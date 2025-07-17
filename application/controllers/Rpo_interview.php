<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rpo_interview extends My_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model('common_model');	
		$this->load->model('rpo_interview_model');
		$this->load->config('hrms_config');
		$this->load->library('get_dependency_data');	
		$userdata = $this->session->userdata('logged_in_user');
		if(!$userdata){
			$newURL = site_url()."/login";
			header('Location: '.$newURL);        		
		}        
	}

	public function index($msg="")
	{	
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());		
		$this->load_view("rpo_interview_canlist","HRMS - Interview Candidate List",$this->content);        
	}

	public function interview_canlist($msg="")
	{	
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());		
		$this->load_view("rpo_interview_canlist","HRMS - Interview Candidate List",$this->content);        
	}

	function list_candidates()
	{
		$this->datatables->unset_column('type_id,is_interested');
		$this->datatables->select('intw_can_id, can_name, email_id,phone1,is_interested');
		$this->datatables->from('rpo_interview_candidate_records');
		$this->datatables->where('is_deleted',0);
		 $update_url = site_url().'/rpo_interview/interview_details/$1';
		$this->datatables->add_column('edit', '<a  href="'.$update_url.'" class="tabledit-edit-button btn btn-success btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_can($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_edit"><span class="glyphicon glyphicon-trash"></span></a>', 'intw_can_id');

		$result= $this->datatables->generate();  
		echo $result;
	}


	function get_rpocan_list()
	{
      $match = $_GET['term'];
		$query = $this->db->select('can_id as id,can_name as text,job_type')->like('can_name',$match,'both')->limit(10)->get("rpo_candidates");
		$json = $query->result();
		echo json_encode($json);
	}

	function get_rpoclient_list()
	{
      $match = $_GET['term'];
		$query = $this->db->select('client_id as id,client_name as text,contact_email')->like('client_name',$match,'both')->limit(10)->get("rpo_client_details");
		$json = $query->result();
		echo json_encode($json);
	}

	function get_project_by_client()
	{
		if($this->input->is_ajax_request())
		{
			$client_id = $this->input->post('client_id');
			$projects = $this->common_model->get_data_array('rpo_contract',array('client_id' => $client_id,'is_deleted' => 0,'proj_end_date >' => date('Y-m-d')));
			if(!empty($projects))
			{
				foreach ($projects as $key => $value)
				{			
					$proj_title = ucwords(strtolower($value['proj_title']));
					$selected ='';
					if($value['client_id'] == $client_id) $selected = 'selected="selected"';
					$data .='<option '. $selected .' value='.$value['client_id'].'>'.$proj_title.'</option>';			
				}
			}
			else
			{
				$data .='<option  value="" "selected">'.'No Projects'.'</option>';	
			}
			
     	echo ($data);
		}
	}


	function add_edit()
	{
		$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		// $access=0;
		// if(!empty($access))
		// {
		// 	$this->session->set_flashdata('warning', 'Access Denied');
		// 	redirect('rpo_interview');
		// }
		// else
		// { 
			$can_id = $this->uri->segment(3);
			if(!empty($can_id))
			{	
				if($this->common_model->count_all($tablename='rpo_interview_candidate_records', $conditions = array('intw_can_id' =>$can_id)) == 0)
				{
					// redirect('Record_not_found');
				}
				else
				{
					$can_data=(object)$this->common_model->get_data('rpo_interview_candidate_records',array('intw_can_id' => $can_id),'*');
					// x_debug($can_data);
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
			if(!empty($this->input->post('can_name')))
			{
				$post = $this->input->post();
				$can_id = $this->input->post('intw_can_id',true);
				$total_yr_exp =$this->input->post('total_yr_exp',true);
				$relivant_yr_exp = $this->input->post('relivant_yr_exp',true);
				// $schedule_date = str_replace('/', '-', $this->input->post('schedule_date',true));
				// if(!empty($schedule_date) && !empty(strtotime($schedule_date)))
				// {
				// 	$schedule_date = date('Y-m-d', strtotime($schedule_date));
				// }
				/*$this->db->select('rpo_unique_id');
				$this->db->from("rpo_emp_unique_record");
				$this->db->limit(1);
				$this->db->order_by('rpo_unique_id',"DESC");
				$last_id = $this->db->get()->row();
	*/
				// x_debug($last_id);exit;
				$last_id = $this->common_model->count_all('rpo_interview_candidate_records');

				if(!empty($last_id))
				{
					if(!empty($can_id))
					{
						$rpo_emp_code = $this->input->post('rpo_emp_code',true);	
					}
					else
					{
						$last_id = $last_id +1;
						$rpo_emp_code = $this->config->item('rpo_prefix').$last_id;
					}
					
				}
				else
				{
					$rpo_emp_code = $this->config->item('rpo_prefix').'1';
				}

				/*if(!empty($this->input->post('email_emp_code',true)))
				{
					$record_exist = check_record_exist($tablename='rpo_interview_candidate_records', $conditions = array('rpo_emp_code' =>$this->input->post('email_emp_code',true)));
				}

				if(!$record_exist)
				{
					$rpo_emp_unique_record = array('emp_name' => $this->input->post('full_name',true),'emp_email' => $this->input->post('email_id',true),'rpo_emp_code'=> $rpo_emp_code);
					$this->common_model->insert('rpo_emp_unique_record',$rpo_emp_unique_record);
				}
				else
				{
					$can_unique_data = $this->common_model->get_data('rpo_emp_unique_record',array('rpo_emp_code'=>$this->input->post('email_emp_code',true)),'rpo_unique_id,rpo_emp_code,emp_name');
					$rpo_emp_code = $can_unique_data['rpo_emp_code'];
				   // x_debug($can_basic_data);	
				}*/
				

				$candidate_data = array(
					'rpo_emp_code' => $rpo_emp_code,
					'can_name' => $this->input->post('can_name',true),
					'email_id' => $this->input->post('email_id',true),
					'phone1' => $this->input->post('mobile_no',true),
					'phone2' => $this->input->post('alternate_no',true),
					'designation' => $this->input->post('position',true),
					'source'=>$this->input->post('source',true),
					'expected_salary' => $this->input->post('expected_salary',true),
					'salary_negotiable'=> $this->input->post('salary_negotiable',true),
					'is_interested'=> $this->input->post('is_interested',true),
					'skills' => $this->input->post('skills',true),
					'total_yr_exp' => $total_yr_exp,
					'relivant_yr_exp' => $relivant_yr_exp,
					'current_location' => $this->input->post('current_location',true),
					'ready_relocate'=> $this->input->post('ready_to_relocate',true),
					// 'schedule_date'=> $schedule_date,
					// 'schedule_comment'=> $this->input->post('schedule_comment',true),
					'resume' =>$this->input->post('resume',true),
					'resume_text' =>$this->input->post('resume_text',true)
				);
				// x_debug($candidate_data);

				if(!empty($can_id))
				{
					$candidate_data = set_log_fields($candidate_data,'update');	
					$this->common_model->update('rpo_interview_candidate_records',$candidate_data,array('intw_can_id'=>$can_id));
					$this->session->set_flashdata('success', 'Candidate Details Updated Successfully!');
					redirect('rpo_interview/interview_canlist');
				}
				else
				{
	 				$candidate_data = set_log_fields($candidate_data,'insert');			
					$this->common_model->insert('rpo_interview_candidate_records',$candidate_data);
					$this->session->set_flashdata('success', 'Candidate Details Added Successfully!');
					redirect('rpo_interview/interview_canlist');
				}
			}
			$this->load_view("add_edit_rpo_interview_candidate","HRMS - Add Edit Candidate",$this->content);
		// }
	}

	function interview_details()
	{
		$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		$access=0;
		if(!empty($access))
		{
			$this->session->set_flashdata('warning', 'Access Denied');
			redirect('rpo_interview');
		}
		else
		{ 
			$this->content->clients  = $this->common_model->get_form_dropdown($tablename='rpo_client_details', $fields = array('client_id','client_name'), $conditions = array('is_deleted' => 0,'contract_end_date > ' => date('Y-m-d'),'contract_status'=>'active'));
			// echo $this->db->last_query();exit;
			// x_debug($this->content->clients);
			$this->content->projects  = $this->common_model->get_form_dropdown($tablename='rpo_contract', $fields = array('proj_id','proj_title'), $conditions = array('is_deleted' => 0,'proj_end_date > '=> date('Y-m-d')));		

			$intw_can_id = $this->uri->segment(3);			
			/* First check if candidate is interested or not for current job opening 
				if yes then 
				{
				   check criteria for schedule new interview for another project 
						- check if interview status is either selected or rejected 
						- if rejected HR can use that candidate for further interviews
						- if selected , joined the company and his contract is closed it can use for another company or project
						- show add new interview button if one of the above condition is true
				}
				else
				{
					End Process
				}			 
			*/	

			/* ------   check if candidate is interested or not for current job opening   ------ */

			// $this->content->show_addnew_btn = 0;
			$is_interested = $this->common_model->get_data('rpo_interview_candidate_records',array('intw_can_id'=>$intw_can_id),'intw_can_id,is_interested');
			// debug($is_interested);

			/* ------ check if interview status is either selected or rejected   ------ */

				// $interview_status = $this->common_model->get_data('rpo_interview_manager',array('intw_can_id'=>$this->input->post('intw_can_id',true)),'intw_can_id,interview_status');
			$interview_status = $this->common_model->get_data_row_order_by('rpo_interview_manager',array('intw_can_id'=>$intw_can_id),'intw_can_id,interview_status',array('inw_mid','desc'),1);
			// if(!empty($interview_status))
			// {
				$can_details  = $this->rpo_interview_model->get_rpo_details($intw_can_id);
			// }

			// debug($interview_status);
			// x_debug($can_details);

			/* Case Rejected */

			// if($interview_status['interview_status']=='rejected')
			// {
			// 	$this->content->show_addnew_btn = 1;
			// }

			// show add new button

			/* Case Selected  */
			// echo strtotime(date('Y-m-d')).'<br/>';
			// echo strtotime($can_details['proj_end_date']);
			/*if(($interview_status['interview_status']=='selected') && (strtotime($can_details['proj_end_date']) < strtotime(date('Y-m-d'))))
			{
				$this->content->show_addnew_btn = 1;
			}*/

			// show add new button

			// if($this->content->show_addnew_btn == 0)
			// {
				// $this->content->candidate_details = $this->common_model->get_data_row_order_by('rpo_interview_manager',array('intw_can_id'=>$intw_can_id),'intw_can_id,interview_status',array('inw_mid','desc'),1);
				$this->content->candidate_details = $this->common_model->get_data_row_order_by('rpo_interview_manager',array('intw_can_id'=>$intw_can_id),'*',array('inw_mid','desc'),1);
			// }	


			// x_debug($this->content->candidate_details);	
			// echo $this->content->show_addnew_btn;exit;

			if(!empty($this->input->post()))
			{			
				// x_debug($this->input->post());
				$userdata = $this->session->userdata('logged_in_user');
				$intw_can_id=$this->input->post("intw_can_id",true);
				$inw_mid=$this->input->post("inw_mid",true);
				$now=date('Y-m-d');
				$data=array(
					'intw_can_id' => $this->input->post("intw_can_id",true),
					'schedule_date' => !empty($this->input->post("schedule_date")) ? date_to_db($this->input->post("schedule_date",true)) : '' , 
					'schedule_comment' => $this->input->post("schedule_comment",true), 
					'client_id' => $this->input->post("client_name",true), 
					'project_id' => $this->input->post("project_name",true), 
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
					'round1_date'=>(!empty($this->input->post("round1_date"))) ? date_to_db($this->input->post("round1_date")) : '',
					'round2_date'=>(!empty($this->input->post("round2_date"))) ? date_to_db($this->input->post("round2_date",true)) : '',
					'round3_date'=>(!empty($this->input->post("round3_date"))) ? date_to_db($this->input->post("round3_date",true)) : '',
					'round4_date'=>(!empty($this->input->post("round4_date"))) ? date_to_db($this->input->post("round4_date",true)) : '',
					'round5_date'=>(!empty($this->input->post("round5_date"))) ? date_to_db($this->input->post("round5_date",true)) : '',
					'interview_status'=>$this->input->post("interview_status",true),
					'created_by'=>$userdata['id'],'created_on'=>$now
				);
				if(!empty($inw_mid))
				{
					$data = set_log_fields($data,'update');	
					$this->common_model->update('rpo_interview_manager',$data,array('inw_mid' => $inw_mid));
					$this->session->set_flashdata('success', 'Interview details updated successfully!');
					redirect('rpo_interview/add_edit_hrdetails/'.$intw_can_id);
				}
				else
				{
					$data['intw_can_id']=$intw_can_id;
					$data = set_log_fields($data,'insert');	
					$this->common_model->insert('rpo_interview_manager',$data);
					$this->session->set_flashdata('success', 'Interview details updated successfully!');
					redirect('rpo_interview/add_edit_hrdetails/'.$intw_can_id);
				}
			}
			$this->load_view("add_rpo_interview_details","HRMS - Add Edit Candidate",$this->content);
		}
	}

	function add_edit_hrdetails()
	{
		$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		$access=0;
		if(!empty($access))
		{
			$this->session->set_flashdata('warning', 'Access Denied');
			redirect('rpo_interview');
		}
		else
		{
			$intw_can_id = $this->uri->segment(3);
			if(!empty($intw_can_id))
			{
				$this->content->can_data = $this->common_model->get_data('rpo_interview_candidate_records',array('intw_can_id'=>$intw_can_id));
			}
			//x_debug($this->content->can_data);
			/* First check if candidate is interested or not for current job opening 
				if yes then 
				{
				   check criteria for schedule new interview for another project 
						- check if interview status is either selected or rejected 
						- if rejected HR can use that candidate for further interviews
						- if selected , joined the company and his contract is closed it can use for another company or project
						- show add new interview button if one of the above condition is true
				}
				else
				{
					End Process
				}
			*/	

			/* ------   check if candidate is interested or not for current job opening   ------ */
				$this->content->show_addnew_btn = 0;
			/* ------ check if interview status is either selected or rejected   ------ */

				$interview_status = $this->common_model->get_data_row_order_by('rpo_interview_manager',array('intw_can_id'=>$intw_can_id),'intw_can_id,interview_status',array('inw_mid','desc'),1);
				if(!empty($interview_status))
				{
					$can_details  = $this->rpo_interview_model->get_rpo_details($intw_can_id);
				}
				/* Case Rejected */

				if($interview_status['interview_status']=='rejected')
				{
					$this->content->show_addnew_btn = 1;
				}
				// show add new button

				/* Case Selected  */
				if(($interview_status['interview_status']=='selected') && (strtotime($can_details['proj_end_date']) < strtotime(date('Y-m-d'))))
				{
					$this->content->show_addnew_btn = 1;
				}

				// show add new button

				if($this->content->show_addnew_btn == 0)
				{
					$this->content->candidate_details = $this->common_model->get_data_row_order_by('rpo_interview_manager',array('intw_can_id'=>$intw_can_id),'*',array('inw_mid','desc'),1);
				}

				$this->content->candidate_details = $this->common_model->get_data_row_order_by('rpo_interview_manager',array('intw_can_id'=>$intw_can_id),'*',array('inw_mid','desc'),1);
			
				$this->content->candidate_details = $this->rpo_interview_model->get_rpo_details($intw_can_id);
				if(!empty($_POST))
				{
					$can_intew_details = array('joining_date'=>date_to_db($this->input->post('joining_date',true)),'offered_position'=>$this->input->post('position',true));
					$this->common_model->update('rpo_interview_manager',$can_intew_details,array('intw_can_id' => $intw_can_id));
					$this->session->set_flashdata('success', 'HR round details updated successfully!');
					redirect('rpo_interview/offer_letter/'.$intw_can_id);
				}
			$this->load_view("add_rpo_hr_round","HRMS - Add Edit Candidate HR Round Details",$this->content);
		}
	}

	function offer_letter()
	{
		$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		$access=0;
		if(!empty($access))
		{
			$this->session->set_flashdata('warning', 'Access Denied');
			redirect('rpo_interview');
		}
		else
		{
			$intw_can_id = $this->uri->segment(3);

			// $condition='intw_can_id='.$intw_can_id;
			// $cand_data=$this->common_model->get_fields_by_id('rpo_interview_manager','intw_can_id',$condition);
			// x_debug($cand_data);
			// if(empty($intw_can_id))
			// {
			// 	$this->content->candidate_details=$this->rpo_interview_model->get_interview_details($intw_can_id);
			// }
			// else
			// {
				$this->content->candidate_details=$this->rpo_interview_model->get_rpo_details($intw_can_id);
				// x_debug($this->content->candidate_details);
			// }
			if(!empty($this->input->post()))
			{			
				// x_debug($this->input->post());
				$userdata = $this->session->userdata('logged_in_user');
				$intw_can_id=$this->input->post("intw_can_id",true);
		      $to_email = $this->input->post("email_id",true); 
	      	$data['letter_body']=$this->input->post('letter_body');
	         $this->load->library('email_send');
            $mailer_config = $this->common_model->get_data('email_config',array('email_template'=>'offer_letter'));
            // echo $to_email;
            // x_debug($mailer_config);
            $data['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
            $phone = $this->common_model->get_data('rpo_candidates',array('intw_can_id'=>$intw_can_id),'phone1');
            $smsm = send_sms($phone['phone1'], "Congratulations, You have been selected. Please check your mailbox..");
            $message = $this->load->view("email_templates/".$mailer_config["email_template"], $data, TRUE);
            // $sent = $this->email_send->send_mail_new($mailer_config, $to_email, $message);
            // if($sent == 1)
            // {
            	$data=array('mail_send'=>1);
            	$data=set_log_fields($data);
            	$this->common_model->update('rpo_interview_manager',$data,array('intw_can_id'=>$intw_can_id));
                $success = $this->session->set_flashdata('success', 'Offer letter has been sent to registered email id!');
                redirect('rpo_interview',$success);
            // } 
            // else
            // {
            //     $error = $this->session->set_flashdata('error', 'Please enter valid email id!');
            //     redirect('rpo_interview', $error);
            // }
			}
			$this->load_view("add_rpo_offer_letter","HRMS - Add Edit Candidate",$this->content);
		}
	}

	function fetch_doc()
	{
		echo json_encode($this->rpo_interview_model->fetch_doc());		
	}

	function email_preview()
	{
		$data=array(
			'intw_can_id'=>$this->input->post('intw_can_id'),
			'letter_body'=>htmlentities($_POST['letter_body']),
			'email_id'=>$this->input->post('email_id')
		);
         $data['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
		 $this->load->view('email_templates/rpo_offer_letter',$data);
	}

	function interview_report()
	{
		$this->load_view("rpo_interview_report","HRMS - Interview Report",$this->content);
	}

	function interview_report_fetch()
	{
		$data=array(
			'from_date'=>$this->input->post('from_date',true),
			'to_date'=>$this->input->post('to_date',true),
			'interview_status'=>$this->input->post('interview_status',true)
		);
		$report=$this->rpo_interview_model->interview_report_fetch($data);
		echo json_encode($report);
	}


	/* RPO Employee Joining Process */

	function joining_process()
	{
		$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		$access=0;
		if(!empty($access))
		{
			$this->session->set_flashdata('warning', 'Access Denied');
			redirect('rpo_interview');
		}
		else
		{
			$intw_can_id = $this->uri->segment(3);
			$this->content->already_added = $this->common_model->get_data('rpo_candidates',array('intw_can_id' => $intw_can_id),'*');
			// check_record_exist($tablename='rpo_candidates', $conditions = array('intw_can_id' =>$intw_can_id));
			if(!empty($intw_can_id))
			{
				$this->content->rpo_can_details = $this->rpo_interview_model->get_rpo_details($intw_can_id);
				// x_debug($this->content->rpo_can_details);
				// $this->content->joining_details = $this->rpo_interview_model->get_joining_details('rpo_employee_projects',array('can_id' => $intw_can_id));
				// x_debug($this->content->joining_details);	
			}

			if(!empty($this->input->post()))
			{
				$data  = array('is_joined'=>$this->input->post('is_joined'),'joining_date' => date_to_db($this->input->post('joining_date',true)));
				// x_debug($data);

				$this->common_model->update('rpo_interview_manager',$data,array('intw_can_id' => $intw_can_id));

				$rpoemppro_id = $this->input->post('rpoemppro_id',true);
				$joining_details = array('can_id' => $intw_can_id,'client_id' => $this->input->post('client_id',true),'project_id' => $this->input->post('project_id',true),'joining_date' => date_to_db($this->input->post('joining_date',true)),'proj_start_date' => date_to_db($this->input->post('proj_start_date',true)),'proj_end_date' => date_to_db($this->input->post('proj_end_date',true)));

				// x_debug($joining_details);

				if(!empty($rpoemppro_id))
				{
					// debug($joining_details);
	 				$joining_details = set_log_fields($joining_details);
					$this->common_model->update('rpo_employee_projects',$joining_details,array('rpoemppro_id' => $rpoemppro_id));
					// echo $this->db->last_query();exit;
					$this->session->set_flashdata('success', 'Joining Details Updated Successfully!');
				}
				else
				{
					$joining_details=set_log_fields($joining_details,'insert');
					$this->common_model->insert('rpo_employee_projects',$joining_details);
					// echo $this->db->last_query();exit;
					$this->session->set_flashdata('success', 'Joining Details Added Successfully!');
				}
				redirect('rpo_interview/joining_process/'.$intw_can_id);			
			}
			// x_debug($this->content->rpo_can_details);
			$this->load_view("rpo_joining_process","HRMS - Joing Process",$this->content);
		}
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
         $id  = $this->common_model->update('rpo_interview_manager',$data,array('intw_can_id'=>$intw_can_id));
         $id2  = $this->common_model->update('rpo_interview_candidate_records',$data,array('intw_can_id'=>$intw_can_id));
         echo "1";
      }
   }

   function get_rpo_details()
   {
   	if($this->input->is_ajax_request())
      {
         $search_str = $this->input->post('search_str',TRUE);
   		$rpo_details = $this->rpo_interview_model->get_rpodata_by_search_string($search_str);
   		echo json_encode($rpo_details);
   	}
   }

	function check_availability()
	{
		if($this->input->is_ajax_request())
		{
			$email = $this->input->post('email',TRUE);
			if($email=='')
			{
				echo "2";
			}
			else
			{
				if($this->common_model->count_all('rpo_interview_candidate_records',array('email_id'=>$email)) > 0)
				{
					echo "0";
				}
				else
				{
					echo "1";
				}  
			}               
		}
	}

	function get_interview_dates()
	{
		if($this->input->is_ajax_request())
		{
			$can_id = $this->input->post('can_id',TRUE);
			$joining_date = $this->input->post('joining_date',TRUE);
			$interview_details = $this->common_model->get_data_row_order_by('rpo_interview_manager',array('intw_can_id'=>$can_id),'*',array('inw_mid','desc'),1);
			// x_debug($interview_details);
			if( !empty($interview_details['schedule_date'])  &&  (($interview_details['schedule_date'] > date_to_db($joining_date)) || ($interview_details['round1_date'] > date_to_db($joining_date)) || ($interview_details['round2_date'] > date_to_db($joining_date)) || ($interview_details['round3_date'] > date_to_db($joining_date)) || ($interview_details['round4_date'] > date_to_db($joining_date)) || ($interview_details['round5_date'] > date_to_db($joining_date))) )
			{
				echo "1";
			}
		}
	}

	private function load_view($viewname= "blank_page",$page_title)
	{
		$this->content->meta_description="Meta meta_description here!";
		$this->content->meta_keywords="meta keywords here!";
		$this->masterpage->setMasterPage('master');
		$this->content->page_description = "";
		$this->masterpage->setPageTitle($page_title);
		$this->masterpage->addContentPage('rpo_manager/'.$viewname,'content',$this->content);
		$this->masterpage->show();
	}
}
