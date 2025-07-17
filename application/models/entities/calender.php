<?php
/**
* Entity class for Calender properties
**/

class Calender_Entity
{
	function __construct()
	{

	}

	public $ev_id = 0;
	public $can_id;
	public $title;
	public $details;
	public $start;
	public $end;
	public $event_type;
	public $is_deleted = 0;
}