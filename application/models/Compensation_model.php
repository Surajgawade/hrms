<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compensation_model extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            // Your own constructor code
    }

    function save_emp_salary_details($salary_data, $sd_id = 0)
    {
        if($sd_id > 0)
        {
            $this->db->where('sd_id',$sd_id);
            return $this->db->update('emp_salary_details',$salary_data);
        }
        else
        {
            $this->db->insert('emp_salary_details', $salary_data);
            return $this->db->insert_id(); 
        }        
    }

    function emp_salary_details($sd_id)
    {
        return $this->db->get_where('emp_salary_details', array('sd_id' => $sd_id, 'is_deleted' => 0))->row();
    }

    function generate_salary_slip($salary_slip_data)
    {
        if($salary_slip_data['salary_slip_id'] > 0)
        {
            $this->db->where('salary_slip_id',$salary_slip_data['salary_slip_id']);
            return $this->db->update('emp_monthly_salary_slips',$salary_slip_data);
        }
        else
        {
            $this->db->insert('emp_monthly_salary_slips', $salary_slip_data);
            return $this->db->insert_id();
        }   
    }
    
    function get_can_salary_details($sd_id)
    {
        $this->db->select('c.can_id, c.can_name, c.joining_date ,j.title as job_profile_title,d.title as department_title, e.*');    
        $this->db->from('candidate c');
        $this->db->join('job_profiles j', 'c.job_profile =  j.id');
        $this->db->join('emp_salary_details e', 'c.can_id = e.can_id');
	   $this->db->join('departments d', 'c.department =  d.id');
        // $this->db->join('can_leave_records l', 'c.can_id = l.can_id');
        $this->db->where('e.is_deleted',0);
        $this->db->where('e.sd_id',$sd_id);
        $this->db->order_by('e.sd_id','desc');
        $this->db->limit(1);
        return $query = $this->db->get()->row();
        // echo $this->db->last_query();exit;
        // x_debug($query);
    }

	    function get_salary_slip_details($salary_slip_id)
    {
        $this->db->select('candidate.can_name,candidate.joining_date,candidate.job_profile,job_profiles.title as job_profile_title,d.title as department_title,emp_salary_details.*,emp_monthly_salary_slips.*');
        $this->db->from('emp_monthly_salary_slips');
        $this->db->join('candidate', 'candidate.can_id = emp_monthly_salary_slips.can_id');
        $this->db->join('emp_salary_details', 'emp_salary_details.can_id = emp_monthly_salary_slips.can_id');
        $this->db->join('job_profiles', 'job_profiles.id = candidate.job_profile','LEFT');
        $this->db->join('departments d', 'candidate.department =  d.id');        
        // $this->db->join('can_leave_records', 'can_leave_records.can_id = emp_monthly_salary_slips.can_id');
        $this->db->where(array('emp_monthly_salary_slips.salary_slip_id' => $salary_slip_id,'emp_monthly_salary_slips.is_deleted' => 0));
        return $this->db->get()->row();
    }
    
    function delete($tablename,$fieldname,$id)
    {
        $this->db->set('is_deleted',1);
        $this->db->where($fieldname,$id);
        $this->db->update($tablename);
    }

    function get_present_days_old($can_id)
    {
        $y = date('Y');
        $m = date('m');
        $days = $this->db->get_where('attendance', array('can_id'=>$can_id, 'month'=>--$m, 'year'=>$y))->row_array();
        $n = 0;
        $h = 0;
        $l = 0;
        $p = 0;
        $a = 0;
        if(!empty($days))
        {
            foreach ($days as $key => $value) {
                if(strpos($key, 'd') !== FALSE)
                {
                    if($value == 'P')
                    {
                        $p++;
                    }
                    else if($value == 'H')
                    {
                        $h++;
                    }
                    else if($value == 'L')
                    {
                        $l++;
                    }
                    else if($value == 'A')
                    {
                        $a++;
                    }
                    else
                    {
                        $n++;
                    }
                }
            }
            $half_days = $h/2;
            $p = $p + $half_days;
        }
        return $p;
    }

	function get_present_days1($can_id)
    {
        $y = date('Y');
        $m = date('m');
        --$m;
        if($m <= 0)
        {
            $m = 12;
            --$y;
        }
        $days = $this->db->get_where('attendance', array('can_id'=>$can_id, 'month'=>$m, 'year'=>$y, 'is_deleted'=>0))->row_array();
        $min = 0;
        $h = 0;
        $p = 0;
        $half_days = 0;
        $full_days = 0;
        $early_leave = 0;
        if(!empty($days))
        {
            for($i = 1; $i<=31; $i++)
            {
                $min = $min + ($days['d'.$i.'_hours'] * 60);
                if(($days['d'.$i.'_hours'] >= $this->config->item('half_hours_per_day')) && ($days['d'.$i.'_hours'] < $this->config->item('grace_time')))
                {
                    $half_days++;
                }
                else if(($days['d'.$i.'_hours'] > $this->config->item('grace_time')) && ($days['d'.$i.'_hours'] < $this->config->item('hours_per_day')))
                {
                    if($early_leave >= 2)
                    {
                        $half_days++;
                    }
                    else
                    {
                        $early_leave++;
                    }
                }
                else if($days['d'.$i.'_hours'] >= $this->config->item('hours_per_day'))
                {
                    $full_days++;
                }
            }
        }
        if($min > 0)
        {
            $h = $min / 60;
        }
        if($h > 0)
        {
            $p = $h / 9;
        }
        $sundays = 0;
        $saturdays = 0;
        $sats = 0;
        $sec_sat = array();
        $total_days = cal_days_in_month(CAL_GREGORIAN, $m, $y);
        for($i=1; $i<=$total_days; $i++)
        {
            if(date('N',strtotime($y.'-'.$m.'-'.$i)) == 7)
            {
                $sundays++;
            }
            if(date('N',strtotime($y.'-'.$m.'-'.$i)) == 6)
            {
                $sats++;
                $saturdays++;
                if(in_array($sats, $this->config->item('weekoff_sat')))
                {
                    $sec_sat[] = date('Y-m-d', strtotime($y.'-'.$m.'-'.$i));
                }
            }
        }
        $holidays = 0;
        $h_days = $this->db->get_where('holiday', array('holiday_year'=>$y, 'holiday_month'=>$m, 'is_deleted'=>0))->result_array();
        if(!empty($h_days))
        {
            foreach ($h_days as $key => $value)
            {
                if(($value['holiday_day'] != 'Sunday') && (!in_array($value['holiday_date'], $sec_sat)))
                {
                    $holidays++;
                }
            }
        }
        $weekly_offs = ++$sundays;
        $working_days = $total_days - ($weekly_offs + $holidays);
        $present_days = $full_days + $early_leave + ($half_days / 2);
        $leave_days = $working_days - $present_days;
        if($leave_days > 0)
        {
            if($leave_days == 1)
            {
                --$leave_days;
            }
            else
            {
                $leave_days = $leave_days - 2;
            }
        }
        $monthly_hours = $working_days * $this->config->item('hours_per_day');
        $lack_time = 0;
        $over_time = 0;
        if($monthly_hours > $h)
        {
            $lack_time = $monthly_hours - $h;
        }
        else
        {
            $over_time = $h - $monthly_hours;
        }
        return $present_days;
    }

    function get_present_days($can_id)
    {
        $y = date('Y');
        $m = date('m');
        --$m;
        if($m <= 0)
        {
            $m = 12;
            --$y;
        }
        $days = $this->db->get_where('attendance', array('can_id'=>$can_id, 'month'=>$m, 'year'=>$y, 'is_deleted'=>0))->row_array();
        $min = 0;
        $h = 0;
        $p = 0;
        $half_days = 0;
        $full_days = 0;
        $early_leave = 0;
        if(!empty($days))
        {
            for($i = 1; $i<=31; $i++)
            {
                $min = $min + ($days['d'.$i.'_hours'] * 60);
                if($days['d'.$i.'_hours'] >= $this->config->item('hours_per_day'))
                {
                    $full_days++;
                }
                else if(($days['d'.$i.'_hours'] >= $this->config->item('half_hours_per_day')) && ($days['d'.$i.'_hours'] < $this->config->item('grace_time')))
                {
                    if($early_leave >= 2)
                    {
                        $half_days++;
                    }
                    else
                    {
                        $full_days++;
                        $early_leave++;
                    }
                }
                else if(($days['d'.$i.'_hours'] >= $this->config->item('grace_time')) && ($days['d'.$i.'_hours'] < $this->config->item('hours_per_day')))
                {
                    $half_days++;
                }
            }
        }
        if($min > 0)
        {
            $h = $min / 60;
        }
        if($h > 0)
        {
            $p = $h / 9;
        }
        $sundays = 0;
        $saturdays = 0;
        $sats = 0;
        $sec_sat = array();
        $total_days = cal_days_in_month(CAL_GREGORIAN, $m, $y);
        for($i=1; $i<=$total_days; $i++)
        {
            if(date('N',strtotime($y.'-'.$m.'-'.$i)) == 7)
            {
                $sundays++;
            }
            if(date('N',strtotime($y.'-'.$m.'-'.$i)) == 6)
            {
                $sats++;
                $saturdays++;
                if(in_array($sats, $this->config->item('weekoff_sat')))
                {
                    $sec_sat[] = date('Y-m-d', strtotime($y.'-'.$m.'-'.$i));
                }
            }
        }
        $holidays = 0;
        $h_days = $this->db->get_where('holiday', array('holiday_year'=>$y, 'holiday_month'=>$m, 'is_deleted'=>0))->result_array();
        if(!empty($h_days))
        {
            foreach ($h_days as $key => $value)
            {
                if(($value['holiday_day'] != 'Sunday') && (!in_array($value['holiday_date'], $sec_sat)))
                {
                    $holidays++;
                }
            }
        }
        $weekly_offs = ++$sundays;
        $working_days = $total_days - ($weekly_offs + $holidays);
        // $present_days = $full_days + $early_leave + ($half_days / 2);
        $present_days = $full_days + ($half_days / 2);
        $leave_days = $working_days - $present_days;
        if($leave_days > 0)
        {
            if($leave_days == 1)
            {
                --$leave_days;
            }
            else
            {
                $leave_days = $leave_days - 2;
            }
        }
        $monthly_hours = $working_days * $this->config->item('hours_per_day');
        $lack_time = 0;
        $over_time = 0;
        if($monthly_hours > $h)
        {
            $lack_time = $monthly_hours - $h;
        }
        else
        {
            $over_time = $h - $monthly_hours;
        }
        return $present_days;
    }

    function get_monthly_salary_slips($month,$year)   
    {
        $this->db->select('b.account_number,ms.net_pay,c.can_name,ms.transaction_type,b.beneficiary_id');
        $this->db->from('emp_monthly_salary_slips ms');
        $this->db->join('candidate c', 'c.can_id = ms.can_id','Left');
        $this->db->join('bank_details b', 'b.can_id = ms.can_id','Left');
        $this->db->where(array('month'=> $month,'year' =>$year));
        return $this->db->get()->result_array();
    }
}
?>
