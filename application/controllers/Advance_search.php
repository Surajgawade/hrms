<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Advance_search extends My_Controller
{

	public function __construct() {
		Parent::__construct();
	}

	public function index($msg="")
	{
		$this->load_view("advance_search","HRMS - Advance search",$this->content);        
	}


	private function load_view($viewname= "blank_page",$page_title)
	{
		$this->content->meta_description="Meta meta_description here!";
		$this->content->meta_keywords="meta keywords here!";
		$this->masterpage->setMasterPage('master');
		$this->content->page_description = "";
		$this->masterpage->setPageTitle($page_title);
		$this->masterpage->addContentPage('controls/'.$viewname,'content',$this->content);
		$this->masterpage->show();
	}

}
?>