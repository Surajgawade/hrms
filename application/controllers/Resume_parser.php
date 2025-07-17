<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/* @property voting_model $voting */

class Resume_parser extends My_Controller
{

    function __construct()
    {
        parent::__construct();
        // $this->load->language('voting');
        $this->load->model('voting_model', 'voting');

        $this->load->model('common_model');
        $this->load->library('form_validation');
        $this->load->library('get_dependency_data');
        
        $this->load->library('docx');
        
        $this->load->library('PdfParser');
        
        $this->form_validation->set_error_delimiters("<span class='notification-input ni-error'>", "</span>");
      
    }
    function reArrayFiles(&$file_post)
    {
        $file_ary = [];
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }
    public function index()
    {
        if(isset($_REQUEST["upload"]))
        {
            if (isset($_FILES['file'])) 
            {
                $data=$this->get_dependency_data->get_resume_data($_FILES);   
                print_r($data);
            }
        }
        $this->load->view('resume_parser');
    }
}