<?php
/**
* Entity class for Travel properties
**/

class Travel_Entity
{
	function __construct()
	{

	}

	public $tv_id = 0;
	public $can_id;
	public $purpose;
	public $location;
	public $days;
	public $stays;
	public $meals;
	public $snacks;
	public $transport_mode;
	public $budget;
	public $advance;
	public $status;
	public $details;
	public $remark;
	public $raised_date;
	public $from_date;
	public $to_date;
	public $approved_date;
	public $claimed_date;
	public $cleared_date;
	public $is_deleted=0;
}