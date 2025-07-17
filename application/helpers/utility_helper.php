<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
function assets_url(){
   return base_url().'assets/';
}


function debug($array)
{
	echo "<pre>";
	print_r($array);
	echo "<pre/>";	
}

function x_debug($array)
{
	debug($array);
	exit;
}

function cl_exception($exp)
{
	echo "system error" . $exp;
	exit();	
}
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------------
 * Created by PhpDesigner7.
 * Date  : 2/1/2012
 * Time  : 2:57:09 PM
 * Author: Raymond L King Sr.
 * The IgnitedCoder Development Team.
 * ------------------------------------------------------------------------
 * To change this template use File | Settings | File Templates.
 * ------------------------------------------------------------------------
 * 
 * MY_array_helper.php
 *
 * ------------------------------------------------------------------------
 */


// --------------------------------------------------------------------

/**
 * Object to Array
 *
 * Takes an object as input and converts the class variables to array key/vals
 * Uses the magic __FUNCTION__ callback method for multi arrays.
 *
 * $array = object_to_array($object);
 * print_r($array);
 * 
 * @param object - The $object to convert to an array
 * @return array
 */
if ( ! function_exists('object_to_array'))
{
 function object_to_array($object)
 {
  if (is_object($object))
  {
   // Gets the properties of the given object with get_object_vars function
   $object = get_object_vars($object);
  }
 
   return (is_array($object)) ? array_map(__FUNCTION__, $object) : $object;
 }
}

// --------------------------------------------------------------------

/**
 * Array to Object
 *
 * Takes an array as input and converts the class variables to an object
 * Uses the magic __FUNCTION__ callback method for multi objects.
 *
 * $object = array_to_object($array);
 * print_r($object);
 * 
 * @param array - The $array to convert to an object
 * @return object
 */
if ( ! function_exists('array_to_object'))
{
 function array_to_object($array)
 {
  return (is_array($array)) ? (object) array_map(__FUNCTION__, $array) : $array;
 }
}


if ( ! function_exists('objectToObject'))
{
	function objectToObject($instance, $className) {
	    return unserialize(sprintf(
	        'O:%d:"%s"%s',
	        strlen($className),
	        $className,
	        strstr(strstr(serialize($instance), '"'), ':')
	    ));
	}
}


function isValidTimeStamp($timestamp)
{
    return ((string) (int) $timestamp === $timestamp) 
        && ($timestamp <= PHP_INT_MAX)
        && ($timestamp >= ~PHP_INT_MAX);
}


function get_milestone_css($selected_milestone, $page='')
{
	$cssclass = "";
	switch($selected_milestone)
	{
		case 1006:
			$cssclass = "mamabg"; 
		break;
		case 1001:
			$cssclass = "growbg";
		break;
		case 1002:
			$cssclass = "firstStepbg";
		break;
		case 1003:
			$cssclass = "curiousbg";
		break;
		case 1004:
			$cssclass = "explorebg";
		break;
		case 1005:
			$cssclass = "createbg";
		break;
	}
	if ($page != '')
	{	
		//debug($cssclass); exit();
		$cssclass = chop($cssclass,"bg");
		
		return $cssclass;
	}
	
	return $cssclass;
}

function get_tag($input,$keyword)
{
	$input = explode(',',$input);
	//debug($input);
	//echo $keyword;
	foreach ($input as $in)
	{
		$pos = strpos(strtolower($in),strtolower($keyword));
		if ($pos === false) {
	        
	    } else {
	        return $in;
	    }
	}
}
function convert_object_to_id_list($object){
	if(!empty($object)){
		foreach($object as $value){
			$categoryid[]=$value->categoryId;
		}
		$catidlist = $categoryid;
		return $catidlist;
	}
}
/**
 * 
 * Method to get unique field name..
 * @param string $field_name
 */
 function unique_field_name($field_name)
 {
 	return 's'.substr(md5($field_name),0,8); //This 's' is because its better for a string to begin with a letter and not with a number
 }

 function format_date($from_date)
 {
 	if(!empty(strtotime($from_date)))
 	{
 		return date("d/m/Y", strtotime($from_date));
 	}
 }

 function format_date_my($from_date)
 {
 	if(!empty(strtotime($from_date)))
 	{
 		return date("m/Y", strtotime($from_date));
 	}
 }

function date_to_db($date = NULL)
{
	$n_date = date('Y-m-d', strtotime(str_replace('/', '-', $date)));
	if(!empty(strtotime($n_date)))
 	{
		return $n_date;
	}
}

function db_to_date($date = NULL)
{
	$n_date = date('d-m-Y', strtotime($date));
	if(!empty(strtotime($n_date)))
 	{
		$n_date = str_replace('-', '/', $n_date);
		return $n_date;
	}
}

function date_to_db_his($date = NULL)
{
	$n_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $date)));
	if(!empty(strtotime($n_date)))
 	{
		return $n_date;
	}
}

function db_to_date_his($date = NULL)
{
	$n_date = date('d-m-Y H:i:s', strtotime($date));
	if(!empty(strtotime($n_date)))
 	{
		$n_date = str_replace('-', '/', $n_date);
		return $n_date;
	}
}




	if(!function_exists('get_days_in_month'))
	{
		function get_days_in_month($date)
		{
			return cal_days_in_month($date);
		}
	}

	if(!function_exists('cal_days_in_month'))
	{
		function cal_days_in_month($date)
		{
			$month = date("m", strtotime($date));
			$year = date("Y", strtotime($date));
			return  $days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
		}
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

	if(!function_exists('cal_weekoff_sun'))
	{
		function cal_weekoff_sun()
		{
			echo "Sundays:".$this->countDays(2017, 10, array(0));	
		}
	}

	if(!function_exists('cal_days_in_month'))
	{
		function cal_days_in_month()
		{
			echo "Saturdays:".$this->countDays(2017, 10, array(6));	
		}
	}

	if(!function_exists('countDays'))
	{
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
	}

	if(!function_exists('get_public_holidays_in_month'))
	{
		function get_public_holidays_in_month()
		{
			$date = date('Y-m-d');
			$month = date("m", strtotime($date));
			$year = date("Y", strtotime($date));
			echo $public_holidays = $this->holiday->get_public_holidays_in_month($month,$year);exit;
		}
	}

// ------------------------------------------------------------------------
/* End of file MY_array_helper.php */
/* Location: ./application/helpers/MY_array_helper.php */ 