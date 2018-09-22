<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Branch_lib extends Main_model {

    public function __construct($deleted=NULL)
    {
        $this->deleted = $deleted;
        $this->tableName = 'branch';
    }

    private $ci;
    
    protected $field = array('id', 'code', 'name', 'address', 'phone', 'mobile', 'email', 'city', 'zip', 'image', 'publish',
                             'defaults', 'sales_account', 'stock_account', 'unit_cost_account', 'ar_account',
                             'bank_account', 'cash_account', 'created', 'updated', 'deleted');
       
    
    function get_details($id)
    {
       $this->db->where('id', $id);
       return $this->db->get($this->tableName); 
    }
    
    function combo()
    {
        $this->db->select($this->field);
        $this->db->where('deleted', NULL);
        $this->db->order_by('code', 'asc');
        $val = $this->db->get($this->tableName)->result();
        if ($val){
          foreach($val as $row){ $data['options'][$row->id] = ucfirst($row->code.' : '.$row->name); }    
        }else{ $data['options'][''] = '--'; }
        return $data;
    }
    
    function combo_all()
    {
        $this->db->select($this->field);
        $this->db->where('deleted', NULL);
        $this->db->order_by('code', 'asc');
        $val = $this->db->get($this->tableName)->result();
        $data['options'][''] = '-- Select --';
        foreach($val as $row){ $data['options'][$row->id] = ucfirst($row->code.' : '.$row->name); }
        return $data;
    }
    
    function get_name($id=null)
    {
        if ($id)
        {
            $this->db->select($this->field);
            $this->db->where('id', $id);
            $val = $this->db->get($this->tableName)->row();
            if ($val){ return $val->code; }else{ return null; } 
        }
        else { return ''; }
    }
    
    function get_branch()
    {
       $this->db->select($this->field); 
       $this->db->where('defaults', 1);
       $val = $this->db->get($this->tableName)->row();
       if (!$this->session->userdata('branch')){ return $val->id; }else{ return $this->session->userdata('branch'); }
    }
    
    function get_default_acc_branch()
    {
       $this->db->select($this->field); 
       $this->db->where('defaults', 1);
       $val = $this->db->get($this->tableName)->row();
       return $val->stock_account; 
    }
    
    function get_branch_session()
    {
       if (!$this->session->userdata('branch')){ return null; }else{ return $this->session->userdata('branch'); }
    }
    
    function get_branch_default()
    {
       if (!$this->session->userdata('branch')){ 
           $this->db->select($this->field); 
           $this->db->where('defaults', 1);
           $val = $this->db->get($this->tableName)->row();
           return $val->id;
       }
       else{ return $this->session->userdata('branch'); }
    }
    
    function get_acc($val,$type='stock')
    {
       $this->db->select($this->field); 
       $this->db->where('id', $val);
       $res = $this->db->get($this->tableName)->row();
       if ($type == 'stock'){ return $res->stock_account; }
       elseif ($type == 'unit'){ return $res->unit_cost_account; }
       elseif ($type == 'ar'){ return $res->ar_account; }
       elseif ($type == 'sales'){ return $res->sales_account; }
       elseif ($type == 'bank'){ return $res->bank_account; }
       elseif ($type == 'cash'){ return $res->cash_account; }
    }

}

/* End of file Property.php */