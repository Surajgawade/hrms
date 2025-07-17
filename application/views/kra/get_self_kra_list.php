<?php foreach($assign_kra as $key=>$value){
	$action='';
	$user_data=get_user_details(array('can_id'=>$value['created_by']));
	if($value['status']==0)
	{
		$action="<a class='assign_btn' id='".$value['kra_id']."' href='".site_url()."/kra/rate_kra/".$value['kra_id']."/".get_login_user_id()."'><i class='fa fa-star' aria-hidden='true'></i> Rate</a>";
	}
	else
	{
		$action="<a class='assign_btn' id='".$value['kra_id']."' href='".site_url()."/kra/rate_kra/".$value['kra_id']."/".get_login_user_id()."'><i class='fa fa-eye' aria-hidden='true'></i> View</a>";	
	}
	echo "<tr><td>MUM00000".$user_data['can_id']."</td><td>".get_user_name_by_id($value['created_by'])."</td><td>".get_user_job_profile($user_data['job_profile'])."</td><td>".date('Y/m/d',strtotime($value['created_on']))."</td><td>".$value['kra_name']."</td><td>".$value['month']."</td><td>".$action."</td></tr>";
}?>