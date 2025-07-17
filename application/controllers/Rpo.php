<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rpo extends My_Controller {

	function __construct() {
		parent::__construct();

		$this->load->database();
		$this->load->model('rpo_model');
		$this->load->model('common_model');
		$userdata = $this->session->userdata('logged_in_user');
		if(!$userdata){
			$newURL = site_url()."/login";
			header('Location: '.$newURL);        		
		}        
	}

	public function rpoemp_salary_details($msg="")
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());
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

	function add_edit_rpo_emp_salary_details()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());

		$rpo_sal_id = $this->uri->segment(3);

		if(!empty($rpo_sal_id))
		{
			if($this->common_model->count_all($tablename='rpoemp_salary_details', $conditions = array('rpo_sal_id' =>$rpo_sal_id)) == 0 )
			{
				redirect('Record_not_found');
			}
			else
			{
				$this->content->rpoempsalary_details = $this->rpo_model->get_rpocan_salary_details($rpo_sal_id);
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

	function get_can_details()
	{
		if($this->input->is_ajax_request())
		{
			$can_id = $this->input->post('can_id');
			$rpocan_details=$this->common_model->get_data('candidate',array('can_id'=>$can_id,'can_type'=>'rpo','is_deleted' => 0));
			if(empty($rpocan_details['joining_date']))
			{
				echo json_encode(array("msg"=>"Please update profile first!"));
			}
			else
			{
        	 echo json_encode($rpocan_details);
			}
      }	
	}  


	function generate_rposalary_slip()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());
		$this->content->rpo_candidates = $this->common_model->get_form_dropdown($tablename = 'candidate', $fields = array('can_id','can_name'),$conditions = array('is_deleted' => 0,'can_type'=>'rpo'));
		// x_debug($this->content->candidates);

		if(!empty($this->input->post()))
		{
			// x_debug($_POST);
			$salary_slip_data = array('can_id' => $this->input->post('can_id',true),'month' => $this->input->post('month',true),'year' => $this->input->post('year',true), 'paid_hours' => $this->input->post('paid_hours',true), 'prof_tax' => $this->input->post('prof_tax',true), 'tds' => $this->input->post('tds',true), 'total_earnings' => $this->input->post('total_earnings',true), 'total_deduction' => $this->input->post('total_deduction',true), 'net_pay' => $this->input->post('net_pay',true));
			
			// $salary_slip_data['created_on'] = date('Y-m-d');
			if(!empty($this->get_rpocan_saldetails()))
			{
				$salary_slip_data=set_log_fields($salary_slip_data,'insert');
				if($this->rpo_model->generate_salary_slip($salary_slip_data))
				{				
					$this->session->set_flashdata('success', 'RPO Employee Salary Slip Generated Successfully!');
					redirect('rpo/all_salary_slips');
				}
			}
			else
			{
				$error = $this->session->set_flashdata('error', 'Salary slip already generated for this employee!');
				redirect('rpo/generate_salary_slip', $error);
			}
		}
      $this->load_view("rpo_salary_slip","HRMS - Generate Salary Slip",$this->content);        
	}

	function get_rpocan_saldetails()
	{		
		$can_id = $this->input->post('can_id');
		$month = $this->input->post('month');
		$year = $this->input->post('year');

		$rpo_can_salary_details['is_salaryslip_exist'] = $this->common_model->count_all('rpoemp_salary_slip', array('can_id'=>$can_id,'month'=> $month,'year'=>$year,'is_deleted'=>0));

		$rpo_can_salary_details['profile_details'] = $this->common_model->get_data('candidate',array('can_id'=>$can_id,'can_type'=>'rpo', 'is_deleted' => 0),'can_id,can_name,email,joining_date');

		$rpo_can_salary_details['salary'] = $this->common_model->get_data('rpoemp_salary_details',array('can_id'=>$can_id,'is_deleted' => 0),'can_id,designation,department,hourly_rate,effective_from,effective_to');
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
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());
		$this->load_view("monthly_rposalary_slips","HRMS - All Salary Slips",$this->content);        
	}

	function list_monthly_salaryslips()
	{  
		$this->datatables->unset_column('rpo_sal_id');
		$this->datatables->select('rpo_sal_id, can_name, month, year');
		$this->datatables->from('rpoemp_salary_slip');
		$this->datatables->join('candidate', 'rpoemp_salary_slip.can_id = candidate.can_id', 'left');
		$this->datatables->where('rpoemp_salary_slip.is_deleted',0);
		$this->db->order_by("rpo_sal_id", "desc");
		$update_url = site_url().'/rpo/update_salary_slip/$1';
		$view_url=site_url().'/rpo/view_salary_slip/$1';
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_salaryslip($1)" class="tabledit-delete-button btn btn-sm swal-btn-cancel btn-danger" ><span class="glyphicon glyphicon-trash"></span></a><a href="'.$view_url.'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>', 'rpo_sal_id');
		$result= $this->datatables->generate();  
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
   		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
	   	$salary_slip_id = $this->uri->segment(3);
	   	$this->content->rpoempsalary_details = $this->rpo_model->get_salary_slip_details($salary_slip_id);
			if(!empty($this->input->post()))
			{
				$post = $this->input->post();
				$salary_slip_data = $post;
				unset($post['joining_date'],$post['designation'],$post['department'],$post['effective_from'],$post['effective_to'],$post['hourly_rate']);
				
				if($this->rpo_model->generate_salary_slip($salary_slip_data))
				{				
					$this->session->set_flashdata('success', 'Employee Salary Slip Generated Successfully!');
					redirect('rpo/all_salary_slips');
				}
			}
			$this->load_view("rpo_salary_slip","HRMS - Edit Employee Salary Details",$this->content);
   }

	 function view_salary_slip($rpo_sal_id)
	 {
		if(!empty($rpo_sal_id))
		{
			$this->load->library('pdfgenerator');
			$data['salary_slip'] = $this->rpo_model->get_salary_slip_details($rpo_sal_id);

			if(isset($_GET['download']))
			{
			$output=$this->load->view('pdf_downlaod/rpo_salary_slip_pdf',$data,true);
			$this->pdfgenerator->generate($output,'Salary slip of month '.$data['salary_slip']['month'].'-'.$data['salary_slip']['year']);
			}
			else
			{
			$this->content->rpoempsalary_details = $data['salary_slip'];
			// $this->content->candidate_data=$data['candidate_data'];
			$this->load_view('salary_slip_view.php','Salary Slip View',$data);
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
		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());  
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
				$this->content->rpoempsalary_details = $this->rpo_model->get_rpocan_salary_details($rpo_sal_id);
			}
		}
		$this->load_view("salary_details_view","HRMS - RPO Salary Slip",$this->content);
	}


	private function load_view($viewname= "blank_page",$page_title)
	{
		$this->content->meta_description="Meta meta_description here!";
		$this->content->meta_keywords="meta keywords here!";
		$this->masterpage->setMasterPage('master');
		$this->content->page_description = "";
		$this->masterpage->setPageTitle($page_title);
		$this->masterpage->addContentPage('rpo/'.$viewname,'content',$this->content);
		$this->masterpage->show();
	}
}
