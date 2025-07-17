<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Performance_criteria extends My_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('performance_model','performance_criteria');		
		$this->load->model('common_model','common');		
		$userdata = $this->session->userdata('logged_in_user');
		if(!$userdata){
			$newURL = site_url()."/login";
			header('Location: '.$newURL);        		
		}        
	}

	public function index($msg="")
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
      $this->load_view("criteria_list","HRMS - Performance Criteria List",$this->content);        
	}

	function list_criterias()
	{
		$this->datatables->unset_column('criteria_id');
		$this->datatables->unset_column('performance_criteria.role_id');
		$this->datatables->select('criteria_id, performance_criteria.role_id ,role_name, criteria_name, percent_value, IF(performance_criteria.role_id = "0", "All" ,role_name) as role_name');
		$this->datatables->join('roles', 'performance_criteria.role_id = roles.role_id', 'left');		
		$this->datatables->from('performance_criteria');
		$this->datatables->where('performance_criteria.is_deleted',0);
      // $this->db->order_by("criteria_id", "desc");        
		$this->datatables->add_column('edit', '<a href="'.site_url().'/performance_criteria/add_criteria/$1" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a><a onClick="delete_data($1)" class="tabledit-delete-button btn btn-sm btn_delete btn-danger" ><span class="glyphicon glyphicon-trash"></span></a>', 'criteria_id');	
		// echo $this->db->last_query();exit;   
		$result= $this->datatables->generate();
		echo $result;
	}

	function add_criteria()
	{
		$this->content->roles = $this->common->get_form_dropdown($tablename = 'roles', $fields = array('role_id','role_name'),$conditions = array('is_deleted' => 0));
		// x_debug($this->content->roles);
		$criteria_id = $this->uri->segment(3);
		$this->content->criteria_details = $this->performance_criteria->get_criteria_details($criteria_id);
		if(!empty($this->input->post()))
		{
			$post = $this->input->post();
			$criteria = array();
			if(!empty($post['criteria_id']))
			{
				$criteria['criteria_id'] = $post['criteria_id'];
				$criteria['criteria_name'] = $post['criteria_name'];
				$criteria['percent_value'] = $post['percent_value'];
				$criteria['role_id'] = $post['role_id'];
				$criteria = set_log_fields($criteria);
				$this->common->update('performance_criteria', $criteria, array('criteria_id'=>$criteria['criteria_id']));
			}
			else
			{
				$criteria['criteria_name'] = $post['criteria_name'];
				$criteria['percent_value'] = $post['percent_value'];
				$criteria['role_id'] = $post['role_id'];
				$criteria = set_log_fields($criteria, 'insert');
				$this->common->insert('performance_criteria', $criteria);
			}
			
			// $this->performance_criteria->save_criteria($criteria);
			$this->session->set_flashdata('success', 'Criteria List Updated Successfully!');
			redirect('performance_and_incentives/rate_criteria');
		}
		$this->load_view("add_edit_criteria","HRMS - Add Edit criteria",$this->content);
	}

	function add_edit()
	{
		$this->content->roles = $this->common->get_form_dropdown($tablename = 'roles', $fields = array('role_id','role_name'),$conditions = array('is_deleted' => 0));
		// x_debug($this->content->roles);
		$criteria_id = $this->uri->segment(3);
		$this->content->criteria_details = $this->performance_criteria->get_criteria_details($criteria_id);
		if(!empty($this->input->post()))
		{
			$post = $this->input->post();
			$criteria = new Performance_Entity();
			if(!empty($post['criteria_id']))
            $criteria->criteria_id = $post['criteria_id'];
			$criteria->criteria_name = $post['criteria_name'];
			$criteria->percent_value = $post['percent_value'];			
			$criteria->role_id = $post['role_id'];
			$this->performance_criteria->save_criteria($criteria);
			$this->session->set_flashdata('success', 'Criteria List Updated Successfully!');
			redirect('performance_criteria');
		}
		$this->load_view("add_edit_criteria","HRMS - Add Edit Criteria",$this->content);
	}

	function delete($criteria_id = '')
	{
		// $id  = $this->performance_criteria->delete_criteria($criteria_id);
		$res = $this->common->update('performance_criteria', array('is_deleted'=>1), array('criteria_id'=>$criteria_id));
		echo json_encode($res);
		/*$this->session->set_flashdata('success', 'criteria list updated succssfully!');
		redirect('performance_criteria');*/
	}

	function candidate_assessment_list()
	{
	//user_access_page($this->router->fetch_class(),$this->router->fetch_method());   	
      $this->load_view("candidate_assessment_list","HRMS - Employee Assessment List",$this->content);        
	}

	function assessment_list()
	{
		$this->datatables->unset_column('can_id');
		$this->datatables->select('can_id, can_name,role_name');
		$this->datatables->join('roles', 'candidate.role_id = roles.role_id', 'left');
		$this->datatables->from('candidate');
		$this->datatables->where('candidate.is_deleted',0);
		// $this->db->order_by("can_id", "desc");
		$this->datatables->add_column('edit', '<a href="add_edit_can_assessment/$1" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_can($1)" class="tabledit-delete-button btn btn-sm swal-btn-cancel btn-danger" ><span class="glyphicon glyphicon-trash"></span></a>', 'can_id');
		//this->datatables->add_column('edit', '<a href="'.site_url().'/performance_criteria/add_edit/$1" class="tabledit-edit-button btn btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><a href="'.site_url().'/performance_criteria/delete/$1" class="tabledit-delete-button btn btn-sm btn_delete" ><span class="glyphicon glyphicon-trash"></span></a>', 'can_id');	
		$result= $this->datatables->generate();
		echo $result;
	}

	function add_edit_can_assessment()
	{
		$can_id = $this->uri->segment(3);
		$this->content->can_details = $this->common->get_candidate_name_role($can_id);
		// echo $this->content->can_details->role_id;exit;
		$this->content->criteria= $this->performance_criteria->get_criteria_by_role($this->content->can_details->role_id);

		$this->content->can_assess_details = $this->performance_criteria->get_candidate_assessment_details($can_id,$this->content->can_details->role_id);
		// $this->content->spl_assess = $this->performance_criteria->get_candidate_assessment_details($can_id, $this->content->can_details->role_id);
		// x_debug($this->content->can_assess_details);

		// $this->content->criteria_all= $this->performance_criteria->get_criteria_by_role($role = 0);
		// $this->content->criteria_specific= $this->performance_criteria->get_criteria_by_role($this->content->can_details->role_id);
		if(!empty($this->input->post()))
		{
			$post = $this->input->post();
			// debug($post);
			// if(!empty($this->content->can_assess_details))
			// 	$per_cri_id = $this->content->can_assess_details->per_cri_id;
			
			$can_assess_data = array();
			if(empty($this->content->can_assess_details)){
				foreach($post['common_criterias'] as $key=>$value) {
	    			$pushArr1 = array('can_id' => $can_id,
											'per_cri_id' => $key,
											'assess_value' => $post['common_criterias'][$key]
											 );
					array_push($can_assess_data,$pushArr1);
				}
			}
			else
			{
				foreach($post['common_criterias'] as $key=>$value) {
    			$pushArr1 = array('can_id' => $can_id,
										'id' => $post['id'][$value],
										'per_cri_id' => $key,
										'assess_value' => $post['common_criterias'][$key]
										 );
				array_push($can_assess_data,$pushArr1);
				}
			}

			// x_debug($can_assess_data);
			// foreach($post['can_spl_criteria'] as $key=>$value) {
			//	$pushArr1 = array('can_id' => $can_id,
			// 									 'per_cri_id' => $key,
			// 									 'assess_value' => $post['can_spl_criteria'][$key]
			// 							 );
			// 	array_push($can_assess_data,$pushArr1);
			// }
			if($this->performance_criteria->save_can_performance_criteria($can_assess_data))
			{
				$this->session->set_flashdata('success', 'Candidate assessment updated succssfully!');
				redirect('performance_criteria/candidate_assessment_list');
			}
		}
      $this->load_view("edit_can_assess","HRMS - Employee Assessment List",$this->content);        

	}

	private function load_view($viewname= "blank_page",$page_title)
	{
		$this->content->meta_description="Meta meta_description here!";
		$this->content->meta_keywords="meta keywords here!";
		$this->masterpage->setMasterPage('master');
		$this->content->page_description = "";
		$this->masterpage->setPageTitle($page_title);
		$this->masterpage->addContentPage('performance/'.$viewname,'content',$this->content);
		$this->masterpage->show();
	}
}