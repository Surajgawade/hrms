<?php 
     $userdata = $this->session->userdata('logged_in_user');
?>

<div class="page-content">
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
	<div class="container-fluid">
		<div class="well">
			<div class="row"> 
				<form data-toggle="validator" class="col-sm-12" id="leave_application" action=" " method="post">
					<h1 class="well headline">Leave Application Form</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Leave From Date <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="date form-group">
									<div class="input-group input-append date" id="datePicker" data-date-start-date="0d">
										<input type="text" class="form-control number" name="from_date" id="from_date" placeholder="dd/mm/yyyy" required data-error="Please Enter Leave From Date" >
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
										<div class="help-block with-errors error_msg"></div>
										<span id="error_leaveappl" class="error_msg"></span>
								</div>
							</div>	
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Leave To Date <span>*</span></label>
								</div>
							</div>
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="date form-group">
									<div class="input-group input-append date" id="datePicker1" data-date-start-date="0d">
									<input type="text" class="form-control number" name="to_date" id="to_date" placeholder="dd/mm/yyyy" data-error="Please Enter Leave To Date" required />
									<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
									<div class="help-block with-errors error_msg" id="to_dt"></div>
									<span id="error_leaveappltodate" class="error_msg"></span>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
								<label class="form-label">Reason For Leave <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea placeholder="Reason For Leave" name="reason" id="reason" rows="2" class="form-control" data-error="Please Enter Reason for Leave" required></textarea>
										<i class="fa fa-address-card"></i>
										<div class="help-block with-errors error_msg"></div>										
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
								<label class="form-label">Mobile Number <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="Enter mobile number" class="form-control number"  minlength="10" maxlength="10" required data-error="Please Enter Valid Mobile Number" pattern="^(\+\d{1,3}[- ]?)?\d{10}$" minlength="10" maxlength="10" name="mobile_no" id="mobile_no" value="<?php echo (isset($can_details->phone1) && !empty($can_details->phone1)) ? $can_details->phone1 :'';?>" >
										<i class="fa fa-mobile"></i>
										<div class="help-block with-errors error_msg" id ="phone1_err"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
								<label class="form-label">Alternate Number</label>
								</div>
							</div>

							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" placeholder="Alternate Number Here.." class="form-control number" name="phone_no" id="phone_no" minlength="10" maxlength="10"  value="<?php echo (isset($can_details->phone2) && !empty($can_details->phone2)) ? $can_details->phone2 : '';?>">
										<i class="fa fa-phone"></i>
										<div class="help-block with-errors error_msg" id="phone2_err"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Leave Address</label>
								</div>
							</div>

							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea placeholder="Leave Address" rows="2" class="form-control"  name="leave_address" id="leave_address"></textarea>
										<i class="fa fa-address-card"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
								<label class="form-label">Leave Type <span>*</span></label>
								</div>
							</div>
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="select-block1">
										<select name="leave_type" id="leave_type" style="width: 100%" class="form-control chosen-select" required>
											<optgroup label="Select Leave Type">
											<?php foreach ($leave_types as $type) {?>
											<option value="<?php echo $type->type_id?>"><?php echo $type->leave_title?></option>
										<?php }?>	
										</optgroup>								
										</select>
											<span class="msg_red" id="err_type"></span>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<input id="submit_leave_appli" type="submit" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
								<input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
							</div>
						</div>
					</div>
				</form> 
			</div>
		</div>
	</div>
</div><!--.page-content-->
<script>
	
$(document).ready(function() {
	$(".chosen-select").chosen();
	
	$('#datePicker, #datePicker1').datepicker({
		format: 'dd/mm/yyyy',
			autoclose : true,
			minDate: new Date()
   	});
});

$('#datePicker').on('changeDate', function(e) {
	$('#datePicker1').datepicker('setStartDate', $('#from_date').val());
	var can_id = '<?php echo $userdata['id'];?>';
	var from_date = $('#from_date').val();
	$.ajax({
			url: '<?php echo site_url();?>/leave_management/get_can_leaves',
			data : {can_id: can_id,from_date:from_date },
			type: 'POST',
			success: function(response){		
				if(response==1)
				{
					$('#error_leaveappl').html('You have already applied leave for same date.').show();
					$('#submit_leave_appli').attr('disabled',true);
					// return false;
				}
				else
				{
					$('#submit_leave_appli').removeAttr('disabled');
					$('#error_leaveappl').html('').hide();				
				}
			}
		});
	 var start = $(this).datepicker('getDate');
    var end = $('#datePicker1').datepicker('getDate');
    var days = (end - start) / (1000 * 60 * 60 * 24);
    if(days < 0)
    {
    	$.notify({
            title: "<strong>Warning</strong>",
            message: "Leave from date should be less than Leave to Date",
            
        },
        {
            type: 'warning',
            delay: 800,
            animate:{
                enter: "animated fadeInUp",
                exit: "animated fadeOutDown"
            }
        });
        $('#fr_dt').text("From Date must be less than To Date.").show().delay(2000).fadeOut(800);
        $('#to_date').val('');
    }
});

$('#datePicker1').on('changeDate', function(e) {
	$('#datePicker').datepicker('setEndDate', $('#to_date').val());
	var can_id = '<?php echo $userdata['id'];?>';
	var from_date = $('#to_date').val();
	$.ajax({
			url: '<?php echo site_url();?>/leave_management/get_can_leaves',
			data : {can_id: can_id,from_date:from_date },
			type: 'POST',
			success: function(response){
				if(response==1)
				{
					$('#error_leaveappltodate').html('You have already applied leave for same date.').show().delay(2000).fadeOut(800);
					$('#submit_leave_appli').attr('disabled',true);
					// return false;
				}
				else
				{
					$('#submit_leave_appli').removeAttr('disabled');
					$('#error_leaveappltodate').html('').hide();				
				}
			}
		});
    var start = $('#datePicker').datepicker('getDate');
    var end = $(this).datepicker('getDate');
    var days = (end - start) / (1000 * 60 * 60 * 24);
    if(days < 0)
    {
    	$.notify({
            title: "<strong>Warning</strong>",
            message: "Leave from date should be less than Leave to Date",
            
        },
        {
            type: 'warning',
            delay: 800,
            animate:{
                enter: "animated fadeInUp",
                exit: "animated fadeOutDown"
            }
        });
        $('#fr_dt').text("From Date must be less than To Date.").show().delay(2000).fadeOut(800);
    	  $('#to_date').val('');
    }
});

/*$('#from_date').blur(function(){
	// $(this).val();
	console.log($(this).val());
});*/

$("#phone_no").blur(function() {
	if($('#phone_no').val() != '')
	{
		if($('#phone_no').val() == $('#mobile_no').val())
		{
	    	$('#phone_no').val('');
			$('#phone2_err').text("Mobile number and Alternate number must not be same").show().delay(2000).fadeOut(1000);
		}
		else if(($('#phone_no').val() < 1000000000) || ($('#phone_no').val() > 9999999999) || ($('#phone_no').val() == ''))
	    {
	        $('#phone2_err').text("Please Enter Valid Mobile Number").show().delay(2000).fadeOut(800);
	        $('#submit_leave_appli').attr('disabled', true);
	    }
	    else
	    {
	        $('#submit_leave_appli').removeAttr('disabled');
	    }
	}
});

$("#mobile_no").blur(function() {
	if($('#phone_no').val() == $('#mobile_no').val())
	{
		$('#phone_no').val('');
		$('#phone1_err').text("Mobile number and Alternate number must not be same").show().delay(2000).fadeOut(1000);
	}
	else if(($('#mobile_no').val() < 1000000000) || ($('#mobile_no').val() > 9999999999) || ($('#mobile_no').val() == ''))
    {
        $('#phone1_err').text("Please Enter Valid Mobile Number").show().delay(2000).fadeOut(800);
        $('#submit_leave_appli').attr('disabled', true);
    }
    else
    {
        $('#submit_leave_appli').removeAttr('disabled');
    }
});

 $('#submit_leave_appli').click(function (e) {
 	$('#leave_application').submit();
	$('.btn').attr('disabled', true);
});
</script>
