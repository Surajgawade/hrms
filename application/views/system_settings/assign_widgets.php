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
		<h1 class="well headline">Assign Widgets---</h1>
			<div class="col-sm-12 col-xs-12 profile_bg">
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label class="form-label">Role Name</label>
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
							<label class="form-label"> Widgets</label>
							
						
							</div>                                       
						
						</div>
						<div style="display:none" class="col-lg-2" id='select_all_permission' >
							<input type='checkbox' id="select_all" onClick="check_uncheck_checkbox(this.checked);">Select All<br>  
						</div>  	
						<div class="col-lg-7" id="permissions">
							  
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<button class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label">Submit</span>
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
	$('.menu_id').attr('checked', false);
	role_id=$(this).val();
	  $.ajax({
	type: 'POST',
	url: '<?php echo site_url();?>/system_settings/get_widgets',
	data: {'role_id':role_id},
	dataType: "text",
	success: function(resultData) { 
		$('#select_all_permission').css('display','block');
		$('#permissions').html(resultData);
	 }
	});

	//$("#candidates").val([1, 2, 3]);			
	});
	$(".chosen-select").chosen();
	$('#example').DataTable({
	responsive: true
	});
	$("#select_all").change(function(){  //"select all" change
	var status = this.checked; // "select all" checked status
	$('.widget_id').each(function(){ //iterate all listed checkbox items
	this.checked = status; //change ".checkbox" checked status
	});
	});

	});
	</script>
