<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transfer_model extends Custom_Model
{
    protected $logs;
    
    function __construct()
    {
        parent::__construct();
        $this->logs = new Log_lib();
        $this->com = new Components();
        $this->com = $this->com->get_id('transfer');
        $this->tableName = 'transfer';
    }
    
    protected $field = array('id', 'no', 'notes', 'dates', 'currency', 'from', 'to', 'approved', 'amount');
    
    function count_all_num_rows()
    {
        //method untuk mengembalikan nilai jumlah baris dari database.
        return $this->db->count_all($this->tableName);
    }
    
    function get_last_transfer($limit)
    {
        $this->db->select($this->field);
        $this->db->order_by('no', 'desc');
        $this->db->limit($limit);
        return $this->db->get($this->tableName);
    }

    function search($date=null)
    {
        $this->db->select($this->field);
        $this->cek_null($date,"dates");
        return $this->db->get($this->tableName);
    }

    function counter()
    {
        $this->db->select_max('no');
        $test = $this->db->get($this->tableName)->row_array();
        $userid=$test['no'];
	$userid = $userid+1;
	return $userid;
    }
    
    function get_transfer_by_id($uid)
    {
        $this->db->select($this->field);
        $this->db->where('id', $uid);
        return $this->db->get($this->tableName);
    }

    function get_transfer_by_no($uid)
    {
        $this->db->select($this->field);
        $this->db->where('no', $uid);
        return $this->db->get($this->tableName);
    }
    
    function update($uid, $users)
    {
        $this->db->where('no', $uid);
        $this->db->update($this->tableName, $users);
    }

    function update_id($uid, $users)
    {
        $this->db->where('id', $uid);
        $this->db->update($this->tableName, $users);
    }

    function valid_no($no)
    {
        $this->db->where('no', $no);
        $query = $this->db->get($this->tableName)->num_rows();
        if($query > 0) { return FALSE; } else { return TRUE; }
    }

    function validating_no($no,$id)
    {
        $this->db->where('no', $no);
        $this->db->where_not_in('id', $id);
        $query = $this->db->get($this->tableName)->num_rows();
        if($query > 0) {  return FALSE; } else { return TRUE; }
    }

    function report($cur,$start,$end)
    {
        $this->db->select($this->field);
        $this->db->from($this->tableName);
        $this->between($start,$end);
        $this->db->where('currency',$cur);
        $this->db->where('approved', 1);
        return $this->db->get();
    }

}

?>