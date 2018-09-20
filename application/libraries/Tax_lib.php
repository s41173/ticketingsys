<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tax_lib extends Custom_Model {

    public function __construct($deleted=NULL)
    {
        $this->deleted = $deleted;
        $this->tableName = 'tax';
    }

    function combo()
    {
        $this->db->select('id, name, code, value');
        $this->db->where('deleted', $this->deleted);
        $val = $this->db->get('tax')->result();
        foreach($val as $row){$data['options'][$row->value] = $row->code;}
        return $data;
    }

    function calculate($tax,$qty,$amount)
    {
        $tot = $qty*$amount;
        return floor($tax * $tot);
    }

    function calculate_tax($amount,$tax)
    {
       return $amount * $tax;
    }



}

/* End of file Property.php */