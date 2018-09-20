<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_ledger_lib extends Custom_Model {
    
    public function __construct($deleted=NULL)
    {
        $this->tableName = 'stock_ledger';
        $this->wt = new Warehouse_transaction_lib();
        $this->ps = new Period_lib();
    }
    
    private $wt, $ps;
    protected $field = array('id', 'branch_id', 'product_id', 'month', 'year', 'open_qty', 'end_qty', 'open_balance', 'end_balance');

    
    function create($pid,$branch,$month=0,$year=0,$open_qty=0,$end_qty=0,$open_balance=0,$end_balance=0)
    {
       $this->db->where('product_id',$pid);
       $this->db->where('branch_id',$branch);
       $this->db->where('month',$month);
       $this->db->where('year',$year);
       $query = $this->db->get($this->tableName)->num_rows();
       
       if ($query == 0){ $this->fill($pid, $branch, $month, $year, $open_qty, $end_qty, $open_balance, $end_balance); }
       else{ $this->edit($pid, $branch, $month, $year, $open_qty, $end_qty, $open_balance, $end_balance); }
    }
    
    private function edit($pid,$branch,$month=0,$year=0,$begin=0,$end=0,$open_balance=0, $end_balance=0)
    {
       $trans = array('open_qty' => $begin, 'end_qty' => $end, 'open_balance' => $open_balance, 'end_balance' => $end_balance);
       $this->db->where('product_id', $pid);
       $this->db->where('branch_id', $branch);
       $this->db->where('month', $month);
       $this->db->where('year', $year);
       $this->db->update($this->tableName, $trans); 
    }
    
    function fill($pid,$branch,$month,$year,$begin=0,$end=0,$open_balance=0, $end_balance=0)
    {
       $this->db->where('product_id', $pid);
       $this->db->where('branch_id', $branch);
       $this->db->where('month', $month);
       $this->db->where('year', $year);
       $num = $this->db->get($this->tableName)->num_rows();
       
       if ($num == 0)
       {
          $trans = array('product_id' => $pid, 'branch_id' => $branch, 'month' => $month, 'year' => $year, 'open_qty' => $begin, 'end_qty' => $end, 'open_balance' => $open_balance, 'end_balance' => $end_balance);
          $this->db->insert($this->tableName, $trans); 
       }
    }
    
    function clean()
    {
        $this->db->where('open_qty', 0);
        $this->db->where('end_qty', 0);
        $this->db->delete($this->tableName);
    }

    function get_trans($pid,$branch=null,$month,$year,$type=null)
    {
       $this->db->where('product_id', $pid);
       $this->cek_null($branch, 'branch_id');
       $this->db->where('month', $month);
       $this->db->where('year', $year);
       $res = $this->db->get($this->tableName)->row();
       
       if ($res)
       {
         if ($type == 'openqty'){ return ($res->open_qty); }
         elseif ($type == 'endqty'){ return ($res->end_qty); } 
         elseif ($type == 'open_balance'){ return ($res->open_balance); } 
         elseif ($type == 'end_balance'){ return ($res->end_balance); } 
       }
       else { return 0; }
    }
    
    function get_trans_by_category($cat,$month,$year,$type=null)
    {
       $this->db->select_sum("open_qty"); 
       $this->db->select_sum("open_balance");
       $this->db->from("$this->table, product");
       $this->db->where($this->table.'.product_id = product.id');
//       $this->db->where('product.category', $cat);
       $this->cek_null($cat, 'product.category');
       $this->cek_null($month, 'month');
//       $this->db->where('month', $month);
       $this->db->where('year', $year);
       $res = $this->db->get();
       $res = $res->row_array();
       
       if ($type == 'openqty'){return intval($res['open_qty']); }
       elseif ($type == 'open_balance'){ return intval($res['open_balance']); }
    }
    
    function get_sum_trans($month,$year,$type=null)
    {
       $this->db->select_sum("open_qty"); 
       $this->db->select_sum("end_qty"); 
       $this->db->select_sum("open_balance"); 
       $this->db->select_sum("end_balance"); 
       $this->db->where('month', $month);
       $this->db->where('year', $year);
       $res = $this->db->get($this->tableName)->row_array();
       
       if ($res)
       {
         if ($type == 'openqty'){ return ($res['open_qty']); }
         elseif ($type == 'endqty'){ return ($res['end_qty']); } 
         elseif ($type == 'open_balance'){ return ($res['open_balance']); } 
         elseif ($type == 'end_balance'){ return ($res['end_balance']); } 
       }
       else { return 0; }
    }
    
    function get_qty($product,$branch=null,$month,$year)
    {
       $this->db->select($this->field); 
       $this->db->where('product_id', $product);
       $this->cek_null($branch, 'branch_id');
       $this->db->where('month', $month);
       $this->db->where('year', $year);
       $res = $this->db->get($this->tableName)->row();
              
       $trs = $this->wt->get_sum_transaction_qty($product, $branch, $month, $year);
       if ($res){ return intval($res->open_qty+$trs); }
       else { return intval($trs); }
    }
    
    function cek_month($month){ if ($month == 12) { return 1; }else { return $month+1; } }
    
    function cek_year($month,$year){ if ($month == 12){ return $year+1; }else{ return $year; }  }
    
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
    
    function closing()
    {
         // start transaction 
        $this->db->trans_start();
        
        $next = $this->next_period();
        $month = $this->ps->get('month');
        $year = $this->ps->get('year');
        $nextmonth = $next[0];
        $nextyear = $next[1];
        
        $transaction = $this->wt->get_monthly(null, null, $month, $year)->result();
        
        foreach ($transaction as $res)
        {
            $trans_qty = $this->wt->get_sum_transaction_qty($res->product_id,$res->branch_id,$month,$year);
            $trans_balance = floatval($this->wt->get_sum_transaction_balance($res->product_id, $res->branch_id, $month, $year,'debit')-$this->wt->get_sum_transaction_balance($res->id, $res->branch_id, $month,$year,'credit'));
            
            $openqty = $this->get_trans($res->product_id, $res->branch_id, $month, $year, 'openqty');
            $openbalance = $this->get_trans($res->product_id, $res->branch_id, $month, $year, 'open_balance');
            
            // edit end saldo bulan ini
            $this->create($res->product_id, $res->branch_id, $month, $year, $openqty, $openqty+$trans_qty, $openbalance, $openbalance+$trans_balance);
            
            // create saldo next month
            $this->create($res->product_id, $res->branch_id, $nextmonth, $nextyear, $openqty+$trans_qty, 0, $openbalance+$trans_balance, 0);
        }
        
        // fungsi lopping transledger yang end qty nya 0 pindahkan to next month
        $result = $this->get_zero_end_qty($month, $year)->result();
        
        foreach ($result as $res) {
            $openqty = $this->get_trans($res->product_id, $res->branch_id, $month, $year, 'openqty');
            $openbalance = $this->get_trans($res->product_id, $res->branch_id, $month, $year, 'open_balance');
            // create end saldo bulan ini
            $this->create($res->product_id, $res->branch_id, $month, $year, $openqty, $openqty, $openbalance, $openbalance);            
            
            // create saldo next month
            $this->create($res->product_id, $res->branch_id, $nextmonth, $nextyear, $openqty, 0, $openbalance, 0);
        }
        
        $this->db->trans_complete();
        if ($this->db->trans_status() == FALSE){  return FALSE; } else { return TRUE; }
    }
    
    private function get_zero_end_qty($month,$year)
    {
        $this->db->select($this->field);
        $this->db->where('month', $month);
        $this->db->where('year', $year);
        $this->db->where('end_qty', 0);
        return $this->db->get($this->tableName);
    }
    
    function edit_begin_saldo($product,$branch,$month,$year,$openqty,$openbalance)
    {  
       $this->db->where('product_id',$product);
       $this->db->where('branch_id', $branch);
       $this->db->where('month',$month);
       $this->db->where('year',$year);
       $query = $this->db->get($this->tableName)->num_rows(); 
       
       if ($query > 0)
       {
          $trans = array('open_qty' => $openqty, 'open_balance' => $openbalance);
          $this->db->where('product_id', $product);
          $this->db->where('branch_id', $branch);
          $this->db->where('month', $month);
          $this->db->where('year', $year);
          $this->db->update($this->tableName, $trans);   
       }
       else 
       { 
          $this->create($product, $branch, $month, $year); 
          
          $trans = array('open_qty' => $openqty, 'open_balance' => $openbalance);
          $this->db->where('product_id', $product);
          $this->db->where('branch_id', $branch);
          $this->db->where('month', $month);
          $this->db->where('year', $year);
          $this->db->update($this->tableName, $trans);   
       }
    }
}

/* End of file Property.php */