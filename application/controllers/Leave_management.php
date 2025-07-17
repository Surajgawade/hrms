<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leave_Management extends My_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('candidate_model');
		$this->load->model('holiday_model');
		$this->load->model('leave_model');
		$this->load->model('common_model');
		$userdata = $this->session->userdata('logged_in_user');
		if(!$userdata){
			$newURL = site_url()."/login";
			header('Location: '.$newURL);        		
		}        
	}

	public function index($msg="")
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
   	$this->load_view("leave_type","HRMS - Leave Types",$this->content);        
	}

	function list_leave_type()
	{
		$this->datatables->unset_column('type_id');
		$this->datatables->select('type_id, leave_title, acronym');
		$this->datatables->from('leave_type');
		$this->datatables->where('is_deleted',0);
		$update_url = site_url().'/leave_management/edit_leave_type/$1';

		//$view_url=site_url().'/leave_management/view/$1';
		$this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a> <a href="javascript:;" onClick="delete_type($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_edit"><span class="glyphicon glyphicon-trash"></span></a>'/*<a href="'.$view_url.'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>'*/, 'type_id');		      

		$result= $this->datatables->generate();  
		echo $result;
	}

	function add_type()
	{
		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		$this->load_view("add_leave_type","HRMS - Add Leave Type",$this->content);	
	}

	function save_leave_type()
	{
		if(!empty($this->input->post()))
		{
			$post = $this->input->post();
			$type_id = $this->input->post('type_id',true);
			$data = array('leave_title' => $this->input->post('leave_title'),'acronym' => $this->input->post('acronym'),'type_id' => !empty($this->input->post('type_id')) ? $this->input->post('type_id') : '');
			
			if(!empty($type_id))
			{
      		$data = set_log_fields($data);
				$this->common_model->update('leave_type',$data,array('type_id' => $type_id));
				$this->session->set_flashdata('success', 'Leave type added successfully!');
			}
			else
			{
      		$data = set_log_fields($data,'insert');
				$this->common_model->insert('leave_type',$data);
				$this->session->set_flashdata('success', 'Leave type updated successfully!');
			}
      	
			redirect('leave_management');
		}  
	}

	function edit_leave_type()
	{
		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		$type_id = $this->uri->segment(3);
		$this->content->leave_type = $this->leave_model->get_leavetype_details($type_id);		
      	$this->load_view("edit_leave_type","HRMS - Edit Leave Type",$this->content);
	}

	function delete_type()
	{
		if ($this->input->is_ajax_request())
		{
			$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
			if(!empty($access))
         {
            //$this->session->set_flashdata('access_denied', 'Access Denied');
            echo '0';
         }
         else
         {
         	$type_id = $this->input->post('type_id');
         	$data['is_deleted'] = 1;
            $data = set_log_fields($data); 
            // $this->common->update('leave_type', $data, array('type_id'=>$type_id));
			   $this->leave_model->delete($tablename='leave_type',$fieldname ='type_id',$type_id);
				echo '1';
         }			
		}
	}


	function leave_balance()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());
      	$this->load_view("leave_balance","HRMS - Leave Balance",$this->content);        
	}

	 function list_leave_balance()
	{
		$superadmin = $this->config->item('super_user_role_id');
        $superadmin = implode(',', $superadmin);
		// $this->datatables->unset_column('can_id');
		$this->datatables->select('can_name, alloted_leave, balance_leave');
        $this->datatables->join('candidate', 'can_leave_records.can_id = candidate.can_id', 'left');
		$this->datatables->from('can_leave_records');
		$this->datatables->where('candidate.is_deleted',0);
		$this->datatables->where('candidate.role_id NOT IN ('.$superadmin.')');
        $result= $this->datatables->generate();  
		echo $result;
	}


	function apply_for_leave()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
      $userdata = $this->session->userdata('logged_in_user');
		$this->content->leave_types = $this->leave_model->get_leave_list();
		$this->content->can_details = $this->common_model->get_fields_by_id($tablename='candidate',$fields = array('can_name','phone1','phone2','email') , $conditions = array('can_id' => $userdata['id']));
		// debug($this->content->can_details);

		if(!empty($this->input->post()))
		{
			$post = $this->input->post();
			$leave_appl_details = array('can_id' => $userdata['id'],'from_date' => date('Y-m-d', strtotime(str_replace('/', '-', $post['from_date']))),'to_date' =>date('Y-m-d', strtotime(str_replace('/', '-', $post['to_date']))) ,'reason'=> $post['reason'], 'mobile_no' =>$post['mobile_no'],'phone_no'=>$post['phone_no'],'leave_address'=>$post['leave_address'],'status'=>'0','leave_type'=>$post['leave_type'],'applied_date'=>date('Y-m-d m:h:s'));
			$leave_appl_details = set_log_fields($leave_appl_details);
			
         $id = $this->leave_model->apply_for_leave($leave_appl_details); 
         user_activity_log($data = array('can_id' => get_login_user_id(), 'table_name' => 'leave_application' ,"operation_name" => 'insert' ,'controller'=> $this->router->fetch_class(),'method'=> 'leave_status','last_modified_on'=> date('Y-m-d h:i:s'), 'last_modified_by' => get_login_user_id(),'comment' => 'Applied for leave'));

         $reporting_mgr = $this->config->item('super_user_role_id');
         $reporting_mgr_role = $this->common_model->get_data('candidate',array('can_id'=>$userdata['reporting_to']),array('role_id'));
        
         $this->load->library('email_send');
         $mailer_config=$this->common_model->get_data('email_config',array('email_template'=>'leave_application'));
         $leave_appl_details['can_name'] = $this->content->can_details->can_name;
         $leave_appl_details['can_email'] = $this->content->can_details->email;
         $leave_appl_details['appl_id'] = $id;
			// x_debug($leave_appl_details);

         if ($reporting_mgr_role['role_id']==$reporting_mgr[0])
         {
         	$leave_appl_details['show_bttons'] = 1;
				// $user_email =  $userdata['email'];
         }
            $leave_appl_details['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
			$message = $this->load->view("email_templates/".$mailer_config["email_template"], $leave_appl_details, TRUE);
			$email_id=$this->common_model->get_data('candidate',array('can_id'=>$userdata['reporting_to']),'email');
			if(!empty($email_id))
			{
				$email_id=$email_id['email'];
			}
			$phone=$this->common_model->get_data('candidate',array('can_id'=>$userdata['reporting_to']),'phone1');
			$smsm = send_sms($phone['phone1'], "Please check your mailbox, One of your Team member has applied for leave.");
			if($this->email_send->send_mail_new($mailer_config, $email_id,$message))
			{			
	         $this->common_model->update('push_notifications',array('reporting_to'=>$userdata['reporting_to']),array('table_type'=>'leave_application','unique_field_id'=>$id));
	         $this->session->set_flashdata('success', 'Leave Application Submitted Successfully!');
	         redirect('leave_management/leave_status'); 
         }                       
		}
      $this->load_view("leave_application","HRMS - Leave Application",$this->content);        
	}
	function leave_request()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
   	$this->load_view("leave_requests","HRMS - Leave Requests",$this->content);        
	}

	function list_leave_request()
	{  
		$superadmin = $this->config->item('super_user_role_id');
        $superadmin = implode(',', $superadmin);
		$this->datatables->unset_column('appl_id');
		$leaves = $this->datatables->select('appl_id, acronym, can_name, from_date, to_date, DATEDIFF(to_date,from_date) as leave_days, CASE WHEN  leave_application.status= 0 THEN \'Pending\' WHEN  leave_application.status= 1 THEN \'Approved\' ELSE \'Rejected\' END AS  status');
		$this->datatables->join('leave_type', 'leave_application.leave_type = leave_type.type_id', 'left');
		$this->datatables->join('candidate', 'leave_application.can_id = candidate.can_id', 'left');
		$this->datatables->from('leave_application');
      // $this->datatables->where('status!=','1');
		$this->datatables->where('candidate.can_id!='.get_login_user_id());
		$this->datatables->where('candidate.role_id NOT IN ('.$superadmin.')');
		// $this->db->order_by("appl_id", "desc");
		if('status'=='Approved')
		{
			$this->datatables->add_column('change_status', '<span class="tabledit-edit-button btn btn-sm btn_assign  btn-success">Approved</span>');  
		}
		else
		{
			$this->datatables->add_column('change_status', '<a href="change_status/$1" class="tabledit-edit-button btn btn-sm btn_assign">Change Status</a>', 'appl_id');  
		}
		$result= $this->datatables->generate();
		// $lst_qry = $this->db->last_query();
		// file_put_contents('/tmp/test1.txt', $lst_qry. "\n\n", FILE_APPEND); 
		echo $result;
	}

	function employee_leave_records()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
   	$this->load_view("emp_leave_records","HRMS - Leave Requests",$this->content);        
	}

	function list_emp_leave_records()
	{  
		$superadmin = $this->config->item('super_user_role_id');
        $superadmin = implode(',', $superadmin);
		$this->datatables->unset_column('appl_id');
		$leaves = $this->datatables->select('appl_id,acronym, can_name, from_date, to_date, CASE WHEN  status= 1 THEN \'Approved\' ELSE \'Rejected\' END AS status');
		$this->datatables->join('leave_type', 'leave_application.leave_type = leave_type.type_id', 'left');
		$this->datatables->join('candidate', 'leave_application.can_id = candidate.can_id', 'left');
		$this->datatables->from('leave_application');
      	$this->datatables->where('status!=','0');
      	$this->datatables->where('candidate.role_id NOT IN ('.$superadmin.')');
		$result= $this->datatables->generate();
		// $lst_qry = $this->db->last_query();
		// file_put_contents('/tmp/test1.txt', $lst_qry. "\n\n", FILE_APPEND); 
		echo $result;
	}



	function change_status()
	{
		user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
		$appl_id = $this->uri->segment(3);
		$this->content->leave_types = $this->leave_model->get_leave_list();
      $this->content->leaveappli_details = $this->leave_model->get_leaveappli_details($appl_id);
      $this->load_view("edit_leave_appli","HRMS - Edit Leave Application",$this->content);
	}

	function change_appli_status()
	{
		if ($this->input->is_ajax_request())
		{
			$appl_id = $this->input->post('appl_id');
			$selected_status = $this->input->post('selected_status');
			$comment = $this->input->post('comment');
         $leave_appl_details = $this->leave_model->change_appli_status($appl_id,$selected_status,$comment);
      	$can_leave_details = $this->leave_model->get_can_leave_record($leave_appl_details->can_id);
        	
         if($leave_appl_details->status == 1)
         {
         	$from_date = date_create($leave_appl_details->from_date);
            $to_date = date_create($leave_appl_details->to_date);
            $diff = date_diff($from_date,$to_date);
            $leave_days = $diff->format("%R%a");
				$leave_cnt = $leave_days + 1;
				$this->leave_model->update_can_balance_leave($leave_appl_details->can_id,$can_leave_details->balance_leave,$leave_cnt);
				/* send approval email to employee */
				$this->content->can_details = $this->common_model->get_fields_by_id($tablename='candidate',$fields = array('can_name','email') , $conditions = array('can_id' => $leave_appl_details->can_id));
				$this->load->library('email_send');
	         $mailer_config=$this->common_model->get_data('email_config',array('email_template'=>'leave_approved'));
	         $leave_appl_details->can_name = $this->content->can_details->can_name;
	         $leave_appl_details->can_email = $this->content->can_details->email;
	         $leave_appl_details->appl_id = $appl_id; 
            $leave_appl_details->logo_img = $this->common_model->get_data('configuration_settings','','company_inner_logo');
				$message = $this->load->view("email_templates/".$mailer_config["email_template"], $leave_appl_details, TRUE);
			$phone=$this->common_model->get_data('candidate',array('can_id'=>$leave_appl_details->can_id),'phone1');
			$smsm = send_sms($phone['phone1'], "Please check your mailbox, Your leave is approved.");

	         if($this->email_send->send_mail_new($mailer_config, $this->content->can_details->email, $message))
				{
					$this->common_model->update('push_notifications',array('reporting_to'=>$userdata['reporting_to']),array('table_type'=>'leave_application','unique_field_id'=>$id));
					echo "1";
           	}
         }
         else if ($leave_appl_details->status == '0')
         {
         	echo "2";
         }
         else if($leave_appl_details->status == '2')
         {
         	echo "3";
         }
          
		}
	}
	
	function leave_status()
	{
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
   	$this->load_view("leave_status","HRMS - Leave Status",$this->content);        
	}

	function processed_leave_appli_list()
	{
		$userdata = $this->session->userdata('logged_in_user');
		$leaves = $this->datatables->select('acronym, can_name, from_date, to_date, DATEDIFF(to_date,from_date) as leave_days, CASE WHEN  status= 1 THEN \'Approved\' WHEN  status= 0 THEN \'Pending\' ELSE \'Rejected\' END AS status');
		$this->datatables->join('leave_type', 'leave_application.leave_type = leave_type.type_id', 'left');
		$this->datatables->join('candidate', 'leave_application.can_id = candidate.can_id', 'left');
		$this->datatables->from('leave_application');
      $this->datatables->where('leave_application.can_id=',$userdata['id']);
		$result= $this->datatables->generate();
		echo $result;	
	}

	function get_can_leaves()
	{
		if ($this->input->is_ajax_request())
		{
			$can_id = $this->input->post('can_id');
			$from_date = date_to_db($this->input->post('from_date'));
			$can_leave_list = $this->leave_model->get_can_leaves_applications($can_id,$from_date);
			if($can_leave_list > 0)
			{
				echo "1";
			}
		}
	}


	function app_rej_leave()
	{
		$email = base64_decode($_GET['em']);
		$appl_id = $_GET['appl_id'];
		$status = $_GET['status'];
      $leave_appl_details = $this->leave_model->change_appli_status($appl_id,$status,$comment='');
   	$can_leave_details = $this->leave_model->get_can_leave_record($leave_appl_details->can_id);
        
         if($leave_appl_details->status == '1')
         {
         	$from_date = date_create($leave_appl_details->from_date);
            $to_date = date_create($leave_appl_details->to_date);
            $diff = date_diff($from_date,$to_date);
            $leave_days = $diff->format("%R%a");

   			//echo $leave_days = $leave_appl_details->to_date - $leave_appl_details->from_date;exit;
				$leave_cnt = $leave_days + 1;
				$this->leave_model->update_can_balance_leave($leave_appl_details->can_id,$can_leave_details->balance_leave,$leave_cnt);

				/* send approval email to employee */
				$this->content->can_details = $this->common_model->get_fields_by_id($tablename='candidate',$fields = array('can_name','email') , $conditions = array('can_id' => $leave_appl_details->can_id));
				// x_debug($this->content->can_details);
				$this->load->library('email_send');
	         $mailer_config=$this->common_model->get_data('email_config',array('email_template'=>'leave_approved'));
	         $leave_appl_details->can_name = $this->content->can_details->can_name;
	         $leave_appl_details->can_email = $this->content->can_details->email;
	         $leave_appl_details->appl_id = $appl_id; 

                $leave_appl_details['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
				$message = $this->load->view("email_templates/".$mailer_config["email_template"], $leave_appl_details, TRUE);

	         if($this->email_send->send_mail_new($mailer_config, $this->content->can_details->email, $message))
				{
					$this->common_model->update('push_notifications',array('reporting_to'=>$userdata['reporting_to']),array('table_type'=>'leave_application','unique_field_id'=>$appl_id));					
         		// $this->session->set_flashdata('success', 'Leave status updated successfully!');
           		// redirect('leave_management/leave_request');
           	}
           	
         	// $this->session->set_flashdata('success', 'Leave status updated successfully!');
            //redirect(site_url()); 
         }
	}

/*	function get_leave_balance()
	{	
		// $this->content->can_details = $this->get_candidate_data($can_id);
		$leave = 0.0;
		$doj =  "2017-11-25";
		$month = date("m", strtotime($doj));
		$date = date("d", strtotime($doj));

		if($date >= 1 && $date <= 7){
			$leave = 2.0;
		}

		if($date >=8 && $date <= 15){
			$leave = 1.5;
		}   

		if($date >=16 && $date <= 21){
			$leave = 1;
		}           

		if($date >=22 && $date <= 31){
			$leave = 0.5;
		}

		$m_leave = 24.0 -(2 * $month);

		echo $total = $leave + $m_leave;
	}*/

	/*function update_can_balance_leave($leaveappli_details,$can_leave_details)
	{
		$leave_days = $leaveappli_details->to_date - $leaveappli_details->from_date;
		$leave_cnt = $leave_days + 1;
		// echo $leave_days = date_diff($leaveappli_details->to_date,$leaveappli_details->from_date);
		// echo $leave_days->format("%R%a");exit;
		// $leave_cnt = $can_leave_details->balance_leave - $leave_days;
		return $this->leave->update_can_balance_leave($leaveappli_details->can_id,$can_leave_details->balance_leave,$leave_cnt);
	}*/

	function get_days_in_month()
	{
		echo $this->cal_days_in_month('2017-02-01');
	}

	function cal_days_in_month($date)
	{
		$month = date("m", strtotime($date));
		$year = date("Y", strtotime($date));
		return  $days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
	}

/*	function get_sun_in_month()
	{
		echo $this->cal_total_sundays(10,2017);
	}

	function cal_total_sundays($month,$year)
	{
		$sundays=0;
		$total_days=cal_days_in_month(CAL_GREGORIAN, $month, $year);
		for($i=1;$i<=$total_days;$i++)
		if(date('N',strtotime($year.'-'.$month.'-'.$i))==7)
		$sundays++;
		return $sundays;
	}*/

	function cal_weekoff_sun()
	{
		echo "Sundays:".$this->countDays(2017, 10, array(0));	
	}

	function cal_weekoff_sat()
	{
		echo "Saturdays:".$this->countDays(2017, 10, array(6));	
	}

	function countDays($year, $month, $ignore) {
		$count = 0;
		$counter = mktime(0, 0, 0, $month, 1, $year);
		while (date("n", $counter) == $month) {
		if (in_array(date("w", $counter), $ignore) == true) {
		$count++;
		}
		$counter = strtotime("+1 day", $counter);
		}
		return $count;
	}

	function get_public_holidays_in_month()
	{
		$date = date('Y-m-d');
		$month = date("m", strtotime($date));
		$year = date("Y", strtotime($date));
		return $public_holidays = $this->holiday_model->get_public_holidays_in_month($month,$year);
	}


	private function load_view($viewname= "blank_page",$page_title)
	{
		$this->content->meta_description="Meta meta_description here!";
		$this->content->meta_keywords="meta keywords here!";
		$this->masterpage->setMasterPage('master');
		$this->content->page_description = "";
		$this->masterpage->setPageTitle($page_title);
		$this->masterpage->addContentPage('leaves/'.$viewname,'content',$this->content);
		$this->masterpage->show();
	}
	 //function to view indiviual leave
    public function view()
    {
        user_access_operation($this->router->fetch_class(),$this->router->fetch_method());  
        $userdata = $this->session->userdata('logged_in_user');
        $type_id =$this->uri->segment(3); 
        $this->content->leave_details=$this->leave_model->get_leavetype_details($type_id);
        $this->load_view("read_leave","HRMS - View Leave",$this->content);
    }

    public function leave_balance_details()
    {
        // user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        $holidays = count($this->common_model->get_data('holiday', array('holiday_year'=>date('Y'), 'is_deleted'=>0)));
        $leave_details = $this->common_model->get_data('can_leave_records', array('can_id'=>get_login_user_id(), 'is_deleted'=>0));
        if(empty($leave_details))
        {
        	$leave_details['alloted_leave'] = 0;
        	$leave_details['balance_leave'] = 0;
        }
        $leave_taken = array();
        $leaves = array();
        $this->db->select('*');
		$this->db->from('candidate');
		$this->db->join('leave_application', 'leave_application.can_id = candidate.can_id');
		$this->db->where('candidate.can_id', get_login_user_id());
		$this->db->where('leave_application.can_id', get_login_user_id());
		$leave_taken = $this->db->get()->result_array();
        // $leave_taken = $this->common_model->get_data_array('leave_application', array('can_id'=>get_login_user_id(), 'is_deleted'=>0));
        $leave_type = $this->common_model->get_data_array('leave_type', array('is_deleted'=>0));
        $configuration = $this->common_model->get_data('configuration_settings', array('conf_id'=>1));
        if(!empty($leave_type))
        {
        	foreach ($leave_type as $keylt => $valuelt)
        	{
        		$leave_type[$keylt]['days'] = 0;
        	}
        }
        if(!empty($leave_taken))
        {
        	foreach ($leave_taken as $key => $value)
        	{
        		if($value['status'] == 1)
        		{
	        		foreach ($leave_type as $keyl => $valuel)
	        		{
	        			if($valuel['type_id'] == $value['leave_type'])
	        			{
			        		$date = date_create($value['from_date']);
				            $ndate = date_create($value['to_date']);
				            $diff = date_diff($date,$ndate);
				            $d = $diff->format("%R%a");
				            ++$d;
				            $leave_type[$keyl]['days'] = $valuel['days'] + $d;
				        }
			        }
			    }
			    if(!empty($value['reporting_to']))
			    {
			    	$reporting_to = $this->common_model->get_data('candidate', array('can_id'=>$value['reporting_to']));
			    	$leave_taken[$key]['reporting_to'] = $reporting_to['can_name'];
			    }
        	}
        }
        // var_dump($holidays);
        $this->content->leave_details = $leave_details;
        $this->content->holiday = $holidays;
        $this->content->configuration = $configuration;
        $this->content->leave_type = $leave_type;
        $this->content->leave_taken = $leave_taken;
        $this->load_view("leave_balance_details","HRMS - View Leave",$this->content);
    }

}


//=============================

//get number of days in month
//$d=cal_days_in_month(CAL_GREGORIAN,11,2017);



//==========================
/*
function countWeekendDays($start, $end)
{
    // $start in timestamp
        // $end in timestamp


    $iter = 24*60*60; // whole day in seconds
    $count = 0; // keep a count of Sats & Suns

    for($i = $start; $i <= $end; $i=$i+$iter)
    {
        if(Date('D',$i) == 'Sat' || Date('D',$i) == 'Sun')
        {
            $count++;
        }
    }
    return $count;
   }
*/
//==================

