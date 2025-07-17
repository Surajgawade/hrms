
<div class="page-content">
	<div class="container-fluid">
		<div class="col-sm-12 well">
			 <div class="row">
			 	<div class="col-sm-12">
			 	<?php if($this->session->flashdata('success')){?>
						<div class="alert alert-success alert-no-border alert-close alert-dismissible fade show" role="alert">
							<?php echo $this->session->flashdata('success');?>
						</div>
				<?php }?>
				</div>
				<form data-toggle="validator" class="col-sm-12" id="task_form" action="" method="post"  role="form">
					<h1 class="well headline">Assign Task</h1>
					<input type="hidden" name="task_id" id="task_id" value="<?php echo $task_details->task_id;?>">
						<div class="col-sm-12 col-xs-12 profile_bg">
							
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Task Name<span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<label class="form-label can_label"><?php echo $task_details->task_name;?></label>
										</div>
									</div>
								</div>
							</div>
										
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Description<span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<label class="form-label can_label"><?php echo $task_details->task_description;?></label>																
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Assign to <span>*</span></label>
									</div>
								</div>
								<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<select class="chosen-select col-md-10 col-sm-12 col-xs-12 alpha_only" name="candidates[]" id="candidates" multiple style="width: 100px" required="">
									  <option value="Select Name" disabled hidden>Select Name</option>
									  <?php foreach ($candidates as $key => $candidate) {?>
									 	 <option value="<?php echo $candidate->can_id?>" <?php foreach($assigned_can as $can){
									 	 	if($can->can_id==$candidate->can_id){ echo 'selected'; }} ?>><?php echo $candidate->can_name?></option>									  	
									  <?php }?>
									</select>
								</div>
								<span class="error_msg" id="err_can"></span>
								</div>
							</div>
							<div class="row">
									<div class="col-lg-6">
										<input type="button" value="Save" class="btn btn-inline btn-success ladda-button" id="assign_task"/>
									</div>
							</div>
					</div>
				</form>
			 </div>
		</div>
</div>

<script>
	$(document).ready(function() {
		$(".chosen-select").chosen();
		// $('#datePicker').datepicker({
		// 	format: 'dd/mm/yyyy'
  //  	});

	   $('#assign_task').click(function (e) {		
			e.preventDefault();
			var task_id= $('#task_id').val();
			var candidates = [];
			$.each($("#candidates option:selected"), function(){            
				candidates.push($(this).val());
			});
			if($("#candidates ")[0].selectedIndex <= 0)
			{
				$('#err_can').html('Select Employees!').show().delay(2000).fadeOut(800);
			}
			else
			{
				//console.log(candidates);
				$('#assign_task').attr('disabled', true);
				$.ajax({
					url: '<?php echo site_url();?>/task/assign_task',
					data : {task_id: task_id, candidates:candidates},
					type: 'POST',
					success: function(response){
						$.notify({
							title: "<strong>Success:</strong> ",
							message: "Task Assigned Successfully!",
						},
						{
							type: "success",
							delay: 800,
							animate:{
							enter: "animated fadeInUp",
							exit: "animated fadeOutDown"
							}
						});
							$('#showmenu').removeAttr('disabled');
							$('#task_id').val(response.task_id);
							setTimeout(function () {
    						window.location.href = '<?php echo site_url();?>/task/task_list';
  		      				}, 2000);
			   		}
				});
				//window.setTimeout(function(){location.reload()},3000);
			}
		});
    });
	
	var classes = {
		2 : 'orange',
		4 : 'blue',
		5 : 'orange'
	};
	/*$('#basic').picker();
	$('#multi').picker({search : true,coloring: classes});*/
</script>	