<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Holidays extends My_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('holiday_model','holiday');		
		$userdata = $this->session->userdata('logged_in_user');
		if(!$userdata){
			$newURL = site_url()."/login";
			header('Location: '.$newURL);        		
		}        
	}

	public function index($msg="")
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
      $this->load_view("holiday_list","HRMS - Holiday List",$this->content);        
	}

	function list_holidays()
	{
		$year = date('Y');
		$this->datatables->unset_column('holiday_id');
		$this->datatables->select('holiday_id, holiday_title, holiday_date, holiday_day');
		$this->datatables->from('holiday');
		$this->datatables->where('is_deleted',0);
		//$this->datatables->where('holiday_year',$year);
		// $this->datatables->order_by("holiday_date", "asc");
		$update_url = site_url().'/holidays/add_edit/$1';
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn-success btn_edit"><span class="glyphicon glyphicon-pencil"></span></a> <a onClick="delete_holiday($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_delete" ><span class="glyphicon glyphicon-trash"></span></a>', 'holiday_id');		      
		$result= $this->datatables->generate();  
		// $lst_qry = $this->db->last_query();
		// file_put_contents('/tmp/test1.txt', $lst_qry. "\n\n", FILE_APPEND); 
		echo $result;
	}

	function add_edit()
	{
		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
    	$holiday_id = $this->uri->segment(3);
		$this->content->holiday_details = $this->holiday->get_holiday_details($holiday_id);
		if(!empty($this->input->post()))
		{
			$post = $this->input->post();
			$holiday = new Holiday_Entity();
			if(!empty($post['holiday_id']))
            $holiday->holiday_id = $post['holiday_id'];
			$holiday->holiday_title = $post['holiday_title'];
			$holiday->description = $post['description'];			
			// $holiday->holiday_year = date('Y');
			$holiday->holiday_date = date('Y-m-d', strtotime(str_replace('/', '-', $post['holiday_date'])));
			$holiday->holiday_month = date("m", strtotime($holiday->holiday_date));
			$holiday->holiday_year = date("Y", strtotime($holiday->holiday_date));
			$holiday->holiday_day = date("l", strtotime($holiday->holiday_date));
    		$holiday=set_log_fields($holiday,'insert');
			$this->holiday->save_holiday($holiday);
			$this->session->set_flashdata('success', 'Holiday Updated Successfully!');
			redirect('holidays');
		}
		$this->load_view("add_edit_holiday","HRMS - Add Edit Holiday",$this->content);
	}

	function delete_holiday()
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
				$holiday_id = $this->input->post('holiday_id');
				$id  = $this->holiday->delete_holiday($holiday_id);
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
		$this->masterpage->addContentPage('holiday/'.$viewname,'content',$this->content);
		$this->masterpage->show();
	}
}
