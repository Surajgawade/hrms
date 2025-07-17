<?php $title="candidate_details"; ?>
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
		<?php }?>
	</div>

	<div class="container-fluid">
		<?php  $this->load->view('interview/top_menu');?>
	<div class="well">
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="can_information" action="" method="post">
				<h1 class="well headline">Candidate Information</h1>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 profile_bg">
						<input type="hidden" name="intw_can_id" id="intw_can_id" value="<?php echo (isset($candidate_details['intw_can_id'])) ? $candidate_details['intw_can_id'] : '';?>" >
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Candidate Name <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control alpha_only"  type="text" name="full_name" id="full_name" placeholder="Candidate Name" value="<?php if(isset($candidate_details['full_name'])) echo $candidate_details['full_name'];?>" required  data-error="Please Enter Candidate Name">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Email Id <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="email" name="email_id" id="email_id" placeholder="Email Id" class="form-control" value="<?php if(isset($candidate_details['email_id'])) echo $candidate_details['email_id'];?>" data-error="Please Enter Valid Email Id" required> 
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
					    </div>


						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Mobile Number <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" minlength="10" maxlength="10" name="mobile_no" id="mobile_no" placeholder="Mobile Number Here" class="form-control number" value="<?php if(isset($candidate_details['mobile_no'])) echo $candidate_details['mobile_no'];?>"  required data-error="Please Enter Your Mobile Number" >
										<i class="fa fa-mobile"></i>
										<div class="help-block with-errors error_msg"></div>
											<span class="error_msg" id ="phone1_err"></span>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Alternate Number</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" minlength="10" maxlength="10" name="alternate_no"  id="alternate_no" placeholder="Alternate Number Here" class="form-control number" value="<?php if(isset($candidate_details['alternate_no'])) echo $candidate_details['alternate_no'];?>" >
										<i class="fa fa-phone"></i>
									</div>
								</div>
							</div>
					    </div>

					   <div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Position</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control alpha_only"  type="text" name="position" id="position" placeholder="Position" value="<?php if(isset($candidate_details['position'])) echo $candidate_details['position'];?>" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Source </label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="source" id="source" placeholder="Source" class="form-control"  value="<?php if(isset($candidate_details['source'])) echo $candidate_details['source'];?>" >
									</div>
								</div>
							</div>
					    </div>


					    <div class="row">
					    	<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Date Of Birth</label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number"  type="text" name="dob" id="dob" placeholder="Date of Birth" value="<?php if(isset($candidate_details['dob'])) echo $candidate_details['dob'];?>" v>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Current CTC</label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number"  type="text" name="current_ctc" id="current_ctc" placeholder="Current CTC" value="<?php if(isset($candidate_details['current_ctc'])) echo $candidate_details['current_ctc'];?>" v>
									</div>
								</div>
							</div>
						</div>
						<div class="row">	
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Expected CTC </label>
								</div>
							</div>						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="expected_ctc" id="expected_ctc" placeholder="Expected CTC" class="form-control number" value="<?php if(isset($candidate_details['expected_ctc'])) echo $candidate_details['expected_ctc'];?>" >
									</div>
								</div>
							</div>					    
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">CTC Negotiable :</label>
								</div>
							</div>						
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
											<label class="form-label"><input type="radio" name="ctc_negotiable	" value="yes" <input type="radio" name="round2_status" value="yes" <?php if(isset($candidate_details['ctc_negotiable']) && $candidate_details['ctc_negotiable']=='yes') { echo "checked"; }?> checked>Yes</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="ctc_negotiable" value="no" <?php if(isset($candidate_details['ctc_negotiable']) && $candidate_details['ctc_negotiable']=='no') { echo "checked"; }?>>No</label>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Notice Period </label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="notice_period" id="notice_period" placeholder="Notice Period" class="form-control" value="<?php if(isset($candidate_details['notice_period'])) echo $candidate_details['notice_period'];?>" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Notice Negotiable</label>
								</div>
							</div>
						
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="notice_negotiable" value="yes" <?php if(isset($candidate_details['notice_negotiable']) && $candidate_details['notice_negotiable']=='yes') { echo "checked"; }?> checked>Yes</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="notice_negotiable" value="no" <?php if(isset($candidate_details['notice_negotiable']) && $candidate_details['notice_negotiable']=='no') { echo "checked"; }?> >No</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Interested</label>
								</div>
							</div>
						
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="is_interested	" value="yes" <?php if(isset($candidate_details['is_interested']) && $candidate_details['is_interested']=='yes') { echo "checked"; }?> checked>Yes</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="is_interested" value="no" <?php if(isset($candidate_details['is_interested']) && $candidate_details['is_interested']=='no') { echo "checked"; }?>>No</label>
									</div>
								</div>
							</div>
					    </div>


					    <div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Skills</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control"  type="text" name="skills" id="skills" placeholder="Skills" value="<?php if(isset($candidate_details['skills'])) echo $candidate_details['skills'];?>" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Total Experience </label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="total_yr_exp" id="total_yr_exp" placeholder="Total Experience" class="form-control" value="<?php if(isset($candidate_details['total_yr_exp'])) echo $candidate_details['total_yr_exp'];?>" >
									</div>
								</div>
							</div>
					    </div>


					    <div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Relevant Experience</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" type="text" name="relivant_yr_exp" id="relivant_yr_exp" placeholder="Relevant Experience" value="<?php if(isset($candidate_details['relivant_yr_exp'])) echo $candidate_details['relivant_yr_exp'];?>" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Current Location </label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="current_location" id="current_location" placeholder="Current Location" class="form-control" value="<?php if(isset($candidate_details['current_location'])) echo $candidate_details['current_location'];?>" >
									</div>
								</div>
							</div>
					    </div>
					    <div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Interview Schedule On:</label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<input type="text" id="schedule_date" name="schedule_date" value="<?php if(isset($candidate_details['schedule_date']) ){ echo $candidate_details['schedule_date']; } ?>" class="form-control" >
								</div>
							</div>
							<div class="col-lg-6 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea id="interview_comment" class="form-control" placeholder="comment here"   ><?php if(isset($candidate_details['schedule_comment'])){ echo $candidate_details['schedule_comment']; } ?></textarea>
									</div>
								</div>
							</div>
					    </div>

					    <div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Ready To Relocate</label>
								</div>
							</div>
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="ready_to_relocate" value="yes" <?php if(isset($candidate_details['ready_to_relocate']) && $candidate_details['ready_to_relocate']=='yes') { echo "checked"; }?> checked>Yes</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="ready_to_relocate" value="no" <?php if(isset($candidate_details['ready_to_relocate']) && $candidate_details['ready_to_relocate']=='no') { echo "checked"; }?> >No</label>
									</div>
								</div>
							</div>

							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Resume </label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="file" name="resume" id="resume">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
					    </div>			
					
				    	<div class="row">
							<div class="col-lg-6">
								<button class="btn btn-inline btn-success ladda-button" data-style="expand-left" id="save_profile"><span class="ladda-label">Submit</span>
								<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
								<input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
							</div>							
						</div>

					</div>
			</form> 
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
	
	$(document).ready(function(){
		$(".chosen-select").chosen();
		$('#datePicker, #datePicker1, #datePicker2, #schedule_date,#dob').datepicker({
		format: 'yyyy-mm-dd',
		maxDate: new Date()
	});

	$("#phone2").blur(function() {
  		if($('#phone1').val() == $('#phone2').val())
			{
			$('#phone2_err').text("Mobile number and Alternate number must not be same").show().delay(2000).fadeOut(1000);
				event.preventDefault();
				$('#save_profile').attr('disabled', true);
			}
		else
		{
			$('#save_profile').removeAttr('disabled');
		}
	});

	$("#phone1").blur(function() {
	  		if($('#phone1').val() == $('#phone2').val())
				{
				$('#phone1_err').text("Mobile number and Alternate number must not be same").show().delay(2000).fadeOut(1000);
					event.preventDefault();
					$('#save_profile').attr('disabled', true);
				}
			else
			{
				$('#save_profile').removeAttr('disabled');
			}
		});
	});
</script>