<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Apc extends MX_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->properti = $this->property->get();
        $this->acl->otentikasi();
        
        $this->load->model('Apc_model', '', TRUE);
        $this->load->model('Apc_trans_model', '', TRUE);

        $this->modul = $this->components->get(strtolower(get_class($this)));
        $this->title = strtolower(get_class($this));

        $this->currency = new Currency_lib();
        $this->unit = new Unit_lib();
        $this->user = new Admin_lib();
        $this->tax = new Tax_lib();
        $this->cost = new Cost_lib();
        $this->ps = new Period_lib();
        $this->ledger = new Cash_ledger_lib();
        $this->journalgl = new Journalgl_lib();
        $this->account = new Account_lib();
        $this->model = new Apcmodel();
        $this->vendor = new Vendor_lib();
        $this->trans = new Trans_ledger_lib();
    }

    private $properti, $modul, $title, $cost,$ps, $model, $ledger, $account;
    private $user,$tax,$journal,$journalgl,$currency,$unit,$vendor,$trans;

    function index()
    {
       $this->get_last();
    }
    
    public function getdatatable($search=null,$dates='null')
    {
        if(!$search){ $result = $this->Apc_model->get_last($this->modul['limit'])->result(); }
        else{ $result = $this->Apc_model->search($dates)->result(); }
        
        if ($result){
	foreach($result as $res)
	{
	   $output[] = array ($res->id, $res->no, strtoupper($res->currency), tglin($res->dates), $res->notes, $this->get_acc($res->account), idr_format($res->amount), $res->approved);
	}
            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($output))
            ->_display();
            exit; 
        }
    }
    
    private function get_acc($acc){ return $this->account->get_code($acc).' : '.$this->account->get_name($acc); }
    
    function get_last()
    {
        $this->acl->otentikasi1($this->title);

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'apc_view';
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_update'] = site_url($this->title.'/update_process');
        $data['form_action_del'] = site_url($this->title.'/delete_all');
        $data['form_action_report'] = site_url($this->title.'/report_process');
        $data['link'] = array('link_back' => anchor('main/','Back', array('class' => 'btn btn-danger')));
        
        $data['currency'] = $this->currency->combo();
        $data['vendor'] = $this->vendor->combo();
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
        $this->table->set_heading('#','No', 'Code', 'Cur', 'Date', 'Notes', 'Acc', 'Balance', 'Action');

        $data['table'] = $this->table->generate();
        $data['source'] = site_url($this->title.'/getdatatable');
            
        // Load absen view dengan melewatkan var $data sbgai parameter
	$this->load->view('template', $data);
    }

    public function chart($cur='IDR')
    {
        $fusion = $this->load->library('fusioncharts');
        $chart  = base_url().'public/flash/Column3D.swf';
        
        $ps = new Period();
        $ps->get();
        $py = new Payment_status_lib();
        
        if ($this->input->post('ccurrency')){ $cur = $this->input->post('ccurrency'); }else { $cur = 'IDR'; }
        if ($this->input->post('tyear')){ $year = $this->input->post('tyear'); }else { $year = $ps->year; }
        
        $arpData[0][1] = 'January';
        $arpData[0][2] = $this->Apc_model->total_chart(1,$year,$cur);
//
        $arpData[1][1] = 'February';
        $arpData[1][2] = $this->Apc_model->total_chart(2,$year,$cur);
//
        $arpData[2][1] = 'March';
        $arpData[2][2] = $this->Apc_model->total_chart(3,$year,$cur);
//
        $arpData[3][1] = 'April';
        $arpData[3][2] = $this->Apc_model->total_chart(4,$year,$cur);
//
        $arpData[4][1] = 'May';
        $arpData[4][2] = $this->Apc_model->total_chart(5,$year,$cur);
//
        $arpData[5][1] = 'June';
        $arpData[5][2] = $this->Apc_model->total_chart(6,$year,$cur);
//
        $arpData[6][1] = 'July';
        $arpData[6][2] = $this->Apc_model->total_chart(7,$year,$cur);

        $arpData[7][1] = 'August';
        $arpData[7][2] = $this->Apc_model->total_chart(8,$year,$cur);
        
        $arpData[8][1] = 'September';
        $arpData[8][2] = $this->Apc_model->total_chart(9,$year,$cur);
//        
        $arpData[9][1] = 'October';
        $arpData[9][2] = $this->Apc_model->total_chart(10,$year,$cur);
//        
        $arpData[10][1] = 'November';
        $arpData[10][2] = $this->Apc_model->total_chart(11,$year,$cur);
//        
        $arpData[11][1] = 'December';
        $arpData[11][2] = $this->Apc_model->total_chart(12,$year,$cur);

        $strXML1 = $fusion->setDataXML($arpData,'','') ;
        $graph   = $fusion->renderChart($chart,'',$strXML1,"Tuition", "98%", 400, false, false) ;
        return $graph;
        
    }
    
    private function get_search($no,$date)
    {
        if ($no){ $this->model->where('no', $no); }
        elseif($date){ $this->model->where('dates', $date); }
        return $this->model->get();
    }
    
    function search()
    {
        $this->acl->otentikasi1($this->title);

        $data['title'] = $this->properti['name'].' | Administrator Find '.ucwords($this->modul['title']);
        $data['h2title'] = 'Find '.$this->modul['title'];
        $data['main_view'] = 'ap_view';
	$data['form_action'] = site_url($this->title.'/search');
        $data['link'] = array('link_back' => anchor($this->title,'<span>back</span>', array('class' => 'back')));
        $data['currency'] = $this->currency->combo();

        $aps = $this->get_search($this->input->post('tno'), $this->input->post('tdate'));
        
        $tmpl = array('table_open' => '<table cellpadding="2" cellspacing="1" class="tablemaster">');

        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");

        //Set heading untuk table
       $this->table->set_heading('No', 'Code', 'Cur', 'Date', 'Notes', 'Acc', 'Balance', '#', 'Action');

        $i = 0;
        foreach ($aps as $ap)
        {
//                $datax = array('name'=> 'cek[]','id'=> 'cek'.$i,'value'=> $ap->id,'checked'=> FALSE, 'style'=> 'margin:0px');

            $this->table->add_row
            (
                ++$i, 'DJC-00'.$ap->no, $ap->currency, tglin($ap->dates), $ap->notes, ucfirst($ap->acc), number_format($ap->amount), $this->status($ap->status),
                anchor($this->title.'/confirmation/'.$ap->id,'<span>update</span>',array('class' => $this->post_status($ap->approved), 'title' => 'edit / update')).' '.
                anchor_popup($this->title.'/invoice/'.$ap->no,'<span>print</span>',$this->atts).' '.
                anchor($this->title.'/add_trans/'.$ap->no,'<span>details</span>',array('class' => 'update', 'title' => '')).' '.
                anchor($this->title.'/delete/'.$ap->id.'/'.$ap->no,'<span>delete</span>',array('class'=> 'delete', 'title' => 'delete' ,'onclick'=>"return confirm('Are you sure you will delete this data?')"))
            );
        }

        $data['table'] = $this->table->generate();
        $data['graph'] = $this->chart($this->input->post('ccurrency'),  $this->input->post('cyear'));
        $this->load->view('template', $data);
    }

    private function status($val=null)
    { switch ($val) { case 0: $val = 'D'; break; case 1: $val = 'S'; break; } return $val; }
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
        $ap = $this->model->where('id',$pid)->get();

        if ($ap->approved == 1)
        {
           echo "warning|$this->title already approved..!";
        }
        else
        {
//            $this->cek_journal($ap->dates,$ap->currency); // cek apakah journal sudah approved atau belum
            $total = $ap->amount;

            if ($total == 0)
            {
              echo "error|$this->title has no value..!";
            }
            else
            {
                $this->model->approved = 1;
                $this->model->status = 1;
                $this->model->save();
                $this->model->clear();
                
                $ap1 = $this->model->where('id',$pid)->get();

                //  create journal gl
                
                $cm = new Control_model();

                $account  = $ap1->account;                
                
                // create journal- GL
                $this->journalgl->new_journal('0'.$ap1->no,$ap1->dates,'DJC',$ap1->currency,$ap1->notes,$ap1->amount, $this->session->userdata('log'));
//                
                $transs = $this->Apc_trans_model->get_last_item($pid)->result(); 
                $dpid = $this->journalgl->get_journal_id('DJC','0'.$ap1->no);
                
                foreach ($transs as $trans) 
                {
//                    $this->cost->get_acc($trans->cost);
                    $this->journalgl->add_trans($dpid,$this->cost->get_acc($trans->cost),$trans->amount,0); // biaya
                }
                
                $this->journalgl->add_trans($dpid,$account,0,$ap1->amount); // kas, bank, kas kecil
                echo "true|DJC-00$ap1->no confirmed..!";
            }
        }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }

    }

//    ===================== approval ===========================================


    function delete($uid)
    {
        if ($this->acl->otentikasi_admin($this->title,'ajax') == TRUE){
        $val = $this->Apc_model->get_by_id($uid)->row();

        if ($val->approved == 1){ $this->void($uid); }
        elseif ( $this->valid_period($val->dates) == TRUE ) // cek journal harian sudah di approve atau belum
        {            
            // remove cash ledger
            $this->ledger->remove($val->dates, "DJC-00".$val->no);
            
            $this->Apc_trans_model->delete_po($uid);
            $this->Apc_model->force_delete($uid);
            echo "warning|1 $this->title successfully removed..!";
        }
        else{ echo "warning|1 $this->title can't removed, journal approved..!"; } 
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }
    
    private function void($uid)
    {
       $val = $this->model->where('id',$uid)->get();
       if ($this->valid_period($val->dates) == TRUE)
       {
           $this->journalgl->remove_journal('DJC', '0'.$val->no); // journal gl
           
           $val->approved = 0;
           $val->status = 0;
           $val->save();
           echo "warning|1 $this->title successfull voided..!";
       }
       else { echo "error|Invalid Period..!";  }
    }
    
    function add()
    {
        $this->acl->otentikasi2($this->title);

        $data['title'] = $this->properti['name'].' | Administrator '.ucwords($this->modul['title']);
        $data['h2title'] = 'Create New '.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_item'] = site_url($this->title.'/add_item/');
        
        $data['currency'] = $this->currency->combo();
        $data['code'] = $this->Apc_model->counter();
        $data['id'] = $this->max_id();
        $data['user'] = $this->session->userdata("username");
        $data['account'] = $this->account->combo_asset();
        $data['cost'] = $this->cost->combo();
        
        $data['main_view'] = 'apc_form';
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
        $data['code'] = $this->Apc_model->counter();
        $data['user'] = $this->session->userdata("username");

	// Form validation
        $this->form_validation->set_rules('tno', 'DJ - No', 'required|numeric|callback_valid_no');
        $this->form_validation->set_rules('tdate', 'Invoice Date', 'required|callback_valid_period');
        $this->form_validation->set_rules('ccurrency', 'Currency', 'required');
        $this->form_validation->set_rules('tnote', 'Note', 'required');
        $this->form_validation->set_rules('tdocno', 'Doc NO', '');

        if ($this->form_validation->run($this) == TRUE)
        {
           $trans = array('no' => $this->input->post('tno'), 'status' => 0,
                           'dates' => $this->input->post('tdate'), 'account' => $this->input->post('cacc'), 
                           'currency' => $this->input->post('ccurrency'), 'notes' => $this->input->post('tnote'), 
                           'desc' => $this->input->post('tdesc'), 'user' => $this->user->get_id($this->input->post('tuser')),
                           'log' => $this->session->userdata('log'), 'created' => date('Y-m-d H:i:s'));
            
            $this->Apc_model->add($trans);
            
            $this->session->set_flashdata('message', "One $this->title data successfully saved!");
            echo "true|One $this->title data successfully saved!|".$this->max_id();
        }
        else{ echo "error|".validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }

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

    function add_trans($uid=null)
    {
        $this->acl->otentikasi2($this->title);
        $this->Apc_model->valid_add_trans($uid, $this->title);
        
        $ap = $this->model->where('id', $uid)->get();

        $data['title'] = $this->properti['name'].' | Administrator '.ucwords($this->modul['title']);
        $data['h2title'] = 'Create New '.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/update_process/'.$ap->id);
        $data['form_action_item'] = site_url($this->title.'/add_item/'.$ap->id);
        $data['currency'] = $this->currency->combo();
        $data['cost'] = $this->cost->combo();
        $data['code'] = $ap->no;
        $data['id'] = $ap->id;
        $data['user'] = $this->session->userdata("username");
        $data['account'] = $this->account->combo_asset();
        
        $data['default']['dates'] = $ap->dates;
        $data['default']['currency'] = $ap->currency;
        $data['default']['acc'] = $ap->account;
        $data['default']['note'] = $ap->notes;
        $data['default']['desc'] = $ap->desc;
        $data['default']['user'] = $this->user->get_username($ap->user);
        $data['default']['account'] = $ap->account;        
        $data['main_view'] = 'apc_form';
        $data['source'] = site_url($this->title.'/getdatatable');
        $data['link'] = array('link_back' => anchor($this->title,'Back', array('class' => 'btn btn-danger')));
        
        $data['total'] = $ap->amount;
        $data['items'] = $this->Apc_trans_model->get_last_item($ap->id)->result();

        $this->load->view('template', $data);
    }


//    ======================  Item Transaction   ===============================================================

    function add_item($pid=null)
    {   
        $this->form_validation->set_rules('ccost', 'Cost Type', 'required');
        $this->form_validation->set_rules('tstaff', 'Staff', 'required');
        $this->form_validation->set_rules('tamount', 'Amount', 'required|numeric');

        if ($this->valid_transaction($pid) == TRUE && $this->form_validation->run($this) == TRUE && $this->valid_confirmation($pid) == TRUE)
        {
            $pitem = array('apc_id' => $pid, 'cost' => $this->input->post('ccost'),
                           'notes' => $this->input->post('tnotes'),
                           'staff' => $this->input->post('tstaff'),
                           'amount' => $this->input->post('tamount'));
            
            $this->Apc_trans_model->add($pitem);
            $this->update_trans($pid);

            echo 'true';
        }
        elseif ( $this->valid_confirmation($pid) != TRUE ){ echo "error|Can't change value - Journal approved..!"; }
        elseif ( $this->valid_transaction($pid) != TRUE ){ echo "error|Can't change value - Transaction Not Created..!"; }
        else{   echo validation_errors(); }
    }
    
    function edit_item($id)
    {
       $this->acl->otentikasi2($this->title); 
       $val = $this->Apc_trans_model->get_by_id($id);  
       $data['form_action_item'] = site_url($this->title.'/edit_item_process/'.$id.'/'.$val->apc_id); 
       
       $data['cost'] = $this->cost->combo();
       
       $data['default']['notes'] = $val->notes;
       $data['default']['staff'] = $val->staff;
       $data['default']['amount'] = $val->amount;       
       $data['default']['cost'] = $val->cost;
        
       $this->load->view('apc_update_item', $data); 
    }
    
    function edit_item_process($id,$apc)
    {
        $ap = $this->model->where('id', $apc)->get();
        
        $this->form_validation->set_rules('tstaff', 'Staff', 'required');
        $this->form_validation->set_rules('tamount', 'Amount', 'required|numeric');

        if ($this->form_validation->run($this) == TRUE && $this->valid_confirmation($ap->no) == TRUE)
        {
            $pitem = array('notes' => $this->input->post('tnotes'), 
                           'cost' => $this->input->post('ccost'),
                           'staff' => $this->input->post('tstaff'),
                           'amount' => $this->input->post('tamount'));
            
            $this->Apc_trans_model->update($id,$pitem);
            $this->update_trans($apc);
        }
        
        redirect($this->title.'/edit_item/'.$id);
    }

    private function update_trans($pid)
    {
        $totals = $this->Apc_trans_model->total($pid);
        
        $this->model->where('id', $pid)->get();
        $this->model->amount = intval($totals['amount']);
        $this->model->save();
    }

    function delete_item($id)
    {
        $pid = $this->Apc_trans_model->get_by_id($id)->row();
        if ($this->valid_confirmation($pid->apc_id) == TRUE &&  $this->acl->otentikasi_admin($this->title,'ajax') == TRUE){
        
        $val = $this->Apc_trans_model->get_by_id($id)->row();
        
        $this->Apc_trans_model->force_delete($id); // memanggil model untuk mendelete data
        $this->update_trans($val->apc_id);
        echo 'true|Transaction removed..!';
        
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }
    
    function print_item($id)
    {
//        $this->cek_confirmation($pid,'add_trans');
        $this->acl->otentikasi1($this->title);
        $terbilang = $this->load->library('terbilang');
        
        $value = $this->Apc_trans_model->get_by_id($id);
        $ap = $this->model->where('id', $value->apc_id)->get();
        
        $data['pono'] = $ap->no;
        $data['staff'] = $value->staff;
        $data['currency'] = $ap->currency;
        $data['notes'] = $value->notes;
        $data['cost'] = $value->cost;
        $data['amount'] = $value->amount;
        $data['user'] = $this->user->get_username($ap->user);
        
        if ($ap->currency == 'IDR')
        { $data['terbilang'] = ucwords($terbilang->baca($value->amount)).' Rupiah'; }
        else { $data['terbilang'] = ucwords($terbilang->baca($value->amount)); }
        
        if ($ap->acc == 'pettycash'){ $this->load->view('apc_receipt', $data); }
        else
        {
           if ($ap->approved == 1){ $this->load->view('apc_receipt', $data); }
           else { $this->load->view('rejected', $data); } 
        } 
    }
//    ==========================================================================================

    // Fungsi update untuk mengupdate db
    function update_process($pid=null)
    {
        if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
	$data['form_action'] = site_url($this->title.'/update_process');
	$data['link'] = array('link_back' => anchor('purchase/','<span>back</span>', array('class' => 'back')));

	// Form validation
        
        $this->form_validation->set_rules('tid', 'ID', 'required|numeric|callback_valid_confirmation');
        $this->form_validation->set_rules('tno', 'DJ - No', 'required|numeric');
        $this->form_validation->set_rules('tdate', 'Invoice Date', 'required|callback_valid_period');
        $this->form_validation->set_rules('tnote', 'Note', 'required');
        $this->form_validation->set_rules('tdocno', 'Doc NO', '');

        if ($this->form_validation->run($this) == TRUE)
        { 
            // cash ledger
            $val = $this->model->where('id',$pid)->get();
            $this->ledger->remove($val->dates, "DJC-00".$val->no);
            
            $this->model->where('id',$pid)->get();
            
            $this->model->currency = $this->input->post('ccurrency');
            $this->model->dates    = $this->input->post('tdate');
            $this->model->account  = $this->input->post('cacc');
            $this->model->notes    = $this->input->post('tnote');
            $this->model->desc     = $this->input->post('tdesc');
            $this->model->user     = $this->user->get_id($this->input->post('tuser'));
            $this->model->log      = $this->session->userdata('log');
            $this->model->updated  = date('Y-m-d H:i:s');
            
            $this->ledger->add($this->model->acc, "DJC-00".$this->model->no, $this->model->currency, $this->model->dates, 0, $this->model->amount);
            $this->model->save();

            echo "true|One $this->title data successfully updated!|".$pid;
        }
        else{ echo validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }

    public function valid_period($date=null)
    {
        $p = new Period();
        $p->get();

        $month = date('n', strtotime($date));
        $year  = date('Y', strtotime($date));

        if ( intval($p->month) != intval($month) || intval($p->year) != intval($year) )
        {
            if (cek_previous_period($month, $year) == TRUE){ return TRUE; }
            else { $this->form_validation->set_message('valid_period', "Invalid Period.!"); return FALSE; }
        }
        else {  return TRUE; }
    }
    
    public function valid_vendor($name)
    {
        if ($this->vendor->valid_vendor($name) == FALSE)
        {
            $this->form_validation->set_message('valid_vendor', "Invalid Vendor.!");
            return FALSE;
        }
        else{ return TRUE; }
    }

   public function valid_no($no)
   {
        if ($this->Apc_model->valid_no($no) == FALSE)
        {
            $this->form_validation->set_message('valid_no', "Order No already registered.!");
            return FALSE;
        }
        else {  return TRUE; }
   }

    public function valid_confirmation($pid)
    {
        $ap = $this->model->where('id', $pid)->get();

        if ($ap->approved == 1)
        {
            $this->form_validation->set_message('valid_confirmation', "Can't change value - Order approved..!.!");
            return FALSE;
        }
        else {  return TRUE; }
    }
    
    public function valid_transaction($id)
    {
        $val = $this->model->where('id', $id)->count();

        if ($val == 0)
        {
            $this->form_validation->set_message('valid_transaction', "Transaction Not Created...!");
            return FALSE;
        }
        else {  return TRUE; }
    }

    public function valid_rate($rate)
    {
        if ($rate == 0)
        {
            $this->form_validation->set_message('valid_rate', "Rate can't 0..!");
            return FALSE;
        }
        else {  return TRUE; }
    }

// ===================================== PRINT ===========================================
    

   function invoice($id=null)
   {
       $this->acl->otentikasi2($this->title);
       $ap = $this->model->where('id', $id)->get();

       $data['h2title'] = 'Print Invoice'.$this->modul['title'];

       $data['pono'] = $ap->no;
       $data['podate'] = tglin($ap->dates);
       $data['vendor'] = "";
       $data['venbank'] = "";
       $data['notes'] = $ap->notes;
       $data['acc'] = ucfirst($ap->acc);
       $data['user'] = $this->user->get_username($ap->user);
       $data['currency'] = $ap->currency;
       $data['docno'] = $ap->docno;
       $data['log'] = $this->session->userdata('log');
       $data['account'] = $this->account->get_code($ap->account).' : '. $this->account->get_name($ap->account);

       $data['amount'] = $ap->amount;
       $terbilang = $this->load->library('terbilang');
       if ($ap->currency == 'IDR')
       { $data['terbilang'] = ucwords($terbilang->baca($ap->amount)).' Rupiah'; }
       else { $data['terbilang'] = ucwords($terbilang->baca($ap->amount)); }
       
       if($ap->approved == 1){ $stts = 'A'; }else{ $stts = 'NA'; }
       $data['stts'] = $stts;

       $data['items'] = $this->Apc_trans_model->get_last_item($ap->id)->result();
       
       $data['accounting'] = $this->properti['accounting'];
       $data['manager'] = $this->properti['manager'];

//       if ($ap->approved != 1){ $this->load->view('rejected', $data); }
//       else { $this->load->view('apc_invoice', $data); }
       $this->load->view('apc_invoice', $data);

   }

   function invoice_po($no=null)
   {
       $this->acl->otentikasi2($this->title);
       $ap = $this->model->where('no', $no)->get();

       $data['h2title'] = 'Print Invoice'.$this->modul['title'];

       $data['pono'] = $ap->no;
       $data['podate'] = tglin($ap->dates);
       $data['vendor'] = "";
       $data['venbank'] = "";
       $data['notes'] = $ap->notes;
       $data['acc'] = ucfirst($ap->acc);
       $data['user'] = $this->user->get_username($ap->user);
       $data['currency'] = $ap->currency;
       $data['docno'] = $ap->docno;
       $data['log'] = $this->session->userdata('log');
       $data['account'] = $this->account->get_code($ap->account).' : '. $this->account->get_name($ap->account);

       $data['amount'] = $ap->amount;
       $terbilang = $this->load->library('terbilang');
       if ($ap->currency == 'IDR')
       { $data['terbilang'] = ucwords($terbilang->baca($ap->amount)).' Rupiah'; }
       else { $data['terbilang'] = ucwords($terbilang->baca($ap->amount)); }
       
       if($ap->approved == 1){ $stts = 'A'; }else{ $stts = 'NA'; }
       $data['stts'] = $stts;

       $data['items'] = $this->Apc_trans_model->get_last_item($ap->id)->result();
       
       $data['accounting'] = $this->properti['accounting'];
       $data['manager'] = $this->properti['manager'];

//       if ($ap->approved != 1){ $this->load->view('rejected', $data); }
//       else { $this->load->view('apc_invoice', $data); }
       $this->load->view('apc_invoice', $data);

   }
   
// ===================================== PRINT ===========================================

// ====================================== REPORT =========================================

    function report()
    {
        $this->acl->otentikasi2($this->title);

        $data['title'] = $this->properti['name'].' | Administrator Report '.ucwords($this->modul['title']);
        $data['h2title'] = 'Report '.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/report_process');
        $data['link'] = array('link_back' => anchor('purchase/','<span>back</span>', array('class' => 'back')));

        $data['currency'] = $this->currency->combo();
        $data['category'] = $this->category->combo_all();
        
        $this->load->view('apc_report_panel', $data);
    }

    function report_process()
    {
        $this->acl->otentikasi2($this->title);
        $data['title'] = $this->properti['name'].' | Report '.ucwords($this->modul['title']);

        
        $cur = $this->input->post('ccurrency');
        $type = $this->input->post('ctype');
        $acc = $this->account->get_id_code($this->input->post('titem'));
        
        $period = $this->input->post('reservation');  
        $start = picker_between_split($period, 0);
        $end = picker_between_split($period, 1);

        $data['currency'] = strtoupper($cur);
        $data['start'] = $start;
        $data['end'] = $end;
        $data['rundate'] = tgleng(date('Y-m-d'));
        $data['log'] = $this->session->userdata('log');

//        Property Details
        $data['company'] = $this->properti['name'];

        if ($type == 0){ $data['aps'] = $this->Apc_model->report($acc,$cur,$start,$end)->result(); $page = 'apc_report'; }
        elseif ($type == 1){ $data['aps'] = $this->Apc_model->report($acc,$cur,$start,$end)->result(); $page = 'apc_report_details'; }
        elseif ($type == 2) { $data['aps'] = $this->Apc_model->report_category($acc,$cur,$start,$end)->result(); $page = 'apc_report_category'; }
        elseif ($type == 3) { $data['aps'] = $this->Apc_model->report_category($acc,$cur,$start,$end)->result(); $page = 'apc_pivot'; }
        
        $this->load->view($page, $data);
        
    }
    
    function payable_process()
    {
        $this->acl->otentikasi2($this->title);
        $data['title'] = $this->properti['name'].' | Report '.ucwords($this->modul['title']);

        $data['rundate'] = tglin(date('Y-m-d'));
        $data['log'] = $this->session->userdata('log');
        $period = $this->input->post('reservation');  
        $start = picker_between_split($period, 0);
        $end = picker_between_split($period, 1);

        $data['start'] = tglin($start);
        $data['end'] = tglin($end);
        
        $cust = $this->input->post('cvendor');

        $data['currency'] = 'IDR';
        $data['start'] = tglin($start);
        $data['end'] = tglin($end);

        $data['rundate'] = tgleng(date('Y-m-d'));
        $data['log'] = $this->session->userdata('log');
        
        // Property Details
        $data['company'] = $this->properti['name'];
        
        $data['customer'] = $this->vendor->get_vendor_name($cust);
        $data['open'] = $this->trans->get_sum_transaction_open_balance_ap('bank', 'IDR', $start, $cust, 'AP', 'PO');
        $data['trans'] = $this->trans->get_transaction_ap('bank', 'IDR', $start, $end, $cust, 'AP', 'PO')->result();
        
        $this->load->view('payable_card', $data);
    }


// ====================================== REPORT =========================================

// ====================================== CASH LEDGER ====================================
   
    function cash_ledger()
    {
        $this->acl->otentikasi2($this->title);

        $data['title'] = $this->properti['name'].' | Administrator Report '.ucwords($this->modul['title']);
        $data['h2title'] = 'Report '.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/cash_ledger_process');
        $data['link'] = array('link_back' => anchor('purchase/','<span>back</span>', array('class' => 'back')));

        $data['currency'] = $this->currency->combo();
        
        $this->load->view('cash_ledger_report_panel', $data);
    }
    
    function cash_ledger_process()
    {
        $this->acl->otentikasi2($this->title);
        $data['title'] = $this->properti['name'].' | Report '.ucwords($this->modul['title']);

        $cur   = $this->input->post('ccurrency');
        $start = $this->input->post('tstart');
        $end   = $this->input->post('tend');
        $acc   = $this->input->post('cacc');

        $data['currency'] = $cur;
        $data['start'] = tglin($start);
        $data['end'] = tglin($end);
        $data['account'] = ucfirst($acc);
        $data['rundate'] = tgleng(date('Y-m-d'));
        $data['log'] = $this->session->userdata('log');

//        Property Details
        $data['company'] = $this->properti['name'];

        $data['opening'] = $this->ledger->get_sum_transaction_open_balance($acc, $cur, $start);
        $data['trans'] = $this->ledger->get_transaction($acc, $cur, $start, $end)->result();
        $data['endbalance'] = $this->ledger->get_sum_transaction_balance($acc, $cur, $start, $end);
        
        $this->load->view('cash_ledger_invoice', $data);
    }
    
    // ====================================== CLOSING ======================================
    function reset_process(){ $this->Apc_model->closing(); $this->Apc_trans_model->closing(); $this->Apc_trans_model->closing_trans(); }
}

?>