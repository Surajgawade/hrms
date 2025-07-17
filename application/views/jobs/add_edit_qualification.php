
<div class="page-content">
	<div class="container-fluid">
		<div class="well" style="margin-bottom:20px;">
			<div class="row">
				<form data-toggle="validator" class="col-sm-12" id="menu_frm" action="" method="post">
					<input type="hidden" name="id" id="id" value="<?php echo !(empty($qua_details['id'])) ? $qua_details['id'] : '';?>">				
					<h1 class="well headline">Add / Edit Qualification Details</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Qualification Name <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Eduation Qualification" type="text" name="title" id="title" value="<?php echo !(empty($qua_details['title'])) ? $qua_details['title'] : '';?>" required data-error="Please Enter Qualification">
											<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-lg-6">
									<button class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label" id="submit_form">Submit</span>
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
</div>
