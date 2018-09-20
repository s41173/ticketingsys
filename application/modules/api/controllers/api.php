<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends MX_Controller {


   public function __construct()
   {
        parent::__construct();


        $this->load->helper('date');
        $this->log = new Log_lib();
        $this->load->library('email');
        $this->login = new Login_lib();
        $this->com = new Components();
        $this->com = $this->com->get_id('login');

        $this->properti = $this->property->get();
        
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token'); 

        // Your own constructor code
   }

   private $date,$time,$log,$login;
   private $properti,$com;

   function index()
   {
       redirect('login');
   }
    
    function contact(){
        
       $datax = (array)json_decode(file_get_contents('php://input')); 
       
       $this->load->library('email');
       $this->email->from($datax['email'], $datax['name']);
       $this->email->to($this->properti['email']);  
       $this->email->subject('Contact Message : '.$datax['name']);
       $this->email->message($datax['message']);	

       if ($this->email->send()){ $stts = 'true'; }else{ $stts = (string)$this->email->print_debugger(); }

       $response = array('status' => $stts);
       $this->output
        ->set_status_header(201)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($response, 128))
        ->_display();
        exit;
   }
    
    function send_email($username)
    {
        $email = $this->Login_model->get_email($username);
        $pass = $this->Login_model->get_pass($username);
        $mess = "
          ".$this->properti['name']." - ".base_url()."
          FORGOT PASSWORD :

          Your Username is: ".$username."
          Your Password : ".$pass." <hr />
Your password for this account has been recovered . You don�t need to do anything, this message is simply a notification to protect the security of your account.
Please note: your password may take awhile to activate. If it doesn�t work on your first try, please try it again later
DO NOT REPLY TO THIS MESSAGE. For further help or to contact support, please email to ".$this->properti['email']."
****************************************************************************************************************** ";

        $params = array($this->properti['email'], $this->properti['name'], $email, 'Password Recovery', $mess, 'text');
        $se = $this->load->library('send_email',$params);

        if ( $se->send_process() == TRUE ){ return TRUE; }else { return FALSE; }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */