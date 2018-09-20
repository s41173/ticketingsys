<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unit_lib extends Custom_Model {

    public function __construct($deleted=NULL)
    {
        $this->deleted = $deleted;
        $this->tableName = 'units';
    }

    function combo()
    {
        $this->db->select('id, name, code');
        $this->db->where('deleted', $this->deleted);
        $val = $this->db->get('units')->result();
        foreach($val as $row){$data['options'][$row->code] = $row->code;}
        return $data;
    }

    function combo_all()
    {
        $this->db->select('id, name, code');
        $this->db->where('deleted', $this->deleted);
        $val = $this->db->get('units')->result();
        $data['options'][''] = '-- All --';
        foreach($val as $row){$data['options'][$row->code] = $row->name;}
        return $data;
    }

    function get_code($name=null)
    {
        $this->db->select('code');
        $this->db->from('units');
        $this->db->where('name', $name);
        $res = $this->db->get()->row();
        return $res->code;
    }


}

/* End of file Property.php */