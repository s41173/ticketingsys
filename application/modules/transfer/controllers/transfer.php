<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transfer extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Transfer_model', 'model', TRUE);

        $this->properti = $this->property->get();
        $this->acl->otentikasi();

        $this->modul = $this->components->get(strtolower(get_class($this)));
        $this->title = strtolower(get_class($this));

        $this->currency  = $this->load->library('currency_lib');
        $this->user      = $this->load->library('admin_lib');
        $this->journalgl = $this->load->library('journalgl_lib');
        $this->account = new Account_lib();
        $this->ledger  = new Cash_ledger_lib();
    }

    private $properti, $modul, $title, $account, $ledger;
    private $vendor,$user,$currency,$journalgl;

    function index()
    {
       $this->get_last();
    }
    
    public function getdatatable($search=null,$date='null')
    {
        if(!$search){ $result = $this->model->get_last_transfer($this->modul['limit'])->result(); }
        else{ $result = $this->model->search($date)->result(); }
        
        if ($result){
	foreach($result as $res)
	{
	   $output[] = array ($res->id, $res->no, $res->notes, tglin($res->dates), $res->currency, $this->get_acc($res->from), $this->get_acc($res->to), 
                              $res->approved, idr_format($res->amount));
	}
            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($output))
            ->_display();
            exit; 
        }
    }
    
    function get_last()
    {
        $this->acl->otentikasi1($this->title);

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'transfer_view';
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_update'] = site_url($this->title.'/update_process');
        $data['form_action_del'] = site_url($this->title.'/delete_all');
        $data['form_action_report'] = site_url($this->title.'/report_process');
        $data['link'] = array('link_back' => anchor('main/','Back', array('class' => 'btn btn-danger')));
        
        $data['currency'] = $this->currency->combo();
        $data['account'] = $this->account->combo_asset();
        $data['code'] = $this->model->counter();
	// ---------------------------------------- //
 
        $config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = "<li><span><b>";
        $config['cur_tag_close'] = "</b></span></li>";

        // library HTML table untuk membuat template table class zebra
        $tmpl = array('table_open' => '<table id="datatable-buttons" class="table table-striped table-bordered">');

        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");

        //Set heading untuk table
        $this->table->set_heading('#','No', 'Code', 'Date', 'Notes', 'Currency', 'From Acc', 'To Acc', 'Amount', 'Action');

        $data['table'] = $this->table->generate();
        $data['source'] = site_url($this->title.'/getdatatable');
            
        // Load absen view dengan melewatkan var $data sbgai parameter
	$this->load->view('template', $data);
    }
    
    private function get_acc($acc)
    {
        return $this->account->get_code($acc).' : '.$this->account->get_name($acc);
    }

    function confirmation($pid)
    {
        if ($this->acl->otentikasi3($this->title,'ajax') == TRUE){
        $transfer = $this->model->get_transfer_by_id($pid)->row();

        if ($transfer->approved == 1){ echo "warning|$this->title already approved..!"; }
        else
        {
            $total = $transfer->amount;
            if ($total == 0){ echo "error|$this->title has no value..!"; }
            else
            {
                $data = array('approved' => 1);
                $this->model->update_id($pid, $data);

                //  create journal
                $cm = new Control_model();
                
                $from = $transfer->from; 
                $to = $transfer->to;
                
                 // add cash ledger
                $this->ledger->remove($transfer->dates, "TR-00".$transfer->no);
                $this->ledger->add($this->get_acc_type($transfer->to), "TR-00".$transfer->no, $transfer->currency, $transfer->dates, $transfer->amount, 0);

                
                $this->journalgl->new_journal('0'.$transfer->no,$transfer->dates,'TR',$transfer->currency, 'Transfer from : '.$this->acc_type($transfer->from).' to '.$this->acc_type($transfer->to), $transfer->amount, $this->session->userdata('log'));
                $dpid = $this->journalgl->get_journal_id('TR','0'.$transfer->no);
                
                $this->journalgl->add_trans($dpid,$to,$transfer->amount,0); // to
                $this->journalgl->add_trans($dpid,$from,0,$transfer->amount); // from

                echo "true|$this->title TR-00$transfer->no confirmed..!";
            }
        }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }
    
    private function get_acc_type($account)
    {
       if ($this->account->get_classi($account) == 7) { return 'cash'; }
       elseif ($this->account->get_classi($account) == 8) { return 'bank'; }
       else { return 'bank'; }
    }


//    ===================== approval ===========================================


    function delete($uid)
    {
        $this->acl->otentikasi_admin($this->title);
        $transfer = $this->model->get_by_id($uid)->row();

        if ($this->valid_period($transfer->dates) == TRUE ) // cek journal harian sudah di approve atau belum
        {
            if ($transfer->approved == 1)
            {
              $this->ledger->remove($transfer->dates, "TR-00".$transfer->no); // cash ledger    
              $this->journalgl->remove_journal('TR', '0'.$transfer->no);
              $data = array('approved' => 0);
              $this->model->update_id($uid, $data);
            }
            else 
            {  $this->ledger->remove($transfer->dates, "TR-00".$transfer->no); // cash ledger  
               $this->model->force_delete($uid); 
            }
            
            echo "warning|1 $this->title successfully removed..!";
        }
        else{  echo "error|1 $this->title can't removed, journal approved..!"; } 
    }

    private function counter()
    {
        $res = 0;
        if ( $this->model->count() > 0 )
        {
           $this->model->select_max('no')->get();
           $res = intval($this->model->no+1);
        }
        else{ $res = 1; }
        return $res;
    }

    function add()
    {
        $this->acl->otentikasi2($this->title);

        $data['title'] = $this->properti['name'].' | Administrator '.ucwords($this->modul['title']);
        $data['h2title'] = 'Create New '.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_item'] = site_url($this->title.'/add_item/');
        
        $data['currency'] = $this->currency->combo();
        $data['code'] = $this->counter();
        $data['user'] = $this->session->userdata("username");
        $data['account'] = $this->account->combo_asset();
        $data['customer'] = $this->customer->combo();
        
        $data['main_view'] = 'cash_form';
        $data['source'] = site_url($this->title.'/getdatatable');
        $data['link'] = array('link_back' => anchor($this->title,'Back', array('class' => 'btn btn-danger')));
        
        $data['total'] = 0;
        $data['items'] = null;
        
        $this->load->view('template', $data);
    }
    

    function add_process()
    {
         if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'cash_form';
	$data['form_action'] = site_url($this->title.'/add_process');
        
        $data['currency'] = $this->currency->combo();
        $data['code'] = $this->model->counter();
        $data['user'] = $this->session->userdata("username");
        $data['account'] = $this->account->combo_asset();

	// Form validation
        $this->form_validation->set_rules('tno', 'GJ - No', 'required|numeric|callback_valid_no');
        $this->form_validation->set_rules('tdate', 'Date', 'required|callback_valid_period');
        $this->form_validation->set_rules('ccurrency', 'Currency', 'required');
        $this->form_validation->set_rules('tnote', 'Note', 'required');
        $this->form_validation->set_rules('tamount', 'Amount', 'required|numeric');
        $this->form_validation->set_rules('cfrom', 'From', 'required');
        $this->form_validation->set_rules('cto', 'To', 'required|callback_valid_acc');

        if ($this->form_validation->run($this) == TRUE)
        {
            $transfer = array('no' => $this->input->post('tno'), 'from' => $this->input->post('cfrom'), 'to' => $this->input->post('cto'),
                        'dates' => $this->input->post('tdate'), 'currency' => $this->input->post('ccurrency'), 'notes' => $this->input->post('tnote'),
                        'amount' => $this->input->post('tamount'), 'log' => $this->session->userdata('log'));
            
            $this->model->add($transfer);
            echo "true|One $this->title data successfully saved!|";
        }
        else{ echo "error|".validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }

    }
    
    function add_trans($id)
    {
        $this->acl->otentikasi2($this->title);
        $this->model->valid_add_trans($id, $this->title);
        
        $cash = $this->model->where('id',$id)->get();
        
        $data['title'] = $this->properti['name'].' | Administrator '.ucwords($this->modul['title']);
        $data['h2title'] = 'Create New '.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/update_process/'.$id);
        $data['form_action_item'] = site_url($this->title.'/add_item/'.$id);
        
        $data['customer'] = $this->customer->combo();
        $data['currency'] = $this->currency->combo();
        
        $data['code'] = $cash->no;
        $data['user'] = $this->session->userdata("username");
        $data['account'] = $this->account->combo_asset();
        
        $data['main_view'] = 'cash_form';
        $data['source'] = site_url($this->title.'/getdatatable');
        $data['link'] = array('link_back' => anchor($this->title,'Back', array('class' => 'btn btn-danger')));
        
        $data['default']['dates'] = $cash->dates;
        $data['default']['customer'] = $cash->customer;
        $data['default']['currency'] = $cash->currency;
        $data['default']['note'] = $cash->notes;
        $data['default']['desc'] = $cash->desc;
        $data['default']['acc'] = $cash->acc;
        $data['total'] = $cash->amount;
        $data['items'] = $this->transmodel->get_last_item($cash->id)->result();
        
        $this->load->view('template', $data);
    }


//    ======================  Item Transaction   ===============================================================

    function add_item($po=null)
    {
        $this->form_validation->set_rules('titem', 'Item Name', 'required');
        $this->form_validation->set_rules('tcredit', 'Credit', 'required|numeric');

        if ($this->form_validation->run($this) == TRUE && $this->valid_confirmation($po) == TRUE)
        {
            $pitem = array('cash_id' => $po, 
                           'account_id' => $this->account->get_id_code($this->input->post('titem')),
                           'balance' => $this->input->post('tcredit'));
            
            $this->transmodel->add($pitem);
            $this->update_trans($po);
            echo 'true';
        }
        elseif ( $this->valid_confirmation($po) != TRUE ){ echo "error|Can't change value - Journal approved..!"; }
        else{ echo 'error|'.validation_errors(); } 
    }

    private function update_trans($po)
    {
        $total = $this->transmodel->total($po);
        $this->model->where('id', $po)->get();
        $this->model->amount = $total['balance'];
        $this->model->save();
    }

    function delete_item($id)
    {
        if ($this->acl->otentikasi_admin($this->title,'ajax') == TRUE){
            
        $jid = $this->transmodel->get_by_id($id)->row();
        if ( $this->valid_confirmation($jid->cash_id) == TRUE )
        {
            $this->transmodel->force_delete($id);
            $this->update_trans($jid->cash_id);
            echo 'true|Transaction removed..!';
        }
        else{ echo "warning|Journal approved, can't deleted..!"; }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }
//    ==========================================================================================
    function update($uid=null)
    {        
        $res = $this->model->get_by_id($uid)->row_array();
	$this->session->set_userdata('langid', $uid);
        
        echo implode("|", $res);
    }
    
    
    // Fungsi update untuk mengupdate db
    function update_process()
    {
        if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){

        $jid = $this->session->userdata('langid');
        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
	$data['form_action'] = site_url($this->title.'/update_process/'.$jid);
	$data['link'] = array('link_back' => anchor($this->title,'<span>back</span>', array('class' => 'back')));

	// Form validation
        $this->form_validation->set_rules('tdate', 'Date', 'required|callback_valid_period');
        $this->form_validation->set_rules('ccurrency', 'Currency', 'required');
        $this->form_validation->set_rules('tnote', 'Note', 'required');
        $this->form_validation->set_rules('tamount', 'Amount', 'required|numeric');
        $this->form_validation->set_rules('cfrom', 'From', 'required');
        $this->form_validation->set_rules('cto', 'To', 'required|callback_valid_acc');

        if ($this->form_validation->run($this) == TRUE && $this->valid_confirmation($jid) == TRUE)
        {
            $transfer = array('from' => $this->input->post('cfrom'), 'to' => $this->input->post('cto'),
                              'dates' => $this->input->post('tdate'), 'currency' => $this->input->post('ccurrency'), 'notes' => $this->input->post('tnote'),
                              'amount' => $this->input->post('tamount'), 'log' => $this->session->userdata('log'));

            $this->model->update_id($jid, $transfer);

            echo "true|One $this->title data successfully updated!|";
        }
        elseif ($this->valid_confirmation($jid) != TRUE){ echo "warning|Journal approved, can't updated..!"; }
        else{ echo 'error|'.validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }
    
    public function valid_confirmation($id)
    {
        $val = $this->model->get_by_id($id)->row();

        if ($val->approved == 1)
        {
            $this->form_validation->set_message('valid_confirmation', "Can't change value - Journal approved..!.!");
            return FALSE;
        }
        else {  return TRUE; }
    }

    public function valid_period($date=null)
    {
        $p = new Period();
        $p->get();

        $month = date('n', strtotime($date));
        $year  = date('Y', strtotime($date));

        if ( intval($p->month) != intval($month) || intval($p->year) != intval($year) )
        {
            $this->form_validation->set_message('valid_period', "Invalid Period.!");
            return FALSE;
        }
        else {  return TRUE; }
    }

    public function valid_no($no)
    {
        if ($this->model->valid_no($no) == FALSE)
        {
            $this->form_validation->set_message('valid_no', "Order No already registered.!");
            return FALSE;
        }
        else {  return TRUE; }
    }

    public function valid_acc($val)
    {
        $from = $this->input->post('cfrom');
        if ( $val == $from )
        {
            $this->form_validation->set_message('valid_acc', "Invalid Account.!");
            return FALSE;
        }
        else { return TRUE; }
    }
    

// ===================================== PRINT ===========================================

   function invoice($id=null)
   {
       $this->acl->otentikasi2($this->title);
       $ap = $this->model->get_by_id($id)->row();

       $data['h2title'] = 'Print Invoice'.$this->modul['title'];

       $data['pono'] = $ap->no;
       $data['podate'] = tglin($ap->dates);
       $data['notes'] = $ap->notes;
       $data['from'] = $this->acc_type($ap->from);
       $data['to'] = $this->acc_type($ap->to);
       $data['currency'] = $ap->currency;
       $data['log'] = $this->session->userdata('log');

       $data['amount'] = $ap->amount;
       $terbilang = $this->load->library('terbilang');
       if ($ap->currency == 'IDR')
       { $data['terbilang'] = ucwords($terbilang->baca($ap->amount)).' Rupiah'; }
       else { $data['terbilang'] = ucwords($terbilang->baca($ap->amount)); }
       
       if($ap->approved == 1){ $stts = 'A'; }else{ $stts = 'NA'; }
       $data['stts'] = $stts;

//       if ($ap->approved != 1){ $this->load->view('rejected', $data); }
//       else { $this->load->view('apc_invoice', $data); }
       $this->load->view('transfer_invoice', $data);

   }
   
   function invoice_po($no=null)
   {
       $this->acl->otentikasi2($this->title);
       $ap = $this->model->get_transfer_by_no($no)->row();

       $data['h2title'] = 'Print Invoice'.$this->modul['title'];

       $data['pono'] = $ap->no;
       $data['podate'] = tglin($ap->dates);
       $data['notes'] = $ap->notes;
       $data['from'] = $this->acc_type($ap->from);
       $data['to'] = $this->acc_type($ap->to);
       $data['currency'] = $ap->currency;
       $data['log'] = $this->session->userdata('log');

       $data['amount'] = $ap->amount;
       $terbilang = $this->load->library('terbilang');
       if ($ap->currency == 'IDR')
       { $data['terbilang'] = ucwords($terbilang->baca($ap->amount)).' Rupiah'; }
       else { $data['terbilang'] = ucwords($terbilang->baca($ap->amount)); }
       
       if($ap->approved == 1){ $stts = 'A'; }else{ $stts = 'NA'; }
       $data['stts'] = $stts;

//       if ($ap->approved != 1){ $this->load->view('rejected', $data); }
//       else { $this->load->view('apc_invoice', $data); }
       $this->load->view('transfer_invoice', $data);

   }
   
    private function acc_type($val=null)
    {
        return $this->account->get_code($val).'-'.$this->account->get_name($val);
    }

   
   function print_expediter($po=null)
   {
       $this->acl->otentikasi2($this->title);

       $data['h2title'] = 'Print Expediter'.$this->modul['title'];

       $cash = $this->Purchase_model->get_journal_by_no($po)->row();

       $data['pono'] = $po;
       $data['podate'] = tgleng($cash->dates);
       $data['vendor'] = $cash->prefix.' '.$cash->name;
       $data['address'] = $cash->address;
       $data['shipdate'] = tgleng($cash->shipping_date);
       $data['city'] = $cash->city;
       $data['phone'] = $cash->phone1;
       $data['phone2'] = $cash->phone2;
       $data['desc'] = $cash->desc;
       $data['user'] = $this->user->get_username($cash->user);
       $data['currency'] = $this->currency->get_code($cash->currency);
       $data['docno'] = $cash->docno;

       $data['cost'] = $cash->costs;
       $data['p2'] = $cash->p2;
       $data['p1'] = $cash->p1;

       $data['items'] = $this->Purchase_item_model->get_last_item($po)->result();

       // property display
       $data['p_name'] = $this->properti['name'];
       $data['paddress'] = $this->properti['address'];
       $data['p_phone1'] = $this->properti['phone1'];
       $data['p_phone2'] = $this->properti['phone2'];
       $data['p_city'] = ucfirst($this->properti['city']);
       $data['p_zip'] = $this->properti['zip'];
       $data['p_npwp'] = $this->properti['npwp'];

       $this->load->view('journal_expediter', $data);
   }

// ===================================== PRINT ===========================================

// ====================================== REPORT =========================================

    function report_process()
    {
        $this->acl->otentikasi2($this->title);
        $data['title'] = $this->properti['name'].' | Report '.ucwords($this->modul['title']);

        $cur = $this->input->post('ccurrency');
        $period = $this->input->post('reservation');  
        $start = picker_between_split($period, 0);
        $end = picker_between_split($period, 1);

        $data['currency'] = $cur;
        $data['start'] = $start;
        $data['end'] = $end;
        $data['rundate'] = tglin(date('Y-m-d'));
        $data['log'] = $this->session->userdata('log');

//        Property Details
        $data['company'] = $this->properti['name'];
        $data['reports'] = $this->model->report($cur,$start,$end)->result();
        
        $this->load->view('transfer_report', $data); 
        
    }


// ====================================== REPORT =========================================
    
// ====================================== CLOSING ======================================
   function reset_process(){ $this->model->closing(); }     

}

?>