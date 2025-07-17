<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once( APPPATH . 'models/entities/leave' . EXT );


class Leave_model extends CI_Model {

	function _construct(){
		parent::_construct();
		get_active_db();
	}

	function get_leave_list()
	{
		return $this->db->get_where('leave_type',array('is_deleted' => 0))->result();
	}

	function add_leave_type($leave_type)
	{
		if($leave_type['type_id'] > 0)
		{
			$this->db->where('type_id', $leave_type['type_id']);
			$this->db->update('leave_type',$leave_type);
			return $leave_type['type_id'];
		}
		else
		{
			$this->db->insert('leave_type',$leave_type);
      	return $this->db->insert_id();
  		}	
	}

	function get_leavetype_details($type_id)
	{
		return $this->db->get_where('leave_type',array('type_id' => $type_id))->row();
	}

	function delete($tablename,$fieldname,$id)
	{
		$this->db->set('is_deleted',1);
		$this->db->where($fieldname,$id);
		$this->db->update($tablename);
	}

	function apply_for_leave($leave_appl_details)
	{
		// $data = (array) $leave_appl_details;
		$this->db->insert('leave_application',$leave_appl_details);
   	return $this->db->insert_id();
	}

	function get_leaveappli_details($appl_id)
	{
		return $this->db->get_where('leave_application',array('appl_id'=>$appl_id))->row();
	}

	function change_appli_status($appl_id,$selected_status,$comment='')
	{
		$this->db->set('status',$selected_status);
		$this->db->set('comment',$comment);
		$this->db->where('appl_id',$appl_id);
		if($this->db->update('leave_application'))
		{
			return $this->db->get_where('leave_application',array('appl_id'=>$appl_id))->row();
		}
	}

	function can_allocate_leaves($id,$system_leaves)
	{
		$this->db->select('*');
		$this->db->where('can_id',$id);
		$query = $this->db->get('can_leave_records');
		$num = $query->num_rows();
		if($num >0)
		{	
			$this->db->set('alloted_sl',$system_leaves['SL']);
			$this->db->set('balance_sl',$system_leaves['SL']);
			$this->db->set('alloted_cl',$system_leaves['CL']);
			$this->db->set('balance_cl',$system_leaves['CL']);
			$this->db->set('alloted_pl',$system_leaves['PL']);
			$this->db->set('balance_pl',$system_leaves['PL']);
			$this->db->where('can_id',$id);
			$this->db->update('can_leave_records');
		}
		else
		{
			$data = array(
				'can_id' => $id ,
				'alloted_sl' => $system_leaves['SL'],
				'balance_sl' => $system_leaves['SL'],
				'alloted_cl' => $system_leaves['CL'],
				'balance_cl' => $system_leaves['CL'],
				'alloted_pl' => $system_leaves['PL'],
				'balance_pl' => $system_leaves['PL'],
			);
			$this->db->insert('can_leave_records',$data);
		}		
	}


/*	function can_allocate_leaves($id,$total)
	{
		$this->db->select('*');
		$this->db->where('can_id',$id);
		$query = $this->db->get('can_leave_records');
		$num = $query->num_rows();
		if($num >0)
		{	
			$this->db->set('alloted_leave',$total);
			$this->db->set('balance_leave',$total);
			$this->db->where('can_id',$id);
			$this->db->update('can_leave_records');
		}
		else
		{
			$data = array(
				'can_id' => $id ,
				'alloted_leave' => $total,
				'balance_leave' => $total 
			);
			$this->db->insert('can_leave_records',$data);
		}		
	}*/

	function get_can_leave_record($can_id)
	{ 
		return $this->db->get_where('can_leave_records',array('can_id'=> $can_id))->row();
	}

	function update_can_balance_leave($can_id,$balance_leave,$leave_cnt)
	{
		$this->db->set('balance_leave',$balance_leave - $leave_cnt);
		$this->db->where('can_id',$can_id);
		return $this->db->update('can_leave_records');
	}
	
	function get_can_leave_balance()
	{
		$this->db->select('can_leave_records.*,candidate.can_name');
		$this->db->from('can_leave_records');
		$this->db->join('candidate', 'candidate.can_id = can_leave_records.can_id','LEFT');
		// $this->db->where('candidate.can_id',$can_id);        
		// $this->db->get()->row();
		// echo $this->db->last_query();exit;
		return $this->db->get()->result();
	}

	function get_can_leaves_applications($can_id,$from_date)
	{
		$this->db->select('*');
		$this->db->from('leave_application');
		$this->db->where('from_date <=', $from_date);
		$this->db->where('to_date >=', $from_date);
		$this->db->where('can_id', $can_id);
		return $this->db->count_all_results();
		// echo $this->db->last_query();exit;
	}
}

?>
