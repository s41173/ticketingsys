<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Account_model', 'Model', TRUE);
        
        $this->properti = $this->property->get();
        $this->acl->otentikasi();

        $this->modul = $this->components->get(strtolower(get_class($this)));
        $this->title = strtolower(get_class($this));

        $this->currency = new Currency_lib();
        $this->classification = new Classification_lib();
        $this->city = new City_lib;
        $this->account = new Account_lib();
        $this->balance = new Balance_account_lib();
        $this->period = new Period_lib();
        $this->journal = new Journalgl_lib();
    }

    private $properti, $modul, $title, $model, $account, $balance;
    private $currency, $classification, $city, $period, $journal;

    private  $atts = array('width'=> '400','height'=> '200',
                      'scrollbars' => 'yes','status'=> 'yes',
                      'resizable'=> 'yes','screenx'=> '0','screenx' => '\'+((parseInt(screen.width) - 400)/2)+\'',
                      'screeny'=> '0','class'=> 'print','title'=> 'print', 'screeny' => '\'+((parseInt(screen.height) - 200)/2)+\'');

    function index()
    {
      $this->get_last();
    }
        
    public function getdatatable($search=null,$class='null',$publish='null')
    {
        if(!$search){ $result = $this->Model->get_last($this->modul['limit'])->result(); }
        else {$result = $this->Model->search($class,$publish)->result(); }
        
        if ($result){
	foreach($result as $res)
	{  
	   $output[] = array ($res->id, $this->classification->get_name($res->classification_id), $this->classification->get_type($res->classification_id), $res->currency, $res->code, $res->name, $res->alias, $res->acc_no,
                              $res->bank, $res->status, $res->default, $res->bank_stts);
	}
            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($output))
            ->_display();
            exit; 
        }
    }    
    
    function publish($uid = null)
    {
       if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){ 
       $val = $this->Model->get_by_id($uid)->row();
       if ($val->status == 0){ $lng = array('status' => 1); }else { $lng = array('status' => 0); }
       $this->Model->update($uid,$lng);
       echo 'true|Status Changed...!';
       }else{ echo "error|Sorry, you do not have the right to change publish status..!"; }
    }
        
    function get_last()
    {
        $this->acl->otentikasi1($this->title);

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'account_view';
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_update'] = site_url($this->title.'/update_process');
        $data['form_action_del'] = site_url($this->title.'/delete_all');
        $data['link'] = array('link_back' => anchor('main/','Back', array('class' => 'btn btn-danger')));
	// ---------------------------------------- //
        
        $data['classi'] = $this->classification->combo();
        $data['currency'] = $this->currency->combo();
        
        $config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = "<li><span><b>";
        $config['cur_tag_close'] = "</b></span></li>";

        // library HTML table untuk membuat template table class zebra
        $tmpl = array('table_open' => '<table id="datatable-buttons" class="table table-striped table-bordered">');

        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");

        //Set heading untuk table
        $this->table->set_heading('#','No', 'Cur', 'Code', 'Name', 'Sub Class', 'Classification', 'Action');

        $data['table'] = $this->table->generate();
        $data['source'] = site_url($this->title.'/getdatatable');
            
        // Load absen view dengan melewatkan var $data sbgai parameter
	$this->load->view('template', $data);
    }

    private function get_search($code=null,$name=null,$class=null)
    {
        if ($code){ $this->model->where('code', $code); }
        elseif ($name){ $this->model->where('name', $name); }
        elseif ($class) { $this->model->where('classification_id', $class); }
        return $this->model->get();
    }
    
    private function get_balance($acc=null)
    {
        $ps = new Period();
        $gl = new Gl();
        $ps->get();
        
        $gl->where('approved', 1);
        $gl->where('MONTH(dates)', $ps->month);
        $gl->where('YEAR(dates)', $ps->year)->get();
        
        $this->load->model('Account_model','am',TRUE);
        $val = $this->am->get_balance($acc,$ps->month,$ps->year)->row_array();
        return $val['vamount'];
    }

    private function get_cost($acc=null,$month=0)
    {
        $ps = new Period();
        $bl = new Balance();
        $ps->get();
        
        $bl->where('account_id', $acc);
        $bl->where('month', $month);
        $num = $bl->where('year', $ps->year)->count();

        $val = null;
        if ( $num > 0)
        {
           $bl->where('account_id', $acc);
           $bl->where('month', $month);
           $bl->where('year', $ps->year)->get(); 
            
           $val[0] = get_month($month);
           $val[1] = $ps->year;
           $val[2] = $bl->beginning + $this->get_balance($acc);
        }
        else
        {
           $val[0] = get_month($month);
           $val[1] = $ps->year;
           $val[2] = 0; 
        }

        return $val;
    }

    function cost($acc = null)
    {
        $this->acl->otentikasi1($this->title);

        $data['title'] = $this->properti['name'].' | Administrator Account Balance '.ucwords($this->modul['title']);
        $data['h2title'] = 'Account Balance '.$this->modul['title'];
        $data['main_view'] = 'account_balance';
        $data['link'] = array('link_back' => anchor($this->title,'<span>back</span>', array('class' => 'back')));

        $data['accname'] = $this->account->get_name($acc);
        $data['acccur'] = $this->account->get_cur($acc);

        $tmpl = array('table_open' => '<table cellpadding="2" cellspacing="1" class="tablemaster">');

        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");

        //Set heading untuk table
        $this->table->set_heading('Month', 'Year', 'Budget');
        
        $account = null;
        for ($x=1; $x<=12; $x++)
        {
           $account[$x] = $this->get_cost($acc,$x);
           $this->table->add_row
           (
               $account[$x][0], $account[$x][1], number_format($account[$x][2])
           );
        }

        $data['table'] = $this->table->generate();
        $this->load->view('account_balance', $data);
    }

    function get_list($target='titem')
    {
        $this->acl->otentikasi1($this->title);

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['form_action'] = site_url($this->title.'/get_list');
        $data['main_view'] = 'vendor_list';
        $data['currency'] = $this->currency->combo();
        $data['link'] = array('link_back' => anchor($this->title.'/get_list','<span>back</span>', array('class' => 'back')));
        $data['classi'] = $this->classification->combo();
        
        $class = $this->input->post('cclassification');

        $accounts = $this->Model->get_list($class)->result();

        $tmpl = array('table_open' => '<table id="myTable" class="acctable table table-hover">');

        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");

        //Set heading untuk table
        $this->table->set_heading('No', 'Code', 'Name', 'Cur', 'Action');

        $i = 0;
        foreach ($accounts as $account)
        {
           $datax = array(
                            'name' => 'button',
                            'type' => 'button',
                            'class' => 'btn btn-success',
                            'content' => 'Select',
                            'onclick' => 'setvalue(\''.$account->code.'\',\''.$target.'\')'
                         );

            $this->table->add_row
            (
                ++$i, $account->code, $account->name, $account->currency,
                form_button($datax)
            );
        }

        $data['table'] = $this->table->generate();
        $this->load->view('account_list', $data);
    }
    
    function delete_all()
    {
      if ($this->acl->otentikasi_admin($this->title,'ajax') == TRUE){
      
      $cek = $this->input->post('cek');
      $jumlah = count($cek);

      if($cek)
      {
        $jumlah = count($cek);
        $x = 0;
        for ($i=0; $i<$jumlah; $i++)
        {
           if ( $this->journal->valid_account_transaction($cek[$i]) == TRUE && $this->valid_default($cek[$i]) == TRUE ) 
           {
              $this->Model->delete($cek[$i]); 
           }
           else { $x=$x+1; }
           
        }
        $res = intval($jumlah-$x);
        //$this->session->set_flashdata('message', "$res $this->title successfully removed &nbsp; - &nbsp; $x related to another component..!!");
        $mess = "$res $this->title successfully removed &nbsp; - &nbsp; $x related to another component..!!";
        echo 'true|'.$mess;
      }
      else
      { //$this->session->set_flashdata('message', "No $this->title Selected..!!"); 
        $mess = "No $this->title Selected..!!";
        echo 'false|'.$mess;
      }
      }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }

    function delete($uid)
    {
        if ($this->acl->otentikasi_admin($this->title,'ajax') == TRUE){
        
        if ( $this->journal->valid_account_transaction($uid) == TRUE && $this->valid_default($uid) == TRUE )
        {
            // hapus balance
            $this->balance->remove_balance($uid);
            $this->Model->delete($uid);
            echo "true|1 $this->title successfully soft removed..!";
        }
        else{ echo  "invalid|$this->title related to another component..!"; }
        
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }

    function add_process()
    {
        if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){

	// Form validation
        $this->form_validation->set_rules('tname', 'Name', 'required|callback_valid_name');
        $this->form_validation->set_rules('tno', 'No', 'required|numeric');
        $this->form_validation->set_rules('tcode', 'Code', 'required|numeric|callback_valid_code');
        $this->form_validation->set_rules('ccurrency', 'Currency', 'required');
        $this->form_validation->set_rules('cclassification', 'Classification', 'required');

        if ($this->form_validation->run($this) == TRUE)
        {            
            if ($this->input->post('cclassification') == 7 || $this->input->post('cclassification') == 8){ $bank = 1; }
            else { $bank  = $this->input->post('cbank'); }
            
            $account = array('classification_id' => $this->input->post('cclassification'), 'currency' => $this->input->post('ccurrency'),
                             'code' => $this->input->post('tcode').'-'.$this->input->post('tno'), 'name' => $this->input->post('tname'),
                             'alias' => $this->input->post('talias'), 'status' => $this->input->post('cactive'), 'bank_stts' => $bank,
                             'created' => date('Y-m-d H:i:s'));
            
            $this->Model->add($account);
            $this->create_balance($this->input->post('tno').'-'.$this->input->post('tcode'));

            echo 'true|'.$this->title.' successfully saved..!';
        }
        else{ echo "error|".validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }

    }
    
    private function create_balance($code=null)
    {
        $ps = $this->period->get();
        $accid = $this->account->get_id_code($code);
        $this->balance->create($accid, $ps->month, $ps->year, 0, 0);
    }

    function update($uid)
    {
        $acc = $this->Model->get_by_id($uid)->row();
        $this->session->set_userdata('langid', $acc->id);
        
        $code = explode('-', $acc->code);
        
        echo $acc->id.'|'.$acc->classification_id.'|'.$acc->currency.'|'.$code[0].'|'.$code[1].'|'.$acc->name.'|'.
             $acc->alias.'|'.$acc->status.'|'.$acc->bank_stts;
    }

    // Fungsi update untuk mengupdate db
    function update_process()
    {
        if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'account_update';
	$data['form_action'] = site_url($this->title.'/update_process');
	$data['link'] = array('link_back' => anchor('account/','<span>back</span>', array('class' => 'back')));
        
	// Form validation
        $this->form_validation->set_rules('tname', 'Name', 'required|callback_validation_name');
        $this->form_validation->set_rules('tno', 'No', 'required|numeric');
        $this->form_validation->set_rules('tcode', 'Code', 'required|numeric|callback_validation_code');
        $this->form_validation->set_rules('ccurrency', 'Currency', 'required');
        $this->form_validation->set_rules('cclassification', 'Classification', 'required');

        if ($this->form_validation->run($this) == TRUE)
        {
            if ($this->input->post('cclassification') == 7 || $this->input->post('cclassification') == 8){ $bank = 1; }
            else { $bank  = $this->input->post('cbank'); }
            
            $account = array('classification_id' => $this->input->post('cclassification'), 'currency' => $this->input->post('ccurrency'),
                             'code' => $this->input->post('tcode').'-'.$this->input->post('tno'), 'name' => $this->input->post('tname'),
                             'alias' => $this->input->post('talias'), 'status' => $this->input->post('cactive'), 'bank_stts' => $bank);
            
            $this->Model->update($this->session->userdata('langid'), $account);
            echo 'true|Data successfully saved..!';
        }
        else{ echo 'error|'.validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }

    public function valid_name($name)
    {        
        if ($this->Model->valid('name',$name) == FALSE)
        {
            $this->form_validation->set_message('valid_name', "This $this->title is already registered.!");
            return FALSE;
        }
        else{ return TRUE; }
        
    }
    
    public function valid_default($uid=null)
    {
        if ($this->Model->valid_default($uid) == FALSE)
        {
            $this->form_validation->set_message('valid_default', "Default Account - [Can't Changed]..!");
            return FALSE;
        }
        else{ return TRUE; }
    }

    public function validation_name($name)
    {   
        $id = $this->session->userdata('langid');
	if ($this->Model->validating('name',$name,$id) == FALSE)
        {
            $this->form_validation->set_message('validation_name', 'This '.$this->title.' is already registered!');
            return FALSE;
        }
        else { return TRUE; }
    }

    public function validation_code($no)
    {
        $code = $this->input->post('tno').'-'.$no;
        $id = $this->session->userdata('langid');
	if ($this->Model->validating('name',$code,$id) == FALSE)
        {
            $this->form_validation->set_message('validation_code', 'This '.$this->title.' code is already registered!');
            return FALSE;
        }
        else { return TRUE; }
    }

    public function valid_code($code)
    {   
        $code = $code.'-'.$this->input->post('tno');
        if ($this->Model->valid('code',$code) == FALSE)
        {
            $this->form_validation->set_message('valid_code', "Account No already registered.!");
            return FALSE;
        }
        else{ return TRUE; }
    }

// ====================================== REPORT =========================================


    function report()
    {
        $this->acl->otentikasi2($this->title);
        $data['title'] = $this->properti['name'].' | Report '.ucwords($this->modul['title']);

        $cur = $this->input->post('ccurrency');
        $status = $this->input->post('cstatus');

        $data['currency'] = 'null';
        $data['rundate'] = tgleng(date('Y-m-d'));
        $data['log'] = $this->session->userdata('log');

//        Property Details
        $data['company'] = $this->properti['name'];

        // assets
        $data['kas'] = $this->Model->report($cur,$status,7)->result();
        $data['bank'] = $this->Model->report($cur,$status,8)->result();
        $data['piutangusaha'] = $this->Model->report($cur,$status,20)->result();
        $data['piutangnonusaha'] = $this->Model->report($cur,$status,27)->result();
        $data['persediaan'] = $this->Model->report($cur,$status,14)->result();
        $data['biayadimuka'] = $this->Model->report($cur,$status,13)->result();
        $data['investasipanjang'] = $this->Model->report($cur,$status,29)->result();
        $data['hartatetapwujud'] = $this->Model->report($cur,$status,26)->result();
        $data['hartatetaptakwujud'] = $this->Model->report($cur,$status,30)->result();
        $data['hartalain'] = $this->Model->report($cur,$status,31)->result();
        
        // kewajiban
        $data['hutangusaha'] = $this->Model->report($cur,$status,10)->result();
        $data['pendapatandimuka'] = $this->Model->report($cur,$status,34)->result();
        $data['hutangjangkapanjang'] = $this->Model->report($cur,$status,35)->result();
        $data['hutangnonusaha'] = $this->Model->report($cur,$status,32)->result();
        $data['hutanglain'] = $this->Model->report($cur,$status,36)->result();
        
        // modal & laba
        $data['modal'] = $this->Model->report($cur,$status,22)->result();
        $data['laba'] = $this->Model->report($cur,$status,18)->result();
        
        // income
        $data['income'] = $this->Model->report($cur,$status,16)->result();
        $data['otherincome'] = $this->Model->report($cur,$status,37)->result();
        $data['outincome'] = $this->Model->report($cur,$status,21)->result();
        
        // biaya
        $data['biayausaha'] = $this->Model->report($cur,$status,15)->result();
        $data['biayausahalain'] = $this->Model->report($cur,$status,17)->result();
        $data['biayaoperasional'] = $this->Model->report($cur,$status,19)->result();
        $data['biayanonoperasional'] = $this->Model->report($cur,$status,24)->result();
        $data['pengeluaranluarusaha'] = $this->Model->report($cur,$status,25)->result();
        
        
        $this->load->view('account_report', $data); 
    }


// ====================================== REPORT =========================================
    
   function get_ajax_code(){ echo $this->classification->get_no($this->input->post('value')); }
   
// ====================================== CLOSING ======================================
   function reset_process(){ $this->Model->closing(); }

}

?>