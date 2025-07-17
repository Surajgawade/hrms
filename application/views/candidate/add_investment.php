<div class="page-content">
	<div class="container-fluid">
		<?php $this->load->view('candidate/can_menu');?>
		<div class="well">
		 <div class="row">
			<form data-toggle="validator"  class="col-sm-12" id="investment_form" action=" " method="post">
				<h1 class="well headline">Investment Form</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Employee Name</label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<label class="form-label name_lable"><?php echo $can_details->can_name;?></label>								
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
										<input class="form-control number" maxlength="10" minlength="1" placeholder="Amount" type="text" name="amount" id="amount" required>
											<span class="error_msg" id ="amt_err"></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Description </label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea placeholder="Description" rows="3" class="form-control" name="description" id="description" ></textarea>
										<i class="fa fa-address-card"></i>
									</div>
								</div>
							</div>
						</div>
													
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Section <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select class="chosen-select alpha_only" name="policy" id="policy" style="width: 100%" required="">
									  <option value="Select Name" selected hidden disabled>Select Name</option>
									  <?php foreach ($policies as $key => $policy) {?>
									 	 <option value="<?php echo $policy['policy_id']?>" ><?php echo $policy['policy_title'];?></option>									  	
									  <?php }?>
									</select>
									<!-- <select class="form-control col-md-10 col-sm-12 col-xs-12" id="section" style="width:500px" name="section" required data-errror="Please Select Policy" ></select> -->
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Policy <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select class="form-control" id="section" style="width:100%" name="section" required data-errror="Please Select Policy" ></select>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<input id="submit_investment" type="button" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
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


function get_select2_data()
	{
		url='<?php echo site_url();?>'+'/rpo_manager/get_policy_list';
		placeholder = '--- Select Policy ---';
		select2(section,url,placeholder);
	}

	$(document).ready(function(){
		$(".chosen-select").chosen();


		//get_select2_data();

		$("#policy").change(function () { 
			//jQuery('#ajax_loader').show();
			var policy_id = $('#policy option:selected').val();
			console.log(policy_id);
			var url = '<?php echo site_url()?>' + '/rpo_manager/get_section_by_policy';
			// placeholder = '--- Select Policy ---';
			// select2(section,url,placeholder);
			$.ajax({type: "POST",data:{policy_id:policy_id},url: url,success: function(response){
				console.log(response);
				// alert(data);
				$("#section").html(response);
				//jQuery('#ajax_loader').hide();	   
			}		
			});
		});

    	$('#submit_investment').click(function (e) {	
			e.preventDefault();
			var can_id = '<?php echo $this->uri->segment(3);?>';
			var inv_id= $('#inv_id').val();
			var description = $('#description').val();
			var amount= $('#amount').val();
			var policy_id = $('#policy option:selected').val();
			var section = $('#section').val();
			if($('#amount').val()=='' || $('#amount').val()<=0)
			{
			$('#amt_err').text(" Please Enter Valid Amount").show().delay(2000).fadeOut(800);
				event.preventDefault();
			}
			else
			{
				$('#submit_investment').attr('disabled',true);
				$.ajax({
					url: '<?php echo site_url();?>/candidate/add_investment_details',
					data : {can_id: can_id, inv_id:inv_id, description: description,amount:amount,policy_id : policy_id,section:section},
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