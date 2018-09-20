<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cash_ledger_lib {

    public function __construct()
    {
        $this->ci = & get_instance();
//        $this->product = new Products_lib();
    }

    private $ci,$product;
    private $table = 'cash_ledger';


    private function cek($acc, $code, $cur, $date)
    {
//       $this->ci->db->where('acc', $acc);
       $this->ci->db->where('dates', $date);
       $this->ci->db->where('code', $code);
       $this->ci->db->where('currency', $cur);
       $res = $this->ci->db->get($this->table)->num_rows();
       if ($res > 0){ return FALSE; }else { return TRUE; }
    }
    
    function add($acc, $code, $cur='IDR', $date, $debit=0, $credit=0)
    {  
        if ($this->cek($acc,$code, $cur, $date) == TRUE)
        {
          $vamount = intval($debit-$credit);
          $trans = array('acc' => $acc, 'code' => $code, 'currency' => $cur, 'dates' => $date, 'debit' => $debit, 'credit' => $credit, 'vamount' => $vamount);
          $this->ci->db->insert($this->table, $trans); 
        }
        else { $this->edit($acc, $code, $cur, $date, $debit, $credit); }   
    }
    
    private function edit($acc, $code, $cur, $date, $debit=0, $credit=0)
    {   
        $id = $this->get_id($acc, $code, $cur, $date);
        
        $vamount = intval($debit-$credit);
        $trans = array('acc' => $acc, 'code' => $code, 'currency' => $cur, 'dates' => $date, 'debit' => $debit, 'credit' => $credit, 'vamount' => $vamount);
        $this->ci->db->where('id', $id);
        $this->ci->db->update($this->table, $trans);
    }
    
    private function get_id($acc, $code, $cur='IDR', $date)
    {
//       $this->ci->db->where('acc', $acc);
       $this->ci->db->where('dates', $date);
       $this->ci->db->where('code', $code);
       $this->ci->db->where('currency', $cur);
       $res = $this->ci->db->get($this->table)->row();
       return $res->id;
    }

//    ============================  remove transaction journal ==============================

    function remove($dates,$codetrans)
    {
        // ============ update transaction ===================
        $this->ci->db->where('dates', $dates);
        $this->ci->db->where('code', $codetrans);
        $this->ci->db->delete($this->table);
        // ====================================================
    }
      
    function get_transaction($acc, $cur, $start,$end)
    {
        $this->ci->db->select('id, code, acc, currency, dates, debit, credit, vamount');
        $this->ci->db->where('acc', $acc);
        $this->ci->db->where('currency', $cur);
        $this->ci->db->where("dates BETWEEN '".setnull($start)."' AND '".setnull($end)."'");
        $this->ci->db->order_by('dates','asc');
        $this->ci->db->order_by('id','asc');
        return $this->ci->db->get($this->table);
    }
    
    function get_sum_transaction_open_balance($acc,$cur,$start)
    {
        $this->ci->db->select_sum('vamount');
        $this->ci->db->where('acc', $acc);
        $this->ci->db->where('currency', $cur);
        $this->ci->db->where('dates <', $start);
        $res = $this->ci->db->get($this->table)->row_array();
        return intval($res['vamount']);
    }
     
     // closing function
    function get_sum_transaction_balance($acc, $cur, $start,$end)
    {
        $this->ci->db->select_sum('debit');
        $this->ci->db->select_sum('credit');
        $this->ci->db->select_sum('vamount');
        
        $this->ci->db->where('acc', $acc);
        $this->ci->db->where('currency', $cur);
        $this->ci->db->where("dates BETWEEN '".setnull($start)."' AND '".setnull($end)."'");
        $res = $this->ci->db->get($this->table)->row_array();
        return $res;
    }
    
    
    // closing function
    

}

/* End of file Property.php */