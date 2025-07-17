<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/lib/responsive-tabs/responsive-tabs.css"></link>
<script src="<?php echo base_url(); ?>assets/js/lib/responsive-tabs/responsiveTabs.js"></script>
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
		<div class="well">
			<div class="col-sm-12" >

				<div class="profile-widget"> 
				  	<div class="row">
				  		<div class="col-md-4 text-center">
				  		</div>
				  		<div class="col-md-4" id="profile_div" style="display:block; text-align: center;">
							<div id="upload-demo-i" class="upload_pic"></div>
							 <?php if($last==get_login_user_id()) {?>
							 <div class="p-image">
						           <a ><i class="fa fa-camera upload-button"></i></a>
							        <input class="file-upload" type="file" id="upload" accept="image/*"/>
						     </div>
						     <?php }?>
						     <h3 class="profile-username"><?php echo (isset($candidate_details->can_name) && !empty($candidate_details->can_name)) ? $candidate_details->can_name : '';?></h3>
						     <h5 class="profile-desig"><?= get_user_job_profile($candidate_details->job_profile)  ?> </h5>
				  		</div>
				  		
				  		<div class="col-md-4" id="upload_div" style=" display:none;">
				  			<div id="upload-demo" style="">
				  			</div>
				  			<div class="act_btn" style="margin-bottom: 20px">
				  				<br>
					  			<button class="btn btn-success upload-result" >Upload Image</button>
					  			<button class="btn btn-success upload-cancel">Cancel</button>
				  			</div>
				  		</div>
				  	</div>
				</div>



				<h1 class="well headline" style="margin-bottom: 10px !important;">Employee Details <a href="javascript:window.history.go(-1);" class="text-white pull-right m-r">Back To List</a></h1>

				<div class="responsive-tabs">
				  	<h2>Profile</h2>
 				  	<div>
 				  		<div class="col-sm-12 col-xs-12 can_details">
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Name :</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->can_name) && !empty($candidate_details->can_name)) ? $candidate_details->can_name : '-';?></p>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Current Address :</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->cur_address) && !empty($candidate_details->cur_address)) ? $candidate_details->cur_address : '-';?></p>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Permanent Address :</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->per_address) && !empty($candidate_details->per_address)) ? $candidate_details->per_address : '-';?></p>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Email Address :</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->email) && !empty($candidate_details->email)) ? $candidate_details->email : '-';?></p>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Date of Birth :</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->dob) && !empty($candidate_details->dob)) ? db_to_date($candidate_details->dob) : '-';?></p>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Mobile Number :</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->phone1) && !empty($candidate_details->phone1)) ? $candidate_details->phone1: '-';?></p>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Alernate Number :</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->phone2) && !empty($candidate_details->phone2)) ? $candidate_details->phone2 : '-';?></p>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Education Qualification :</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->candidate_qualification) && !empty($candidate_details->candidate_qualification)) ? $candidate_details->candidate_qualification : '-';?></p>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Designation :</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->job_profile_title) && !empty($candidate_details->job_profile_title)) ? $candidate_details->job_profile_title : '-';?></p>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Current CTC Per Year :</label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->current_ctc) && !empty($candidate_details->current_ctc)) ? $candidate_details->current_ctc : '-';?></p>
										</div>
									</div>
								</div>
							
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Expected CTC Per Year :</label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->expected_ctc) && !empty($candidate_details->expected_ctc)) ? $candidate_details->expected_ctc : '-';?></p>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Emergency Contact Name :</label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->emer_contact_name) && !empty($candidate_details->emer_contact_name)) ? $candidate_details->emer_contact_name : '-';?></p>
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Emergency Contact Number :</label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->emer_contact_no) && !empty($candidate_details->emer_contact_no)) ? $candidate_details->emer_contact_no : '-';?></p>
										</div>
									</div>
								</div>
							</div>	

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Aadhaar Card No. :</label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->aadhar_no) && !empty($candidate_details->aadhar_no)) ? $candidate_details->aadhar_no : '-';?></p>
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Pan Card No. :</label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->pan_no) && !empty($candidate_details->pan_no)) ? $candidate_details->pan_no : '-';?></p>
										</div>
									</div>
								</div>
							</div>
							

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Blood Group :</label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->blood_group) && !empty($candidate_details->blood_group)) ? $candidate_details->blood_group : '-';?></p>
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Ready to Relocate :</label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo $candidate_details->ready_to_relocate=='1' ? 'Yes': 'No';?></p>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Joining Date :</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->joining_date) && !empty($candidate_details->joining_date)) ? db_to_date($candidate_details->joining_date) : '-';?></p>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Role :</label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->role_name) && !empty($candidate_details->role_name)) ? $candidate_details->role_name : '-';?></p>
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Reporting To :</label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php echo (isset($candidate_details->reporting_to) && !empty($candidate_details->reporting_to)) ? $candidate_details->reporting_to : '-';?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
 				  	</div>
 				  	
					<h2>Leaves</h2>
					<div>
						<div class="row container-fluid table-responsive">
							<table class="display table table-bordered table-striped">
								<tr>
									<th>From Date</th>
									<th>To Date</th>
									<th>Reason</th>
									<th>Status</th>
								</tr>
								<?php if(!empty($candidate_leaves) && isset($candidate_leaves)) {
									foreach($candidate_leaves as $keyl => $valuel) { ?>
									<tr>
										<td><?php echo db_to_date($valuel['from_date']); ?></td>
										<td><?php echo db_to_date($valuel['to_date']); ?></td>
										<td><?php echo $valuel['reason']; ?></td>
										<?php if($valuel['status'] == 0) { ?>
											<td class="text-primary">Pending</td>
										<?php } else if($valuel['status'] == 1) { ?>
											<td class="text-success">Approved</td>
										<?php } else { ?>
											<td class="text-danger">Rejected</td>
										<?php } ?>
									</tr>
								<?php } } else { ?>
									<tr>
										<td colspan="4" class="text-center"><strong class="h3 text-danger">No records found.</strong></td>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>

					<h2>Tasks</h2>
					<div>
						<div class="row container-fluid table-responsive">
							<table class="display table table-bordered table-striped">
								<tr>
									<th>Task Name</th>
									<th>Task Details</th>
									<th>Created Date</th>
									<th>Completion Date</th>
									<th>Status</th>
								</tr>
								<?php if(!empty($candidate_tasks) && isset($candidate_tasks)) {
									foreach($candidate_tasks as $keyt => $valuet) { ?>
									<tr>
										<td><?php echo $valuet['task_name']; ?></td>
										<td><?php echo $valuet['task_description']; ?></td>
										<td><?php echo db_to_date($valuet['created_on']); ?></td>
										<td><?php echo db_to_date($valuet['tat']); ?></td>
										<td><?php echo $valuet['status']; ?></td>
									</tr>
								<?php } } else { ?>
									<tr>
										<td colspan="5" class="text-center"><strong class="h3 text-danger">No records found.</strong></td>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>

					<h2>Events</h2>
					<div>
						<div class="row container-fluid table-responsive">
							<table class="display table table-bordered table-striped">
								<tr>
									<th>Event Type</th>
									<th>From Date</th>
									<th>To Date</th>
									<th>Event</th>
									<th>Details</th>
								</tr>
								<?php if(!empty($candidate_events) && isset($candidate_events)) {
									foreach($candidate_events as $keye => $valuee) {?>
									<tr>
										<td><?php echo $valuee['event_type']; ?></td>
										<td><?php echo db_to_date($valuee['start']); ?></td>
										<td><?php echo db_to_date($valuee['end']); ?></td>
										<td><?php echo $valuee['title']; ?></td>
										<td><?php echo $valuee['details']; ?></td>
									</tr>
								<?php } } else { ?>
									<tr>
										<td colspan="5" class="text-center"><strong class="h3 text-danger">No records found.</strong></td>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>

					<h2>Travels</h2>
					<div>
						<div class="row container-fluid table-responsive">
							<table class="display table table-bordered table-striped">
								<tr>
									<th>Purpose</th>
									<th>Location</th>
									<th>From Date</th>
									<th>To Date</th>
									<th>Budget</th>
									<th>Status</th>
								</tr>
								<?php if(!empty($candidate_travels) && isset($candidate_travels)) {
									foreach($candidate_travels as $keyt => $valuet) { ?>
									<tr>
										<td><?php echo $valuet['purpose']; ?></td>
										<td><?php echo $valuet['location']; ?></td>
										<td><?php echo db_to_date($valuet['from_date']); ?></td>
										<td><?php echo db_to_date($valuet['to_date']); ?></td>
										<td><?php echo $valuet['budget']; ?></td>
										<td><?php echo $valuet['status']; ?></td>
									</tr>
								<?php } } else { ?>
									<tr>
										<td colspan="6" class="text-center"><strong class="h3 text-danger">No records found.</strong></td>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php //x_debug($candidate_details); ?>
<script type="text/javascript">
	RESPONSIVEUI.responsiveTabs();
	pic="<?php echo $candidate_details->profile_picture; ?>";
		//alert(pic);
		if(pic!='')
		{
			html = '<img src="' + "<?php echo base_url().PROFILE_PATH.$candidate_details->profile_picture; ?>" + '" />';
				$("#upload-demo-i").html(html);
		}
		else{
			html = '<img src="' + "<?php echo base_url().PROFILE_PATH.'no_profile_image.png'; ?>" + '" />';
			$("#upload-demo-i").html(html);		
		}
</script>

