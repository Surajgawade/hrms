<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organisation_tree extends MY_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('dashboard_model');
        $this->load->model('common_model','common');
        // $logged_in = $this->session->userdata['logged_in'];
        $userdata = $this->session->userdata('logged_in_user');
        if(!$userdata){
            $newURL = site_url()."/login";
            header('Location: '.$newURL);
        }
    }

	public function index($msg="")
	{
		$this->load_view("organisation_tree","HRMS - Organisation Chart",$this->content);
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

	public function get_tree_data()
	{
		$superadmin = $this->config->item('super_user_role_id');
        $superadmin = implode(',', $superadmin);
        $emp = $this->db->query('SELECT * FROM `candidate` WHERE `is_deleted`=0 AND role_id NOT IN ('.$superadmin.')')->result_array();
		$data = array();
		foreach ($emp as $key => $value) {
			$data[$key]['id'] = $value['can_id'];
			$data[$key]['parentId'] = $value['reporting_to'];
			$data[$key]['Name'] = $value['can_name'];
			$data[$key]['Department'] = $value['department'];
			$data[$key]['Email'] = $value['email'];
			if(($value['profile_picture'] != NULL) && !empty($value['profile_picture']))
			{
				$img = base_url().PROFILE_PATH.$value['profile_picture'];
			}
			else
			{
				$img = base_url().PROFILE_PATH.'no_profile_image.png';
			}
			$data[$key]['Image'] = $img;
			$job_profile = $this->common->get_data('job_profiles',array('id'=>$value['job_profile'], 'is_deleted'=>0), 'title');
			if(empty($job_profile))
			{
				$data[$key]['Designation'] = ' ';
			}
			else
			{
				$data[$key]['Designation'] = $job_profile['title'];
			}
		}
		echo json_encode($data);
	}

}