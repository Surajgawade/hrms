
<div class="page-content">
	<div class="container-fluid p-xl-0">
		<div class="well">
			 <div class="row">
			 	<div class="col-sm-12">
					<?php if($this->session->flashdata('success')){?>
					<script type="text/javascript">
					var message_text='<?php echo $this->session->flashdata('success');?>';
						$.notify({
							title: "<strong>"+title+"</strong> ",
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
				<form data-toggle="validator" class="col-sm-12" id="task_form" action="<?php echo site_url();?>/resignation/resi_email" method="post"  role="form">
					<h1 class="well headline">Resignation</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Resignation Title<span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<?php if(@$show > 0) { ?>
												<input class="form-control" placeholder="" type="text" name="email_title" id="t_resig_err" required value="<?php  echo 'Resignation - '.$this->session->userdata('user_name')?>" readonly="true">
												<i class="fa fa-user"></i>
											<?php } else { ?>
												<input class="form-control" placeholder="" type="text" name="email_title" id="t_resig_err" required value="" readonly="true" data-error="Please Enter Name">
												<i class="fa fa-user"></i>
											<?php } ?>
											<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">To<span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="" type="text" name="mail_to" id="nw_title" required  
											value="<?php echo $ro_emails; ?>" readonly="true">
											<i class="fa fa-user"></i>
										</div>
									</div>
								</div>
							</div>	
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">CC<span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="" type="text" name="mail_cc" id="nw_title" required  
											value="<?php echo $hr_email; ?>" readonly="true">
											<i class="fa fa-user"></i>
										</div>
									</div>
								</div>
							</div>	
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">BCC<span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="" type="text" name="mail_bcc" id="nw_title" required  
											value="<?php echo $can_details; ?>" readonly="true">
											<i class="fa fa-user"></i>
										</div>
									</div>
								</div>
							</div>	
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Requested release date<span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="input-group input-append date" id="datepicker1" data-date-start-date="0d">
											<input type="text" class="form-control" name="req_date" id="tat" placeholder="dd/mm/yyyy" value="<?php echo set_value('tat');?>" required data-error="Please Select Release Date" />
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Description<span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<div class="col-lg-12 nopadding">
											<textarea id="nw_description" name="email_description" rows="8" class="form-control" required data-error="Please Enter Description" ></textarea>

										<div class="help-block with-errors error_msg"></div>
										</div>	

										<div></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								<div class="progress">
								<div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%" >0%</div>
								</div>
								<div class="msg"></div>
								</div>
							</div>
						</div>	

						<div class="row">
							<div class="col-lg-6">
								<input type="submit" id="submit_news1" value="Mail" class="btn btn-inline btn-success ladda-button"/>
								<input id="showmenu" type="button" value="Cancel" onclick="javascript:window.history.go(-1);" class="btn btn-inline ladda-button cancel"/>		
								<input type="hidden" name="hideID" id="hideID" value="<?php if(isset($news_details->nw_id)){ echo $news_details->nw_id;} ?>">
							</div>
						</div>
				</form>
			 </div>
		</div>
		
		
		</div>										
	</div>
</div>

<script>
	// $(document).ready(function() {
	$(".chosen-select").chosen();		
	tinymce.init({
        selector: "textarea",
        branding: false
    });
    $('#showmenu').click(function() {
        $('.menu').slideToggle("fast");
    });

$('#datepicker1').datepicker({
			format: 'dd/mm/yyyy',
			autoclose : true,
			minDate: new Date()
  		 	});

 	
</script>	




