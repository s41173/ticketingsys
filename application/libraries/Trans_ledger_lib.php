<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trans_ledger_lib {

    public function __construct()
    {
        $this->ci = & get_instance();
    }

    private $ci;
    private $table = 'trans_ledger';


    private function cek($code, $no, $cur, $date, $type)
    {
//       $this->ci->db->where('acc', $acc);
       $this->ci->db->where('dates', $date);
       $this->ci->db->where('code', $code);
       $this->ci->db->where('no', $no);
       $this->ci->db->where('currency', $cur);
       $this->ci->db->where('type', $type);
       $res = $this->ci->db->get($this->table)->num_rows();
       if ($res > 0){ return FALSE; }else { return TRUE; }
    }
    
    function add($acc, $code, $no, $cur='IDR', $date, $debit=0, $credit=0, $cust, $type='AR')
    {  
        if ($this->cek($code, $no, $cur, $date, $type) == TRUE)
        {
          $vamount = intval($debit-$credit);
          $trans = array('acc' => $acc, 'code' => $code, 'no' => $no, 'currency' => $cur, 'dates' => $date, 'type' => $type, 
                         'debit' => intval($debit), 'credit' => intval($credit), 'vamount' => $vamount, 'customer_id' => $cust);
          $this->ci->db->insert($this->table, $trans); 
        }
        else { $this->edit($acc, $code, $no, $cur, $date, $debit, $credit, $cust, $type); }   
    }
    
    private function edit($acc, $code, $no, $cur, $date, $debit=0, $credit=0, $cust, $type)
    {   
        $id = $this->get_id($acc, $code, $no, $cur, $date);
        
        $vamount = intval($debit-$credit);
        $trans = array('acc' => $acc, 'code' => $code, 'no' => $no, 'currency' => $cur, 'dates' => $date, 'debit' => $debit, 'credit' => $credit, 
                       'type' => $type, 'vamount' => $vamount, 'customer_id' => $cust);
        $this->ci->db->where('id', $id);
        $this->ci->db->update($this->table, $trans);
    }
    
    private function get_id($acc, $code, $no, $cur='IDR', $date)
    {
//       $this->ci->db->where('acc', $acc);
       $this->ci->db->where('dates', $date);
       $this->ci->db->where('code', $code);
       $this->ci->db->where('no', $no);
       $this->ci->db->where('currency', $cur);
       $res = $this->ci->db->get($this->table)->row();
       return $res->id;
    }

//    ============================  remove transaction journal ==============================

    function remove($dates,$codetrans,$no)
    {
        // ============ update transaction ===================
        $this->ci->db->where('dates', $dates);
        $this->ci->db->where('code', $codetrans);
        $this->ci->db->where('no', $no);
        $this->ci->db->delete($this->table);
        // ====================================================
    }
    
    private function cek_null($val,$field)
    {
        if ($val == ""){return null;}
        else {return $this->ci->db->where($field, $val);}
    }
      
    function get_transaction($acc, $cur, $start,$end, $cust, $type, $trans=null)
    {
        $this->ci->db->select('id, code, no, acc, currency, dates, debit, credit, vamount');
        
        if ($trans=='SO')
        {
          $this->ci->db->where('code', 'SO');
          $this->ci->db->where('code', 'CR'); 
        }
        elseif ($trans == 'NSO')
        {
          $this->ci->db->where('code', 'NSO');
          $this->ci->db->where('code', 'NCR');   
        }
        
        $this->cek_null($acc, 'acc');
        $this->ci->db->where('currency', $cur);
        $this->ci->db->where('customer_id', $cust);
        $this->ci->db->where('type', $type);
        $this->ci->db->where("dates BETWEEN '".setnull($start)."' AND '".setnull($end)."'");
        $this->ci->db->order_by('dates','asc');
        $this->ci->db->order_by('id','asc');
        return $this->ci->db->get($this->table);
    }
    
    function get_sum_transaction_open_balance($acc,$cur,$start,$cust, $type, $trans=null)
    {
        $this->ci->db->select_sum('vamount');
        
        if ($trans=='SO')
        {
          $this->ci->db->where('code', 'SO');
          $this->ci->db->where('code', 'CR'); 
        }
        elseif ($trans == 'NSO')
        {
          $this->ci->db->where('code', 'NSO');
          $this->ci->db->where('code', 'NCR');   
        }
        
        $this->ci->db->where('acc', $acc);
        $this->ci->db->where('currency', $cur);
        $this->ci->db->where('customer_id', $cust);
        $this->ci->db->where('type', $type);
        $this->ci->db->where('dates <', $start);
        $res = $this->ci->db->get($this->table)->row_array();
        return intval($res['vamount']);
    }
     
     // closing function
    function get_sum_transaction_balance($acc, $cur, $start,$end,$cust,$type, $trans=null)
    {
        $this->ci->db->select_sum('debit');
        $this->ci->db->select_sum('credit');
        $this->ci->db->select_sum('vamount');
        
        if ($trans=='SO')
        {
          $this->ci->db->where('code', 'SO');
          $this->ci->db->where('code', 'CR'); 
        }
        elseif ($trans == 'NSO')
        {
          $this->ci->db->where('code', 'NSO');
          $this->ci->db->where('code', 'NCR');   
        }
        
        $this->ci->db->where('acc', $acc);
        $this->ci->db->where('currency', $cur);
        $this->ci->db->where('customer_id', $cust);
        $this->ci->db->where('type', $type);
        $this->ci->db->where("dates BETWEEN '".setnull($start)."' AND '".setnull($end)."'");
        $res = $this->ci->db->get($this->table)->row_array();
        return $res;
    }
    
    
    // AP report get
    
          
    function get_transaction_ap($acc=null, $cur, $start,$end, $cust, $type)
    {
        $this->ci->db->select('id, code, no, acc, currency, dates, debit, credit, vamount');
        $this->cek_null($acc, 'acc');
        
        $this->ci->db->where('currency', $cur);
        $this->ci->db->where('customer_id', $cust);
        $this->ci->db->where('type', $type);
        $this->ci->db->where("dates BETWEEN '".setnull($start)."' AND '".setnull($end)."'");
        $this->ci->db->order_by('dates','asc');
        $this->ci->db->order_by('id','asc');
        return $this->ci->db->get($this->table);
    }
    
    function get_sum_transaction_open_balance_ap($acc=null,$cur,$start,$cust, $type, $trans=null)
    {
        $this->ci->db->select_sum('vamount');
        
        $this->cek_null($acc, 'acc');
        $this->ci->db->where('currency', $cur);
        $this->ci->db->where('customer_id', $cust);
        $this->ci->db->where('type', $type);
        $this->ci->db->where('dates <', $start);
        $res = $this->ci->db->get($this->table)->row_array();
        return intval($res['vamount']);
    }
     
     // closing function
    function get_sum_transaction_balance_ap($acc, $cur, $start,$end,$cust,$type,$trans=null)
    {
        $this->ci->db->select_sum('debit');
        $this->ci->db->select_sum('credit');
        $this->ci->db->select_sum('vamount');
        
        if ($trans)
        {
          $this->ci->db->where('code', $trans);
          $this->ci->db->where('code', 'CD'); 
        }
        
        $this->cek_null($acc, 'acc');
        $this->ci->db->where('currency', $cur);
        $this->ci->db->where('customer_id', $cust);
        $this->ci->db->where('type', $type);
        $this->ci->db->where("dates BETWEEN '".setnull($start)."' AND '".setnull($end)."'");
        $res = $this->ci->db->get($this->table)->row_array();
        return $res;
    }
    

}

/* End of file Property.php */