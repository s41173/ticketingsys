<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ledger extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Ledger_model', 'Model', TRUE);
        
        $this->properti = $this->property->get();
        $this->acl->otentikasi();

        $this->modul = $this->components->get(strtolower(get_class($this)));
        $this->title = strtolower(get_class($this));

        $this->currency   = new Currency_lib();
        $this->user       = $this->load->library('admin_lib');
        $this->account    = new Account_lib();
        $this->period     = new Period_lib();
    }

    private $properti, $modul, $title, $currency, $account;
    private $user, $period;

    function index(){ $this->start(); }
    
    public function getdatatable($search=null,$class='null',$publish='null')
    {
        if(!$search){ $result = $this->Model->get_ledger(null,null,null)->result(); }
        else {$result = $this->Model->search($class,$publish)->result(); }
        
        if ($result){
	foreach($result as $res)
	{  
	   $output[] = array ($res->id, $this->classification->get_name($res->classification_id), $this->classification->get_type($res->classification_id), $res->currency, $res->code, $res->name, $res->alias, $res->acc_no,
                              $res->bank, $res->status, $res->default, $res->bank_stts);
	}
            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($output))
            ->_display();
            exit; 
        }
    }   
    
    function start()
    {
        $this->acl->otentikasi1($this->title);

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'ledger_view';
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_update'] = site_url($this->title.'/update_process');
        $data['form_action_del'] = site_url($this->title.'/delete_all');
        $data['form_action_report'] = site_url($this->title.'/report_process');
        $data['link'] = array('link_back' => anchor('main/','Back', array('class' => 'btn btn-danger')));
        
        $data['currency'] = $this->currency->combo();
	// ---------------------------------------- //
        
        $config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = "<li><span><b>";
        $config['cur_tag_close'] = "</b></span></li>";

        // library HTML table untuk membuat template table class zebra
        $tmpl = array('table_open' => '<table id="xdatatable-buttons" class="table table-striped table-bordered">');

        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");

        //Set heading untuk table
        $this->table->set_heading('#','No', 'Cur', 'Date', 'Notes', 'Debit', 'Credit', 'Action');

        $data['table'] = $this->table->generate();
        $data['source'] = site_url($this->title.'/getdatatable');
        $data['graph'] = "";
        
        $data['begin'] = 0;
        $data['end'] = 0;
        $data['mutation'] = 0;
        $data['debit'] = 0;
        $data['credit'] = 0;
            
        // Load absen view dengan melewatkan var $data sbgai parameter
	$this->load->view('template', $data);
    }
    
    function search()
    {
        $this->acl->otentikasi1($this->title);
        
        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'ledger_view';
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_update'] = site_url($this->title.'/update_process');
        $data['form_action_del'] = site_url($this->title.'/delete_all');
        $data['form_action_report'] = site_url($this->title.'/report_process');
        $data['link'] = array('link_back' => anchor($this->title,'Back', array('class' => 'btn btn-danger')));
        
        $data['currency'] = $this->currency->combo();
	// ---------------------------------------- //
        
        $config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = "<li><span><b>";
        $config['cur_tag_close'] = "</b></span></li>";
        
        $acc   = $this->input->post('taccount');
        $period = $this->input->post('reservation');  
        $start = picker_between_split($period, 0);
        $end = picker_between_split($period, 1);
        
        $accname = null; if($acc){ $accname = $this->account->get_name($this->account->get_id_code($acc)); }

        if($acc){ $ledgers = $this->Model->get_ledger($this->account->get_id_code($acc),$start,$end)->result(); }
        else { $ledgers = null; }

        $atts = array('width'=> '800','height'=> '500',
                      'scrollbars' => 'yes','status'=> 'yes',
                      'resizable'=> 'yes','screenx'=> '0','screenx' => '\'+((parseInt(screen.width) - 800)/2)+\'',
                      'screeny'=> '0','class'=> 'btn btn-primary btn-xs','title'=> 'print', 'screeny' => '\'+((parseInt(screen.height) - 500)/2)+\'');
        
        // library HTML table untuk membuat template table class zebra
        $tmpl = array('table_open' => '<table id="xdatatable-buttons" class="table table-striped table-bordered">');

        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");

        //Set heading untuk table
        $this->table->set_heading('#','No', 'Cur', 'Date', 'Notes', 'Debit', 'Credit', 'Action');

        $i = 0;
        if ($ledgers)
        {
            foreach ($ledgers as $ledger)
            {
                $datax = array('name'=> 'cek[]','id'=> 'cek'.$i,'value'=> $ledger->id,'checked'=> FALSE, 'style'=> 'margin:0px');

                $this->table->add_row
                (
                    ++$i, $ledger->code.'-00'.$ledger->no, $ledger->currency, tglin($ledger->dates), $this->cek_space($ledger->notes), number_format($ledger->debit), number_format($ledger->credit),
                    "<div class=\"btn-group\" role\"group\">".
                    anchor('journalgl/add_trans/'.$ledger->id,'<i class="fa fas-2x fa-book"> </i>',array('class' => 'btn btn-success btn-xs', 'title' => 'Details')).' '.
                    anchor_popup($this->title.'/voucher/'.$ledger->code.'/'.$ledger->no,'<i class="fa fas-2x fa-print"> </i>',$atts).
                    "</div>"    
                );
            }

           $data['table'] = $this->table->generate();
        }
        
        // ===== chart  =======
//        $data['graph'] = $this->chart($this->input->post('ccurrency'),$this->account->get_id_code($acc));
        $data['graph'] = site_url('ledger')."/chart/IDR/".$this->account->get_id_code($acc);
        $data['source'] = site_url($this->title.'/getdatatable');
        
        // balance
        $bl = $this->get_balance($this->account->get_id_code($acc));
        $data['begin'] = $bl[0];
        $data['end'] = $bl[1];
        $data['mutation'] = $bl[2];
        $data['debit'] = $bl[3];
        $data['credit'] = $bl[4];
        
        
        // Load absen view dengan melewatkan var $data sbgai parameter
	$this->load->view('template', $data);
    }

//    function get($acc=null)
//    {
//        $this->acl->otentikasi1($this->title);
//
//        $accname = null; if($acc){ $accname =  $this->account->get_name($this->account->get_id_code($acc)); }
//        
//        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
//        $data['h2title'] = $this->modul['title'].' '.$accname;
//        $data['main_view'] = 'ledger_view';
//	$data['form_action'] = site_url($this->title.'/search');
//        $data['form_action_graph'] = site_url($this->title.'/get_last_sales');
//        $data['link'] = array('link_back' => anchor('accountc/','<span>back</span>', array('class' => 'back')));
//        
//        $ps = new Period();
//        $ps->get();
//
//        $data['currency'] = $this->currency->combo();
//        if($acc){ $ledgers = $this->lm->get_monthly($this->account->get_id_code($acc),$ps->month,$ps->year)->result(); }
//        else { $ledgers = null; }
//
//        $atts = array('width'=> '800','height'=> '500',
//                      'scrollbars' => 'yes','status'=> 'yes',
//                      'resizable'=> 'yes','screenx'=> '0','screenx' => '\'+((parseInt(screen.width) - 800)/2)+\'',
//                      'screeny'=> '0','class'=> 'print','title'=> 'print', 'screeny' => '\'+((parseInt(screen.height) - 500)/2)+\'');
//
//        // library HTML table untuk membuat template table class zebra
//        $tmpl = array('table_open' => '<table cellpadding="2" cellspacing="1" class="tablemaster">');
//
//        $this->table->set_template($tmpl);
//        $this->table->set_empty("&nbsp;");
//
//        //Set heading untuk table
//        $this->table->set_heading('No', 'Code', 'Cur', 'Date', 'Notes', 'Debit', 'Credit', 'Action');
//
//        $i = 0;
//        if ($ledgers)
//        {
//            foreach ($ledgers as $ledger)
//            {
//                $datax = array('name'=> 'cek[]','id'=> 'cek'.$i,'value'=> $ledger->id,'checked'=> FALSE, 'style'=> 'margin:0px');
//
//                $this->table->add_row
//                (
//                    ++$i, $ledger->code.'-0'.$ledger->no, $ledger->currency, tglin($ledger->dates), $this->cek_space($ledger->notes), number_format($ledger->debit), number_format($ledger->credit),
//                    anchor('journalgl/add_trans/'.$ledger->no.'/'.$ledger->code,'<span>details</span>',array('class' => 'update', 'title' => '')).' '.
//                    anchor_popup($this->title.'/voucher/'.$ledger->code.'/'.$ledger->no,'<span>print</span>',$atts)
//                );
//            }
//
//        $data['table'] = $this->table->generate();
//        }
//        // ===== chart  =======
////        $data['graph'] = $this->chart($this->input->post('ccurrency'),$this->account->get_id_code($acc));
//        
//        // balance
//        $bl = $this->get_balance($this->account->get_id_code($acc));
//        $data['begin'] = $bl[0];
//        $data['end'] = $bl[1];
//        $data['mutation'] = $bl[2];
//        $data['debit'] = $bl[3];
//        $data['credit'] = $bl[4];
//        
//        // Load absen view dengan melewatkan var $data sbgai parameter
//	$this->load->view('template', $data);
//    }

    private function get_balance($acc=null)
    {
        $ps = $this->period->get();
        $bl = new Balance_account_lib();
        $bl = $bl->get($acc, $ps->month, $ps->year);
        
        if ($bl){ $begin = $bl->beginning; }else{ $begin = 0; }
                
        $this->load->model('Account_model','am',TRUE);
        $val = $this->am->get_balance($acc,$ps->month,$ps->year)->row_array();
//        
        $res[0] = idr_format(floatval($begin)); //begin
        $res[1] = idr_format(floatval($begin + $val['vamount'])); //end
        $res[2] = idr_format($val['vamount']); // mutation
        $res[3] = idr_format($val['debit']); // debit
        $res[4] = idr_format($val['credit']); // credit
        
        return $res;
    }
    
    public function chart($cur='IDR',$acc=null)
    {
        $ps = new Period();
        $gl = new Gl();
        $bl = new Balances();
        $ps->get();
        
        $gl = $this->Model->get_monthly($acc,$ps->month,$ps->year)->result();
        
        $bl->where('month', $ps->month);
        $bl->where('account_id', $acc);
        $bl->where('year', $ps->year)->get();
        
        $i=0; $j=1; $k=2;
        $result = $bl->beginning; 
        
        $datax = array();
        if ($gl){
          foreach ($gl as $value)
          {
            $res = $this->Model->get_balance($acc,$value->no)->row_array();
            $res[$i] = $result;
            
            $point = array("label" => tglshort($value->dates) , "y" => $result + floatval($res['vamount']));
            array_push($datax, $point);  
            
            $result = $res[$i];
            $i++;
          }
        }
        echo json_encode($datax, JSON_NUMERIC_CHECK);
    }

    private function cek_space($val)
    {  $res = explode("<br />",$val);  if (count($res) == 1) { return $val;  } else { return implode('', $res); } }

//    ===================== approval ===========================================

    public function valid_date($date)
    {
        $cur = $this->input->post('ccurrency');
        if ($this->journal->valid_journal($date,$cur) == FALSE)
        {
            $this->form_validation->set_message('valid_date', "Journal [ ".tgleng($date)." ] - ".$cur." already approved.!");
            return FALSE;
        }
        else {  return TRUE; }
    }

// ===================================== PRINT ===========================================

   function voucher($code=null,$no=0)
   {
       $this->acl->otentikasi2($this->title);

       $data['h2title'] = 'Print Voucher'.$this->modul['title'];
       
       $gl = new Gl();
       $gl->where('code',$code)->where('no',$no)->get();
       
       $data['code']    = $gl->no;
       $data['dates']  = $gl->dates;
       $data['currency']   = $gl->currency;
       $data['notes'] = $gl->notes;
       $data['log']   = $gl->log;
       $data['codetrans']   = $gl->code;
       $data['docno']   = $gl->docno;
       $data['balance']   = $gl->balance;
       $data['user'] = $this->session->userdata("username");
       
       $data['items'] = $gl->order_by('id', 'desc')->transaction->get();
       $data['account'] = $this->account; 
      // property display
       $data['p_name'] = $this->properti['name'];
       $data['logo'] = $this->properti['logo'];
       $data['paddress'] = $this->properti['address'];
       $data['p_phone1'] = $this->properti['phone1'];
       $data['p_phone2'] = $this->properti['phone2'];
       $data['p_city'] = ucfirst($this->properti['city']);
       $data['p_zip'] = $this->properti['zip'];
//       $data['p_npwp'] = $this->properti['npwp'];

       $this->load->view('ledger_voucher', $data);
       
   }

// ===================================== PRINT ===========================================

// ====================================== REPORT =========================================

    function report()
    {
        $this->acl->otentikasi2($this->title);

        $data['title'] = $this->properti['name'].' | Administrator Report '.ucwords($this->modul['title']);
        $data['h2title'] = 'Report '.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/report_process');
        $data['link'] = array('link_back' => anchor('sales/','<span>back</span>', array('class' => 'back')));

        $data['currency'] = $this->currency->combo();
        
        $this->load->view('ledger_report_panel_2', $data);
    }

    function report_process()
    {
        $this->acl->otentikasi2($this->title);
        $data['title'] = $this->properti['name'].' | Report '.ucwords($this->modul['title']);

        $cur = $this->input->post('ccurrency');
        $accstart = $this->input->post('taccstart');
        $accend   = $this->input->post('taccend');
        
        $period = $this->input->post('reservation');  
        $start = picker_between_split($period, 0);
        $end = picker_between_split($period, 1);

        $data['cur'] = $cur;
        $data['start'] = $start;
        $data['end'] = $end;
        $data['rundate'] = tgleng(date('Y-m-d'));
        $data['log'] = $this->session->userdata('log');

    //        Property Details
        $data['company'] = $this->properti['name'];
        $data['accounts'] = $this->Model->report($this->account->get_id_code($accstart),$this->account->get_id_code($accend))->result();

        $this->load->view('journal_invoice', $data);
        
    }

// ====================================== REPORT =========================================

    public function valid_part($part,$po)
    {
        if ($this->sinvoice->valid_part($part,$po) == FALSE)
        {
            $this->form_validation->set_message('valid_part', "Payment term already registered.!");
            return FALSE;
        }
        else {  return TRUE; }
    }
    
    // ====================================== CLOSING ======================================
    function reset_process(){ }


}

?>