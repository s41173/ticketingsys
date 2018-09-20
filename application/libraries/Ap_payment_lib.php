<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ap_payment_lib extends Custom_Model {

    public function __construct()
    {
        $this->table = 'ap_payment';
        $this->table2 = 'payment_trans';
    }

    private $table;


    //    ======================= relation cek  =====================================

    
    function cek_relation($id,$type)
    {
       $this->db->where($type, $id);
       $query = $this->db->get($this->table)->num_rows();
       if ($query > 0) { return FALSE; } else { return TRUE; }
    }
    
    function cek_relation_trans($id,$type,$code='PO')
    {
       $this->db->where($type, $id);
       $this->db->where('code', $code);
       $query = $this->db->get($this->table2)->num_rows();
       if ($query > 0) { return FALSE; } else { return TRUE; }
    }
    
    function combo_over($vendor=null,$cur='IDR')
    {
        $data['options']['0'] = '-- Select --';
        $this->db->select('id, no, dates, over');
        $this->cek_null($vendor, 'vendor');
        $this->db->where('currency', $cur);
        $this->db->where('over_stts', 1);
        $this->db->where('credit_over', 0);
        $val = $this->db->get($this->table)->result();
        if ($val){
          foreach($val as $row){$data['options'][$row->no] = 'CD-0'.$row->no.' : '.tglin($row->dates).' = '.number_format($row->over);}  
        }
        return $data;
    }
    
    function get_over_payment($no)
    {
       $this->db->select('id, no, dates, over');
       $this->db->where('no', $no);
       $this->db->where('over_stts', 1);
       $this->db->where('credit_over', 0);
       $res = $this->db->get($this->table)->row();
       return intval($res->over);
    }
    
    function get_dates($no)
    {
       $this->db->select('id, no, dates, over');
       $this->db->where('no', $no);
       $res = $this->db->get($this->table)->row();
       return intval($res->dates);
    }
    
    function set_over_stts($no, $users)
    {
        $this->db->where('no', $no);
        $this->db->update($this->table, $users);
    }
    
    function set_post_stts($no, $users)
    {
        $this->db->where('no', $no);
        $this->db->update($this->table, $users);
    }

}

/* End of file Property.php */