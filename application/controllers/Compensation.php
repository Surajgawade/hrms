<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Compensation extends My_Controller {

	function __construct() {
		parent::__construct();

		$this->load->database();
		$this->load->model('candidate_model');
		$this->load->model('leave_model');
		$this->load->model('common_model');
      $this->load->model('compensation_model');
		// $logged_in = $this->session->userdata['logged_in'];
		$userdata = $this->session->userdata('logged_in_user');
		if(!$userdata){
			$newURL = site_url()."/login";
			header('Location: '.$newURL);        		
		}        
	}

	public function employee_salary_details($msg="")
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());
		$this->load_view("emp_salary_details","HRMS - Employee Salary Details",$this->content);        
	}

	function list_emp_salarydetails()
	{  
		$this->datatables->unset_column('sd_id');
		$this->datatables->select('sd_id, can_name, gross_pay, effective_from, effective_to');
		$this->datatables->from('emp_salary_details');
		$this->datatables->join('candidate', 'emp_salary_details.can_id = candidate.can_id', 'left');
		$this->datatables->where('emp_salary_details.is_deleted',0);
		$this->datatables->where('candidate.is_deleted',0);
		$this->db->order_by("sd_id", "desc");
		$update_url = site_url().'/compensation/add_edit_employee_salary_details/$1';
        $view_url=site_url().'/compensation/view/$1/';		
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_empsalary($1)" class="tabledit-delete-button btn btn-sm swal-btn-cancel btn-danger btn_edit" ><span class="glyphicon glyphicon-trash"></span></a><a href="'.$view_url.'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>', 'sd_id');
		$result= $this->datatables->generate();
		echo $result;
   }

	function add_edit_employee_salary_details()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());
		$superadmin = $this->config->item('super_user_role_id');
        $superadmin = implode(',', $superadmin);
		$sd_id = $this->uri->segment(3);

		if(!empty($sd_id))
		{
			if($this->common_model->count_all($tablename='emp_salary_details', $conditions = array('sd_id' =>$sd_id)) == 0 )
			{
				redirect('Record_not_found');
			}
			else
			{
				$this->content->empsalary_details = $this->compensation_model->get_can_salary_details($sd_id);
			}
		}
			// $this->content->candidates = $this->common_model->get_form_dropdown($tablename = 'candidate', $fields = array('can_id','can_name'),$conditions = array('is_deleted' => 0,'can_type!=' => 'rpo'));
			$this->content->candidates = $this->db->query('SELECT * FROM `candidate` WHERE `is_deleted`=0 AND role_id NOT IN ('.$superadmin.')')->result();
			if(!empty($this->input->post()))
			{
				$post = $this->input->post();
				// x_debug($post);
				// $post = $this->security->xss_clean($post);
				$sd_id = $post['sd_id'];
				unset($post['joining_date'],$post['can_designation'],$post['sd_id']);
				$salary_data = $post;

				$effective_from = str_replace('/', '-', $post['effective_from']);
				if(!empty($effective_from) && !empty(strtotime($effective_from)))
				{
					$salary_data['effective_from'] = date('Y-m-d', strtotime($effective_from));
				}

				$effective_to = str_replace('/', '-', $post['effective_to']);
				if(!empty($effective_to) && !empty(strtotime($effective_to)))
				{
					$salary_data['effective_to'] = date('Y-m-d', strtotime($effective_to));
				}

				$salary_data['created_on'] = date('Y-m-d');
				if(!empty($sd_id))
				{
    				$salary_data=set_log_fields($salary_data,'insert');
					
					$this->common_model->update('emp_salary_details',$salary_data,array('sd_id' => $sd_id));
					$this->session->set_flashdata('success', 'Salary Details Updated Successfully!');
				}
				else
				{
    				$salary_data=set_log_fields($salary_data,'insert');

					$this->common_model->insert('emp_salary_details',$salary_data);
					$this->session->set_flashdata('success', 'Salary Details Added Successfully!');
				}				
				redirect('compensation/employee_salary_details');
			}
		
      $this->load_view("add_edit_salary_details","HRMS - Add Employee Salary Details",$this->content);        
	}

	function get_can_details()
	{
		if($this->input->is_ajax_request())
		{
			$can_id = $this->input->post('can_id');
			// $can_details = $this->common_model->get_details_by_fieldname($tablename = 'candidate', $fields = array('can_id','can_name'),$conditions = array('is_deleted' => 0),$joins = 0 );
			$can_details = $this->candidate_model->get_can_details($can_id);
			// x_debug($can_details);
			if(empty($can_details->joining_date) && empty($can_details->job_profile_title))
			{
				echo json_encode(array("msg"=>"Please update profile first!"));
			}
			else
			{
        	 echo json_encode($can_details);
			}
      }	
	}  


	function generate_salary_slip()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());
		$superadmin = $this->config->item('super_user_role_id');
        $superadmin = implode(',', $superadmin);
		// $this->content->candidates = $this->common_model->get_form_dropdown($tablename = 'candidate', $fields = array('can_id','can_name'),$conditions = array('is_deleted' => 0,'can_type!=' => 'rpo'));
        $this->content->candidates = $this->db->query('SELECT * FROM `candidate` WHERE `is_deleted`=0 AND role_id NOT IN ('.$superadmin.')')->result();
		if(!empty($this->input->post()))
		{
			$post = $this->input->post();
			unset($post['pf_applicable']);
			$salary_slip_data = $post;
			$salary_slip_data['created_on'] = date('Y-m-d');
			if(!empty($this->get_can_salary_details()))
			{
				if($this->compensation_model->generate_salary_slip($salary_slip_data))
				{				
					$this->session->set_flashdata('success', 'Employee Salary Slip Generated Successfully!');
					redirect('compensation/all_salary_slips');
				}
			}
			else
			{
				$error = $this->session->set_flashdata('error', 'Salary slip already generated for this employee!');
				redirect('compensation/generate_salary_slip', $error);
			}
		}
      $this->load_view("salary_form","HRMS - Generate Salary Slip",$this->content);        
	}


	

	function get_can_salary_details()
	{		
		$can_id = $this->input->post('can_id');
		$month = $this->input->post('month');
		$year = $this->input->post('year');

		$can_salary_details['is_salaryslip_exist'] = $this->common_model->count_all('emp_monthly_salary_slips', array('can_id'=>$can_id,'month'=> $month,'year'=>$year,'is_deleted'=>0));
		$can_salary_details['profile_details'] = $this->candidate_model->get_can_details($can_id);
		$can_salary_details['salary'] = $this->candidate_model->get_can_salary_details($can_id);
		$can_salary_details['leaves'] = $this->compensation_model->get_present_days($can_id);
		// x_debug($can_salary_details);
		if($this->input->is_ajax_request())
		{
			if($can_salary_details['is_salaryslip_exist'] > 0)
			{
				echo json_encode(array("msg"=>"1"));
			}
			else if(empty(strtotime($can_salary_details['profile_details']->joining_date)) && empty($can_salary_details['profile_details']->job_profile_title))
			{
				echo json_encode(array("msg"=>"2"));
			}
			else if(empty($can_salary_details['salary']))
			{
				echo json_encode(array("msg"=>"3"));
			}
			else
			{
				echo json_encode($can_salary_details);
			}	
		}
		else
		{
			return $can_salary_details;
		}
	}
	function view_salaryslip()
	{
		$userdata = $this->session->userdata('logged_in_user');       
		$this->load_view("can_salaryslip","HRMS - Employee Freiends Reference Details",$this->content);
	}

	function salary_slip_details()
	{
		$can_id = $this->uri->segment(3);
		$this->content->can_details = $this->get_candidate_name_by_id($can_id);
		// $this->content->salary_slip_details = $this->candidate_model->get_salary_slip_details($can_id);     
		$this->load_view("salary_slip_details","HRMS - Employee Salary Slip Details",$this->content);
	}

	function delete_saldetails()
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
			$sd_id = $this->input->post('sd_id');
			$this->candidate_model->delete($tablename='emp_salary_details',$fieldname ='sd_id',$sd_id);
			echo "1";
			}
		}
   }

 
	function all_salary_slips()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());
		$this->load_view("monthly_salary_slips","HRMS - All Salary Slips",$this->content);        
	}

	function list_monthly_salaryslips()
	{  
		$this->datatables->unset_column('salary_slip_id,candidate.can_id');
		$this->datatables->select('candidate.can_id,salary_slip_id, can_name, month, year');
		$this->datatables->from('emp_monthly_salary_slips');
		$this->datatables->join('candidate', 'emp_monthly_salary_slips.can_id = candidate.can_id', 'left');
		$this->datatables->where('emp_monthly_salary_slips.is_deleted',0);
		$this->db->order_by("salary_slip_id", "desc");
		$update_url = site_url().'/compensation/update_salary_slip/$1';
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_salaryslip($1)" class="tabledit-delete-button btn btn-sm swal-btn-cancel btn-danger" ><span class="glyphicon glyphicon-trash"></span></a> <a href="view_salary_slip/$1/$2?download=true" class="tabledit-edit-button btn-success btn btn-sm btn_edit"><span class="glyphicon glyphicon-download"></span></a><a href="view_salary_slip/$1/$2" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>', 'salary_slip_id,can_id');
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
			$salary_slip_id = $this->input->post('salary_slip_id');
			$this->candidate_model->delete($tablename='emp_monthly_salary_slips',$fieldname ='salary_slip_id',$salary_slip_id);
			echo "1";
			}
		}
   }

   function update_salary_slip()
   {
   		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
	   	$salary_slip_id = $this->uri->segment(3);
	   	$this->content->salary_slip_details = $this->compensation_model->get_salary_slip_details($salary_slip_id);
			if(!empty($this->input->post()))
			{
				$post = $this->input->post();
				unset($post['pf_applicable']);
				$salary_slip_data = $post;
				$salary_slip_data['created_on'] = date('Y-m-d');
	   		// x_debug($salary_slip_data);
				
				if($this->compensation_model->generate_salary_slip($salary_slip_data))
				{				
					$this->session->set_flashdata('success', 'Employee Salary Slip Generated Successfully!');
					redirect('compensation/all_salary_slips');
				}
			}
			$this->load_view("edit_salary_slip","HRMS - Edit Employee Salary Details",$this->content);
   }

	private function load_view($viewname= "blank_page",$page_title)
	{
		$this->content->meta_description="Meta meta_description here!";
		$this->content->meta_keywords="meta keywords here!";
		$this->masterpage->setMasterPage('master');
		$this->content->page_description = "";
		$this->masterpage->setPageTitle($page_title);
		$this->masterpage->addContentPage('compensation/'.$viewname,'content',$this->content);
		$this->masterpage->show();
	}


	function my_salaryslips()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());
		$userdata = $this->session->userdata('logged_in_user');
     	$this->load_view("my_salaryslips","HRMS - Employee Freiends Reference Details",$this->content);	
	}

	function view_salary_slip($salary_slip_id,$can_id)
	{
		$userdata = $this->session->userdata('logged_in_user');
		if(($can_id == get_login_user_id()) || (in_array($userdata['role_id'],$this->config->item('hr_user_role_id'))||in_array($userdata['role_id'],$this->config->item('super_user_role_id'))||in_array($userdata['role_id'],$this->config->item('admin_user_role_id'))))
		{
			if(!empty($can_id) && !empty($salary_slip_id))
			{
				$this->load->library('pdfgenerator');
				$data['salary_slip']=$this->common_model->get_data('emp_monthly_salary_slips',array('can_id'=>$can_id,'salary_slip_id'=>$salary_slip_id));

				$data['candidate_data']=(array)$this->candidate_model->get_can_details($can_id);
				if(isset($_GET['download']))
				{
				$output=$this->load->view('pdf_downlaod/salary_slip_pdf',$data,true);
				$this->pdfgenerator->generate($output,'Salary slip of month '.$data['salary_slip']['month'].'-'.$data['salary_slip']['year']);
				}
				else
				{
				$this->content->salary_slip=$data['salary_slip'];
				$this->content->candidate_data=$data['candidate_data'];
				$this->load_view('salary_slip_pdf','Salary Slip View',$data);
				}
			}
			else
			{
				echo "invalid arguments";
			}
		}
		else
		{
			$this->session->set_flashdata('warning', 'Access Denied');
			redirect('candidate');
		}
	}

   function get_user_salary_slips()
	{		 
		$this->datatables->unset_column('ca.can_id,ems.salary_slip_id');
		$this->datatables->select('ca.can_id,ems.salary_slip_id,ca.can_name,ems.year,ems.month');
		$this->datatables->join('emp_monthly_salary_slips ems', 'ca.can_id = ems.can_id', 'left');
		$this->datatables->from('candidate ca');
		$this->datatables->where('ems.can_id',get_login_user_id());
		$this->datatables->add_column('download', '<a href="view_salary_slip/$1/$2?download=true" class="tabledit-edit-button btn-success btn btn-sm btn_edit"><span class="glyphicon glyphicon-download"></span></a><a href="view_salary_slip/$1/$2" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>','salary_slip_id,can_id');
		$result= $this->datatables->generate();  
		echo $result;
	}
	//function to view salary slip 
    public function view()
    {
        user_access_operation($this->router->fetch_class(),$this->router->fetch_method());  
        $userdata = $this->session->userdata('logged_in_user');
        $sd_id = (int)$this->uri->segment(3);  
		if(!empty($sd_id))
		{
			if($this->common_model->count_all($tablename='emp_salary_details', $conditions = array('sd_id' =>$sd_id)) == 0 )
			{
				redirect('Record_not_found');
			}
			else
			{
				$this->content->salary_slip = $this->compensation_model->get_can_salary_details($sd_id);
			}
		}
        $this->load_view("salary_slip","HRMS - Salary Slip",$this->content);
    }

   function generate_excel()
   {
   	// $month = date('m')-1;
   	// $year = date('Y');
   	// $emp_monthly_salaryslips = $this->compensation_model->get_monthly_salary_slips($month,$year);
   	$this->load_view("salary_slip_excel","HRMS - Monthly Salary Slips",$this->content);
   }


   function list_currentmonth_slips()
   {
   	$month = date('m')-1;
   	$year = date('Y');
   	$this->datatables->unset_column('salary_slip_id');
		$this->datatables->select('ms.salary_slip_id,ms.transaction_type,ms.debit_acc_number,b.beneficiary_id,b.account_number,ms.net_pay,c.can_name');
		$this->datatables->from('emp_monthly_salary_slips ms');
		$this->datatables->join('candidate c', 'c.can_id = ms.can_id', 'left');
		$this->datatables->join('bank_details b', 'b.can_id = ms.can_id', 'left');
		$this->db->where(array('month'=> $month,'year' =>$year));
        // return $this->db->get()->result_array();
		$this->db->order_by("salary_slip_id", "desc");		
		$result= $this->datatables->generate();
		// $result = array_push($result, $data['account_details']);
		echo $result;	
   }


	public function download()
	{
		$company_bank_details = $this->common_model->get_data('configuration_settings',array(),'company_name,bank_account_number,account_holder_name,remark_about_file,bank_name,ifsc_code,branch_name,branch_code,currency');

		$month = date('m')-1;
   	$year = date('Y');

   	$dateObj   = DateTime::createFromFormat('!m', $month);
		$monthName = $dateObj->format('F');

   	$emp_monthly_salaryslips = $this->compensation_model->get_monthly_salary_slips($month,$year);
   	// x_debug($emp_monthly_salaryslips);

		require_once APPPATH . '/third_party/Phpexcel/Bootstrap.php';

		// Create new Spreadsheet object
		$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

		// Set document properties
		$spreadsheet->getProperties()->setCreator('raoson.com')
		->setLastModifiedBy($company_bank_details['company_name'])
		->setTitle('Payment To Registered Beneficiaries')
		->setSubject('Employees Salary Slip Details')
		->setDescription('Current Month Salary Slips');


		// add style to the header
		$a1b1Array = array(
								'font' => array(
									'bold' => true,
									'color' => ['rgb' => 'FFFFFF'],
								),
								'alignment' => array(
									'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
									'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
								),
								'borders' => array(
									'top' => array(
										'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
									),
								),
								'fill' => array(
									'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
									'rotation' => 90,
									'startcolor' => array(
									'argb' => '000000',
									),
									'endcolor' => array(
									'argb' => '000000',
									),
								),
							);
		$a2Array = array(
								'font' => array(
									'bold' => true,
									'color' => ['rgb' => 'FFFFFF'],
								),
								'alignment' => array(
									'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
									'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
								),
								'borders' => array(
									'top' => array(
										'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
									),
								),
								'fill' => array(
									'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
									'rotation' => 90,
									'startcolor' => array(
									'argb' => 'd01311',
									),
									'endcolor' => array(
									'argb' => 'd01311',
									),
								),
							);


		$c1Array = array(
								'font' => array(
									'bold' => true,
									'color' => ['rgb' => '000000'],
								),
								'width' =>  '5000px',
								'alignment' => array(
									'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
									'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
								),
								'borders' => array(
									'top' => array(
										'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
									),
								),
								'fill' => array(
									'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
									'rotation' => 90,
									'startcolor' => array(
									'argb' => 'e4aa17',
									),
									'endcolor' => array(
									'argb' => 'e4aa17',
									),
								),
						);




		// $spreadsheet->getActiveSheet()->getStyle('A1:B1')->applyFromArray($a1b1Array);
		// $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($a2Array);
		$spreadsheet->getActiveSheet()->getStyle('C1')->applyFromArray($c1Array);
		$spreadsheet->getActiveSheet()->getStyle('D1')->applyFromArray($c1Array);
		$spreadsheet->getActiveSheet()->getStyle('E1')->applyFromArray($c1Array);

		// $spreadsheet->getColumnDimension('A',$create = true)->setWidth(100);

		// set the names of header cells
		$spreadsheet->setActiveSheetIndex(0)
		// ->mergeCells('A1:B1')
		// ->mergeCells('A2:B2')
		// ->mergeCells('D1:D2')
		->setCellValue("A1",'')
		->setCellValue("A2",'')
		// ->setCellValue("B1",'Debit A/c No');
		// ->setCellValue("C1",'196405000399')
		->setCellValue("C1",$monthName.' '.$year)
		->setCellValue("D1",'SALARY PAYMENT FOR THE MONTH OF '.$monthName.''.$year);
		// ->setCellValue("E1",);
		// ->setCellValue("F1",'Remark');

		$spreadsheet->getActiveSheet()->getColumnDimension('B1')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('C1')->setAutoSize(true);
		// ->setAutoSize(true);
		// $spreadsheet->getActiveSheet()->getColumnDimension('B1')->setAutoSize(false)->setWidth(5000);

		// add style to the header
		$styleArray = array(
								'font' => array(
									'bold' => true,
								),
								'alignment' => array(
									'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
									'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
								),
								'borders' => array(
									'top' => array(
										'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
									),
								),
								'fill' => array(
									'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
									'rotation' => 90,
									'startcolor' => array(
									'argb' => 'e4aa17',
									),
									'endcolor' => array(
									'argb' => 'e4aa17',
									),
								),
							);
		$spreadsheet->getActiveSheet()->getStyle('A4:F4')->applyFromArray($a1b1Array);


		// auto fit column to content

		foreach(range('A','F') as $columnID) {
			$spreadsheet->getActiveSheet()->getColumnDimension($columnID)
		->setAutoSize(true);
		}
		// set the names of header cells
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue("A4",'Transaction type')
		->setCellValue("B4",'Debit A/c No')
		->setCellValue("C4",'Beneficiaries A/c No')
		->setCellValue("D4",'Amount')
		->setCellValue("E4",'Name')
		->setCellValue("F4",'Remark');

		// Add some data
		$x= 5;
		foreach($emp_monthly_salaryslips as $sub)
		{
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue("A$x",$sub['transaction_type'])
			->setCellValue("B$x",$company_bank_details['bank_account_number'])
			->setCellValue("C$x",$sub['beneficiary_id'])
			->setCellValue("D$x",$sub['net_pay'])
			->setCellValue("E$x",$sub['can_name'])
			->setCellValue("F$x",'Remarks here');
			$spreadsheet->getActiveSheet()->getStyle('A'.$x.':F'.$x )->applyFromArray($styleArray);
			$x++;
		}

		$worksheet_title = "Payment_Sheet".$month."Year_".$year;
		$worksheet_name = "Payment to Registered Beneficiaries";
		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle($worksheet_title);

		// set right to left direction
		//		$spreadsheet->getActiveSheet()->setRightToLeft(true);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename='.$worksheet_name.'.xlsx');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		//print_r('uer');
		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0
		//print_r("hi");
		//exit;
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Excel2007');
		//print_r($writer);

		$writer->save('php://output');
		//  create new file and remove Compatibility mode from word title

		/* create text file for bank salary transactions*/
		$this->load->helper('file');
		$txt_data = '';

		foreach ($emp_monthly_salaryslips as $key => $value) {
			$txt_data .= 'PRB|';
			$txt_data .= $value['transaction_type']. '|';
			$txt_data .= $value['net_pay']. '|';
			$txt_data .= $company_bank_details['currency']. '|';
			$txt_data .= $value['beneficiary_id']. '|';
			$txt_data .= $company_bank_details['bank_account_number']. '|';
			$txt_data .= '0011';
			$txt_data .= $value['can_name']. '|';
			$txt_data .= 'N'. '|';
			$txt_data .= 'PRBNBB'. '^'."\n";
		}
		if ( ! write_file(BANKPATH.$monthName.'_'.$year.'.txt', $txt_data))
		{
		        echo 'Unable to write the file';
		}
		else
		{
		        echo 'File written!';
		}
		$string = read_file(BANKPATH.$monthName.'_'.$year.'.txt');
		exit;

		
	}

	function create_txt()
	{
		echo "In create txt function";

		$this->load->helper('file');

		$data = 'Some file data';
		if ( ! write_file(BANKPATH.'file.txt', $data))
		{
		        echo 'Unable to write the file';
		}
		else
		{
		        echo 'File written!';
		}
		$string = read_file(BANKPATH.'file.txt');		
	}
}
