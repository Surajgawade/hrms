<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>HRMS Dashboard - Reset Password</title>

	<!-- responsive meta -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="icon" href="" type="image/x-icon" />
	<link rel="icon" href="<?php echo assets_url();?>img/fav.ico" type="image/x-icon" />
	<link rel="stylesheet" href="<?php echo assets_url() ?>css/lib/bootstrap/bootstrap.css">
	<!-- <link rel="stylesheet" href="<?php //echo assets_url() ?>css/profile.css"> -->
	
	<link rel="stylesheet" href="<?php echo assets_url() ?>css/style_log.css">
	<link rel="stylesheet" href="<?php echo assets_url() ?>css/lib/font-awesome/font-awesome.min.css">
	<script src="<?php echo assets_url();?>js/lib/jquery/jquery-3.2.1.min.js"></script>
	<script src="<?php echo assets_url();?>js/randombg.js"></script>
	<script src="<?php echo assets_url();?>js/lib/popper/popper.min.js"></script>
	<script src="<?php echo assets_url();?>js/lib/bootstrap/bootstrap.min.js"></script>
	 <!-- Sweet Alert JS -->
	<script type="text/javascript" src="<?php echo assets_url();?>js/lib/bootstrap-sweetalert/sweetalert.js"></script>
	<link rel="stylesheet" href="<?php echo assets_url();?>css/lib/bootstrap-sweetalert/sweetalert.css" />	

	
	<!--[end if]-->

</head>
<body class="randbg">
	<section class="navigation">
  <div class="container">
    <div class="brand">    
      <a href="#"><img class="logo_img" src="<?php echo assets_url() ?>img/login.png" alt=""></a>
    </div>
    <nav>
      <div class="nav-mobile"><a id="nav-toggle" href="#!"><span></span></a></div>
      <ul class="nav-list">
        <li>
          <a href="#!">HRMS</a>
        </li>
        <li>
          <a href="#!">Contact</a>
        </li>
      </ul>
    </nav>
  </div>
</section>
<div class="container">
	<div class="col-md-12 main_content_reset">
		<div class="content-w3ls_reset">
		
			<div class="content-agile2">
				<form name="save_pwd" class="form-signin" method="post" action="">
					<h2 class="agileits1">Reset Password</h2>
					<div class="checkpass" style="color: red">
						<?php
				            if(isset($error)){
				            	echo $error;
				            }
				            if(!isset($email)){
				            	$email="";
				            }
						?>
					</div>
					
					<input type="hidden" id="reset_code" name="reset_code" value="<?php echo $_GET['em']; ?>">
					<div class="form-control">	
						<input type="password" id="new_pswrd" class="pwd_col" name="password" value="" placeholder="New Password">
					</div>

					<div class="form-control agileinfo">
						<input type="password" id="confirm_pswrd" class="pwd_col" value="" placeholder="Confirm Password" onChange="check_values()">
					</div>	
				
					<button id="btn_save" name="submit" class="register checkpass" type="button">Save</button>
				</form>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<footer>
	<div class="footer"> © 2018 Esuitx, All rights reserved.</div>
</footer>
</body>
</html>
<script>
	
	function check_values()
	{
		var pwd = $('#new_pswrd').val();
		var n_pwd = $('#confirm_pswrd').val();
		if((pwd == n_pwd) && (pwd != '') && (n_pwd != ''))
		{
			$('#btn_save').removeAttr('disabled');
		}
		else
		{
			$('#btn_save').attr('disabled', true);
			swal( "Password Mismatched","Please Enter Again.","warning");
	                	window.setTimeout(function(){
				            window.location.reload();
				        },3000);
		}
	}

	$('#btn_save').on('click', function()
	{
		// alert('hii');
		var pwd = $('#new_pswrd').val();
		var n_pwd = $('#confirm_pswrd').val();
		var reset_code = $('#reset_code').val();
		if((pwd == n_pwd) && (pwd != '') && (n_pwd != ''))
		{
	        $.ajax({
	            url: '<?php echo site_url();?>/login/save_password',
	            dataType :"json",
	            async:false,
	            data : {'reset_code':reset_code, 'password':pwd},
	            type: 'POST',
	            success: function(response)
	            {
	            	console.log(response);
	                if(response == true)
	                {
					   swal( "Password changed successfully.","","success");
	                	window.setTimeout(function(){
				            window.location.href = '<?php echo site_url("login"); ?>';
				        },3000);
	                }
	                else
	                {
	                	swal( "Something went wrong!!!","","error");
	                	window.setTimeout(function(){
				            window.location.reload();
				        },3000);
	                }
	            }
	        });
		}
		else
		{
			$('#btn_save').attr('disabled', true);
			swal( "Password Fields Are Blank !","Please Enter Password.","warning");

            	window.setTimeout(function(){
		            window.location.reload();
		        },3000);
				}
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