<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout_lib {

    public function __construct()
    {
        $this->ci = & get_instance();
        $this->table = 'checkout';
    }

    private $ci,$table;

    

    function update_check($no=null,$data=null)
    {
        if ($no)
        {
            $this->ci->db->where('no', $no);
            $this->ci->db->update($this->table, $data);
        } 
    }

    function create_check_no($no=null,$currency=null,$bank=null,$date=null,$due=null,$amount=null)
    {
        if ($no)
        {
           $cek = array('no' => $no, 'currency' => $currency, 'bank' => $bank, 'dates' => $date, 'due' => $due, 'amount' => $amount);
           $this->ci->db->insert($this->table, $cek);
        }
    }

    function edit_check_no($no,$bank=null,$date=null,$due=null,$amount=null)
    {
        $cek = array('bank' => $bank, 'dates' => $date, 'due' => $due, 'amount' => $amount);
        $this->ci->db->where('no', $no);
        $this->ci->db->update($this->table, $cek);
    }



    function get_check_by_no($no=null)
    {
        if ($no)
        {
            $this->ci->db->where('no', $no);
            $jid = $this->ci->db->get($this->table)->row();
            return $jid;
        }
        else { return FALSE; }
        
    }

    public function cek_no($no)
    {
        $this->ci->db->where('no', $no);
        $num = $this->ci->db->get($this->table)->num_rows();

        if ($num > 0) { return FALSE; } else { return TRUE; }
    }


    function remove($no)
    {
        $this->ci->db->where('no', $no);
        $this->ci->db->delete($this->table);
    }


//  =======================  cek approval  =======================================

}

/* End of file Property.php */
