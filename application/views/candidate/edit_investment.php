<div class="page-content">
	<div class="container-fluid">
		<?php $this->load->view('candidate/can_menu');?>
		<div class="well">
		 <div class="row">
			<form data-toggle="validator"  class="col-sm-12" id="investment_form" action=" " method="post">
				<input type="hidden" name="inv_id" id="inv_id" value="<?php echo !empty($inv_details->inv_id) ? $inv_details->inv_id:''?>">

				<h1 class="well headline">Investment Form</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Employee Name</label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<label class="form-label name_lable"><?php echo $can_details->can_name;?></label>								
							</div> 

						</div>

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Amount <span> * </span></label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Amount" type="text" name="amount" id="amount" required value="<?php echo !empty($inv_details->amount) ? $inv_details->amount:''?>">
											<span class="error_msg" id ="amt_err"></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Description </label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea placeholder="Description" rows="3" class="form-control" name="description" id="description" ><?php echo !empty($inv_details->description) ? $inv_details->description:''?></textarea>
										<i class="fa fa-address-card"></i>
									</div>
								</div>
							</div>
						</div>
													
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Section <span>*</span></label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select id="section" name="section" class="web" required required data-errror="Please Select Policy" >
											<optgroup label="Policy">
											  <option value="abc" <?php if($inv_details->section=="abc") echo "selected";?>>abc</option>
											  <option value="xyz" <?php if($inv_details->section=="xyz") echo "selected";?>>xyz</option>
											  <option value="pqr" <?php if($inv_details->section=="pqr") echo "selected";?>>pqr</option>
											  <option value="mno" <?php if($inv_details->section=="mno") echo "selected";?>>mno</option>
											</optgroup>
										
										</select>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<input id="submit_investment" type="button" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
							<!-- <input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset"> -->
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
    	$('#submit_investment').click(function (e) {		
			e.preventDefault();
			<?php $total = $this->uri->total_segments();
			$last = $this->uri->segment($total);?>
			var can_id = '<?php echo $last;?>';
			var inv_id= $('#inv_id').val();
			var description = $('#description').val();
			var amount= $('#amount').val();
			var section = $('#section').val();
			if($('#amount').val()=='')
			{
			$('#amt_err').text(" Please Enter Amount").show().delay(2000).fadeOut(800);
				event.preventDefault();
			}
			else
			{
				$('#submit_investment').attr('disabled',true);
				$.ajax({
					url: '<?php echo site_url();?>/candidate/add_investment_details',
					data : {can_id: can_id, inv_id:inv_id, description: description,amount:amount,section:section},
					type: 'POST',
					success: function(response){
	              		 $.notify({
					title: "<strong>Success:</strong> ",
					message:"Investment Details Updated Successfully!",				
					},{
					type: "success",
					delay: 800,
					animate:{
						enter: "animated fadeInUp",
						exit: "animated fadeOutDown"
						} 
					});	
					setTimeout(function () {
					window.location.href = '<?php echo site_url();?>/candidate/investment/'+can_id;
	    				}, 2000);
			   		}
				});
				document.getElementById("investment_form").reset();
			}
		});		
	});
</script>