<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_lib extends Main_model {

    public function __construct($deleted=NULL)
    {
        $this->deleted = $deleted;
        $this->tableName = 'customer';
    }

    private $ci;
       
    function get_name($id=null)
    {
        if ($id)
        {
            $this->db->select('id,first_name,last_name');
            $this->db->where('id', $id);
            $val = $this->db->get($this->tableName)->row();
            if ($val){ return strtoupper($val->first_name.' '.$val->last_name); }
        }
        else if($id == 0){ return 'Top'; }
        else { return ''; }
    }
    
    function get_type($id=null)
    {
        if ($id)
        {
            $this->db->select('type');
            $this->db->where('id', $id);
            $val = $this->db->get($this->tableName)->row();
            if ($val){ return $val->type; }else { return 0; }
        }
        else { return 0; }
    }
    
    function get_cust_type($type=null)
    {
        $this->db->select('email');
        $this->db->where('type', $type);
        $this->db->where('status', 1);
        $this->db->where('deleted', $this->deleted);
        $val = $this->db->get($this->tableName)->result();
        return $val;
    }
    
    function get_details($id)
    {
       $this->db->where('id', $id);
       return $this->db->get($this->tableName); 
    }
    
    function combo()
    {
        $this->db->select('id,first_name,last_name');
        $this->db->where('deleted', NULL);
        $this->db->where('status', 1);
        $this->db->order_by('first_name', 'asc');
        $val = $this->db->get($this->tableName)->result();
        if ($val){
            foreach($val as $row){ $data['options'][$row->id] = ucfirst($row->first_name.' '.$row->last_name); }
        }else{ $data['options'][''] = '--'; }
        return $data;
    }


}

/* End of file Property.php */