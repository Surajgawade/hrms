
<div class="page-content">
		<div>
		<?php if($this->session->flashdata('success')){?>
			<script type="text/javascript">
				var message_text='<?php echo $this->session->flashdata('success');?>';
					$.notify({
							title: "<strong>Success:</strong> ",
							message: message_text,
						},
						{
							type: "success",
							delay: 800,
							animate:{
							enter: "animated fadeInUp",
							exit: "animated fadeOutDown"
							}
						});
			</script>
		<?php } ?>
	</div>
	<div class="container-fluid">
		<div class="well" style="margin-bottom:20px;">
			<div class="row">
				<form data-toggle="validator" class="col-sm-12" id="resource_request_form" action="" method="post">
					<input type="hidden" name="request_id" id="request_id" value="<?php echo isset($resource_request['request_id']) ? $resource_request['request_id'] : ''; ?>">				
					<h1 class="well headline">Resource Request Form</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label"> Resource Type <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select class="chosen-select col-md-10 col-sm-12 col-xs-12" name="resource_type" id="resource_type" required >
											<option value="" selected="">Select Resource Type</option>
											<?php if(!empty($job_profiles)){ foreach ($job_profiles as $profile) {?>											
											<option value="<?php echo $profile['id'];?>" <?php if(isset($resource_request['resource_type']) && $profile['id'] == $resource_request['resource_type']) echo "selected";?>><?php echo $profile['title'];?></option>
											<?php } }?>
										</select>
										<span class="error_msg" id="err_resource_type"></span>	
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">No. of Positions <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control number" placeholder="No. of Positions" type="text" name="no_of_positions" id="no_of_positions" required data-error="Please Enter no of position" value="<?php echo (isset($resource_request['no_of_positions']) && !empty($resource_request['no_of_positions'])) ? $resource_request['no_of_positions'] : '';?>" maxlength="3">
											<div class="help-block with-errors error_msg" id="nop"></div>
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
											<textarea placeholder="Enter Description" rows="3" name="job_description" id="job_description" class="form-control" required data-error="Please Enter Job Description"><?php echo (isset($resource_request['job_description']) && !empty($resource_request['job_description'])) ? $resource_request['job_description'] : '';?></textarea>
											<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Keywords <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<textarea placeholder="Enter Keywords" rows="3" name="keywords" id="keywords" class="form-control" required data-error="Please Enter Keywords"><?php echo (isset($resource_request['keywords']) && !empty($resource_request['keywords'])) ? $resource_request['keywords'] : '';?></textarea>
											<small class="text-muted">Please seperate keywords with ,</small>
											<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label"> Qualification<span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select class="chosen-select col-md-10 col-sm-12 col-xs-12 alpha_only" name="qualification[]" id="qualification" multiple style="width: 100px" required="" data-placeholder="Select Qualification">
										 		 <option value="Select Name" disabled hidden>Select Qualification</option>
												  <?php if(!empty($qualifications)){ foreach ($qualifications as $qualification) {?>
												 	<option value="<?php echo $qualification->id?>" <?php if(in_array($qualification->id,explode(",",$resource_request['qualification']))){ echo 'selected'; } ?>	><?php echo $qualification->title?></option>
												  <?php }}?>
											</select>
											<span class="error_msg" id="err_qualification"></span>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Budget </label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control number" placeholder="Budget" type="text" name="budget" id="budget" value="<?php echo (isset($resource_request['budget']) && !(empty($resource_request['budget']))) ? $resource_request['budget'] : '';?>" maxlength="8">
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Experience </label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-10 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select name="experience" id="experience" class="form-control">
												<option value="">Select Year</option>
												<?php for($i=0;$i<=30;$i++){ ?>
													<option value="<?php echo $i;?>"<?php if(isset($resource_request['experience']) &&($i == $resource_request['experience'])) echo "selected";?>><?php echo $i;?></option>
												<?php } ?>												
											</select>
										</div>
									</div>
								</div>
							</div>

							<!-- <div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label"> Reporting To<span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select class="chosen-select col-md-10 col-sm-12 col-xs-12" name="reporting_to" id="reporting_to" >
											<option value="" selected="" disabled>Select Reporting To</option>
											<?php if(!empty($candidates)){ foreach ($candidates as $candidate) {?>											
											<option value="<?php echo $candidate->can_id?>" <?php if(isset($resource_request['reporting_to']) && $candidate->can_id == $resource_request['reporting_to']) echo "selected";?>><?php echo $candidate->can_name?></option>
											<?php } }?>
										</select>	
										</div>
									</div>
								</div>
							</div> -->
							

							<!--<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Status <span>*</span> </label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-8 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select id="status" name="status" class="web col-lg-12 col-sm-12 col-xs-12" required data-error="Please Select Status">
											 <option value="" disabled selected hidden>Select Status</option> 
											<option value="open" <?php echo (@$resource_request['status'] == 0) ? 'selected' : ''; ?> selected >Open</option>
											<option value="close" <?php echo (@$resource_request['status'] == 1) ? 'selected' : ''; ?>>Close</option>>
											</select>
											<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>
							</div>-->
						
							<div class="row">
								<div class="col-lg-6">
									<button id="submit_form"class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label" >Submit</span>
									<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>							
									<input type="button" value="Reset" class="btn btn-inline ladda-button reset" data-style="expand-left">
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
	$(document).ready(function () {
		$(".chosen-select").chosen();
		$('#submit_form').click(function (event) {
			// $('#submit_form').attr('disabled',true);
			if($('#resource_type').val()=='')
			{
				$('#err_resource_type').html('Please Select Resource Type').show().delay(2000).fadeOut(1000);
				$("html, body").animate({ scrollTop: 0 }, "slow");
				return false;
			}
			if($('#no_of_positions').val()=='' || $('#no_of_positions').val()<=0)
			{
				$('#nop').html('Enter valid No. of positions').show().delay(2000).fadeOut(1000);
				$("html, body").animate({ scrollTop: 0 }, "slow");
				return false;
			}
			if($('#qualification').val()=='')
			{
				$('#err_qualification').html('Please Select Qualification').show().delay(2000).fadeOut(1000);
				$("html, body").animate({ scrollTop: 0 }, "slow");
				return false;
			}
		});
	});
</script>
