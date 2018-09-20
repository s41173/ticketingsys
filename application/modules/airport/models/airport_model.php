<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Airport_model extends Custom_Model
{
    protected $logs;
    
    function __construct()
    {
        parent::__construct();
        $this->logs = new Log_lib();
        $this->com = new Components();
        $this->com = $this->com->get_id('airport');
        $this->tableName = 'airports';
    }
    
    protected $field = array('id', 'code', 'name', 'location', 'country_id', 'country_name', 'created', 'updated', 'deleted');
    protected $com;
    
    function combo_country(){
        
        $this->db->select($this->field);
        $this->db->where('deleted', NULL);
        $this->db->order_by('country_id', 'asc');
        $this->db->group_by("country_id"); 
        $val = $this->db->get($this->tableName)->result();
        
        if ($val){
          foreach($val as $row){ $data['options'][$row->country_id] = ucfirst($row->country_id.' : '.$row->country_name); }    
        }else{ $data['options'][''] = '--'; }
        
        return $data;
    }
    
    function get_last($country=null, $limit, $offset=null)
    {
        $this->db->select($this->field);
        $this->db->from($this->tableName); 
        $this->cek_null($country, 'country_id');
        $this->db->where('deleted', $this->deleted);
        $this->db->order_by('name', 'asc'); 
        $this->db->limit($limit, $offset);
        return $this->db->get(); 
    }
    
    function get_list($clas=null)
    {
        $this->db->select($this->field);
        $this->db->from($this->tableName); 
        $this->db->where('deleted', $this->deleted);
        $this->cek_null($clas, 'classification_id');
        $this->db->order_by('code', 'asc'); 
        return $this->db->get(); 
    }
    
    function search($country=null)
    {   
        $this->db->select($this->field);
        $this->db->from($this->tableName); 
        $this->db->where('deleted', $this->deleted);
        $this->cek_null_string($country, 'country_id');
        $this->db->order_by('name', 'asc'); 
        return $this->db->get(); 
    }
    
    function valid_default($uid)
    {
        $this->db->where('id', $uid);
        $query = $this->db->get($this->tableName)->row();
        if($query->default == 1){ return FALSE; }else{ return TRUE; }
    }
    
    function report()
    {
        $this->db->select($this->field);
        $this->cek_null($cur, 'currency');
        $this->db->order_by('code','asc');
        return $this->db->get('accounts');
    }

}

?>