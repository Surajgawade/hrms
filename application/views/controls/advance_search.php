
<div class="page-content">
	<div class="container-fluid">
		
	<div class="well">
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="profile_form" action="" method="post">
				<h1 class="well headline">Advance Search</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Employee Name</label>
								</div>
							</div>
							<div class="col-lg-2 col-sm-9 col-xs-12">									 
									<div class="form-group">
										<select class="col-lg-12">
										  <option value="equal">= Equalto</option>
										  <option value="like">Like</option>
										  <option value="startwith">Start with</option>
										  <option value="endwith">Ends with</option>
										  <option value="endwith">< Greater than</option>
										   <option value="endwith"> > Less than</option>
										 
										</select>
										<span class="error_msg" id="err_date"></span>								
									</div>  
								</div>

							<div class="col-lg-8 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control alpha_only" placeholder="Employee Name" type="text" name="can_name" data-error="Please Enter Your Full Name" value="<?php echo (isset($can_details->can_name) && !empty($can_details->can_name)) ? $can_details->can_name : '';?>" >
										<i class="fa fa-user"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Address </label>
								</div>
							</div>
							<div class="col-lg-2 col-sm-9 col-xs-12">									 
								<div class="form-group">
									<select class="col-lg-12">
									  <option value="equal">= Equalto</option>
									  <option value="like">Like</option>
									  <option value="startwith">Start with</option>
									  <option value="endwith">Ends with</option>
									  <option value="endwith">< Greater than</option>
									   <option value="endwith"> > Less than</option>
									 
									</select>
									<span class="error_msg" id="err_date"></span>								
								</div>  
							</div>

							<div class="col-lg-8 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea placeholder="Address" name="cur_address" id="cur_address" rows="1" class="form-control"  data-error="Please Enter Address" value="<?php echo set_value('cur_address');?>"><?php echo (isset($can_details->cur_address) && !empty($can_details->cur_address)) ? $can_details->cur_address : '';?></textarea>
										<i class="fa fa-address-card"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Email ID </label>
								</div>
							</div>
							<div class="col-lg-2 col-sm-9 col-xs-12">									 
								<div class="form-group">
									<select class="col-lg-12">
									  <option value="equal">= Equalto</option>
									  <option value="like">Like</option>
									  <option value="startwith">Start with</option>
									  <option value="endwith">Ends with</option>
									  <option value="endwith">< Greater than</option>
									   <option value="endwith"> > Less than</option>
									</select>
									<span class="error_msg" id="err_date"></span>								
								</div>  
							</div>

							<div class="col-lg-8 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="email" placeholder="Email Address" class="form-control" name="email" value="<?php echo (isset($can_details->email) && !empty($can_details->email)) ? $can_details->email : '';?>">
										<i class="fa fa-envelope"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Current CTC</label>
								</div>
							</div>
							<div class="col-lg-2 col-sm-9 col-xs-12">									 
									<div class="form-group">
										<select class="col-lg-12">
										  <option value="equal">= Equalto</option>
										  <option value="startwith">Start with</option>
										  <option value="endwith">Ends with</option>
										  <option value="endwith">< Greater than</option>
										   <option value="endwith"> > Less than</option>
										 
										</select>
										<span class="error_msg" id="err_date"></span>								
									</div>  
								</div>

							<div class="col-lg-8 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="current_ctc"  id="current_ctc" placeholder="Current CTC" class="form-control number" value="<?php echo (isset($can_details->current_ctc) && !empty($can_details->current_ctc)) ? $can_details->current_ctc : ''?>">
										<i class="fa fa-rupee"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Phone No.</label>
								</div>
							</div>
							<div class="col-lg-2 col-sm-9 col-xs-12">									 
									<div class="form-group">
										<select class="col-lg-12">
										  <option value="equal">= Equalto</option>
										  <option value="startwith">Start with</option>
										  <option value="endwith">Ends with</option>
										  <option value="endwith">< Greater than</option>
										   <option value="endwith"> > Less than</option>
										 
										</select>
										<span class="error_msg" id="err_date"></span>								
									</div>  
								</div>

							<div class="col-lg-8 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" minlength="10" maxlength="10" name="phone1" id="phone1" placeholder="Mobile Number Here" class="form-control number" value="<?php echo (isset($can_details->phone1) && !empty($can_details->phone1)) ? $can_details->phone1 : '';?>" data-error="Please Enter Your Mobile Number" >
										<i class="fa fa-mobile"></i>
										<div class="help-block with-errors error_msg"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Date of Birth</label>
								</div>
							</div>
							<div class="col-lg-2 col-sm-9 col-xs-12">									 
									<div class="form-group">
										<select class="col-lg-12" id="getFname" onchange="admSelectCheck(this);">
										  <option value="equal">= Equalto</option>
										  <option value="between" id="admOption">Between</option>
										  <option value="startwith">Start with</option>
										  <option value="endwith">Ends with</option>
										  <option value="endwith">< Greater than</option>
										   <option value="endwith"> > Less than</option>
										</select>
										<span class="error_msg" id="err_date"></span>								
									</div>  
								</div>

							<div class="col-lg-4 col-sm-4 col-xs-12">
								<div class="date form-group">
									<div class="input-group input-append date" id="datePicker" data-date-end-date="0d">
										<input type="text" class="form-control" name="joining_to" id="joining_to" placeholder="Joining Date To (dd/mm/yyyy)" value="<?php echo (isset($can_details->blood_group) && !empty($can_details->joining_date)) ? format_date($can_details->joining_date) : ''?>">
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-4 col-xs-12" id="admDivCheck" style="display:none;">
								<div class="date form-group">
									<div class="input-group input-append date" id="datePicker" data-date-end-date="0d">
										<input type="text" class="form-control" name="joining_to" id="joining_to" placeholder="Joining Date To (dd/mm/yyyy)" value="<?php echo (isset($can_details->blood_group) && !empty($can_details->joining_date)) ? format_date($can_details->joining_date) : ''?>">
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Date of Joining</label>
								</div>
							</div>
							<div class="col-lg-2 col-sm-9 col-xs-12">									 
									<div class="form-group">
										<select class="col-lg-12" id="getFname" onchange="admSelect(this);">
										  <option value="equal">= Equalto</option>
										  <option value="between" id="admOpt">Between</option>
										  <option value="startwith">Start with</option>
										  <option value="endwith">Ends with</option>
										  <option value="endwith">< Greater than</option>
										   <option value="endwith"> > Less than</option>
										 
										</select>
										<span class="error_msg" id="err_date"></span>								
									</div>  
								</div>
							<div class="col-lg-4 col-sm-4 col-xs-12">
								<div class="date form-group">
									<div class="input-group input-append date" id="datePicker" data-date-end-date="0d">
										<input type="text" class="form-control" name="joining_to" id="joining_to" placeholder="Joining Date To (dd/mm/yyyy)" value="<?php echo (isset($can_details->blood_group) && !empty($can_details->joining_date)) ? format_date($can_details->joining_date) : ''?>">
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-4 col-xs-12" id="admDivCheckopt" style="display:none;">
								<div class="date form-group">
									<div class="input-group input-append date" id="datePicker2" data-date-end-date="0d">
										<input type="text" class="form-control" name="joining_frm" id="joining_frm" placeholder="Joining Date From (dd/mm/yyyy)" value="<?php echo (isset($can_details->blood_group) && !empty($can_details->joining_date)) ? format_date($can_details->joining_date) : ''?>">
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-4 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select class="chosen-select col-md-12 col-sm-12 col-xs-12 form-control" name="reporting_to" id="reporting_to" >		
										<option value="" selected disabled>Select Reporting To</option>	

										<?php if(isset($candidates)){ foreach ($candidates as $candidate) {?>				
										<option value="<?php echo $candidate->can_id?>" <?php if(isset($can_details->reporting_to) && ($candidate->can_id == $can_details->reporting_to)) echo "selected";?>><?php echo $candidate->can_name?></option>
											<?php }} ?>
										</select>						
									</div>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select multiple="" class="web  chosen-select col-md-12 col-sm-12 col-xs-12 form-control" name="qualification" id="qualification">
										<option value="" selected>Select Education Qualification</option>

										<option value="">Select Education Qualification</option>
										<option value="">Select Education Qualification</option>
											<?php if(!empty($qualifications)){foreach ($qualifications as $qualification) {?>
										
											<option value="<?php echo $qualification->id?>" <?php if((isset($can_details->education) && $qualification->id == $can_details->education)) echo "selected";?>><?php echo $qualification->title?></option>

											<?php } }?>
										</select>									
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-sm-4 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select class="chosen-select col-md-12 col-sm-12 col-xs-12 form-control" name="job_profile" id="job_profile" >
										<option value="" selected="" disabled>Select Designation</option>
										<option value="">UI Developer</option>
										<option value="">PHP Developer</option>
											<?php if(!empty($job_profiles)){ foreach ($job_profiles as $profile) {?>											
											<option value="<?php echo $profile->id?>" <?php if(isset($can_details->job_profile) && $profile->id == $can_details->job_profile) echo "selected";?>><?php echo $profile->title?></option>
											<?php } }?>
										</select>										
									</div>
								</div>
							</div>
						</div>
						
					   	<div class="row">
							<div class="col-lg-12" style="text-align: center;">
								<button class="col-lg-3 col-sm-4 btn btn-inline btn-success ladda-button" data-style="expand-left" id="save_profile">
									<i class="fa fa-search"></i> Search
								</button>
							</div>							
						</div>
					</div>
			</form> 
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$(".chosen-select").chosen();
		$('#datePicker, #datePicker1, #datePicker2').datepicker({
		format: 'dd/mm/yyyy',
		maxDate: new Date()
   });
});
	function admSelectCheck(nameSelect)
{
    if(nameSelect){
        admOptionValue = document.getElementById("admOption").value;
        if(admOptionValue == nameSelect.value){
            document.getElementById("admDivCheck").style.display = "block";
        }
        else{
            document.getElementById("admDivCheck").style.display = "none";
        }
    }
    else{
        document.getElementById("admDivCheck").style.display = "none";
    }
}
function admSelect(nameSelect)
{
    if(nameSelect){
        admOptionValue = document.getElementById("admOpt").value;
        if(admOptionValue == nameSelect.value){
            document.getElementById("admDivCheckopt").style.display = "block";
        }
        else{
            document.getElementById("admDivCheckopt").style.display = "none";
        }
    }
    else{
        document.getElementById("admDivCheckopt").style.display = "none";
    }
}
</script>




