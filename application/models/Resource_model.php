<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Resource_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        get_active_db();
        // Your own constructor code
    }

	function get_request_details($request_id)
	{
		$this->db->select('resource_request.*,job_profiles.title');
		$this->db->from('resource_request');
		$this->db->join('job_profiles', 'resource_request.resource_type = job_profiles.id','LEFT');
		// $this->db->join('qualifications', 'resource_request.qualification = qualifications.id','LEFT');
		// $this->db->where_in('qualifications.id','resource_request.qualification');
		return $this->db->get()->row_array();
	}

	function assign_task($data)
    {
        $this->load->model('common_model');
        $count= $this->db->get_where('interview_task', array('request_id' => $data['request_id'],'can_id' => $data['can_id']))->num_rows();
        if($count<1)
        {
        	$data = set_log_fields($data,'insert');
            $this->db->insert('interview_task', $data);
            $rec['task'] = $this->common_model->get_data('interview_task', array('request_id'=>$data['request_id'], 'is_deleted'=>0));
            $rec['resource']=$this->common_model->get_data('resource_request', array('request_id'=>$data['request_id'], 'is_deleted'=>0));
            $rec['candidate'] = $this->common_model->get_data('candidate', array('can_id'=>$data['can_id'], 'is_deleted'=>0));
            $this->load->library('email_send');
            $rec['profile']=$this->common_model->get_data('job_profiles', array('id'=>$rec['resource']['resource_type'],'is_deleted'=>0));
            
            $mailer_config = $this->common_model->get_data('email_config',array('email_template'=>'interview_task_assign'));
            $rec['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
            $message = $this->load->view("email_templates/".$mailer_config["email_template"], $rec, TRUE);
            $smsm = send_sms($rec['candidate']['phone1'], "Please check your mailbox, Task has been assigned to you.");
            $sent = $this->email_send->send_mail_new($mailer_config, $rec['candidate']['email'], $message);
            if($sent == 1)
            {				
                return $this->db->insert_id(); 
            }
            else
            {
                return 0;
            }
        }else
        {
        	return 0;
        }        
    }
}

?>
