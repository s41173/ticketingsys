<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Deposit extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Deposit_model', '', TRUE);

        $this->properti = $this->property->get();
        $this->acl->otentikasi();

        $this->modul = $this->components->get(strtolower(get_class($this)));
        $this->title = strtolower(get_class($this));

        $this->currency = new Currency_lib();
        $this->user = new Admin_lib();
        $this->journalgl = new Journalgl_lib();
        $this->account = new Account_lib();
        $this->load->library('terbilang');
        $this->airline = new Airline_lib();
    }

    private $properti, $modul, $title,$model,$ledger;
    private $user,$currency,$account,$journalgl,$airline;

    private  $atts = array('width'=> '800','height'=> '600',
                      'scrollbars' => 'yes','status'=> 'yes',
                      'resizable'=> 'yes','screenx'=> '0','screenx' => '\'+((parseInt(screen.width) - 800)/2)+\'',
                      'screeny'=> '0','class'=> 'print','title'=> 'print', 'screeny' => '\'+((parseInt(screen.height) - 600)/2)+\'');

    function index()
    {
       $this->get_last_deposit();
    }
    
    public function getdatatable($search=null,$airline='null')
    {
        if(!$search){ $result = $this->Deposit_model->get_last($this->modul['limit'])->result(); }
        else{ $result = $this->Deposit_model->search($airline)->result(); }
        
        if ($result){
	foreach($result as $res)
	{
	   $output[] = array ($res->id, tglin($res->dates), $this->airline->get_detail_field('code',$res->airline), $res->description, idr_format($res->amount), $res->approved, 
                              $this->account->get_code($res->account).' : '.$this->account->get_name($res->account) );
	}
            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($output))
            ->_display();
            exit; 
        }
    }
    
    function get_last_deposit()
    {
        $this->acl->otentikasi1($this->title);

        $data['title'] = $this->properti['name'].' | Administrator  '.ucwords($this->modul['title']);
        $data['h2title'] = $this->modul['title'];
        $data['main_view'] = 'deposit_view';
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_update'] = site_url($this->title.'/update_process');
        $data['form_action_del'] = site_url($this->title.'/delete_all');
        $data['form_action_report'] = site_url($this->title.'/report_process');
        $data['link'] = array('link_back' => anchor('main/','Back', array('class' => 'btn btn-danger')));
        
        $data['airline'] = $this->airline->combo_deposit();
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
        $this->table->set_heading('#','No', 'Date', 'Airline', 'Description', 'Amount', 'Acc', 'Action');

        $data['table'] = $this->table->generate();
        $data['source'] = site_url($this->title.'/getdatatable');
            
        // Load absen view dengan melewatkan var $data sbgai parameter
	$this->load->view('template', $data);
    }
    
    private function get_acc($acc)
    {
        return $this->account->get_code($acc).' : '.$this->account->get_name($acc);
    }

    function confirmation($pid)
    {
        if ($this->acl->otentikasi3($this->title,'ajax') == TRUE){
        $deposit = $this->Deposit_model->get_by_id($pid)->row();

        if ($deposit->approved == 1) { echo "warning|$this->title already approved..!"; }
        elseif ($deposit->amount == 0){ echo "error|$this->title has no value..!";  }
        elseif ($this->valid_period($deposit->dates) == FALSE ){ echo "error|$this->title has invalid period..!"; }
        else
        {
            try {      
                $deposit = $this->Deposit_model->get_by_id($pid)->row();
                $account  = $this->airline->get_detail_field('account', $deposit->airline);

                $this->journalgl->new_journal('0'.$pid, $deposit->dates, 'DA', 'IDR', 'Deposit : '.$this->airline->get_detail_field('name', $deposit->airline).'-'. tglincomplete($deposit->dates), $deposit->amount, $this->session->userdata('log'));
                $dpid = $this->journalgl->get_journal_id('DA','0'.$pid);

                $this->journalgl->add_trans($dpid,$account,$deposit->amount,0); // piutang ( debit )
                $this->journalgl->add_trans($dpid,$deposit->account,0,$deposit->amount); // kas, bank, kas kecil ( credit )

                $value = array('approved' => 1);
                $this->Deposit_model->update($pid, $value);
                echo "true|$this->title DA-0$pid confirmed..!";
            }
            catch(Exception $e) { echo "error|".$e->getMessage(); }
        }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }


//    ===================== approval ===========================================


    function delete($uid)
    {
        if ($this->acl->otentikasi_admin($this->title,'ajax') == TRUE){
        $val = $this->Deposit_model->get_by_id($uid)->row();

        if ( $this->valid_period($val->dates) == TRUE )
        {             
           if ($val->approved == 1)
           {
              $this->journalgl->remove_journal('DA', '0'.$uid);
              $value = array('approved' => 0);
              $this->Deposit_model->update($uid, $value);             
              echo "warning|1 $this->title successfully rollback..!";
           }
           else
           {
              $this->Deposit_model->delete($uid);
              echo "true|1 $this->title successfully soft removed..!";
           }
        }
        else{ echo "error|1 $this->title can't removed, invalid period..!"; } 
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }

    function add()
    {
        $this->acl->otentikasi2($this->title);

        $data['title'] = $this->properti['name'].' | Administrator '.ucwords($this->modul['title']);
        $data['h2title'] = 'Create New '.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/add_process');
        $data['form_action_item'] = site_url($this->title.'/add_item/');
        
        $data['currency'] = $this->currency->combo();
        $data['code'] = $this->counter();
        $data['user'] = $this->session->userdata("username");
        $data['account'] = $this->account->combo_asset();
        $data['customer'] = $this->customer->combo();
        
        $data['main_view'] = 'deposit_form';
        $data['source'] = site_url($this->title.'/getdatatable');
        $data['link'] = array('link_back' => anchor($this->title,'Back', array('class' => 'btn btn-danger')));
        
        $data['total'] = 0;
        $data['items'] = null;
        
        $this->load->view('template', $data);
    }
    

    function add_process()
    {
         if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){

	// Form validation
        $this->form_validation->set_rules('cairline', 'Airline', 'required');
        $this->form_validation->set_rules('tdates', 'Transaction Date', 'required|callback_valid_period');
        $this->form_validation->set_rules('tamount', 'Amount', 'required|numeric');
        $this->form_validation->set_rules('tdesc', 'Description', 'required');
        $this->form_validation->set_rules('titem', 'Account', 'required');

        if ($this->form_validation->run($this) == TRUE)
        {
            $deposit = array('dates' => $this->input->post('tdates'), 'airline' => $this->input->post('cairline'),
                             'amount' => $this->input->post('tamount'), 'description' => $this->input->post('tdesc'),
                             'account' => $this->account->get_id_code($this->input->post('titem')),
                             'created' => date('Y-m-d H:i:s'));
            
            $this->Deposit_model->add($deposit);
            echo 'true|'.$this->title.' successfully saved..!';
        }
        else{ echo "error|".validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }

    }

    function update($uid)
    {
        $acc = $this->Deposit_model->get_by_id($uid)->row();
        $this->session->set_userdata('langid', $acc->id);
        echo $acc->id.'|'.$acc->dates.'|'.$acc->airline.'|'.$acc->description.'|'.$acc->amount.'|'.$acc->approved.'|'. $this->account->get_code($acc->account);
    }
    
    // Fungsi update untuk mengupdate db
    function update_process()
    {
        if ($this->acl->otentikasi2($this->title,'ajax') == TRUE){

	// Form validation
        $this->form_validation->set_rules('cairline', 'Airline', 'required');
        $this->form_validation->set_rules('tdates', 'Transaction Date', 'required|callback_valid_period');
        $this->form_validation->set_rules('tamount', 'Amount', 'required|numeric');
        $this->form_validation->set_rules('tdesc', 'Description', 'required');
        $this->form_validation->set_rules('titem', 'Account', 'required');

        if ($this->form_validation->run($this) == TRUE && $this->valid_confirmation($this->session->userdata('langid')) == TRUE)
        {
            $deposit = array('dates' => $this->input->post('tdates'), 'airline' => $this->input->post('cairline'),
                             'account' => $this->account->get_id_code($this->input->post('titem')),
                             'amount' => $this->input->post('tamount'), 'description' => $this->input->post('tdesc'));

            $this->Deposit_model->update($this->session->userdata('langid'), $deposit);
            echo 'true|Data successfully saved..!';
        }
        elseif ($this->valid_confirmation($this->session->userdata('langid')) != TRUE){ echo "warning|Journal approved, can't deleted..!"; }
        else{ echo 'error|'.validation_errors(); }
        }else { echo "error|Sorry, you do not have the right to edit $this->title component..!"; }
    }


    public function valid_period($date=null)
    {
        $p = new Period();
        $p->get();

        $month = date('n', strtotime($date));
        $year = date('Y', strtotime($date));

        if ( intval($p->month) != intval($month) || intval($p->year) != intval($year) )
        {
            $this->form_validation->set_message('valid_period', "Invalid Period.!");
            return FALSE;
        }
        else {  return TRUE; }
    }

    public function valid_confirmation($id)
    {
        $val = $this->Deposit_model->get_by_id($id)->row();

        if ($val->approved == 1)
        {
            $this->form_validation->set_message('valid_confirmation', "Can't change value - Journal approved..!.!");
            return FALSE;
        }
        else {  return TRUE; }
    }

// ===================================== PRINT ===========================================

   function invoice($pid=null)
   {
       $this->acl->otentikasi2($this->title);
       $deposit = $this->Deposit_model->get_by_id($pid)->row();

       $data['h2title'] = 'Print Invoice'.$this->modul['title'];
       
       $data['p_name'] = $this->properti['name'];
       $data['pid'] = 'DA-0'.$pid;
       $data['date'] = tglin($deposit->dates);
       $data['airline'] = $this->airline->get_detail_field('code',$deposit->airline).' - '.$this->airline->get_detail_field('name',$deposit->airline);
       $data['description'] = $deposit->description;
       $data['amount'] = idr_format($deposit->amount);
       $data['account'] = $this->account->get_code($deposit->account).'-'.$this->account->get_name($deposit->account);
       
       if ($deposit->approved == 1){ $stts = 'Y'; }else{ $stts = 'N'; }
       $data['approved'] = $stts;
       $data['log'] = $this->session->userdata('log');
       
       $data['terbilang'] = $this->terbilang->baca($deposit->amount).' Rupiah';

       $this->load->view('deposit_invoice', $data);
   }
  
// ====================================== REPORT =========================================

    function report()
    {
        $this->acl->otentikasi2($this->title);

        $data['title'] = $this->properti['name'].' | Administrator Report '.ucwords($this->modul['title']);
        $data['h2title'] = 'Report '.$this->modul['title'];
	$data['form_action'] = site_url($this->title.'/report_process');
        $data['link'] = array('link_back' => anchor('journal/','<span>back</span>', array('class' => 'back')));

        $data['currency'] = $this->currency->combo();
        
        $this->load->view('deposit_report_panel', $data);
    }

    function report_process()
    {
        $this->acl->otentikasi2($this->title);
        $data['title'] = $this->properti['name'].' | Report '.ucwords($this->modul['title']);

        $period = $this->input->post('reservation');  
        $start = picker_between_split($period, 0);
        $end = picker_between_split($period, 1);

        $data['start'] = $start;
        $data['end'] = $end;
        $data['rundate'] = tglin(date('Y-m-d'));
        $data['log'] = $this->session->userdata('log');

//        Property Details
        $data['company'] = $this->properti['name'];
        $data['reports'] = $this->Deposit_model->report($start,$end)->result();
        
        $this->load->view('deposit_report', $data); 
        
    }

// ====================================== REPORT =========================================
    
}

?>