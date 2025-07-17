<?php 
if(!function_exists('get_user_data'))
{
	function get_user_data($id=null)
	{
		if(!empty($id))
		{
			$CI = get_instance();
			$CI->load->model('candidate_model');
			$user_data=$CI->candidate_model->get_by_id($id);

			return $user_data;
		}
	}
}
	
if(!function_exists('get_user_settings'))
{	
	function get_user_settings($id=null,$is_rpo)
	{
		if(!empty($id))
		{
			$CI = get_instance();
			$CI->load->model('user_model');
			$user_data=$CI->user_model->get_user_settings($id,$is_rpo);

			return $user_data;
		}
	}
}
if(!function_exists('get_user_menues'))
{	
	function get_user_menues($id=null,$is_rpo=false)
	{
		if(!empty($id))
		{
			$CI = &get_instance();
			$CI->load->model('user_model');
			$user_data=$CI->user_model->get_user_menu_list($id,$is_rpo);

			return $user_data;
		}
	}
}
if(!function_exists('user_access_page'))
{
	function user_access_page($controller,$method='')
	{
		$CI = &get_instance();			
		$user_controllers=$CI->session->userdata('user_controllers');
		$user_methods=$CI->session->userdata('user_methods');
		if(!empty($controller) && !empty($method))
		{
			if(!in_array($controller, $user_controllers) || !in_array($method, $user_methods))
			{
				//redirect('access_denied');
				if(!empty(get_login_user_id()))
				{
					redirect('access_denied');
				}
				else
				{
					redirect('login');		
				}
			}
		}
	}
}
if(!function_exists('user_access_operation'))
{
	function user_access_operation($controller,$method='',$isajax=false)
	{
		//echo $controller;
		$CI = &get_instance();			
		$user_menu_operations=$CI->session->userdata('user_menu_operations');
		$super_user=$CI->config->item('super_user_role_id');
		$admin_user=$CI->config->item('admin_user_role_id');
		$userdata=$CI->session->userdata('logged_in_user');
		$role_id=$CI->session->userdata('role_id');
		if(!in_array($role_id, $super_user))
		{
			if(!empty($controller) && !empty($method))
			{
				// x_debug(in_array($method, $user_menu_operations[$controller]));
				//$controller=str_replace('_', ' ', strtolower($controller));
				$method=str_replace('_', ' ', strtolower($method));
				if(!in_array($method, $user_menu_operations[$controller]))
				{
					if($isajax)
					{
						return '1';
						//echo 'no access';
					}
					else
					{
						if(!empty(get_login_user_id()))
						{
							redirect('access_denied');
						}
						else
						{
							redirect('login');		

						}
					} 
				}
			}
		}
	}
}
if(!function_exists('get_login_user_id'))
{
	function get_login_user_id()
	{
		$CI = &get_instance();			
		$user_data=$CI->session->userdata('logged_in_user');
		return $user_data['id'];
	}
}
if(!function_exists('get_user_notifications'))
{	
	function get_user_notifications_count($can_id=null)
	{
		if(!empty($can_id))
		{
			$CI = &get_instance();
			$CI->load->model('common_model');
			$task_data=$CI->common_model->count_all('push_notifications',array('can_id'=>$can_id,'table_type'=>'task_manager','operation_type'=>'insert','status'=>0));
	    	$leave_data=$CI->common_model->count_all('push_notifications',array('can_id'=>$can_id,'table_type'=>'leave_application','operation_type'=>'update','status'=>0));
	    	$leave_request=$CI->common_model->count_all('push_notifications',array('reporting_to'=>$can_id,'table_type'=>'leave_application','operation_type'=>'insert','status'=>0));
			$count=$task_data+$leave_data+$leave_request;
			return $count;
		}
	}
}
if(!function_exists('get_user_name_by_id'))
{	
	function get_user_name_by_id($id=null,$can_type=null)
	{
		if(!empty($id))
		{
			$CI = &get_instance();
			$tablename = 'candidate';
			if(!empty($can_type))
			{
				$tablename= 'rpo_candidates';
			}
			$CI->load->model('candidate_model');
			$user_data=$CI->candidate_model->get_candidate_name_by_id($id,$tablename);
			$user_data=(array)$user_data;
			if(isset($user_data['can_name']) && !empty($user_data['can_name']))
			{
				return $user_data['can_name'];
			}
		}
	}
}
if(!function_exists('get_user_details'))
{	
	function get_user_details($condition=null)
	{
		if(!empty($condition))
		{
			$CI = &get_instance();
			$CI->load->model('common_model');
			$user_data=$CI->common_model->get_data('candidate',$condition,'can_id,job_profile');
				return $user_data;
		}
	}
}
if(!function_exists('get_time_difference'))
{
	function get_time_difference($created_time)
	{
		//date_default_timezone_set('Asia/Kolkata'); //Change as per your default time
		date_default_timezone_set('Asia/Culcutta');
		//$str = strtotime(date('Y-m-d H:i:s',strtotime($created_time)));
		$str = strtotime($created_time);
		$today = strtotime(date('Y-m-d H:i:s'));

		// It returns the time difference in Seconds...
		$time_differnce = $today-$str;

		// To Calculate the time difference in Years...
		$years = 60*60*24*365;

		// To Calculate the time difference in Months...
		$months = 60*60*24*30;

		// To Calculate the time difference in Days...
		$days = 60*60*24;

		// To Calculate the time difference in Hours...
		$hours = 60*60;

		// To Calculate the time difference in Minutes...
		$minutes = 60;

		if(intval($time_differnce/$years) > 1)
		{
			return intval($time_differnce/$years)." years ago";
		}
		else if(intval($time_differnce/$years) > 0)
		{
			return intval($time_differnce/$years)." year ago";
		}
		else if(intval($time_differnce/$months) > 1)
		{
			return intval($time_differnce/$months)." months ago";
		}
		else if(intval(($time_differnce/$months)) > 0)
		{
			return intval(($time_differnce/$months))." month ago";
		}
		else if(intval(($time_differnce/$days)) > 1)
		{
			return intval(($time_differnce/$days))." days ago";
		}
		else if (intval(($time_differnce/$days)) > 0) 
		{
			return intval(($time_differnce/$days))." day ago";
		}
		else if (intval(($time_differnce/$hours)) > 1) 
		{
			return intval(($time_differnce/$hours))." hours ago";
		}
		else if (intval(($time_differnce/$hours)) > 0) 
		{
			return intval(($time_differnce/$hours))." hour ago";
		}
		else if (intval(($time_differnce/$minutes)) > 1) 
		{
			return intval(($time_differnce/$minutes))." minutes ago";
		}
		else if (intval(($time_differnce/$minutes)) > 0) 
		{
			return intval(($time_differnce/$minutes))." minute ago";
		}
		else if (intval(($time_differnce)) > 1) 
		{
			return intval(($time_differnce))." seconds ago";
		}
		else
		{
			return "few seconds ago";
		}
	}
}
if(!function_exists('set_user_settings'))
{
	function set_user_settings($can_id,$is_rpo=false)
	{
	 	if(!empty($can_id))
	 	{
	 		$CI = &get_instance();
			$CI->session->set_userdata('user_settings',get_user_settings($can_id,$is_rpo));
			$menues=get_user_menues($can_id,$is_rpo);
			// x_debug($menues);
			$CI->session->set_userdata('user_controllers',$menues['controllers']);
			$CI->session->set_userdata('user_methods',$menues['methods']);
			$CI->session->set_userdata('user_menu_operations',$menues['menu_operations']);
			$widgets=$CI->common_model->get_data('user_widgets',array('role_id'=> $CI->session->role_id),'group_concat(widget_id) as widgets');
     		$CI->session->set_userdata('widgets',explode(',', $widgets['widgets'])); 
    	}
	}
}
if(!function_exists('set_user_session'))
{
 	function set_user_session($can_id)
 	{
		if(!empty($can_id))
		{
			$CI = &get_instance();
			$user_data=$CI->load->model('common_model');
			$user=$CI->common_model->get_data('candidate',array('can_id'=>$can_id));
			$CI->session->set_userdata('user_name',$user['can_name']);
			$CI->session->set_userdata('user_id',$user['can_id']);
			$CI->session->set_userdata('profile_pic',$user['profile_pic']);
			$CI->session->set_userdata('role_id',$user['role_id']);
			$CI->session->set_userdata('ro_id',$user['reporting_to']);
			$CI->session->set_userdata('email',$user['email']);
			$CI->session->set_userdata('can_type',$user['can_type']);
	   }
 	}
}
if(!function_exists('set_user_widgets'))
{
	function set_user_widgets()
	{
		$CI = &get_instance();
		$CI->load->model('common_model');
		$widgets=$CI->common_model->get_data('user_widgets',array('role_id'=> $CI->session->role_id),'group_concat(widget_id) as widgets');
		$CI->session->set_userdata('widgets',explode(',', $widgets['widgets']));
	}
}
if(!function_exists('get_user_job_profile'))
{
	function get_user_job_profile($id='')
	{
		if(!empty($id))
		{
			$CI = &get_instance();
			$CI->load->model('common_model');
			$job=$CI->common_model->get_data('job_profiles',array('id'=>$id),'title');
			if(!empty($job['title']))
			{
				return $job['title'];
			}
		}
	}
}
?>
