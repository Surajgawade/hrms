<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Interview extends My_Controller {

	function __construct()
	{
		parent::__construct();
		// $this->load->model('interview_model');		
		$this->load->model('common_model');	
		$this->load->model('interview_model');
		$this->load->library('get_dependency_data');	
		$userdata = $this->session->userdata('logged_in_user');
		if(!$userdata){
			$newURL = site_url()."/login";
			header('Location: '.$newURL);        		
		}        
	}

	public function interview_canlist($msg="")
	{
		$userdata = $this->session->userdata('logged_in_user');
   		$this->load_view("interview_canlist","HRMS - Interview Candidate List",$this->content);        
	}

	function list_candidates()
	{
		$this->datatables->unset_column('type_id');
		$this->datatables->select('ir.intw_can_id, ir.full_name, ir.email_id, ir.mobile_no, im.interview_status');
		$this->datatables->from('interview_candidate_records ir');
		$this->datatables->join('interview_manager im', 'ir.intw_can_id=im.intw_can_id','left');
		$this->datatables->where('ir.is_deleted',0);

		$update_url = site_url().'/interview/add_edit/$1/old';
		$view_url=site_url().'/interview/view/$1';

		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a> <a href="javascript:;" onClick="delete_type($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_edit"><span class="glyphicon glyphicon-trash"></span></a>', 'intw_can_id');
		//<a href="'.$view_url.'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>

		$result= $this->datatables->generate();  
		echo $result;
	}

	function add_edit()
	{
		$stag = $this->uri->segment(4);
		if($stag=='new'){
			$int_task_id=$this->uri->segment(3);
		} 
		else if($stag=='old'){
			$can_id=$this->uri->segment(3);
			$int_task_id='';
		}
		else{
			$int_task_id='';
		}

		if(!empty($can_id))
		{
			if($this->common_model->count_all($tablename='interview_candidate_records', $conditions = array('intw_can_id' =>$can_id)) == 0 )
			{
				redirect('Record_not_found');
			}
			else
			{
				$can_data=(object)$this->common_model->get_data('interview_candidate_records',array('intw_can_id' => $can_id),'*');
				
				$this->content->can_details = $can_data;
			}
			
		}
		if(!empty($_FILES))
        {

            if (isset($_FILES['file'])) 
            {
                $data=$this->get_dependency_data->get_resume_data($_FILES);   
              	
              	if(!empty(is_array($data)))
              	{
	              	$this->session->set_flashdata('mobile_no',multi_array_keysearch($data,'mobile'));
	                $this->session->set_flashdata('gender',multi_array_keysearch($data,'gender'));
	               	if(array_key_exists('basics', $data))
	               	{
	               		 $this->session->set_flashdata('email',multi_array_keysearch($data['basics'],'email'));
	               		 $this->session->set_flashdata('name',multi_array_keysearch($data['basics'],'name'));
	               	}
	                $this->session->set_flashdata('dob',multi_array_keysearch($data,'dob'));
	                $this->session->set_flashdata('skills',multi_array_keysearch($data,'skills'));

	                $this->session->set_flashdata('summary',multi_array_keysearch($data,'summary'));
	                $this->session->set_flashdata('places',multi_array_keysearch($data,'places'));
	                
	                $this->session->set_flashdata('work_experience',multi_array_keysearch($data,'work_experience'));

	                $this->session->set_flashdata('education',multi_array_keysearch($data,'EDUCATION'));
	                $this->session->set_flashdata('file_type',$data['file_type']);
	                $this->session->set_flashdata('file_name',$data['file_name']);
	                $this->session->set_flashdata('resume_text',$data['text']);
            	}
            }
        }
		if(!empty($this->input->post('full_name')))
		{
			$can_id = $this->input->post('intw_can_id',true);
			$schedule_date = str_replace('/', '-', $this->input->post('schedule_date',true));
			if(!empty($schedule_date) && !empty(strtotime($schedule_date)))
			{
				$schedule_date = date('Y-m-d', strtotime($schedule_date));
			}
			$candidate_data = array(
				'int_task_id'=>$int_task_id,
				'full_name' => $this->input->post('full_name',true),
				'email_id' => $this->input->post('email_id',true),
				'mobile_no' => $this->input->post('mobile_no',true),
				'alternate_no' => $this->input->post('alternate_no',true),
				'position' => $this->input->post('position',true),
				'source'=>$this->input->post('source',true),
				'current_ctc' => $this->input->post('current_ctc',true),
				'expected_ctc' => $this->input->post('expected_ctc',true),
				'ctc_negotiable'=> $this->input->post('ctc_negotiable',true),
				'notice_period_month'=> $this->input->post('notice_period_month',true),
				'notice_period_days'=> $this->input->post('notice_period_days',true),
				'notice_negotiable'=> $this->input->post('notice_negotiable',true),
				'is_interested'=> $this->input->post('is_interested',true),
				'skills' => $this->input->post('skills',true),
				'total_yr_exp_year' => $this->input->post('total_yr_exp_year',true),
				'total_yr_exp_month' => $this->input->post('total_yr_exp_month',true),
				'relivant_yr_exp_year' => $this->input->post('relivant_yr_exp_year',true),
				'relivant_yr_exp_month' => $this->input->post('relivant_yr_exp_month',true),
				'current_location' => $this->input->post('current_location',true),
				'ready_relocate'=> $this->input->post('ready_to_relocate',true),
				'schedule_date'=> $schedule_date,
				'schedule_comment'=> $this->input->post('interview_comment',true),
				'resume' =>$this->input->post('resume',true),
				'resume_text' =>$this->input->post('resume_text',true)
			);
			if(!empty($can_id))
			{
				$where='intw_can_id='.$can_id;
				$candidate_data = set_log_fields($candidate_data,'update');	
				$this->common_model->update('interview_candidate_records',$candidate_data,$where);
				$this->session->set_flashdata('success', 'Candidate Details Updated Successfully!');
			}
			else
			{
 				$candidate_data = set_log_fields($candidate_data,'insert');			
				$this->common_model->insert('interview_candidate_records',$candidate_data);
				$this->session->set_flashdata('success', 'Candidate Details Added Successfully!');
			}
			if($int_task_id=='' || $int_task_id==null){
				redirect('interview/interview_canlist');
			}
			else{
				redirect('interview/interview_task');				
			}

			
		}

		$this->load_view("add_edit_new","HRMS - Add Edit Candidate",$this->content);
	}
	

	private function load_view($viewname= "blank_page",$page_title)
	{
		$this->content->meta_description="Meta meta_description here!";
		$this->content->meta_keywords="meta keywords here!";
		$this->masterpage->setMasterPage('master');
		$this->content->page_description = "";
		$this->masterpage->setPageTitle($page_title);
		$this->masterpage->addContentPage('interview/'.$viewname,'content',$this->content);
		$this->masterpage->show();
	}

	function insert_data(){
		$intw_can_id = $this->uri->segment(3);

		$condition='intw_can_id='.$intw_can_id;
		$cand_data=$this->common_model->get_fields_by_id('interview_manager','intw_can_id',$condition);
		if(empty($cand_data))
		{
			$this->content->candidate_details=$this->interview_model->get_interview_details($intw_can_id);
		}
		else
		{
			$this->content->candidate_details=$this->interview_model->get_record($intw_can_id);
		}
		if(!empty($this->input->post()))
		{			
			$userdata = $this->session->userdata('logged_in_user');
			$intw_can_id=$this->input->post("intw_can_id",true);
			$now=date('Y-m-d');
			$interview_status=$this->input->post("interview_status",true);
			$int_task_id=$this->input->post("int_task_id");
			$data=array(
				'round1'=>$this->input->post("round1",true),
				'round2'=>$this->input->post("round2",true),
				'round3'=>$this->input->post("round3",true),
				'round4'=>$this->input->post("round4",true),
				'round5'=>$this->input->post("round5",true),
				'round1_status'=>$this->input->post("round1_status",true),
				'round2_status'=>$this->input->post("round2_status",true),
				'round3_status'=>$this->input->post("round3_status",true),
				'round4_status'=>$this->input->post("round4_status",true),
				'round5_status'=>$this->input->post("round5_status",true),
				'round1_comment'=>$this->input->post("round1_comment",true),
				'round2_comment'=>$this->input->post("round2_comment",true),
				'round3_comment'=>$this->input->post("round3_comment",true),
				'round4_comment'=>$this->input->post("round4_comment",true),
				'round5_comment'=>$this->input->post("round5_comment",true),
				'interview_status'=>$interview_status,
				'created_by'=>$userdata['id'],'created_on'=>$now
			);
			// x_debug($data);
			if(!empty($cand_data->intw_can_id))
			{
				$where='intw_can_id='.$intw_can_id;
				$data = set_log_fields($data,'update');	
				$this->common_model->update('interview_manager',$data,$where);				
			}
			else
			{
				$data['intw_can_id']=$intw_can_id;
				$data = set_log_fields($data,'insert');	
				$this->common_model->insert('interview_manager',$data);
			}
			if(isset($int_task_id) && $interview_status=='selected'){
				$this->interview_model->update_count($int_task_id);				
			}
			if($interview_status=='selected'){
				$this->session->set_flashdata('success', 'Candidate details updated successfully!');
				redirect('interview/add_edit_hr/'.$intw_can_id.'/old');
			}else{
				$this->session->set_flashdata('success', 'Candidate details updated successfully!');
				redirect('interview/insert_data/'.$intw_can_id.'/old');
			}
		}
		$this->load_view("add_interview_details","HRMS - Add Edit Candidate",$this->content);	
	}

	function add_edit_hr(){
		$intw_can_id = $this->uri->segment(3);

		$condition='intw_can_id='.$intw_can_id;
		$cand_data=$this->common_model->get_fields_by_id('interview_manager','intw_can_id',$condition);
		if(empty($cand_data))
		{
			$this->content->candidate_details=$this->interview_model->get_interview_details($intw_can_id);
		}
		else
		{
			$this->content->candidate_details=$this->interview_model->get_record($intw_can_id);
		}
		if(!empty($this->input->post()))
		{			
			$userdata = $this->session->userdata('logged_in_user');
			$intw_can_id=$this->input->post("intw_can_id",true);
			$bonus_status=$this->input->post("bonus_status",true);
			$can_details=($this->common_model->get_fields_by_id('interview_candidate_records','*',array('intw_can_id'=>$intw_can_id)));
			if($bonus_status=='no'){
				$offered_bonus='0';
			}else{
				$offered_bonus=$this->input->post("offered_bonus",true);
			}		

			$joining_date = str_replace('/', '-', $this->input->post('joining_date',true));
				if(!empty($joining_date) && !empty(strtotime($joining_date)))
				{
					$joining_date = date('Y-m-d', strtotime($joining_date));
				}	
				$interval=date_diff(date_create($can_details->schedule_date),date_create($joining_date));
				$interval=$interval->format('%R%a');
			if($interval<0)
			{
				$this->session->set_flashdata('success','Joining Date must be greater than Interview Scheduled Date!');			
			}
			else
			{
				
				$data=array(
					'offered_ctc'=>$this->input->post("offered_ctc",true),				
					'bonus_status'=>$bonus_status,
					'offered_bonus'=>$offered_bonus,
					'joining_date'=>$joining_date
				);
				$data1=array(
					'notice_period_month'=> $this->input->post('notice_period_month',true),
					'notice_period_days'=> $this->input->post('notice_period_days',true),
				
					'notice_negotiable'=>$this->input->post("notice_negotiable",true),
					'position'=>$this->input->post("position",true)
				);
				$data = set_log_fields($data,'update');	
				$data1 = set_log_fields($data1,'update');	
				$this->interview_model->update_record($intw_can_id,$data,$data1);
				$this->session->set_flashdata('success', 'Candidate details updated successfully!');
				redirect('interview/offer_letter/'.$intw_can_id.'/old');
			}			
			
		}
		$this->load_view("add_hr_round","HRMS - Add Edit Candidate",$this->content);	
	}

	function offer_letter(){
		$intw_can_id = $this->uri->segment(3);
		$condition='intw_can_id='.$intw_can_id;
		$cand_data=$this->common_model->get_fields_by_id('interview_manager','intw_can_id',$condition);
		if(empty($cand_data))
		{
			$this->content->candidate_details=$this->interview_model->get_interview_details($intw_can_id);
		}
		else
		{
			$this->content->candidate_details=$this->interview_model->get_record($intw_can_id);
		}
		if(!empty($this->input->post()))
		{			
			$userdata = $this->session->userdata('logged_in_user');
			$intw_can_id=$this->input->post("intw_can_id",true);
	        $to_email = $this->input->post("email_id",true); 
	      	$data['letter_body']=$this->input->post('letter_body');
	        $this->load->library('email_send');
            $mailer_config = $this->common_model->get_data('email_config',array('email_template'=>'offer_letter'));
            $data['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
            $phone=$this->common_model->get_data('interview_candidate_records',array('intw_can_id'=>$intw_can_id),'mobile_no');
			$smsm = send_sms($phone['mobile_no'], "Congratulations, You have been selected. Please check your mailbox.");
            $message = $this->load->view("email_templates/".$mailer_config["email_template"], $data, TRUE);
            $sent = $this->email_send->send_mail_new($mailer_config, $to_email, $message);
            if($sent == 1)
            {
            	$data=array('mail_send'=>1);
            	$data=set_log_fields($data,'update');
            	$this->common_model->update('interview_manager',$data,array('intw_can_id'=>$intw_can_id));
                $success = $this->session->set_flashdata('success', 'Mail sent successfully!');
				redirect('interview/interview_canlist');
            } 
            else
            {
                $error = $this->session->set_flashdata('error', 'Please enter valid email id!');
                redirect('interview/interview_canlist');
            }			
		}
		$this->load_view("add_offer_letter","HRMS - Add Edit Candidate",$this->content);	
	}

	function fetch_doc(){
		echo json_encode($this->interview_model->fetch_doc());		
	}

	function email_preview(){
		$data=array(
			'intw_can_id'=>$this->input->post('intw_can_id'),
			'letter_body'=>htmlentities($_POST['letter_body']),
			'email_id'=>$this->input->post('email_id')
		);
		 $this->load->view('email_templates/offer_letter',$data);
	}

	function interview_report()
	{
		$this->load_view("interview_report","HRMS - Interview Report",$this->content);
	}
	function interview_report_fetch()
	{
		$data=array(
			'from_date'=>$this->input->post('from_date',true),
			'to_date'=>$this->input->post('to_date',true),
			'interview_status'=>$this->input->post('interview_status',true),
			'created_by'=>$this->input->post('created_by',true)
		);
		$report=$this->interview_model->interview_report_fetch($data);
		// x_debug($report);
		echo json_encode($report);
	}

	function delete()
    {
        $access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
        if(!empty($access))
        {
            $this->session->set_flashdata('access_denied', 'Access Denied');
            echo 'Access Denied';
            echo "0";
        }
        else
        { 
            $intw_can_id = $this->input->post('intw_can_id');
            $data['is_deleted']=1;
            $data=set_log_fields($data); 
            $id  = $this->common_model->update('interview_manager',$data,array('intw_can_id'=>$intw_can_id));
            $id2  = $this->common_model->update('interview_candidate_records',$data,array('intw_can_id'=>$intw_can_id));
            echo "1";
        }
    }

    public static function get_reporting(){
    	$userdata = $this->session->userdata('logged_in_user');
    	echo json_encode($this->interview_model->get_reporting($userdata['id']));
    }

     public function interview_task()
	{
		// user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
     	$this->load_view("interview_task","HRMS - Taks Assigned List",$this->content);        
	}

	function interview_list()
	{
		$userdata = $this->session->userdata('logged_in_user');
		$this->datatables->unset_column('int_task_id');
		$this->datatables->select('it.*,it.int_task_id, rq.request_id, rq.resource_type, rq.no_of_positions, rq.job_description, rq.keywords, rq.qualification, rq.budget, rq.experience, jp.title, it.count');
		$this->datatables->from('interview_task it');
		$this->datatables->join('resource_request rq', 'it.request_id=rq.request_id', 'left');		
		$this->datatables->join('job_profiles jp', 'rq.resource_type = jp.id', 'left');
		// $this->datatables->join('interview_candidate_records ic', 'ic.int_task_id=it.int_task_id', 'left');
		// $this->datatables->join('interview_manager im', 'im.intw_can_id = ic.intw_can_id', 'left');, im.interview_status
		$this->datatables->where('it.can_id',$userdata['id']);		
		$this->datatables->where('rq.is_deleted',0);
		$this->db->order_by('it.last_modified_on','desc');
		$update_url = site_url().'/interview/update_task/$1';
		// $view_url=site_url().'/interview/view_task/$1';
		$add_url=site_url().'/interview/add_edit/$1/new';

		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a> ', 'int_task_id');	
		$this->datatables->add_column('assign','<a href="'.$add_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn-info">Add Candidate</a>','int_task_id');    
		// <a href="'.$view_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a> 
		$result= $this->datatables->generate();  
		echo $result;
	}

	function update_task()
    {
       	// user_access_operation($this->router->fetch_class(),$this->router->fetch_method());   
		$userdata = $this->session->userdata('logged_in_user');
        $request_id = $this->uri->segment(3);
	    $this->content->task_details=$this->common_model->getRowByQuery('select it.*,it.int_task_id, rq.request_id, rq.resource_type, rq.no_of_positions, rq.job_description, rq.keywords, rq.qualification, rq.budget, rq.experience, jp.title from interview_task it join resource_request rq on it.request_id=rq.request_id join job_profiles jp on rq.resource_type = jp.id where it.can_id='.$userdata['id'].' and rq.is_deleted=0'); 
        if($this->input->is_ajax_request())
        {
        	$int_task_id=$this->input->post('int_task_id');
        	$data=array(
        		'status'=>$this->input->post('status')
        	);
        	$data = set_log_fields($data);
        	// x_debug($data);
			$this->common_model->update('interview_task',$data,array('int_task_id' => $int_task_id));
			$this->session->set_flashdata('success', 'Task Status Updated successfully!');
        }	    

	    $this->load_view("assigned_task","HRMS - Assign Task",$this->content);
    }



}
