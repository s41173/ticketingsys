<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cost_lib extends Custom_Model {
    
    public function __construct($deleted=NULL)
    {
        $this->deleted = $deleted;
        $this->tableName = 'costs';
    }

    function combo()
    {
        $this->db->select('id, name, account_id');
        $this->db->order_by('name', 'asc');
        $this->db->where('deleted', $this->deleted);
        $val = $this->db->get($this->tableName)->result();
        foreach($val as $row){$data['options'][$row->id] = $row->name;}
        return $data;
    }

    function combo_all()
    {
        $this->ci->db->select('id, name, account_id');
        $this->db->where('deleted', $this->deleted);
        $val = $this->db->get($this->tableName)->result();
        $data['options'][''] = '-- All --';
        foreach($val as $row){$data['options'][$row->id] = $row->name;}
        return $data;
    }

    function get_name($id=null)
    {
        $this->db->select('name');
        $this->db->from($this->tableName);
        $this->db->where('id', $id);
        $res = $this->db->get()->row();
        return $res->name;
    }
    
    function get_acc($id=null)
    {
        $this->db->select('account_id');
        $this->db->from($this->tableName);
        $this->db->where('id', $id);
        $res = $this->db->get()->row();
        return $res->account_id;
    }
    
    function cek_relation($id,$type)
    {
       $this->db->where($type, $id);
       $this->db->where('deleted', $this->deleted);
       $query = $this->db->get($this->tableName)->num_rows();
       if ($query > 0) { return FALSE; } else { return TRUE; }
    }


}

/* End of file Property.php */