<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hrpolicy extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('common_model');
        $this->load->model('Hrpolicy_model','hrpolicy');
        $userdata = $this->session->userdata('logged_in_user');
        if(!$userdata){
            $newURL = site_url()."/login";
            header('Location: '.$newURL);        		
        }        
    }
    private function load_view($viewname= "blank_page",$page_title){
        $this->content->meta_description="Meta meta_description here!";
        $this->content->meta_keywords="meta keywords here!";
        $this->masterpage->setMasterPage('master');
        $this->content->page_description = "";
        $this->masterpage->setPageTitle($page_title);
        $this->masterpage->addContentPage('hrpolicy/'.$viewname,'content',$this->content);
        $this->masterpage->show();
    }
	public function index()
	{

        $this->load_view("home","HRMS - HR-Policy",$this->content); 
  }
  public function policy_list($msg="")
  {  
         $this->content->hr_policy_dtls = $this->hrpolicy->get_hrpolicy_dtls();
         $this->load_view("policy_list","HRMS - HR Policy List",$this->content); 
  }
   public function insert_hr_policy($msg="")
  {  
         $this->hrpolicy->hrpolicy_insert();
        
         $url = site_url().'/hrpolicy/policy_list';
            redirect($url);
  }

    function upload_document()
    {
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
        {
            $upload_path = UPLOADPATH."hr_doc/"; //set your folder path
            if(!is_dir($upload_path))
            {
               mkdir($upload_path , 777,true);
            }

          /*  echo $can_doc_path = "/var/www/html/hrms/uploads/".$can_id."/";
            if( ! is_dir($can_doc_path)){
                mkdir($can_doc_path, 0777, true);
            }*/
            //set the valid file extensions 
            $valid_formats = array("pdf"); //add the formats you want to upload
         // var_dump($_FILES);
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
                        $file_name = $_POST['filename'];
                        $particular = $this->input->post('particular', true);
                         $todate = date_to_db($_POST['todate']);//get the file name
                        $tmp = $_FILES['myfile']['tmp_name'];
                        if (move_uploaded_file($tmp, $upload_path . time().$file_name.'.'.$ext))
                        { 
                            //check if it the file move successfully, then insert into database
                            $data  = array('particular' => $particular,'doc_upload_date' => $todate,'doc_path'=>time().$file_name.'.'.$ext);
                            // x_debug($data);
                            //$data=set_log_fields($data,'insert');
                            
                            $this->hrpolicy->hrpolicy_insert($data);
                            //$this->common_model->insert('hrpolicy',$data);                 
                            // print_r($result);exit;
                           // echo  json_encode(array("result"=>$result,"msg"=>"File uploaded successfully!"));                         
                           echo "1";
                        } 
                        else
                        {
                            echo "2";
                        }
                    }
                    else
                    {
                        echo "3";
                    }
                }
                else
                {
                    echo "4";
                }
            }
            else
            {
                echo "Please select a file..!";
            }
            exit;
        }        
    }
}
  