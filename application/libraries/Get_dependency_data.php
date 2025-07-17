<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Get_dependency_data {
	public $CI;
		 
	function __construct()
    {
    	$this->CI = &get_instance();
    	 $this->CI->load->model('common_model');
    }
    public function get_notification_data($can_id,$count=false)
    {
    	if(!empty($can_id))
    	{
	    	$task_data=$this->CI->common_model->get_data_array('push_notifications',array('can_id'=>$can_id,'table_type'=>'task_manager','operation_type'=>'insert'));
	    	$leave_data=$this->CI->common_model->get_data_array('push_notifications',array('can_id'=>$can_id,'table_type'=>'leave_application','operation_type'=>'update'));
	    	$leave_request=$this->CI->common_model->get_data_array('push_notifications',array('reporting_to'=>$can_id,'table_type'=>'leave_application','operation_type'=>'insert'));
	        $notifications_data=array_merge((array)$task_data,(array)$leave_data,(array)$leave_request);
	        rsort($notifications_data);
	        if($count)
	        {
	        	return count($notifications_data);
	        }
	        
	        foreach ($notifications_data as $key => $value) {
	                if ($value['table_type']!='task_manager')
	                {
	                	$table_unique_field=$value["unique_field_name"];
	                	$table=$value['table_type'];

	                	$data=$this->CI->common_model->get_data_array($value['table_type'],array($value["unique_field_name"]=>$value['unique_field_id']));
	                	if(!empty($data))
	                	{
	                		$notifications_data[$key]['field_data']=$data[0];
	                	}
	                }
	                else
	                {

	                	$query="SELECT t.*,tm.taskm_id from tasks t JOIN task_manager tm on t.task_id=tm.task_id where tm.taskm_id=".$value['unique_field_id'];
	                	$data=$this->CI->common_model->getByQuery($query);
	                	if(!empty($data))
	                	{
	                		$notifications_data[$key]['field_data']=$data[0];
	                	}
	                }
	            }
	        // print_r($notifications_data);
	        // exit;
	        return $notifications_data;
	    }
    }
    public function get_resume_data($file_path)
    {
    	$file   = $_FILES['file'];
        $file_name  = $file['name'];
        $file_tmp   = $file['tmp_name'];
        $file_size  = $file['size'];
        $file_error = $file['error'];

        // Working With File Extension
        $file_ext   = explode('.', $file_name);
        $file_fname = explode('.', $file_name);

        $file_fname = strtolower(current($file_fname));
        $file_ext   = strtolower(end($file_ext));
        $allowed    = array('txt','pdf','doc','docx');
        
        
        if (in_array($file_ext,$allowed)) { 
            if ($file_error === 0) {
                if ($file_size <= 5000000) {
                        $file_name_new     =  $file_fname . uniqid('',true) . '.' . $file_ext;
                        $file_name_new    =  uniqid('',true) . '.' . $file_ext;
                        $file_destination =  FCPATH.'ResumeParser/ResumeTransducer/UnitTests/' . $file_name_new;
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                        //include_once(APPPATH .'libraries/Pdf2text.php');
                        $this->CI->load->library('pdf2text');
                        $this->CI->load->library('docx');
                           $imageFileType = pathinfo($file_destination);
                            $places_data=$this->CI->common_model->get_data_array('cities','','');
                            $places=array();
                            foreach ($places_data as $key => $value) {
                                $places[]=$value['city'];
                            }
                            $places=implode('|', $places);
                            // print_r($places);
                            // exit;
                            $resumeText='';
                            if ($imageFileType['extension '] == 'pdf') 
                            {
                                $this->CI->pdf2text->setFilename($filename=$file_destination);
                                $this->CI->pdf2text->decodePDF();
                                $resumeText = $this->CI->pdf2text->output();
                                $resumeText = trim(str_replace("\n", " ", $resumeText));
                                
                            }
                            else
                            {
                                $this->filename=$file_destination;
                                $resumeText = $this->CI->docx->convertToText($this->filename);
                            }
                            
                            // exit;
                            $file_name_out = str_replace(".pdf",".txt",$file_name_new);
                            //print_r($file_name_out); 
                          // print_r("sudo ".FCPATH."shellmain.sh '".$file_name_new."' '".$file_name_out."'");
                          // exit;
 
                            $lastline = shell_exec("sudo ".FCPATH."shellmain.sh '".$file_name_new."' '".$file_name_out."'");
                          // print_r($lastline);
                          // exit; 
                            $filename = FCPATH.'test/'. $file_name_out;  
                            $handle = fopen($filename, "r");
                            if(!$handle){
                                return "file can not be opened";
                                die();
                            }
                            else{

                                 $contents = fread($handle, filesize($filename));
                                $result4 = $contents;
                                $description = str_replace("\\n","\n",$result4);
                                $des=str_replace("?"," ",$description);
                            
                                $obj = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $des), true );
                                $fileInfo = explode(PHP_EOL, $resumeText);
                                $records = [];
                                foreach ($fileInfo as $row) {
                                // if($row == '') continue;
                                // $parts = explode(',12', $row);
                                
                                $parts = preg_split('/(?<=[.?!])\s+(?=[a-z])/i', $row);
                                foreach ($parts as $part) {
                                    if ($part == '') {
                                        continue;
                                    }
                                // echo $part.'<br><br>';
                                    $part = strtolower($part);

                                    //  ***************  EMAIL  **************

                                    if ($part) {
                                        $pattern = '/[a-z0-9_\-\+]+@[a-z0-9\-]+\.([a-z]{2,3})(?:\.[a-z]{2})?/i';

                                        preg_match("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i", $part, $matches);
                                        //$pattern = '/[a-z0-9_\-\+]+@[a-z0-9\-]+\.([a-z]{2,3})(?:\.[a-z]{2})?/i';
                                        //preg_match_all($pattern, $part, $matches);
                                        if(!empty($matches))
                                        {
                                            foreach ($matches[0] as $match) {
                                                $obj['email'][] = $match;
                                            }
                                        }
                                    }

                                    //  ***************  DOB  **************

                                    if (preg_match('/dob|d.o.b|date of birth/', $part)) {
                                        $dob = preg_split('/:|-/', $part);
                                        foreach ($dob as $db) {
                                            $date = date_parse($db);
                                            if ($date['error_count'] == 0) {
                                                $obj['dob'][] = $date['year'].'-'.$date['month'].'-'.$date['day'];
                                            }
                                        }
                                    }

                                    $date = @find_date($part);
                                    if ($date) {
                                        $obj['dob'][] = $date['year'].'-'.$date['month'].'-'.$date['day'];
                                    }
                                    // }

                                    $p = '{.*?(\d\d?)[\\/\.\-]([\d]{2})[\\/\.\-]([\d]{4}).*}';
                                    if (preg_match($p, $part)) {
                                        $date = preg_replace($p, '$3-$2-$1', $part);
                                        $dd = new \DateTime($date);
                                        $obj['dob'][] = $dd->format('Y-m-d');
                                    }

                                    //  ***************  MOBILE  **************

                                    preg_match_all('/\d{10}/', $part, $matches);
                                    if (count($matches[0])) {
                                        foreach ($matches[0] as $mob) {
                                            $obj['mobile'][] = $mob;
                                        }
                                    }

                                    preg_match_all('/\d{12}/', $part, $matches);
                                    if (count($matches[0])) {
                                        foreach ($matches[0] as $mob) {
                                            $obj['mobile'][] = $mob;
                                        }
                                    }

                                    preg_match_all('/(\d{5}) (\d{5})/', $part, $matches);
                                    if (count($matches[0])) {
                                        foreach ($matches[0] as $mob) {
                                            $obj['mobile'][] = $mob;
                                        }
                                    }

                                    //  ***************  SKILLS  **************

                                    preg_match_all('/production|sales|call center|Accounts|marketting|tele communication|engineer|software engineering|software engineer|manufacturing|office administration|human resource|admin|secretarial|customer service|call center|finance account/', $part, $matches);
                                    if (count($matches[0])) {
                                        foreach ($matches[0] as $skill) {
                                            $obj['skills'][] = $skill;
                                        }
                                    }
                                    preg_match_all('/'.strtolower($places).'/', strtolower($part), $matches);
                                    // print_r($matches);

                                    if (count($matches[0])) {
                                     foreach ($matches[0] as $skill) {
                                            $obj['places'][] = $skill;
                                        }   
                                    }
                                    //  ***************  PLACE  **************
                                    
                                    preg_match_all($places_regx, $part, $matches);
                                    if (count($matches[0])) {
                                        foreach ($matches[0] as $skill) {
                                            $obj['place'][] = ucwords($skill);
                                        }
                                    }

                                    //  ***************  NAME  **fe************

                                    if (isset($records['email'])) {
                                        foreach ($records['email'] as $email) {
                                            $e = explode('@', $email);
                                            $obj['name'][] = $e[0];
                                        // code...
                                        }
                                    }
                                }
                             }  
                            }   
                            $obj['file_type']=$imageFileType['extension'];
                            $obj['file_name']=$file_name_new;
                            if($imageFileType!='pdf')
                            {
                            	$obj['text']=$resumeText;              
                        	}
                        	return $obj;
                        }
                        else
                        {
                            return "some error in uploading file";
                        }
                       
                }
                else
                {
                    return "size must bne less then 5MB";
                }
            }

        }
        else
        {
            return "invalid file";
        }
    }
}
