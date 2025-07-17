<?php
/**
* Entity class for Candidate properties
**/

class Candidate_Entity
{
	function __construct()
	{

	}

	public $can_id =0;
	public $can_name;
	public $cur_address;
	public $per_address;
	public $email;
	public $phone1;	
	public $phone2;
	public $education;
	public $current_ctc;
	public $expected_ctc;
	public $emer_contact_name;
	public $emer_contact_no;
	public $ready_to_relocate;
	public $can_type;
	public $pan_no;
	public $aadhar_no;
	public $blood_group;
	public $is_active;
	public $is_deleted;
	public $dob;
	public $job_profile;
	public $joining_date;	
	public $reporting_to;	
}

class Bank_Entity
{
	function __construct()
	{

	}

	public $bd_id =0;
	public $can_id;
	public $bank_name;
	public $branch;
	public $account_number;
	public $ifsc;
}

class Billing_Entity
{
	function __construct()
	{

	}

	public $bill_id =0;
	public $can_id;
	public $amount;
	public $rate_type;
	public $effective_from;
	public $effective_to;
	public $review_date;
}


class Experience_Entity
{
	function __construct()
	{

	}

	public $exp_id =0;
	public $can_id;
	public $company_name;
	public $working_from;
	public $working_to;
	public $designation;
	public $responsibilities;
	public $leaving_reason;
}

class Investment_Entity
{
	function __construct()
	{

	}

	public $inv_id =0;
	public $can_id;
	public $description;
	public $amount;
	public $section;
}

class Reference_Entity
{
	function __construct()
	{

	}

	public $ref_id =0;
	public $can_id;
	public $ref_type;
	public $ref_name;
	public $ref_email;
	public $ref_contact;
	public $ref_designation;
	public $ref_company;
	public $ref_experience;
	public $ref_mobile;
}

