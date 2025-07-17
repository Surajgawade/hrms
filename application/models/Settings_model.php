<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once( APPPATH . 'models/entities/menu' . EXT );
class Settings_model extends CI_Model {

	/*function to get meues list */
	function __construct()
	{
		parent::__construct();
		get_active_db();
		$this->load->model('common_model');
	}
	function get_all_menues()
	{
		// $this->db->select('m1.menu_id AS m1menu_id, m1.menu_name AS m1menu_name, m2.menu_id AS m2menu_id,m2.menu_name AS m2menu_name'); 
		// $this->db->join('menues AS m1','m1.parent_id = m2.menu_id','left');

		$this->db->where('is_deleted',0);	
		// $this->db->join('menues', 'menues.id = menues.parent_id');
		return $this->db->get('menues')->result();	
	}

	function get_menu_dropdown()
	{
		$this->db->where(array('parent_id' => 0 ,'is_deleted'=> 0 ));
		return $this->db->get('menues')->result();
	}

	function add_menu_details($menu_details,$menu_id = null)
	{
		if(!empty($menu_id))
		{
			$this->db->where('menu_id', $menu_id);
			$this->db->update('menues',$menu_details);
			return $menu_id;
		}
		else
		{
			$this->db->insert('menues',$menu_details);
			return $this->db->insert_id();
		}
	}

	function edit_menu_details($menu_id)
	{
		return $this->db->get_where('menues',array('menu_id' => $menu_id))->row();
	}

	function delete_menu($menu_id)
	{
		$count = $this->db->get_where('menues', array('parent_id' => $menu_id))->num_rows();
		if($count>0)
		{
			return $count;
		}
		else
		{
			$this->db->set('is_deleted',1);
	      $this->db->where('menu_id',$menu_id);
	      $this->db->update('menues');
		}
	}


	function get_all_roles()
	{
		$this->db->where('is_deleted',0);	
		return $this->db->get('roles')->result();	
	}

	function add_role_details($role_details)
	{
		// x_debug($menu_details);
		$role = (array) $role_details; 
		if($role_details->role_id > 0)
		{
			$this->db->where('role_id', $role_details->role_id);
			$this->db->update('roles',$role);
			return $role_details->role_id;
		}
		else
		{
			$this->db->insert('roles',$role);
			return $this->db->insert_id();
		}
	}

	function edit_role_details($role_id)
	{
		return $this->db->get_where('roles',array('role_id' => $role_id))->result();
	}

	function delete_role($role_id)
	{
		$this->db->set('is_deleted',1);
      $this->db->where('role_id',$role_id);
      $this->db->update('roles');
	}

	function get_all_permissions()
	{
		$this->db->where('is_deleted',0);	
		return $this->db->get('permissions')->result();	
	}

	function add_permission_details($permission_details)
	{
		// x_debug($menu_details);
		$permission = (array) $permission_details; 
		if($permission_details->permission_id > 0)
		{
			$this->db->where('permission_id', $permission_details->permission_id);
			$this->db->update('permissions',$permission);
			return $permission_details->permission_id;
		}
		else
		{
			$this->db->insert('permissions',$permission);
			return $this->db->insert_id();
		}
	}

	function edit_permission_details($permission_id)
	{
		return $this->db->get_where('permissions',array('permission_id' => $permission_id))->result();
	}

	function delete_permission($permission_id)
	{
		$this->db->set('is_deleted',1);
      $this->db->where('permission_id',$permission_id);
      $this->db->update('permissions');
	}

	function assign_permissions($insert_arr)
	{
		$this->db->insert('role_permissions',$insert_arr);
      return $this->db->insert_id();
	}
	function get_all_menu_permissions()
	{
		$this->db->where('is_deleted',0);	
		return $this->db->get('menues')->result();	
	}
	function get_assigned_menu_permissions($role_id)
	{
		if(!empty($role_id))
		{
			$qry="select um.*,m.menu_name from user_menu um join menues m on um.menu_id=m.menu_id where parent_id=0 and role_id=".$role_id;
			$data=$this->common_model->getByQuery($qry);
			return $data;	
		}
	}
	function get_role_operations($role_id,$menu_id)
	{
		if(!empty($menu_id))
		{
			$this->db->where(array('is_active'=>1,'menu_id'=>$menu_id));	
			$menu_operations['operations']=$this->db->get('menu_operations')->result_array();
			if(!empty($role_id))
			{
				$assign_operation=$this->common_model->getByQuery('select group_concat(mo_id) as mo_ids from user_menu_operations where role_id='.$role_id.' and menu_id='.$menu_id);
				if(!empty($assign_operation))
				{
					$menu_operations['selected']=explode(',',$assign_operation[0]['mo_ids']);
				}
			}
			return $menu_operations;	
		}
	}
	function get_menues($role_id=null)
	{
		if(!empty($role_id))
		{
			$this->db->where(array('is_deleted'=>0));	
			$menu['permissions']=$this->db->get('menues')->result_array();
			$assign_menues=$this->common_model->getByQuery('select group_concat(menu_id) as menu_ids from user_menu where role_id='.$role_id);
				if(!empty($assign_menues))
				{
					$menu['selected']=explode(',',$assign_menues[0]['menu_ids']);
				}
				return $menu;
		}
	}
	function save_menu_permissions($data)
	{
		if(!empty($data))
		{
			if(!empty($data['role_id']) && !empty($data['menu_ids']))
			{
				$this->db->delete('user_menu',array('role_id'=>$data['role_id']));
				$menus_array=array();
				foreach ($data['menu_ids'] as $value) 
				{
					$menus_array[]=array('role_id'=>$data['role_id'],'menu_id'=>$value,'is_active'=>1);
					$this->db->insert('user_menu',array('role_id'=>$data['role_id'],'menu_id'=>$value,'is_active'=>1));	
				}
				
			} 
		}
	}
	function save_menu_operation($data,$state='')
	{
		if(!empty($data))
		{
			if(!empty($data['menu_id']) && !empty($data['operation_name']))
			{
				$cnt=$this->db->get_where('menu_operations',array('menu_id'=>$data['menu_id'],'menu_operation_name'=>$data['operation_name']))->result_array();
				// print_r($cnt);
				// exit;
				if(count($cnt)==0)
				{
					$this->db->insert('menu_operations',array('menu_id'=>$data['menu_id'],'menu_operation_name'=>$data['operation_name'],'description'=>$data['description'],'is_active'=>1));	
				}
			} 
		}
	}
	function get_menu_name_by_id($id=null)
	{
		if(!empty($id))
		{
			$data=$this->db->get_where('menues',array('menu_id'=>$id))->result_array();
			if(!empty($data))
			{
				if(isset($data[0]['menu_name']) && !empty($data[0]['menu_name']))
				{
					return $data[0]['menu_name'];
				}
			}
		}
	}
	function get_parent_menu_details($id=null)
	{
		if(!empty($id))
		{
			$menu_details=$this->db->get_where('menues',array('menu_id'=>$id))->result_array();
			if(isset($menu_details[0]['parent_id']) && !empty($menu_details[0]['parent_id']))
			{
				$parent_menu_details=$this->db->get_where('menues',array('menu_id'=>$menu_details[0]['parent_id']))->result_array();
			}
			if(!empty($parent_menu_details[0]))
			{
				return $parent_menu_details[0];	
			}
		}
	}
	function save_role_menu_operation($post)
	{
		if(!empty($post))
		{
			if(!empty($post['candidate_role']) && !empty($post['menu_id']))
			{
				$this->db->delete('user_menu_operations',array('role_id'=>$post['candidate_role'],'menu_id'=>$post['menu_id']));
				if(!empty($post['operations']))
				{
					foreach ($post['operations'] as $key => $value) {
						$this->db->insert('user_menu_operations',array('role_id'=>$post['candidate_role'],'menu_id'=>$post['menu_id'],'mo_id'=>$value,'is_active'=>1,'created_on'=>date('Y-m-d h:m:s'),'created_by'=>get_login_user_id()));
					}
				}
			}
		}

	}
	function get_menu_operation_details($menu_id)
	{
		if(!empty($menu_id))
		{
			$data=$this->db->get_where('menu_operations',array('mo_id'=>$menu_id))->row();
			return $data;
		}
	}

//Employee property functions start here
	
	function property_list(){
		$query = $this->db->get_where('property', array('is_deleted'=>0));
		return $query->result();
	}

	function save_property($data){
		$query=$this->db->insert('property',$data);
		return $query;
	}

	function delete_property($prop_id){
		$this->db->where('prop_id',$prop_id);
		$result = $this->db->update('property', array('is_deleted'=>1));
		return $result;
	}
	function get_property_data($prop_id){
		return $this->db->get_where('property', array('prop_id' => $prop_id))->row();
	}
	function update_property($data,$prop_id){
		$this->db->where('prop_id',$prop_id);
		return $this->db->update('property',$data);
	}
//Employee property functions end here
	function get_widgets($role_id=null)
	{
		if(!empty($role_id))
		{
			$this->db->where(array('is_active'=>1));	
			$widgets['widgets']=$this->db->get('widgets')->result_array();
			$assign_widgets=$this->common_model->getByQuery('select group_concat(widget_id) as widget_ids from user_widgets where role_id='.$role_id);
				if(!empty($assign_widgets))
				{
					$widgets['selected']=explode(',',$assign_widgets[0]['widget_ids']);
				}
				return $widgets;
		}
	}
	function save_user_widgets($data)
	{
		if(!empty($data))
		{
			
			if(!empty($data['role_id']) && !empty($data['widget_ids']))
			{
				$this->db->delete('user_widgets',array('role_id'=>$data['role_id']));
				$menus_array=array();
				foreach ($data['widget_ids'] as $value) 
				{
					$data=array('role_id'=>$data['role_id'],'widget_id'=>$value);
					$data=set_log_fields($data,'insert');
					$this->db->insert('user_widgets',$data);	
				}
				
			}
			else if(!empty($data['role_id']) && empty($data['widget_ids']))
			{
				$this->db->delete('user_widgets',array('role_id'=>$data['role_id']));
			} 
		}
	}
}

?>
