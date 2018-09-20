<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Experience_lib
{
    public function __construct()
    {
        $this->ci = & get_instance();
        $this->table = 'experience_bonus';
    }

    private $ci,$table;
    
    function cek_relation($id,$type)
    {
       $this->ci->db->where($type, $id);
       $query = $this->ci->db->get($this->table)->num_rows();
       if ($query > 0) { return FALSE; } else { return TRUE; }
    }
    
    function count($employee)
    {
//        $this->ci->db->select('amount');
        $this->ci->db->from($this->table);
        $this->ci->db->where('employee_id', $employee);
        $res = $this->ci->db->get()->num_rows();
        return $res;
    }  
    
    function count_honor($employee,$dept)
    {
//        $this->ci->db->select('amount');
        $this->ci->db->from($this->table);
        $this->ci->db->where('employee_id', $employee);
        $this->ci->db->where('dept', $dept);
        $res = $this->ci->db->get()->num_rows();
        return $res;
    }  
    
    function get_amount($employee)
    {
        $this->ci->db->select('amount, consumption, transportation, bonus, principal, principal_helper, head_department,
                               home_room, picket, insurance');
        $this->ci->db->from($this->table);
        $this->ci->db->where('employee_id', $employee);
        $res = $this->ci->db->get()->row();
        if ($res){return $res;}else{return 0;}
    }    
    
    function get_honor_amount($employee,$dept)
    {
        $this->ci->db->select('amount, consumption, transportation, bonus, principal, principal_helper, head_department,
                               home_room, picket, insurance');
        $this->ci->db->from($this->table);
        $this->ci->db->where('employee_id', $employee);
        $this->ci->db->where('dept', $dept);
        $res = $this->ci->db->get()->row();
        if ($res){return $res;}else{return 0;}
    }    
    
}


/* End of file Property.php */