<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once( APPPATH . 'models/entities/candidate' . EXT );

class Common_model extends CI_Model {

	public function __construct()
    {
            parent::__construct();
            get_active_db();
            // Your own constructor code
    }

	/*function to get user roles */
	function get_form_dropdown($tablename, $fields ,$conditions)
	{
		$this->db->select($fields);
		$this->db->from($tablename);
		$this->db->where($conditions);
		return $this->db->get()->result();	
	}


	/*used in compensation*/
	function get_data_by_field($tablename ,$fields ,$conditions)
	{
		$this->db->select($fields);
		$this->db->from($tablename);
		$this->db->where($conditions);
		return $this->db->get()->row();
	}
	

	function get_fields_by_id($tablename ,$fields ,$conditions)
	{
		$this->db->select($fields);
		$this->db->from($tablename);
		$this->db->where($conditions);
		return $this->db->get()->row();
	}

	function get_userdata_by_fieldname($tablename,$fields,$conditions)
	{
		$this->db->select($fields);
		$this->db->from($tablename);
		$this->db->where($conditions);
		return $this->db->get()->row();
	}


	function get_user_details_by_id($id)
	{
		return $this->db->get_where('candidate', array('can_id' => $id,'is_active'=>1,'is_deleted'=>0))->row();
	}

	function get_can_list()
	{
		$this->db->select('can_id,can_name');
		$this->db->from('candidate');
		$this->db->where('is_deleted',0);
		return $this->db->get()->result();
	}
	

	function get_candidate_name_role($can_id)
	{
		$this->db->select('can_name,candidate.role_id,role_name');
		$this->db->join('roles', 'roles.role_id = candidate.role_id','LEFT');
		$this->db->where('can_id',$can_id);
		return $this->db->get('candidate')->row();
	}

	function save_reset_code($email,$em)
	{
		$this->db->set('reset_code',$em);
		$this->db->where('email',$email);
		$this->db->update('candidate');
	}

	function reset_password($data)
	{
		$this->db->set('password',$data['password']);
		$this->db->where('email',$data['can_details']->email);
		$this->db->update('candidate');
	}
	function get_data($table,$criteria=null,$fields=null)
    {
        if(!empty($fields))
        {
        	$this->db->select($fields);
        }
        if(!empty($criteria))
       	{
       	 	$this->db->where($criteria);
       	}
        $q = $this->db->get($table);
        if($q->num_rows() > 0)
        {
            return (array)$q->row();
        }
    }
    function get_data_array($table,$criteria=null,$fields=null)
    {
        if(!empty($fields))
        {
        	$this->db->select($fields);
        }
        if(!empty($criteria))
       	{
       	 	$this->db->where($criteria);
       	}
        $q = $this->db->get($table);

        if($q->num_rows() > 0)
        {
            return $q->result_array();
        }
    }

    function getByQuery($query=null)
    {
    	if(!empty($query))
    	{
    		$data=$this->db->query($query);
            $data=$data->result_array();
            return $data;
    	}
    }

	function getRowByQuery($query=null)
	{
		if(!empty($query))
		{
			$data=$this->db->query($query);
			$data=$data->row_array();
			return $data;
		}
	}

	function bulk_insert($tablename=null, $data=null)
	{
		$this->db->insert_batch($tablename, $data); 
		return $this->db->insert_id(); 
	}

	function insert($tablename=null, $data=null)
	{
		$this->db->insert($tablename, $data); 
		return $this->db->insert_id(); 
	}
	public function update( $table, $data = array(), $where)
	{
		if(!empty($where))
		{
			$this->db->where($where);      
		}
		$this->db->update($table,$data);
		return $this->db->affected_rows() >= 1 ? true : false ;
	}
	public function count_all($table,$where=null)
	{
		if(!empty($where))
		{
			$this->db->where($where);
		}
		return $this->db->from($table)->count_all_results();
	}

	function active_account($email)
    {
        $this->db->set('is_active',1);
        $this->db->where('email', $email);
        return $this->db->update('candidate');
        // echo $this->db->last_query();exit;
    }
    function get_data_array_order_by($table,$criteria=null,$fields=null,$order_by=null,$limit)
    {
       	if(!empty($fields))
        {
        	$this->db->select($fields);
        }
        if(!empty($criteria))
       	{
       	 	$this->db->where($criteria);
       	}
       	if(!empty($order_by))
       	{
       		$this->db->order_by(implode(' ',$order_by)); 
       	}
        
       	if(!empty($limit))
       	{
       		$this->db->limit($limit);
       	}
        $q = $this->db->get($table);
        if($q->num_rows() > 0)
        {
            return $q->result_array();
        }
        // echo $this->db->last_query();exit;
    }

	function get_data_row_order_by($table,$criteria=null,$fields=null,$order_by=null,$limit)
	{
		if(!empty($fields))
		{
			$this->db->select($fields);
		}
		if(!empty($criteria))
		{
			$this->db->where($criteria);
		}
		if(!empty($order_by))
		{
			$this->db->order_by(implode(' ',$order_by)); 
		}

		if(!empty($limit))
		{
			$this->db->limit($limit);
		}
			$q = $this->db->get($table);
		if($q->num_rows() > 0)
		{
			return $q->row_array();
		}
		// echo $this->db->last_query();exit;
	}



    function get_data_array_order_by_in($table,$criteria=null,$fields=null,$order_by=null,$limit,$where_in=null)
    {
       	if(!empty($fields))
        {
        	$this->db->select($fields);
        }

        if(!empty($where_in))
       	{
       	 	$this->db->where_in($where_in);
       	}
        if(!empty($criteria))
       	{
       	 	$this->db->where($criteria);
       	}
       	if(!empty($order_by))
       	{
       		$this->db->order_by(implode(' ',$order_by)); 
       	}
        
       	if(!empty($limit))
       	{
       		$this->db->limit($limit);
       	}
        $q = $this->db->get($table);
        if($q->num_rows() > 0)
        {
            return $q->result_array();
        }
         // echo $this->db->last_query();exit;
    }
}

?>