<?php  $userdata = $this->session->userdata('logged_in_user');
//x_debug($userdata);?>
<div class="page-content">
	<div class="container-fluid">
		<div class="col-sm-12 well">
			 <div class="row">
			 	<div class="col-sm-12">

				</div>
				<form data-toggle="validator" class="col-sm-12" id="frm_reopen_task" action="" method="post"  role="form">
					<h1 class="well headline">Reopen Task</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							
							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Task Name</label>
									</div>
								</div>
							
								<div class=col-lg-10>
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Enter Task Name" type="text" name="task_name" id="task_name" " value="<?php echo $task_status_details->task_name;?>" readonly>
											<i class="fa fa-user"></i>
										</div>
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Comment</label>
									</div>
								</div>
							
								<div class=col-lg-10>
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<textarea placeholder="Enter Task Comment" rows="3" name="task_comment" id="task_comment" class="form-control" readonly><?php echo !empty($task_status_details->task_comment) ? $task_status_details->task_comment : '' ;?></textarea>										
										</div>
										<div class="help-block with-errors error_msg"></div>										
									</div>
								</div>
							</div>

										
							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Reason For Reopen Task <span>*</span></label>
									</div>
								</div>
							
								<div class=col-lg-10>
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<textarea placeholder="Enter reason for reopen task" rows="3" name="reopen_reason" id="reopen_reason" class="form-control" required data-error="Enter reason for reopen task"><?php echo !empty($task_status_details->task_reopen_comment) ? $task_status_details->task_reopen_comment : '';?></textarea>
										
										</div>
										<div class="help-block with-errors error_msg"></div>

									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Task Status <span> * </span></label>
									</div>
								</div>
							
								<div class=col-lg-10>
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select class="form-control" required="" id="task_status" name="task_status" class="web" style="width: 100%">
													<!--<option value="Open" <?php if($task_status_details->status=='Open') //echo "selected";?>>Open</option>												
												  	<option value="Completed" <?php if($task_status_details->status=='Completed')// echo "selected";?>>Completed</option>
												  	--><option value="Reopen" <?php if($task_status_details->status=='Reopen') echo "selected";?>>Reopen</option>												  											  
											</select>
										</div>
									</div>
								</div>
							</div>


													
							<div class="row">
								<div class="col-lg-6">
									<input type="submit" value="submit" class="btn btn-inline btn-success ladda-button"/>
								</div>
							</div>
					</div>
				</form>
			 </div>
		</div>
</div>
