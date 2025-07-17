<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Calendar extends My_Controller
{

	public function __construct() {
		Parent::__construct();
		$this->load->model("calendar_model");
	}

	public function index($msg="")
	{
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
		$this->load_view("calendar","HRMS - Event Calender",$this->content);        
	}

	private function load_view($viewname= "blank_page",$page_title)
	{
		$this->content->meta_description="Meta meta_description here!";
		$this->content->meta_keywords="meta keywords here!";
		$this->masterpage->setMasterPage('master');
		$this->content->page_description = "";
		$this->masterpage->setPageTitle($page_title);
		$this->masterpage->addContentPage('calendar/'.$viewname,'content',$this->content);
		$this->masterpage->show();
	}

	function event_details()
    {
    	$userdata = $this->session->userdata('logged_in_user');
    	$events = $this->calendar_model->get_event_details($userdata['id']);
    	foreach ($events as $key => $value) {
            /*$events[$key]['start'] = date('Y-m-d', strtotime($value['start']));
            $events[$key]['end'] = date('Y-m-d h:i:s', strtotime($value['end']));*/
    		if($value['event_type'] == 'meeting')
    		{
    			$events[$key]['className'] = '';
    		}
    		else if($value['event_type'] == 'appointment')
    		{
    			$events[$key]['className'] = 'event-green';
    		}
    		else if($value['event_type'] == 'calls')
    		{
    			$events[$key]['className'] = 'event-orange';
    		}
    		else if($value['event_type'] == 'training')
    		{
    			$events[$key]['className'] = 'event-coral';
    		}
            else if($value['event_type'] == 'task')
            {
                $events[$key]['className'] = 'event-seagreen';
            }
            else if($value['event_type'] == 'leave')
            {
                $events[$key]['className'] = 'event-purple';
            }
            else if($value['event_type'] == 'travel')
            {
                $events[$key]['className'] = 'event-lightpink';
            }
    	}
        echo json_encode($events);
    }

    function add_event_details()
    {
        $access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
        if(!empty($access))
        {
            echo json_encode(array("result"=>1,"msg"=>"Access Denied"));
        }
        else
        { 

        	$this->load->helper(array('form', 'url','security'));
            $this->load->library('form_validation');
            //server side validations
            $this->form_validation->set_rules('title','Title','required');
            $this->form_validation->set_rules('start','Start Date','required');
            $this->form_validation->set_rules('end', 'End Date','required');
            if ($this->form_validation->run() == FALSE)
            {
            	echo json_encode(array("result"=>FALSE,"msg"=>"Please Fill All Details. Event is not saved."));
            }
            else
            {
    	        $userdata = $this->session->userdata('logged_in_user');
                
    	        if ($this->input->is_ajax_request())
    	        {
    	            $post = $this->input->post();
                    $post['start'] = date_to_db_his($post['start']);
                    $post['end'] = date_to_db_his($post['end']);
                    $date = date_create($post['start']);
                    $ndate = date_create($post['end']);
		            $cdate = date_create(date('Y-m-d'));
                    $diff = date_diff($date,$ndate);
                    $d = $diff->format("%R%a");
                    $h = $diff->format("%R%h");
                    $s = $diff->format("%R%s");
                    $i = $diff->format("%R%i");
		            $diff2 = date_diff($date,$cdate);
                    $d2 = $diff2->format("%R%a");
                    if(($d < 0) || ($post['start'] == NULL) || ($post['end'] == NULL))
                    {
                        echo json_encode(array("result"=>FALSE,"msg"=>"Please Check Dates. Event is not saved."));
                    }
		            else if(($d2 > 0) && empty($post['ev_id']))
                    {
                        echo json_encode(array("result"=>FALSE,"msg"=>"Cannot add event on past dates."));
                    }
                    else
                    {
                        if(($i < 0) || ($h < 0) || ($s < 0))
                        {
                            echo json_encode(array("result"=>FALSE,"msg"=>"Please Check Time. Event is not saved."));
                        }
                        else
                        {
            	            $event_details = new Calender_Entity();
            	            $event_details->can_id = $userdata['id'];
            	            if(!empty($post['ev_id']))
            	                $event_details->ev_id = $post['ev_id'];
            	            $event_details->title = $post['title'];
            	            $event_details->details = $post['details'];
            	            $event_details->event_type = $post['event_type'];
            	            $event_details->start = $post['start'];
            	            $event_details->end = $post['end'];
            	            $this->calendar_model->add_event_details($event_details);
            	            echo json_encode(array("result"=>2,"msg"=>"Event Details Saved Successfully!"));
                        }
                    }
    	        }
    	        else
    	        {
    	        	echo json_encode(array("result"=>0,"msg"=>"Something Went Wrong. Event is not saved."));
    	        }
    	    }
        }
    }

    function get_event_details($ev_id = '')
    {
    	$res = $this->calendar_model->get_event_by_ID($ev_id);
    	$res['start'] = db_to_date_his($res['start']);
    	$res['end'] = db_to_date_his($res['end']);
    	echo json_encode($res);
    }

    function delete_event($ev_id = '')
    {
    	$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
        if(!empty($access))
        {
            echo "0";
        }
        else
        { 
        	$res = $this->calendar_model->delete_event($ev_id);
            echo "1";
        }
    }

    function get_leave_for_day()
    {
        $post = $this->input->post();
        $start_date = date_to_db($post['start_date'])." 00:00:00";
        $leaves = $this->db->get_where('event', array('can_id'=>get_login_user_id(), 'is_deleted'=>0, 'event_type'=>'leave', 'from_tbl'=>'leave'))->result_array();
        $i = 0;
        if(!empty($leaves))
        {
            foreach ($leaves as $key => $value)
            {
                $value['start'] = strtotime($value['start']);
                $value['end'] = strtotime($value['end']);
                $start_date = strtotime($start_date);
                if(($value['start'] <= $start_date) && ($value['end'] >= $start_date))
                {
                    $i++;

                }
            }
        }
        if($i === 0)
        {
            echo json_encode(TRUE);
        }
        else
        {
            echo json_encode(FALSE);
        }
    }
}
?>
