<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Query_runner extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('candidate_model');
        $this->load->model('task_model');
        $this->load->model('common_model','common');
        $this->load->library('table');
        $userdata = $this->session->userdata('logged_in_user');
        if(!$userdata){
            $newURL = site_url()."/login";
            header('Location: '.$newURL);        		
        }        
    }
	public function index($msg="")
	{
        $this->load_view("query_runner","HRMS - Query Runner",$this->content);
	}
    public function run()
    {
        $qry=$this->input->post('query');
        $data=$this->db->query($qry);
        //print_r($data);
        $template = array(
        'table_open' => '<table border="1" cellpadding="2" cellspacing="0" class="table-striped">'
        );

        $this->table->set_template($template);

        echo $this->table->generate($data);

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
}
