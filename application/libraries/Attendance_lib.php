<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attendance_lib
{
    public function __construct()
    {
        $this->ci = & get_instance();
        $this->table = 'attendance';
    }

    private $ci,$table;
    
    function cek_relation($id,$type)
    {
       $this->ci->db->where($type, $id);
       $query = $this->ci->db->get($this->table)->num_rows();
       if ($query > 0) { return FALSE; } else { return TRUE; }
    }
    
    function get($employee,$month,$year)
    {
        $this->ci->db->select('presence,late,overtime');
        $this->ci->db->from($this->table);
        $this->ci->db->where('employee_id', $employee);
        $this->ci->db->where('month', $month);
        $this->ci->db->where('year', $year);
        $res = $this->ci->db->get()->row();
        if ($res){return $res;}
    }  
    
    function save($employee,$month=0,$year=0,$presence=0,$late=0,$overtime=0,$log=0)
    {
        if (!$this->get($employee, $month, $year))
        {
            $trans = array('employee_id' => $employee, 'month' => $month, 'year' => $year,
                           'presence' => $presence, 'late' => $late, 'overtime' => $overtime, 'log' => $log);
        
            $this->ci->db->insert($this->table, $trans);
        }
    }
    
}


/* End of file Property.php */