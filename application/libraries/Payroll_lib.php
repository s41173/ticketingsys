<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_lib {

    public function __construct()
    {
        $this->ci = & get_instance();
        $this->journal = new Journalgl_lib();
    }

    private $ci,$journal;
    private $table = 'payroll';
    
    
    function delete($pid)
    {
        $this->ci->db->where('payroll_id', $pid);
        $this->ci->db->delete($this->table);
    }
    
    function get($pid)
    {
        if ($pid)
        {
           $this->ci->db->from($this->table);
           $this->ci->db->where('id', $pid);
           $res = $this->ci->db->get()->row();
           return $res;   
        }
    }

// fungso belum terpakai


    public function update_balance($id,$honor=0,$salary=0,$bonus=0,$consumption=0,$transport=0,$overtime=0,$late=0,$loan=0,$insurance=0,$tax=0,$other=0,$balance=0,$type=null)
    {
        $val = $this->ci->db->where('id', $id)->get($this->table)->row();
        
        if ($type == 'add')
        {
           $honor       = intval($val->total_honor + $honor); 
           $salary      = intval($val->total_salary + $salary);
           $bonus       = intval($val->total_bonus + $bonus);
           $consumption = intval($val->total_consumption + $consumption);
           $transport   = intval($val->total_transportation + $transport);
           $overtime    = intval($val->total_overtime + $overtime);
           $late        = intval($val->total_late + $late);
           $loan        = intval($val->total_loan + $loan);
           $insurance   = intval($val->total_insurance + $insurance);
           $tax         = intval($val->total_tax + $tax);
           $other       = intval($val->total_other + $other);
           $balance     = intval($val->balance + $balance);
        }
        else 
        {
           $honor       = intval($val->total_honor - $honor); 
           $salary      = intval($val->total_salary - $salary);
           $bonus       = intval($val->total_bonus - $bonus);
           $consumption = intval($val->total_consumption - $consumption);
           $transport   = intval($val->total_transportation - $transport);
           $overtime    = intval($val->total_overtime - $overtime);
           $late        = intval($val->total_late - $late);
           $loan        = intval($val->total_loan - $loan);
           $insurance   = intval($val->total_insurance - $insurance);
           $tax         = intval($val->total_tax - $tax);
           $other       = intval($val->total_other - $other);
           $balance     = intval($val->balance - $balance); 
        }
                
        $trans = array('total_honor' => $honor, 'total_salary' => $salary, 'total_bonus' => $bonus, 'total_consumption' => $consumption,
                       'total_transportation' => $transport, 'total_overtime' => $overtime,
                       'total_late' => $late, 'total_loan' => $loan, 'total_insurance' => $insurance,
                       'total_tax' => $tax, 'total_other' => $other, 'balance' => $balance
                      );
        $this->ci->db->where('id', $id);
        $this->ci->db->update($this->table, $trans);
        $this->cek_balance($id);
    }
    
    private function cek_balance($id)
    {
       $val = $this->ci->db->where('id', $id)->get($this->table)->row();
       
       $salary = intval($val->total_honor + $val->total_salary + $val->total_bonus + $val->total_consumption + $val->total_transportation +
                 $val->total_overtime);
       
       $loan = intval($val->total_late + $val->total_loan + $val->total_insurance + $val->total_tax + $val->total_other);
       $result = $salary - $loan;
       
       $trans = array('balance' => $result);
       $this->ci->db->where('id', $id);
       $this->ci->db->update($this->table, $trans);
    }

//  =======================  cek approval  =======================================

    function cek_approval($id)
    {
        $this->ci->db->where('id', $id);
        $val = $this->ci->db->get($this->table)->row();
        if ($val->approved == 1) { return FALSE; } else { return TRUE; }    
    }

    
    private function cek_null($val,$field)
    {
        if ($val == ""){return null;}
        else {return $this->ci->db->where($field, $val);}
    }

//  =======================  cek approval  =======================================

}

/* End of file Property.php */