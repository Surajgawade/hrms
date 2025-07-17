<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rpo_login_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                get_active_db();
                // Your own constructor code
        }

        function check_password($email,$password){
          $where_arr = array(
                             'email_id' => $email,
                             'is_deleted' => 0
                            );
          $this->db->select('can_id, can_name,email_id,password,can_type,profile_picture,designation');
          $this->db->where($where_arr);
          $query = $this->db->get('rpo_candidates');

          $num_rows = $query->num_rows();
    
          if($num_rows > 0){
             //var_dump($this->db->last_query()) ; die();
             return $row = $query->row();
          }
          else{
            return 0;
          }
        }
	function check_login_password($email,$password)
   {
      $where_arr = array(
                     'rpo_candidates.email_id' => $email,
                     'is_deleted' => 0
                     );
      $this->db->select('*');
      $this->db->from('rpo_candidates');
      // $this->datatables->join('rpo_candidates', 'users.email_id = rpo_candidates.email_id', 'left');
      $this->db->where($where_arr);
      $query = $this->db->get();
      $num_rows = $query->num_rows();    
      if($num_rows > 0)
      {
         //var_dump($this->db->last_query()) ; die();
         $resy = $this->yearly_leaves_add();
         return $row = $query->row();
      }
      else
      {
         return 0;
      }
  }

    function yearly_leaves_add()
    {
      $config_rec = $this->db->get_where('configuration_settings', array('conf_id'=>1))->row_array();
      $this->db->select('can_leave_records.*,candidate.joining_date');
      $this->db->from('can_leave_records');
      $this->db->join('candidate', 'candidate.can_id = can_leave_records.can_id','inner');
      $leaves_rec = $this->db->get()->result_array();
      $monthly_leaves = ($config_rec['PL']/12)+($config_rec['SL']/12)+($config_rec['CL']/12);
      $date = date_create($config_rec['year_start_date']);
      $ndate = date_create(date('Y-m-d'));
      $diff = date_diff($date, $ndate);
      $d = $diff->format("%R%a");
      $year = date('Y');
      $start_year = date('Y' ,strtotime($config_rec['year_start_date']));
      $res = 0;
      if(date('Y-m-d') == $config_rec['year_start_date'])
      {
        $this->db->set('mail_sent', 0);
        $mails_sent = $this->db->update('insurance_details');
        if($year > $start_year)
        {
          if($d >= 0)
          {
            $start = date('m-d', strtotime($config_rec['year_start_date']));
            $end = date('m-d', strtotime($config_rec['year_end_date']));
            $start_date = $year.'-'.$start;
            $end_date = $year.'-'.$end;
            $this->db->set('year_start_date', $start_date);
            $this->db->set('year_end_date', $end_date);
            $this->db->where('conf_id', 1);
            $res = $this->db->update('configuration_settings');
            if($res > 0)
            {
              $sdate = date_create($start_date);
              $diff2 = date_diff($sdate, $ndate);
              $m = $diff2->format("%R%m");
              if($m >= 0)
              {
                if(!empty($leaves_rec))
                {
                  foreach ($leaves_rec as $key => $value)
                  {
                    if($value['joining_date'] > date('Y-01-01'))
                    {
                      $jdate = date_create($value['joining_date']);
                      $diff3 = date_diff($jdate, $ndate);
                      $m = $diff3->format("%R%m");
                    }
                    $this->db->set('alloted_leave', $m*$monthly_leaves);
                    $this->db->set('balance_leave', $value['balance_leave']);
                    $this->db->where('id', $value['id']);
                    $leaves = $this->db->update('can_leave_records');
                  }
                }
              }
            }
          }
        }
      }
      else if(date('Y-m-d') == date('Y-m-01'))
      {
        $sdate = date_create($config_rec['year_start_date']);
        $diff2 = date_diff($sdate, $ndate);
        $m = $diff2->format("%R%m");
        if($m >= 0)
        {
          if(!empty($leaves_rec))
          {
            foreach ($leaves_rec as $key => $value)
            {
              if($value['joining_date'] > date('Y-01-01'))
              {
                $jdate = date_create($value['joining_date']);
                $diff3 = date_diff($jdate, $ndate);
                $m = $diff3->format("%R%m");
                if($m <= 0)
                {
                  $m = 0;
                }
              }
              $this->db->set('alloted_leave', $m*$monthly_leaves);
              $this->db->where('id', $value['id']);
              $res = $this->db->update('can_leave_records');
            }
          }
        }
      }
      return $res;
    }
}
