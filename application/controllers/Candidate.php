 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Candidate extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('candidate_model');
        $this->load->model('common_model');
        $this->load->config('hrms_config');
        $userdata = $this->session->userdata('logged_in_user');
        if(!$userdata){
            $newURL = site_url()."/login";
            header('Location: '.$newURL);        		
        }        
    }

	public function index($msg="")
	{
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
        $this->load_view("candidate_list","HRMS - Employee List",$this->content);        
	}

    public function candidate_list($msg="")
    {
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
        $this->load_view("candidate_list","HRMS - Employee List",$this->content);        
    }
    public function get_candidates_data($department_id='')
    {
        $this->content->candidates=$this->common_model->get_data_array('candidate',array('department'=>$department_id));
        $this->load_view('can_list','Department Wise Employee List',$this->content);
    }
    function list_candidate()
    {  
        $userdata = $this->session->userdata('logged_in_user');
        
        $this->datatables->unset_column('can_id');
        $this->datatables->select('c.can_id,c.emp_code, c.can_name, c.email,jp.title as job_profile, c.phone1,CASE WHEN  c.is_deleted= 1 THEN \'No\' ELSE \'Yes\' END AS is_active');
        $this->datatables->from('candidate c');
        $this->datatables->join('job_profiles jp', 'jp.id = c.job_profile', 'left');
        $this->datatables->where('c.role_id!=11');
	   $this->datatables->where('c.is_active',1);
        if(!in_array($userdata['role_id'], $this->config->item('super_user_role_id')) && !in_array($userdata['role_id'], $this->config->item('admin_user_role_id')) && $userdata['role_id']!=5)
        { 
            $this->datatables->where('c.created_by',get_login_user_id());
        }
        //$this->datatables->where('c.job_profile=jp.id');
        // $this->db->order_by("can_id", "desc");
        $update_url = site_url().'/candidate/update/$1';
        $view_url=site_url().'/candidate/view/$1';
        $this->datatables->add_column('edit', '<a  href="'.$update_url.'" class="tabledit-edit-button btn btn-success btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><button onClick="activate_can($1)"  class="tabledit-delete-button btn-success btn btn-sm btn_delete " id="activate_candidate_$1" >Activate</button><a href="javascript:;" onClick="delete_can($1)"  class="tabledit-delete-button btn-danger btn btn-sm btn_delete" id="delete_candidate_$1"><span class="glyphicon glyphicon-trash"></span></a><a href="'.$view_url.'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>', 'can_id');           


        $result= $this->datatables->generate();  
        // $lst_qry = $this->db->last_query();
        // file_put_contents('/tmp/test1.txt', $lst_qry. "\n\n", FILE_APPEND); 
        echo $result;
    }  


    function register()
    {  
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());
       	$this->load_view("register","HRMS - Register New Employee",$this->content);			
    }


    function check_availability()
    {
        if($this->input->is_ajax_request())
        {
            $email = $this->input->post('email',TRUE);
            if($email=='')
            {
              echo "2";
            }
            else
            {
                if($this->candidate_model->check_email_availability($email) > 0)
                {
                    echo "0";
                }
                else
                {
                    echo "1";
                }  
            }               
        }
    }

    function insert()
    {
        $this->load->helper(array('form', 'url','security'));
        $this->load->library('form_validation');
        //server side validations
        $this->form_validation->set_rules('can_name','Candidate Name','required',array('required'=>'not proivedd %s'));
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('mobileno', 'Mobile Number','required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->register();
        }
        else
        {
    	    $this->load->model('candidate_model');
    	    $can_name = $this->input->post('can_name', true);
    	    $email = $this->input->post('email',true);
    	    $mobileno = $this->input->post('mobileno', true);
    	    $default_password = password_hash("raoson1234", PASSWORD_DEFAULT);
            if($this->candidate_model->check_email_availability($email) > 0)
            {
                $error = $this->session->set_flashdata('error', 'Email id already exist!');
                $this->session->set_flashdata('can_name',$can_name);
                $this->session->set_flashdata('email',$email);
                $this->session->set_flashdata('mobileno',$mobileno);
                redirect('candidate/register', $error);
            }
            else
            {
		/*
                    $this->load->library('email_send');
                    $mailer_config=$this->common_model->get_data('email_config',array('email_template'=>'registration_confirmation'));
                    $message = $this->load->view("email_templates/".$mailer_config["email_template"], $insert_arr, TRUE);

                    $sent = $this->email_send->send_mail_new($mailer_config, $email,$message);
                    if($sent==1)
                    {
                       // echo "New Employee has been created successfully!";exit;
                        $success = $this->session->set_flashdata('success', 'New Employee has been created successfully!');
                        redirect('candidate',$success);
                    }
                    else
                    {
			$error = "Error in inserting candidate registration details";
                    log_message('error', $error);
                    }
                  */
                $manger_role = $this->common_model->get_data('roles', array('role_name like'=>'%Manager%', 'is_deleted'=>0));
                $manager = $this->common_model->get_data('candidate', array('role_id'=>$manger_role['role_id'], 'is_deleted'=>0));

                $last_id = $this->common_model->count_all('candidate');

                if(!empty($last_id))
                {
                    // if(!empty($can_id))
                    // {
                    //     $emp_code = $this->input->post('emp_code',true);    
                    // }
                    // else
                    // {
                        $last_id = $last_id +1;
                        $emp_code = $this->config->item('canId_prefix').$last_id;
                    // }
                    
                }
                else
                {
                    $emp_code = $this->config->item('canId_prefix').'1';
                }


                $insert_arr = array('can_name' => $can_name, 'email'=>$email, 'phone1'=>$mobileno, 'password'=>$default_password,'role_id'=>14,'is_active'=>1,'reporting_to'=>$manager['can_id'],'emp_code'=>$emp_code);
                $insert_arr=set_log_fields($insert_arr,'insert');
                $id = $this->common_model->insert('candidate',$insert_arr);
                if($id > 0)
                {
                    $this->load->library('email_send');
                    $mailer_config = $this->common_model->get_data('email_config',array('email_template'=>'registration_confirmation'));
                    $insert_arr['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
                    $message = $this->load->view("email_templates/".$mailer_config["email_template"], $insert_arr, TRUE);
                    $success = $this->session->set_flashdata('success', 'New Employee has been created successfully!');
                    redirect('candidate',$success);

                }
        }
}
    }


/*    function send_mail($data = NULL)
    {
        $this->load->library('email_send');
        $this->load->helper('url');
        // require_once 'class.phpmailer.php';
        //include APPPATH . 'third_party/phpmailer/PHPMailerAutoload.php';
        //$em = base64_encode($data['email']);
        $subject ="Registration Confirmation";
        $message = $this->CI->load->view($template='email_templates/registration_confirmation', $data, TRUE);
        return $this->email_send->send_mail($data['email'], $subject, $message ,$data);
    }*/

    public function profile()
    {
       // user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        $date = $this->input->get('token',true);
        $email = $this->input->get('em',true);
        $date = date_create(date('Y-m-d', base64_decode($date)));
        $ndate = date_create(date('Y-m-d'));
        $email = base64_decode($email);
        $diff = date_diff($date,$ndate);
        $d = $diff->format("%R%a");
        $id = $this->candidate_model->get_id_from_email($email);
        if($d > 7)
        {
            $url = site_url().'/candidate/register/expired';
            redirect($url);
            //give message activation link has been expeired and redirect to register page
        }
        else
        {
            $url = site_url().'/candidate/update/'.$id['can_id'];
            redirect($url);
            //redirect to profile form 
        }
    }


    public function update()
    {
        $this->content->percentage = $this->check_per_profile_complete();  
        // $access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
        // $access=0;
        $userdata = $this->session->userdata('logged_in_user');
        $can_id = $this->uri->segment(3);

        if(($can_id == get_login_user_id()) || (in_array($userdata['role_id'],$this->config->item('hr_user_role_id'))||in_array($userdata['role_id'],$this->config->item('super_user_role_id'))||in_array($userdata['role_id'],$this->config->item('admin_user_role_id'))))
        {
            $this->content->qualifications  = $this->common_model->get_form_dropdown($tablename='qualifications', $fields = array('id','title'), $conditions = array('is_deleted' => 0));
            $this->content->candidates = $this->common_model->get_form_dropdown($tablename = 'candidate', $fields = array('can_id','can_name'),$conditions = array('is_deleted' => 0));       
            $this->content->departments  = $this->common_model->get_form_dropdown($tablename='departments', $fields = array('id','title'),$conditions = array('is_deleted' => 0));
            $this->content->roles  = $this->common_model->get_form_dropdown($tablename='roles', $fields = array('role_id','role_name'),$conditions = array('is_deleted' => 0));

            $this->content->department_hods = $this->candidate_model->get_dept_hods();
            check_record_exist($tablename='candidate', $conditions = array('can_id' =>$can_id));

            $this->content->can_details = $this->get_candidate_data($can_id);
            
            $this->content->reporting_to = $this->common_model->get_data('candidate',array('can_id' => $this->content->can_details->reporting_to),$fields='can_name'); 
            $this->session->can_profile_pic=$this->content->can_details->profile_picture;
            $this->session->can_job_profile=$this->content->can_details->job_profile;
            $this->session->can_name=$this->content->can_details->can_name;
            if($this->content->can_details->department != 0 && !empty($this->content->can_details->department))
            {
                $this->content->job_profiles  = $this->common_model->get_form_dropdown($tablename='job_profiles', $fields = array('id','title'),$conditions = array('is_deleted' => 0, 'dept_id'=>$this->content->can_details->department));
            }
            else
            {
                $this->content->job_profiles  = $this->common_model->get_form_dropdown($tablename='job_profiles', $fields = array('id','title'),$conditions = array('is_deleted' => 0));
            }
            if(!empty($_POST))
            {
                $post = $this->input->post();
                // x_debug($post);
                //$candidate_details = new Candidate_Entity();
                $candidate_details['can_id'] = $can_id;
                $candidate_details['can_name'] = $post['can_name'];
                $candidate_details['cur_address'] = $post['cur_address'];
                $candidate_details['per_address'] = $post['per_address'];
                $candidate_details['email'] = $post['email'];
                $candidate_details['dob'] = (!empty($post['dob']))?date_to_db($post['dob']):'';
                $candidate_details['gender'] = $post['gender'];
                $candidate_details['phone1'] = $post['phone1'];
                $candidate_details['phone2'] = $post['phone2'];
                $candidate_details['education'] = $post['qualification'];
                $candidate_details['job_profile'] = $post['job_profile'];
                $candidate_details['department'] = $post['department'];
                $candidate_details['current_ctc'] = $post['current_ctc'];
                $candidate_details['expected_ctc'] = $post['expected_ctc'];
                $candidate_details['emer_contact_name'] = $post['emer_contact_name'];
                $candidate_details['emer_contact_no'] = $post['emer_contact_no'];
                $candidate_details['aadhar_no'] = $post['aadhar_no'];
                $candidate_details['pan_no'] = strtoupper($post['pan_no']);
                $candidate_details['blood_group'] = $post['blood_group'];
                $candidate_details['ready_to_relocate'] = $post['ready_to_relocate'];
                $candidate_details['joining_date'] = (!empty($post['joining_date']))?date_to_db($post['joining_date']):'';
                $candidate_details['probation_period'] = (!empty($post['probation_period'])) ? $post['probation_period'] :'';
                $candidate_details['probation_end_date'] = (!empty($post['probation_end_date'])) ? date_to_db($post['probation_end_date']):'';
                $candidate_details['role_id'] = $post['role'];
                if(!empty($post['rpo_role_name']))
                    $candidate_details['can_type'] = $post['rpo_role_name'];
                else
                    $candidate_details['can_type'] = 'user';
                $candidate_details['reporting_to'] = $post['reporting_to'];
                $candidate_details['is_active'] = 1;
                $candidate_details=set_log_fields($candidate_details);

                
                $id = $this->common_model->update('candidate',$candidate_details,array('can_id'=>$can_id));
                /* Log user activity */
                if($can_id==get_login_user_id())
                {
                    user_activity_log($data = array('can_id' => get_login_user_id(),'table_name' => 'candidate' ,"operation_name" => 'update' ,'controller'=> $this->router->fetch_class(),'method'=> 'update', 'last_modified_on'=> date('Y-m-d h:i:s'), 'last_modified_by' => get_login_user_id(),'comment' => 'Profile Updated'));
                }

                $doj = $this->candidate_model->get_can_doj($can_id);
                if(!empty($doj))
                {
                    // $this->allocate_leaves($can_id, $doj->joining_date);
                   $this->leave_allocation($can_id, $doj->joining_date,$doj->probation_period,$doj->probation_end_date);
                    // x_debug($doj);   
                }

                if($last==get_login_user_id())
                {
                  set_user_session(get_login_user_id());
                  $this->session->set_userdata('profile_pic',$this->session->can_profile_pic);
                  $this->session->set_userdata('can_profile_pic',$this->session->can_profile_pic);
                  $this->session->set_userdata('job_profile',$candidate_details['job_profile']);
                }
                
                $this->session->set_flashdata('success', 'Profile Updated Successfully!');
                redirect('candidate/update/'.$can_id);
            }
            $this->load_view("can_profile","HRMS - Employee Profile",$this->content);
        }
        else
        {             
            $this->session->set_flashdata('warning', 'Access Denied');
            redirect('candidate');  
        }
    }

    function delete()
    {
        $access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
        if(!empty($access))
        {
            // $this->session->set_flashdata('access_denied', 'Access Denied');
            // echo 'Access Denied';
            echo "0";
        }
        else
        { 
            $can_id = $this->input->post('can_id');
            $data['is_deleted']=1;
            $data=set_log_fields($data); 
            $id  = $this->common_model->update('candidate',$data,array('can_id'=>$can_id));
            echo "1";
        }
    }
    function activate()
    {
        $access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
        $access=0;
        if(!empty($access))
        {
            echo "0";
        }
        else
        {
            $data['is_deleted']=0;
            $data=set_log_fields($data); 
            $can_id = $this->input->post('can_id');
            $this->common_model->update('candidate',$data,array('can_id'=>$can_id));
            echo "1";
        }
    }

    public function get_candidate_data($id)
    {
       return $this->candidate_model->get_by_id($id);
    }

    function get_candidate_name_by_id($can_id)
    {
       return $this->candidate_model->get_candidate_name_by_id($can_id); 
    }

    /* ======  Employee Bank Details ====== */

    function bank_details()
    {
        //user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        $userdata = $this->session->userdata('logged_in_user');
        $can_id = $this->uri->segment(3);
        if(($can_id == get_login_user_id()) || (in_array($userdata['role_id'],$this->config->item('hr_user_role_id'))||in_array($userdata['role_id'],$this->config->item('super_user_role_id'))||in_array($userdata['role_id'],$this->config->item('admin_user_role_id'))))
        {
            $this->content->percentage = $this->check_per_profile_complete();  
            check_record_exist($tablename='candidate', $conditions = array('can_id' =>$can_id));
            $this->content->can_details = $this->get_candidate_name_by_id($can_id);
            $this->content->can_bank_details = $this->candidate_model->get_candidate_bank_details($can_id);
            // x_debug($this->content->can_bank_details);
            $this->load_view("bank_details","HRMS - Employee Bank Details",$this->content);
        }
        else
        {
            $this->session->set_flashdata('warning', 'Access Denied');
            redirect('candidate');
        }
    }


    function upload_bank_details()
    {
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
        {
            $can_id = $this->input->post('can_id', true);
            $bd_id = $this->input->post('bd_id', true);
            $bank_name = $this->input->post('bank_name', true);
            $branch_name = $this->input->post('branch_name', true);
            $account_number = $this->input->post('account_number', true);
            $IFSC_code = strtoupper($this->input->post('IFSC_code', true));
            $beneficiary_id = $this->input->post('beneficiary_id', true);
            $transaction_type = $this->input->post('transaction_type', true);
            $old_bank_statement = $this->input->post('old_bank_statement', true);
            $upload_path = UPLOADPATH; //set your folder path
            if(!is_dir($upload_path))
            {
               mkdir($upload_path , 777);
            }

            $can_doc_path = $upload_path.$can_id."/";
            if( ! is_dir($can_doc_path)){
                mkdir($can_doc_path, 0766, true);
            }
            //set the valid file extensions 
            $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "GIF", "JPG", "PNG", "doc", "txt", "docx", "pdf", "xls", "xlsx"); //add the formats you want to upload
         
            if (!empty($_FILES))
            {
                $name = $_FILES['myfile']['name']; //get the name of the file
                $size = $_FILES['myfile']['size']; //get the size of the file
                //check if the file is selected or cancelled after pressing the browse button.
                list($txt, $ext) = explode(".", $name); //extract the name and extension of the file
                if (in_array($ext, $valid_formats))
                { 
                    //if the file is valid go on.
                    if ($size < 2098888)
                    {
                        // check if the file size is more than 2 mb
                        // $file_name = $_POST['filename']; //get the file name
                        $tmp = $_FILES['myfile']['tmp_name'];
                        if (move_uploaded_file($tmp, $can_doc_path . time().'acc_statement'.'.'.$ext))
                        { 
                            //check if it the file move successfully, then insert into database
                            $data  = array('can_id' => $can_id,'bd_id' => $bd_id, 'bank_name' => $bank_name,'branch' => $branch_name,'account_number' => $account_number,'ifsc'=> $IFSC_code,'beneficiary_id' =>$beneficiary_id,'transaction_type' =>$transaction_type,'bank_statement_path' => $can_doc_path,'bank_statement_name'=>time().'acc_statement'.'.'.$ext);
                            if($bd_id>0)
                            {
                                $data=set_log_fields($data);
                                $this->common_model->update('bank_details',$data,array('bd_id'=>$bd_id));
                            }
                            else
                            {
                                $data=set_log_fields($data,'insert');
                                $this->common_model->insert('bank_details',$data);
                                if($can_id==get_login_user_id())
                                {
                                    user_activity_log($data = array('can_id' => get_login_user_id(),'table_name' => 'bank_details' ,"operation_name" => 'update' ,'controller'=> $this->router->fetch_class(),'method'=> 'update','last_modified_on'=> date('Y-m-d h:i:s'),'last_modified_by' => get_login_user_id(),'comment' => 'Bank Details Uploaded'));
                                }
                            }
                            // print_r($data);exit;
                            // $this->candidate_model->save_bank_details($data);
                            
                           //echo  json_encode(array("msg"=>"Bank details updated successfully!"));                         
                            // redirect('candidate/bank_details/'.$can_id);
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
                    echo "4";
                }
            }
            else if($old_bank_statement != NULL)
            {
                $data  = array('can_id' => $can_id,'bd_id' => $bd_id, 'bank_name' => $bank_name,'branch' => $branch_name,'account_number' => $account_number,'ifsc'=>$IFSC_code,'beneficiary_id' =>$beneficiary_id,'transaction_type' =>$transaction_type);
                $data = set_log_fields($data);
                $res = $this->common_model->update('bank_details',$data,array('bd_id'=>$bd_id));
                if($res == true)
                {
                    if($can_id==get_login_user_id())
                    {
                        user_activity_log($data = array('can_id' => get_login_user_id(), 'table_name' => 'candidate' ,"operation_name" => 'update' ,'controller'=> $this->router->fetch_class(),'method'=> 'update','last_modified_on'=> date('Y-m-d h:i:s'),'last_modified_by' => get_login_user_id(),'comment' => 'Bank Details Updated'));
                    }
                    echo "1";
                }
                else
                {
                    echo "5";
                }
            }
            else
            {
                echo "Please select a file..!";
            }
            exit;
        }  
    }


    /* ======  Employee Document Details ====== */


    function documents()
    {
        $userdata = $this->session->userdata('logged_in_user');
        $can_id = $this->uri->segment(3);
        if(($can_id == get_login_user_id()) || (in_array($userdata['role_id'],$this->config->item('hr_user_role_id'))||in_array($userdata['role_id'],$this->config->item('super_user_role_id'))||in_array($userdata['role_id'],$this->config->item('admin_user_role_id'))))
        {
            $this->content->percentage = $this->check_per_profile_complete();  
            //user_access_operation($this->router->fetch_class(),$this->router->fetch_method());         
            $this->load_view("documents","HRMS - Employee Documents",$this->content);
        }
        else
        {
            $this->session->set_flashdata('warning', 'Access Denied');
            redirect('candidate');
        }
    }

    function document_details($can_id = '')
    {
        $this->datatables->unset_column('doc_id');
        $this->datatables->unset_column('file_name');
        $this->datatables->select('doc_id,doc_name,file_name');
        $this->datatables->from('documents');
        $this->datatables->where('can_id',$can_id);
        $this->datatables->where('is_deleted',0);
        // $this->db->order_by("doc_id", "desc");
        $this->datatables->add_column('edit', '<button type="button" class="tabledit-delete-button btn-danger btn btn-sm btn_delete_bill" value="$1" style="float: none;" onClick="delete_data($1)"><span class="glyphicon glyphicon-trash"></span></button>', 'doc_id');
        $this->datatables->add_column('file_name', '<a href="'.base_url().'uploads/documents/$2" download>$1</a>', 'doc_name,file_name');
        $result= $this->datatables->generate();  
        echo $result;
    }

    function add_document()
    {
        $this->content->percentage = $this->check_per_profile_complete();  
        $can_id = $this->uri->segment(3);
        $this->content->can_details = $this->get_candidate_name_by_id($can_id); 
        $this->load_view("add_document","HRMS - Upload New Document",$this->content);
    }

    function upload_document()
    {
        $can_id = $_POST['can_id'];
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
        {
            $upload_path = UPLOADPATH."documents/"; //set your folder path
            if(!is_dir($upload_path))
            {
               mkdir($upload_path , 777,true);
            }

          /*  echo $can_doc_path = "/var/www/html/hrms/uploads/".$can_id."/";
            if( ! is_dir($can_doc_path)){
                mkdir($can_doc_path, 0777, true);
            }*/
            //set the valid file extensions 
            $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "GIF", "JPG", "PNG", "doc", "txt", "docx", "pdf", "xls", "xlsx"); //add the formats you want to upload
         
            $name = $_FILES['myfile']['name']; //get the name of the file            
            $size = $_FILES['myfile']['size']; //get the size of the file         
            if (strlen($name))
            { 
                //check if the file is selected or cancelled after pressing the browse button.
                list($txt, $ext) = explode(".", $name); //extract the name and extension of the file
                if (in_array($ext, $valid_formats))
                { 
                    //if the file is valid go on.
                    if ($size < 2098888)
                    {
                        // check if the file size is more than 2 mb
                        $file_name = $_POST['filename']; //get the file name
                        $tmp = $_FILES['myfile']['tmp_name'];
                        if (move_uploaded_file($tmp, $upload_path . time().$file_name.'.'.$ext))
                        { 
                            //check if it the file move successfully, then insert into database
                            $data  = array('can_id' => $can_id, 'doc_name' => $file_name,'file_name'=>time().$file_name.'.'.$ext,'doc_path' => $upload_path,'thumb_path'=>$upload_path);
                            $data=set_log_fields($data,'insert');
                            $this->common_model->insert('documents',$data);  
                            user_activity_log($data = array('can_id' => get_login_user_id(), 'table_name' => 'documents' ,"operation_name" => 'update' ,'controller'=> $this->router->fetch_class(),'method'=> 'update','last_modified_on'=> date('Y-m-d h:i:s'), 'last_modified_by' => get_login_user_id(),'comment' => 'Document Uploaded'));

                            $result = $this->candidate_model->get_all_documents($can_id);
                            // print_r($result);exit;
                           // echo  json_encode(array("result"=>$result,"msg"=>"File uploaded successfully!"));                         
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
                    echo "4";
                }
            }
            else
            {
                echo "Please select a file..!";
            }
            exit;
        }        
    }

    /* ======  Employee Experience Details ====== */


    function experience()
    {
        //user_access_operation($this->router->fetch_class(),$this->router->fetch_method());

       /* $can_id = $this->uri->segment(3);
        $this->content->can_details = $this->get_candidate_name_by_id($can_id);
        $this->content->job_profiles  = $this->common_model->get_form_dropdown($tablename='job_profiles', $fields = array('id','title'),$conditions = array('is_deleted' => 0));
        $this->content->experiences = $this->candidate_model->get_all_experience($can_id); */  
        $this->content->percentage = $this->check_per_profile_complete();  
        $this->load_view("experience","HRMS - Employee Experience Summary",$this->content);
    }


    function experience_details($can_id = '')
    {
        $this->datatables->unset_column('exp_id');
        $this->datatables->select('exp_id,company_name,working_from,working_to,title,can_id');
        $this->datatables->join('job_profiles', 'experience.designation = job_profiles.id', 'left');
        $this->datatables->from('experience');
        $this->datatables->where('can_id',$can_id);
        $this->datatables->where('experience.is_deleted',0);
        // $this->db->order_by("exp_id", "desc");        

        $update_url = site_url().'/candidate/edit_exp_details/$1/$2';
        $this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn-success btn btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_data($1)"class="tabledit-delete-button btn btn-danger btn-sm btn_delete"><span class="glyphicon glyphicon-trash"></span></a>', 'exp_id,can_id');
        $result= $this->datatables->generate();  
        echo $result;
    }

    function add_experience()
    {
        $this->content->percentage = $this->check_per_profile_complete();  
        //$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        if(!empty($access))
        {
            redirect('access_denied');
        }
        else
        {
            $can_id = $this->uri->segment(3);
            $this->content->can_details = $this->get_candidate_name_by_id($can_id);
            $this->content->job_profiles  = $this->common_model->get_form_dropdown($tablename='job_profiles', $fields = array('id','title'),$conditions = array('is_deleted' => 0));
            $this->load_view("add_experience","HRMS -Add Employee Experience Details",$this->content);
        }
    }

    function save_experience()
    {
        // user_access_operation($this->router->fetch_class(),$this->router->fetch_method());

        if ($this->input->is_ajax_request())
        {
            $post = $this->input->post();
            $to_date = explode('/', $post['working_to']);
            $month = $to_date[0];
            $year = $to_date[1];            
            $days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
            $working_to = $days."/".$post['working_to'];
            $working_from = "01/".$post['working_from'];
            $experience_details  = array('can_id' => $post['can_id'],
                            'exp_id' => !empty($post['exp_id']) ? $post['exp_id'] : 0,
                            'company_name' => $post['company_name'],
                            'working_from' => date('Y-m-d', strtotime(str_replace('/', '-', $working_from))),
                            'working_to' => date('Y-m-d', strtotime(str_replace('/', '-', $working_to))),
                            'designation' => $post['designation'],
                            'ctc' => $post['ctc'],
                            'responsibilities' => $post['roles'],
                            'leaving_reason' => $post['leaving_reason']
                         );
            if($experience_details['exp_id'] > 0)
            {
                $experience_details=set_log_fields($experience_details);
                $this->common_model->update('experience',$experience_details,array("exp_id"=>$experience_details['exp_id']));
                echo  "Experience details updated successfully!";            
            }
            else
            {
                $experience_details=set_log_fields($experience_details,'insert'); 
                $this->common_model->insert('experience',$experience_details);
                echo  "Experience details saved successfully!";            
               
            }
            // if($this->candidate_model->add_experience($experience_details)){
            // }                           
            // $result = $this->candidate_model->get_all_experience($post['can_id']);
            //$exp_details = $this->candidate_model->edit_exp_details($exp_id);
          //  print_r($exp_details);exit;
        }
    }

    function edit_exp_details()
    {
        $this->content->percentage = $this->check_per_profile_complete();  
        //$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        if(!empty($access))
        {
            redirect('access_denied');
        }
        else
        {
            $exp_id = $this->uri->segment(3);
            $can_id = $this->uri->segment(4);
            check_record_exist($tablename='experience', $conditions = array('can_id' =>$can_id,'exp_id' => $exp_id),true);
                $this->content->can_details = $this->get_candidate_name_by_id($can_id);
                $this->content->job_profiles  = $this->common_model->get_form_dropdown($tablename='job_profiles', $fields = array('id','title'),$conditions = array('is_deleted' => 0));
                $this->content->exp_details = $this->candidate_model->edit_exp_details($exp_id);  
                // x_debug($this->content->exp_details);
                $this->load_view("edit_exp_details","HRMS - Edit Experience Details",$this->content);
       }
    }


    /* ======  Employee Billing Details ====== */


    function billing()
    {
        //user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        $this->content->percentage = $this->check_per_profile_complete();  
        $can_id = $this->uri->segment(3);
        $this->content->can_details = $this->get_candidate_name_by_id($can_id);
        $this->content->billing_details = $this->candidate_model->get_billing_details($can_id);     
        $this->load_view("billing","HRMS - Employee Billing Details",$this->content);
    }

    function billing_details($can_id="")
    {
        $this->datatables->unset_column('bill_id');
        $this->datatables->unset_column('effective_from');
        $this->datatables->unset_column('effective_to');
        $this->datatables->select('bill_id,rate_type,amount,effective_from,effective_to,can_id');
        $this->datatables->from('billing');
        $this->datatables->where('can_id',$can_id);
        $this->datatables->where('is_deleted',0);
        // $this->db->order_by("bill_id", "desc");
        $update_url = site_url().'/candidate/edit_billing_details/$1/$2';          

        $this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn_edit_bill btn-success"><span class="glyphicon glyphicon-pencil"></span></a> <a class="tabledit-delete-button btn-danger btn btn-sm btn_delete_bill" value="$1" style="float: none;" onClick="delete_data($1)"><span class="glyphicon glyphicon-trash"></span></a>', 'bill_id,can_id');
        $result= $this->datatables->generate();
        echo $result;
    }


    function add_billing()
    {
        $this->content->percentage = $this->check_per_profile_complete();  
        $access = user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        if(!empty($access))
        {
            redirect('access_denied');
        }
        else
        {
            $can_id = $this->uri->segment(3);
            $this->content->can_details = $this->get_candidate_name_by_id($can_id); 
            $this->load_view("add_billing","HRMS - Add Billing Details",$this->content);    
        }
    }

    function add_billing_details()
    {
        $this->content->percentage = $this->check_per_profile_complete();
        if ($this->input->is_ajax_request())
        { 
            $post = $this->input->post();
             $billing_details = array('bill_id' => (isset($post['bill_id']) && !empty($post['bill_id'])) ? $post['bill_id'] : '','can_id' => $post['can_id'],'rate_type' => $post['rate_type'], 'amount' => $post['amount'],'effective_from' => date('Y-m-d', strtotime(str_replace('/', '-', $post['from_date']))),'effective_to' => date('Y-m-d', strtotime(str_replace('/', '-', $post['to_date']))),'review_date' => date('Y-m-d', strtotime(str_replace('/', '-', $post['review_date']))));
               
                if($post['bill_id']>0)
                {
                    $billing_details=set_log_fields($billing_details);
                    $this->common_model->update('billing',$billing_details,array('bill_id'=>$post['bill_id']));
                    
                }
                else
                {
                    $billing_details=set_log_fields($billing_details,'insert');
                    $this->common_model->insert('billing',$billing_details);

                }               
            }        
    }

    function edit_billing_details()
    {
        $this->content->percentage = $this->check_per_profile_complete();  
        //$access = user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
        if(!empty($access))
        {
            redirect('access_denied');
        }
        else
        {
            $bill_id = $this->uri->segment(3);
            $can_id = $this->uri->segment(4);
            $is_exist = check_record_exist($tablename='billing', $conditions = array('can_id' =>$can_id,'bill_id' => $bill_id),true);
            if($is_exist==1)
            {
                redirect('Record_not_found');
            }
            else
            {            
                $this->content->can_details = $this->get_candidate_name_by_id($can_id); 
                $this->content->billing_details = $this->candidate_model->edit_billing_details($bill_id);
                $this->load_view("edit_billing","HRMS - Edit Employee Billing Details",$this->content);
            }
        }
    }


    /* ======  Employee Investment Details ====== */


    function investment()
    {
      //  user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        $userdata = $this->session->userdata('logged_in_user');
        $can_id = $this->uri->segment(3);
        if(($can_id == get_login_user_id()) || (in_array($userdata['role_id'],$this->config->item('hr_user_role_id'))||in_array($userdata['role_id'],$this->config->item('super_user_role_id'))||in_array($userdata['role_id'],$this->config->item('admin_user_role_id'))))
        {
            $this->content->percentage = $this->check_per_profile_complete();  
            $this->content->can_details = $this->get_candidate_name_by_id($can_id);
            $this->content->investment_details = $this->candidate_model->get_investment_details($can_id);     
            $this->load_view("invetments","HRMS - Employee Investment Details",$this->content);
        }
        else
        {
            $this->session->set_flashdata('warning', 'Access Denied');
            redirect('candidate');
        }
    }

    function investment_details($can_id = '')
    {
        $this->datatables->unset_column('inv_id');
        $this->datatables->select('inv_id,amount,description,section,can_id');
        $this->datatables->from('investment');
        $this->datatables->where('can_id',$can_id);
        $this->datatables->where('is_deleted',0);
        // $this->db->order_by("inv_id", "desc"); 
        $update_url = site_url().'/candidate/edit_investment_details/$1/$2';  
         $this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn_edit_bill btn-success"><span class="glyphicon glyphicon-pencil"></span></a> <a type="button" class="tabledit-delete-button btn-danger btn btn-sm btn_delete_bill" value="$1" style="float: none;" onClick="delete_data($1)"><span class="glyphicon glyphicon-trash"></span></a>', 'inv_id,can_id');
        $result= $this->datatables->generate();  
        echo $result;
    }

    function add_investment()
    {
        $this->content->percentage = $this->check_per_profile_complete();  
        //$access = user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        if(!empty($access))
        {
            redirect('access_denied');
        }
        else
        {
            $can_id = $this->uri->segment(3);
            $this->content->can_details = $this->get_candidate_name_by_id($can_id); 
            $this->content->policies = $this->common_model->get_data_array('investment_policies',array('parent_section'=>null,'is_deleted'=>0));
            $this->load_view("add_investment","HRMS - Add Investment Details",$this->content);    
        }   
    }

    function add_investment_details()
    {
        // user_access_operation($this->router->fetch_class(),$this->router->fetch_method());

        if ($this->input->is_ajax_request())
        {
            $post = $this->input->post();
            $investment_details  = array('can_id' => $post['can_id'],'inv_id' => !empty($post['inv_id']) ? $post['inv_id'] : 0, 'description' => $post['description'],'amount' => $post['amount'], 'section' => $post['policy_id'], 'policy_id' => $post['section']);

            // x_debug($investment_details);
            if($investment_details['inv_id'] > 0)
            {
                $investment_details=set_log_fields($investment_details);
                $this->common_model->update("investment",$investment_details,array("inv_id"=>$investment_details['inv_id']));
                echo "Investment details updated successfully!";
            }
            else
            {
                $investment_details=set_log_fields($investment_details,'insert');
                $this->common_model->insert("investment",$investment_details);   
                echo "Investment details added successfully!";
            }
                    
            $result = $this->candidate_model->get_investment_details($post['can_id']);
            //echo "Investment details added successfully!";
            // echo  json_encode(array("result"=>$result,"msg"=>"Investment details added successfully!"));
        }
    }

    function edit_investment_details()
    {
        $this->content->percentage = $this->check_per_profile_complete();  
        //$access = user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        if(!empty($access))
        {
            redirect('access_denied');
        }
        else
        {
            $inv_id = $this->uri->segment(3);
            $can_id = $this->uri->segment(4);
            check_record_exist($tablename='investment', $conditions = array('can_id' =>$can_id,'inv_id' => $inv_id),true);
                $this->content->can_details = $this->get_candidate_name_by_id($can_id); 
                $this->content->inv_details = $this->candidate_model->get_investment_details($inv_id);
                $this->content->policies = $this->common_model->get_data_array('investment_policies',array('parent_section'=>null,'is_deleted'=>0));
                // x_debug($this->content->inv_details);
                $this->load_view("edit_investment","HRMS - Edit Employee Investment Details",$this->content);
        }
    }  

    /* ======  Employee Verification Reference Details ====== */


    function reference()
    {
        $this->content->percentage = $this->check_per_profile_complete();  
       // user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        $can_id = $this->uri->segment(3);

        $this->load_view("reference","HRMS - Employee Professional Reference Details",$this->content);
   
       /* user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        $can_id = $this->uri->segment(3);
        $this->content->can_details = $this->get_candidate_name_by_id($can_id);
        $this->content->job_profiles  = $this->common_model->get_form_dropdown($tablename='job_profiles', $fields = array('id','title'),$conditions = array('is_deleted' => 0));        
        $this->load_view("reference","HRMS - Employee Verification Reference Details",$this->content);*/
    }

    function reference_details($can_id = '',$type)
    {
        $this->datatables->unset_column('ref_id');
        $this->datatables->select('ref_id,ref_name,ref_email,ref_mobile,ref_designation,ref_company,ref_experience,can_id,ref_type');
        $this->datatables->from('referance');
        $this->datatables->where('can_id',$can_id);
        $this->datatables->where('ref_type',$type);
        $this->datatables->where('is_deleted',0);
        // $this->db->order_by("ref_id", "desc");  
        // if($type==0)
        $update_url = site_url().'/candidate/edit_reference_details/$1/$2/$3';
        $this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn-success btn btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_data($2)"class="tabledit-delete-button btn btn-danger btn-sm btn_delete"><span class="glyphicon glyphicon-trash"></span></a>', 'ref_type,ref_id,can_id');
        $result= $this->datatables->generate();  
        echo $result;
    }

    function add_reference_details()
    {
        $this->content->percentage = $this->check_per_profile_complete();  
        $can_id = $this->uri->segment(3);
        $this->content->can_details = $this->get_candidate_name_by_id($can_id);
        $this->content->job_profiles  = $this->common_model->get_form_dropdown($tablename='job_profiles', $fields = array('id','title'),$conditions = array('is_deleted' => 0));   
        //user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        if ($this->input->is_ajax_request())
        {
            $post = $this->input->post();
            $reference_details  = array('can_id' => $post['can_id'],
                            'ref_id' =>   !empty($post['ref_id']) ? $post['ref_id']: 0,
                            'ref_type' => $post['ref_type'],
                            'ref_name' => $post['ref_name'],
                            'ref_email' => $post['ref_email'],
                            'ref_contact' => $post['ref_contact'],                           
                            'ref_mobile' => $post['ref_mobile'],                           
                            'ref_company' => $post['ref_company'],                           
                            'ref_designation' => $post['ref_designation'],                           
                            'ref_experience' => $post['ref_experience']                     
                    );
            if($reference_details['ref_id'] > 0)
            {
                $reference_details=set_log_fields($reference_details);
                $this->common_model->update('referance',$reference_details,array('ref_id'=>$reference_details['ref_id']));
                echo  "Reference details updated successfully!";
            }
            else
            {
                $reference_details=set_log_fields($reference_details,'insert');
                $this->common_model->insert('referance',$reference_details);   
                echo  "Reference details added successfully!";
            }  
        }
        else
        {
            $this->load_view("add_references","HRMS - Employee Reference Details",$this->content);
        }
    }

    function edit_reference_details()
    {   
        $this->content->percentage = $this->check_per_profile_complete();  
        //$access = user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
        $access=0;
	if(!empty($access))
        {
            redirect('access_denied');
        }
        else
        {
            $ref_type = $this->uri->segment(3);
            $ref_id = $this->uri->segment(4);
            $can_id = $this->uri->segment(5);
            $this->content->ref_id=$ref_type;
            check_record_exist($tablename='referance', $conditions = array('can_id' =>$can_id,'ref_id' => $ref_id),true);
                $this->content->can_details = $this->get_candidate_name_by_id($can_id); 
                $this->content->ref_details = $this->candidate_model->edit_ref_details($ref_id,$ref_type);
                // x_debug($this->content->ref_details);
                $this->load_view("edit_ref_details","HRMS - Edit Employee Reference Details",$this->content);
        
        }

       /* user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
 
        if ($this->input->is_ajax_request())
        {
            $ref_id = $this->input->post('ref_id');
            $ref_type = $this->input->post('ref_type');
            $ref_details = $this->candidate_model->edit_ref_details($ref_id,$ref_type);
            echo json_encode(array("result" => $ref_details));
        } */ 
    }

    /* ======  Employee Interview Reference Details ====== */


    function interview_reference()
    {
        $this->content->percentage = $this->check_per_profile_complete();
        $userdata = $this->session->userdata('logged_in_user');
        $can_id = $this->uri->segment(3);
        if(($can_id == get_login_user_id()) || (in_array($userdata['role_id'],$this->config->item('hr_user_role_id'))||in_array($userdata['role_id'],$this->config->item('super_user_role_id'))||in_array($userdata['role_id'],$this->config->item('admin_user_role_id'))))
        {
            $this->load_view("interview_reference","HRMS - Employee Friends Reference Details",$this->content);
        }
        else
        {
            $this->session->set_flashdata('warning', 'Access Denied');
            redirect('candidate');  
        }
       /* user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        $can_id = $this->uri->segment(3);
        $this->content->can_details = $this->get_candidate_name_by_id($can_id);
        $this->content->reference_details = $this->candidate_model->get_reference_details($can_id,$ref_type=1);     
        $this->load_view("interview_reference","HRMS - Employee Freiends Reference Details",$this->content);*/
    }

  


   function add_interview_reference_details()
    {
        $this->content->percentage = $this->check_per_profile_complete();
        if ($this->input->is_ajax_request())
        {
            $post = $this->input->post();
            $reference_details['can_id'] = $post['can_id'];
            if(!empty($post['ref_id']))
                $reference_details['ref_id'] = $post['ref_id'];
                $reference_details['ref_name'] = $post['ref_name'];
                $reference_details['ref_email'] = $post['ref_email'];
                $reference_details['ref_contact'] = $post['ref_contact'];
                $reference_details['ref_mobile'] = $post['ref_mobile'];
                $reference_details['ref_company'] = $post['ref_company'];
                $reference_details['ref_designation'] = $post['ref_designation'];
                $reference_details['ref_experience'] = $post['ref_experience'];
            //x_debug($reference_details);
            if($reference_details['ref_id'] > 0)
            {
                $reference_details=set_log_fields($reference_details);
                $this->common_model->update('referance',$reference_details,array('ref_id'=>$reference_details['ref_id']));
                echo  "Reference details updated successfully!";
            }
            else
            {
                $reference_details=set_log_fields($reference_details,'insert');
                $this->common_model->insert('referance',$reference_details);   
                echo  "Reference details added successfully!";
            }  
            $this->candidate_model->add_reference_details($reference_details);                            
            $result = $this->candidate_model->get_reference_details($post['can_id']);
            echo  json_encode(array("result"=>$result,"msg"=>"Investment details added successfully!"));
        }
    }


  /*  function edit_exp_details()
    {
        user_access_operation($this->router->fetch_class(),$this->router->fetch_method());

        if ($this->input->is_ajax_request())
        {
            $exp_id = $this->input->post('exp_id');
            $exp_details = $this->candidate_model->edit_exp_details($exp_id);
            echo json_encode(array("result" => $exp_details));
        } 
    }
*/

    function delete_doc()
    {
        if ($this->input->is_ajax_request())
        {
            //$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
	    $access=0;
            if(!empty($access))
            {
                echo "0";
            }
            else
            {
                $doc_id = $this->input->post('doc_id');
                $this->candidate_model->delete($tablename='documents',$fieldname ='doc_id',$doc_id);
                echo "1";
            }
        }
    }   

    function delete_billing()
    {
        if ($this->input->is_ajax_request())
        {
            //$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
	    $access=0;
            if(!empty($access))
            {
                echo "0";
            }
            else
            {
                $bill_id = $this->input->post('bill_id');
                $this->candidate_model->delete($tablename='billing',$fieldname ='bill_id',$bill_id);
                echo "1";   
            } 
        }
    }

    function delete_exp()
    {
        if ($this->input->is_ajax_request())
        {
            //$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
	    $access=0;
            if(!empty($access))
            {
               echo "0";
            }
            else
            {
                $exp_id = $this->input->post('exp_id');
                $this->candidate_model->delete($tablename='experience',$fieldname ='exp_id',$exp_id); 
                echo "1";  
            }          
        }        
    }

    function delete_investment()
    {
        if ($this->input->is_ajax_request())
        {
            //$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
	    $access=0;
            if(!empty($access))
            {
                echo "0";
            }
            else
            {
                $inv_id = $this->input->post('inv_id');
                $this->candidate_model->delete($tablename='investment',$fieldname ='inv_id',$inv_id);
                echo "1";
            }
        }
    }

    function delete_ref()
    {
        if($this->input->is_ajax_request())
        {
            //$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
	    $access=0;
            if(!empty($access))
            {
                $this->session->set_flashdata('access_denied', 'Access Denied');
                echo "0";
            }
            else
            {
                $ref_id = $this->input->post('ref_id');
                $this->candidate_model->delete($tablename='referance',$fieldname ='ref_id',$ref_id);
                echo "1";
            }
        }

    }

    function allocate_leaves($id, $doj)
    {
        $leave = 0.0;
        $month = date("m", strtotime($doj));
        $date = date("d", strtotime($doj));

        if($date >= 1 && $date <= 7)
            $leave = 2.0;
        
        if($date >=8 && $date <= 15)
            $leave = 1.5;
       
        if($date >=16 && $date <= 21)
            $leave = 1;
        
        if($date >=22 && $date <= 31)
            $leave = 0.5;
        
        $m_leave = 24.0 -(2 * $month);

        $total = $leave + $m_leave;
        $this->load->model('leave_model','leave');

        $this->leave->can_allocate_leaves($id,$total);
    }

    function leave_allocation($id, $doj,$probation_period,$probation_end_date)
    {
        $system_leaves = $this->common_model->get_data('configuration_settings',array(),'SL,CL,PL');
        // x_debug($system_leaves);
        $this->load->model('leave_model');
        $this->leave_model->can_allocate_leaves($id,$system_leaves);
    }


    function get_candidates()
    {
        $this->load->view('select2');
    }
    function get_can_list()
    {
        $match = $_GET['term'];
        $query = $this->db->select('can_id as id,can_name as text')->like('can_name',$match,'both')->limit(10)->get("candidate");
        $json = $query->result();
        echo json_encode($json);
    }


    //function to view indiviual candidate details
    public function view()
    {
        //user_access_operation($this->router->fetch_class(),$this->router->fetch_method());  
        $userdata = $this->session->userdata('logged_in_user');
        $can_id = (int)$this->uri->segment(3); 
        // $this->content->candidate_details = $this->common_model->get_data('candidate', array('can_id' => $can_id ,'is_deleted' => 0));
        $this->content->candidate_details = $this->candidate_model->get_can_details($can_id,true);
        //x_debug($this->content->candidate_details);
	$this->content->candidate_leaves = $this->common_model->get_data_array('leave_application', array('can_id'=>$can_id, 'is_deleted'=>0));
        $this->content->candidate_tasks = $this->db->select('t.*,m.*')->from('tasks t')->join('task_manager m', 't.task_id = m.task_id', 'inner')->where('m.can_id', $can_id)->get()->result_array();
        $this->content->candidate_events = $this->common_model->get_data_array('event', array('can_id'=>$can_id, 'is_deleted'=>0, 'from_tbl'=>NULL, 'from_id'=>NULL, 'task_id'=>NULL));
        $this->content->candidate_travels = $this->common_model->get_data_array('travel', array('can_id'=>$can_id, 'is_deleted'=>0));
        $this->load_view("candidate_details","HRMS - News",$this->content);
    }
    public function test()
    {
	echo date('Y-m-d H:i:s');
	echo "<br>-----<br>";
	echo get_time_difference('2017-12-18 12:02:01');
    }

    function check_per_profile_complete()
    {
        if($this->input->is_ajax_request())
        {
            $can_id = $this->input->post('can_id');
        }
        else
        {
            $can_id = end($this->uri->segment_array());
        }
        
        $can_type=$this->session->can_type;
        //$percentage = 5;
        $per_new = array();
        $per_new['default'] = 5;
        array_push($per_new, $per_new['profile']);
        $data['can']= $this->common_model->count_all('candidate',array('can_id' =>$can_id,'is_deleted'=>0));
        if(!empty($data['can']))
        {
            $record = $this->candidate_model->get_can_details($can_id,true);
            //var_dump($record);exit();
            if(!empty($record->can_name) && !empty($record->cur_address) && !empty($record->email) && !empty($record->dob) && !empty($record->phone1) && !empty($record->job_profile) && !empty($record->department) && !empty($record->aadhar_no) && !empty($record->pan_no) && !empty($record->joining_date) && !empty($record->reporting_to))
            //$percentage = $percentage + 15;
            $per_new['profile_per'] = $per_new['default'] + 15;
            array_push($per_new, $per_new['profile_per']);
        }

        $data['bank_details']= $this->common_model->count_all('bank_details',array('can_id' =>$can_id,'is_deleted'=>0));
        if(!empty($data['bank_details']))
        {
            if($can_type=='user')
            {  
                //$percentage = $percentage + 20;
                $per_new['bank_per'] = 20;
                array_push($per_new, $per_new['bank_per']);
            }
            else
            {
                //$percentage = $percentage + 15;
                $per_new['bank_per'] = 15;
                array_push($per_new, $per_new['bank_per']);
            }
        }
        // x_debug($per_new);

        $data['documents']= $this->common_model->count_all('documents',array('can_id' =>$can_id,'is_deleted'=>0));
        if(!empty($data['documents']))
        {
            if($can_type=='user')
            {  
                //$percentage = $percentage + 20;
                $per_new['doc_per'] = 20;
                array_push($per_new, $per_new['doc_per']);
            }
            else
            {
                //$percentage = $percentage + 10;
                $per_new['doc_per'] = 10;
                array_push($per_new, $per_new['doc_per']);
            }
        }

        $data['billing']= $this->common_model->count_all('billing',array('can_id' =>$can_id,'is_deleted'=>0));
        if(!empty($data['billing']))
        {
            //$percentage = $percentage + 15;
            $per_new['bill_per'] = 15;
            array_push($per_new, $per_new['bill_per']);
        }

        $data['experience']= $this->common_model->count_all('experience',array('can_id' =>$can_id,'is_deleted'=>0));
        if(!empty($data['experience']))
        {
            //$percentage = $percentage + 10;
            $per_new['exp_per'] = 10;
            array_push($per_new, $per_new['exp_per']);
        }

        $data['referance']= $this->common_model->count_all('referance',array('can_id' =>$can_id,'is_deleted'=>0));
        if(!empty($data['referance']))
        {
            if($can_type=='user')
            {  
                //$percentage = $percentage + 20;
                $per_new['ref_per'] = 20;
                array_push($per_new, $per_new['ref_per']);
            }
            else
            {
                //$percentage = $percentage + 10;
                $per_new['ref_per'] = 10;
                array_push($per_new, $per_new['ref_per']);
            }
        }

        $data['insurance_details']= $this->common_model->count_all('insurance_details',array('can_id' =>$can_id,'is_deleted'=>0));
        if(!empty($data['insurance_details']))
        {
                //$percentage = $percentage + 10;
                $per_new['ins_per'] = 10;
                array_push($per_new, $per_new['ins_per']);
        }
        
        $data['investment']= $this->common_model->count_all('investment',array('can_id' =>$can_id,'is_deleted'=>0));
        if(!empty($data['investment']))
        {
            if($can_type=='user')
            {  
                //$percentage = $percentage + 20;
                $per_new['inv_per'] = 20;
                array_push($per_new, $per_new['inv_per']);
            }
            else
            {
                //$percentage = $percentage + 10;
                $per_new['inv_per'] = 10;
                array_push($per_new, $per_new['inv_per']);
            }
        }
        // x_debug($per_new);

        if($this->input->is_ajax_request())
        {
            //$res = array();

            // $res[] = array('label'=>'Pending','value'=>100-$percentage);
            // $res[] = array('label'=>'Completed','value'=>$percentage);
            
            echo json_encode($percentage,$per_new);
        }
        else
        {
            $new['per_new']=$per_new;
            //$per_new[]=$per_new;
            //x_debug($per_new);
            return $new;
        }
        //x_debug($data);
    }
    function upload_profile_image()
    {
            $this->load->helper('string');
            $name =random_string('alnum',10);
            $can_data=$this->common_model->get_data('candidate',array('can_id'=>get_login_user_id(),'profile_picture'));
            //print_r($data);
            $file_path=UPLOADPATH.'profile_images/';
            
            if(!empty($can_data['profile_picture']))
            {
                unlink($file_path.$can_data['profile_picture']);
            }
            $data = $_POST['image'];
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $imageName = $image.$name.time().'.png';
            $file=$imageName;
            file_put_contents($file_path.$file, $data);
            $data=array('profile_picture'=>$file);
            set_log_fields($data);
            
            $this->common_model->update('candidate',$data,array('can_id'=>get_login_user_id()));
            $this->session->set_userdata('profile_pic',$file);
            $this->session->set_userdata('can_profile_pic',$file);

            echo 'done';
    }

    function birthday_wishes()
    {
        $userdata = $this->session->userdata('logged_in_user');
        $this->load->library('email_send');
        $mailer_config=$this->common_model->get_data('email_config',array('email_template'=>'birthday_wishes'));
        $mailer_config['email_from'] = $userdata['email'];
        $birthday_wishes['message'] = $this->input->post('message',true);
        $birthday_wishes['name'] = $this->input->post('name',true);
        $birthday_wishes['can_id'] = $this->input->post('can_id',true);
        $birthday_wishes['from_name'] =  $userdata['name'];

        $birthday_wishes['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');


        $email_id =$this->input->post('email',true);
        $message = $this->load->view("email_templates/".$mailer_config["email_template"],$birthday_wishes, TRUE);
        $birthday_details = array('can_id' => $userdata['id'],'wish_to' => $birthday_wishes['can_id'] ,'message' =>$birthday_wishes['message'] ,'on_date'=>date('Y-m-d m:h:s'));
        $mobile = $this->common_model->get_data('candidate',array('can_id'=>$birthday_wishes['can_id']),'phone1');
        $this->common_model->insert('birthday_wishes',$birthday_details);
        $smsm = send_sms($mobile['phone1'], 'Wishing you a very happy birthday from Raoson.');
        if($this->email_send->send_mail_new($mailer_config, $email_id,$message))
        {
            $res['can_id'] = $birthday_wishes['can_id'];
            $res['res'] = TRUE;
            echo json_encode($res);
        }
        else
        {
            $res['can_id'] = $birthday_wishes['can_id'];
            $res['res'] = FALSE;
            echo json_encode($res);
        }
    }



    /* ==========  like button on dashboard ========= */

    function like()
    {
        $userdata = $this->session->userdata('logged_in_user'); 
        $can_id =  $this->input->post('can_id',true);      
        $like_data = array('can_id'=>$can_id,'like_from'=>$userdata['id'],'on_date'=>date('Y-m-d m:h:s'));
        // $like_data=set_log_fields($like_data,'insert');
        $this->common_model->insert('birthday_likes',$like_data);
        $total_likes = $this->common_model->count_all('birthday_likes',array('can_id' =>$can_id,'YEAR(on_date)'=>date('Y')));
        echo $total_likes;
    }
     /* ======  Employee Insurance Details ====== */


    function insurance_details()
    {
        //user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        $this->content->percentage = $this->check_per_profile_complete();  
        $can_id = $this->uri->segment(3);
        //check_record_exist($tablename='insurance_details', $conditions = array('can_id' =>$can_id));
        $this->content->can_details = $this->get_candidate_name_by_id($can_id);
        $this->content->can_insurance_details = $this->candidate_model->get_employee_insurance_details($can_id);
        $this->content->company_details = $this->common_model->get_data_array('insurance_company', array('is_deleted'=>0));
        $this->load_view("insurance_details","HRMS - Employee Insurance Details",$this->content);
    }


    function upload_insurance_details()
    {
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
        {
            // print_r($_POST);exit();
            $can_id = $this->input->post('can_id', true);
            $joining_date = $this->common_model->get_data('candidate', array('can_id'=>$can_id), $fields='joining_date');
            $insurance_id = $this->input->post('insurance_id');
            $ins_start_date = date_to_db($this->input->post('ins_start_date'));
            $ins_expire_date = date_to_db($this->input->post('ins_expire_date'));
            $paid_by = $this->input->post('paid_by', true);
            $premium_amnt = $this->input->post('premium_amnt', true);
            $assured_amt = $this->input->post('assured_amt', true);
            $ins_comp_name = $this->input->post('ins_comp_name', true);
            $policy_no = $this->input->post('policy_no', true);
            $policy_no = trim($policy_no);
            $old_ins_doc = $this->input->post('old_ins_doc', true);
            $upload_path = UPLOADPATH; //set your folder path
            if($ins_start_date >= $joining_date['joining_date'])
            {
                if(!is_dir($upload_path))
                {
                   mkdir($upload_path , 777);
                }

                $can_doc_path = $upload_path."insurance_doc/";
                if( ! is_dir($can_doc_path)){
                    mkdir($can_doc_path, 0766, true);
                }
                //set the valid file extensions 
                $valid_formats = array( "doc", "txt", "docx", "pdf"); //add the formats you want to upload
             
                if (!empty($_FILES))
                {
                    $name = $_FILES['myfile']['name']; //get the name of the file
                    $size = $_FILES['myfile']['size']; //get the size of the file
                    //check if the file is selected or cancelled after pressing the browse button.
                    list($txt, $ext) = explode(".", $name); //extract the name and extension of the file
                    if (in_array($ext, $valid_formats))
                    { 
                        //if the file is valid go on.
                        if ($size < 2098888)
                        {
                            // check if the file size is more than 2 mb
                            // $file_name = $_POST['filename']; //get the file name
                            $tmp = $_FILES['myfile']['tmp_name'];
                            if (move_uploaded_file($tmp, $can_doc_path . time().'ins_doc'.'.'.$ext))
                            { 
                                //check if it the file move successfully, then insert into database
                                $data  = array('can_id' => $can_id,'ins_start_date' => $ins_start_date,'ins_expire_date' => $ins_expire_date,'premium_amnt' => $premium_amnt,'assured_amt'=>$assured_amt,'ins_comp_name'=>$ins_comp_name,'policy_no'=>$policy_no,'ins_doc_path' => $can_doc_path,'ins_doc_name'=>time().'ins_doc'.'.'.$ext);
                                if($insurance_id>0)
                                {
                                    $data=set_log_fields($data);
                                    $this->common_model->update('insurance_details',$data,array('insurance_id'=>$insurance_id));
                                }
                                else
                                {
                                    $data=set_log_fields($data,'insert');
                                    $this->common_model->insert('insurance_details',$data);
                                    if($can_id==get_login_user_id())
                                    {
                                        user_activity_log($data = array('can_id' => get_login_user_id(),'table_name' => 'insurance_details' ,"operation_name" => 'update' ,'controller'=> $this->router->fetch_class(),'method'=> 'update','last_modified_on'=> date('Y-m-d h:i:s'),'last_modified_by' => get_login_user_id(),'comment' => 'Insurance Details Uploaded'));
                                    }
                                }
                                // print_r($data);exit;
                                // $this->candidate_model->save_bank_details($data);
                                
                               //echo  json_encode(array("msg"=>"Bank details updated successfully!"));                         
                                // redirect('candidate/bank_details/'.$can_id);
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
                        echo "4";
                    }
                }
                else if($old_ins_doc != NULL)
                {
                    $data  = array('can_id' => $can_id,'insurance_id' => $insurance_id, 'ins_start_date' => $ins_start_date,'ins_expire_date' => $ins_expire_date,'premium_amnt' => $premium_amnt,'assured_amt'=>$assured_amt,'ins_comp_name'=>$ins_comp_name,'policy_no'=>$policy_no);
                    $data = set_log_fields($data);
                    $res = $this->common_model->update('insurance_details',$data,array('insurance_id'=>$insurance_id));
                    if($res == true)
                    {
                        if($can_id==get_login_user_id())
                        {
                            user_activity_log($data = array('can_id' => get_login_user_id(), 'table_name' => 'insurance_details' ,"operation_name" => 'update' ,'controller'=> $this->router->fetch_class(),'method'=> 'update','last_modified_on'=> date('Y-m-d h:i:s'),'last_modified_by' => get_login_user_id(),'comment' => 'Insurance Details Updated'));
                        }
                        echo "1";
                    }
                    else
                    {
                        echo "5";
                    }
                }
                else
                {
                    echo "Please select a file..!";
                }
            }
            else
            {
                echo "6";
            }
            exit;
        }  
    }


    /* ======  Employee Profile Summary ====== */


    function profile_summary()
    {
        $userdata = $this->session->userdata('logged_in_user');
        $can_id = $this->uri->segment(3);
        if(($can_id == get_login_user_id()) || (in_array($userdata['role_id'],$this->config->item('hr_user_role_id'))||in_array($userdata['role_id'],$this->config->item('super_user_role_id'))||in_array($userdata['role_id'],$this->config->item('admin_user_role_id'))))
        {
            $this->content->percentage = $this->check_per_profile_complete();  
            $this->content->can_details = $this->get_candidate_name_by_id($can_id);

            $this->content->can_details->profile = $this->common_model->get_fields_by_id($tablename='candidate',$fields = array('can_name','phone1','email','pan_no','aadhar_no') , $conditions = array('can_id' => get_login_user_id()));
            $this->content->can_details->salary = $this->common_model->get_fields_by_id($tablename='emp_salary_details',$fields = array('pf_no','esic_no') , $conditions = array('can_id' => get_login_user_id(),'is_deleted' => 0));
            $this->content->can_details->bank_details = $this->common_model->get_fields_by_id($tablename='bank_details',$fields = array('account_number') , $conditions = array('can_id' => get_login_user_id(),'is_deleted' => 0));
            $this->load_view("profile_summary","HRMS - Employee Profile Summary ",$this->content);
        }
        else
        {
            $this->session->set_flashdata('warning', 'Access Denied');
            redirect('candidate');
        }

    }

    function user_profile_details()
    {
        $this->content->profile = $this->common_model->get_fields_by_id($tablename='candidate',$fields = array('can_name','phone1','email','pan_no','aadhar_no') , $conditions = array('can_id' => get_login_user_id()));
        $this->content->salary = $this->common_model->get_fields_by_id($tablename='emp_salary_details',$fields = array('pf_no','esic_no') , $conditions = array('can_id' => get_login_user_id(),'is_deleted' => 0));
        $this->content->bank_details = $this->common_model->get_fields_by_id($tablename='bank_details',$fields = array('account_number') , $conditions = array('can_id' => get_login_user_id(),'is_deleted' => 0));
        // x_debug($userdata);
        $this->load_view('profile_summary_new','Profilr Summary',$this->content);
        echo json_encode($userdata);        
    }


    function get_desig_by_dept()
    {
        if($this->input->is_ajax_request())
        {
            $dept_id = $this->input->post('dept_id');
            $designation = $this->common_model->get_data_array('job_profiles',array('dept_id' => $dept_id,'is_deleted' => 0));
            foreach ($designation as $key => $value) {         
                $title = ucwords(strtolower($value['title']));
                $selected ='';
                // if($value['dept_id'] == $dept_id) $selected = 'selected="selected"';
                $data .='<option'. $selected .' value='.$value['id'].'>'.$title.'</option>';           
        }
        echo json_encode($data);
        }
    }  

    function hod_as_reporting_mgr()
    {
        if($this->input->is_ajax_request())
        {
            $dept_id = $this->input->post('dept_id');
            $candidates = $this->common_model->get_data_array('candidate',array('department' => $dept_id,'is_deleted' => 0,'can_type!='=>'user'));
            if(empty($candidates))
            {
                $candidates = $this->common_model->get_data_array('candidate',array('is_deleted' => 0,'can_type'=>'Admin',''));
            }
            $hods = $this->candidate_model->get_dept_hods($dept_id);
            $hod_id='';
            foreach ($hods as $key => $value) {
                $hod_id = $value->can_id;
            }
            // echo $hod_id;
            // debug($hods);
            // debug($candidates);
            foreach ($candidates as $key => $value) {         
                $title = ucwords(strtolower($value['can_name']));
                $selected ='';
                if($dept_id==$value['is_hod'] && $hod_id==$value['can_id'])
                {
                    if($hod_id==$value['can_id'])
                    {
                        $selected ='selected';
                    }
                    else
                    {
                        $selected ='';
                    }
                   // echo $data .='<option selected="'. $selected .'" value='.$value['can_id'].'>'.$title.'</option>';
                }

                // if($value['dept_id'] == $dept_id) $selected = 'selected="selected"';
                $data .='<option'.' value='.$value['can_id'].'>'.$title.'</option>';           
        }
        echo json_encode($data);
        }
    }
    public function salary_details()
    {
        $userdata = $this->session->userdata('logged_in_user');
        $can_id = $this->uri->segment(3);
        if(($can_id == get_login_user_id()) || (in_array($userdata['role_id'],$this->config->item('hr_user_role_id'))||in_array($userdata['role_id'],$this->config->item('super_user_role_id'))||in_array($userdata['role_id'],$this->config->item('admin_user_role_id'))))
        {
            $this->content->percentage = $this->check_per_profile_complete();
            $this->content->salary_details=$this->common_model->get_data_array_order_by('emp_salary_details',array('can_id'=>$can_id),'',array('sd_id','desc'),1);
            $this->load_view('salary_details','Profile Summary',$this->content);
        }
        else
        {
            $this->session->set_flashdata('warning', 'Access Denied');
            redirect('candidate');
        }
    }
    /*  Assets Details  */

   function assets()
    {
        $userdata = $this->session->userdata('logged_in_user');
        $can_id = $this->uri->segment(3);
        if(($can_id == get_login_user_id()) || (in_array($userdata['role_id'],$this->config->item('hr_user_role_id'))||in_array($userdata['role_id'],$this->config->item('super_user_role_id'))||in_array($userdata['role_id'],$this->config->item('admin_user_role_id'))))
        {
            $this->content->percentage = $this->check_per_profile_complete();  
            $this->content->can_details = $this->get_candidate_name_by_id($can_id);
            // $this->content->assets = $this->candidate_model->get_assets_details($can_id);
            $can_type=$this->session->can_type;
            if($can_type!='user' && $can_type!='Manager')             
                $this->load_view("can_assets","HRMS - Employee Assets Details",$this->content);
            else
                $this->load_view("my_assets","HRMS - My Assets Details",$this->content);
        }
        else
        {
            $this->session->set_flashdata('warning', 'Access Denied');
            redirect('candidate');
        }
    }

    function assets_list($can_id = '')
    {
        $this->datatables->unset_column('c.can_asset_id');
        $this->datatables->select('c.can_asset_id,p.prop_name,c.quantity,p.penalty,d.title,c.can_id');
        $this->datatables->from('can_assigned_assets c');
        $this->datatables->join('property p', 'p.prop_id = c.asset_id', 'left');
        $this->datatables->join('departments d', 'd.id = p.dept_id', 'left');
        $this->datatables->where('c.can_id',$can_id);
        $this->datatables->where('c.is_deleted',0);
        // $this->db->order_by("can_asset_id", "desc"); 
        // $update_url = site_url().'/candidate/edit_investment_details/$1/$2'; 
        if($can_type!='user' && $can_type!='Manager')
        { 
            $this->datatables->add_column('edit', '<a type="button" class="tabledit-delete-button btn-danger btn btn-sm btn_delete_bill" value="$1" style="float: none;" onClick="delete_data($1)"><span class="glyphicon glyphicon-trash"></span></a>', 'can_asset_id');
        }
        $result= $this->datatables->generate();  
        echo $result;
    }

    function assign_assets()
    {
      // user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
      $this->content->percentage = $this->check_per_profile_complete();
      $can_id = $this->uri->segment(3);
      $this->content->can_details = $this->get_candidate_name_by_id($can_id);
      $this->content->assets_list = $this->common_model->get_data_array('property',array('is_deleted' =>0,'quantity>'=>0));
      if ($this->input->is_ajax_request())
      {
         // x_debug($this->input->post());
         $can_asset_array = array('can_id'=>$this->input->post('can_id'),'asset_id' =>$this->input->post('asset_id'),'quantity'=>$this->input->post('quantity'));
         $can_asset_array=set_log_fields($can_asset_array,'insert');
         $id = $this->common_model->insert('can_assigned_assets',$can_asset_array);
         $quantity_in_stock = $this->common_model->get_data('property',array('is_deleted' => 0,'prop_id'=>$this->input->post('asset_id')));
         // x_debug($quantity_in_stock);
         $quantity_in_stock = $quantity_in_stock['quantity'] - $this->input->post('quantity');
         $this->common_model->update('property',array('quantity'=>$quantity_in_stock),array('prop_id'=>$this->input->post('asset_id')));
         if($id > 0)
         {
            echo "1";
         }
      }

      $this->load_view("can_assign_assets","HRMS - Assign Assets",$this->content);
    }

   function delete_asset()
   {
      if ($this->input->is_ajax_request())
      {
         //$access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
         $access=0;
         if(!empty($access))
         {
            echo "0";
         }
         else
         {
            $can_asset_id = $this->input->post('can_asset_id');
            $this->common_model->update($tablename='can_assigned_assets',array('is_deleted'=>0),array('can_asset_id'=>$can_asset_id));
            echo "1";
         }
      }
   }


    /*  Assets Details  */



    private function load_view($viewname= "blank_page",$page_title)
    {
        $this->content->meta_description="Meta meta_description here!";
        $this->content->meta_keywords="meta keywords here!";
        $this->masterpage->setMasterPage('master');
        $this->content->page_description = "";
        $this->masterpage->setPageTitle($page_title);
        $this->masterpage->addContentPage('candidate/'.$viewname,'content',$this->content);
        $this->masterpage->show();
    }

    public function remove_profile()
    {
        $res = $this->common_model->update('candidate', array('profile_picture'=>NULL), array('can_id'=>get_login_user_id()));
        $this->session->profile_pic = NULL;
        echo json_encode($res);
    }
}