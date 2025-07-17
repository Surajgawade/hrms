<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Resource_request extends My_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('common_model');		
		$this->load->model('resource_model');		
		$userdata = $this->session->userdata('logged_in_user');
		if(!$userdata){
			$newURL = site_url()."/login";
			header('Location: '.$newURL);        		
		}        
	}

	public function index($msg="")
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
      $this->load_view("resource_request_list","HRMS - Resource Request List",$this->content);        
	}

	function list_request()
	{
		$userdata = $this->session->userdata('logged_in_user');
		$this->datatables->unset_column('request_id');
		$this->datatables->select('rq.created_on,rq.request_id,can.can_name,jp.title,rq.resource_type,rq.no_of_positions,rq.job_description, rq.keywords,rq.budget,rq.request_status,rq.created_by');
		$this->datatables->from('resource_request rq');
		$this->datatables->join('candidate can', 'rq.created_by = can.can_id', 'left');
		$this->datatables->join('job_profiles jp', 'rq.resource_type = jp.id', 'left');
		$this->datatables->where('rq.is_deleted',0);
		$this->datatables->where('rq.created_by',$userdata['id']);
		$update_url = site_url().'/resource_request/add_edit/$1';
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn-success btn btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a> <a onClick="delete_request($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_delete" ><span class="glyphicon glyphicon-trash"></span></a>', 'request_id');			      
		$result= $this->datatables->generate();  
		echo $result;
	} 

	function add_edit()
	{
			user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
			$userdata = $this->session->userdata('logged_in_user');
			$request_id = $this->uri->segment(3);
			$action ='';
			$id =0;
			$message_new='';
			$query='select job_profiles.*, candidate.department from job_profiles join candidate on job_profiles.dept_id=candidate.department where candidate.can_id='.$userdata['id'].' AND job_profiles.is_deleted = 0';
			$this->content->job_profiles=$this->common_model->getByQuery($query);
			$this->content->qualifications  = $this->common_model->get_form_dropdown($tablename='qualifications', $fields = array('id','title'),$conditions = array('is_deleted' => 0));
			$this->content->candidates = $this->common_model->get_form_dropdown($tablename = 'candidate', $fields = array('can_id','can_name'),$conditions = array('is_deleted' => 0)); 

			$this->content->resource_request = $this->common_model->get_data($table='resource_request', $criteria = array('request_id' => $request_id), $fields='*');
			if(!empty($this->input->post()))
			{
				$quali_arr = implode(",",$this->input->post('qualification', true));
				$data = array(
							'resource_type' => $this->input->post('resource_type', true),
							'no_of_positions' => $this->input->post('no_of_positions', true),
							'job_description' => $this->input->post('job_description', true),
							'keywords' => $this->input->post('keywords', true),
							'qualification' => $quali_arr,
							'budget' => $this->input->post('budget', true),
							'experience' => $this->input->post('experience', true)
							);
				if(!empty($request_id))
				{
					$data = set_log_fields($data);
					$id = $this->common_model->update('resource_request',$data,array('request_id' => $request_id));
					$email_data = $this->common_model->getRowByQuery('Select rq.*, jp.title ,can.can_name from resource_request rq join candidate can on can.can_id=rq.created_by join job_profiles jp on jp.id=rq.resource_type where rq.is_deleted = 0 AND rq.request_id='.$request_id);
					$action = 'update';
					$message_new="Updated resource request sent to reporting authority!";
				}
				else
				{
					$data = set_log_fields($data,'insert');
					$id = $this->common_model->insert('resource_request',$data);					
					$message_new = "New resource request sent to reporting authority!";
					$email_data = $this->common_model->getRowByQuery('Select rq.*, jp.title ,can.can_name from resource_request rq join candidate can on can.can_id=rq.created_by join job_profiles jp on jp.id=rq.resource_type where rq.is_deleted = 0 AND rq.request_id='.$id);
					$action = 'insert';
				}
				if($id > 0)
				{					
					$this->load->library('email_send');
					$mailer_config=$this->common_model->get_data('email_config',array('email_template'=>'resource_request'));
                    $email_data['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
					$message = $this->load->view("email_templates/".$mailer_config["email_template"], $email_data, TRUE);
					// echo $message;
					$can_id=$this->config->item('hr_user_role_id');
					$email_id = $this->common_model->get_data('candidate',array('role_id'=>$can_id[0]),'email,phone1');
					// x_debug($email_id);
					$smsm = send_sms($email_id['phone1'], "Please check your mailbox, Resource request has been made.");
					$this->email_send->send_mail_new($mailer_config, $email_id['email'],$message);
					$this->session->set_flashdata('success','Resource request sent successfully!');
				}
				else
				{
					$error = "Error in sending request";
					log_message('error', $error);
				}
				redirect('resource_request/index');
				
		}
		$this->load_view("add_edit_resource_request","HRMS - Add Edit Resource Request",$this->content);
	}

	function delete_request()
	{
		if ($this->input->is_ajax_request())
		{
			$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
	        if(!empty($access))
	        {
	        		echo "0";
	        }
	        else
	        {
					$request_id = $this->input->post('request_id');
					$this->common_model->update('resource_request', array('is_deleted' => 1 ),array('request_id'=>$request_id));
					echo "1";
			}
		}
	}

	public function received_request()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
      $this->load_view("received_resource_request_list","HRMS - Received Resource Request List",$this->content);        
	}

	function list_received_request()
	{
		$userdata = $this->session->userdata('logged_in_user');
		$this->datatables->unset_column('request_id');
		$this->datatables->select('rq.created_on,rq.request_id,can.can_name,jp.title,rq.resource_type,rq.no_of_positions, rq.budget,rq.request_status,rq.created_by, jpp.title as designation,rq.last_modified_on');
		$this->datatables->from('resource_request rq');
		$this->datatables->join('candidate can', 'rq.created_by = can.can_id', 'left');
		$this->datatables->join('job_profiles jp', 'rq.resource_type = jp.id', 'left');
		$this->datatables->join('job_profiles jpp', 'can.job_profile=jpp.id', 'left');
		$this->datatables->where('rq.is_deleted',0);
		$this->db->order_by('rq.last_modified_on','desc');
		if($userdata['role_id']==11){
			$this->datatables->where('rq.request_status',3);
		}		
		$status_url = site_url().'/resource_request/process_request/$1';
		$view_url=site_url().'/resource_request/view_request/$1';
	   $this->datatables->add_column('edit', '<a href="'.$view_url.'"class="tabledit-delete-button btn btn-success btn_delete">View</a>', 'request_id');   
		$result= $this->datatables->generate();  
		echo $result;
	}

	
	public function view_request()
    {
        user_access_operation($this->router->fetch_class(),$this->router->fetch_method());  
        $userdata = $this->session->userdata('logged_in_user');
        $request_id = (int)$this->uri->segment(3);  
			$this->content->job_profiles=$this->common_model->getByQuery($query);
        $this->content->qualifications  = $this->common_model->get_form_dropdown($tablename='qualifications', $fields = array('id','title'),$conditions = array('is_deleted' => 0));
        $this->content->resource_request= $this->common_model->getRowByQuery('Select rq.*, jp.title ,can.can_name from resource_request rq join candidate can on can.can_id=rq.created_by join job_profiles jp on jp.id=rq.resource_type where rq.is_deleted = 0 AND rq.request_id='.$request_id); 

        if(!empty($this->input->post()))
		{
			$request_id=$this->input->post('request_id');
			$data = array(
				'no_of_positions' => $this->input->post('no_of_positions', true),
				'budget' => $this->input->post('budget', true),
				'experience' => $this->input->post('experience', true)
			);
			if(!empty($request_id))
			{
				$data = set_log_fields($data);
				$id = $this->common_model->update('resource_request',$data,array('request_id' => $request_id));
				if(!$id){
					$this->session->set_flashdata('success', 'Resource Request Processed Successfully!');
					redirect('resource_request/received_request');
				}else{
					$this->session->set_flashdata('error', 'Error While Approving Resource!');
					redirect('resource_request/received_request');
				}
			}			
		}
        $this->load_view("view_resource_request","HRMS - Received Request",$this->content);
    }

    function process_request()
    {
    	user_access_operation($this->router->fetch_class(),$this->router->fetch_method());  
        $userdata = $this->session->userdata('logged_in_user');
    	$status=$this->input->post('status');
    	$request_id=$this->input->post('request_id');

    	if($status==1)
		{	

			$flashmessage="Resource Request Accepted Successfully!";	
			$email_data = $this->common_model->getRowByQuery('Select rq.*, jp.title ,can.can_name from resource_request rq join candidate can on can.can_id=rq.created_by join job_profiles jp on jp.id=rq.resource_type where rq.is_deleted = 0 AND rq.request_id='.$request_id);
			$this->load->library('email_send');
			$mailer_config=$this->common_model->get_data('email_config',array('email_template'=>'resource_request_approved'));
            $email_data['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
			$message = $this->load->view("email_templates/".$mailer_config["email_template"], $email_data, TRUE);
			$can_id=$this->config->item('hr_user_role_id');
			$email_id = $this->common_model->get_data('candidate',array('role_id'=>$can_id[0]),'email,phone1');
			$smsm = send_sms($email_id['phone1'], "Please check your mailbox, Resource request has been approved.");
			$this->email_send->send_mail_new($mailer_config, $email_id,$message);
			//to move resource to job table
			$query='select resource_request.resource_type, resource_request.job_description, resource_request.no_of_positions, resource_request.keywords, job_profiles.title from resource_request join job_profiles on resource_request.request_id=job_profiles.id where request_id='.$request_id.' ';
	    	$resource_details=$this->common_model->getRowByQuery($query);

	    	$data=array(
	    		'request_id'=>$request_id,
	    		'job_title'=>$resource_details['title'],
	    		'job_description'=>$resource_details['job_description'],
	    		'no_of_position'=>$resource_details['no_of_positions'],
	    		'keywords'=>$resource_details['keywords']
	    	);
	    	$count=$this->common_model->count_all('jobs',array('request_id'=>$request_id));
	    	if($count==0){
	    		$data = set_log_fields($data,'insert');
	    		$id=$this->common_model->insert('jobs',$data);
	    	}
	    	

		}
		else if($status==3)
		{
			$flashmessage="Resource Request Send to Super Admin for Process Successfully!";		
			$email_data = $this->common_model->getRowByQuery('Select rq.*, jp.title ,can.can_name from resource_request rq join candidate can on can.can_id=rq.created_by join job_profiles jp on jp.id=rq.resource_type where rq.is_deleted = 0 AND rq.request_id='.$request_id);
			$this->load->library('email_send');
			$mailer_config=$this->common_model->get_data('email_config',array('email_template'=>'resource_request'));
            $email_data['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
			$message = $this->load->view("email_templates/".$mailer_config["email_template"], $email_data, TRUE);
			$can_id=$this->config->item('super_user_role_id');
			$email_id = $this->common_model->get_data('candidate',array('role_id'=>$can_id[0]),'email');
			$this->email_send->send_mail_new($mailer_config, $email_id,$message);
			
		}
		else if($status==2){
			$flashmessage="Resource Request Rejected!";		
		}
		$data=array('request_status' => $status);
		$data = set_log_fields($data);
		$result=$this->common_model->update('resource_request', $data, array('request_id'=>$request_id));
		if(!$result){
			$this->session->set_flashdata('success', $flashmessage);
			redirect('resource_request/received_request');
		}else{
			$this->session->set_flashdata('error', 'Error While Approving Resource!');
			redirect('resource_request/received_request');
		}

    }

    public function assign_resource()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
     	$this->load_view("accepted_resource_list","HRMS - Accepted Resource List",$this->content);        
	}

	function assign_resourcee_list()
	{
		$userdata = $this->session->userdata('logged_in_user');
		$this->datatables->unset_column('request_id');
		$this->datatables->select('rq.*, rq.request_id, can.can_name,jp.title, cand.can_name as assigned_to');
		$this->datatables->from('resource_request rq');
		$this->datatables->join('candidate can', 'rq.created_by = can.can_id', 'left');
		$this->datatables->join('job_profiles jp', 'rq.resource_type = jp.id', 'left');
		$this->datatables->join('interview_task it', 'rq.request_id = it.request_id', 'left');
		$this->datatables->join('candidate cand', 'it.can_id = cand.can_id', 'left');
		$this->datatables->where('rq.is_deleted',0);
		$this->datatables->where('rq.request_status','1');
		$this->db->order_by('rq.last_modified_on','desc');
		$assign_url = site_url().'/resource_request/assign/$1';
		$this->datatables->add_column('assign', '<a href="'.$assign_url.'" class="tabledit-edit-button btn btn-sm btn-primary">Assign Task</a>', 'request_id');			      
		$result= $this->datatables->generate();  
		echo $result;
	}

	function assign()
    {
       	user_access_operation($this->router->fetch_class(),$this->router->fetch_method());   
		$userdata = $this->session->userdata('logged_in_user');
        $request_id = $this->uri->segment(3);
	    $this->content->resource_details=$this->common_model->getRowByQuery('select resource_request.request_id, resource_request.resource_type, resource_request.job_description, resource_request.no_of_positions, resource_request.keywords, resource_request.budget, job_profiles.title from resource_request join job_profiles on resource_request.request_id=job_profiles.id where request_id='.$request_id.' ');
	    // x_debug($this->content->resource_details);
	     $this->content->assigned_can=$this->common_model->getByQuery('select candidate.can_id, candidate.can_name, interview_task.tat from interview_task join candidate on candidate.can_id = interview_task.can_id where interview_task.request_id='.$request_id); 
	     // x_debug( $this->content->assigned_can);
      $this->content->candidates = $this->common_model->get_form_dropdown($tablename = 'candidate', 'can_id,can_name',array('is_deleted' => 0,'reporting_to'=>$userdata[id]));
      $this->load_view("assign_task","HRMS - Assign Task",$this->content);
    }


    function assign_task()
    {
        $userdata = $this->session->userdata('logged_in_user');
        //user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
         if($this->input->is_ajax_request())
         {
        	$request_id=$this->input->post('request_id');   
         	$tat = str_replace('/', '-', $this->input->post('tat',true));
			if(!empty($tat) && !empty(strtotime($tat)))
			{
				$tat = date('Y-m-d', strtotime($tat));
			}
            $candidates = $this->input->post('candidates');
	    	$this->content->assigned_can=$this->common_model->getByQuery('select candidate.can_id, candidate.can_name from interview_task join candidate on candidate.can_id = interview_task.can_id where interview_task.request_id='.$request_id);
         	// print_r($this->content->assigned_can);exit;

             foreach ($this->content->assigned_can as  $can)
            {      
               if(!in_array($can['can_id'], $candidates))
               {
	    		 $this->content->assigned_can=$this->common_model->getByQuery('DELETE FROM interview_task WHERE can_id='.$can['can_id'].' AND request_id='.$request_id);
               }
            }
            for ($i=0; $i < count($candidates); $i++)
            {
	         	$data=array('request_id'=>$request_id, 'priority'=>$this->input->post('priority'), 'tat'=>$tat, 'can_id'=>$candidates[$i], 'status'=>'Open');
	         	if($this->resource_model->assign_task($data))
                {
                    echo "1";
                }
                else
                {
                    echo "2";
                }
	        }
         	$this->common_model->update('resource_request',array('request_status'=>1),array('request_id'=>$request_id));	        
        }
    }

	private function load_view($viewname= "blank_page",$page_title)
	{
		$this->content->meta_description="Meta meta_description here!";
		$this->content->meta_keywords="meta keywords here!";
		$this->masterpage->setMasterPage('master');
		$this->content->page_description = "";
		$this->masterpage->setPageTitle($page_title);
		$this->masterpage->addContentPage('resource_request/'.$viewname,'content',$this->content);
		$this->masterpage->show();
	}
}
