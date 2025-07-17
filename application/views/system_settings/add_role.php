<div class="page-content">
	<div class="container-fluid p-xl-0">
		<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>Add New Role</h2>
						</div>						
					</div>
				</div>
			</header>
		<div class="well">
			 <div class="row">

				<form data-toggle="validator" class="col-sm-12" id="role_frm" action=" " method="post">
						<input type="hidden" name="role_id" id="role_id" value="">				
							<div class="col-sm-12 col-xs-12 profile_bg">
								<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Role Name</label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control" placeholder="Role Name" type="text" name="role_name" id="role_name" required="" oninvalid="this.setCustomValidity('Please Enter valid ID')" 
		                                            oninput="setCustomValidity('');">
												<i class="fa fa-user"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Role Description</label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input required="" class="form-control" placeholder="Role Description" type="text" name="role_description" id="role_description">
											</div>
										</div>
									</div>
								</div>						
								<div class="row">
									<div class="col-lg-6">
										<input id="create_role" type="Submit" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
										<input type="reset" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
									</div>							
								</div>		
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>