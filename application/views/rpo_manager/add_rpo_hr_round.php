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
	<?php $title="hr_round_details"; $this->load->view('rpo_manager/top_menu');?>
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
								<input type="text" id="interview_status" class="form-control" placeholder="" value="<?php echo (isset($candidate_details['interview_status']))? $candidate_details['interview_status'] :'' ?>" readonly>
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
								<label class="form-label">Expected Salary:</label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<input type="text" id="expected_salary" name="expected_salary" class="form-control" placeholder="Enter Expected Salary" value="<?php echo (isset($candidate_details['expected_salary']))? $candidate_details['expected_salary'] :'Expected Salary not mentioned' ?>" readonly>
							</div>
						</div>						
					</div>	

					<div class="row">
				 		<div class="col-lg-2 col-sm-3 col-xs-12">
						<div class="form-group">
							<label class="form-label">Salary Negotiable:</label>
						</div>
						</div>
					
						<div class="col-lg-2 col-sm-4 col-xs-12">
							<div class="form-group">
								<div class="form-control-wrapper form-control-icon-right">
									<label class="form-label"><input type="radio" name="salary_negotiable" value="yes" <?php if((isset($can_data['salary_negotiable']) && $can_data['salary_negotiable']	=='yes') )echo "checked";?>>Yes</label>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-sm-4 col-xs-12">
						<div class="form-group">
							<div class="form-control-wrapper form-control-icon-right">
								<label class="form-label"><input type="radio" name="salary_negotiable" value="no" <?php if((isset($can_data['salary_negotiable']) && $can_data['salary_negotiable']=='no')) echo "checked";?> >No</label>
							</div>
						</div>
						</div>
				 	</div>

					<div class="row">
						<div class="col-lg-2 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="form-label">Client Rate:</label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<input type="text" id="client_rate" name="client_rate" class="form-control" placeholder="Enter Client Given Rate " value="<?php if(isset($candidate_details['client_rate'])){ echo $candidate_details['client_rate']; } ?>" required data-error="Please Enter Client Given Rate" > 
							</div>
						</div>	
						<div class="col-lg-2 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="form-label">Offered Rate:</label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<input type="text" id="offered_rate" name="offered_rate" class="form-control" placeholder="Enter offered Rate " value="<?php if(isset($candidate_details['offered_rate'])){ echo $candidate_details['offered_rate']; } ?>" required data-error="Please Enter Client Given Rate" >
							</div>
						</div>					
					</div>
			
				
					<div class="row">
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Position Offered:</label>
							</div>
						</div>
						<div class="col-lg-3 col-sm-9 col-xs-12">
							<div class="form-group">
								<input type="text" id="position" name="position" class="form-control" placeholder="Enter Position Offered" readonly="" value="<?php if(!empty($candidate_details['offered_position'])) {echo  $candidate_details['offered_position'];} else if(!empty($candidate_details['designation'])){ echo ($candidate_details['designation']);} else echo '';?>"> 
								<span class="error_msg" id ="position_err"></span>
							</div>
						</div>
						<div class="col-lg-1 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label"><input type="checkbox" name="position_check" id="position_check" value="yes" >Edit</label>	
							</div>
						</div>
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Joining Date:</label>
							</div>
						</div>
						<div class="col-lg-4 col-sm-9 col-xs-12">
							<div class="form-group">
								<input type="text" id="joining_date" name="joining_date" class="form-control" placeholder="Enter Joining Date"  value="<?php echo (isset($candidate_details['joining_date']) && !empty($candidate_details['joining_date'])) ? format_date($candidate_details['joining_date']) : ''?>" data-date-start-date="0d"> 
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

	$('#joining_date').on('changeDate', function(e) {
		// $('#datePicker1').datepicker('setStartDate', $('#from_date').val());
		var can_id = $('#intw_can_id').val();
		var joining_date = $('#joining_date').val();
		// console.log($('#joining_date').val());
		$.ajax({
			url: '<?php echo site_url();?>/rpo_interview/get_interview_dates',
			data : {can_id: can_id,joining_date:joining_date },
			type: 'POST',
			success: function(response){
				console.log(response);
				if(response==1)
				{
					$('#date_err').html('Joining date should be less than interview date').show();
					$('#submit_interview').attr('disabled',true);
					return false;
				}
				else 
				{
					$('#submit_interview').removeAttr('disabled');
					$('#date_err').html('').hide();				
				}
			}
		});
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