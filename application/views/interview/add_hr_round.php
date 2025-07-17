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
	<?php
	$joining_date ='';
	if(isset($candidate_details['joining_date']) && !empty($candidate_details['joining_date']))
	{
 		if(!empty(strtotime($candidate_details['joining_date'])))
 		{
 			$joining_date = db_to_date($candidate_details['joining_date']);
 		}
	}
	?>	
<div class="container-fluid">
	<?php $title="hr_round_details"; $this->load->view('interview/top_menu');?>
	<div class="well">
			<form action="" id="interview_form" name="interview_form" method="post" data-toggle="validator">
				<?php if(isset($candidate_details)){?>	
				<input type="hidden" name="intw_can_id" id="intw_can_id" value="<?php if(isset($candidate_details['intw_can_id'])){ echo $candidate_details['intw_can_id']; } ?>">
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
								<input type="text" id="interview_status" name="interview_status" class="form-control" placeholder="Enter Expected CTC" value="<?php echo (isset($candidate_details['interview_status']))? $candidate_details['interview_status'] :'' ?>" readonly>
							</div>
						</div>
						<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										
									</div>
						</div>						
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									
								</div>
							</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-lg-2 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="form-label">Expected CTC:</label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<input type="text" id="expected_ctc" name="expected_ctc" class="form-control" placeholder="Enter Expected CTC" value="<?php echo (isset($candidate_details['expected_ctc']))? $candidate_details['expected_ctc'] :'Expected CTC not mentioned' ?>" readonly>
							</div>
						</div>
						<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">CTC Negotiable:</label>
									</div>
						</div>						
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<input type="text" name="ctc_negotiable" id="ctc_negotiable" class="form-control" value="<?php if(isset($candidate_details['ctc_negotiable'])){ echo $candidate_details['ctc_negotiable']; } ?>" readonly>
								</div>
							</div>
						</div>
					</div>	

					<div class="row">
						<div class="col-lg-2 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="form-label">Offered CTC:<span>*</span></label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<input type="text" id="offered_ctc" name="offered_ctc"  class="form-control number" placeholder="Enter offered CTC " value="<?php if(isset($candidate_details['offered_ctc'])){ echo $candidate_details['offered_ctc']; } ?>" required data-error="Please Enter Offered CTC" >
								<div class="help-block with-errors error_msg"></div>
							</div>
							<!-- pattern="^(?!0+$)[0-9]{1,10}$" -->
						</div>					
					</div>

					<div class="row">
						<div class="col-lg-2 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="form-label">Given Notice Period:<span>*</span></label>
							</div>
						</div>
						<div class="col-lg-2 col-sm-2 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<select name="notice_period_month" id="notice_period_month" class="form-control">
										<option value="">Select Month</option>
										<?php for($i=0;$i<=11;$i++){ ?>
											<option value="<?php echo $i;?>"<?php if(isset($candidate_details['notice_period_month']) &&($i == $candidate_details['notice_period_month'])) echo "selected";?>><?php echo $i;?></option>
										<?php } ?>													
									</select>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-sm-2 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<select name="notice_period_days" id="notice_period_days" class="form-control">
										<option value="">Select Days</option>
										<?php for($i=0;$i<=30;$i++){ ?>
											<option value="<?php echo $i;?>"<?php if(isset($candidate_details['notice_period_days']) &&($i == $candidate_details['notice_period_days'])) echo "selected";?>><?php echo $i;?></option>
										<?php } ?>													
									</select>											
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Is Notice Period Negotiable :</label>
									</div>
						</div>	
						<div class="col-lg-1 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<label class="form-label"><input type="radio" name="notice_negotiable" value="yes" <?php if(isset($candidate_details['notice_negotiable']) && $candidate_details['notice_negotiable']=='yes') { echo "checked"; }?> >Yes</label>
								</div>
							</div>
						</div>
						<div class="col-lg-1 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<label class="form-label"><input type="radio" name="notice_negotiable" value="no" <?php if(isset($candidate_details['notice_negotiable']) && $candidate_details['notice_negotiable']=='no') { echo "checked"; }?> >No</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">						
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Is applicable for bonus:</label>	
							</div>
						</div>
						<div class="col-lg-2 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<label class="form-label"><input type="radio" name="bonus_status" value="yes" <?php if(isset($candidate_details['bonus_status']) && $candidate_details['bonus_status']=='no') { echo "checked"; }?>>Yes</label>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<label class="form-label"><input type="radio" name="bonus_status" value="no" <?php if(isset($candidate_details['bonus_status']) && $candidate_details['bonus_status']=='no') { echo "checked"; }?>>No</label>
								</div>
							</div>
						</div>	
						<div class="col-lg-2 col-sm-6 col-xs-12 bonus">
							<div class="form-group">
								<label class="form-label">Bonus offered:<span>*</span></label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12 bonus">
							<div class="form-group">
								<input type="text" id="offered_bonus" name="offered_bonus" class="form-control" placeholder="Enter Offered Bonus " value="<?php if(isset($candidate_details['offered_bonus'])){ echo $candidate_details['offered_bonus']; } ?>">
							</div>
						</div>					
				    </div>
				
					<div class="row">
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Position Offered:<span>*</span></label>
							</div>
						</div>
						<div class="col-lg-2 col-sm-9 col-xs-12">
							<div class="form-group">
								<input type="text" id="position" name="position" class="form-control alpha_only" placeholder="Enter Position Offered" readonly="" value="<?php echo (($candidate_details['position']))? $candidate_details['position'] : '' ?>" required data-error="Please Enter Offered Position"> 
								<div class="help-block with-errors error_msg"></div>
							</div>
						</div>
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label"><input type="checkbox" name="position_check" id="position_check" value="yes" >Click to Edit</label>	
							</div>
						</div>
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Joining Date:<span>*</span></label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<input type="text" id="joining_date" name="joining_date" class="form-control" placeholder="Enter Joining Date"  value="<?php echo $joining_date; ?>"  data-date-start-date="0d"> 
								<span class="error_msg" id ="date_err"></span>
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
  		$('#joining_date').datepicker({
			format: 'dd/mm/yyyy',
			maxDate: new Date()
		});
  		$(".bonus").hide();
  		
  		$('input[type=radio][name=bonus_status]').change(function(){
  			var radioval=$('input[name=bonus_status]:checked').val();
  			if(radioval=='yes'){
  				$(".bonus").show();
  			}
  			else{
  				$(".bonus").hide();
  			}
  		});

  		$('input[type=checkbox][name=position_check]').change(function(){
  			var radioval=$('input[name=position_check]:checked').val();
  			if(radioval=='yes'){
  				$("#position").attr('readonly',false);
  			}
  			else{
  				$("#position").attr('readonly',true);

  			}
  		});
  		$("#submit_interview").click(function(){
  			if($("#position").val()==''){
	  			$("#position_err").html("Field could not be empty");
	  			return false;
	  		}
	  		if($("#joining_date").val()=='0000-00-00' || $("#joining_date").val()==''){
  			$("#date_err").html("Field could not be empty");
  			return false;
  		}
  		});
  		
	});

</script>