<div class="page-content">
	<?php $this->load->view('candidate/can_menu');?>
	<div class="container-fluid p-xl-0">
	<div class="well">
		 <div class="row">
				<form data-toggle="validator" class="col-sm-12" id="billing_form" action=" " method="post">
					
					<h1 class="well headline">Assign Assets</h1>
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
/*
		$('#submit_billing').click(function (e)
		{	

			e.preventDefault();
			var can_id = '<?php echo $this->uri->segment(3);?>';
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
					url: '<?php echo site_url();?>/candidate/add_billing_details',
					data : {can_id: can_id, bill_id:bill_id, rate_type: rate_type,amount:amount,from_date:from_date,to_date:to_date,review_date:review_date},
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
						window.location.href = '<?php echo site_url();?>/candidate/billing/'+can_id;
    				}, 2000);	
				}
						
			
				});

				//window.location.href = '<?php //echo site_url();?>/candidate/billing/'+can_id;
			}
		});*/
	});

</script>
	