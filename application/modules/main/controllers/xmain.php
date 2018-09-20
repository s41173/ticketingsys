<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Main_model', '', TRUE);
        
        $this->load->library('property');
        $this->customer = $this->load->library('customer_lib');
        $this->vendor = $this->load->library('vendor_lib');
        $this->load->library('user_agent');
        $this->properti = $this->property->get();

        $this->load->library('fusioncharts');
        $this->swfCharts  = base_url().'public/flash/Column3D.swf';

        $this->acl->otentikasi();
    }

    var $title = 'main';
    var $limit = null;
    private $properti,$vendor,$customer;

    function index()
    {       
       $this->main_panel();
    }

    private function get_ar_value($val1=null,$val2=null)
    {
        $val = $this->Main_model->get_last_ar_between($val1,$val2)->row_array();
        return $val['total'];
    }
    
    private function get_last_ar_value($val1=null)
    {
        $val = $this->Main_model->get_last_ar($val1)->row_array();
        return $val['total'];
    }

    private function get_ar_list()
    {
        $val = $this->Main_model->get_ar_list()->result();

        $tmpl = array('table_open' => '<table cellpadding="2" cellspacing="1" class="tablemaster">');
        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Code', 'Date', 'Customer', 'Balance');
        $i = 0;
        foreach ($val as $sales)
        {
            $this->table->add_row ( ++$i, 'SO-00'.$sales->no,  tglin($sales->dates), $this->customer->get_customer_name($sales->customer), number_format($sales->p2) ); 
        }
        $table = $this->table->generate();
        return $table;

    }

//    ------ purchase ----------------------------

    private function get_ap_value($val1=null,$val2=null)
    {
        $val = $this->Main_model->get_last_ap_between($val1,$val2)->row_array();
        return $val['total'];
    }

    private function get_last_ap_value($val1=null)
    {
        $val = $this->Main_model->get_last_ap($val1)->row_array();
        return $val['total'];
    }

    private function get_ap_list()
    {
        $val = $this->Main_model->get_ap_list()->result();

        $tmpl = array('table_open' => '<table cellpadding="2" cellspacing="1" class="tablemaster">');
        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Code', 'Date', 'Customer', 'Balance');
        $i = 0;
        foreach ($val as $sales)
        { $this->table->add_row ( ++$i, 'PO-00'.$sales->no,  tglin($sales->dates), $this->vendor->get_vendor_name($sales->vendor), number_format($sales->p2) ); }
        $table = $this->table->generate();
        return $table;

    }

    private function get_check_in()
    {
        $val = $this->Main_model->checkin()->result();

        $tmpl = array('table_open' => '<table cellpadding="2" cellspacing="1" class="tablemaster">');
        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Code', 'Check-No', 'Cur', 'Date', 'Due', 'Balance');
        $i = 0;
        foreach ($val as $sales)
        { $this->table->add_row ( ++$i, 'CR-00'.$sales->no, $sales->check_no, $sales->currency, tglin($sales->dates), tglin($sales->due), number_format($sales->amount) ); }
        $table = $this->table->generate();
        return $table;

    }

    private function get_check_out()
    {
        $val = $this->Main_model->checkout('ap_payment')->result();

        $tmpl = array('table_open' => '<table cellpadding="2" cellspacing="1" class="tablemaster">');
        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Code', 'Check-No', 'Cur', 'Date', 'Due', 'Balance');
        $i = 0;
        foreach ($val as $sales)
        { $this->table->add_row ( ++$i, 'CR-00'.$sales->no, $sales->check_no, $sales->currency, tglin($sales->dates), tglin($sales->due), number_format($sales->amount) ); }
        $table = $this->table->generate();
        return $table;

    }

    private function get_check_out_payment()
    {
        $val = $this->Main_model->checkout('ap_payment_cash')->result();

        $tmpl = array('table_open' => '<table cellpadding="2" cellspacing="1" class="tablemaster">');
        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Code', 'Check-No', 'Cur', 'Date', 'Due', 'Balance');
        $i = 0;
        foreach ($val as $sales)
        { $this->table->add_row ( ++$i, 'CR-00'.$sales->no, $sales->check_no, $sales->currency, tglin($sales->dates), tglin($sales->due), number_format($sales->amount) ); }
        $table = $this->table->generate();
        return $table;

    }

    private function get_min_product()
    {
        $val = $this->Main_model->get_min_product()->result();

        $tmpl = array('table_open' => '<table cellpadding="2" cellspacing="1" class="tablemaster">');
        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'Code', 'Name', 'Qty', 'Cur');
        $i = 0;
        foreach ($val as $sales)
        { $this->table->add_row ( ++$i, 'PRO-0'.$sales->id, $sales->name, $sales->qty.' '.$sales->unit, $sales->currency ); }
        $table = $this->table->generate();
        return $table;
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
       $data['main_view'] = 'main/main_view';

        $arrData[0][1] = '0 - 30 Day';
        $arrData[0][2] = $this->get_ar_value(30,0);

        $arrData[1][1] = '30 - 60 Day';
        $arrData[1][2] = $this->get_ar_value(60,30);

        $arrData[2][1] = '60 - 90 Day';
        $arrData[2][2] = $this->get_ar_value(90,60);
        
        $arrData[3][1] = '> 90 Day';
        $arrData[3][2] = $this->get_last_ar_value(90);

        $strXML        = $this->fusioncharts->setDataXML($arrData,'','') ;
        $data['graph'] = $this->fusioncharts->renderChart($this->swfCharts,'',$strXML,"Sales", 500, 275, false, false) ;
        $data['salestable'] = $this->get_ar_list();

        // purchase =============================================

        $arpData[0][1] = '0 - 30 Day';
        $arpData[0][2] = $this->get_ap_value(30,0);

        $arpData[1][1] = '30 - 60 Day';
        $arpData[1][2] = $this->get_ap_value(60,30);

        $arpData[2][1] = '60 - 90 Day';
        $arpData[2][2] = $this->get_ap_value(90,60);

        $arpData[3][1] = '> 90 Day';
        $arpData[3][2] = $this->get_last_ap_value(90);

        $strXML1        = $this->fusioncharts->setDataXML($arpData,'','') ;
        $data['graph1'] = $this->fusioncharts->renderChart($this->swfCharts,'',$strXML1,"Purchase", 500, 275, false, false) ;
        $data['purchasetable'] = $this->get_ap_list();

        // ============ check in ========================
        $data['checkintable'] = $this->get_check_in();

        // ============ check out ========================
        $data['checkouttable']        = $this->get_check_out();
        $data['checkouttablepayment'] = $this->get_check_out_payment();
        $data['producttable']         = $this->get_min_product();
        
        // period
        $ps = new Period();
        $ps = $ps->get();
        $data['month'] = get_month($ps->month);
        $data['year'] = $ps->year;

       $this->load->view('template', $data);

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
    
}

?>