<?php
  $colors=array('brow'=>'cd6724','green'=>'46c35f','gold'=>'f29824','blue'=>'00a8ff','purple'=>'ac6bec','orange-red'=>'ff561c','grey'=>'adb7be','red'=>'fa424a','aquamarine'=>'21a788','magenta'=>'b348ae','blue-dirty'=>'1b99cf','coral'=>'fe664c','pink-red'=>'f5465e','Yellow'=>'FFFF00','blue-sky'=>'23b9e2');
?>
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
	<div class="container-fluid p-xl-0">	
		<div class="well">
			 <div class="row">	 	
				<form data-toggle="validator" class="col-sm-12" id="menu_frm" name="menu_frm" action="" method="post">
					<h1 class="well headline">Add New Menu</h1>
						<input type="hidden" name="menu_id" id="menu_id" value="">				
							<div class="col-sm-12 col-xs-12 profile_bg">
								<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Menu Name <span>*</span></label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control" placeholder="Menu Name" type="text" name="menu_name" id="menu_name" required data-error="Please Enter Menu Name">  
												<div class="help-block with-errors error_msg"></div>  
												<div class="help-block with-errors error_msg" id="err_menu"></div> 
											</div>
										</div>
									</div>
								</div>
		
								<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Description <span>*</span></label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control" placeholder="Menu Description" type="text" name="menu_description" id="menu_description" required data-error="Please Enter Description">  
											<div class="help-block with-errors error_msg"></div>   
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Parent Menu</label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<select  id="parent_menu" name="parent_menu" class="web" style="width:100%;" >
													<?php if(!empty($menues_dropdown)){ ?>
														<option value="0">Select Parent</option>													

													<?php	foreach ($menues_dropdown as $menu) {?>
														<option value="<?php echo $menu->menu_id?>"><?php echo $menu->menu_name?></option>
													<?php }}else{?>
													<option value="0">No Menues Yet</option>													
													<?php } ?>
												</select> 
											</div>
										</div>
									</div>
								</div>
								<div class="row">	
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Icon Class</label>
										</div>
									</div>
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<input type="text"  name="menu_icon_class" class="icon-class-input form-control col-lg-4 col-sm-6 col-xs-12" style="float:left" value="" />
											<button type="button" class="btn btn-primary picker-button col-lg-4 col-sm-5 col-xs-12">Pick an Icon</button>
											 <!-- <span class="demo-icon"></span>  -->
										</div>
									</div>
								</div>	
								<div id="iconPicker" class="modal fade">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title">Icon Picker</h4>
											</div>
											<div class="modal-body iconsroll">
												<div>
													<ul class="icon-picker-list">
														<li>
															<a data-class="{{item}} {{activeState}}" data-index="{{index}}">
																<span class="{{item}}"></span>
																<span class="name-class">{{item}}</span>
															</a>
														</li>
													</ul>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" id="change-icon" class="btn btn-success">
													<span class="fa fa-check-circle-o"></span>
													Use Selected Icon
												</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
											</div>
										</div>
									</div>
								</div>

								<div class="row">	
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Select Color</label>
										</div>
									</div>
									<div class="col-lg-2 col-sm-9 col-xs-12">
										<div class="form-group">
										<select name='menu_icon_color' id="colorselector">
										    <?php 
										    foreach ($colors as $key => $value) 
											    {
											    	
											    	echo '<option value="'.$key.'" data-color="#'.$value.'">$key</option>';	
											    	
											    }
										    ?>
											</select>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12">
										<input id="create_menu" type="submit" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
										<input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
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
<script src="<?php echo assets_url();?>js/lib/color-picker/color.js"> </script>
<script src="<?php echo assets_url();?>js/lib/accordion/accordion.js"></script>

 <script>
  $( function() {
  	 $('#colorselector').colorselector();
 
  } );
  $(document).ready(function()
 	{
		$('#create_menu').attr('disabled',true);

	  $("#create_menu").click(function(event){

		var menu_name = $('#menu_name').val();
		if(menu_name!='')
		{
			$.ajax({
				url: '<?php echo site_url();?>/system_settings/check_menu_exist',
				data : {menu_name: menu_name},
				type: 'POST',
				success: function(response){
					console.log(response);
					if(response==1)
					{
						$('#err_menu').html('Menu already exist!').show();
						$('#create_menu').attr('disabled',true);
						event.preventDefault();
						return false;
					}
					else 
					{
						$('#create_menu').removeAttr('disabled');
						// form.Submit();
						$('#err_menu').html('').hide();				
					}
				}
			});
		}
	});

	$("#menu_name").blur(function(event){

		var menu_name = $('#menu_name').val();
		if(menu_name!='')
		{
			$.ajax({
				url: '<?php echo site_url();?>/system_settings/check_menu_exist',
				data : {menu_name: menu_name},
				type: 'POST',
				success: function(response){
					console.log(response);
					if(response==1)
					{
						$('#err_menu').html('Menu already exist!').show();
						$('#create_menu').attr('disabled',true);
						event.preventDefault();
						return false;
					}
					else 
					{
						$('#create_menu').removeAttr('disabled');
						// form.Submit();
						$('#err_menu').html('').hide();				
					}
				}
			});
		}
	});
  });

  </script>
