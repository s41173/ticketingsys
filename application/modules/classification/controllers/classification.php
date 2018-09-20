<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Classification extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Classification_model', 'model', TRUE);

        $this->properti = $this->property->get();
        $this->acl->otentikasi();

        $this->modul = $this->components->get(strtolower(get_class($this)));
        $this->title = strtolower(get_class($this));
        $this->account = new Account_lib();
    }

    private $properti, $modul, $title, $classification, $wt, $branch, $conversi;
    private $role, $account;

    function index()
    {
        $this->get_last();
    }
    
    public function getdatatable($search=null,$branch='null',$cat='null',$col='null',$size='null',$publish='null')
    {
        if(!$search){ $result = $this->model->get_last($this->modul['limit'])->result(); }
        else {$result = $this->model->search($branch,$cat,$col,$size,$publish)->result(); }
	
        $output = null;
        if ($result){
                
         foreach($result as $res)
	 {   
	   $output[] = array ($res->id, $res->no, $res->name, $res->type, $res->status);
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
       $val = $this->model->get_by_id($uid)->row();
       if ($val->status == 0){ $lng = array('status' => 1); }else { $lng = array('status' => 0); }
       $this->model->update($uid,$lng);
       echo 'true|Status Changed...!';
       }else{ echo "error|Sorry, you do not have the right to change publish status..!"; }
    }

    function get_last()
    {
        $this->acl->otentikasi1($this->title);

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords('Product Manager');
        $data['h2title'] = 'Product Manager';
        $data['main_view'] = 'classification_view';
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_update'] = site_url($this->title.'/update_process');
        $data['form_action_del'] = site_url($this->title.'/delete_all');
        $data['form_action_report'] = site_url($this->title.'/report_process');
        $data['form_action_import'] = site_url($this->title.'/import');
        $data['link'] = array('link_back' => anchor('main/','Back', array('class' => 'btn btn-danger')));

//        $data['category'] = $this->category->combo_all();
//        $data['manufacture'] = $this->manufacture->combo_all();
//        $data['color'] = $this->attribute->combo_color();
//        $data['size'] = $this->attribute->combo_size();
//        $data['currency'] = $this->currency->combo();
//        $data['branch'] = $this->branch->combo();
//        $data['array'] = array('','');
        
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
        $this->table->set_heading('#','No', 'Code', 'Name', 'Type', 'Action');

        $data['table'] = $this->table->generate();
        $data['source'] = site_url($this->title.'/getdatatable');
        $data['graph'] = site_url()."/classification/chart/";
            
        // Load absen view dengan melewatkan var $data sbgai parameter
	$this->load->view('template', $data);
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
           if ( $this->cek_relation($cek[$i]) == TRUE && $this->cek_status($cek[$i]) == TRUE ) 
           {
              $this->model->delete($cek[$i]); 
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
            if ( $this->cek_relation($uid) == TRUE && $this->cek_status($uid) == TRUE)
            {
              $this->model->delete($uid);
              echo "true|1 $this->title successfully removed..!";
            }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }
    
    private function cek_status($id)
    {
        $val = $this->model->get_by_id($id)->row();
        if ($val->status == 1){ return FALSE; } else { return TRUE; }
    }

    private function cek_relation($id)
    {
        return $this->account->cek_classi($id);
    }

    function add_process()
    {
        if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'category_view';
	$data['form_action'] = site_url($this->title.'/add_process');
	$data['link'] = array('link_back' => anchor('category/','<span>back</span>', array('class' => 'back')));

	// Form validation
        $this->form_validation->set_rules('tcode', 'Code', 'required|callback_valid_classification');
        $this->form_validation->set_rules('tname', 'Name', 'required|callback_valid_name');
        $this->form_validation->set_rules('ctype', 'Acc Type', 'required');

        if ($this->form_validation->run($this) == TRUE)
        {   
            $value = array('name' => strtoupper($this->input->post('tname')), 'no' => $this->input->post('tcode'),
                                  'type' => $this->input->post('ctype'), 'created' => date('Y-m-d H:i:s'));
            
            $this->model->add($value);
            $this->session->set_flashdata('message', "One $this->title data successfully saved!");
//            redirect($this->title);
            echo 'true|'.$this->title.' successfully saved..!';
        }
        else{ echo "error|".validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }

    }

    function update($uid)
    {   
        $val = $this->model->get_by_id($uid)->row();
	$this->session->set_userdata('langid', $val->id);
        echo $val->id.'|'.$val->no.'|'.$val->name.'|'.$val->type.'|'.$val->status;
    }

    public function valid_classification($val)
    {   
        if ($this->model->valid('no',$val) == FALSE)
        {
            $this->form_validation->set_message('valid_classification'," $this->title no registered..!");
            return FALSE;
        }
        else{ return TRUE; }   
    }

    public function valid_name($val)
    {
        if ($this->model->valid('name',$val) == FALSE)
        {
            $this->form_validation->set_message('valid_classification'," $this->title name registered..!");
            return FALSE;
        }
        else{ return TRUE; }   
    }

    function validation_classification($val)
    {   
        $id = $this->session->userdata('langid');
	if ($this->model->validating('no',$val,$id) == FALSE)
        {
            $this->form_validation->set_message('validation_classification', "Classification registered!");
            return FALSE;
        }
        else{ return TRUE; }   
    }

    function validation_name($val)
    {
	$id = $this->session->userdata('langid');
	if ($this->model->validating('name',$val,$id) == FALSE)
        {
            $this->form_validation->set_message('validation_name', "Classification name registered!");
            return FALSE;
        }
        else{ return TRUE; }   
    }

    // Fungsi update untuk mengupdate db
    function update_process()
    {
        if ($this->acl->otentikasi_admin($this->title) == TRUE){
	$data['form_action'] = site_url($this->title.'/update_process');

	// Form validation

        $this->form_validation->set_rules('tcode', 'Code', 'required|callback_validation_classification');
        $this->form_validation->set_rules('tname', 'Name', 'required|callback_validation_name');
        $this->form_validation->set_rules('ctype', 'Acc Type', 'required');

        if ($this->form_validation->run($this) == TRUE)
        {
            $value = array('name' => strtoupper($this->input->post('tname')), 'no' => $this->input->post('tcode'),
                           'type' => $this->input->post('ctype'));
            
            $this->model->update($this->session->userdata('langid'), $value);
            echo 'true|Data successfully saved..!';
        }
        else{ echo 'error|'.validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }
    
    // ====================================== CLOSING ====================================== 
   function reset_process(){ $this->model->closing(); }

}

?>