<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct()
    {
        $this->load->model('common_model');
        get_active_db();
    }
    public function get_user_settings($id=null,$is_rpo=false)
    {
        if (!empty($id))
        {
            $user_settings='';
            $tablename='candidate';
            if($is_rpo)
            {
               $tablename='rpo_candidates';  
            }
            $user_data=$this->common_model->get_data($tablename,array('can_id'=>$id));
            // echo "<pre>";
            // print_r($user_data);
            // exit;
            if (!empty($user_data['role_id']))
            {
                $user_settings=$this->get_menu($user_data['role_id']);
            }
            else
            {
                $user_settings=$this->get_menu('1');
            }
            // echo "<pre>";
            // print_r($user_settings);
            // exit;
            
            return $user_settings;
        }
    }
    public function get_menu($role_id=null)
    {
        if (!empty($role_id))
        {
            $qry='';
            $super_user=$this->config->item('super_user_role_id');
            if(!in_array($role_id, $super_user))
            {
                $qry='select distinct um.role_id,um.menu_id,m.menu_name,m.parent_id,m.sort_order,m.controller,m.method,m.menu_icon_class,m.menu_icon_color from user_menu um join menues m on m.menu_id=um.menu_id where um.role_id='.$role_id." and m.is_deleted=0 and um.is_active=1 and m.parent_id=0 order by sort_order asc";
            }
            else
            {
                $qry='select distinct m.menu_id,m.menu_name,m.parent_id,m.sort_order,m.controller,m.method,m.menu_icon_class,m.menu_icon_color from menues m where m.is_deleted=0 and m.parent_id=0 order by sort_order asc';   
            }
            $menu_array=array();
            $data=$this->common_model->getByQuery($qry);
               foreach ($data as $key => $value) {
                    if(!in_array($role_id, $super_user))
                    {
                        $qry_submenu="select distinct um.role_id,um.menu_id,m.menu_name,m.parent_id,m.sort_order,m.controller,m.method,m.menu_icon_class,m.menu_icon_color from user_menu um join menues m on m.menu_id=um.menu_id  where um.role_id=".$role_id." and um.is_active=1 and m.parent_id=".$value['menu_id']." and m.is_deleted=0 order by sort_order asc";
                    }
                    else
                    {
                        $qry_submenu="select distinct m.menu_id,m.menu_name,m.parent_id,m.sort_order,m.controller,m.method,m.menu_icon_class,m.menu_icon_color from menues m where m.parent_id=".$value['menu_id']." and m.is_deleted=0 order by sort_order asc";   
                    }

                    $sub_menu=$this->common_model->getByQuery($qry_submenu);
                    $value['submenu']=$sub_menu;
                    $menu_array[$key]=$value;
                } 
                return $menu_array;
        }
    }
    public function get_user_menu_list($id='',$is_rpo=false)
    {
        if(!empty($id))
        {
            $user_settings='';
            $table='candidate';
            if($is_rpo)
            {
                $table='rpo_candidates';
            }
            $user_data=$this->common_model->get_data($table,array('can_id'=>$id));
            if(!empty($user_data))
            {
                $role_id='';
                if(!empty($user_data['role_id']))
                {
                    $role_id=$user_data['role_id'];
                }
                else
                {
                    $role_id='1';   
                }
                $super_user=$this->config->item('super_user_role_id');
                $qry='';
                if(!in_array($role_id, $super_user))
                {
                    $qry='select m.* from user_menu um join menues m on m.menu_id=um.menu_id where um.role_id='.$role_id." and um.is_active=1 and m.is_deleted=0 order by sort_order asc";    
                }
                else
                {
                    $qry='select m.* from menues m where m.is_deleted=0 order by sort_order asc';   
                }
                $data=$this->common_model->getByQuery($qry);
                
                $menu=array();
                $operations=array();
                    
                foreach ($data as $key => $value) {
                    
                    $menu['controllers'][]=$value['controller'];
                    $qry_to_get_menu_operations="select group_concat(LOWER(mo.menu_operation_name)) as menu_operations from menu_operations mo join user_menu_operations umo on mo.mo_id =umo.mo_id where umo.menu_id=".$value['menu_id']." and umo.role_id=".$role_id;
                    $menu_operations=$this->common_model->getByQuery($qry_to_get_menu_operations);
                    $menu_operations=$menu_operations[0]['menu_operations'];
                    // if(empty($menu_operations))
                    // {
                    //     $menu_operations='view';
                    // }
                     if(!empty($menu_operations))
                     {
                        $operations[$value['controller']]=explode(',',$menu_operations);   
                    }
                    if(empty($operations[$value['controller']]))
                    {
                        $operations[$value['controller']]=array('0'=>'view');
                    }
                    if(empty($value['method']))
                    {
                        $value['method']='index';   
                    }
                    $menu['methods'][]=$value['method'];
                }
                $menu['menu_operations']=$operations;
                 return $menu;
            }
        }
    }


}
