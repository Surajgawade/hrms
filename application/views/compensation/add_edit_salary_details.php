   <?php
	$effective_from ='';
	if(isset($empsalary_details->effective_from) && !empty($empsalary_details->effective_from))
	{
 		if(!empty(strtotime($empsalary_details->effective_from)))
 		{
 			$effective_from = db_to_date($empsalary_details->effective_from);
 		}
	}
	$effective_to ='';
	if(isset($empsalary_details->effective_to) && !empty($empsalary_details->effective_to))
	{
 		if(!empty(strtotime($empsalary_details->effective_to)))
 		{
 			$effective_to = db_to_date($empsalary_details->effective_to);
 		}
	}
?>
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
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" name="salarydetails_form" id="salarydetails_form" action="" method="post">

				<input type="hidden" name="sd_id" id="sd_id" value="<?php echo !(empty($empsalary_details->sd_id)) ? $empsalary_details->sd_id : '';?>">				
				<input type="hidden" name="can_id" id="can_id" value="<?php echo !(empty($empsalary_details->can_id)) ? $empsalary_details->can_id : '';?>">		
				<h1 class="well headline"><?php echo empty($empsalary_details->sd_id) ? 'Add' : 'Edit';?> Employee Salary Details</h1>
					<span id="error_profile"></span>

					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Employee Name <span>*</span> </label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<?php if(isset($empsalary_details)){?>
										<input class="form-control" placeholder="Employee Name" type="text" name="joining_date" id="joining_date" value="<?php echo (isset($empsalary_details->can_name) && !empty($empsalary_details->can_name))? $empsalary_details->can_name : '';?>" readonly>
									<?php } else{?>
										<select class="chosen-select col-md-10 col-sm-12 col-xs-12 " name="can_id" id="can_name"  style="width: 100%" required data-error="Select Employee Name" >
												<option value="" selected hidden>Select Employee Name</option>
												<?php foreach ($candidates as $key => $candidate) {?>
												<option value="<?php echo $candidate->can_id?>"><?php echo $candidate->can_name?></option>
												<?php }?>
											</select>
											<span class="msg_red" id="err_canid"></span>
											<div class="help-block with-errors error_msg"></div>
									<?php }?>
									</div>		
								</div>
							</div>
							
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Date Of Joining <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Date of Joining" type="text" name="joining_date" id="joining_date" value="<?php echo (isset($empsalary_details->joining_date) && !empty($empsalary_details->joining_date)) ? format_date($empsalary_details->joining_date) : '';?>" readonly>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Designation <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input placeholder="Designation" class="form-control" type="text" name="can_designation" id="can_designation" value="<?php echo (isset($empsalary_details->job_profile_title) &&!empty($empsalary_details->job_profile_title)) ? $empsalary_details->job_profile_title : '';?>" readonly>
									</div>
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Department <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input placeholder="Department" class="form-control" type="text" id="can_department" value="<?php echo (isset($empsalary_details->department_title) && !empty($empsalary_details->department_title)) ? $empsalary_details->department_title : '';?>" readonly>
									</div>
								</div>
							</div>
						
							<?php /*<input class="form-control number"  type="hidden" name="pf_amount" id="pf_amount" readonly value="<?php echo (isset($empsalary_details->pf_amount) && !empty($empsalary_details->pf_amount)) ? $empsalary_details->pf_amount : '';?>">*/?>
						</div>
                        
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Applicable for PF </label>
								</div>
							</div>


							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label" required="">
											<input type="radio" name="pf_applicable" value="1" <?php if((isset($empsalary_details->pf_applicable) && $empsalary_details->pf_applicable==1) ) echo "checked";?>>Yes</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="pf_applicable" value="0" <?php if((isset($empsalary_details->pf_applicable) && $empsalary_details->pf_applicable==0)) echo "checked";?> checked>No</label>
									</div>
								</div>
							</div>
							
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">PF No. </label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Enter PF No." type="text" name="pf_no" id="pf_no" value="<?php echo (isset($empsalary_details->pf_no) && !empty($empsalary_details->pf_no)) ? $empsalary_details->pf_no:'';?>" <?php if($empsalary_details->pf_applicable==0){?> readonly <?php }?>>
										<span class="msg_red" id="err_pfno"></span>
									</div>
								</div>
							</div>	
						</div>

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">ESIC No.</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="ESIC No." type="text" value="<?php echo  (isset($empsalary_details->esic_no) && !empty($empsalary_details->esic_no)) ? $empsalary_details->esic_no : '';?>" name="esic_no">
									</div>
									<div class="help-block with-errors error_msg"></div>			
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Gross Salary <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Enter Gross Salary" type="text" name="gross_pay" id="gross_pay" required data-error="Please Enter Gross Salary"  value="<?php echo (isset($empsalary_details->gross_pay) && !empty($empsalary_details->gross_pay)) ? $empsalary_details->gross_pay : '';?>">
										<div class="help-block with-errors error_msg"></div>			
									</div>
								</div>
							</div>
							<?php /*
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">PF Amount </label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Enter PF Amount" type="text" name="pf_amount" id="pf_amount" readonly value="<?php echo (isset($empsalary_details->pf_amount) && !empty($empsalary_details->pf_amount)) ? $empsalary_details->pf_amount : '';?>">
									</div>
								</div>
							</div>*/?>
							<input class="form-control number" placeholder="Enter PF Amount" type="hidden" name="pf_amount" id="pf_amount" readonly value="<?php echo (isset($empsalary_details->pf_amount) && !empty($empsalary_details->pf_amount)) ? $empsalary_details->pf_amount : '';?>">

						</div>			
                        
						<div class="month-head">
							<h6>Earnings &amp; Reimbursement </h6>
						</div>

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Basic <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="" type="text" name="basic" id="basic" required data-error="Please Enter Basic Salary" value="<?php echo (isset($empsalary_details->basic) && !empty($empsalary_details->basic)) ? $empsalary_details->basic : '';?>" readonly> 
									</div>
									<div class="help-block with-errors error_msg"></div>			
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">H.R.A <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="" type="text" name="HRA" id="HRA" data-error="Please Enter HRA" value="<?php echo (isset($empsalary_details->HRA) && !empty($empsalary_details->HRA)) ? $empsalary_details->HRA : '';?>" required readonly >
									</div>
									<div class="help-block with-errors error_msg"></div>			
								</div>
							</div>
						</div>
                        
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Conveyance <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="" type="text" name="conveyance" id="conveyance" data-error="Please Enter Conveyance" value="<?php echo (isset($empsalary_details->conveyance) && !empty($empsalary_details->conveyance)) ? $empsalary_details->conveyance : '';?>" required readonly>
									</div>
									<div class="help-block with-errors error_msg"></div>			
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Medical <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="" type="text" name="medical" id="medical" data-error="Please Enter Medical Allowance" value="<?php echo (isset($empsalary_details->medical) && !empty($empsalary_details->medical)) ? $empsalary_details->medical : '';?>" required readonly>
									</div>
									<div class="help-block with-errors error_msg"></div>			
								</div>
							</div>
						</div>
                        
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
								<label class="form-label">Special Allow <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="" type="text" name="special_allowance" id="special_allowance" data-error="Please Enter Special Allowance" value="<?php echo (isset($empsalary_details->special_allowance) && !empty($empsalary_details->special_allowance)) ? $empsalary_details->special_allowance : '';?>" required readonly>		
									</div>
										<div class="help-block with-errors error_msg"></div>	
								</div>
							</div>

						</div>
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">LTA</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="" type="text" name="LTA" id="LTA" value="<?php echo (isset($empsalary_details->LTA) && !empty($empsalary_details->LTA)) ? $empsalary_details->LTA : '0';?>" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Mobile reimbursement</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="" type="text" name="mobile_reimbursement" id="mobile_reimbursement" value="<?php echo (isset($empsalary_details->mobile_reimbursement) && !empty($empsalary_details->mobile_reimbursement)) ? $empsalary_details->mobile_reimbursement : '0';?>"> 
									</div>
								</div>
							</div>							
						</div>
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Motor Allowance</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="" type="text" name="motor_allowance" id="motor_allowance" value="<?php echo (isset($empsalary_details->motor_allowance) && !empty($empsalary_details->motor_allowance)) ? $empsalary_details->motor_allowance : '0';?>">
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Gratuity</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="" type="text" name="gratuity" id="gratuity" value="<?php echo (isset($empsalary_details->gratuity) && !empty($empsalary_details->gratuity)) ? $empsalary_details->gratuity : '0';?>">
									</div>
								</div>
							</div>
						</div>

                	<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Effective From Date <span>*</span></label>
								</div>
							</div>
						
							<div class=col-lg-4>
       						<div class="date form-group">
								<div class="input-group input-append date" id="datePicker">
									<input type="text" class="form-control" name="effective_from" id="effective_from" placeholder="dd/mm/yyyy"  data-error="Please Enter Effective from Date" value="<?php echo $effective_from;?>" required/>
									<span class="input-group-addon add-on"><span  id="demo-1-button" class="glyphicon glyphicon-calendar"></span></span>
								</div>
								<div class="help-block with-errors error_msg"></div>
							</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Effective To Date </label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="date form-group">
									<div class="input-group input-append date" id="datePicker1">
										<input type="text" class="form-control" name="effective_to" id="effective_to" placeholder="dd/mm/yyyy" value="<?php echo $effective_to;?>"/>
										<span class="input-group-addon add-on"><span  id="demo-2-button" class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
							</div>
						</div>                

						<div class="row">
							<div class="col-lg-6">
								<button class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label" id="submit_form">Submit</span>
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

	var gross =0;
	var basic = 0;
	var hra = 0;
	var special = 0;
	var pf_amount = 0;
	var lta=0;
	var mobile=0;
	var motor=0;
	var gratuity=0;

	function formatDate (input)
	{
		var datePart = input.match(/\d+/g),
		year = datePart[0].substring(0), // get only two digits
		month = datePart[1], day = datePart[2];
		return day+'/'+month+'/'+year;
   }

$("#datePicker,#datePicker1").datepicker({
			format: "dd/mm/yyyy",
			maxDate: new Date()
		});

	$(document).ready(function(){
		// $(salarydetails_form)
		// 	.bootstrapValidator({
		// 		excluded: ':disabled'
		// 	});

		$(".chosen-select").chosen();

		/*$('#can_name').blur(function(){
		$('#err_canid').html('Please Select Employee').show().delay(2000).fadeOut(1000);;
		event.preventDeafault();
		return false;
		}*/

		$('#can_name').change(function(){
			$(this).closest('form').find("input[type=text]").val("");
			var can_id = $("#can_name").chosen().val();
			if($("#can_name").chosen().val()=='')
			{
				$('#err_canid').html('Please Select Employee').show().delay(2000).fadeOut(1000);;
				event.preventDeafault();
				return false;
			}
			else
			{
				var response = $.parseJSON($.ajax({
					url:  '<?php echo site_url();?>/compensation/get_can_details',
					dataType: "json", 
					data: {can_id:can_id},
					type:'POST',
					async: false
				}).responseText);
				if(response.msg == "Please update profile first!")
				{
					$('#error_profile').html('<div class="alert alert-danger alert-no-border alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Please update profile first!</div>').show();
				}
				else
				{
					$('#error_profile').html('').hide();
					if(response.job_profile_title != null)
					{
						$('#can_designation').val(response.job_profile_title);
					}
					else
					{
						$('#can_designation').val('');
					}

					if(response.department_title != null)
					{
						$('#can_department').val(response.department_title);
					}
					else
					{
						$('#can_department').val('');
					}

					if(response.joining_date != null)
					{
						$('#joining_date').val(formatDate (response.joining_date));
					}
					else
					{
						$('#joining_date').val('');
					}
				}
			}			
		});
		/* Calculate salary break up on gross salary */
		$('#gross_pay').change(function(){
			gross = $('#gross_pay').val();
			if(gross!='')
			{
				if(gross>6000)
				{	
					var basic_per = '<?php echo $this->config->item('basic_per');?>';
					basic = ((basic_per/100)*gross).toFixed(2);
					hra = ((50/100)*basic).toFixed(2);
					conveyance = '<?php echo $this->config->item('conveyance');?>';
					medical = '<?php echo $this->config->item('medical');?>';
					special = (parseFloat(gross) -(parseFloat(basic)+parseFloat(hra)+parseFloat(conveyance)+parseFloat(medical)+parseFloat(lta)+parseFloat(mobile)+parseFloat(motor))).toFixed(2);
					// special = (gross - (basic + hra + conveyance + medical));
					var pf_appl = $('input[name=pf_applicable]:checked').val();
					//console.log(pf_appl);

					if(pf_appl==1)
					{
						pf_amount = ((12/100)*basic).toFixed(2);
						$('#pf_amount').val(pf_amount);
					}
					else
					{
						pf_amount = 0;
						$('#pf_amount').val(pf_amount);
					}
				}
				else
				{
					basic = 0;
					hra = 0;
					conveyance = 0;
					medical = 0;
					special = 0;
				}
				

				$('#basic').val(basic);
				$('#HRA').val(hra);
				$('#conveyance').val(conveyance);
				$('#medical').val(medical);
				$('#special_allowance').val(special);
				$('#pf_amount').val(pf_amount);
				$('#LTA').val(0);
				$('#mobile_reimbursement').val(0);
				$('#motor_allowance').val(0);
				$('#gratuity').val(0);
			}
		});

		$('input[type=radio][name=pf_applicable]').change(function() {
			var pf_appl = $('input[name=pf_applicable]:checked').val();
			// console.log($('#basic').val());
			if (pf_appl == 0) {
				$('#pf_amount').val(0);
				$('#pf_no').val('');
				$('#pf_no').attr('readonly',true);
				$('#err_pfno').html('').hide();				
			}
			else if (pf_appl == 1) 
			{
				if($('#pf_no').val()=='')
				{
					$('#err_pfno').html('Please enter PF no.').show().delay(2000).fadeOut(1000);
					$('#pf_no').removeAttr('readonly');
					
					//event.preventDeafault();
					return false;
				}
				else
				{
					pf_amount = ((12/100)*($('#basic').val())).toFixed(2);
					$('#pf_amount').val(pf_amount);
					calc_special_allowance();
				}

			}
		});

	// $( "#LTA" ).change(function(){
	// 	special = calc_special_allowance();
	// });
	
	$( "#LTA" ).bind( "change", function()
	{		
		calc_special_allowance();			
	});
	$( "#mobile_reimbursement" ).bind( "change", function()
	{		
		calc_special_allowance();			
	});

	$( "#motor_allowance" ).bind( "change", function()
	{	
		calc_special_allowance();			
	});



		$('#submit_form').click(function (event) {
			var is_pf_appl = $('input[name=pf_applicable]:checked').val();
			if($('#can_name').val()=='')
			{
				$('#err_canid').html('Please Select Employee').show().delay(2000).fadeOut(1000);
				//event.preventDeafault();
				return false;
			}

			if(is_pf_appl==1)
			{
				// console.log('is_pf_appl');
				if($('#pf_no').val()=='')
				{
					$('#pf_no').removeAttr('readonly',true);
					$('#err_pfno').html('Please enter PF no.').show().delay(2000).fadeOut(1000);
					//event.preventDeafault();
					return false;
				}
				else
				{
					$('#err_pfno').html('').hide();
				}
			}
			else
			{
				$('#pf_no').val('');
				$('#pf_no').attr('readonly',true);
			}
		});
	});
	$('#datePicker').on('changeDate', function(e) {
		$('#datePicker1').datepicker('setStartDate', $('#effective_from').val());
	});
	$('#datePicker1').on('changeDate', function(e) {
		$('#datePicker').datepicker('setEndDate', $('#effective_to').val());
	});
 	function calc_special_allowance()
	{
		console.log('in calc_special_allowance');
		// console.log($('#LTA').val());
		special = (parseFloat($('#gross_pay').val()) -(parseFloat($('#basic').val())+parseFloat($('#HRA').val())+parseFloat($('#conveyance').val())+parseFloat($('#medical').val())+parseFloat($('#LTA').val())+parseFloat($('#mobile_reimbursement').val())+parseFloat($('#motor_allowance').val()))).toFixed(2);
			$('#special_allowance').val(special);
	}
</script>
 
