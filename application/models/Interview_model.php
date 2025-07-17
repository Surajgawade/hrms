<?php
	class Interview_model extends CI_Model{
		function _construct(){
			parent::_construct();
			get_active_db();

		}

		function get_interview_details($intw_can_id){
			$this->db->select('*');
			$this->db->from('interview_candidate_records');
			$this->db->where('intw_can_id',$intw_can_id);
			$query=$this->db->get();
			return (array)$query->row();
		}
		function get_record($intw_can_id){
			$this->db->select('interview_candidate_records.*, interview_manager.*');
			$this->db->from('interview_manager');
			$this->db->join('interview_candidate_records','interview_manager.intw_can_id=interview_candidate_records.intw_can_id');
			$this->db->where('interview_manager.intw_can_id',$intw_can_id);
			$result= $this->db->get();
			 return (array)$result->row();

		}

		function update_record($intw_can_id,$data,$data1){
			
			$this->db->where('intw_can_id',$intw_can_id);
			$this->db->update('interview_candidate_records',$data1);
			echo $this->db->last_query();
			$this->db->where('intw_can_id',$intw_can_id);
			$this->db->update('interview_manager',$data);
				
			echo $this->db->last_query();
		}

		function fetch_doc(){
			$this->db->select('*');
			$this->db->from('document_list');
			$result=$this->db->get();
			return $result->result_array();
		}

		function interview_report_fetch($data){			
			$this->db->select('interview_manager.*,interview_candidate_records.*');
			$this->db->from('interview_manager');
			$this->db->join('interview_candidate_records','interview_manager.intw_can_id=interview_candidate_records.intw_can_id');
			$this->db->where('interview_manager.created_on >=', $data['from_date']);
			$this->db->where('interview_manager.created_on <=', $data['to_date']);
			if($data['interview_status']!="" ){
				$this->db->where('interview_manager.interview_status',$data['interview_status']);
			}
			if($data['interview_status']=="upcoming_interviews"){

				$this->db->or_where('interview_candidate_records.schedule_date >=', $data['from_date']);
				$this->db->where('interview_candidate_records.schedule_date <=', $data['to_date']);
			}
			if($data['interview_status']=="upcoming_joining"){
				$this->db->or_where('interview_manager.joining_date >=', $data['from_date']);
				$this->db->where('interview_manager.joining_date <=', $data['to_date']);
				$this->db->where('interview_manager.interview_status','selected');
			}
			if(is_numeric($data['created_by'])){
				$this->db->where('interview_candidate_records.created_by=',$data['created_by']);
			}
			
			// $this->db->get();
			// return $this->db->last_query();
			$query = $this->db->get();
			return($query->result_array());
		}

		function get_reporting($can_id){
			$this->db->select('can_id,can_name');
			$this->db->where('reporting_to',$can_id);
			$query=$this->db->get('candidate');
			return($query->result_array());
		}
		function update_count($int_task_id)
		{
			$this->db->where('int_task_id',$int_task_id);
			$this->db->set('count','count+1', FALSE);
			$this->db->update('interview_task');
			// x_debug($this->db->last_query());
		}
	}
?>