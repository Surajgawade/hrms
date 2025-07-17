
<div class="page-content">
	<div class="container-fluid">
		<div class="well" style="margin-bottom:20px;">
			<div class="row">
				<form data-toggle="validator" class="col-sm-12" id="menu_frm" action="" method="post">
					<input type="hidden" name="asset_code" id="asset_code" value="<?php echo !(empty($asset_details['asset_code'])) ? $asset_details['asset_code'] : '';?>">				
					<h1 class="well headline">Add / Edit Asset Details</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Asset Name <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Asset Name" type="text" name="asset_name" id="asset_name" value="<?php echo !(empty($asset_details['asset_name'])) ? $asset_details['asset_name'] : '';?>" required data-error="Please Enter Asset Name">
											<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>


								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Asset Type   <span>*</span></label>
									</div>
								</div>
						
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select class="chosen-select col-md-10 col-sm-12 col-xs-12" name="asset_type" id="asset_type" required data-error="Please Select Asset Type">
											<option value="" selected="" disabled>Select Asset Type</option>
												<?php foreach ($asset_types as $key => $type) {?>
												<option value="<?php echo $type->asset_code?>" <?php if($type->asset_code==$asset_details['asset_type']){echo "selected";}?>><?php echo $type->title?></option>
												<?php }?>
											</select>
											<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>


								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Quantity On Hand </label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control number" placeholder="Quantity On Hand" type="text" name="quant_on_hand" id="quant_on_hand" value="<?php echo !(empty($asset_details['quant_on_hand'])) ? $asset_details['quant_on_hand'] : '';?>" >
										</div>
									</div>
								</div>


								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Quantity In Store </label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Quantity In Store" type="text" name="quant_in_store" id="quant_in_store" value="<?php echo !(empty($asset_details['quant_in_store'])) ? $asset_details['quant_in_store'] : '';?>">
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Assigned To <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select class="chosen-select col-md-10 col-sm-12 col-xs-12" name="assigned_to" id="assigned_to" required>
											<option value="" selected hidden>Select Employee Name</option>
												<?php foreach ($candidates as $key => $candidate) {?>
												<option value="<?php echo $candidate->can_id?>" <?php if($candidate->can_id==$asset_details['assigned_to']){echo "selected";}?>><?php echo $candidate->can_name?></option>
												<?php }?>
											</select>
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Description </label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Description" type="text" name="description" id="description" value="<?php echo !(empty($asset_details['description'])) ? $asset_details['description'] : '';?>">
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

<script type="text/javascript">
	$(document).ready(function() {
		$(".chosen-select").chosen();
	});
</script>