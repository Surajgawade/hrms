<?php  $userdata = $this->session->userdata('logged_in_user');?>
<div class="page-content">
	<div class="container-fluid">
		<section class="tabs-section">
			<div class="tabs-section-nav tabs-section-nav-left">
				<ul class="nav" role="tablist">
					<!-- <li class="nav-item">
						<a class="nav-link " href="#tabs-2-tab-1" role="tab" data-toggle="tab">
							<span class="nav-link-in">Profile</span>
						</a>
					</li> -->
					<li class="nav-item">
						<a class="nav-link active" href="#tabs-2-tab-2" role="tab" data-toggle="tab">
							<span class="nav-link-in">Change Password</span>
						</a>
					</li>
				</ul>
			</div><!--.tabs-section-nav-->

			<!-- <div class="tab-content no-styled profile-tabs">
				<div role="tabpanel" class="tab-pane active" id="tabs-2-tab-1">
					<section class="box-typical profile-side-user">
						<button type="button" class="avatar-preview avatar-preview-128">
							<img src="<?php //echo assets_url();?>img/avatar-default.png" alt=""/>
							<span class="update">
								<i class="font-icon font-icon-picture-double"></i>
								Update photo
							</span>
							<input type="file"/>
						</button>

						<div class="profile-card">
							<div class="profile-card-name">Sarah Sanchez</div>
							<div class="profile-card-status">Company Founder</div>
							<button type="button" class="btn btn-rounded">SAVE</button>
						</div>
					</section>
				</div> --><!--.tab-pane-->
				<div role="tabpanel" class="tab-pane" id="tabs-2-tab-2">
					<section class="box-typical profile-settings box-typical-padding">
						<section class="box-typical-section">
							<form name="change_pass" id="frm_change_pass" method="post" action="#">
								<div class="form-group row">
									<div class="col-xl-2">
										<label class="form-label">Current Password</label>
									</div>
									<div class="col-xl-4">
										<input class="form-control" type="password" name="current_pass" id="current_pass" placeholder="Old Password"/>
										<span id="err_curr_pass" class="error_msg"></span>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-xl-2">
										<label class="form-label">New Password</label>
									</div>
									<div class="col-xl-4">
										<input class="form-control" type="password" name="new_password" id="new_password" placeholder="New Password"/>
										<span id="err_newpass" class="error_msg"></span>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-xl-2">
										<label class="form-label">Confirm New Password</label>
									</div>
									<div class="col-xl-4">
										<input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password"/>
										<span id="err_confirmpass" class="error_msg"></span>
									</div>
								</div>
							</section>

							<section class="box-typical-section profile-settings-btns">
								<button type="button" id="change_pass_btn" class="btn btn-rounded btn-success">Save Changes</button>
								<button type="button" class="btn btn-rounded btn-inline" id="reset">Cancel</button>
							</section>
						</form>
					</section>
				</div><!--.tab-pane-->
			</div><!--.tab-content-->
		</section><!--.tabs-section-->
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
      $('#current_pass').blur(function (event) {
        if(($('#current_pass').val().trim()==''))
        {
          $('#err_curr_pass').addClass('warning-msg').html('Please enter your current password').show();
          event.preventDefault();
        }
        else
        {
          var email_id ='<?php echo $userdata['email']?>';
          var current_pass = $('#current_pass').val().trim();
         $.ajax({
                  type:'post',
                  data:{'current_pass':current_pass,'email_id':email_id},
                  dataType: "json",
                  url:'<?php echo site_url();?>/profile/check_password',
                  success:function(response){                  
                    if(response==0)
                    {
                      $('#err_curr_pass').addClass('warning-msg').html('You have entered wrong current password').show();
                      $('#change_pass_btn').attr('disabled', true);
                    }
                    else
                    {
                      $('#err_curr_pass').html('').hide();
                      $('#change_pass_btn').removeAttr('disabled');
                    }
                }               
            });
        } 
      });

		$('#change_pass_btn').click(function(event){
			isValid=1;

			var current_pass = $('#current_pass').val().trim();
			var new_pass = $('#new_password').val().trim();
			var confirm_pass = $('#confirm_password').val().trim();
			if(current_pass=='')
			{
				$('#err_curr_pass').html('Enter old password').show();
				event.preventDefault();
			}
			else if(new_pass=='')
			{
				$('#err_newpass').html('Enter new password').show();
			}
			else if(confirm_pass=='')
			{
				$('#err_confirmpass').html('Enter confirm password').show();
			}
			else if(new_pass!=confirm_pass)
			{
				$('#err_confirmpass').html('Confirm password does not match with new password').show();
			}
			else
			{		
				$('#err_oldpass').html('').hide();
				$('#err_newpass').html('').hide();
				$('#err_confirmpass').html('').hide();
				$('#change_pass_btn').attr('disabled',true);
				$.ajax({
					url: '<?php echo site_url();?>/profile/change_password',
					data : {confirm_pass: confirm_pass},
					type: 'POST',
					success: function(response){
						response = JSON.parse(response);
						if(response == true)
						{
							$.notify({
								title: "<strong>Success:</strong> ",
								message:"Password Updated Successfully! Login With New Password",
								
							},{
							type: "success",
							delay: 800,
								animate:{
									enter: "animated fadeInUp",
									exit: "animated fadeOutDown"
								} 
							});
							setTimeout(function () {
						window.location.href = '<?php echo site_url();?>';
    				}, 2000);
						}
						else
						{
							$.notify({
								title: "<strong>Success:</strong> ",
								message:"Something Went Wrong!",
								
							},{
							type: "warning",
							delay: 800,
								animate:{
									enter: "animated fadeInUp",
									exit: "animated fadeOutDown"
								} 
						});
						}
					}
				});
			}
		});
		$('#reset').click(function(){
			$('#frm_change_pass').find("input[type=password]").val("");
		});
	});	
</script>
