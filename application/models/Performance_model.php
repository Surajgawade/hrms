<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once( APPPATH . 'models/entities/Performance' . EXT );

class Performance_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    function save_criteria($criteria_details)
    {
        $criteria = (array) $criteria_details;        
        if($criteria_details->criteria_id > 0)
        {
            $this->db->set('criteria_name',$criteria_details->criteria_name);
            $this->db->set('percent_value',$criteria_details->percent_value);
            $this->db->where('criteria_id', $criteria_details->criteria_id);
            $this->db->update('performance_criteria',$criteria);
            return $criteria_details->criteria_id;
        }
        else
        {
            $this->db->insert('performance_criteria',$criteria);
            return $this->db->insert_id();
        }
    }

    function get_candidate_assessment_details($can_id,$role_id)
    {
        $this->db->select('c.id,c.per_cri_id,c.assess_value as value,p.criteria_name,p.percent_value');
        $this->db->from('can_assessment as c');
        $this->db->join('performance_criteria as p', 'p.criteria_id = c.per_cri_id');
        $this->db->where(array('c.can_id' => $can_id,'p.role_id' =>$role_id));
        return $this->db->get()->result();
    }

    // function check_assessment()
    // {

    // }
    
    function get_criteria_list()
    {
        return $this->db->get_where('performance_criteria',array('is_deleted'=> 0))->result();
    }

    function get_criteria_by_role($role)
    {
        //x_debug($roles);
        // $this->db->where_in('role_id',$roles);
       return $this->db->get_where('performance_criteria',array('is_deleted'=> 0,'role_id'=> $role))->result(); 
    }

    function get_criteria_details($criteria_id)
    {
        return $this->db->get_where('performance_criteria',array('is_deleted'=> 0,'criteria_id' => $criteria_id))->row();
    }

    function delete_criteria($criteria_id)
    {
        $this->db->set('is_deleted',1);
        $this->db->where('criteria_id', $criteria_id);
        return $this->db->update('performance_criteria');
    }

    function save_can_performance_criteria($can_assess_data)
    {
        $this->db->insert_batch('can_assessment', $can_assess_data); 
        return $this->db->insert_id(); 
    }

    function get_can_role_details($can_id = '')
    {
        $data = array();
        $role = $this->db->get_where('candidate',array('can_id' =>$can_id, 'is_deleted'=>0))->row_array();
        $role_name = $this->db->get_where('roles',array('role_id' =>$role['role_id'], 'is_deleted'=>0))->row_array();
        $desg = $this->db->get_where('job_profiles',array('id' =>$role['job_profile'], 'is_deleted'=>0))->row_array();
        $data['role'] = $desg['title'];
        $data['role_id'] = $role_name['role_id'];
        $data['perform'] = $this->db->get_where('performance_criteria',array('role_id' =>$role['role_id'], 'is_deleted'=>0))->result_array();
        return $data;
    }

    function add_assesment_list($assesment_details)
    {
        // var_dump($assesment_details);
        if($assesment_details->list_id > 0)
        {
            $this->db->where("list_id",$assesment_details->list_id);
            if($this->db->update("assesment_list",$assesment_details))
            {
                return $assesment_details->list_id;
            }
        }
        else
        {
            $data = (array) $assesment_details;
            $this->db->insert('assesment_list',$data);
            return $this->db->insert_id();
        }
    }

    function add_can_assesment($can_asses)
    {
        // var_dump($can_asses);
        if($can_asses['id'] > 0)
        {
            $this->db->where("id",$can_asses['id']);
            if($this->db->update("can_assessment",$can_asses))
            {
                return $can_asses['id'];
            }
        }
        else
        {
            $data = (array) $can_asses;
            $this->db->insert('can_assessment',$data);
            return $this->db->insert_id();
        }
        // return $this->db->insert('can_assessment',$can_asses);
    }

    function delete($tablename,$fieldname,$id)
    {
        $this->db->set('is_deleted',1);
        $this->db->where($fieldname,$id);
        $this->db->update($tablename);
    }

    function get_list_details($al_id='')
    {
        $data = array();
        $data['can_list'] = $this->db->get_where('assesment_list',array('list_id' => $al_id,'is_deleted'=> 0))->row_array();
        $data['assesment'] = $this->db->get_where('can_assessment',array('assesment_list_id' => $al_id,'is_deleted'=> 0))->result_array();
        // var_dump($data);
        return $data;
    }

    function get_role_name($can_id='')
    {
        $can = $this->db->get_where('candidate',array('can_id' => $can_id,'is_deleted'=> 0))->row_array();
        $role = $this->db->get_where('job_profiles',array('id' => $can['job_profile'],'is_deleted'=> 0))->row_array();
        return $role['title'];
    }

    function get_criteria_name($criteria_id='')
    {
        $criteria = $this->db->get_where('performance_criteria',array('criteria_id' => $criteria_id,'is_deleted'=> 0))->row_array();
        return $criteria['criteria_name'];
    }

    function get_can_name($can_id='')
    {
        $role = $this->db->get_where('candidate',array('can_id' => $can_id,'is_deleted'=> 0))->row_array();
        return $role['can_name'];
    }
    function get_list_criterias($criteria_id){
        $this->db->select('criteria_id, performance_criteria.role_id ,role_name, criteria_name, percent_value');
        $this->db->join('roles', 'performance_criteria.role_id = roles.role_id', 'left');       
        $this->db->from('performance_criteria');
        $this->db->where('performance_criteria.criteria_id',$criteria_id);
        return $this->db->get()->row();
    }
}
?>