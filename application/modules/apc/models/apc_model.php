<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Apc_model extends Custom_Model
{   
    function __construct()
    {
        parent::__construct();
        $this->logs = new Log_lib();
        $this->com = new Components();
        $this->com = $this->com->get_id('apc');
        $this->tableName = 'apc';
    }
    
    protected $field = array('apc.id', 'apc.no', 'apc.currency', 'apc.dates', 'apc.acc', 'apc.account', 'apc.user', 'apc.status',
                             'apc.amount', 'apc.notes', 'apc.approved');
    
    function count_all_num_rows()
    {
        //method untuk mengembalikan nilai jumlah baris dari database.
        return $this->db->count_all($this->tableName);
    }
    
    function get_last($limit)
    {
        $this->db->select($this->field);
        $this->db->where('deleted', $this->deleted);
        $this->db->from($this->tableName);
        $this->db->order_by('apc.id', 'desc');
        $this->db->limit($limit);
        return $this->db->get(); 
    }
    
    function search($date)
    {
        $this->db->select($this->field);
        $this->db->where('deleted', $this->deleted);
        $this->db->from($this->tableName);
        $this->cek_null($date,"apc.dates");
        return $this->db->get();
    }
    
    function counter()
    {
        $this->db->select_max('no');
        $test = $this->db->get($this->tableName)->row_array();
        $userid=$test['no'];
	$userid = $userid+1;
	return $userid;
    }
    
    function report($acc=null,$cur=null,$start=null,$end)
    {
        $this->db->select('apc.id, apc.no, apc.dates, apc.currency, apc.notes, apc.account, apc.amount, apc.approved');
        $this->db->where('deleted', $this->deleted);
        $this->db->from($this->tableName);
        $this->db->where('apc.currency', $cur);
        $this->cek_between($start, $end);
        $this->cek_null($acc, 'apc.account');
        $this->db->where('apc.approved', 1);
        $this->db->order_by('apc.dates','asc');
        return $this->db->get(); 
    }
    
    function report_category($acc=null,$cur=null,$start=null,$end=null)
    {
       $this->db->select('apc.id, apc.no, apc.dates, apc.currency, apc.account, apc.approved,
                          costs.name as cost, costs.account_id as account, apc_trans.notes, apc_trans.staff, 
                          apc_trans.amount,');
        
        $this->db->from('apc, apc_trans, costs');
        $this->db->where('apc.deleted', $this->deleted);
        $this->db->where('apc.id = apc_trans.apc_id');
        $this->db->where('apc_trans.cost = costs.id');
        $this->db->where('apc.currency', $cur);
        $this->cek_null($acc, 'apc.account');
        $this->cek_between($start, $end);
        $this->db->where('apc.approved', 1);
       
        return $this->db->get();  
    }
    
    private function cek_null_report($val,$field)
    { if ($val != ""){ return $this->db->where($field, $val); } }
    
    function total_chart($month,$year,$cur='IDR')
    {
        $this->db->select_sum('amount');

        $this->db->from($this->tableName);
        $this->db->where('deleted', $this->deleted);
        $this->cek_null($cur,"currency");
        $this->db->where('approved', 1);
        $this->cek_null($month,"MONTH(dates)");
        $this->cek_null($year,"YEAR(dates)");
        $query = $this->db->get()->row_array();
        return $query['amount'];
    }
    
    private function cek_between($start,$end)
    {
        if ($start == null || $end == null ){return null;}
        else { return $this->db->where("apc.dates BETWEEN '".$start."' AND '".$end."'"); }
    }
    
    private function cek_cat($val,$field)
    {
        if ($val == ""){return null;}
        else {return $this->db->where($field, $val);}
    }
    
    function valid_no($no)
    {
        $this->db->where('no', $no);
        $query = $this->db->get($this->tableName)->num_rows();
        if($query > 0) { return FALSE; } else { return TRUE; }
    }

}

?>