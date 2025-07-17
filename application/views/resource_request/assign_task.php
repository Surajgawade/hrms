
<div class="page-content">
	<?php
	$tat ='';
	if(isset($assigned_can['tat']) && !empty($assigned_can['tat']))
	{	
 		if(!empty(strtotime($assigned_can['tat'])))
 		{
 			$tat = db_to_date($assigned_can['tat']);
 			echo $tat;
 		}
	}
	?>
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
					<input type="hidden" name="request_id" id="request_id" value="<?php echo (isset($resource_details['request_id'])) ? $resource_details['request_id'] : '';?>">
						<div class="col-sm-12 col-xs-12 profile_bg">
							
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Task Name:</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<label class="form-label can_label">Enable Candidate Resource Request</label>
										</div>
									</div>
								</div>
							</div>									
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Resource Type:</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input type="text" name="resource_title" id="resource_title" class="form-control" value="<?php echo (isset($resource_details['title'])) ? $resource_details['title'] : '';?>" readonly>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Job Description:</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<textarea name="task_description" id="task_description" class="form-control" rows="6" readonly><?php echo (isset($resource_details['job_description'])) ? $resource_details['job_description'] : '';?></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Keywords:</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<textarea name="keywords" id="keywords" class="form-control" readonly><?php echo (isset($resource_details['keywords'])) ? $resource_details['keywords'] : '';?></textarea>
										</div>
									</div>
								</div>
							</div>			
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">No Of Position:</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input type="text" name="no_of_positions" id="no_of_positions" class="form-control" value="<?php echo (isset($resource_details['no_of_positions'])) ? $resource_details['no_of_positions'] : '';?>" readonly="">		
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Budget:</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input type="budget" name="budget" id="budget" class="form-control" value="<?php echo (isset($resource_details['budget'])) ? $resource_details['budget'] : '';?>" readonly >		
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Assign to<span>*</span></label>
									</div>
								</div>
								<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<select class="chosen-select col-md-10 col-sm-12 col-xs-12 alpha_only" name="candidates[]" id="candidates" multiple style="width: 100px" required="" data-placeholder="Assign To">
									  <option value="Select Name" disabled hidden>Select Name</option>
									  <?php foreach ($candidates as $key => $candidate) {?>
									 	 <option value="<?php echo $candidate->can_id?>" <?php foreach($assigned_can as $can){
									 	 	if($can['can_id']==$candidate->can_id){ echo 'selected'; }} ?>><?php echo $candidate->can_name?></option>									  	
									  <?php }?>
									</select>
								</div>
								<span class="error_msg" id="err_can"></span>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Turn Around Time</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									  <div class="form-group">
										<div class="input-group input-append date" id="datepicker1" data-date-start-date="0d">
											<input type="text" class="form-control" name="tat" id="tat" placeholder="dd/mm/yyyy" value="<?php echo $tat;?>" />
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
										<span class="error_msg" id="err_tat"></span>								
									</div>  
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Priority </label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select class="form-control" id="priority" name="priority" class="web">
												  <option value="High">High</option>
												  <option value="Medium">Medium</option>
												  <option value="Low">Low</option>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
									<div class="col-lg-6">
									<input type="button" value="Assign Task" class="btn btn-inline ladda-button" id="assign_task" />
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
		$('#datepicker1').datepicker({
			format: 'dd/mm/yyyy',
			autoclose : true,
			minDate: new Date()
  		 	});

	   $('#assign_task').click(function (e) {		
			e.preventDefault();
			var request_id= $('#request_id').val();
			var resource_title=$("#resource_title").val();
			var task_description=$("#task_description").html();
			var priority=$("#priority").val();
			var tat=$("#tat").val();

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
				$.ajax({
					url: '<?php echo site_url();?>/resource_request/assign_task',
					data : {request_id: request_id, candidates:candidates, resource_title:resource_title, task_description:task_description, priority:priority, tat:tat},
					type: 'POST',
					success: function(response){
						$('#assign_task').attr('disabled', true);
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
							setTimeout(function () {
    						window.location.href = '<?php echo site_url();?>/resource_request/assign_resource';
  		      				}, 2000);
			   		}
				});
			}
		});
    });
	
	var classes = {
		2 : 'orange',
		4 : 'blue',
		5 : 'orange'
	};
</script>	