<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_trans_lib {

    public function __construct()
    {
        $this->ci = & get_instance();
        $this->journal = new Journalgl_lib();
        $this->loan_trans = new Loan_trans_lib();
    }

    private $ci,$journal,$loan_trans;
    private $table = 'payroll_trans';
    
    
    function cek_relation($id,$type)
    {
       $this->ci->db->where($type, $id);
       $query = $this->ci->db->get($this->table)->num_rows();
       if ($query > 0) { return FALSE; } else { return TRUE; }
    }
    
    function delete($pid)
    {
        $this->rollback_loan($pid);
        $this->ci->db->where('payroll_id', $pid);
        $this->ci->db->delete($this->table);
    }
    
    private function rollback_loan($pid)
    {
       $this->ci->db->select('id,dates,currency');
       $this->ci->db->from('payroll'); 
       $this->ci->db->where('id', $pid); 
       $val = $this->ci->db->get()->row();
        
       $this->ci->db->select('id,employee_id,loan');
       $this->ci->db->from($this->table); 
       $this->ci->db->where('payroll_id', $pid); 
       $result = $this->ci->db->get()->result();
       
       foreach ($result as $res) 
       {
        if ($res->loan > 0){ $this->loan_trans->remove($val->dates, $res->employee_id, $val->currency, $res->loan); }
       }
    }

    function cek_payroll($employee)
    {
        $this->ci->db->from($this->table);
        $this->ci->db->where('employee_id', $employee);
        $res = $this->ci->db->get()->num_rows();
        if($res > 0){ return FALSE; }else{ return TRUE;}
    }

    private function counter()
    {
        $this->ci->db->select_max('no');
        $test = $this->ci->db->get($this->table)->row_array();
        $userid=$test['no'];
	$userid = $userid+1;
	return $userid;
    }
    
    function get_salary_amount($pid=0, $division=null, $type=null)
    {
       $this->ci->db->select_sum('payroll_trans.basic_salary');
       $this->ci->db->select_sum('payroll_trans.experience');
       $this->ci->db->select_sum('payroll_trans.consumption');
       $this->ci->db->select_sum('payroll_trans.transportation');
       $this->ci->db->select_sum('payroll_trans.overtime');
       $this->ci->db->select_sum('payroll_trans.bonus');
       $this->ci->db->select_sum('payroll_trans.late');
       $this->ci->db->select_sum('payroll_trans.loan');
       $this->ci->db->select_sum('payroll_trans.tax');
       $this->ci->db->select_sum('payroll_trans.insurance');
       $this->ci->db->select_sum('payroll_trans.other_discount');
       $this->ci->db->select_sum('payroll_trans.amount');
        
       $this->ci->db->from('payroll_trans, employee, division');
       $this->ci->db->where('employee.id = payroll_trans.employee_id');
       $this->ci->db->where('division.id = employee.division_id');
       
       $this->ci->db->where('payroll_trans.payroll_id', $pid);
       $this->ci->db->where('division.id', $division);
       $this->cek_null($type, 'payroll_trans.type');
       return $this->ci->db->get(); 
    }
    
    function get_amount($pid=0,$dept=null,$type=null)
    {
       $this->ci->db->select_sum('basic_salary');
       $this->ci->db->select_sum('experience');
       $this->ci->db->select_sum('consumption');
       $this->ci->db->select_sum('transportation');
       $this->ci->db->select_sum('overtime');
       $this->ci->db->select_sum('bonus');
       $this->ci->db->select_sum('principal');
       $this->ci->db->select_sum('principal_helper');
       $this->ci->db->select_sum('head_department');
       $this->ci->db->select_sum('home_room');
       $this->ci->db->select_sum('picket');
       $this->ci->db->select_sum('late');
       $this->ci->db->select_sum('loan');
       $this->ci->db->select_sum('tax');
       $this->ci->db->select_sum('insurance');
       $this->ci->db->select_sum('other_discount');
       $this->ci->db->select_sum('amount');
       
       $this->ci->db->where('payroll_id', $pid);
       $this->cek_null($dept, 'dept');
       $this->cek_null($type, 'type');
       return $this->ci->db->get($this->table);
    }
 
    private function cek_null($val,$field)
    {
        if ($val == ""){return null;}
        else {return $this->ci->db->where($field, $val);}
    }

//  =======================  cek approval  =======================================

}

/* End of file Property.php */