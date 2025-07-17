<div class="page-content">
	<div class="container-fluid">			
    	<div class="well">
			<div class="row">
				<form data-toggle="validator" class="col-sm-12" id="profile_form" action=" " method="post">
					<input type="hidden" name="criteria_id" value="<?php echo !empty($criteria_details->criteria_id) ? $criteria_details->criteria_id : ''; ?>">
					<?php //var_dump($criteria_details); ?>
					<h1 class="well headline">Add Performance Criteria</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							<div class="row">
								<div class="col-lg-2 col-sm-4 col-xs-12">
									<div class="form-group">
										<label class="form-label">Select Role <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-8 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select id="role_id" name="role_id" class="web form-control col-lg-12 col-sm-12 col-xs-12" required data-error="Please Select Role">
											<option value="" disabled="disabled" selected hidden>Select Role</option>
												  <?php foreach ($roles as $role) {?>
												  	<option value="<?php echo $role->role_id?>" <?php echo (@$criteria_details->role_id == @$role->role_id) ? 'selected' : ''; ?>><?php echo $role->role_name?></option>
												  <?php }?>
											</select>
									<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-2 col-sm-4 col-xs-12">
									<div class="form-group">
										<label class="form-label">Criteria <span>*</span></label>
									</div>
								</div>							
								<div class="col-lg-10 col-sm-8 col-xs-12">
                           <div class="form-group">
                                 <div class="form-control-wrapper form-control-icon-right">
                                    <input class="form-control" placeholder="Enter Criteria" type="text" name="criteria_name"  value="<?php echo !empty($criteria_details->criteria_name) ? $criteria_details->criteria_name: ''?>" required data-error="Please Enter Criteria">    
									<div class="help-block with-errors error_msg"></div>                                      
                                 </div>
                           </div>
								</div>
							</div>

                     <div class="row">
								<div class="col-lg-2 col-sm-4 col-xs-12">
									<div class="form-group">
										<label class="form-label">Percent Value <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-8 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control number" placeholder="Enter valid value" type="text" name="percent_value" id="percent_value" maxlength="3" min="1" max="100" value="<?php echo !empty($criteria_details->percent_value) ? $criteria_details->percent_value: ''?>" required data-error="Please Enter Percent Value">
									<div class="help-block with-errors error_msg" id="per"></div>
										</div>
									</div>
								</div>
							</div>
								
							<div class="row">
								<div class="col-lg-12">
									<button class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label" id="submit_per">Submit</span>
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
</div><!--.page-content-->
<script type="text/javascript">
	$('#percent_value').on('blur', function() {
		var val = $('#percent_value').val();
		if(val <=0 || val > 100)
		{
			$('#per').text("Enter valid percentage.").show().delay(2000).fadeOut(800);
        	$('#submit_per').attr('disabled', true);
		}
		else
		{
			$('#submit_per').removeAttr('disabled');
		}
	});
</script>