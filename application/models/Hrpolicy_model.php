<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once( APPPATH . 'models/entities/candidate' . EXT );

class Hrpolicy_model extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            get_active_db();
            // Your own constructor code
    }
function get_hrpolicy_dtls()
    {
        $this->db->select('*');
        $this->db->from('hrpolicy'); 
        $this->db->order_by('pid','desc');     
        return $this->db->get()->result();
    }
    
     function hrpolicy_insert($data)
    {
        // x_debug($data);die();
        // $dt=date_to_db($this->input->post('doc_date'));
        /*$data = array(
        'pid' => NULL,
        'doc_upload_date' => $dt,
        'doc_path' => $this->input->post('files'),
        'doc_status' => 0);*/
        $this->db->insert('hrpolicy', $data);
    }

    


}
