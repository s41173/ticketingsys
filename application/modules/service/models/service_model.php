<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends Custom_Model
{
    protected $logs;
    
    function __construct()
    {
        parent::__construct();
        $this->logs = new Log_lib();
        $this->com = new Components();
        $this->com = $this->com->get_id('service');
        $this->tableName = 'service';
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
    
    function counter($type=0)
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
    
    function get_service_qty_based_category($cat=0,$month=null,$year=null)
    {
        if (!$month){ $month = date('n'); }
        if (!$year){ $year = date('Y'); }
        
        $this->db->select_sum('service_item.qty', 'qtys');
        
        $this->db->from('service, service_item, product, category');
        $this->db->where('service.id = service_item.service_id');
        $this->db->where('service_item.product_id = product.id');
        $this->db->where('product.category = category.id');
        
        $this->db->where('MONTH(service.dates)', $month);
        $this->db->where('YEAR(service.dates)', $year);
        $this->db->where('category.id', $cat);
        $this->db->where('service.confirmation', 1);
        $query = $this->db->get()->row_array();
        return intval($query['qtys']);
    }
    
    function report_category($start=null,$end=null,$confirm=null)
    {   
        $this->db->select("service.id, service.code, service.dates, service_item.passenger, service_item.idcard, service_item.checkin, service_item.checkout, service_item.description,  
                           service_item.bookcode, service_item.vendor, service_item.price, service_item.amount, service_item.hpp, service_item.discount, service_item.tax,
                           service.payment_id, service.paid_date, service.cc_no, service.cc_name, service.cc_bank, service.sender_name, service.sender_acc, service.sender_bank, service.sender_amount,
                           service.account, service.log ,service.approved");
        
        $this->db->from('service, service_item');
        $this->db->where('service.id = service_item.service_id');
        $this->db->where('service.deleted', $this->deleted);
        $this->between('service.dates', $start, $end);
        
//        if ($paid == '1'){ $this->db->where('paid_date IS NOT NULL'); }
//        elseif ($paid == '0'){ $this->db->where('paid_date IS NULL'); }
        $this->cek_null($confirm, 'approved');
        $this->db->order_by('dates', 'desc'); 
        return $this->db->get(); 
    }

}

?>