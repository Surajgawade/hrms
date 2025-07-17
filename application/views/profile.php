<div class="page-content">
	<div class="container-fluid">
	
	<div class="col-sm-12">
		<div class="row">
			<div class="menu_btns col-sm-12">
				<a href="<?php echo base_url();?>index.php/bank_details">
					<button type="button" class="btn btn-inline btn-success">Bank Details</button>
				</a>
				<a href="<?php echo base_url();?>index.php/documents">
					<button type="button" class="btn btn-inline btn-success">Documents</button>
				</a>
				<a href="<?php echo base_url();?>index.php/billing">
					<button type="button" class="btn btn-inline btn-success">Billing</button>
				</a>
				<a href="<?php echo base_url();?>index.php/experience">
					<button type="button" class="btn btn-inline btn-success">Experience</button>
				</a>
				<a href="<?php echo base_url();?>index.php/investment">
					<button type="button" class="btn btn-inline btn-success">Investment</button>
				</a>
				<a href="<?php echo base_url();?>index.php/reference">
					<button type="button" class="btn btn-inline btn-success">Reference</button>
				</a>
			</div>
		</div>
	</div>	
	<div class="well">
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="profile_form" action=" " method="post">
				<h1 class="well headline">Candidate Profile Form</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">User ID</label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Your User ID" type="text" name="user_id" required data-error="Please Enter Your Full Name" value="<?php echo !empty($can_details->can_name) ? $can_details->can_name : '';?>">
										<i class="fa fa-user"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Candidate Name</label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control alpha_only" placeholder="Your Full Name" type="text" name="can_name" required data-error="Please Enter Your Full Name">
										<i class="fa fa-user"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Address</label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea placeholder="Your Permanent Address" rows="3" class="form-control" required data-error="Please Enter Your Correspondence Address"  ></textarea>
										<i class="fa fa-address-card"></i>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Email Address</label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="Your Email Address" class="form-control" name="email" required="" oninvalid="this.setCustomValidity('Please Enter valid Email ID')" oninput="setCustomValidity('')">
										<i class="fa fa-envelope"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Date of Birth</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="date form-group">
									<div class="input-group input-append date" id="datePicker">
										<input type="text" class="form-control" name="date" placeholder="dd/mm/yyyy" />
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Mobile Number</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="+91 -" class="form-control" required="" oninvalid="this.setCustomValidity('Please Enter valid Mobile No.')" oninput="setCustomValidity('')">
										<i class="fa fa-mobile"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Phone Number</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="Phone Number Here.." class="form-control" required="" oninvalid="this.setCustomValidity('Please Enter valid Phone No.')" oninput="setCustomValidity('')">
										<i class="fa fa-phone"></i>
									</div>
								</div>
							</div>
					    </div>
									
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Education Qualification</label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select id="job" name="user_job" class="web" required="">
											<optgroup label="Web">
											  <option value="frontend_developer">Bachelor Degree</option>
											  <option value="php_developor">PHP Developer</option>
											  <option value="python_developer">Python Developer</option>
											  <option value="rails_developer"> Rails Developer</option>
											  <option value="web_designer">Web Designer</option>
											  <option value="WordPress_developer">WordPress Developer</option>
											</optgroup>
											<optgroup label="Mobile">
											  <option value="Android_developer">Androild Developer</option>
											  <option value="iOS_developer">iOS Developer</option>
											  <option value="mobile_designer">Mobile Designer</option>
											</optgroup>
											<optgroup label="Business">
											  <option value="business_owner">Business Owner</option>
											  <option value="freelancer">Freelancer</option>
											</optgroup>
											<optgroup label="Other">
											  <option value="secretary">Secretary</option>
											  <option value="maintenance">Maintenance</option>
											</optgroup>
										</select>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Job Role:</label>
								</div>
							</div>
						
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select id="job" name="user_job" class="web" required="">
											<optgroup label="Web">
											  <option value="frontend_developer">Front-End Developer</option>
											  <option value="php_developor">PHP Developer</option>
											  <option value="python_developer">Python Developer</option>
											  <option value="rails_developer"> Rails Developer</option>
											  <option value="web_designer">Web Designer</option>
											  <option value="WordPress_developer">WordPress Developer</option>
											</optgroup>
										</select>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Current CTC</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="Your Current CTC" class="form-control" required="" oninvalid="this.setCustomValidity('Please Enter Current CTC.')" oninput="setCustomValidity('')">
										<i class="fa fa-rupee"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Expected CTC</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="Your Expected CTC" class="form-control" required="" oninvalid="this.setCustomValidity('Please Enter Expected No.')" oninput="setCustomValidity('')">
										<i class="fa fa-rupee"></i>
									</div>
								</div>
							</div>
					    </div>

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Emergency Contact Name</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="Emergency Contact Name" class="form-control" required="" oninvalid="this.setCustomValidity('Please Enter Emergency Name')" oninput="setCustomValidity('')">
										<i class="fa fa fa-phone"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Emergency Contact Number</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="Emergency Contact Number" class="form-control" required="" oninvalid="this.setCustomValidity('Please Enter Emergency Contact No.')" oninput="setCustomValidity('')">
										<i class="fa fa fa-phone"></i>
									</div>
								</div>
							</div>
					    </div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Adhaar Card No.</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="Adhaar Card No." class="form-control" required="" oninvalid="this.setCustomValidity('Please Enter valid Adhaar No.')" oninput="setCustomValidity('')">
										<i class="font-icon font-icon-doc"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Pan Card No.</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="Pan Card No." class="form-control" required="" oninvalid="this.setCustomValidity('Please Enter valid Pan No.')" oninput="setCustomValidity('')">
										<i class="font-icon font-icon-doc"></i>
									</div>
								</div>
							</div>
					    </div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Blood Group</label>
								</div>
							</div>
						
							<div class=col-lg-4>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="Blood Group" class="form-control" required="">
										<i class="fa fa-eyedropper"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label" required="">Ready to Relocate :</label>
								</div>
							</div>
						
							<div class=col-lg-2>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label" required=""><input type="radio" name="optradio">Yes</label>
									</div>
								</div>
							</div>
							<div class=col-lg-2>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><input type="radio" name="optradio">No</label>
									</div>
								</div>
							</div>
					    </div>

						<div class="row">
							<div class="col-lg-6">
								<button class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label">Submit</span>
								<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
							
								<button class="btn btn-inline ladda-button" data-style="expand-left"><span class="ladda-label">Reset</span>
								<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
							</div>
							
						</div>

					</div>
			</form> 
		</div>
	</div>
</div>
</div>


<script>
	
$(document).ready(function() {
    $('#datePicker')
        .datepicker({
            format: 'dd/mm/yyyy'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#eventForm').formValidation('revalidateField', 'date');
        });

    $('#eventForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
           
            date: {
                validators: {
                    notEmpty: {
                        message: 'The date is required'
                    },
                    date: {
                        format: 'DD/MM/YYYY',
                        message: 'The date is not a valid'
                    }
                }
            }
        }
    });
});
</script>