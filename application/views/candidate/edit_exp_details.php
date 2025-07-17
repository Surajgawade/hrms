<div class="page-content">
	<div class="container-fluid">
	<div class="col-sm-12 well">
		<?php $this->load->view('candidate/can_menu');?>
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="experience_form" action=" " method="post">
				<h1 class="well headline">Edit Experience Details</h1>
				<input type="hidden" name="exp_id" id="exp_id" value="<?php echo $exp_details->exp_id;?>">				
				<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Employee Name</label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">								
									<label class="form-label name_lable"><?php echo (isset($can_details->can_name) && !empty($can_details->can_name)) ? $can_details->can_name :'';?></label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Company Name <span>*</span> </label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input required="" class="form-control" placeholder="Your Company Name" type="text" name="company_name" id="company_name" value="<?php echo (isset($exp_details->company_name) && !empty($exp_details->company_name)) ? $exp_details->company_name :'';?>">
										<i class="fa fa-user"></i>
											<span class="error_msg" id ="com_err"></span>
									</div>
								</div>
							</div>
						</div>
										
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Working from Date <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
       						<div class="date form-group">
								<div class="input-group input-append date" id="datePicker">
									<input type="text" class="form-control" name="working_from" id="working_from" placeholder="MM/YYYY" value="<?php echo (isset($exp_details->working_from) && !empty($exp_details->working_from)) ? format_date_my($exp_details->working_from) :'';?>" />
									<span class="input-group-addon add-on"><span  id="demo-1-button" class="glyphicon glyphicon-calendar"></span></span>
								</div>
											<span class="error_msg" id ="from_date_err"></span>
							</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Working To Date <span>*</span> </label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="date form-group">
									<div class="input-group input-append date" id="datePicker1">
										<input type="text" class="form-control" name="working_to" id="working_to" placeholder="MM/YYYY"  value="<?php echo (isset($exp_details->working_to) && !empty($exp_details->working_to)) ? format_date_my($exp_details->working_to) :'';?>"/>
										<span class="input-group-addon add-on"><span   id="demo-2-button" class="glyphicon glyphicon-calendar"></span></span>
									</div>
											<span class="error_msg" id ="to_date_err"></span>
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
										<select required="" id="designation" name="designation" class="web col-sm-12">
											<?php foreach ($job_profiles as $profile) {?>											
											<option value="<?php echo $profile->id?>" <?php echo ($profile->id == $exp_details->designation) ? 'selected' : ''; ?>><?php echo $profile->title?></option>
											<?php } ?>
										</select>
											<span class="error_msg" id ="des_err"></span>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">CTC Per Year</label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="CTC" type="text" name="ctc" id="ctc" value="<?php echo (isset($exp_details->ctc) && !empty($exp_details->ctc)) ? $exp_details->ctc :'';?>">
										<i class="fa fa-user"></i>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Reason For Leaving the Job </label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea placeholder="Reason For Leaving" rows="3" class="form-control" name="reason" id="reason" ><?php echo !empty($exp_details->leaving_reason) ? $exp_details->leaving_reason : '';?></textarea>
										<i class="fa fa-address-card"></i>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Roles &amp; Responsibilites </label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<textarea placeholder="Roles &amp; Responsibilites" rows="3" class="form-control"  name="roles" id="roles"><?php echo !empty($exp_details->responsibilities) ? $exp_details->responsibilities : '';?></textarea>
										<i class="fa fa-address-card"></i>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-6">
							<input id="submit_expr" type="button" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
							<!-- <input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset"> -->
							<!-- <input type="button" class="btn btn-inline ladda-button" data-style="expand-left" value="Add New"> -->
							</div>
						</div>	
					

					</div>
			</form> 
		</div>
	</div>
</div>
</div>
<script type="text/javascript" src="<?php echo assets_url();?>js/lib/bootstrap-datepicker/js/jquery.mtz.monthpicker.js"></script>

<script type="text/javascript">
	$('#working_from, #working_to').monthpicker({
		pattern: 'mm/yyyy', 
		selectedYear: 2017
	});
	var options = {
		selectedYear: 2017,
		startYear: 2008,
		finalYear: 2212,
		openOnFocus: false // Let's now use a button to show the widget
	};

	$('#working_to').monthpicker(options);
	$('#working_from').monthpicker().bind('monthpicker-change-year', function (e, year)
	{
	});

	$('#demo-1-button').bind('click', function () {
	   $('#working_from').monthpicker('show');
	});
	$('#demo-2-button').bind('click', function () {
	   $('#working_to').monthpicker('show');
	});

   $('#submit_expr').click(function (e) {		
		e.preventDefault();
		//var can_id = '<?php //echo $this->uri->segment(3);?>';
		<?php $total = $this->uri->total_segments();
		$last = $this->uri->segment($total);?>
		var can_id = '<?php echo $last;?>';
		var exp_id= $('#exp_id').val();		
		var company_name = $('#company_name').val();
		var working_from= $('#working_from').val();
		var working_to = $('#working_to').val();
		var designation= $('#designation').val();
		var ctc= $('#ctc').val();
		var reason= $('#reason').val();
		var roles= $('#roles').val();
	
		if($('#company_name').val()=='')
		{
			$('#com_err').text(" Please Enter Company Name").show().delay(2000).fadeOut(800);
	        event.preventDefault();
		}
		else if($('#working_from').val()=='')
		{
			$('#from_date_err').text(" Please Enter Working from Date").show().delay(2000).fadeOut(800);
	        event.preventDefault();
		}else if($('#working_to').val()=='')
		{
			$('#to_date_err').text(" Please Enter Working to Date").show().delay(2000).fadeOut(800);
	        event.preventDefault();
		}
		else if($('#designation').val()=='')
		{
			$('#des_err').text(" Please Enter Designation").show().delay(2000).fadeOut(800);
	        event.preventDefault();
		}
		else
		{
			$('#submit_expr').attr('disabled',true);
			$.ajax({
				url: '<?php echo site_url();?>/candidate/save_experience',
				data : {can_id: can_id, exp_id :exp_id, company_name: company_name, working_from:working_from, working_to:working_to,designation:designation,ctc:ctc, leaving_reason:reason, roles:roles},
				type: 'POST',
				success: function(response){
					$.notify({
								title: "<strong>Success:</strong> ",
								message:"Experience Details Saved Successfully!",
								
							},{
							type: "success",
							delay: 800,
								animate:{
									enter: "animated fadeInUp",
									exit: "animated fadeOutDown"
								} 
						});	
						setTimeout(function () {
						window.location.href = '<?php echo site_url();?>/candidate/experience/'+can_id;
    				}, 2000);	
	   			}
			});
		}
	});

   $('#working_from').on('change', function(e) {
        var start = $(this).monthpicker('getDate');
        var end = $('#working_to').monthpicker('getDate');
        if((start != null) && (end != null))
        {
	        var days = (end - start) / (1000 * 60 * 60 * 24);
	        if(days <= 0)
	        {
	            $.notify({
	                title: "<strong>Warning</strong>",
	                message: "Please Select Correct Date",
	                
	            },
	            {
	                type: 'warning',
	                delay: 800,
	                animate:{
	                    enter: "animated fadeInUp",
	                    exit: "animated fadeOutDown"
	                } 
	            });
	            $('#submit_expr').attr('disabled',true);
	        }
	        else
	        {
	        	$('#submit_expr').removeAttr('disabled');
	        }
	    }
	    else
	    {
	    	$('#submit_expr').attr('disabled',true);
	    }
    });

    $('#working_to').on('change', function(e) {
        var start = $('#working_from').monthpicker('getDate');
        var end = $(this).monthpicker('getDate');
        if((start != null) && (end != null))
        {
	        var days = (end - start) / (1000 * 60 * 60 * 24);
	        if(days <= 0)
	        {
	            $.notify({
	                title: "<strong>Warning</strong>",
	                message: "Please Select Correct Date",
	                
	            },
	            {
	                type: 'warning',
	                delay: 800,
	                animate:{
	                    enter: "animated fadeInUp",
	                    exit: "animated fadeOutDown"
	                } 
	            });
	            $('#submit_expr').attr('disabled',true);
	        }
	        else
	        {
	        	$('#submit_expr').removeAttr('disabled');
	        }
	    }
	    else
	    {
	    	$('#submit_expr').attr('disabled',true);
	    }
    });

</script>