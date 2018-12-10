<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model', '', TRUE);
        
        $this->load->library('property');
        $this->load->library('user_agent');
        $this->properti = $this->property->get();

        $this->acl->otentikasi();
        $this->period = new Period_lib();
        $this->period = $this->period->get();
        $this->customer = new Customer_lib();
        $this->vendor = new Vendor_lib();
    }

    var $title = 'main';
    var $limit = null;
    private $properti,$period,$customer,$vendor;

    function index()
    {       
	$this->main_panel();
    }
    

    private function user_agent()
    {
        $agent=null;
        if ($this->agent->is_browser()){  $agent = $this->agent->browser().' '.$this->agent->version();}
        elseif ($this->agent->is_robot()){ $agent = $this->agent->robot(); }
        elseif ($this->agent->is_mobile()){ $agent = $this->agent->mobile(); }
        else{ $agent = 'Unidentified User Agent'; }
        return $agent." - ".$this->agent->platform();
    }
    
    function main_panel()
    {
       $data['name'] = $this->properti['name'];
       $data['title'] = $this->properti['name'].' | Administrator  '.ucwords('Main Panel');
       $data['h2title'] = "Main Panel";

       $data['waktu'] = tgleng(date('Y-m-d')).' - '.waktuindo().' WIB';
       $data['user_agent'] = $this->user_agent();
       $data['month'] = get_month($this->period->month);
       $data['year'] = $this->period->year;
       $data['main_view'] = 'main/main_view';
       
       // chart
       $data['archart'] = site_url()."/main/ar_chart/";
       $data['apchart'] = site_url()."/main/ap_chart/";
       
       // table
       $data['salestable'] = $this->get_ar_list();
       
       $this->load->view('template', $data);

    }
    
    private function get_min_product()
    {
        $val = $this->Main_model->get_min_product()->result();
        
        $tmpl = array ('table_open'          => '<table class="table table-striped jambo_table bulk_action">',
                       'heading_row_start'   => '<tr class="headings">'
              );
        
        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Code', 'Name', 'Qty', 'Cur');
        $i = 0;
        foreach ($val as $sales)
        { $this->table->add_row ( ++$i, $sales->sku, strtoupper($sales->name), $sales->qty.' '.$sales->unit, strtoupper($sales->currency)); }
        $table = $this->table->generate();
        return $table;
    }
    
    private function get_check_out()
    {
        $val = $this->Main_model->checkout('ap_payment')->result();

        $tmpl = array ('table_open'          => '<table class="table table-striped jambo_table bulk_action">',
                       'heading_row_start'   => '<tr class="headings">'
              );
        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Code', 'Check-No', 'Cur', 'Date', 'Due', 'Balance');
        $i = 0;
        foreach ($val as $sales)
        { $this->table->add_row ( ++$i, 'CR-00'.$sales->no, $sales->check_no, $sales->currency, tglin($sales->dates), tglin($sales->due), idr_format($sales->amount) ); }
        $table = $this->table->generate();
        return $table;

    }
    
    private function get_check_in()
    {
        $val = $this->Main_model->checkin()->result();

         $tmpl = array ('table_open'          => '<table class="table table-striped jambo_table bulk_action">',
                       'heading_row_start'   => '<tr class="headings">'
              );
        
        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Code', 'Check-No', 'Cur', 'Date', 'Due', 'Balance');
        $i = 0;
        foreach ($val as $sales)
        { $this->table->add_row ( ++$i, 'CR-00'.$sales->no, $sales->check_no, $sales->currency, tglin($sales->dates), tglin($sales->due), idr_format($sales->amount) ); }
        $table = $this->table->generate();
        return $table;

    }
    
    private function get_ar_list()
    {
        $val = $this->Main_model->get_ar_list()->result();

        $tmpl = array ('table_open'          => '<table class="table table-striped jambo_table bulk_action">',
                       'heading_row_start'   => '<tr class="headings">'
              );
        
        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Code', 'Date', 'Customer', 'Balance');
        $i = 0;
        foreach ($val as $sales)
        {
            $this->table->add_row ( ++$i, 'SO-0'.$sales->id,  tglin($sales->dates), $this->customer->get_name($sales->cust_id), idr_format($sales->amount) ); 
        }
        $table = $this->table->generate();
        return $table;

    }
    
    private function get_ap_list()
    {
        $val = $this->Main_model->get_ap_list()->result();

        $tmpl = array ('table_open'          => '<table class="table table-striped jambo_table bulk_action">',
                       'heading_row_start'   => '<tr class="headings">'
              );
        
        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Code', 'Date', 'Vendor', 'Balance');
        $i = 0;
        foreach ($val as $sales)
        { $this->table->add_row ( ++$i, 'PO-0'.$sales->no,  tglin($sales->dates), $this->vendor->get_vendor_name($sales->vendor), idr_format($sales->p2) ); }
        $table = $this->table->generate();
        return $table;

    }
    
    function ar_chart()
    {        
        $val1 = $this->Main_model->get_last_ar_between(30,0)->row_array();
        $val2 = $this->Main_model->get_last_ar_between(60,30)->row_array();
        $val3 = $this->Main_model->get_last_ar_between(90,60)->row_array();
        $val4 = $this->Main_model->get_last_ar(90)->row_array();
        
        $data = array(
                    array(
                        "label" => "0 - 30 Day",
                        "y" => $val1['amount']
                    ),
                    array(
                        "label" => "30 - 60 Day",
                        "y" => $val2['amount']
                    ),
                    array(
                        "label" => "60 - 90 Day",
                        "y" => $val3['amount']
                    ),
                    array(
                        "label" => "> 90 Day",
                        "y" => $val4['amount']
                    )
                );
       echo json_encode($data, JSON_NUMERIC_CHECK);
    }
    
    function ap_chart()
    {        
        $val1 = $this->Main_model->get_last_ap_between(30,0)->row_array();
        $val2 = $this->Main_model->get_last_ap_between(60,30)->row_array();
        $val3 = $this->Main_model->get_last_ap_between(90,60)->row_array();
        $val4 = $this->Main_model->get_last_ap(90)->row_array();
        
        $data = array(
                    array(
                        "label" => "0 - 30 Day",
                        "y" => $val1['total']
                    ),
                    array(
                        "label" => "30 - 60 Day",
                        "y" => $val2['total']
                    ),
                    array(
                        "label" => "60 - 90 Day",
                        "y" => $val3['total']
                    ),
                    array(
                        "label" => "> 90 Day",
                        "y" => $val4['total']
                    )
                );
       echo json_encode($data, JSON_NUMERIC_CHECK);
    }

    function article()
    {
       otentikasi1($this->title);
       $property = $this->Property_model->get_last_propery()->row();
       $data['name'] = $property->name;
       $data['title'] = propertyname('Article');
       $data['h2title'] = "Article Panel";

       $data['waktu'] = tgleng(date('Y-m-d')).' - '.waktuindo().' WIB';
       $data['main_view'] = 'main/article';
       $this->load->view('template', $data);
    }
    
    // ====================================== CLOSING ======================================
    function reset_process(){ }
    
}

?>