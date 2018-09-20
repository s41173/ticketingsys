<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attribute_lib extends Custom_Model {

    public function __construct($deleted=NULL)
    {
        $this->deleted = $deleted;
        $this->tableName = 'attribute';
        $this->attr_list = new Attribute_list_lib();
    }

    private $attr_list;
    protected $field = array('id', 'category_id', 'attribute_list_id', 'orders', 'created', 'updated', 'deleted');

    function combo($catid=null)
    {
        $data = null;
        $this->db->select($this->field);
        $this->db->where('category_id', $catid);
        $this->db->where('deleted', NULL);
        $val = $this->db->get($this->tableName)->result();
        if ($val){           
           foreach($val as $row){$data['options'][$row->attribute_list_id] = ucfirst($this->attr_list->get_name($row->attribute_list_id));}
        }
        else { $data['options'][''] = ' -- '; }
        return $data; 
    }
    
    function get_name($id=null)
    {
        if ($id)
        {
            $this->db->select('id,name');
            $this->db->where('id', $id);
            $val = $this->db->get($this->tableName)->row();
            if ($val){ return $val->name; }
        }
        else if($id == 0){ return 'Top'; }
        else { return ''; }
    }
    
    function combo_color()
    {
        $data = null;
        $this->db->select('name,descs');
        $this->db->where('deleted', NULL);
        $val = $this->db->get('color')->result();
        if ($val){           
           foreach($val as $row){$data['options'][$row->name] =  $row->name; }
        }
        else { $data['options'][''] = ' -- '; }
        return $data; 
    }
    
    function combo_size()
    {
        $data = null;
        $this->db->select('name,descs');
        $this->db->where('deleted', NULL);
        $val = $this->db->get('size')->result();
        if ($val){           
           foreach($val as $row){$data['options'][$row->name] =  $row->name; }
        }
        else { $data['options'][''] = ' -- '; }
        return $data; 
    }


}

/* End of file Property.php */