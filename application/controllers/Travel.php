<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Travel extends My_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('travel_model');
        $this->load->model('candidate_model');
        $this->load->model('common_model','common');
        // $logged_in = $this->session->userdata['logged_in'];
        $userdata = $this->session->userdata('logged_in_user');
        if(!$userdata){
            $newURL = site_url()."/login";
            header('Location: '.$newURL);               
        }        
    }

    public function index($msg="")
    {
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
        $this->load_view("travel_view","HRMS - Travel List",$this->content);        
    }


    function get_candidate_name_by_id($can_id)
    {
       return $this->candidate_model->get_candidate_name_by_id($can_id); 
    }

    function documents()
    {
         user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
       
        $can_id = $this->uri->segment(3);
        $this->content->can_details = $this->get_candidate_name_by_id($can_id);
        // $this->content->documents = $this->candidate_model->get_all_documents($can_id);     
        $this->load_view("documents","HRMS - Employee Travel Documents",$this->content);
    }

    function tdocument_details($can_id = '', $tv_id = '')
    {
        $this->datatables->unset_column('td_id');
        $this->datatables->unset_column('tfile_name');
        $this->datatables->select('td_id,tdoc_name,tfile_name');
        $this->datatables->from('travel_document');
        $this->datatables->where('can_id',$can_id);
        $this->datatables->where('tv_id',$tv_id);
        $this->datatables->where('is_deleted',0);
        $this->datatables->add_column('edit', '<button type="button" class="tabledit-delete-button btn btn-sm btn_delete_bill" value="$1" style="float: none;" onClick="delete_data($1)"><span class="glyphicon glyphicon-trash"></span></button>', 'td_id');
        $this->datatables->add_column('ff', '<a href="'.base_url().'upload_travel_docs/'.$tv_id.'/$1" target="_blank">$1</a>', 'tfile_name');
        $result= $this->datatables->generate();  
        echo $result;
    }

    function upload_document()
    {
        $post = $this->input->post();
        $can_id = $post['can_id'];
        $tv_id = $post['tv_id'];
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
        {
            $upload_path = UPLOADTRAVEL; //set your folder path
            if(!is_dir($upload_path))
            {
               mkdir($upload_path , 777);
            }

            $can_doc_path = $upload_path.$tv_id."/";
            if( ! is_dir($can_doc_path)){
                mkdir($can_doc_path, 0766, true);
            }
            //set the valid file extensions 
            $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "GIF", "JPG", "PNG", "doc", "txt", "docx", "pdf", "xls", "xlsx"); //add the formats you want to upload
         
            $name = $_FILES['myfile']['name']; //get the name of the file            
            $size = $_FILES['myfile']['size']; //get the size of the file         
            if (strlen($name))
            { 
                //check if the file is selected or cancelled after pressing the browse button.
                list($txt, $ext) = explode(".", $name); //extract the name and extension of the file
                if (in_array($ext, $valid_formats))
                { 
                    //if the file is valid go on.
                    if ($size < 2098888)
                    {
                        // check if the file size is more than 2 mb
                        $file_name = $_POST['filename']; //get the file name
                        $tmp = $_FILES['myfile']['tmp_name'];
                        if (move_uploaded_file($tmp, $can_doc_path . time().$file_name.'.'.$ext))
                        { 
                            //check if it the file move successfully, then insert into database
                            $data  = array('can_id' => $can_id, 'tv_id' => $tv_id, 'tdoc_name' => $file_name,'tfile_name'=>time().$file_name.'.'.$ext,'tdoc_path' => $can_doc_path,'tthumb_path'=>$can_doc_path);
                            $this->travel_model->upload_document($data);                            
                            $result = $this->travel_model->get_all_documents($tv_id);
                            // print_r($result);exit;
                            echo json_encode(array("result"=>$result,"msg"=>"File uploaded successfully!"));
                            // echo "File uploaded successfully!!";
                        } 
                        else
                        {
                            // echo "failed";
                            echo json_encode(array("result"=>FALSE,"msg"=>"Failed"));
                        }
                    }
                    else
                    {
                        // echo "File size max 2 MB";
                        echo json_encode(array("result"=>FALSE,"msg"=>"File size max 2 MB"));
                    }
                }
                else
                {
                    // echo "Invalid file format..";
                    echo json_encode(array("result"=>FALSE,"msg"=>"Invalid file format.."));
                }
            }
            else
            {
                // echo "Please select a file..!";
                echo json_encode(array("result"=>FALSE,"msg"=>"Please select a file..!"));
            }
            exit;
        }        
    }

    function delete_doc()
    {

        // var_dump($_POST);
        if ($this->input->is_ajax_request())
        {
            $doc_id = $this->input->post('doc_id');
            // var_dump($doc_id);
            $this->travel_model->delete($tablename='travel_document',$fieldname ='td_id',$doc_id);
        }
    }   

    function add_travel()
    {
         user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
       
        $userdata = $this->session->userdata('logged_in_user');
        $can_id = $userdata['id'];
        $trv_id = $this->uri->segment(4);
        $this->content->can_details = $this->get_candidate_name_by_id($can_id);
        $this->content->travel_details = $this->travel_model->get_travel_details($trv_id);
        $this->load_view("add_travel","HRMS - Employee Travel Details",$this->content);
    }

    function add_travel_details()
    {
        $userdata = $this->session->userdata('logged_in_user');

        if ($this->input->is_ajax_request())
        {
            $post = $this->input->post();
            $travel_details = new Travel_Entity();
            $post['from_date'] = date_to_db($post['from_date']);
            $post['to_date'] = date_to_db($post['to_date']);
            $travel_details->can_id = $userdata['id'];
            if(!empty($post['tv_id']))
                $travel_details->tv_id = $post['tv_id'];
            $travel_details->purpose = $post['purpose'];
            $travel_details->budget = $post['budget'];
            $travel_details->location = $post['location'];
            $from_date = date_create($post['from_date']);
            $to_date = date_create($post['to_date']);
            $diff = date_diff($from_date,$to_date);
            $d = $diff->format("%R%a");
            $travel_details->days = ++$d;
            $travel_details->status = 'raised';
            $travel_details->raised_date = date('Y-m-d');
            $travel_details->from_date = $post['from_date'];//date('Y-m-d', strtotime(str_replace('/', '-', $post['from_date'])));
            $travel_details->to_date = $post['to_date'];//date('Y-m-d', strtotime(str_replace('/', '-', $post['from_date'])));
            $travel_details->advance = $post['advance'];
            if($post['stay_radio'] == 'N')
            {
                $travel_details->stays = 0;
            }
            else
            {
                $travel_details->stays = $post['stays'];
            }
            if($post['meal_radio'] == 'N')
            {
                $travel_details->meals = 0;
            }
            else
            {
                $travel_details->meals = $post['meals'];
            }
            if($post['snack_radio'] == 'N')
            {
                $travel_details->snacks = 0;
            }
            else
            {
                $travel_details->snacks = $post['snacks'];
            }
            $travel_details->transport_mode = $post['transport_mode'];
            $travel_details->other_transport = $post['other_transport'];
            $travel_details->details = $post['details'];
            //$travel_details=set_log_fields($travel_details,'insert');
            $result = $this->travel_model->add_travel_details($travel_details);
            user_activity_log($data = array('can_id' => get_login_user_id(), 'table_name' => 'travel' ,"operation_name" => 'insert' ,'last_modified_on'=> date('Y-m-d h:i:s'),'last_modified_by' => get_login_user_id(),'comment' => 'Added new travel'));

            // $result = $this->travel_model->get_travel_details($post['can_id']);
            echo json_encode(array("result"=>$result,"msg"=>"Travel details saved successfully!"));
        }
    }

    function travel()
    {
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
        $userdata = $this->session->userdata('logged_in_user');
        $this->content->can_details = $this->get_candidate_name_by_id($userdata['id']);
        $this->load_view("travel","HRMS - Employee Travel Details",$this->content);
    }

    function travel_details()
    {
        $userdata = $this->session->userdata('logged_in_user');
        // $this->content->can_details = $this->get_candidate_name_by_id($userdata['id']);
        $this->datatables->unset_column('travel.tv_id');
        $this->datatables->select('travel.tv_id,candidate.can_name,travel.from_date,travel.to_date,travel.purpose,travel.status,travel.budget');
        // If(status = "raised", "Enable", "Disabled") as status
        $this->datatables->from('travel');
        $this->datatables->join('candidate', 'candidate.can_id = travel.can_id', 'LEFT');
        $this->datatables->where('travel.is_deleted',0);
        $this->datatables->order_by('travel.tv_id','desc');
        // $this->datatables->add_column('edit', '$1', $this->checkStatus('travel.status', 'tv_id'));
        // $this->datatables->add_column('edit', 'callback_checkStatus(travel.status, tv_id)', 'tv_id');
        $this->datatables->add_column('edit', '<a href="'.site_url().'/travel/add_travel/'.$userdata['id'].'/$1" class="tabledit-edit-button btn btn-sm btn_edit_bill" value="$1" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></a><button type="button" class="tabledit-delete-button btn btn-sm btn_delete_bill" value="$1" style="float: none;" onClick="delete_data($1)"><span class="glyphicon glyphicon-trash"></span></button>', 'tv_id');
        $result= $this->datatables->generate();
        echo $result;
    }

    function approval_details()
    {
        $this->datatables->unset_column('travel.tv_id');
        $this->datatables->select('travel.tv_id,candidate.can_name,travel.from_date,travel.to_date,travel.purpose,travel.status,travel.budget');
        $this->datatables->from('travel');
        $this->datatables->join('candidate', 'candidate.can_id = travel.can_id', 'LEFT');
        $this->datatables->where('travel.is_deleted',0);
        $this->datatables->where('travel.status','raised');
        $this->datatables->order_by('travel.tv_id','desc');
        $this->datatables->add_column('edit', '<a href="'.site_url().'/travel/travel_approval/$1" class="tabledit-edit-button btn btn-sm btn_edit_bill" value="$1" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></a><button type="button" class="tabledit-delete-button btn btn-sm btn_delete_bill" value="$1" style="float: none;" onClick="delete_data($1)"><span class="glyphicon glyphicon-trash"></span></button>', 'tv_id');
        $result= $this->datatables->generate();
        echo $result;
    }

    function checkStatus($stat = NULL, $id = NULL)
    {
        if($stat == 'raised')
        {
            return '<button type="button" class="tabledit-edit-button btn btn-sm btn_edit_bill" value="$1" style="float: none;" onClick="fill_data($1)"><span class="glyphicon glyphicon-pencil"></span></button><button type="button" class="tabledit-delete-button btn btn-sm btn_delete_bill" value="$1" style="float: none;" onClick="delete_data($1)"><span class="glyphicon glyphicon-trash"></span></button>';
        }
        else
        {
            return '<button type="button" class="tabledit-edit-button btn btn-sm btn_edit_bill" value="$1" style="float: none;" disabled><span class="glyphicon glyphicon-pencil"></span></button><button type="button" class="tabledit-delete-button btn btn-sm btn_delete_bill" value="$1" style="float: none;" disabled><span class="glyphicon glyphicon-trash"></span></button>';
        }
    }

    function delete_travel()
    {
        if ($this->input->is_ajax_request())
        {
            $tv_id = $this->input->post('tv_id');
            $this->travel_model->delete($tablename='travel',$fieldname ='tv_id',$tv_id);
        }
    }

    function travel_approval()
    {
        user_access_operation($this->router->fetch_class(),$this->router->fetch_method());
        
        $trv_id = $this->uri->segment(3);
        $this->content->travel_details = $this->travel_model->get_travel_details($trv_id);
        $this->content->can_details = $this->get_candidate_name_by_id($this->content->travel_details->can_id);
        // var_dump($this->content->travel_details);
        $this->load_view("approval_form","HRMS - Employee Travel Approval",$this->content);
    }

    function travel_particular($trv_id = '')
    {
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
        
        $this->content->travel_details = $this->travel_model->get_travel_details($trv_id);
        $this->content->can_details = $this->get_candidate_name_by_id($this->content->travel_details->can_id);
        $this->load_view("travel_particular","HRMS - Employee Travel Approval",$this->content);
    }

    function travel_clearance()
    {
        $can_id = $this->uri->segment(3);
        $trv_id = $this->uri->segment(4);
        $this->content->can_details = $this->get_candidate_name_by_id($can_id);
        $this->content->travel_details = $this->travel_model->get_travel_details($trv_id);
        $this->load_view("travel_clearance","HRMS - Employee Travel Approval",$this->content);
    }
   
    private function load_view($viewname= "blank_page",$page_title)
    {
        $this->content->meta_description="Meta meta_description here!";
        $this->content->meta_keywords="meta keywords here!";
        $this->masterpage->setMasterPage('master');
        $this->content->page_description = "";
        $this->masterpage->setPageTitle($page_title);
        $this->masterpage->addContentPage('travel/'.$viewname,'content',$this->content);
        $this->masterpage->show();
    }

    function add_travel_remark()
    {
        $post = $this->input->post();
        $remark_details = $this->travel_model->get_travel_details($post['tv_id']);
        $remark_details->tv_id = $post['tv_id'];
        $remark_details->can_id = $post['can_id'];
        $remark_details->remark = $post['remark'];
        $remark_details->status = $post['status'];
        $remark_details->approved_date = date('Y-m-d');
        $result = $this->travel_model->add_travel_remark($remark_details);
        // $result = $this->travel_model->get_travel_details($post['can_id']);
        echo json_encode(array("result"=>$result,"msg"=>"Travel Remark saved successfully!"));
    }

    function add_travel_clearance()
    {
        $post = $this->input->post();
        $clearance_details = $this->travel_model->get_travel_details($post['tv_id']);
        $clearance_details->tv_id = $post['tv_id'];
        $clearance_details->can_id = $post['can_id'];
        $clearance_details->clearance_remark = $post['clearance_remark'];
        // var_dump($post);
        if($post['status'] == 'approved')
        {
            $clearance_details->status = 'cleared';
            $clearance_details->cleared_date = date('Y-m-d');
        }
        else
        {
            $clearance_details->status = 'approved';
            $clearance_details->cleared_date = NULL;
        }
        // var_dump($clearance_details);
        $result = $this->travel_model->add_travel_clearance($clearance_details);
        echo json_encode(array("result"=>$result,"msg"=>"Travel Cleared successfully!"));
    }

    function clearance()
    {
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
        $userdata = $this->session->userdata('logged_in_user');
        $this->content->can_details = $this->get_candidate_name_by_id($userdata['id']);
        $this->load_view("clearance","HRMS - Employee Travel Details",$this->content);
    }

    function clearance_details()
    {
        $this->datatables->unset_column('travel.tv_id');
        $this->datatables->select('travel.tv_id,candidate.can_name,travel.from_date,travel.to_date,travel.purpose,travel.status,travel.budget');
        $this->datatables->from('travel');
        $this->datatables->join('candidate', 'candidate.can_id = travel.can_id', 'LEFT');
        $this->datatables->where('travel.is_deleted',0);
        $this->datatables->where('travel.status','claimed');
        $this->datatables->order_by('travel.tv_id','desc');
        $this->datatables->add_column('edit', '<a href="'.site_url().'/travel/clearance_show/$1" class="tabledit-edit-button btn btn-sm btn_edit_bill" value="$1" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></a><button type="button" class="tabledit-delete-button btn btn-sm btn_delete_bill" value="$1" style="float: none;" onClick="delete_data($1)"><span class="glyphicon glyphicon-trash"></span></button>', 'tv_id');
        $result= $this->datatables->generate();
        echo $result;
    }

    function clearance_show($id = '')
    {
         user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
       
        $this->content->travel_details = $this->travel_model->get_travel_details($id);
        $this->content->travel_doc_details = $this->travel_model->get_travel_doc_details($id);
        $this->content->can_details = $this->get_candidate_name_by_id($this->content->travel_details->can_id);
        $this->load_view("clearance_view","HRMS - Employee Travel Clearance",$this->content);
    }

    function bill_upload()
    {
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());   
        $userdata = $this->session->userdata('logged_in_user');
        $this->content->can_details = $this->get_candidate_name_by_id($userdata['id']);
        $this->load_view("bill_upload","HRMS - Employee Travel Details",$this->content);
    }

    function bill_details()
    {
        $this->datatables->unset_column('travel.tv_id');
        $this->datatables->select('travel.tv_id,candidate.can_name,travel.from_date,travel.to_date,travel.purpose,travel.status,travel.budget');
        $this->datatables->from('travel');
        $this->datatables->join('candidate', 'candidate.can_id = travel.can_id', 'LEFT');
        $this->datatables->where('travel.is_deleted',0);
        $this->datatables->where('travel.status','approved');
        // $this->datatables->or_where('travel.status','claimed');
        $this->datatables->order_by('travel.tv_id','desc');
        $this->datatables->add_column('edit', '<a href="'.site_url().'/travel/travel_particular/$1" class="tabledit-edit-button btn btn-sm btn_edit_bill" value="$1" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></a><button type="button" class="tabledit-delete-button btn btn-sm btn_delete_bill" value="$1" style="float: none;" onClick="delete_data($1)"><span class="glyphicon glyphicon-trash"></span></button>', 'tv_id');
        $result= $this->datatables->generate();
        echo $result;
    }

    function add_travel_claim()
    {
        $post = $this->input->post();
        $clearance_details = $this->travel_model->get_travel_details($post['tv_id']);
        $clearance_details->tv_id = $post['tv_id'];
        $clearance_details->status = $post['status'];
        $clearance_details->claimed_date = date('Y-m-d');
        $result = $this->travel_model->add_travel_claim($clearance_details);
        echo json_encode(array("result"=>$result,"msg"=>"Travel Cleared successfully!"));
    }
}
