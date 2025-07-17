<?php
/**
* Entity class for Task properties
**/

class Task_Entity
{
	function __construct()
	{

	}

	public $task_id =0;
	public $task_name;
	public $task_description;
	public $tat;
	public $priority;
	public $task_created_by;
	public $created_on;
	public $remarks;	
	public $is_deleted=0;
}
?>