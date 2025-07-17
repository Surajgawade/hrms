<div class="page-content">
	<div class="container-fluid">
		
	<div class="col-sm-12 well">
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="add_clearance" action=" " method="post">
				<h1 class="well headline">Travel Clearance Form</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">

						<?php if(($travel_details->status == 'claimed') || ($travel_details->status == 'approved')) { ?>

							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Candidate Name</label>
									</div>
								</div>
							
								<div class="col-lg-10">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Enter Travel Purpose" type="text" value="<?php echo $can_details->can_name; ?>" disabled>
											<i class="fa fa-user"></i>
											<input type="hidden" name="can_id" value="<?php echo @$can_details->can_id; ?>">
											<input type="hidden" name="tv_id" value="<?php echo @$travel_details->tv_id; ?>">
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Travel Purpose</label>
									</div>
								</div>
							
								<div class="col-lg-10">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Enter Travel Purpose" value="<?php echo $travel_details->purpose; ?>" type="text" disabled>
											<i class="fa fa-user"></i>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
	                            <div class="col-lg-2">
	                                <div class="form-group">
	                                    <label class="form-label">From Date</label>
	                                </div>
	                            </div>
	                
	                            <div class="col-lg-4">
	                                <div class="date form-group">
	                                    <div class="input-group input-append date" id="datePicker">
	                                        <input type="text" class="form-control" placeholder="DD/MM/YYYY" disabled value="<?php echo $travel_details->from_date; ?>"/>
	                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
	                                    </div>
	                                </div>
	                            </div>

	                            <div class="col-lg-2">
	                                <div class="form-group">
	                                    <label class="form-label">To Date</label>
	                                </div>
	                            </div>
	                
	                            <div class="col-lg-4">
	                                <div class="date form-group">
	                                    <div class="input-group input-append date" id="datePicker">
	                                        <input type="text" class="form-control" placeholder="DD/MM/YYYY" disabled value="<?php echo $travel_details->to_date; ?>"/>
	                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
	                                    </div>
	                                </div>
	                            </div>
							</div>
							
	                        <div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Travel Budget</label>
									</div>
								</div>
							
								<div class="col-lg-10">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Travel Amount" value="<?php echo $travel_details->budget; ?>" type="text" disabled>
											<i class="fa fa-user"></i>
										</div>
									</div>
								</div>
							</div>

	                        <div class="row">
	                            <div class="col-lg-2">
	                                <div class="form-group">
	                                    <label class="form-label">Details</label>
	                                </div>
	                            </div>
	                    
	                            <div class="col-lg-10">
	                                <div class="form-group">
	                                    <div class="form-control-wrapper form-control-icon-right">
	                                        <textarea class="form-control col-md-12" rows="3" disabled><?php echo $travel_details->details; ?></textarea>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-lg-12">
	                                <input type="checkbox" name="travel" value="clear">I get clearance from the accounts and received same amount as exepnced & claimed during the prupose of travel on duty.
	                            </div>
	                        </div>
	                        <br/>
							<div class="row">
								<div class="col-lg-6">
									<button type="button" id="submit_travel" class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label">Submit</span>
									<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
								
									<button type="button" id="reset_form" class="btn btn-inline ladda-button" data-style="expand-left"><span class="ladda-label">Reset</span>
									<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
								</div>
							</div>

					<?php } else { ?>

						<div class="row">
							<span class="h1 text-center text-danger">This travel either not approved or not claimed.</span>
						</div>

					<?php } ?>
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
});

$('#submit_travel').click(function (e) {       
    e.preventDefault();
    var fdata = $('#add_clearance').serialize();
    $.ajax({
        url: '<?php echo site_url();?>/travel_management/add_travel_clearance',
        dataType :"json",
        async:false,
        data : fdata,
        type: 'POST',
        success: function(response)
        {
            $.notify({
                type: 'success',
                title: "<strong>Success:</strong> ",
                message: "Travel details updated successfully!",
                delay: 2000,
                animate:{
                    enter: "animated fadeInUp",
                    exit: "animated fadeOutDown"
                }
            });
        }
    });
    /*document.getElementById("submit_travel").reset();
    oTable.draw();*/
    // window.setTimeout(function(){location.reload()},3000);
});

$('#reset_form').on('click', function() {
    document.getElementById("add_travel").reset();
});
</script>