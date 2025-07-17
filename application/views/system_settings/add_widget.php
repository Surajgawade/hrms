 <div class="page-content">
	<div class="container-fluid p-xl-0">
		<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>Add New Widget</h2>
						</div>						
					</div>
				</div>
			</header>
		<div class="well">
			 <div class="row">

				<form data-toggle="validator" class="col-sm-12" id="role_frm" action=" " method="post">
						<input type="hidden" name="widget_id"  id="widget_id" value="<?php echo (isset($widget_details['widget_id']))? $widget_details['widget_id']:'' ?>"">				
							<div class="col-sm-12 col-xs-12 profile_bg">
								<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Widget Name</label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper">
												<input class="form-control" placeholder="Widget Name" type="text" name="widget_name" id="widget_name" value="<?php echo (isset($widget_details['widget_name']))? $widget_details['widget_name']:'' ?>" required="">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Widget Description</label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input required="" class="form-control" placeholder="Widget Description" type="text" name="widget_description" value="<?php echo (isset($widget_details['widget_description']))? $widget_details['widget_description']:'' ?>" id="widget_description">
											</div>
										</div>
									</div>
								</div>						
								<div class="row">
									<div class="col-lg-6">
										<input id="create_widget" type="Submit" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
										<input type="reset" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
									</div>							
								</div>		
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
