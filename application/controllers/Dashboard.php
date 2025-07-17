<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('dashboard_model');
		$this->load->model('common_model','common');
		// $logged_in = $this->session->userdata['logged_in'];
		$userdata = $this->session->userdata('logged_in_user');
		if(!$userdata)
		{
			$newURL = site_url()."/login";
			header('Location: '.$newURL);
		}
		set_user_widgets();
   }

	public function index($msg="")
	{
		
		user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
		//$this->content->widgets=$this->session->widgets;0
		if(in_array($this->session->role_id,$this->config->item('super_user_role_id')))
		{
			$this->content->widgets=range(1, 20);			
		}
		else
		{
			$this->content->widgets=$this->session->widgets;
		}
		// x_debug($this->session->widgets);
		$this->load_view("dashboard","HRMS - Dashboard",$this->content);        
	}

	private function load_view($viewname= "blank_page",$page_title)
	{
		$this->content->meta_description="Meta meta_description here!";
		$this->content->meta_keywords="meta keywords here!";
		$this->masterpage->setMasterPage('master');
		$this->content->page_description = "";
		$this->masterpage->setPageTitle($page_title);
		$this->masterpage->addContentPage($viewname,'content',$this->content);
		$this->masterpage->show();
	}
 
	public function get_tasks_list()
	{
		$userdata = $this->session->userdata('logged_in_user');
		echo json_encode($this->dashboard_model->get_tasks_list($userdata['id']));
	}

	public function get_leaves_list()
	{
		echo json_encode($this->dashboard_model->get_leaves_list(get_login_user_id()));
	}

	public function get_attendance_details()
	{
		$month = date('m');
		$year = date('Y');
		$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$p=$e =$h =$l=0;
		$rec = $this->common->get_data('attendance',array('can_id'=>get_login_user_id(), 'month'=>$month, 'year'=>$year));
		for($i = 1; $i <= $days; $i++)
        {
        	if(($rec['d'.$i.'_in_time'] != NULL) || ($rec['d'.$i.'_out_time'] != NULL))
        	{
        		++$p;
        		if(!empty($rec['d'.$i.'_in_time']) && $rec['d'.$i.'_in_time'] > $this->config->item('late_mark_time'))
        		{
        			++$l;
        		}
        		if(!empty($rec['d'.$i.'_out_time']) && $rec['d'.$i.'_out_time'] < $this->config->item('office_out_time'))
        		{
        			++$e;
        		}
        	}
        	if(($rec['d'.$i.'_hours'] >= $this->config->item('half_hours_per_day')) && ($rec['d'.$i.'_hours'] < $this->config->item('hours_per_day')) && !empty($rec['d'.$i.'_hours']))
    		{
    			++$h;
    		}
        }
        $data = array();
        $data['present'] = $p;
        $data['half'] = $h;
        $data['late'] = $l;
        $data['early'] = $e;
		echo json_encode($data);
	}

	public function get_pie_chart()
	{
		echo json_encode($this->dashboard_model->get_pie_chart(get_login_user_id()));
	}

	public function get_events()
	{
		echo json_encode($this->dashboard_model->get_events(get_login_user_id()));
	}

	public function get_travels()
	{
		echo json_encode($this->dashboard_model->get_travels(get_login_user_id()));
	}
	public function get_performace_report_highcharts()
    {
      $query="select k.month as months, avg(user_rating_average) as user_rating_average,avg(manager_rating_average) as manager_rating_average from kra_employee ke  left join kra k  on k.kra_id =ke.kra_id where ke.can_id='".get_login_user_id()."' and ke.status !=0 group by k.month";
      // print_r($query);
      // exit;
      $data=$this->common_model->getByQuery($query);
		
      $data=array_group_by($data,'months');
		$month_array= array(1=>"Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

		  $categoryArray=array();
		foreach ($month_array as $key => $value) {
			if(!array_key_exists($value, $data))
			{
				$categoryArray[]=array("Day"=>$value,'user_rating_average'=>0,'manager_rating_average'=>0);
			}
			else
			{
				unset($data[$key][0]['months']);
				$categoryArray[]=array("Day"=> $value,'user rating average'=>$data[$value][0]['user_rating_average'],'manager rating average'=>$data[$value][0]['manager_rating_average']);
				unset($data[$key]);
				unset($data[$key]);
			}
		}
		
		$array=$categoryArray;
		echo(json_encode($array,JSON_NUMERIC_CHECK));
    }
	public function get_performace_report_old()
	{
		$this->load->model('common_model');
		$this->load->helper('common');
		$query="select MONTH(t.tat) as months, count(CASE WHEN tm.status = 'Completed' THEN tm.can_id ELSE NULL END) as Completed,count(CASE WHEN tm.status != 'Completed' THEN tm.can_id ELSE NULL END) as Pending  from tasks  t inner join task_manager  tm on tm.task_id =t.task_id where tm.can_id='".get_login_user_id()."' and t.is_deleted=0 and YEAR(t.tat) =".date('Y')." group by months";
		//print_r($query);

		$data=$this->common_model->getByQuery($query);
		 //x_debug($data);
		$data=array_group_by($data,'months');
		$month_array= array(1 =>"January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December");

		  $categoryArray=array();
          $dataseries1['seriesName']='Pending Tasks';
          $dataseries1['showValues']='1';
          $dataseries2['seriesName']='Completed Tasks';
          $dataseries2['showValues']='1';
          
		foreach ($month_array as $key => $value) {
			$categoryArray['category'][]=array("label"=>$value);
			if(!array_key_exists($key, $data))
			{

				// $data[$month_array[$key]]=array('Completed'=>0,'Pending'=>0);
				$dataseries1['data'][]=array('value'=>0);
				$dataseries2['data'][]=array('value'=>0);
			}
			else
			{
				unset($data[$key][0]['months']);
				// $data[$month_array[$key]]=$data[$key][0];	
				$dataseries1['data'][]=array('value'=>$data[$key][0]['Pending']);
				$dataseries2['data'][]=array('value'=>$data[$key][0]['Completed']);
				unset($data[$key]);
				unset($data[$key]);
			}
		}
		
		$array['categories']=$categoryArray;
		$array['dataset'][]=$dataseries1;
		$array['dataset'][]=$dataseries2;
		//x_debug($array);
		echo(json_encode($array));
	}
	public function get_performace_report_highcharts_old()
	{
		$this->load->model('common_model');
		$this->load->helper('common');
		$query="select MONTH(t.tat) as months, count(CASE WHEN tm.status = 'Completed' THEN tm.can_id ELSE NULL END) as Completed,count(CASE WHEN tm.status != 'Completed' THEN tm.can_id ELSE NULL END) as Pending  from tasks  t inner join task_manager  tm on tm.task_id =t.task_id where tm.can_id='".get_login_user_id()."' and t.is_deleted=0 and YEAR(t.tat) =".date('Y')." group by months";
		//print_r($query);

		$data=$this->common_model->getByQuery($query);
		// x_debug($data);
		$data=array_group_by($data,'months');
		$month_array= array(1 =>"January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December");

		  $categoryArray=array();
		foreach ($month_array as $key => $value) {
			if(!array_key_exists($key, $data))
			{
				$categoryArray[]=array("Day"=>substr($value, 0, 3),'Pending Task'=>0,'Completed Task'=>0);
			}
			else
			{
				unset($data[$key][0]['months']);
				$categoryArray[]=array("Day"=> substr($value, 0, 3),'Pending Task'=>$data[$key][0]['Pending'],'Completed Task'=>$data[$key][0]['Completed']);
				unset($data[$key]);
				unset($data[$key]);
			}
		}
		
		$array=$categoryArray;
		echo(json_encode($array,JSON_NUMERIC_CHECK));
	}

	public function get_jobs()
	{
		echo json_encode($this->dashboard_model->get_jobs());
	}

	public function get_all_jobs()
	{
		echo json_encode($this->dashboard_model->get_all_jobs());
	}
	public function get_news()
	{
		echo json_encode($this->dashboard_model->get_news());
	}
	public function get_avg_employee_age()
	{
		$data=$this->common->get_data('candidate',array('is_deleted'=>0,'is_active'=>1),'AVG((TO_DAYS(NOW())-TO_DAYS(candidate.dob)))/365 as avg');
		if(!empty($data))
		{
			echo $data['avg'];
		}

	}
	function get_dept_average_salary()
	{
	  $rec = $this->dashboard_model->get_dept_average_salary();
		$res = array();
		if(!empty($rec))
		{
			foreach ($rec as $key => $value) {
				$res[$key]['label'] = $value['department_title'];
				$res[$key]['value'] = $value['average_salary'];
			}
		}
		echo json_encode($res);
	}

	function get_dept_emp_count()
	{
		$rec = $this->dashboard_model->get_dept_emp_count();
		if(!empty($rec))
		{
			foreach ($rec as $key => $value) {
				$res[$key]['label'] = $value['department_title'];
				$res[$key]['value'] = $value['count'];
			}
		}
		echo json_encode($res);
	}
	function get_dept_emp_count_highchart()
	{
		$rec = $this->dashboard_model->get_dept_emp_count();
		$res = array();
		if(!empty($rec))
		{
			foreach ($rec as $key => $value) {
				$res[] = array('name'=>$value['department_title'],"y"=>$value['count'],'url'=>site_url().'/candidate/get_candidates_data/'.$value['id']);
				
			}
		}
		echo json_encode($res,JSON_NUMERIC_CHECK);
	}

	public function get_resignations()
	{
		$year = date('Y');
		for($i = 1; $i <= 12; $i++)
		{
			// var_dump(date("F", mktime(0, 0, 0, $i, 10)));
			$data['label'][] = array("label"=>date("M", mktime(0, 0, 0, $i, 10)));
			$data['joinee'][] = array("value"=>$this->common->count_all('candidate', array('is_deleted'=>0, 'joining_date like'=>'%'.$year.'-'.date("m", mktime(0, 0, 0, $i, 10)).'%')));
			$data['resignation'][] = array("value"=>$this->common->count_all('resignation_details', array('hr_status'=>1, 'pm_status'=>1, 'md_status'=>1, 'req_rel_date like'=>'%'.$year.'-'.date("m", mktime(0, 0, 0, $i, 10)).'%'),'DISTINCT(can_id)'));
		}
		echo json_encode($data);
	}

	function user_profile_details()
	{
		$userdata['profile'] = $this->common_model->get_fields_by_id($tablename='candidate',$fields = array('can_name','phone1','email','pan_no','aadhar_no') , $conditions = array('can_id' => get_login_user_id()));
		$userdata['salary'] = $this->common_model->get_fields_by_id($tablename='emp_salary_details',$fields = array('pf_no','esic_no') , $conditions = array('can_id' => get_login_user_id(),'is_deleted' => 0));
		$userdata['bank_details'] = $this->common_model->get_fields_by_id($tablename='bank_details',$fields = array('account_number') , $conditions = array('can_id' => get_login_user_id(),'is_deleted' => 0));
		echo json_encode($userdata);		
	}

	 function user_recent_activities()
	{
		$data['activities'] = $this->common_model->get_data_array_order_by('user_activities', array('last_modified_by'=>get_login_user_id()), 'activity_id,can_id,comment,controller,method,last_modified_on',array('activity_id','desc'),5);
		$t_data='';
		if(!empty($data['activities']))
		{
			$t_data = '<ul class="recent_activites">';
	               
			foreach($data['activities'] as $key=>$value)
			{
				$t_data .='<a href="'.site_url().'/'.$value['controller'].'/'.$value['method'].'/'.get_login_user_id().'"><li class="list-group-item d-flex justify-content-between recent_list"><div><div class="media-body lh-1"><div><span>'.$value['comment'].' </span></div></div></div><small class="text-muted">'.get_time_difference($value['last_modified_on']).'</small></li></a>';
			}
			 $t_data.='</ul>';
		}
		echo $t_data;
	}


	function get_user_birthdays()
	{
		$this->load->model('candidate_model');
		$new_array = array();
		$todays_birthdays = array();
		$upcoming_birthdays =array();
		$final_array = array();
		// $data['birthdays'] = $this->common_model->get_data_array('candidate', array(('MONTH(dob)')=>date('m'), ('DAY(dob)')=>date('d') ,'is_deleted'=>0), 'can_id,can_name,email,profile_picture,dob');

		$data['birthdays'] = $this->candidate_model->get_user_birthdays();
		// debug($data['birthdays']);
		foreach ($data['birthdays'] as $key => $value)
		{
			$day =  date('d',strtotime($value['dob']));
			if($this->common_model->count_all('birthday_wishes',array('wish_to'=>$value['can_id'],'can_id'=>get_login_user_id(),'YEAR(on_date)'=>date('Y') ,'DAY(on_date)' => date('d'))) > 0)
			{
				$value['wished'] = 1;
			}
			else
			{
				$value['wished'] = 0;							
			}
			// echo file_exists(PROFILE_PATH.$value['profile_picture']);
			if($value['profile_picture']!='' && file_exists(PROFILE_PATH.$value['profile_picture']))
			{
				$value['is_image_exist'] =1;
				$new_array = $value;
			}
			else
			{
				$value['is_image_exist'] = 0;
				$new_array = $value;
			}

			if($day==date('d'))
			{
				$value['likes'] = $this->common_model->count_all('birthday_likes',array('can_id'=> $value['can_id']));
				$value['already_liked'] = $this->common_model->count_all('birthday_likes',array('can_id'=> $value['can_id'],'like_from'=> get_login_user_id(),'YEAR(on_date)'=>date('Y')));
				$value['is_today'] = 1;
				$new_array = $value;
				array_push($todays_birthdays, $new_array);
			}

			else if($day > date('d'))
			{
				$value['is_today'] = 0;
				$string = format_date($value['dob']);

				$date = DateTime::createFromFormat("d/m/Y", $string);
				$date->format("d"); //day
				$month_name =  $date->format("F"); //month
				$date->format("Y"); //year

				$value['month_name']=substr($month_name, 0, 3);

				$new_array = $value;
				array_push($upcoming_birthdays, $new_array);
			}
			// $new_array = $value;
			// array_push($final_array, $new_array);
		}
		$final_array['todays_birthdays'] = $todays_birthdays;
		$final_array['upcoming_birthdays'] = $upcoming_birthdays;

		// x_debug($final_array);
		echo json_encode($final_array);
	}

	function get_interview(){

		$criteria=array('schedule_date'=> date('Y-m-d'));
		$fields='full_name,email_id,mobile_no';
		echo json_encode($this->common_model->get_data_array('interview_candidate_records',$criteria,$fields));
	}

	function get_rpo_user_profile_details()
	{
		$userdata = $this->dashboard_model->get_rpo_user_profile_details(get_login_user_id());
		echo json_encode($userdata);		
	}

	public function get_performace_report_highcharts_new()
    {
      // $query="select k.month as months, avg(user_rating_average) as user_rating_average,avg(manager_rating_average) as manager_rating_average from kra_employee ke  left join kra k  on k.kra_id =ke.kra_id where ke.can_id='".get_login_user_id()."' and ke.status !=0 group by k.month";

		if (!$this->db->table_exists('kra_view') )
		{
			$this->db->query('CREATE OR REPLACE VIEW kra_view AS SELECT `kra`.`month` AS months, avg(user_rating_average) as user_rating_average,avg(manager_rating_average) as manager_rating_average,`kra_employee`.`can_id`  FROM `kra_employee` LEFT JOIN `kra` ON `kra`.`kra_id`  = `kra_employee`.`kra_id` WHERE `kra_employee`.`status`!=0 GROUP BY `kra`.`month` AND `kra`.`is_active` = 1');
		}

		$query = "SELECT * FROM kra_view WHERE can_id=".get_login_user_id();
      $data=$this->common_model->getByQuery($query);
		
      $data=array_group_by($data,'months');
		$month_array= array(1=>"Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

		  $categoryArray=array();
		  $array = array();

          $dataseries1['seriesName']='User Rating Average';
          $dataseries1['showValues']='1';
          $dataseries2['seriesName']='Manager Rating Average';
          $dataseries2['showValues']='1';
          
		foreach ($month_array as $key => $value) {
			$categoryArray['category'][]=array("label"=>$value);
			if(!array_key_exists($value, $data))
			{
				$dataseries1['data'][]=array('value'=>0);
				$dataseries2['data'][]=array('value'=>0);
			}
			else
			{
				unset($data[$key][0]['months']);
				$dataseries1['data'][]=array('value'=>$data[$value][0]['user_rating_average']);
				$dataseries2['data'][]=array('value'=>$data[$value][0]['manager_rating_average']);
				unset($data[$key]);
				unset($data[$key]);
			}
		}
		
		$array['categories']=$categoryArray;
		$array['dataset'][]=$dataseries1;
		$array['dataset'][]=$dataseries2;
		echo(json_encode($array));
    }

//My theme cookie
	public function my_theme()
	{
		if($this->input->is_ajax_request())
      {
         $theme = $this->input->post('theme',TRUE);
         $cookie = array(
                        'name'   => 'theme',
                        'value'  => $theme,
                        'expire' => 86400*30,//'86500',
                        'path'  =>'/'
                    );
         $this->input->set_cookie($cookie);
         $cookie_data = $this->input->cookie();
      }
	}

	public function get_emp_cnt()
    {
    	$res = $this->common_model->count_all('candidate',array('is_deleted'=>0));
    	echo json_encode($res);
    }

    public function toggle_db()
    {
    	$toggle_val=$this->input->post('toggle_val');
    	if($toggle_val=='true')
    	{		
    		$this->session->set_userdata('active_db','hrms');
    	}
    	else
    	{	
    		$this->session->set_userdata('active_db','hrms_global');
    	}
    }
}
