<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>HRMS Dashboard - User Login</title>
		<!-- responsive meta -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link rel="icon" href="" type="image/x-icon" />
		<link rel="icon" href="<?php echo assets_url();?>img/fav.ico" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo assets_url() ?>css/lib/bootstrap/bootstrap.css">
		<link rel="stylesheet" href="<?php echo assets_url() ?>css/lib/font-awesome/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo assets_url() ?>css/style_log.css">
		<link rel="stylesheet" href="<?php echo assets_url() ?>css/lib/font-awesome/font-awesome.min.css">

		<link rel="stylesheet" href="<?php echo assets_url() ?>css/style.css">
		<script src="<?php echo assets_url();?>js/lib/jquery/jquery-3.2.1.min.js"></script>
		<script src="<?php echo assets_url();?>js/randombg.js"></script>
		<script src="<?php echo assets_url();?>js/lib/popper/popper.min.js"></script>
		<script src="<?php echo assets_url();?>js/lib/bootstrap/bootstrap.min.js"></script>
		<!-- Bootstrap Form Validation JS-->
		<script src="<?php echo assets_url();?>js/lib/form-validate/bootstrapValidator.min.js"></script>
		<script src="<?php echo assets_url();?>js/lib/form-validate/validator.min.js"></script><!-- Form Validation -->
		<link rel="stylesheet" href="<?php echo assets_url();?>css/lib/bootstrap-form-validation/bootstrapValidator.min.css">
		<!-- Sweet Alert JS -->
		<script type="text/javascript" src="<?php echo assets_url();?>js/lib/bootstrap-sweetalert/sweetalert.js"></script>
		<link rel="stylesheet" href="<?php echo assets_url();?>css/lib/bootstrap-sweetalert/sweetalert.css" />	
		<!--[end if]-->
	</head>
	<body class="randbg">
		<?php 
			if(($this->input->cookie('cookie_email') != NULL) && !empty($this->input->cookie('cookie_email')))
			{
				$email = $this->input->cookie('cookie_email');
			}
			else
			{
				$email = NULL;
			}
		?>
		<section class="navigation">
			<div class="container">
				<div class="brand">
					<a href="#"><img class="logo_img" src="<?php echo assets_url();?>img/login.png" alt=""></a>
				</div>
				<nav>
				<div class="nav-mobile"><a id="nav-toggle" href="#!"><span></span></a></div>
					<ul class="nav-list">
						<li>
							<a href="#!">HRMS</a>
						</li>
						<li>
							<a href="#!">CRM</a>
						</li>
						<li>
							<a href="#!">PMS</a>
						</li>
						<li>
							<a href="#!">Contact</a>
						</li>
					</ul>
				</nav>
			</div>
		</section>

		<div class="container">
			<div class="col-md-12 main_content">
				<div class="row">
					<div class="col-md-5">
						<div class="content-w3ls">
							<h2 class="agileits1">SignIn Form</h2>
							<div class="content-agile2">
								<div class="checkpass">
									<?php
										if(isset($error))
										{
											echo $error;
										}
										if(!isset($email))
										{
											$email="";
										}
									?>
								</div>

								<div>
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
								</div>
								<form name="Login" class="form-signin" method="post" action="<?php echo site_url();?>/rpo_login/process" id="Login">
									<div class="form-control">	
										<input type="email" id="email" name="email" placeholder="mail@example.com" value="<?php echo $email; ?>" required="">
									</div>

									<div class="form-control agileinfo">	
										<input type="password" class="lock" name="password" placeholder="Password" id="password1" required="">
									</div>	

									<div class="form-control agileinfo">
										<div class="checkpass">	
											<input value="remember-me" type="checkbox" id="checkbox"  name="remember"> Remember me
												<span class="pull-right">
												<a data-toggle="modal" href="#myModal" style="text-decoration: none; outline: 0;"> Forgot Password?</a>
											</span>
										</div>				
									</div>

									<input type="submit" class="register" id="submit" value="Sign In">
									<!-- <input type="submit" class="register bg_green" value="Register"> -->
								</form>
								<!-- Modal -->

								<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
									<form data-toggle="validator" id="resetPassword" name="resetPassword" method="post" action="" >
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">Forgot Password ?</h4>
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												</div>
												<div class="modal-body">
													<p>Enter your e-mail address to reset your password.</p>
													<input name="recovery_email" id="recovery_email" placeholder="user@abc.com" autocomplete="off" class="form-control placeholder-no-fix rest_stl" type="email" required>
													<span class="error_msg" id ="forgot_err"></span>
												</div>
												<div class="modal-footer">
													<button class="btn btn-success" type="button" id="forgot_submit" value="submit">Submit</button>
													<button data-dismiss="modal" class="btn btn-success" type="button">Cancel</button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<!-- modal -->
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="col-md-7">
						<div class="content_para">
							<p class="title">Esuitx</p>
							<p class="para_content"> We present Intelligent Business Software to resolve
								business inefficiencies for all Business Modules.</p>	
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			function isValidEmailAddress(email)
			{
				var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				return regex.test(email);
			}

			$(document).ready(function()
			{
				$(".alert").show().delay(2000).fadeOut(1000);
				$('#forgot_submit').click(function(){
					var recovery_email = $('#recovery_email').val();
					if(recovery_email=='')
					{
						$('#forgot_err').html('Please Enter Your Email ID');
					}
					else if(!isValidEmailAddress(recovery_email))
					{
						// $('#email_exist').html('Please enter valid email id!').show();
						$('#forgot_err').html('Please Enter Valid Email ID!');
					}
					else
					{
						$.ajax({
							url: '<?php echo site_url();?>/Rpo_login/check_availability',
							data : {email: recovery_email},
							type: 'POST',
							success: function(response)
							{
								if(response==0)
								{
									$('#forgot_err').html('Email ID Does Not Exist!');
								}
								else if(response==1)
								{
									$('#myModal').modal('hide');
									swal( "Please check your e-mail.","We have sent a password reset link.","success");
									window.setTimeout(function(){
										window.location.reload();
									},50000);
								}
								else if(response==2)
								{
									$('#myModal').modal('hide');
									swal( "Email Sending Failed.","","error");
									window.setTimeout(function(){
										window.location.reload();
									},2000);
								}
							}
						});
					}
				});
			});
			$(".randbg").RandBG();
			(function($) { // Begin jQuery
				$(function() { // DOM ready
					// If a link has a dropdown, add sub menu toggle.
					$('nav ul li a:not(:only-child)').click(function(e) {
						$(this).siblings('.nav-dropdown').toggle();
						// Close one dropdown when selecting another
						$('.nav-dropdown').not($(this).siblings()).hide();
						e.stopPropagation();
					});
					// Clicking away from dropdown will remove the dropdown class
					$('html').click(function() {
						$('.nav-dropdown').hide();
					});
					// Toggle open and close nav styles on click
					$('#nav-toggle').click(function() {
						$('nav ul').slideToggle();
					});
					// Hamburger to X toggle
					$('#nav-toggle').on('click', function() {
						this.classList.toggle('active');
					});
				}); // end DOM ready
			})(jQuery); // end jQuery
		</script>
	</body>
</html>