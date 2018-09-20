<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendor_lib extends Custom_Model {

    public function __construct($deleted=NULL)
    {
        $this->deleted = $deleted;
        $this->tableName = 'vendor';
    }

    protected $field = array('id', 'prefix', 'name', 'type', 'cp1', 'npwp', 'address', 'shipping_address', 'phone1', 'phone2',
                             'fax', 'hp', 'email', 'website', 'city', 'zip', 'notes', 'status', 'acc_name', 'acc_no', 'bank', 
                             'created', 'updated', 'deleted');
    
    function valid_vendor($name=null)
    {
        $this->db->select('name');
        $this->db->where('name', $name);
        $val = $this->db->get($this->tableName)->num_rows();
        if ($val > 0){return TRUE;} else{ return FALSE; }
    }
    
    function get_detail($id)
    {
       $this->db->select($this->field);
       $this->db->where('id', $id);
       return $this->db->get($this->tableName)->row();
    }
    
    function get_vendor_id($name=null)
    {
        if ($name != null)
        {
            $this->db->select('id,name');
            $this->db->where('name', $name);
            $val = $this->db->get($this->tableName)->row();
            return $val->id;
        }
        else { return null; }
    }

    function get_vendor_shortname($id=null)
    {
        if ($id)
        {
             $this->db->select('id,name,prefix');
            $this->db->where('id', $id);
            $val = $this->db->get($this->tableName)->row();
            return $val->name;
        }
        else { return null; }
    }

    function get_vendor_name($id=null)
    {
        if ($id)
        {
             $this->db->select('id,name,prefix');
            $this->db->where('id', $id);
            $val = $this->db->get($this->tableName)->row();
            if ($val){ return $val->prefix.' '.$val->name; }
            else{ return null; }
            
        }
        else { return null; }
    }

    function combo()
    {
        $data = null;
        $this->db->select('id, name');
        $this->db->where('deleted', $this->deleted);
        $this->db->where('status', 1);
        $val = $this->db->get($this->tableName)->result();
        if ($val){
          foreach($val as $row){$data['options'][$row->id] = $row->name;}
        }
        else{ $data['options'][''] = '--'; }
        return $data;
    }

    function combo_all()
    {
        $this->db->select('id, name');
        $this->db->where('deleted', $this->deleted);
        $this->db->where('status', 1);
        $val = $this->db->get($this->tableName)->result();
        $data['options'][''] = '-- All --';
        foreach($val as $row){$data['options'][$row->id] = $row->name;}
        return $data;
    }

    function get_vendor_bank($vid)
    {
        $this->db->select('acc_name, acc_no, bank');
        $this->db->where('id', $vid);
        $val = $this->db->get($this->tableName)->row();
        return $val->acc_name.' / '.$val->acc_no.' - '.$val->bank;
    }


}

/* End of file Property.php */