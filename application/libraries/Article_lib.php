<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_lib extends Custom_Model {

    public function __construct($deleted=NULL)
    {
        $this->deleted = $deleted;
        $this->tableName = 'article';
    }

    protected $field = array('id', 'category_id', 'user', 'lang', 'permalink', 'title', 'text', 'image', 'dates',
                             'time', 'counter', 'comment', 'front', 'publish',
                             'created', 'updated', 'deleted');
    
    function combo()
    {
        $this->db->select($this->field);
        $this->db->where('deleted', $this->deleted);
        $val = $this->db->get($this->tableName)->result();
        foreach($val as $row){$data['options'][$row->id] = ucfirst($row->title);}
        return $data;
    }
    
    function combo_category($cat=null)
    {
        $this->db->select($this->field);
        $this->db->where('deleted', $this->deleted);
        $this->cek_null($cat, 'category_id');
        $this->db->order_by('dates', 'desc');
        $val = $this->db->get($this->tableName);
        if ($val)
        {
          $data['options'][''] = ' -- ';  
          foreach($val->result() as $row){$data['options'][$row->id] = ucfirst($row->title);}
        }
        else{ $data['options'][null] = ' -- '; }
        return $data;   
    }
    
    function combo_update($id)
    {
        $this->db->select($this->field);
        $this->db->where('deleted', NULL);
        $this->db->order_by('name', 'asc');
        $this->db->where_not_in('id', $id);
        $val = $this->db->get($this->tableName)->result();
        $data['options'][0] = 'Top';
        foreach($val as $row){ $data['options'][$row->id] = ucfirst($row->name); }
        return $data;
    }
    
    function get_name($id=null)
    {
        if ($id)
        {
            $this->db->select($this->field);
            $this->db->where('id', $id);
            $val = $this->db->get($this->tableName)->row();
            if ($val){ return ucfirst($val->title); }
        }
        else { return ''; }
    }
    
    function get_content($id=null)
    {
        if ($id)
        {
            $this->db->select($this->field);
            $this->db->where('id', $id);
            $val = $this->db->get($this->tableName)->row();
            if ($val){ return ucfirst($val->text); }
        }
        else { return ''; }
    }


}

/* End of file Property.php */