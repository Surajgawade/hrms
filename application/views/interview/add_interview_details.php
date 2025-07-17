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
	<?php $title="interview_details"; $this->load->view('interview/top_menu');?>
	<div class="well">
			<form action="" id="interview_form" name="interview_form" method="post" data-toggle="validator">
				<?php if(isset($candidate_details)){?>	
				<input type="hidden" name="intw_can_id" id="intw_can_id" value="<?php if(isset($candidate_details['intw_can_id'])){ echo $candidate_details['intw_can_id']; } ?>">
			<?php if($candidate_details['int_task_id']>0){ ?><input type='hidden' name='int_task_id' id='int_task_id' value="<?php echo $candidate_details['int_task_id'];?>"><?php  } ?>

				<h1 class="well headline">Interview Manager</h1>
				<div class="col-sm-12 col-xs-12 profile_bg">
					<div class="row">
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Interview Schedule On:</label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<input type="text" id="schedule_date" name="schedule_date" value="<?php echo $schedule_date; ?>" class="form-control" readonly="">
							</div>
						</div>
						<div class="col-lg-6 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<textarea id="interview_comment" class="form-control" placeholder="comment here"   readonly><?php if(isset($candidate_details['schedule_comment'])){ echo $candidate_details['schedule_comment']; } ?></textarea>
								</div>
							</div>
						</div>
				    </div>
					<div class="row" id="round1_div">
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Round 1:</label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<input type="text" id="round1" name="round1" class="form-control" pattern="^[A-Za-z1-9]+$" placeholder="Enter round name" value="<?php if(isset($candidate_details['round1'])){ echo $candidate_details['round1']; } ?>" data-error="Please Enter alphabets and numbers only"> 
								<div class="help-block with-errors error_msg"></div>
							</div>
						</div>
						<div class="col-lg-1 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Cleared:</label>	
							</div>
						</div>
						<div class="col-lg-1 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<label class="form-label"><input type="radio" name="round1_status" value="yes" <?php if(isset($candidate_details['round1_status']) && $candidate_details['round1_status']=='yes'){ echo "checked"; }?> >Yes</label>
								</div>
							</div>
						</div>
						<div class="col-lg-1 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<label class="form-label"><input type="radio" name="round1_status" value="no" <?php if(isset($candidate_details['round1_status']) && $candidate_details['round1_status']=='no'){ echo "checked"; }?>>No</label>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<textarea id="round1_comment" name="round1_comment" class="form-control validate" placeholder="Enter Round1 comment here" pattern="^[A-Za-z1-9]+$" data-error="Please Enter alphabets and numbers only"><?php if(isset($candidate_details['round1_comment'])){ echo $candidate_details['round1_comment']; } ?></textarea>
									<div class="help-block with-errors error_msg"></div>
								</div>
							</div>
						</div>
				    </div>
				
					<div class="row" id="round2_div">
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Round 2:</label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<input type="text" id="round2" name="round2" class="form-control" pattern="^[A-Za-z1-9]+$" placeholder="Enter round name" value="<?php if(isset($candidate_details['round2'])){ echo $candidate_details['round2']; } ?>" data-error="Please Enter alphabets and numbers only">
								<div class="help-block with-errors error_msg"></div> 
							</div>
						</div>
						<div class="col-lg-1 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Cleared:</label>	
							</div>
						</div>
						<div class="col-lg-1 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<label class="form-label"><input type="radio" name="round2_status" value="yes" <?php if(isset($candidate_details['round2_status']) && $candidate_details['round2_status']=='yes'){ echo "checked"; }?>>Yes</label>
								</div>
							</div>
						</div>
						<div class="col-lg-1 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<label class="form-label"><input type="radio" name="round2_status" value="no" <?php if(isset($candidate_details['round2_status']) && $candidate_details['round2_status']=='no'){ echo "checked"; }?>>No</label>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<textarea id="round2_comment" name="round2_comment" class="form-control" placeholder="Enter Round2 comment here" pattern="^[A-Za-z1-9]+$" data-error="Please Enter alphabets and numbers only"><?php if(isset($candidate_details['round2_comment'])){ echo $candidate_details['round2_comment']; } ?></textarea><div class="help-block with-errors error_msg"></div>
								</div>
							</div>
						</div>
					</div>

					<div class="row" id="round3_div">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Round 3:</label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<input type="text" id="round3" name="round3" class="form-control" pattern="^[A-Za-z1-9]+$" placeholder="Enter round name" value="<?php if(isset($candidate_details['round3'])){ echo $candidate_details['round3']; } ?>" data-error="Please Enter alphabets and numbers only"> <div class="help-block with-errors error_msg"></div>
								</div>
							</div>
							<div class="col-lg-1 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Cleared:</label>	
								</div>
							</div>
							<div class="col-lg-1 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="round3_status" value="yes" <?php if(isset($candidate_details['round3_status']) && $candidate_details['round3_status']=='yes'){ echo "checked"; }?>>Yes</label>
									</div>
								</div>
							</div>
							<div class="col-lg-1 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="round3_status" value="no" <?php if(isset($candidate_details['round3_status']) && $candidate_details['round3_status']=='no'){ echo "checked"; }?>>No</label>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea id="round3_comment" name="round3_comment" class="form-control" placeholder="Enter Round3 comment here" pattern="^[A-Za-z1-9]+$" data-error="Please Enter alphabets and numbers only"><?php if(isset($candidate_details['round3_comment'])){ echo $candidate_details['round3_comment']; } ?></textarea>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
					</div>

					<div class="row" id="round4_div">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Round 4:</label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<input type="text" id="round4" name="round4" class="form-control" pattern="^[A-Za-z1-9]+$" placeholder="Enter round name" value="<?php if(isset($candidate_details['round4'])){ echo $candidate_details['round4']; } ?>" data-error="Please Enter alphabets and numbers only"> <div class="help-block with-errors error_msg"></div>
								</div>
							</div>
							<div class="col-lg-1 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Cleared:</label>	
								</div>
							</div>
							<div class="col-lg-1 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="round4_status" value="yes" <?php if(isset($candidate_details['round4_status']) && $candidate_details['round4_status']=='yes'){ echo "checked"; }?>>Yes</label>
									</div>
								</div>
							</div>
							<div class="col-lg-1 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="round4_status" value="no" <?php if(isset($candidate_details['round4_status']) && $candidate_details['round4_status']=='no'){ echo "checked"; }?> >No</label>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea id="round4_comment" name="round4_comment" class="form-control" placeholder="Enter Round4 comment here" pattern="^[A-Za-z1-9]+$" data-error="Please Enter alphabets and numbers only"><?php if(isset($candidate_details['round4_comment'])){ echo $candidate_details['round4_comment']; } ?></textarea><div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
					</div>

					<div class="row" id="round5_div">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Round 5:</label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<input type="text" id="round1" name="round5" pattern="^[A-Za-z1-9]+$" class="form-control" placeholder="Enter round name" value="<?php if(isset($candidate_details['round5'])){ echo $candidate_details['round5']; } ?>" data-error="Please Enter alphabets and numbers only"> 
									<div class="help-block with-errors error_msg"></div>
								</div>
							</div>
							<div class="col-lg-1 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Cleared:</label>	
								</div>
							</div>
							<div class="col-lg-1 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="round5_status" value="yes" <?php if(isset($candidate_details['round5_status']) && $candidate_details['round5_status']=='yes'){ echo "checked"; }?>>Yes</label>
									</div>
								</div>
							</div>
							<div class="col-lg-1 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="round5_status" value="no" <?php if(isset($candidate_details['round5_status']) && $candidate_details['round5_status']=='no'){ echo "checked"; }?>>No</label>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea id="round5_comment" name="round5_comment" class="form-control" placeholder="Enter Round5 comment here" pattern="^[A-Za-z1-9]+$" data-error="Please Enter alphabets and numbers only"><?php if(isset($candidate_details['round5_comment'])){ echo $candidate_details['round5_comment']; } ?></textarea>
									</div>
								</div>
							</div>
					</div>

					<div class="row">
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Status:</label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<select id="interview_status" name="interview_status" class="form-control chosen-select col-md-12 col-sm-12 col-xs-12">
								<option value="null">Select interview status</option>
						    	<option value="selected" <?php if($candidate_details['interview_status']=="selected") echo "selected"; ?>>Selected</option>
						    	<option value="rejected" <?php if($candidate_details['interview_status']=="rejected") echo "selected"; ?>>Rejected</option>
						    	<option value="onhold" <?php if($candidate_details['interview_status']=="onhold") echo "selected"; ?>>On Hold</option>
						    </select>
						</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
						
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<div class="form-group">
									
								</div>
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
				} ?>
			</form>
	</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('.datepicker1').datepicker({
			format: 'yyyy-mm-dd',
			autoclose : true,
			minDate: new Date()
  		});
  		var round1_status=$("input[name='round1_status']:checked").val();
		var round2_status=$("input[name='round2_status']:checked").val();
		var round3_status=$("input[name='round3_status']:checked").val();
		var round4_status=$("input[name='round4_status']:checked").val();
		var round5_status=$("input[name='round5_status']:checked").val();
		if(round1_status=='no'){
				$("#round2_div").hide();
				$("#round3_div").hide();
				$("#round4_div").hide();
				$("#round5_div").hide();
			}
			if(round2_status=='no'){
				$("#round3_div").hide();
				$("#round4_div").hide();
				$("#round5_div").hide();
			}
			if(round3_status=='no'){
				$("#round4_div").hide();
				$("#round5_div").hide();
			}
			if(round4_status=='no'){
				$("#round5_div").hide();
			}
		$("#select_div").hide();
		$('input[type="radio"]').click(function(){
			var round1_status=$("input[name='round1_status']:checked").val();
			var round2_status=$("input[name='round2_status']:checked").val();
			var round3_status=$("input[name='round3_status']:checked").val();
			var round4_status=$("input[name='round4_status']:checked").val();
			var round5_status=$("input[name='round5_status']:checked").val();
			$("#round2_div").show();
			$("#round3_div").show();
			$("#round4_div").show();
			$("#round5_div").show();
			if(round1_status=='no'){
				$("#round2_div").hide();
				$("#round3_div").hide();
				$("#round4_div").hide();
				$("#round5_div").hide();
			}
			if(round2_status=='no'){
				$("#round3_div").hide();
				$("#round4_div").hide();
				$("#round5_div").hide();
			}
			if(round3_status=='no'){
				$("#round4_div").hide();
				$("#round5_div").hide();
			}
			if(round4_status=='no'){
				$("#round5_div").hide();
			}
		});
		$("#submit_interview").click(function(){
			window.location.redirect('<?php echo site_url(); ?>/interview/add_edit_hr/'+$intw_can_id);
		});
	});

</script>