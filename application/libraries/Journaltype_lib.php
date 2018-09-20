<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Journaltype_lib extends Custom_Model {

    public function __construct($deleted=NULL)
    {
        $this->deleted = $deleted;
        $this->tableName = 'journaltypes';
        $this->le = new Ledger_lib();
        $this->period = new Period_lib();
    }
    
    private $period;
    private $le,$currency;	

    function combo()
    {
        $this->db->select('code');
        $this->db->order_by('code', 'asc'); 
        $this->db->distinct();
        $val = $this->db->get($this->tableName)->result();
        if ($val){
          foreach($val as $row){$data['options'][$row->code] = $row->code;}
          return $data;  
        }else { return null; }
        
    }

    function combo_all()
    {
        $data = null;
        $this->db->select('code');
        $this->db->order_by('code', 'asc'); 
        $this->db->distinct();
        $val = $this->db->get($this->tableName)->result();
        $data['options'][''] = '-- All --';
        if ($val){
          foreach($val as $row){$data['options'][$row->code] = $row->code;}
          $data;  
        }
        return $data;
    }

    function get_code($name=null)
    {
        $this->db->select('code');
        $this->db->from($this->tableName);
        $this->db->where('name', $name);
        $res = $this->db->get()->row();
        return $res->code;
    }


}

/* End of file Property.php */
