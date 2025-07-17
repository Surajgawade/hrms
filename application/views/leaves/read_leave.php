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
			 <div class="col-sm-12" >
					<h1 class="well headline" style="margin-bottom: 10px !important;">Leave Manager<a href="javascript:window.history.go(-1);" class="text-white pull-right m-r">Back To List</a></h1>
						<div class="col-sm-12 col-xs-12 can_details">
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Leave Type :</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php if(isset($leave_details->leave_title)) echo $leave_details->leave_title;  ?></p>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Acronym :</label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<p><?php if(isset($leave_details->acronym)){ echo $leave_details->acronym; } ?></p>
										</div>
									</div>
								</div>
							</div>

						</div>
						<div class="row">
			<div class="col-md-1"></div>
		</div>
			</div>
		</div>
	</div>
</div>
