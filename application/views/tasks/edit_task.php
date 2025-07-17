<link href="<?php echo base_url()?>assets/css/mdtimepicker.css" rel="stylesheet" type="text/css">

<div class="page-content">
	<div class="container-fluid">
		
				<form data-toggle="validator" class="col-sm-12" id="profile_form" action=" " method="post"  role="form">
					<h1 class="well headline">Task Manager</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							
							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Task Name <span>*</span></label>
									</div>
								</div>
							
								<div class=col-lg-10>
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Enter Task Name" type="text" name="task_name" id="task_name" required data-error="Please Enter Task Name" value="<?php echo (isset($task_details->task_name) && !empty($task_details->task_name)) ? $task_details->task_name : '';?>">
											<i class="fa fa-user"></i>
										<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>
							</div>
										
							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Description </label>
									</div>
								</div>
							
								<div class=col-lg-10>
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<textarea placeholder="Enter Task Description" rows="3" name="task_description" id="task_description" class="form-control"><?php echo (isset($task_details->task_description) && !empty($task_details->task_description)) ? $task_details->task_description : '';?></textarea>
										
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Turn Around Time </label>
									</div>
								</div>
							
								<div class=col-lg-4>
									<div class="form-group">

											<div class="input-group input-append date" id="datepicker1" data-date-start-date="0d">
											<input type="text" class="form-control" name="tat" id="tat" placeholder="dd/mm/yyyy" value="<?php echo (isset($task_details->tat) &&  !empty($task_details->tat)) ? format_date($task_details->tat) : set_value('tat');?>" />
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>

									</div>
								</div>
								<div class="col-lg-4 col-sm-4 col-xs-4">
								<input type="text" id="timepicker" placeholder="time" value="<?php echo (isset($task_details->time) && !empty($task_details->time)) ? $task_details->time:''?>"/>
							</div>
							</div>

							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Priority </label>
									</div>
								</div>
							
								<div class=col-lg-10>
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select class="form-control" id="priority" name="priority" class="web" style="width: 100%">
												<option value="High" <?php if(isset($task_details->priority) && $task_details->priority=='High') echo "selected";?>>High</option>
												<option value="Medium" <?php if(isset($task_details->priority) && $task_details->priority=='Medium') echo "selected";?>>Medium</option>
												<option value="Low" <?php if(isset($task_details->priority) && $task_details->priority=='Low') echo "selected";?>>Low</option>
											</select>
										</div>
									</div>
								</div>
							</div>

													
							<div class="row">
								<div class="col-lg-6">
									<input type="submit" value="Save" class="btn btn-inline btn-success ladda-button"/>
								</div>
							</div>
					</div>
				</form>
			 </div>
		</div>
</div>
<script src="<?php echo base_url()?>assets/js/mdtimepicker.js"></script>
<script>
	$(document).ready(function() {
		$(".chosen-select").chosen();
		$('#timepicker').mdtimepicker();
		//$('#datetimepicker1').datetimepicker();
		$('#datepicker1').datepicker({
			format: 'dd/mm/yyyy',
			autoclose : true,
			minDate: new Date()
  		 	});
	});
  		 </script>