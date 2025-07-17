<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Expire_trial_pack extends My_Controller {

	public function index($msg="")
	{
        /*$users = $this->db->update('users',array('is_active'=>0));
        $candidates = $this->db->update('candidate',array('is_active'=>0, 'is_deleted'=>1));*/
        // $this->load->view("expire_trial_pack","",$this->content);
        $this->load->view("expire_trial_pack","",$this->content);
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