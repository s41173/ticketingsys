<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cashout_trans_model extends Custom_Model
{
    protected $logs;
    
    function __construct()
    {
        parent::__construct();
        $this->logs = new Log_lib();
        $this->com = new Components();
        $this->com = $this->com->get_id('cashout');
        $this->tableName = 'cashout_trans';
    }
    
    protected $field = array('id', 'cash_id', 'account_id', 'balance');
    
    function get_last_item($po)
    {
        $this->db->select($this->field);
        $this->db->from($this->tableName);
        $this->db->where('cash_id', $po);
        $this->db->order_by('id', 'asc'); 
        return $this->db->get(); 
    }

    function total($pid)
    {
        $this->db->select_sum('balance');
        $this->db->where('cash_id', $pid);
        return $this->db->get($this->tableName)->row_array();
    }

    function delete_po($uid)
    {
        $this->db->where('cash_id', $uid);
        $this->db->delete($this->tableName); // perintah untuk delete data dari db
    }
    
    function closing_trans(){
        $this->db->truncate('cashout'); 
    }
   
}

?>