<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_status_lib {

    public function __construct()
    {
        $this->ci = & get_instance();
    }

    private $ci;
    private $table = 'fee_payment_status';
    private $fee;

//  $date = tanggal, $currency = matauang, $code = PJ001 - Pembelian Notes, $codetrans = PJ/ SJ, $no = no, $type = AP / AR, $amount = nominal;

    function create($student,$year,$month,$datevalue)
    {
        if ( $this->cek($student,$year) == FALSE ){ $this->edit($student,$year,$month,$datevalue); }
        else { $this->new_add($student,$year,$month,$datevalue); }
    }

    private function cek($student,$year)
    {
        $this->ci->db->where('student_id', $student);
        $this->ci->db->where('financial_year', $year);
        $query = $this->ci->db->get($this->table)->num_rows();
        if($query > 0) { return FALSE; } else { return TRUE; }
    }

    private function edit($student,$year,$month,$datevalue)
    {
        $value = array($month => $datevalue);
        
        $this->ci->db->where('student_id', $student);
        $this->ci->db->where('financial_year', $year);
        $this->ci->db->update($this->table, $value);
    }

    private function new_add($student,$year,$month,$datevalue)
    {
        $value = array('student_id' => $student, 'financial_year' => $year, $month => $datevalue);
        $this->ci->db->insert($this->table, $value);
    }
    
    function add_payment($student,$year)
    {
        $value = array('student_id' => $student, 'financial_year' => $year);
        $this->ci->db->insert($this->table, $value);
    }

//    ============================  remove transaction journal ==============================

    function remove($student,$year,$month)
    {
        $value = array($month => null);
        $this->ci->db->where('student_id', $student);
        $this->ci->db->where('financial_year', $year);
        $this->ci->db->update($this->table, $value);
    }
    
    function delete($student)
    {
        $this->ci->db->where('student_id', $student);
        $this->ci->db->delete($this->table);
    }

//  =======================  student migration  =======================================    
    function migration()
    {
        $this->ci->db->select('students_id');
        $this->ci->db->from('students');
        $result = $this->ci->db->get()->result();
        $fyear = new Financial_lib();
        $i=0;
        
        foreach ($result as $res)
        {
            if ( $this->cek($res->students_id,$fyear->get()) == TRUE )
            { $this->migration_process($res->students_id,$fyear->get()); $i++;}
        }
        return $i;
    }
    
    private function migration_process($student,$year)
    {
        $value = array('student_id' => $student, 'financial_year' => $year);
        $this->ci->db->insert($this->table, $value);
    }
    
//  =======================  student migration  =======================================    
    
//  =======================  validasi  =======================================

    function valid_payment($student, $month, $year)
    {
        $this->ci->db->where('student_id', $student);
        $this->ci->db->where('financial_year', $year);
        $val = $this->ci->db->get($this->table)->row();

        if ($val->$month){ return FALSE; } else{ return TRUE; }
    }
    
    function get_all_miss_payment($student,$year) // fungsi untuk mendapatkan jumlah bulan tunggakan
    {
       $this->ci->db->where('student_id', $student);
       $this->ci->db->where('financial_year', $year); 
       $val = $this->ci->db->get($this->table)->row();
       
       $ps = new Period();
       $ps->get();
//       $now = $this->months_periode($ps->month);
       $now = 12;
       
       if ($val)
       {
          $res=0;
       
          for($i=1; $i<=12; $i++)
          {
             $pi = 'p'.$i;
             if ($val->$pi != null){ $res = $res+1; }
          }
          if($now - $res < 0){ return 0; }else{ return $now-$res; }
       }  
    }
    
    function get_miss_payment($student,$year) // fungsi untuk mendapatkan jumlah bulan tunggakan
    {
       $this->ci->db->where('student_id', $student);
       $this->ci->db->where('financial_year', $year); 
       $val = $this->ci->db->get($this->table)->row();
       
       $ps = new Period();
       $ps->get();
       $now = $this->months_periode($ps->month);
       
       if ($val)
       {
          $res=0;
          for($i=1; $i<=12; $i++)
          {
             $pi = 'p'.$i;
             if ($val->$pi != null){ $res = $res+1; }
          }
          if($now - $res < 0){ return 0; }else{ return $now-$res; }
       }  
    }
    
    function get_miss_payment_period($student,$year,$request) // fungsi untuk mendapatkan tunggakan sesuai bulan
    {
       $this->ci->db->where('student_id', $student);
       $this->ci->db->where('financial_year', $year); 
       $val = $this->ci->db->get($this->table)->row();
       
       $ps = new Period();
       $ps->get();
       $now = $this->months_periode($request);
       
       if ($val)
       {
          $res=0;
          for($i=1; $i<=12; $i++)
          {
             $pi = 'p'.$i;
             if ($val->$pi != null){ $res = $res+1; }
          }
          if($now - $res < 0){ return 0; }else{ return $now-$res; }
       }  
    }
    
    function get_front_payment($student,$year)
    {
       $this->ci->db->where('student_id', $student);
       $this->ci->db->where('financial_year', $year); 
       $val = $this->ci->db->get($this->table)->row();
       
       $ps = new Period();
       $ps->get();
       $now = $this->months_periode($ps->month);
       
       if ($val)
       {
          $res=0;
          for($i=1; $i<=12; $i++)
          {
             $pi = 'p'.$i;
             if ($val->$pi != null){ $res = $res+1; }
          }
          if($res - $now  < 0){ return 0; }else{ return $res-$now; }
       }  
    }
    
    function get_month_status($student,$year) // fungsi untuk mendapatkan status pembayaran bulan sekarang
    {
       $this->ci->db->where('student_id', $student);
       $this->ci->db->where('financial_year', $year); 
       $val = $this->ci->db->get($this->table)->row();
       
       if ($val)
       {
          $res=0;
       
          for($i=1; $i<=12; $i++)
          {
             $pi = 'p'.$i;
             if ($val->$pi == null){ $res = $i; break; }
          }
          return $res;
       }  
    }
    
    function get_front_status($student,$year)
    {
       $this->ci->db->where('student_id', $student);
       $this->ci->db->where('financial_year', $year); 
       $val = $this->ci->db->get($this->table)->row();
       
       $ps = new Period();
       $ps->get();
       $now = $this->months_periode($ps->month)+1;
       
       if ($val)
       {
          $res=0;
       
          for($i=12; $i>=$now; $i--)
          {
             $pi = 'p'.$i;
             if ($val->$pi != null){ $res = $i; break; }
          }
          return $res;
       }  
    }
    
    function get_period_type($val=1,$year=null)
    {
        $fyear = new Financial_lib();
        $fyear = $fyear->get();
        $ps = new Period();
        $ps->get();
        
        $now = $this->months_periode($ps->month);
        $month = $val;
        $res=0;
        
        if ($fyear == $year )
        {
          if ($now > $month){ $res = 0; }
          elseif ( $now == $month ){ $res=1;}
          elseif ($now < $month){ $res=2; }
          return $res;  
        }
        else { return 0; }
    }
    
    public function months_periode($month)
    {
        $res=0;
        switch ($month) 
        {
            case 7:$res=1; break;
            case 8:$res=2; break;
            case 9:$res=3; break;
            case 10:$res=4; break;
            case 11:$res=5; break;
            case 12:$res=6; break;
            case 1:$res=7; break;
            case 2:$res=8; break;
            case 3:$res=9; break;
            case 4:$res=10; break;
            case 5:$res=11; break;
            case 6:$res=12; break;
        }
        return $res;
    }
    
    public function months_from_period($month)
    {
        $res=0;
        switch ($month) 
        {
            case 1:$res=7; break;
            case 2:$res=8; break;
            case 3:$res=9; break;
            case 4:$res=10; break;
            case 5:$res=11; break;
            case 6:$res=12; break;
            case 7:$res=1; break;
            case 8:$res=2; break;
            case 9:$res=3; break;
            case 10:$res=4; break;
            case 11:$res=5; break;
            case 12:$res=6; break;
        }
        return $res;
    }
    
    public function months_name($month)
    {
        $res=0;
        switch ($month) 
        {
            case 1:$res='Jul'; break;
            case 2:$res='Aug'; break;
            case 3:$res='Sep'; break;
            case 4:$res='Oct'; break;
            case 5:$res='Nov'; break;
            case 6:$res='Dec'; break;
            case 7:$res='Jan'; break;
            case 8:$res='Feb'; break;
            case 9:$res='Mar'; break;
            case 10:$res='Apr'; break;
            case 11:$res='May'; break;
            case 12:$res='Jun'; break;
        }
        return $res;
    }
    
    public function year_name($month,$financial)
    {
        $year = explode('-', $financial);
        $res=0;
        switch ($month) 
        {
            case 1:$res=$year[0]; break;
            case 2:$res=$year[0]; break;
            case 3:$res=$year[0]; break;
            case 4:$res=$year[0]; break;
            case 5:$res=$year[0]; break;
            case 6:$res=$year[0]; break;
            case 7:$res=$year[1]; break;
            case 8:$res=$year[1]; break;
            case 9:$res=$year[1]; break;
            case 10:$res=$year[1]; break;
            case 11:$res=$year[1]; break;
            case 12:$res=$year[1]; break;
        }
        return $res;
    }

//  ======================= validasi  =======================================
    
 // ======================= fungsi untuk rekapitulasi =======================
    
    private function cek_null($val,$field)
    { if (isset($val)){ return $this->ci->db->where($field, $val); } }
    
    function get_miss_recapitulation($dept=null,$grade=null,$monthperiod,$year)
    {
        $bulan = $this->months_from_period($monthperiod);
        $tahun = $this->year_name($monthperiod, $year);
        
        $this->ci->db->select('id, student_id, p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, p11, p12, financial_year');
        $this->ci->db->from('fee_payment_status, students');
        $this->ci->db->where('fee_payment_status.student_id = students.students_id');
//        $this->ci->db->where('students.dept_id', $dept);
//        $this->ci->db->where('students.grade_id', $grade);
        $this->cek_null($dept, 'students.dept_id');
        $this->cek_null($grade, 'students.grade_id');
        $this->ci->db->where('financial_year', $year);
//        $this->ci->db->where('students.active', 1);
//        ============ JOIN ================================
        $this->ci->db->where('students.resign >', $tahun.'-'.$bulan.'-'.get_total_days($bulan));
        $this->ci->db->where('students.joined <=', $tahun.'-'.$bulan.'-'.get_total_days($bulan));
        $payments = $this->ci->db->get()->result(); 
        
        $total = 0;
        $period = $this->months_from_period($monthperiod);
        foreach ($payments as $res)
        {
            $total = $total + $this->get_miss($res,$period,$monthperiod);
        }
        return intval($total);
    }
    
    private function get_miss($res,$period,$monthperiod)
    {
        $result = 0;
        for($i=1; $i<=$monthperiod; $i++)
        {
            $pi = 'p'.$i;
            if ($this->cekdate($res->$pi,$period) == '-'){ $result = $result + 0; }
            else { $result = $result + 1; }
        }
        return intval($monthperiod-$result);  
    }
    
    private function cekdate($date=null,$period=null)
    { 
        $period = $this->months_periode($period);
        $res = null;
        if ($date)
        {
           $m = $this->months_periode(date('n', strtotime($date))); 
           if ($m <= $period){ $res = $date; }else{ $res = '-'; }
        }
        else { $res = '-'; }
        return $res;
    }
 
    
    // fungsi rekapitulasi pembayaran di muka
    function get_front_recapitulation($dept,$grade,$month,$year,$detail=null)
    {
        $monthperiod = $this->months_periode($month);
        
        $tahun = $this->year_name($monthperiod, $year);
        
        $this->ci->db->select('id, student_id, p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, p11, p12, financial_year');
        $this->ci->db->from('fee_payment_status, students');
        $this->ci->db->where('fee_payment_status.student_id = students.students_id');
        $this->ci->db->where('students.dept_id', $dept);
        $this->ci->db->where('students.grade_id', $grade);
        $this->ci->db->where('financial_year', $year);
//        $this->ci->db->where('students.active', 1);
        
        $this->ci->db->where('students.resign >', $tahun.'-'.$month.'-'.get_total_days($month));
        $this->ci->db->where('students.joined <=', $tahun.'-'.$month.'-'.get_total_days($month));
        
        $this->ci->db->where("MONTH(p$monthperiod) <", $month);
        if (!$detail){ $num = $this->ci->db->get()->num_rows(); return $num; }
        else { $result = $this->ci->db->get()->result(); return $result; }
    }
    
    // fungsi rekapitulasi sortir berdasarkan jenis tuition
    function get_miss_recapitulation_based_fee($dept,$grade,$monthperiod,$year,$fee)
    {
        $bulan = $this->months_from_period($monthperiod);
        $tahun = $this->year_name($monthperiod, $year);
        
        $this->ci->db->select('id, student_id, p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, p11, p12, financial_year');
        $this->ci->db->from('fee_payment_status, students');
        $this->ci->db->where('fee_payment_status.student_id = students.students_id');
        $this->ci->db->where('students.dept_id', $dept);
        $this->ci->db->where('students.grade_id', $grade);
        $this->ci->db->where('financial_year', $year);
//        $this->ci->db->where('students.active', 1);
        $this->ci->db->where('students.resign >', $tahun.'-'.$bulan.'-'.get_total_days($bulan));
        $this->ci->db->where('students.joined <=', $tahun.'-'.$bulan.'-'.get_total_days($bulan));
        
        $payments = $this->ci->db->get()->result(); 
        
        $total = 0;
        $period = $this->months_from_period($monthperiod);
        foreach ($payments as $res)
        {
            $total = $total + $this->get_miss_student($res,$period,$monthperiod,$fee);
        }
        if ($total != null){ return $total; }else{ return 0; }

    }
    
    private function get_miss_student($res,$period,$monthperiod,$fee)
    {
        $result = 0;
        for($i=1; $i<=$monthperiod; $i++)
        {
            $pi = 'p'.$i;
            if ($this->cekdate($res->$pi,$period) == '-'){ $result = intval($result + 0);}
            else { $result = intval($result + 1); }
        }
        $result = intval($monthperiod-$result);  

        if ($this->fee->get_by_student($res->student_id) == $fee){ return $result; }else {return null;}
    }
    
}
