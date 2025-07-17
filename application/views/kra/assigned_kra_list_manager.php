<?php 
foreach($assign_kra as $key=>$value){
	$user_data=get_user_details(array('can_id'=>$value['created_by']));
	echo "<tr><td>MUM00000".$user_data['can_id']."</td><td>".get_user_name_by_id($value['created_by'])."</td><td>".get_user_job_profile($user_data['job_profile'])."</td><td>".date('Y/m/d',strtotime($value['created_on']))."</td><td>".$value['kra_name']."</td><td>".$value['month']."</td><td><button class='assign_btn' id='".$value['kra_id']."' href='' data-toggle = 'modal' data-target = '#name_kra'><i class='fa fa-users' aria-hidden='true'></i> Assign</button></td></tr>";
}?>