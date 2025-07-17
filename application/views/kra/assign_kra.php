<div class="page-content">
	<div class="container-fluid p-xl-12 profile_bg">
		<div class="well">
			<form id="kra_form">
			<div class="row">
				<div class="col-lg-3">
					<div class="form-group">
						<label class="form-label">KRA</label>
					</div>
				</div>
				<div class="col-lg-9">
					<?php if(!empty($kra))
					{
						?>
						<select id='kra_title' name='kra_title' class='form-control'><option value=''>Select KRA</option>
			 			<?php foreach ($kra as $key => $value) 
						{
							echo "<option value=".$value['kra_id'].">".$value['kra_name']."</option>";	
						}
						?>
						</select>
					<?php	
			 		}?>
					<span id="title-error"></span>
				</div>	
			</div>
		</br>
		<div class="row">
				<div class="col-lg-3">
					Department
				</div>
				<div class="col-lg-2">
					<input type='checkbox' id="select_all" onClick="check_uncheck_checkbox(this.checked);">Select All
				</div>
				<div class="col-lg-6">
					<?php
						$department_ids=array();
			 				$department_ids[]=$value['id'];
					 
						foreach ($department as $key => $value) {
							echo "<input class='department_ids' type='checkbox' name='department_ids[]' value='".$value['id']."'>".$value['title']."<br>";		
							
						}
					?>
					<span id="department-error"></span>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3" align="right">
					<button class="btn-primary btn-lg" id="submit" type="button" name="submit">Assign Kra</button>
				</div>
			</div>
		</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	
$(document).ready(function() {
	$("#select_all").change(function(){  //"select all" change
	var status = this.checked; // "select all" checked status
	$('.department_ids').each(function(){ //iterate all listed checkbox items
	this.checked = status; //change ".checkbox" checked status
	});
	});
});
	$("#department").change(function() {
		id=$("#department option:selected").val();
		if(id!='')
		{	
			
		}
	});
	$("#submit").click(function() {
		title=$("#kra_title option:selected").val();
		var fields = $("input[class='department_ids']").serializeArray();
	
		if(title=='')
		{
			$('#title-error').html('<p style="color:red" id="msg">required</p>');
			$("#msg").hide(1000);
		}
		else if(fields=='')
		{
			$('#department-error').html('<p style="color:red" id="msg-dept">required</p>');	
			$("#msg-dept").hide(1000);
		}
		
		else
		{
			$.ajax({
					url: '<?php echo site_url();?>/kra/save_assign_kra/',
					dataType :"json",
					data : $("#kra_form").serialize(),
					type: 'POST',
					success: function(response){
						if(response==1)
						{
							swal("Kra Has Been Assigned Successfully", "success");
						}
						else
						{
							$('#title-error').html('<p style="color:red" id="msg">Already Exist</p>');	
						}
					}
				});
		}
	});
</script>
