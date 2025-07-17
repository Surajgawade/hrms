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
	<?php
		$schedule_date ='';
		if(isset($candidate_details['schedule_date']) && !empty($candidate_details['schedule_date']))
		{
	 		if(!empty(strtotime($candidate_details['schedule_date'])))
	 		{
	 			$schedule_date = db_to_date($candidate_details['schedule_date']);
	 		}
		}
	?>
	<?php $title="interview_details"; $this->load->view('rpo_manager/top_menu');?>
	<div class="well">
			<form data-toggle="validator" action="" id="interview_form" name="interview_form" method="post" >
				<?php //if(isset($candidate_details)){?>	
				<input type="hidden" name="intw_can_id" id="intw_can_id" value="<?php echo $this->uri->segment(3);?>">
				
				<h1 class="well headline">Interview Manager 
				<?php if($show_addnew_btn==1){?>
					<!-- <button class="btn btn-inline check-all" data-style="expand-right"><span><i class="fa fa-plus"></i> Add New </span></button> -->
				<?php } else {?>
				<input type="hidden" name="inw_mid" id="inw_mid" value="<?php if(isset($candidate_details['inw_mid'])){ echo $candidate_details['inw_mid']; } ?>">
				<?php } ?>
				</h1>
				<div class="col-sm-12 col-xs-12 profile_bg">
				   <div class="row">
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Interview Schedule On: <span>*</span></label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<div class="input-group input-append date" id="datePicker" data-date-start-date="0d">
									<input type="text" class="form-control col-md-12 number" required data-error="Please Select Interview Schedule Date"  name="schedule_date" id="schedule_date" placeholder="dd/mm/yyyy" value="<?php echo isset($candidate_details['schedule_date']) ? format_date($candidate_details['schedule_date']): '';?>">
									<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
								</div>
										<div class="help-block with-errors error_msg"></div>
							</div>
						</div>
						<div class="col-lg-6 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<textarea id="schedule_comment" name="schedule_comment" class="form-control" placeholder="comment here"><?php if(isset($candidate_details['schedule_comment'])){ echo $candidate_details['schedule_comment']; } ?></textarea>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-2 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="form-label">Client Name: <span>*</span></label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">	
								<select class="form-control chosen-select col-md-12 col-sm-12 col-xs-12" name="client_name" id="client_name" required>
									<option value="" selected="" disabled>Select Client Name</option>
									<?php if(!empty($clients)){foreach ($clients as $client) {?>										
									<option value="<?php echo $client->client_id;?>" <?php if((isset($candidate_details['client_id']) && $client->client_id == $candidate_details['client_id'])) echo "selected";?>><?php echo $client->client_name?></option>
											<?php } }?>
								</select>	
								<div class="help-block with-errors error_msg" id="err_client"></div>
							</div>
						</div>
						<div class="col-lg-2 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="form-label">Project Name: <span>*</span></label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<select class="form-control chosen-select col-md-12 col-sm-12 col-xs-12" id="project_name" name="project_name">
									<option value="" selected="" disabled>Select Project Name</option>
									<?php if(!empty($projects)){foreach ($projects as $project) {?>										
									<option value="<?php echo $project->proj_id;?>" <?php if((isset($candidate_details['project_id']) && $project->proj_id == $candidate_details['project_id'])) echo "selected";?>><?php echo $project->proj_title?></option>
									<?php } }?>
								</select>
								<div class="help-block with-errors error_msg" id="err_project"></div>
							</div>
						</div>			
					</div>
					<div class="row">
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label"><strong>Round 1 Details:</strong></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Round 1:</label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<input type="text" id="round1" name="round1" class="form-control" placeholder="Enter round name" value="<?php if(isset($candidate_details['round1'])){ echo $candidate_details['round1']; } ?>" > 
							</div>
						</div>
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Date:</label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<div class="input-group input-append date" id="datePicker1" data-date-start-date="0d">
									<input type="text" class="form-control col-md-12 number" name="round1_date" id="round1_date" placeholder="dd/mm/yyyy" value="<?php echo isset($candidate_details['round1_date']) ? format_date($candidate_details['round1_date']): '';?>">
									<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
								</div>
							</div>
						</div>						
				    </div>

				    <div class="row" id="round1_div">
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Cleared:</label>	
							</div>
						</div>
						<div class="col-lg-2 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<label class="form-label"><input type="radio" name="round1_status" value="yes" <?php if(isset($candidate_details['round1_status']) && $candidate_details['round1_status']=='yes'){ echo "checked"; }?> >Yes</label>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<label class="form-label"><input type="radio" name="round1_status" value="no" <?php if(isset($candidate_details['round1_status']) && $candidate_details['round1_status']=='no'){ echo "checked"; }?>>No</label>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Comment:</label>	
							</div>
						</div>
						<div class="col-lg-4 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<textarea id="round1_comment" name="round1_comment" class="form-control" placeholder="Enter Round1 comment here"><?php if(isset($candidate_details['round1_comment'])){ echo $candidate_details['round1_comment']; } ?></textarea>
								</div>
							</div>
						</div>
				    </div>
				   <div id="round2_div">
					   <div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label"><strong>Round 2 Details:</strong></label>
								</div>
							</div>
						</div>
					
						<div class="row" >
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Round 2:</label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<input type="text" id="round2" name="round2" class="form-control" placeholder="Enter round name" value="<?php if(isset($candidate_details['round2'])){ echo $candidate_details['round2']; } ?>"> 
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Date:</label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="input-group input-append date" id="datePicker2" data-date-start-date="0d">
										<input type="text" class="form-control col-md-12 number" name="round2_date" id="round2_date" placeholder="dd/mm/yyyy" value="<?php echo isset($candidate_details['round2_date']) ? format_date($candidate_details['round2_date']): '';?>">
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Cleared:</label>	
								</div>
							</div>
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="round2_status" value="yes" <?php if(isset($candidate_details['round2_status']) && $candidate_details['round2_status']=='yes'){ echo "checked"; }?>>Yes</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="round2_status" value="no" <?php if(isset($candidate_details['round2_status']) && $candidate_details['round2_status']=='no'){ echo "checked"; }?>>No</label>
									</div>
								</div>
							</div>

							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Comment:</label>	
								</div>
							</div>
							<div class="col-lg-4 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea id="round2_comment" name="round2_comment" class="form-control" placeholder="Enter Round2 comment here"><?php if(isset($candidate_details['round2_comment'])){ echo $candidate_details['round2_comment']; } ?></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="round3_div">
					   <div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label"><strong>Round 3 Details:</strong></label>
								</div>
							</div>
						</div>
						<div class="row" >
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Round 3:</label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<input type="text" id="round3" name="round3" class="form-control" placeholder="Enter round name" value="<?php if(isset($candidate_details['round3'])){ echo $candidate_details['round3']; } ?>"> 
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Date:</label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="input-group input-append date" id="datePicker3" data-date-start-date="0d">
										<input type="text" class="form-control col-md-12 number" name="round3_date" id="round3_date" placeholder="dd/mm/yyyy" value="<?php echo isset($candidate_details['round3_date']) ? format_date($candidate_details['round3_date']): '';?>">
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
							</div>							
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Cleared:</label>	
								</div>
							</div>
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="round3_status" value="yes" <?php if(isset($candidate_details['round3_status']) && $candidate_details['round3_status']=='yes'){ echo "checked"; }?>>Yes</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="round3_status" value="no" <?php if(isset($candidate_details['round3_status']) && $candidate_details['round3_status']=='no'){ echo "checked"; }?>>No</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Comment:</label>	
								</div>
							</div>
							<div class="col-lg-4 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea id="round3_comment" name="round3_comment" class="form-control" placeholder="Enter Round3 comment here"><?php if(isset($candidate_details['round3_comment'])){ echo $candidate_details['round3_comment']; } ?></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="round4_div">
					   <div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label"><strong>Round 4 Details:</strong></label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Round 4:</label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<input type="text" id="round4" name="round4" class="form-control" placeholder="Enter round name" value="<?php if(isset($candidate_details['round4'])){ echo $candidate_details['round4']; } ?>"> 
								</div>
							</div>

							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Date:</label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="input-group input-append date" id="datePicker4" data-date-start-date="0d">
										<input type="text" class="form-control col-md-12 number" name="round4_date" id="round4_date" placeholder="dd/mm/yyyy" value="<?php echo isset($candidate_details['round4_date']) ? format_date($candidate_details['round4_date']): '';?>">
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Cleared:</label>	
							</div>
						</div>
						<div class="col-lg-2 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<label class="form-label"><input type="radio" name="round4_status" value="yes" <?php if(isset($candidate_details['round4_status']) && $candidate_details['round4_status']=='yes'){ echo "checked"; }?>>Yes</label>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<label class="form-label"><input type="radio" name="round4_status" value="no" <?php if(isset($candidate_details['round4_status']) && $candidate_details['round4_status']=='no'){ echo "checked"; }?> >No</label>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Comment:</label>	
								</div>
							</div>
						<div class="col-lg-4 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<textarea id="round4_comment" name="round4_comment" class="form-control" placeholder="Enter Round4 comment here"><?php if(isset($candidate_details['round4_comment'])){ echo $candidate_details['round4_comment']; } ?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
					<div id="round5_div">
					   <div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label"><strong>Round 5 Details:</strong></label>
								</div>
							</div>
						</div>
						<div class="row" >
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Round 5:</label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<input type="text" id="round1" name="round5" class="form-control" placeholder="Enter round name"> 
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Date:</label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="input-group input-append date" id="datePicker5" data-date-start-date="0d">
										<input type="text" class="form-control col-md-12 number" name="round5_date" id="round5_date" placeholder="dd/mm/yyyy" value="<?php echo isset($candidate_details['round5_date']) ? format_date($candidate_details['round5_date']): '';?>">
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Cleared:</label>	
								</div>
							</div>
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="round5_status" value="yes" <?php if(isset($candidate_details['round5_status']) && $candidate_details['round5_status']=='yes'){ echo "checked"; }?>>Yes</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="round5_status" value="no" <?php if(isset($candidate_details['round5_status']) && $candidate_details['round5_status']=='no'){ echo "checked"; }?>>No</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Comment:</label>	
								</div>
							</div>
							<div class="col-lg-4 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea id="round5_comment" name="round5_comment" class="form-control" placeholder="Enter Round5 comment here"><?php if(isset($candidate_details['round5_comment'])){ echo $candidate_details['round5_comment']; } ?></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="form-label">Status: <span>*</span></label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">	
								<select class="form-control chosen-select col-md-12 col-sm-12 col-xs-12" name="interview_status" id="interview_status" required>
									<!-- <option value="" selected="" disabled>Select Status</option> -->
									<option value="" selected="" disabled>Select interview status</option>
							    	<option value="selected" <?php if($candidate_details['interview_status']=="selected") echo "selected"; ?>>Selected</option>
							    	<option value="rejected" <?php if($candidate_details['interview_status']=="rejected") echo "selected"; ?>>Rejected</option>
							    	<option value="onhold" <?php if($candidate_details['interview_status']=="onhold") echo "selected";?>>On Hold</option>
								</select>
								<div class="help-block with-errors error_msg" id="err_int_status"></div>
							</div>
						</div>

					</div>
				</div><br>
				<div class="row">
					<div class="col-lg-6">
						<button class="btn btn-inline btn-success ladda-button" data-style="expand-left" name="submit_interview" id="submit_interview"><span class="ladda-label">Submit</span>
						<span class="ladda-spinner"></span><span class="ladda-spinner"></span>
						<div class="ladda-progress" style="width: 106px;"></div></button>
						<input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
					</div>							
				</div>
				<?php 
				//} ?>
			</form>
	</div>
</div>
</div>
<script type="text/javascript">	

	$(document).ready(function () {
		$("#client_name").chosen();
		$('#datePicker,#datePicker1,#datePicker2,#datePicker3,#datePicker4,#datePicker5').datepicker({
			format: 'dd/mm/yyyy',
			autoclose : true,
		   maxDate: new Date()
		});

		$('#datePicker').on('changeDate', function(e) {
			$('#datePicker1').datepicker('setStartDate', $('#schedule_date').val());
		});
		$('#datePicker1').on('changeDate', function(e) {
			$('#datePicker').datepicker('setEndDate', $('#round1_date').val());
		});

		$('#datePicker1').on('changeDate', function(e) {
			$('#datePicker2').datepicker('setStartDate', $('#round1_date').val());
		});
		$('#datePicker1').on('changeDate', function(e) {
			$('#datePicker2').datepicker('setEndDate', $('#round2_date').val());
		});

		$('#datePicker2').on('changeDate', function(e) {
			$('#datePicker3').datepicker('setStartDate', $('#round2_date').val());
		});
		$('#datePicker2').on('changeDate', function(e) {
			$('#datePicker3').datepicker('setEndDate', $('#round3_date').val());
		});

		$('#datePicker3').on('changeDate', function(e) {
			$('#datePicker4').datepicker('setStartDate', $('#round3_date').val());
		});
		$('#datePicker3').on('changeDate', function(e) {
			$('#datePicker4').datepicker('setEndDate', $('#round4_date').val());
		});

		$('#datePicker4').on('changeDate', function(e) {
			$('#datePicker5').datepicker('setStartDate', $('#round4_date').val());
		});
		$('#datePicker4').on('changeDate', function(e) {
			$('#datePicker5').datepicker('setEndDate', $('#round5_date').val());
		});

		// url='<?php //echo site_url();?>'+'/rpo_interview/get_rpoclient_list';
		// placeholder='--- Select Client ---';
		// select2(client_name,url,placeholder);

		$("#client_name").change(function () { 
			var client_id = $('#client_name option:selected').val();
			var url = '<?php echo site_url()?>' + '/rpo_interview/get_project_by_client';
			$.ajax({type: "POST",data:{client_id:client_id},url: url,success: function(response){
				
				$("#project_name").html(response);
				$("#project_name").chosen();
			}		
			});
		});

		$('input[type=radio][name=round1_status]').change(function()
		{
			if(this.value=='no'){
				$("#round2_div,#round3_div,#round4_div,#round5_div").hide();
				$("#interview_status").val('rejected');
			}
			else
			{
				$("#round2_div,#round3_div,#round4_div,#round5_div").show();
				$("#interview_status").val('');
			}
		});

		$('input[type=radio][name=round2_status]').change(function()
		{
			if(this.value=='no'){
				$("#round3_div,#round4_div,#round5_div").hide();
				$("#interview_status").val('rejected');
			}
			else
			{
				$("#round3_div,#round4_div,#round5_div").show();
				$("#interview_status").val('');
			}
		});
		$('input[type=radio][name=round3_status]').change(function()
		{
			if(this.value=='no'){
				$("#round4_div,#round5_div").hide();
				$("#interview_status").val('rejected');
			}
			else
			{
				$("#round4_div,#round5_div").show();
				$("#interview_status").val('');
			}
		});
		$('input[type=radio][name=round4_status]').change(function()
		{
			if(this.value=='no'){
				$("#round5_div").hide();
				$("#interview_status").val('rejected');
			}
			else
			{
				$("#round5_div").show();
				$("#interview_status").val('');
			}
		});

		$('input[type=radio][name=round5_status]').change(function()
		{
			if(this.value=='no'){
				$("#interview_status").val('rejected');
			}
			else
			{
				$("#interview_status").val('');
			}
		});

		$("#select_div").hide();

		$("#submit_interview").click(function(){
			var client_id = $('#client_name option:selected').val();
			var project_id = $('#project_name option:selected').val();
			var int_status = $('#interview_status option:selected').val();
			if(client_id=='')
			{
				$('#err_client').html('Please Select Client Name').show().delay(2000).fadeOut(1000);
			}
			if(project_id=='')
			{
				$('#err_project').html('Please Select Project Name').show().delay(2000).fadeOut(1000);
			}
			if(int_status='')
			{
				$('#err_int_status').html('Please Select Status').show().delay(2000).fadeOut(1000);
			}

			window.location.redirect('<?php echo site_url(); ?>/interview/add_edit_hr/'+$intw_can_id);
		});
	});

</script>