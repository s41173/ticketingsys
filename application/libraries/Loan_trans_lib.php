<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loan_trans_lib
{
    public function __construct()
    {
        $this->ci = & get_instance();
        $this->table = 'loan_trans';
        $this->loan = new Loan_lib();
    }

    private $ci,$table,$loan;
    
    function cek_relation($id,$type)
    {
       $this->ci->db->where($type, $id);
       $query = $this->ci->db->get($this->table)->num_rows();
       if ($query > 0) { return FALSE; } else { return TRUE; }
    }
    
    function get_by_employee($employee)
    {
        $this->ci->db->from($this->table);
        $this->ci->db->where('employee_id', $employee);
        $this->ci->db->order_by('dates', 'asc');
        return $this->ci->db->get()->result();
    }   
    
    function add($date,$employee,$cur,$amount,$type,$acc,$notes,$log)
    {
        $trans = array('dates' => $date, 'employee_id' => $employee, 'currency' => $cur,
                       'acc' => $acc, 'type' => $type, 'notes' => $notes, 
                       'amount' => $amount, 'log' => $log);
        
        $this->ci->db->insert($this->table, $trans);
        $this->loan->change_loan($employee,$cur,$amount,$type);
    }
    
    function remove($date,$employee,$cur,$amount)
    {
        $this->loan->change_loan($employee,$cur,$amount,'borrow');
        
        $this->ci->db->where('dates', $date);
        $this->ci->db->where('employee_id', $employee);
        $this->ci->db->where('currency', $cur);
        $this->ci->db->where('amount', $amount);
        $this->ci->db->delete($this->table);
    }
    
}


/* End of file Property.php */