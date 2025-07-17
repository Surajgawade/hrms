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
	<?php $title="offer_letter"; $this->load->view('rpo_manager/top_menu');?>
	<div class="well">
			<form action="" id="interview_form" name="interview_form" method="post" data-toggle="validator">
				<?php if(isset($candidate_details)){?>	
				<input type="hidden" name="intw_can_id" id="intw_can_id" value="<?php if(isset($candidate_details['intw_can_id'])){ echo $candidate_details['intw_can_id']; } ?>">
				<input type="hidden" name="email_id" id="email_id" value="<?php if(isset($candidate_details['email_id'])){ echo $candidate_details['email_id']; } ?>">
				<h1 class="well headline">Offer Letter</h1>
				<div class="col-sm-12 col-xs-12 profile_bg">
					<div class="row">						
						<div class="col-lg-12 col-sm-9 col-xs-12" >
							<div class="form-group">
								<textarea class="form-control" id="letter_body" name="letter_body" row="10" style="height:500px;"><?php if(isset($candidate_details)){?>
									<p><strong>Dear <?php echo $candidate_details['can_name'] ?>,</strong><br><br>Please find below the Offer Letter provided with all details. You are required to acknowledge and be in compliance with the same for further processing. <br>This has reference to the interview you had with us. We are pleased to know that you will like to be a member of Team. We are pleased to offer you a position of <strong><?php echo $candidate_details['offered_position'] ?></strong>.<br><br>Your gross annual salary on the basis of Cost to the Company will be Rs. <strong><?php echo $candidate_details['offered_rate'] ?></strong> per annum. The details of the salary break up will be given to you at the time of joining.<br><br>We would expect you to join as early as possible but not later than <strong><?php echo format_date($candidate_details['joining_date']);?></strong>.<br><br>On the date of your joining, you may please bring along the following:<br><br>1. Copies of educational and experience certificates<br><br>2. Relieving certificate from the previous employer, if any<br><br>3. Appointment letter of the previous employer and salary revision letters, if any<br><br>4. Last pay slip received from the previous employer, if any<br><br>5. Form 16 (TDS Certificate), if any<br><br>6. 3 Passport Size Photographs<br><br>Your appointment will be subject to verification of references.<br><br>We welcome you to <strong><?php echo "Raoson";//$candidate_details['client_name'];?></strong> Family. Please acknowledge the email&nbsp; as a token of your acceptance.<br><br>Thanks,<br><br><strong>Raoson Business and Softech Solutions</strong><br data-mce-bogus="1"></p> <?php } ?>
								</textarea>
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-lg-6">
						<!-- <input type="button" class="btn btn-inline btn-info ladda-button" data-style="expand-left" value="Preview" name="email_preview" id="email_preview" > -->
						<button class="btn btn-inline btn-success ladda-button" data-style="expand-left" name="submit_letter" id="submit_letter"><span class="ladda-label">Send Mail</span>
						<span class="ladda-spinner"></span><span class="ladda-spinner"></span>
						<div class="ladda-progress" style="width: 106px;"></div></button>
						
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
		tinymce.init({
	        selector: "textarea",
        branding: false
	    });

  		$('#letter_date').datepicker({
			format: 'yyyy/mm/dd',
			maxDate: new Date()
		});
  		
  		$("#submit_letter").click(function(){
  			var intw_can_id=$("#intw_can_id").val();
  			var email_id=$("#email_id").val();
  			var letter_body=tinyMCE.activeEditor.getContent();
  			$.ajax({
  				url:'<?php echo site_url();?>/rpo_interview/offer_letter',
  				type:'post',
  				data:{'intw_can_id':intw_can_id,'email_id':email_id,'letter_body':letter_body},
  			});
  		});
	});

</script>