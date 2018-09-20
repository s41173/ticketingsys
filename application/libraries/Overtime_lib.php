<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Overtime_lib
{
    public function __construct()
    {
        $this->ci = & get_instance();
        $this->table = 'overtime';
    }

    private $ci,$table;
    
    function cek_relation($id,$type)
    {
       $this->ci->db->where($type, $id);
       $query = $this->ci->db->get($this->table)->num_rows();
       if ($query > 0) { return FALSE; } else { return TRUE; }
    }
    
    function get_name($id)
    {
        if ($id)
        {
//            $this->ci->db->select('name');
            $this->ci->db->from($this->table);
            $this->ci->db->where('id', $id);
            $res = $this->ci->db->get()->row();
            return $res->first_title.' '.$res->name.' '.$res->end_title;
        }
    }
    
    
}


/* End of file Property.php */