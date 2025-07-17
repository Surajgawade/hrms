   <?php
   // x_debug($rpoempsalary_details);

	$current_month = date('m');
	$month = date('m')-1;
	$year = date('Y');
	if($current_month==1)
	{
		$month = 12;
		$year = date('Y')-1;
	}
	else if($current_month==2)
	{
		$month = date('m')-1;
	}
	$total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	$dateObj   = DateTime::createFromFormat('!m', $month);
	$monthName = $dateObj->format('F');

	$effective_from ='';
	if(isset($rpoempsalary_details->effective_from) && !empty($rpoempsalary_details->effective_from))
	{
 		if(!empty(strtotime($rpoempsalary_details->effective_from)))
 		{
 			$effective_from = db_to_date($rpoempsalary_details->effective_from);
 		}
	}
	$effective_to ='';
	if(isset($rpoempsalary_details->effective_to) && !empty($rpoempsalary_details->effective_to))
	{
 		if(!empty(strtotime($rpoempsalary_details->effective_to)))
 		{
 			$effective_to = db_to_date($rpoempsalary_details->effective_to);
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
			<form data-toggle="validator" class="col-sm-12" name="monthly_salary_slip" id="monthly_salary_slip" action="" method="post">

				<input type="hidden" name="rpo_sal_id" id="rpo_sal_id" value="<?php echo !(empty($rpoempsalary_details->rpo_sal_id)) ? $rpoempsalary_details->rpo_sal_id : '';?>">				
				<input type="hidden" name="can_id" id="can_id" value="<?php echo !(empty($rpoempsalary_details->can_id)) ? $rpoempsalary_details->can_id : '';?>">		
				<input type="hidden" name="month" id="month" value="<?php echo $month;?>">
					<input type="hidden" name="year" id="year" value="<?php echo $year;?>">
				<h1 class="well headline"><?php echo empty($rpoempsalary_details->rpo_sal_id) ? 'Add' : 'Edit';?> RPO Salary Slip</h1>
					<span id="error_profile"></span>

					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Month </label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><?php echo $monthName;?></label>
									</div>
								</div>
							</div>

							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
								<label class="form-label">Year</label>
								</div>
							</div>

							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><?php echo $year;?></label>
									</div>
								</div>
							</div>							
                  </div>
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Employee Name <span>*</span> </label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<?php if(isset($rpoempsalary_details)){?>
										<input class="form-control" placeholder="Employee Name" type="text" value="<?php echo (isset($rpoempsalary_details->can_name) && !empty($rpoempsalary_details->can_name))? $rpoempsalary_details->can_name : '';?>" readonly>
									<?php } else{?>
										<select class="chosen-select col-md-10 col-sm-12 col-xs-12 " name="can_id" id="can_name"  style="width: 100%" required data-error="Select Employee Name" >
												<option value="" disabled selected hidden>Select Employee Name</option>
												<?php foreach ($rpo_candidates as $key => $candidate) {?>
												<option value="<?php echo $candidate->can_id?>"><?php echo $candidate->can_name?></option>
												<?php }?>
											</select>
											<!-- <span class="msg_red" id="err_canid"></span> -->
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
										<input class="form-control" placeholder="Date of Joining" type="text" id="joining_date" value="<?php echo (isset($rpoempsalary_details->joining_date) && !empty($rpoempsalary_details->joining_date)) ? format_date($rpoempsalary_details->joining_date) : '';?>" readonly>
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
										<input placeholder="Designation" class="form-control" type="text" id="designation" value="<?php echo (isset($rpoempsalary_details->designation) &&!empty($rpoempsalary_details->designation)) ? $rpoempsalary_details->designation : '';?>" readonly >
									</div>
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Department</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input placeholder="Department" class="form-control" type="text"  id="department" value="<?php echo (isset($rpoempsalary_details->department) && !empty($rpoempsalary_details->department)) ? $rpoempsalary_details->department : '';?>" readonly>
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
									<input type="text" class="form-control" id="effective_from" placeholder="dd/mm/yyyy"  data-error="Please Enter Effective from Date" value="<?php echo (isset($rpoempsalary_details->effective_from) && !empty($rpoempsalary_details->effective_from)) ? format_date($rpoempsalary_details->effective_from) : '';?>" required readonly/>
									<span class="input-group-addon add-on"><span  id="demo-1-button" class="glyphicon glyphicon-calendar"></span></span>
								</div>
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
										<input type="text" class="form-control" id="effective_to" placeholder="dd/mm/yyyy" value="<?php echo (isset($rpoempsalary_details->effective_to) && !empty($rpoempsalary_details->effective_to)) ? format_date($rpoempsalary_details->effective_to) : '';?>" readonly	/>
										<span class="input-group-addon add-on"><span  id="demo-2-button" class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
							</div>
						</div>  

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Hourly Rate</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input placeholder="Hourly Rate" class="form-control" type="text" id="hourly_rate" value="<?php echo (isset($rpoempsalary_details->amount) &&!empty($rpoempsalary_details->amount)) ? $rpoempsalary_details->amount : '';?>" readonly>
									</div>
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Paid Hours</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input placeholder="Paid Hours" class="form-control number" type="text" name="paid_hours" id="paid_hours" value="<?php echo (isset($rpoempsalary_details->paid_hours) &&!empty($rpoempsalary_details->paid_hours)) ? $rpoempsalary_details->paid_hours : '';?>">
									</div>
								</div>
							</div>
						</div>


						<div class="row">
							<?php /*<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Professional Tax</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input placeholder="Professional Tax" class="form-control" type="text" name="prof_tax" id="prof_tax" value="<?php echo (isset($rpoempsalary_details->prof_tax) && !empty($rpoempsalary_details->prof_tax)) ? $rpoempsalary_details->prof_tax : '';?>" readonly>
									</div>
								</div>
							</div>*/?>

							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">TDS</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input placeholder="TDS" class="form-control number" type="text" name="tds" id="tds" value="<?php echo (isset($rpoempsalary_details->tds) &&!empty($rpoempsalary_details->tds)) ? $rpoempsalary_details->tds : '';?>" readonly>
									</div>
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Total Earnings</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input placeholder="Total Earnings" class="form-control" type="text" name="total_earnings" id="total_earnings" value="<?php echo (isset($rpoempsalary_details->total_earnings) &&!empty($rpoempsalary_details->total_earnings)) ? $rpoempsalary_details->total_earnings : '';?>" readonly>
									</div>
								</div>
							</div>
						</div> 

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Total Deduction</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input placeholder="Total Deduction" class="form-control number" type="text" name="total_deduction" id="total_deduction" value="<?php echo (isset($rpoempsalary_details->total_deduction) &&!empty($rpoempsalary_details->total_deduction)) ? $rpoempsalary_details->total_deduction : '';?>" readonly>
									</div>
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Net Pay</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input placeholder="Net Pay" class="form-control" type="text" name="net_pay" id="net_pay" value="<?php echo (isset($rpoempsalary_details->net_pay) &&!empty($rpoempsalary_details->net_pay)) ? $rpoempsalary_details->net_pay : '';?>" readonly>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<button class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label" id="submit_form">Submit</span>
								<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>							
								<button class="btn btn-inline ladda-button" data-style="expand-left"><span class="ladda-label">Reset</span>
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
	$("#datePicker,#datePicker1").datepicker({
			format: "dd/mm/yyyy",
			maxDate: new Date()
	});

	function formatDate (input)
	{
		var datePart = input.match(/\d+/g),
		year = datePart[0].substring(0), // get only two digits
		month = datePart[1], day = datePart[2];
		return day+'/'+month+'/'+year;
   }

	$(document).ready(function(){
	
		$(".chosen-select").chosen();

		$('#can_name').change(function(){
			$(this).closest('form').find("input[type=text]").val("");
			var can_id = $("#can_name").chosen().val();
			// if($("#can_name").chosen().val()=='')
			// {
			// 	$('#err_canid').html('Please Select Employee').show().delay(2000).fadeOut(1000);;
			// 	return false;
			// }
			// else
			// {
				var month = $("#month").val();
				var year = $("#year").val();
				// get_rpocan_saldetails
				// var response = $.parseJSON($.ajax({
				// 		url:  '<?php //echo site_url();?>/rpo_manager/get_rpocan_saldetails',
				// 		dataType: "json", 
				// 		data: {can_id:can_id,month:month,year:year},
				// 		type:'POST',
				// 		async: false
				// 	}).responseText);

				// if()
				// {

				// }
				// else
				// {
					var pt_amount = 0.0;
					if(month==2)
						pt_amount = 300;
					else
						pt_amount = 200;

					var response = $.parseJSON($.ajax({
						url:  '<?php echo site_url();?>/rpo_manager/get_rpocan_billing_details',
						dataType: "json", 
						data: {can_id:can_id,month:month,year:year},
						type:'POST',
						async: false
					}).responseText);
					console.log(response);
					console.log(response.msg);
					if(response.msg == "1")
					{
						$('#monthly_salary_slip').trigger("reset");
						$('#error_profile').html('<div class="alert alert-danger alert-no-border alert-dismissible fade show" role="alert" style="margin-top:10px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Salary slip already generated for this employee!</div>').show();
					}
					else if(response.msg == "2")
					{
						$('#monthly_salary_slip').trigger("reset");				
						$('#error_profile').html('<div class="alert alert-danger alert-no-border alert-dismissible fade show" role="alert"  style="margin-top:10px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Please update profile first!</div>').show().delay(2000).fadeOut(1000);
					}
					else if(response.msg == "3")
					{
						$('#monthly_salary_slip').trigger("reset");				
						$('#error_profile').html('<div class="alert alert-danger alert-no-border alert-dismissible fade show" role="alert" style="margin-top:10px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Please add salary details first!</div>').show().delay(2000).fadeOut(1000);
					}
					else
					{
						// console.log(response);
						$('#error_profile').html('').hide();
						if(response.billing_details != null)
						{
							// console.log(response.billing_details);
							$('#designation').val(response.profile_details.designation);
							$('#department').val(response.billing_details.department);
							$('#hourly_rate').val(response.billing_details.amount);
							$('#effective_from').val(response.billing_details.effective_from);					
							$('#effective_to').val(response.billing_details.effective_to);
							// $('#prof_tax').val(pt_amount);					

							if(response.profile_details.joining_date != null)
								$('#joining_date').val(formatDate (response.profile_details.joining_date));
						}
						else
						{
							$('#monthly_salary_slip').trigger("reset");
							$(this).closest('form').find("input[type=text]").val("");	
						}
					}
				// }
			// }			
		});

		$('#paid_hours').blur(function(){	
			var paid_hours = $(this).val();
			var tds =0;
			var total_deduction =0;
			var net_pay =0;

			if(($('#paid_hours').val() !='') && ($('#paid_hours').val() !=0))
			{
				total_earnings = paid_hours*$('#hourly_rate').val();	
				$('#total_earnings').val(total_earnings);
				tds = total_earnings/10;
				$('#tds').val(tds);
				// total_deduction = tds + parseFloat($('#prof_tax').val());
				total_deduction = tds ;
				$('#total_deduction').val(total_deduction);
				net_pay = total_earnings - parseFloat(total_deduction);
				$('#net_pay').val(net_pay);
			}
			else
			{
				$('#error_day').html('Enter paid hours').show().delay(2000).fadeOut(1000);
			}
		});

	});

	$('#datePicker').on('changeDate', function(e) {
		$('#datePicker1').datepicker('setStartDate', $('#effective_from').val());
	});
	$('#datePicker1').on('changeDate', function(e) {
		$('#datePicker').datepicker('setEndDate', $('#effective_to').val());
	});

</script>
 
