<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Attendance extends My_Controller
{

	public function __construct() {
		Parent::__construct();
		$this->load->model("attendance_model");
        $this->load->model('common_model','common');
	}

    function index()
    {
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());
        $this->db->select('month,year');
        $this->db->from('attendance');
        $this->db->where('can_id', get_login_user_id());
        $this->content->attendance_list = $this->db->get()->result_array();
        $this->load_view("own_attendance_list","HRMS - Attendance List",$this->content);   
    }

    public function import_attendance($msg="")
    {
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());
        $this->load_view("import_attendance","HRMS - Import Atandance",$this->content);
    }

	private function load_view($viewname= "blank_page",$page_title)
	{
		$this->content->meta_description="Meta meta_description here!";
		$this->content->meta_keywords="meta keywords here!";
		$this->masterpage->setMasterPage('master');
		$this->content->page_description = "";
		$this->masterpage->setPageTitle($page_title);
		$this->masterpage->addContentPage('attendance/'.$viewname,'content',$this->content);
		$this->masterpage->show();
	}

    function update_or_insert($record = '')
    {
        $rec = $this->common->get_data('attendance',array('can_id'=>$record['can_id'], 'month'=>$record['month'], 'year'=>$record['year']), 'atn_id');
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
        $this->db->from('attendance');
        $this->db->group_by('year, month');
        $this->content->attendance_list = $this->db->get()->result_array();
        $this->load_view("attendance_list","HRMS - Attendance List",$this->content);
    }

    function attendance_view($month = '', $year = '')
    {
        user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        $superadmin = $this->config->item('super_user_role_id');
        $superadmin = implode(',', $superadmin);
        $records = $this->db->select('attendance.*,candidate.can_name,candidate.can_id')->from('attendance')->join('candidate', 'candidate.can_id = attendance.can_id', 'inner')->where(array('month'=>$month, 'year'=>$year, 'attendance.is_deleted'=>0))->where('candidate.role_id NOT IN ('.$superadmin.')')->get()->result_array();
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
                $p = 0;
                $e = 0;
                $h = 0;
                $hol = 0;
                $w = 0;
                $sats = 0;
                $atten[$key]['name'] = $value['can_name'];
                $atten[$key]['can_id'] = $value['can_id'];
                $atten[$key]['month'] = $month;
                $atten[$key]['year'] = $year;
                for($i = 1; $i <= $days; $i++)
                {
                    if($value['d'.$i.'_hours'] >= $this->config->item('hours_per_day'))
                    {
                        $p++;
                        $atten[$key][$i.'-presenty'] = 'P';
                        $atten[$key][$i.'-day_color'] = 'darkgreenbg';
                    }
                    else if(($value['d'.$i.'_hours'] >= $this->config->item('half_hours_per_day')) && ($value['d'.$i.'_hours'] < $this->config->item('grace_time')))
                    {
                        if($e >= 2)
                        {
                            $h++;
                            $atten[$key][$i.'-presenty'] = 'H';
                            $atten[$key][$i.'-day_color'] = 'cyan-colorbg';
                        }
                        else
                        {
                            $e++;
                            $p++;
                            $atten[$key][$i.'-presenty'] = 'P';
                            $atten[$key][$i.'-day_color'] = 'darkgreenbg';
                        }
                    }
                    else if(($value['d'.$i.'_hours'] >= $this->config->item('grace_time')) && ($value['d'.$i.'_hours'] < $this->config->item('hours_per_day')))
                    {
                        $h++;
                        $atten[$key][$i.'-presenty'] = 'H';
                        $atten[$key][$i.'-day_color'] = 'cyan-colorbg';
                    }
                    else
                    {
                        $atten[$key][$i.'-presenty'] = 'A';
                        $atten[$key][$i.'-day_color'] = 'yellow-colorbg';
                    }
                    $leaves = $this->db->get_where('leave_application', array('can_id'=>$value['can_id'], 'from_date <='=>$year.'-'.$month.'-'.$i, 'to_date >='=>$year.'-'.$month.'-'.$i, 'is_deleted'=>0))->num_rows();
                    if($leaves > 0)
                    {
                        if($atten[$key][$i.'-presenty'] == 'A')
                        {
                            $atten[$key][$i.'-presenty'] = 'L';
                            $atten[$key][$i.'-day_color'] = 'bg_red';
                        }
                    }
                    $holidays = $this->db->get_where('holiday', array('holiday_date'=>$year.'-'.$month.'-'.$i, 'is_deleted'=>0))->num_rows();
                    if($holidays > 0)
                    {
                        $hol++;
                        if($atten[$key][$i.'-presenty'] == 'A')
                        {
                            $atten[$key][$i.'-presenty'] = 'O';
                            $atten[$key][$i.'-day_color'] = 'bgdarkpink';
                        }
                    }
                    if(date('N',strtotime($year.'-'.$month.'-'.$i)) == 7)
                    {
                        $w++;
                        if($atten[$key][$i.'-presenty'] == 'A')
                        {
                            $atten[$key][$i.'-presenty'] = 'W';
                            $atten[$key][$i.'-day_color'] = 'bg-purple';
                        }
                    }
                    if(date('N',strtotime($year.'-'.$month.'-'.$i)) == 6)
                    {
                        $sats++;
                        if(in_array($sats, $this->config->item('weekoff_sat')))
                        {
                            $w++;
                            if($atten[$key][$i.'-presenty'] == 'A')
                            {
                                $atten[$key][$i.'-presenty'] = 'W';
                                $atten[$key][$i.'-day_color'] = 'bg-purple';
                            }
                        }
                    }
                }
                $p_days = $p + ($h / 2);
                $a_days = $hol + $w;
                $wd = $days - $a_days;
                $abs = $wd - $p_days;
                if($abs <= 0)
                {
                    $abs = 0;
                }
                $atten[$key]['total'] = '<span class="text-success">Present : <strong>'.$p_days.'</strong></span> <br/><span class="text-danger">Absent : <strong>'.$abs.'</strong></span>';
            }
            $this->content->attendance_records = $atten;
            $this->load_view("attendance_detail_view","HRMS - Attendance Details",$this->content);
        }
    }

    function check_decimal($num = '')
    {
        $num = number_format($num, 2);
        if(($num > 0) && ($num < 24))
        {
            if(stripos($num, '.') !== FALSE)
            {
                $nums = explode('.', $num);
                if($nums[1] >= 60)
                {
                    return FALSE;
                }
                else
                {
                    return TRUE;
                }
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    function save_attendance()
    {
        $access = user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
        if(!empty($access))
        {
            echo json_encode(array("result"=>1,"msg"=>"Access Denied"));
        }
        else
        { 
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
                            $upload_path = UPLOADPATH."documents/";
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
                                unlink($file_name);
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
                                    for ($c = 0; $c < $num; $c++) {
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
                                foreach ($attendance_details as $key => $value)
                                {
                                    $vals = count($value);
                                    if($vals <= 65)
                                    {
                                        if(!empty($value[0]) && ($value[0] == 'Attendance Date'))
                                        {
                                            $year = date('Y', strtotime($value[3]));
                                            $month = date('m', strtotime($value[3]));
                                            $import_id = $this->common->get_data('attendance', array(), 'max(import_id) as max_import');
                                        }
                                        else if(!empty($value[0]) && is_numeric($value[0]) && !empty($value[1]) && is_numeric($value[1]) && !array_search($value[1], $atten_details) && ($value[0] != 'Attendance Date'))
                                        {
                                            if(!in_array($value[2], $can_ids))
                                            {
                                                $can_id = $this->common->get_data('candidate', array('can_name LIKE'=>'%'.$value[2].'%'), 'can_id');
                                                if(!empty($can_id))
                                                {
                                                    $atten_details[$key]['can_id'] = $can_id['can_id'];
                                                    $atten_details[$key]['month'] = $month;
                                                    $atten_details[$key]['year'] = $year;
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
                                    else
                                    {
                                        $blank++;
                                    }
                                }
                                if($blank > 0)
                                {
                                    echo "5";
                                    exit;
                                }
                                foreach ($attendance_details as $key1 => $value1)
                                {
                                    if(!empty($value1[0]) && ($value1[0] == 'Attendance Date'))
                                    {
                                        $day = ltrim(date('d', strtotime($value1[3])), 0);
                                    }
                                    else if(!empty($value1[0]) && is_numeric($value[0]) && !empty($value1[1]) && is_numeric($value1[1]) && !array_search($value1[1], $atten_details) && ($value1[0] != 'Attendance Date'))
                                    {
                                        foreach ($atten_details as $key2 => $value2)
                                        {
                                            if($value2['name'] == $value1[2])
                                            {
                                                $atten_details[$key2]['d'.$day.'_in_time'] = $value1[5];
                                                $atten_details[$key2]['d'.$day.'_out_time'] = $value1[7];
                                                $atten_details[$key2]['d'.$day.'_hours'] = $value1[12];
                                            }
                                        }
                                    }
                                }
                                if($blank > 0)
                                {
                                    echo "5";
                                    exit;
                                }
                                $cnt = count($atten_details);
                                foreach ($atten_details as $key1 => $value1)
                                {
                                    $decide = $this->update_or_insert($value1);
                                    unset($value1['name']);
                                    if($decide <= 0)
                                    {
                                        $atten_record = set_log_fields($value1, 'insert');
                                        $res = $this->common->insert('attendance',$atten_record);
                                        if($res > 0)
                                        {
                                            $i++;
                                        }
                                    }
                                    else
                                    {
                                        $atten_record = set_log_fields($value1);
                                        $res = $this->common->update('attendance',$atten_record,array('atn_id'=>$decide));
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
    }

    function attendance_indiv_view($month = '', $year = '',$can_id='')
    {
        user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        $superadmin = $this->config->item('super_user_role_id');
        $superadmin = implode(',', $superadmin);
        $records = $this->db->select('attendance.*,candidate.can_name,candidate.can_id')->from('attendance')->join('candidate', 'candidate.can_id = attendance.can_id', 'inner')->where(array('month'=>$month, 'year'=>$year, 'attendance.is_deleted'=>0,'attendance.can_id'=>$can_id))->where('candidate.role_id NOT IN ('.$superadmin.')')->get()->result_array();
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
                $p=$e =$h =$hol = $w =$sats =$wh=$ab=$lc=$mp=0;
                
                $atten[$key]['atn_id']=$value['atn_id'];
                $atten[$key]['name'] = $value['can_name'];
                $atten[$key]['month']=$value['month'];
                $atten[$key]['year']=$value['year'];
                $atten[$key]['can_id']=$value['can_id'];
                for($i = 1; $i <= $days; $i++)
                {
                     $atten[$key]['d'.$i.'_in_time']=$value['d'.$i.'_in_time'];
                     $atten[$key]['d'.$i.'_out_time']=$value['d'.$i.'_out_time'];
                     $atten[$key]['d'.$i.'_hours']=$value['d'.$i.'_hours'];
                    if($value['d'.$i.'_hours'] >= $this->config->item('hours_per_day'))
                    {
                        $p++;
                        $atten[$key][$i.'-presenty'] = 'P';
                        $atten[$key][$i.'-day_color'] = 'darkgreenbg';
                    }
                    else if(($value['d'.$i.'_hours'] >= $this->config->item('half_hours_per_day')) && ($value['d'.$i.'_hours'] < $this->config->item('grace_time')))
                    {
                        $e++;
                        if($e >= 2)
                        {
                            $h++;
                            $atten[$key][$i.'-presenty'] = 'H';
                            $atten[$key][$i.'-day_color'] = 'cyan-colorbg';                          
                        }
                        else
                        {
                            $p++;
                            $atten[$key][$i.'-presenty'] = 'P';
                            $atten[$key][$i.'-day_color'] = 'darkgreenbg';
                        }
                    }
                    else if(($value['d'.$i.'_hours'] >= $this->config->item('grace_time')) && ($value['d'.$i.'_hours'] < $this->config->item('hours_per_day')))
                    {
                        $h++;
                        $atten[$key][$i.'-presenty'] = 'H';
                        $atten[$key][$i.'-day_color'] = 'cyan-colorbg';
                    }
                    else
                    {
                        $ab++;
                        $atten[$key][$i.'-presenty'] = 'A';
                        $atten[$key][$i.'-day_color'] = 'yellow_bg';                        
                    }
                    $leaves = $this->db->get_where('leave_application', array('can_id'=>$value['can_id'], 'from_date <='=>$year.'-'.$month.'-'.$i, 'to_date >='=>$year.'-'.$month.'-'.$i, 'is_deleted'=>0))->num_rows();
                    
                    if($leaves > 0)
                    {
                        if($atten[$key][$i.'-presenty'] == 'A')
                        {
                            $atten[$key][$i.'-presenty'] = 'L';
                            $atten[$key][$i.'-day_color'] = 'bg_red';
                            $ab++;
                        }
                    }
                    $holidays = $this->db->get_where('holiday', array('holiday_date'=>$year.'-'.$month.'-'.$i, 'is_deleted'=>0))->num_rows();
                    if($holidays > 0)
                    {
                        $hol++;
                        if($atten[$key]['d'.$i.'_in_time']=='' && $atten[$key]['d'.$i.'_out_time']=='')
                        {
                            $atten[$key]['d'.$i.'_in_time']='-';
                            $atten[$key]['d'.$i.'_out_time']='-';
                            $atten[$key]['d'.$i.'_hours']='-';
                        }else{
                            $wh++;
                        }
                        if($atten[$key][$i.'-presenty'] == 'A')
                        {
                            $atten[$key][$i.'-presenty'] = 'O';
                            $atten[$key][$i.'-day_color'] = 'bgdarkpink';
                            
                        }
                    }
                    if(date('N',strtotime($year.'-'.$month.'-'.$i)) == 7)
                    {
                        $w++;
                        if($atten[$key][$i.'-presenty'] == 'A')
                        {
                            $atten[$key][$i.'-presenty'] = 'W';
                            $atten[$key][$i.'-day_color'] = 'bg-purple';
                            if($atten[$key]['d'.$i.'_in_time']=='' && $atten[$key]['d'.$i.'_out_time']==''){
                                $atten[$key]['d'.$i.'_in_time']='-';
                                $atten[$key]['d'.$i.'_out_time']='-';
                                $atten[$key]['d'.$i.'_hours']='-';
                            }else{
                                $wh++;
                            }
                            
                        }
                    }
                    if(date('N',strtotime($year.'-'.$month.'-'.$i)) == 6)
                    {
                        $sats++;
                        if(in_array($sats, $this->config->item('weekoff_sat')))
                        {
                            $w++;
                            if($atten[$key]['d'.$i.'_in_time']=='' && $atten[$key]['d'.$i.'_out_time']==''){
                                    $atten[$key]['d'.$i.'_in_time']='-';
                                    $atten[$key]['d'.$i.'_out_time']='-';
                                    $atten[$key]['d'.$i.'_hours']='-';
                                }
                                else{
                                   $wh++;
                                }
                            if($atten[$key][$i.'-presenty'] == 'A')
                            {
                                $atten[$key][$i.'-presenty'] = 'W';
                                $atten[$key][$i.'-day_color'] = 'bg-purple';
                            }
                        }
                    }
                    if($atten[$key]['d'.$i.'_in_time']>=$this->config->item('late_mark_time')){
                        $lc++;
                    }
                    if(($atten[$key]['d'.$i.'_in_time']=='' && $atten[$key]['d'.$i.'_out_time']!='') || ($atten[$key]['d'.$i.'_in_time']!='' && $atten[$key]['d'.$i.'_out_time']==''))
                    {
                        $mp++;
                    }
                }
                $p_days = $p + ($h / 2);
                $a_days = $hol + $w;
                $wd = $days - $a_days;
                $abs = $wd - $p_days;
                if($abs<=0){
                    $abs=0;
                }
                $atten[$key]['total'] = '<span class="text-success">Present : <strong>'.$p_days.'</strong></span> <br/><span class="text-danger">Absent : <strong>'.$abs.'</strong></span>';
                $atten[$key]['fullday']=$p;
                $atten[$key]['halfday']=$h;
                $atten[$key]['weekoff']=$w;
                $atten[$key]['holiday']=$hol;
                $atten[$key]['workonholiday']=$wh;
                $atten[$key]['absent']=$abs;
                $atten[$key]['earlyleave']=$e;
                $atten[$key]['latecome']=$lc;
                $atten[$key]['misspunch']=$mp;
            }
            $this->content->attendance_records = $atten;
        }
        $this->load_view("attendance_indi_view","HRMS - Monthly Summary",$this->content);
    }

    function updatetime()
    {
        $intime=$this->input->post('intime');
        $outtime=$this->input->post('outtime');
        $inid=$this->input->post('inid');
        $outid=$this->input->post('outid');
        $atn_id=$this->input->post('atn_id');
        $hourid=$this->input->post('whour');

        $difference = date_diff(date_create($intime), date_create($outtime));
        $h = $difference->format('%h');
        $i = $difference->format('%i');
        if($h < 10)
        {
            $h = '0'.$h;
        }
        if($i < 10)
        {
            $i = '0'.$i;
        }
        $hours = $h.':'.$i;
        $data=array(
            "$inid"=> $intime,
            "$outid"=> $outtime,
            "$hourid"=>$hours
        );
        $this->db->where('atn_id',$atn_id);
        $this->db->update('attendance',$data);
    }

    function own_attendance_list()
    {
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());
        $this->db->select('month,year');
        $this->db->from('attendance');
        $this->db->where('can_id', get_login_user_id());
        $this->content->attendance_list = $this->db->get()->result_array();
        $this->load_view("own_attendance_list","HRMS - Attendance List",$this->content);
    }

    function own_attendance_details($month = '', $year = '')
    {
        user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        $can_id = get_login_user_id();
        $records = $this->db->select('attendance.*,candidate.can_name,candidate.can_id')->from('attendance')->join('candidate', 'candidate.can_id = attendance.can_id', 'inner')->where(array('month'=>$month, 'year'=>$year, 'attendance.is_deleted'=>0,'attendance.can_id'=>$can_id))->get()->result_array();
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
                $p=$e =$h =$hol = $w =$sats =$wh=$ab=$lc=$mp=0;
                
                $atten[$key]['atn_id']=$value['atn_id'];
                $atten[$key]['name'] = $value['can_name'];
                $atten[$key]['month']=$value['month'];
                $atten[$key]['year']=$value['year'];
                $atten[$key]['can_id']=$value['can_id'];
                for($i = 1; $i <= $days; $i++)
                {
                     $atten[$key]['d'.$i.'_in_time']=$value['d'.$i.'_in_time'];
                     $atten[$key]['d'.$i.'_out_time']=$value['d'.$i.'_out_time'];
                     $atten[$key]['d'.$i.'_hours']=$value['d'.$i.'_hours'];
                    if($value['d'.$i.'_hours'] >= $this->config->item('hours_per_day'))
                    {
                        $p++;
                        $atten[$key][$i.'-presenty'] = 'P';
                        $atten[$key][$i.'-day_color'] = 'darkgreenbg';
                    }
                    else if(($value['d'.$i.'_hours'] >= $this->config->item('half_hours_per_day')) && ($value['d'.$i.'_hours'] < $this->config->item('grace_time')))
                    {
                        $e++;
                        if($e >= 2)
                        {
                            $h++;
                            $atten[$key][$i.'-presenty'] = 'H';
                            $atten[$key][$i.'-day_color'] = 'cyan-colorbg';                          
                        }
                        else
                        {
                            $p++;
                            $atten[$key][$i.'-presenty'] = 'P';
                            $atten[$key][$i.'-day_color'] = 'darkgreenbg';
                        }
                    }
                    else if(($value['d'.$i.'_hours'] >= $this->config->item('grace_time')) && ($value['d'.$i.'_hours'] < $this->config->item('hours_per_day')))
                    {
                        $h++;
                        $atten[$key][$i.'-presenty'] = 'H';
                        $atten[$key][$i.'-day_color'] = 'cyan-colorbg';
                    }
                    else
                    {
                        $ab++;
                        $atten[$key][$i.'-presenty'] = 'A';
                        $atten[$key][$i.'-day_color'] = 'yellow-colorbg';                        
                    }
                    $leaves = $this->db->get_where('leave_application', array('can_id'=>$value['can_id'], 'from_date <='=>$year.'-'.$month.'-'.$i, 'to_date >='=>$year.'-'.$month.'-'.$i, 'is_deleted'=>0))->num_rows();
                    
                    if($leaves > 0)
                    {
                        if($atten[$key][$i.'-presenty'] == 'A')
                        {
                            $atten[$key][$i.'-presenty'] = 'L';
                            $atten[$key][$i.'-day_color'] = 'bg_red';
                            $ab++;
                        }
                    }
                    $holidays = $this->db->get_where('holiday', array('holiday_date'=>$year.'-'.$month.'-'.$i, 'is_deleted'=>0))->num_rows();
                    if($holidays > 0)
                    {
                        $hol++;
                        if($atten[$key]['d'.$i.'_in_time']=='' && $atten[$key]['d'.$i.'_out_time']=='')
                        {
                            $atten[$key]['d'.$i.'_in_time']='-';
                            $atten[$key]['d'.$i.'_out_time']='-';
                            $atten[$key]['d'.$i.'_hours']='-';
                        }else{
                            $wh++;
                        }
                        if($atten[$key][$i.'-presenty'] == 'A')
                        {
                            $atten[$key][$i.'-presenty'] = 'O';
                            $atten[$key][$i.'-day_color'] = 'bgdarkpink';
                            
                        }
                    }
                    if(date('N',strtotime($year.'-'.$month.'-'.$i)) == 7)
                    {
                        $w++;
                        if($atten[$key][$i.'-presenty'] == 'A')
                        {
                            $atten[$key][$i.'-presenty'] = 'W';
                            $atten[$key][$i.'-day_color'] = 'bg-purple';
                            if($atten[$key]['d'.$i.'_in_time']=='' && $atten[$key]['d'.$i.'_out_time']==''){
                                $atten[$key]['d'.$i.'_in_time']='-';
                                $atten[$key]['d'.$i.'_out_time']='-';
                                $atten[$key]['d'.$i.'_hours']='-';
                            }else{
                                $wh++;
                            }
                            
                        }
                    }
                    if(date('N',strtotime($year.'-'.$month.'-'.$i)) == 6)
                    {
                        $sats++;
                        if(in_array($sats, $this->config->item('weekoff_sat')))
                        {
                            $w++;
                            if($atten[$key]['d'.$i.'_in_time']=='' && $atten[$key]['d'.$i.'_out_time']==''){
                                    $atten[$key]['d'.$i.'_in_time']='-';
                                    $atten[$key]['d'.$i.'_out_time']='-';
                                    $atten[$key]['d'.$i.'_hours']='-';
                                }
                                else{
                                   $wh++;
                                }
                            if($atten[$key][$i.'-presenty'] == 'A')
                            {
                                $atten[$key][$i.'-presenty'] = 'W';
                                $atten[$key][$i.'-day_color'] = 'bg-purple';
                            }
                        }
                    }
                    if($atten[$key]['d'.$i.'_in_time']>=$this->config->item('late_mark_time')){
                        $lc++;
                    }
                    if(($atten[$key]['d'.$i.'_in_time']=='' && $atten[$key]['d'.$i.'_out_time']!='') || ($atten[$key]['d'.$i.'_in_time']!='' && $atten[$key]['d'.$i.'_out_time']==''))
                    {
                        $mp++;
                    }
                }
                $p_days = $p + ($h / 2);
                $a_days = $hol + $w;
                $wd = $days - $a_days;
                $abs = $wd - $p_days;
                if($abs<=0){
                    $abs=0;
                }
                $atten[$key]['total'] = '<span class="text-success">Present : <strong>'.$p_days.'</strong></span> <br/><span class="text-danger">Absent : <strong>'.$abs.'</strong></span>';
                $atten[$key]['fullday']=$p;
                $atten[$key]['halfday']=$h;
                $atten[$key]['weekoff']=$w;
                $atten[$key]['holiday']=$hol;
                $atten[$key]['workonholiday']=$wh;
                $atten[$key]['absent']=$abs;
                $atten[$key]['earlyleave']=$e;
                $atten[$key]['latecome']=$lc;
                $atten[$key]['misspunch']=$mp;
            }
            $this->content->attendance_records = $atten;
        }
        $this->load_view("own_attendance_details_view","HRMS - Monthly Summary",$this->content);
    }
}
?>
