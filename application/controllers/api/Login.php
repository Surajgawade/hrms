<?php

require(APPPATH.'/libraries/REST_Controller.php');
 
class Login extends REST_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('candidate_model');
        $this->output->set_content_type('application/json');
       $this->load->model('common_model');
       $this->load->model('login_model');
        
        //$this->load->library('../login','login');
    }
    function authenticate_post(){

        $data=$this->post();

        $email=$data['email'];
        $password=$data['password'];
        
        if(empty($email))
        {
        	echo json_encode(array('message'=>'Username Is Required'));
        }
        else if(empty($password))
        {
        	echo json_encode(array('message'=>'Password Is Required'));	
        }
        else
        {
        	$this->load->model('login_model');
	        $data=$this->login_model->check_login_password($email,$password);
	        
	        if(!empty($data))
	        {
	        	// /x_debug($data);
	        	$email = $data->email;
	            $hash = $data->password;
	            // print_r($hash);
	            // print_r($password);
	            // exit;
	           	if(password_verify($password,$hash))
	           	{
	        		echo json_encode(array('message'=>'success',"data"=>$data));
	        	}
	        	else
	        	{
	        		echo json_encode(array('message'=>'Invalid Password'));		
	        	}
	        }
	        else
	        {
	        	echo json_encode(array('message'=>'Invalid Username Or Password'));	
	        }
        }
        
    }
    function forgot_password_post()
    {
        $data=$this->post();
        $email=$data['email'];
        if(empty($email))
        {
            echo json_encode(array('message'=>'Username Is Required'));
        }
        else
        {
            $data = $this->common_model->get_fields_by_id('candidate' ,$fields  = array('can_name','email'),$conditions = array('email' => $email));
                $data = (array) $data;       
            
            $this->forgotPassword_mail($data);
            echo json_encode(array('message'=>'Email Send successfully'));
        }
    }
    function reset_password_post()
    {
        
        $data=$this->post();
        $email=$data['email'];
        $old_password=$data['password'];
        $new_password=$data['new_password'];
        $hash='';
        $data=$this->login_model->check_login_password($email,$old_password);
         //x_debug($data);
        //echo(password_verify($password, $data->password)); 
        //x_debug($user);
        if(empty($email))
        {
            echo json_encode(array('message'=>'Username Required'));   
        }
        else if(empty($old_password))
        {
            echo json_encode(array('message'=>'Old Password Required'));    
        }
        else if(empty($new_password))
        {
            echo json_encode(array('message'=>'New Password Required'));    
        }
        else if(empty($data))
        {
            $hash=$data->password;
            echo json_encode(array('message'=>'Invalid Username'));
        }
        else if(password_verify($old_password, $hash))
        {
            echo json_encode(array('message'=>'Invalid Password'));
        }
        else
        {
            $new_password=password_hash($new_password,PASSWORD_DEFAULT);
            //print_r($new_password);
            // exit;
            if($this->common_model->update('candidate',array('password'=>$new_password),array('email'=>$email)))
            {
                echo json_encode(array('message'=>'Password Updated successfully'));       
            }
            else
            {
                echo json_encode(array('message'=>'Error'));       
            }
        }
        //$data_array = array('email' => $user_data['email'] ,'password' =>$encoded_password);
    }
    function forgotPassword_mail($data = NULL)
    {
        $this->load->library('email_send');
        $this->load->helper('url');
        $subject = 'Password Update Request';
        // x_debug($data);
        $this->common_model->update('candidate',array('reset_code'=>base64_encode($data['email'])),array('email'=>$data['email']));
        $data['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
        $message = $this->load->view('email_templates/reset_password', $data, TRUE);
        $phone = $this->common_model->get_data('candidate',array('email'=>$data['email']),'phone1');
        $smsm = send_sms($phone['phone1'], "Reset password link has been sent to your mailbox.");
        $this->email_send->send_mail($data['email'],$subject, $message ,$data);
    }
}
