<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bulk_mail extends My_Controller
{
	public function __construct() {
		Parent::__construct();
		$this->load->model("common_model");
	}

	public function index($msg="")
	{
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
		$this->load_view("bulk_mail","HRMS - Notify all",$this->content);        
	}

	private function load_view($viewname= "blank_page",$page_title)
	{
		$this->content->meta_description="Meta meta_description here!";
		$this->content->meta_keywords="meta keywords here!";
		$this->masterpage->setMasterPage('master');
		$this->content->page_description = "";
		$this->masterpage->setPageTitle($page_title);
		$this->masterpage->addContentPage('bulk_mail/'.$viewname,'content',$this->content);
		$this->masterpage->show();
	}

    public function send_bulk_mail()
    {
        $post = $this->input->post();
        $data = set_log_fields($post,'insert');
        $id = $this->common_model->insert('bulk_mail',$data);
        if($id > 0)
        {
            if(($post['departments'] == 'all') && ($post['recipients'] == 'all'))
            {
                $candidates = $this->common_model->get_data_array('candidate', array('is_active'=>1, 'is_deleted'=>0));
            }
            else
            {
                if(strpos($post['recipients'], ','))
                {
                    $recs = explode(',', $post['recipients']);
                    $can_res = $recs;
                }
                else
                {
                    $can_res = array(0 => $post['recipients']);
                }
                foreach ($can_res as $keyr => $valuer) {
                    $candidates[$keyr] = $this->common_model->get_data('candidate', array('can_id'=>$valuer));
                }
            }
            $data['mail_content'] = $post['message'];
            $data['subject'] = $post['subject'];
            $data['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
            $cnt = count($candidates);
            $i = 0;
            if(!empty($candidates) && !empty($data['mail_content']) && !empty($data['subject']))
            {
                $can_mails = array();
                foreach ($candidates as $key => $value)
                {
                    $this->load->library('email_send');
                    $mailer_config = $this->common_model->get_data('email_config',array('email_template'=>'bulk_mail'));
                    $data['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
                    $message = $this->load->view("email_templates/".$mailer_config["email_template"], $data, TRUE);
                    $smsm = send_sms($value['phone1'], "Please check your mailbox, Mail has been sent from Raoson.");
                    $sent = $this->email_send->send_mail_new($mailer_config, $value['email'], $message, $data['subject']);
                    if($sent == 1)
                    {
                        $i++;
                        sleep(30);
                    } 
                }
                if($cnt == $i)
                {
                    // $this->alert_notify($post['message']);
                    echo "1";
                }
                else
                {
                    echo "2";
                }
            }
            else
            {
                echo "4";
            }
        }
        else
        {
            echo "2";
        }
    }

    /*public function alert_notify($message = '')
    {
        var_dump($messge)
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP); 
        socket_set_option($sock, SOL_SOCKET, SO_BROADCAST, 1); 
        socket_sendto($sock, $message, strlen($message), 0, '255.255.255.255', $port); 
    }*/

    public function get_departments()
    {
        $departments = $this->common_model->get_data_array('departments',array('is_deleted'=>0), 'id,title');
        echo json_encode($departments);
    }

    public function get_recipients()
    {
        $post = $this->input->post();
        $candidates = $this->common_model->get_data_array('candidate',array('is_deleted'=>0, 'department'=>$post['dept_id']), 'can_id,can_name,job_profile');
        if(!empty($candidates))
        {
            foreach ($candidates as $key => $value)
            {
                if(!empty($value['job_profile']) && ($value['job_profile'] != 0))
                {
                    $designation = $this->common_model->get_data('job_profiles',array('is_deleted'=>0, 'id'=>$value['job_profile']), 'id,title');
                    if(!empty($designation))
                    {
                        $candidates[$key]['designation'] = $designation['title'];
                    }
                    else
                    {
                        $candidates[$key]['designation'] = '';
                    }
                }
                else
                {
                    $candidates[$key]['designation'] = '';
                }
            }
        }
        echo json_encode($candidates);
    }
}
?>
