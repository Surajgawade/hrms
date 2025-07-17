<?php
$table='<table class="table_responsive display table table-bordered table-striped">';
	$table.="<thead><tr><th>Employee Id</th><th>Employee Name</th><th>Review Type</th><th>Month</th><th>Joining Date</th><th>Job Profile</th><th>Status</th><th>Action</th></tr></thead>";
if(!empty($kra_candidate))
{
	
	foreach ($kra_candidate as $key => $value) {
		$status=($value['status']==0)?'Pending':'Completed';
		$action='';
		if($value['status']==1)
		{
			$action="<a class='assign_btn' id='".$value['kra_id']."' href='".site_url()."/kra/rate_kra/".$value['kra_id']."/".$value['can_id']."/".get_login_user_id()."'><i class='fa fa-tasks' aria-hidden='true'></i> Rate</a><button class='btn btn-sm btn-danger' type='button' onClick='delete_kra_emp(".$value['kra_id'].",".$value['can_id'].")'><i class='fa fa-trash' aria-hidden='true'></i></button>";
		}
		else if($value['status']==2)
		{
			$action="<a class='assign_btn' id='".$value['kra_id']."' href='".site_url()."/kra/view_kra/".$value['kra_id']."/".$value['can_id']."/".get_login_user_id()."'><i class='fa fa-tasks' aria-hidden='true'></i> View</a><button class='btn btn-sm btn-danger' type='button' onClick='delete_kra_emp(".$value['kra_id'].",".$value['can_id'].")'><i class='fa fa-trash' aria-hidden='true'></i></button>";	
		}
	$table.="<tr><td>".'MUM00000'.$value['can_id']."</td><td>".$value['can_name']."</td><td>".$value['kra_name']."</td><td>".$value['month']."</td><td>".$value['joining_date']."</td><td>".get_user_job_profile($value['job_profile'])."</td><td>".$status."</td><td>".$action."</td></tr>";
?>
<?php		
	}
	
}
$table.="</table>";
	echo $table;
	echo $pagination;
?>