
<div class="page-content">
	<div class="container-fluid">
		<div class="well" style="margin-bottom:20px;">
			<div class="row">
				<form data-toggle="validator" class="col-sm-12" id="menu_frm" action="" method="post">
					<input type="hidden" name="id" id="id" value="<?php echo !(empty($job_details['id'])) ? $job_details['id'] : '';?>">				
					<h1 class="well headline">Add / Edit Designation Details</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
						
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Department   <span>*</span></label>
									</div>
								</div>
						
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select class="chosen-select col-md-10 col-sm-12 col-xs-12" name="dept_id" id="dept_id" required data-error="Please Select Department">
											<option value="" selected="" disabled>Select Department</option>
												<?php foreach ($departments as $key => $department) {?>
												<option value="<?php echo $department->id?>" <?php if($department->id==$job_details['dept_id']){echo "selected";}?>><?php echo $department->title?></option>
												<?php }?>
											</select>
											<span class="error_msg" id="err_dept"></span>
											<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Job Title <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Job Title" type="text" name="title" id="title" value="<?php echo !(empty($job_details['title'])) ? $job_details['title'] : '';?>" required data-error="Please Enter Job Title">
											<div class="help-block with-errors error_msg" id="err_jobtitle"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Is HOD </label>
									</div>
								</div>
						
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<label class="form-label"><input type="checkbox" name="is_hod" id="is_hod" value="1" <?php if($job_details['is_hod']) {echo "checked";}?> >Yes</label>	
										</div>
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-lg-6">
									<button  id="submit_form" class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label">Submit</span>
									<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>							
									<button class="btn btn-inline ladda-button reset" data-style="expand-left"><span class="ladda-label">Reset</span>
									<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
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
		$(".chosen-select").chosen();
		$('#submit_form').attr('disabled',true);
	});

	$('#title').blur(function()
	{
		var title = $('#title').val();
		var dept_id = $('#dept_id').val();
		if(dept_id!='' && title!='')
		{
			$.ajax({
				url: '<?php echo site_url();?>/jobs/check_desi_exist',
				data : {dept_id: dept_id ,title: title},
				type: 'POST',
				success: function(response){
					console.log(response);
					if(response==1)
					{
						$('#err_jobtitle').html('Designation already exist!').show();
						$('#submit_form').attr('disabled',true);
						return false;
					}
					else 
					{
						$('#submit_form').removeAttr('disabled');
						$('#err_jobtitle').html('').hide();				
					}
				}
			});
		}
		else
		{
			$('#submit_form').attr('disabled',true);
			$('#err_dept').html('Please select department first!').show();
			return false;
		}
	});

	$("#submit_form").click(function(){

		var title = $('#title').val();
		var dept_id = $('#dept_id').val();
		if(dept_id!='' && title!='')
		{
			$.ajax({
				url: '<?php echo site_url();?>/jobs/check_desi_exist',
				data : {dept_id: dept_id ,title: title},
				type: 'POST',
				success: function(response){
					console.log(response);
					if(response==1)
					{
						$('#err_jobtitle').html('Designation already exist!').show();
						$('#submit_form').attr('disabled',true);
						return false;
					}
					else 
					{
						$('#submit_form').removeAttr('disabled');
						$('#err_jobtitle').html('').hide();				
					}
				}
			});
		}
		else
		{
			$('#submit_form').attr('disabled',true);
			$('#err_dept').html('Please select department first!').show();
			return false;
		}

	});


</script>