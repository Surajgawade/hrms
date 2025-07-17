<?php
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
?>
<div class="page-content">
	<div class="container-fluid">
	<div class="col-sm-12 well">
	<?php $this->load->view('rpo_manager/rpo_emp_menu');?>
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
										<?php if(isset($can_details)){?>
										<input class="form-control" placeholder="Employee Name" type="text" value="<?php echo (isset($can_details->can_name) && !empty($can_details->can_name))? $can_details->can_name : '';?>" readonly>
									<?php } ?>
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
										<input class="form-control" placeholder="Date of Joining" type="text" id="joining_date" value="<?php echo (isset($can_details->joining_date) && !empty($can_details->joining_date)) ? format_date($can_details->joining_date) : '';?>" readonly>
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
										<input placeholder="Designation" class="form-control" type="text" id="designation" value="<?php echo (isset($can_details->designation) &&!empty($can_details->designation)) ? $can_details->designation : '';?>" readonly >
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
										<input placeholder="Department" class="form-control" type="text"  id="department" value="<?php echo (isset($can_details->department) && !empty($can_details->department)) ? $can_details->department : '';?>" readonly>
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
									<input type="text" class="form-control" id="effective_from" placeholder="dd/mm/yyyy"  data-error="Please Enter Effective from Date" value="<?php echo (isset($billing_details['effective_from']) && !empty($billing_details['effective_from'])) ? format_date($billing_details['effective_from']) : '';?>" required readonly/>
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
										<input type="text" class="form-control" id="effective_to" placeholder="dd/mm/yyyy" value="<?php echo (isset($billing_details['effective_to']) && !empty($billing_details['effective_to'])) ? format_date($billing_details['effective_to']) : '';?>" readonly	/>
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
										<input placeholder="Hourly Rate" class="form-control" type="text" id="hourly_rate" value="<?php echo (isset($billing_details['amount']) &&!empty($billing_details['amount'])) ? $billing_details['amount'] : '';?>" readonly>
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
										<input placeholder="Paid Hours" class="form-control number" type="text" name="paid_hours" id="paid_hours" value="">
										<span id='err_paid_hours' class="error_msg"></span>
									</div>
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Professional Tax</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input placeholder="Professional Tax" class="form-control" type="text" name="prof_tax" id="prof_tax" value="0">
									</div>
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">TDS</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input placeholder="TDS" class="form-control number" type="text" name="tds" id="tds" value="" readonly>
									</div>
								</div>
							</div>
						</div> 

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Total Earnings</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input placeholder="Total Earnings" class="form-control" type="text" name="total_earnings" id="total_earnings" value="" readonly>
									</div>
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Total Deduction</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input placeholder="Total Deduction" class="form-control number" type="text" name="total_deduction" id="total_deduction" value="" readonly>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Net Pay</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input placeholder="Net Pay" class="form-control" type="text" name="net_pay" id="net_pay" value="" readonly>
									</div>
								</div>
							</div>
						</div>             

						<div class="row">
							<div class="col-lg-6">
								<button class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label" id="generate">Submit</span>
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
	$(document).ready(function()
	{
		$('.chosen-select').chosen();
		$('#datePicker, #datePicker1, #datePicker2')
	        .datepicker({
	            format: 'dd/mm/yyyy'
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
				total_deduction = tds + parseFloat($('#prof_tax').val());
				$('#total_deduction').val(total_deduction);
				net_pay = total_earnings - parseFloat(total_deduction);
				$('#net_pay').val(net_pay);
			}
			else
			{
				$('#error_day').html('Enter paid hours').show().delay(2000).fadeOut(1000);
			}
		});

		$('#generate').click(function (e)
		{	
			e.preventDefault();
			var can_id = '<?php echo $this->uri->segment(3);?>';
			var paid_hours= $('#paid_hours').val();
			var month= $('#month').val();
			var year= $('#year').val();
			var prof_tax= $('#prof_tax').val();
			var tds= $('#tds').val();
			var total_earnings= $('#total_earnings').val();
			var total_deduction= $('#total_deduction').val();
			var net_pay= $('#net_pay').val();
			if($('#paid_hours').val()=='')
			{
			$('#err_paid_hours').text(" Please enter paid hours").show().delay(2000).fadeOut(800);
				event.preventDefault();
			}
			else
			{
				$('#generate').attr('disabled',true);
				$.ajax({
					url: '<?php echo site_url();?>/rpo_manager/add_salary_slip',
					data : {can_id: can_id, paid_hours:paid_hours, month: month,year:year,prof_tax:prof_tax,tds:tds,total_earnings:total_earnings,total_deduction:total_deduction,net_pay:net_pay},
					type: 'POST',
					success: function(response){
	
						$.notify({
								title: "<strong>Success:</strong> ",
								message: "Salary Slip Generated Successfully!",
								
							},{
							type: "success",
							delay: 800,
								animate:{
									enter: "animated fadeInUp",
									exit: "animated fadeOutDown"
								} 
						});	
						// setTimeout(function () {
						// window.location.href = '<?php //echo site_url();?>/rpo_manager/billing/'+can_id;
    		// 		}, 2000);	
				}
						
			
				});

				//window.location.href = '<?php //echo site_url();?>/candidate/billing/'+can_id;
			}
		});
	});

</script>
	