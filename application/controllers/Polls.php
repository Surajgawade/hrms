<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

   /* @property voting_model $voting */
   class Polls extends My_Controller
   {

      function __construct()
      {
         parent::__construct();
         // $this->load->language('voting');
         $this->load->model('voting_model', 'voting');
         $this->load->model('common_model');
         $this->load->library('form_validation');
         $this->form_validation->set_error_delimiters("<span class='notification-input ni-error'>", "</span>");
         $this->load->model('voting_counter_model', 'voting_counter');
      }

      function index()
      {
         $this->votes_list();
      }

      function votes_list()
      {
         $this->content->categories = $this->common_model->get_data_array('ci_voting');
         $this->load_view('votes_list','HRMS - Poll List', $this->content);
      }

      function poll_list()
      {
         $this->datatables->unset_column('dv_id');
         $this->datatables->select('dv_id,dv_title, dv_state,created_on,CASE WHEN dv_state = 1 THEN \'Yes\' ELSE \'No\' END AS is_active');
         $this->datatables->from('ci_voting');

         $update_url = site_url().'/polls/edit/$1';
         $this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn-success btn btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="remove($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_delete" ><span class="glyphicon glyphicon-trash"></span></a>', 'dv_id');
         $result= $this->datatables->generate();
         // $lst_qry = $this->db->last_query();
         // file_put_contents('/tmp/test1.txt', $lst_qry. "\n\n", FILE_APPEND); 
         echo $result;
      }

      function create()
      {
         $this->form_validation->set_error_delimiters('<div class="error_msg">', '</div>');
         $this->form_validation->set_rules('dv_title', $this->lang->line('dv_title'), 'trim|required');
         $this->form_validation->set_rules('fields[]', $this->lang->line('fields'), 'required');
         $this->content->dv_title=$this->input->post('dv_title',TRUE);
         $this->content->fields=$this->input->post('fields',TRUE);

         if ($this->form_validation->run() == false)
         {
            $this->load_view('voting_new','Hrms- Create Poll',$this->content);
         }
         else
         {
            $fields = $this->input->post('fields');
            $orderd_data = $this->array_combine2($fields);
            $orderd_data['dv_title']=$this->input->post('dv_title',TRUE);
            $orderd_data['dv_created']=strtotime(date('Y-m-d'));
            $orderd_data=set_log_fields($orderd_data,'insert');
            $this->common_model->insert('ci_voting',$orderd_data);
            $this->session->set_flashdata('success_msg', 'Poll Successfully Created');
            redirect('polls/votes_list/');
         }
      }

      public function edit($id)
      {
         $data['vote'] = (object)$this->common_model->get_data('ci_voting',array('dv_id'=>$id));
         $columns = $this->common_model->get_data('ci_voting',array('dv_id'=>$id),'A,B,C,D,E,F,G,H,I,J');
         $data['columns'] = array_filter($columns);
         $vote = $this->common_model->count_all('ci_voting_counter',array('v_voting_id'=>$id));

         $this->content->vote=$data['vote'];
         $this->content->columns=$data['columns'];
         $data['columns'] = array_filter($columns);
         // print_r($this->content->vote);
         //  exit;  
         // x_debug($data);
         if (!empty($vote))
         {
            $this->session->set_flashdata('warning', 'sorry,you cant edit live vote');
            redirect('polls/votes_list/');
         }
         $this->form_validation->set_rules('dv_title', $this->lang->line('dv_title'), 'trim|required');
         if ($this->form_validation->run() == false)
         {
            $this->load_view('voting_edit','Edit Vote', $this->content);
         }
         else
         {
            $fields = $this->input->post('fields');
            $orderd_data = $this->array_combine2($fields);
            $this->voting->update($orderd_data, $id);
            $this->session->set_flashdata('success_msg', 'Vote Succesfully edit');
            redirect('polls/votes_list/');
         }
      }

      function array_combine2($arr2)
      {
         $filter_arr2 = array_filter($arr2);
         $arr1 = range('A', 'z');
         $count = min(count($arr1), count($filter_arr2));
         return array_combine(array_slice($arr1, 0, $count), array_slice($filter_arr2, 0, $count));
      }

      public function remove($id)
      {
         $this->common_model->update('ci_voting',array('is_active'=>0,'dv_state'=>0),array('dv_id'=>$id));
         $this->session->set_flashdata('success_msg', 'Vote successfully removed');
         echo '1';
      }

      public function activate($id)
      {
         $this->common_model->update('ci_voting',array('is_active'=>1,'dv_state'=>1),array('dv_id'=>$id));
         $this->session->set_flashdata('success_msg', 'Vote successfully activated');
         echo '1';
      }

      function activate_vote($id)
      {
         $this->voting->active($id);
         $this->session->set_flashdata('success_msg', '1 new category activated!');
         redirect('admin_voting/votes_list/');
      }

      /**
      * This function deactivate voting then redirect to votes_list
      * @example id=1
      * @param integer $id
      */
      function deactivate_vote($id)
      {
         $this->voting->deactivate($id);
         $this->session->set_flashdata('success_msg', '1 new category deactivated!');
         redirect('admin_voting/votes_list/');
      }


      public function vote_page()
      {
         $data['votes'] = $this->common_model->get_data_array('ci_voting',array('dv_state'=>1));
         $columns = $this->voting_counter->get_all_columns_active();
         foreach ($data['votes'] as $key => $value)
         {
            $data['votes'][$key]['columns']=(array)$this->voting_counter->get_all_columns_active($value['dv_id']);
         }
         $this->content->votes=$data['votes'];
         $this->load_view('vote_page','HRMS - Live Polls',$this->content);
      }


      public function vote_page_dashboard($id='',$pointer='')
      {
         if(!empty($id))
         {
            if($pointer=='previous')
            {
               $data['votes'] = $this->common_model->get_data_array_order_by('ci_voting',array('dv_id < '=>$id,'dv_state'=>1),'','',1);  
            }
            else
            {
               $data['votes'] = $this->common_model->get_data_array_order_by('ci_voting',array('dv_id >'=>$id,'dv_state'=>1),'','',1);   
            } 
         }
         else
         {
            $data['votes'] = $this->common_model->get_data_array_order_by('ci_voting',array('dv_state'=>1),'',array('dv_id'  ,'desc'),1);
            // $data['vote_count'] = $this->common_model->get_votes();
            // print_r('ther');
            // exit;
         }
         $columns = $this->voting_counter->get_all_columns_active();
         foreach ($data['votes'] as $key => $value)
         {
            $data['votes'][$key]['columns']=(array)$this->voting_counter->get_all_columns_active($value['dv_id']);
            $data['found_ip'] = $this->voting_counter->check_ip($value['dv_id'], get_login_user_id());

         }
         //$this->content->votes=$data['votes'];
         // x_debug($data);
         $output=$this->load->view('poll/vote_page_dashboard', $data,true);
         if(!empty($id))
         {
            echo json_encode(array('output'=>$output,'data'=>count($data['votes'])));
         }
         else
         {
            echo $output;
         }
      }

      public function voted($id)
      {
         $user_id = get_login_user_id();
         $v_column = $this->input->post('v_column');
         if (!empty($v_column))
         {
            $found_ip = $this->voting_counter->check_ip($id, $user_id);
            if (empty($found_ip))
            {
               $this->voting_counter->add_vote($id, $user_id);
               $data['result'] = $this->voting_counter->result($id);
               $data['rows'] = $this->voting_counter->getNumVoting($id);
               $this->load->view('poll/vote_result_current', $data);
            }
            else 
            {
               $data['result'] = $this->voting_counter->result($id);
               $data['rows'] = $this->voting_counter->getNumVoting($id);
               echo $this->load->view('poll/vote_result_current', $data);
            }
         }
      }

      private function load_view($viewname= "blank_page",$page_title)
      {
         $this->content->meta_description="Meta meta_description here!";
         $this->content->meta_keywords="meta keywords here!";
         $this->masterpage->setMasterPage('master');
         $this->content->page_description = "";
         $this->masterpage->setPageTitle($page_title);
         $this->masterpage->addContentPage('poll/'.$viewname,'content',$this->content);
         $this->masterpage->show();
      }
   }