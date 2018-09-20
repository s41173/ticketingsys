<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_lib extends Custom_Model {
    
    public function __construct($deleted=NULL)
    {
        $this->deleted = $deleted;
        $this->tableName = 'product';
        $this->wt = new Warehouse_transaction_lib();
    }
    
    private $wt;
    protected $field = array('id', 'sku', 'category', 'manufacture', 'name', 'model', 'permalink', 'currency',
                             'description', 'shortdesc', 'spesification', 'meta_title', 'meta_desc', 'meta_keywords',
                             'price', 'pricelow', 'discount', 'qty', 'min_order', 'image', 'url_upload', 'url1', 'url2', 'url3', 'url4', 'url5',
                             'dimension', 'dimension_class', 'weight', 'related', 'publish',
                             'created', 'updated', 'deleted');

    function cek_relation($id,$type)
    {
       $this->db->where($type, $id);
       $query = $this->db->get('product')->num_rows();
       if ($query > 0) { return FALSE; } else { return TRUE; }
    }

//    function add_qty($id=null,$amount_qty=null)
//    {
//        $this->db->where('id', $id);
//        $qty = $this->db->get('product')->row();
//        $qty = $qty->qty;
//        $qty = $qty + $amount_qty;
//
//        $res = array('qty' => $qty);
//        $this->db->where('id', $id);
//        $this->db->update('product', $res);
//    }
//
//    function min_qty($id=null,$amount_qty=null)
//    {
//        $this->db->where('id', $id);
//        $qty = $this->db->get('product')->row();
//        $qty = $qty->qty;
//        $qty = $qty - $amount_qty;
//
//        $res = array('qty' => $qty);
//        $this->db->where('id', $id);
//        $this->db->update('product', $res);
//    }

    function valid_sku($sku){
        
       $this->db->where('sku', $sku);
       $val = $this->db->get($this->tableName)->num_rows(); 
       if ($val > 0){ return TRUE; }else{ return FALSE; }
    }
    
    function edit_price($name=null,$price=0)
    {
        $this->db->where('name', $name);
        $val = $this->db->get('product')->row();

        $res = array('price' => $price);
        $this->db->where('name', $name);
        $this->db->update('product', $res);
    }

    function valid_qty($pid,$qty)
    {
       $this->db->select('id, name, qty');
       $this->db->where('id', $pid);
       $res = $this->db->get('product')->row();
       if ($res->qty - $qty < 0){ return FALSE; } else { return TRUE; }
    }

    function get_details($name=null)
    {
        if ($name)
        {
           $this->db->select('id, name, qty');
           $this->db->where('name', $name);
           return $this->db->get('product')->row();
        }
    }

    function get_id($name=null)
    {
        if ($name)
        {
           $this->db->select('id, name, qty');
           $this->db->where('name', $name);
           $res = $this->db->get('product')->row();
           return $res->id;
        }
    }
    
    function get_id_by_sku($name=null)
    {
        if ($name)
        {
           $this->db->select('id, name, qty');
           $this->db->where('sku', $name);
           $res = $this->db->get('product')->row();
           if ($res){ return $res->id; }else{ return 0; }
        }
    }
   

    function get_name($id=null)
    {
        if ($id)
        {
           $this->db->select('id, name, qty, weight, price, discount');
           $this->db->where('id', $id);
           $res = $this->db->get('product')->row();
           return $res->name;
        }
    }
    
    function get_name_by_sku($code=null)
    {
        if ($code)
        {
           $this->db->select('id, name, qty, weight, price, discount');
           $this->db->where('sku', $code);
           $res = $this->db->get('product')->row();
           return $res->name;
        }
    }
    
    function get_detail_based_id($id=null)
    {
        if ($id)
        {
           $this->db->select($this->field);
           $this->db->where('id', $id);
           $res = $this->db->get('product')->row();
           return $res;
        }
    }
    
    function get_detail_based_sku($sku=null)
    {
        if ($sku)
        {
           $this->db->select($this->field);
           $this->db->where('sku', $sku);
           $res = $this->db->get('product')->row();
           if ($res){ return $res; }else{ return null; }
        }
    }
    
    function get_weight($id=null)
    {
        if ($id)
        {
           $this->db->select($this->field);
           $this->db->where('id', $id);
           $res = $this->db->get('product')->row();
           return $res->weight;
        }
    }

    function get_unit($id=null)
    {
        if ($id)
        {
           $this->db->select('unit');
           $this->db->where('id', $id);
           $res = $this->db->get('product')->row();
           return $res->unit;
        }
    }
    
    function get_sku($id=null)
    {
        if ($id)
        {
           $this->db->select('sku');
           $this->db->where('id', $id);
           $res = $this->db->get('product')->row();
           return $res->sku;
        }
    }

    function get_qty($id=null)
    {
        if ($id)
        {
           $this->db->select('qty');
           $this->db->where('id', $id);
           $res = $this->db->get('product')->row();
           return $res->qty;
        }
    }

    function get_price($id=null)
    {
        if ($id)
        {
           $this->db->select('price');
           $this->db->where('id', $id);
           $res = $this->db->get('product')->row();
           return $res->price;
        }
    }

    function get_all()
    {
      $this->db->select('id, name, qty, unit');
      $this->db->where('deleted', $this->deleted);
      $this->db->order_by('name', 'asc');
      return $this->db->get('product');
    }
    
    function combo()
    {
        $this->db->select($this->field);
        $this->db->where('deleted', $this->deleted);
        $this->db->where('publish', 1);
        $val = $this->db->get($this->tableName)->result();
        if ($val){ foreach($val as $row){$data['options'][$row->id] = ucfirst($row->name);} }
        else { $data['options'][''] = '--'; }        
        return $data;
    }
    
    function combo_publish($id)
    {
        $this->db->select($this->field);
        $this->db->where('deleted', $this->deleted);
        $this->db->where('publish', 1);
        $this->db->where_not_in('id', $id);
        $val = $this->db->get($this->tableName)->result();
        if ($val){ foreach($val as $row){$data['options'][$row->id] = ucfirst($row->name);} }
        else { $data['options'][''] = '--'; }        
        return $data;
    }
    
    function get_product_based_category($cat,$branch=null,$month=0,$year=0)
    {
        $this->db->select_sum('open_qty');
        $this->db->from('product, stock_ledger');
        $this->db->where('product.id = stock_ledger.product_id');
        $this->db->where('product.deleted', $this->deleted);
        $this->db->where('product.publish', 1);
        $this->db->where('product.category', $cat);
        $this->cek_null($branch, 'stock_ledger.branch_id');
        $this->db->where('stock_ledger.month', $month);
        $this->db->where('stock_ledger.year', $year);
        $res = $this->db->get()->row_array();
        $open = $res['open_qty']; 
        $tr = $this->wt->get_sum_transaction_qty_category($cat, $branch, $month, $year);
        return intval($open+$tr);
    }

}

/* End of file Property.php */