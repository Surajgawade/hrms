<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once( APPPATH . 'models/entities/holiday' . EXT );

class Holiday_model extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            get_active_db();
            // Your own constructor code
    }

    function save_holiday($holiday_details)
    {

        $holiday = (array) $holiday_details;        
        if($holiday_details->holiday_id > 0)
        {
            $this->db->set('holiday_title',$holiday_details->holiday_title);
            $this->db->set('description',$holiday_details->description);
            $this->db->set('holiday_date',$holiday_details->holiday_date);
            $this->db->set('holiday_day',$holiday_details->holiday_day);
            $this->db->set('holiday_year',$holiday_details->holiday_year);
            $this->db->set('holiday_month',$holiday_details->holiday_month);
            $this->db->where('holiday_id', $holiday_details->holiday_id);
            $this->db->update('holiday',$holiday);
            return $holiday_details->holiday_id;
        }
        else
        {
            $this->db->insert('holiday',$holiday);
            return $this->db->insert_id();
        }
    }
    
    function get_holiday_list()
    {
        return $this->db->get_where('holiday',array('is_deleted',0))->result();
    }

    function get_holiday_details($holiday_id)
    {
        return $this->db->get_where('holiday',array('is_deleted'=> 0,'holiday_id' => $holiday_id))->row();
    }

    function delete_holiday($holiday_id)
    {
        $this->db->set('is_deleted',1);
        $this->db->where('holiday_id', $holiday_id);
        return $this->db->update('holiday');
    }

    function get_public_holidays_in_month($month,$year)
    {
        $this->db->select('*');
        $this->db->from('holiday');
        $this->db->where(array('holiday_month' => $month,'holiday_year' => $year,'is_deleted' => 0));
        $query = $this->db->get();
        return $rowcount = $query->num_rows();
    }
}
?>