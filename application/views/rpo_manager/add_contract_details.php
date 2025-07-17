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
<?php 	
$proj_start_date ='';
	if(isset($contract_details['proj_start_date']) && !empty($contract_detailscontract_details['proj_start_date']))
	{
 		if(!empty(strtotime($contract_details['proj_start_date']	)))
 		{
 			$proj_start_date = db_to_date($contract_details['proj_start_date']);
 		}
 	}
 	$proj_end_date ='';
	if(isset($contract_details['proj_end_date']) && !empty($contract_details['proj_end_date']))
	{
 		if(!empty(strtotime($contract_details['proj_end_date']	)))
 		{
 			$proj_end_date = db_to_date($contract_details['proj_end_date']);
 		}
 	}
?>
	<div class="container-fluid">
	<div class="well">
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="can_information" action="" method="post">
				<h1 class="well headline">RPO Contract and Project Details</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<input type="hidden" name="proj_id" id="proj_id" value="<?php echo (isset($contract_details['proj_id']))? $contract_details['proj_id'] : '' ?>">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Client Name: <span>*</span></label>
								</div>
							</div>						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
											<?php if(isset($contract_details['client_name'])) {
												echo '<input type="text" name="client_name" id="client_name" value="'.$contract_details['client_name'].'" class="form-control-plaintext">'.
												'<input type="hidden" name="client_id" id="client_id" value="'.$contract_details['client_id'].'">';
											} else {?>
												<select name="client_name" id="client_name" class="form-control chosen-select col-md-12 col-sm-12 col-xs-12">
												</select>
											<?php } ?>
									</div>
								</div>
							</div>
							
					    </div>
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Project Title: <span>*</span></label>
								</div>
							</div>						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control alpha_only"  type="text" name="proj_title" id="proj_title" placeholder="Project Title" required data-error="Please Enter Project Title" value="<?php echo (isset($contract_details['proj_title']))? $contract_details['proj_title'] : '' ?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Project Type: <span>*</span></label>
								</div>
							</div>						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select name="proj_type" id="proj_type" class="form-control">
											<option value="Contract" <?php if(isset($contract_details['proj_type']) && ($contract_details['proj_type']=="Contract")){ echo "selected"; }?> >Contract</option>
											<option value="Permanent" <?php if(isset($contract_details['proj_type']) && ($contract_details['proj_type']=="Permanent")){ echo "selected"; }?>>Permanent</option>
										</select>
										<!-- <input class="form-control alpha_only"  type="text" name="proj_type" id="proj_type" placeholder="Project Type" required data-error="Please Enter Project Type" value="<?php //echo (isset($contract_details['proj_type']))? $contract_details['proj_type'] : '' ?>"> -->
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
					    </div>

					    <div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Job Profile: <span>*</span></label>
								</div>
							</div>						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control alpha_only"  type="text" name="job_profile" id="job_profile" placeholder="Job Profile" required data-error="Please Enter Job Profile" value="<?php echo (isset($contract_details['job_profile']))? $contract_details['job_profile'] : '' ?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Job Description:<span>*</span></label>
								</div>
							</div>						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea class="form-control alpha_only"  type="text" name="job_description" id="job_description" placeholder="Job Description" required data-error="Please Enter Job Description"><?php echo (isset($contract_details['job_description']))? $contract_details['job_description'] : '' ?></textarea>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
					    </div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">No of Positions: <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" type="text" name="no_of_position" id="no_of_position" placeholder="No of Position Available"  value="<?php echo (isset($contract_details['no_of_position']))? $contract_details['no_of_position'] : '' ?>" required data-error="Please Enter No. of Position">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Job Location:</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="job_location"  id="job_location" placeholder="Job Location" class="form-control" value="<?php echo (isset($contract_details['job_location']))? $contract_details['job_location'] : '' ?>">
									</div>
								</div>
							</div>
					    </div>

					   <div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Project Start Date:</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" type="text" name="proj_start_date" id="proj_start_date" placeholder="Project Start Date" value="<?php echo !empty($contract_details['proj_start_date']) ? db_to_date($contract_details['proj_start_date']) : ''; ?>">
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Project End Date:</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" type="text" name="proj_end_date" id="proj_end_date" placeholder="Project End Date" data-date-start-date="0d" value="<?php echo !empty($contract_details['proj_start_date']) ? db_to_date($contract_details['proj_end_date']): ''; ?>">
									</div>
								</div>
							</div>
					    </div>

					    <div class="row">
					    	<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Client Rate: <span>*</span></label>
								</div>
							</div>						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right" >
										<input class="form-control number" type="text" name="client_rate" id="client_rate" placeholder="Client Rate" required data-error="Please Enter Client Rate" value="<?php echo $contract_details['client_rate'];?>">
									</div><div class="help-block with-errors error_msg"></div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Offered Rate: <span>*</span></label>
								</div>
							</div>						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right" >
										<input class="form-control number"  type="text" name="offered_rate" id="offered_rate" placeholder="Offered Rate" required data-error="Please Enter Offered Rate"  value="<?php echo $contract_details['offered_rate'];?>">
									</div><div class="help-block with-errors error_msg"></div>
								</div>
							</div>
						</div>


					    <div class="row">
					    	<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Project Status:</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right" >
										<select name="project_status" id="project_status" class="form-control">
											<option value="1" <?php if(isset($client_details['project_status']) && ($client_details['project_status']=="active")){ echo "selected"; }else {?> >Active</option>
											<option value="0" <?php echo "seleced"; } ?>>Closed</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Contact Person Name: <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right" >
										<input class="form-control alpha_only"  type="text" name="contact_name" id="contact_name" placeholder="Contact Person Name" value="<?php echo (isset($contract_details['contact_name']))? $contract_details['contact_name'] : '' ?>" required data-error="Please Enter Contact Person Name">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Contact Person Mobile Number:<span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" minlength="10" maxlength="10" name="contact_number" id="contact_number" placeholder="Mobile Number Here" class="form-control number" required data-error="Please Enter Your Mobile Number" value="<?php echo (isset($contract_details['contact_number']))? $contract_details['contact_number'] : '' ?>">
										<i class="fa fa-mobile"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Contact Person Email ID: <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="email" name="contact_email" id="contact_email" placeholder="Email Id" class="form-control" data-error="Please Enter Email Id" required value="<?php echo (isset($contract_details['contact_email']))? $contract_details['contact_email'] : '' ?>"> <i class="fa fa-envelope"></i>
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
		$('#proj_start_date, #proj_end_date, #contract_end_date').datepicker({
			format: 'dd/mm/yyyy',
			maxDate: new Date()
		});
	
		
		// $("#proj_end_date").blur(function(){
		// 	var proj_start_date=$("#proj_start_date").val();
		// 	var proj_end_date=$("#proj_end_date").val();
		// 	if(proj_start_date=="" || proj_end_date==""){
		// 		type ='warning';
		// 		message ='Select project from date and project end date properly!';
		// 		title ='Warning:';
		// 	} 
		// 	else if(proj_start_date >= proj_end_date){
		// 		type ='warning';
		// 		message ='End date should not be less than from date!';
		// 		title ='Warning:';
		// 	}
			
		// 	$.notify({
		//            title: title,
		//            message: message,        
		//        },{
		//         type: type,
		//         delay: 800,
		//             animate:{
		//                 enter: "animated fadeInUp",
		//                 exit: "animated fadeOutDown"
		//             } 
		//     });
		// });
		$.ajax({
			url:'<?php echo site_url();?>/rpo_manager/fetch_client',
			dataType:'JSON',
			success:function(output){
				var row='';
				row = '<option selected="" disabled>Select Client</option>';
	  			$.each(output,function(index,arrvalue){
					row +='<option value='+arrvalue.client_id+' >'+arrvalue.client_name+'</option>';
				});
				$("#client_name").prepend(row);
				$(".chosen-select").chosen();
			},
			error:function(error){
				console.log(error.responseText);
			}
		});		
	});
</script>
