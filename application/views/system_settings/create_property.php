
<div class="page-content">
	<div class="container-fluid p-xl-0">
		<div class="well">
			 <div class="row">
			 	<div class="col-sm-12">
					<?php if($this->session->flashdata('success')){?>
					<script type="text/javascript">
					var message_text='<?php echo $this->session->flashdata('success');?>';
						$.notify({
							title: "<strong>"+title+"</strong> ",
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
				<form data-toggle="validator" class="col-sm-12" id="task_form" action="" method="post"  role="form">
					<h1 class="well headline">Employee Property Manager</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Department Name<span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select class="form-control chosen-select" placeholder="Enter select Department Name" name="dept_id" id="dept_id" required>
												<option value="" disabled selected>Please select Department</option>
												<?php if(isset($departments)) { foreach ($departments as $key => $value) { ?>
													<option value="<?php echo $value['id']; ?>" <?php echo ($result->dept_id == $value['id']) ? 'selected' :''; ?>><?php echo $value['title']; ?></option>
												<?php } } else { ?>
													<option value="">No records found.</option>
												<?php } ?>
											</select>
											<span class="error_msg" id ="t_name_err"></span>
										</div>
									</div>
								</div>
							</div>
										
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Property Name <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Enter Property Name" type="text" name="prop_name" id="prop_name" required value="<?php if(isset($result->prop_name)){ echo $result->prop_name; } ?>">
											<span class="error_msg" id ="t_prop_err"></span>	
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Quantity <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control number" min="1" maxlength="12" placeholder="Enter Quantity" type="text" name="quantity" id="quantity" required value="<?php if(isset($result->quantity)){ echo $result->quantity; } ?>">
											<span class="error_msg" id ="qty_err"></span>	
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Purchase Price <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control number" min="1" maxlength="12" placeholder="Enter Purchase Price" type="text" name="purchase_price" id="purchase_price" required value="<?php if(isset($result->purchase_price)){ echo $result->purchase_price; } ?>">
											<span class="error_msg" id ="pp_err"></span>	
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Penalty <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control number" min="1" maxlength="12" placeholder="Enter Penalty" type="text" name="penalty" id="penalty" required value="<?php if(isset($result->penalty)){ echo $result->penalty; } ?>">
											<span class="error_msg" id ="plt_err"></span>	
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Status <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select class="form-control chosen-select" id="status" name="status" class="web" style="width: 100%">

												  <option value="1" <?php echo ($result->status == 1) ? 'selected' : ''; ?>>Available</option>
												  <option value="0" <?php echo ($result->status == 0) ? 'selected' : ''; ?>>Not Available</option>
											</select>
										</div>
									</div>
								</div>
							</div>
													
							<div class="row">
								<div class="col-lg-6">
									<input type="button" id="submit_prop" value="Save" class="btn btn-inline btn-success ladda-button"/>
									<input id="showmenu" type="button" value="Reset" class="btn btn-inline ladda-button reset"/>	
									<input type="hidden" name="hideID" id="hideID" value="<?php if(isset($result->prop_id)){ echo $result->prop_id; } ?>"">	
								</div>
							</div>
					</div>
				</form>
			 </div>
		</div>									
	</div>
</div>

<script>
	$(".chosen-select").chosen();
	$(document).ready(function() {
        $('#showmenu').click(function() {
            $('.menu').slideToggle("fast");
        });
    $("#submit_prop").click(function(){
    	var dept_id=$("#dept_id").val();
    	var prop_name=$("#prop_name").val();
    	var quantity=$("#quantity").val();
    	var purchase_price=$("#purchase_price").val();
    	var penalty=$("#penalty").val();
    	var status=$("#status").val();
    	var hideID=$("#hideID").val();

    	if(dept_id.trim()==""){
    		$("#t_name_err").text("Please Enter Department Name").show().delay(2000).fadeOut(800);
    	}else if(prop_name.trim()==""){
    		$("#t_prop_err").text("Please Enter Property Name").show().delay(2000).fadeOut(800);
    	}
    	else if(quantity.trim()=="" || quantity.trim() <= 0){
    		$("#qty_err").text("Please Enter Appropriate Quantity Name").show().delay(2000).fadeOut(800);
    	}
    	else if(purchase_price.trim()=="" || purchase_price.trim()<=0){
    		$("#pp_err").text("Please Enter Appropriate Purchase Price").show().delay(2000).fadeOut(800);
    	}
    	else if(penalty.trim()=="" || penalty.trim()<=0){
    		$("#plt_err").text("Please Enter Appropriate Penalty").show().delay(2000).fadeOut(800);
    	}
    	else{
    		$('#submit_prop').attr('disabled', true);
    		$.ajax({
    		data:{'dept_id':dept_id,'prop_name':prop_name,'status':status,'hideID':hideID,'quantity':quantity,'purchase_price':purchase_price,'penalty':penalty},
    		dataType:"json",
    		url:'<?php echo site_url(); ?>/system_settings/save_property',
    		type:'POST',
    		success:function(response){
    			$.notify({
					title: "<strong>Success</strong> ",
					message: "Property Added Successfully",
				},
				{
					type: "success",
					delay: 500,
					animate:{
					enter: "animated fadeInUp",
					exit: "animated fadeOutDown"
					}
				});
			},
			error:function(error){
				console.log(error.responseText);
			}
    		});
    		window.setTimeout(function () {
				window.location.href = '<?php echo site_url();?>/system_settings/employee_properties'
			}, 2000);
    	}

    	
    });
 
});
</script>	
