<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Apc_trans_model extends Custom_Model
{
    protected $logs;
    
    function __construct()
    {
        parent::__construct();
        $this->logs = new Log_lib();
        $this->com = new Components();
        $this->com = $this->com->get_id('apc');
        $this->tableName = 'apc_trans';
    }
    
    protected $field = array('id', 'apc_id', 'cost', 'notes', 'staff', 'amount');
    
    function get_last_item($po)
    {
        $this->db->select($this->field);
        $this->db->from($this->tableName);
        $this->db->where('apc_id', $po);
        $this->db->order_by('id', 'asc'); 
        return $this->db->get(); 
    }

    function total($pid)
    {
        $this->db->select_sum('amount');
        $this->db->where('apc_id', $pid);
        return $this->db->get($this->tableName)->row_array();
    }

    function delete_po($uid)
    {
        $this->db->where('apc_id', $uid);
        $this->db->delete($this->tableName); // perintah untuk delete data dari db
    }
    
    function closing_trans(){
        $this->db->truncate('cash_ledger'); 
    }
   
}

?>