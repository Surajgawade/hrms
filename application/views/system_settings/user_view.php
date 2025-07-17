<?php //x_debug($this->content);?>

<div class="page-content">
	<div class="container-fluid p-xl-0">
		<div style="color: red">
			<?php  echo validation_errors();?>
		</div>
		<div class="well">
			<div class="row">
				<form data-toggle="validator" class="col-sm-12" id="profile_form" method="post" action="<?php echo site_url();?>/system_settings/save_user ">
					<h1 class="well headline">Employee Registration Form</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<?php if($this->session->flashdata('error')){?>
						<div class="alert alert-danger alert-no-border alert-close alert-dismissible fade show" role="alert">
						 <?php echo $this->session->flashdata('error');?>
						</div>
						<?php }?>
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Employee Name <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control alpha_only" placeholder="Employee Full Name" type="text" id="can_name" name="can_name" required data-error="Please Enter Employee Full Name" value="<?php echo $this->session->flashdata('can_name');?>">
										<i class="fa fa-user"></i>
										<div class="help-block with-errors error_msg"></div>										
									</div>									
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Email Address <span>*</span></label>
								</div>
							</div>
							<div class="col-lg-7 col-sm-6 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="email" placeholder="Employee Email Address" class="form-control" id="email" name="email"  required data-error="Please Enter Valid Email ID" value="<?php echo $this->session->flashdata('email');?>">
										<i class="fa fa-envelope"></i>
										<div class="help-block with-errors error_msg"></div>										
									</div>
									<div class="display_n"><span id="email_exist"></span></div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-3 col-xs-12">
								<div class="form-group">
									<a href="javascript:;" id="check" class="btn btn-inline">Check Availibility</a>
								</div>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-lg-6">
								<button class="btn btn-inline btn-success ladda-button" data-style="expand-left" id="btn_register"><span class="ladda-label">Submit</span>
								<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
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

$(document).ready(function(){

	$('#check').click(function(){
		var email = $('#email').val();
		
			$.ajax({
				url: '<?php echo site_url();?>/candidate/check_availability',
				data : {email: email},
				type: 'POST',
				success: function(response){
					if(response==0)
						$('#email_exist').addClass('msg_red').html('Email Id already exist! Please use another email Id.');
					else
						$('#email_exist').addClass('msg_green').html('Email Id is available.');
					 	$('.display_n').removeClass('display_n');
				}
			});
		
	});
});

</script>
	