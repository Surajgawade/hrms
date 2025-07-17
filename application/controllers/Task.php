<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Task extends My_Controller {

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

	public function index($msg="")
	{
        $this->load_view("task_list","HRMS - Task List",$this->content);
	}


	public function task_list($msg="")
	{
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
        $this->load_view("task_list","HRMS - Task List",$this->content);
	}

    function list_task()
    {
        $userdata = $this->session->userdata('logged_in_user');
        $this->datatables->unset_column('task_id');
        $this->datatables->unset_column('tat');
        $this->datatables->select('task_id, task_name, task_description, priority,candidate.can_name, tat,time');
        $this->datatables->from('tasks');
        $this->datatables->join('candidate', 'tasks.task_created_by = candidate.can_id', 'left');
        // $this->datatables->join('task_manager', 'candidate.can_id = task_manager.can_id');
        $this->datatables->where('tasks.is_deleted',0);
        $this->datatables->where('candidate.is_deleted',0);
        $this->datatables->where('tasks.task_created_by',$userdata['id']);
        // $this->datatables->group_by('task_manager.can_id');
        $update_url = site_url().'/task/update/$1';
        $assign_url = site_url().'/task/assign/$1';
        $view_url=site_url().'/task/view/$1/task_list';
        //echo $id = '/task/update/$1';exit;
        //$can_name = $this->get_assigned_candidates();
        $this->datatables->add_column('assigned To', '<span>$1</span>','');
        $this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn-success btn btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_task($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_delete" ><span class="glyphicon glyphicon-trash"></span></a>
            <a href="'.$view_url.'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>', 'task_id');
        $this->datatables->add_column('assign_task', '<a href="'.$assign_url.'" class="tabledit-edit-button btn btn-sm btn_assign">Assign task</a>', 'task_id');
        // $lst_qry = $this->db->last_query();
        // file_put_contents('/tmp/test_new.txt', $lst_qry. "\n\n", FILE_APPEND);  
        $result= $this->datatables->generate();  
        echo $result;
    }

    function get_assigned_candidates()
    {
        $this->content->assigned_can = $this->task_model->get_can_name();
        // x_debug($this->content->assigned_can);
        // return $instituciones;
    }


    function my_task_list()
    {
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
        $this->load_view("my_task_list","HRMS - My Task List",$this->content);
    }

    function list_my_task()
    {
        $userdata = $this->session->userdata('logged_in_user');
        $this->datatables->unset_column('tasks.task_id');
        $this->datatables->unset_column('tat');
        $this->datatables->select('tasks.task_id, task_name, task_description, priority, tat,candidate.can_name, status,time');
        $this->datatables->from('tasks');
        $this->datatables->join('task_manager', 'tasks.task_id = task_manager.task_id', 'left');
        $this->datatables->join('candidate', 'task_manager.assigned_by = candidate.can_id', 'left');
        $this->datatables->where('task_manager.can_id',$userdata['id']);
        $this->datatables->where('task_manager.is_deleted',0);
        $update_task_url = site_url().'/task/update_my_task/$1';
        $view_url=site_url().'/task/view/$1/my_task_list';
        $this->datatables->add_column('edit', '<a href="'.$update_task_url.'" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a><a href="'.$view_url.'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>', 'task_id');
        $result= $this->datatables->generate(); 

        echo $result;
    }

    function update_my_task()
    {
        $userdata = $this->session->userdata('logged_in_user');
        $task_id = $this->uri->segment(3);
        //check_record_exist($tablename='tasks', $conditions = array('task_id' =>$task_id));
        $this->content->task_details = $this->task_model->get_my_task_details($task_id,$userdata['id']);
        if(!empty($_POST))
        {
            $task_array = array('task_id'=> $this->input->post('task_id',true),'can_id'=> $userdata['id'] ,'status' => $this->input->post('task_status',true),'task_comment'=> $this->input->post('task_comment',true));
            if($this->task_model->update_mytask_status($task_array))
            {
                $task_array=set_log_fields($task_array);
                $this->session->set_flashdata('success', 'Task Status Updated Successfully!');
                redirect('task/my_task_list');
            }        
        }
        $this->load_view("update_task_status","HRMS - Update My Task Status",$this->content);
    }

    function create_task()
    {
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
        $superadmin = $this->config->item('super_user_role_id');
        $superadmin = implode(',', $superadmin);
        // $this->content->candidates = $this->common_model->get_form_dropdown($tablename = 'candidate', $fields = array('can_id','can_name'),$conditions = array('is_deleted' => 0));
        $this->content->candidates = $this->db->query('SELECT * FROM `candidate` WHERE `is_deleted`=0 AND role_id NOT IN ('.$superadmin.')')->result();
        $userdata = $this->session->userdata('logged_in_user');
        if(!empty($this->input->is_ajax_request()))
        {   
            $task_details = new Task_Entity(); 
            $task_details->task_name = $this->input->post('task_name');
            $task_details->task_description = $this->input->post('task_description');
            $task_details->tat =  date('Y-m-d', strtotime(str_replace('/', '-', $post['tat'])));
            $task_details->priority = $this->input->post('priority');
            $task_details->task_created_by = $userdata['id'];
            $task_details->created_on = date('Y-m-d');
            // x_debug($task_details);
            // $data = array('task_name' =>$this->input->post('task_name') ,'task_description' => $this->input->post('task_description'),'task_created_by' => $userdata['id'],'created_on'=>date('Y-m-d'));
            $task_details=set_log_fields($task_details,'insert');
	    $task_id = $this->task_model->save_task($task_details);
            if( $task_id >0 )
            {
               echo  json_encode(array("task_id"=> $task_id,'success'=>'Task added successfully!'));
            }
        }
        $this->load_view("create_task","HRMS - Create Task",$this->content);
    }

    function save_task()
    {
        $userdata = $this->session->userdata('logged_in_user');
        if(!empty($this->input->is_ajax_request()))
        {   
            $task_details = new Task_Entity(); 
            $task_details->task_name = $this->input->post('task_name');
            $task_details->task_description = $this->input->post('task_description');
            $task_details->tat =  date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tat'))));
            $task_details->priority = $this->input->post('priority');
            $task_details->task_created_by = $userdata['id'];
            $task_details->created_on = date('Y-m-d');
            $data = array('task_name' =>$this->input->post('task_name') ,'task_description' => $this->input->post('task_description'),'task_created_by' => $userdata['id'],'priority' => $this->input->post('priority'),'tat'=> date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tat')))),'time'=>$this->input->post('time')) ;
            $task_details=set_log_fields($data,'insert');
            $task_id = $this->common_model->insert('tasks',$task_details);
            if( $task_id >0 )
            {
                
               echo  json_encode(array("task_id"=> $task_id,'success'=>'Task added successfully!'));
            }
        }
    }

    function assign_task()
    {
        $userdata = $this->session->userdata('logged_in_user');
        //user_access_operation($this->router->fetch_class(),$this->router->fetch_method());   
         if($this->input->is_ajax_request())
         {
            $task_id = $this->input->post('task_id');
            $candidates = $this->input->post('candidates');
            $this->content->assigned_can = $this->task_model->get_assigned_candidates($task_id);
            foreach ($this->content->assigned_can as  $can)
            {      
               if(!in_array($can->can_id, $candidates))
               {
                  $this->task_model->delete_ass_can($task_id,$can->can_id);
               }
            }
            for ($i=0; $i < count($candidates); $i++)
            {
               $data = array('task_id' => $task_id, 'can_id' =>$candidates[$i],'assigned_by' => $userdata['id'],'status'=>'Open'); 
               $data = set_log_fields($data,'insert');
                if($this->task_model->assign_task($data))
                {
                    echo "1";
                }
                else
                {
                    echo "2";
                }
            }
        }
    }

    function update()
    {
        user_access_operation($this->router->fetch_class(),$this->router->fetch_method());  
        $task_id = $this->uri->segment(3);
        check_record_exist($tablename='tasks', $conditions = array('task_id' =>$task_id));
        $this->content->task_details = $this->task_model->get_task_data($task_id);
        if(!empty($_POST))
        {
            $post = $this->input->post();
            $task_details = new Task_Entity();
            $task_details->task_id = $task_id;
            $task_details->task_name = $post['task_name'];
            $task_details->task_description = $post['task_description'];
            $task_details->tat = date('Y-m-d', strtotime(str_replace('/', '-', $post['tat'])));
            $task_details->priority = $post['priority'];
            $task_details->task_created_by = $this->content->task_details->task_created_by;
            $task_details->priority = $post['priority'];
            
                $task_details=set_log_fields($task_details);
            if($this->task_model->save_task($task_details))
            {
                $this->session->set_flashdata('success', 'Task Updated Successfully!');
                redirect('task');
            } 
        }
        $this->load_view("edit_task","HRMS - Edit Task",$this->content);
    }


   function assign()
   {
      user_access_operation($this->router->fetch_class(),$this->router->fetch_method());   
      $superadmin = $this->config->item('super_user_role_id');
      $superadmin = implode(',', $superadmin);
      $task_id = $this->uri->segment(3);
      $this->content->task_details = $this->task_model->get_task_data($task_id);
      $this->content->assigned_can = $this  ->task_model->get_assigned_candidates($task_id);
      //$task_details=set_log_fields($task_details);
      // $this->content->candidates = $this->common_model->get_form_dropdown($tablename = 'candidate', $fields = array('can_id','can_name'),$conditions = array('is_deleted' => 0, 'role_id NOT IN ('.$superadmin.')'));
      $this->content->candidates = $this->db->query('SELECT * FROM `candidate` WHERE `is_deleted`=0 AND role_id NOT IN ('.$superadmin.')')->result();
      $this->load_view("assign_task","HRMS - Assign Task",$this->content);
   }

    function delete_task()
    {
        $access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
        if(!empty($access))
        {
            $this->session->set_flashdata('access_denied', 'Access Denied');
            echo '0';
        }
        else
        { 
            $task_id = $this->input->post('task_id');
            $id  = $this->task_model->delete($tablename='tasks',$fieldname='task_id',$task_id);
            $assign = $this->task_model->delete($tablename='task_manager',$fieldname='taskm_id',$id);
            $task_details=set_log_fields($task_details);
            echo '1';
            
        }
    }

   // function task_status()
   // {
   //      user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
   //      $this->load_view("my_task_status","HRMS - View Task Status",$this->content);
   // }

    // function list_my_task_status()
    // {
    //     $userdata = $this->session->userdata('logged_in_user');
    //     $this->datatables->unset_column('tasks.task_id');
    //     $this->datatables->unset_column('task_manager.can_id');
    //     $this->datatables->unset_column('task_manager.taskm_id');
    //     $this->datatables->select('tasks.task_id, task_name, task_manager.taskm_id, task_manager.can_id,candidate.can_name, task_manager.status');
    //     $this->datatables->from('tasks');
    //     $this->datatables->join('task_manager', 'tasks.task_id = task_manager.task_id', 'left');
    //     $this->datatables->join('candidate', 'task_manager.can_id = candidate.can_id', 'left');
    //     $this->datatables->where('tasks.task_created_by',$userdata['id']);
    //     $reopen_task_url = site_url().'/task/reopen_task/$1';
        
    //     $this->datatables->add_column('edit', '<a href="'.$reopen_task_url.'"  class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span> Reopen </a>', 'taskm_id');

    //     $result= $this->datatables->generate();  
    //     echo $result;
    // }

    function task_status()
   {
        user_access_page($this->router->fetch_class(),$this->router->fetch_method()); 

        $this->content->opened =  $this->task_model->get_task_details(array('status'=>"Open"));
        $this->content->completed =  $this->task_model->get_task_details(array('status'=>"Completed"));
        $this->content->in_progress =  $this->task_model->get_task_details(array('status'=>"In-Progress"));
        $this->content->reopen =  $this->task_model->get_task_details(array('status'=>"Reopen"));
        //x_debug($this->content);
        $this->load_view("my_task_status","HRMS - View Task Status",$this->content);
   }

    function reopen_task($taskm_id)
    {
        user_access_operation($this->router->fetch_class(),$this->router->fetch_method());   
        $this->content->task_status_details = $this->task_model->get_taskstatus_details($taskm_id);
        // x_debug($this->content->task_status_details);
        if(!empty($_POST))
        {
            $post = $this->input->post();
            $task_status_array = array('taskm_id'=> $this->uri->segment(3),'task_reopen_comment' => $_POST['reopen_reason'],'status'=> $_POST['task_status']);
            if($this->task_model->reopen_task($task_status_array))
            {
                $this->session->set_flashdata('success', 'Task Reopen Successfully!');
                redirect('task/task_status');
            }        
        }
        // $task_mange_id = $this->input->post('task_mange_id');
        // $this->task_model->reopen_task($tablename='taskm_id',$fieldname ='bill_id',$task_mange_id);
        $this->load_view("reopen_task","HRMS - Reopen Task",$this->content);
           
    }

    private function load_view($viewname= "blank_page",$page_title)
    {
        $this->content->meta_description="Meta meta_description here!";
        $this->content->meta_keywords="meta keywords here!";
        $this->masterpage->setMasterPage('master');
        $this->content->page_description = "";
        $this->masterpage->setPageTitle($page_title);
        $this->masterpage->addContentPage('tasks/'.$viewname,'content',$this->content);
        $this->masterpage->show();
    }
	 //function to view task indiviual
    public function view()
    {
        user_access_operation($this->router->fetch_class(),$this->router->fetch_method());  
        $userdata = $this->session->userdata('logged_in_user');
        $task_id = (int)$this->uri->segment(3);  
        $this->content->task_details = $this->task_model->get_task_data_all($task_id);
        $this->load_view("read_task","HRMS - News",$this->content);
    }
}
