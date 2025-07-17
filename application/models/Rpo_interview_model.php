<?php
	class Rpo_interview_model extends CI_Model{
		function _construct(){
			parent::_construct();
			get_active_db();
		}

		function get_interview_details($intw_can_id){
			$this->db->select('*');
			$this->db->from('rpo_interview_candidate_records');
			$this->db->where('intw_can_id',$intw_can_id);
			$query=$this->db->get();
			return (array)$query->row();
		}
		function get_record($intw_can_id){
			$this->db->select('rpo_interview_candidate_records.*, rpo_interview_manager.*');
			$this->db->from('rpo_interview_manager');
			$this->db->join('rpo_interview_candidate_records','rpo_interview_manager.intw_can_id=rpo_interview_candidate_records.intw_can_id');
			$this->db->where('rpo_interview_manager.intw_can_id',$intw_can_id);
			$result= $this->db->get();
			 return (array)$result->row();

		}

		function update_record($intw_can_id,$data,$data1){
			
			$this->db->where('intw_can_id',$intw_can_id);
			$this->db->update('rpo_interview_candidate_records',$data1);
			$this->db->where('intw_can_id',$intw_can_id);
			$this->db->update('rpo_interview_manager',$data);
		}

		function fetch_doc(){
			$this->db->select('*');
			$this->db->from('document_list');
			$result=$this->db->get();
			return $result->result_array();
		}

		function interview_report_fetch($data){			
			$this->db->select('rpo_interview_manager.*,rpo_interview_candidate_records.*');
			$this->db->from('rpo_interview_manager');
			$this->db->join('rpo_interview_candidate_records','rpo_interview_manager.intw_can_id=rpo_interview_candidate_records.intw_can_id');
			$this->db->where('rpo_interview_manager.created_on >=', $data['from_date']);
			$this->db->where('rpo_interview_manager.created_on <=', $data['to_date']);
			if($data['interview_status']!=""){
				$this->db->where('rpo_interview_manager.interview_status',$data['interview_status']);
			}
			if($data['interview_status']=="upcoming_interviews"){

				$this->db->or_where('rpo_interview_candidate_records.schedule_date >=', $data['from_date']);
				$this->db->where('rpo_interview_candidate_records.schedule_date <=', $data['to_date']);
			}
			if($data['interview_status']=="upcoming_joining"){
				$this->db->or_where('rpo_interview_manager.joining_date >=', $data['from_date']);
				$this->db->where('rpo_interview_manager.joining_date <=', $data['to_date']);
				$this->db->where('rpo_interview_manager.interview_status','selected');
			}
			$query = $this->db->get();

			return($query->result_array());
		}

		function get_joining_details()
		{
			$this->db->select('rpo_employee_projects.*');
			// $this->db->select('rpo_employee_projects.*,rpo_client_details.client_name,rpo_contract.proj_title');
			$this->db->from('rpo_employee_projects');
			// $this->db->join('rpo_client_details', 'rpo_client_details.client_id = rpo_employee_projects.client_id');
			// $this->db->join('rpo_contract', 'rpo_contract.proj_id = rpo_employee_projects.project_id');
			return $this->db->get()->row_array();
		}

		function get_can_interview_details($intw_can_id)
		{
			$this->db->select('rpo_interview_candidate_records.intw_can_id,rpo_interview_candidate_records.full_name,rpo_interview_manager.*');
			$this->db->from('rpo_interview_candidate_records');
			$this->db->join('rpo_interview_manager','rpo_interview_manager.intw_can_id=rpo_interview_candidate_records.intw_can_id','LEFT');
			$this->db->where('rpo_interview_candidate_records.intw_can_id',$intw_can_id);
			return $this->db->get()->row_array();
		}

		function get_rpo_details($intw_can_id)
		{
			$this->db->select('ricr.*,rim.interview_status,rim.joining_date,rim.is_joined,offered_position,rcd.client_name,rc.proj_id,rc.proj_type,rc.client_id,rc.client_rate,rc.offered_rate,rc.proj_title,rc.proj_start_date,rc.proj_end_date,rp.rpoemppro_id');
			$this->db->from('rpo_interview_candidate_records ricr');
			$this->db->join('rpo_interview_manager rim','rim.intw_can_id=ricr.intw_can_id','LEFT');
			$this->db->join('rpo_client_details rcd','rcd.client_id=rim.client_id','LEFT');
			$this->db->join('rpo_contract rc','rc.proj_id=rim.project_id','LEFT');
			$this->db->join('rpo_employee_projects rp','rp.can_id=ricr.intw_can_id','LEFT');
			$this->db->where('ricr.intw_can_id',$intw_can_id);
			$this->db->order_by('rim.inw_mid','desc');
			$this->db->limit(1);
			return $this->db->get()->row_array();
		}

		function  get_rpodata_by_search_string($search_str)
		{
			$this->db->select('*');
			$this->db->from('rpo_interview_candidate_records');
			$this->db->where('rpo_emp_code',$search_str);
			$this->db->or_where('email_id',$search_str);
			// $this->db->like('rpo_emp_code', $search_str);
			// $this->db->or_like('rpo_emp_code', $search_str);
			return $this->db->get()->row_array(); 
		}

		function get_rpodata_to_insert($intw_can_id)
		{
			$this->db->select('ricr.intw_can_id,ricr.rpo_emp_code,ricr.can_name,ricr.email_id,ricr.phone1,ricr.phone2,ricr.designation,rim.joining_date');
			$this->db->from('rpo_interview_candidate_records ricr');
			$this->db->join('rpo_interview_manager rim','rim.intw_can_id=ricr.intw_can_id','LEFT');
			$this->db->where('ricr.intw_can_id',$intw_can_id);
			return $this->db->get()->row_array(); 
		}


		function get_contract_details($proj_id)
		{
			$this->db->select('rpo_contract.*,rpo_client_details.client_name');
			$this->db->from('rpo_contract');
			$this->db->join('rpo_client_details','rpo_client_details.client_id=rpo_contract.client_id','LEFT');
			$this->db->where('rpo_contract.proj_id',$proj_id);
			return $this->db->get()->row_array();
		}
	}
?>