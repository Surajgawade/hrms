<?php
/**
* 
*/
class Rpo_manager_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		get_active_db();
	}

	function get_data()
	{
		$this->db->select('client_id,client_name');
		$result= $this->db->get('rpo_client_details');
		return $result->result_array();
	}

	function get_rpocan_salary_details($rpo_sal_id)
	{
		$this->db->select('c.can_id, c.can_name, c.joining_date, e.*');    
		$this->db->from('candidate c');
		$this->db->join('rpoemp_salary_details e', 'c.can_id = e.can_id');
		$this->db->where('e.is_deleted',0);
		$this->db->where('e.rpo_sal_id',$rpo_sal_id);
		$this->db->order_by('e.rpo_sal_id','desc');
		$this->db->limit(1);
		return $query = $this->db->get()->row();
	}

	function generate_salary_slip($salary_slip_data)
	{
		if($salary_slip_data['rpo_sal_id'] > 0)
		{
			$this->db->where('rpo_sal_id',$salary_slip_data['rpo_sal_id']);
			return $this->db->update('rpoemp_salary_slip',$salary_slip_data);
		}
		else
		{
			$this->db->insert('rpoemp_salary_slip', $salary_slip_data);
			return $this->db->insert_id();
		}   
	}

	function get_salary_slip_details($rpo_sal_id)
	{
		$this->db->select('rpo_can.can_name,rpo_can.joining_date,rpo_can.designation,rpo_can.department,rpo_billing.*,rpoemp_salary_slip.*');
		$this->db->from('rpoemp_salary_slip');
		$this->db->join('rpo_candidates rpo_can', 'rpo_can.can_id = rpoemp_salary_slip.can_id');
		$this->db->join('rpo_billing', 'rpo_billing.can_id = rpoemp_salary_slip.can_id');
		$this->db->where(array('rpoemp_salary_slip.rpo_sal_id' => $rpo_sal_id,'rpoemp_salary_slip.is_deleted' => 0));
		return $this->db->get()->row();
	}

	function update_password($data_array)
	{
		$this->db->set('password',$data_array['password']);
		$this->db->where('email_id', $data_array['email']);
		return $this->db->update('rpo_candidates');
	}

}

?>