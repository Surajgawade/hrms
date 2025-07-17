<?php
require(APPPATH.'/libraries/REST_Controller.php');
 
class Candidate extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('leave_model');
        $this->load->model('common_model');
    }
    function candidate_details_get($can_id=''){
        $data=array();
        if(!empty($can_id))
        {
            $data=$this->candidate_model->get_can_all_details($can_id,true);
        }
        else
        {
            $data=$this->candidate_model->get_can_all_details($can_id,true);    
        }
        echo json_encode($data);

    }
    function add_post()
    {
        $post=$this->post();
    }
    function update_post()
    {
        $post=$this->post();
        // x_debug($post);
        $candidate_details['can_id'] = $post['can_id'];
        $candidate_details['can_name'] = $post['can_name'];
        $candidate_details['cur_address'] = $post['cur_address'];
        $candidate_details['per_address'] = $post['per_address'];
        $candidate_details['email'] = $post['email'];
        $candidate_details['dob'] = (!empty($post['dob']))?date_to_db($post['dob']):'';
        $candidate_details['gender'] = $post['gender'];
        $candidate_details['phone1'] = $post['phone1'];
        $candidate_details['phone2'] = $post['phone2'];
        $candidate_details['education'] = $post['qualification'];
        $candidate_details['job_profile'] = $post['job_profile'];
        $candidate_details['department'] = $post['department'];
        $candidate_details['current_ctc'] = $post['current_ctc'];
        $candidate_details['expected_ctc'] = $post['expected_ctc'];
        $candidate_details['emer_contact_name'] = $post['emer_contact_name'];
        $candidate_details['emer_contact_no'] = $post['emer_contact_no'];
        $candidate_details['aadhar_no'] = $post['aadhar_no'];
        $candidate_details['pan_no'] = strtoupper($post['pan_no']);
        $candidate_details['blood_group'] = $post['blood_group'];
        $candidate_details['ready_to_relocate'] = $post['ready_to_relocate'];
        $candidate_details['joining_date'] = (!empty($post['joining_date']))?date_to_db($post['joining_date']):'';
        $candidate_details['probation_period'] = (!empty($post['probation_period'])) ? $post['probation_period'] :'';
        $candidate_details['probation_end_date'] = (!empty($post['probation_end_date'])) ? date_to_db($post['probation_end_date']):'';
        $candidate_details['role_id'] = $post['role'];
        
        if(!empty($post['rpo_role_name']))
            $candidate_details['can_type'] = $post['rpo_role_name'];
        else
            $candidate_details['can_type'] = 'user';
        $candidate_details['reporting_to'] = $post['reporting_to'];
        $candidate_details['is_active'] = 1;
        $candidate_details=set_log_fields($candidate_details);
        $candidate_details['last_modified_by']=$post['modified_by'];
        
        //x_debug($candidate_details);

        if($this->common_model->update('candidate',$candidate_details,array('can_id'=>$candidate_details['can_id'])))
        {
            echo json_encode(array("message"=>"Updated Successfully"));
        }
        else
        {
            echo json_encode(array("message"=>"Nothing Updated"));
        }

    }
}