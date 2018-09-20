<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Warehouse_transaction_lib extends Custom_Model {
    
    public function __construct($deleted=NULL)
    {
        $this->tableName = 'warehouse_transaction';
    }

    protected $field = array('id', 'dates', 'code', 'currency', 'branch_id', 'product_id', 'debit', 'credit', 'price', 'amount', 'log');
    
    function get_amount($no)
    {
//        $this->db->select('dates,code,currency,amount');
        $this->db->select_sum('amount');
        $this->db->where('code', $no);
        $res = $this->db->get($this->tableName)->row_array();
        return intval($res['amount']);
    }
    
    function add($date, $code, $branch, $cur='IDR', $product, $in=0, $out=0, $price=0, $amount=0, $log=null)
    {   
        $trans = array('dates' => $date, 'code' => $code, 'branch_id' => $branch, 'currency' => $cur, 'product_id' => $product,
                       'debit' => $in, 'credit' => $out, 'price' => $price, 
                       'amount' => $amount, 'log' => $log);
        $this->db->insert($this->tableName, $trans);
    }

//    ============================  remove transaction journal ==============================

    function remove($dates,$codetrans,$product=null)
    {
        // ============ update transaction ===================
        $this->db->where('dates', $dates);
        $this->db->where('code', $codetrans);
        $this->cek_null($product, 'product_id');
        $this->db->delete($this->tableName);
        // ====================================================
    }
    
    function get_monthly($product=null,$branch=null,$month=0,$year=0)
    {
        $this->db->select($this->field);
        $this->cek_null($product, 'product_id');
        $this->cek_null($branch, 'branch_id');
        $this->db->where('MONTH(dates)', $month);
        $this->db->where('YEAR(dates)', $year);
        $this->db->order_by('id','asc');
        return $this->db->get($this->tableName);
    }
    
    function get_transaction($product,$branch,$start,$end)
    {
        $this->db->select($this->field);
        $this->db->where('product_id', $product);
        $this->cek_null($branch, 'branch_id');
        $this->db->where("dates BETWEEN '".setnull($start)."' AND '".setnull($end)."'");
//        $this->db->order_by('id','asc');
        $this->db->order_by('dates','asc');
        return $this->db->get($this->tableName);
    }
    
     // closing function
    function get_sum_transaction_balance($product,$branch=null,$month,$year,$type=null)
    {
        $this->db->select_sum('amount');
        $this->db->where('product_id', $product);
        $this->cek_null($branch, 'branch_id');
        $this->db->where('MONTH(dates)', $month);
        $this->db->where('YEAR(dates)', $year);
        if ($type == 'debit'){ $this->db->where('debit >', 0); }
        if ($type == 'credit'){ $this->db->where('credit >', 0); }
        $res = $this->db->get($this->tableName)->row_array();
        return floatval($res['amount']);
    }
    
    function get_sum_transaction_qty($product,$branch=null,$month,$year)
    {
        $this->db->select_sum('debit');
        $this->db->select_sum('credit');
        $this->db->where('product_id', $product);
        $this->cek_null($branch, 'branch_id');
        $this->db->where('MONTH(dates)', $month);
        $this->db->where('YEAR(dates)', $year);
        $res = $this->db->get($this->tableName)->row_array();
        return floatval($res['debit']-$res['credit']);
    }
    
    function get_sum_transaction_qty_category($cat,$branch,$month,$year)
    {
        $this->db->select_sum('debit');
        $this->db->select_sum('credit');
        $this->db->from('product, warehouse_transaction');
        $this->db->where('product.id = warehouse_transaction.product_id');
        $this->db->where('product.category', $cat);
        $this->cek_null($branch, 'branch_id');
        $this->db->where('MONTH(dates)', $month);
        $this->db->where('YEAR(dates)', $year);
        $res = $this->db->get()->row_array();
        return intval($res['debit']-$res['credit']);
    }
   
}

/* End of file Property.php */