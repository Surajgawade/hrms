<div class="page-content">
	<div class="container-fluid p-xl-12 profile_bg">
		<div class="well">
			<form id="kra_form">
			<div class="row">
				<div class="col-lg-3">
					<div class="form-group">
						<label class="form-label">KRA TITLE</label>
					</div>
				</div>
				<div class="col-lg-9">
					<input type="text" placeholder="KRA Title" class="form-control" id="kra_title" name="kra_title" oninvalid="">
					<span id="title-error"></span>
				</div>	
			</div>
			
			</div>
			<div class="row">
				<div class="col-lg-3" align="right">
					<input type='checkbox' id="select_all" onClick="check_uncheck_checkbox(this.checked);">Select All
				</div>
				<div class="col-lg-9">
					<?php 
						foreach ($kra_entities as $key => $value) {
							echo "<input class='entity_ids' type='checkbox' name='entity_ids[]' value='".$value['kra_entity_id']."'>".$value['name']."<br>";		
							
						}
					?>
					<span id="entity-error"></span>
				</div>
			</div>
			<input type="hidden" name="all_deparments" value="<?php echo implode(',', $department_ids); ?>">
			<div class="row">
				<div class="col-lg-3" align="right">
					<button class="btn-primary btn-lg" id="submit" type="button" name="submit">Add Kra</button>
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
	$('.entity_ids').each(function(){ //iterate all listed checkbox items
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
		id=$("#department option:selected").val();
		var fields = $("input[class='entity_ids']").serializeArray();

		if($('#kra_title').val()=='')
		{
			$('#title-error').html('<p style="color:red" id="msg">required</p>');
			$("#msg").hide(1000);
		}
		// else if(id=='')
		// {
		// 	$('#department-error').html('<p style="color:red" id="msg-dept">required</p>');	
		// 	$("#msg-dept").hide(1000);
		// }
		else if(fields=='')
		{
			$('#entity-error').html('<p style="color:red" id="msg-entity">required</p>');	
			$("#msg-entity").hide(1000);
		}
		else
		{
			$.ajax({
					url: '<?php echo site_url();?>/kra/save_kra/',
					dataType :"json",
					data : $("#kra_form").serialize(),
					type: 'POST',
					success: function(response){
						if(response==1)
						{
							swal("Kra Has Been Added Successfully", "success");
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
