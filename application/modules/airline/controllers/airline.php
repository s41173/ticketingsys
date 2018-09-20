<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Airline extends MX_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->properti = $this->property->get();
        $this->acl->otentikasi();
        
        $this->load->model('Airline_model', '', TRUE);

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
       
    }

    private $properti, $modul, $title, $cost,$ps, $model, $ledger, $account;
    private $user,$tax,$journal,$journalgl,$currency,$unit;

    function index()
    {
       $this->get_last();
    }
    
    public function getdatatable($search=null,$region='null',$type='null')
    {
        if(!$search){ $result = $this->Airline_model->get_last($this->modul['limit'])->result(); }
        else{ $result = $this->Airline_model->search($region,$type)->result(); }
        
        if ($result){
	foreach($result as $res)
	{
           $bl = $this->account->get_balance($res->account, $this->ps->get('month'), $this->ps->get('year')); 
	   $output[] = array ($res->id, $res->code, strtoupper($res->name), $this->status($res->region), $res->description, $res->type,
                              $this->account->get_code($res->account).' : '.$this->account->get_name($res->account), $res->publish, idr_format($bl)
                             );
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
        $data['main_view'] = 'airline_view';
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
        $this->table->set_heading('#','No', 'Code', 'Name', 'Region', 'Type', 'Account', 'Balance', 'Action');

        $data['table'] = $this->table->generate();
        $data['source'] = site_url($this->title.'/getdatatable');
            
        // Load absen view dengan melewatkan var $data sbgai parameter
	$this->load->view('template', $data);
    }

    private function status($val=null)
    { switch ($val) { case 0: $val = 'Domestic'; break; case 1: $val = 'International'; case 2: $val = 'Domestic & International'; break; } return $val; }


    function publish($uid = null)
    {
       if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){ 
       $val = $this->Airline_model->get_by_id($uid)->row();
       if ($val->publish == 0){ $lng = array('publish' => 1); }else { $lng = array('publish' => 0); }
       $this->Airline_model->update($uid,$lng);
       echo 'true|Status Changed...!';
       }else{ echo "error|Sorry, you do not have the right to change publish status..!"; }
    }

//    ===================== approval ===========================================


    function delete($uid)
    {
        if ($this->acl->otentikasi_admin($this->title,'ajax') == TRUE){
            $val = $this->Airline_model->get_by_id($uid)->row();
            if ($val->publish == 0)
            {   $this->Airline_model->delete($uid);
                echo "true|1 $this->title successfully soft removed..!";
            }
            else{ echo "warning|publish $this->title can not be removed..!"; }
        
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }
    
    function add()
    {
        $this->acl->otentikasi2($this->title);

        $data['title'] = $this->properti['name'].' | Administrator '.ucwords($this->modul['title']);
        $data['h2title'] = 'Create New '.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_item'] = site_url($this->title.'/add_item/');
        
        $data['currency'] = $this->currency->combo();
        $data['code'] = $this->Airline_model->counter();
        $data['id'] = $this->max_id();
        $data['user'] = $this->session->userdata("username");
        $data['account'] = $this->account->combo_asset();
        $data['cost'] = $this->cost->combo();
        
        $data['main_view'] = 'airline_form';
        $data['source'] = site_url($this->title.'/getdatatable');
        $data['link'] = array('link_back' => anchor($this->title,'Back', array('class' => 'btn btn-danger')));
        
        $data['total'] = 0;
        $data['items'] = null;
        
        $this->load->view('template', $data);
    }
    
    function add_process()
    {
        if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){

	// Form validation
        $this->form_validation->set_rules('tcode', 'Code', 'required|callback_valid_code');
        $this->form_validation->set_rules('cregion', 'Region Type', 'required');
        $this->form_validation->set_rules('ctype', 'Type', 'required');
        $this->form_validation->set_rules('tname', 'Name', 'required');
        $this->form_validation->set_rules('tdesc', 'Description', '');
        $this->form_validation->set_rules('titem', 'Account', 'required');

        if ($this->form_validation->run($this) == TRUE)
        {            
            $airline = array('code' => $this->input->post('tcode'), 'name' => $this->input->post('tname'),
                             'region' => $this->input->post('cregion'), 'type' => $this->input->post('ctype'),
                             'account' => $this->account->get_id_code($this->input->post('titem')), 
                             'description' => $this->input->post('tdesc'),
                             'created' => date('Y-m-d H:i:s'));
            
            $this->Airline_model->add($airline);

            echo 'true|'.$this->title.' successfully saved..!';
        }
        else{ echo "error|".validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }

    }    
    
    function update($uid)
    {
        $acc = $this->Airline_model->get_by_id($uid)->row();
        $this->session->set_userdata('langid', $acc->id);
        
        echo $acc->id.'|'.$acc->code.'|'.$acc->name.'|'.$acc->region.'|'.$acc->description.'|'.
             $acc->type.'|'. $this->account->get_code($acc->account).'|'.$acc->publish;
    }


    // Fungsi update untuk mengupdate db
    function update_process()
    {
        if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){
        
	// Form validation
        $this->form_validation->set_rules('tcode', 'Code', 'required');
        $this->form_validation->set_rules('cregion', 'Region Type', 'required');
        $this->form_validation->set_rules('ctype', 'Type', 'required');
        $this->form_validation->set_rules('tname', 'Name', 'required');
        $this->form_validation->set_rules('tdesc', 'Description', '');
        $this->form_validation->set_rules('titem', 'Account', 'required');

        if ($this->form_validation->run($this) == TRUE)
        {
            $airline = array('name' => $this->input->post('tname'),
                             'region' => $this->input->post('cregion'), 'type' => $this->input->post('ctype'),
                             'account' => $this->account->get_id_code($this->input->post('titem')),
                             'description' => $this->input->post('tdesc'),
                             'created' => date('Y-m-d H:i:s'));
            
            $this->Airline_model->update($this->session->userdata('langid'), $airline);
            echo 'true|Data successfully saved..!';
        }
        else{ echo 'error|'.validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }

   public function valid_code($code)
   {
        if ($this->Airline_model->valid('code',$code) == FALSE)
        {
            $this->form_validation->set_message('valid_code', "Code already registered.!");
            return FALSE;
        }
        else {  return TRUE; }
   }
// ===================================== PRINT ===========================================
    

   function invoice($id=null)
   {
       $this->acl->otentikasi2($this->title);
       
       $val = $this->Airline_model->get_by_id($id)->row();
       echo $this->account->get_balance($val->account, $this->ps->get('month'), $this->ps->get('year'));

//       $data['h2title'] = 'Print Invoice'.$this->modul['title'];
//
//       $data['pono'] = $ap->no;
//       $data['podate'] = tglin($ap->dates);
//       $data['vendor'] = "";
//       $data['venbank'] = "";
//       $data['notes'] = $ap->notes;
//       $data['acc'] = ucfirst($ap->acc);
//       $data['user'] = $this->user->get_username($ap->user);
//       $data['currency'] = $ap->currency;
//       $data['docno'] = $ap->docno;
//       $data['log'] = $this->session->userdata('log');
//       $data['account'] = $this->account->get_code($ap->account).' : '. $this->account->get_name($ap->account);
//
//       $data['amount'] = $ap->amount;
//       $terbilang = $this->load->library('terbilang');
//       if ($ap->currency == 'IDR')
//       { $data['terbilang'] = ucwords($terbilang->baca($ap->amount)).' Rupiah'; }
//       else { $data['terbilang'] = ucwords($terbilang->baca($ap->amount)); }
//       
//       if($ap->approved == 1){ $stts = 'A'; }else{ $stts = 'NA'; }
//       $data['stts'] = $stts;
//
//       $data['items'] = $this->Airline_trans_model->get_last_item($ap->id)->result();
//       
//       $data['accounting'] = $this->properti['accounting'];
//       $data['manager'] = $this->properti['manager'];
//
////       if ($ap->approved != 1){ $this->load->view('rejected', $data); }
////       else { $this->load->view('airline_invoice', $data); }
//       $this->load->view('airline_invoice', $data);

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
        
        $this->load->view('airline_report_panel', $data);
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

        if ($type == 0){ $data['aps'] = $this->Airline_model->report($acc,$cur,$start,$end)->result(); $page = 'airline_report'; }
        elseif ($type == 1){ $data['aps'] = $this->Airline_model->report($acc,$cur,$start,$end)->result(); $page = 'airline_report_details'; }
        elseif ($type == 2) { $data['aps'] = $this->Airline_model->report_category($acc,$cur,$start,$end)->result(); $page = 'airline_report_category'; }
        elseif ($type == 3) { $data['aps'] = $this->Airline_model->report_category($acc,$cur,$start,$end)->result(); $page = 'airline_pivot'; }
        
        $this->load->view($page, $data);
        
    }


}

?>