  <?php $can_type=$this->session->can_type;
$userdata = $this->session->userdata('logged_in_user');

/*debug($userdata);
	if(in_array($userdata['role_id'], $this->config->item('super_user_role_id')) || in_array($userdata['role_id'], $this->config->item('admin_user_role_id')) || in_array($userdata['role_id'], $this->config->item('hr_user_role_id'))){
		echo "show dropdown";
	}
	else
	{
		echo "show textbox";
	}
	exit;*/
?>

<!-- <?php //print_r($can_details->job_profile);die();?> -->
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
	<?php $this->load->view('candidate/can_menu');?>
	<div class="well">
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="profile_form" action="" method="post">
				<h1 class="well headline">Employee Profile Form</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Employee Name <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control alpha_only" placeholder="Your Full Name" type="text" name="can_name" required data-error="Please Enter Your Full Name" value="<?php echo (isset($can_details->can_name) && !empty($can_details->can_name)) ? $can_details->can_name : '';?>" >
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
										<textarea placeholder="Your Permanent Address" name="cur_address" id="cur_address" rows="3" class="form-control" required data-error="Please Enter Your Correspondence Address" value="<?php echo set_value('cur_address');?>"><?php echo (isset($can_details->cur_address) && !empty($can_details->cur_address)) ? $can_details->cur_address : '';?></textarea>
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
										<textarea placeholder="Your Permanent Address" name="per_address" id="per_address" rows="3" class="form-control" value="<?php echo set_value('per_address');?>"><?php echo (isset($can_details->per_address) && !empty($can_details->per_address)) ? $can_details->per_address : '';?></textarea>
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
										<input type="email" placeholder="Your Email Address" class="form-control" name="email" required value="<?php echo (isset($can_details->email) && !empty($can_details->email)) ? $can_details->email : '';?>" readonly>
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
									<div class="input-group input-append date" id="datePicker" data-date-end-date="-10y">
										<input type="text" class="form-control col-md-12 number" required data-error="Please Enter Birth Date"  name="dob" id="dob" placeholder="dd/mm/yyyy" value="<?php echo (isset($can_details->dob) && !empty($can_details->dob)) ? format_date($can_details->dob) : ''?>">
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
										<label class="form-label" required="">
											<input type="radio" name="gender" value="1" <?php if((isset($can_details->gender) && $can_details->gender==1) ) echo "checked";?> checked>Male</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="gender" value="0" <?php if((isset($can_details->gender) && $can_details->gender==0)) echo "checked";?>>Female</label>
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
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" minlength="10" maxlength="10" name="phone1" id="phone1" placeholder="Mobile Number Here" class="form-control number" value="<?php echo (isset($can_details->phone1) && !empty($can_details->phone1)) ? $can_details->phone1 : '';?>" required data-error="Please Enter Your Mobile Number" >
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
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" minlength="10" maxlength="10" name="phone2"  id="phone2" placeholder="Alternate Number Here" class="form-control number" value="<?php echo (isset($can_details->phone2) && !empty($can_details->phone2)) ? $can_details->phone2 : ''?>">
										<i class="fa fa-phone"></i>
											<span class="error_msg" id ="phone2_err"></span>
									</div>
								</div>
							</div>
					    </div>
									
						<div class="row">
						<?php //if(in_array($userdata['role_id'], $this->config->item('super_user_role_id')) || in_array($userdata['role_id'], $this->config->item('admin_user_role_id')) || in_array($userdata['role_id'], $this->config->item('hr_user_role_id'))){?>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Education Qualification <span>*</span></label>
								</div>
							</div>
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select class="web chosen-select col-md-10 col-sm-12 col-xs-12" name="qualification" id="qualification">
										<option value="" selected disabled>Select Your Education Qualification</option>
											<?php if(!empty($qualifications)){foreach ($qualifications as $qualification) {?>
										
											<option value="<?php echo $qualification->id?>" <?php if((isset($can_details->education) && $qualification->id == $can_details->education)) echo "selected";?>><?php echo $qualification->title?></option>
											<?php } }?>
										</select>									
									</div>
								</div>
							</div>
						<?php //} else { ?>

							<?php /*<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Education Qualification</label>
								</div>
							</div>
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="qualification" id="qualification" hidden  value="<?php echo $can_details->education?>">
									<?php if (!empty($can_details->education)) {if(!empty($qualifications)){
										foreach ($qualifications as $qualification) 
										{ 
										if($qualification->id == $can_details->education)
											{?>
										<input class="form-control" type="text" value="<?php echo (isset($qualification->title) && !empty($qualification->title)) ? $qualification->title : ''?>" readonly>
										<i class="fa fa-graduation-cap"></i>
										<?php } }} }else{?>
										<input class="form-control" type="text" value="" readonly>
										<i class="fa fa-graduation-cap"></i>
										<?php } ?>
									</div>
							</div>
						</div> */?>
						<?php //} ?>
					</div>
					
						<div class="row">
						<?php //if(in_array($userdata['role_id'], $this->config->item('super_user_role_id')) || in_array($userdata['role_id'], $this->config->item('admin_user_role_id')) || in_array($userdata['role_id'], $this->config->item('hr_user_role_id'))){?>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Department   <span>*</span></label>
								</div>
							</div>
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select class="chosen-select col-md-10 col-sm-12 col-xs-12" name="department" id="department" required data-error="Please Select Department">
										<option value="" selected disabled>Select Department</option>
											<?php if(!empty($departments)){ foreach ($departments as $department) {?>											
											<option value="<?php echo $department->id?>"><?php echo $department->title?></option>
											<?php } }?>
										</select>
										<span class="error_msg" id="err_dept"></span>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						<?php //} else { ?>
							<?php /*<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Department</label>
								</div>
							</div>
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="department" id="department" hidden  value="<?php echo $can_details->department?>">
									<?php if (!empty($can_details->department)) {if(!empty($departments)){
										foreach ($departments as $department) 
										{ 
										if($department->id == $can_details->department)
											{?>
										<input class="form-control" type="text" value="<?php echo (isset($department->title) && !empty($department->title)) ? $department->title : ''?>" readonly>
										<i class="fa fa-sitemap"></i>
										<?php } }} }else{?>
										<input class="form-control" type="text" value="" readonly>
										<i class="fa fa-sitemap"></i>
										<?php } ?>
									</div>
								</div>
							</div>
							 */?>
						<?php //} ?>
					</div>

						<div class="row">
						<?php //if(in_array($userdata['role_id'], $this->config->item('super_user_role_id')) || in_array($userdata['role_id'], $this->config->item('admin_user_role_id')) || in_array($userdata['role_id'], $this->config->item('hr_user_role_id'))){?>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Designation  <span>*</span></label>
								</div>
							</div>
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
									<select class="chosen-select col-md-10 col-sm-12 col-xs-12" name="job_profile" id="job_profile" required data-error="Please Select Designation">

										<?php foreach ($job_profiles as $profile)  {?> 
									<option value="<?php echo $profile->id; ?>"><?php echo $profile->title?></option>
											<?php 	}  ?>
										</select>
										<span class="error_msg" id="err_jp"></span>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						<?php //} else { ?>
						<?php /*	<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Designation  </label>
								</div>
							</div>
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="job_profile" id="job_profile" hidden  value="<?php echo $can_details->job_profile?>">
									<?php if (!empty($can_details->job_profile)) {if(!empty($job_profiles)){
										foreach ($job_profiles as $job_profile) 
										{ 
										if($job_profile->id == $can_details->job_profile)
											{?>
										<input class="form-control" type="text" value="<?php echo (isset($job_profile->title) && !empty($job_profile->title)) ? $job_profile->title : ''?>" readonly>
										<i class="fa fa-user"></i>
										<?php } }} }else{?>
										<input class="form-control" type="text" value="" readonly>
										<i class="fa fa-user"></i>
										<?php } ?>
									</div>
								</div>
							</div>
							 */?>
						<?php //} ?>
					    </div>

						<?php if($can_type!='user'){ ?>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Current CTC Per Year</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="current_ctc"  id="current_ctc" placeholder="Your Current CTC" class="form-control number" value="<?php echo (isset($can_details->current_ctc) && !empty($can_details->current_ctc)) ? $can_details->current_ctc : ''?>" maxlength="8">
										<i class="fa fa-rupee"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Expected CTC Per Year</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="expected_ctc" id="expected_ctc" placeholder="Your Expected CTC" class="form-control number" value="<?php echo  (isset($can_details->expected_ctc) && !empty($can_details->expected_ctc)) ? $can_details->expected_ctc : ''?>" maxlength="8">
										<i class="fa fa-rupee"></i>
									</div>
								</div>
							</div>
					    </div>
						<?php } ?> 
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Emergency Contact Name</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control alpha_only"  type="text" name="emer_contact_name" id="emer_contact_name" placeholder="Emergency Contact Name" value="<?php echo (isset($can_details->emer_contact_name) && !empty($can_details->emer_contact_name) )? $can_details->emer_contact_name : ''?>">
										<i class="fa fa fa-user"></i>
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
										<input type="text" minlength="10" maxlength="10" name="emer_contact_no" id="emer_contact_no" placeholder="Emergency Contact Number" class="form-control number" value="<?php echo (isset($can_details->emer_contact_no)) && !empty($can_details->emer_contact_no) ? $can_details->emer_contact_no : ''?>" data-error="Please Enter Valid Number">
										<i class="fa fa fa-phone"></i>
										<div class="help-block with-errors error_msg" id="emer_contact_no_err"></div>
									</div>
								</div>
							</div>
					   </div>
						
						<div class="row">
						<?php //if(in_array($userdata['role_id'], $this->config->item('super_user_role_id')) || in_array($userdata['role_id'], $this->config->item('admin_user_role_id')) || in_array($userdata['role_id'], $this->config->item('hr_user_role_id'))){?>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Aadhaar Card No. <span>*</span></label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
								
										<input type="text" name="aadhar_no" id="aadharcard-mask-input" placeholder="Aadhaar Card No." class="form-control number" value="<?php echo (isset($can_details->aadhar_no) && !empty($can_details->aadhar_no)) ? $can_details->aadhar_no : '';?>" required data-error="Please Enter Your Valid Aadhaar Card No.">
										<small class="text-muted">Aadhaar Card Format: 0000 0000 0000</small>
										<i class="font-icon font-icon-doc"></i>
										<div class="help-block with-errors error_msg" id="adhar_err"></div>
									</div>
								</div>
							</div>
						<?php //} else { ?>
						<?php /*<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Aadhaar Card No.</label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
								
										<input type="text" name="aadhar_no" id="aadharcard-mask-input" placeholder="Aadhaar Card No." class="form-control number" value="<?php echo (isset($can_details->aadhar_no) && !empty($can_details->aadhar_no)) ? $can_details->aadhar_no : '';?>" readonly>
										<small class="text-muted">Aadhaar Card Format: 0000 0000 0000</small>
										<i class="font-icon font-icon-doc"></i>
									</div>
								</div>
							</div>
							 */?>
						<?php //} ?>

						<?php //if(in_array($userdata['role_id'], $this->config->item('super_user_role_id')) || in_array($userdata['role_id'], $this->config->item('admin_user_role_id')) || in_array($userdata['role_id'], $this->config->item('hr_user_role_id'))){?>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Pan Card No. <span>*</span></label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="pan_no" id="pancard-mask-input" placeholder="Pan Card No." class="form-control uppercase" value="<?php echo (isset($can_details->pan_no) && !empty($can_details->pan_no)) ? $can_details->pan_no : '';?>" required data-error="Please Enter Your Valid Pan Card No.">
										<small class="text-muted">Pan Card Format: AAAAA0000A</small>

										<i class="font-icon font-icon-doc"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						<?php //} else { ?>
						<?php /* 	<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Pan Card No.</label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="pan_no" id="pancard-mask-input" placeholder="Pan Card No." class="form-control uppercase" value="<?php echo (isset($can_details->pan_no) && !empty($can_details->pan_no)) ? $can_details->pan_no : '';?>" readonly>
										<small class="text-muted">Pan Card Format: AAAAA0000A</small>

										<i class="font-icon font-icon-doc"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						 */?>
						<?php //} ?>
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
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label" required="">Ready to Relocate :</label>
								</div>
							</div>
						
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label" required=""><input type="radio" name="ready_to_relocate" value="1" <?php if((isset($can_details->ready_to_relocate) && $can_details->ready_to_relocate==1) )echo "checked";?>>Yes</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="ready_to_relocate" value="0" <?php if((isset($can_details->ready_to_relocate) && $can_details->ready_to_relocate==0)) echo "checked";?>>No</label>
									</div>
								</div>
							</div>
					    </div>



		   			<div class="row">
							<?php if(in_array($userdata['role_id'], $this->config->item('super_user_role_id')) || in_array($userdata['role_id'], $this->config->item('admin_user_role_id')) || in_array($userdata['role_id'], $this->config->item('hr_user_role_id'))){?>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Joining Date <span>*</span></label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="date form-group">
										<div class="input-group input-append date" id="datePicker2" data-date-end-date="0d">
											<input type="text" class="form-control number" name="joining_date" id="joining_date" placeholder="dd/mm/yyyy" value="<?php echo (isset($can_details->joining_date) && !empty($can_details->joining_date)) ? format_date($can_details->joining_date) : ''?>" required data-error="Please Enter Proper Joining Date.">
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
										<div class="help-block with-errors error_msg"></div>
									</div>
							</div>
							<?php } else { ?>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Joining Date</label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="date form-group">
										<div class="input-group input-append date" id="" data-date-end-date="0d">
											<input type="text" class="form-control number" name="joining_date" id="joining_date" placeholder="dd/mm/yyyy" value="<?php echo (isset($can_details->joining_date) && !empty($can_details->joining_date)) ? format_date($can_details->joining_date) : ''?>" data-error="Please Enter Proper Joining Date." readonly>
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
										<div class="help-block with-errors error_msg"></div>
								</div>
							</div>
							<?php } ?>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Probation Period</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select class="chosen-select" name="probation_period" id="probation_period">
											<option value="0">Select No Of Months</option>
											<?php for ($i=1; $i < 13 ; $i++) { ?>
												<option value="<?php echo $i;?>" <?php if($can_details->probation_period == $i){ echo "selected";}?>><?php echo $i;?></option>
											<?php }?>
										</select>
										<div class="help-block with-errors error_msg" id="emer_contact_no_err"></div>
									</div>
								</div>
							</div>
					   </div>
					   <input type="hidden" name="probation_end_date" id='probation_end_date' value="<?php echo !empty($can_details->probation_end_date) ? $can_details->probation_end_date: '';?>">
					   <?php /*
				       <div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Joining Date <span> * </span></label>
								</div>
							</div>

						<?php if(in_array($userdata['role_id'], $this->config->item('super_user_role_id')) || in_array($userdata['role_id'], $this->config->item('admin_user_role_id')) || in_array($userdata['role_id'], $this->config->item('hr_user_role_id'))){?>
							<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="date form-group">
										<div class="input-group input-append date" id="datePicker2" data-date-end-date="0d">
											<input type="text" class="form-control number" name="joining_date" id="joining_date" placeholder="dd/mm/yyyy" value="<?php echo (isset($can_details->joining_date) && !empty($can_details->joining_date)) ? format_date($can_details->joining_date) : ''?>" required data-error="Please Enter Proper Joining Date.">
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
						<?php } else { ?>
							<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="date form-group">
										<div class="input-group input-append date" id="" data-date-end-date="0d">
											<input type="text" class="form-control number" name="joining_date" id="joining_date" placeholder="dd/mm/yyyy" value="<?php echo (isset($can_details->joining_date) && !empty($can_details->joining_date)) ? format_date($can_details->joining_date) : ''?>" data-error="Please Enter Proper Joining Date." readonly>
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
						<?php } ?>
						</div>
						<?php */?>
						        <div class="row">
                    <?php if($can_type!='user'){ ?>
                    <div class="col-lg-2 col-sm-3 col-xs-12 ">
                            <div class="form-group">
                                    <label class="form-label">Role</label>
                            </div>
                    </div>

                     <div class="col-lg-4 col-sm-9 col-xs-12">
                            <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                            <select class="form-control select2-arrow manual select2-no-search-arrow disabled" name="role" id="role" >
                                                    <option value="" selected disabled>Select Role</option>
                                                    <?php foreach ($roles as $role) {?>                                                             
                                                    <option  value="<?php echo $role->role_id?>" <?php if(isset($can_details->role_id) &&($role->role_id == $can_details->role_id)) echo "selected";?>><?php echo $role->role_name?></option>
                                                    <?php } ?>

                                            </select>

                                    </div>
                            </div>
                    </div>
                    <?php }
                    else
                    {
                     ?>
                    <div class="col-lg-2 col-sm-3 col-xs-12">
                            <div class="form-group">
                                    <label class="form-label">Role </label>
                            </div>
                    </div>

                    <div class="col-lg-4 col-sm-9 col-xs-12">
                            <div class="form-group">
                            <div class="form-control-wrapper form-control-icon-right">
                            <input type='text' class="form-control" readonly id="role-name" value="<?php echo $can_type; ?>">
                            <input type='hidden'  class="form-control"  name='role' value=" <?php if(isset($can_details->role_id)) echo $can_details->role_id; ?>" >
                            </div>
                            </div>
                    </div>

                    <?php
                    }?>
               <input type="hidden" name="rpo_role_name" id="rpo_role_name">
 					<?php if(in_array($userdata['role_id'], $this->config->item('super_user_role_id')) || in_array($userdata['role_id'], $this->config->item('admin_user_role_id')) || in_array($userdata['role_id'], $this->config->item('hr_user_role_id'))){?>
                <div class="col-lg-2 col-sm-3 col-xs-12">
                            <div class="form-group">
                                    <label class="form-label">Reporting To <span>*</span></label>
                            </div>
                    </div>

                    <div class="col-lg-4 col-sm-9 col-xs-12">
                            <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
 									  <select class="chosen-select col-md-12 col-sm-12 col-xs-12" name="reporting_to" id="reporting_to" required data-error="Please Select Reporting Authority" >     
                        			</select>
									<span class="error_msg" id="err_rpt"></span>                                   
									<div class="help-block with-errors error_msg"></div>
                                    </div>
                            </div>
                    </div>
                    <?php }
                    else
                    {
                     ?>
                        <div class="col-lg-2 col-sm-3 col-xs-12">
                            <div class="form-group">
                                    <label class="form-label">Reporting To </label>
                            </div>
                    </div>

                    <div class="col-lg-4 col-sm-9 col-xs-12">
                            <div class="form-group">
                            <div class="form-control-wrapper form-control-icon-right">
                            <input type='hidden' class="form-control" name='reporting_to' id="reporting_to1" value="<?php echo $can_details->reporting_to; ?>">
                            <input type='text'  class="form-control" value="<?php echo (isset($reporting_to['can_name']) && !empty($reporting_to['can_name'])) ? $reporting_to['can_name'] : '';?>" readonly>
                            </div>
                            </div>
                    </div>

                    <?php
                    }?>
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
	var sel_dept_id="<?php echo $can_details->department?>";
	var url1 = '<?php echo site_url()?>' + '/candidate/hod_as_reporting_mgr';

		$.ajax({
			type: "POST",
			data:{dept_id:sel_dept_id},
			url: url1,
			dataType :'json',
			success: function(response){
				//console.log(response);
			$("#reporting_to").html(response).trigger('chosen:updated');
			$("#reporting_to").val("<?php echo $can_details->reporting_to?>").trigger("chosen:updated");
			}		
		});



		$('#department').change(function () { 
			var dept_id = $('#department option:selected').val();
			var url = '<?php echo site_url()?>' + '/candidate/get_desig_by_dept';
		
			$.ajax({
				type: "POST",
				data:{dept_id:dept_id},
				url: url,
				dataType :'json',
				success: function(response){
					//console.log(response);
				$("#job_profile").html(response).trigger('chosen:updated');
				
				}		
			});

			var url2 = '<?php echo site_url()?>' + '/candidate/hod_as_reporting_mgr';

			$.ajax({
				type: "POST",
				data:{dept_id:dept_id},
				url: url2,
				dataType :'json',
				success: function(response){
					//console.log(response);
				$("#reporting_to").html(response).trigger('chosen:updated');
				$("#reporting_to").val("<?php echo $can_details->reporting_to?>").trigger("chosen:updated");
				}		
			});
		});

	$('#probation_period').change(function () { 
		var probation_period = $('#probation_period option:selected').val();
		var doj = $('#joining_date').val();
		var date_arr = [];
		date_arr = doj.split("/");
		var pdate = date_arr[0];
		var month = parseInt(date_arr[1]) + parseInt(probation_period);
		if(month>12)
		{
			month = month - 12;
		}
		var year = date_arr[2];
		if(month<9)
		{
			month = '0'+month;
		}
		probation_end_date = pdate+'/'+month+'/'+year;
		$('#probation_end_date').val(probation_end_date);
	});


	$(".chosen-select").chosen();
		//$("#job_profile").trigger('chosen:updated');
		//$('#reporting_to').val(38);
        //$('#reporting_to').trigger("chosen:updated");
		 
		var dept_id="<?php echo $can_details->department?>";

		

	    $("#department").val(dept_id).trigger("chosen:updated");
		 // $("#department").trigger("change");

		 var job_profile="<?php echo $can_details->job_profile?>";

		

	    $("#job_profile").val(job_profile).trigger("chosen:updated");
		 // $("#job_profile").trigger("change");
		 //('#reporting_to').val(38).prop("selected", true).trigger("liszt:updated");

		 //$("#reporting_to").val("38").trigger("liszt:updated");
		 //$("#reporting_to").val("38").trigger("chosen:updated.chosen");
		 // $("#reporting_to").val(38);

	$('#datePicker, #datePicker1, #datePicker2').datepicker({
		format: 'dd/mm/yyyy',
		maxDate: new Date()
	});

	$('#datePicker').on('changeDate', function(e) {
       	$('#datePicker2').datepicker('setStartDate', $('#joining_date').val());
		var start = $(this).datepicker('getDate');
        var end = $('#datePicker2').datepicker('getDate');
        var days = (end - start) / (1000 * 60 * 60 * 24);
        if(days <= 0)
        {
        	$('#joining_date').val('');
        	$('#joining_date_err').text("Date of birth cannot be less than ").show().delay(2000).fadeOut(800);
        }
    });

    $('#datePicker2').on('changeDate', function(e) {
       	$('#datePicker').datepicker('setStartDate', $('#joining_date').val());
		var start = $('#datePicker').datepicker('getDate');
        var end = $(this).datepicker('getDate');
        var days = (end - start) / (1000 * 60 * 60 * 24);
        if(days <= 0)
        {
        	$('#joining_date').val('');
        	$('#joining_date_err').text("Date of birth cannot be less than ").show().delay(2000).fadeOut(800);
        }
    });

	$('#role').change(function(){
		if($("#role option:selected").text()=='RPO')
		{
			$('#rpo_role_name').val('rpo');
			console.log($("#role option:selected").text());
		}
		else
		{
			$('#rpo_role_name').val('');
		}
	});


	$("#phone2").blur(function() {
		if($('#phone2').val().trim() != '')
		{
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
		}
		else
		{
			$('#save_profile').removeAttr('disabled');
		}
	});

	$("#emer_contact_no").blur(function() {
  		if($('#emer_contact_no').val() != '')
		{
			if(($('#emer_contact_no').val() < 1000000000) || ($('#emer_contact_no').val() > 9999999999))
	    	{
	        	$('#emer_contact_no_err').text("Please Enter Valid Number").show().delay(2000).fadeOut(800);
	        	$('#save_profile').attr('disabled', true);
	    	}
	    	else
	    	{
	    		$('#save_profile').removeAttr('disabled');
	    	}
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

	$("#save_profile").click(function(){
		// alert("One");
		if($('#job_profile').val()==null)
		{				
			$('#err_jp').html('Please Select Designation').show().delay(2000).fadeOut(1000);
			// $("html, body").animate({ scrollTop: 50 }, "slow");
			// return false;				
		}
		else if($('#department').val()==null)
		{
			$('#err_dept').html('Please Select Department').show().delay(2000).fadeOut(1000);
			// $("html, body").animate({ scrollTop: 100 }, "slow");
			// return false;	
		}
		else if($('#reporting_to').val()==null)
		{
			$('#err_rpt').html('Please Select Reporting Authority').show().delay(2000).fadeOut(1000);
			// return false;	
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


