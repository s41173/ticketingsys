<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trans_ledger_lib extends Custom_Model {

    public function __construct($deleted=NULL)
    {
        $this->deleted = $deleted;
        $this->tableName = 'trans_ledger';
    }


    private function cek($code, $no, $cur, $date, $type)
    {
//       $this->db->where('acc', $acc);
       $this->db->where('dates', $date);
       $this->db->where('code', $code);
       $this->db->where('no', $no);
       $this->db->where('currency', $cur);
       $this->db->where('type', $type);
       $res = $this->db->get($this->tableName)->num_rows();
       if ($res > 0){ return FALSE; }else { return TRUE; }
    }
    
    function add($acc, $code, $no, $cur='IDR', $date, $debit=0, $credit=0, $cust, $type='AR')
    {  
        if ($this->cek($code, $no, $cur, $date, $type) == TRUE)
        {
          $vamount = intval($debit-$credit);
          $trans = array('acc' => $acc, 'code' => $code, 'no' => $no, 'currency' => $cur, 'dates' => $date, 'type' => $type, 
                         'debit' => intval($debit), 'credit' => intval($credit), 'vamount' => $vamount, 'customer_id' => $cust);
          $this->db->insert($this->tableName, $trans); 
        }
        else { $this->edit($acc, $code, $no, $cur, $date, $debit, $credit, $cust, $type); }   
    }
    
    private function edit($acc, $code, $no, $cur, $date, $debit=0, $credit=0, $cust, $type)
    {   
        $id = $this->get_id($acc, $code, $no, $cur, $date);
        
        $vamount = intval($debit-$credit);
        $trans = array('acc' => $acc, 'code' => $code, 'no' => $no, 'currency' => $cur, 'dates' => $date, 'debit' => $debit, 'credit' => $credit, 
                       'type' => $type, 'vamount' => $vamount, 'customer_id' => $cust);
        $this->db->where('id', $id);
        $this->db->update($this->tableName, $trans);
    }
    
    private function get_id($acc, $code, $no, $cur='IDR', $date)
    {
//       $this->db->where('acc', $acc);
       $this->db->where('dates', $date);
       $this->db->where('code', $code);
       $this->db->where('no', $no);
       $this->db->where('currency', $cur);
       $res = $this->db->get($this->tableName)->row();
       return $res->id;
    }

//    ============================  remove transaction journal ==============================

    function remove($dates,$codetrans,$no)
    {
        // ============ update transaction ===================
        $this->db->where('dates', $dates);
        $this->db->where('code', $codetrans);
        $this->db->where('no', $no);
        $this->db->delete($this->tableName);
        // ====================================================
    }
      
    function get_transaction($acc, $cur, $start,$end, $cust, $type, $trans=null)
    {
        $this->db->select('id, code, no, acc, currency, dates, debit, credit, vamount');
        
//        if ($trans=='SO')
//        {
//          $this->db->where('code', 'SO');
//          $this->db->where('code', 'CR'); 
//        }
        
        $this->cek_null($acc, 'acc');
        $this->db->where('currency', $cur);
        $this->db->where('customer_id', $cust);
        $this->db->where('type', $type);
        $this->db->where("dates BETWEEN '".setnull($start)."' AND '".setnull($end)."'");
        $this->db->order_by('dates','asc');
        $this->db->order_by('id','asc');
        return $this->db->get($this->tableName);
    }
    
    function get_sum_transaction_open_balance($acc,$cur,$start,$cust, $type, $trans=null)
    {
        $this->db->select_sum('vamount');
        
        if ($trans=='SO')
        {
          $this->db->where('code', 'SO');
          $this->db->where('code', 'CR'); 
        }
        
        $this->db->where('acc', $acc);
        $this->db->where('currency', $cur);
        $this->db->where('customer_id', $cust);
        $this->db->where('type', $type);
        $this->db->where('dates <', $start);
        $res = $this->db->get($this->tableName)->row_array();
        return intval($res['vamount']);
    }
     
     // closing function
    function get_sum_transaction_balance($acc, $cur, $start,$end,$cust,$type, $trans=null)
    {
        $this->db->select_sum('debit');
        $this->db->select_sum('credit');
        $this->db->select_sum('vamount');
        
//        if ($trans=='SO')
//        {
//          $this->db->where('code', 'SO');
//          $this->db->where('code', 'CR'); 
//        }
        
        $this->db->where('acc', $acc);
        $this->db->where('currency', $cur);
        $this->db->where('customer_id', $cust);
        $this->db->where('type', $type);
        $this->db->where("dates BETWEEN '".setnull($start)."' AND '".setnull($end)."'");
        $res = $this->db->get($this->tableName)->row_array();
        return $res;
    }
       
    // AP report get
    
    function get_transaction_ap($acc, $cur, $start,$end, $cust, $type, $trans='PO')
    {
        $this->db->select('id, code, no, acc, currency, dates, debit, credit, vamount');
        $this->cek_null($acc, 'acc');
        
//        if ($trans)
//        {
//          $this->db->where('code', $trans);
//          $this->db->where('code', 'CD'); 
//        }
        
        $this->db->where('currency', $cur);
        $this->db->where('customer_id', $cust);
        $this->db->where('type', $type);
        $this->db->where("dates BETWEEN '".setnull($start)."' AND '".setnull($end)."'");
        $this->db->order_by('dates','asc');
        $this->db->order_by('id','asc');
        return $this->db->get($this->tableName);
    }
    
    function get_sum_transaction_open_balance_ap($acc,$cur,$start,$cust, $type, $trans='PO')
    {
        $this->db->select_sum('vamount');
        
//        if ($trans)
//        {
//          $this->db->where('code', $trans);
//          $this->db->where('codes', 'CD'); 
//        }
        
        $this->db->where('acc', $acc);
        $this->db->where('currency', $cur);
        $this->db->where('customer_id', $cust);
        $this->db->where('type', $type);
        $this->db->where('dates <', $start);
        $res = $this->db->get($this->tableName)->row_array();
        return intval($res['vamount']);
    }
     
     // closing function
    function get_sum_transaction_balance_ap($acc, $cur, $start,$end,$cust,$type,$trans=null)
    {
        $this->db->select_sum('debit');
        $this->db->select_sum('credit');
        $this->db->select_sum('vamount');
        
        if ($trans)
        {
          $this->db->where('code', $trans);
          $this->db->where('code', 'CD'); 
        }
        
        $this->db->where('acc', $acc);
        $this->db->where('currency', $cur);
        $this->db->where('customer_id', $cust);
        $this->db->where('type', $type);
        $this->db->where("dates BETWEEN '".setnull($start)."' AND '".setnull($end)."'");
        $res = $this->db->get($this->tableName)->row_array();
        return $res;
    }
    

}

/* End of file Property.php */