<?php 
if(!function_exists('array_group_by'))
{
	function array_group_by(array $array, $key)
    {
        if (!is_string($key) && !is_int($key) && !is_float($key) && !is_callable($key) ) {
            trigger_error('array_group_by(): The key should be a string, an integer, or a callback', E_USER_ERROR);
            return null;
        }
        $func = (!is_string($key) && is_callable($key) ? $key : null);
        $_key = $key;
        // Load the new array, splitting by the target key
        $grouped = [];
        foreach ($array as $value) {
            $key = null;
            if (is_callable($func)) {
                $key = call_user_func($func, $value);
            } elseif (is_object($value) && isset($value->{$_key})) {
                $key = $value->{$_key};
            } elseif (isset($value[$_key])) {
                $key = $value[$_key];
            }
            if ($key === null) {
                continue;
            }
            $grouped[$key][] = $value;
        }
        // Recursively build a nested grouping if more parameters are supplied
        // Each grouped array value is grouped according to the next sequential key
        if (func_num_args() > 2) {
            $args = func_get_args();
            foreach ($grouped as $key => $value) {
                $params = array_merge([ $value ], array_slice($args, 2, func_num_args()));
                $grouped[$key] = call_user_func_array('array_group_by', $params);
            }
        }
        return $grouped;
    }
}
if(!function_exists('get_smtp_details'))
{
    function get_smtp_details()
    {
        date_default_timezone_set('Etc/UTC');
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug   = 0;
        $mail->DKIM_domain = '127.0.0.1';
        $mail->Debugoutput = 'html';
        $mail->Host        = "smtpout.secureserver.net";
        $mail->Port        = 465;
        $mail->SMTPAuth    = true;
        $mail->Username    = "it@raoson.com";
        $mail->Password    = "Koonal2910";
        $mail->SMTPSecure  = 'ssl';
        return $mail;
    }
}
/*if(!function_exists('set_log_fields'))
{
    function set_log_fields($data,$action=null)
    {
        if (!empty($data))
        {
            if (!is_object($data))
            {
                $log_id=get_login_user_id();
                if(!empty($action))
                {
                    $data['created_by']=$log_id;
                    $data['last_modified_by']=$log_id;
                    
                }
                else
                {
                    $data['last_modified_by']=$log_id;
                }
                return $data;
            }
            else
            {
                $log_id=get_login_user_id();
                if(!empty($action))
                {
                    $data->created_by=$log_id;
                    $data->last_modified_by=$log_id;
                    
                }
                else
                {
                    $data->last_modified_by=$log_id;
                }
                return $data;   
            }
        }
    }
}*/
if(!function_exists('set_log_fields'))
{
    function set_log_fields($data,$action=null)
    {
        if (!empty($data))
        {
            $date=date('Y-m-d h:i:s');
            if (!is_object($data))
            {
                $log_id=get_login_user_id();
                if(!empty($action))
                {
                   $data['created_by']=$log_id;
                   $data['created_on']=$date;
                   $data['last_modified_on']=$date;
                   $data['last_modified_by']=$log_id;
                    
                }
                else
                {
                    $data['last_modified_by']=$log_id;
                    $data['last_modified_on']=$date;
                }
                return $data;
            }
            else
            {
                $log_id=get_login_user_id();
                if(!empty($action))
                {
                    $data->created_by=$log_id;
                    $data->created_on=$date;
                    $data->last_modified_on=$date;
                    $data->last_modified_by=$log_id;
                    
                }               else
                {
                   $data->last_modified_by=$log_id;
                   $data->last_modified_on=$date;
                }
                return $data;   
            }
        }
    }
}
if(!function_exists('check_record_exist'))
{
    function check_record_exist($tablename,$conditions,$isajax = false)
    {
        $CI = get_instance();
        $CI->load->model('common_model');
        if($CI->common_model->count_all($tablename, $conditions)== 0)
        {
            if($isajax)
            {
                return '1';
                //echo 'no access';
            }
            else
            {
                redirect('Record_not_found');
            }
        }
        else
        {
            return true;
        }
    }
}

if(!function_exists('user_activity_log'))
{
    function user_activity_log($data)
    {
        // x_debug($data);
        $CI = get_instance();
        $CI->load->model('common_model'); 
        $CI->common_model->insert($tablename ='user_activities', $data);    
    }
}
if(!function_exists('find_date'))
{ 
    function find_date($string)
    {

        //Define month name:
        $month_names = [
            'january',
            'february',
            'march',
            'april',
            'may',
            'june',
            'july',
            'august',
            'september',
            'october',
            'november',
            'december',
        ];

        $month_number = $month = $matches_year = $year = $matches_month_number = $matches_month_word = $matches_day_number = '';

        //Match dates: 01/01/2012 or 30-12-11 or 1 2 1985
        preg_match('/([0-9]?[0-9])[\.\-\/ ]?([0-1]?[0-9])[\.\-\/ ]?([0-9]{2,4})/', $string, $matches);
        if ($matches) {
            if ($matches[1]) {
                $day = $matches[1];
            }

            if ($matches[2]) {
                $month = $matches[2];
            }

            if ($matches[3]) {
                $year = $matches[3];
            }
        }

        //Match month name:
        preg_match('/('.implode('|', $month_names).')/i', $string, $matches_month_word);

        if ($matches_month_word) {
            if ($matches_month_word[1]) {
                $month = array_search(strtolower($matches_month_word[1]), $month_names) + 1;
            }
        }

        //Match 5th 1st day:
        preg_match('/([0-9]?[0-9])(st|nd|th)/', $string, $matches_day);
        if ($matches_day) {
            if ($matches_day[1]) {
                $day = $matches_day[1];
            }
        }

        //Match Year if not already setted:
        if (empty($year)) {
            preg_match('/[0-9]{4}/', $string, $matches_year);
            if ($matches_year[0]) {
                $year = $matches_year[0];
            }
        }
        if (!empty($day) && !empty($month) && empty($year)) {
            preg_match('/[0-9]{2}/', $string, $matches_year);
            if ($matches_year[0]) {
                $year = $matches_year[0];
            }
        }

        //Leading 0
        if (1 == strlen($day)) {
            $day = '0'.$day;
        }

        //Leading 0
        if (1 == strlen($month)) {
            $month = '0'.$month;
        }

        //Check year:
        if (2 == strlen($year) && $year > 20) {
            $year = '19'.$year;
        } elseif (2 == strlen($year) && $year < 20) {
            $year = '20'.$year;
        }

        $date = [
            'year'    => $year,
            'month'   => $month,
            'day'     => $day,
        ];

        //Return false if nothing found:
        if (empty($year) && empty($month) && empty($day)) {
            return false;
        } else {
            return $date;
        }
    }
}
if(!function_exists('multi_array_keysearch'))
{ 
    function multi_array_keysearch( Array $array, $key ) {
    if (array_key_exists($key, $array)) return $array[$key];
    foreach ($array as $k=>$v) {
        if (!is_array($v)) continue;
        if (array_key_exists($key, $v)) return $vp[$key];
    }
    return false;
}

}
if(!function_exists('send_sms'))
{ 
    function send_sms($numbers = '', $message = '')
    {
        if(!empty($numbers) && is_string($numbers) == true)
        {
            $CI = get_instance();
            $config_setting = $CI->db->get_where('configuration_settings', array('conf_id'=>1))->row_array();
            if(!empty($config_setting['sms_api_key']) && !empty($config_setting['sms_senderid']) && !empty($config_setting['sms_user']) && !empty($config_setting['sms_password']) && !empty($config_setting['sms_link']))
            {
                // return false;
                // Replace with your username
                $user = $config_setting['sms_user'];

                // Replace with your API KEY (We have sent API KEY on activation email, also available on panel)
                $apikey = $config_setting['sms_api_key']; 

                // Replace if you have your own Sender ID, else donot change
                $senderid  =  $config_setting['sms_senderid']; 

                // Replace with the destination mobile Number to which you want to send sms
                $mobile  =  $numbers; 

                // Replace with your Message content
                // $message   =  "Testing SMS API by Prasad......"; 
                $message = urlencode($message);

                // For Plain Text, use "txt" ; for Unicode symbols or regional Languages like hindi/tamil/kannada use "uni"
                $type   =  "txt";
                $data = array('apikey' => $apikey, 'numbers' => $mobile, "message" => $message);
                // $ch = curl_init($config_setting['sms_link']."user=".$user."&apikey=".$apikey."&mobile=".$mobile."&senderid=".$senderid."&message=".$message."&type=".$type."");
                    $ch = curl_init($config_setting['sms_link']);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    // curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($ch);      
                    curl_close($ch); 

                // Display MSGID of the successful sms push
                /*echo $output;
                exit;*/
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
}

if(!function_exists('get_active_db'))
{
    function get_active_db()
    {
        // $CI = get_instance();
        // $db=$CI->session->active_db;
        // if($db=='hrms' || empty($db)){
        //     $CI->db=$CI->load->database('default',true);            
        // }
        // else 
        // {
        //     $CI->db=$CI->load->database('hrms_global',true);            
        // }
        // return $CI->db;
    }
}
?>
