   <?php
   // x_debug($rpoempsalary_details);
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
			<form data-toggle="validator" class="col-sm-12" name="salarydetails_form" id="salarydetails_form" action="" method="post">

				<input type="hidden" name="rpo_sal_id" id="rpo_sal_id" value="<?php echo !(empty($rpoempsalary_details->rpo_sal_id)) ? $rpoempsalary_details->rpo_sal_id : '';?>">				
				<input type="hidden" name="can_id" id="can_id" value="<?php echo !(empty($rpoempsalary_details->can_id)) ? $rpoempsalary_details->can_id : '';?>">		
				<h1 class="well headline"><?php echo empty($rpoempsalary_details->rpo_sal_id) ? 'Add' : 'Edit';?> RPO Employee Salary Details</h1>
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
										<?php if(isset($rpoempsalary_details)){?>
										<input class="form-control" placeholder="Employee Name" type="text" name="joining_date" id="joining_date" value="<?php echo (isset($rpoempsalary_details->can_name) && !empty($rpoempsalary_details->can_name))? $rpoempsalary_details->can_name : '';?>" readonly>
									<?php } else{?>
										<select class="chosen-select col-md-10 col-sm-12 col-xs-12 " name="can_id" id="can_name"  style="width: 100%" required data-error="Select Employee Name" >
												<option value="" selected hidden>Select Employee Name</option>
												<?php foreach ($rpo_candidates as $key => $candidate) {?>
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
										<input class="form-control" placeholder="Date of Joining" type="text" name="joining_date" id="joining_date" value="<?php echo (isset($rpoempsalary_details->joining_date) && !empty($rpoempsalary_details->joining_date)) ? format_date($rpoempsalary_details->joining_date) : '';?>" readonly>
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
										<input placeholder="Designation" class="form-control" type="text" name="designation" id="designation" value="<?php echo (isset($rpoempsalary_details->designation) &&!empty($rpoempsalary_details->designation)) ? $rpoempsalary_details->designation : '';?>" required data-error="Enter Designation">
										<div class="help-block with-errors error_msg"></div>
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
										<input placeholder="Department" class="form-control" type="text"  name="department" id="department" value="<?php echo (isset($rpoempsalary_details->department) && !empty($rpoempsalary_details->department)) ? $rpoempsalary_details->department : '';?>">
									</div>
								</div>
							</div>
						</div>
             		

                	<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Effective From Date </label>
								</div>
							</div>
						
							<div class=col-lg-4>
       						<div class="date form-group">
								<div class="input-group input-append date" id="datePicker">
									<input type="text" class="form-control" name="effective_from" id="effective_from" placeholder="dd/mm/yyyy"  data-error="Please Enter Effective from Date" value="<?php echo (isset($rpoempsalary_details->effective_from) && !empty($rpoempsalary_details->effective_from)) ? format_date($rpoempsalary_details->effective_from) : '';?>"/>
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
										<input type="text" class="form-control" name="effective_to" id="effective_to" placeholder="dd/mm/yyyy" value="<?php echo (isset($rpoempsalary_details->effective_to) && !empty($rpoempsalary_details->effective_to)) ? format_date($rpoempsalary_details->effective_to) : '';?>"/>
										<span class="input-group-addon add-on"><span  id="demo-2-button" class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
							</div>
						</div>  

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Hourly Rate <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input placeholder="Hourly Rate" class="form-control number" type="text" name="hourly_rate" id="hourly_rate" value="<?php echo (isset($rpoempsalary_details->hourly_rate) &&!empty($rpoempsalary_details->hourly_rate)) ? $rpoempsalary_details->hourly_rate : '';?>" required data-error="Enter Hourly Rate">
										<div class="help-block with-errors error_msg" id="err_hourly_rate"></div>
									</div>
								</div>
							</div>
						</div>              

						<div class="row">
							<div class="col-lg-6">
								<button class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label" id="submit_form">Submit</span>
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
			if($("#can_name").chosen().val()=='')
			{
				$('#err_canid').html('Please Select Employee').show().delay(2000).fadeOut(1000);;
				event.preventDeafault();
				return false;
			}
			else
			{
				var response = $.parseJSON($.ajax({
					url:  '<?php echo site_url();?>/rpo/get_can_details',
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

	});

	$('#datePicker').on('changeDate', function(e) {
		$('#datePicker1').datepicker('setStartDate', $('#effective_from').val());
	});
	$('#datePicker1').on('changeDate', function(e) {
		$('#datePicker').datepicker('setEndDate', $('#effective_to').val());
	});

	$("#submit_form").click(function(){
			if($('#hourly_rate').val()==0)
			{
				$('#err_hourly_rate').html('Hourly Rate Cannot Be 0').show();
				return false;
			}
			else
			{
				$('#err_hourly_rate').html('').hide();
			}
	});	

</script>
 
