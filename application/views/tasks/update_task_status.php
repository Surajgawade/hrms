<?php $userdata = $this->session->userdata('logged_in_user');?>
<div class="page-content">
	<div class="container-fluid">
		<div class="col-sm-12 well">
			 <div class="row">
			 	<div class="col-sm-12">

				</div>
				<form data-toggle="validator" class="col-sm-12" id="profile_form" action="<?php echo site_url();?>/task/update_my_task " method="post"  role="form">
					<input type="hidden" name="task_id" value="<?php echo (isset($task_details->task_id) && !empty($task_details->task_name)) ? $task_details->task_id:'' ?>">
					<h1 class="well headline">Task Manager</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							
							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Task Name<span>*</span></label>
									</div>
								</div>
							
								<div class=col-lg-10>
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Enter Task Name" type="text" name="task_name" id="task_name" value="<?php echo $task_details->task_name;?>" readonly>
											<i class="fa fa-user"></i>
										</div>
									</div>
								</div>
							</div>
										
							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Description<span>*</span></label>
									</div>
								</div>
							
								<div class=col-lg-10>
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<textarea placeholder="Enter Task Description" rows="3" name="task_description" id="task_description" class="form-control" required readonly><?php echo $task_details->task_description;?></textarea>
										
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Turn Around Time<span>*</span></label>
									</div>
								</div>
							
								<div class=col-lg-10>
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input type="text" class="form-control" placeholder="Turn Around Time" name="tat" id="tat" required value="<?php echo !empty($task_details->tat) ? format_date($task_details->tat) : set_value('tat');?>" readonly>
											<i class="glyphicon glyphicon-time"></i>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Priority <span>*</span></label>
									</div>
								</div>
							
								<div class=col-lg-10>
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select class="form-control" disabled required id="priority" name="priority" class="web" style="width: 100%" readonly>
												  <option value="High" <?php if($task_details->priority=='High') echo "selected";?>>High</option>
												  <option value="Medium" <?php if($task_details->priority=='Medium') echo "selected";?>>Medium</option>
												  <option value="Low" <?php if($task_details->priority=='Low') echo "selected";?>>Low</option>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Task Status <span>*</span></label>
									</div>
								</div>
							
								<div class=col-lg-10>
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select class="form-control" required="" id="task_status" name="task_status" class="web" style="width: 100%">
												<option value="Open" <?php if($task_details->status=='Open') echo "selected";?>>Open</option>										
												<option value="In-Progress" <?php if($task_details->status=='In-Progress') echo "selected";?>>In-Progress</option>	
												  <option value="Completed" <?php if($task_details->status=='Completed') echo "selected";?>>Completed</option>
										<?php if($task_details->task_created_by == $userdata['id']){?>
												  <option value="Reopen" <?php if($task_details->status=='Reopen') echo "selected";?>>Reopen</option>												  					
										<?php }?>
											</select>
										</div>
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Comment </label>
									</div>
								</div>
							
								<div class=col-lg-10>
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<textarea placeholder="Enter Task Comment" rows="3" name="task_comment" id="task_comment" class="form-control" ><?php echo $task_details->task_comment;?></textarea>										
										</div>										
									</div>
								</div>
							</div>

							<?php if($task_details->status=='Reopen'){?>
							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Reason For Reopen <span>*</span></label>
									</div>
								</div>
							
								<div class=col-lg-10>
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<textarea placeholder="Enter Task Comment" rows="3" class="form-control" readonly><?php echo $task_details->task_reopen_comment;?></textarea>										
										</div>
									</div>
								</div>
							</div>
							<?php }?>

													
							<div class="row">
								<div class="col-lg-6">
									<input type="submit" id="submit" value="Save" class="btn btn-inline btn-success ladda-button"/>
								</div>
							</div>
					</div>
				</form>
			 </div>
		</div>
</div>
