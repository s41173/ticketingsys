<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Honor_attendance_lib
{
    public function __construct()
    {
        $this->ci = & get_instance();
        $this->table = 'honor_absence';
    }

    private $ci,$table;
    
    function cek_relation($id,$type)
    {
       $this->ci->db->where($type, $id);
       $query = $this->ci->db->get($this->table)->num_rows();
       if ($query > 0) { return FALSE; } else { return TRUE; }
    }
    
    function get($employee=null,$dept=null,$hours=null,$time=null)
    {
//        $this->ci->db->select('hours');
        $this->ci->db->from($this->table);
        $this->cek_null($employee, 'employee_id');
        $this->cek_null($dept, 'dept');
        $this->cek_null($time, 'work_time');
        $this->cek_null($hours, 'hours');
        $res = $this->ci->db->get()->row();
        if ($res){return $res;}else {return null;}
    }   
    
    private function cek_null($val,$field)
    {
        if ($val == ""){return null;}
        else {return $this->ci->db->where($field, $val);}
    }
    
    function cek($employee,$dept,$hours,$time)
    {
        $this->ci->db->from($this->table);
        $this->cek_null($employee, 'employee_id');
        $this->cek_null($dept, 'dept');
        $this->cek_null($time, 'work_time');
        $this->cek_null($hours, 'hours');
        $res = $this->ci->db->get()->num_rows();
        return $res;
    } 
    
    function save($employee,$dept,$hours,$time)
    {
//        return $this->cek($employee, $dept, $hours, $time);
        if ($this->get($employee, $dept, $hours, $time) == 0)
        {
            $trans = array('employee_id' => $employee, 'dept' => $dept, 'hours' => $hours, 'work_time' => $time);
            $this->ci->db->insert($this->table, $trans);
        }
    }
    
}


/* End of file Property.php */