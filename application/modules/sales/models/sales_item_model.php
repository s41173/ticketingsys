<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sales_item_model extends Custom_Model
{
    function __construct()
    {
        parent::__construct();
        $this->logs = new Log_lib();
        $this->tableName = 'sales_item';
    }
    
    protected $field = array('id', 'sales_id', 'passenger', 'idcard', 'source', 'dates', 'source_desc', 
                             'destination', 'destination_desc', 'country',
                             'returns', 'return_dates', 'ticketno', 'bookcode', 'airline', 'vendor', 'price', 'amount', 'hpp', 'discount', 'tax');
    
    function get_last_item($pid)
    {
        $this->db->select($this->field);
        $this->db->from($this->tableName); 
        $this->db->where('sales_id', $pid);
        $this->db->order_by('id', 'asc'); 
        return $this->db->get(); 
    }
    
    function cek_return($pid){
        
        $this->db->select($this->field);
        $this->db->from($this->tableName); 
        $this->db->where('sales_id', $pid);
        $this->db->where('returns', TRUE);
        $num = $this->db->get()->num_rows();
        if ($num > 0){ return TRUE; }else{ return FALSE; }
    }

    function total($pid)
    {
        $this->db->select_sum('hpp');
        $this->db->select_sum('price');
        $this->db->select_sum('discount');
        $this->db->select_sum('tax');
        $this->db->select_sum('amount');
        $this->db->where('sales_id', $pid);
        return $this->db->get($this->tableName)->row_array();
    }

    function delete($uid)
    {
        $this->db->where('id', $uid);
        $this->db->delete($this->tableName); // perintah untuk delete data dari db
    }

    function delete_sales($uid)
    {
        $this->db->where('sales_id', $uid);
        $this->db->delete($this->tableName); // perintah untuk delete data dari db
    }
    
    function add($users)
    {
        $this->db->insert($this->tableName, $users);
    }
    
    function valid_product($pid,$sid)
    {
       $this->db->where('product_id', $pid); 
       $this->db->where('sales_id', $sid); 
       $query = $this->db->get($this->tableName)->num_rows();
       if ($query > 0){ return FALSE; }else{ return TRUE; }
    }
    
    function valid_items($sid)
    {
       $this->db->where('sales_id', $sid); 
       $query = $this->db->get($this->tableName)->num_rows();
       if ($query > 0){ return TRUE; }else{ return FALSE; }
    }
    
    function counter()
    {
        $this->db->select_max('id');
        $test = $this->db->get($this->tableName)->row_array();
        $userid=$test['id'];
	$userid = $userid+1;
	return $userid;
    }
    
    function update_id($uid, $users)
    {
        $this->db->where('id', $uid);
        $this->db->update($this->tableName, $users);
    }

}

?>