
<div class="page-content">
	<div class="container-fluid">
		<?php $this->load->view('rpo_manager/rpo_emp_menu');?>
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
										<input class="form-control" placeholder="Amount" type="text" name="amount" id="amount" required value="<?php echo !empty($inv_details['amount']) ? $inv_details['amount']:''?>">
											<span class="error_msg" id ="amt_err"></span>
									</div>
								</div>
							</div>
						</div>
													
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Policy <span>*</span></label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select class="chosen-select col-md-10 col-sm-12 col-xs-12 alpha_only" name="policy" id="policy" style="width: 100px" required="">
									  <option value="Select Name">Select Name</option>
									  <?php foreach ($policies as $key => $policy) {?>
									 	 <option value="<?php echo $policy['policy_id']?>" <?php if($policy['policy_id']==$inv_details['section']) { echo "selected";}?>><?php echo $policy['policy_title'];?></option>									  	
									  <?php }?>
									</select>
									<!-- <select class="form-control col-md-10 col-sm-12 col-xs-12" id="section" style="width:500px" name="section" required data-errror="Please Select Policy" ></select> -->
										<div class="help-block with-errors error_msg"></div>
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
										<?php if(!empty($inv_details['policy_id'])){ ?>
										<select class="form-control col-md-10 col-sm-12 col-xs-12" id="section" style="width:500px" name="section" required data-errror="Please Select Policy" >
											<option value="<?php echo $inv_details['policy_id'];?>" selected><?php echo $inv_details['policy_id'];?></option>
										</select>
										<?php } else {?>
										<select class="form-control col-md-10 col-sm-12 col-xs-12" id="section" style="width:500px" name="section" required data-errror="Please Select Policy" ></select>
										<?php }?>
										<div class="help-block with-errors error_msg"></div>
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
										<textarea placeholder="Description" rows="3" class="form-control" name="description" id="description" ><?php echo !empty($inv_details['description']) ? $inv_details['description']:''?></textarea>
										<i class="fa fa-address-card"></i>
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
		$(".chosen-select").chosen();

		$("#policy").change(function () { 
			//jQuery('#ajax_loader').show();
			var policy_id = $('#policy option:selected').val();
			console.log(policy_id);
			var url = '<?php echo site_url()?>' + '/rpo_manager/get_section_by_policy';
			// placeholder = '--- Select Policy ---';
			// select2(section,url,placeholder);
			$.ajax({type: "POST",data:{policy_id:policy_id},url: url,success: function(response){
				$("#section").html(response);
			}		
			});
		});

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
					url: '<?php echo site_url();?>/rpo_manager/add_investment_details',
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
					window.location.href = '<?php echo site_url();?>/rpo_manager/investment/'+can_id;
	    				}, 2000);
			   		}
				});
				document.getElementById("investment_form").reset();
			}
		});		
	});
</script>