<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends My_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('candidate_model');
		$this->load->model('common_model','common');
		// $logged_in = $this->session->userdata['logged_in'];
		$userdata = $this->session->userdata('logged_in_user');
		if(!$userdata){
			$newURL = site_url()."/login";
			header('Location: '.$newURL);        		
		}        
	}


	public function index()
	{		  
		$userdata = $this->session->userdata('logged_in_user');
		$this->content->qualifications  = $this->common->get_form_dropdown($tablename='qualifications', $fields = array('id','title'), $conditions = array('is_deleted' => 0));
      $this->content->job_profiles  = $this->common->get_form_dropdown($tablename='job_profiles', $fields = array('id','title'),$conditions = array('is_deleted' => 0));
		$this->content->user_details = $this->common->get_user_details_by_id($userdata['id']);
		// echo $this->db->last_query();exit;
		// x_debug($this->content->user_details);
		if(!empty($this->input->post()))
		{
			$post = $this->input->post();
			$user_details = new Candidate_Entity();
			
			$user_details->can_id = $userdata['id'];
         $user_details->can_name = $post['can_name'];
         $user_details->cur_address = $post['cur_address'];
         $user_details->per_address = $post['per_address'];
         $user_details->email = $post['email'];
         $user_details->dob = date('Y-m-d', strtotime(str_replace('/', '-', $post['dob'])));
         $user_details->phone1 = $post['phone1'];
         $user_details->phone2 = $post['phone2'];
         $user_details->education = $post['qualification'];
         $user_details->job_profile = $post['job_profile'];
         $user_details->current_ctc = $post['current_ctc'];
         $user_details->expected_ctc = $post['expected_ctc'];
         $user_details->emer_contact_name = $post['emer_contact_name'];
         $user_details->emer_contact_no = $post['emer_contact_no'];
         $user_details->aadhar_no = $post['aadhar_no'];
         $user_details->pan_no = $post['pan_no'];
         $user_details->blood_group = $post['blood_group'];
         $user_details->ready_to_relocate = $post['ready_to_relocate'];
         $user_details->is_active = 1;
         $this->candidate_model->save_candidate_details($user_details);
         $this->session->set_flashdata('success', 'Profile Updated Successfully!');
         redirect('profile');
		}
		$this->load_view('my_profile',"Candidate Profile",$this->content);
	}

	function settings()
	{
		//user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
		$this->load_view('my_profile_settings',"Profile Settings",$this->content);
	}

	public function check_password()
	{
		if($this->input->is_ajax_request())
		{
			$curr_pass = $this->input->post('current_pass',true);
			$email = $_POST['email_id'];
			// $user_details = $this->common->get_data('candidate',array('email'=>$email_id));
			$this->load->model('login_model');

			$user = $this->login_model->check_password($email,$curr_pass);
         if($user)
         {
         	$email = $user->email;
            $hash = $user->password;
				if (password_verify($curr_pass, $hash))
	         {
				 	echo "1";
				}
				else
				{
					echo "0";
				}
         }
		
		}
	}

	function change_password()
	{
		//user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
		$user_data = $this->session->userdata('logged_in_user');	
		// x_debug($user_data);	
		if($this->input->post())
		{
			$post = $this->input->post();
			$confirm_pass = $post['confirm_pass'];			
			$encoded_password = password_hash($confirm_pass, PASSWORD_DEFAULT);
			$data_array = array('email' => $user_data['email'] ,'password' =>$encoded_password);
			if($this->candidate_model->update_password($data_array))
			{
            user_activity_log($data = array('can_id' => get_login_user_id(), 'table_name' => 'candidate' ,"operation_name" => 'update' ,'last_modified_on'=> date('Y-m-d h:i:s'),'last_modified_by' => get_login_user_id(),'comment' => 'Password Uploaded'));
            	$this->common_model->update('candidate', array('login_status'=>1), array('can_id'=>$user_data['id']));
				echo json_encode(TRUE);
			}
			else
			{
				echo json_encode(FALSE);
			}
		}
	}

	function my_salaryslips()
	{
		//user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
		$userdata = $this->session->userdata('logged_in_user');
     	// $this->content->my_salary_slips = $this->candidate_model->get_my_salary_slips($userdata['id']);
     	$this->load_view("my_salaryslips","HRMS - Employee Salary Slips",$this->content);
	}

	private function load_view($viewname= "blank_page",$page_title)
	{
		$this->content->meta_description="Meta meta_description here!";
		$this->content->meta_keywords="meta keywords here!";
		$this->masterpage->setMasterPage('master');
		$this->content->page_description = "";
		$this->masterpage->setPageTitle($page_title);
		$this->masterpage->addContentPage('candidate/'.$viewname,'content',$this->content);
		$this->masterpage->show();
	}
}
