<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Airline_model extends Custom_Model
{   
    function __construct()
    {
        parent::__construct();
        $this->logs = new Log_lib();
        $this->com = new Components();
        $this->com = $this->com->get_id('airline');
        $this->tableName = 'airline';
    }
    
    protected $field = array('airline.id', 'airline.code', 'airline.name', 'airline.region', 'airline.description',
                             'airline.type', 'airline.account', 'airline.publish',
                             'airline.created', 'airline.updated', 'airline.deleted');
    
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
        $this->db->order_by('airline.id', 'desc');
        $this->db->limit($limit);
        return $this->db->get(); 
    }
    
    function search($region='null',$search='null')
    {
        $this->db->select($this->field);
        $this->db->where('deleted', $this->deleted);
        $this->db->from($this->tableName);
        $this->cek_null_string($region,"airline.region");
        $this->cek_null_string($search,"airline.type");
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
        $this->db->select('airline.id, airline.no, airline.dates, airline.currency, airline.notes, airline.account, airline.amount, airline.approved');
        $this->db->where('deleted', $this->deleted);
        $this->db->from($this->tableName);
        $this->db->where('airline.currency', $cur);
        $this->cek_between($start, $end);
        $this->cek_null($acc, 'airline.account');
        $this->db->where('airline.approved', 1);
        $this->db->order_by('airline.dates','asc');
        return $this->db->get(); 
    }
    
    function report_category($acc=null,$cur=null,$start=null,$end=null)
    {
       $this->db->select('airline.id, airline.no, airline.dates, airline.currency, airline.account, airline.approved,
                          costs.name as cost, costs.account_id as account, airline_trans.notes, airline_trans.staff, 
                          airline_trans.amount,');
        
        $this->db->from('airline, airline_trans, costs');
        $this->db->where('airline.deleted', $this->deleted);
        $this->db->where('airline.id = airline_trans.airline_id');
        $this->db->where('airline_trans.cost = costs.id');
        $this->db->where('airline.currency', $cur);
        $this->cek_null($acc, 'airline.account');
        $this->cek_between($start, $end);
        $this->db->where('airline.approved', 1);
       
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
        else { return $this->db->where("airline.dates BETWEEN '".$start."' AND '".$end."'"); }
    }
    

}

?>