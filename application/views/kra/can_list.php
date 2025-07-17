<?php
// x_debug($kra_candidate);
if(!empty($kra_candidate))
{
	$table='<table class="table-responsive display table table-bordered table-striped">';
	$table.="<thead><tr><th>Employee Id</th><th>Employee Name</th><th>Joining Date</th><th>Job Profile</th><th>Status</th><th>Final Status</th><th>Action</th></tr></thead>";
	$user_id=get_login_user_id();
	foreach ($kra_candidate as $key => $value) {
		$status=($value['status']==0)?'Pending':'Assigned';
		if($value['status']==0 && $value['can_id']==$user_id)
		{
			$action="<button class='assign_btn assign' id='".$value['kra_id']."' href='' data-toggle = 'modal' data-target = '#name_kra'><i class='fa fa-users' aria-hidden='true'></i> Assign</button>";	
		}
		else if($value['status']==0)
		{
			$action=$status;
		}
		else
		{
			$action='Already Assigned';	
		}
	$table.="<tr><td>".'MUM00000'.$value['can_id']."</td><td>".$value['can_name']."</td><td>".$value['joining_date']."</td><td>".get_user_job_profile($value['job_profile'])."</td><td>".$action."</td><td></td><td><button class='btn btn-sm btn-danger' type='button' onClick='delete_kra(".$value['kra_id'].")'><i class='fa fa-trash' aria-hidden='true'></i></button></td></tr>";
?>
<?php		
	}
	$table.="</table>";
	echo $table;
	echo $pagination;
}
?>
<script type="text/javascript">
  $(".assign").click(function() {
      $('#kra_id').val($(this).attr('id'));
    });
</script>