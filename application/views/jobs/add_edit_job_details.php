
<div class="page-content">
	<div class="container-fluid">
		<div class="well" style="margin-bottom:20px;">
			<div class="row">
				<form data-toggle="validator" class="col-sm-12" id="menu_frm" action="" method="post">
					<input type="hidden" name="job_id" id="job_id" value="<?php echo !(empty($job_details['job_id'])) ? $job_details['job_id'] : '';?>">				
					<h1 class="well headline">Add / Edit Job Details</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Job Title <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Job Title" type="text" name="job_title" id="job_title" value="<?php echo !(empty($job_details['job_title'])) ? $job_details['job_title'] : '';?>" required data-error="Please Enter Job Title">
											<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Job Description <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<textarea placeholder="Enter Description" rows="3" name="job_description" id="job_description" class="form-control" required data-error="Please Enter Job Description"><?php echo !(empty($job_details['job_description'])) ? $job_details['job_description'] : '';?></textarea>
											<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">No. of Positions </label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control number" placeholder="No. of Positions" type="text" name="no_of_position" id="no_of_position" value="<?php echo !(empty($job_details['no_of_position'])) ? $job_details['no_of_position'] : '';?>">
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Status <span>*</span> </label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-8 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select id="status" name="status" class="web form-control col-lg-12 col-sm-12 col-xs-12" required data-error="Please Select Status">
											<option value="" disabled selected hidden>Select Status</option>
											<option value="open" <?php echo (@$job_details['status'] == 'open') ? 'selected' : ''; ?>>Open</option>
											<option value="close" <?php echo (@$job_details['status'] == 'close') ? 'selected' : ''; ?>>Close</option>>
											</select>
									<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-lg-6">
									<button class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label" id="submit_form">Submit</span>
									</button>							
							
									<button class="btn btn-inline ladda-button reset" data-style="expand-left"><span class="ladda-label">Reset</span>
									</button>
								</div>							
						</div>
					</div>
				</form> 
			</div>
		</div>
	</div>
</div>
