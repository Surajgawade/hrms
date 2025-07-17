<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Push_notifications extends My_Controller {

	
    function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->library('get_dependency_data');
    }
    public function index($msg="")
	{
        $this->load->model('common_model');
        $user_data=$this->session->userdata('logged_in_user');
        $user_id=$user_data['id'];
        // print_r($user_data);
        // exit;
        $notifications_data=array();
        $notifications=array();
        $unseen_notification_count = get_user_notifications_count($user_id);
       
        
        if(isset($_POST["data"]))
        {
             if(!empty($_POST["data"]))
             {
                $notifications_data['data']=$this->get_dependency_data->get_notification_data($user_id);
                $notifications=$this->load->view('user_notifications',$notifications_data,true);
                $this->output->cache($notifications);
                
                $this->common_model->update('push_notifications',array('status'=>1),array('status'=>0,'can_id'=>$user_id));
                $this->common_model->update('push_notifications',array('status'=>1),array('status'=>0,'reporting_to'=>$user_id));
                //1print_r($notifications_data);
             } 
        }
         $data = array(
          'unseen_notification' => $unseen_notification_count,
          'notifications_data'=>$notifications
         );
         echo json_encode($data);        
	}
	private function load_view($viewname= "blank_page",$page_title)
    {
        $this->content->meta_description="Meta meta_description here!";
        $this->content->meta_keywords="meta keywords here!";
        $this->masterpage->setMasterPage('master');
        $this->content->page_description = "";
        $this->masterpage->setPageTitle($page_title);
        $this->masterpage->addContentPage($viewname,'content',$this->content);
        $this->masterpage->show();
    }
}