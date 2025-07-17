<?php
	$userdata = $this->session->userdata('logged_in_user');
?>
<div class="page-content">
	<div class="container-fluid">
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
		<?php $this->load->view('rpo_manager/rpo_emp_menu');?>
	<div class="well">
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="rpo_profile_form" action="" method="post">
				<h1 class="well headline">RPO Employee Profile Form</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<input type='hidden' class="form-control" name='can_id' id="can_id" value="<?php echo $rpo_can_details['can_id']; ?>">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Employee Name <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control alpha_only" placeholder="Your Full Name" type="text" name="can_name" required data-error="Please Enter Your Full Name" value="<?php echo (isset($rpo_can_details['can_name']) && !empty($rpo_can_details['can_name'])) ? $rpo_can_details['can_name'] : '';?>" >
										<i class="fa fa-user"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Correspondence Address <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea placeholder="Your Permanent Address" name="cur_address" id="cur_address" rows="3" class="form-control" required data-error="Please Enter Your Correspondence Address" value="<?php echo set_value('cur_address');?>"><?php echo (isset($rpo_can_details['cur_address']) && !empty($rpo_can_details['cur_address'])) ? $rpo_can_details['cur_address'] : '';?></textarea>
										<i class="fa fa-address-card"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Permanant Address</label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea placeholder="Your Permanent Address" name="per_address" id="per_address" rows="3" class="form-control" value="<?php echo set_value('per_address');?>"><?php echo (isset($rpo_can_details['per_address']) && !empty($rpo_can_details['per_address'])) ? $rpo_can_details['per_address ']: '';?></textarea>
										<i class="fa fa-address-card"></i>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Email Address <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="email" placeholder="Your Email Address" class="form-control" name="email" required value="<?php echo (isset($rpo_can_details['email_id']) && !empty($rpo_can_details['email_id'])) ? $rpo_can_details['email_id'] : '';?>">
										<i class="fa fa-envelope"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Date of Birth <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="date form-group">
									<div class="input-group input-append date" id="datePicker" data-date-end-date="0d">
										<input type="text" class="form-control col-md-12 " required data-error="Please Enter Birth Date"  name="dob" id="dob" placeholder="dd/mm/yyyy" value="<?php echo (isset($rpo_can_details['dob']) && !empty($rpo_can_details['dob'])) ? format_date($rpo_can_details['dob']) : ''?>">
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label" required="">Gender :</label>
								</div>
							</div>
						
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label" required=""><input type="radio" name="gender" value="1" <?php if((isset($rpo_can_details['gender']) && $rpo_can_details['gender']==1) ) echo "checked";?> checked>Male</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="gender" value="0" <?php if((isset($rpo_can_details['gender']) && $rpo_can_details['gender']==0)) echo "checked";?>>Female</label>
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
										<input type="text" minlength="10" maxlength="10" name="phone1" id="phone1" placeholder="Mobile Number Here" class="form-control number" value="<?php echo (isset($rpo_can_details['phone1']) && !empty($rpo_can_details['phone1'])) ? $rpo_can_details['phone1'] : '';?>" required data-error="Please Enter Your Mobile Number" >
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
										<input type="text" minlength="10" maxlength="10" name="phone2"  id="phone2" placeholder="Alternate Number Here" class="form-control number" value="<?php echo (isset($rpo_can_details['phone2']) && !empty($rpo_can_details['phone2'])) ? $rpo_can_details['phone2'] : ''?>">
										<i class="fa fa-phone"></i>
											<span class="error_msg" id ="phone2_err"></span>
									</div>
								</div>
							</div>
					   </div>
									
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Blood Group</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select id="blood_group" name="blood_group" class="chosen-select web col-lg-12" required>
                                 <optgroup label="Blood Group">
	                                   <option value="A+" <?php echo (@$rpo_can_details['blood_group'] == 'A+') ? 'selected' : ''; ?>>A+</option>
	                                   <option value="A-" <?php echo (@$rpo_can_details['blood_group'] == 'A-') ? 'selected' : ''; ?>>A-</option>
	                                   <option value="B+" <?php echo (@$rpo_can_details['blood_group'] == 'B+') ? 'selected' : ''; ?>>B+</option>
	                                   <option value="B-" <?php echo (@$rpo_can_details['blood_group'] == 'B-') ? 'selected' : ''; ?>>B-</option>
	                                   <option value="AB+" <?php echo (@$rpo_can_details['blood_group'] == 'AB+') ? 'selected' : ''; ?>>AB+</option>
	                                   <option value="AB-" <?php echo (@$rpo_can_details['blood_group'] == 'AB-') ? 'selected' : ''; ?>>AB-</option>
	                                   <option value="O+" <?php echo (@$rpo_can_details['blood_group'] == 'O+') ? 'selected' : ''; ?>>O+</option>
	                                   <option value="O-" <?php echo (@$rpo_can_details['blood_group'] == 'O-') ? 'selected' : ''; ?>>O-</option>
                                 </optgroup>
                              </select>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Education Qualification</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control alpha_only" placeholder="Enter Qualification" type="text" name="education_qualification" id="education_qualification" value="<?php echo (isset($rpo_can_details['education_qualification']) && !empty($rpo_can_details['education_qualification'])) ? $rpo_can_details['education_qualification'] : '';?>" >
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Designation : <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control alpha_only" placeholder="Enter Designation" type="text" name="designation" id="designation" value="<?php echo (isset($rpo_can_details['designation']) && !empty($rpo_can_details['designation'])) ? $rpo_can_details['designation'] : '';?>" >								
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Department : </label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control alpha_only" placeholder="Enter Department" type="text" name="department" id="department" value="<?php echo (isset($rpo_can_details['department']) && !empty($rpo_can_details['department'])) ? $rpo_can_details['department'] : '';?>" >								
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
					   </div>
 
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Emergency Contact Name</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control alpha_only"  type="text" name="emer_contact_name" id="emer_contact_name" placeholder="Emergency Contact Name" value="<?php echo (isset($rpo_can_details['emer_contact_name']) && !empty($rpo_can_details['emer_contact_name']) )? $rpo_can_details['emer_contact_name'] : ''?>">
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Emergency Contact Number</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" minlength="10" maxlength="10" name="emer_contact_no" id="emer_contact_no" placeholder="Emergency Contact Number" class="form-control number" value="<?php echo (isset($rpo_can_details['emer_contact_no'])) && !empty($rpo_can_details['emer_contact_no']) ? $rpo_can_details['emer_contact_no'] : ''?>" data-error="Please Enter Valid Number">
										<i class="fa fa fa-phone"></i>
										<div class="help-block with-errors error_msg" id="emer_contact_no_err"></div>
									</div>
								</div>
							</div>
					   </div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Aadhaar Card No. <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="aadhar_no" id="aadharcard-mask-input" placeholder="Aadhaar Card No." class="form-control number" value="<?php echo (isset($rpo_can_details['aadhar_no']) && !empty($rpo_can_details['aadhar_no'])) ? $rpo_can_details['aadhar_no'] : '';?>" required data-error="Please Enter Your Valid Aadhaar Card No.">
										<small class="text-muted">Aadhaar Card Format: 0000 0000 0000</small>
										<i class="font-icon font-icon-doc"></i>
										<div class="help-block with-errors error_msg" id="adhar_err"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Pan Card No. <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="pan_no" id="pancard-mask-input" placeholder="Pan Card No." class="form-control uppercase" value="<?php echo (isset($rpo_can_details['pan_no']) && !empty($rpo_can_details['pan_no'])) ? $rpo_can_details['pan_no'] : '';?>" required data-error="Please Enter Your Valid Pan Card No.">
										<small class="text-muted">Pan Card Format: AAAAA0000A</small>

										<i class="font-icon font-icon-doc"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
					   </div>
						
					
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Joining Date <span> * </span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="date form-group">
										<div class="input-group input-append date" id="datePicker2" data-date-end-date="0d">
											<input type="text" class="form-control" name="joining_date" id="joining_date" placeholder="dd/mm/yyyy" value="<?php echo (isset($rpo_can_details['joining_date']) && !empty($rpo_can_details['joining_date'])) ? format_date($rpo_can_details['joining_date']) : ''?>" required data-error="Please Enter Joining Date.">
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
										<div class="help-block with-errors error_msg"></div>
									</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label" required="">Job Type :</label>
								</div>
							</div>
						
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label" required=""><input type="radio" name="job_type" value="1" <?php if((isset($rpo_can_details['job_type']) && $rpo_can_details['job_type']==1) ) echo "checked";?> checked>Contract</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="job_type" value="0" <?php if((isset($rpo_can_details['job_type']) && $rpo_can_details['job_type']==0)) echo "checked";?>>Permanent</label>
									</div>
								</div>
							</div>
						</div>           

				    	<div class="row">
							<div class="col-lg-6">
								<button type="submit" class="btn btn-inline btn-success ladda-button" data-style="expand-left" id="save_profile"><span class="ladda-label">Submit</span>
								<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
								<input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
								<!-- <input type="button" class="btn btn-inline ladda-button" data-style="expand-left" value="Submit">
								<input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset"> -->
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

		$("#phone1").blur(function() {
	  		if($('#phone1').val() == $('#phone2').val())
			{
				$('#phone1_err').text("Mobile number and Alternate number must not be same").show().delay(2000).fadeOut(1000);
					event.preventDefault();
					$('#save_profile').attr('disabled', true);
			}
			else if(($('#phone1').val() < 1000000000) || ($('#phone1').val() > 9999999999) || ($('#phone1').val() == ''))
		    {
		        $('#phone1_err').text("Please Enter Valid Mobile Number").show().delay(2000).fadeOut(800);
		        $('#save_profile').attr('disabled', true);
		    }
			else
			{
				$('#save_profile').removeAttr('disabled');
			}
		});

		$("#phone2").blur(function() {
	  		if($('#phone1').val() == $('#phone2').val())
			{
				$('#phone2_err').text("Mobile number and Alternate number must not be same").show().delay(2000).fadeOut(1000);
					event.preventDefault();
					$('#save_profile').attr('disabled', true);
			}
			else if(($('#phone2').val() < 1000000000) || ($('#phone2').val() > 9999999999))
		    {
		        $('#phone2_err').text("Please Enter Valid Mobile Number").show().delay(2000).fadeOut(800);
		        $('#save_profile').attr('disabled', true);
		    }
			else
			{
				$('#save_profile').removeAttr('disabled');
			}
		});

		$('#aadharcard-mask-input').on('blur', function(){
			var adhar = $('#aadharcard-mask-input').val();
			adhar = adhar.replace(/\ /g, '');
			if(adhar < 100000000000 || adhar > 999999999999)
			{
				$('#adhar_err').html('Please Enter Valid Aadhar Number').show().delay(2000).fadeOut(1000);
				$('#save_profile').attr('disabled', true);
			}
			else
			{
				$('#save_profile').removeAttr('disabled');
			}
		});

	});

</script>


