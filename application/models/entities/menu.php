<?php
/**
* Entity class for Settings properties
**/

class Menu_Entity
{
	function __construct()
	{

	}

	public $menu_id =0;
	public $menu_name;
	public $menu_description;
	public $parent_id = 0;
	public $sort_order = 0;
	public $is_deleted = 0;	
}

class Role_Entity
{
	function __construct()
	{

	}

	public $role_id =0;
	public $role_name;
	public $role_description;
	public $is_deleted = 0;	
}

class Permission_Entity
{
	function __construct()
	{

	}

	public $permission_id =0;
	public $permission_name;
	public $is_deleted = 0;	
}

class Role_Permission_Entity
{
	function __construct()
	{

	}

	public $id =0;
	public $role_id;
	public $permission_id;
	public $is_deleted = 0;	
}



