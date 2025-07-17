<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rpo_manager extends My_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('rpo_manager_model');
		$this->load->model('rpo_interview_model');
		$this->load->model('common_model');
		$this->config->load('hrms_config');
		$userdata = $this->session->userdata('logged_in_user');
		if(!$userdata)
		{
			$newURL = site_url()."/login";
			header('Location: '.$newURL);        		
		}        
	}

	function index()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());		
      $this->load_view("rpo_canlist","HRMS - RPO Employee List",$this->content);        
	}

	function list_rpocanlist()
	{
		$year = date('Y');
		$this->datatables->unset_column('can_id');
		$this->datatables->select('can_id, can_name, email_id, phone1');
		$this->datatables->from('rpo_candidates');
		$this->datatables->where('is_deleted',0);
		$update_url = site_url().'/rpo_manager/add_edit_rpo_candidate/$1';
      $view_url=site_url().'/rpo_manager/view/$1';
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn-success btn_edit"><span class="glyphicon glyphicon-pencil"></span></a> <a onClick="delete_candidate($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_delete" ><span class="glyphicon glyphicon-trash"></span></a>', 'can_id');		      
		$result= $this->datatables->generate();
		echo $result;
	}

	function add_edit_rpo_candidate()
	{
		// user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
	 	$this->content->percentage = $this->check_per_profile_complete();
	 	// x_debug($this->content->percentage);
    	$rpocan_id = $this->uri->segment(3);
		$this->content->rpo_can_details = $this->common_model->get_data('rpo_candidates',array('can_id'=>$rpocan_id,'is_deleted'=>0));
		if(!empty($_POST))
		{
			$post = $this->input->post();	
			$can_id = $this->input->post('can_id',true);
			$default_password = password_hash("raoson1234", PASSWORD_DEFAULT);
			$rpo_can_data = array(
											'can_name' => trim($this->input->post('can_name',true)),
											'cur_address' => trim($this->input->post('cur_address',true)),
											'per_address' => trim($this->input->post('per_address',true)),
											'email_id' => $this->input->post('email',true),
											'password' => password_hash("raoson1234", PASSWORD_DEFAULT),
											'phone1' => $this->input->post('phone1',true),
											'phone2' => $this->input->post('phone2',true),
											'education_qualification' => $this->input->post('education_qualification',true),
											'emer_contact_name' => $this->input->post('emer_contact_name',true),
											'emer_contact_no' => $this->input->post('emer_contact_no',true),
											'pan_no' => $this->input->post('pan_no',true),
											'aadhar_no' => $this->input->post('aadhar_no',true),
											'blood_group' => $this->input->post('blood_group',true),
											'designation' => $this->input->post('designation',true),
											'department' => $this->input->post('department',true),
											'dob' => date_to_db($this->input->post('dob',true)),
											'joining_date' => date_to_db($this->input->post('joining_date',true)),
											'job_type' => $this->input->post('job_type',true)
										);
			if(!empty($can_id))
			{
 				$rpo_can_data = set_log_fields($rpo_can_data);
				$this->common_model->update('rpo_candidates',$rpo_can_data,array('can_id' => $can_id));
				$this->session->set_flashdata('success', 'RPO Candidate Added Successfully!');
			}
			else
			{
				$rpo_can_data=set_log_fields($rpo_can_data,'insert');
				$this->common_model->insert('rpo_candidates',$rpo_can_data);
				$this->session->set_flashdata('success', 'RPO Candidate Updated Successfully!');
			}
			redirect('rpo_manager');
		}
      $this->load_view("add_edit_rpo_candidate","HRMS - Add Edit RPO Employee Details",$this->content); 
	}
	

	function get_rpocan_list()
	{
      $match = $_GET['term'];
		$query = $this->db->select('can_id as id,can_name as text,job_type')->like('can_name',$match,'both')->limit(10)->get("rpo_candidates");
		$json = $query->result();
		echo json_encode($json);
	}

	function get_rpoclient_list()
	{
      $match = $_GET['term'];
		$query = $this->db->select('client_id as id,client_name as text,contact_email')->like('client_name',$match,'both')->limit(10)->get("rpo_client_details");
		$json = $query->result();
		echo json_encode($json);
	}

	function get_project_by_client()
	{
		if($this->input->is_ajax_request())
		{
			$client_id = $this->input->post('client_id');
			$projects = $this->common_model->get_data_array('rpo_contract',array('client_id' => $client_id,'is_deleted' => 0));
			foreach ($projects as $key => $value) {			
				$proj_title = ucwords(strtolower($value['proj_title']));
				$selected ='';
				if($value['client_id'] == $client_id) $selected = 'selected="selected"';
				$data .='<option '. $selected .' value='.$value['client_id'].'>'.$proj_title.'</option>';			
		}
     	echo ($data);
		}
	}

	public function rpoemp_salary_details($msg="")
	{
		// user_access_page($this->router->fetch_class(),$this->router->fetch_method());
		$this->load_view("rpoemp_salary_details","HRMS - Employee Salary Details",$this->content);        
	}

	function list_emp_salarydetails()
	{  
		$this->datatables->unset_column('rpo_sal_id');
		$this->datatables->select('rpo_sal_id, can_name, hourly_rate, effective_from, effective_to');
		$this->datatables->from('rpoemp_salary_details');
		$this->datatables->join('candidate', 'rpoemp_salary_details.can_id = candidate.can_id', 'left');
		$this->datatables->where('rpoemp_salary_details.is_deleted',0);
		$this->datatables->where('candidate.is_deleted',0);
		$this->datatables->where('candidate.can_type','rpo');
		// $this->db->order_by("rpo_sal_id", "desc");
		$update_url = site_url().'/rpo/add_edit_rpo_emp_salary_details/$1';
      $view_url=site_url().'/rpo/view/$1';		
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_rposaldetails($1)" class="tabledit-delete-button btn btn-sm swal-btn-cancel btn-danger btn_edit" ><span class="glyphicon glyphicon-trash"></span></a><a href="'.$view_url.'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>', 'rpo_sal_id');
		$result= $this->datatables->generate();
		echo $result;
   }
/*not in use now
	function add_edit_rpo_emp_salary_details()
	{

		$rpo_sal_id = $this->uri->segment(3);

		if(!empty($rpo_sal_id))
		{
			if($this->common_model->count_all($tablename='rpoemp_salary_details', $conditions = array('rpo_sal_id' =>$rpo_sal_id)) == 0 )
			{
				redirect('Record_not_found');
			}
			else
			{
				$this->content->rpoempsalary_details = $this->rpo_manager_model->get_rpocan_salary_details($rpo_sal_id);
			}
		}
		// x_debug($this->content->rpoempsalary_details);
		$this->content->rpo_candidates = $this->common_model->get_form_dropdown($tablename = 'candidate', $fields = array('can_id','can_name'),$conditions = array('is_deleted' => 0,'can_type'=>'rpo'));

			if(!empty($this->input->post()))
			{
				echo $rpo_sal_id = $this->content->rpoempsalary_details->rpo_sal_id;
				unset($post['joining_date']);

				$salary_data = array('can_id' => $this->input->post('can_id',true),'designation' => $this->input->post('designation',true),'department' => $this->input->post('department',true), 'hourly_rate' => $this->input->post('hourly_rate',true));

				$effective_from = str_replace('/', '-', $this->input->post('effective_from',true));
				if(!empty($effective_from) && !empty(strtotime($effective_from)))
				{
					$salary_data['effective_from'] = date('Y-m-d', strtotime($effective_from));
				}

				$effective_to = str_replace('/', '-',$this->input->post('effective_to',true));
				if(!empty($effective_to) && !empty(strtotime($effective_to)))
				{
					$salary_data['effective_to'] = date('Y-m-d', strtotime($effective_to));
				}

				$salary_data['created_on'] = date('Y-m-d');
				if(!empty($rpo_sal_id))
				{
    				$salary_data = set_log_fields($salary_data);
					$this->common_model->update('rpoemp_salary_details',$salary_data,array('rpo_sal_id' => $rpo_sal_id));
					$this->session->set_flashdata('success', 'RPO Salary Details Updated Successfully!');
				}
				else
				{
    				$salary_data=set_log_fields($salary_data,'insert');

					$this->common_model->insert('rpoemp_salary_details',$salary_data);
					$this->session->set_flashdata('success', 'RPO Salary Details Added Successfully!');
				}				
				redirect('rpo/rpoemp_salary_details');
			}
		
      $this->load_view("add_edit_rpo_salarydetails","HRMS - Add RPO Employee Salary Details",$this->content);        
	}
*/
	function get_can_details()
	{
		if($this->input->is_ajax_request())
		{
			$rpo_can_id = $this->input->post('rpo_can_id');
			$rpocan_details=$this->common_model->get_data('rpo_candidates',array('can_id'=>$rpo_can_id,'is_deleted' => 0),'designation,department,joining_date');
			// if(empty($rpocan_details['joining_date']))
			// {
			// 	echo json_encode(array("msg"=>"Please update profile first!"));
			// }
			// else
			// {
        	 echo json_encode($rpocan_details);
			// }
      }	
	}  


	function generate_rposalary_slip()
	{
		// user_access_page($this->router->fetch_class(),$this->router->fetch_method());
		$this->content->rpo_candidates = $this->common_model->get_form_dropdown($tablename = 'rpo_candidates',array('can_id','can_name'), array('is_deleted' => 0));
		// x_debug($this->content->candidates);

		if(!empty($this->input->post()))
		{
			$salary_slip_data = array('can_id' => $this->input->post('can_id',true),'month' => $this->input->post('month',true),'year' => $this->input->post('year',true), 'paid_hours' => $this->input->post('paid_hours',true), 'tds' => $this->input->post('tds',true), 'total_earnings' => $this->input->post('total_earnings',true), 'total_deduction' => $this->input->post('total_deduction',true), 'net_pay' => $this->input->post('net_pay',true));
			// x_debug($salary_slip_data);
			
			// $salary_slip_data['created_on'] = date('Y-m-d');
			// if(!empty($this->get_rpocan_saldetails()))
			// {
				$salary_slip_data=set_log_fields($salary_slip_data,'insert');
				if($this->rpo_manager_model->generate_salary_slip($salary_slip_data))
				{				
					$this->session->set_flashdata('success', 'RPO Employee Salary Slip Generated Successfully!');
					redirect('rpo_manager/all_salary_slips');
				}
			// }
			// else
			// {
			// 	$error = $this->session->set_flashdata('error', 'Salary slip already generated for this employee!');
			// 	redirect('rpo/generate_salary_slip', $error);
			// }
		}
      $this->load_view("rpo_salary_slip","HRMS - Generate Salary Slip",$this->content);        
	}

	function get_rpocan_saldetails()
	{		
		$can_id = $this->input->post('can_id');
		$month = $this->input->post('month');
		$year = $this->input->post('year');

		$rpo_can_salary_details['is_salaryslip_exist'] = $this->common_model->count_all('rpoemp_salary_slip', array('can_id'=>$can_id,'month'=> $month,'year'=>$year,'is_deleted'=>0));

		$rpo_can_salary_details['profile_details'] = $this->common_model->get_data('candidate',array('can_id'=>$can_id,'can_type'=>'rpo', 'is_deleted' => 0),'can_id,can_name,email,joining_date,designation,department,');

		$rpo_can_salary_details['salary'] = $this->common_model->get_data('rpoemp_salary_details',array('can_id'=>$can_id,'is_deleted' => 0),'can_id,hourly_rate,effective_from,effective_to');
		// debug($rpo_can_salary_details);

		if($this->input->is_ajax_request())
		{
			if($rpo_can_salary_details['is_salaryslip_exist'] > 0)
			{
				echo json_encode(array("msg"=>"1"));
			}
			else if(empty(strtotime($rpo_can_salary_details['profile_details']['joining_date'])))
			{
				echo json_encode(array("msg"=>"2"));
			}
			else if(empty($rpo_can_salary_details['salary']))
			{
				echo json_encode(array("msg"=>"3"));
			}
			else
			{
				echo json_encode($rpo_can_salary_details);
			}	
		}
		else
		{
			return $rpo_can_salary_details;
		}
	}

	function view_salaryslip()
	{
		$userdata = $this->session->userdata('logged_in_user');       
		$this->load_view("rpocan_salaryslip","HRMS - Employee Salary Slip",$this->content);
	}

	function salary_slip_details()
	{
		$can_id = $this->uri->segment(3);
		$this->content->can_details = $this->get_candidate_name_by_id($can_id);
		// $this->content->salary_slip_details = $this->candidate_model->get_salary_slip_details($can_id);     
		$this->load_view("salary_slip_details","HRMS - Employee Salary Slip Details",$this->content);
	}

	function delete_rposaldetails()
   {
		if($this->input->is_ajax_request())
		{
			$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
         if(!empty($access))
         {
            echo "0";
         }
         else
         {
				$rpo_sal_id = $this->input->post('rpo_sal_id');
				$this->common_model->update('rpoemp_salary_details',array('is_deleted' =>1),array('rpo_sal_id' => $rpo_sal_id));
				echo "1";
			}
		}
   }

 
	function all_salary_slips()
	{
		// user_access_page($this->router->fetch_class(),$this->router->fetch_method());
		$this->load_view("monthly_rposalary_slips","HRMS - All Salary Slips",$this->content);        
	}

	function list_monthly_salaryslips()
	{  
		$this->datatables->unset_column('rpo_sal_id');
		$this->datatables->select('rpo_sal_id, can_name, month, year,paid_hours,net_pay');
		$this->datatables->from('rpoemp_salary_slip');
		$this->datatables->join('rpo_candidates', 'rpoemp_salary_slip.can_id = rpo_candidates.can_id', 'left');
		$this->datatables->where('rpoemp_salary_slip.is_deleted',0);
		$this->db->order_by("rpo_sal_id", "desc");
		$update_url = site_url().'/rpo_manager/update_salary_slip/$1';
		$view_url=site_url().'/rpo_manager/view_salary_slip/$1';
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_salaryslip($1)" class="tabledit-delete-button btn btn-sm swal-btn-cancel btn-danger" ><span class="glyphicon glyphicon-trash"></span></a> <a href="'.$view_url.'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>', 'rpo_sal_id');
		$result= $this->datatables->generate(); 
		// echo $this->db->last_query();exit; 
		echo $result;
   }

   function delete_salaryslip()
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
				$rpo_sal_id = $this->input->post('rpo_sal_id');
				$this->candidate_model->delete($tablename='rpoemp_salary_slip',$fieldname ='rpo_sal_id',$rpo_sal_id);
				echo "1";
			}
		}
   }

   function update_salary_slip()
   {
		// user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
   	$salary_slip_id = $this->uri->segment(3);
   	$this->content->rpoempsalary_details = $this->rpo_manager_model->get_salary_slip_details($salary_slip_id);
   	// x_debug($this->content->rpoempsalary_details);
		if(!empty($this->input->post()))
		{
			$post = $this->input->post();
			// x_debug($post);
			$salary_slip_data = $post;
			unset($post['joining_date'],$post['designation'],$post['department'],$post['effective_from'],$post['effective_to'],$post['hourly_rate']);
			
			if($this->rpo_manager_model->generate_salary_slip($salary_slip_data))
			{				
				$this->session->set_flashdata('success', 'Employee Salary Slip Generated Successfully!');
				redirect('rpo_manager/all_salary_slips');
			}
		}
		$this->load_view("rpo_salary_slip","HRMS - Edit Employee Salary Details",$this->content);
   }

	function view_salary_slip($rpo_sal_id)
	{
		if(!empty($rpo_sal_id))
		{
			$this->load->library('pdfgenerator');
			$data['salary_slip'] = $this->rpo_manager_model->get_salary_slip_details($rpo_sal_id);

			if(isset($_GET['download']))
			{
				$output=$this->load->view('pdf_downlaod/rpo_salary_slip_pdf',$data,true);
				$this->pdfgenerator->generate($output,'Salary slip of month '.$data['salary_slip']['month'].'-'.$data['salary_slip']['year']);
			}
			else
			{
				$this->content->rpoempsalary_details = $data['salary_slip'];
				// $this->content->candidate_data=$data['candidate_data'];
				$this->load_view('salary_slip_view','Salary Slip View',$data);
				//$this->load->view('',$data);
			}
		}
		else
		{
			echo "invalid arguements";
		}
	}

	//function to view salary slip 
	public function view()
	{
		// user_access_operation($this->router->fetch_class(),$this->router->fetch_method());  
		$userdata = $this->session->userdata('logged_in_user');
		$rpo_sal_id = (int)$this->uri->segment(3);  
		if(!empty($rpo_sal_id))
		{
			if($this->common_model->count_all($tablename='rpoemp_salary_details', $conditions = array('rpo_sal_id' =>$rpo_sal_id)) == 0 )
			{
				redirect('Record_not_found');
			}
			else
			{
				$this->content->rpoempsalary_details = $this->rpo_manager_model->get_rpocan_salary_details($rpo_sal_id);
			}
		}
		$this->load_view("salary_details_view","HRMS - RPO Salary Slip",$this->content);
	}

	function delete_candidate()
	{
		if ($this->input->is_ajax_request())
		{
			/*$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
			$access=0;
			if(!empty($access))
			{
				echo "0";
			}
			else
			{*/
				$can_id = $this->input->post('rpo_can_id');
				$this->common_model->update($tablename='rpo_candidates',array('is_deleted'=>1), array('can_id' => $can_id ));
				echo "1";   
			// } 
		}
	}

	/*  ===========  Client Contract/Projects Functionality Start  ==========  */

	function client_list()
	{
		// user_access_page($this->router->fetch_class(),$this->router->fetch_method());		
		$this->load_view('client_list',"HRMS - RPO Client",$this->content);
	}

	function client_list_fetch()
	{
		// user_access_page($this->router->fetch_class(),$this->router->fetch_method());		
		$this->datatables->unset_column('client_id');
		$this->datatables->select('client_id, client_name, contact_number,contract_status');
		$this->datatables->from('rpo_client_details');
		$this->datatables->where('is_deleted',0);

		$update_url = site_url().'/rpo_manager/add_edit_client/$1';
		$view_url=site_url().'/rpo_manager/view/$1';

		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a> <a href="javascript:;" onClick="delete_client($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_edit"><span class="glyphicon glyphicon-trash"></span></a>', 'client_id');
		//<a href="'.$view_url.'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>
		echo $result= $this->datatables->generate();  
		// x_debug($result);
	}

	function add_edit_client()
	{
		$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		$access=0;
		if(!empty($access))
		{
			$this->session->set_flashdata('warning', 'Access Denied');
			redirect('rpo_manager');
		}
		else
		{
			$client_id = $this->uri->segment(3);
			if(!empty($client_id))
			{
				if($this->common_model->count_all($tablename='rpo_client_details', $conditions = array('client_id' =>$client_id)) == 0 )
				{
					redirect('Record_not_found');
				}
				else
				{
					$this->content->client_details = $this->common_model->get_data('rpo_client_details',array('client_id' => $client_id),'*');
				}			
			}
			if(!empty($this->input->post()))
			{
				// x_debug($_POST);exit;
				$client_id=$this->input->post('client_id');
				$userdata = $this->session->userdata('logged_in_user');
				$now=date('Y-m-d');
				$client_data=array(
					'client_name'=>$this->input->post('client_name'),
					'contact_name'=>$this->input->post('contact_name'),
					'contact_number'=>$this->input->post('contact_number'),
					'contact_email'=>$this->input->post('contact_email'),
					'contract_sign_date'=>(!empty($this->input->post("contract_sign_date"))) ? date_to_db($this->input->post("contract_sign_date")) : '',
					'contract_status'=>$this->input->post('contract_status'),
					'contract_from_date'=>(!empty($this->input->post("contract_from_date"))) ? date_to_db($this->input->post("contract_from_date")) : '',
					'contract_end_date'=>(!empty($this->input->post("contract_end_date"))) ? date_to_db($this->input->post("contract_end_date")) : ''
				);

				if(!empty($client_id)){
					$client_data = set_log_fields($client_data,'update');
					$this->common_model->update('rpo_client_details',$client_data,'client_id='.$client_id);
					$this->session->set_flashdata('success', 'Client Details Updated Successfully!');
				}
				else
				{
					$client_data = set_log_fields($client_data,'insert');			
					$this->common_model->insert('rpo_client_details',$client_data);
					$this->session->set_flashdata('success', 'Client Details Added Successfully!');
				}
				redirect('rpo_manager/client_list');			
			}
			$this->load_view("add_client_details","HRMS - Add Edit RPO Client",$this->content);
		}
	}

	function delete_client()
	{
		if ($this->input->is_ajax_request())
		{
			$client_id = $this->input->post('client_id');
			$this->common_model->update('rpo_client_details',array('is_deleted'=>1),array('client_id'=>$client_id));
			echo "1";
		}
	}

	function project_list()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());		
		$this->load_view('contract_list',"HRMS - RPO Client Projects",$this->content);
	}

	function contract_list_fetch()
	{
		$this->datatables->unset_column('proj_id');
		$this->datatables->select('proj_id, proj_title,proj_type,client_name, project_status, CASE WHEN project_status= 1 THEN \'Active\' ELSE \'Closed\' END AS project_status');
		$this->datatables->from('rpo_contract');
		$this->datatables->join('rpo_client_details rc', 'rc.client_id = rpo_contract.client_id', 'left');
		$this->datatables->where('rpo_contract.is_deleted',0);
		$update_url = site_url().'/rpo_manager/add_edit_contract/$1';
		$view_url=site_url().'/rpo_manager/view/$1';

		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a> <a href="javascript:;" onClick="delete_contract($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_edit"><span class="glyphicon glyphicon-trash"></span></a>', 'proj_id');
		//<a href="'.$view_url.'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>
		echo $result= $this->datatables->generate();  
		// x_debug($result);
	}

	function add_edit_contract()
	{
		$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		$access=0;
		if(!empty($access))
		{
			$this->session->set_flashdata('warning', 'Access Denied');
			redirect('rpo_interview');
		}
		else
		{ 
			$proj_id = $this->uri->segment(3);

			if(!empty($proj_id))
			{
				if($this->common_model->count_all($tablename='rpo_contract', $conditions = array('proj_id' =>$proj_id)) == 0 )
				{
					redirect('Record_not_found');
				}
				else
				{
					$this->content->contract_details = $this->rpo_interview_model->get_contract_details($proj_id);
					// x_debug($this->content->contract_details);
				}			
			}
			if(!empty($this->input->post()))
			{
				$proj_id=$this->input->post('proj_id');
				$userdata = $this->session->userdata('logged_in_user');
				$now=date('Y-m-d');
				$contract_data = array(
										'client_id'=>$this->input->post('client_name'),
										'proj_title'=>$this->input->post('proj_title'),
										'proj_type'=>$this->input->post('proj_type'),
										'job_profile'=>$this->input->post('job_profile'),
										'job_description'=>$this->input->post('job_description'),
										'no_of_position'=>$this->input->post('no_of_position'),
										'job_location'=>$this->input->post('job_location'),
										'proj_start_date'=>(!empty($this->input->post("proj_start_date"))) ? date_to_db($this->input->post("proj_start_date")) : '',
										'proj_end_date'=>(!empty($this->input->post("proj_end_date"))) ? date_to_db($this->input->post("proj_end_date")) : '',
										'contact_name'=>$this->input->post('contact_name'),
										'contact_number'=>$this->input->post('contact_number'),
										'contact_email'=>$this->input->post('contact_email'),
										'client_rate'=>$this->input->post('client_rate'),
										'offered_rate'=>$this->input->post('offered_rate'),
										'project_status'=>$this->input->post('project_status'),
									);

				if(!empty($proj_id))
				{
					$contract_data = set_log_fields($contract_data,'update');
					$this->common_model->update('rpo_contract',$contract_data,'proj_id='.$proj_id);
					$this->session->set_flashdata('success', 'Contract Details Updated Successfully!');
					redirect('rpo_manager/project_list');			
				}
				else
				{
					$contract_data = set_log_fields($contract_data,'insert');			
					$this->common_model->insert('rpo_contract',$contract_data);
					$this->session->set_flashdata('success', 'Contract Details Added Successfully!');
					redirect('rpo_manager/project_list');			
				}
			}
			$this->load_view("add_contract_details","HRMS - Add Edit RPO Contract",$this->content);
		}
	}

	function delete_contract()
	{
		if ($this->input->is_ajax_request())
		{
			$proj_id = $this->input->post('proj_id');
			$this->common_model->update('rpo_contract',array('is_deleted'=>1),array('proj_id'=>$proj_id));
			echo "1";
		}
	}

	/*  ===========  Client Contract/Projects Functionality End  ==========  */


	function fetch_client()
	{
		echo json_encode($this->common_model->get_data_array('rpo_client_details',array('is_deleted'=>0,'contract_end_date > '=> date('Y-m-d')),'client_id,client_name'));
	}


	/* ======  Employee Bank Details ====== */

	function bank_details()
	{
		//user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		$this->content->percentage = $this->check_per_profile_complete();  
		$can_id = $this->uri->segment(3);
		check_record_exist($tablename='rpo_candidates', $conditions = array('can_id' =>$can_id));
		$this->content->can_details = $this->common_model->get_data_by_field('rpo_candidates','can_name', array('can_id' =>$can_id));
		$this->content->can_bank_details =  $this->common_model->get_data('rpo_bank_details', array('can_id' => $can_id));
		// x_debug($this->content->can_bank_details);
		$this->load_view("bank_details","HRMS - Employee Bank Details",$this->content);
	}


	function upload_bank_details()
	{
		if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$can_id = $this->input->post('can_id', true);
			$bd_id = $this->input->post('bd_id', true);
			$bank_name = $this->input->post('bank_name', true);
			$branch_name = $this->input->post('branch_name', true);
			$account_number = $this->input->post('account_number', true);
			$IFSC_code = strtoupper($this->input->post('IFSC_code', true));
			$old_bank_statement = $this->input->post('old_bank_statement', true);
			$upload_path = RPOUPLOADPATH; //set your folder path
			if(!is_dir($upload_path))
			{
				mkdir($upload_path , 777);
			}

			$can_doc_path = $upload_path."/";
			if( ! is_dir($can_doc_path))
			{
				mkdir($can_doc_path, 0766, true);
			}
			//set the valid file extensions 
			$valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "GIF", "JPG", "PNG", "doc", "txt", "docx", "pdf", "xls", "xlsx"); //add the formats you want to upload

			if (!empty($_FILES))
			{
				$name = $_FILES['myfile']['name']; //get the name of the file
				$size = $_FILES['myfile']['size']; //get the size of the file
				//check if the file is selected or cancelled after pressing the browse button.
				list($txt, $ext) = explode(".", $name); //extract the name and extension of the file
				if (in_array($ext, $valid_formats))
				{ 
					//if the file is valid go on.
					if ($size < 2098888)
					{
						// check if the file size is more than 2 mb
						// $file_name = $_POST['filename']; //get the file name
						$tmp = $_FILES['myfile']['tmp_name'];
						if (move_uploaded_file($tmp, $can_doc_path . time().'acc_statement'.'.'.$ext))
						{ 
							//check if it the file move successfully, then insert into database
							$data  = array('can_id' => $can_id,'bd_id' => $bd_id, 'bank_name' => $bank_name,'branch' => $branch_name,'account_number' => $account_number,'ifsc'=>$IFSC_code,'bank_statement_path' => $can_doc_path,'bank_statement_name'=>time().'acc_statement'.'.'.$ext);
							if($bd_id>0)
							{
								$data=set_log_fields($data);
								$this->common_model->update('rpo_bank_details',$data,array('bd_id'=>$bd_id));
							}
							else
							{
								$data=set_log_fields($data,'insert');
								$this->common_model->insert('rpo_bank_details',$data);
								if($can_id==get_login_user_id())
								{
									//user_activity_log($data = array('can_id' => get_login_user_id(),'table_name' => 'rpo_bank_details' ,"operation_name" => 'update' ,'controller'=> $this->router->fetch_class(),'method'=> 'update','last_modified_on'=> date('Y-m-d h:i:s'),'last_modified_by' => get_login_user_id(),'comment' => 'Bank Details Uploaded'));
								}
							}
							// print_r($data);exit;
							// $this->candidate_model->save_bank_details($data);

							//echo  json_encode(array("msg"=>"Bank details updated successfully!"));                         
							// redirect('candidate/bank_details/'.$can_id);
							echo "1";
						} 
						else
						{
							echo "2";
						}
					}
					else
					{
						echo "3";
					}
				}
				else
				{
					echo "4";
				}
			}
			else if($old_bank_statement != NULL)
			{
				$data  = array('can_id' => $can_id,'bd_id' => $bd_id, 'bank_name' => $bank_name,'branch' => $branch_name,'account_number' => $account_number,'ifsc'=>$IFSC_code);
				$data = set_log_fields($data);
				$res = $this->common_model->update('rpo_bank_details',$data,array('bd_id'=>$bd_id));
				if($res == true)
				{
					// if($can_id==get_login_user_id())
					// {
						//user_activity_log($data = array('can_id' => get_login_user_id(), 'table_name' => 'rpo_bank_details' ,"operation_name" => 'update' ,'controller'=> $this->router->fetch_class(),'method'=> 'update','last_modified_on'=> date('Y-m-d h:i:s'),'last_modified_by' => get_login_user_id(),'comment' => 'Bank Details Updated'));
					// }
					echo "1";
				}
				else
				{
					echo "5";
				}
			}
			else
			{
				echo "Please select a file..!";
			}
			exit;
		}  
	}



    /* ======  Employee Document Details ====== */


   function documents()
   {
		$this->content->percentage = $this->check_per_profile_complete();  
		//user_access_operation($this->router->fetch_class(),$this->router->fetch_method());         
		$this->load_view("documents","HRMS - Employee Documents",$this->content); 
   }

   function document_details($can_id = '')
   {
		$this->datatables->unset_column('doc_id');
		$this->datatables->unset_column('file_name');
		$this->datatables->select('doc_id,doc_name,file_name');
		$this->datatables->from('rpo_documents');
		$this->datatables->where('can_id',$can_id);
		$this->datatables->where('is_deleted',0);
		// $this->db->order_by("doc_id", "desc");
		$this->datatables->add_column('edit', '<button type="button" class="tabledit-delete-button btn-danger btn btn-sm btn_delete_bill" value="$1" style="float: none;" onClick="delete_data($1)"><span class="glyphicon glyphicon-trash"></span></button>', 'doc_id');
		$this->datatables->add_column('file_name', '<a href="'.RPOUPLOADPATH.'$2" download>$1</a>', 'doc_name,file_name');
		$result= $this->datatables->generate();  
		echo $result;
    }

   function add_document()
   {
		$this->content->percentage = $this->check_per_profile_complete();  
		$can_id = $this->uri->segment(3);
		$this->content->can_details = $this->common_model->get_data_by_field('rpo_candidates','can_name', array('can_id' =>$can_id));
		$this->load_view("add_document","HRMS - Upload New Document",$this->content);
	}

   function upload_document()
   {
		$can_id = $_POST['can_id'];
		if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$upload_path = RPOUPLOADPATH; //set your folder path
			if(!is_dir($upload_path))
			{
				mkdir($upload_path , 777,true);
			}

			/*  echo $can_doc_path = "/var/www/html/hrms/uploads/".$can_id."/";
			if( ! is_dir($can_doc_path)){
			mkdir($can_doc_path, 0777, true);
			}*/
			//set the valid file extensions 
			$valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "GIF", "JPG", "PNG", "doc", "txt", "docx", "pdf", "xls", "xlsx"); //add the formats you want to upload

			$name = $_FILES['myfile']['name']; //get the name of the file            
			$size = $_FILES['myfile']['size']; //get the size of the file         
			if (strlen($name))
			{ 
				//check if the file is selected or cancelled after pressing the browse button.
				list($txt, $ext) = explode(".", $name); //extract the name and extension of the file
				if (in_array($ext, $valid_formats))
				{ 
					//if the file is valid go on.
					if ($size < 2098888)
					{
						// check if the file size is more than 2 mb
						$file_name = $_POST['filename']; //get the file name
						$tmp = $_FILES['myfile']['tmp_name'];
						if (move_uploaded_file($tmp, $upload_path . time().$file_name.'.'.$ext))
						{ 
							//check if it the file move successfully, then insert into database
							$data  = array('can_id' => $can_id, 'doc_name' => $file_name,'file_name'=>time().$file_name.'.'.$ext,'doc_path' => $upload_path,'thumb_path'=>$upload_path);
							$data=set_log_fields($data,'insert');
							$this->common_model->insert('rpo_documents',$data);  
							//user_activity_log($data = array('can_id' => get_login_user_id(), 'table_name' => 'documents' ,"operation_name" => 'update' ,'controller'=> $this->router->fetch_class(),'method'=> 'update','last_modified_on'=> date('Y-m-d h:i:s'), 'last_modified_by' => get_login_user_id(),'comment' => 'Document Uploaded'));

							$result = $this->candidate_model->get_all_documents($can_id);
							// print_r($result);exit;
							// echo  json_encode(array("result"=>$result,"msg"=>"File uploaded successfully!"));                         
							echo "1";
						} 
						else
						{
							echo "2";
						}
					}
					else
					{
						echo "3";
					}
				}
				else
				{
					echo "4";
				}
			}
			else
			{
				echo "Please select a file..!";
			}
			exit;
		}        
   }


    /* ======  RPO Employee Billing Details ====== */

	function billing()
	{
		// user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		$this->content->percentage = $this->check_per_profile_complete();  
		$can_id = $this->uri->segment(3);
		$this->content->can_details = $this->common_model->get_data_by_field('rpo_candidates','can_name', array('can_id' =>$can_id));
		// $this->content->billing_details = $this->candidate_model->get_billing_details($can_id);     
		$this->load_view("billing","HRMS - Employee Billing Details",$this->content);
	}

	function billing_details($can_id="")
	{
		$this->datatables->unset_column('bill_id');
		$this->datatables->unset_column('effective_from');
		$this->datatables->unset_column('effective_to');
		$this->datatables->select('bill_id,rate_type,amount,effective_from,effective_to,can_id');
		$this->datatables->from('rpo_billing');
		$this->datatables->where('can_id',$can_id);
		$this->datatables->where('is_deleted',0);
		// $this->db->order_by("bill_id", "desc");
		$update_url = site_url().'/rpo_manager/edit_billing_details/$1/$2';          

		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn_edit_bill btn-success"><span class="glyphicon glyphicon-pencil"></span></a> <a type="button" class="tabledit-delete-button btn-danger btn btn-sm btn_delete_bill" value="$1" style="float: none;" onClick="delete_data($1)"><span class="glyphicon glyphicon-trash"></span></a>', 'bill_id,can_id');
		$result= $this->datatables->generate();
		echo $result;
	}


   function add_billing()
   {
		$this->content->percentage = $this->check_per_profile_complete();  
		// $access = user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		// if(!empty($access))
		// {
		//     redirect('access_denied');
		// }
		// else
		// {
		$can_id = $this->uri->segment(3);
		$this->content->can_details = $this->common_model->get_data_by_field('rpo_candidates','can_name,intw_can_id', array('can_id' =>$can_id));
		$this->content->interview_details  = $this->rpo_interview_model->get_rpo_details($this->content->can_details->intw_can_id);
		// x_debug($this->content->interview_details);
		$this->load_view("add_billing","HRMS - Add Billing Details",$this->content);    
		// }
   }

   function add_billing_details()
   {
      $this->content->percentage = $this->check_per_profile_complete();
		if ($this->input->is_ajax_request())
		{ 
			$post = $this->input->post();
			// x_debug($post);
			$billing_details = array('bill_id' => (isset($post['bill_id']) && !empty($post['bill_id'])) ? $post['bill_id'] : '','can_id' => $post['can_id'],'rate_type' => $post['rate_type'], 'amount' => $post['amount'],'client_id' => $post['client_id'],'project_id' => $post['project_id'],'effective_from' => date('Y-m-d', strtotime(str_replace('/', '-', $post['from_date']))),'effective_to' => date('Y-m-d', strtotime(str_replace('/', '-', $post['to_date']))),'review_date' => date('Y-m-d', strtotime(str_replace('/', '-', $post['review_date']))));

			if($post['bill_id']>0)
			{
				$billing_details=set_log_fields($billing_details);
				$this->common_model->update('rpo_billing',$billing_details,array('bill_id'=>$post['bill_id']));
			}
			else
			{
				$billing_details=set_log_fields($billing_details,'insert');
				$this->common_model->insert('rpo_billing',$billing_details);
			}               
		}        
   }

   function edit_billing_details()
   {
		$this->content->percentage = $this->check_per_profile_complete(); 

		//$access = user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		// if(!empty($access))
		// {
		//     redirect('access_denied');
		// }
		// else
		// {
		$bill_id = $this->uri->segment(3);
		$can_id = $this->uri->segment(4);
		$this->content->can_details = $this->common_model->get_data_by_field('rpo_candidates','can_name,intw_can_id', array('can_id' =>$can_id));
		$this->content->interview_details  = $this->rpo_interview_model->get_rpo_details($this->content->can_details->intw_can_id); 
		// x_debug($this->content->interview_details);

		// $is_exist = check_record_exist($tablename='rpo_billing', $conditions = array('can_id' =>$can_id,'bill_id' => $bill_id),true);
		// if($is_exist==1)
		// {
		//     redirect('Record_not_found');
		// }
		// else
		// {            
		$this->content->can_details = $this->common_model->get_data_by_field('rpo_candidates','can_name', array('can_id' =>$can_id));
		$this->content->billing_details = $this->common_model->get_data('rpo_billing', array('can_id' => $can_id,'bill_id' => $bill_id,'is_deleted' => 0));
		$this->load_view("edit_billing","HRMS - Edit Employee Billing Details",$this->content);
		// }
		// }
   }


   /* ======  RPO Employee Salary Slips Genaration  ====== */

	function salary_slips()
	{
		// user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		$this->content->percentage = $this->check_per_profile_complete();  
		$can_id = $this->uri->segment(3);
		$this->content->can_details = $this->common_model->get_data_by_field('rpo_candidates','can_name', array('can_id' =>$can_id));
		// $this->content->billing_details = $this->candidate_model->get_billing_details($can_id);     
		$this->load_view("salary_slips","HRMS - RPO Employee Salary Slips",$this->content);
	}

	function salary_slip_list($can_id="")
	{
		$this->datatables->unset_column('rpo_sal_id');
		$this->datatables->unset_column('can_id');
		// $this->datatables->unset_column('effective_from');
		// $this->datatables->unset_column('effective_to');
		$this->datatables->select('rpo_sal_id,can_name,month,year,paid_hours,net_pay,rpo_candidates.can_id');
		$this->datatables->from('rpoemp_monthlysalary_slip');
		$this->datatables->join('rpo_candidates', 'rpoemp_monthlysalary_slip.can_id = rpo_candidates.can_id', 'left');
		$this->datatables->where('rpo_candidates.can_id',$can_id);
		$this->datatables->where('rpoemp_monthlysalary_slip.is_deleted',0);
		// $this->db->order_by("rpo_sal_id", "desc");
		$update_url = site_url().'/rpo_manager/edit_salary_slip/$1/$2';          

		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn_edit_bill btn-success"><span class="glyphicon glyphicon-pencil"></span></a> <a type="button" class="tabledit-delete-button btn-danger btn btn-sm btn_delete_bill" value="$1" style="float: none;" onClick="delete_data($1)"><span class="glyphicon glyphicon-trash"></span></a>', 'rpo_sal_id,can_id');
		$result= $this->datatables->generate();
		echo $result;
	}


   function generate_salary_slip()
   {
		$this->content->percentage = $this->check_per_profile_complete();  
		// $access = user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		// if(!empty($access))
		// {
		//     redirect('access_denied');
		// }
		// else
		// {
		$can_id = $this->uri->segment(3);
		$this->content->can_details = $this->common_model->get_data_by_field('rpo_candidates','can_name,intw_can_id,can_name,joining_date,designation,department', array('can_id' =>$can_id));
		// x_debug($this->content->can_details);

		$this->content->billing_details  = $this->common_model->get_data_row_order_by('rpo_billing',array('can_id'=>$can_id,'is_deleted'=>0),'*',array('bill_id','desc'),1);
			// $interview_status = $this->common_model->get_data_row_order_by('rpo_interview_manager',array('intw_can_id'=>$intw_can_id),'intw_can_id,interview_status',array('inw_mid','desc'),1);
		// x_debug($this->content->billing_details);
		$this->load_view("generate_rpo_salary_slip","HRMS - Add Billing Details",$this->content);    
		// }
   }

   function add_salary_slip()
   {
      $this->content->percentage = $this->check_per_profile_complete();
		if ($this->input->is_ajax_request())
		{ 
			$post = $this->input->post();
			// x_debug($post);
			$salary_details = array('can_id' => (isset($post['can_id']) && !empty($post['can_id'])) ? $post['can_id'] : '','paid_hours' => $post['paid_hours'],'month' => $post['month'], 'year' => $post['year'],'prof_tax' => $post['prof_tax'],'tds' => $post['tds'],'total_earnings' => $post['total_earnings'],'total_deduction' =>$post['total_deduction'] ,'net_pay'=> $post['net_pay']);

			if($post['rpo_sal_id']>0)
			{
				$salary_details=set_log_fields($salary_details);
				$this->common_model->update('rpoemp_monthlysalary_slip',$salary_details,array('rpo_sal_id'=>$post['rpo_sal_id']));
			}
			else
			{
				$billing_details=set_log_fields($billing_details,'insert');
				$this->common_model->insert('rpoemp_monthlysalary_slip',$salary_details);
			}               
		}        
   }

   function edit_salary_slip()
   {
		$this->content->percentage = $this->check_per_profile_complete(); 

		//$access = user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		// if(!empty($access))
		// {
		//     redirect('access_denied');
		// }
		// else
		// {
		$rpo_sal_id = $this->uri->segment(3);
		$can_id = $this->uri->segment(4);
		// $this->content->can_details = $this->common_model->get_data_by_field('rpo_candidates','can_name,intw_can_id', array('can_id' =>$can_id));
		// $this->content->interview_details  = $this->rpo_interview_model->get_rpo_details($this->content->can_details->intw_can_id); 
		// x_debug($this->content->interview_details);

		// $is_exist = check_record_exist($tablename='rpo_billing', $conditions = array('can_id' =>$can_id,'bill_id' => $bill_id),true);
		// if($is_exist==1)
		// {
		//     redirect('Record_not_found');
		// }
		// else
		// {            
		// $this->content->can_details = $this->common_model->get_data_by_field('rpo_candidates','can_name', array('can_id' =>$can_id));
		$this->content->salary_details = $this->common_model->get_data('rpoemp_monthlysalary_slip', array('can_id' => $can_id,'rpo_sal_id' => $rpo_sal_id,'is_deleted' => 0));
		$this->load_view("edit_salary_slip","HRMS - Edit Employee Billing Details",$this->content);
		// }
		// }
   }

         /* ======  Employee Insurance Details ====== */


	function insurance_details()
	{
		//user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		$this->content->percentage = $this->check_per_profile_complete();  
		$can_id = $this->uri->segment(3);
		//check_record_exist($tablename='insurance_details', $conditions = array('can_id' =>$can_id));
		$this->content->can_details = $this->common_model->get_data_by_field('rpo_candidates','can_name,joining_date', array('can_id' =>$can_id));
		$this->content->company_details = $this->common_model->get_data_array('insurance_company', array('is_deleted'=>0));		
	   // x_debug($this->content->company_details);

	   $this->content->can_insurance_details = $this->common_model->get_data('rpo_insurance_details', array('can_id' => $can_id,'is_deleted' => 0));
	   // x_debug($this->content->can_insurance_details);
		$this->load_view("insurance_details","HRMS - Employee Insurance Details",$this->content);
	}


	function upload_insurance_details()
	{
		if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			// print_r($_POST);
			$can_id = $this->input->post('can_id', true);
			$insurance_id = $this->input->post('insurance_id');
			$ins_start_date = date_to_db($this->input->post('ins_start_date'));
			$ins_expire_date = date_to_db($this->input->post('ins_expire_date'));
			$paid_by = $this->input->post('paid_by', true);
			$premium_amnt = $this->input->post('premium_amnt', true);
			$assured_amt = $this->input->post('assured_amt', true);
			$ins_comp_name = $this->input->post('ins_comp_name', true);
			$policy_no = $this->input->post('policy_no', true);
			$old_ins_doc = $this->input->post('old_ins_doc', true);
			$upload_path = RPOUPLOADPATH; //set your folder path
			if(!is_dir($upload_path))
			{
				mkdir($upload_path , 777);
			}

			$can_doc_path = $upload_path."insurance_doc/";
			if( ! is_dir($can_doc_path)){
				mkdir($can_doc_path, 0766, true);
			}
			//set the valid file extensions 
			$valid_formats = array( "doc", "txt", "docx", "pdf"); //add the formats you want to upload

			if (!empty($_FILES))
			{
				$name = $_FILES['myfile']['name']; //get the name of the file
				$size = $_FILES['myfile']['size']; //get the size of the file
				//check if the file is selected or cancelled after pressing the browse button.
				list($txt, $ext) = explode(".", $name); //extract the name and extension of the file
				if (in_array($ext, $valid_formats))
				{ 
					//if the file is valid go on.
					if ($size < 2098888)
					{
						// check if the file size is more than 2 mb
						// $file_name = $_POST['filename']; //get the file name
						$tmp = $_FILES['myfile']['tmp_name'];
						if (move_uploaded_file($tmp, $can_doc_path . time().'ins_doc'.'.'.$ext))
						{ 
							//check if it the file move successfully, then insert into database
							$data  = array('can_id' => $can_id,'ins_start_date' => $ins_start_date,'ins_expire_date' => $ins_expire_date,'premium_amnt' => $premium_amnt,'assured_amt'=>$assured_amt,'ins_comp_name'=>$ins_comp_name,'policy_no'=>$policy_no,'ins_doc_path' => $can_doc_path,'ins_doc_name'=>time().'ins_doc'.'.'.$ext);
							if($insurance_id>0)
							{
								$data = set_log_fields($data);
								$this->common_model->update('rpo_insurance_details',$data,array('insurance_id'=>$insurance_id));
							}
							else
							{
								$data=set_log_fields($data,'insert');
								$this->common_model->insert('rpo_insurance_details',$data);
								/*if($can_id==get_login_user_id())
								{
									user_activity_log($data = array('can_id' => get_login_user_id(),'table_name' => 'insurance_details' ,"operation_name" => 'update' ,'controller'=> $this->router->fetch_class(),'method'=> 'update','last_modified_on'=> date('Y-m-d h:i:s'),'last_modified_by' => get_login_user_id(),'comment' => 'Insurance Details Uploaded'));
								}*/
							}
							// print_r($data);exit;
							// $this->candidate_model->save_bank_details($data);

							//echo  json_encode(array("msg"=>"Bank details updated successfully!"));                         
							// redirect('candidate/bank_details/'.$can_id);
							echo "1";
						} 
						else
						{
							echo "2";
						}
					}
					else
					{
						echo "3";
					}
				}
				else
				{
					echo "4";
				}
			}
			else if($old_ins_doc != NULL)
			{
				$data  = array('can_id' => $can_id,'insurance_id' => $insurance_id, 'ins_start_date' => $ins_start_date,'ins_expire_date' => $ins_expire_date,'premium_amnt' => $premium_amnt,'assured_amt'=>$assured_amt,'ins_comp_name'=>$ins_comp_name,'policy_no'=>$policy_no);
				$data = set_log_fields($data);
				$res = $this->common_model->update('rpo_insurance_details',$data,array('insurance_id'=>$insurance_id));
				if($res == true)
				{
					// if($can_id==get_login_user_id())
					// {
					// 	user_activity_log($data = array('can_id' => get_login_user_id(), 'table_name' => 'insurance_details' ,"operation_name" => 'update' ,'controller'=> $this->router->fetch_class(),'method'=> 'update','last_modified_on'=> date('Y-m-d h:i:s'),'last_modified_by' => get_login_user_id(),'comment' => 'Insurance Details Updated'));
					// }
					echo "1";
				}
				else
				{
					echo "5";
				}
			}
			else
			{
				echo "Please select a file..!";
			}
			exit;
		}  
	}

	    /* ======  Employee Investment Details ====== */

	function get_policy_list()
	{
		$match = $_GET['term'];
		$query = $this->db->select('policy_id as id,policy_title as text')->like('policy_title',$match,'both')->limit(10)->get("investment_policies");
		$json = $query->result();
		echo json_encode($json);
	}

	function get_section_by_policy()
	{
		if($this->input->is_ajax_request())
		{
			$policy_id = $this->input->post('policy_id');
			$sections = $this->common_model->get_data_array('investment_policies',array('parent_section' => $policy_id,'is_deleted' => 0));
			foreach ($sections as $key => $value) {			
				$policy_title = ucwords(strtolower($value['policy_title']));
				$selected ='';
				if($value['policy_id'] == $policy_id) $selected = 'selected="selected"';
				$data .='<option '. $selected .' value='.$value['policy_id'].'>'.$policy_title.'</option>';			
		}
     	echo ($data);
		}
	}

	function investment()
	{
		//  user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		$this->content->percentage = $this->check_per_profile_complete();  
		$can_id = $this->uri->segment(3);
		$this->content->can_details = $this->common_model->get_data_by_field('rpo_candidates','can_name,joining_date', array('can_id' =>$can_id));     
		$this->load_view("investments","HRMS - Employee Investment Details",$this->content);
	}

	function investment_details($can_id = '')
	{
		$this->datatables->unset_column('inv_id');
		$this->datatables->select('inv_id,amount,description,section,can_id');
		$this->datatables->from('rpo_investment');
		$this->datatables->where('can_id',$can_id);
		$this->datatables->where('is_deleted',0);
		// $this->db->order_by("inv_id", "desc"); 
		$update_url = site_url().'/rpo_manager/edit_investment_details/$1/$2';  
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn_edit_bill btn-success"><span class="glyphicon glyphicon-pencil"></span></a> <a type="button" class="tabledit-delete-button btn-danger btn btn-sm btn_delete_bill" value="$1" style="float: none;" onClick="delete_data($1)"><span class="glyphicon glyphicon-trash"></span></a>', 'inv_id,can_id');
		$result= $this->datatables->generate();  
		echo $result;
	}

	function add_investment()
	{
		$this->content->percentage = $this->check_per_profile_complete();  
		//$access = user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		// if(!empty($access))
		// {
		// 	redirect('access_denied');
		// }
		// else
		// {
			$can_id = $this->uri->segment(3);
			$this->content->can_details = $this->common_model->get_data_by_field('rpo_candidates','can_name', array('can_id' =>$can_id));    
			$this->content->policies = $this->common_model->get_data_array('investment_policies',array('parent_section'=>null,'is_deleted'=>0));
			$this->load_view("add_investment","HRMS - Add Investment Details",$this->content);    
		// }   
	}

	function add_investment_details()
	{
		// user_access_operation($this->router->fetch_class(),$this->router->fetch_method());

		if ($this->input->is_ajax_request())
		{
			$post = $this->input->post();
			// print_r($post);exit;
			$investment_details  = array('can_id' => $post['can_id'],'inv_id' => !empty($post['inv_id']) ? $post['inv_id'] : 0, 'description' => $post['description'],
			'amount' => $post['amount'], 'section' => $post['policy_id'], 'policy_id' => $post['section']);
			// x_debug($investment_details);
			if($investment_details['inv_id'] > 0)
			{
				$investment_details=set_log_fields($investment_details);
				$this->common_model->update("rpo_investment",$investment_details,array("inv_id"=>$investment_details['inv_id']));
				echo "Investment details updated successfully!";
			}
			else
			{
				$investment_details = set_log_fields($investment_details,'insert');
				$this->common_model->insert("rpo_investment",$investment_details);   
				echo "Investment details added successfully!";
			}

			//$result = $this->candidate_model->get_investment_details($post['can_id']);
			//echo "Investment details added successfully!";
			// echo  json_encode(array("result"=>$result,"msg"=>"Investment details added successfully!"));
		}
	}

	function edit_investment_details()
	{
		$this->content->percentage = $this->check_per_profile_complete();  
		//$access = user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		// if(!empty($access))
		// {
		// 	redirect('access_denied');
		// }
		// else
		// {
			$inv_id = $this->uri->segment(3);
			$can_id = $this->uri->segment(4);
			$is_exist = check_record_exist($tablename='rpo_investment', $conditions = array('can_id' =>$can_id,'inv_id' => $inv_id),true);
			if($is_exist==1)
			{
				redirect('Record_not_found');
			}
			else
			{ 
				$this->content->can_details = $this->common_model->get_data_by_field('rpo_candidates','can_name', array('can_id' =>$can_id));
				$this->content->policies = $this->common_model->get_data_array('investment_policies',array('parent_section'=>null,'is_deleted'=>0));
				// debug($this->content->policies);	
				$this->content->inv_details = $this->common_model->get_data('rpo_investment', array('can_id' => $can_id,'inv_id' => $inv_id,'is_deleted' => 0));
				
				// debug($this->content->can_details);
				// x_debug($this->content->inv_details);
				$this->load_view("edit_investment","HRMS - Edit Employee Investment Details",$this->content);
			}
		// }
	} 


	function contract_document_list()
	{
		$this->load_view("client_documents","HRMS - Client Documents",$this->content); 
	}

	function list_contractdocs($client_id = '')
   {
        $this->datatables->unset_column('doc_id');
        $this->datatables->unset_column('file_name');
        $this->datatables->select('doc_id,doc_name,file_name');
        $this->datatables->from('rpo_client_documents');
        $this->datatables->where('client_id',$client_id);
        $this->datatables->where('is_deleted',0);
        // $this->db->order_by("doc_id", "desc");
        $this->datatables->add_column('edit', '<button type="button" class="tabledit-delete-button btn-danger btn btn-sm btn_delete_bill" value="$1" style="float: none;" onClick="delete_data($1)"><span class="glyphicon glyphicon-trash"></span></button>', 'doc_id');
        $this->datatables->add_column('file_name', '<a href="'.base_url().'rpo/client_documents/$2" download>$1</a>', 'doc_name,file_name');
        $result= $this->datatables->generate();  
        echo $result;
   }

	function add_contract_document()
   {
		$client_id = $this->uri->segment(3);
		$this->content->client_details = $this->common_model->get_data('rpo_client_details', array('client_id' => $client_id),'client_name');
		$this->load_view("add_contract_document","HRMS - Employee Documents",$this->content); 
   }



	function upload_contract_document()
	{
		$client_id = $_POST['client_id'];
		if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$upload_path = RPOUPLOADPATH.'client_documents/'; //set your folder path
			if(!is_dir($upload_path))
			{
				mkdir($upload_path , 777,true);
			}

			/*  echo $can_doc_path = "/var/www/html/hrms/uploads/".$can_id."/";
			if( ! is_dir($can_doc_path)){
			mkdir($can_doc_path, 0777, true);
			}*/
			//set the valid file extensions 
			$valid_formats = array("jpg","txt", "png", "gif", "bmp", "jpeg", "GIF", "JPG", "PNG", "doc", "txt", "docx", "pdf", "xls", "xlsx"); //add the formats you want to upload

			$name = $_FILES['myfile']['name']; //get the name of the file            
			$size = $_FILES['myfile']['size']; //get the size of the file         
			if (strlen($name))
			{ 
				//check if the file is selected or cancelled after pressing the browse button.
				list($txt, $ext) = explode(".", $name); //extract the name and extension of the file
				if (in_array($ext, $valid_formats))
				{ 
					//if the file is valid go on.
					if ($size < 2098888)
					{
						// check if the file size is more than 2 mb
						$file_name = $_POST['filename']; //get the file name
						$tmp = $_FILES['myfile']['tmp_name'];
						if (move_uploaded_file($tmp, $upload_path . time().$file_name.'.'.$ext))
						{ 
							//check if it the file move successfully, then insert into database
							$data  = array('client_id' => $client_id, 'doc_name' => $file_name,'file_name'=>time().$file_name.'.'.$ext,'doc_path' => $upload_path,'thumb_path'=>$upload_path);
							$data=set_log_fields($data,'insert');
							$this->common_model->insert('rpo_client_documents',$data);  
							//user_activity_log($data = array('can_id' => get_login_user_id(), 'table_name' => 'documents' ,"operation_name" => 'update' ,'controller'=> $this->router->fetch_class(),'method'=> 'update','last_modified_on'=> date('Y-m-d h:i:s'), 'last_modified_by' => get_login_user_id(),'comment' => 'Document Uploaded'));

							// print_r($result);exit;
							// echo  json_encode(array("result"=>$result,"msg"=>"File uploaded successfully!"));                         
							echo "1";
						} 
						else
						{
							echo "2";
						}
					}
					else
					{
						echo "3";
					}
				}
				else
				{
					echo "4";
				}
			}
			else
			{
				echo "Please select a file..!";
			}
			exit;
		} 
	}


	function delete_doc()
	{
		if ($this->input->is_ajax_request())
		{
			$doc_id = $this->input->post('doc_id');
			$this->common_model->update('rpo_client_documents',array('is_deleted'=>1),array('doc_id'=>$doc_id));
			echo "1";
		
		}
	} 


	/* ===========   If Candidate selected in RPO interview process it gets add in RPO Employee List ========== */

	function add_in_rpo_employee_list()
	{
		if ($this->input->is_ajax_request())
		{
			$rpo_intw_can_id = $this->input->post('repo_can_id');
			$rpo_can_data = $this->rpo_interview_model->get_rpodata_to_insert($rpo_intw_can_id);
			$rpo_can_data['password'] = password_hash("raoson1234", PASSWORD_DEFAULT);
			// x_debug($rpo_can_data);

			$rpo_can_data = set_log_fields($rpo_can_data,'insert');
			$this->common_model->insert('rpo_candidates',$rpo_can_data);
			// x_debug($rpo_can_data);
			// echo $rpo_intw_can_id;
			echo "1";
		}
	}



	/*  Calculate percentage of profile completed */

	function check_per_profile_complete()
    {
        if($this->input->is_ajax_request())
        {
            $can_id = $this->input->post('can_id');
        }
        else
        {
            $can_id = end($this->uri->segment_array());
        }
        
        //$can_type = $this->session->can_type;
        //$percentage = 5;
        $per_new = array();
        $per_new['default'] = 5;
        array_push($per_new, $per_new['profile']);
        $data['can']= $this->common_model->count_all('rpo_candidates',array('can_id' =>$can_id,'is_deleted'=>0));

        if(!empty($data['can']))
        {
            $record =  $this->common_model->get_data('rpo_candidates',array('can_id'=>$can_id,'is_deleted'=>0));
            if(!empty($record['can_name']) && !empty($record['cur_address']) && !empty($record['email_id']) && !empty($record['dob']) && !empty($record['phone1']) && !empty($record['designation']) && !empty($record['aadhar_no']) && !empty($record['pan_no']) && !empty($record['joining_date']))
            //$percentage = $percentage + 15;
            $per_new['profile_per'] = $per_new['default'] + 15;
            $per_new['profile_per'] =  15;
            array_push($per_new, $per_new['profile_per']);
        }

        $data['bank_details']= $this->common_model->count_all('rpo_bank_details',array('can_id' =>$can_id,'is_deleted'=>0));
        if(!empty($data['bank_details']))
        {
            // if($can_type=='user')
            // {  
            //    $per_new['bank_per'] = 20;
            //    array_push($per_new, $per_new['bank_per']);
            // }
            // else
            // {
               $per_new['bank_per'] = 15;
               array_push($per_new, $per_new['bank_per']);
            // }
        }
        // x_debug($per_new);

        $data['documents']= $this->common_model->count_all('rpo_documents',array('can_id' =>$can_id,'is_deleted'=>0));
        if(!empty($data['documents']))
        {
            if($can_type=='user')
            {  
                //$percentage = $percentage + 20;
                $per_new['doc_per'] = 20;
                array_push($per_new, $per_new['doc_per']);
            }
            else
            {
                //$percentage = $percentage + 10;
                $per_new['doc_per'] = 10;
                array_push($per_new, $per_new['doc_per']);
            }
        }

        $data['billing']= $this->common_model->count_all('rpo_billing',array('can_id' =>$can_id,'is_deleted'=>0));
        if(!empty($data['billing']))
        {
            //$percentage = $percentage + 15;
            $per_new['bill_per'] = 15;
            array_push($per_new, $per_new['bill_per']);
        }
		/*
        $data['experience']= $this->common_model->count_all('experience',array('can_id' =>$can_id,'is_deleted'=>0));
        if(!empty($data['experience']))
        {
            //$percentage = $percentage + 10;
            $per_new['exp_per'] = 10;
            array_push($per_new, $per_new['exp_per']);
        }

        $data['referance']= $this->common_model->count_all('referance',array('can_id' =>$can_id,'is_deleted'=>0));
        if(!empty($data['referance']))
        {
            if($can_type=='user')
            {  
                //$percentage = $percentage + 20;
                $per_new['ref_per'] = 20;
                array_push($per_new, $per_new['ref_per']);
            }
            else
            {
                //$percentage = $percentage + 10;
                $per_new['ref_per'] = 10;
                array_push($per_new, $per_new['ref_per']);
            }
        }*/

        $data['insurance_details']= $this->common_model->count_all('rpo_insurance_details',array('can_id' =>$can_id,'is_deleted'=>0));
        if(!empty($data['insurance_details']))
        {
                //$percentage = $percentage + 10;
                $per_new['ins_per'] = 10;
                array_push($per_new, $per_new['ins_per']);
        }
        
        $data['investment']= $this->common_model->count_all('rpo_investment',array('can_id' =>$can_id,'is_deleted'=>0));
        if(!empty($data['investment']))
        {
            if($can_type=='user')
            {  
                //$percentage = $percentage + 20;
                $per_new['inv_per'] = 20;
                array_push($per_new, $per_new['inv_per']);
            }
            else
            {
                //$percentage = $percentage + 10;
                $per_new['inv_per'] = 10;
                array_push($per_new, $per_new['inv_per']);
            }
        }
        // x_debug($per_new);

        if($this->input->is_ajax_request())
        {
            //$res = array();

            // $res[] = array('label'=>'Pending','value'=>100-$percentage);
            // $res[] = array('label'=>'Completed','value'=>$percentage);
            
            echo json_encode($percentage,$per_new);
        }
        else
        {
            $new['per_new']=$per_new;
            //$per_new[]=$per_new;
            // x_debug($per_new);
            return $new;
        }
        //x_debug($data);
    }

	function delete_billing()
	{
		if ($this->input->is_ajax_request())
		{
			//$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
			$access=0;
			if(!empty($access))
			{
				echo "0";
			}
			else
			{
				$bill_id = $this->input->post('bill_id');
				$this->common_model->update($tablename='rpo_billing',array('is_deleted'=>1),array('bill_id'=>$bill_id));
				echo "1";   
			} 
		}
	}


	function get_rpocan_billing_details()
	{		
		$can_id = $this->input->post('can_id');
		$month = $this->input->post('month');
		$year = $this->input->post('year');

		$rpo_can_salary_details['is_salaryslip_exist'] = $this->common_model->count_all('rpoemp_salary_slip', array('can_id'=>$can_id,'month'=> $month,'year'=>$year,'is_deleted'=>0));

		$rpo_can_salary_details['profile_details'] = $this->common_model->get_data('rpo_candidates',array('can_id'=>$can_id,'is_deleted' => 0),'can_id,can_name,email_id,joining_date,designation,department');


		$rpo_can_salary_details['billing_details'] = $this->common_model->get_data_row_order_by('rpo_billing',array('can_id'=>$can_id,'is_deleted' => 0),'effective_from,effective_to,amount,client_id,project_id,rate_type',array('bill_id','desc'),1);


		// $rpo_can_salary_details['salary'] = $this->common_model->get_data('rpoemp_salary_details',array('can_id'=>$can_id,'is_deleted' => 0),'can_id,designation,department,hourly_rate,effective_from,effective_to');
		// x_debug($rpo_can_salary_details);

		if($this->input->is_ajax_request())
		{
			if($rpo_can_salary_details['is_salaryslip_exist'] > 0)
			{
				echo json_encode(array("msg"=>"1"));
			}
			else if(empty(strtotime($rpo_can_salary_details['profile_details']['joining_date'])))
			{
				echo json_encode(array("msg"=>"2"));
			}
			else if(empty($rpo_can_salary_details['billing_details']))
			{
				echo json_encode(array("msg"=>"3"));
			}
			else
			{
				echo json_encode($rpo_can_salary_details);
			}	
		}
		else
		{
			return $rpo_can_salary_details;
		}
	}


	function upload_profile_image()
	{
		$this->load->helper('string');
		$name =random_string('alnum',10);
		$can_data=$this->common_model->get_data('rpo_candidates',array('can_id'=>get_login_user_id(),'profile_picture'));
		//print_r($data);
		$file_path=RPOUPLOADPATH.'profile_images/';

		if(!empty($can_data['profile_picture']))
		{
			unlink($file_path.$can_data['profile_picture']);
		}
		$data = $_POST['image'];
		list($type, $data) = explode(';', $data);
		list(, $data)      = explode(',', $data);
		$data = base64_decode($data);
		$imageName = $image.$name.time().'.png';
		$file=$imageName;
		file_put_contents($file_path.$file, $data);
		$data=array('profile_picture'=>$file);
		set_log_fields($data);

		$this->common_model->update('rpo_candidates',$data,array('can_id'=>get_login_user_id()));
		$this->session->set_userdata('profile_pic',$file);
		$this->session->set_userdata('can_profile_pic',$file);
		// x_debug($_SESSION);
		echo 'done';
	}

	public function import_attendance($msg="")
   {
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());
		$this->load_view("import_attendance","HRMS - Import Atandance",$this->content);
   }

	function save_attendance()
	{
		// $access = user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
		// if(!empty($access))
		// {
		// 	echo json_encode(array("result"=>1,"msg"=>"Access Denied"));
		// }
		// else
		// { 
			if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
			{
				$valid_formats = array("csv","xls","xlsx");
				$name = $_FILES['myfile']['name'];
				$size = $_FILES['myfile']['size'];
				if (strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					if (in_array($ext, $valid_formats))
					{
						if($ext == "xls" || $ext == "xlsx")
						{
							$upload_path = RPOUPLOADPATH."attendance_sheet/";
							$tmp = $_FILES['myfile']['tmp_name'];
							if(!is_dir($upload_path))
							{
								mkdir($upload_path , 777);
							}
							$file_name = $upload_path.$txt.'.'.$ext;
							if (move_uploaded_file($tmp, $file_name))
							{
								exec("ssconvert ".$file_name." ".$upload_path.$txt.".csv");
								$file = $upload_path.$txt.".csv";
								// unlink($file_name);
							}
							else
							{
								echo "2";
							}
						}
						else
						{
							$file = $_FILES['myfile']['tmp_name'];
						}
						if ($size < 2098888)
						{
							$attendance_details = array();
							$row = 0;
							if (($handle = fopen($file, "r")) !== FALSE)
							{
								while (($data = fgetcsv($handle, 0, ",")) !== FALSE)
								{
									$num = count($data);
									for ($c = 0; $c < $num; $c++)
									{
										$attendance_details[$row][] = $data[$c];
									}
									$row++;
								}
								fclose($handle);
								unlink($file);
								$i = 0;
								$blank = 0;
								$row_cnt = 0;
								$can_ids = array();
								// x_debug($attendance_details);
								foreach ($attendance_details as $key => $value)
								{
									$vals = count($value);
									if(!empty($value[0]) && ($value[0] == 'Attendance Month'))
									{
										$year = date('Y', strtotime($value[3]));
										$month = date('m', strtotime($value[3]));
										$import_id = $this->common_model->get_data('rpo_attendance', array(), 'max(import_id) as max_import');
									}
									else if(!empty($value[0]) && is_numeric($value[0]) && !empty($value[1]) && ($value[0] != 'Attendance Month'))
									{
										if(!in_array($value[2], $can_ids))
										{
											$can_id = $this->common_model->get_data('rpo_candidates', array('can_name LIKE'=>'%'.$value[2].'%'), 'can_id');
											if(!empty($can_id))
											{
												$atten_details[$key]['can_id'] = $can_id['can_id'];
												$atten_details[$key]['month'] = $month;
												$atten_details[$key]['year'] = $year;
												$atten_details[$key]['total_hours'] = $value[4];
												if($import_id['max_import'] == NULL || empty($import_id['max_import']))
												{
												 	$atten_details[$key]['import_id'] = 1;
												}
												else
												{
												  	$atten_details[$key]['import_id'] = ++$import_id['max_import'];
												}
												$atten_details[$key]['name'] = $value[2];
												$can_ids[] = $value[2];
											}
										}
									}
								}

								$cnt = count($atten_details);
								foreach ($atten_details as $key1 => $value1)
								{
									$decide = $this->update_or_insert($value1);
									unset($value1['name']);
									if($decide <= 0)
									{
										$atten_record = set_log_fields($value1, 'insert');
										$res = $this->common_model->insert('rpo_attendance',$atten_record);
										if($res > 0)
										{
											$i++;
										}
									}
									else
									{
										$atten_record = set_log_fields($value1);
										$res = $this->common_model->update('rpo_attendance',$atten_record,array('atn_id'=>$decide));
										$i++;
									}
								}
								if($cnt == $i)
								{
									echo "1";
								}
								else
								{
									echo "2";
								}
							}
							else
							{
								echo "2";
							}
						}
						else
						{
							echo "3";
						}
					}
					else
					{
						echo "4";
					}
				}
				else
				{
					echo "6";
				}
				exit;
			}
	}


	function update_or_insert($record = '')
	{
		$rec = $this->common_model->get_data('rpo_attendance',array('can_id'=>$record['can_id'], 'month'=>$record['month'], 'year'=>$record['year']), 'atn_id');
		if(empty($rec))
		{
			return 0;
		}
		else
		{
			return $rec["atn_id"];
		}
	}

	function attendance_list()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());
		$this->db->select('month,year');
		$this->db->from('rpo_attendance');
		$this->db->group_by('year, month');
		$this->content->attendance_list = $this->db->get()->result_array();
		$this->load_view("rpo_attendance_list","HRMS - RPO Attendance List",$this->content);
	}

	function attendance_view($month = '', $year = '')
	{
		// user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		$records = $this->db->select('rpo_attendance.*,rpo_candidates.can_name,rpo_candidates.can_id')->from('rpo_attendance')->join('rpo_candidates', 'rpo_candidates.can_id = rpo_attendance.can_id', 'inner')->where(array('month'=>$month, 'year'=>$year, 'rpo_attendance.is_deleted'=>0))->get()->result_array();
		if(empty($records))
		{
			$this->content->attendance_records = NULL;
		}
		else
		{
			$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			$atten = array();
			foreach ($records as $key => $value)
			{
				$atten[$key]['name'] = $value['can_name'];
				$atten[$key]['can_id'] = $value['can_id'];
				$atten[$key]['month'] = $month;
				$atten[$key]['year'] = $year;
				$atten[$key]['total_hours'] = $value['total_hours'];
			}
			$this->content->attendance_records = $atten;
			$this->load_view("rpo_attendance_detail_view","HRMS - Attendance Details",$this->content);
		}
	}


	function settings()
	{
		//user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
		$this->load_view('my_profile_settings',"Profile Settings",$this->content);
	}

	public function check_password()
	{
		if($this->input->is_ajax_request())
		{
			$curr_pass = $this->input->post('current_pass',true);
			$email = $_POST['email_id'];
			// $user_details = $this->common->get_data('candidate',array('email'=>$email_id));
			$this->load->model('rpo_login_model');

			$user = $this->rpo_login_model->check_password($email,$curr_pass);
         if($user)
         {
         	$email = $user->email;
            $hash = $user->password;
				if (password_verify($curr_pass, $hash))
	         {
				 	echo "1";
				}
				else
				{
					echo "0";
				}
         }
		
		}
	}

	function change_password()
	{
		//user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
		$user_data = $this->session->userdata('logged_in_user');	
		// x_debug($user_data);	
		if($this->input->post())
		{
			$post = $this->input->post();
			$confirm_pass = $post['confirm_pass'];			
			$encoded_password = password_hash($confirm_pass, PASSWORD_DEFAULT);
			$data_array = array('email' => $user_data['email'] ,'password' =>$encoded_password);
			if($this->rpo_manager_model->update_password($data_array))
			{
            user_activity_log($data = array('can_id' => get_login_user_id(), 'table_name' => 'candidate' ,"operation_name" => 'update' ,'last_modified_on'=> date('Y-m-d h:i:s'),'last_modified_by' => get_login_user_id(),'comment' => 'Password Uploaded'));
            	$this->common_model->update('rpo_candidates', array('login_status'=>1), array('can_id'=>$user_data['id']));
				echo json_encode(TRUE);
			}
			else
			{
				echo json_encode(FALSE);
			}
		}
	}

   public function remove_profile()
	{
		$res = $this->common_model->update('rpo_candidates', array('profile_picture'=>NULL), array('can_id'=>get_login_user_id()));
		$this->session->profile_pic = NULL;
		echo json_encode($res);
	}

	private function load_view($viewname= "blank_page",$page_title)
	{
		$this->content->meta_description="Meta meta_description here!";
		$this->content->meta_keywords="meta keywords here!";
		$this->masterpage->setMasterPage('master');
		$this->content->page_description = "";
		$this->masterpage->setPageTitle($page_title);
		$this->masterpage->addContentPage('rpo_manager/'.$viewname,'content',$this->content);
		$this->masterpage->show();
	}
}
