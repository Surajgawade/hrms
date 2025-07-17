<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
		$userdata = $this->session->userdata('logged_in_user');
		if(!$userdata)
		{
			$newURL = site_url()."/login";
			header('Location: '.$newURL);
		}
	}

	public function job_openings()
	{
		//user_access_page($this->router->fetch_class(),$this->router->fetch_method());  
		$this->load_view("job_openings","HRMS - Job Openings",$this->content);        
	}


	public function job_list()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());  
		$this->load_view("job_list","HRMS - Job List",$this->content);        
	}

	function view_list()
	{  
		$this->datatables->unset_column('job_id');
		$this->datatables->select('job_id, job_title, status');
		$this->datatables->from('jobs');
		$this->datatables->where('is_deleted',0);
		// $this->db->order_by("can_id", "desc");
		$update_url = site_url().'/jobs/add_edit_job_details/$1';
		$view_url=site_url().'/jobs/view/$1';
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn-success btn btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a> <a onClick="delete_job($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_edit" ><span class="glyphicon glyphicon-trash"></span></a><a href="'.$view_url.'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>', 'job_id');	   
		$result= $this->datatables->generate();  
		echo $result;
	}

	function add_edit_job_details()
	{
		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		$job_id = $this->uri->segment(3);

		if(!empty($job_id))
		{
			if($this->common_model->count_all($tablename='jobs', $conditions = array('job_id' =>$job_id)) == 0 )
			{
				redirect('Record_not_found');
			}
			else
				{
			$this->content->job_details = $this->common_model->get_data('jobs',array('job_id'=>$job_id));
			}
		}
		$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		if(!empty($access))
		{
			$this->session->set_flashdata('warning', 'Access Denied');
			redirect('jobs/job_list');
		}
		else
		{
			if(!empty($this->input->post()))
			{
				$post = $this->input->post();
				$job_id = $post['job_id'];
				$job_data = $post;

				if(!empty($job_id))
				{
					$job_data=set_log_fields($job_data);
					$this->common_model->update('jobs',$job_data,array('job_id' => $job_id));
					$this->session->set_flashdata('success', 'Job Opening Details Updated Successfully!');
				}
				else
				{
					$job_data=set_log_fields($job_data,'insert');
					$this->common_model->insert('jobs',$job_data);
					$this->session->set_flashdata('job_data', 'Job Opening Details Added Successfully!');
				}				
				redirect('jobs/job_list');
			}
			$this->load_view("add_edit_job_details","HRMS - Add Job Opening Details",$this->content);
		}
	}

	function delete_job()
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
				$job_id = $this->input->post('job_id');
				$id  = $this->common_model->update('jobs',array('is_deleted' => 1 ),array('job_id' => $job_id));
				echo "1";
			}
		}
	}

	//function to view indiviual job 
	public function view()
	{
		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());  
		$userdata = $this->session->userdata('logged_in_user');
		$job_id =$this->uri->segment(3); 
		$conditions='job_id='.$job_id;
		$this->content->job_details=$this->common_model->get_fields_by_id('jobs','*',$conditions);
		$this->load_view("view_jobs","HRMS - View Leave",$this->content);
	}


	// Refer a friend & send email with JD 

	function refer_friend()
	{
		if(!empty($this->input->post()))
		{
			$userdata = $this->session->userdata('logged_in_user');

			$this->load->library('email_send');
			$mailer_config = $this->common_model->get_data('email_config',array('email_template'=>'refer_friend'));
			$mailer_config['email_from'] = $userdata['email'];
			$job_reference['message'] = $this->input->post('message',true);
			$job_reference['job_title'] = $this->input->post('job_title',true);
			$job_reference['no_of_position'] = $this->input->post('no_of_position',true);			

			$job_reference['referto_name'] = $this->input->post('referto_name',true);
			$job_reference['referto_email'] = $this->input->post('referto_email',true);
			$job_reference['job_id'] = $this->input->post('frm_job_id',true);
			$job_reference['can_id'] = $userdata['id'];
			$email_id =$this->input->post('referto_email',true);
            $job_reference['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
			$message = $this->load->view("email_templates/".$mailer_config["email_template"],$job_reference, TRUE);
			$job_reference_details = array('job_id'=> $job_reference['job_id'],'referred_by' => $userdata['id'],'referred_by' => $job_reference['can_id'] ,'referto_name' => $job_reference['referto_name'],'referto_email' => $job_reference['referto_email'],'job_title' =>$job_reference['job_title'],'no_of_position' =>$job_reference['no_of_position'],'message' =>$job_reference['message']);

			$this->common_model->insert('referred_job_manager',$job_reference_details); 

			if($this->email_send->send_mail_new($mailer_config, $email_id,$message))
			{           
				$this->session->set_flashdata('success', 'Email sent!');
				redirect('jobs/job_openings');
			}
		}
	}

//Designation
	public function designation_list()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());  
		$this->load_view("designation_list","HRMS - Designation List",$this->content);        
	}

	function view_designation_list()
	{  
		$this->datatables->unset_column('id');
		$this->datatables->select('id,title');
		$this->datatables->from('job_profiles');
		$this->datatables->where('is_deleted',0);
		// $this->db->order_by("can_id", "desc");
		$update_url = site_url().'/jobs/add_edit_designation/$1';
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn-success btn btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a> <a onClick="delete_designation($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_delete" ><span class="glyphicon glyphicon-trash"></span></a>', 'id');	   
		$result= $this->datatables->generate();  
		echo $result;
	}

	function add_edit_designation()
	{
		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		$id = $this->uri->segment(3);
		$this->content->departments = $this->common_model->get_form_dropdown($tablename = 'departments', $fields = array('id','title'),$conditions = array('is_deleted' => 0));
		// x_debug($this->content->departments);
		if(!empty($id))
		{
			if($this->common_model->count_all($tablename='job_profiles', $conditions = array('id' =>$id)) == 0 )
			{
				redirect('Record_not_found');
			}
			else
			{
				$this->content->job_details = $this->common_model->get_data('job_profiles',array('id'=>$id));
				// x_debug($this->content->job_details);
			}
		}
		$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		if(!empty($access))
		{
			$this->session->set_flashdata('warning', 'Access Denied');
			redirect('jobs/designation_list');
		}
		else
		{
			if(!empty($this->input->post()))
			{
				$post = $this->input->post();
				// x_debug($post);				
				$id = $post['id'];
				if(isset($post['is_hod']))
				{
					$is_hod = $post['is_hod'];	
				}
				else
				{
					$is_hod = 0;	
				}
				
				$job_data = array('title'=>$post['title'],'dept_id'=>$post['dept_id'],'is_hod'=>$is_hod);

				if(!empty($id))
				{
					$job_data=set_log_fields($job_data);
					$this->common_model->update('job_profiles',$job_data,array('id' => $id));
					$this->session->set_flashdata('success', 'Designation Details Updated Successfully!');
				}
				else
				{
					$job_data=set_log_fields($job_data,'insert');
					$this->common_model->insert('job_profiles',$job_data);
					$this->session->set_flashdata('job_data', 'Designation Details Added Successfully!');
				}				
				redirect('jobs/designation_list');
			}
			$this->load_view("add_edit_designation","HRMS - Add/Edit Designation Details",$this->content);
		}
	}

	function delete_designation()
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
				$job_id = $this->input->post('id');
				$id  = $this->common_model->update('job_profiles',array('is_deleted' => 1 ),array('id' => $job_id));
				echo "1";
			}
		}
	}

//Department
	public function department_list()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());  
		$this->load_view("department_list","HRMS - Department List",$this->content);        
	}

	function view_department_list()
	{  
		$this->datatables->unset_column('id');
		$this->datatables->select('id,title');
		$this->datatables->from('departments');
		$this->datatables->where('is_deleted',0);
		// $this->db->order_by("can_id", "desc");
		$update_url = site_url().'/jobs/add_edit_department/$1';
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn-success btn btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a> <a onClick="delete_department($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_edit" ><span class="glyphicon glyphicon-trash"></span></a>', 'id');	   
		$result= $this->datatables->generate();  
		echo $result;
	}

	function add_edit_department()
	{
		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		$id = $this->uri->segment(3);

		if(!empty($id))
		{
			if($this->common_model->count_all($tablename='departments', $conditions = array('id' =>$id)) == 0 )
			{
				redirect('Record_not_found');
			}
			else
				{
			$this->content->dep_details = $this->common_model->get_data('departments',array('id'=>$id));
			}
		}
		$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		if(!empty($access))
		{
			$this->session->set_flashdata('warning', 'Access Denied');
			redirect('jobs/department_list');
		}
		else
		{
			if(!empty($this->input->post()))
			{
				$post = $this->input->post();
				$id = $post['id'];
				$dep_data = $post;

				if(!empty($id))
				{
					$dep_data=set_log_fields($dep_data);
					$this->common_model->update('departments',$dep_data,array('id' => $id));
					$this->session->set_flashdata('success', 'Department Details Updated Successfully!');
				}
				else
				{
					$dep_data=set_log_fields($dep_data,'insert');
					$this->common_model->insert('departments',$dep_data);
					$this->session->set_flashdata('dep_data', 'Department Details Added Successfully!');
				}				
				redirect('jobs/department_list');
			}
			$this->load_view("add_edit_department","HRMS - Add/Edit Department Details",$this->content);
		}
	}

	function delete_department()
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
				$dep_id = $this->input->post('id');
				$id  = $this->common_model->update('departments',array('is_deleted' => 1 ),array('id' => $dep_id));
				echo "1";
			}
		}
	}

	function check_desi_exist()
	{
		if($this->input->is_ajax_request())
		{
			$dept_id = $this->input->post('dept_id',TRUE);
			$title = $this->input->post('title',TRUE);
			$is_exist = $this->common_model->count_all('job_profiles', array('dept_id'=> $dept_id,'title'=>$title,'is_deleted' =>0));
			if($is_exist)
			{
				echo "1";
			}
		}
	}

//Qualification
	public function qualification_list()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());  
		$this->load_view("qualification_list","HRMS - Qualification List",$this->content);        
	}

	function view_qualification_list()
	{  
		$this->datatables->unset_column('id');
		$this->datatables->select('id,title');
		$this->datatables->from('qualifications');
		$this->datatables->where('is_deleted',0);
		// $this->db->order_by("can_id", "desc");
		$update_url = site_url().'/jobs/add_edit_qualification/$1';
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn-success btn btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a> <a onClick="delete_qualification($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_edit" ><span class="glyphicon glyphicon-trash"></span></a>', 'id');	   
		$result= $this->datatables->generate();  
		echo $result;
	}

	function add_edit_qualification()
	{
		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		$id = $this->uri->segment(3);

		if(!empty($id))
		{
			if($this->common_model->count_all($tablename='qualifications', $conditions = array('id' =>$id)) == 0 )
			{
				redirect('Record_not_found');
			}
			else
				{
			$this->content->qua_details = $this->common_model->get_data('qualifications',array('id'=>$id));
			}
		}
		$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		if(!empty($access))
		{
			$this->session->set_flashdata('warning', 'Access Denied');
			redirect('jobs/qualification_list');
		}
		else
		{
			if(!empty($this->input->post()))
			{
				$post = $this->input->post();
				$id = $post['id'];
				$qua_data = $post;

				if(!empty($id))
				{
					$qua_data=set_log_fields($qua_data);
					$this->common_model->update('qualifications',$qua_data,array('id' => $id));
					$this->session->set_flashdata('success', 'Qualification Details Updated Successfully!');
				}
				else
				{
					$qua_data=set_log_fields($qua_data,'insert');
					$this->common_model->insert('qualifications',$qua_data);
					$this->session->set_flashdata('qua_data', 'Qualification Details Added Successfully!');
				}				
				redirect('jobs/qualification_list');
			}
			$this->load_view("add_edit_qualification","HRMS - Add/Edit Qualification Details",$this->content);
		}
	}

	function delete_qualification()
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
				$qua_id = $this->input->post('id');
				$id  = $this->common_model->update('qualifications',array('is_deleted' => 1 ),array('id' => $qua_id));
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
		$this->masterpage->addContentPage('jobs/'.$viewname,'content',$this->content);
		$this->masterpage->show();
	}

}

