<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Closing extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Closing_model', '', TRUE);
        
        $this->properti = $this->property->get();
        $this->acl->otentikasi();
        $this->modul = $this->components->get(strtolower(get_class($this)));
        $this->title = strtolower(get_class($this));

        $this->load->library('currency_lib');
        $this->product = new Product_lib();
        $this->user = $this->load->library('admin_lib');
//        $this->sales = $this->load->library('sales');
        $this->journal = new Journalgl_lib();
        $this->component = new Components();
        $this->period = new Period();
        $this->period = $this->period->get();
        $this->balancelib = new Balance_account_lib();

    }

    private $atts = array('width'=> '800','height'=> '600',
                      'scrollbars' => 'yes','status'=> 'yes',
                      'resizable'=> 'yes','screenx'=> '0','screenx' => '\'+((parseInt(screen.width) - 800)/2)+\'',
                      'screeny'=> '0','class'=> 'print','title'=> 'print', 'screeny' => '\'+((parseInt(screen.height) - 600)/2)+\'');

    private $properti, $modul, $title, $component,$balancelib;
    private $user,$product,$sales,$journal,$period;

    function index()
    { 
        $this->closing_process();
    }
    
    private function closing_process()
    {
        $ps = new Period();
        $ps->get();
        if ($ps->month == $ps->closing_month){ $this->annual();}else { $this->monthly(); }
    }
    
    public function cek_component()
    {
        $result = $this->component->get_closing_aktif();
        $val=0;
        foreach ($result as $res)
        { if ($this->cek_closing_component($res->table) == 0){ $val = 0; break; }else { $val = 1; } }
        return $val;
    }
    
    private function cek_closing_component($table)
    {
       $month = $this->period->month;
       $year = $this->period->year;
       
       $this->db->where('approved', 0); 
       $this->db->where('MONTH(dates)', $month);
       $this->db->where('YEAR(dates)', $year);
       $val = $this->db->get($table)->num_rows();
       if (floatval($val) > 0){ return 0; }else{ return 1; }
    }
    

    function get_last_closing()
    {
        $this->acl->otentikasi1($this->title);

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'closing_view';
	$data['form_action'] = site_url($this->title.'/search');
        $data['link'] = array('link_back' => anchor('main/','<span>back</span>', array('class' => 'back')));
        
	$uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

	// ---------------------------------------- //
        $closings = $this->Closing_model->get_last_closing($this->modul['limit'], $offset)->result();
        $num_rows = $this->Closing_model->count_all_num_rows();

        if ($num_rows > 0)
        {
	    $config['base_url'] = site_url($this->title.'/get_last_closing');
            $config['total_rows'] = $num_rows;
            $config['per_page'] = $this->modul['limit'];
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();

            $tmpl = array('table_open' => '<table cellpadding="2" cellspacing="1" class="tablemaster">');

            $this->table->set_template($tmpl);
            $this->table->set_empty("&nbsp;");

            //Set heading untuk table
            $this->table->set_heading('No', 'Code', 'Date', 'Notes', 'Log');

            $i = 0 + $offset;
            foreach ($closings as $closing)
            {
                $datax = array('name'=> 'cek[]','id'=> 'cek'.$i,'value'=> $closing->id,'checked'=> FALSE, 'style'=> 'margin:0px');
                
                $this->table->add_row
                (++$i, 'CLO-00'.$closing->id, tgleng($closing->dates).' - '.$closing->times, $closing->notes, $closing->log);
            }
            $data['table'] = $this->table->generate();
        }
        else { $data['message'] = "No $this->title data was found!"; }

        // Load absen view dengan melewatkan var $data sbgai parameter
	$this->load->view('template', $data);
    }

    function search()
    {
        $this->acl->otentikasi1($this->title);

        $data['title'] = $this->properti['name'].' | Administrator Find '.ucwords($this->modul['title']);
        $data['h2title'] = 'Find '.$this->modul['title'];
        $data['main_view'] = 'closing_view';
	$data['form_action'] = site_url($this->title.'/search');
        $data['link'] = array('link_back' => anchor($this->title,'<span>back</span>', array('class' => 'back')));

        $closings = $this->Closing_model->search($this->input->post('tdate'))->result();
        
        $tmpl = array('table_open' => '<table cellpadding="2" cellspacing="1" class="tablemaster">');

        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");

        //Set heading untuk table
        $this->table->set_heading('No', 'Code', 'Date', 'Notes', 'Log');

        $i = 0;
        foreach ($closings as $closing)
        {
            $datax = array('name'=> 'cek[]','id'=> 'cek'.$i,'value'=> $closing->id,'checked'=> FALSE, 'style'=> 'margin:0px');

            $this->table->add_row
            (++$i, 'CLO-00'.$closing->id, tgleng($closing->dates).' - '.$closing->times, $closing->notes, $closing->log);
        }

        $data['table'] = $this->table->generate();
        $this->load->view('template', $data);
    }

    function calculate($page=null)
    {
        $this->load->model('Account_model', 'am', TRUE);
        
        $accounts = new Accounts();
        $ps = new Period();
        $bl = new Balances();
        $accounts->get();
        $ps->get();
        
        $res = null;
        $next = $this->next_period();  
        
        foreach ($accounts as $account)
        {    
           // tambahkan sebuah fungsi untuk hitung laba tahun berjalan 
//           if ($account->id == 21 || $account->id == 22)
//           {

            $res_trans = $this->am->get_balance($account->id,$ps->month,$ps->year)->row_array(); 
            $res_trans = floatval($res_trans['vamount']);

            $bl->where('month', $ps->month);
            $bl->where('year', $ps->year);
            $bl->where('account_id', $account->id)->get();
            $res1 = floatval($bl->beginning + $res_trans + $bl->vamount);

            $this->balancelib->create($account->id, $ps->month, $ps->year, floatval($bl->beginning), $res1); // create end saldo this month
            $this->balancelib->create($account->id, $next[0], $next[1], $res1, 0); // create beginning saldo next month
            $bl->clear();               
        }
        
        $this->session->set_flashdata('message', "Calculating Ending Balance Sucessed..!");
        redirect($page);    
    }
    
    function monthly()
    {
        $this->load->model('Account_model', 'am', TRUE);
        
        $accounts = new Accounts();
        $ps = new Period();
        $bl = new Balances();
        $accounts->get();
        $ps->get();
        
        $res = null;
        foreach ($accounts as $account)
        {    
            $next = $this->next_period();  

            $res_trans = $this->am->get_balance($account->id,$ps->month,$ps->year)->row_array(); 
            $res_trans = floatval($res_trans['vamount']);

            $bl->where('month', $ps->month);
            $bl->where('year', $ps->year);
            $bl->where('account_id', $account->id)->get();
            $res1 = floatval($bl->beginning + $bl->vamount + $res_trans);
//            $res1 = floatval($bl->beginning + $res_trans);

            $this->balancelib->create($account->id, $ps->month, $ps->year, floatval($bl->beginning), $res1); // create end saldo this month
            $this->balancelib->create($account->id, $next[0], $next[1], $res1, 0); // create beginning saldo next month
            $bl->clear();               
        }
        
        // update ledger stock
        $stock = new Stock_ledger_lib();
        $stock->closing();

//          update periode akuntansi
         $ps->month = $next[0];
         $ps->year = $next[1];
         $ps->save();

         $this->session->set_flashdata('message', "Monthly End Sucessed..!");
         redirect('main');    
    }
    
    private function next_period()
    {
        $ps = new Period();
        $ps = $ps->get();
        
        $month = $ps->month;
        $year = $ps->year;
        
        if ($month == 12){$nmonth = 1;}else { $nmonth = $month +1; }
        if ($month == 12){ $nyear = $year+1; }else{ $nyear = $year; }
        $res[0] = $nmonth; $res[1] = $nyear;
        return $res;
    }
    
    function annual()
    {
       $ps = new Period();
       $ps->get();
       if ($ps->month == $ps->closing_month){ $this->annual_process(); }
       else {$this->session->set_flashdata('message', "Annual Closing Rollback - Invalid Period..!");  } 
       redirect('main');
    }
    
    private function annual_process()
    {
        $this->load->model('Account_model', 'am', TRUE);
        
        $accounts = new Accounts();
        $ps = new Period();
        $bl = new Balances();
        $accounts->get();
        $ps->get();
        
        $res = null;
        foreach ($accounts as $account)
        {    
           if ($account->id == 21)
           {
              $bl = new Balances();
              $bl->where('month', $ps->month);
              $bl->where('year', $ps->year);
              $bl->where('account_id', $account->id)->get();
              
              $res_trans = $this->am->get_balance($account->id,$ps->month,$ps->year)->row_array(); 
              $res_trans = floatval($res_trans['vamount']);
              
              $res1 = $bl->beginning + $res_trans;
              
              // memindahkan saldo awal + vamount menjadi end saldo
              $this->balancelib->create($account->id, $ps->month, $ps->year, $bl->beginning, $res1);
              
              // memindai nilai laba tahun berjalan ke akun laba di tahan
              $bl->clear();
              $bl = new Balances();
              
              $next = $this->next_period();
              
              $bl->account_id = 22;
              $bl->beginning  = $res1;
              $bl->end        = 0;
              $bl->month      = $next[0];
              $bl->year       = $next[1];
              
              $this->balancelib->create(22, $next[0], $next[1], $res1, 0);
              
              // menset nilai akun bulan depan menjadi 0
              $bl->clear();
              $bl = new Balances();
              
              $bl->account_id = $account->id;
              $bl->beginning  = 0;
              $bl->end        = 0;
              $bl->month      = $next[0];
              $bl->year       = $next[1];
              
              $this->balancelib->create($account->id, $next[0], $next[1], 0, 0);
              
           } 
           elseif ($account->id != 21 && $account->id != 22)
           {
              $res = $this->am->get_balance($account->id,$ps->month,$ps->year)->row_array();

              $bl->where('month', $ps->month);
              $bl->where('year', $ps->year);
              $bl->where('account_id', $account->id)->get();
              $res = floatval($res['vamount']) + floatval($bl->beginning) + floatval($bl->vamount); // saldo akhir bulan ini

              // update end saldo bulan ini
//              $bl->end = $res;
//              $bl->save();
              
              $this->balancelib->create($account->id, $ps->month, $ps->year, $bl->beginning, $res); 

              // tambah nilai awal saldo bulan depan
              $bl->clear();
              $bl = new Balances();
              $bl->account_id = $account->id;
              $bl->beginning  = $res;
              $bl->end        = 0;
              $bl->month      = $next[0];
              $bl->year       = $next[1];
//              $bl->save();  
              
              $this->balancelib->create($account->id, $next[0], $next[1], $res, 0); 
           }
           
         }

          // closing jumlah siswa bulan ini
         
         // update ledger stock
          $stock = new Stock_ledger_lib();
          $stock->closing();

          // update periode akuntansi
          $ps->month = $next[0];
          $ps->year = $next[1];
          $ps->save();

          $this->session->set_flashdata('message', "Annual Closing Sucessed..!");
          redirect('main');
    }
    
                // ====================================== CLOSING ======================================
    function reset_process(){ $this->model->closing(); } 
    
}

?>
