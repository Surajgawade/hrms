<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once( APPPATH . 'models/entities/candidate' . EXT );

class Resignation_model extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            get_active_db();
            // Your own constructor code
    }

    
    function get_email_information($user_id)
    {
      return $this->db->get_where('candidate',array('can_id' =>$user_id))->result();  
    }
    function get_email_ro($ro_id)
    {
      return $this->db->get_where('candidate',array('can_id' =>$ro_id))->result();  
    }


    function resi_information_insert()
    {

        if($this->session->userdata('ro_id') == NULL)
        {
            $ro_id=22;
        }else{ $ro_id= $this->session->userdata('ro_id');}
      $data = array(
        'resi_id' => NULL,
        'can_id' => $this->session->userdata('user_id'),
        'ro_id' => $ro_id,
        'resi_title' => $this->input->post('email_title'),
        'resi_to' => $this->input->post('mail_to'),
        'resi_cc' => $this->input->post('mail_cc'),
        'resi_bcc' => $this->input->post('mail_bcc'),
        'req_rel_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('req_date')))),
        'sys_rel_date' => date('Y-m-d', strtotime("+90 days")),
        'resi_cont' => $this->input->post('email_description'),
        'hr_status' => 0,
        'hr_remark' => '',
        'pm_status' => 0,
        'pm_remark' => '',
        'md_status' => 0,
        'md_remark' => '',
        'release_status' => 0
);
$this->db->insert('resignation_details', $data);
    }


function get_resignation_dtls($id)
    {
        $this->db->select('*');
        $this->db->from('resignation_details');
        $this->db->where('can_id',$id); 
        $this->db->order_by('resi_id','asc');
        //$this->db->limit(1, 1);       
        return $this->db->get()->result();
    }
    function get_resignation_dtls_for_hr()
    {
        $this->db->select('*');
        $this->db->from('resignation_details');
        $this->db->order_by('resi_id','asc');      
        return $this->db->get()->result();
    }
    function get_resignation_dtls_for_pm($id)
    {

        $this->db->select('*');
        $this->db->from('resignation_details');
        $this->db->where('resi_to',$id); 
        $this->db->order_by('resi_id','asc');
        //$this->db->limit(1, 1);       
        return $this->db->get()->result();
    }
    function get_resignation_dtls_for_md()
    {

        $this->db->select('*');
        $this->db->from('resignation_details');
        $this->db->order_by('resi_id','asc');     
        return $this->db->get()->result();
    }

function get_role_dtls($u_id)
    {
      return $this->db->get_where('candidate',array('can_id' =>$ro_id))->result();  
    }
    
    function update_hr_status($id,$status)
    {
        if($status == 1)
        {
            $data = array('hr_status' => 0);
        }
        else
        {
            $data = array('hr_status' => 1);
        }
        $this->db->where('resi_id',$id); 
        $res = $this->db->update('resignation_details', $data);
        return $res;
    }
    
    function update_pm_status($id,$status)
    {
        if($status==1){
         $data = array(
        'pm_status' => 0);
         }else{
        $data = array(
        'pm_status' => 1);
         }
         $this->db->where('resi_id',$id); 
$this->db->update('resignation_details', $data);
    }
    
    function update_md_status($id,$status)
    {
        if($status==1){
         $data = array(
        'md_status' => 0);
         }else{
        $data = array(
        'md_status' => 1);
         }
         $this->db->where('resi_id',$id); 
$this->db->update('resignation_details', $data);
    }
    
    function insert_hr_remark()
    {
    
         $data = array(
        'hr_remark' => $this->input->post('remark'));
         $this->db->where('resi_id',$this->input->post('resi_id')); 
$this->db->update('resignation_details', $data);
    }
    function insert_pm_remark()
    {
    
         $data = array(
        'pm_remark' => $this->input->post('remark'));
         $this->db->where('resi_id',$this->input->post('resi_id')); 
$this->db->update('resignation_details', $data);
    }

    function insert_md_remark()
    {
    
         $data = array(
        'md_remark' => $this->input->post('remark'));
         $this->db->where('resi_id',$this->input->post('resi_id')); 
$this->db->update('resignation_details', $data);
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
        // x_debug($candidate_details);
        $this->db->where('can_id', $candidate_details->can_id);
        if($this->db->update('candidate', $candidate_details))
        return $candidate_details->can_id;
    }

    function delete_candidate($can_id)
    {
        $this->db->set('is_deleted',1);
        $this->db->where('can_id', $can_id);
        return $this->db->update('candidate');
        // echo $this->db->last_query();exit;
    }

    function get_candidate_bank_details($can_id)
    {
        $this->db->select('bank_details.*,candidate.can_name');
        $this->db->from('bank_details');
        $this->db->join('candidate', 'candidate.can_id = bank_details.can_id','LEFT');
        $this->db->where('candidate.can_id',$can_id);        
         // $this->db->get()->row();
         // echo $this->db->last_query();exit;
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
        $this->db->select('joining_date');
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
        // x_debug($documents);
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
            // $data = (array) $reference_details;            
            $this->db->insert('referance',$reference_details);
            return $this->db->insert_id();
        }
    }

   /* function delete_doc($doc_id)
    {
        $this->db->set('is_deleted',1);
        $this->db->where("doc_id",$doc_id);
        $this->db->update("documents"); 
    }*/

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
        // echo $this->db->last_query();exit;
    }

    function get_can_details($can_id)
    {
        $this->db->select('c.can_id,clr.balance_leave,c.can_name,c.joining_date,c.job_profile,job_profiles.title as job_profile_title,c.pan_no');
        $this->db->from('candidate c');
        $this->db->join('job_profiles', 'job_profiles.id = c.job_profile','LEFT');
        $this->db->join('can_leave_records clr', 'clr.can_id = c.can_id','LEFT');
        $this->db->where('c.can_id',$can_id);
        return $this->db->get()->row();
    }

    /*function get_can_details_by_fieldname($tablename,$fields,$jointablename,$join_condition, $where_conditions)
    {

    }*/

    function get_can_salary_details($can_id)
    {
        $this->db->select('c.can_name, c.joining_date ,j.title as job_profile_title, e.*,l.balance_leave');    
        $this->db->from('candidate c');
        $this->db->join('job_profiles j', 'c.job_profile =  j.id');
        $this->db->join('emp_salary_details e', 'c.can_id = e.can_id');
        $this->db->join('can_leave_records l', 'c.can_id = l.can_id');
        $this->db->where('e.is_deleted',0);
        $this->db->where('c.can_id',$can_id);
        $this->db->order_by('e.sd_id','desc');
        $this->db->limit(1);
        return $query = $this->db->get()->row();
        // echo $this->db->last_query();exit;
        // x_debug($query);
    }


}
