<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class System_Settings extends My_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('candidate_model');
		$this->load->model('common_model','common');
		$this->load->model('settings_model','settings');
		// $logged_in = $this->session->userdata['logged_in'];
		$userdata = $this->session->userdata('logged_in_user');
		if(!$userdata){
			$newURL = site_url()."/login";
			header('Location: '.$newURL);        		
		}        
	}

	function index()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
		$this->load_view("menues","HRMS - Menu List",$this->content);			
	}

	function menu_list()
	{
		$this->datatables->unset_column('menu_id');
		$this->datatables->select('menu_id, menu_name, menu_description');
		$this->datatables->from('menues');
		$this->datatables->where('is_deleted',0);
		$update_url = site_url().'/system_settings/update_menu/$1';
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn-success btn btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_menu($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_delete" ><span class="glyphicon glyphicon-trash"></span></a>', 'menu_id');
		$result= $this->datatables->generate();  
		// $lst_qry = $this->db->last_query();
		// file_put_contents('/tmp/test1.txt', $lst_qry. "\n\n", FILE_APPEND); 
		echo $result;
	}

	function add_menu()
   {
   		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
	   	$this->content->menues = $this->settings->get_all_menues();
			$this->content->menues_dropdown = $this->settings->get_menu_dropdown();
	   	if(!empty($this->input->post()))
	   	{
	   		$post = $this->input->post();
	   		$controller ='';
	   		$method ='';
	   		if(empty($post['parent_menu']))
				{
					$controller = str_replace(' ','_',strtolower($post['menu_name']));
					$method = 'index';
				}
				else
				{
					$parent_menu_name=$this->settings->get_menu_name_by_id($post['parent_menu']);
					$controller = str_replace(' ','_',strtolower($parent_menu_name));
					$method = str_replace(' ','_',strtolower($post['menu_name']));
				}
				$menu_data = array('menu_name' => $post['menu_name'], 'parent_id'=> $post['parent_menu'],'menu_description'=> $post['menu_description'],'controller'=> $controller,'method'=> $method,'menu_icon_class' =>$post['menu_icon_class'],'menu_icon_color' => $post['menu_icon_color']);
					$menu_data=set_log_fields($menu_data,'insert');
					$id=$this->common->insert('menues',$menu_data);
					$this->common->update('menues',array('sort_order'=>$id),array('menu_id'=>$id));
					$this->session->set_flashdata('success', 'Menu Added Successfully!');
					redirect('system_settings');                        
	   	}
	      $this->load_view("add_menu","HRMS - Add Menu",$this->content);
   }

   function update_menu()
   {
   		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        $menu_id = $this->uri->segment(3);
        $this->content->menues = $this->settings->get_all_menues();
		  $this->content->menues_dropdown = $this->settings->get_menu_dropdown();
        $this->content->menu_details = $this->settings->edit_menu_details($menu_id);
        $this->content->parent_menu_details=$this->settings->get_parent_menu_details($menu_id);
        if(!empty($_POST))
        {
            $post = $this->input->post();
            $menu_id = $post['menu_id'];
            if(empty($post['parent_menu']))
				{
					$controller = str_replace(' ','_',strtolower($post['menu_name']));
					$method = 'index';
				}
				else
				{
					$parent_menu_name=$this->settings->get_menu_name_by_id($post['parent_menu']);
					$controller = str_replace(' ','_',strtolower($parent_menu_name));
					$method = str_replace(' ','_',strtolower($post['menu_name']));	
				}
				$menu_data = array('menu_name' => $post['menu_name'], 'parent_id' => $post['parent_menu'],'menu_description'=> $post['menu_description'],'controller'=> $controller,'method'=> $method,'menu_icon_class' =>$post['menu_icon_class'],'menu_icon_color' =>$post['menu_icon_color']); 
            	$menu_data=set_log_fields($menu_data);
				
            $this->common->update('menues',$menu_data,array('menu_id'=>$menu_id)); 
            $this->session->set_flashdata('success', 'Menu Updated Successfully!');
            redirect('system_settings');
        }
        $this->load_view("edit_menu","HRMS - Edit Menu",$this->content);
   }

	function edit_menu()
	{
		if ($this->input->is_ajax_request())
		{
			$menu_id = $this->input->post('menu_id');
			$menu_details = $this->settings->edit_menu_details($menu_id);
			echo json_encode(array("result" => $menu_details));
		} 
	} 

	function delete_menu()
	{
		if ($this->input->is_ajax_request())
		{
			$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
	        if(!empty($access))
	        {
	        	echo "0";
	        }
	        else
	        {
				$menu_id = $this->input->post('menu_id');
				$count = $this->settings->delete_menu($menu_id);
				if($count>0)
				{
					echo "2";
				}
				else
				{
					echo "1";
				}
			}
		}
	}

	function roles()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
		$this->content->roles = $this->settings->get_all_roles();
    	$this->load_view("roles","HRMS - Role List",$this->content);			
	}

	function role_list()
	{
		$this->datatables->select('role_id, role_name, role_description');
		$this->datatables->from('roles');
		$this->datatables->where('is_deleted',0);
		$this->datatables->add_column('edit', '<a href="edit_role/$1" class="tabledit-edit-button btn-success btn btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_role($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_delete" ><span class="glyphicon glyphicon-trash"></span></a>', 'role_id');
		$result= $this->datatables->generate();  
		// $lst_qry = $this->db->last_query();
		// file_put_contents('/tmp/test1.txt', $lst_qry. "\n\n", FILE_APPEND); 
		echo $result;
	}

	function add_role()
   {
   		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		if ($this->input->post())
		{
			$post = $this->input->post();
			$role_details = new Role_Entity();
			if(!empty($post['role_id']))
				$role_details->role_id = $post['role_id'];
			$role_details->role_name = $post['role_name'];
			$role_details->role_description = $post['role_description'];
			$role_details=set_log_fields($role_details,'insert');
			$this->settings->add_role_details($role_details);
			if($role_details->role_id)                           
				$this->session->set_flashdata('success', 'Menu Updated Successfully!');
				
			else
				$this->session->set_flashdata('success', 'role added successfully!');				
			redirect('system_settings/roles');
		}
		$this->load_view("add_role","HRMS - Role List",$this->content);
   }		

	function edit_role()
	{
		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
				$role_id= $this->uri->segment('3');
				if ($this->input->post())
				{
					$post=$this->input->post();
				
					if(isset($post['role_name']) && !empty($post['role_name']))
					{
						$this->common->update('roles',array('role_name'=>$post['role_name'],'role_description'=>$post['role_description']),array('role_id'=>$role_id));
						$this->session->set_flashdata('success', 'Role Updated Successfully!');
						redirect('system_settings/roles');
					}
				}
				if(!empty($role_id))
				{
					$this->content->role_details=$this->common->get_data('roles',array('role_id'=>$role_id));
					// print_r($this->content->role_details);
					// die();
					$this->load_view("edit_role","HRMS - Role List",$this->content); 
				}
}

	function delete_role()
	{
		if ($this->input->is_ajax_request())
		{
		 	$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
	        if(!empty($access))
	        {
	        	echo "0";
	        }
	        else
	        {
				$role_id = $this->input->post('role_id');
				$this->settings->delete_role($role_id);
				echo "1";
			}
			
		}
	}

	function permissions()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
		$this->content->permissions = $this->settings->get_all_permissions();
    	$this->load_view("permissions","HRMS - Permission List",$this->content);			
	}

	function add_permission()
   {
		if ($this->input->is_ajax_request())
		{
			$post = $this->input->post();
			$permission_details = new Permission_Entity();
			if(!empty($post['permission_id']))
				$permission_details->permission_id = $post['permission_id'];
			$permission_details->permission_name = $post['permission_name'];
			$this->settings->add_permission_details($permission_details);
			if($permission_details->permission_id)                           
				echo json_encode(array("msg"=>"Permission details updated successfully!"));
			else
				echo json_encode(array("msg"=>"Permission added successfully!"));
		}
   }

	function edit_permission()
	{
		if ($this->input->is_ajax_request())
		{
			$permission_id = $this->input->post('permission_id');
			$permission_details = $this->settings->edit_permission_details($permission_id);
			echo json_encode(array("result" => $permission_details));
		} 
	} 

	function delete_permission()
	{
		if ($this->input->is_ajax_request())
		{
			$permission_id = $this->input->post('permission_id');
			$this->settings->delete_permission($permission_id);
			echo "Permission deleted successfully!";
		}
	}

	 function assign_permissions()
	{
		
   	user_access_page($this->router->fetch_class(),$this->router->fetch_method()); 
		$this->content->roles = $this->settings->get_all_roles();       
		$this->content->permissions = $this->settings->get_all_permissions();
		if(!empty($this->input->post()))
		{
			$post['role_id'] = $this->input->post('candidate_role');
			$post['menu_ids']=$this->input->post('menu_ids');
			$this->settings->save_menu_permissions($post);
			set_user_settings(get_login_user_id());
			$this->session->set_flashdata('success', 'Permission Assigned Successfully!');
		}
    	$this->load_view("assign_permissions","HRMS - Assign Permissions To Candidate",$this->content);			
	}

	function add_menu_operations()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());
        
		$this->content->menues = $this->settings->get_menu_dropdown();
		if(!empty($this->input->post()))
		{
			$post=$this->input->post();
			//x_debug($post);
			$data=$this->common->get_data('menu_operations',array('menu_id'=>$post['menu_id'],'menu_operation_name'=>$post['operation_name']));
			if(!empty($data))
			{
				$this->session->set_flashdata('success', 'Menu Operation Already Exist');
			}
			else
			{
				$this->db->insert('menu_operations',array('menu_id'=>$post['menu_id'],'menu_operation_name'=>$post['operation_name'],'description'=>$post['description'],'is_active'=>1));
				$this->session->set_flashdata('success', 'Menu Operation Added Successfully');

			}

		}
		$this->load_view("add_menu_operations","HRMS - Add Menu Operations",$this->content);	
	}
	 function assign_menu_operations()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());
        
		$this->content->roles = $this->settings->get_all_roles();       
		$this->content->menues = $this->settings->get_all_menues();
		
		if(!empty($this->input->post()))
		{
			$this->settings->save_role_menu_operation($this->input->post());
			set_user_settings(get_login_user_id());
			$this->session->set_flashdata('success', 'Menu Operation Assigned Successfully!');
			redirect('system_settings/assign_menu_operations');
		}

		$this->load_view("assign_user_menu_operations","HRMS - Assign Permissions To Candidate",$this->content);			
	}

	function get_role_permissions_list()
	{
		$role_id=$this->input->post('role_id');
		$data['data']=$this->settings->get_assigned_menu_permissions($role_id);
		if(!empty($data['data']))
		{
			$output=$this->load->view('user_menu_list',$data,true);
			echo($output);
		}	
	}
	function get_role_permissions()
	{
		$role_id=$this->input->post('role_id');
		$data=$this->settings->get_assigned_menu_permissions($role_id);
		if(!empty($data))
		{
			$menu_ids=implode(', ', array_column($data, 'menu_id'));
			echo $menu_ids;
		}
	}
	function get_role_menu_operations()
	{
		$role_id=$this->input->post('role_id');
		$menu_id=$this->input->post('menu_id');
		
		//print_r($role_id);
		$data=$this->settings->get_role_operations($role_id,$menu_id);
		if(!empty($data['operations']))
		{
			$output=$this->load->view('user_menu_operations_list',$data,true);
			
			echo($output);
		}
		else
		{
			echo '0';
		}
	}
	function get_menues()
	{
		$role_id=$this->input->post('role_id');
		$data=$this->settings->get_menues($role_id);
		if(!empty($data['permissions']))
		{
			$output=$this->load->view('user_menu_check_list',$data,true);
			echo($output);
		}
		else
		{
			echo '0';
		}
	}	

	function get_menu_assign_operation()
	{
		 $menu_id=$this->input->get('menu_id');
		// echo $menu_id;
		$this->datatables->unset_column('menu_operations.mo_id');
		$this->datatables->select('menu_operations.mo_id, menu_operations.menu_id, menues.menu_name, menu_operation_name, description,menu_operations.is_active, CASE WHEN menu_operations.is_active = 1 THEN \'Yes\' ELSE \'No\' END AS is_active');
      	$this->datatables->join('menues', 'menu_operations.menu_id = menues.menu_id', 'left');
		$this->datatables->from('menu_operations');
		 $this->datatables->where('menu_operations.menu_id',$menu_id);
		$this->datatables->add_column('edit', '<a href="update_menu_operation/$1" class="tabledit-edit-button btn-success btn btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_menu($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_delete" ><span class="glyphicon glyphicon-trash"></span></a>', 'mo_id');
		$result= $this->datatables->generate();  
		echo $result;
	}

   function update_menu_operation()
   {
   		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        $mo_id = $this->uri->segment(3);
        $this->content->menu_details = $this->settings->get_menu_operation_details($mo_id);
        // print_r($this->content->menues_details);
        // exit;
        if(!empty($_POST))
        {
        	$mo_id = $this->uri->segment(3);
            $post = $this->input->post();
            
            $this->common_model->update('menu_operations',array('menu_operation_name'=>$post['mo_name'],'description'=>$post['menu_description']),array('mo_id'=>$mo_id));
            	redirect('system_settings/add_menu_operations');
        }
        $this->load_view("update_menu_operation","HRMS - Update Menu Operation",$this->content);
   }

   function delete_menu_operation()
    {
    	if ($this->input->is_ajax_request())
        {
            $access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
            if(!empty($access))
            {
               echo "0";
            }
            else
            {
		        $id = $this->input->post('id');
		        if(!empty($id))
		        {
			        $this->common->update('menu_operations',array('is_active'=>0),array('mo_id'=>$id));
			        echo "1";
			    }
			}
		}
    }
    function users()
    {
    	user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
      	
      	$this->load_view("users_list","Users List",$this->content);       
    }
    function list_users()
    {
    	$this->datatables->unset_column('user_id');
		$this->datatables->select('user_id, user_name, email,CASE WHEN is_active = 1 THEN \'Yes\' ELSE \'No\' END AS is_active');
		$this->datatables->from('users');
		$this->datatables->add_column('edit', '<a href="javascript:;" onClick="delete_user($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_delete" ><span class="glyphicon glyphicon-trash"></span></a>', 'user_id');
		$result= $this->datatables->generate();  
		// $lst_qry = $this->db->last_query();
		// file_put_contents('/tmp/test1.txt', $lst_qry. "\n\n", FILE_APPEND); 
		echo $result;
    }
    function add_user()
    {
    	$this->content->header_name="User Registration Form";
    	 $this->load_view("user_view","Add User",$this->content);
    }
    function update_user($user_id)
    {
    	$this->content->header_name="User Edit Form";
    	$this->content->user_details=$this->common->get_data('users',array('user_id'=>$user_id));
    	$this->load_view("user_view","Edit User",$this->content);
    }
   function delete_user()
    {
       $access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
        if(!empty($access))
        {
            echo "0";
        }
        else
        { 
            $user_id = $this->input->post('user_id');
            $data['is_active']=0;
            $data=set_log_fields($data); 
            $id  = $this->common->update('users',$data,array('user_id'=>$user_id));
            $can_data=$this->common->get_data('users',array('user_id'=>$user_id));
            $data['is_deleted']=1;
            $this->common->update('candidate',$data,array('email'=>$can_data['email']));
            echo "1";
        }
    }
    function save_user()
    {
        $this->load->helper(array('form', 'url','security'));
        $this->load->library('form_validation');
        //server side validations
        $this->form_validation->set_rules('can_name','Candidate Name','required',array('required'=>'not proivedd %s'));
		  $this->form_validation->set_rules('email','Email','required|valid_email');
		//$this->form_validation->set_rules('mobileno', 'Mobile Number','required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->register();
        }
        else
        {
    	    $this->load->model('candidate_model');
    	    $can_name = $this->input->post('can_name', true);
    	    $email = $this->input->post('email',true);
    	    $default_password = password_hash("raoson1234", PASSWORD_DEFAULT);
            $subscibed_users=$this->config->item('user_add_permissions')+1;
                
            if($this->candidate_model->check_email_availability($email) > 0)
            {
                $error = $this->session->set_flashdata('error', 'Email id already exist!');
                $this->session->set_flashdata('can_name',$can_name);
                $this->session->set_flashdata('email',$email);
                $this->session->set_flashdata('mobileno',$mobileno);
                redirect('system_settings/add_user', $error);
            }
            else
            {
            	if($this->common->count_all('users',array('is_active'=>1))<=$subscibed_users)
            	{
            		$manger_role = $this->common_model->get_data('roles', array('role_name like'=>'%Manager%', 'is_deleted'=>0));
                	$manager = $this->common_model->get_data('candidate', array('role_id'=>$manger_role['role_id'], 'is_deleted'=>0));

             		$last_id = $this->common_model->count_all('candidate');
             		$emp_code = $this->common_model->get_data('configuration_settings',array(),'emp_code_prefix');
						if(!empty($last_id))
						{
							$last_id = $last_id +1;
							$emp_code =$emp_code['emp_code_prefix'].$last_id;
						}
						else
						{
							$emp_code = $emp_code['emp_code_prefix'].'1';
						}

	            	$insert_arr = array('can_name' => $can_name, 'email'=>$email, 'password'=>$default_password,'role_id'=>14,'is_active'=>0,'reporting_to'=>$manager['can_id'],'emp_code'=> $emp_code);
	                $insert_arr=set_log_fields($insert_arr,'insert');
	                // x_debug($insert_arr);
	                $id = $this->common->insert('candidate',$insert_arr);
	                if($id > 0)
	                {
	                	$insert_arr_user = array('user_name' => $can_name, 'email'=>$email, 'password'=>$default_password);
	                	$insert_arr_user=set_log_fields($insert_arr_user,'insert');
	                
	                	//unset($insert_arr[''])
	                	$this->common->insert('users',$insert_arr_user);
	                    $this->load->library('email_send');
	                    $mailer_config=$this->common->get_data('email_config',array('email_template'=>'registration_confirmation'));
                    	$insert_arr['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
	                    $message = $this->load->view("email_templates/".$mailer_config["email_template"], $insert_arr, TRUE);

	                    $sent = $this->email_send->send_mail_new($mailer_config, $email,$message);
	                    if($sent==1)
	                    {
	                       // echo "New Employee has been created successfully!";exit;
	                        $success = $this->session->set_flashdata('success', 'New Employee has been created successfully!');
	                        redirect('system_settings/users',$success);
	                    } 
	                    else{
	                        $error = $this->session->set_flashdata('error', 'Please enter valid email id!');
	                        $this->session->set_flashdata('can_name',$can_name);
	                        $this->session->set_flashdata('email',$email);
	                        $this->session->set_flashdata('mobileno',$mobileno);
	                        redirect('system_settings/users', $error);
	                    }               
	                    
	                }
	                else
	                {
	                    $error = "Error in inserting candidate registration details";
	                    log_message('error', $error);
	                }
	            }
	            else
	            {
	            	$error = $this->session->set_flashdata('error', 'Your User Limit Is Exceeded! Please Upgrade The Plan');
	                $this->session->set_flashdata('can_name',$can_name);
	                $this->session->set_flashdata('email',$email);
	                $this->session->set_flashdata('mobileno',$mobileno);
	                redirect('system_settings/add_user', $error);
	            }  
            }
        }
    }

	private function load_view($viewname= "blank_page",$page_title)
	{
		$this->content->meta_description="Meta meta_description here!";
		$this->content->meta_keywords="meta keywords here!";
		$this->masterpage->setMasterPage('master');
		$this->content->page_description = "";
		$this->masterpage->setPageTitle($page_title);
		$this->masterpage->addContentPage('system_settings/'.$viewname,'content',$this->content);
		$this->masterpage->show();
	}
//Employee property functions start here
	function create_property()
	{
		$this->content->departments = $this->common->get_data_array('departments', array('is_deleted'=>0));
        $this->load_view("create_property","HRMS - Employee Properties",$this->content);	
	}
	function employee_properties()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());
        $this->load_view("property_list","HRMS - Employee Properties",$this->content);	
	}

	function property_list(){
		$result=$this->settings->property_list();
		if(!empty($result))
		{
			foreach ($result as $key => $value)
			{
				$dept = $this->common->get_data('departments', array('id'=>$value->dept_id));
				$result[$key]->dept_name = $dept['title'];
			}
		}
		echo json_encode($result);
	}

	function save_property(){
		$prop_id=$this->input->post('hideID');
		if($prop_id!=''){
			$data=array(			
			'dept_id'=>$this->input->post('dept_id'),
			'prop_name'=>$this->input->post('prop_name'),
			'quantity'=>$this->input->post('quantity'),
			'purchase_price'=>$this->input->post('purchase_price'),
			'penalty'=>$this->input->post('penalty'),
			'status'=>$this->input->post('status')
		);
		$result=$this->settings->update_property($data,$prop_id);
		echo $result;
		}else{
			$data=array(
			'dept_id'=>$this->input->post('dept_id'),
			'prop_name'=>$this->input->post('prop_name'),
			'quantity'=>$this->input->post('quantity'),
			'purchase_price'=>$this->input->post('purchase_price'),
			'penalty'=>$this->input->post('penalty'),
			'status'=>$this->input->post('status')
			);
			$result=$this->settings->save_property($data);
		}
		echo $result;
	}

	function update(){
		$prop_id=$this->uri->segment(3);
		$this->content->departments = $this->common->get_data_array('departments', array('is_deleted'=>0));
		$this->content->result=$this->settings->get_property_data($prop_id);
		$this->load_view("create_property", "HRMS- Edit Property", $this->content);
	}

	function delete_property(){
		$prop_id=$this->input->post('prop_id');
		$result=$this->settings->delete_property($prop_id);
		echo $result;
	}
	 
	function widgets()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
		$this->load_view("widgets","HRMS - Widget List",$this->content);			
	}

	function widget_list()
	{
		$this->datatables->unset_column('widget_id');
		$this->datatables->select('widget_id, widget_name, widget_description,CASE WHEN is_active = 1 THEN \'Yes\' ELSE \'No\' END AS is_active');
		$this->datatables->from('widgets');
		// $this->datatables->where('is_active',1);
		$update_url = site_url().'/system_settings/update_widget/$1';
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn-success btn btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_menu($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_delete" ><span class="glyphicon glyphicon-trash"></span></a>', 'widget_id');
		$result= $this->datatables->generate();  
		// $lst_qry = $this->db->last_query();
		// file_put_contents('/tmp/test1.txt', $lst_qry. "\n\n", FILE_APPEND); 
		echo $result;
	}
	function add_widget()
	{
		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		//x_debug($this->input->post());   
		if(!empty($this->input->post()))
	   	{
	   		$data=$this->input->post();
	   		if(empty($data['widget_id']))
	   		{
		   		$data=set_log_fields($data,'insert');
		   		$this->common->insert('widgets',$data);
		   		$this->session->set_flashdata('success', 'Widget Added Successfully!');
		   		redirect('system_settings/widgets');
			}
		   	//redirect('system_settings/widgets');
	   	}
	    $this->load_view("add_widget","HRMS - Add Widget",$this->content);
	}
	function update_widget($id)
	{
		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		$is_exist = check_record_exist($tablename='widgets', $conditions = array('widget_id' =>$id));
		$this->content->widget_details=$this->common->get_data('widgets',array('widget_id'=>$id));
		if(!empty($this->input->post()))
	   	{
	   		$data=$this->input->post();
			if(!empty($data['widget_id']))
		   	{
		   		$data=set_log_fields($data);
		   		//unset($data['widget_id']);
		   		$status=$this->common->update('widgets',$data,array('widget_id'=>$data['widget_id']));
		   		if($status)
		   		{
		   			$this->session->set_flashdata('success', 'Widget updated Successfully!');
		   		}
		   		redirect('system_settings/widgets');
		   	}
		}
		$this->load_view("add_widget","HRMS - Update Widget",$this->content);	
	}
	function assign_widgets()
	{
		
   		user_access_page($this->router->fetch_class(),$this->router->fetch_method()); 
		$this->content->roles = $this->settings->get_all_roles();       
		//$this->content->widgets = $this->common->get_data_array('widgets','');
		if(!empty($this->input->post()))
		{

			$post['role_id'] = $this->input->post('candidate_role');
			$post['widget_ids']=$this->input->post('widget_ids');
			//x_debug($this->input->post());
			$this->settings->save_user_widgets($post);
			set_user_settings(get_login_user_id());
			$this->session->set_flashdata('success', 'Widgets Assigned Successfully!');
		}
    	$this->load_view("assign_widgets","HRMS - Assign Widget To Candidate",$this->content);			
	}
	function get_widgets()
	{
		$role_id=$this->input->post('role_id');
		$data=$this->settings->get_widgets($role_id);
		//x_debug($data);
		if(!empty($data['widgets']))
		{
			$output=$this->load->view('user_widget_check_list',$data,true);
			echo($output);
		}
		else
		{
			echo '0';
		}
	}
//Employee property functions end here

// Employee Assets
	public function asset_list()
	{
		//user_access_page($this->router->fetch_class(),$this->router->fetch_method());  
		$this->load_view("asset_list","HRMS - Assets List",$this->content);        
	}

	function view_asset_list()
	{  
		$this->datatables->unset_column('asset_code');
		$this->datatables->select('asset_code,asset_name,asset_type,candidate.can_name');
		$this->datatables->from('assets');
		$this->datatables->join('candidate','assets.assigned_to = candidate.can_id', 'left');
		$this->datatables->where('assets.is_active',1);
		// $this->db->order_by("can_id", "desc");
		$update_url = site_url().'/system_settings/add_edit_assets/$1';
		$view_url=site_url().'/system_settings/view_assets/$1';
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn-success btn btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a> <a onClick="delete_asset($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_edit" ><span class="glyphicon glyphicon-trash"></span></a><a href="'.$view_url.'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>', 'asset_code');	   
		$result= $this->datatables->generate();  
		echo $result;
	}

	function add_edit_assets()
	{
		//user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		$asset_code = $this->uri->segment(3);
		// $this->content->asset_types = $this->common_model->get_data_array('asset_types',array('is_deleted'=>0),'asset_code,title');
		$this->content->asset_types = $this->common_model->get_form_dropdown($tablename = 'asset_types', $fields = array('asset_code','title'),$conditions = array('is_deleted' => 0));
		$this->content->candidates = $this->common_model->get_form_dropdown($tablename = 'candidate', $fields = array('can_id','can_name'),$conditions = array('is_deleted' => 0));
		//x_debug($this->content->assets);
		if(!empty($asset_code))
		{
			//var_dump($this->common_model->count_all('assets',array('asset_code' =>$asset_code)));exit();
			if($this->common_model->count_all('assets', array('asset_code' =>$asset_code)) == 0 )
			{
				redirect('Record_not_found');
			}
			else
				{
			$this->content->asset_details = $this->common_model->get_data('assets',array('asset_code'=>$asset_code));
			// x_debug($this->content->asset_details);
			}
		}
		//$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		if(!empty($access))
		{
			$this->session->set_flashdata('warning', 'Access Denied');
			redirect('system_settings/asset_list');
		}
		else
		{
			if(!empty($this->input->post()))
			{
				$post = $this->input->post();
				$asset_code = $post['asset_code'];
				$asset_data = $post;

				if(!empty($asset_code))
				{
					$asset_data=set_log_fields($asset_data);
					$this->common_model->update('assets',$asset_data,array('asset_code' => $asset_code));
					$this->session->set_flashdata('success', 'Asset Details Updated Successfully!');
				}
				else
				{
					$asset_data=set_log_fields($asset_data,'insert');
					$this->common_model->insert('assets',$asset_data);
					$this->session->set_flashdata('asset_data', 'Asset Details Added Successfully!');
				}				
				redirect('system_settings/asset_list');
			}
			$this->load_view("add_edit_assets","HRMS - Add/Edit Asset Details",$this->content);
		}
	}

	function delete_asset()
	{
		if ($this->input->is_ajax_request())
		{
			//$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
			if(!empty($access))
			{
				echo "0";
			}
			else
			{
				$assest_id = $this->input->post('asset_code');
				$asset_code  = $this->common_model->update('assets',array('is_active' => 0 ),array('asset_code' => $assest_id));
				echo "1";
			}
		}
	}

	function delete_widget()
	{
		$post = $this->input->post();
		$res = $this->common_model->update('widgets', array('is_active'=>0), array('widget_id' => $post['widget_id']));
		echo json_encode($res);
	}

	function active_widget()
	{
		$post = $this->input->post();
		$res = $this->common_model->update('widgets', array('is_active'=>1), array('widget_id' => $post['widget_id']));
		echo json_encode($res);
	}

	function check_menu_exist()
	{
		if($this->input->is_ajax_request())
		{
			$menu_name = $this->input->post('menu_name',TRUE);
			$is_exist = $this->common_model->count_all('menues', array('menu_name'=>$menu_name,'is_deleted' =>0));
			// x_debug($is_exist);
			if($is_exist>0)
			{
				echo "1";
			}
		}
	}

	function get_dept()
	{
		if($this->input->is_ajax_request())
		{
			$asset_id = $this->input->post('asset_id',TRUE);
			$res = $this->common_model->get_data('property',array('prop_id'=>$asset_id),'prop_id,dept_id');
			echo json_encode($res);
		}
	}
}
