<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_lib {

    public function __construct()
    {
        $this->ci = & get_instance();
    }

    private $ci;


//    fungsi di panggil ketika ada po yg masih blm approved ketika hendak closing harian
    function cek_approval_po($date,$currency)
    {
        $this->ci->db->where('dates', $date);
        $this->ci->db->where('currency', $currency);
        $this->ci->db->where('approved', 0);

        $query = $this->ci->db->get('purchase')->num_rows();
        if($query > 0) { return FALSE; } else { return TRUE; }
    }

    function get_po($no)
    {
        $this->ci->db->select('id, p2, notes, docno, vendor, dates, currency');
        $this->ci->db->where('no', $no);
        $query = $this->ci->db->get('purchase')->row();
        return $query;
    }
    
    function get_buying_price($pname,$no)
    {
        $this->ci->db->select('price');
        $this->ci->db->where('purchase_id', $no);
        $this->ci->db->where('name', $pname);
        $query = $this->ci->db->get('purchase_item')->row();
        return intval($query->price);
    }

    function cek_settled($no=null)
    {
        $this->ci->db->select('status');
        $this->ci->db->where('no', $no);
        $query = $this->ci->db->get('purchase')->row();
        if($query->status != 0) { return FALSE; } else { return TRUE; }
    }

    function settled_po($uid, $users)
    {
        $this->ci->db->where('no', $uid);
        $this->ci->db->update('purchase', $users);
    }
    

//    ======================= relation cek  =====================================

    // vendor
    function cek_relation($id,$type)
    {
       $this->ci->db->where($type, $id);
       $query = $this->ci->db->get('purchase')->num_rows();
       if ($query > 0) { return FALSE; } else { return TRUE; }
    }

    // backup =======

    function closing()
    {
        $this->ci->db->select('no');
        $this->ci->db->where('status', 1);
        $this->ci->db->where('approved', 1);
        $query = $this->ci->db->get('purchase')->result();

        foreach ($query as $value)
        { $this->delete($value->no); }
    }

    private function delete($po)
    {
       $this->ci->db->where('purchase_id', $po);
       $this->ci->db->delete('purchase_item');

       $this->ci->db->where('no', $po);
       $this->ci->db->delete('purchase');
    }

}

/* End of file Property.php */
