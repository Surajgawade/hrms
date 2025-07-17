<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Resignation extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Resignation_model','resignation');
        $this->load->model('common_model');
        $userdata = $this->session->userdata('logged_in_user');
        if(!$userdata){
            $newURL = site_url()."/login";
            header('Location: '.$newURL);        		
        }        
    }
    private function load_view($viewname= "blank_page",$page_title){
        $this->content->meta_description="Meta meta_description here!";
        $this->content->meta_keywords="meta keywords here!";
        $this->masterpage->setMasterPage('master');
        $this->content->page_description = "";
        $this->masterpage->setPageTitle($page_title);
        $this->masterpage->addContentPage('resignation/'.$viewname,'content',$this->content);
        $this->masterpage->show();
    }
	public function index()
	{
        if($this->session->userdata('role_id') == 5)
        {

                $this->content->resi_dtls = $this->resignation->get_resignation_dtls_for_hr();
                $this->load_view("resig_details_hr","HRMS - Resignation",$this->content);  
        }
        elseif($this->session->userdata('role_id') == 3)
        {
                $this->content->resi_dtls = $this->resignation->get_resignation_dtls_for_pm($this->session->userdata('email'));
                $this->load_view("resig_details_pm","HRMS - Resignation",$this->content);  
        }
        elseif($this->session->userdata('role_id') == 2)
        {
                $this->content->resi_dtls = $this->resignation->get_resignation_dtls_for_md();
                $this->load_view("resig_details_md","HRMS - Resignation",$this->content);  
        }
        else{
                $this->content->resi_dtls = $this->resignation->get_resignation_dtls($this->session->userdata('user_id'));
                $this->load_view("resig_details","HRMS - Resignation",$this->content); 
        }
    }
    public function resi_email()
    {
        $this->load->library('email_send');
        $user_data['email_title'] = $this->input->post('email_title');
        $user_data['email_to'] = $this->input->post('mail_to');
        $user_data['mail_cc'] = $this->input->post('mail_cc');
        $user_data['mail_bcc'] = $this->input->post('mail_bcc');
        $user_data['req_date'] = $this->input->post('req_date');
        $user_data['email_description'] = $this->input->post('email_description');
        $user_data['email_date'] = $this->input->post('req_date');
        $CI = get_instance();
        $user_data['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
        $message = $CI->load->view("email_templates/resignation", $user_data, TRUE);  
        $this->email_send->resignation($user_data['email_to'], $user_data['email_title'], $message, $user_data['mail_cc'],$user_data['mail_bcc'],$user_data['email_description'],$user_data['email_date']);
        $this->resignation->resi_information_insert();
         $url = site_url().'/resignation/resig_details';
            redirect($url);
    }
    public function resig_details()
    {
         $this->content->resi_dtls = $this->resignation->get_resignation_dtls($this->session->userdata('user_id'));
         $this->load_view("resig_details","HRMS - Resignation",$this->content);  
    }

    public function send_resig()
    {
        $superadmin = $this->config->item('super_user_role_id');
        $superadmin = implode(',', $superadmin);
         $email_details= $this->resignation->get_email_information($this->session->userdata('user_id'));
         $ro_email = $this->resignation->get_email_ro($email_details[0]->reporting_to);
         $this->content->can_details = $email_details[0]->email;
         // $this->content->hr_email = $email_details[0]->reporting_hr_email;
         $this->content->hr_email = $this->config->item('hr_email');
         $this->content->ro_emails = $ro_email[0]->email;
         $this->content->show = $this->db->query('SELECT * FROM `candidate` WHERE `is_deleted`=0 AND can_id='.get_login_user_id().' AND role_id NOT IN ('.$superadmin.')')->num_rows();
         $this->load_view("resignation","HRMS - Resignation",$this->content);  
    }
    
    public function save_handover()
    {
        $post = $this->input->post();
        $handover = array();
        if(!empty($post))
        {
            foreach ($post as $key => $value)
            {
                if(strpos($key, '-') !== FALSE)
                {
                    $h_rec = explode('-', $key);
                    $handover[$h_rec[2]][$h_rec[1]] = $value;
                }
            }
            $cnt = count($handover);
            $i = 0;
            if(!empty($handover))
            {
                foreach ($handover as $key1 => $value1)
                {
                    /*$qty = $this->common_model->get_data('property', array('prop_id'=>$value1['prop_id']));
                    $qty['quantity']++;
                    $qty_up = $this->common_model->update('property', array('quantity'=>$qty['quantity']), array('prop_id'=>$value1['prop_id']));*/
                    $res = $this->common_model->insert('handover_details', $value1);
                    if($res > 0)
                    {
                        $i++;
                    }
                }
                if($cnt == $i)
                {
                    $this->hr_status_update($post['resi_id'],$post['status']);
                }
                else
                {
                    echo json_encode(FALSE);
                }
            }
            else
            {
                $this->hr_status_update($post['resi_id'],$post['status']);
            }
        }
    }

    public function save_client_handover()
    {
        $post = $this->input->post();
        $handover = array();
        if(!empty($post))
        {
            foreach ($post as $key => $value)
            {
                if(strpos($key, '-') !== FALSE)
                {
                    $h_rec = explode('-', $key);
                    $handover[$h_rec[2]][$h_rec[1]] = $value;
                }
            }
            $cnt = count($handover);
            $i = 0;
            if(!empty($handover))
            {
                foreach ($handover as $key1 => $value1)
                {
                    if(!empty(trim($value1['client_name'])))
                    {
                        $value1['res_id'] = $post['resi_id'];
                        $can = $this->common_model->get_data('resignation_details', array('resi_id'=>$post['resi_id']));
                        $value1['can_id'] = $can['can_id'];
                        $res = $this->common_model->insert('client_handover', $value1);
                        if($res > 0)
                        {
                            $i++;
                        }
                    }
                    else
                    {
                        $i++;
                    }
                }
                if($cnt == $i)
                {
                    $this->pm_status_update($post['resi_id'],$post['status']);
                }
                else
                {
                    echo json_encode(FALSE);
                }
            }
            else
            {
                $this->pm_status_update($post['resi_id'],$post['status']);
            }
        }
    }

    public function hr_status_update($id,$status)
    {
        $res = $this->resignation->update_hr_status($id,$status);
        if($res == true)
        {
            $this->session->set_flashdata('success',"Response saved successfully !");
            $url = site_url().'/resignation/';
            redirect($url);
        }
    }
    public function pm_status_update($id,$status)
    {
        $res = $this->resignation->update_pm_status($id,$status);
        if($res == true)
        {
            $this->session->set_flashdata('success',"Response saved successfully !");
            $url = site_url().'/resignation/';
            redirect($url);
        }
    }
     public function md_status_update($id,$status)
    {
        $this->resignation->update_md_status($id,$status);
          $url = site_url().'/resignation/';
            redirect($url);  
    }
    public function hr_remark()
    {
        $this->resignation->insert_hr_remark($id);
          $url = site_url().'/resignation/';
            redirect($url);  
    }
     public function pm_remark()
    {
        $this->resignation->insert_pm_remark($id);
          $url = site_url().'/resignation/';
            redirect($url);  
    }
    public function md_remark()
    {
        $this->resignation->insert_md_remark($id);
          $url = site_url().'/resignation/';
            redirect($url);  
    }
    public function get_can_property($res_id = '')
    {
        $can = $this->common_model->get_data('resignation_details', array('resi_id'=>$res_id));
        $can_id = $can['can_id'];
        $res = $this->common_model->get_data_array('can_assigned_assets', array('can_id'=>$can_id, 'is_deleted'=>0));
        if(!empty($res))
        {
            foreach ($res as $key => $value)
            {
                $prop = $this->common_model->get_data('property', array('prop_id'=>$value['asset_id'], 'is_deleted'=>0));
                $res[$key]['property'] = $prop['prop_name'];
                $dept = $this->common_model->get_data('departments', array('id'=>$prop['dept_id'], 'is_deleted'=>0));
                $res[$key]['department'] = $dept['title'];
                $res[$key]['dept_id'] = $dept['id'];
                $res[$key]['res_id'] = $res_id;
            }
        }
        echo json_encode($res);
    }

    public function get_marketing_details($res_id = '')
    {
        $can = $this->common_model->get_data('resignation_details', array('resi_id'=>$res_id));
        $candidate = $this->common_model->get_data('candidate', array('can_id'=>$can['can_id']));
        $dept = $this->common_model->get_data('departments', array('id'=>$candidate['department'], 'is_deleted'=>0));
        if(!empty($dept))
        {
            if(stripos($dept['title'], 'market') !== FALSE)
            {
                echo json_encode(TRUE);
            }
            else
            {
                echo json_encode(FALSE);
            }
        }
        else
        {
            echo json_encode(FALSE);
        }
    }
}
