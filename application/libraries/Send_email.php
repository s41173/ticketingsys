<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Send_email extends CI_Email {

    public function __construct($params)
    {
        // Do something with $params
        parent::__construct();
        
        $this->ci = & get_instance();
//        $this->ci->load->library('email');
        $this->ci->load->library('property');

        $this->from_email = $params[0];
        $this->from_name = $params[1];
        $this->to = $params[2];
        $this->subject = $params[3];
        $this->mess = $params[4];
        $this->type = $params[5];
        
    }

    private $ci;
    private $property;
    private $from_email, $from_name, $to, $subject, $mess, $type;

    public function send_process()
    {
        if ($this->email_validation() == TRUE)
        {
              $this->property = $this->ci->property->get();
              
               $config['protocol'] = 'smtp';
               $config['smtp_host'] = "mail.sejahtera-sports.com";
               $config['smtp_user'] = "info@sejahtera-sports.com";
               $config['smtp_pass'] = "medan2017";
               $config['mailpath'] = '/usr/sbin/sendmail';
               $config['charset']  = 'utf-8';
               $config['wordwrap'] = TRUE;
               $config['mailtype'] = $this->type;
              
              $this->initialize($config);
              $this->from($this->from_email, $this->from_name);
              $this->to($this->to);
              $this->cc($this->property['cc_email']);
              $this->subject($this->subject);
              $this->message($this->mess);
              
              if (@$this->send() != TRUE) 
              {
//                 throw new Exception("Failed To Sent Email");   
//                  return $this->print_debugger();
                return FALSE;
              }else{ return TRUE; }
        }
        else { return FALSE; }

    }

    private function email_validation()
    {
        if ( filter_var($this->from_email, FILTER_VALIDATE_EMAIL) != TRUE || filter_var($this->to, FILTER_VALIDATE_EMAIL) != TRUE )
        { return FALSE; } else { return TRUE; }
    }
}

/* End of file Property.php */