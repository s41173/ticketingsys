<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_lib extends Main_model {

    public function __construct($deleted=NULL)
    {
        // Do something with $params
        $this->deleted = $deleted;
        $this->tableName = 'log';
    }
    
    protected $field = array('log.id', 'log.userid', 'log.date', 'log.time', 'log.component_id', 'log.activity',
                             'log.description',
                             'log.created', 'log.updated', 'log.deleted');

    public function max_log()
    {
        $this->db->select_max('id');
        $val = $this->db->get($this->tableName)->row_array();
        $val = $val['id'];
        return $val;
    }
    
    function get_user($log){
       $this->db->select($this->field);
       $this->db->where('id', $log);
       $val = $this->db->get($this->tableName)->row();
       if ($val){ return $val->userid; }else{ return null; }
       
    }

    public function insert($userid=null, $date=null, $time=null, $activity=null, $com=0, $desc='')
    {
        $logs = array('userid' => $userid, 'date' => $date, 'time' => $time, 'activity' => $activity, 'component_id' => $com,
                      'description' => $desc);
        $this->db->insert($this->tableName, $logs);
    }
}

/* End of file Property.php */