<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Controls extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Controls_model', 'model', TRUE);
        
        $this->properti = $this->property->get();
        $this->acl->otentikasi();

        $this->modul = $this->components->get(strtolower(get_class($this)));
        $this->title = strtolower(get_class($this));

        $this->currency = new Currency_lib();
        $this->classification = new Classification_lib();
        $this->account = new Account_lib();
        $this->component = new Components();
    }

    private $properti, $modul, $title, $account, $component;
    private $currency,$classification;

    function index()
    {
      $this->get_last();
    }
    
    public function getdatatable($search=null,$class='null',$publish='null')
    {
        if(!$search){ $result = $this->model->get_last($this->modul['limit'])->result(); }
        else {$result = $this->model->search($class,$publish)->result(); }
        
        if ($result){
	foreach($result as $res)
	{  
	   $output[] = array ($res->id, $res->no, $res->desc, $this->account->get_code($res->account_id).' : '.$this->account->get_name($res->account_id), ucfirst($this->component->get_name($res->modul)), $res->status);
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
        $data['main_view'] = 'control_view';
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_update'] = site_url($this->title.'/update_process');
        $data['form_action_del'] = site_url($this->title.'/delete_all');
        $data['link'] = array('link_back' => anchor('main/','Back', array('class' => 'btn btn-danger')));
	// ---------------------------------------- //
       
        $data['currency'] = $this->currency->combo();
        $data['modul'] = $this->component->combo_id_all();
        
        $config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = "<li><span><b>";
        $config['cur_tag_close'] = "</b></span></li>";

        // library HTML table untuk membuat template table class zebra
        $tmpl = array('table_open' => '<table id="datatable-buttons" class="table table-striped table-bordered">');

        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");

        //Set heading untuk table
        $this->table->set_heading('#','No', 'Desc', 'Account', 'Modul', 'Action');

        $data['table'] = $this->table->generate();
        $data['source'] = site_url($this->title.'/getdatatable');
            
        // Load absen view dengan melewatkan var $data sbgai parameter
	$this->load->view('template', $data);
    }
    
    function add_process()
    {
        if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){

	// Form validation
        $this->form_validation->set_rules('tdesc', 'Name', 'required|callback_valid_control');
        $this->form_validation->set_rules('titem', 'Account Code', 'required');
        $this->form_validation->set_rules('cmodul', 'Component', 'required');

        if ($this->form_validation->run($this) == TRUE)
        {
            $account = array('no' => $this->model->counter(), 'desc' => $this->input->post('tdesc'),
                             'account_id' => $this->account->get_id_code($this->input->post('titem')), 
                             'modul' => $this->input->post('cmodul'), 'status' => 0,
                             'created' => date('Y-m-d H:i:s'));
            
            $this->model->add($account);
            echo 'true|'.$this->title.' successfully saved..!';
        }
        else{ echo "error|".validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }

    }

    function update($uid)
    {
        $this->acl->otentikasi2($this->title);
        
        $control = $this->model->get_by_id($uid)->row();

	$this->session->set_userdata('langid', $control->id);
        echo $control->id.'|'.$control->desc.'|'.$this->account->get_code($control->account_id).'|'.$control->modul;
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
        $this->form_validation->set_rules('titem', 'Account', 'required');

        if ($this->form_validation->run($this) == TRUE)
        {   
            $account = array('account_id' => $this->account->get_id_code($this->input->post('titem')), 
                             'modul' => $this->input->post('cmodul'));

            $this->model->update($this->session->userdata('langid'), $account);
            echo 'true|Data successfully saved..!';
        }
        else{ echo 'error|'.validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }
    
    function delete($uid)
    {
        if ($this->acl->otentikasi_admin($this->title,'ajax') == TRUE){

            if ($this->cek_status($uid) == TRUE)
            {
               $this->model->force_delete($uid);
               echo "true|1 $this->title successfully soft removed..!";
            }
            else { echo 'warning|Default control account can not removed..!';  }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
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
           if ( $this->cek_status($cek[$i]) == TRUE ) 
           {
              $this->model->force_delete($cek[$i]); 
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
    
    private function cek_status($id)
    {
        $res = $this->model->get_by_id($id)->row();
        if ($res->status == 0){ return TRUE; } else { return FALSE; }
    }


    public function valid_control($name)
    {        
        if ($this->model->valid('desc',$name) == FALSE)
        {
            $this->form_validation->set_message('valid_control', "This $this->title is already registered.!");
            return FALSE;
        }
        else{ return TRUE; }   
    }

    public function validation_control($acc)
    {   
        $id = $this->session->userdata('langid');
	if ($this->model->validating('account_id',$this->account->get_id_code($acc),$id) == FALSE)
        {
            $this->form_validation->set_message('validation_control', 'This '.$this->title.' is already registered!');
            return FALSE;
        }
        else { return TRUE; }  
    }
    
   // ====================================== CLOSING ====================================== 
   function reset_process(){ $this->model->closing(); }

}

?>