<div class="page-content">
	<div class="container-fluid">
	<div class="col-sm-12 well">
	<?php $this->load->view('rpo_manager/rpo_emp_menu');?>
		 <div class="row">
				<form data-toggle="validator" class="col-sm-12" id="billing_form" action=" " method="post">
					
					<h1 class="well headline">Add Employee Billing Details</h1>
						<div class="profile_bg col-sm-12 col-xs-12 ">
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Employee Name</label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-3 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<label class="form-label name_lable"><?php echo $can_details->can_name;?></label>
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Type of Rate <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-3 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select id="rate_type" name="rate_type" class="web chosen-select" style="width: 100%" required >
												  <option value="hourly">Per Hour</option>
												  <option value="daily">Per Day</option>
												  <option value="weekly">Per Week</option>
												  <option value="monthly">Per Month</option>
												  <option value="yearly">Per Year</option>
											</select>
											<span class="error_msg" id ="rate_err"></span>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Client Name:</label>
									</div>
								</div>
								<div class="col-lg-4 col-sm-3 col-xs-12">
									<div class="form-group">
										<input type="text" class="form-control" name="" id="" value="<?php echo $interview_details['client_name'];?>" readonly>
										<input type="hidden" name="client_id" id="client_id" value="<?php echo $interview_details['client_id'];?>">
									</div>
								</div>
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Project Name:</label>
									</div>
								</div>
								<div class="col-lg-4 col-sm-3 col-xs-12">
									<div class="form-group">
										<input type="text" class="form-control" name="" id="" value="<?php echo $interview_details['proj_title'];?>" readonly>
										<input type="hidden" name="project_id" id="project_id" value="<?php echo $interview_details['proj_id'];?>">
									</div>
								</div>			
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Effective from Date <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-3 col-xs-12">
	       						<div class="date form-group">
										<div class="input-group input-append date" id="datePicker">
											<input type="text" class="form-control" name="from_date" id="from_date" placeholder="dd/mm/yyyy" value="<?php echo format_date($interview_details['proj_start_date']);?>" required />
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
										<span class="error_msg" id ="from_err"></span>
									</div>
								</div>
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Effective to Date <span>*</span></label>
									</div>
								</div>

								<div class="col-lg-4 col-sm-3 col-xs-12">
									<div class="date form-group">
										<div class="input-group input-append date" id="datePicker1">
											<input type="text" class="form-control" name="to_date" id="to_date" placeholder="dd/mm/yyyy" value="<?php echo format_date($interview_details['proj_end_date']);?>"/>
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Amount <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-3 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control number" placeholder="Enter Amount" type="text" maxlength="6" minlength="1" name="amount" id="amount" value="<?php echo $interview_details['offered_rate'];?>" required  >
											<i class="fa fa-rupee"></i>
											<span class="error_msg" id ="amount_err"></span>
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Review Date </label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-3 col-xs-12">
									<div class="date form-group">
										<div class="input-group input-append date" id="datePicker2">
											<input type="text" class="form-control" name="review_date" id="review_date" placeholder="dd/mm/yyyy"/>
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
									</div>
								</div>
							</div>
										
							<div class="row">
								<div class="col-lg-6">
									<input id="submit_billing" type="button" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
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
	$(document).ready(function()
	{
		$('.chosen-select').chosen();
		$('#datePicker, #datePicker1, #datePicker2')
	        .datepicker({
	            format: 'dd/mm/yyyy'
   		});

		$('#submit_billing').click(function (e)
		{	

			e.preventDefault();
			var can_id = '<?php echo $this->uri->segment(3);?>';
			var bill_id= $('#bill_id').val();
			var rate_type= $('#rate_type').val();
			var amount= $('#amount').val();
			var client_id= $('#client_id').val();
			var project_id= $('#project_id').val();
			var from_date= $('#from_date').val();
			var to_date= $('#to_date').val();
			var review_date= $('#review_date').val();
			if($('#rate_type').val()=='')
			{
			$('#rate_err').text(" Please Select Rate Type").show().delay(2000).fadeOut(800);
				event.preventDefault();
			}
			else if($('#amount').val()=='' || $('#amount').val()<=0)
			{
				$('#amount_err').text(" Please Enter Valid Amount").show().delay(2000).fadeOut(800);
	         event.preventDefault();
			}
			else if($('#from_date').val()=='')
			{
				$('#from_err').text(" Please Select Effective from Date").show().delay(2000).fadeOut(800);
	         event.preventDefault();
			}
			else if($('#to_date').val()=='')
			{
				$('#to_err').text(" Please Select Effective to Date").show().delay(2000).fadeOut(800);
	         event.preventDefault();
			}
			else
			{
				$('#submit_billing').attr('disabled',true);
				$.ajax({
					url: '<?php echo site_url();?>/rpo_manager/add_billing_details',
					data : {can_id: can_id, bill_id:bill_id, rate_type: rate_type,amount:amount,client_id:client_id,project_id:project_id,from_date:from_date,to_date:to_date,review_date:review_date},
					type: 'POST',
					success: function(response){
	
						$.notify({
								title: "<strong>Success:</strong> ",
								message: "Billing Details Added Successfully!",
								
							},{
							type: "success",
							delay: 800,
								animate:{
									enter: "animated fadeInUp",
									exit: "animated fadeOutDown"
								} 
						});	
						setTimeout(function () {
						window.location.href = '<?php echo site_url();?>/rpo_manager/billing/'+can_id;
    				}, 2000);	
				}
				});
			}
		});
	});

/*	$('#datePicker').on('changeDate', function(e) {
	    var start = $(this).datepicker('getDate');
	    var end = $('#datePicker1').datepicker('getDate');
	    var days = (end - start) / (1000 * 60 * 60 * 24);
	    if(days < 0)
	    {
	    	$.notify({
	            title: "<strong>Warning</strong>",
	            message: "From Date must be less than To Date.",
	            
	        },
	        {
	            type: 'warning',
	            delay: 800,
	            animate:{
	                enter: "animated fadeInUp",
	                exit: "animated fadeOutDown"
	            }
	        });
	        $('#to_err').text("From Date must be less than To Date.").show().delay(2000).fadeOut(800);
	        $('#to_date').val('');
	    }
	});

	$('#datePicker1').on('changeDate', function(e) {
	    var start = $('#datePicker').datepicker('getDate');
	    var end = $(this).datepicker('getDate');
	    var days = (end - start) / (1000 * 60 * 60 * 24);
	    if(days < 0)
	    {
	    	$.notify({
	            title: "<strong>Warning</strong>",
	            message: "From Date must be less than To Date.",
	            
	        },
	        {
	            type: 'warning',
	            delay: 800,
	            animate:{
	                enter: "animated fadeInUp",
	                exit: "animated fadeOutDown"
	            }
	        });
	        $('#to_err').text("From Date must be less than To Date.").show().delay(2000).fadeOut(800);
	    	$('#to_date').val('');
	    }
	});*/
</script>
	