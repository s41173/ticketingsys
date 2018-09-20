<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_lib extends Custom_Model {

    public function __construct($deleted=NULL)
    {
        $this->tableName = 'stock';
        $this->deleted = $deleted;
        $this->stocktemp = new Stock_temp_lib();
    }
    
    private $stocktemp, $stockvalue=0;
    // stock
    
    function add_stock($pid,$date,$qty,$price)
    {   
        $this->db->where('product_id', $pid); 
        $this->db->where('dates', $date); 
        $num = $this->db->get($this->tableName)->num_rows();
        
        if ($num > 0)
        {
            $this->db->where('product_id', $pid); 
            $this->db->where('dates', $date); 
            $val = $this->db->get($this->tableName)->row();
            $qty = intval($qty + $val->qty);

            $res = array('qty' => $qty);
            $this->db->where('id', $val->id);
            $this->db->update($this->tableName, $res);
        }
        else
        {
            $trans = array('product_id' => $pid, 'dates' => $date, 'qty' => $qty, 'amount' => $price);
            $this->db->insert($this->tableName, $trans); 
        }
        $this->cleaning();
    }
    
    // -------------------------- bagian min stock ================================
    
    function min_stock($pid,$qty=0,$sid,$trans_type='SA',$itemid) //FIFO / LIFO
    {
        if ($qty > 0){ $this->stocks($pid,$qty,$sid,$trans_type,$itemid); }
        $this->cleaning();
        return $this->stockvalue;
    }
    
    private function stocks($pid,$req, $sid, $trans_type='SA',$itemid)
    {
        $res = $this->get_first_stock($pid);  

        if ($res != null)
        {
           if($req > $res->qty)
           { 
               $this->stockvalue = $this->stockvalue + intval($res->qty*$res->amount);
               $this->stocktemp->add_stock($pid, $res->qty, $res->amount, $res->dates, $trans_type, $sid, $itemid); // pindhkan stock ke table temporary
               $this->increase_stock($pid, $res->dates, $res->qty); // kurangkan stock di tabel stock
               $this->min_stock($pid, intval($req - $res->qty),$sid,'SA',$itemid); 
           }
           else 
           { 
               $this->stockvalue = $this->stockvalue + intval($req*$res->amount);
               $this->stocktemp->add_stock($pid,$req,$res->amount, $res->dates, $trans_type, $sid, $itemid);
               $this->increase_stock($pid, $res->dates, $req); // kurangkan stock di tabel stock
               $this->min_stock($pid, 0,$sid, 'SA', $itemid); 
           } 
        }
        else{ $this->min_stock($pid, 0, $sid); }  
    }
    
    function increase_stock($pid,$date,$aqty)
    {
        $this->db->where('product_id', $pid); 
        $this->db->where('dates', $date); 
        $num = $this->db->get($this->tableName)->num_rows();
        
        if ($num > 0)
        {
           $this->db->where('product_id', $pid);
           $this->db->where('dates', $date);
           $val = $this->db->get($this->tableName)->row();
           $qty = intval($val->qty - $aqty);

           $res = array('qty' => $qty);
           $this->db->where('id', $val->id);
           $this->db->update($this->tableName, $res);
        }
        $this->cleaning();
    }
    
    // - ---- ----------------- akhir bagian min stock -----------------------------
    
    // -------------- rollback stock dari stock temp ke stock ----------------------
    
    function rollback($transtype='SA', $sid, $itemid=null)
    {
        $result = $this->stocktemp->get_temp_stock($transtype, $sid, $itemid)->result();
        foreach ($result as $res) {
            $this->add_stock($res->product_id, $res->dates, $res->qty, $res->amount);
        }
        $this->stocktemp->remove_temp_stock($transtype, $sid, $itemid);
        $this->cleaning();
    }
    
    function valid_stock($pid,$date,$aqty)
    {
      $this->db->where('product_id', $pid);
      $this->db->where('dates', $date);
      $this->db->where('qty >=', $aqty);
      $num = $this->db->get($this->tableName)->num_rows();
      if ($num > 0){ return TRUE; }else{ return FALSE; }
    }
   
    
    function get_first_stock($pid,$type='FIFO')
    {
        $this->db->where('product_id', $pid);
        $this->db->where('qty >', 0);
        $num = $this->db->get($this->tableName)->num_rows();
        if ($num > 0)
        {
            $this->db->where('product_id', $pid);
            $this->db->where('qty >', 0);
            if ($type == 'FIFO'){ $this->db->order_by('dates', 'asc'); } else{ $this->db->order_by('dates', 'desc'); }
            $this->db->limit(1);
            $val = $this->db->get($this->tableName)->row(); 
            return $val;
        }
        else{ return null; }
    }
    
    function get_stock($pid,$date)
    {
        $this->db->where('product_id', $pid);
        $this->db->where('dates', $date);
        $this->db->limit(1);
        $num = $this->db->get($this->tableName)->num_rows();
        if ($num > 0)
        {
            $this->db->order_by('dates', 'asc');
            $val = $this->db->get($this->tableName)->row(); 
            return $val;
        }
        else{ return null; }
    }
   
    
    function get_sum_stock($pid)
    {
       $this->db->where('product_id', $pid);
       return $this->db->get($this->tableName)->result();  
    }
    
    function get_sum_qty_stock($pid)
    {
       $this->db->select_sum('qty'); 
       $this->db->where('product_id', $pid);
       $res = $this->db->get($this->tableName)->row_array();  
       return intval($res['qty']);
    }
    
    function get_sum_amount_stock($pid)
    {
       $this->db->select('sum(qty*amount) as amount'); 
       $this->db->where('product_id', $pid);
       $res = $this->db->get($this->tableName)->row_array();  
       return floatval($res['amount']);
    }
    
    function unit_cost($pid){ 
        
        return @round($this->get_sum_amount_stock($pid)/$this->get_sum_qty_stock($pid)); 
        
    }
    
    function get_last_stock_price($pid) // fungsi get harga terakhir stock
    {
      $this->db->where('product_id', $pid);
      $this->db->order_by('dates', 'asc');
      $this->db->limit(1);
      
      $res = $this->db->get($this->tableName)->row();    
      if ($res){ return $res->amount; }else{ return 0; } 
      
    }
    
    function get_end_date_stock($pid,$start) // fungsi mendaptkan tnggal terakhir 
    {
       $this->db->select('dates');
       $this->db->where('product_id', $pid);
       $this->db->where('dates <', $start);
       $this->db->order_by('dates','desc');
       $this->db->limit(1);
       $res = $this->db->get($this->tableName)->row();
       if ($res){ return $res->dates; }else { return null; }
       
    }
    
    function cleaning()
    {
      $this->db->where('qty', 0);
      $this->db->delete($this->tableName);
    }

}

/* End of file Property.php */