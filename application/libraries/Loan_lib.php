<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loan_lib
{
    public function __construct()
    {
        $this->ci = & get_instance();
        $this->table = 'loan';
    }

    private $ci,$table;
    
    function cek_relation($id,$type)
    {
       $this->ci->db->where($type, $id);
       $query = $this->ci->db->get($this->table)->num_rows();
       if ($query > 0) { return FALSE; } else { return TRUE; }
    }
    
    function get($employee)
    {
        $this->ci->db->select_sum('amount');
        $this->ci->db->from($this->table);
        $this->ci->db->where('employee_id', $employee);
        $res = $this->ci->db->get()->row_array();
        if($res){ return $res['amount']; }else{ return 0;}
    }  
    
    function cek_loan($employee)
    {
        $this->ci->db->select_sum('amount');
        $this->ci->db->from($this->table);
        $this->ci->db->where('employee_id', $employee);
        $res = $this->ci->db->get()->row_array();
        if($res['amount']){ return FALSE; }else{ return TRUE;}
    }
    
    function change_loan($employee=0, $cur='IDR', $amount=0, $type="")
    { 
       $this->ci->db->select('amount'); 
       $this->ci->db->from($this->table);
       $this->ci->db->where('employee_id', $employee);
       $num = $this->ci->db->get()->num_rows();
       
       if ($num > 0){ $this->edit_loan($employee,$cur,$amount,$type); }
       else 
       { 
           $loan = array('employee_id' => $employee, 'amount' => $amount, 'currency' => $cur); 
           $this->ci->db->insert($this->table, $loan);
       }
    }
    
    private function edit_loan($employee=0, $cur='IDR', $amount=0, $type="")
    {
       $this->ci->db->select('amount'); 
       $this->ci->db->from($this->table);
       $this->ci->db->where('employee_id', $employee);
       $this->ci->db->where('currency', $cur);
       $res = $this->ci->db->get()->row();
       $res = $res->amount;
       
       if ($type == 'borrow'){ $balance = intval($res + $amount); }
       elseif ($type == 'paid'){ $balance = intval($res - $amount); }
       
       $trans = array('amount' => $balance);
       $this->ci->db->where('employee_id', $employee);
       $this->ci->db->where('currency', $cur);
       $this->ci->db->update($this->table, $trans);
    }
    
}


/* End of file Property.php */