<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once 'definer.php';

class Service extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Service_model', '', TRUE);
        $this->load->model('Service_item_model', 'sitem', TRUE);

        $this->properti = $this->property->get();
//        $this->acl->otentikasi();

        $this->modul = $this->components->get(strtolower(get_class($this)));
        $this->title = strtolower(get_class($this));
        $this->role = new Role_lib();
        $this->currency = new Currency_lib();
        $this->customer = new Customer_lib();
        $this->payment = new Payment_lib();
        $this->city = new City_lib();
        $this->bank = new Bank_lib();
        $this->journalgl = new Journalgl_lib();
        $this->period = new Period_lib();
        $this->period = $this->period->get();
        $this->tax = new Tax_lib();
        $this->account = new Account_lib();
        $this->airport = new Airport_lib();
        $this->airline = new Airline_lib();
        $this->vendor = new Vendor_lib();
        $this->service = new Sales_lib();
        $this->trans = new Trans_ledger_lib();
    }

    private $properti, $modul, $title, $bank, $journalgl, $airport, $airline, $vendor, $trans;
    private $role, $currency, $customer, $payment, $city, $period, $tax, $account, $service;
    
    function index()
    {
       $this->session->unset_userdata('start'); 
       $this->session->unset_userdata('end');
       $this->get_last(); 
    }

//     ============== ajax ===========================
     
    public function getdatatable($search=null,$customer='null',$paid='null')
    {
        if(!$search){ $result = $this->Service_model->get_last($this->modul['limit'])->result(); }
        else {$result = $this->Service_model->search($customer,$paid)->result(); }
	
        $output = null;
        if ($result){
                
         foreach($result as $res)
	 {
           if ($res->paid_date){ $stts = 'S'; }else{ $stts = 'C'; }
	   $output[] = array ($res->id, $res->code, tglin($res->dates).' '.timein($res->dates), $this->customer->get_name($res->cust_id),
                              idr_format($res->amount), $res->payment_id, $res->approved, $stts
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

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords('Service Order');
        $data['h2title'] = 'Service Order';
        $data['main_view'] = 'service_view';
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_update'] = site_url($this->title.'/update_process');
        $data['form_action_del'] = site_url($this->title.'/delete_all/hard');
        $data['form_action_report'] = site_url($this->title.'/report_process');
        $data['form_action_confirmation'] = site_url($this->title.'/payment_confirmation');
        $data['link'] = array('link_back' => anchor('main/','Back', array('class' => 'btn btn-danger')));

        $data['customer'] = $this->customer->combo();
        $data['bank'] = $this->account->combo_asset();
        $data['array'] = array('','');
        $data['month'] = combo_month();
        $data['year'] = date('Y');
        $data['default']['month'] = date('n');
        
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
        $this->table->set_heading('#','No', 'Code', 'Date', 'Customer', 'Balance', '#', 'Action');

        $data['table'] = $this->table->generate();
        $data['source'] = site_url($this->title.'/getdatatable/');
        $data['graph'] = site_url()."/service/chart/".$this->input->post('cmonth').'/'.$this->input->post('tyear');
            
        // Load absen view dengan melewatkan var $data sbgai parameter
	$this->load->view('template', $data);
    }
    
    function chart($month=null,$year=null)
    {   
        $data = $this->category->get();
        $datax = array();
        foreach ($data as $res) 
        {  
           $tot = $this->Service_model->get_service_qty_based_category($res->id,$month,$year); 
           $point = array("label" => $res->name , "y" => $tot);
           array_push($datax, $point);      
        }
        echo json_encode($datax, JSON_NUMERIC_CHECK);
    }
    
    function publish($uid = null)
    {
       if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){   
        try {
            $val = $this->Service_model->get_by_id($uid)->row();
              if ($val->amount > 0){
                if ($val->approved == 0){   
                   if ($val->payment_id == 5){ $lng = array('approved' => 1, 'paid_date' => date('Y-m-d H:i:s'));}else{ $lng = array('approved' => 1);}
                   $this->Service_model->update($uid,$lng);
                   $this->create_journal($uid);
                   echo 'true|Status Changed...!';
                }
                else { echo 'warning|Transaction has been posted...!'; }
            }else{ echo "error|Invalid Amount..!"; }  
        }
        catch(Exception $e) {
          echo 'error'.$e->getMessage();
        }
       }else{ echo "error|Sorry, you do not have the right to change publish status..!"; }
    }
    
    function delete_all($type='hard')
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
             if ($type == 'soft') { $this->Service_model->delete($cek[$i]); }
             else { $this->shipping->delete_by_service($cek[$i]);
                    $this->Service_model->force_delete($cek[$i]);  
             }
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
           
            $service = $this->Service_model->get_by_id($uid)->row();
            $this->journalgl->remove_journal('SSO', $uid);
            $this->journalgl->remove_journal('SCR', $uid);
            
            // hapus kartu piutang / hutang
            $this->trans->remove(date('Y-m-d', strtotime($service->dates)), 'SSO', $uid);
            $this->trans->remove(date('Y-m-d', strtotime($service->dates)), 'SPO', $uid);
            $this->trans->remove(date('Y-m-d', strtotime($service->dates)), 'SCR', $uid);
            
            if ($service->approved == 1){
                
             $param = array('approved' => 0, 'paid_date' => null, 'updated' => date('Y-m-d H:i:s'));
             $this->Service_model->update($uid, $param);   
             echo "true|1 $this->title successfully rollback..!";
            }else{
              $this->sitem->delete_service($uid);
              $this->Service_model->delete($uid);
              echo "true|1 $this->title successfully removed..!";    
            }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
        
    }
    
    function add($param=0)
    {
        $this->acl->otentikasi2($this->title);
         
        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = 'Create New '.$this->modul['title'];
        $data['main_view'] = 'service_form';
        if ($param == 0){$data['form_action'] = site_url($this->title.'/add_process'); $data['counter'] = $this->Service_model->counter(); }
        else { $data['form_action'] = site_url($this->title.'/update_process'); $data['counter'] = $param; }
	
        $data['link'] = array('link_back' => anchor($this->title,'Back', array('class' => 'btn btn-danger')));
        $data['form_action_trans'] = site_url($this->title.'/add_item/0'); 

        $data['customer'] = $this->customer->combo();
        $data['vendor'] = $this->vendor->combo();
        $data['passenger'] = $this->service->combo_passenger();
        $data['account'] = $this->account->combo_asset();
        $data['airport'] = $this->airport->combo();
        $data['airline'] = $this->airline->combo();
        
        $data['tax'] = $this->tax->combo();
        $data['payment'] = $this->payment->combo();
        $data['source'] = site_url($this->title.'/getdatatable');
        $data['graph'] = site_url()."/service/chart/";
        $data['city'] = $this->city->combo_city_combine();
        $data['default']['dates'] = date("Y/m/d");
        $data['code'] = '0'.$data['counter'].date('dnyHi');
        
        $data['items'] = null;

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
        $this->form_validation->set_rules('ccustomer', 'Customer', 'required');
        $this->form_validation->set_rules('tdates', 'Transaction Date', 'required');
        $this->form_validation->set_rules('tduedates', 'Transaction Due Date', 'required');
        $this->form_validation->set_rules('tcode', 'Transaction Code', 'required');
        $this->form_validation->set_rules('cpayment', 'Payment Type', 'required');
        $this->form_validation->set_rules('tcosts', 'Landed Cost', 'numeric');

        if ($this->form_validation->run($this) == TRUE)
        {
            if ($this->input->post('cpayment') == 5){ $acc = $this->input->post('caccount');}else{ $acc = 0; }
            
            $service = array('cust_id' => $this->input->post('ccustomer'), 'dates' => date("Y-m-d H:i:s"), 
                           'cost' => $this->input->post('tcosts'), 'code' => $this->input->post('tcode'), 'account' => $acc,
                           'due_date' => $this->input->post('tduedates'), 'payment_id' => $this->input->post('cpayment'), 
                           'created' => date('Y-m-d H:i:s'), 'log' => $this->session->userdata('log'));

            $this->Service_model->add($service);
            echo "true|One $this->title data successfully saved!|".$this->Service_model->counter(1);
//            $this->session->set_flashdata('message', "One $this->title data successfully saved!");
//            redirect($this->title.'/update/'.$this->Service_model->counter(1));
        }
        else{ $data['message'] = validation_errors(); echo "error|".validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }

    }
    
    function add_item($sid=0)
    { 
       if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){ 
       if ($sid == 0){ echo 'error|Service ID not saved'; }
       else {
       
         // Form validation
        $this->form_validation->set_rules('tpassenger', 'Passenger', 'required');
        $this->form_validation->set_rules('tidcard', 'ID Card', 'required');
        $this->form_validation->set_rules('tcheckin', 'CheckIn', 'callback_valid_return');
        $this->form_validation->set_rules('tcheckout', 'CheckOut Description', '');
        $this->form_validation->set_rules('tbook', 'Book Code', 'required');
        $this->form_validation->set_rules('tdesc', 'Description', 'required');
        $this->form_validation->set_rules('tcapital', 'Capital Price', 'required|numeric');
        $this->form_validation->set_rules('tprice', 'Price', 'required|numeric');
        $this->form_validation->set_rules('tdiscount', 'Discount', 'required|numeric');
        $this->form_validation->set_rules('ctax', 'Tax Type', 'required');

            if ($this->form_validation->run($this) == TRUE && $this->valid_confirm($sid) == TRUE)
            {
                // start transaction 
                $this->db->trans_start(); 
                
                $amt = floatval($this->input->post('tprice')-$this->input->post('tdiscount'));
                $tax = floatval($this->input->post('ctax')*$amt);
                $id = $this->sitem->counter();
                
                $service = array('id' => $id, 'service_id' => $sid, 'passenger' => $this->input->post('tpassenger'), 'idcard' => $this->input->post('tidcard'),
                               'checkin' => setnull($this->input->post('tcheckin')), 'checkout' => setnull($this->input->post('tcheckout')), 'description' => $this->input->post('tdesc'),
                               'bookcode' => $this->input->post('tbook'), 'vendor' => setnull($this->input->post('cvendor')),
                               'tax' => $tax, 'discount' => $this->input->post('tdiscount'),
                               'hpp' => $this->input->post('tcapital'), 'price' => $this->input->post('tprice'), 'amount' => floatval($amt+$tax));
//
                $this->sitem->add($service);
                $this->update_trans($sid);
                echo "true|Service Transaction data successfully saved!|";
                
                $this->db->trans_complete();
                // end transaction
            }
            else{ echo "error|".validation_errors(); }  
        }
       }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }
    
    
    function update_item_process()
    { 
       if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){ 
       
         // Form validation
        $this->form_validation->set_rules('tpassenger', 'Passenger', 'required');
        $this->form_validation->set_rules('tidcard', 'ID Card', 'required');
        $this->form_validation->set_rules('tcheckin', 'CheckIn', 'callback_valid_return');
        $this->form_validation->set_rules('tcheckout', 'CheckOut Description', '');
        $this->form_validation->set_rules('tbook', 'Book Code', 'required');
        $this->form_validation->set_rules('tdesc', 'Description', 'required');
        $this->form_validation->set_rules('tcapital', 'Capital Price', 'required|numeric');
        $this->form_validation->set_rules('tprice', 'Price', 'required|numeric');
        $this->form_validation->set_rules('tdiscount', 'Discount', 'required|numeric');
        $this->form_validation->set_rules('ctax', 'Tax Type', 'required');

            if ($this->form_validation->run($this) == TRUE && $this->valid_confirm($this->input->post('tsid')) == TRUE)
            {
                // start transaction 
                $this->db->trans_start(); 
                
                $amt = floatval($this->input->post('tprice')-$this->input->post('tdiscount'));
                $tax = floatval($this->input->post('ctax')*$amt);
                
                $service = array('passenger' => $this->input->post('tpassenger'), 'idcard' => $this->input->post('tidcard'),
                               'checkin' => setnull($this->input->post('tcheckin')), 'checkout' => setnull($this->input->post('tcheckout')), 'description' => $this->input->post('tdesc'),
                               'bookcode' => $this->input->post('tbook'), 'vendor' => setnull($this->input->post('cvendor')),
                               'tax' => $tax, 'discount' => $this->input->post('tdiscount'),
                               'hpp' => $this->input->post('tcapital'), 'price' => $this->input->post('tprice'), 'amount' => floatval($amt+$tax));

                $this->sitem->update_id($this->input->post('tid'), $service);
                $this->update_trans($this->input->post('tsid'));
                echo "true|Service Transaction data successfully saved!|";
                
                $this->db->trans_complete();
                // end transaction
            }
            else{ echo "error|".validation_errors(); }  
        
       }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }
    
    private function update_trans($sid)
    {
        $totals = $this->sitem->total($sid);
        $price = $totals['price'];
        
        $service = $this->Service_model->get_by_id($sid)->row();
        $cost = $service->cost;
        
        // total        
        $transaction = array('tax' => $totals['tax'], 'total' => $price, 'discount' => $totals['discount'], 
                             'amount' => intval($totals['amount']+$cost), 'cost' => $cost);
	$this->Service_model->update($sid, $transaction);
    }
    
    function delete_item($id,$sid)
    {
        if ($this->acl->otentikasi2($this->title) == TRUE && $this->valid_confirm($sid) == TRUE){ 
            
         // start transaction 
            $this->db->trans_start();    
            $this->sitem->delete($id); // memanggil model untuk mendelete data
            $this->update_trans($sid);
            $this->session->set_flashdata('message', "1 item successfully removed..!"); 
            $this->db->trans_complete();
//       end transaction
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
        redirect($this->title.'/update/'.$sid);
    }
    
    private function split_array($val)
    { return implode(",",$val); }
   
    function shipping($sid=0)
    { 
       if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){ 
       if ($sid == 0){ echo 'error|Service ID not saved'; }
       else {
       
        $service = $this->Service_model->get_by_id($sid)->row();
           
         // Form validation
        $this->form_validation->set_rules('ccity', 'City', 'required');
        $this->form_validation->set_rules('tshipaddkurir', 'Shipping Address', 'required');
        $this->form_validation->set_rules('ccourier', 'Courier Service', 'required');
        $this->form_validation->set_rules('cpackage', 'Package Type', '');
        $this->form_validation->set_rules('tweight', 'Weight', 'required|numeric');

            if ($this->form_validation->run($this) == TRUE && $this->valid_confirm($sid) == TRUE)
            {
                $city = explode('|', $this->input->post('ccity'));
                $package = explode('|', $this->input->post('cpackage'));
                $param = array('service_id' => $sid, 'shipdate' => null,
                               'courier' => $this->input->post('ccourier'), 'dest' => $city[1], 'dest_id' => $city[0],
                               'dest_desc' => $this->input->post('tshipaddkurir'), 'package' => $package[0],
                               'weight' => $this->input->post('tweight'), 'rate' => $this->input->post('rate'),
                               'amount' => intval($this->input->post('rate')*$this->input->post('tweight')));
                
                $this->shipping->create($sid, $param);
                $this->update_trans($sid);
                echo "true|Shipping Transaction data successfully saved!|";
            }
            else{ echo "error|".validation_errors(); }  
        }
       }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }
    
    function update_item($uid)
    {
        $acc = $this->sitem->get_by_id($uid)->row();
        echo $acc->id.'|'.$acc->service_id.'|'.$acc->passenger.'|'.$acc->idcard.'|'.$acc->checkin.'|'.$acc->checkout.'|'.$acc->description.'|'.$acc->bookcode.'|'.$acc->vendor.'|'.
             $acc->price.'|'.$acc->amount.'|'.$acc->hpp.'|'.$acc->discount.'|'.$acc->tax;
    }
    
    // Fungsi update untuk menset texfield dengan nilai dari database
    function update($param=0)
    {
        $this->acl->otentikasi2($this->title);
        
        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = 'Update '.$this->modul['title'];
        $data['main_view'] = 'service_form';
        $data['form_action'] = site_url($this->title.'/update_process/'.$param); 
        $data['form_action_trans'] = site_url($this->title.'/add_item/'.$param); 
        $data['form_action_shipping'] = site_url($this->title.'/shipping/'.$param); 
        $data['counter'] = $param; 
	
        $data['link'] = array('link_back' => anchor($this->title,'Back', array('class' => 'btn btn-danger')));
        
        $service = $this->Service_model->get_by_id($param)->row();
        $customer = $this->customer->get_details($service->cust_id)->row();
        
        $data['customer'] = $this->customer->combo();
        $data['vendor'] = $this->vendor->combo();
        $data['passenger'] = $this->service->combo_passenger();
        $data['account'] = $this->account->combo_asset();
        $data['airport'] = $this->airport->combo();
        $data['airline'] = $this->airline->combo();
        $data['tax'] = $this->tax->combo();
        $data['payment'] = $this->payment->combo();
        $data['source'] = site_url($this->title.'/getdatatable');
        $data['graph'] = site_url()."/service/chart/";
        $data['city'] = $this->city->combo_city_combine();
        $data['default']['dates'] = date("Y/m/d");
        $data['code'] = $service->code;
        
        $data['default']['customer'] = $service->cust_id;
        $data['default']['email'] = $customer->email;
        $data['default']['ship_address'] = $customer->shipping_address;
        $data['default']['dates'] = $service->dates;
        $data['default']['due_date'] = $service->due_date;
        $data['default']['payment'] = $service->payment_id;
        $data['default']['account'] = $service->account;
        $data['default']['costs'] = $service->cost;
        $data['default']['tax'] = $service->tax;
        $data['default']['discount'] = $service->discount;
        $data['default']['total'] = $service->total;
        $data['default']['tot_amt'] = floatval($service->amount);
        
        // transaction table
        $data['items'] = $this->sitem->get_last_item($param)->result();
        $this->load->view('template', $data);
    }
    
   function invoice($sid=null,$type=null)
   {
       $this->acl->otentikasi2($this->title);

       $data['h2title'] = 'Print Tax Invoice'.$this->modul['title'];
       
       if ($type == 'code'){ $service = $this->Service_model->get_by_code($sid)->row();
       }else{ $service = $this->Service_model->get_by_id($sid)->row(); }
       
       // customer
       $customer = $this->customer->get_details($service->cust_id)->row();
       $data['customer'] = strtoupper($customer->first_name.' '.$customer->last_name);
       $data['address'] = $customer->address;
       $data['city'] = $customer->city;
       $data['phone'] = $customer->phone1;
       $data['phone2'] = $customer->phone2;

       //service
       $data['pono'] = 'SO-'.$sid;
       $data['code'] = $service->code;
       $data['podate'] = tglincomplete($service->dates);
       $data['desc'] = '';
       $data['notes'] = '';
       $data['user'] = $this->session->userdata('username');
       $data['currency'] = 'IDR';
       $data['log'] = $this->session->userdata('log');
       $data['cost'] = $service->cost;
       $data['amount'] = $service->amount;

       // service item
       $data['items'] = $this->sitem->get_last_item($service->id)->result();

       // property display
       $data['logo'] = $this->properti['logo'];
       $data['paddress'] = $this->properti['address'];
       $data['p_phone1'] = $this->properti['phone1'];
       $data['p_phone2'] = $this->properti['phone2'];
       $data['p_city'] = ucfirst($this->properti['city']);
       $data['p_zip'] = $this->properti['zip'];
       $data['p_npwp'] = '';
       $data['p_sitename'] = $this->properti['sitename'];
       $data['p_email'] = $this->properti['email'];

       if ("IDR"){ $data['symbol'] = 'Rp.'; $matauang = 'rupiah'; }
       else { $data['symbol'] = ''; $matauang = ''; }


       $data['status'] = $service->paid_date;
       $app = null;
       if ($service->approved == 1){ $app = 'A'; } else{ $app = 'NA'; }
       $data['approve'] = $app;
       
       $terbilang = $this->load->library('terbilang');
       $data['terbilang'] = ucwords($terbilang->baca($service->amount).' '.$matauang);

        if ($this->sitem->cek_return($sid) == TRUE){ $this->load->view('service_invoice_return', $data);}else{ $this->load->view('service_invoice', $data); }
   }
    
    function update_process($param)
    {
        if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'service_form';
        $data['form_action'] = site_url($this->title.'/update_process/'.$param); 
	$data['link'] = array('link_back' => anchor('category/','<span>back</span>', array('class' => 'back')));

	// Form validation
        $this->form_validation->set_rules('ccustomer', 'Customer', 'required');
        $this->form_validation->set_rules('tdates', 'Transaction Date', 'required');
        $this->form_validation->set_rules('tduedates', 'Transaction Due Date', 'required');
        $this->form_validation->set_rules('tcode', 'Transaction Code', 'required');
        $this->form_validation->set_rules('cpayment', 'Payment Type', 'required');
        $this->form_validation->set_rules('tcosts', 'Landed Cost', 'numeric');

        if ($this->form_validation->run($this) == TRUE && $this->valid_confirm($param) == TRUE)
        {     
            if ($this->input->post('cpayment') == 5){ $acc = $this->input->post('caccount');}else{ $acc = 0; }
            
            $service = array('cust_id' => $this->input->post('ccustomer'), 'dates' => date("Y-m-d H:i:s"), 
                           'cost' => $this->input->post('tcosts'), 'code' => $this->input->post('tcode'), 'account' => $acc,
                           'due_date' => $this->input->post('tduedates'), 'payment_id' => $this->input->post('cpayment'),
                           'log' => $this->session->userdata('log'));
            
            $this->Service_model->update($param, $service);
            $this->update_trans($param);

            $this->session->set_flashdata('message', "One $this->title data successfully saved!");
            echo "true|One $this->title data successfully saved!|".$param;
        }
        elseif ($this->valid_confirm($param) != TRUE){ echo "error|Service Already Confirmed..!"; }
        elseif ($this->valid_items($param) != TRUE){ echo "error|Service Already Confirmed..!"; }
        else{ echo "error|".validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
        //redirect($this->title.'/update/'.$param);
    }
    
    function confirmation($sid)
    {
        $service = $this->Service_model->get_by_id($sid)->row();
//	$this->session->set_userdata('langid', $service->id);
        
        echo $sid.'|'.$service->sender_name.'|'.$service->sender_acc.'|'.$service->sender_bank.'|'.$service->sender_amount.'|'.$service->account.'|'.
             $service->cc_no.'|'.$service->cc_name.'|'.$service->cc_bank.'|'.$service->paid_date;
    }
        
    function create_journal($sid)
    {
        $this->journalgl->remove_journal('SSO', $sid);
        $this->journalgl->remove_journal('SCR', '00'.$sid);
        
        $service = $this->Service_model->get_by_id($sid)->row();
        $totals = $this->sitem->total($sid);
        
        $cm = new Control_model();
        
        $landed   = $cm->get_id(2);
        $discount = $cm->get_id(4);
        $tax      = $cm->get_id(18);
        $ar       = $cm->get_id(17);
        
        if ($this->payment->get_name($service->payment_id) == 'Cash'){ $account = $service->account; }
        else{ $account = $ar; 
          // kartu piutang
          $this->trans->add('bank', 'SSO', $service->id, 'IDR', $service->dates, $service->amount, 0, $service->cust_id, 'AR');
        }    
        
        $this->journalgl->new_journal($service->id, $service->dates,'SSO','IDR','ServiceOrder - '.$service->code, $service->amount, $this->session->userdata('log'));
        $jid = $this->journalgl->get_journal_id('SSO',$service->id);

        $this->journalgl->add_trans($jid,$account,$service->amount,0); // piutang usaha bertambah
        if ($service->tax > 0){ $this->journalgl->add_trans($jid,$tax,0,$service->tax); } // pajak penjualan
        if ($service->cost > 0){ $this->journalgl->add_trans($jid,$landed,0,$service->cost); } // landed costs
        if ($service->discount > 0){ $this->journalgl->add_trans($jid,$discount,$service->discount,0); } // discount
        
        
        $items = $this->sitem->get_last_item($sid)->result();
        $ap = $cm->get_id(11); // hutang dagang
        $hpp = $cm->get_id(65); // hpp
        $sales_service = $cm->get_id(19); // hpp
        
        foreach ($items as $res){
            
            $this->journalgl->add_trans($jid,$ap, 0, $res->hpp); // hutang kredit
            
            $this->trans->add('bank', 'SPO', $res->service_id, 'IDR', $service->dates, 0, $res->hpp, $res->vendor, 'AP'); // kartu hutang
            
            $this->journalgl->add_trans($jid,$hpp, $res->hpp, 0); // tambah (hpp) service
            $this->journalgl->add_trans($jid,$sales_service,0,$res->price); // tambah penjualan service
        }
    }

    
    function payment_confirmation()
    {
       if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'service_form';
	$data['link'] = array('link_back' => anchor('category/','<span>back</span>', array('class' => 'back')));

	// Form validation
        $this->form_validation->set_rules('tcdates', 'Confirmation Date', 'required');
        $this->form_validation->set_rules('tccname', 'CC - Account Name');
        $this->form_validation->set_rules('tccno', 'CC - Account No');
        $this->form_validation->set_rules('tccbank', 'CC - Account Bank');
        $this->form_validation->set_rules('taccname', 'Account Name');
        $this->form_validation->set_rules('taccno', 'Account No');
        $this->form_validation->set_rules('taccbank', 'Account Bank');
        $this->form_validation->set_rules('tamount', 'Amount', 'numeric|required');
        $this->form_validation->set_rules('cbank', 'Merchant Bank', 'required');

        if ($this->form_validation->run($this) == TRUE && $this->valid_confirm($this->input->post('hid')) == TRUE && $this->valid_approval($this->input->post('hid')) == TRUE )
        {
            $service = array('paid_date' => $this->input->post('tcdates'),
                           'cc_name' => $this->input->post('tccname'), 'cc_no' => $this->input->post('tccno'), 'cc_bank' => $this->input->post('tccbank'),
                           'sender_name' => $this->input->post('taccname'), 'sender_acc' => $this->input->post('taccno'),
                           'sender_bank' => $this->input->post('taccbank'), 'sender_amount' => $this->input->post('tamount'),
                           'account' => $this->input->post('cbank')
                );
            $stts = 'confirmed!';
            $this->Service_model->update($this->input->post('hid'), $service);
            $this->confirmation_journal($this->input->post('hid'));

            $status = true;
            if ($status == true){
               echo "true|One $this->title data payment successfully ".$stts;  
            }else { echo "error|Error Sending Mail...!! ";   }
        }
        elseif ($this->valid_confirm($this->input->post('hid')) != TRUE){ echo "error|Service Order Payment Already Confirmed..!"; }
        elseif ($this->valid_approval($this->input->post('hid')) != TRUE){ echo "error|Service Order Not Approved..!"; }
        else{ echo "error|". validation_errors(); $this->session->set_flashdata('message', validation_errors()); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; } 
    }
    
    function confirmation_journal($sid)
    {
        $service = $this->Service_model->get_by_id($sid)->row();
        $cm = new Control_model();
        
        $this->trans->add('bank', 'SCR', $service->id, 'IDR', $service->dates, 0, $service->amount, $service->cust_id, 'AR'); // pelunasan kartu piutang
        
        $ar = $cm->get_id(17);
        $account = $service->account;
        
        $this->journalgl->new_journal($service->id,$service->paid_date,'SCR','IDR','Payment Confirmation',$service->amount, $this->session->userdata('log'));
        $jid = $this->journalgl->get_journal_id('SCR', $service->id);
        
        $this->journalgl->add_trans($jid,$account, $service->amount, 0); // tambah bank
        $this->journalgl->add_trans($jid,$ar, 0, $service->amount); // kurang piutang
    }
    
    function valid_return($val)
    {
        $checkin = $this->input->post('tcheckin');
        $checkout = $this->input->post('tcheckout');
        if ($val){ if ($checkin > $checkout){ $this->form_validation->set_message('valid_return', "Invalid Checkout Date..!"); return FALSE; }else{ return TRUE; }}else{ return TRUE; }
    }
    
    function valid_required($val)
    {
        $stts = $this->input->post('cstts');
        if ($stts == 1){
            if (!$val){
              $this->form_validation->set_message('valid_required', "Field Required..!"); return FALSE;
            }else{ return TRUE; }
        }else{ return TRUE;  }
    }
    
    function valid_login()
    {
        if (!$this->session->userdata('username')){
            $this->form_validation->set_message('valid_login', "Transaction rollback relogin to continue..!");
            return FALSE;
        }else{ return TRUE; }
    }
    
    function valid_name($val)
    {
        if ($this->Service_model->valid('name',$val) == FALSE)
        {
            $this->form_validation->set_message('valid_name','Name registered..!');
            return FALSE;
        }
        else{ return TRUE; }
    }
    
    function valid_confirm($sid)
    {
        if ($this->Service_model->valid_confirm($sid) == FALSE)
        {
            $this->form_validation->set_message('valid_confirm','Service Already Confirmed..!');
            return FALSE;
        }
        else{ return TRUE; }
    }
    
    function valid_approval($sid)
    {
        $service = $this->Service_model->get_by_id($sid)->row();
        if ($service->approved == 0)
        {
            $this->form_validation->set_message('valid_approval','Service Already Not Approved..!');
            return FALSE;
        }
        else{ return TRUE; }
    }
    
    function valid_items($sid)
    {
        if ($this->sitem->valid_items($sid) == FALSE)
        {
            $this->form_validation->set_message('valid_items',"Empty Transaction..!");
            return FALSE;
        }
        else{ return TRUE; }
    }
    
    function report_process()
    {
        $this->acl->otentikasi2($this->title);
        $data['title'] = $this->properti['name'].' | Report '.ucwords($this->modul['title']);

        $data['rundate'] = tglin(date('Y-m-d'));
        $data['log'] = $this->session->userdata('log');
        $period = $this->input->post('reservation');  
        $start = picker_between_split($period, 0);
        $end = picker_between_split($period, 1);
        $confirm = $this->input->post('cconfirm');

        $data['start'] = tglin($start);
        $data['end'] = tglin($end);
        
//        Property Details
        $data['company'] = $this->properti['name'];
        $data['reports'] = $this->Service_model->report($start,$end,$confirm)->result();
        $data['reports_item'] = $this->Service_model->report_category($start,$end,$confirm)->result();
//        
        $type = $this->input->post('ctype');
        if ($type == 0){ $this->load->view('service_report', $data); }
        elseif($type == 1) { $this->load->view('service_pivot', $data); }
        elseif($type == 2) { $this->load->view('service_report_item', $data); }
        elseif($type == 3) { $this->load->view('service_pivot_item', $data); }
        elseif($type == 4) { $this->load->view('service_paid', $data); }
    } 
    
    function receivable_process()
    {
        $this->acl->otentikasi2($this->title);
        $data['title'] = $this->properti['name'].' | Report '.ucwords($this->modul['title']);

        $data['rundate'] = tglin(date('Y-m-d'));
        $data['log'] = $this->session->userdata('log');
        $period = $this->input->post('reservation');  
        $start = picker_between_split($period, 0);
        $end = picker_between_split($period, 1);

        $data['start'] = tglin($start);
        $data['end'] = tglin($end);
        
        $cust = $this->input->post('ccustomer');
        $trans = $this->input->post('ctrans');

        $data['currency'] = 'IDR';
        $data['start'] = tglin($start);
        $data['end'] = tglin($end);

        $data['rundate'] = tgleng(date('Y-m-d'));
        $data['log'] = $this->session->userdata('log');
        
        // Property Details
        $data['company'] = $this->properti['name'];
        
        $data['customer'] = $this->customer->get_name($cust);
        $data['open'] = $this->trans->get_sum_transaction_open_balance(null, 'IDR', $start, $cust, 'AR', $trans);
        $data['trans'] = $this->trans->get_transaction(null, 'IDR', $start, $end, $cust, 'AR', $trans)->result();
        
        $this->load->view('receivable_card', $data);
    }

}

?>