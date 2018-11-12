<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_lib extends Custom_Model {

    public function __construct($deleted=NULL)
    {
        $this->deleted = $deleted;
        $this->tableName = 'member';
    }

    private $ci;
    protected $field = array('id', 'company', 'first_name', 'last_name', 'address', 'phone', 'fax', 'email',
                             'website', 'state', 'city', 'zip', 'image', 'joined', 'status', 'verify_code',
                             'created', 'updated', 'deleted');
        
    function get_details($id,$type=null)
    {
       $this->db->select($this->field); 
       $this->db->where('id', $id);
       $query = $this->db->get($this->tableName)->row();
       if ($query){ if ($type){ return $query->$type; }else{ return $query; } }else{ return null; } 
    }
    
    function combo()
    {
        $this->db->select($this->field);
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