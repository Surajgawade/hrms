<?php
/**
* Entity class for Leave properties
**/

class Leave_Entity
{
	function __construct()
	{

	}
	public $appl_id=0;
	public $emp_name;
	public $can_id;
	public $from_date;
	public $to_date;
	public $reason;
	public $mobile_no;
	public $phone_no;
	public $leave_address;
	public $leave_type;
	public $applied_date;
	public $status=0;
}

class Leavetype_Entity
{
	function __construct()
	{

	}

	public $type_id =0;
	public $leave_title;
	public $acronym;	
	public $is_deleted=0;
}
?>