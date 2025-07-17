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
									<label class="form-label">Joining Date : <span>*</span></label>
								</div>
					</div>						
					<div class="col-lg-4 col-sm-9 col-xs-12">
						<div class="form-group">
							<div class="input-group input-append date" id="datePicker3" data-date-start-date="0d">
								<input type="text" id="joining_date" name="joining_date" class="form-control" placeholder="" value="<?php echo (isset($rpo_can_details['joining_date']))? format_date($rpo_can_details['joining_date']) :'' ?>" required data-error="Please Enter Joining Date">
								<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
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
							<input type="hidden" name="client_id" value="<?php echo !empty($rpo_can_details['client_id']) ? $rpo_can_details['client_id'] : '';?>">
							<input type="text" class="form-control"  name="" id="" value="<?php echo !empty($rpo_can_details['client_name']) ? $rpo_can_details['client_name'] : '';?>" readonly>
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
							<input type="hidden" name="project_id" value="<?php echo !empty($rpo_can_details['proj_id']) ? $rpo_can_details['proj_id'] : '';?>">
							<input type="text" class="form-control" name="" id="" value="<?php echo !empty($rpo_can_details['proj_title']) ? $rpo_can_details['proj_title'] : '';?>" readonly>
							<!-- <select class="form-control col-md-10 col-sm-12 col-xs-12" id="project_name" style="width:500px" name="project_name" required data-errror="Please Select Project" ></select> -->
						</div>
					</div>										
				</div>

				<div class="row">
					<div class="col-lg-2 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="form-label">Designation :</label>
						</div>
					</div>
					<div class="col-lg-4 col-sm-9 col-xs-12">
						<div class="form-group">
							<input type="text" class="form-control"  name="" id="" value="<?php echo !empty($rpo_can_details['designation']) ? $rpo_can_details['designation'] : '';?>" readonly>
							<!-- <select class="form-control col-md-10 col-sm-12 col-xs-12" id="client_name" style="width:500px" name="client_name" required data-errror="Please Select Client" ></select> -->
						</div>
					</div>
					<div class="col-lg-2 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="form-label">Project Type:</label>
						</div>
					</div>
					<div class="col-lg-4 col-sm-9 col-xs-12">
						<div class="form-group">
							<input type="text" class="form-control" name="" id="" value="<?php echo !empty($rpo_can_details['proj_type']) ? $rpo_can_details['proj_type'] : '';?>" readonly>
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
							<input type="text" class="form-control" name="proj_start_date" id="proj_start_date" value="<?php echo format_date($rpo_can_details['proj_start_date']);?>" readonly>
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
							<input type="text" class="form-control" name="proj_end_date" id="proj_end_date" value="<?php echo format_date($rpo_can_details['proj_end_date']);?>" readonly>
							<!-- <select class="form-control col-md-10 col-sm-12 col-xs-12" id="project_name" style="width:500px" name="project_name" required data-errror="Please Select Project" ></select> -->
						</div>
					</div>			
				</div>

				<div class="row" id="joined_div">
			 		<div class="col-lg-2 col-sm-3 col-xs-12">
						<div class="form-group">
							<label class="form-label">Joined:</label>
						</div>
					</div>
				
					<div class="col-lg-2 col-sm-4 col-xs-12">
						<div class="form-group">
							<div class="form-control-wrapper form-control-icon-right">
								<label class="form-label"><input type="radio" name="is_joined" value="1" <?php if(isset($rpo_can_details['is_joined']) && ($rpo_can_details['is_joined']	==1)) echo "checked";?>>Yes</label>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-sm-4 col-xs-12">
						<div class="form-group">
							<div class="form-control-wrapper form-control-icon-right">
								<label class="form-label"><input type="radio" name="is_joined" value="0" <?php if(isset($rpo_can_details['is_joined']) && ($rpo_can_details['is_joined']==0)) echo "checked";?>>No</label>
							</div>
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
					<?php if(!$already_added){?>
					<button type="button" class="btn btn-inline btn-success ladda-button" data-style="expand-left" name="submit_rpo" id="submit_rpo" onclick="add_in_rpo('<?php echo $rpo_can_details['intw_can_id'];?>')"><span class="ladda-label">Add To RPO Employee List</span>
						<?php }?>
				</div>							
			</div>
			<?php 
			} ?>
		</form>
	</div>
</div>
</div>
<script type="text/javascript">

	function add_in_rpo(repo_can_id)
	{
		swal({
			title: 'Are you sure?',
			text: "You want to add in RPO Employee List?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, add it!'
		}).then(function () {
			$.ajax({
				url: '<?php echo site_url();?>/rpo_manager/add_in_rpo_employee_list',
				data : {repo_can_id: repo_can_id},
				type: 'POST',
				success: function(response){
					var type='' ;
					var message='' ;
					var title='' ;
					if(response==1)
					{
						type ='success';
						message ='Candidate added in RPO Employee List Successfully!';
						title ='Success';
					}
					else
					{
						type ='warning';
						message ="Access Denied";
						title ='Warning'; 

					}
					$.notify({
							title: title,
							message: message,
						},
						{
							type: type,
							delay: 800,
							animate:{
							enter: "animated fadeInUp",
							exit: "animated fadeOutDown"
							}
						});
					// window.setTimeout(function(){location.reload()},2000);
				}

			});
			// return true;			
		});
	}
	$(document).ready(function()
	{
		var today = get_todays_date();		
		$('#joining_date').datepicker({
			format: 'dd/mm/yyyy'
		});
		// $("#submit_rpo").hide();
		var joining_date = $('#joining_date').val();
		if(joining_date > today)
		{
			$('#joined_div').hide();
		}
		else
		{
			$('#joined_div').show();
		}
		$('#joining_date').on('changeDate', function(e) {
			if($('#joining_date').val()<today){
				$('#joined_div').show();
			}
			else
			{
				$('#joined_div').hide();
			}
		});


		var is_joined = $('input[type=radio][name=is_joined]:checked').val();
		console.log(is_joined);
		if(is_joined==1)
		{
			$("#submit_rpo").show();
		}
		else
		{
			$("#submit_rpo").hide();
		}
		$('input[type=radio][name=is_joined]').change(function()
		{
			if(this.value==1){
				$("#submit_rpo").show();
			}
			else
			{
				$("#submit_rpo").hide();
			}
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