<?php
error_reporting(0);
date_default_timezone_set("Asia/Kolkata");
class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->CI = & get_instance();
		$this->content = new stdClass();
		$this->content->access_directory = strtolower($this->router->fetch_directory());
		$this->content->access_class = strtolower($this->router->fetch_class());
		$this->content->access_method = strtolower($this->router->fetch_method());
		$this->load->model('common_model');
		$this->content->config_settings = $this->common_model->get_data('configuration_settings',array(),'*');
		$this->content->my_theme = $this->input->cookie('theme');
	}


}