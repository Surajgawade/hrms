<?php
/**
* Entity class for News properties
**/

class News_Entity
{
	function __construct()
	{

	}

	public $nw_id =0;
	public $nw_title;
	public $nw_description;
	public $nw_image;
	public $image_name;
	public $publish_date;
	public $created_by;
	public $created_on;
	public $last_modified_by;
	public $last_modified_on;
}
?>