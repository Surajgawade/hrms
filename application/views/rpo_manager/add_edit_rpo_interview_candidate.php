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
	<?php
	$schedule_date ='';
	if(isset($can_details->schedule_date) && !empty($can_details->schedule_date))
	{
 		if(!empty(strtotime($can_details->schedule_date)))
 		{
 			$schedule_date = db_to_date($can_details->schedule_date);
 		}
	}
	?>
	<div class="container-fluid">
		<?php $this->load->view('rpo_manager/top_menu');?>

	<div class="well">
		 
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="can_information" action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="intw_can_id" id="intw_can_id" value="<?php echo (isset($can_details->intw_can_id)) ? $can_details->intw_can_id : '';?>" >
				<input type="hidden" name="rpo_emp_code" id="rpo_emp_code" value="<?php echo (isset($can_details->rpo_emp_code)) ? $can_details->rpo_emp_code : '';?>" >
				<h1 class="well headline">Candidate Information</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
					  <div class="row ">
						 <div class="col-lg-6 col-sm-6 col-xs-6 profile_bg">
						 	<?php if($this->uri->segment(3)==''){?>
					 		<div class="row">
						 		<div class="col-lg-3 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Check Existing:</label>
									</div>
								</div>
							
								<div class="col-lg-3 col-sm-4 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<label class="form-label"><input type="radio" name="is_exist" value="yes">Yes</label>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="is_exist" value="no" checked>No</label>
									</div>
								</div>
								</div>
						 	</div>
						 	<div class="row" id="search_div">
							 	<div class="col-lg-3 col-sm-3 col-xs-3">
									<label class="form-label">Search With Email Or Emp Code:</label>
								</div>
								<div class="col-lg-9 col-sm-9 col-xs-9">
	           					 <input class="form-control" type="text" name="email_emp_code" id="email_emp_code" value="<?php echo (isset($can_details->rpo_emp_code)) && !empty($can_details->rpo_emp_code) ? $can_details->rpo_emp_code : ''?>" />
	           					 <span class="error_msg" id="err_empcode"></span>
								</div>	
						 	</div>
						 	<?php }?>
						 	<?php if (!isset($can_details->intw_can_id)){ ?>
						 	<div class="row ">
							 	<div class="col-lg-3 col-sm-3 col-xs-3">
									<label class="form-label">Upload Resume:</label>
								</div>
								<div class="col-lg-9 col-sm-9 col-xs-9">
	           					 <input class="form-control" type="file" name="file" id="upload" class="file-upload_rpo" />
								</div>	
						 	</div>
						 	<?php }?>
						 	<div class="row">
						 		<div class="col-lg-3 col-sm-3 col-xs-3">
								<div class="form-group">
									<label class="form-label">Candidate Name:<span>*</span></label>
								</div>
								</div>
							
								<div class="col-lg-9 col-sm-9 col-xs-9">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<?php
												$name=$this->session->flashdata('name');
												$fullname = '';
												if(isset($name['firstName']))
												{
													$fullname=$name['firstName'];
												}
												if(isset($name['surname']))
												{
													$fullname.=" ".$name['surname'];
												}
											 ?>
											<input class="form-control alpha_only req_field"  type="text" name="can_name" id="can_name" placeholder="Candidate Name" value="<?php echo $fullname; ?><?php echo (isset($can_details->can_name) && !empty($can_details->can_name) )? $can_details->can_name : ''?>" required  data-error="Please Enter Candidate Name">
											<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>
						 	</div>
						 	<div class="row">						 		
								<div class="col-lg-3 col-sm-3 col-xs-3">
									<div class="form-group">
										<label class="form-label">Email Id:<span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-9 col-sm-9 col-xs-9">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<?php if(count($this->session->flashdata('email')) > 1)
											{
												echo "<select class='form-control' id='email'>";
												foreach ($this->session->flashdata('email') as $key => $value) {
													echo "<option>$value</option>";
												}
												echo "</select>";
											}else
											{?>
											<input type="email" name="email_id" id="email_id" placeholder="Email Id" class="form-control req_field" value="<?php echo implode('',$this->session->flashdata('email')); ?><?php echo (isset($can_details->email_id)) && !empty($can_details->email_id) ? $can_details->email_id : ''?>" data-error="Please Enter Email Id" required>
											<?php }?> 
											<div class="help-block with-errors error_msg"></div>
											<span class="error_msg" id="err_email_exists"></span>
										</div>
									</div>
								</div>
						 	</div>

						 	<!-- <div class="row"> -->
						 	<!-- </div> -->
						 	<div class="row">
						 		<div class="col-lg-3 col-sm-3 col-xs-3">
								<div class="form-group">
									<label class="form-label">Mobile Number:<span>*</span></label>
								</div>
								</div>
							
								<div class="col-lg-9 col-sm-9 col-xs-9">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">

											<?php  if(!empty($this->session->flashdata('mobile_no'))){ ?>
												<select class="form-control" id='Mobile'><option>select</option>
													<?php foreach ($this->session->flashdata('mobile_no') as $key => $value) {
														if(strlen($value)==10)
														{
															echo "<option>$value</option>";
														}
													} ?>
												</select>
											<?php }
											?>
											<input type="text" minlength="10" maxlength="10" name="mobile_no" id="mobile_no" placeholder="Mobile Number Here" class="form-control number req_field" value="<?php echo (isset($can_details->phone1) && !empty($can_details->phone1)) ? $can_details->phone1 : '';?>" required data-error="Please Enter Mobile Number" >
											<i class="fa fa-mobile"></i>
											<div class="help-block with-errors error_msg"></div>
												<span class="error_msg" id ="phone1_err"></span>
										</div>
									</div>
								</div>
						 	</div>
						 	<div class="row">
						 		<div class="col-lg-3 col-sm-3 col-xs-3">
								<div class="form-group">
									<label class="form-label">Alternate Number:</label>
								</div>
								</div>
							
								<div class="col-lg-9 col-sm-9 col-xs-9">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input type="text" minlength="10" maxlength="10" name="alternate_no"  id="alternate_no" placeholder="Alternate Number Here" class="form-control number" value="<?php echo (isset($can_details->phone2) && !empty($can_details->phone2)) ? $can_details->phone2 : ''?>">
											<i class="fa fa-phone"></i>
										</div>
									</div>
								</div>
						 	</div>
						 	<div class="row">
						 		<div class="col-lg-3 col-sm-3 col-xs-3">
								<div class="form-group">
									<label class="form-label">Designation:<span>*</span></label>
								</div>
								</div>
							
								<div class="col-lg-9 col-sm-9 col-xs-9">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control alpha_only req_field"  type="text" name="position" id="position" placeholder="Designation" value="<?php echo (isset($can_details->designation) && !empty($can_details->designation) )? $can_details->designation : ''?>" required data-error="Please Enter Designation">
											<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>
						 	</div>
						 	<div class="row">
						 		<div class="col-lg-3 col-sm-3 col-xs-3">
								<div class="form-group">
									<label class="form-label">Source:</label>
								</div>
								</div>							
								<div class="col-lg-9 col-sm-9 col-xs-9">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input type="text" name="source" id="source" placeholder="Source" class="form-control req_field" value="<?php echo (isset($can_details->source)) && !empty($can_details->source) ? $can_details->source : ''?>">
										</div>
									</div>
								</div>
						 	</div>
						 	<div class="row">
						 		<div class="col-lg-3 col-sm-3 col-xs-3">
								<div class="form-group">
									<label class="form-label">Expected Salary:<span>*</span></label>
								</div>
								</div>							
								<div class="col-lg-9 col-sm-9 col-xs-9">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input type="text" name="expected_salary" id="expected_salary" placeholder="Expected Salary" class="form-control number req_field" value="<?php echo (isset($can_details->expected_salary)) && !empty($can_details->expected_salary) ? $can_details->expected_salary : ''?>" required data-error="Please Enter Expected Salary"><div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>	
						 	</div>
						 	<div class="row">
						 		<div class="col-lg-3 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Salary Negotiable:</label>
								</div>
								</div>
							
								<div class="col-lg-3 col-sm-4 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<label class="form-label"><input type="radio" name="salary_negotiable" value="yes" <?php if((isset($can_details->salary_negotiable) && $can_details->salary_negotiable	=='yes') )echo "checked";?> checked>Yes</label>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="salary_negotiable" value="no" <?php if((isset($can_details->salary_negotiable) && $can_details->salary_negotiable=='no')) echo "checked";?> >No</label>
									</div>
								</div>
								</div>
						 	</div>
						 	
						 	<div class="row">
						 		<div class="col-lg-3 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Interested:</label>
								</div>
								</div>
							
								<div class="col-lg-3 col-sm-4 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<label class="form-label"><input type="radio" name="is_interested" value="yes" <?php if((isset($can_details->is_interested	) && $can_details->is_interested	=='yes') )echo "checked";?> checked>Yes</label>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-4 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<label class="form-label"><input type="radio" name="is_interested" value="no" <?php if((isset($can_details->is_interested	) && $can_details->is_interested	=='no')) echo "checked";?>>No</label>
										</div>
									</div>
								</div>
						 	</div>
						 	<div class="row">
						 		<div class="col-lg-3 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Skills:</label>
								</div>
								</div>
							
								<div class="col-lg-9 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control"  type="text" name="skills" id="skills" placeholder="Skills" value="<?php echo (isset($can_details->skills) && !empty($can_details->skills) )? $can_details->skills : ''?>">
										</div>
									</div>
								</div>
						 	</div>
						 	<div class="row">
						 		<div class="col-lg-3 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Total Experience:<span>*</span></label>
								</div>
								</div>
							
								<div class="col-lg-9 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input type="text" name="total_yr_exp" id="total_yr_exp" placeholder="Total Experience (in months only)" class="form-control number req_field" value="<?php echo (isset($can_details->total_yr_exp)) && !empty($can_details->total_yr_exp) ? $can_details->total_yr_exp : ''?>" required data-error="Please Enter Total Experience">
											<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>	
						 	</div>
						 	<div class="row">
						 		<div class="col-lg-3 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Relevant Experience:<span>*</span></label>
								</div>
								</div>
							
								<div class="col-lg-9 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control number req_field" type="text" name="relivant_yr_exp" id="relivant_yr_exp" placeholder="Relevant Experience (in months only)" value="<?php echo (isset($can_details->relivant_yr_exp) && !empty($can_details->relivant_yr_exp) )? $can_details->relivant_yr_exp : ''?>" required data-error="Please Enter Relevant Experience">
											<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>	
						 	</div>
						 	<div class="row">
						 		<div class="col-lg-3 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Current Location:<span>*</span></label>
								</div>
								</div>
							
								<div class="col-lg-9 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<?php if(!empty($this->session->flashdata('places')))
											{
												echo "<select id='places' class='form-control'><option>select</option>";
												foreach (array_unique($this->session->flashdata('places')) as $key => $value) {
													echo "<option>$value</option>";		
												}
												echo "</select>";
											}
											?>
												<input type="text" name="current_location" id="current_location" placeholder="Current Location" class="form-control special_char" value="<?php echo (isset($can_details->current_location)) && !empty($can_details->source) ? $can_details->current_location : ''?>" >
												<div class="help-block with-errors error_msg"></div>
										</div>
									</div>
								</div>
						 	</div>
						 	<?php /*<div class="row">
								<div class="col-lg-3 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Interview Schedule On:</label>
									</div>
								</div>
								<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<input type="text" id="schedule_date" name="schedule_date" value="<?php echo $schedule_date; ?>" class="form-control" data-date-start-date="0d">
								</div>
							</div>
							
							</div>
							<div class="row">
								<div class="col-lg-3 col-sm-3 col-xs-12">
									
								</div>
								<div class="col-lg-6 col-sm-4 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<textarea id="schedule_comment" name="schedule_comment" class="form-control" placeholder="comment here"   ><?php if(isset($candidate_details['schedule_comment'])){ echo $candidate_details['schedule_comment']; } ?></textarea>
										</div>
									</div>
								</div>
					    	</div>*/?>
						 	<div class="row">
								<div class="col-lg-3 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Ready To Relocate</label>
									</div>
								</div>
								<div class="col-lg-3 col-sm-4 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<label class="form-label"><input type="radio" name="ready_to_relocate" value="yes" <?php if((isset($can_details->ready_relocate) && $can_details->ready_relocate=='yes')) {echo "checked";}?> >Yes</label>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-4 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<label class="form-label"><input type="radio" name="ready_to_relocate" value="no" <?php if((isset($can_details->ready_relocate) && $can_details->ready_relocate=='no')){echo "checked";}?> checked>No</label>
										</div>
									</div>
								</div>
					    	</div>
						 </div>
						 <div class="col-lg-6 col-sm-6 col-xs-6 profile_bg">
						 	<?php if($this->session->flashdata('file_type')=='pdf'){ ?>
						 	<iframe src="<?php echo base_url() ?>/ResumeParser/ResumeTransducer/UnitTests/<?php echo $this->session->flashdata('file_name')?>" style="width:100%; height:100%;" frameborder="0"></iframe>
						 	<?php }
						 	else if(!empty($this->session->flashdata('resume_text')) || (isset($can_details->resume_text) && !empty($can_details->resume_text)))
						 	{?>
						 		<textarea name="resume_text" class="form-control" style="height: 100%">
						 			<?php echo $this->session->flashdata('resume_text')." ".$can_details->resume_text; ?>
						 		</textarea>
						 	<?php }
						 	else if(isset($can_details->resume) && !empty($can_details->resume))
						 	{
						 	?>
						 	<iframe src="<?php echo base_url() ?>/ResumeParser/ResumeTransducer/UnitTests/<?php echo $can_details->resume?>" style="width:100%; height:100%;" frameborder="0"></iframe>
						 	<?php
						 	}
						 	?>
						 	<br>
						 	<input type="hidden" name="resume" value="<?php if(!empty($this->session->flashdata('file_name'))){echo $this->session->flashdata('file_name');}?>">
						 </div>

					  </div>
					</div>

					<div class="col-sm-12 col-xs-12 profile_bg">
				    	<div class="row">
							<div class="col-lg-6">
								<button class="btn btn-inline btn-success ladda-button" data-style="expand-left" id="save_profile"><span class="ladda-label">Submit</span>
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
	$('#email_id').blur(function(){
		var email = $('#email_id').val();
		
			$.ajax({
				url: '<?php echo site_url();?>/rpo_interview/check_availability',
				data : {email: email},
				type: 'POST',
				success: function(response){
					if(response==2)
					{
						$('#err_email_exists').addClass('msg_red').html('Please enter email id.');
					}
					else if(response==0)
					{
						$('#err_email_exists').removeClass('msg_green')
						$('#err_email_exists').addClass('msg_red').html('Email Id already exist! Please use another email Id.');
					}
					else
					{
						$('#err_email_exists').addClass('msg_green').html('Email Id is available.');
					 	$('.display_n').removeClass('display_n');
					}
				}
			});
		
	});
		var i = 0;
		var readURL = function(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();

	            reader.onload = function (e) {
	                $('.profile-pic').attr('src', e.target.result);
	            }
	    
	            reader.readAsDataURL(input.files[0]);
	        }
	    }
	    

	    $("#upload").on('change', function(){
	        readURL(this);            
	        if((this.files[0].size/1024/1024)<2)
	        {
				i++;
	        }
	        else
	        {
	        	swal('File Size Must Be Less Than 2 MB',"",'error');
	        	$('#can_information').trigger('reset');
	        }
	       
	    });
	    $.fn.checkFileType = function(options) {
		  	var defaults = {
		    allowedExtensions: [],
		    success: function() {},
		    error: function() {}
		  };
		  options = $.extend(defaults, options);

		  return this.each(function() {

		    $(this).on('change', function() {
		      var value = $(this).val(),
		        file = value.toLowerCase(),
		        extension = file.substring(file.lastIndexOf('.') + 1);

		      if ($.inArray(extension, options.allowedExtensions) == -1) {
		        options.error();
		        $(this).focus();
		      } else {
		        options.success();

		      }

		    });

		  });
		};

	    $('#upload').checkFileType({
	    allowedExtensions: ['doc', 'docx', 'pdf'],
	    success: function() {
	    	if(i == 1)
	    	{
	    		$('#can_name').val('');
		  		$('#can_name,#email_id,#mobile_no,#position,#expected_salary,#total_yr_exp,#relivant_yr_exp').removeAttr('required');
		  		$('#can_name,#email_id,#mobile_no,#expected_salary,#total_yr_exp,#relivant_yr_exp').removeClass('req_field');
		  		$('#save_profile').click();
		  		$('#can_name,#email_id,#mobile_no,#position,#expected_salary,#total_yr_exp,#relivant_yr_exp').attr('required');
		  		$('#can_name,#email_id,#mobile_no,#expected_salary,#total_yr_exp,#relivant_yr_exp').addClass('req_field');
			}
	    },
	    error: function() {
	    	swal('Please Select PDF or DOC File Type',"",'error');
			$('#can_information').trigger('reset');
	    }
	  });
	    
	    $(".upload-button").on('click', function() {
	     
	       // $("#upload").click();

	    });

	    $(".upload-cancel").on('click', function() {
	       //$("#upload").click();

	    });


		$("#search_div").hide();
		// $(".chosen-select").chosen();
		$('#datePicker, #datePicker1, #datePicker2,#schedule_date,#dob').datepicker({
			format: 'dd/mm/yyyy',
			maxDate: new Date()
		});
      $('#datetimepicker1').datetimepicker({
        	//autoclose: true
        //bootcssVer: 3
      });

   	$('input[type=radio][name=is_exist]').change(function()
		{
			if(this.value=='yes'){
				$("#search_div").show();
			}
			else
			{
				$("#search_div").hide();
			}
		});

     $("#email_emp_code").change(function(){ 
     		var email_emp_code = $(this).val();
     		// console.log(email_emp_code);
     		if(email_emp_code!='')
     		{
				$.ajax({
					url: '<?php echo site_url();?>/rpo_interview/get_rpo_details',
					data : {search_str: email_emp_code},
					type: 'POST',
					dataType:"json",
					success: function(response)
					{
						console.log(response);
						if(response!=null)
						{
							$('#err_empcode').html('').hide();
							$('#intw_can_id').val(response.intw_can_id);
							$('#can_name').val(response.can_name);
							$('#email_id').val(response.email_id);
							$('#mobile_no').val(response.phone1);
							$('#alternate_no').val(response.phone2);
							$('#position').val(response.designation);
							$('#source').val(response.source);
							$('#expected_salary').val(response.expected_salary);
							$('#salary_negotiable').val(response.salary_negotiable);
							$('#is_interested').val(response.is_interested);
							$('#skills').val(response.skills);
							$('#total_yr_exp').val(response.total_yr_exp);
							$('#relivant_yr_exp').val(response.relivant_yr_exp);
							$('#current_location').val(response.current_location);
							$('#ready_to_relocate').val(response.ready_to_relocate);	
						}
						else
						{
							$("#intw_can_id,#can_name,#email_id,#mobile_no,#alternate_no,#position,#source,#expected_salary,#skills,#total_yr_exp,#relivant_yr_exp,#current_location").val("");
							$('#err_empcode').html('No record found!').show();
						}
						
					}			
				});
     		}
     });

	/*$("#upload").change(function()
	{
  		$('#can_name').val('');
  		$('#can_name,#email_id,#mobile_no,#position,#expected_salary,#total_yr_exp,#relivant_yr_exp').removeAttr('required');
  		$('#can_name,#email_id,#mobile_no,#expected_salary,#total_yr_exp,#relivant_yr_exp').removeClass('req_field');
  		$('#save_profile').click();
  		$('#can_name,#email_id,#mobile_no,#position,#expected_salary,#total_yr_exp,#relivant_yr_exp').attr('required');
  		$('#can_name,#email_id,#mobile_no,#expected_salary,#total_yr_exp,#relivant_yr_exp').addClass('req_field');
  	});*/
  	$("#Mobile").change(function() {
  		//alert();
  		number=$("#Mobile option:selected").text();
  		if(number!='select')
  		{
			$('#mobile_no').val(number);
  		}
  	}); 

  	$("#places").change(function() {
  		//alert();
  		location1=$("#places option:selected").text();
  		if(location1!='select')
  		{
			$('#current_location').val(location1);
  		}
  	}); 
	$("#phone2").blur(function() {
  		if($('#phone1').val() == $('#phone2').val())
			{
			$('#phone2_err').text("Mobile number and Alternate number must not be same").show().delay(2000).fadeOut(1000);
				event.preventDefault();
				$('#save_profile').attr('disabled', true);
			}
		else
		{
			$('#save_profile').removeAttr('disabled');
		}
	});

	$("#phone1").blur(function(){
  		if($('#phone1').val() == $('#phone2').val())
			{
			$('#phone1_err').text("Mobile number and Alternate number must not be same").show().delay(2000).fadeOut(1000);
				event.preventDefault();
				$('#save_profile').attr('disabled', true);
			}
		else
		{
			$('#save_profile').removeAttr('disabled');
		}
	});
});
</script>