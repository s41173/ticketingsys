<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Balance extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Balance_model', 'model', TRUE);
        $this->load->model('Account_model', 'am', TRUE);
        
        $this->properti = $this->property->get();
        $this->acl->otentikasi();

        $this->modul = $this->components->get(strtolower(get_class($this)));
        $this->title = strtolower(get_class($this));

        $this->account = new Account_lib();
        $this->balancelib = new Balance_account_lib();
        $this->period = new Period_lib();
        $this->journal = new Journalgl_lib();
    }

    private $properti, $modul, $title, $model, $account,$balancelib, $period, $journal;


    function index()
    {
      $this->get_last_balance();
    }
    
    private function fill_balance()
    {
       $ps = new Period();
       $bl = new Balances();
       $ps->get(); 
       
       if ($bl->where('month', $ps->start_month)->where('year', $ps->start_year)->count() == 0)
       {
          $accounts = $this->account->get();
          foreach ($accounts as $account){ $this->balancelib->fill($account->id, $ps->month, $ps->year, 0, 0); } 
       }
       
       $bl->where('account_id IS NULL')->delete();
    }
    
    public function getdatatable($search=null)
    {
        if(!$search){ $result = $this->am->get_begin_saldo_account()->result(); }
        
        if ($result){
	foreach($result as $res)
	{  
	   $output[] = array ($res->id, $res->currency, $res->code, $res->name, number_format($this->get_balance($res->id)));
	}
            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($output))
            ->_display();
            exit; 
        }
    }   
    
    function get_last_balance()
    {
        $this->acl->otentikasi1($this->title);

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'balance_view';
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_update'] = site_url($this->title.'/update_process');
        $data['form_action_del'] = site_url($this->title.'/delete_all');
        $data['link'] = array('link_back' => anchor('main/','Back', array('class' => 'btn btn-danger')));
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
        $this->table->set_heading('#', 'No', 'Cur', 'Code', 'Name', 'Beginning Balance', 'Action');

        $data['table'] = $this->table->generate();
        $data['source'] = site_url($this->title.'/getdatatable');
            
        // Load absen view dengan melewatkan var $data sbgai parameter
	$this->load->view('template', $data);
    }
    
    private function get_balance($acc=null)
    {
        $ps = $this->period->get();
        $bl = new Balances();
        
        $bl->where('account_id', $acc);
        $bl->where('month', $ps->start_month);
        $bl->where('year', $ps->start_year)->get(); 
        return floatval($bl->beginning);
    }

    function update($uid)
    {
        $this->acl->otentikasi2($this->title);
        $acc = $this->model->get_by_id($uid)->row();
        $this->session->set_userdata('langid', $acc->id);
        $this->session->set_userdata('acid', $acc->account_id);
        echo $uid.'|'.$this->account->get_code($acc->account_id).'|'.$this->account->get_name($acc->account_id).'|'.$this->get_balance($acc->account_id);
    }

    // Fungsi update untuk mengupdate db
    function update_process()
    {
        if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){
               
	// Form validation
        $this->form_validation->set_rules('tbalance', 'Balance', 'required|numeric|callback_valid_setting['.$this->session->userdata('acid').']');

        if ($this->form_validation->run($this) == TRUE)
        {                    
            $ps = $this->period->get();
            $bl = new Balances();

            $bl->where('account_id', $this->session->userdata('acid'));
            $bl->where('month', $ps->month);
            $bl->where('year', $ps->year)->get();
                        
            $bl->beginning = $this->input->post('tbalance');
            $bl->vamount = $this->journal->calculate_account_amount($this->session->userdata('acid'), $this->input->post('tbalance'));
            $bl->end = $this->input->post('tbalance');
            $bl->save();
            $this->update_historical();

            echo 'true|Data successfully saved..!';
        }
        else{ echo 'error|'.validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }
    
    private function update_historical()
    {
        $bl = new Balances();
        $ps = $this->period->get();
        $val = 0;
        
        $bl->select_sum('vamount');
        $bl->where('month', $ps->month);
        $bl->where('year', $ps->year)->get();
        $val = $bl->vamount;
        $bl->clear();        
        
        $bls = new Balances();
        $bls->where('account_id', 23);
        $bls->where('month', $ps->month);
        $bls->where('year', $ps->year)->get();
        
        $bls->beginning = $val;
        $bls->vamount = 0;
        $bls->save();
    }
    
    // fungsi validasi berlaku jika period sesuai dengan tanggal start
    public function valid_setting($val,$acid)
    {
        $ps = $this->period->get();
        
        if ($acid == 23)
        {
           $this->form_validation->set_message('valid_setting', "Balance can't change..!");
           return FALSE; 
        }
        elseif ( $ps->month != $ps->start_month || $ps->year != $ps->start_year )
        {
           $this->form_validation->set_message('valid_setting', "Period is not appropriate..!");
           return FALSE; 
        }
        else { return TRUE; }
        
    }

    private function previous_month()
    {
        $ps = $this->period->get();
        
        $prevmonth = 0;
        $prevyear = 0;
        
        if ($ps->start_month == 1){ $prevmonth = 12; $prevyear = intval($ps->start_year-1); }
        else { $prevmonth = intval($ps->start_month-1); $prevyear = $ps->start_year; }
        
        $totalday = get_total_days($prevmonth);
        
        return $totalday.'-'.$prevmonth.'-'.$prevyear;
    }


// ====================================== REPORT =========================================
    // ====================================== CLOSING ====================================== 
   function reset_process(){ $this->model->closing(); }
    
    
}

?>