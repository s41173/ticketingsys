<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Journalgl extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Journal_model', 'jm', TRUE);
        
        $this->properti = $this->property->get();
        $this->acl->otentikasi();

        $this->modul = $this->components->get(strtolower(get_class($this)));
        $this->title = strtolower(get_class($this));
       
        $this->currency = new Currency_lib();
        $this->user = new Admin_lib();
        $this->journaltype = new Journaltype_lib();
        $this->account = new Account_lib();
        $this->classi = new Classification_lib();
        $this->ledger = new Ledger_lib();
        $this->period = new Period_lib();

        $this->model = new Gl();
        $this->mitem = new Transaction();
    }

    private $properti, $modul, $title,$model,$mitem,$journaltype;
    private $user,$currency,$account,$classi,$ledger,$period;


    function index()
    {
        $this->session->unset_userdata('jid');
       $this->ledger->set_profit_loss(); 
       $this->get_last();
    }
    
    public function getdatatable($search=null,$code='null',$no='null',$dates='null')
    {
        if(!$search){ $result = $this->jm->get_last($this->modul['limit'])->result(); }
        else {$result = $this->jm->search($code,$no,$dates)->result(); }
        
        if ($result){
	foreach($result as $res)
	{  
	   $output[] = array ($res->id, $res->no, $res->code, tglin($res->dates), $res->currency, $res->notes, idr_format($res->balance), $res->approved);
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
        $data['main_view'] = 'journal_view';
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_update'] = site_url($this->title.'/update_process');
        $data['form_action_del'] = site_url($this->title.'/delete_all');
        $data['form_action_report'] = site_url($this->title.'/report_process');
        $data['link'] = array('link_back' => anchor('main/','Back', array('class' => 'btn btn-danger')));
	// ---------------------------------------- //
       
        $data['currency'] = $this->currency->combo();
        $data['journal'] = $this->journaltype->combo_all();
        
        $config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = "<li><span><b>";
        $config['cur_tag_close'] = "</b></span></li>";

        // library HTML table untuk membuat template table class zebra
        $tmpl = array('table_open' => '<table id="datatable-buttons" class="table table-striped table-bordered">');

        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");

        //Set heading untuk table
        $this->table->set_heading('#', 'No', 'Code', 'Cur', 'Date', 'Notes', 'Balance', 'Action');

        $data['table'] = $this->table->generate();
        $data['source'] = site_url($this->title.'/getdatatable');
            
        // Load absen view dengan melewatkan var $data sbgai parameter
	$this->load->view('template', $data);
    }

    function search()
    {
        $this->acl->otentikasi1($this->title);

        $data['title'] = $this->properti['name'].' | Administrator Find '.ucwords($this->modul['title']);
        $data['h2title'] = 'Find '.$this->modul['title'];
        $data['main_view'] = 'journal_view';
	$data['form_action'] = site_url($this->title.'/search');
        $data['link'] = array('link_back' => anchor($this->title,'<span>back</span>', array('class' => 'back')));

        $data['jurnaltype'] = $this->journaltype->combo_all();
        $journals = $this->get_search($this->input->post('tno'), $this->input->post('cref'), $this->input->post('tdate'));
        
        $tmpl = array('table_open' => '<table cellpadding="2" cellspacing="1" class="tablemaster">');

        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");

        //Set heading untuk table
        $this->table->set_heading('No', 'Code', 'Cur', 'Date', 'Notes', 'Balance', 'Action');

        $i = 0;
        foreach ($journals as $journal)
        {
//                $datax = array('name'=> 'cek[]','id'=> 'cek'.$i,'value'=> $journal->id,'checked'=> FALSE, 'style'=> 'margin:0px');

            $this->table->add_row
            (
                ++$i, $journal->code.'-'.$journal->no, $journal->currency, tglin($journal->dates), $journal->notes, number_format($journal->balance),
                anchor($this->title.'/confirmation/'.$journal->id,'<span>update</span>',array('class' => $this->post_status($journal->approved), 'title' => 'edit / update')).' '.
                anchor_popup($this->title.'/invoice/'.$journal->no.'/'.$journal->code,'<span>print</span>',$this->atts).' '.
                anchor($this->title.'/add_trans/'.$journal->no.'/'.$journal->code,'<span>details</span>',array('class' => 'update', 'title' => '')).' '.
                anchor($this->title.'/delete/'.$journal->id.'/'.$journal->no,'<span>delete</span>',array('class'=> 'delete', 'title' => 'delete' ,'onclick'=>"return confirm('Are you sure you will delete this data?')"))
            );
        }

        $data['table'] = $this->table->generate();
        $this->load->view('template', $data);
    }


    function get_list($currency=null,$vendor=null)
    {
        $this->acl->otentikasi1($this->title);

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['form_action'] = site_url($this->title.'/get_list');
        $data['main_view'] = 'vendor_list';
        $data['currency'] = $this->currency->combo();
        $data['link'] = array('link_back' => anchor($this->title.'/get_list','<span>back</span>', array('class' => 'back')));

        $currency = $this->input->post('ccurrency');
        $vendor = $this->vendor->get_vendor_id($this->input->post('tvendor'));

        $journals = $this->Purchase_model->get_journal_list($currency,$vendor)->result();

        $tmpl = array('table_open' => '<table cellpadding="2" cellspacing="1" class="tablemaster">');

        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");

        //Set heading untuk table
        $this->table->set_heading('No', 'Code', 'Date', 'Cur', 'Notes', 'Total', 'Balance', 'Action');

        $i = 0;
        foreach ($journals as $journal)
        {
           $datax = array(
                            'name' => 'button',
                            'type' => 'button',
                            'content' => 'Select',
                            'onclick' => 'setvalue(\''.$journal->no.'\',\'titem\')'
                         );

            $this->table->add_row
            (
                ++$i, 'PO-00'.$journal->no, tgleng($journal->dates), $journal->currency, $journal->notes, number_format($journal->total,3), number_format($journal->p2,3),
                form_button($datax)
            );
        }

        $data['table'] = $this->table->generate();
        $this->load->view('journal_list', $data);
    }

//    ===================== approval ===========================================

    private function post_status($val)
    {
       if ($val == 0) {$class = "notapprove"; }
       elseif ($val == 1){$class = "approve"; }
       return $class;
    }

    function confirmation($pid)
    {
        if ($this->acl->otentikasi3($this->title,'ajax') == TRUE){
        $journal = $this->model->where('id', $pid)->get();
        $ps = $this->period->get();

        if ($journal->approved == 1) { echo "warning|$this->title already approved..!"; }
        elseif ($journal->balance == 0){ echo "error|$this->title has no value..!"; }
//        elseif ($this->valid_period($journal->dates) == FALSE ){ $this->session->set_flashdata('message', "$this->title has invalid period..!"); }
        else
        {
            if ($this->cek_cf($pid) == TRUE){$this->model->cf = 1;}else{$this->model->cf = 0;}
            $this->model->approved = 1;
            $this->model->save();
            $this->ledger->set_profit_loss($journal->currency);
            echo "true|$this->title GJ-0$journal->no confirmed..!";
        }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }
    
    private function cek_cf($pid)
    {
       $ac = new Account_lib();
       $result = $this->mitem->where('gl_id', $pid)->get();
       $res = FALSE;
       foreach ($result as $val){ if ($ac->get_classi($val->account_id) == 7 || $ac->get_classi($val->account_id) == 8){ $res = TRUE; break; } }
       return $res;
    }


//    ===================== approval ===========================================


    function delete($uid)
    {
        if ($this->acl->otentikasi_admin($this->title,'ajax') == TRUE){
        $val = $this->model->where('id', $uid)->get();
        $cur = $this->model->currency;

//        if ( $this->valid_period($this->model->dates) == TRUE )
//        { 
           if ($val->approved == 1) 
           {
               $val->approved = 0;
               $val->save();
               $this->ledger->set_profit_loss($cur);
               $this->session->set_flashdata('message', "1 $this->title successfully rollback..!");
               echo "true|1 $this->title successfully rollback..!";
           }
           else
           {
              $this->mitem->where('gl_id', $uid)->get();
              $this->mitem->delete_all();
              $val->delete();
              $this->session->set_flashdata('message', "1 $this->title successfully removed..!"); 
              echo "true|1 $this->title successfully removed..!";
           }
//        }
//        else{ $this->session->set_flashdata('message', "1 $this->title can't removed, invalid period..!");} 
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }

    function counter($type='GJ',$target='non')
    { 
        $res = 0;
        if ( $this->model->count() > 0 )
        {
           $this->model->select_max('no');
           $this->model->where('code', $type)->get();
           $res = $this->model->no + 1;
        }  
        else{ $res = 1; }
        if ($target=='non'){ return $res; }else{ echo $res; }
    }
    

    function add()
    {
        $this->acl->otentikasi2($this->title);

        $data['title'] = $this->properti['name'].' | Administrator '.ucwords($this->modul['title']);
        $data['h2title'] = 'Create New '.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_item'] = site_url($this->title.'/add_item/');
        $data['currency'] = $this->currency->combo();
        $data['user'] = $this->session->userdata("username");
        $data['journal'] = $this->journaltype->combo();
        $data['main_view'] = 'journal_form';
        $data['source'] = site_url($this->title.'/getdatatable');
        $data['link'] = array('link_back' => anchor($this->title,'Back', array('class' => 'btn btn-danger')));
        
        $data['counter'] = $this->counter();
        if ($this->session->userdata('jid')){
            $val = $this->jm->get_by_id($this->session->userdata('jid'))->row();
            $data['total'] = $val->balance;
            $data['items'] = $this->jm->get_transaction($this->session->userdata('jid'))->result();   
            $res = $this->get_debit_credit($this->session->userdata('jid'));
            $data['debit']   = $res[0];
            $data['credit']  = $res[1];
            $data['balance'] = $res[2];
        }else{ $data['total'] = 0; $data['items'] = null; }
        
        $this->load->view('template', $data);
    }

    function add_process()
    {
        if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){

	// Form validation
        $this->form_validation->set_rules('tno', 'No', 'required|numeric|callback_valid_no');
//        $this->form_validation->set_rules('tdate', 'Invoice Date', 'required|callback_valid_period');
        $this->form_validation->set_rules('tdate', 'Invoice Date', 'required');
        $this->form_validation->set_rules('ccurrency', 'Currency', 'required');
        $this->form_validation->set_rules('tnote', 'Note', 'required');

        if ($this->form_validation->run($this) == TRUE)
        {
            $this->model->no       = $this->input->post('tno');
            $this->model->code     = $this->input->post('ctype');
            $this->model->dates    = $this->input->post('tdate');
            $this->model->currency = $this->input->post('ccurrency');
            $this->model->docno    = $this->input->post('tdocno');
            $this->model->notes    = $this->input->post('tnote');
            $this->model->desc     = $this->input->post('tdesc');
            $this->model->log      = $this->session->userdata('log');
            $this->model->created  = date('Y-m-d H:i:s');
            $this->model->save();
            
//            $this->session->set_userdata('jid', $this->jm->counter());
            $this->session->set_flashdata('message', "One $this->title data successfully saved!");
            echo "true|One $this->title data successfully saved!|".$this->jm->counter();
        }
        else{ echo 'error|'.validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }

    function add_trans($id)
    {
        $this->acl->otentikasi2($this->title);
        $this->jm->valid_add_trans($id, $this->title);
        
        $this->session->unset_userdata('jid');
                
        $data['title'] = $this->properti['name'].' | Administrator '.ucwords($this->modul['title']);
        $data['h2title'] = 'Create New '.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/update_process/'.$id);
        $data['form_action_item'] = site_url($this->title.'/add_item/'.$id);
        $data['currency'] = $this->currency->combo();
        $data['user'] = $this->session->userdata("username");
        $data['journal'] = $this->journaltype->combo();
        $data['main_view'] = 'journal_form';
        $data['source'] = site_url($this->title.'/getdatatable');
        $data['link'] = array('link_back' => anchor($this->title,'Back', array('class' => 'btn btn-danger')));
        
        $journal = $this->jm->get_by_id($id)->row();
        $data['counter'] = $journal->no;
        $data['default']['type'] = $journal->code;
        
        $data['total'] = $journal->balance;
        $data['items'] = $this->jm->get_transaction($id)->result();   
        $res = $this->get_debit_credit($id);
        $data['debit']   = $res[0];
        $data['credit']  = $res[1];
        $data['balance'] = $res[2];
        
        $data['default']['dates'] = $journal->dates;
        $data['default']['currency'] = $journal->currency;
        $data['default']['note'] = $journal->notes;
        $data['default']['desc'] = $journal->desc;
        $data['default']['docno'] = $journal->docno;
        $data['default']['balance'] = $journal->balance;
        
        $this->load->view('template', $data);
    }


//    ======================  Item Transaction   ===============================================================

    function add_item($uid=null)
    {
//        $this->cek_confirmation($po,'add_trans');
        if ($uid){ $jid = $uid; }else{ $jid = $this->session->userdata('jid'); }
        
        if ($jid){
            $this->form_validation->set_rules('titem', 'Item Name', 'required');
            $this->form_validation->set_rules('tdebit', 'Debit', 'required|numeric');
            $this->form_validation->set_rules('tcredit', 'Credit', 'required|numeric');

            if ($this->form_validation->run($this) == TRUE && $this->valid_confirmation($jid) == TRUE)
            {
                $this->mitem->gl_id = $jid;
                $this->mitem->account_id = $this->account->get_id_code($this->input->post('titem'));
                $this->mitem->debit = $this->input->post('tdebit');
                $this->mitem->credit = $this->input->post('tcredit');
                $this->mitem->vamount = $this->calculate_vamount($this->account->get_id_code($this->input->post('titem')), $this->input->post('tdebit'), $this->input->post('tcredit'));

                $this->mitem->save();
                $this->update_trans($jid);
                echo 'true';
            }
            elseif ( $this->valid_confirmation($jid) != TRUE ){ echo "error|Can't change value - Journal approved..!"; }
            else{ echo 'error|'.validation_errors(); }
        }else{ echo 'error|Journal Transaction Not Created...!!'; }
    }

    private function calculate_vamount($acc,$debit=0,$credit=0)
    {
        $type = $this->classi->get_type($this->account->get_classi($acc));
        $res = 0;

        if ($type == 'harta'){ $res = 0 + $debit - $credit; }
        elseif ($type == 'kewajiban'){ $res = 0 - $debit + $credit; }
        elseif ($type == 'modal'){ $res = 0 - $debit + $credit; }
        elseif ($type == 'pendapatan'){ $res = 0 - $debit + $credit; }
        elseif ($type == 'biaya'){ $res = 0 + $debit - $credit; }
        return $res;
    }

    private function update_trans($po)
    {
        if ($this->cek_balance($po) == TRUE)
        {
            $this->mitem->select_sum('debit');
            $this->mitem->where('gl_id',$po)->get();

            $this->model->where('id', $po)->get();
            $this->model->balance = $this->mitem->debit;
        }
        else
        {
            $this->model->where('id', $po)->get();
            $this->model->balance = 0;
        }

        $this->model->save();
    }

    private function cek_balance($id)
    {
        $this->mitem->select_sum('debit');
        $this->mitem->select_sum('credit');
        $this->mitem->where('gl_id',$id)->get();
        $debit = intval($this->mitem->debit);
        $credit = intval($this->mitem->credit);
        if ($debit!=$credit){ return FALSE; } else{ return TRUE; }
    }

    private function get_debit_credit($id)
    {
        $this->mitem->select_sum('debit');
        $this->mitem->select_sum('credit');
        $this->mitem->where('gl_id',$id)->get();
        $debit = $this->mitem->debit;
        $credit = $this->mitem->credit;

        $res = null;
        $res[0] = $debit;
        $res[1] = $credit;
        $res[2] = $debit-$credit;
        return $res;
    }

    function delete_item($id)
    {
        if ($this->acl->otentikasi_admin($this->title,'ajax') == TRUE){

        $jid = $this->jm->get_glid($id)->row();            
        $jid = $jid->gl_id;
        if ( $this->valid_confirmation($jid) == TRUE )
        {
            $this->mitem->where('id',$id)->get();
            $this->mitem->delete();
            $this->update_trans($jid);
            $this->session->set_flashdata('message', "1 item successfully removed..!");
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
        $this->form_validation->set_rules('tno', 'No', 'required|numeric');
        $this->form_validation->set_rules('tdate', 'Invoice Date', 'required');
        $this->form_validation->set_rules('tdate', 'Invoice Date', 'required');
        $this->form_validation->set_rules('ccurrency', 'Currency', 'required');
        $this->form_validation->set_rules('tnote', 'Note', 'required');

        if ($this->form_validation->run($this) == TRUE && $this->valid_confirmation($jid) == TRUE)
        {
            $this->model->where('id',$jid)->get();

            $this->model->dates    = $this->input->post('tdate');
            $this->model->docno    = $this->input->post('tdocno');
            $this->model->notes    = $this->input->post('tnote');
            $this->model->desc     = $this->input->post('tdesc');
            $this->model->log      = $this->session->userdata('log');

            $this->model->save();
            echo "true|One $this->title data successfully updated!|".$jid;
        }
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
        $this->model->where('code', 'GJ');
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
    

   function invoice($pid)
   {
        $this->acl->otentikasi1($this->title);

        $journal = $this->jm->get_by_id($pid)->row();

        $data['title'] = $this->properti['name'].' | Administrator '.ucwords($this->modul['title']);
        $data['code'] = $journal->no;
        $data['codetrans'] = $journal->code;
        $data['user'] = $this->session->userdata("username");

        $data['dates'] = $journal->dates;
        $data['currency'] = $journal->currency;
        $data['notes'] = $journal->notes;
        $data['desc'] = $journal->desc;
        $data['docno'] = $journal->docno;
        $data['balance'] = $journal->balance;
        
        $res = $this->get_debit_credit($journal->id);
        $data['debit']   = $res[0];
        $data['credit']  = $res[1];
        $data['balances'] = idr_format($res[2],2);

//        ============================ Item  =========================================
        $data['items'] = $this->mitem->where('gl_id', $journal->id)->order_by('id', 'asc')->get();

        $this->load->view('journal_invoice', $data);
   }
   
   function invoice_po($no,$code)
   {
        $this->acl->otentikasi1($this->title);

        $this->model->where('code', $code);
        $journal = $this->model->where('no', $no)->get();

        $data['title'] = $this->properti['name'].' | Administrator '.ucwords($this->modul['title']);
        $data['code'] = $journal->no;
        $data['codetrans'] = $journal->code;
        $data['user'] = $this->session->userdata("username");

        $data['dates'] = $journal->dates;
        $data['currency'] = $journal->currency;
        $data['notes'] = $journal->notes;
        $data['desc'] = $journal->desc;
        $data['docno'] = $journal->docno;
        $data['balance'] = $journal->balance;
        
        $res = $this->get_debit_credit($journal->id);
        $data['debit']   = $res[0];
        $data['credit']  = $res[1];
        $data['balances'] = idr_format($res[2],2);

//        ============================ Item  =========================================
        $data['items'] = $this->mitem->where('gl_id', $journal->id)->order_by('id', 'asc')->get();

        $this->load->view('journal_invoice', $data);
   }

// ===================================== PRINT ===========================================

// ====================================== REPORT =========================================

    function report_process()
    {
        $this->acl->otentikasi2($this->title);
        $data['title'] = $this->properti['name'].' | Report '.ucwords($this->modul['title']);

        $cur = $this->input->post('ccurrency');
        $journal = $this->input->post('cjournal');
        
        $period = $this->input->post('reservation');  
        $start = picker_between_split($period, 0);
        $end = picker_between_split($period, 1);

        $data['currency'] = $cur;
        $data['start'] = $start;
        $data['end'] = $end;
        $data['rundate'] = tgleng(date('Y-m-d'));
        $data['log'] = $this->session->userdata('log');

//        Property Details
        $data['company'] = $this->properti['name'];
        
        $data['journals'] = $this->jm->report($cur,$journal,$start,$end)->result();
        $this->load->view('journal_report', $data); 
        
    }
    
        // ====================================== CLOSING ====================================== 
   function reset_process(){ $this->jm->closing(); $this->jm->closing_trans(); }


// ====================================== REPORT =========================================

}

?>