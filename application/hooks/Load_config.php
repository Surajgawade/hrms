<?php  
    defined('BASEPATH') OR exit('No direct script access allowed');  
    class Load_config extends CI_Controller {  
    	public function get_configurations()  
        {
        	$this->CI =& get_instance();
        	$configurations = $this->CI->db->get_where('configuration_settings', array('conf_id'=>1))->row_array();
		    $config['proxy_ips'] = $configurations['proxy_ips'];
			$config['user_add_permissions'] = $configurations['user_add_permissions'];
			$config['super_user_role_id'] = $configurations['super_user_role_id'];
			$config['admin_user_role_id'] = $configurations['admin_user_role_id'];
			$config['hr_user_role_id'] = $configurations['hr_user_role_id'];
			$config['weekoff_sat'] = $configurations['weekoff_sat'];
			$config['hours_per_day'] = $configurations['hours_per_day'];
			$config['grace_time'] = $configurations['grace_time'];
			$config['half_hours_per_day'] = $configurations['half_hours_per_day'];
			// $config['establishment_date'] = "2014-01-01";
			$config['late_mark_time'] = $configurations['late_mark_time'];
			$config['office_out_time'] = $configurations['office_out_time'];
			$config['hr_email'] = $configurations['hr_email'];
			$config['job_refer']  = array(
				'company_name' => $configurations['company_name'],
				'email_id' => $configurations['email_id'],
				'address' => $configurations['address'],
				'contact_no' => $configurations['contact_no'],);
        }  
    }  
?>  