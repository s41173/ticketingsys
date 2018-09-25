<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cashout extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Cashout_trans_model', 'transmodel', TRUE);

        $this->properti = $this->property->get();
        $this->acl->otentikasi();

        $this->modul = $this->components->get(strtolower(get_class($this)));
        $this->title = strtolower(get_class($this));

        $this->currency = new Currency_lib();
        $this->user = new Admin_lib();
        $this->journalgl = new Journalgl_lib();
        $this->account = new Account_lib();
        $this->vendor = new Vendor_lib();
        $this->load->library('terbilang');
        $this->ledger  = new Cash_ledger_lib();
        $this->trans = new Trans_ledger_lib();

        $this->model = new Cashouts();
    }

    private $properti, $modul, $title,$model,$ledger,$trans;
    private $vendor,$user,$cash,$currency,$account,$journalgl;

    private  $atts = array('width'=> '800','height'=> '600',
                      'scrollbars' => 'yes','status'=> 'yes',
                      'resizable'=> 'yes','screenx'=> '0','screenx' => '\'+((parseInt(screen.width) - 800)/2)+\'',
                      'screeny'=> '0','class'=> 'print','title'=> 'print', 'screeny' => '\'+((parseInt(screen.height) - 600)/2)+\'');

    function index()
    {
       $this->get_last_cash();
    }
    
    public function getdatatable($search=null,$dates='null')
    {
        if(!$search){$this->model->order_by("dates", "desc"); $result = $this->model->get($this->modul['limit']); }
        else{ $result = $this->model->where('dates', $dates)->get(); }
        
        if ($result){
	foreach($result as $res)
	{
	   $output[] = array ($res->id, $res->no, tglin($res->dates), $res->currency, $this->vendor->get_vendor_name($res->vendor), $res->notes, idr_format($res->amount), $this->get_acc($res->acc), $res->desc, $res->log, $res->approved);
	}
            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($output))
            ->_display();
            exit; 
        }
    }
    
    function get_last_cash()
    {
        $this->acl->otentikasi1($this->title);

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'cash_view';
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_update'] = site_url($this->title.'/update_process');
        $data['form_action_del'] = site_url($this->title.'/delete_all');
        $data['form_action_report'] = site_url($this->title.'/report_process');
        $data['link'] = array('link_back' => anchor('main/','Back', array('class' => 'btn btn-danger')));
        
        $data['currency'] = $this->currency->combo();
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
        $this->table->set_heading('#','No', 'Code', 'Cur', 'Date', 'Vendor', 'Notes', 'Acc', 'Balance', 'Action');

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
        $cash = $this->model->where('id', $pid)->get();

        if ($cash->approved == 1) { echo "warning|$this->title already approved..!"; }
        elseif ($cash->amount == 0){ echo "error|$this->title has no value..!";  }
        elseif ($this->valid_period($cash->dates) == FALSE ){ echo "error|$this->title has invalid period..!"; }
        else
        {
            // tambah fungsi calculate balance account
            //$this->calculate_account_balance($cash->id);
            $this->model->approved = 1;
            $this->model->save();
            $this->model->clear();
            $cash1 = $this->model->where('id', $pid)->get();
            $transs = $this->transmodel->get_last_item($pid)->result();
             
            // pelunasan kartu hutang
            $this->trans->add('bank', 'CD', $cash1->no, strtoupper($cash1->currency), $cash1->dates, $cash1->amount, 0, $cash1->vendor, 'AP');
            
             $account  = $cash1->acc;
            
             $cm = new Control_model();
        
             $this->journalgl->new_journal('0000'.$cash1->no, $cash1->dates,'CD', $cash1->currency, 'Payment to : '.$this->vendor->get_vendor_name($cash1->vendor), $cash1->amount, $this->session->userdata('log'));
             $dpid = $this->journalgl->get_journal_id('CD','0000'.$cash1->no);
               
             foreach ($transs as $trans) 
             {
                 $this->journalgl->add_trans($dpid,$trans->account_id,$trans->balance,0); // kas, bank, kas kecil ( debit )
             }
             $this->journalgl->add_trans($dpid,$account,0,$cash1->amount);
             
             echo "true|$this->title CD-0000$cash->no confirmed..!";
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
        if ($this->acl->otentikasi_admin($this->title,'ajax') == TRUE){
        $val = $this->model->where('id', $uid)->get();

        if ( $this->valid_period($val->dates) == TRUE )
        { 
           if ($val->approved == 1)
           {    
             $this->trans->remove($val->dates, 'CD', $val->no); // hapus kartu hutang  
             $this->journalgl->remove_journal('CD', '0000'.$val->no);
             $val->approved = 0;
             $val->save();
             echo "warning|1 $this->title successfully rollback..!";
           }
           else
           {
             $this->transmodel->delete_po($uid);
             $val->delete();
             $this->session->set_flashdata('message', "1 $this->title successfully removed..!");
             echo "warning|1 $this->title successfully removed..!";
           }
        }
        else{ echo "error|1 $this->title can't removed, invalid period..!"; } 
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
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
    
    private function max_id()
    {
        $res = 0;
        if ( $this->model->count() > 0 )
        {
           $this->model->select_max('id')->get();
           $res = intval($this->model->id);
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
        $data['vendor'] = $this->vendor->combo();
        
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
        $data['code'] = $this->counter();
        $data['user'] = $this->session->userdata("username");

	// Form validation
        $this->form_validation->set_rules('cvendor', 'Vendor', 'required');
        $this->form_validation->set_rules('tno', 'No', 'required|numeric|callback_valid_no');
        $this->form_validation->set_rules('tdate', 'Invoice Date', 'required|callback_valid_period');
        $this->form_validation->set_rules('ccurrency', 'Currency', 'required');
        $this->form_validation->set_rules('tnote', 'Note', 'required');
        $this->form_validation->set_rules('cacc', 'Account', 'required');

        if ($this->form_validation->run($this) == TRUE)
        {
            $this->model->vendor   = $this->input->post('cvendor');
            $this->model->no       = $this->input->post('tno');
            $this->model->acc      = $this->input->post('cacc');
            $this->model->dates    = $this->input->post('tdate');
            $this->model->currency = $this->input->post('ccurrency');
            $this->model->notes    = $this->input->post('tnote');
            $this->model->desc     = $this->input->post('tdesc');
            $this->model->log      = $this->session->userdata('log');
            $this->model->created  = date('Y-m-d H:i:s');

            $this->model->save();

            $this->session->set_flashdata('message', "One $this->title data successfully saved!");
            echo "true|One $this->title data successfully saved!|".$this->max_id();
        }
        else{ echo "error|".validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }

    }
    
    private function valid_add_trans($id)
    {
        if (!$id){ redirect($this->title); }
        $cash = $this->model->where('id',$id)->get();
        if (!$cash){ redirect($this->title); }
    }
    
    function add_trans($id)
    {
        $this->acl->otentikasi2($this->title);
        $this->valid_add_trans($id);
        
        $cash = $this->model->where('id',$id)->get();
        
        $data['title'] = $this->properti['name'].' | Administrator '.ucwords($this->modul['title']);
        $data['h2title'] = 'Create New '.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/update_process/'.$id);
        $data['form_action_item'] = site_url($this->title.'/add_item/'.$id);
        
        $data['vendor'] = $this->vendor->combo();
        $data['currency'] = $this->currency->combo();
        
        $data['code'] = $cash->no;
        $data['user'] = $this->session->userdata("username");
        $data['account'] = $this->account->combo_asset();
        
        $data['main_view'] = 'cash_form';
        $data['source'] = site_url($this->title.'/getdatatable');
        $data['link'] = array('link_back' => anchor($this->title,'Back', array('class' => 'btn btn-danger')));
        
        $data['default']['dates'] = $cash->dates;
        $data['default']['vendor'] = $cash->vendor;
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

    // Fungsi update untuk mengupdate db
    function update_process($jid=null)
    {
        if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
	$data['form_action'] = site_url($this->title.'/update_process/'.$jid);
	$data['link'] = array('link_back' => anchor('journal/','<span>back</span>', array('class' => 'back')));

	// Form validation
        $this->form_validation->set_rules('tdate', 'Invoice Date', 'required|callback_valid_period');
        $this->form_validation->set_rules('tnote', 'Note', 'required');
        $this->form_validation->set_rules('cacc', 'Account', 'required');

        if ($this->form_validation->run($this) == TRUE && $this->valid_confirmation($jid) == TRUE)
        {
            $this->model->where('id',$jid)->get();

            $this->model->dates    = $this->input->post('tdate');
            $this->model->acc      = $this->input->post('cacc');
            $this->model->notes    = $this->input->post('tnote');
            $this->model->desc     = $this->input->post('tdesc');
            $this->model->log      = $this->session->userdata('log');
            $this->model->updated  = date('Y-m-d H:i:s');

            $this->model->save();
            echo "true|One $this->title data successfully updated!|".$jid;
        }
        elseif ($this->valid_confirmation($jid) != TRUE){ echo "warning|Journal approved, can't deleted..!"; }
        else{ echo 'error|'.validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }


    public function valid_period($date=null)
    {
        $p = new Period();
        $p->get();

        $month = date('n', strtotime($date));
        $year = date('Y', strtotime($date));

        if ( intval($p->month) != intval($month) || intval($p->year) != intval($year) )
        {
            $this->form_validation->set_message('valid_period', "Invalid Period.!");
            return FALSE;
        }
        else {  return TRUE; }
    }

    public function valid_no($no)
    {
        $val = $this->model->where('no', $no)->count();
        if ($val > 0)
        {
            $this->form_validation->set_message('valid_no', "Order No already registered.!");
            return FALSE;
        }
        else {  return TRUE; }
    }

    public function valid_confirmation($id)
    {
        $val = $this->model->where('id', $id)->get();

        if ($val->approved == 1)
        {
            $this->form_validation->set_message('valid_confirmation', "Can't change value - Journal approved..!.!");
            return FALSE;
        }
        else {  return TRUE; }
    }

// ===================================== PRINT ===========================================

   function invoice($po=null)
   {
       $this->acl->otentikasi2($this->title);
       $cash = $this->model->where('id', $po)->get();

       $data['h2title'] = 'Print Invoice'.$this->modul['title'];

       $data['p_name'] = $this->properti['name'];
       $data['pono'] = $cash->no;
       $data['podate'] = tglin($cash->dates);
       $data['vendor'] = $this->vendor->get_vendor_name($cash->vendor);
       $data['desc'] = $cash->desc;
       $data['notes'] = $cash->notes;
       $data['user'] = $this->user->get_username($cash->user);
       $data['currency'] = $cash->currency;
       $data['acc'] = $this->get_acc($cash->acc);
       $data['log'] = $this->session->userdata('log');
       $data['amount'] = $cash->amount;
       
       if ($cash->currency == 'IDR'){ $data['terbilang'] = $this->terbilang->baca($cash->amount).' Rupiah'; }
       else { $data['terbilang'] = $this->terbilang->baca($cash->amount); }

       $data['items'] = $this->transmodel->get_last_item($cash->id)->result();
       $this->load->view('cash_invoice', $data);
   }

   function invoice_po($po=null)
   {
       $this->acl->otentikasi2($this->title);
       $cash = $this->model->where('no', $po)->get();

       $data['h2title'] = 'Print Invoice'.$this->modul['title'];

       $data['p_name'] = $this->properti['name'];
       $data['pono'] = $cash->no;
       $data['podate'] = tglin($cash->dates);
       $data['vendor'] = $this->vendor->get_vendor_name($cash->vendor);
       $data['desc'] = $cash->desc;
       $data['notes'] = $cash->notes;
       $data['user'] = $this->user->get_username($cash->user);
       $data['currency'] = $cash->currency;
       $data['acc'] = $this->get_acc($cash->acc);
       $data['log'] = $this->session->userdata('log');
       $data['amount'] = $cash->amount;
       
       if ($cash->currency == 'IDR'){ $data['terbilang'] = $this->terbilang->baca($cash->amount).' Rupiah'; }
       else { $data['terbilang'] = $this->terbilang->baca($cash->amount); }

       $data['items'] = $this->transmodel->get_last_item($cash->id)->result();
       $this->load->view('cash_invoice', $data);
   }

// ===================================== PRINT ===========================================

// ====================================== REPORT =========================================

    function report()
    {
        $this->acl->otentikasi2($this->title);

        $data['title'] = $this->properti['name'].' | Administrator Report '.ucwords($this->modul['title']);
        $data['h2title'] = 'Report '.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/report_process');
        $data['link'] = array('link_back' => anchor('journal/','<span>back</span>', array('class' => 'back')));

        $data['currency'] = $this->currency->combo();
        
        $this->load->view('cash_report_panel', $data);
    }

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
        $data['reports'] = $this->get_report_search($cur,$start,$end);
        
        $data['total'] = 0;
        $this->load->view('cash_report', $data); 
        
    }
    
    private function get_report_search($cur,$start,$end)
    {
       if ($start != '' || $end != '') { $this->model->where_between('dates', "'".$start."'", "'".$end."'"); }
       $this->model->where('currency', $cur);
       return $this->model->where('approved', 1)->get();
    }


// ====================================== REPORT =========================================
    
       // ====================================== CLOSING ======================================
    
   function reset_process(){ $this->transmodel->closing_trans();  $this->transmodel->closing(); }  

}

?>