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
<?php
	$contract_sign_date ='';
	if(isset($client_details['contract_sign_date']) && !empty($client_details['contract_sign_date']))
	{
 		if(!empty(strtotime($client_details['contract_sign_date']	)))
 		{
 			$contract_sign_date = db_to_date($client_details['contract_sign_date']);
 		}
 	}
 	$contract_from_date ='';
	if(isset($client_details['contract_from_date']) && !empty($client_details['contract_from_date']))
	{
 		if(!empty(strtotime($client_details['contract_from_date']	)))
 		{
 			$contract_from_date = db_to_date($client_details['contract_from_date']);
 		}
 	}
 	$contract_end_date ='';
	if(isset($client_details['contract_end_date']) && !empty($client_details['contract_end_date']))
	{
 		if(!empty(strtotime($client_details['contract_end_date']	)))
 		{
 			$contract_end_date = db_to_date($client_details['contract_end_date']);
 		}
 	}
?>
	<div class="container-fluid">
	<?php $this->load->view('rpo_manager/client_menu');?>
	<div class="well">
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="can_information" action="" method="post">
				<h1 class="well headline">RPO Client Details</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<input type="hidden" name="client_id" id="client_id" value="<?php echo (isset($client_details['client_id']))? $client_details['client_id'] : '' ?>">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Client Name:<span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control alpha_only"  type="text" name="client_name" id="client_name" placeholder="Client Name" required data-error="Please Enter Client Name" value="<?php echo (isset($client_details['client_name']))? $client_details['client_name'] : '' ?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Contact Person Name:<span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control alpha_only" type="text" name="contact_name" id="contact_name" placeholder="Contact Person Name" required data-error="Please Enter Contact Person Name" value="<?php echo (isset($client_details['contact_name']))? $client_details['contact_name'] : '' ?>">
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
					    </div>


						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Mobile Number:<span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" minlength="10" maxlength="10" name="contact_number" id="contact_number" placeholder="Mobile Number Here" class="form-control number" required data-error="Please Enter Your Mobile Number" value="<?php echo (isset($client_details['contact_number']))? $client_details['contact_number'] : '' ?>">
										<i class="fa fa-mobile"></i>
										<div class="help-block with-errors error_msg"></div>
											<span class="error_msg" id ="phone1_err"></span>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Email ID:<span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="email" name="contact_email"  id="contact_email" placeholder="Email Address" class="form-control" value="<?php echo (isset($client_details['contact_email']))? $client_details['contact_email'] : '' ?>" required data-error="Please Enter Valid Email ID">
										<i class="fa fa-envelope"></i><div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
					    </div>

					   <div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Contract Sign Date:<span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" type="text" name="contract_sign_date" id="contract_sign_date" placeholder="Contract Sign Date" value="<?php echo $contract_sign_date; ?>" required data-error="Please Enter Contract Sign Date">
									</div><div class="help-block with-errors error_msg"></div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Contract Status:</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select name="contract_status" id="contract_status" class="form-control">
											<option value="active" <?php if(isset($client_details['contract_status']) && ($client_details['contract_status']=="active")){ echo "selected"; }?> >Active</option>
											<option value="closed" <?php if(isset($client_details['contract_status']) && ($client_details['contract_status']=="closed")){ echo "selected"; } ?>>Closed</option>
										</select>
									</div>
								</div>
							</div>
					    </div>

					    <div class="row">
					    	<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Contract From Date:</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right" >
										<input class="form-control"  type="text" name="contract_from_date" id="contract_from_date" placeholder="Contract From Date" value="<?php echo $contract_from_date; ?>">
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Contract End Date:</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right" >
										<input class="form-control"  type="text" name="contract_end_date" id="contract_end_date" placeholder="Contract End Date" data-date-start-date="0d" value="<?php echo $contract_end_date; ?>">
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
		$('#contract_sign_date, #contract_from_date, #contract_end_date').datepicker({
			format: 'dd/mm/yyyy'
		});
		$('#contract_from_date').on('changeDate', function(e) {
			$('#contract_from_date').datepicker('setEndDate', $('#contract_end_date').val());
		});
		
	});
</script>