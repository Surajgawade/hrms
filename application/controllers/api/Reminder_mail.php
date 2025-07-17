<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reminder_mail extends My_Controller {

	function __construct() 
    {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->helper('common');
    }
    public function index($msg="")
	{
            
	}

    function test(){
      echo "this function is called form command line";
    }


	function send_mail()
    {

        $this->load->library('email_send');
        $this->load->helper('url');
        $mailer_config=$this->common_model->get_data('email_config',array('email_template'=>'task_reminder'));
        if(!empty($mailer_config))
        {
            $subject ="Task Reminder Mail";
            $qry='select tm.can_id,ca.can_name,ca.email,ca.phone1,ta.task_name,ta.task_description,ta.priority,tm.assigned_by,ta.tat,datediff(now(),ta.tat) as datediff,tm.task_id,tm.status from task_manager tm join candidate ca on ca.can_id=tm.can_id join tasks ta on ta.task_id=tm.task_id  where status!="completed" and ta.is_deleted!=1 and tm.assigned_by!=0 and ta.tat<=now()';
            $can_data=$this->common_model->getByQuery($qry);
            if(!empty($can_data))
            {
                $can_data=array_group_by($can_data,'email');
                $failed_emails=[];
                foreach ($can_data as $key => $value) {
                    if(!empty($key))
                    {
                        $data['can_data']=$value;
                        $data['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
                        $message=$this->CI->load->view($template='email_templates/task_reminder', $data, TRUE);    
                        $smsm = send_sms($data['can_data']['phone1'], "This is task reminder, Kindly check mailbox.");
                        $send_status=$this->email_send->send_mail_new($mailer_config,$key,$message);
                        if(empty($send_status))
                        {
                            $failed_emails[]=$key;
                        }
                    }
                    
                }
                if(!empty($failed_emails))
                {
                    log_message('error', current_url().':-Email Sending Failed Count:'.count($failed_emails));
                    log_message('error', current_url().':-Email Sending Failed Emails:'.implode(',',$failed_emails));
                }
            }
            else
            {
                log_message('error', current_url().':-Candidate Data Not Found');
            }
        }
        else
        {
            log_message('error', current_url().':-mailer config not found');
        }
        
    }
}
