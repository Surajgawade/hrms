<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once( APPPATH . 'models/entities/news' . EXT );

class News_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        get_active_db();
    }

    public function get_news_list(){
    	$this->db->select('nw_id,nw_title');
    	$query=$this->db->get('news');
    	$result = $query->result_object();
    	return $result;
    }

    function get_news_data($nw_id)
    {
        return $this->db->get_where('news', array('nw_id' => $nw_id))->row();
    }

    public function update_news($news_details){
        $news=(array) $news_details;
        $this->db->set('nw_title',$news_details->nw_title);
        $this->db->set('image_name',$news_details->image_name);
        $this->db->set('nw_description',$news_details->nw_description);
        $this->db->set('nw_image',$news_details->nw_image);
        $this->db->set('publish_status',$news_details->publish_status);
        $this->db->set('publish_date',$news_details->publish_date);
        $this->db->set('last_modified_by',$news_details->last_modified_by);
        $this->db->where('nw_id', $news_details->nw_id);
        $this->db->update('news');
        return $news_details->nw_id;
    }

    public function save_news($news_details){
    	$news=(array) $news_details;

    		$this->db->set('nw_title',$news_details->nw_title);
            $this->db->set('image_name',$news_details->image_name);
            $this->db->set('nw_description',$news_details->nw_description);
            $this->db->set('nw_image',$news_details->nw_image);
            $this->db->set('publish_status',$news_details->publish_status);
            $this->db->set('publish_date',$news_details->publish_date);
            $this->db->set('created_by',$news_details->created_by);
            $this->db->set('created_on',$news_details->created_on);
            $this->db->set('last_modified_by',$news_details->last_modified_by);
            $this->db->insert('news',$news);
            return $news_details->nw_id;
    	
	}

    function delete($tablename,$fieldname,$id)
    {
        echo $tablename;
        echo $fieldname;
        echo $id;
        
        $this->db->set('is_deleted',1);
        $this->db->where($fieldname,$id);
        $this->db->update($tablename);
        return $id;
    }
}

?>
