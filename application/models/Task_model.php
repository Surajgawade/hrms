<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once( APPPATH . 'models/entities/task' . EXT );

class Task_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        get_active_db();
    }
    
    function save_task($task_details)
    {
        $task = (array) $task_details;        
        if($task_details->task_id > 0)
        {
            $this->db->set('task_name',$task_details->task_name);
            $this->db->set('task_description',$task_details->task_description);
            $this->db->set('tat',$task_details->tat);
            $this->db->set('priority',$task_details->priority);
            $this->db->set('created_on',$task_details->created_on);
            $this->db->set('task_created_by',$task_details->task_created_by);
            $this->db->where('task_id', $task_details->task_id);
            $this->db->update('tasks',$task);
            return $task_details->task_id;
        }
        else
        {
            $this->db->insert('tasks',$task);
            return $this->db->insert_id();
        }        
    }

    function delete($tablename,$fieldname,$id)
    {
        $this->db->set('is_deleted',1);
        $this->db->where($fieldname,$id);
        $this->db->update($tablename);
        return $id;
    }

    function get_task_list()
    {
        return $this->db->get('tasks')->result();
    }
    function get_task_data($task_id)
    {
        return $this->db->get_where('tasks', array('task_id' => $task_id))->row();
    }
	
 function get_task_data_all($task_id){
        $this->db->select('tasks.task_id, task_name, task_description, priority, task_manager.status,  candidate.can_name as assigned_to, task_manager.can_id, c.can_name as assigned_by');
        $this->db->from('tasks');
        $this->db->join('task_manager', 'tasks.task_id=task_manager.task_id', 'left');
        $this->db->join('candidate c','task_manager.assigned_by=c.can_id');
        $this->db->join('candidate','task_manager.can_id=candidate.can_id');
        $this->db->where('tasks.task_id',$task_id);
        return $this->db->get()->row();
    }
    function assign_task($data)
    {
        $this->load->model('common_model');
        $count =  $this->db->get_where('task_manager', array('task_id' => $data['task_id'],'can_id' => $data['can_id']))->num_rows();
        if($count<1)
        {
            $rec['task'] = $this->common_model->get_data('tasks', array('task_id'=>$data['task_id'], 'is_deleted'=>0));
            $rec['candidate'] = $this->common_model->get_data('candidate', array('can_id'=>$data['can_id'], 'is_deleted'=>0));
            $this->load->library('email_send');
            $mailer_config = $this->common_model->get_data('email_config',array('email_template'=>'task_assign'));
            $rec['logo_img'] = $this->common_model->get_data('configuration_settings',array(),'company_inner_logo');
            $message = $this->load->view("email_templates/".$mailer_config["email_template"], $rec, TRUE);
            $smsm = send_sms($rec['candidate']['phone1'], "Please check your mailbox. New Task has been assigned to you.");
            $sent = $this->email_send->send_mail_new($mailer_config, $rec['candidate']['email'], $message);
            if($sent == 1)
            {
                $this->db->insert('task_manager', $data);
                return $this->db->insert_id(); 
            }
            else
            {
                return 0;
            }
        }        
    }

    function delete_ass_can($task_id,$can_id)
    {
        $this->db->where(array('task_id' => $task_id, 'can_id' => $can_id));
        return $this->db->delete('task_manager');
    }


    function get_assigned_candidates($task_id)
    {
        $this->db->select('task_manager.can_id');
        $this->db->from('task_manager');
        $this->db->where('task_manager.task_id',$task_id);
        return $this->db->get()->result();
    }

    function get_my_task_details($task_id,$can_id)
    {
        $this->db->select('*');
        $this->db->from('tasks');
        $this->db->join('task_manager', 'task_manager.task_id = tasks.task_id');
        $this->db->where('task_manager.task_id',$task_id);
        $this->db->where('task_manager.can_id',$can_id);
        return $this->db->get()->row();
    }

    function update_mytask_status($task_array)
    {
        $this->db->where('task_id', $task_array['task_id']);
        $this->db->where('can_id', $task_array['can_id']);
        return $this->db->update('task_manager',$task_array);
    }

    function get_taskstatus_details($taskm_id,$status='')
    {
        $this->db->select('task_manager.*,tasks.task_name,task_manager.task_comment');
        $this->db->from('task_manager');
        $this->db->join('tasks', 'tasks.task_id = task_manager.task_id');
        $this->db->where('task_manager.taskm_id',$taskm_id);
        $this->db->where('task_manager.status',$status);
        return $this->db->get()->row();
    }


    function reopen_task($task_status_array)
    {
        $this->db->where('taskm_id', $task_status_array['taskm_id']);
        return $this->db->update('task_manager',$task_status_array);
    }

    function get_can_name($task_id)
    {
        $this->db->select('candidate.can_name');
        $this->db->from('task_manager');
        $this->db->join('candidate', 'candidate.can_id = task_manager.can_id');        
        $this->db->where('task_manager.task_id',$task_id);
        return $this->db->get()->result();
    }

    public function get_task_details($conditions=null)
    {
        $this->db->select('tasks.*,task_manager.status,task_manager.can_id,task_manager.task_id,task_manager.taskm_id,candidate.can_name,candidate.profile_picture');
        $this->db->from('tasks');
        $this->db->join('task_manager', 'task_manager.task_id = tasks.task_id');
        $this->db->join('candidate', 'candidate.can_id = task_manager.can_id');
        $this->db->where('task_manager.created_by',get_login_user_id());
        $this->db->where($conditions);
        return $this->db->get()->result_array();
    }

}
?>
