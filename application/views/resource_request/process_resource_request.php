
<div class="page-content">
	<div class="container-fluid">
		<div class="well" style="margin-bottom:20px;">
			<div class="row">
				<form data-toggle="validator" class="col-sm-12" id="resource_request_form" action="" method="post">
					<input type="hidden" name="request_id" id="request_id" value="<?php echo !(empty($resource_request['id'])) ? $resource_request['id'] : '';?>">				
					<input type="hidden" name="status" id="status" value="<?php echo !(empty($GET['status'])) ? $GET['status'] : '';?>">				
					<h1 class="well headline">Process Resource Request</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label"> Resource Type</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" value=" <?php echo (isset($resource_request['title']) && !empty($resource_request['title'])) ? $resource_request['title'] : '';?>" readonly>
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
										<input type="text" class="form-control" value=" <?php echo (isset($resource_request['no_of_positions']) && !empty($resource_request['no_of_positions'])) ? $resource_request['no_of_positions'] : '';?>" readonly/>
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
											<textarea class="form-control" readonly=""><?php echo (isset($resource_request['job_description']) && !empty($resource_request['job_description'])) ? $resource_request['job_description'] : '';?></textarea>
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
											<textarea  class="form-control" readonly=""><?php echo (isset($resource_request['keywords']) && !empty($resource_request['keywords'])) ? $resource_request['keywords'] : '';?></textarea>
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
											<input class="form-control" type="text" readonly="" value="<?php echo (isset($resource_request['budget']) && !(empty($resource_request['budget']))) ? $resource_request['budget'] : '';?>">
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
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" type="text" value="<?php echo (isset($resource_request['experience']) && !(empty($resource_request['experience']))) ? $resource_request['experience'] : '';?>" readonly>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Comment </label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<textarea class="form-control" name="comment" id="comment"></textarea>
										</div>
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-lg-6">
									<button class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label" id="submit_form">Submit</span>
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
	$(document).ready(function () {
		$(".chosen-select").chosen();
		$('#submit_form').click(function (event) {
			if($('#resource_type').val()=='')
			{
				$('#err_resource_type').html('Please select resource type').show().delay(2000).fadeOut(1000);
				$("html, body").animate({ scrollTop: 0 }, "slow");
				return false;
				
			}
		});
	});
</script>
