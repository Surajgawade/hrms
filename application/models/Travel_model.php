<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once( APPPATH . 'models/entities/travel' . EXT );

class Travel_model extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            get_active_db();
            // Your own constructor code
    }

    
    function insert_rec($insert_arr)
    {
        $this->db->insert('candidate',$insert_arr);
        return $this->db->insert_id();
    }

    function check_email_availability($email)
    {
        return $this->db->get_where('candidate',array('email' =>$email))->num_rows();
    }

    function get_by_id($id)
    {
    	return $this->db->get_where('candidate',array('can_id' =>$id))->row();
    }

    function save_candidate_details($candidate_details)
    {
        $this->db->set('can_name',$candidate_details->can_name);
        $this->db->set('cur_address',$candidate_details->cur_address);
        $this->db->set('per_address',$candidate_details->per_address);
        $this->db->set('email',$candidate_details->email);
        $this->db->set('dob',$candidate_details->dob);
        $this->db->set('phone1',$candidate_details->phone1);
        $this->db->set('phone2',$candidate_details->phone2);
        $this->db->set('education',$candidate_details->education);
        $this->db->set('job_profile',$candidate_details->job_profile);
        $this->db->set('current_ctc',$candidate_details->current_ctc);
        $this->db->set('expected_ctc',$candidate_details->expected_ctc);
        $this->db->set('emer_contact_name',$candidate_details->emer_contact_name);
        $this->db->set('emer_contact_no',$candidate_details->emer_contact_no);
        $this->db->set('aadhar_no',$candidate_details->aadhar_no);
        $this->db->set('pan_no',$candidate_details->pan_no);
        $this->db->set('blood_group',$candidate_details->blood_group);
        $this->db->set('ready_to_relocate',$candidate_details->ready_to_relocate);
        $this->db->set('reporting_to',$candidate_details->reporting_to);
        $this->db->where("can_id",$candidate_details->can_id);
            if($this->db->update("candidate"))       
                return $candidate_details->can_id;
        // $canarr = (array) $candidate_details;
        // $this->db->where('can_id', $candidate_details->can_id);
        // $this->db->update('candidate',$canarr);
    }

    function delete_candidate($can_id)
    {
        $this->db->set('is_deleted',1);
        $this->db->where('can_id', $can_id);
        return $this->db->update('candidate');
    }

    function get_candidate_bank_details($can_id)
    {
        $this->db->select('bank_details.*,candidate.can_name');
        $this->db->from('bank_details');
        $this->db->join('candidate', 'candidate.can_id = bank_details.can_id','LEFT');
        $this->db->where('candidate.can_id',$can_id);
         // $this->db->get()->row();
         // echo $this->db->last_query();exit;
        return $this->db->get()->row();
    }
    function get_candidate_name_by_id($can_id)
    {
        $this->db->select('can_name');
        $this->db->where('can_id',$can_id);
        return $this->db->get('candidate')->row();
    }

    function save_bank_details($bank_details)
    {
        $bank = (array) $bank_details;        
        if($bank_details->bd_id > 0)
        {
            $this->db->where('bd_id', $bank_details->bd_id);
            $this->db->update('bank_details',$bank);
            return $candidate_details->bd_id;
        }
        else
        {
            $this->db->insert('bank_details',$bank);
             return $this->db->insert_id();
        }         
    }

    function upload_document($documents)
    {
        // x_debug($documents);
        $this->db->insert('travel_document',$documents);
         return $this->db->insert_id();
    }

    function get_all_documents($tv_id)
    {
        return $this->db->get_where('travel_document',array('tv_id' => $tv_id,'is_deleted'=> 0))->result();
    }

    function get_all_experience($can_id)
    {
        return $this->db->get_where('experience',array('can_id' => $can_id,'is_deleted'=> 0))->result();
    }
   
    function add_experience($experience_details)
    {
        if($experience_details->exp_id>0)
        {
            $this->db->set('company_name',$experience_details->company_name);
            $this->db->set('working_from',$experience_details->working_from);
            $this->db->set('working_to',$experience_details->working_to);
            $this->db->set('designation',$experience_details->designation);
            $this->db->set('responsibilities',$experience_details->responsibilities);
            $this->db->set('leaving_reason',$experience_details->leaving_reason);
            $this->db->where("exp_id",$experience_details->exp_id);
            if($this->db->update("experience"))
            {           
                return $experience_details->exp_id;
            }
        }
        else
        {
            $data = (array) $experience_details;
            $this->db->insert('experience',$data);
            return $this->db->insert_id(); 
        }
        
    }

    function get_billing_details($can_id)
    {
        return $this->db->get_where('billing',array('can_id' => $can_id,'is_deleted'=> 0))->result();
    }

    function add_billing_details($billing_details)
    {
        if($billing_details->bill_id>0)
        {
            $this->db->set('rate_type',$billing_details->rate_type);
            $this->db->set('amount',$billing_details->amount);
            $this->db->set('effective_from',$billing_details->effective_from);
            $this->db->set('effective_to',$billing_details->effective_to);
            $this->db->where("bill_id",$billing_details->bill_id);
            if($this->db->update("billing"))
            {           
                return $billing_details->bill_id;
            }
        }
        else
        {
            $data = (array) $billing_details;
            $this->db->insert('billing',$data);
            return $this->db->insert_id();   
        }
        
    }

    function get_investment_details($can_id)
    {
        return $this->db->get_where('investment',array('can_id' => $can_id,'is_deleted'=> 0))->result();
    }

    function add_investment_details($investment_details)
    {
        if($investment_details->inv_id>0)
        {
            $this->db->set('description',$investment_details->description);
            $this->db->set('amount',$investment_details->amount);
            $this->db->set('section',$investment_details->section);
            $this->db->where("inv_id",$investment_details->inv_id);
            if($this->db->update("investment"))
            {           
                return $investment_details->inv_id;
            }
        }
        else
        {
            $data = (array) $investment_details;            
            $this->db->insert('investment',$data);
            return $this->db->insert_id();
        }
    }

    function get_reference_details($can_id)
    {
        return $this->db->get_where('referance',array('can_id' => $can_id,'is_deleted'=> 0))->result();
    }

    function add_reference_details($reference_details)
    {
        if($reference_details->ref_id>0)
        {
            $this->db->set('ref_name',$reference_details->ref_name);
            $this->db->set('ref_email',$reference_details->ref_email);
            $this->db->set('ref_contact',$reference_details->ref_contact);
            $this->db->set('ref_mobile',$reference_details->ref_mobile);
            $this->db->set('ref_company',$reference_details->ref_company);
            $this->db->set('ref_experience',$reference_details->ref_experience);
            $this->db->where("ref_id",$reference_details->ref_id);
            if($this->db->update("referance"))
            {           
                return $reference_details->ref_id;
            }
        }
        else
        {
            $data = (array) $reference_details;            
            $this->db->insert('referance',$data);
            return $this->db->insert_id();
        }
    }

   /* function delete_doc($doc_id)
    {
        $this->db->set('is_deleted',1);
        $this->db->where("doc_id",$doc_id);
        $this->db->update("documents"); 
    }*/

    function edit_billing_details($bill_id)
    {
        return $this->db->get_where('billing',array('bill_id' => $bill_id))->result();
    }

    function edit_exp_details($exp_id)
    {
        return $this->db->get_where('experience',array('exp_id' => $exp_id))->result();
    }

    function edit_inv_details($inv_id)
    {
        return $this->db->get_where('investment',array('inv_id' => $inv_id))->result();
    }

    function edit_ref_details($ref_id)
    {
        return $this->db->get_where('referance',array('ref_id' => $ref_id))->result();
    }   

    function delete($tablename,$fieldname,$id)
    {
        $this->db->set('is_deleted',1);
        $this->db->where($fieldname,$id);
        $this->db->update($tablename);
    }

    function update_password($data_array)
    {
        $this->db->set('password',$data_array['password']);
        $this->db->where('email', $data_array['email']);
        return $this->db->update('candidate');
        // echo $this->db->last_query();exit;
    }

    function get_id_from_email($em)
    {
        $this->db->select('can_id');
        $this->db->from('candidate');
        $this->db->where('email',$em);        
        return $this->db->get()->row_array();
    }

    function get_travel_details($tv_id)
    {
        return $this->db->get_where('travel',array('tv_id' => $tv_id,'is_deleted'=> 0))->row();
    }

    function get_travel_doc_details($tv_id)
    {
        return $this->db->get_where('travel_document',array('tv_id' => $tv_id,'is_deleted'=> 0))->result_array();
    }

    function add_travel_details($travel_details)
    {
        if($travel_details->tv_id > 0)
        {
            $this->db->where("tv_id",$travel_details->tv_id);
            if($this->db->update("travel",$travel_details))
            {
                return $travel_details->tv_id;
            }
        }
        else
        {
            $data = (array) $travel_details;
            $this->db->insert('travel',$data);
            return $this->db->insert_id();   
        }
    }

    function add_travel_remark($remark_details)
    {
        $this->db->set('status',$remark_details->status);
        $this->db->set('remark',$remark_details->remark);
        $this->db->set('approved_date',$remark_details->approved_date);
        $this->db->where('tv_id',$remark_details->tv_id);
        if($this->db->update("travel"))
        {
            return $remark_details->tv_id;
        }
    }

    function add_travel_clearance($clearance_details)
    {
        $this->db->set('status',$clearance_details->status);
        $this->db->set('cleared_date',$clearance_details->cleared_date);
        $this->db->set('clearance_remark',$clearance_details->clearance_remark);
        $this->db->where('tv_id',$clearance_details->tv_id);
        if($this->db->update("travel"))
        {
            return $clearance_details->tv_id;
        }
    }

    function add_travel_claim($claim_details)
    {
        $this->db->set('status',$claim_details->status);
        $this->db->set('claimed_date',$claim_details->claimed_date);
        $this->db->where('tv_id',$claim_details->tv_id);
        if($this->db->update("travel"))
        {
            return $claim_details->tv_id;
        }
    }
}