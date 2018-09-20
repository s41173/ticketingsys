<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_item_lib {

    public function __construct()
    {
        $this->ci = & get_instance();
        $this->pro = new Product_lib();
    }

    private $ci, $pro;

    function cek_relation($id,$type)
    {
       $this->ci->db->where($type, $id);
       $query = $this->ci->db->get('purchase_item')->num_rows();
       if ($query > 0) { return FALSE; } else { return TRUE; }
    }


    function get_last_item($po)
    {
        $this->ci->db->select('id, purchase_id, product, qty, price, tax, amount');
        $this->ci->db->from('purchase_item');
        $this->ci->db->where('purchase_id', $po);
        $this->ci->db->order_by('id', 'asc');
        return $this->ci->db->get();
    }
    
    function get_product_item($po,$product)
    {
        $this->ci->db->select('id, purchase_id, product, qty, price, tax, amount');
        $this->ci->db->from('purchase_item');
        $this->ci->db->where('purchase_id', $po);
        $this->ci->db->where('product', $product);
        return $this->ci->db->get()->row();
    }

    function valid_item($po,$val)
    {
      $this->ci->db->where('purchase_id', $po);
      $this->ci->db->where('product', $val);
      $query = $this->ci->db->get('purchase_item')->num_rows();
      if ($query > 0) { return TRUE; } else { return FALSE; }
    }

    function combo($no)
    {
        $this->ci->db->select('product');
        $this->ci->db->where('purchase_id', $no);
        $val = $this->ci->db->get('purchase_item')->result();
        foreach($val as $row){$data['options'][$row->product] = $this->pro->get_sku($row->product).' - '.$this->pro->get_name($row->product);}
        return $data;
    }
    

}
