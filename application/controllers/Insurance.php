<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Insurance extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('candidate_model');
        $this->load->model('task_model');
        $this->load->model('common_model');

        $userdata = $this->session->userdata('logged_in_user');
        if(!$userdata){
            $newURL = site_url()."/login";
            header('Location: '.$newURL);        		
        }        
    }

	public function index( )
	{
        $this->load_view("insurance_list","HRMS - Insurance List",$this->content);
	}

    function list_insurance()
    {
        $month = date('m');
        $year = date('Y');
        if($month == 12)
        {
            $month = 1;
            ++$year;
        }
        else
        {
            ++$month;
        }
        if($month < 10)
        {
            $month = '0'.$month;
        }
        $this->datatables->unset_column('insurance_id');
        $this->datatables->select('candidate.can_name, insurance_id, policy_no, ins_expire_date, premium_amnt, mail_sent');
        $this->datatables->from('insurance_details');
        $this->datatables->join('candidate', 'insurance_details.can_id = candidate.can_id', 'left');
        $this->datatables->where('ins_expire_date like', $year.'-'.$month.'-%');
        $this->datatables->add_column('checkall','<input type="checkbox" id="chk-$1">','insurance_id');
        $this->datatables->add_column('pay', '<button type="button" class="tabledit-edit-button btn btn-sm btn-success btn_edit" onClick="remind($1)"><span> Remind</span></button>', 'insurance_id');
        $result= $this->datatables->generate();
        echo $result;
    }

    function pay($insurance_id = '')
    {
        $data['insurance'] = $this->common_model->get_data('insurance_details', array('insurance_id'=>$insurance_id, 'is_deleted'=>0));
        $data['company'] = $this->common_model->get_data('insurance_company', array('ic_id'=>$data['insurance']['ins_comp_name'], 'is_deleted'=>0));
        $data['candidate'] = $this->common_model->get_data('candidate', array('can_id'=>$data['insurance']['can_id'], 'is_deleted'=>0));
        $data['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
        if(!empty($insurance_id))
        {
            $this->load->library('email_send');
            $mailer_config = $this->common_model->get_data('email_config',array('email_template'=>'insurance_premium_reminder'));
            $data['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
            $message = $this->load->view("email_templates/".$mailer_config["email_template"], $data, TRUE);
            $sent = $this->email_send->send_mail_new($mailer_config, $data['company']['ic_email'], $message);
            if($sent == 1)
            {
                $res = $this->common_model->update('insurance_details', array('mail_sent'=>1), array('insurance_id'=>$insurance_id));
                echo "1";
            } 
            else
            {
                echo "4";
            }
        }
        else
        {
            echo "2";
        }
    }

    function pay_bulk()
    {
        $post = $this->input->post();
        if(!empty($post['ids']))
        {
            $mails = array();
            $i_vals = array();
            foreach ($post['ids'] as $key1 => $value1) {
                if(stripos($value1, '-') !== FALSE)
                {
                    $ids = explode('-', $value1);
                    $i_vals[] = $ids[1];
                }
            }
            foreach ($i_vals as $key => $val) {
                $insurance = $this->common_model->get_data('insurance_details', array('insurance_id'=>$val, 'is_deleted'=>0));
                $company = $this->common_model->get_data('insurance_company', array('ic_id'=>$insurance['ins_comp_name'], 'is_deleted'=>0));
                $candidate = $this->common_model->get_data('candidate', array('can_id'=>$insurance['can_id'], 'is_deleted'=>0));
                $mails[$company['ic_email']][$key]['can_name'] = $candidate['can_name'];
                $mails[$company['ic_email']][$key]['ins_expire_date'] = $insurance['ins_expire_date'];
                $mails[$company['ic_email']][$key]['policy_no'] = $insurance['policy_no'];
                $mails[$company['ic_email']][$key]['premium_amnt'] = $insurance['premium_amnt'];
            }
            if(!empty($mails))
            {
                $this->load->library('email_send');
                $cnt_m = count($mails);
                $i = 0;
                foreach ($mails as $keym => $valuem) {
                    $mailer_config = $this->common_model->get_data('email_config',array('email_template'=>'insurance_premium_reminder_bulk'));
                    $data['data'] = $valuem;
                    $data['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
                    $message = $this->load->view("email_templates/".$mailer_config["email_template"], $data, TRUE);
                    $sent = $this->email_send->send_mail_new($mailer_config, $keym, $message);
                    if($sent == 1)
                    {
                        foreach ($i_vals as $key1 => $val1) {
                            $res = $this->common_model->update('insurance_details', array('mail_sent'=>1), array('insurance_id'=>$val1));
                        }
                        $i++;
                    }
                }
                if($i == $cnt_m)
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
                echo "4";
            }
        }
        else
        {
            echo "3";
        }
    }

    function company_list($msg="")
    {
        $this->load_view("company_list","HRMS - Insurance List",$this->content);
    }

    function list_companies()
    {
        $this->datatables->unset_column('ic_id');
        $this->datatables->select('name, ic_id, description, ic_email');
        $this->datatables->from('insurance_company');
        $this->datatables->where('is_deleted', 0);
        $this->datatables->add_column('edit', '<a  href="'.site_url().'/insurance/add_company/$1" class="tabledit-edit-button btn btn-success btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_com($1)" class="tabledit-delete-button btn-danger btn btn-sm btn_delete" id="delete_company_$1"><span class="glyphicon glyphicon-trash"></span></a>', 'ic_id');
        $result= $this->datatables->generate();
        echo $result;
    }

    function add_company($ic_id = '')
    {
        if(!empty($ic_id))
        {
            $this->content->company_details = $this->common_model->get_data('insurance_company', array('ic_id'=>$ic_id, 'is_deleted'=>0));
        }
        $this->load_view("add_company","HRMS - Add Insurance Company",$this->content);
    }

    function save_company()
    {
        if ($this->input->is_ajax_request())
        {
            $post = $this->input->post();
            if(!empty($post['name']) && !empty($post['ic_email']))
            {
                $company_record = $post;
                if(empty($post['ic_id']))
                {
                    $company_record = set_log_fields($company_record, 'insert');
                    $res = $this->common_model->insert('insurance_company', $company_record);
                }
                else
                {
                    $company_record = set_log_fields($company_record);
                    $res = $this->common_model->update('insurance_company', $company_record, array('ic_id'=>$post['ic_id']));
                }
                if($res)
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
                echo "3";
            }
        }
        else
        {
            echo "2";
        }
    }

    function delete_company($ic_id = '')
    {
        if ($this->input->is_ajax_request())
        {
            if(!empty($ic_id))
            {
                $res = $this->common_model->update('insurance_company', array('is_deleted'=>1), array('ic_id'=>$ic_id));
                if($res)
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
                echo "3";
            }
        }
        else
        {
            echo "2";
        }
    }

    private function load_view($viewname= "blank_page",$page_title)
    {
        $this->content->meta_description="Meta meta_description here!";
        $this->content->meta_keywords="meta keywords here!";
        $this->masterpage->setMasterPage('master');
        $this->content->page_description = "";
        $this->masterpage->setPageTitle($page_title);
        $this->masterpage->addContentPage('insurance/'.$viewname,'content',$this->content);
        $this->masterpage->show();
    }

    function searchAllDB($search = '')
    {
        global $mysqli;
        $user_info = $this->common_model->get_data('candidate', array('can_id'=>get_login_user_id(), 'is_deleted'=>0));
        if(!empty($user_info))
        {
            $out = "";
            $tables = array("bank_details","birthday_wishes","candidate","ci_voting","departments","documents","hrpolicy","insurance_company","insurance_details","");
            $sql = "show tables;";
            $rs = $this->db->query($sql);
            if($rs->num_rows() > 0){
                foreach ($rs->result_array() as $key => $value) {
                    $table = $value['Tables_in_'.$this->db->database];
                    $sql_search = "select * from ".$table." where ";
                    $sql_search_fields = Array();
                    $sql2 = "SHOW COLUMNS FROM ".$table;
                    $rs2 = $this->db->query($sql2);
                    if($rs2->num_rows() > 0){
                        foreach ($rs2->result_array() as $key2 => $value2) {
                            $colum = $value2['Field'];
                            $sql_search_fields[] = $colum." like('%".$search."%')";
                        }
                    }
                    $sql_search .= implode(" OR ", $sql_search_fields);
                    $rs3 = $this->db->query($sql_search);
                    $search_result = $rs3->result_array();
                    if(!empty($search_result))
                    {
                        $out[$table] = $rs3->result_array();
                    }
                }
            }
            echo "<pre>";
            print_r(count($out));
            echo "</pre>";
        }
        else
        {

        }
    }

    function search_global($search = '')
    {
        $user_info = $this->common_model->get_data('candidate', array('can_id'=>get_login_user_id(), 'is_deleted'=>0));
        if(!empty($user_info))
        {
            $out = "";
            $sql = "show tables;";
            $rs = $this->db->query($sql);
            $final_result = array();
            if($rs->num_rows() > 0){
                foreach ($rs->result_array() as $key => $value) {
                    $table = $value['Tables_in_'.$this->db->database];
                    $sql_search = "select * from ".$table." where ";
                    $sql_search_fields = Array();
                    $sql2 = "SHOW COLUMNS FROM ".$table;
                    $rs2 = $this->db->query($sql2);
                    if($rs2->num_rows() > 0){
                        foreach ($rs2->result_array() as $key2 => $value2) {
                            $colum = $value2['Field'];
                            $sql_search_fields[] = $colum." like('%".$search."%')";
                        }
                    }
                    $sql_search .= implode(" OR ", $sql_search_fields);
                    $rs3 = $this->db->query($sql_search);
                    $search_result = $rs3->result_array();
                    if(!empty($search_result))
                    {
                        $out[$table] = $rs3->result_array();
                    }
                }
            }
            /*if($user_info['can_type'] == 'user')
            {*/
                if(!empty($out))
                {
                    foreach ($out as $keyo => $valueo)
                    {
                        foreach ($valueo as $keyr => $valuer)
                        {
                            if(array_key_exists('created_by', $valuer))
                            {
                                if($valuer['created_by'] == get_login_user_id())
                                {
                                    $final_result[$keyo][$keyr] = $valuer;
                                }
                            }
                            else if(array_key_exists('last_modified_by', $valuer))
                            {
                                if($valuer['last_modified_by'] == get_login_user_id())
                                {
                                    $final_result[$keyo][$keyr] = $valuer;
                                }
                            }
                            else if(array_key_exists('can_id', $valuer))
                            {
                                if($valuer['can_id'] == get_login_user_id())
                                {
                                    $final_result[$keyo][$keyr] = $valuer;
                                }
                            }
                            else if(array_key_exists('is_deleted', $valuer))
                            {
                                if($valuer['is_deleted'] == 0)
                                {
                                    $final_result[$keyo][$keyr] = $valuer;
                                }
                            }
                        }
                    }
                }
                else
                {

                }
            /*}
            else
            {
                $final_result = $out;
            }*/
            $user_settings = $this->session->userdata('user_settings');
            $user_set = array();
            if(!empty($user_settings))
            {
                foreach ($user_settings as $keyu => $valueu)
                {
                    if(strpos($valueu['controller'], $search) !== false)
                    {
                        $user_set[$keyu] = $valueu;
                    }
                    if(strpos($valueu['method'], $search) !== false)
                    {
                        $user_set[$keyu] = $valueu;
                    }
                    if(!empty($valueu['submenu']))
                    {
                        foreach ($valueu['submenu'] as $keyus => $valueus)
                        {
                            if(strpos($valueus['controller'], $search) !== false)
                            {
                                $user_set[$keyu][$keyus] = $valueus;
                            }
                            if(strpos($valueus['method'], $search) !== false)
                            {
                                $user_set[$keyu][$keyus] = $valueus;
                            }
                        }
                    }
                }
            }
            echo "<pre>";
            var_dump($user_set);
            var_dump($final_result);
            echo "</pre>";
        }
    }

    function search_menu($search = '')
    {
        $user_settings = $this->session->userdata('user_settings');
        $user_set = array();
        $search = trim($search);
        if(!empty($user_settings))
        {
            foreach ($user_settings as $keyu => $valueu)
            {
                if(stripos($valueu['controller'], $search) !== false)
                {
                    $user_set[] = $valueu;
                }
                else if(stripos($valueu['method'], $search) !== false)
                {
                    $user_set[] = $valueu;
                }
                else if(stripos($valueu['menu_name'], $search) !== false)
                {
                    $user_set[] = $valueu;
                }
                if(!empty($valueu['submenu']))
                {
                    foreach ($valueu['submenu'] as $keyus => $valueus)
                    {
                        if(stripos($valueus['controller'], $search) !== false)
                        {
                            $user_set[] = $valueus;
                        }
                        else if(stripos($valueus['method'], $search) !== false)
                        {
                            $user_set[] = $valueus;
                        }
                        else if(stripos($valueus['menu_name'], $search) !== false)
                        {
                            $user_set[] = $valueus;
                        }
                    }
                }
            }
        }
        $links = array();
        $input = array();
        if(!empty($user_set))
        {
            $i = 0;
            foreach ($user_set as $key1 => $value1)
            {
                /*if(array_key_exists('submenu', $value1))
                {
                    foreach ($value1['submenu'] as $key2 => $value2)
                    {
                        if(!empty($value2['controller']))
                        {
                            $links[$i]['link'] = '/'.$value2['controller'];
                            if(!empty($value2['method']))
                            {
                                $links[$i]['link'] .= '/'.$value2['method'];
                            }
                            $links[$i]['title'] = $value2['menu_name'];
                            $i++;
                        }
                    }
                }
                else
                {*/
                    if(!empty($value1['controller']) && !empty($value1['method']))
                    {
                        $links[$i]['link'] = '/'.$value1['controller'];
                        if(!empty($value1['method']))
                        {
                            $links[$i]['link'] .= '/'.$value1['method'];
                        }
                        $links[$i]['title'] = $value1['menu_name'];
                        $i++;
                    }
                // }
            }
            $input = array_map("unserialize", array_unique(array_map("serialize", $links)));
            echo json_encode($input);
        }
        else
        {
            echo json_encode($input);
        }
    }
}