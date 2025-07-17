<div class="page-content">
	<?php $this->load->view('candidate/can_menu');?>
	<div class="container-fluid p-xl-0">
	<div class="well">
		 <div class="row">
				<form data-toggle="validator" class="col-sm-12" id="reference_form" action=" " method="post">
				<input type="hidden" name="ref_id" id="ref_id" value="<?php echo !empty($ref_details->ref_id) ? $ref_details->ref_id: '';?>">
				<input type="hidden" name="ref_type" id="ref_type" value="<?php echo !empty($ref_details->ref_type) ? $ref_details->ref_type: '';?>">

				<h1 class="well headline">Reference Form</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Candidate Name</label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<label class="form-label name_lable"><?php echo $can_details->can_name;?></label>								
							</div>
						</div>
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Reference Name <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Reference Name" type="text" name="ref_name" id="ref_name" value="<?php echo !empty($ref_details->ref_name) ? $ref_details->ref_name: '';?>" required >
										<i class="fa fa-user"></i>
											<span class="error_msg" id ="ref_name_err"></span>
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
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="email" placeholder="Your Email Address" class="form-control" name="ref_email" id="ref_email"  value="<?php echo !empty($ref_details->ref_email) ? $ref_details->ref_email: '';?>">
										<i class="fa fa-envelope"></i>
											<span class="error_msg" id ="email_err"></span>
									</div>
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Mobile Number </label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="+91 -" class="form-control number" name="ref_mobile" id="ref_mobile" value="<?php echo !empty($ref_details->ref_mobile) ? $ref_details->ref_mobile: '';?>" minlength="10" maxlength="10">
										<i class="fa fa-mobile"></i>
											<span class="error_msg" id ="mob_err"></span>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Alternate Number </label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="Alternate Number Here.." class="form-control number" name="ref_contact" id="ref_contact" value="<?php echo !empty($ref_details->ref_contact) ? $ref_details->ref_contact: '';?>" minlength="10" maxlength="10">
										<i class="fa fa-phone"></i>
									</div>
								</div>
							</div>
					    </div>
									
						
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Designation <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="Reference Designation" class="form-control" name="ref_designation" id="ref_designation"  value="<?php echo !empty($ref_details->ref_designation) ? $ref_details->ref_designation: '';?>">
										<i class="fa fa-rupee"></i>
											<span class="error_msg" id ="des_err"></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Reference Company <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="Reference Company" class="form-control" name="ref_company" id="ref_company"  value="<?php echo !empty($ref_details->ref_company) ? $ref_details->ref_company: '';?>">
										<i class="fa fa-rupee"></i>
											<span class="error_msg" id ="ref_err"></span>
									</div>
								</div>
							</div>
							
					    </div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Reference Experience</label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="Reference Experience" class="form-control" name="ref_experience" id="ref_experience" value="<?php echo !empty($ref_details->ref_experience) ? $ref_details->ref_experience: '';?>"> 
						 			</div>
								</div>
							</div>
							
					    </div>

					    <div class="row">
							<div class="col-lg-6">
								<input id="submit_reference" type="button" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
							<!-- <input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset"> -->
							<!-- <input type="button" class="btn btn-inline ladda-button pull-right" data-style="expand-left" value="Add New"> -->
							</div>							
						</div>

					</div>
			</form> 
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

		$('#datePicker, #datePicker1, #datePicker2')
	        .datepicker({
	            format: 'dd/mm/yyyy'
   	});
 

      $('#submit_reference').click(function (e) {		
			e.preventDefault();
			// var can_id = '<?php //echo $this->uri->segment(3);?>';
			<?php $total = $this->uri->total_segments();
			$last = $this->uri->segment($total);?>
			var can_id = '<?php echo $last;?>';
			var ref_type= $('#ref_type').val();
			var ref_id= $('#ref_id').val();
			var ref_name = $('#ref_name').val();
			var ref_email= $('#ref_email').val();
			var ref_contact = $('#ref_contact').val();
			var ref_mobile = $('#ref_mobile').val();
			var ref_designation = $('#ref_designation').val();
			var ref_company = $('#ref_company').val();
			var ref_experience = $('#ref_experience').val();
		
			if($('#ref_name').val()=='')
			{
			$('#ref_name_err').text(" Please Enter Reference Name").show().delay(2000).fadeOut(800);
				
			}
			else if($('#ref_email').val()=='')
			{
				$('#email_err').text(" Please Enter Valid Email").show().delay(2000).fadeOut(800);
	         	
			}
			else if(!isValidEmailAddress(ref_email))
			{
				$('#email_err').text("Incorrect Email Format").show().delay(2000).fadeOut(800);
		     	 
			}
			else if(ref_mobile.length<10)
			{
				$('#mob_err').text(" Please Enter Valid Mobile No").show().delay(2000).fadeOut(800);
	         		
			}
			else if(ref_contact!='' && ref_contact.length<10)
			{
				$('#contact_err').text(" Please Enter Valid Contact Number").show().delay(2000).fadeOut(800);
	         		
			} 
			else if($('#ref_designation').val()=='')
			{
				$('#amount_err').text(" Please Enter Reference Designation").show().delay(2000).fadeOut(800);
	         }
			else
			{
				$('#submit_reference').attr('disabled',true);
				$.ajax({
					url: '<?php echo site_url();?>/candidate/add_reference_details',
					data : {can_id: can_id, ref_id: ref_id,ref_type:ref_type, ref_name: ref_name,ref_email:ref_email,ref_contact:ref_contact,ref_mobile:ref_mobile,ref_designation:ref_designation,ref_company:ref_company,ref_experience:ref_experience},
					type: 'POST',
					success: function(response){
						$.notify({
								title: "<strong>Success:</strong> ",
								message:"Reference Details Updated Successfully!",
								
							},{
							type: "success",
							delay: 800,
								animate:{
									enter: "animated fadeInUp",
									exit: "animated fadeOutDown"
								} 
						});	
						if(ref_type==0)
						{
							redirect_url = '<?php echo site_url();?>/candidate/reference/'+can_id+'?type='+ref_type;
						}
						else
						{
							redirect_url = '<?php echo site_url();?>/candidate/interview_reference/'+can_id+'?type='+ref_type;
						}
						setTimeout(function () {
						window.location.href = redirect_url;
    				}, 2000);	
		   		}
				});
				document.getElementById("reference_form").reset();
			}
		});
	});
</script>
	