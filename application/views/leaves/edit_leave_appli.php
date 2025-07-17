<div class="page-content">
	<div class="container-fluid">
		<div class="well">
		    <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="leave_application" action=" " method="post">
				<input type="hidden" name="appl_id" id="appl_id" value="<?php echo $leaveappli_details->appl_id?>">
				<h1 class="well headline">Approve Or Reject Leave</h1>
				<div class="col-sm-12 col-xs-12 profile_bg">
			<!-- 	<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label class="form-label">Employee Name</label>
						</div>
					</div>
				
					<div class=col-lg-10>
						<div class="form-group">
							<div class="form-control-wrapper form-control-icon-right">
								<input class="form-control" placeholder="Your Employee Name" type="text" name="user_id" required="" oninvalid="this.setCustomValidity('Please Enter valid ID')" oninput="setCustomValidity('');">
								<i class="fa fa-user"></i>
							</div>
						</div>
					</div>
				</div> -->
			<?php if($this->session->flashdata('success')){?>
				<div class="alert alert-success alert-no-border alert-close alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<?php echo $this->session->flashdata('success');?>
				</div>
				<?php }?>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label class="form-label">Leave From Date</label>
						</div>
					</div>
				
					<div class="col-lg-4">
					<div class="date form-group">
						<div class="input-group input-append date" id="datePicker">
							<input type="text" class="form-control" name="from_date" id="from_date" placeholder="DD/MM/YYYY" value="<?php echo format_date($leaveappli_details->from_date);?>" readonly/>
							<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>
					</div>
					</div>	
				</div>
				
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label class="form-label">Leave From To</label>
						</div>
					</div>
				
					<div class="col-lg-4">
						<div class="date form-group">
							<div class="input-group input-append date" id="datePicker1">
								<input type="text" class="form-control" name="to_date" id="to_date" placeholder="DD/MM/YYYY" value="<?php echo format_date($leaveappli_details->to_date);?>" readonly />
								<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
						</div>
					</div>
				</div>	
				
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label class="form-label">Reason For Leave</label>
						</div>
					</div>
				
					<div class=col-lg-10>
						<div class="form-group">
							<div class="form-control-wrapper form-control-icon-right">
								<textarea placeholder="Reason For Leave" name="reason" id="reason" rows="2" class="form-control" required="" oninvalid="this.setCustomValidity('Please Enter Reason for Leaving')" oninput="setCustomValidity('');" readonly><?php echo $leaveappli_details->reason?></textarea>
								<i class="fa fa-address-card"></i>
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
								<input type="text" placeholder="+91 -" class="form-control" required="" oninvalid="this.setCustomValidity('Please Enter valid Mobile No.')" oninput="setCustomValidity('');" name="mobile_no" id="mobile_no" value="<?php echo $leaveappli_details->mobile_no?>" readonly>
								<i class="fa fa-mobile"></i>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label class="form-label">Alternate Number</label>
						</div>
					</div>
				
					<div class=col-lg-4>
						<div class="form-group">
							<div class="form-control-wrapper form-control-icon-right">
								<input type="text" placeholder="Alternate Number Here.." class="form-control" required="" name="phone_no" id="phone_no" value="<?php echo $leaveappli_details->phone_no?>" readonly>
								<i class="fa fa-phone"></i>
							</div>
						</div>
					</div>
			    </div>
				
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label class="form-label">Leave Address</label>
						</div>
					</div>
				
					<div class=col-lg-10>
						<div class="form-group">
							<div class="form-control-wrapper form-control-icon-right">
								<textarea placeholder="Leave Address" rows="2" class="form-control" required="" name="leave_address" id="leave_address" readonly=""><?php echo $leaveappli_details->reason?></textarea>
								<i class="fa fa-address-card"></i>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label class="form-label">Leave Type</label>
						</div>
					</div>
					<div class=col-lg-10>
						<div class="form-group">
							<div class="select-block1">
								<select required="" name="leave_type" id="leave_type" style="width: 100%" disabled="">
									<option value="" selected disabled>Select Leave Type</option>
									<?php foreach ($leave_types as $type) {?>
										<option value="<?php echo $type->type_id?>" <?php if($type->type_id==$leaveappli_details->leave_type) echo "selected";?>><?php echo $type->leave_title?></option>						
									<?php }?>									
								</select>
							</div>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label class="form-label">Change Leave Status</label>
						</div>
					</div>
					<div class=col-lg-10>
						<div class="form-group">
							<div class="select-block1">
								<select class="status" name="leave_status" id="leave_status" style="width: 100%">
									<option value="" selected disabled>Select Status</option>
									<option value="0" <?php if($leaveappli_details->status==0) echo "selected";?>>Pending</option>
									<option value="1" <?php if($leaveappli_details->status==1) echo "selected";?>>Approved</option>
									<option value="2" <?php if($leaveappli_details->status==2) echo "selected";?>>Rejected</option>								
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label class="form-label">Leave Comment</label>
						</div>
					</div>
				
					<div class=col-lg-10>
						<div class="form-group">
							<div class="form-control-wrapper form-control-icon-right">
								<textarea placeholder="Leave Comment" rows="2" class="form-control" required="" name="leave_comment" id="leave_comment"><?php echo !empty($leaveappli_details->comment) ? $leaveappli_details->comment : '';?></textarea>
								<i class="fa fa-address-card"></i>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-6">
						<input id="change_leave_status" type="button" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
					</div>
				</div>

			</form> 
		    </div>
		</div>
        </div>
</div><!--.page-content-->
<script>
	
$(document).ready(function() {
	/*$('#datePicker, #datePicker1').datepicker({
		format: 'dd/mm/yyyy'
   });*/

	$('#change_leave_status').on('click', function() {
		var selected_status = $('#leave_status').val();
		var comment = $('#leave_comment').val();
		var appl_id = $('#appl_id').val();
		$('#change_leave_status').attr('disabled', true);
		$.ajax({
			url: '<?php echo site_url();?>/leave_management/change_appli_status',
			// dataType :"json",
			data : {appl_id: appl_id,selected_status:selected_status,comment:comment},
			type: 'POST',
			success: function(response){
					// console.log(response);
					// 	var type='' ;
					// 	var message='' ;
					// 	var title='' ;
					// 	if(response==1)
					// 	{
					// 		type ='success';
					// 		message ='Employee Leave Approved!';
					// 		title ='Success';
					// 	}
					// 	else if(response==2) 
					// 	{
					// 		type ='warning';
					// 		message ='Employee Leave Pending!';
					// 		title ='Warning';

					// 	}
					// 	else if(response==3) 
					// 	{
					// 		type ='danger';
					// 		message ='Employee Leave Rejected!';
					// 		title ='Rejected';

					// 	}
						$.notify({
									title: "<strong>Success</strong> ",
									message: "Leave Status Has Been Updated Successfully!",
									
								},{
								type: 'success',
								delay: 800,
									animate:{
										enter: "animated fadeInUp",
										exit: "animated fadeOutDown"
									} 
							});	
					setTimeout(function () {
						window.location.href = '<?php echo site_url();?>/leave_management/leave_request';
    				}, 1000);
			}
		});
	});
});
</script>