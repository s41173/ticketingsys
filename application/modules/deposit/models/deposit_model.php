<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Deposit_model extends Custom_Model
{
    protected $logs;
    
    function __construct()
    {
        parent::__construct();
        $this->logs = new Log_lib();
        $this->com = new Components();
        $this->com = $this->com->get_id('deposit');
        $this->tableName = 'deposit';
    }
    
    protected $field = array('id', 'dates', 'airline', 'description', 'amount', 'account', 'approved', 'created', 'updated', 'deleted');
    
    function get_last($limit)
    {
        $this->db->select($this->field);
        $this->db->from($this->tableName);
        $this->db->where('deleted', NULL);
        $this->db->order_by('id', 'asc'); 
        $this->db->limit($limit);
        return $this->db->get(); 
    }
    
    function search($airline='null')
    {
        $this->db->select($this->field);
        $this->db->from($this->tableName);
        $this->db->where('deleted', NULL);
        $this->db->order_by('id', 'desc'); 
        $this->cek_null_string($airline, 'airline');
        return $this->db->get(); 
    }
    
    function report($start,$end){
        
       $this->db->select($this->field);
       $this->db->from($this->tableName);
       $this->db->where('deleted', NULL);
       $this->cek_between($start, $end);
       $this->db->order_by('id', 'desc'); 
       return $this->db->get();   
    }
    
    private function cek_between($start,$end)
    {
        if ($start == null || $end == null ){return null;}
        else { return $this->db->where("dates BETWEEN '".$start."' AND '".$end."'"); }
    }

}

?>