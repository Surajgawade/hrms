<?php
  $colors=array('brow'=>'cd6724','green'=>'46c35f','gold'=>'f29824','blue'=>'00a8ff','purple'=>'ac6bec','orange-red'=>'ff561c','grey'=>'adb7be','red'=>'fa424a','aquamarine'=>'21a788','magenta'=>'b348ae','blue-dirty'=>'1b99cf','coral'=>'fe664c','pink-red'=>'f5465e','Yellow'=>'FFFF00','blue-sky'=>'23b9e2');
?>
<div class="page-content">
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
	<div class="container-fluid">	
		<div class="well">
			 <div class="row">	 	
				<form data-toggle="validator" class="col-sm-12" id="company_frm" name="company_frm" action="" method="post">
					<h1 class="well headline">Add Company</h1>
						<input type="hidden" name="ic_id" id="ic_id" value="<?php echo @$company_details['ic_id']; ?>">				
							<div class="col-sm-12 col-xs-12 profile_bg">
								<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Company Name <span>*</span></label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control" placeholder="Company Name" type="text" name="name" id="company_name" required data-error="Please Enter Company Name" value="<?php echo @$company_details['name']; ?>">
												<div class="help-block with-errors error_msg" id="err_name"></div>   
											</div>
										</div>
									</div>
								</div>
		
								<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Description</label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<textarea class="form-control" placeholder="Company Description" type="text" name="description"><?php echo @$company_details['description']; ?></textarea>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Company Email <span>*</span></label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control" placeholder="Company email" type="email" name="ic_email" id="company_email" required data-error="Please Enter valid email" value="<?php echo @$company_details['ic_email']; ?>">  
											<div class="help-block with-errors error_msg" id="err_email"></div>   
											</div>
										</div>
									</div>
								</div>
								

								<div class="row">
									<div class="col-lg-12">
										<input id="create_company" type="submit" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
										<input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
									</div>							
								</div>
							</div>
					   </form> 
			 </div>
		</div>

		</div>										
	</div>
</div>

<script>
	$('#create_company').on('click', function() {
		if($('#company_name').val() == '')
		{
			$('#err_name').text("Please Enter Company Name").show().delay(2000).fadeOut(800);
		}
		else if($('#company_email').val() == '' || !ValidateEmail($('#company_email').val()))
		{
			$('#err_mail').text("Please Enter Valid Company Email").show().delay(2000).fadeOut(800);
		}
		else
		{
			var fdata = $('#company_frm').serialize();
            $('#create_company').attr('disabled',true);
            $.ajax({
                url: '<?php echo site_url();?>/insurance/save_company',
                dataType :"json",
                async:false,
                data : fdata,
                type: 'POST',
                success: function(response)
                {
                	var type = '' ;
					var message = '';
					var title = '';
					if(response == 1)
					{
						type ='success';
						message ='Company Saved Successfully!';
						title ='Success:';
					}
					else if(response == 2)
					{
						type = 'danger';
						message = 'Something went wrong...';
						title = 'Oops:';
					}
					else if(response == 3)
					{
						type = 'warning';
						message = 'Please fill all details';
						title = 'Warning:';
					}
                    $.notify({
                            title: "<strong>"+title+"</strong> ",
                            message: message,
                            type: type,
                        },{
	                        delay: 800,
                            animate:{
                                enter: "animated fadeInUp",
                                exit: "animated fadeOutDown"
                            } 
                    });
                    if(response == 1)
                    {
	                    window.setTimeout(function(){
	                        window.location.href = '<?php echo site_url("insurance/company_list"); ?>';
	                    },1000);
	                }
            	}
        	});
		}
	});

	function ValidateEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    };
</script>