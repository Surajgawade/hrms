<div class="page-content">
	<div class="container-fluid">
		<?php $this->load->view('candidate/can_menu');?>
	<div class="well">
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12"  >
				<h1 class="well headline">Profile Summary</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right" id="user_profile_details">
										<p id="pf_no"><strong> PF Number </strong>:&nbsp;&emsp;&emsp;&emsp;&emsp;<?php  echo isset($can_details->salary->pf_no) && !empty($can_details->salary->pf_no) ? $can_details->salary->pf_no : 'Not Provided';?>  <span> </span> </p>
				                        <p id="account_number"> <strong>Account Number </strong>:&nbsp;&emsp;<?php  echo isset($can_details->bank_details->account_number) && !empty($can_details->bank_details->account_number) ? $can_details->bank_details->account_number : 'Not Provided';?> <span></span> </p>
				                        <p id="pan_no"> <strong>PAN Number </strong>:&nbsp;&emsp;&emsp;&emsp;<?php  echo isset($can_details->profile->pan_no) && !empty($can_details->profile->pan_no) ? $can_details->profile->pan_no : 'Not Provided';?><span></span></p>
				                        <p id="aadhar_no"> <strong>Aadhaar Number </strong>:&emsp;&emsp;<?php  echo isset($can_details->profile->aadhar_no) && !empty($can_details->profile->aadhar_no) ? $can_details->profile->aadhar_no : 'Not Provided';?><span></span> </p>
									</div>
								</div>
							</div>
						</div>

					</div>
				</form> 
		</div>
	</div>
</div>
</div>

