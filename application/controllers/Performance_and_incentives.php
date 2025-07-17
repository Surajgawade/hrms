<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Performance_and_incentives extends My_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('performance_model','performance_criteria');
		$this->load->model('performance_model');		
		$this->load->model('common_model','common');		
		$userdata = $this->session->userdata('logged_in_user');
		if(!$userdata){
			$newURL = site_url()."/login";
			header('Location: '.$newURL);        		
		}        
	}

	public function rate_criteria($msg="")
	{
		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());   
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
		$view_url=site_url().'/performance_and_incentives/view_criteria/$1';
		$this->datatables->add_column('edit', '<a href="'.site_url().'/performance_and_incentives/add_criteria/$1" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a><a onClick="delete_data($1)" class="tabledit-delete-button btn btn-sm btn_edit btn-danger" ><span class="glyphicon glyphicon-trash"></span></a><a href="'.$view_url.'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>', 'criteria_id');	
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
		$this->load_view("add_edit_criteria","HRMS - Add Edit Criteria",$this->content);
	}

	/*function list_criterias()
	{
		$this->datatables->unset_column('criteria_id');
		$this->datatables->unset_column('performance_criteria.role_id');
		$this->datatables->select('criteria_id, performance_criteria.role_id ,role_name, criteria_name, percent_value, IF(performance_criteria.role_id = "0", "All" ,role_name) as role_name');
		$this->datatables->join('roles', 'performance_criteria.role_id = roles.role_id', 'left');		
		$this->datatables->from('performance_criteria');
		$this->datatables->where('performance_criteria.is_deleted',0);
      // $this->db->order_by("criteria_id", "desc");        
		$this->datatables->add_column('edit', '<a href="'.site_url().'/performance_criteria/add_edit/$1" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a><a href="'.site_url().'/performance_criteria/delete/$1" class="tabledit-delete-button btn btn-sm btn_delete btn-danger" ><span class="glyphicon glyphicon-trash"></span></a>', 'criteria_id');	
		// echo $this->db->last_query();exit;   
		$result= $this->datatables->generate();
		echo $result;
	}*/

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

	function delete_criteria()
	{
		$access = user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		if(!empty($access))
        {
            echo "0";
        }
        else
        {
			$criteria_id = $this->input->post('criteria_id', true);
			$res = $this->common->update('performance_criteria', array('is_deleted'=>1), array('criteria_id'=>$criteria_id));
			echo json_encode($res);
		}
	}

	function candidate_assessment_list()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());   	
      	$this->load_view("candidate_assessment_list","HRMS - Employee Assessment List",$this->content);        
	}

	function assessment_list()
	{
		$superadmin = $this->config->item('super_user_role_id');
        $superadmin = implode(',', $superadmin);
		$this->datatables->unset_column('assesment_list.list_id');
		$this->datatables->select('assesment_list.list_id,candidate.can_name,assesment_list.date');
		$this->datatables->from('assesment_list');
		$this->datatables->join('candidate', 'candidate.can_id = assesment_list.can_id', 'LEFT');
		$this->datatables->where('assesment_list.is_deleted',0);
		$this->datatables->where('candidate.role_id NOT IN ('.$superadmin.')');
		$this->db->order_by("assesment_list.list_id", "desc");
		$view_url=site_url().'/performance_and_incentives/view/$1';
		$this->datatables->add_column('edit', '<a href="add_edit_can_assessment/$1" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_asses($1)" class="tabledit-delete-button btn btn-sm swal-btn-cancel btn-danger" ><span class="glyphicon glyphicon-trash"></span></a>
			 <a href="'.$view_url.'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>', 'list_id');
		//this->datatables->add_column('edit', '<a href="'.site_url().'/performance_criteria/add_edit/$1" class="tabledit-edit-button btn btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><a href="'.site_url().'/performance_criteria/delete/$1" class="tabledit-delete-button btn btn-sm btn_delete" ><span class="glyphicon glyphicon-trash"></span></a>', 'can_id');	
		$result= $this->datatables->generate();
		echo $result;
	}

	function add_edit_can_assessment($al_id='')
	{
		$superadmin = $this->config->item('super_user_role_id');
        $superadmin = implode(',', $superadmin);
		if($al_id != NULL)
		{
			$performance = $this->performance_model->get_list_details($al_id);
			$performance['can_list']['role_name'] = $this->performance_model->get_role_name($performance['can_list']['can_id']);
			$performance['can_list']['can_name'] = $this->performance_model->get_can_name($performance['can_list']['can_id']);
			foreach ($performance['assesment'] as $key => $value) {
				$performance['assesment'][$key]['criteria_name'] = $this->performance_model->get_criteria_name($value['criteria_id']);
			}
			$this->content->performance_details = $performance;
		}
		// $this->content->candidates = $this->common->get_form_dropdown($tablename = 'candidate', $fields = array('can_id','can_name'),$conditions = array('is_deleted' => 0));
		$this->content->candidates = $this->db->query('SELECT * FROM `candidate` WHERE `is_deleted`=0 AND role_id NOT IN ('.$superadmin.')')->result();
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

	function get_can_role_details()
	{
		$this->load->model('performance_model');
		$can_id = $this->input->post('can_id',true);
		echo json_encode($this->performance_model->get_can_role_details($can_id));
	}

	function save_assesment()
	{
		$this->load->model('performance_model');
		$post = $this->input->post();
		$post['date'] = date_to_db($post['date']);
        $assesment_details = new Performance_Entity();
        $assesment_details->can_id = $post['can_id'];
        if(!empty($post['list_id']))
        {
            $assesment_details->list_id = $post['list_id'];
        }
        else
        {
        	$assesment_details->list_id = 0;
        }
        $assesment_details->role_id = $post['role_id'];
        $assesment_details->date = $post['date'];
        $nul_val = 0;
        foreach ($post as $keyv => $valuev) {
        	if($valuev == NULL)
        	{
        		if($keyv != 'list_id')
        		{
        			$nul_val++;
        		}
        	}
    	}
    	if($nul_val == 0)
    	{
    		$assesment_details=set_log_fields($assesment_details,'insert');
	        $result = $this->performance_model->add_assesment_list($assesment_details);
	        if(($result < 0) && ($result != NULL) && ($result != FALSE))
	        {
	        	echo json_encode(array("result"=>FALSE,"msg"=>"Something went wrong!"));
	        }
	        else
	        {
	        	$can_asses = array();
	        	$cnt = count($can_asses);
	        	$i = 1;
	        	foreach ($post as $key => $value) {
	        		if(strpos($key, '-') !== false)
		    		{
		    			$str = explode('-', $key);
		    			$can_asses[$str[1]][$str[0]] = $value;
		    			$can_asses[$str[1]]['can_id'] = $post['can_id'];
		    			$can_asses[$str[1]]['assesment_list_id'] = $result;
		    			$can_asses[$str[1]]['criteria_id'] = $str[1];
		    			$can_asses[$str[1]]['is_deleted'] = 0;
		    		}
		    	}
	        	foreach ($can_asses as $key1 => $value1) {
	        		if(array_key_exists('id', $value1))
	        		{

	        		}
	        		else
	        		{
	        			$value1['id'] = 0;
	        		}
    				$value1=set_log_fields($value1,'insert');
	        		$res = $this->performance_model->add_can_assesment($value1);
	        		if($res == TRUE)
	        		{
	        			$i++;
	        		}
	        	}
	        	if($cnt == $i)
	        	{
	        		echo json_encode(array("result"=>FALSE,"msg"=>"Something went wrong!"));
	        	}
	        	else
	        	{
	        		echo json_encode(array("result"=>TRUE,"msg"=>"Assesment Saved Successfully!"));
	        	}
	        }
	    }
	    else
	    {
	    	echo json_encode(array("result"=>FALSE,"msg"=>"All fields are mandatory!"));
	    }
	}

	function convert_date($date = NULL)
	{
		$n_date = date('Y-m-d', strtotime(str_replace('/', '-', $date)));
		return $n_date;
	}

	function delete_asses()
	{
		$access = user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		if(!empty($access))
        {
            echo "0";
        }
        else
        {
			$list_id = $this->input->post('list_id');
	        $id = $this->performance_model->delete($tablename = 'assesment_list',$fieldname ='list_id',$list_id);
	        echo "1";
	    }
	}

	//function to view indiviual candidate details
    public function view()
    {
    	$al_id = $this->uri->segment(3);
		if($al_id != NULL)
		{
			$performance = $this->performance_model->get_list_details($al_id);
			$performance['can_list']['role_name'] = $this->performance_model->get_role_name($performance['can_list']['role_id']);
			$performance['can_list']['can_name'] = $this->performance_model->get_can_name($performance['can_list']['can_id']);
			foreach ($performance['assesment'] as $key => $value) {
				$performance['assesment'][$key]['criteria_name'] = $this->performance_model->get_criteria_name($value['criteria_id']);
			}
			$this->content->performance_details = $performance;
			//x_debug($this->content->performance_details);
		}
	    $this->load_view("assesment_details","HRMS - View Candidate Assessment",$this->content); 
    }

	public function view_criteria()
    {
        user_access_operation($this->router->fetch_class(),$this->router->fetch_method());  
        $userdata = $this->session->userdata('logged_in_user');
        $criteria_id =$this->uri->segment(3); 
        $this->content->criteria_details=$this->performance_model->get_list_criterias($criteria_id);
        $this->load_view("view_criteria","HRMS - View Leave",$this->content);
    }	

}
