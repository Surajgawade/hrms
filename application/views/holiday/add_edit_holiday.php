<div class="page-content">
	<div class="container-fluid">
		<div class="well" style="margin-bottom:20px;">
			<div class="row">
				<form data-toggle="validator" class="col-sm-12" id="menu_frm" action="" method="post">
					<input type="hidden" name="holiday_id" id="holiday_id" value="<?php echo !(empty($holiday_details->holiday_id)) ? $holiday_details->holiday_id : '';?>">				
					<h1 class="well headline">Add / Edit Holiday</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Holiday Title <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Holiday Name" type="text" name="holiday_title" id="holiday_title" value="<?php echo !(empty($holiday_details->holiday_title)) ? $holiday_details->holiday_title : '';?>" required data-error="Please Enter Holiday Title">
									<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Description</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<textarea placeholder="Enter Description" rows="3" name="description" id="description" class="form-control"><?php echo !(empty($holiday_details->description)) ? $holiday_details->description : '';?></textarea>
										</div>
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
									<label class="form-label">Holiday Date <span>*</span></label>
									</div>
								</div>

								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="date form-group">
										<div class="input-group input-append date" id="datePicker" data-date-start-date="0d">
										<input type="text" class="form-control" name="holiday_date" id="holiday_date" placeholder="dd/mm/yyyy"   value="<?php echo !(empty($holiday_details->holiday_date)) ? format_date($holiday_details->holiday_date) : '';?>" required data-error="Please Enter Holiday Date">
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
									<div class="help-block with-errors error_msg"></div>
									</div>
								</div>	
							</div>
							
							<div class="row">
								<div class="col-lg-6">
									<input id="add_holiday" type="submit" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
									<input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
									<!-- <input type="button" class="btn btn-inline ladda-button pull-right" data-style="expand-left" value="Add New"> -->
								</div>							
							</div>
						</div>
				</form> 
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#datePicker').datepicker({
			format: 'dd/mm/yyyy',
			autoclose : true,
			minDate: new Date()
		});
	});
</script>
