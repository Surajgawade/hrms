<?php print_r($this->content->menu_details);
 ?>
<div class="page-content">
	<div class="container-fluid p-xl-0">
		<div class="well">
			 <div class="row">
			 	<div class="col-sm-12">
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
				<form data-toggle="validator" class="col-sm-12" id="menu_frm" name="menu_frm" action="" method="post">
					<h1 class="well headline">Edit Menu Operation</h1>
						<input type="hidden" name="menu_id" id="menu_id" value="">				
							<div class="col-sm-12 col-xs-12 profile_bg">
								<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Menu Operation Name</label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control" placeholder="Menu Name" type="text" name="mo_name" id="mo_name" required="" oninvalid="this.setCustomValidity('Please Enter Menu Name')" oninput="setCustomValidity('');" value="<?php echo $menu_details->menu_operation_name ?>">
											</div>
										</div>
									</div>
								</div>
		
								<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Description</label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input required="" class="form-control" placeholder="Menu Description" type="text" name="menu_description" id="menu_description" value="<?php echo $menu_details->description ?>">
											</div>
										</div>
									</div>
								</div>
								<input type="hidden" class="form-control" placeholder="Menu Description" type="text" name="mo_id" id="mo_id" value="<?php echo $menu_details->mo_id ?>">
								
								<div class="row">
									<div class="col-lg-12">
										<input id="create_menu" type="submit" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Save"/>
										<input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
									</div>							
								</div>
								<div class="row">
									<div class="col-lg-12">
										<?php echo $this->session->flashdata('message');?>
									</div>
								</div>
							</div>
					   </form> 
			 </div>
		</div>

		</div>										
	</div>
</div>
<script src="<?php echo assets_url();?>js/lib/icon/icon.js"> </script>
