<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_Setting extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->model('dashboard_model');
		$this->load->model('common_model');
		$userdata = $this->session->userdata('logged_in_user');
		if(!$userdata)
		{
			$newURL = site_url()."/login";
			header('Location: '.$newURL);
		}
	}

	public function index()
	{
		$this->configuration_settings();
	}

	public function configuration_settings()
	{
		if(!empty($_POST))
	    {
        	$post = $this->input->post();
        	$config_settings = $post;
        	$post['year_start_date'] = date_to_db($post['year_start_date']);
        	$post['year_end_date'] = date_to_db($post['year_end_date']);
        	$post['company_outer_logo'] = $this->input->post('company_outer_logo',true);
        	$post['company_inner_logo'] = $this->input->post('company_inner_logo',true);
        	$upload_path = UPLOADPATH.'logo';
			if( ! is_dir($upload_path))
			{
				mkdir($upload_path, 0755, true);
			}
			$this->load->library('upload');
			if(!empty($_FILES['company_outer_logo']))
			{
				$company_outer_logo = time().$_FILES['company_outer_logo']['name'];
				$config['upload_path'] = $upload_path;
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = '2048';
				$config['file_name'] = $company_outer_logo;
				$config['file_ext_tolower'] = TRUE;
				$this->upload->initialize($config);

				if ($this->upload->do_upload('company_outer_logo'))
				{
					$this->upload->data('company_outer_logo');
					$post['company_outer_logo'] = $company_outer_logo;			
				}
				else
				{
					echo "failed to upload";
				}
			}
			else
			{
				$post['company_outer_logo'] = $this->input->post('pre_outer_logo',true);
			}
			if(!empty($_FILES['company_inner_logo']))
			{
				$company_inner_logo = time().$_FILES['company_inner_logo']['name'];
				$config['upload_path'] = $upload_path;
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = '2048';
				$config['file_name'] = $company_inner_logo;
				$config['file_ext_tolower'] = TRUE;
				$this->upload->initialize($config);
				if ($this->upload->do_upload('company_inner_logo'))
				{
					$this->upload->data('company_inner_logo');
					$post['company_inner_logo'] = $company_inner_logo;			
				}
				else
				{
					echo "failed to upload";
				}
			}
			else
			{
				$post['company_outer_logo'] = $this->input->post('pre_inner_logo',true);

			}
        	$id = $this->common_model->update('configuration_settings',$post,array('conf_id'=>1));
        	$this->session->set_flashdata('success', 'Configurations Updated Successfully!');
            redirect('config_setting/configuration_settings/');
	    }
    	$this->content->configuration_settings = $this->common_model->get_data('configuration_settings',array('conf_id' =>1));
		$this->load_view("configuration_settings","HRMS - Configuration Setting",$this->content);
	}

	private function load_view($viewname= "blank_page",$page_title)
	{
		$this->content->meta_description="Meta meta_description here!";
		$this->content->meta_keywords="meta keywords here!";
		$this->masterpage->setMasterPage('master');
		$this->content->page_description = "";
		$this->masterpage->setPageTitle($page_title);
		$this->masterpage->addContentPage(''.$viewname,'content',$this->content);
		$this->masterpage->show();
	}
}