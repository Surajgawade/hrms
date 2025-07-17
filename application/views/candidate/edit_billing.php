<div class="page-content">
	<div class="container-fluid">
	<div class="col-sm-12 well">
		<?php $this->load->view('candidate/can_menu');?>
		 <div class="row">
				<form data-toggle="validator" class="col-sm-12" id="billing_form" action=" " method="post">
					<input type="hidden" name="bill_id" id="bill_id" value="<?php echo !empty($billing_details->bill_id) ? $billing_details->bill_id:'' ;?>">
					<input type="hidden" name="can_id" id="can_id" value="<?php echo !empty($billing_details->can_id) ? $billing_details->can_id : '';?>">
					<h1 class="well headline">Edit Employee Billing Details</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Employee Name</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<label class="form-label name_lable"><?php echo $can_details->can_name;?></label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Type Of Rate <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select required id="rate_type" name="rate_type" class="web" style="width: 100%">
												  <option value="hourly" <?php if(!empty($billing_details->rate_type) && ($billing_details->rate_type  =="hourly")){ echo "selected";} ?>>Per Hour</option>
												  <option value="daily" <?php if(!empty($billing_details->rate_type) && ($billing_details->rate_type=="daily")){ echo "selected";} ?>>Per Day</option>
												  <option value="weekly" <?php if(!empty($billing_details->rate_type) && ($billing_details->rate_type=="weekly")){ echo "selected";} ?>>Per Week</option>
												  <option value="monthly" <?php if(!empty($billing_details->rate_type) && ($billing_details->rate_type=="monthly")){ echo "selected";} ?>>Per Month</option>
												  <option value="yearly" <?php if(!empty($billing_details->rate_type) && ($billing_details->rate_type=="yearly")){ echo "selected";} ?>>Per Year</option>
											</select>
											<span class="error_msg" id ="rate_err"></span>
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
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control number" placeholder="Enter Amount" type="text" name="amount" id="amount" required value="<?php echo !empty($billing_details->amount) ? $billing_details->amount: '';?>">
											<i class="fa fa-rupee"></i>
											<span class="error_msg" id ="amount_err"></span>
										</div>
									</div>
								</div>
							</div>

									
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Effective from Date <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-9 col-xs-12">
	       						<div class="date form-group">
									<div class="input-group input-append date" id="datePicker">
										<input type="text" class="form-control" name="from_date" id="from_date" placeholder="DD/MM/YYYY" value="<?php echo !empty($billing_details->effective_from) ? format_date($billing_details->effective_from):''?>"/>
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
											<span class="error_msg" id ="from_err"></span>
								</div>
								</div>	
							</div>
							
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Effective to Date <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="date form-group">
										<div class="input-group input-append date" id="datePicker1">
											<input type="text" class="form-control" name="to_date" id="to_date" placeholder="DD/MM/YYYY"  value="<?php echo !empty($billing_details->effective_to) ? format_date($billing_details->effective_to):''?>"/>
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
											<span class="error_msg" id ="to_err"></span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Review Date </label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="date form-group">
										<div class="input-group input-append date" id="datePicker2">
											<input type="text" class="form-control" name="review_date" id="review_date" placeholder="DD/MM/YYYY"  value="<?php echo !empty($billing_details->review_date) ? format_date($billing_details->review_date):''?>"/>
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
									</div>
								</div>
							</div>	
										
							<div class="row">
								<div class="col-lg-6">
									<input id="submit_billing" type="button" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
									<!-- <input type="button" class="btn btn-inline ladda-button" data-style="expand-left" value="Reset"> -->
								</div>							
							</div>
						</div>
				</form> 
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	$('#datePicker, #datePicker1, #datePicker2').datepicker({
            format: 'dd/mm/yyyy'
   		});
	$(document).ready(function()
	{
			$('#submit_billing').click(function (e)
		{		
			e.preventDefault();
			var can_id = '<?php echo $this->uri->segment(4);?>';
			var bill_id= $('#bill_id').val();
			var rate_type= $('#rate_type').val();
			var amount= $('#amount').val();
			var from_date= $('#from_date').val();
			var to_date= $('#to_date').val();
			var review_date= $('#review_date').val();
			if($('#rate_type').val()=='')
			{
			$('#rate_err').text(" Please Select Rate Type").show().delay(2000).fadeOut(800);
				event.preventDefault();
			}
			else if($('#amount').val()=='')
			{
				$('#amount_err').text(" Please Enter Amount").show().delay(2000).fadeOut(800);
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
					url: '<?php echo site_url();?>/candidate/add_billing_details',
					data : {can_id: can_id, bill_id:bill_id, rate_type: rate_type,amount:amount,from_date:from_date,to_date:to_date,review_date:review_date},
					type: 'POST',
					success: function(response)
					{
						$.notify({
								title: "<strong>Success:</strong> ",
								message: "Billing Details Updated Successfully!",
								
							},{
							type: "success",
							delay: 800,
								animate:{
									enter: "animated fadeInUp",
									exit: "animated fadeOutDown"
								} 
						});
						setTimeout(function () {
						window.location.href = '<?php echo site_url();?>/candidate/billing/'+can_id;
    				}, 2000);	
					}
				});

				//window.location.href = '<?php //echo site_url();?>/candidate/billing/'+can_id;
			}
		});
	});

	$('#datePicker').on('changeDate', function(e) {
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
	});
</script>
	