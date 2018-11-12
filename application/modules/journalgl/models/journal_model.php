<?php

class Journal_model extends Custom_Model
{   
    function __construct()
    {
        parent::__construct();
        $this->logs = new Log_lib();
        $this->com = new Components();
        $this->com = $this->com->get_id('journalgl');
        $this->tableName = 'gls';
    }
    
    protected $field = array('id', 'member_id', 'no', 'dates', 'code', 'currency', 'docno', 'notes', 'balance', 'desc', 'log', 'cf', 'approved');
        
    function get_last($member=0, $limit, $offset=null)
    {
        $this->db->select($this->field);
        $this->db->from($this->tableName); 
        $this->db->where('member_id', $member);
        $this->db->where('deleted', $this->deleted);
        $this->db->order_by('id', 'desc'); 
        $this->db->limit($limit, $offset);
        return $this->db->get(); 
    }

    function search($member=0,$code=null,$no=null,$dates=null)
    {
        $this->db->select($this->field);
        $this->db->from($this->tableName);
        $this->db->where('member_id', $member);
        $this->cek_null_string($code, 'code');
        $this->cek_null_string($no, 'no');
        $this->cek_null_string(picker_split2($dates), 'dates');
        $this->db->order_by('dates','asc');
        return $this->db->get(); 
    }
    
    function report($member=0, $cur=null,$type=null,$start=null,$end=null)
    {
        $this->db->select($this->field);
        $this->db->from($this->tableName);
        $this->db->where('member_id', $member);
        $this->cek_null($cur, 'currency');
        $this->cek_null($type, 'code');
        $this->between('dates', $start, $end);
        $this->db->where('approved', 1);
        $this->db->order_by('dates','asc');
        return $this->db->get(); 
    }
    
    private function cek_between($start,$end)
    {
        if ($start == null || $end == null ){return null;}
        else { return $this->db->where("dates BETWEEN '".$start."' AND '".$end."'"); }
    }
    
    function counters()
    {
       $this->db->select_max('id');
       $query = $this->db->get($this->tableName)->row_array(); 
       return intval($query['id']); 
    }
    
    function get_transaction($gl=0)
    {
        $this->db->select('id, gl_id, account_id, debit, credit, vamount');
        $this->db->from('transactions'); 
        $this->db->where('gl_id', $gl);
        $this->db->order_by('id', 'asc'); 
        return $this->db->get(); 
    }
    
    function get_glid($id=0)
    {
        $this->db->select('id, gl_id, account_id, debit, credit, vamount');
        $this->db->from('transactions'); 
        $this->db->where('id', $id);
        return $this->db->get(); 
    }
    
    function closing_trans(){
        $this->db->truncate('transactions'); 
        $this->db->truncate('balances'); 
    }
    
}

?>