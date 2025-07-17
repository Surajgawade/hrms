<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Attendance_Model extends CI_Model
{

	public function __construct()
    {
            parent::__construct();
            get_active_db();
            // Your own constructor code
    }

}
?>