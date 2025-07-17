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
            <div class="well" style="margin-bottom:20px;">
				 <div class="row">
					<form data-toggle="validator" class="col-sm-12" id="profile_form" action=" " method="post">
						<h1 class="well headline">Assign Menu Operations</h1>
							<div class="col-sm-12 col-xs-12 profile_bg">
								<div class="row">
									<div class="col-lg-2">
										<div class="form-group">
											<label class="form-label">Role Name </label>
                                        </div>
                              </div>
                              <div class="col-lg-10">
											<div class="form-group">
												<div class="form-control-wrapper form-control-icon-right">
													<select class="chosen-select col-md-10 col-sm-12 col-xs-12 " name="candidate_role" id="candidate_role"  style="width: 100px" required="">
														<optgroup label="">
															<option value="">Select Role</option>
														
															<?php foreach ($roles as $role) {?>
																<option value="<?php echo $role->role_id;?>"><?php echo $role->role_name;?></option>
															<?php }?>												  												  
														</optgroup>
													</select>
												</div>
											</div>
										</div>
                            </div> 
									<div class="row">     
										<div class="col-lg-2">
											<div class="form-group">
											<label class="form-label"> Permission </label>
											</div>                                       
										</div>
										<div class="col-lg-10">
											<select class="form-control col-md-10 col-sm-12 col-xs-12 " name="menu_id" id="menus"  required="">
											</select>
											

										</div>
									</div>
								<br>
									<div class="row" id="select_all_opearations" style="display: none">
										<div class="col-lg-2">
										</div>
										<div class="col-lg-10">
											<input type='checkbox' id="select_all" onClick="check_uncheck_checkbox(this.checked);">Select All
										</div>
									</div>
									<div class="row" id="Operations">     
										
									</div>
									<div class="row">
										<div class="col-lg-12">
											<button class="btn btn-inline btn-success ladda-button" id="submit" data-style="expand-left" disabled><span class="ladda-label">Submit</span>
											<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
										</div>
									</div>
									
							    </div>
							</div>						
							
		
						</div>
					</form> 
				</div>
			</div>
		</div>
</div><!--.page-content-->

	<script>
		$(function(){
			//$(".chosen-select").chosen();
			$('#candidate_role').on('change', function() {
  				role_id=$(this).val();
  				  $.ajax({
			      type: 'POST',
			      url: '<?php echo site_url();?>/system_settings/get_role_permissions_list',
			      data: {'role_id':role_id},
			      dataType: "text",
			      success: function(resultData) { 
			      	  $("#menus").html(resultData);

  				 }
				});
  				
  				//$("#candidates").val([1, 2, 3]);			
  			});
  			$('#menus').on('change', function() {  	  		  	  		
  				role_id=$('#candidate_role').val();
  				menu_id=$(this).val();
  				 $.ajax({
			      type: 'POST',
			      url: '<?php echo site_url();?>/system_settings/get_role_menu_operations',
			      data: {'role_id':role_id,'menu_id':menu_id},
			      dataType: "text",
			      success: function(resultData) { 
			      		if(resultData!=0)
			      		{	
			      	  		$("#Operations").html(resultData);
			      	  		$('#select_all_opearations').css('display','block');
			      	  		$('#submit').removeAttr('disabled');

			      	  	}
			      	  	else
			      	  	{
			      	  		$("#Operations").html('please add menu permission first');
			      	  		$('#select_all').removeAttr('checked');
			      	  		$('#select_all_opearations').css('display','none');
			      	  		$('#submit').attr('disabled',true);
			      	  	}

  				 }
  				});
  			});
			  $(".chosen-select").chosen();
			$('#example').DataTable({
				responsive: true
			});
			$("#select_all").change(function(){  //"select all" change
			    var status = this.checked; // "select all" checked status
			    $('.menu_id').each(function(){ //iterate all listed checkbox items
			        this.checked = status; //change ".checkbox" checked status
			    });
			});

		});
	</script>