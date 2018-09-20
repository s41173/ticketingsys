<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_temp_lib extends Custom_Model {

    public function __construct($deleted=NULL)
    {
        $this->tableName = 'stock_temp';
        $this->deleted = $deleted;
    }
    
    // stock
    
    function add_stock($pid,$qty,$price,$stockdates,$trcode,$trid,$itemid)
    {   
        $this->db->where('product_id', $pid); 
        $this->db->where('trans_code', $trcode); 
        $this->db->where('trans_id', $trid); 
        $this->db->where('dates', $stockdates); 
        $num = $this->db->get($this->tableName)->num_rows();
        
        if ($num > 0)
        {
            $this->db->where('product_id', $pid); 
            $this->db->where('trans_code', $trcode); 
            $this->db->where('trans_id', $trid); 
            $this->db->where('dates', $stockdates); 
            $val = $this->db->get($this->tableName)->row();
            $qty = intval($qty + $val->qty);

            $res = array('qty' => $qty);
            $this->db->where('id', $val->id);
            $this->db->update($this->tableName, $res);
        }
        else
        {
            $trans = array('product_id' => $pid, 'qty' => $qty, 'amount' => $price, 'dates' => $stockdates, 'trans_code' => $trcode, 'trans_id' => $trid,
                          'item_id' => $itemid);
            $this->db->insert($this->tableName, $trans); 
        }
    }
    
    // -------------------------- bagian min stock ================================
    
    function get_temp_stock($trcode='SA',$sid, $itemid=null)
    {
        $this->db->where('trans_code', $trcode); 
        $this->db->where('trans_id', $sid); 
        $this->cek_null($itemid, 'item_id');
        return $this->db->get($this->tableName);
    }
    
    function remove_temp_stock($trcode='SA',$sid,$itemid=null)
    {
        $this->db->where('trans_code', $trcode); 
        $this->db->where('trans_id', $sid); 
        $this->cek_null($itemid, 'item_id');
        $this->db->delete($this->tableName);
    }
    
}

/* End of file Property.php */