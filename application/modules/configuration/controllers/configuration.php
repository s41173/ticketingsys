<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Configuration extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Configuration_model', '', TRUE);

        $this->properti = $this->property->get();
        $this->acl->otentikasi();

        $this->modul = $this->components->get(strtolower(get_class($this)));
        $this->title = strtolower(get_class($this));
        $this->role = new Role_lib();
        $this->city = new City_lib();
        $this->period = new Period_lib();
    }

    private $properti, $modul, $title;
    private $role,$city,$period;

    function index()
    {
       $this->get_last(); 
    }
     
    public function getdatatable($search=null)
    {
        if(!$search){ $result = $this->Configuration_model->get_last($this->modul['limit'])->row(); }
	
        $output = null;
        if ($result){
        $ps = $this->period->get();        
        $output[] = array ($result->id, $result->name, $result->address, $result->phone1, $result->phone2, $result->email,
                              $result->billing_email, $result->technical_email, $result->cc_email, $result->zip, $result->account_name,
                              $result->account_no, $result->bank, $result->city, $result->site_name, $result->meta_description,
                              $result->meta_keyword, $result->logo, $result->manager, $result->accounting, $ps->month, $ps->year, $ps->start_month, 
                              $ps->start_year, $ps->closing_month
                             );
         
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

        $data['title'] = $this->properti['name'].' | Configurationistrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'configuration_view';
        $data['form_action1'] = site_url($this->title.'/update_process/1');
        $data['form_action2'] = site_url($this->title.'/update_process/2');
        $data['form_action3'] = site_url($this->title.'/update_process/3');
        $data['form_action4'] = site_url($this->title.'/update_process/4');
        $data['form_action5'] = site_url($this->title.'/update_process/5');
        $data['link'] = array('link_back' => anchor('main/','Back', array('class' => 'btn btn-danger')));

        $data['roles'] = $this->role->combo();
        $data['city'] = $this->city->combo_city_name();
        
        // period setting
        $data['cmonth'] = combo_month();
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
        $this->table->set_heading('#','No', 'Username', 'E-mail', 'Role', 'Status', 'Action');

        $data['table'] = $this->table->generate();
        $data['source'] = site_url($this->title.'/getdatatable');
            
        // Load absen view dengan melewatkan var $data sbgai parameter
	$this->load->view('template', $data);
    }

    // Fungsi update untuk mengupdate db
    function update_process($param=0)
    {
        if ($this->acl->otentikasi3($this->title,'ajax') == TRUE){

        $data['title'] = $this->properti['name'].' | Configurationistrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'admin_update';
	$data['form_action1'] = site_url($this->title.'/update_process/1');
        $data['form_action2'] = site_url($this->title.'/update_process/2');
        $data['form_action3'] = site_url($this->title.'/update_process/3');
        $data['form_action4'] = site_url($this->title.'/update_process/4');
        $data['form_action5'] = site_url($this->title.'/update_process/5');
	$data['link'] = array('link_back' => anchor('admin/','<span>back</span>', array('class' => 'back')));

	// Form validation
        if ($param == 1)
        {
           $this->form_validation->set_rules('tname', 'Property', 'required|max_length[100]');
           $this->form_validation->set_rules('taddress', 'Address', 'required');
	   $this->form_validation->set_rules('tphone1', 'Phone1', 'required|max_length[15]');
           $this->form_validation->set_rules('tphone2', 'Phone2', 'required|max_length[15]');
           $this->form_validation->set_rules('tmail', 'Property Mail', 'required|valid_email|max_length[100]');
           $this->form_validation->set_rules('tbillmail', 'Billing Email', 'required|valid_email|max_length[100]');
           $this->form_validation->set_rules('ttechmail', 'Technical Email', 'required|valid_email|max_length[100]');
           $this->form_validation->set_rules('tccmail', 'CC Email', 'required|valid_email|max_length[100]');
	   $this->form_validation->set_rules('ccity', 'City', 'required|max_length[25]');
           $this->form_validation->set_rules('tzip', 'Zip Code', 'required|numeric|max_length[25]');
        }
        elseif ($param == 2)
        {
            $this->form_validation->set_rules('taccount_name', 'Account Name', 'required|max_length[100]');
            $this->form_validation->set_rules('taccount_no', 'Account No', 'required|max_length[100]');
            $this->form_validation->set_rules('tbank', 'Bank Name', 'required'); 
        }
        elseif ($param == 3)
        {
            $this->form_validation->set_rules('tsitename', 'Site Name', 'required');
            $this->form_validation->set_rules('tmetadesc', 'Global Meta Description', '');
            $this->form_validation->set_rules('tmetakey', 'Global Meta Keyword', ''); 
        }
        elseif ($param == 4)
        {
            $this->form_validation->set_rules('tmanager', 'Manager', '');
            $this->form_validation->set_rules('taccounting', 'Accounting', '');
            $this->form_validation->set_rules('twebmail', 'Webmail', '');
        }
        elseif ($param == 5)
        {
            $this->form_validation->set_rules('cbegin_month', 'Begin Month', 'required|callback_valid_starting_period'); 
            $this->form_validation->set_rules('tbegin_year', 'Begin Year', 'required|numeric|callback_valid_starting_period'); 
            $this->form_validation->set_rules('cmonth', 'Period Month', 'required'); 
            $this->form_validation->set_rules('tyear', 'Period Year', 'required|numeric'); 
            $this->form_validation->set_rules('cend_month', 'End-Closing Month', 'required'); 
        }


        if ($this->form_validation->run($this) == TRUE)
        {
            if ($param == 1)
            {
                $property = array('name' => $this->input->post('tname'), 'address' => $this->input->post('taddress'),
                                  'phone1' => $this->input->post('tphone1'), 'phone2' => $this->input->post('tphone2'),
                                  'cc_email' => $this->input->post('tccmail'), 'email' => $this->input->post('tmail'),
                                  'billing_email' => $this->input->post('tbillmail'), 'technical_email' => $this->input->post('ttechmail'),
                                  'zip' => $this->input->post('tzip'),'city' => $this->input->post('ccity'));

                $this->Configuration_model->update(1, $property);
                echo "true|One $this->title has successfully updated..! ";
            }
            elseif ($param == 2)
            {
                $property = array( 'bank' => $this->input->post('tbank'), 'account_name' => $this->input->post('taccount_name'), 'account_no' => $this->input->post('taccount_no'));
                $this->Configuration_model->update(1, $property);
                echo "true|One $this->title has successfully updated..! ";
            }
            elseif ($param == 4)
            {   
                $property = array( 'manager' => $this->input->post('tmanager'), 'accounting' => $this->input->post('taccounting'), 'email_link' => $this->input->post('twebmail'));
                $this->Configuration_model->update(1, $property);
                echo "true|One $this->title has successfully updated..! ";
            }
            elseif ($param == 5)
            {   
                $ps = $this->period->get();
                if ($ps->status == 1)
                {
                    $monthperiod = $this->input->post('cmonth');
                    $yearperiod = $this->input->post('tyear');
                    $monthend = $ps->closing_month;
                    $startmonth = $ps->start_month;
                    $startyear = $ps->start_year;
                }
                elseif($ps->status == 0) 
                {
                   $monthperiod = $this->input->post('cmonth');
                   $yearperiod = $this->input->post('tyear');
                   $monthend = $this->input->post('cend_month');
                   $startmonth = $this->input->post('cbegin_month');
                   $startyear = $this->input->post('tbegin_year');
                }

                $property = array( 'start_month' => $startmonth, 'start_year' => $startyear,
                                   'month' => $monthperiod, 'year' => $yearperiod,
                                   'closing_month' => $monthend
                                 );
                
//                 echo $startmonth.'|'.$startyear.'|'.$monthperiod.'|'.$monthend;
                $this->period->update_period(1, $property);
                echo "true|One $this->title has successfully updated..! ";
            }
            elseif ($param == 3){
            
               $config['upload_path']   = './images/property/';
               $config['allowed_types'] = 'gif|jpg|png';
               $config['overwrite']     = TRUE;
               $config['max_size']      = '15000';
               $config['max_width']     = '10000';
               $config['max_height']    = '10000';
               $config['remove_spaces'] = TRUE;

               $this->load->library('upload', $config); 
               
               if ( !$this->upload->do_upload("userfile")){
                   $data['error'] = $this->upload->display_errors();
                   $property = array('site_name' => $this->input->post('tsitename'), 'meta_description' => $this->input->post('tmetadesc'), 'meta_keyword' => $this->input->post('tmetakey'));
               }
               else{
                   $info = $this->upload->data();
                   $property = array('site_name' => $this->input->post('tsitename'), 'meta_description' => $this->input->post('tmetadesc'), 'meta_keyword' => $this->input->post('tmetakey'), 'logo' => $info['file_name']);
               }
               
               $this->Configuration_model->update(1, $property);
               if ($this->upload->display_errors()){ echo "warning|".$this->upload->display_errors(); }
               else { echo "true|One $this->title has successfully updated..! "; }
            }
            
        } else{ echo 'error|'.validation_errors(); }
      }
      else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }
    
    function remove_img()
    {
        $img = $this->Configuration_model->get_by_id(1)->row();
        $img = $img->logo;
        if ($img){ $img = "./images/property/".$img; unlink("$img"); }
    }
    
    //  callback period validation
    public function valid_closing_period($val=null)
    {
        $end = $this->input->post('cyearend');
        $year = $this->input->post('tyearperiod'); 
        
        if ($this->ps->status == 1)
        {
            if ($end != $this->ps->closing_month || $year != $this->ps->year)
            {
                $this->form_validation->set_message('valid_closing_period', "Year Period & Year-End Cannot Changed..!");
                return FALSE;
            }
            else { return TRUE; }
        }
        else { return TRUE; }
    }
    
    public function valid_starting_period($val=null)
    {
        $smonth = $this->input->post('cbegin_month');
        $emonth = $this->input->post('cmonth');
        $syear = $this->input->post('tbegin_year');
        $eyear = $this->input->post('tyear');
        
        if ($syear > $eyear)
        {
           $this->form_validation->set_message('valid_starting_period', "Invalid Begin Year..!!");
           return FALSE;
        }
        else
        {
            if ($syear == $eyear) { if ($smonth > $emonth){ $this->form_validation->set_message('valid_starting_period', "Invalid Begin Month..!!"); return FALSE; }else { return TRUE; }}
            else { return TRUE; }
        }
    }
    
    // ====================================== CLOSING ======================================
    function reset_process(){ } 


}

?>