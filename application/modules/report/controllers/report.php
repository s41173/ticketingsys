<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Ledger_model', 'lm', TRUE);
        $this->load->model('Account_model', 'am', TRUE);

        $this->properti = $this->property->get();
        $this->acl->otentikasi();

        $this->modul = $this->components->get(strtolower(get_class($this)));
        $this->title = strtolower(get_class($this));

        $this->currency   = $this->load->library('currency_lib');
        $this->user       = $this->load->library('admin_lib');
        $this->account    = $this->load->library('account_lib');

        $this->load->library('fusioncharts');
        $this->swfCharts  = base_url().'public/flash/Column3D.swf';
    }

    private $properti, $modul, $title, $currency, $account;
    private $user;

    function index()
    {
//        $this->start();
        redirect('main');
    }
    
    // profit & loss
    function profitloss()
    {
        $this->acl->otentikasi2($this->title);

        $data['title'] = $this->properti['name'].' | Administrator Report '.ucwords($this->modul['title']);
        $data['h2title'] = 'Profit & Loss Report '.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/profitloss_report');

        $ps = new Period();
        $ps->get();
        
        $data['currency'] = $this->currency->combo();
        $data['years'] = $ps->year;
        
        $this->load->view('profitloss_report_panel', $data);
    }
    
    function profitloss_report()
    {
        $month = $this->input->post('csmonth');
        $emonth = $this->input->post('cemonth');
        $year = $this->input->post('tsyear');
        $eyear = $this->input->post('teyear');
        $cur = $this->input->post('ccurrency');
        $data['company'] = '';
        $rtype = $this->input->post('ctype');
        $file = $this->input->post('cfile');
        
        $data['months']  = $month;
        $data['emonths'] = $emonth;
        $data['years'] = $year;
        $data['eyears'] = $eyear;
        $data['currency'] = $cur;
        
        $this->form_validation->set_rules('csmonth', 'Start Month', 'required|callback_valid_report');
        $this->form_validation->set_rules('cemonth', 'End Month', 'required|callback_valid_report');
        $this->form_validation->set_rules('tsyear', 'Start Year', 'required|numeric|callback_valid_report');
        $this->form_validation->set_rules('teyear', 'End Year', 'required|numeric|callback_valid_report');
        
        if ($this->form_validation->run($this) == TRUE)
        {
            $data['income'] = $this->am->get_account(16)->result(); // pendapatan usaha
            $data['outincome'] = $this->am->get_account(21)->result(); // Pendapatan Luar Usaha
            $data['frontincome'] = $this->am->get_account(37)->result(); // Pendapatan Usaha Lainnya

            $data['hpp'] = $this->am->get_account(15)->result(); // biaya usaha
            $data['operationalcost'] = $this->am->get_account(19)->result(); // Biaya adm / umum
            $data['nonoperationalcost'] = $this->am->get_account(24)->result(); // Biaya Non Operasional 
            $data['othercost'] = $this->am->get_account(17)->result(); // Biaya Usaha Lain
            $data['outcost'] = $this->am->get_account(25)->result();  // Pengeluaran Luar Usaha 
            
            $fname = null;
            if ($rtype == 0){ $fname = 'labarugi_standard'; }
            elseif ($rtype == 1){ $fname = 'labarugi_2kolom'; }
            elseif ($rtype == 2){ $fname = 'labarugi_4kolom'; }
            elseif ($rtype == 3){ $fname = 'labarugi_yeartodate'; }
            elseif ($rtype == 4){ $fname = 'labarugi_12kolom'; }
            elseif ($rtype == 5){ $fname = 'labarugi_budget'; } 
            
            
            if ($file == 0)
            {
               if ($rtype == 0){ $this->load->view($fname, $data); }
               elseif ($rtype == 1){ $this->load->view($fname, $data); }
               elseif ($rtype == 2){ $this->load->view($fname, $data); }
               elseif ($rtype == 3){ $this->load->view($fname, $data); }
               elseif ($rtype == 4){ $this->load->view($fname, $data); }
               elseif ($rtype == 5){ $this->load->view($fname, $data); } 
            }
            elseif ($file == 1)
            { 
                $data['file'] = $fname;
                $this->load->view('xls_converter',$data);
            }
            
        }
    }
    
    
    public function valid_report($val=null)
    {
        $smonth = $this->input->post('csmonth');
        $emonth = $this->input->post('cemonth');
        $syear = $this->input->post('tsyear');
        $eyear = $this->input->post('teyear');
        
        if ($syear > $eyear)
        {
           $this->form_validation->set_message('valid_report', "Invalid Year..!!");
           return FALSE;
        }
        else
        {
            if ($syear == $eyear) { if ($smonth > $emonth){ $this->form_validation->set_message('valid_report', "Invalid Month..!!"); return FALSE; }else { return TRUE; }}
            else { return TRUE; }
        }
    }
    
    // balance sheet
    
    function balance_sheet()
    {
        $this->acl->otentikasi2($this->title);

        $data['title'] = $this->properti['name'].' | Administrator Report '.ucwords($this->modul['title']);
        $data['h2title'] = 'Balance Sheet'.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/balance_sheet_report');

        $ps = new Period();
        $ps->get();
        
        $data['currency'] = $this->currency->combo();
        $data['years'] = $ps->year;
        
        $this->load->view('balancesheet_report_panel', $data);
    }
    
    function balance_sheet_report()
    {
        $month = $this->input->post('csmonth');
        $emonth = $this->input->post('cemonth');
        $year = $this->input->post('tsyear');
        $eyear = $this->input->post('teyear');
        $cur = $this->input->post('ccurrency');
        $data['company'] = $this->properti['name'];
        
        $data['months']  = $month;
        $data['emonths'] = $emonth;
        $data['years'] = $year;
        $data['eyears'] = $eyear;
        $data['currency'] = $cur;
        $rtype = $this->input->post('ctype');
        $file = $this->input->post('cfile');
        
        $this->form_validation->set_rules('csmonth', 'Start Month', 'required|callback_valid_report');
        $this->form_validation->set_rules('cemonth', 'End Month', 'required|callback_valid_report');
        $this->form_validation->set_rules('tsyear', 'Start Year', 'required|numeric|callback_valid_report');
        $this->form_validation->set_rules('teyear', 'End Year', 'required|numeric|callback_valid_report');
            
        if ($this->form_validation->run($this) == TRUE)
        {
                // harta
           $data['kas'] = $this->am->get_all_account(7)->result(); // kas
           $data['bank'] = $this->am->get_all_account(8)->result(); // Bank
           $data['piutangusaha'] = $this->am->get_all_account(20)->result(); // Piutang Usaha
           $data['piutangnonusaha'] = $this->am->get_all_account(27)->result(); // Piutang Non UsahaS
           $data['persediaan'] = $this->am->get_all_account(14)->result(); // Persediaan
           $data['biayadimuka'] = $this->am->get_all_account(13)->result(); // biayadimuka
           $data['investasi'] = $this->am->get_all_account(29)->result(); // Investasi Jangka Panjang
           $data['hartawujud'] = $this->am->get_all_account(26)->result(); // Harta Tetap Berwujud
           $data['hartatakwujud'] = $this->am->get_all_account(30)->result(); // Harta Tetap Tak Berwujud
           $data['hartalain'] = $this->am->get_all_account(31)->result(); // Harta Lain
           
           // kewajiban
           $data['hutangusaha'] = $this->am->get_all_account(10)->result(); // hutang usaha
           $data['pendapatandimuka'] = $this->am->get_all_account(34)->result(); // pendapatan dimuka
           $data['hutangpanjang'] = $this->am->get_all_account(35)->result(); // hutang jangka panjang
           $data['hutangnonusaha'] = $this->am->get_all_account(32)->result(); // hutang non usaha
           $data['hutanglain'] = $this->am->get_all_account(36)->result(); // hutanglain

           //modal
           $data['modal'] = $this->am->get_all_account(22)->result(); // modal
           $data['laba'] = $this->am->get_all_account(18)->result(); // laba
           
            $fname = null;
            if ($rtype == 0){ $fname = 'neraca_standard'; }
            elseif ($rtype == 1){ $fname = 'neraca_2kolom'; }
            elseif ($rtype == 2){ $fname = 'neraca_4kolom'; }
            elseif ($rtype == 3){ $fname = 'neraca_12kolom'; }
            elseif ($rtype == 4){ $fname = 'neraca_budget'; }
            
            
            if ($file == 0)
            {
               if ($rtype == 0){ $this->load->view($fname, $data); }
               elseif ($rtype == 1){ $this->load->view($fname, $data); }
               elseif ($rtype == 2){ $this->load->view($fname, $data); }
               elseif ($rtype == 3){ $this->load->view($fname, $data); }
               elseif ($rtype == 4){ $this->load->view($fname, $data); }
               elseif ($rtype == 5){ $this->load->view($fname, $data); } 
            }
            elseif ($file == 1)
            { 
                $data['file'] = $fname;
                $this->load->view('xls_converter',$data);
            }
        }
         
    }
    
    // balance sheet
    
    // trial balance
    function trial_balance()
    {
        $this->acl->otentikasi2($this->title);

        $data['title'] = $this->properti['name'].' | Administrator Report '.ucwords($this->modul['title']);
        $data['h2title'] = 'Balance Sheet'.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/trial_balance_report');

        $ps = new Period();
        $ps->get();
        
        $data['currency'] = $this->currency->combo();
        $data['years'] = $ps->year;
        
        $this->load->view('trial_balance_report_panel', $data);
    }
    
    function trial_balance_report()
    {
        $month = $this->input->post('csmonth');
        $emonth = $this->input->post('cemonth');
        $year = $this->input->post('tsyear');
        $eyear = $this->input->post('teyear');
        $cur = $this->input->post('ccurrency');
        $data['company'] = $this->properti['name'];
        $file = $this->input->post('cfile');
        
        $data['months']  = $month;
        $data['emonths'] = $emonth;
        $data['years'] = $year;
        $data['eyears'] = $eyear;
        $data['currency'] = $cur;
        
        $data['accounts'] = $this->am->get_all_account()->result();
        
        if ($file == 0)
        {
          $this->load->view('neraca_saldo', $data);  
        }
        elseif ($file == 1)
        { 
            $data['file'] = 'neraca_saldo';
            $this->load->view('xls_converter',$data);
        }
    }
    
    // trial balance
    
    // Cash flow
    function cash_flow()
    {
        $this->acl->otentikasi2($this->title);

        $data['title'] = $this->properti['name'].' | Administrator Report '.ucwords($this->modul['title']);
        $data['h2title'] = 'Cash Flow'.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/cash_flow_report');

        $ps = new Period();
        $ps->get();
        
        $data['currency'] = $this->currency->combo();
        $data['years'] = $ps->year;
        
        $this->load->view('cash_flow_report_panel', $data);
    }
    
    function cash_flow_report()
    {
        $start = $this->input->post('tstart');
        $end = $this->input->post('tend');
        $cur = $this->input->post('ccurrency');
        $data['company'] = $this->properti['name'];
        
        $data['start'] = $start;
        $data['end']   = $end;
        $data['period'] = tglin($start).' - '.tglin($end);
        $data['cur'] = $cur;
        $file = $this->input->post('cfile');
            
        // operating activities
        $data['piutangusaha'] = $this->am->get_cash_flow_acc($cur,20,$start,$end)->result();
        $data['piutangnonusaha'] = $this->am->get_cash_flow_acc($cur,27,$start,$end)->result();
        $data['persediaan'] = $this->am->get_cash_flow_acc($cur,14,$start,$end)->result();
        $data['hutangusaha'] = $this->am->get_cash_flow_acc($cur,10,$start,$end)->result();
        $data['pendapatanmuka'] = $this->am->get_cash_flow_acc($cur,34,$start,$end)->result();
        $data['pendapatanusaha'] = $this->am->get_cash_flow_acc($cur,16,$start,$end)->result();
        $data['pendapatanusahalain'] = $this->am->get_cash_flow_acc($cur,37,$start,$end)->result();
        $data['biayausaha'] = $this->am->get_cash_flow_acc($cur,15,$start,$end)->result();
        $data['biayausahalain'] = $this->am->get_cash_flow_acc($cur,17,$start,$end)->result();
        $data['biayaadm'] = $this->am->get_cash_flow_acc($cur,19,$start,$end)->result();
        // operating activities
        
        // investment activity
        $data['biayadimuka'] = $this->am->get_cash_flow_acc($cur,13,$start,$end)->result();
        $data['investasipanjang'] = $this->am->get_cash_flow_acc($cur,29,$start,$end)->result();
        $data['hartaberwujud'] = $this->am->get_cash_flow_acc($cur,26,$start,$end)->result();
        $data['hartatakberwujud'] = $this->am->get_cash_flow_acc($cur,30,$start,$end)->result();
        $data['hartalain'] = $this->am->get_cash_flow_acc($cur,31,$start,$end)->result();
        $data['biayanonoperasional'] = $this->am->get_cash_flow_acc($cur,24,$start,$end)->result();
        // investment activity
        
        // financing activity
        $data['hutangpanjang'] = $this->am->get_cash_flow_acc($cur,35,$start,$end)->result();
        $data['hutangnonusaha'] = $this->am->get_cash_flow_acc($cur,32,$start,$end)->result();
        $data['hutanglain'] = $this->am->get_cash_flow_acc($cur,36,$start,$end)->result();
        $data['modal'] = $this->am->get_cash_flow_acc($cur,22,$start,$end)->result();
        $data['laba'] = $this->am->get_cash_flow_acc($cur,18,$start,$end)->result();
        $data['pendapatanluarusaha'] = $this->am->get_cash_flow_acc($cur,21,$start,$end)->result();
        $data['pengeluaranluarusaha'] = $this->am->get_cash_flow_acc($cur,25,$start,$end)->result();
        // financing activity
         
        if ($file == 0)
        {
          $this->load->view('arus_kas', $data);  
        }
        elseif ($file == 1)
        { 
            $data['file'] = 'arus_kas';
            $this->load->view('xls_converter',$data);
        }
    } 
    
    // Cash flow
    
    function start()
    {
       $this->acl->otentikasi1($this->title);
       $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
       $data['h2title'] = $this->modul['title'];
       $data['main_view'] = 'ledger_view';
       $data['form_action'] = site_url($this->title.'/search');
       $data['form_action_graph'] = site_url($this->title.'/get_last_sales');
       $data['link'] = array('link_back' => anchor('main/','<span>back</span>', array('class' => 'back')));
       
       $data['currency'] = $this->currency->combo();
       
       $data['begin']    = 0;
       $data['end']      = 0;
       $data['mutation'] = 0;
       $data['debit']    = 0;
       $data['credit']   = 0;
       
       $this->load->view('template', $data);
    }
    
    function search()
    {
        $this->acl->otentikasi1($this->title);
        
        $acc   = $this->input->post('titem');
        $start = $this->input->post('tstart');
        $end   = $this->input->post('tend');

        $accname = null; if($acc){ $accname =  $this->account->get_name($this->account->get_id_code($acc)); }
        
        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'].' '.$accname;
        $data['main_view'] = 'ledger_view';
	$data['form_action'] = site_url($this->title.'/search');
        $data['form_action_graph'] = site_url($this->title.'/get_last_sales');
        $data['link'] = array('link_back' => anchor($this->title,'<span>back</span>', array('class' => 'back')));

        $data['currency'] = $this->currency->combo();
        if($acc){ $ledgers = $this->lm->get_ledger($this->account->get_id_code($acc),$start,$end)->result(); }
        else { $ledgers = null; }

        $atts = array('width'=> '800','height'=> '500',
                      'scrollbars' => 'yes','status'=> 'yes',
                      'resizable'=> 'yes','screenx'=> '0','screenx' => '\'+((parseInt(screen.width) - 800)/2)+\'',
                      'screeny'=> '0','class'=> 'print','title'=> 'print', 'screeny' => '\'+((parseInt(screen.height) - 500)/2)+\'');

        // library HTML table untuk membuat template table class zebra
        $tmpl = array('table_open' => '<table cellpadding="2" cellspacing="1" class="tablemaster">');

        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");

        //Set heading untuk table
        $this->table->set_heading('No', 'Code', 'Cur', 'Date', 'Notes', 'Debit', 'Credit', 'Action');

        $i = 0;
        if ($ledgers)
        {
            foreach ($ledgers as $ledger)
            {
                $datax = array('name'=> 'cek[]','id'=> 'cek'.$i,'value'=> $ledger->id,'checked'=> FALSE, 'style'=> 'margin:0px');

                $this->table->add_row
                (
                    ++$i, $ledger->code.'-00'.$ledger->no, $ledger->currency, tglin($ledger->dates), $this->cek_space($ledger->notes), number_format($ledger->debit), number_format($ledger->credit),
                    anchor('journalgl/add_trans/'.$ledger->no.'/'.$ledger->code,'<span>details</span>',array('class' => 'update', 'title' => '')).' '.
                    anchor_popup($this->title.'/voucher/'.$ledger->no,'<span>print</span>',$atts)
                );
            }

        $data['table'] = $this->table->generate();
        }
        // ===== chart  =======
        $data['graph'] = $this->chart($this->input->post('ccurrency'),$this->account->get_id_code($acc));
        
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

    function get($acc=null)
    {
        $this->acl->otentikasi1($this->title);

        $accname = null; if($acc){ $accname =  $this->account->get_name($this->account->get_id_code($acc)); }
        
        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'].' '.$accname;
        $data['main_view'] = 'ledger_view';
	$data['form_action'] = site_url($this->title.'/search');
        $data['form_action_graph'] = site_url($this->title.'/get_last_sales');
        $data['link'] = array('link_back' => anchor('accountc/','<span>back</span>', array('class' => 'back')));
        
        $ps = new Period();
        $ps->get();

        $data['currency'] = $this->currency->combo();
        if($acc){ $ledgers = $this->lm->get_monthly($this->account->get_id_code($acc),$ps->month,$ps->year)->result(); }
        else { $ledgers = null; }

        $atts = array('width'=> '800','height'=> '500',
                      'scrollbars' => 'yes','status'=> 'yes',
                      'resizable'=> 'yes','screenx'=> '0','screenx' => '\'+((parseInt(screen.width) - 800)/2)+\'',
                      'screeny'=> '0','class'=> 'print','title'=> 'print', 'screeny' => '\'+((parseInt(screen.height) - 500)/2)+\'');

        // library HTML table untuk membuat template table class zebra
        $tmpl = array('table_open' => '<table cellpadding="2" cellspacing="1" class="tablemaster">');

        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");

        //Set heading untuk table
        $this->table->set_heading('No', 'Code', 'Cur', 'Date', 'Notes', 'Debit', 'Credit', 'Action');

        $i = 0;
        if ($ledgers)
        {
            foreach ($ledgers as $ledger)
            {
                $datax = array('name'=> 'cek[]','id'=> 'cek'.$i,'value'=> $ledger->id,'checked'=> FALSE, 'style'=> 'margin:0px');

                $this->table->add_row
                (
                    ++$i, 'JT-00'.$ledger->no, $ledger->currency, tglin($ledger->dates), $this->cek_space($ledger->notes), number_format($ledger->debit), number_format($ledger->credit),
                    anchor('journalgl/add_trans/'.$ledger->no,'<span>details</span>',array('class' => 'update', 'title' => '')).' '.
                    anchor_popup($this->title.'/voucher/'.$ledger->no,'<span>print</span>',$atts)
                );
            }

        $data['table'] = $this->table->generate();
        }
        // ===== chart  =======
        $data['graph'] = $this->chart($this->input->post('ccurrency'),$this->account->get_id_code($acc));
        
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

    private function get_balance($acc=null)
    {
        $ps = new Period();
        $gl = new Gl();
        $bl = new Balance();
        $ps->get();
        
        $gl->where('approved', 1);
        $gl->where('MONTH(dates)', $ps->month);
        $gl->where('YEAR(dates)', $ps->year)->get();
        
        $bl->where('month', $ps->month);
        $bl->where('year', $ps->year);
        $bl->where('account_id', $acc)->get();
                
        $this->load->model('Account_model','am',TRUE);
        $val = $this->am->get_balance($acc,$ps->month,$ps->year)->row_array();
        
        $res[0] = $bl->beginning; //begin
        $res[1] = $bl->beginning + $val['vamount']; //end
        $res[2] = $val['vamount']; // mutation
        $res[3] = $val['debit']; // debit
        $res[4] = $val['credit']; // credit
        
        return $res;
        
    }
    
    // ====================================== CLOSING ======================================
    function reset_process(){ } 


}

?>