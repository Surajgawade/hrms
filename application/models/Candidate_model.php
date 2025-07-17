<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once( APPPATH . 'models/entities/candidate' . EXT );

class Candidate_model extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            get_active_db();
            // Your own constructor code
    }

    
    function insert_rec($insert_arr)
    {
      $this->db->insert('candidate',$insert_arr);
      return $this->db->insert_id();
    }

    function check_email_availability($email)
    {
        return $this->db->get_where('candidate',array('email' =>$email))->num_rows();
    }

    function get_by_id($id)
    {
    	return $this->db->get_where('candidate',array('can_id' =>$id))->row();
    }

    function save_candidate_details($candidate_details)
    {
        $this->db->where('can_id', $candidate_details->can_id);
        if($this->db->update('candidate', $candidate_details))
        return $candidate_details->can_id;
    }

    function delete_candidate($can_id)
    {
        $this->db->set('is_deleted',1);
        $this->db->where('can_id', $can_id);
        return $this->db->update('candidate');
    }

    function get_candidate_bank_details($can_id)
    {
        $this->db->select('bank_details.*,candidate.can_name');
        $this->db->from('bank_details');
        $this->db->join('candidate', 'candidate.can_id = bank_details.can_id','LEFT');
        $this->db->where('candidate.can_id',$can_id);
        return $this->db->get()->row();
    }
    function get_candidate_name_by_id($can_id)
    {
        $this->db->select('can_name');
        $this->db->where('can_id',$can_id);
        return $this->db->get('candidate')->row();
    }


    function get_id_from_email($em)
    {
        $this->db->select('can_id');
        $this->db->from('candidate');
        $this->db->where('email',$em);
        return $this->db->get()->row_array();
    }

    function get_can_doj($id)
    {
        $this->db->select('joining_date,probation_period,probation_end_date');
        $this->db->from('candidate');
        $this->db->where('can_id',$id);
        return $this->db->get()->row();
    }

    function save_bank_details($bank_details)
    {      
        if($bank_details['bd_id'] > 0)
        {
            $this->db->where('bd_id', $bank_details['bd_id']);
            $this->db->update('bank_details',$bank_details);
            return $bank_details['bd_id'];
        }
        else
        {
            $this->db->insert('bank_details',$bank_details);
             return $this->db->insert_id();
        }         
    }

    function upload_document($documents)
    {
        $this->db->insert('documents',$documents);
         return $this->db->insert_id();
    }

    function get_all_documents($can_id)
    {
        return $this->db->get_where('documents',array('can_id' => $can_id,'is_deleted'=> 0))->result();
    }

    function get_all_experience($can_id)
    {
        return $this->db->get_where('experience',array('can_id' => $can_id,'is_deleted'=> 0))->result();
    }
   
    function add_experience($experience_details)
    {
        if($experience_details['exp_id'] > 0)
        {
            $this->db->where("exp_id",$experience_details['exp_id']);
            if($this->db->update("experience",$experience_details))
            {           
                return $experience_details['exp_id'];
            }
        }
        else
        {
            $this->db->insert('experience',$experience_details);
            return $this->db->insert_id(); 
        }
    }

    function get_billing_details($can_id)
    {
        return $this->db->get_where('billing',array('can_id' => $can_id,'is_deleted'=> 0))->result();
    }

    function add_billing_details($billing_details)
    {
        if($billing_details['bill_id']>0)
        {
            $this->db->where("bill_id",$billing_details['bill_id']);
            if($this->db->update("billing",$billing_details))
            {           
                return $billing_details['bill_id'];
            }
        }
        else
        {
            $this->db->insert('billing',$billing_details);
            return $this->db->insert_id();   
        }
        
    }

    function get_investment_details($inv_id)
    {
        return $this->db->get_where('investment',array('inv_id' => $inv_id,'is_deleted'=> 0))->row();
    }

    function add_investment_details($investment_details)
    {
        if($investment_details['inv_id'] > 0)
        {
            $this->db->where("inv_id",$investment_details['inv_id']);
            if($this->db->update("investment",$investment_details))
            {           
                return $investment_details['inv_id'];
            }
        }
        else
        {
            $this->db->insert('investment',$investment_details);
            return $this->db->insert_id();
        }
    }

    function get_reference_details($can_id,$ref_type)
    {
        return $this->db->get_where('referance',array('can_id' => $can_id,'ref_type'=>$ref_type, 'is_deleted'=> 0))->result();
    }

    function add_reference_details($reference_details)
    {
        if($reference_details['ref_id'] > 0)
        {
            $this->db->where("ref_id",$reference_details['ref_id']);
            if($this->db->update("referance",$reference_details))
            {           
                return $reference_details['ref_id'];
            }
        }
        else
        {
            $this->db->insert('referance',$reference_details);
            return $this->db->insert_id();
        }
    }

    function edit_billing_details($bill_id)
    {
        return $this->db->get_where('billing',array('bill_id' => $bill_id))->row();
    }

    function edit_exp_details($exp_id)
    {
        return $this->db->get_where('experience',array('exp_id' => $exp_id))->row();
    }

    function edit_inv_details($inv_id)
    {
        return $this->db->get_where('investment',array('inv_id' => $inv_id))->result();
    }

    function edit_ref_details($ref_id,$ref_type)
    {
        return $this->db->get_where('referance',array('ref_id' => $ref_id,'ref_type' =>$ref_type))->row();
    }   

    /* common function for deleting employee details*/
    function delete($tablename,$fieldname,$id)
    {
        $this->db->set('is_deleted',1);
        $this->db->where($fieldname,$id);
        $this->db->update($tablename);
    }

    function update_password($data_array)
    {
        $this->db->set('password',$data_array['password']);
        $this->db->where('email', $data_array['email']);
        return $this->db->update('candidate');
    }

    function get_can_details($can_id,$all_field=false)
    {
        if($all_field)
        {
            $this->db->select('c.*,q.title as candidate_qualification,jp.title as job_profile_title,d.title as department_title, r.role_name as role_name, c1.can_name as reporting_to');
        }   
        else
        {
            $this->db->select('c.can_id,c.can_name,c.joining_date,c.job_profile,jp.title as job_profile_title, d.title as department_title, c.pan_no,clr.balance_leave');
        }
        $this->db->from('candidate c');
        $this->db->join('job_profiles jp', 'jp.id = c.job_profile','LEFT');
	    $this->db->join('departments d', 'c.department =  d.id','LEFT');
        $this->db->join('qualifications q', 'q.id = c.education','LEFT');
        $this->db->join('roles r', 'r.role_id = c.role_id','LEFT');
        $this->db->join('candidate c1','c1.can_id = c.reporting_to','LEFT');
        $this->db->join('can_leave_records clr', 'clr.can_id = c.can_id','LEFT');
        $this->db->where('c.can_id',$can_id);
        return $this->db->get()->row();
    }
    function get_can_all_details($can_id,$all_field=false)
    {
        if($all_field)
        {
            $this->db->select('c.*,q.title as candidate_qualification,jp.title as job_profile_title,d.title as department_title, r.role_name as role_name, c1.can_name as reporting_to');
        }   
        else
        {
            $this->db->select('c.can_id,c.can_name,c.joining_date,c.job_profile,jp.title as job_profile_title, d.title as department_title, c.pan_no,clr.balance_leave');
        }
        $this->db->from('candidate c');
        $this->db->join('job_profiles jp', 'jp.id = c.job_profile','LEFT');
        $this->db->join('departments d', 'c.department =  d.id','LEFT');
        $this->db->join('qualifications q', 'q.id = c.education','LEFT');
        $this->db->join('roles r', 'r.role_id = c.role_id','LEFT');
        $this->db->join('candidate c1','c1.can_id = c.reporting_to','LEFT');
        $this->db->join('can_leave_records clr', 'clr.can_id = c.can_id','LEFT');
        if(!empty($can_id))
        {
            $this->db->where('c.can_id',$can_id);
        }
        return $this->db->get()->result_array();
    }

    function get_can_salary_details($can_id)
    {
        $this->db->select('c.can_name, c.joining_date ,j.title as job_profile_title,d.title as department_title , e.*,l.balance_leave,b.transaction_type');    
        $this->db->from('candidate c');
        $this->db->join('job_profiles j', 'c.job_profile =  j.id','LEFT');
        $this->db->join('bank_details b', 'c.can_id = b.can_id');
	    $this->db->join('departments d', 'c.department =  d.id','LEFT');
        $this->db->join('emp_salary_details e', 'c.can_id = e.can_id','LEFT');
        $this->db->join('can_leave_records l', 'c.can_id = l.can_id','LEFT');
        $this->db->where('e.is_deleted',0);
        $this->db->where('c.can_id',$can_id);
        $this->db->order_by('e.sd_id','desc');
        $this->db->limit(1);
        return $query = $this->db->get()->row();
    }

    function get_employee_insurance_details($can_id)
    {
        $this->db->select('i.*,c.can_name,c.joining_date');
        $this->db->from('candidate c');
        $this->db->join('insurance_details i', 'c.can_id = i.can_id','LEFT');
        //$this->db->join('insurance_details i', 'i.joining_date =c.joining_date','LEFT');
        $this->db->where('c.can_id',$can_id); 
         return $this->db->get()->row();
         //var_dump($query);exit();
    }

    function get_user_birthdays()
    {
        $superadmin = $this->config->item('super_user_role_id');
        $superadmin = implode(',', $superadmin);
        // x_debug($superadmin);
        $this->db->query('CREATE  OR REPLACE VIEW birthday_wishesh_view AS SELECT `candidate`.`can_id`, `candidate`.`can_name`,`candidate`.`email`,`candidate`.`profile_picture`,`candidate`.`dob`,MONTH(`candidate`.`dob`) as month_dob,DAY(`candidate`.`dob`) as date_dob, `job_profiles`.`title` FROM `candidate` INNER JOIN `job_profiles` ON `job_profiles`.`id` = `candidate`.`job_profile` WHERE `candidate`.`role_id` NOT IN("'.$superadmin.'") AND `candidate`.`is_deleted` = 0 AND `candidate`.`is_active` = 1');
        
        $this->db->select('*');
        $this->db->from('birthday_wishesh_view');
        // $this->db->join('job_profiles j', 'j.id =  c.job_profile');
        $this->db->where(array('MONTH(birthday_wishesh_view.dob)'=>date('m')));
        return $this->db->get()->result_array();  
    }

    function get_dept_hods($dept_id='')
    {
        $this->db->select('c.can_id,c.can_name,c.email,j.is_hod');
        $this->db->from('candidate c');
        $this->db->join('job_profiles j', 'j.id =  c.job_profile');
        if(!empty($dept_id))
        {
            $this->db->where(array('j.dept_id'=>$dept_id));
        }
        $this->db->where(array('j.is_hod'=>1));
        $this->db->or_where(array('c.can_type'=>'Admin'));
        return $this->db->get()->result();
        // echo $this->db->last_query();exit;  
    }
}
