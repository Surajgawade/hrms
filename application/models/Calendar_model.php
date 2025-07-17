<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once( APPPATH . 'models/entities/calender' . EXT );
class Calendar_Model extends CI_Model
{

	public function __construct()
    {
            parent::__construct();
            get_active_db();
            // Your own constructor code
    }

    function get_event_details($can_id = '')
    {
        return $this->db->get_where('event',array('can_id' =>$can_id, 'is_deleted'=>0))->result_array();
    }

    function add_event_details($event_details)
    {
        if($event_details->ev_id > 0)
        {
            $this->db->where("ev_id",$event_details->ev_id);
            if($this->db->update("event",$event_details))
            {
                return $event_details->ev_id;
            }
        }
        else
        {
            $data = (array) $event_details;
            $this->db->insert('event',$data);
            return $this->db->insert_id();   
        }
    }

    function get_event_by_ID($ev_id = '')
    {
        return $this->db->get_where('event',array('ev_id' =>$ev_id))->row_array();
    }

    function delete_event($ev_id = '')
    {
        $this->db->set('is_deleted',1);
        $this->db->where('ev_id', $ev_id);
        return $this->db->update('event');
    }
}
?>