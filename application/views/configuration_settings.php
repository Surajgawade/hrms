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
	<div class="well">
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="config_form" action="" method="post" enctype="multipart/form-data">
				<h1 class="well headline">Configuration Settings Form</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">No. of Users <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="No. of Users" type="text" name="user_add_permissions" required data-error="Please Enter No. of Users" value="<?php echo !empty($configuration_settings['user_add_permissions']) ? $configuration_settings['user_add_permissions'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Super User Role Id <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Super User" type="text" name="super_user_role_id" required data-error="Please Enter Super User Role Id" value="<?php echo !empty($configuration_settings['super_user_role_id']) ? $configuration_settings['super_user_role_id'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Admin User Role Id <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Admin User" type="text" name="admin_user_role_id" required data-error="Please Enter Admin User Role Id" value="<?php echo !empty($configuration_settings['admin_user_role_id']) ? $configuration_settings['admin_user_role_id'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">HR User Role Id <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="HR User" type="text" name="hr_user_role_id" required data-error="Please Enter HR User Role Id" value="<?php echo !empty($configuration_settings['hr_user_role_id']) ? $configuration_settings['hr_user_role_id'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">No. of Saturdays Off <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Saturdays off" type="text" name="weekoff_sat" required data-error="Please Enter No. of Saturdays Off" value="<?php echo !empty($configuration_settings['weekoff_sat']) ? $configuration_settings['weekoff_sat'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Hours per Day <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Hours per Day" type="text" name="hours_per_day" required data-error="Please Enter Hours per day" value="<?php echo !empty($configuration_settings['hours_per_day']) ? $configuration_settings['hours_per_day'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Grace Time <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Grace Time" type="text" name="grace_time" required data-error="Please Enter Grace time" value="<?php echo !empty($configuration_settings['grace_time']) ? $configuration_settings['grace_time'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Half Hours per Day <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Half Hours per Day" type="text" name="half_hours_per_day" required data-error="Please Enter Half hours per day" value="<?php echo !empty($configuration_settings['half_hours_per_day']) ? $configuration_settings['half_hours_per_day'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>
									
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Late Mark Time <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Late mark time" type="text" name="late_mark_time" required data-error="Please Enter Late Mark Time" value="<?php echo !empty($configuration_settings['late_mark_time']) ? $configuration_settings['late_mark_time'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Office Out Time <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Office Out Time" type="text" name="office_out_time" required data-error="Please Enter Office Out Time" value="<?php echo !empty($configuration_settings['office_out_time']) ? $configuration_settings['office_out_time'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">HR Email Id <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="HR Email Id" type="text" name="hr_email" required data-error="Please Enter HR Email Id" value="<?php echo !empty($configuration_settings['hr_email']) ? $configuration_settings['hr_email'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Company Name <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Company Name" type="text" name="company_name" required data-error="Please Enter Company Name" value="<?php echo !empty($configuration_settings['company_name']) ? $configuration_settings['company_name'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Company Address <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Company Address" type="text" name="address" required data-error="Please Enter Company Address" value="<?php echo !empty($configuration_settings['address']) ? $configuration_settings['address'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Company Contact Number <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Company Contact Number" type="text" name="contact_no" required data-error="Please Enter Company Contact Number" value="<?php echo !empty($configuration_settings['contact_no']) ? $configuration_settings['contact_no'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Proxy IPs <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Proxy IPs" type="text" name="proxy_ips" required data-error="Please Enter Proxy IPs" value="<?php echo !empty($configuration_settings['proxy_ips']) ? $configuration_settings['proxy_ips'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Year Start Date <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="date form-group">
									<div class="input-group input-append date" id="datePicker">
										<input class="form-control" placeholder="Year Start Date" type="text" name="year_start_date" id="year_start_date" required data-error="Please Enter Year Start Date" value="<?php echo !empty($configuration_settings['year_start_date']) ? db_to_date($configuration_settings['year_start_date']) : '';?>">
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
									<div class="help-block with-errors error_msg"></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Year End Date <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="date form-group">
										<div class="input-group input-append date" id="datePicker1">
											<input class="form-control" placeholder="Year End Date" type="text" name="year_end_date" id="year_end_date" required data-error="Please Enter Year End Date" value="<?php echo !empty($configuration_settings['year_end_date']) ? db_to_date($configuration_settings['year_end_date']) : '';?>">
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
										<div class="help-block with-errors error_msg"></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Basic Percentage <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Basic Percentage" type="text" name="basic_percentage" min="0" max="100" required data-error="Please Enter Basic Percentage" value="<?php echo !empty($configuration_settings['basic_percentage']) ? $configuration_settings['basic_percentage'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Yearly Paid Leaves <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Yearly Paid Leaves" type="text" name="PL" min="0" max="100" required data-error="Please Enter Yearly Paid Leaves" value="<?php echo !empty($configuration_settings['PL']) ? $configuration_settings['PL'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Yearly Sick Leaves <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Yearly Sick Leaves" type="text" name="SL" min="0" max="100" required data-error="Please Enter Yearly Sick Leaves" value="<?php echo !empty($configuration_settings['SL']) ? $configuration_settings['SL'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Yearly Casual Leaves <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Yearly Casual Leaves" type="text" name="CL" min="0" max="100" required data-error="Please Enter Yearly Casual Leaves" value="<?php echo !empty($configuration_settings['CL']) ? $configuration_settings['CL'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">SMS API Key <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="SMS API Key" type="text" name="sms_api_key" required data-error="Please Enter SMS API Key" value="<?php echo !empty($configuration_settings['sms_api_key']) ? $configuration_settings['sms_api_key'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">SMS Sender ID <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="SMS Sender ID" type="text" name="sms_senderid" required data-error="Please Enter SMS Sender ID" value="<?php echo !empty($configuration_settings['sms_senderid']) ? $configuration_settings['sms_senderid'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">SMS Link <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="SMS Link" type="text" name="sms_link" required data-error="Please Enter SMS Link" value="<?php echo !empty($configuration_settings['sms_link']) ? $configuration_settings['sms_link'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">SMS User <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="SMS User" type="text" name="sms_user" required data-error="Please Enter SMS User" value="<?php echo !empty($configuration_settings['sms_user']) ? $configuration_settings['sms_user'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">SMS Password <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="SMS Password" type="text" name="sms_password" required data-error="Please Enter SMS Password" value="<?php echo !empty($configuration_settings['sms_password']) ? $configuration_settings['sms_password'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Bank Account Number <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Bank Account Number" type="text" name="bank_account_number" required data-error="Please Enter Bank Account Number" value="<?php echo !empty($configuration_settings['bank_account_number']) ? $configuration_settings['bank_account_number'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Account Holder Name <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Account Holder Name" type="text" name="account_holder_name" required data-error="Please Enter Account Holder Name" value="<?php echo !empty($configuration_settings['account_holder_name']) ? $configuration_settings['account_holder_name'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Remark About File <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Remark About File" type="text" name="remark_about_file" required data-error="Please Enter Remark About File" value="<?php echo !empty($configuration_settings['remark_about_file']) ? $configuration_settings['remark_about_file'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Bank Name <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Bank Name" type="text" name="bank_name" required data-error="Please Enter Bank Name" value="<?php echo !empty($configuration_settings['bank_name']) ? $configuration_settings['bank_name'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">IFSC Code <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="IFSC Code" type="text" name="ifsc_code" required data-error="Please Enter IFSC Code" value="<?php echo !empty($configuration_settings['ifsc_code']) ? $configuration_settings['ifsc_code'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Branch Name <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Branch Name" type="text" name="branch_name" required data-error="Please Enter Branch Name" value="<?php echo !empty($configuration_settings['branch_name']) ? $configuration_settings['branch_name'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Branch Code <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Branch Code" type="text" name="branch_code" required data-error="Please Enter Branch Code" value="<?php echo !empty($configuration_settings['branch_code']) ? $configuration_settings['branch_code'] : '';?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Login Page Logo</label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
								    <input class="upload_logo" type="file" name="company_outer_logo" id="company_outer_logo" class="file"  accept=".jpg,.jpeg,.png/*">
								    <span><?php echo !empty($configuration_settings['company_outer_logo']) ? $configuration_settings['company_outer_logo'] : '';?></span>
								    <input type="hidden" id="pre_outer_logo" name="pre_outer_logo" value="<?php echo !empty($configuration_settings['company_outer_logo']) ? $configuration_settings['company_outer_logo'] : '';?>">
							  	</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Menu Header Logo</label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<input class="upload_logo" type="file" name="company_inner_logo" id="company_inner_logo" class="file"  accept=".jpg,.jpeg,.png/*">
									<span><?php echo !empty($configuration_settings['company_inner_logo']) ? $configuration_settings['company_inner_logo'] : '';?></span>
									<input type="hidden" id="pre_inner_logo" name="pre_inner_logo" value="<?php echo !empty($configuration_settings['company_inner_logo']) ? $configuration_settings['company_inner_logo'] : '';?>">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<button class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label">Submit</span>
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
		var i = 0;
	    $('#datePicker, #datePicker1').datepicker({
    	    format: 'dd/mm/yyyy',
    	    autoclose : true
    	});

	    $('#datePicker').on('changeDate', function(e) {
			$('#datePicker1').datepicker('setStartDate', $('#year_start_date').val());
		});
		$('#datePicker1').on('changeDate', function(e) {
			$('#datePicker').datepicker('setEndDate', $('#year_end_date').val());
		});

    	var readURL = function(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();

	            reader.onload = function (e) {
	                $('.profile-pic').attr('src', e.target.result);
	            }
	    
	            reader.readAsDataURL(input.files[0]);
	        }
	    }

    	$("#company_outer_logo").on('change', function(){
	        readURL(this);            
	        if((this.files[0].size/1024/1024)<5)
	        {
	        	var filename = $('#company_outer_logo').val().replace(/C:\\fakepath\\/i, '')
				i++;
	        }
	        else
	        {
	        	$('#company_outer_logo').val('');
	        	swal("File Size Must Be Less Than 5 MB","","error");
	        }
	       
	    });
	    $.fn.checkFileType = function(options) {
		  	var defaults = {
		    allowedExtensions: [],
		    success: function() {},
		    error: function() {}
		  };
		  options = $.extend(defaults, options);

		  return this.each(function() {

		    $(this).on('change', function() {
		      var value = $(this).val(),
		        file = value.toLowerCase(),
		        extension = file.substring(file.lastIndexOf('.') + 1);

		      if ($.inArray(extension, options.allowedExtensions) == -1) {
		        options.error();
		        $(this).focus();
		      } else {
		        options.success();

		      }

		    });

		  });
		};

	    $('#company_outer_logo').checkFileType({
	    allowedExtensions: ['jpg', 'jpeg', 'png'],
	    success: function() {
	    	if(i == 1)
	    	{
	    		var filename = $('#company_outer_logo').val().replace(/C:\\fakepath\\/i, '');
			}
	    },
	    error: function() {
	    	$('#company_outer_logo').val('');
	    	swal("Please Select Image File Type","","error");
	    }
	  });

	    $("#company_inner_logo").on('change', function(){
	        readURL(this);            
	        if((this.files[0].size/1024/1024)<5)
	        {
	        	var filename = $('#company_inner_logo').val().replace(/C:\\fakepath\\/i, '');
				i++;
	        }
	        else
	        {
	        	$('#company_inner_logo').val('');
	        	swal("File Size Must Be Less Than 5 MB","","error");
	        }
	       
	    });
	    $.fn.checkFileType = function(options) {
		  	var defaults = {
		    allowedExtensions: [],
		    success: function() {},
		    error: function() {}
		  };
		  options = $.extend(defaults, options);

		  return this.each(function() {

		    $(this).on('change', function() {
		      var value = $(this).val(),
		        file = value.toLowerCase(),
		        extension = file.substring(file.lastIndexOf('.') + 1);

		      if ($.inArray(extension, options.allowedExtensions) == -1) {
		        options.error();
		        $(this).focus();
		      } else {
		        options.success();

		      }

		    });

		  });
		};

	    $('#company_inner_logo').checkFileType({
	    allowedExtensions: ['jpg', 'jpeg', 'png'],
	    success: function() {
	    	if(i == 1)
	    	{
	    		var filename = $('#company_inner_logo').val().replace(/C:\\fakepath\\/i, '')
			}
	    },
	    error: function() {
	    	$('#company_inner_logo').val('');
	    	swal("Please Select Image File Type","","error");
	    }
	  });
    });
</script>