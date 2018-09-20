<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Airport_lib extends Custom_Model {

    public function __construct($deleted=NULL)
    {
        $this->deleted = $deleted;
        $this->tableName = 'airports';
    }

    private $ci;
    
    protected $field = array('airports.id', 'airports.code', 'airports.name', 'airports.location', 'airports.country_id', 'airports.country_name',
                             'airports.created', 'airports.updated', 'airports.deleted');
    
    function get_detail_field($type,$val)
    {
       $this->db->where('id', $val);
       $res = $this->db->get($this->tableName)->row();
       return $res->$type;
    }
    
    function combo($region=null)
    {
        $data = null;
        $this->db->select($this->field);
        $this->db->where('deleted', NULL);
        if ($region == 'id'){ $this->db->where('region', 'id'); }
        elseif($region == 'all'){ $this->db->where('region IS NOT id'); }
        $this->db->order_by('code', 'asc');
        $val = $this->db->get($this->tableName)->result();
        if ($val){
          foreach($val as $row){ $data['options'][$row->id] = ucfirst($row->code.' : '.$row->name); }    
        }else{ $data['options'][''] = '--'; }
        return $data;
    }
    
    function get_country($uid){
        
        $this->db->select($this->field);
        $this->db->where('id', $uid);
        $val = $this->db->get($this->tableName)->row();
        return $val->country_id;
    }
    
    function get_code($uid){
        $this->db->select($this->field);
        $this->db->where('id', $uid);
        $val = $this->db->get($this->tableName)->row();
        return $val->code;
    }

}

/* End of file Property.php */