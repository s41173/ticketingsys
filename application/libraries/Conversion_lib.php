<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conversion_lib extends Main_model {

    public function __construct($deleted=NULL)
    {
        $this->deleted = $deleted;
        $this->tableName = 'conversion';
    }

    private $ci;
    
    protected $field = array('id', 'num', 'alpha', 'created', 'updated', 'deleted');
       
    
    private function get()
    {
       $this->db->order_by('alpha', 'asc'); 
       $res = $this->db->get($this->tableName)->result(); 
       
       $a=array("A"=>"9","B"=>"9","C"=>"9","D"=>"9","E"=>"9","F"=>"9","G"=>"9","H"=>"9","I"=>"9","J"=>"9",
                "K"=>"9","L"=>"9","M"=>"9","N"=>"9","O"=>"9","P"=>"9","Q"=>"9","R"=>"9","S"=>"9","T"=>"9","U"=>"9","V"=>"9",
                "W"=>"9","X"=>"9","Y"=>"9","Z"=>"9"
                );
       foreach ($res as $row){
           $a[$row->alpha] = $row->num;
       }
       return $a;
//       print_r($a);
    }
    
    function calculate($par='374')
    {
       $a = $this->get();
       $param = str_split($par);
       
       $res=array();
       for($i=0; $i<count($param); $i++)
       {
           $res[$i] = array_search($param[$i],$a);
       }
       return implode('', $res);
    }


}

/* End of file Property.php */