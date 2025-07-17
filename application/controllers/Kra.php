<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class KRA extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('common_model');
        $this->load->model('candidate_model');
        
        $this->load->library('ajax_pagination');
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
        $this->masterpage->addContentPage('kra/'.$viewname,'content',$this->content);
        $this->masterpage->show();
    }
  public function hr_dashboard()
  {
    $this->content->kra_entities=$this->common_model->get_data_array('kra_entities',array('is_active'=>1),'kra_entity_id,name');
    $this->content->user_list=$this->common_model->get_data_array('candidate',array('is_active'=>1,'reporting_to'=>get_login_user_id()),'can_id,can_name');
    // x_debug($this->content->user_list);
    $this->content->total_employee=$this->common_model->count_all('candidate');

    $this->content->team_self_evaluation=$this->common_model->count_all('kra_employee');
    $this->content->superviser_evaluation=$this->common_model->count_all('kra_employee',array('status'=>1));
    $this->content->pending_review=$this->common_model->count_all('kra_employee',array('status!='=>2));
    $this->content->final_kra=$this->common_model->count_all('kra_employee',array('status'=>2));
    //$this->content->assign_kra=$this->common_model->getByQuery('select c.can_id,c.can_name,ke.kra_id,ke.status,user_rating_average,manager_rating_average,ke.created_on,k.month,k.kra_name,ke.created_by from kra_employee ke left join kra k on k.kra_id=ke.kra_id left join candidate c on c.can_id=ke.can_id');
    // x_debug($this->content->assign_kra);
   $this->content->assigned_kra=$this->common_model->count_all('kra_department');
    $can_id=$this->common_model->get_data_array('candidate',array('reporting_to!='=>0),'DISTINCT(reporting_to) as reporting_to');
    $can_ids=implode(', ', array_column($can_id, 'reporting_to'));
    $this->content->department=$this->common_model->getByQuery('select departments.title, departments.id FROM departments join candidate on departments.id=candidate.department where candidate.can_id IN ('.$can_ids.') group by departments.title');

    $this->load_view("hr_dashboard","KRA - HR-Dashboard",$this->content); 
  }
  public function user_dashboard()
  {

    $this->content->kra_entities=$this->common_model->get_data_array('kra_entities',array('is_active'=>1),'kra_entity_id,name');

    $this->content->completed_kra=$this->common_model->count_all('kra_employee',array('status!='=>0,'can_id'=>get_login_user_id()));

    $this->content->assign_kra=$this->common_model->getByQuery('select c.can_id,c.can_name,ke.kra_id,ke.status,user_rating_average,manager_rating_average,ke.created_on,k.month,k.kra_name,ke.created_by from kra_employee ke left join kra k on k.kra_id=ke.kra_id left join candidate c on c.can_id=ke.can_id where k.is_active=1 AND ke.is_active=1 AND ke.can_id='.get_login_user_id());
    $this->content->assigned_kra=count($this->content->assign_kra);
    $this->load_view("user_dashboard","KRA - User-Dashboard",$this->content); 
  }
  public function manager_dashboard()
  {
     $this->content->user_list=$this->common_model->get_data_array('candidate',array('is_active'=>1,'reporting_to'=>get_login_user_id()),'can_id,can_name');

     $this->content->team_self_evaluation=$this->common_model->count_all('kra_employee',array('created_by'=>get_login_user_id()));
    $this->content->superviser_evaluation=$this->common_model->count_all('kra_employee',array('status'=>1,'created_by'=>get_login_user_id()));
    $this->content->pending_review=$this->common_model->count_all('kra_employee',array('status!='=>2,'created_by'=>get_login_user_id()));
    $this->content->total_employee=$this->common_model->count_all('candidate',array('reporting_to'=>get_login_user_id()));
    $this->content->self_review=$this->common_model->count_all('kra_employee',array('can_id'=>get_login_user_id(),'status'=>0));
    $this->content->assign_kra_total=$this->common_model->count_all('kra_employee',array('created_by'=>get_login_user_id()));
    $this->content->kra_entities=$this->common_model->get_data_array('kra_entities',array('is_active'=>1),'kra_entity_id,name');
    
    $this->content->team_members=$this->common_model->get_data_array('candidate',array('reporting_to'=>get_login_user_id()),'can_id,can_name');
    // x_debug($this->content->team_members);
    $this->content->assign_kra=$this->common_model->getByQuery('select k.kra_id,kra_name,k.month,status,kd.created_by,kd.created_on from kra k left join kra_department kd on k.kra_id=kd.kra_id where k.is_active=1 AND department_head_id='.get_login_user_id());

    $this->content->department=$this->common_model->get_data_array('departments',array('is_deleted'=>0),'id,title');
    
    $this->load_view("manager_dashboard","KRA - Manager-Dashboard",$this->content);
  }
  public function assign_kra()
  {
    $kra=$this->common_model->get_data_array('kra',array('is_active'=>1),'kra_id,kra_name');
    $this->content->kra=$kra;
    $this->content->department=$this->common_model->get_data_array('departments',array('is_deleted'=>0),'id,title');
    $this->load_view('assign_kra','HRMS-Add KRA',$this->content);
  }
  public function add_kra()
  {
    $departments=$this->common_model->get_data_array('departments',array('is_deleted'=>0),'id,title');
    $this->content->department=$this->common_model->get_data_array('departments',array('is_deleted'=>0),'id,title');
    $this->content->kra_entities=$this->common_model->get_data_array('kra_entities',array('is_active'=>1),'kra_entity_id,name');
    $this->load_view('add_kra','HRMS-Add KRA',$this->content);
  }
  public function save_kra()
  {

        $data=array('kra_name'=>$this->input->post('kra_title'),'kra_entity_ids'=>implode(',', array_column($this->input->post('entity_ids'),'value')),'month'=>$this->input->post('month'));
        $data=set_log_fields($data,'insert');
        $id=$this->common_model->insert('kra',$data);
        if(!empty($id))
        {
            $data=array('kra_id'=>$id,'department_head_id'=>$this->input->post('emplyee_id'),'month'=>$this->input->post('month'));
            $data=set_log_fields($data,'insert');
            $this->common_model->insert('kra_department',$data);
            $date = strtotime("+7 day");
            $date=date('Y-m-d h:i:s', $date);
            $data = array('task_name' =>'New KRA Assignment Added' ,'task_description' => $this->input->post('kra_title'),'task_created_by' => get_login_user_id(),'priority' => 'Medium','tat'=> $date) ;
            $data=set_log_fields($data,'insert');
            $task_details=set_log_fields($data,'insert');
            $task_id = $this->common_model->insert('tasks',$task_details);
            $data = array('task_id' =>$task_id ,'can_id' => $this->input->post('emplyee_id'),'status'=>'Open','assigned_by'=>get_login_user_id());
            $data=set_log_fields($data,'insert');
            $this->common_model->insert('task_manager',$data);
            
            echo "1";
        }
  }
  public function save_kra_manager()
  {
        $data=array('kra_name'=>$this->input->post('kra_title'),'kra_entity_ids'=>implode(',', array_column($this->input->post('entity_ids'),'value')),'month'=>$this->input->post('month'));
        $data=set_log_fields($data,'insert');
        $id=$this->common_model->insert('kra',$data);
        echo $id;
  }
  
  public function save_assign_kra()
  {
    // x_debug($this->input->post());
    if($this->input->post('employee_ids'))

    {
        foreach ($this->input->post('employee_ids') as $key => $value) {
            $data=array('kra_id'=>$this->input->post('kra_id'),'can_id'=>$value['value']);
            $data=set_log_fields($data,'insert');
            $this->common_model->insert('kra_employee',$data);
            $date = strtotime("+7 day");
            $date=date('Y-m-d h:i:s', $date);
            
            $data = array('task_name' =>'New KRA Assignment Added' ,'task_description' => 'KRA Added','task_created_by' => get_login_user_id(),'priority' => 'Medium','tat'=> $date) ;

            $task_details=set_log_fields($data,'insert');
            $task_id = $this->common_model->insert('tasks',$task_details);
            $data = array('task_id' =>$task_id ,'can_id' => $value['value'],'status'=>'Open','assigned_by'=>get_login_user_id());
            $data=set_log_fields($data,'insert');
            $this->common_model->insert('task_manager',$data);
        }
        echo "1"; 
    }
  }
  
  public function rate_kra($id='',$can_id='',$user_id)
  {
    $this->content->candidate_details=(array)$this->candidate_model->get_can_details($can_id,true);
    if(!empty($user_id))
    {
      $rating_data=$this->common_model->get_data('kra_employee',array('kra_id'=>$id,'can_id'=>$can_id));  
      if(!empty($rating_data))
      {
        $this->content->user_rating_values=explode(',', $rating_data['user_rating_values']);
        $this->content->manager_rating_values=explode(',', $rating_data['manager_rating_values']);
        $this->content->user_rating_average=$rating_data['user_rating_average'];
        $this->content->manager_rating_average=$rating_data['manager_rating_average'];
      }
    }
     //x_debug($this->content);
    $this->content->kra_details=$this->common_model->get_data('kra',array('kra_id'=>$id));
    if(!empty($this->content->kra_details))
    {
        $this->content->kra_entities=$this->common_model->getByQuery('select kra_entity_id,name from kra_entities where kra_entity_id IN ('.$this->content->kra_details['kra_entity_ids'].")");
    }
    $this->load_view('rate_kra','HRMS-Add KRA',$this->content);
  }
  public function get_candidate_list($department_id='',$page='')
  {
    $this->load->library('pagination');
    $config['per_page'] = 10;
    //$count=$this->common_model->count_all('candidate',array('department'=>$department_id));
    //$assign_kra=$this->common_model->get_data_array('kra_department',array('department_id'=>$department_id),'distinct(kra_id) as ids');
    $this->content->kra_total=$assign_kra[0]['ids'];
    $offset=0;
    if(!empty($page))
    {
        $offset=$page;
    }
    $config['target']      = '.result';
    $config['base_url'] = site_url().'/kra/get_candidate_list/'.$department_id.'/';
    $config['total_rows'] = $count;

    $can_id=$this->common_model->get_data_array('candidate',array('reporting_to!='=>0),'DISTINCT(reporting_to) as reporting_to');
    $can_ids=implode(', ', array_column($can_id, 'reporting_to'));
    //x_debug($can_ids);
    $data['candidates']=$this->common_model->getByQuery('select can_id,can_name,joining_date,job_profile,department,d.title,c.reporting_to from candidate c join departments d where c.department=d.id and  department IN('.implode(',', $this->input->post('id')).")  and c.can_id IN (".$can_ids.")");
    $data['kra_candidate']=$this->common_model->getByQuery('select kd.kra_id,can_id,can_name,joining_date,job_profile,department,c.reporting_to,kd.status from kra_department kd left join candidate c on c.can_id=kd.department_head_id where kd.is_active=1 AND department IN('.implode(',', $this->input->post('id')).")");
    $list=$this->load->view('kra/can_list',$data,true);
    $select_list=$this->load->view('kra/can_select_list',$data,true);
    echo(json_encode(array('can_list'=>$list,'total_employee'=>$count,'can_select_list'=>$select_list)));
  }


  public function get_team_kra($all='')
  {
    if(!empty($all))
    {
      $data['kra_candidate']=$this->common_model->getByQuery('select k.kra_name,kd.can_id,can_name,joining_date,job_profile,ke.month,department,c.reporting_to,kd.status,kd.kra_id from kra_employee kd left join candidate c on c.can_id=kd.can_id left join kra k on k.kra_id=kd.kra_id left join kra_department ke on ke.kra_id=kd.kra_id where kd.is_active=1 order by kd.created_on desc');
    }
    else
    {
      $data['kra_candidate']=$this->common_model->getByQuery('select k.kra_name,kd.can_id,can_name,joining_date,job_profile,ke.month,department,c.reporting_to,kd.status,kd.kra_id from kra_employee kd left join candidate c on c.can_id=kd.can_id left join kra k on k.kra_id=kd.kra_id left join kra_department ke on ke.kra_id=kd.kra_id where kd.is_active=1 AND kd.created_by='.get_login_user_id()." order by kd.last_modified_on"); 
    }
    $list=$this->load->view('kra/can_list_manager',$data,true);
    echo(json_encode(array('can_list'=>$list))); 
    // x_debug($data['kra_candidate']);
  }
  public function get_assigned_kra_list() 
  {
    $this->content->assign_kra=$this->common_model->getByQuery('select k.kra_id,kra_name,k.month,status,kd.created_by,kd.created_on from kra k left join kra_department kd on k.kra_id=kd.kra_id where status=0 and department_head_id='.get_login_user_id());
    $list=$this->load->view('kra/assigned_kra_list_manager',$data,true);
    echo(json_encode(array('can_list'=>$list))); 
     
  }
  public function get_assisgned_candidate()
  {

  }
  public function save_kra_rating($user_type)
  {
     //x_debug($this->input->post());
    if(!empty($user_type))
    {
      $values=$this->input->post('values');
      $values=rtrim($values,",");
      $kra_id=$this->input->post('kra_id');
      if($user_type=='user')
      {
        $data=$this->common_model->get_data('kra_employee',array('can_id'=>get_login_user_id(),'kra_id'=>$kra_id));
      // x_debug($this->input->post());  
        if(!empty($data))
        {
          if(!empty($data['user_rating_average']))
          {
            echo "Sorry You have already rated this assignment";
          }
          else
          {
            $this->common_model->update('kra_employee',array('status'=>1,'user_rating_values'=>$values,'user_rating_average'=>$this->input->post('avg')),array('can_id'=>get_login_user_id(),'kra_id'=>$kra_id));
            echo "Rating Submitted Successfully";
          }
        }
        else
        {
          echo "Invalid Request";
        }
      }
      else if($user_type=='manager')
      {
          $data=$this->common_model->get_data('kra_employee',array('can_id'=>$this->input->post('can_id'),'kra_id'=>$kra_id));
          //x_debug($data);
      
        if(!empty($data['manager_rating_average']))
          {
            echo "Sorry You have already rated this assignment";
          }
          else
          {
            $this->common_model->update('kra_employee',array('status'=>2,'manager_rating_values'=>$values,'manager_rating_average'=>$this->input->post('avg')),array('can_id'=>$this->input->post('can_id'),'kra_id'=>$kra_id));
            echo "Rating Submitted Successfully";
          }
        }
        else
        {
          echo "Invalid Request";
        }
      }
    }
    public function view_kra($id='',$can_id='',$user_id='')
    {
      $rating_data=$this->common_model->get_data('kra_employee',array('kra_id'=>$id,'can_id'=>$can_id));  
      $this->content->candidate_details=(array)$this->candidate_model->get_can_details($can_id,true);
      if(!empty($rating_data))
      {
        $this->content->user_rating_values=explode(',', $rating_data['user_rating_values']);
        $this->content->manager_rating_values=explode(',', $rating_data['manager_rating_values']);
        $this->content->user_rating_average=$rating_data['user_rating_average'];
        $this->content->manager_rating_average=$rating_data['manager_rating_average'];
      }
      $this->content->kra_details=$this->common_model->get_data('kra',array('kra_id'=>$id));
      if(!empty($this->content->kra_details))
      {
          $this->content->kra_entities=$this->common_model->getByQuery('select kra_entity_id,name from kra_entities where kra_entity_id IN ('.$this->content->kra_details['kra_entity_ids'].")");
      }
      $this->load_view('view_kra','View Appraisal Form');
    }
    public function get_self_kra()
    {
      $data['assign_kra']=$this->common_model->getByQuery('select c.can_id,c.can_name,ke.kra_id,ke.status,user_rating_average,manager_rating_average,ke.created_on,k.month,k.kra_name,ke.created_by from kra_employee ke left join kra k on k.kra_id=ke.kra_id left join candidate c on c.can_id=ke.can_id where ke.can_id='.get_login_user_id());
      $can_list=$this->load->view('kra/get_self_kra_list',$data,true);
      echo json_encode(array('can_list'=>$can_list));

    }
    public function get_performace_report()
    {
      $query="select k.month as months, avg(user_rating_average) as user_rating_average,avg(manager_rating_average) as manager_rating_average from kra_employee ke  left join kra k  on k.kra_id =ke.kra_id where ke.can_id='".get_login_user_id()."' and ke.status !=0 group by k.month";
      // print_r($query);
      // exit;
      x_debug($this->common_model->getByQuery($query));

    }
    public function add_kra_entity()
    {
      if(!empty($this->input->post('text')))
      {
        $cnt=$this->common_model->count_all('kra_entities',array('name'=>$this->input->post('text')));
        if($cnt==0)
        {
          $data=array('name'=>$this->input->post('text'));
          $data=set_log_fields($data);
          $id=$this->common_model->insert('kra_entities',$data);
          echo(json_encode(array('id'=>$id,'msg'=>'Entity Added Successfully')));
        }
        else
        {
          echo(json_encode(array('id'=>'','msg'=>'Entity already exist')));
        }
      }
    }
    public function language()
    {
      $this->load->view('language');
    }

    public function delete_kra()
    {
      $kra = $this->common_model->update('kra',array('is_active'=>0), array('kra_id'=>$this->input->post('id')));
      if($kra == true)
      {
        $kra_dept = $this->common_model->update('kra_department',array('is_active'=>0), array('kra_id'=>$this->input->post('id')));
        $kra_emp = $this->common_model->update('kra_employee',array('is_active'=>0), array('kra_id'=>$this->input->post('id')));
      }
      echo json_encode($kra);
    }

    public function delete_kra_emp()
    {
      $kra_emp = $this->common_model->update('kra_employee',array('is_active'=>0), array('kra_id'=>$this->input->post('id'), 'can_id'=>$this->input->post('can_id')));
      echo json_encode($kra_emp);
    }
}
  