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
				
				<h1 class="well headline">Joining Process</h1>
				<div class="col-sm-12 col-xs-12 profile_bg">
					<div class="row">
						<div class="col-lg-2 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="form-label">Date of Joining</label>
							</div>
						</div>
						<div class="col-lg-10 col-sm-9 col-xs-12" >
							<div class="form-group">
								
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
		;

  		$('#letter_date').datepicker({
			format: 'yyyy/mm/dd',
			maxDate: new Date()
		});
  		
	});

</script>