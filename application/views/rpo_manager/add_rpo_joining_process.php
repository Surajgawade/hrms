<div class="page-content">
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
	
<div class="container-fluid">
	<?php $this->load->view('rpo_manager/top_menu');?>
	<div class="well">
			<form action="" id="rpo_joining_form" name="rpo_joining_form" method="post" data-toggle="validator">
			<?php if(isset($rpo_can_details)){?>	
			<input type="hidden" name="rpoemppro_id" id="rpoemppro_id" value="<?php if(isset($rpo_can_details['rpoemppro_id'])){ echo $rpo_can_details['rpoemppro_id']; } ?>">
			<input type="hidden" name="intw_can_id" id="intw_can_id" value="<?php if(isset($rpo_can_details['intw_can_id'])){ echo $rpo_can_details['intw_can_id']; } ?>">
			<h1 class="well headline">HR Interview Manager</h1>
			<div class="col-sm-12 col-xs-12 profile_bg">
				<div class="row">
					<div class="col-lg-2 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="form-label">Interview Status:</label>
						</div>
					</div>
					<div class="col-lg-4 col-sm-9 col-xs-12">
						<div class="form-group">
							<input type="text" id="interview_status" name="interview_status" class="form-control" placeholder="" value="<?php echo (isset($rpo_can_details['interview_status']))? $rpo_can_details['interview_status'] :'' ?>" readonly>
						</div>
					</div>
					<div class="col-lg-2 col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="form-label">Joining Date : </label>
								</div>
					</div>						
					<div class="col-lg-4 col-sm-9 col-xs-12">
						<div class="form-group">
								<input type="text" id="joining_date" name="joining_date" class="form-control" placeholder="" value="<?php echo (isset($rpo_can_details['joining_date']))? format_date($rpo_can_details['joining_date']) :'' ?>" readonly>
						</div>
					</div>
				</div>	
		

				<div class="row">
					<div class="col-lg-2 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="form-label">Client Name:</label>
						</div>
					</div>
					<div class="col-lg-4 col-sm-9 col-xs-12">
						<div class="form-group">
							<input type="text" name="" id="" value="<?php echo $rpo_can_details['client_name'];?>" readonly>
							<!-- <select class="form-control col-md-10 col-sm-12 col-xs-12" id="client_name" style="width:500px" name="client_name" required data-errror="Please Select Client" ></select> -->
						</div>
					</div>
					<div class="col-lg-2 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="form-label">Project Name:</label>
						</div>
					</div>
					<div class="col-lg-4 col-sm-9 col-xs-12">
						<div class="form-group">
							<input type="text" name="" id="" value="<?php echo $rpo_can_details['proj_title'];?>" readonly>
							<!-- <select class="form-control col-md-10 col-sm-12 col-xs-12" id="project_name" style="width:500px" name="project_name" required data-errror="Please Select Project" ></select> -->
						</div>
					</div>			
				</div>

				<div class="row">
					<div class="col-lg-2 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="form-label">Contract From:</label>
						</div>
					</div>
					<div class="col-lg-4 col-sm-9 col-xs-12">
						<div class="form-group">
							<input type="text" name="" id="" value="<?php echo format_date($rpo_can_details['proj_start_date']);?>" readonly> 
							<!-- <select class="form-control col-md-10 col-sm-12 col-xs-12" id="client_name" style="width:500px" name="client_name" required data-errror="Please Select Client" ></select> -->
						</div>
					</div>
					<div class="col-lg-2 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="form-label">Contract To:</label>
						</div>
					</div>
					<div class="col-lg-4 col-sm-9 col-xs-12">
						<div class="form-group">
							<input type="readonly" name="" id="" value="<?php echo format_date($rpo_can_details['proj_end_date']);?>">
							<!-- <select class="form-control col-md-10 col-sm-12 col-xs-12" id="project_name" style="width:500px" name="project_name" required data-errror="Please Select Project" ></select> -->
						</div>
					</div>			
				</div>
		
			</div><br>
			<div class="row">
				<div class="col-lg-6">
					<button class="btn btn-inline btn-success ladda-button" data-style="expand-left" name="submit_joining" id="submit_joining"><span class="ladda-label">Submit</span>
					<span class="ladda-spinner"></span><span class="ladda-spinner"></span>
					<div class="ladda-progress" style="width: 106px;"></div></button>
					<input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
				</div>							
			</div>
			<?php 
			} ?>
		</form>
	</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function()
	{
		$('#joining_date').datepicker({
			format: 'mm/dd/yyyy'
		});
<?php /*
		url='<?php echo site_url();?>'+'/rpo_manager/get_rpoclient_list';
		placeholder='--- Select Client ---';
		select2(client_name,url,placeholder);

		$("#client_name").change(function () { 
			//jQuery('#ajax_loader').show();
			var client_id = $('#client_name option:selected').val();
			console.log(client_id);
			var url = '<?php echo site_url()?>' + '/rpo_manager/get_project_by_client';
			// placeholder = '--- Select Policy ---';
			// select2(section,url,placeholder);
			$.ajax({type: "POST",data:{client_id:client_id},url: url,success: function(response){
				console.log(response);
				// alert(data);
				var proj_id = '<?php $joining_details['project_id'];?>';
				$("#project_name").html(response);
				//jQuery('#ajax_loader').hide();	   
			}		
			});
		});
*/?>

	});
</script>