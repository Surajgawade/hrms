<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Access_denied extends My_Controller {

	public function index($msg="")
	{
        $this->load_view("access_denied","",$this->content);        
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