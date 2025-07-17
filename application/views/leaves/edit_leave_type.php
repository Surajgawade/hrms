<div class="page-content">
	<div class="container-fluid">
	<div class="col-sm-12 well">
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="add_leave" action="<?php echo site_url('leave_management/save_leave_type');?>" method="post">
				<input type="hidden" name="type_id" id="type_id" value="<?php echo $this->uri->segment(3);?>">
				<h1 class="well headline">Edit Leave Type</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Leave Title <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Enter Leave Title" type="text" name="leave_title" id="leave_title"  value="<?php echo !(empty($leave_type->leave_title)) ? $leave_type->leave_title : '';?>" required data-error="Please Enter Leave Title">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>
							
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Acronym <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Acronym" type="text" name="acronym" id="acronym" value="<?php echo !(empty($leave_type->acronym)) ? $leave_type->acronym : '';?>" required data-error="Please Enter Acronym">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>	
					
						<div class="row">
							<div class="col-lg-6">
							<input id="submit_leave_type" type="submit" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
							<input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
							</div>
						</div>
					</div>
			</form> 
		</div>
	</div>
</div>
</div>

	