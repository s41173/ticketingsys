<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Balance_model extends Custom_Model
{
    protected $logs;
    
    function __construct()
    {
        parent::__construct();
        $this->logs = new Log_lib();
        $this->com = new Components();
        $this->com = $this->com->get_id('balance');
        $this->tableName = 'balances';
    }
    
    protected $field = array('id', 'currency', 'account_id', 'beginning', 'end', 'vamount', 'budget', 'month', 'year');
    
    protected $com;
    
    function get_last($limit, $offset=null)
    {
        $this->db->select($this->field);
        $this->db->from($this->tableName); 
        $this->db->where('deleted', $this->deleted);
        $this->db->order_by('id', 'desc'); 
        $this->db->limit($limit, $offset);
        return $this->db->get(); 
    }
    
    function valid_default($uid)
    {
        $this->db->where('id', $uid);
        $query = $this->db->get($this->tableName)->row();
        if($query->default == 1){ return FALSE; }else{ return TRUE; }
    }
    
    function report($cur=null,$stts=null,$cla=null)
    {
        $this->db->select('id, classification_id, currency, code, name, alias, status');
        $this->cek_null($cur, 'currency');
        $this->cek_null($stts, 'status');
        $this->cek_null($cla, 'classification_id');
        $this->db->order_by('code','asc');
        return $this->db->get('accounts');
    }

}

?>