<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rpo_login extends CI_Controller
{
   function __construct()
   {
      parent::__construct();
      $this->load->model('rpo_login_model');
      $this->load->model('common_model','common');
   }

   function index()
   {
      $this->data['email'] = $this->input->cookie('email');
      if(!empty($this->session->userdata('logged_in_user')))
      {
         redirect('dashboard');
      }
      else
      {
         $this->load->view('rpo_login', $this->data);
      }
   }

   function process()
   {
      if(!empty($this->input->post()))
      {
         $email = $this->input->post('email',true);
         $cookie_email = $email;
         $password = $this->input->post('password',true);
         $post = $this->input->post();
         $user = $this->rpo_login_model->check_login_password($email,$password);
         if($user)
         {
            $email = $user->email_id;
            $hash = $user->password;
         }
         else
         {
            $data['error'] = '<div class="alert alert-danger alert-no-border alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>Email Address Does Not Exist</div>';
            $data['email'] = $email;
            $this->load->view('rpo_login',$data);
            return 0;
         }
         if (password_verify($password, $hash))
         {
            $can_arr = array('id'=>$user->can_id, 'name' => $user->can_name, 'email'=>$user->email_id,'intw_can_id'=>$user->intw_can_id,'can_type'=>$user->can_type, 'logged_in'=> true);
            // debug($user);
            $this->session->set_userdata('logged_in_user',$can_arr);
            $this->session->set_userdata('intw_can_id',$user->intw_can_id);
            $this->session->set_userdata('role_id',$user->role_id);
            $this->session->set_userdata('profile_pic',$user->profile_picture);
            $this->session->set_userdata('user_name',$user->can_name);
            $this->session->set_userdata('job_profile',$user->designation);
            $this->session->set_userdata('user_id',$user->can_id);
            $this->session->set_userdata('email',$user->email_id);
            $this->session->set_userdata('can_type',$user->can_type);
            $this->session->set_userdata('is_rpo_can',1);
            // x_debug($_SESSION);
            set_user_settings($user->can_id,$is_rpo = true);
            // x_debug($menus);

            $newURL = site_url()."/dashboard";
            if(array_key_exists('remember', $post))
            {
               $this->load->helper('cookie');
               $cookie = array(
               'name'   => 'cookie_email',
               'value'  => $cookie_email,
               'expire' => 86400*30//'86500'
               );
               $this->input->set_cookie($cookie);
               $cookie_data = $this->input->cookie();
            }   
            $hr_user_role_id=$this->config->item('hr_user_role_id');
            // if($can_arr['role_id']==$hr_user_role_id[0])
            // {
            //    $condition=array('can_id'=>$hr_user_role_id[0], 'login_date'=>date('Y-m-d'));
            //    $session_data=$this->common_model->get_data('login_session',$condition);

            //    if(empty($session_data))
            //    {
            //       $data=array('login_date'=>date('Y-m-d'), 'can_id'=>$can_arr['role_id']);
            //       $this->common_model->insert('login_session',$data);
            //       $this->session->set_userdata('first_login','1');
            //    }
            //    else
            //    {
            //       $this->session->set_userdata('first_login','0');
            //    }
            // }
            // To check first login
            echo $user->login_status;
            $this->session->set_userdata('login_status',$user->login_status);
            // To check first login end here
            header('Location: '.$newURL);
         }
         else
         {
            $data['error'] = '<div class="alert alert-danger alert-no-border alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>Email and Password Does Not Match</div>';
            $data['email'] = $email;
            $this->load->view('rpo_login',$data);
         }
      }
   }


   function check_availability()
   {
      $this->load->model('candidate_model');
      if($this->input->is_ajax_request())
      {
         $email = $this->input->post('email',TRUE);
         if($this->candidate_model->check_email_availability($email) > 0)
         {
            $data = $this->common->get_fields_by_id($tablename='candidate' ,$fields  = array('can_name','email'),$conditions = array('email' => $email));
            $data = (array) $data;       
          $this->forgotPassword_mail($data);
         }
         else
         {
          echo "0";
         }
      }
   }


   function forgotPassword_mail($data = NULL)
   {
      $this->load->library('email_send');
      $this->load->helper('url');
      $subject = 'Password Update Request';
      // x_debug($data);
      $this->common->update('candidate',array('reset_code'=>base64_encode($data['email'])),array('email'=>$data['email']));
      $data['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
      $message = $this->load->view('email_templates/reset_password', $data, TRUE);
      $this->email_send->send_mail($data['email'],$subject, $message ,$data);
   }

   function save_password()
   {
      $post = $this->input->post();
      $data['password'] =  password_hash($post['password'], PASSWORD_DEFAULT);
      $data['can_details'] = $this->common->get_data($tablename='candidate', $conditions = array('reset_code' => $post['reset_code']));
      //x_debug($data);
      $this->common->update('candidate',array('password'=>$data['password'],'reset_code'=>''),array('can_id'=>$data['can_details']['can_id']));
      echo "true";
   }


   function reset_password()
   {
      $data  = array();
      $link_date=$_GET['d'];
      $date=strtotime(date('Y-m-d h:i:s'));
      // $min=round(abs($date - $link_date) / 60,2);
      //print_r($min);
      $min=round(abs($date - $link_date)/3600,2);
      if($min>24)
      {
         echo 'link has been expired..';        
      }
      else
      {
         $data=$this->common->get_data('candidate',array('reset_code'=>$_GET['em']),'can_id');
         if(!empty($data))
         {
            $this->load->view('reset_password',$data);
         }
         else
         {
            echo 'link has been expired..';       
         }
         // $this->load->view('reset_password',$data);
      }
      //$this->load->view('reset_password',$data);
   }


   function logout()
   {
      $this->session->sess_destroy();
      //unset($this->session);
      $this->data['email'] = $this->input->cookie('email');
      // $this->config->item('foo');
      // var_dump($this->input->cookie('email'));
      // $this->cache->clean();
      redirect('rpo_login', $this->data);
      /* echo "Logout successfully,<br> Redirecting in few seconds";
      $newURL =  base_url()."/index.php/login";
      header('Location: '.$newURL);
      header('Refresh: 3;url=http://localhost/hrms/');   */   
   }

   function email_activation()
   {
      $email = base64_decode($_GET['em']);
      if($this->common->active_account($email))
      {
         $this->common->update('users',array('is_active'=>1),array('email'=>$email));
         $success = $this->session->set_flashdata('success', 'Your account has been activated.');
         redirect('Login', $success);    
      }
   }


   // Function to update data in database to current date
   function update_data_in_db()
   {
      // $data1 = array('tat' => date('Y-m-d'));
      // echo $this->common->update('tasks',$data1);
      $this->db->set('tat', date('Y-m-d')); 
      $q = $this->db->update('tasks');
      $this->db->set('status', 'raised');
      $this->db->set('raised_date', date('Y-m-d'));
      $this->db->set('from_date', date("Y-m-d", strtotime("+ 2 day")));
      $this->db->set('to_date', date("Y-m-d", strtotime("+ 6 day")));
      $this->db->set('approved_date',NULL);
      $status = array('approved', 'raised');
      $this->db->where_in('status',$status); 
      $q = $this->db->update('travel');
      $this->db->set('start', date('Y-m-d 00:00:00'));
      $this->db->set('end', date('Y-m-d 23:59:59'));
      $event_type = array('training', 'meeting', 'appointment','calls');
      $this->db->where_in('event_type',$event_type); 
      $q = $this->db->update('event');
      $this->db->set('dv_state', 1); 
      $q = $this->db->update('ci_voting');
      // $lst_qry = $this->db->last_query();
      redirect('Login');
   }
}


