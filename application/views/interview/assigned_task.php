
<div class="page-content">
	<?php
	$tat ='';
	if(isset($task_details['tat']) && !empty($task_details['tat']))
	{	
 		if(!empty(strtotime($task_details['tat'])))
 		{
 			$tat = db_to_date($task_details['tat']);
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
					<h1 class="well headline">Assigned Task</h1>
					<input type="hidden" name="int_task_id" id="int_task_id" value="<?php echo (isset($task_details['int_task_id'])) ? $task_details['int_task_id'] : '';?>">
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
											<label class="form-label can_label">Resource Request to Process</label>
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
											<input type="text" name="resource_title" id="resource_title" class="form-control" value="<?php echo (isset($task_details['title'])) ? $task_details['title'] : '';?>" readonly>
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
											<textarea name="task_description" id="task_description" class="form-control" rows="6" readonly><?php echo (isset($task_details['job_description'])) ? $task_details['job_description'] : '';?></textarea>
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
											<textarea name="keywords" id="keywords" class="form-control" readonly><?php echo (isset($task_details['keywords'])) ? $task_details['keywords'] : '';?></textarea>
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
											<input type="text" name="no_of_positions" id="no_of_positions" class="form-control" value="<?php echo (isset($task_details['no_of_positions'])) ? $task_details['no_of_positions'] : '';?>" readonly="">		
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
											<input type="budget" name="budget" id="budget" class="form-control" value="<?php echo (isset($task_details['budget'])) ? $task_details['budget'] : '';?>" readonly >		
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Turn Around Time:</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									  <div class="form-group">
										<div class="input-group input-append date" id="datepicker1" data-date-start-date="0d">
											<input type="text" class="form-control" name="tat" id="tat" placeholder="dd/mm/yyyy" value="<?php echo $tat;?>" readonly>
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
										<span class="error_msg" id="err_tat"></span>								
									</div>  
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Priority: </label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input type="priority" name="priority" id="priority" class="form-control" value="<?php echo (isset($task_details['priority'])) ? $task_details['priority'] : '';?>" readonly >		
											
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Status: </label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select class="form-control" required="" id="status" name="status" >
												<option value="Open" <?php if($task_details['status']=='Open') echo "selected";?>>Open</option>										
												<option value="In-Progress" <?php if($task_details['status']=='In-Progress') echo "selected";?>>In-Progress</option>	
												  <option value="Completed" <?php if($task_details['status']=='Completed') echo "selected";?>>Completed</option>
											</select>		
											
										</div>
									</div>
								</div>
							</div>
							<div class="row">
									<div class="col-lg-6">
										<input type="button" value="Update" class="btn btn-inline ladda-button btn-success" id="update_task" />
										<input type="button" value="Add New Candidate" class="btn btn-inline ladda-button btn-primary" id="add_new" />

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

	   $('#update_task').click(function (e) {		
			e.preventDefault();
			var int_task_id= $('#int_task_id').val();
			var status=$("#status").val();

			$.ajax({
				url: '<?php echo site_url();?>/interview/update_task',
				data : {int_task_id: int_task_id, status:status},
				type: 'POST',
				success: function(response){
					$.notify({
						title: "<strong>Success:</strong> ",
						message: "Task Status Updated successfully!!",
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
						window.location.href = '<?php echo site_url();?>/interview/interview_task';
		      				}, 2000);
		   		}
			});
			
		});
    });
	
</script>	