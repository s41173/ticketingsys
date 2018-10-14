<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sales_model extends Custom_Model
{
    protected $logs;
    
    function __construct()
    {
        parent::__construct();
        $this->logs = new Log_lib();
        $this->com = new Components();
        $this->com = $this->com->get_id('sales');
        $this->tableName = 'sales';
    }
    
    protected $field = array('id', 'code', 'dates', 'cust_id', 'amount', 'tax', 'cost', 'discount', 'total',
                             'payment_id', 'bank_id', 'paid_date', 'paid_contact', 'due_date',
                             'cc_no', 'cc_name', 'cc_bank', 'sender_name', 'sender_acc', 'sender_bank', 'sender_amount', 'account',
                             'approved', 'log', 'created', 'updated', 'deleted');
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
    
    function search($customer=null,$paid=null)
    {   
        $this->db->select($this->field);
        $this->db->from($this->tableName); 
        $this->db->where('deleted', $this->deleted);
        $this->cek_null_string($customer, 'cust_id');
        
        if ($paid == '1'){ $this->db->where('paid_date IS NOT NULL'); }
        elseif ($paid == '0'){ $this->db->where('paid_date IS NULL'); }
        
        $this->db->order_by('dates', 'desc'); 
        return $this->db->get(); 
    }
    
        
    function get_by_code($uid)
    {
        $this->db->select($this->field);
        $this->db->where('code', $uid);
        return $this->db->get($this->tableName);
    }
    
    function report($start=null,$end=null,$confirm=null)
    {   
        $this->db->select($this->field);
        $this->db->from($this->tableName); 
        $this->db->where('deleted', $this->deleted);
        $this->between('dates', $start, $end);
        
//        if ($paid == '1'){ $this->db->where('paid_date IS NOT NULL'); }
//        elseif ($paid == '0'){ $this->db->where('paid_date IS NULL'); }
        $this->cek_null($confirm, 'approved');
        $this->db->order_by('dates', 'desc'); 
        return $this->db->get(); 
    }
    
    function counters($type=0)
    {
       $this->db->select_max('id');
       $query = $this->db->get($this->tableName)->row_array(); 
       if ($type == 0){ return intval($query['id']+1); }else { return intval($query['id']); }
    }
    
    function valid_confirm($sid)
    {
       $this->db->where('id', $sid);
       $query = $this->db->get($this->tableName)->row();
       if ($query->paid_date != NULL){ return FALSE; }else{ return TRUE; }
    }
    
    function get_sales_qty_based_category($cat=0,$month=null,$year=null)
    {
        if (!$month){ $month = date('n'); }
        if (!$year){ $year = date('Y'); }
        
        $this->db->select_sum('sales_item.qty', 'qtys');
        
        $this->db->from('sales, sales_item, product, category');
        $this->db->where('sales.id = sales_item.sales_id');
        $this->db->where('sales_item.product_id = product.id');
        $this->db->where('product.category = category.id');
        
        $this->db->where('MONTH(sales.dates)', $month);
        $this->db->where('YEAR(sales.dates)', $year);
        $this->db->where('category.id', $cat);
        $this->db->where('sales.confirmation', 1);
        $query = $this->db->get()->row_array();
        return intval($query['qtys']);
    }
    
    function report_category($start=null,$end=null,$confirm=null)
    {   
        $this->db->select("sales.id, sales.code, sales.dates, sales_item.passenger, sales_item.idcard, sales_item.source, sales_item.dates as depart_dates, sales_item.source_desc,  
                           sales_item.destination, sales_item.destination_desc, sales_item.returns, sales_item.return_dates, sales_item.ticketno,
                           sales_item.airline, sales_item.vendor, sales_item.bookcode, sales_item.country, sales_item.price, sales_item.amount, sales_item.hpp, sales_item.discount, sales_item.tax,
                           sales.payment_id, sales.paid_date, sales.cc_no, sales.cc_name, sales.cc_bank, sales.sender_name, sales.sender_acc, sales.sender_bank, sales.sender_amount,
                           sales.account, sales.log ,sales.approved");
        
        $this->db->from('sales, sales_item');
        $this->db->where('sales.id = sales_item.sales_id');
        $this->db->where('sales.deleted', $this->deleted);
        $this->between('sales.dates', $start, $end);
        
//        if ($paid == '1'){ $this->db->where('paid_date IS NOT NULL'); }
//        elseif ($paid == '0'){ $this->db->where('paid_date IS NULL'); }
        $this->cek_null($confirm, 'approved');
        $this->db->order_by('dates', 'desc'); 
        return $this->db->get(); 
    }

}

?>