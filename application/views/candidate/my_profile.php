<?php $userdata = $this->session->userdata('logged_in_user');?>
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
		<?php //$this->load->view('candidate/can_menu');?>
		<div class="col-sm-12">
			<div class="row">
				<div class="menu_btns">
					<a href="<?php echo site_url();?>/candidate/update/<?php echo $userdata['id'];?>">
					<button type="button" class="btn btn-inline btn-success">Profile Details</button>
					</a>
					<a href="<?php echo site_url();?>/candidate/bank_details/<?php echo $userdata['id'];?>">
					<button type="button" class="btn btn-inline btn-success">Bank Details</button>
					</a>
					<a href="<?php echo site_url();?>/candidate/documents/<?php echo $userdata['id'];?>">
					<button type="button" class="btn btn-inline btn-success">Documents</button>
					</a>
					<a href="<?php echo site_url();?>/candidate/billing/<?php echo $userdata['id'];?>">
					<button type="button" class="btn btn-inline btn-success">Billing</button>
					</a>
					<a href="<?php echo site_url();?>/candidate/experience/<?php echo $userdata['id'];?>">
					<button type="button" class="btn btn-inline btn-success">Experience</button>
					</a>
					<a href="<?php echo site_url();?>/candidate/investment/<?php echo $userdata['id'];?>">
					<button type="button" class="btn btn-inline btn-success">Investment</button>
					</a>
					<a href="<?php echo site_url();?>/candidate/reference/<?php echo $userdata['id'];?>">
					<button type="button" class="btn btn-inline btn-success">Professional Reference</button>
					</a>
					<a href="<?php echo site_url();?>/candidate/interview_reference/<?php echo $userdata['id'];?>">
					<button type="button" class="btn btn-inline btn-success">Friends Reference</button>
					</a>
				</div>
			</div>
		</div>
	<div class="well">
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="my_profile_form" action="" method="post">
				<h1 class="well headline">My Profile Form</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Full Name<span>*</span></label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Your Full Name" type="text" name="can_name" required data-error="Please Enter Your Full Name"  value="<?php echo !empty($user_details->can_name) ? $user_details->can_name : '';?>" value="<?php echo set_value('can_name');?>">
										<i class="fa fa-user"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Correspondence Address<span>*</span></label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea placeholder="Your Permanent Address" name="cur_address" id="cur_address" rows="3" class="form-control" required data-error="Please Enter Your Correspondence Address" value="<?php echo !empty($user_details->cur_address) ? $user_details->cur_address : '';?>" value="<?php echo set_value('cur_address');?>"><?php echo $user_details->cur_address;?></textarea>
										<i class="fa fa-address-card"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Permanant Address</label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea placeholder="Your Permanent Address" name="per_address" id="per_address" rows="3" class="form-control" value="<?php echo !empty($user_details->per_address) ? $user_details->per_address : '';?>" value="<?php echo set_value('per_address');?>"><?php echo $user_details->per_address;?></textarea>
										<i class="fa fa-address-card"></i>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Email Address<span>*</span></label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="Your Email Address" class="form-control" name="email" required value="<?php echo !empty($user_details->email) ? $user_details->email : '';?>" value="<?php echo $user_details->email?>" readonly>
										<i class="fa fa-envelope"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Date of Birth</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="date form-group">
									<div class="input-group input-append date" id="datePicker" data-date-end-date="0d">
										<input type="text" class="form-control" name="dob" id="dob" placeholder="dd/mm/yyyy" value="<?php echo !empty($user_details->dob) ? format_date($user_details->dob) : ''?>">
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Mobile Number<span>*</span></label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" minlength="10" maxlength="10" name="phone1" id="phone1" placeholder="Mobile Number Here" class="form-control number"  value="<?php echo !empty($user_details->phone1) ? $user_details->phone1 : '';?>" value="<?php echo $user_details->phone1?>" required data-error="Please Enter Your Mobile Number">
										<i class="fa fa-mobile"></i>
											<span class="error_msg" id ="phone1_err"></span>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Alternate Number</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="phone2"  id="phone2" placeholder="Alternate Number Here" class="form-control number" value="<?php echo !empty($user_details->phone2) ? $user_details->phone2 : '';?>" value="<?php echo $user_details->phone2?>">
										<i class="fa fa-phone"></i>
											<span class="error_msg" id ="phone2_err"></span>
									</div>
								</div>
							</div>
					    </div>
									
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Education Qualification</label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select class="web chosen-select col-md-10 col-sm-12 col-xs-12" name="qualification" id="qualification">
											<option value="" selected disabled>Select Your Education Qualification</option>
											<?php foreach ($qualifications as $qualification) {?>
												
											<option value="<?php echo $qualification->id?>" <?php if($qualification->id == $user_details->education) echo "selected";?>><?php echo $qualification->title?></option>
											<?php } ?>
										</select>									
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Designation :</label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select class="web chosen-select col-md-10 col-sm-12 col-xs-12" name="job_profile" id="job_profile">
											<option value="" selected="" disabled>Select Your Designation</option>
											<?php foreach ($job_profiles as $profile) {?>											
											<option value="<?php echo $profile->id?>" <?php if($profile->id == $user_details->job_profile) echo "selected";?>><?php echo $profile->title?></option>
											<?php } ?>
										</select>										
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Current CTC Per Year</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="current_ctc"  id="current_ctc" placeholder="Your Current CTC" class="form-control number" value="<?php echo !empty($user_details->current_ctc) ? $user_details->current_ctc : ''?>" value="<?php echo $user_details->current_ctc?>">
										<i class="fa fa-rupee"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Expected CTC Per Year</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="expected_ctc" id="expected_ctc" placeholder="Your Expected CTC" class="form-control number" value="<?php echo !empty($user_details->expected_ctc) ? $user_details->expected_ctc : ''?>" value="<?php echo $user_details->expected_ctc?>">
										<i class="fa fa-rupee"></i>
									</div>
								</div>
							</div>
					    </div>

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Emergency Contact Name</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="emer_contact_name" id="emer_contact_name" placeholder="Emergency Contact Name" class="form-control alpha_only" value="<?php echo !empty($user_details->emer_contact_name) ? $user_details->emer_contact_name : ''?>" value="<?php echo $user_details->emer_contact_name?>">
										<i class="fa fa fa-phone"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Emergency Contact Number</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" minlength="10" maxlength="10" name="emer_contact_no" id="emer_contact_no" placeholder="Emergency Contact Number" class="form-control number" value="<?php echo !empty($user_details->emer_contact_no) ? $user_details->emer_contact_no : ''?>" value="<?php echo $user_details->emer_contact_no?>" data-error="Please Enter Valid Number">
										<i class="fa fa fa-phone"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
					    </div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Aadhaar Card No.<span>*</span></label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="aadhar_no" id="aadharcard-mask-input" placeholder="Aadhaar Card No." class="form-control number" value="<?php echo $user_details->aadhar_no?>" required data-error="Please Enter Your Valid Aadhaar Card No.">
										<small class="text-muted">Aadhaar Card Format: 0000 0000 0000</small>
										<i class="font-icon font-icon-doc"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Pan Card No.<span>*</span></label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="pan_no" id="pancard-mask-input" placeholder="Pan Card No." class="form-control uppercase" value="<?php echo $user_details->pan_no?>" required data-error="Please Enter Your Valid Pan Card No.">
										<small class="text-muted">Pan Card Format: AAAAA0000A</small>

										<i class="font-icon font-icon-doc"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
					    </div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Blood Group</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
									 <select id="blood_group" name="blood_group" class="chosen-select web col-lg-12" required>
                                            <optgroup label="Blood Group">
	                                            <option value="A+" <?php echo (@$can_details->blood_group == 'A+') ? 'selected' : ''; ?>>A+</option>
	                                            <option value="A-" <?php echo (@$can_details->blood_group == 'A-') ? 'selected' : ''; ?>>A-</option>
	                                            <option value="B+" <?php echo (@$can_details->blood_group == 'B+') ? 'selected' : ''; ?>>B+</option>
	                                            <option value="B-" <?php echo (@$can_details->blood_group == 'B-') ? 'selected' : ''; ?>>B-</option>
	                                            <option value="AB+" <?php echo (@$can_details->blood_group == 'AB+') ? 'selected' : ''; ?>>AB+</option>
	                                            <option value="AB-" <?php echo (@$can_details->blood_group == 'AB-') ? 'selected' : ''; ?>>AB-</option>
	                                            <option value="O+" <?php echo (@$can_details->blood_group == 'O+') ? 'selected' : ''; ?>>O+</option>
	                                            <option value="O-" <?php echo (@$can_details->blood_group == 'O-') ? 'selected' : ''; ?>>O-</option>
                                            </optgroup>
                                        </select>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label" required="">Ready to Relocate :</label>
								</div>
							</div>
						
							<div class=col-lg-2>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label" required=""><input type="radio" name="ready_to_relocate" value="1" 	<?php if($user_details->ready_to_relocate==1) echo "checked";?>>Yes</label>
									</div>
								</div>
							</div>
							<div class=col-lg-2>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="ready_to_relocate" value="0" <?php if($user_details->ready_to_relocate==0) echo "checked";?>>No</label>
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


<script>
	
$(document).ready(function() {
		$(".chosen-select").chosen();
		$('#datePicker, #datePicker1, #datePicker2').datepicker({
		format: 'dd/mm/yyyy',
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