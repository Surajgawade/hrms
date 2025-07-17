
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
		<?php } ?>
	</div>
	<div class="container-fluid">
		<div class="well" style="margin-bottom:20px;">
			<div class="row">
				<form data-toggle="validator" class="col-sm-12" id="resource_request_form" action="" method="post">
					<input type="hidden" name="request_id" id="request_id" value="<?php echo (isset($resource_request['request_id']))? $resource_request['request_id'] :'' ?>">				
					<h1 class="well headline">Resource Request</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label"> Resource Type <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input type="text" name="resource_type" id="resource_type" class="form-control" value="<?php if(isset($resource_request['title'])){ echo $resource_request['title'];} ?>" readonly>
											<!-- <select class="chosen-select col-md-10 col-sm-12 col-xs-12" name="resource_type" id="resource_type" required readonly>
											<option value="" selected="">Select Resource Type</option>
											<?php if(!empty($job_profiles)){ foreach ($job_profiles as $profile) {?>											
											<option value="<?php echo $profile->id?>" <?php if(isset($resource_request['resource_type']) && $profile->id == $resource_request['resource_type']) echo "selected";?>><?php echo $profile->title?></option>	
											<?php } }?> -->
										</select>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">No. of Positions <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control number" placeholder="No. of Positions" type="text" name="no_of_positions" id="no_of_positions" required data-error="Please Enter no of position" value="<?php echo (isset($resource_request['no_of_positions']) && !empty($resource_request['no_of_positions'])) ? $resource_request['no_of_positions'] : '';?>" maxlength="3">
											<div class="help-block with-errors error_msg" id="nop"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Job Description <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<textarea placeholder="Enter Description" rows="3" name="job_description" id="job_description" class="form-control" readonly><?php echo (isset($resource_request['job_description']) && !empty($resource_request['job_description'])) ? $resource_request['job_description'] : '';?> </textarea>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Keywords <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<textarea placeholder="Enter Keywords" rows="3" name="keywords" id="keywords" class="form-control" required data-error="Please Enter Keywords" readonly><?php echo (isset($resource_request['keywords']) && !empty($resource_request['keywords'])) ? $resource_request['keywords'] : '';?></textarea>
											<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label"> Qualification<span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											
												  <?php if(!empty($qualifications)){ 
												  	foreach ($qualifications as $qualification) {
												  	 if(in_array($qualification->id,explode(",",$resource_request['qualification']))){ 
												  	  echo'<input type="text" name="qualification" id="qualification" value='.$qualification->title.' class="form-control" readonly>';
												   }}}?>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Budget </label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control number" placeholder="Budget" type="text" name="budget" id="budget" value="<?php echo (isset($resource_request['budget']) && !(empty($resource_request['budget']))) ? $resource_request['budget'] : '';?>" maxlength="8">
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Experience </label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-10 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select name="experience" id="experience" class="form-control readonly">
												<option value="">Select Year</option>
												<?php for($i=0;$i<=30;$i++){ ?>
													<option value="<?php echo $i;?>"<?php if(isset($resource_request['experience']) &&($i == $resource_request['experience'])) echo "selected";?>><?php echo $i;?></option>
												<?php } ?>												
											</select>
											<span class="error_msg" id="err_resource_type"></span>	
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">
									<input type="hidden" name="request_status" id="request_status" value="<?php if(isset($resource_request['request_status'])){ echo $resource_request['request_status']; } ?>">
									<?php if(isset($resource_request['request_status']) && ($resource_request['request_status']==0) || ($resource_request['request_status']==3)){
										echo '<button class="btn btn-inline btn-success ladda-button " data-style="expand-left" id="update_req"><span class="ladda-label" >Update</span>
									<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
										<button class="btn btn-inline btn-primary ladda-button " data-style="expand-left" id="accept_req" name="accept_req"><span class="ladda-label" >Approve</span>
									<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>		
									<button class="btn btn-inline btn-danger ladda-button" data-style="expand-left" id="reject_req" name="reject_req"><span class="ladda-label">Reject</span>
									<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>';
	    							    $userdata = $this->session->userdata('logged_in_user');
										$super_user_role_id=$this->config->item('super_user_role_id');
						                if($userdata['role_id']!=$super_user_role_id[0])
						                {
										echo '<button class="btn btn-inline btn-info ladda-button" data-style="expand-left" id="process_req" name="process_req"><span class="ladda-label" >Process</span>
										<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
										';	
										}						
									} else if($resource_request['request_status']==1){ 
										echo "<h3 class='text-center text-primary'>The request has been Approved</h3>";
									} 
									else if($resource_request['request_status']==2){ 
										echo "<h3 class='text-center text-danger'>The request has been Rejected</h3>";
									} ?>
								</div>	
						</div>
					</div>
				</form> 
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$(".chosen-select").chosen();
	
		$('#update_req').click(function (event) {
			if($('#experience').val()=='')
			{
				$('#err_resource_type').html('Please select resource type').show().delay(2000).fadeOut(1000);
				$("html, body").animate({ scrollTop: 0 }, "slow");
				return false;
			}
			if($('#no_of_positions').val()=='' || $('#no_of_positions').val()<=0)
			{
				$('#nop').html('Enter valid No. of positions').show().delay(2000).fadeOut(1000);
				$("html, body").animate({ scrollTop: 0 }, "slow");
				return false;
			}

		});
		$("#accept_req").click(function(){
			var status=1;
			var request_id=$("#request_id").val();
			$.ajax({
				data:{status:status,request_id:request_id},
				type:'POST',
				url:'<?php echo site_url();?>/resource_request/process_request',
				
			});
		});
		$("#reject_req").click(function(){
			var status=2;
			var request_id=$("#request_id").val();
			$.ajax({
				data:{status:status,request_id:request_id},
				type:'POST',
				url:'<?php echo site_url();?>/resource_request/process_request',
				
			});
		});
		$("#process_req").click(function(){
			var status=3;
			var request_id=$("#request_id").val();
			$.ajax({
				data:{status:status,request_id:request_id},
				type:'POST',
				url:'<?php echo site_url();?>/resource_request/process_request',
				
			});
		});

	});
</script>
