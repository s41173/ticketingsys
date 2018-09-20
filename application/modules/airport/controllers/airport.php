<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Airport extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Airport_model', 'model', TRUE);

        $this->properti = $this->property->get();
        $this->acl->otentikasi();

        $this->modul = $this->components->get(strtolower(get_class($this)));
        $this->title = strtolower(get_class($this));
        $this->role = new Role_lib();
    }

    private $properti, $modul, $title;
    private $city,$role;

    function index()
    {
       $this->get_last(); 
    }
     
    public function getdatatable($search=null,$country='null')
    {
        if(!$search){ $result = $this->model->get_last('id',$this->modul['limit'])->result(); }else{
            $result = $this->model->search($country)->result(); 
        }
	
        $output = null;
        if ($result){
                
         foreach($result as $res)
	 {
	   $output[] = array ($res->id, $res->code, $res->name, $res->location, strtoupper($res->country_id), $res->country_name,
                              $res->created, $res->updated, $res->deleted );
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

        $data['title'] = $this->properti['name'].' | Airportistrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'airport_view';
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_update'] = site_url($this->title.'/update_process');
        $data['form_action_del'] = site_url($this->title.'/delete_all');
        $data['link'] = array('link_back' => anchor('main/','Back', array('class' => 'btn btn-danger')));

        $data['roles'] = $this->role->combo();
        $data['country'] = $this->model->combo_country();
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
        $this->table->set_heading('#','No', 'Code', 'Name', 'Location', 'Country', 'Action');

        $data['table'] = $this->table->generate();
        $data['source'] = site_url($this->title.'/getdatatable');
            
        // Load absen view dengan melewatkan var $data sbgai parameter
	$this->load->view('template', $data);
    }

    function delete($uid)
    {
        if ($this->acl->otentikasi_admin($this->title,'ajax') == TRUE){
            $this->model->delete($uid);
            $this->session->set_flashdata('message', "1 $this->title successfully removed..!");

            echo "true|1 $this->title successfully removed..!";
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }

    // Fungsi update untuk menset texfield dengan nilai dari database
    function update($uid=null)
    {        
        $airport = $this->model->get_by_id($uid)->row();
               
	$this->session->set_userdata('langid', $airport->id);
        
        echo $uid.'|'.$airport->username.'|'.$airport->name.'|'.$airport->address.'|'.$airport->phone1.
             '|'.$airport->city.'|'.$airport->email.'|'.$airport->role.'|'.$airport->status.'|'.$airport->branch_id;
    }

    function validation_username($name)
    {
	$id = $this->session->userdata('langid');
	if ($this->model->validating('username',$name,$id) == FALSE)
        {
            $this->form_validation->set_message('validation_username', 'This user is already registered!');
            return FALSE;
        }
        else{ return TRUE; }
    }

    // Fungsi update untuk mengupdate db
    function update_process()
    {
        if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){

        $data['title'] = $this->properti['name'].' | Airportistrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'airport_update';
	$data['form_action'] = site_url($this->title.'/update_process');
	$data['link'] = array('link_back' => anchor('airport/','<span>back</span>', array('class' => 'back')));

	// Form validation
        $this->form_validation->set_rules('tusername', 'UserName', 'required|callback_validation_username');
	$this->form_validation->set_rules('tpassword', 'Password', '');
        $this->form_validation->set_rules('tname', 'Name', 'required');
        $this->form_validation->set_rules('taddress', 'Address', 'required');
        $this->form_validation->set_rules('tphone', 'Phone', 'required|numeric');
        $this->form_validation->set_rules('ccity', 'City', 'required');
        $this->form_validation->set_rules('tmail', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('crole', 'Role', 'required');
        $this->form_validation->set_rules('rstatus', 'Status', 'required');

        if ($this->form_validation->run($this) == TRUE)
        {
            if ($this->input->post('tpassword')){
            
              $users = array('username' => $this->input->post('tusername'),'password' => $this->input->post('tpassword'),'name' => $this->input->post('tname'),
                           'address' => $this->input->post('taddress'), 'phone1' => $this->input->post('tphone'), 'city' => $this->input->post('ccity'),
                           'email' => $this->input->post('tmail'), 'yahooid' => setnull($this->input->post('tid')), 'role' => $this->input->post('crole'), 
                           'branch_id' => $this->input->post('cbranch'), 'status' => $this->input->post('rstatus'));     
            }
            else {
              $users = array('username' => $this->input->post('tusername'),'name' => $this->input->post('tname'),
                           'address' => $this->input->post('taddress'), 'phone1' => $this->input->post('tphone'), 'city' => $this->input->post('ccity'),
                           'email' => $this->input->post('tmail'), 'yahooid' => setnull($this->input->post('tid')), 'role' => $this->input->post('crole'), 
                           'branch_id' => $this->input->post('cbranch'), 'status' => $this->input->post('rstatus'));
            }

	    $this->model->update($this->session->userdata('langid'), $users);
            $this->session->set_flashdata('message', "One $this->title has successfully updated!");
          //  $this->session->unset_userdata('langid');
            echo "true|One $this->title has successfully updated..!";

        }
        else{ echo 'warning|'.validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }

}

?>