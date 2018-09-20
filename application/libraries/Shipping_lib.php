<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shipping_lib extends Custom_Model {
    
    public function __construct($deleted=NULL)
    {
        $this->deleted = $deleted;
        $this->tableName = 'shipping';
    }

    protected $field = array('id', 'sales_id', 'shipdate', 'courier', 'awb', 'origin', 'origin_id', 'origin_desc', 'dest',
                             'dest_id', 'dest_desc', 'package', 'rate', 'weight', 'amount', 'status');

    function cek_relation($id,$type)
    {
       $this->db->where($type, $id);
       $query = $this->db->get('product')->num_rows();
       if ($query > 0) { return FALSE; } else { return TRUE; }
    }
    
    function get_detail_based_sales($id=null)
    {
        if ($id)
        {
           $this->db->select($this->field);
           $this->db->where('sales_id', $id);
           $res = $this->db->get($this->tableName)->row();
           return $res;
        }
    }
    
    function cek_shiping_based_sales($sid)
    {
       if ($sid)
        {
           $this->db->select($this->field);
           $this->db->where('sales_id', $sid);
           $res = $this->db->get($this->tableName)->row();
           if ($res){
              if ($res->shipdate){ return true; }else{ return false; } 
           }
           
        } 
    }
    
    function create($sid,$param)
    {
      $this->db->where('sales_id', $sid);
      $query = $this->db->get($this->tableName)->num_rows();
      if ($query > 0) {$this->edit($sid, $param); } 
      else { $this->add_new($param); }  
    }
    
    private function add_new($param)
    {
       $this->db->insert($this->tableName, $param); 
    }
    
    private function edit($sid,$param)
    {
       $this->db->where('sales_id', $sid);
       $this->db->update($this->tableName, $param); 
    }
    
    function delete_by_sales($sid)
    {
       $this->db->where('sales_id', $sid);
       $this->db->delete($this->tableName);
    }
    
    function total($sid)
    {
      $this->db->where('sales_id', $sid);
      $query = $this->db->get($this->tableName)->row();
      if ($query){ return $query->amount; }else{ return 0; } 
    }

}

/* End of file Property.php */