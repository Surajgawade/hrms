<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class News extends My_Controller {

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
        $this->load->model('candidate_model');
        $this->load->model('news_model');
        $this->load->model('common_model','common');

        $userdata = $this->session->userdata('logged_in_user');
        if(!$userdata){
            $newURL = site_url()."/login";
            header('Location: '.$newURL);               
        } 
    }

    public function index($msg=""){
        user_access_page($this->router->fetch_class(),$this->router->fetch_method());
        $this->load_view("news_list","HRMS - News List",$this->content);
    }

    private function load_view($viewname= "blank_page",$page_title){
        $this->content->meta_description="Meta meta_description here!";
        $this->content->meta_keywords="meta keywords here!";
        $this->masterpage->setMasterPage('master');
        $this->content->page_description = "";
        $this->masterpage->setPageTitle($page_title);
        $this->masterpage->addContentPage('news/'.$viewname,'content',$this->content);
        $this->masterpage->show();
    }

    function list_news()
    {  
        $this->datatables->unset_column('nw_id');
        $this->datatables->select('nw_id,nw_title,DATE_FORMAT(publish_date, "%d-%m-%Y %h:%i %p") AS publish_date');
        $this->datatables->from('news');
        $this->datatables->where('is_deleted',0);
        $this->datatables->order_by('created_on','DESC');
        $update_url = site_url().'/news/update/$1';
        $view_url=site_url().'/news/view/$1';

        $this->datatables->add_column('edit', '<a href="'.$update_url.'" class="tabledit-edit-button btn btn-success btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="javascript:;" onClick="delete_news($1)"  class="tabledit-delete-button btn-danger btn btn-sm btn_edit" ><span class="glyphicon glyphicon-trash"></span></a>
            <a href="'.$view_url.'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>', 'nw_id');    
        $result= $this->datatables->generate();  
        echo $result;
    }  

    function read_news()
    {
        $this->load_view("read_news","HRMS - News List",$this->content);
    }

    public function update()
    {
        user_access_operation($this->router->fetch_class(),$this->router->fetch_method());  
        $userdata = $this->session->userdata('logged_in_user');
        $nw_id = $this->uri->segment(3);
        $this->content->news_details = $this->news_model->get_news_data($nw_id);
        // var_dump($this->content->news_details);exit();
        if(!empty($_POST))
        {
            $post = $this->input->post();
            $news_details = new News_Entity();
            $news_details->nw_id = $nw_id;
            $news_details->nw_title = $post['nw_title'];
            $news_details->nw_description = $post['nw_description'];
            $news_details->nw_image = $post['nw_image'];
            $news_details->last_modified_by = $userdata['id'];;
            $news_details->last_modified_on = date('Y-m-d h:i:s');
            
            if($this->news_model->save_news($news_details))
            {
                $this->session->set_flashdata('success', 'News Updated Successfully!');
                redirect('news');
            } 
        }
        $this->load_view("create_news","HRMS - Edit News",$this->content);
    }

    public function view()
    {
        //user_access_operation($this->router->fetch_class(),$this->router->fetch_method());  
        $userdata = $this->session->userdata('logged_in_user');
        $nw_id = $this->uri->segment(3);
        $this->content->news_details = $this->news_model->get_news_data($nw_id);
         if(!empty($_POST))
        {
            $post = $this->input->post();
            $news_details = new News_Entity();
            $news_details->nw_id = $nw_id;
            $news_details->nw_title = $post['nw_title'];
            $news_details->nw_description = $post['nw_description'];
            $news_details->last_modified_by=$userdata['id'];;
            $news_details->last_modified_on=date('Y-m-d h:i:s');
        }
        $this->load_view("read_news","HRMS - News",$this->content);
    }

    public function create_news(){
        user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
        $this->load_view("create_news","HRMS - Add News",$this->content);
    }

    function delete_news(){
        $access=user_access_operation($this->router->fetch_class(),$this->router->fetch_method(),true);
        echo($access);
        if(!empty($access))
        {
            $this->session->set_flashdata('access_denied', 'Access Denied');
            echo '0';
        }
        else
        { 
            $nw_id = $this->input->post('nw_id');
            $id  = $this->news_model->delete($tablename='news',$fieldname='nw_id',$nw_id);
            echo '1';
            
        }
    }

    public function save_news(){
        $userdata = $this->session->userdata('logged_in_user');
        $old_image = $this->input->post('old_image', true);
        // var_dump($_POST);
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
        {   
            $image_name=$this->input->post('image_name');
            // if($image_name==""){
                 $upload_path = UPLOADPATH."newsImage/"; //set your folder path
            if(!is_dir($upload_path))
            {
               mkdir($upload_path , 0777);
            }
            //set the valid file extensions 
            $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "GIF", "JPG", "PNG"); 
         
            $name = $_FILES['nw_image']['name'];            
            $size = $_FILES['nw_image']['size'];       
            if (strlen($name))
            { 
                //check if the file is selected or cancelled after pressing the browse button.
                list($txt, $ext) = explode(".", $name); 
                if (in_array($ext, $valid_formats))
                { 
                    if ($size < 2098888)
                    {
                        // check if the file size is more than 2 mb
                        $nw_title = $_POST['nw_title']; 
                        $nw_description = $_POST['nw_description'];
                        $tmp = $_FILES['nw_image']['tmp_name'];
                        $path=$upload_path . time().'.'.$ext;
                        if (move_uploaded_file($tmp, $path) )
                        {                             
                            $news_details=new News_Entity();
                            $news_details->nw_title=$this->input->post('nw_title');
                            $news_details->image_name=time().'.'.$ext;
                            if(!empty($this->input->post('nw_id')))
                                $news_details->nw_id = $this->input->post('nw_id');
                            $news_details->nw_description=$this->input->post('nw_description');
                            $news_details->nw_image= $path;
                            $news_details->publish_status=$this->input->post('publish_status');
                            if($this->input->post('publish_status')==1){
                                $news_details->publish_date=date('Y-m-d H:i:s');
                            }else{
                                  $news_details->publish_date=NULL;
                            }
                            if(!empty($this->input->post('nw_id')) && ($this->input->post('nw_id') != 0))
                            {
                                $news_details = set_log_fields($news_details);
                                $this->common->update('news',$news_details,array('nw_id'=>$this->input->post('nw_id')));
                            }
                            else
                            {
                                $news_details = set_log_fields($news_details, 'insert');
                                $this->common->insert('news',$news_details);
                            }
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
            else if($old_image != NULL)
            {
                if($this->input->post('publish_status') == 1){
                    $publish_date = date('Y-m-d H:i:s');
                }else{
                      $publish_date = NULL;
                }
                $data  = array('nw_title' => $this->input->post('nw_title'),'nw_description' => $this->input->post('nw_description'), 'publish_status' => $this->input->post('publish_status'), 'publish_date'=>$publish_date);
                $data = set_log_fields($data);
                $res = $this->common->update('news',$data,array('nw_id'=>$this->input->post('nw_id')));
                if($res == true)
                {
                    echo "1";
                }
                else
                {
                    echo "2";
                }
            }
            else
            {
                echo "5";
            }
                
            /*}else{
                $news_details=new News_Entity();
                $news_details->nw_title=$this->input->post('nw_title');
                $news_details->nw_description=$this->input->post('nw_description');
                $news_details->image_name=$image_name;
                $news_details->publish_status=$this->input->post('publish_status');
                if($this->input->post('publish_status')==1){
                    $news_details->publish_date=date('Y-m-d h:i:s');
                }
                $news_details->last_modified_by = $userdata['id'];
                if($this->input->post('nw_id')){
                    $news_details->nw_id=$this->input->post('nw_id');
                }
                $this->news_model->update_news($news_details);                                        
                echo "1";
            }*/
            
            exit;
        }   
    }
}
?>