<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vendor extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Vendor_model', '', TRUE);

        $this->properti = $this->property->get();
        $this->acl->otentikasi();

        $this->modul = $this->components->get(strtolower(get_class($this)));
        $this->title = strtolower(get_class($this));
        $this->role = new Role_lib();
        $this->city = new City_lib();
        $this->disctrict = new District_lib();
    }

    private $properti, $modul, $title, $customer, $city, $disctrict;
    private $role;

    function index()
    {
       $this->get_last(); 
    }
     
    public function getdatatable($search=null,$cat='null',$publish='null')
    {
        if(!$search){ $result = $this->Vendor_model->get_last($this->modul['limit'])->result(); }
        else {$result = $this->Vendor_model->search($cat,$publish)->result(); }
	
        $output = null;
        if ($result){
                
         foreach($result as $res)
	 {   
	   $output[] = array ($res->id, $res->prefix.' '.$res->name, $res->type, $res->address, $res->shipping_address, 
                              $res->phone1, $res->phone2, $res->fax, $res->email, $res->website, $res->city,
                              $res->zip, $res->notes, $res->status
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

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords('Customer Manager');
        $data['h2title'] = 'Supplier Manager';
        $data['main_view'] = 'vendor_view';
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_update'] = site_url($this->title.'/update_process');
        $data['form_action_del'] = site_url($this->title.'/delete_all');
        $data['form_action_report'] = site_url($this->title.'/report_process');
        $data['link'] = array('link_back' => anchor('main/','Back', array('class' => 'btn btn-danger')));

        $data['city'] = $this->city->combo_city_db();
        $data['array'] = array('','');
        
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
        $this->table->set_heading('#','No', 'Type', 'Name', 'Phone', 'Email', 'City', 'Action');

        $data['table'] = $this->table->generate();
        $data['source'] = site_url($this->title.'/getdatatable');
            
        // Load absen view dengan melewatkan var $data sbgai parameter
	$this->load->view('template', $data);
    }
    
    function publish($uid = null)
    {
       if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){ 
       $val = $this->Vendor_model->get_by_id($uid)->row();
       if ($val->status == 0){ $lng = array('status' => 1); }else { $lng = array('status' => 0); }
       $this->Vendor_model->update($uid,$lng);
       echo 'true|Status Changed...!';
       }else{ echo "error|Sorry, you do not have the right to change publish status..!"; }
    }
    
    function delete_all($type='soft')
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
             if ($type == 'soft') { $this->Vendor_model->delete($cek[$i]); }
             else { $this->remove_img($cek[$i],'force');
                    $this->attribute_customer->force_delete_by_customer($cek[$i]);
                    $this->Vendor_model->force_delete($cek[$i]);  }
             $x=$x+1;
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
      }else{ echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
      
    }

    function delete($uid)
    {
        if ($this->acl->otentikasi_admin($this->title,'ajax') == TRUE){
            $this->Vendor_model->delete($uid);
            
            $this->session->set_flashdata('message', "1 $this->title successfully removed..!");

            echo "true|1 $this->title successfully removed..!";
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
        
    }
    
    function add()
    {

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = 'Create New '.$this->modul['title'];
        $data['main_view'] = 'article_form';
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['link'] = array('link_back' => anchor($this->title,'Back', array('class' => 'btn btn-danger')));

        $data['language'] = $this->language->combo();
        $data['category'] = $this->category->combo();
        $data['currency'] = $this->currency->combo();
        $data['source'] = site_url($this->title.'/getdatatable');
        
        $this->load->helper('editor');
        editor();

        $this->load->view('template', $data);
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
        $this->form_validation->set_rules('tname', 'SKU', 'required|callback_valid_vendor');
        $this->form_validation->set_rules('tcp', 'Name', 'required');
        $this->form_validation->set_rules('ctype', 'Vendor Type', 'required');
        $this->form_validation->set_rules('tphone', 'Phone 1', 'required');
        $this->form_validation->set_rules('tmobile', 'Mobile', 'required');
        $this->form_validation->set_rules('temail', 'Email', 'required|valid_email|callback_valid_email');
        $this->form_validation->set_rules('tnpwp', 'Npwp', '');
        $this->form_validation->set_rules('tfax', 'Fax', '');
        $this->form_validation->set_rules('taddress', 'Address', 'required');
        $this->form_validation->set_rules('ccity', 'City', 'required');
        $this->form_validation->set_rules('tzip', 'Zip', '');
        $this->form_validation->set_rules('twebsite', 'Website', '');
        $this->form_validation->set_rules('taccname', 'Account Name', '');
        $this->form_validation->set_rules('taccno', 'Account No', '');
        $this->form_validation->set_rules('tbank', 'Bank', '');   
        

        if ($this->form_validation->run($this) == TRUE)
        {
            $customer = array('name' => strtoupper($this->input->post('tname')), 'type' => $this->input->post('ctype'),
                  'cp1' => strtoupper($this->input->post('tcp')), 'npwp' => $this->input->post('tnpwp'),
                  'address' => $this->input->post('taddress'), 'shipping_address' => $this->input->post('taddress'), 'phone1' => $this->input->post('tphone'), 
                  'fax' => $this->input->post('tfax'), 'hp' => $this->input->post('tmobile'), 'email' => $this->input->post('temail'),
                  'website' => $this->input->post('twebsite'), 'city' => $this->input->post('ccity'), 'zip' => $this->input->post('tzip'),
                  'acc_name' => $this->input->post('taccname'), 'acc_no' => $this->input->post('taccno'),
                  'bank' => $this->input->post('tbank'), 'created' => date('Y-m-d H:i:s'));

            $this->Vendor_model->add($customer);
            $this->session->set_flashdata('message', "One $this->title data successfully saved!");
            
            echo 'true|'.$this->title.' successfully saved..!';
        }
        else{ echo "error|".validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }

    }
    
    private function cek_tick($val)
    {
        if (!$val)
        { return 0;} else { return 1; }
    }
    
    private function split_array($val)
    { return implode(",",$val); }
   

    // Fungsi update untuk menset texfield dengan nilai dari database
    function update($uid=null)
    {        
        $vendor = $this->Vendor_model->get_by_id($uid)->row();
	$this->session->set_userdata('langid', $vendor->id);
        
        echo $vendor->id.'|'.$vendor->prefix.'|'.$vendor->name.'|'.$vendor->type.'|'.$vendor->cp1.'|'.$vendor->npwp.'|'.
             $vendor->address.'|'.$vendor->shipping_address.'|'.$vendor->phone1.'|'.$vendor->fax.'|'.$vendor->hp.'|'.$vendor->email.'|'.
             $vendor->website.'|'.$vendor->city.'|'.$vendor->zip.'|'.$vendor->acc_name.'|'.$vendor->acc_no.'|'.$vendor->bank;
    }
   
    public function valid_vendor($name)
    {
        if ($this->Vendor_model->valid('name',$name) == FALSE)
        {
            $this->form_validation->set_message('valid_vendor', "This $this->title is already registered.!");
            return FALSE;
        }
        else{ return TRUE; }
    }
    
    function valid_email($val)
    {
        if ($this->Vendor_model->valid('email',$val) == FALSE)
        {
            $this->form_validation->set_message('valid_email','Email registered..!');
            return FALSE;
        }
        else{ return TRUE; }
    }

    function validating_email($val)
    {
	$id = $this->session->userdata('langid');
	if ($this->Vendor_model->validating('email',$val,$id) == FALSE)
        {
            $this->form_validation->set_message('validating_email', "Email registered!");
            return FALSE;
        }
        else{ return TRUE; }
    }
    
    // Fungsi update untuk mengupdate db
    function update_process($param=0)
    {
        if ($this->acl->otentikasi_admin($this->title) == TRUE){

        $data['title'] = $this->properti['name'].' | Customeristrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'customer_update';
	$data['form_action'] = site_url($this->title.'/update_process');
	$data['link'] = array('link_back' => anchor('admin/','<span>back</span>', array('class' => 'back')));

	// Form validation
        $this->form_validation->set_rules('tname', 'SKU', 'required');
        $this->form_validation->set_rules('tcp', 'Name', 'required');
        $this->form_validation->set_rules('ctype', 'Vendor Type', 'required');
        $this->form_validation->set_rules('tphone', 'Phone 1', 'required');
        $this->form_validation->set_rules('tmobile', 'Mobile', 'required');
        $this->form_validation->set_rules('temail', 'Email', 'required|valid_email|callback_validating_email');
        $this->form_validation->set_rules('tnpwp', 'Npwp', '');
        $this->form_validation->set_rules('tfax', 'Fax', '');
        $this->form_validation->set_rules('taddress', 'Address', 'required');
        $this->form_validation->set_rules('ccity', 'City', 'required');
        $this->form_validation->set_rules('tzip', 'Zip', '');
        $this->form_validation->set_rules('twebsite', 'Website', '');
        $this->form_validation->set_rules('taccname', 'Account Name', '');
        $this->form_validation->set_rules('taccno', 'Account No', '');
        $this->form_validation->set_rules('tbank', 'Bank', '');  
            
        if ($this->form_validation->run($this) == TRUE)
        {
            $customer = array('type' => $this->input->post('ctype'),
                  'cp1' => strtoupper($this->input->post('tcp')), 'npwp' => $this->input->post('tnpwp'),
                  'address' => $this->input->post('taddress'), 'shipping_address' => $this->input->post('taddress'), 'phone1' => $this->input->post('tphone'), 
                  'fax' => $this->input->post('tfax'), 'hp' => $this->input->post('tmobile'), 'email' => $this->input->post('temail'),
                  'website' => $this->input->post('twebsite'), 'city' => $this->input->post('ccity'), 'zip' => $this->input->post('tzip'),
                  'acc_name' => $this->input->post('taccname'), 'acc_no' => $this->input->post('taccno'),
                  'bank' => $this->input->post('tbank'));

            $this->Vendor_model->update($this->session->userdata('langid'), $customer);
            echo "true|One $this->title has successfully updated!";
        }
        else{ echo 'error|'.validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }
    
    function ajaxcombo_district()
    {
        $cityid = $this->input->post('value');
        if ($cityid != null){
            $district = $this->disctrict->combo_district_db($cityid);
            $js = "class='select2_single form-control' id='cdistrict' tabindex='-1' style='width:100%;' "; 
            echo form_dropdown('cdistrict', $district, isset($default['district']) ? $default['district'] : '', $js);
        }
    }
    
    // ====================================== CLOSING ======================================
   function reset_process(){ $this->Vendor_model->closing(); }
   

}

?>