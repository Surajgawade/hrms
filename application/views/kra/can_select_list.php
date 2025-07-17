<?php if(!empty($candidates))
{
	echo "<Select class='form-control chosen-select' id='employee_select' name='employee'>";
	echo "<option value=''>Select Employee</option>";
	foreach ($candidates as $key => $value) {
		echo "<option value='".$value['can_id']."'>".$value['can_name']."</option>";
	}
	echo "</Select>";

}
?>
<script type="text/javascript">
	$("#employee_select").change(function(){  //"select all" change
		employee=$("#employee_select option:selected").val();
	
		if(employee!='')
		{
			$(".form").css('display','block');
		}
		else
		{
			$(".form").css('display','none');	
		}
	});

	$(".chosen-select").chosen();
</script>