<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Division_lib {

    public function __construct()
    {
        $this->ci = & get_instance();
    }

    private $ci;
    private $table = 'division';

    function combo()
    {
        $this->ci->db->select('id, name');
        $this->ci->db->order_by('name', 'asc');
        $val = $this->ci->db->get($this->table)->result();
        foreach($val as $row){$data['options'][$row->id] = strtoupper($row->name);}
        return $data;
    }

    function combo_all()
    {
        $this->ci->db->select('id, name');
        $val = $this->ci->db->get($this->table)->result();
        $data['options'][''] = '-- Division --';
        foreach($val as $row){$data['options'][$row->id] = strtoupper($row->name);}
        return $data;
    }
    
    function combo_name()
    {
        $this->ci->db->select('id, name');
        $val = $this->ci->db->get($this->table)->result();
        foreach($val as $row){$data['options'][strtoupper($row->name)] = strtoupper($row->name);}
        return $data;
    }
    
    function combo_name_all()
    {
        $this->ci->db->select('id, name');
        $val = $this->ci->db->get($this->table)->result();
        $data['options'][''] = '-- All --';
        foreach($val as $row){$data['options'][$row->name] = strtoupper($row->name);}
        return $data;
    }
    
    function get()
    {
       $this->ci->db->select('id,name'); 
       $this->ci->db->from($this->table);
       $this->ci->db->order_by('name', 'asc');
       return $this->ci->db->get()->result();
    }

    function get_name($id=null)
    {
        if ($id)
        {  
            $this->ci->db->select('name');
            $this->ci->db->from($this->table);
            $this->ci->db->where('id', $id);
            $res = $this->ci->db->get()->row();
            return strtoupper($res->name);
        }
        else { return 'non'; }
        
    }
    
    function get_id($name=null)
    {
        if ($name)
        {  
            $this->ci->db->select('id');
            $this->ci->db->from($this->table);
            $this->ci->db->where('name', $name);
            $res = $this->ci->db->get()->row();
            if ($res){ return strtoupper($res->id); }
        }
        else { return 'Non'; }
        
    }
        
    function get_salary_details($id=null)
    {
        $this->ci->db->select('basic_salary,consumption,transportation,overtime');
        $this->ci->db->from($this->table);
        $this->ci->db->where('id', $id);
        $res = $this->ci->db->get()->row();
        if($res){ return $res; }else{ return null; }
    }
    
    function cek_relation($id,$type)
    {
       $this->ci->db->where($type, $id);
       $query = $this->ci->db->get($this->table)->num_rows();
       if ($query > 0) { return FALSE; } else { return TRUE; }
    }


}

/* End of file Property.php */