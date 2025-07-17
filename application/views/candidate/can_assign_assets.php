<div class="page-content">
	<div class="container-fluid">
	<div class="well">
		<?php $this->load->view('candidate/can_menu');?>
		 <div class="row">
				<form class="col-sm-12" id="myform"  method="post">
					<h1 class="well headline">Assign Assets</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Employee Name</label>
								</div>
							</div>
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label name_lable"><?php echo $can_details->can_name;?></label>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
								<label class="form-label">Asset List<span> * </span></label>
								</div>
							</div>

							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select required="" id="asset_id" name="asset_id" class="chosen-select col-sm-12">
											<?php foreach ($assets_list as $asset) {?>											
											<option value="<?php echo $asset['prop_id']; ?>"><?php echo $asset['prop_name']?></option>
											<?php } ?>
										</select>
											<span class="error_msg" id ="asset_err"></span>
									</div>
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
										<input class="form-control number" placeholder="Quantity" type="text" name="quantity" id="quantity" required>
											<span class="error_msg" id ="quantity_err"></span>
									</div>
								</div>
							</div>
						</div>

					
						<div class="row">
							<div class="col-lg-6">
							<input id="assign_asset" type="button" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
							<input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
							</div>
						</div>
					</div>
				</form>  
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function()
	{
		$(".chosen-select").chosen();
    	$('#assign_asset').click(function (e) {	
			e.preventDefault();
			var can_id = '<?php echo $this->uri->segment(3);?>';
			var asset_id= $('#asset_id').val();
			var quantity= $('#quantity').val();
			if($('#quantity').val()=='' || $('#quantity').val()<=0)
			{
			$('#amt_err').text(" Please Enter Valid Quantity").show().delay(2000).fadeOut(800);
				event.preventDefault();
			}
			else
			{
				$('#assign_asset').attr('disabled',true);
				$.ajax({
					url: '<?php echo site_url();?>/candidate/assign_assets',
					data : {can_id: can_id, asset_id:asset_id, quantity: quantity},
					type: 'POST',
					success: function(response){
		             $.notify({
									title: "<strong>Success:</strong> ",
									message:"Asset Assigned Successfully!",
									
								},{
								type: "success",
								delay: 800,
									animate:{
										enter: "animated fadeInUp",
										exit: "animated fadeOutDown"
									} 
							});	
							setTimeout(function () {
							window.location.href = '<?php echo site_url();?>/candidate/assets/'+can_id;
	    				}, 2000);
			   		}
				});
			}
		});
	});
</script>
	