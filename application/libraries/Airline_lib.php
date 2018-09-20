<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Airline_lib extends Custom_Model {

    public function __construct($deleted=NULL)
    {
        $this->deleted = $deleted;
        $this->tableName = 'airline';
    }

    private $ci;
    
    protected $field = array('airline.id', 'airline.code', 'airline.name', 'airline.region', 'airline.description',
                             'airline.type', 'airline.account', 'airline.publish',
                             'airline.created', 'airline.updated', 'airline.deleted');
    
    function get_detail_field($type,$val)
    {
       $this->db->where('id', $val);
       $res = $this->db->get($this->tableName)->row();
       return $res->$type;
    }
    
    function combo_deposit()
    {
        $this->db->select($this->field);
        $this->db->where('deleted', NULL);
        $this->db->where('publish', 1);
        $this->db->where('type', 'DEPOSIT');
        $this->db->order_by('code', 'asc');
        $val = $this->db->get($this->tableName)->result();
        if ($val){
          foreach($val as $row){ $data['options'][$row->id] = ucfirst($row->code.' : '.$row->name); }    
        }else{ $data['options'][''] = '--'; }
        
        return $data;
    }
    
    function combo()
    {
        $data = null;
        $this->db->select($this->field);
        $this->db->where('deleted', NULL);
        $this->db->where('publish', 1);
        $this->db->order_by('code', 'asc');
        $val = $this->db->get($this->tableName)->result();
        if ($val){
          foreach($val as $row){ $data['options'][$row->id] = ucfirst($row->code.' : '.$row->name); }    
        }else{ $data['options'][''] = '--'; }
        
        return $data;
    }

}

/* End of file Property.php */