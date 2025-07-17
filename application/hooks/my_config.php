 <?php  
   defined('BASEPATH') OR exit('No direct script access allowed');  
	class My_config extends CI_Controller
	{  
		function load_config()
		{
			$custom_config = config_item('custom_config');
			$CI =& get_instance();
			$configurations = $CI->db->get_where('configuration_settings', array('conf_id'=>1))->row_array();

			// x_debug($configurations);
			foreach ($configurations as $key => $value) {
				$CI->config->set_item($key,$value);
			}
		}
	}
  ?>