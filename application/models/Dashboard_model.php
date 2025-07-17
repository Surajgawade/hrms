<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// include_once( APPPATH . 'models/entities/calender' . EXT );
class Dashboard_model extends CI_Model
{

	public function __construct()
    {
            parent::__construct();
            // Your own constructor code
            get_active_db();
            $this->load->model('common_model');
    }

    function get_tasks_list($can_id = '')
    {
	    $data = array();
        $this->db->query('CREATE OR REPLACE VIEW task_view AS SELECT `tasks`.`task_id`, `task_manager`.`can_id`, `task_manager`.`status` FROM `task_manager` INNER JOIN `tasks` ON `tasks`.`task_id` = `task_manager`.`task_id` WHERE `tasks`.`is_deleted` =0  AND `status` != "Completed"');

        $this->db->select('*');
        $this->db->from('task_view');
        $this->db->where(array('task_view.can_id'=>$can_id, 'status !='=>'Completed'));
        $pending_tasks = $this->db->get();
        $data['pending_tasks'] = $pending_tasks->num_rows();


        /*$this->db->select('tasks.*,task_manager.*');
        $this->db->from('task_manager');
        $this->db->join('tasks', 'tasks.task_id = task_manager.task_id','INNER');
        $this->db->where(array('tasks.is_deleted'=>0));
        $this->db->where(array('task_manager.can_id'=>$can_id, 'status'=>'Completed'));
        $completed_tasks = $this->db->get();
        $data['completed_tasks'] = $completed_tasks->num_rows();*/
        return $data;

       /* $completed_tasks = $this->db->query('CREATE VIEW task_view AS SELECT `tasks`.`task_id`, `task_manager`.`can_id`, `task_manager`.`status` FROM `task_manager` INNER JOIN `tasks` ON `tasks`.`task_id` = `task_manager`.`task_id` WHERE `tasks`.`is_deleted` =0  AND `status` != "Completed" AND `task_manager`.`can_id` ='.$can_id);
        x_debug($completed_tasks);
        $completed_tasks = $this->db->get();
        $data['completed_tasks'] = $completed_tasks->num_rows();*/
    }

    function get_leaves_list($can_id = '')
    {
        $data = array();
        // $leaves = $this->db->get_where('can_leave_records',array('can_id' =>$can_id))->row_array();
        $this->db->select('alloted_leave,balance_leave');
        $this->db->from('can_leave_records');
        $this->db->where(array('can_id' => $can_id));
        $leaves = $this->db->get()->row_array();
        if(!empty($leaves))
        {
            $data['leaves_taken'] = $leaves['alloted_leave'] - $leaves['balance_leave'];
            if($leaves['balance_leave'] > 0)
            {
                $data['pending_leaves'] = $leaves['balance_leave'];
            }
            else
            {
                $data['pending_leaves'] = 0;
            }
            if($data['leaves_taken'] <= 0)
            {
                $data['leaves_taken'] = 0;
            }
        }
        else
        {
            $data['leaves_taken'] = 0;
            $data['pending_leaves'] = 0;
        }
        return $data;
    }

    function get_events($can_id = '')
    {
        $data = array();
        $events = $this->db->get_where('event',array('can_id' =>$can_id, 'is_deleted' =>0))->result_array();
        foreach ($events as $key => $value) {
            if(($value['start'] <= date('Y-m-d h:i:s')) && ($value['end'] >= date('Y-m-d h:i:s')))
            {
                $data[] = $value;
            }
        }
        return $data;
    }

    function get_pie_chart($can_id = '')
    {
        $data = array();
        $this->db->select('tasks.*,task_manager.*');
        $this->db->from('task_manager');
        $this->db->join('tasks', 'tasks.task_id = task_manager.task_id','INNER');
        $this->db->where(array('tasks.is_deleted'=>0, 'tat like'=>'%'.date('Y-m').'%'));
        $this->db->where(array('task_manager.can_id'=>$can_id, 'status !='=>'Completed'));
        $month_pending_tasks = $this->db->get();
        $data['month_pending_tasks'] = $month_pending_tasks->num_rows();
        $this->db->select('tasks.*,task_manager.*');
        $this->db->from('task_manager');
        $this->db->join('tasks', 'tasks.task_id = task_manager.task_id','INNER');
        $this->db->where(array('tasks.is_deleted'=>0, 'tat like'=>'%'.date('Y-m').'%'));
        $this->db->where(array('task_manager.can_id'=>$can_id, 'status'=>'Completed'));
        $month_completed_tasks = $this->db->get();
        $data['month_completed_tasks'] = $month_completed_tasks->num_rows();
        return $data;
    }

    function get_travels($can_id = '')
    {
        $data = array();

        // $travels = $this->db->get_where('travel',array('can_id' =>$can_id, 'from_date like'=>'%'.date('Y-m').'%', 'to_date like'=>'%'.date('Y-m').'%', 'status !='=>'cleared', 'status !='=>'claimed' ,'status !='=>'rejected', 'is_deleted' =>0), 6);

        $this->db->select('tv_id,can_id,purpose,location,status');
        $this->db->from('travel');
        $this->db->where(array('can_id' =>$can_id, 'from_date like'=>'%'.date('Y-m').'%', 'to_date like'=>'%'.date('Y-m').'%', 'status !='=>'cleared', 'status !='=>'claimed' ,'status !='=>'rejected', 'is_deleted' =>0),6);
        $data['travels']= $this->db->get()->result_array();

        
        // $data['travels'] = $travels->result_array();
        return $data;
    }

    function get_jobs()
    {
        $data = array();
        $this->db->order_by('job_id', 'DESC');
        $jobs = $this->db->get_where('jobs',array('is_deleted' =>0,'status' => 'open'), 7);
        $data['jobs'] = $jobs->result_array();
        return $data;
    }

    function get_all_jobs()
    {
        $data = array();
        $this->db->order_by('job_id', 'DESC');
        $jobs = $this->db->get_where('jobs',array('is_deleted' =>0,'status' => 'open'));
        $data['jobs'] = $jobs->result_array();
        return $data;
    }
     function get_news(){
        $data=array();
        $this->db->select('nw_id,nw_title,nw_description,publish_date,nw_image,image_name');
        $this->db->from('news');
        $this->db->where('is_deleted',0);
        $this->db->where('publish_status',1);
        $this->db->order_by('created_on','DESC');
        $this->db->limit(5);
        $data=$this->db->get()->result_array();
        return $data;
    }
	
    function get_dept_average_salary()
    {
        $this->db->query('CREATE OR REPLACE VIEW dept_avg_salary_view AS SELECT `departments`.`title` as department_title, SUM(`emp_salary_details`.`gross_pay`)  as average_salary FROM `emp_salary_details` JOIN `candidate` ON `candidate`.`can_id` = `emp_salary_details`.`can_id`  JOIN `departments` ON `candidate`.`department` = `departments`.`id` WHERE `candidate`.`is_deleted` = 0 AND `candidate`.`is_active` = 1 AND `emp_salary_details`.`is_deleted` = 0 GROUP BY `candidate`.`department`');
        $this->db->select('*');
        $this->db->from('dept_avg_salary_view');
        // $this->db->join('candidate', 'candidate.can_id = emp_salary_details.can_id');
        // $this->db->join('departments d', 'candidate.department =  d.id');        
        // $this->db->where(array('candidate.is_active' => 1,'candidate.is_deleted' => 0));
        // $this->db->where(array('emp_salary_details.is_deleted' => 0));        
        // $this->db->group_by('candidate.department');
        $dept_avg_sal = $this->db->get();
        $data = $dept_avg_sal->result_array();
        return $data;
    }
    function get_dept_emp_count($value='')
    {
        $this->db->select('d.title as department_title,d.id, COUNT(can_id) as count');
        $this->db->from('candidate');
        $this->db->join('departments d', 'candidate.department =  d.id');        
        $this->db->where(array('candidate.is_active' => 1,'candidate.is_deleted' => 0));
        $this->db->group_by('candidate.department');
        $dept_emp_count = $this->db->get();
        $emp_dept = $dept_emp_count->result_array();
        // var_dump($emp_dept);
        return $emp_dept;
    }

    /* function get_user_activities($user_id)
    {
        $this->db->where('can_id', $user_id);
        $query = $this->db->get('bank_details');
        if($query->num_rows >= 1)
        {
            echo $bank_details =1;
            //if query finds one row relating to this user then execute code accordingly here
        }

        $this->db->where('can_id', $user_id);
        $query = $this->db->get('billing');
        if($query->num_rows >= 1)
        {
            $billing =1;
            //if query finds one row relating to this user then execute code accordingly here
        }

        $this->db->select('c.can_id,c.can_name');
        $this->db->from('candidate c');

     // echo   $this->common_model->count_all($tablename='billing bl', $conditions = array('bl.can_id' => $user_id));exit;
        if($bank_details==1)
        {
            echo "record exist in bank_details";exit;
            $this->db->select('b.bank_name');
            $this->db->join('bank_details b', 'c.can_id = b.can_id');
        }
        if($billing==1)
        {
            echo "record exist ib billing";

            $this->db->join('billing bl', 'c.can_id = bl.can_id');
        }
        // if($this->common_model->count_all($tablename='billing bl', $conditions = array('bl.can_id' => $user_id)))
        // {
        //     $this->db->join('billing bl', 'c.can_id =  bl.can_id'); 
        // }  

        $this->db->where(array('c.can_id' => $user_id,'c.is_active' => 1,'c.is_deleted' => 0));
        // $this->db->group_by('candidate.department');
        $record = $this->db->get()->row_array();
        // echo $this->db->last_query();exit;
        return $record;
    }*/


    public function get_user_activities($user_id)
    {
        /*$sql = "CREATE VIEW user_activities
                AS SELECT c.*, b.last_modified_on AS blastm, d.doc_name, e.company_name
                FROM candidate c, bank_details b, billing bl, documents d, experience e
                WHERE c.can_id=".$user_id;
                $this->db->query($sql);*/

         $sql ="SELECT c.can_id,c.last_modified_on, 'story' as table_type
                FROM candidate c
                UNION
                SELECT b.can_id,b.last_modified_on, 'status' as table_type
                FROM bank_details b
                WHERE ( c.last_modified_by = $user_id ) OR (b.last_modified_by = $user_id)
                ORDER BY 'timestamp' DESC LIMIT 0, 5";
                $this->db->query($sql);
    }

    public function get_rpo_user_profile_details($can_id = '')
    {
        $data = array();
        $this->db->query('CREATE OR REPLACE VIEW my_profile_view AS SELECT `rpo_candidates`.`can_id`, `rpo_candidates`.`pan_no`, `rpo_candidates`.`aadhar_no`, `rpo_bank_details`.`account_number` FROM `rpo_bank_details` INNER JOIN `rpo_candidates` ON `rpo_candidates`.`can_id` = `rpo_bank_details`.`can_id` WHERE `rpo_candidates`.`is_deleted` =0');
        $this->db->select('*');
        $this->db->from('my_profile_view');
        $this->db->where(array('my_profile_view.can_id'=>$can_id));
        $profile = $this->db->get();
        $data = $profile->row_array();
        return $data;
    }
}
?>
