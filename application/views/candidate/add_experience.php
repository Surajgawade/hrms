<div class="page-content">
	<div class="container-fluid">
	<div class="well">
		<?php $this->load->view('candidate/can_menu');?>
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="experience_form" action=" " method="post">
				<h1 class="well headline">Add Experience Details </h1>
				<input type="hidden" name="exp_id" id="exp_id" value="">				
				<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Employee Name</label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<label class="form-label name_lable"><?php echo $can_details->can_name;?></label>
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
										<input required="" class="form-control" placeholder="Your Company Name" type="text" name="company_name" id="company_name">
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
									<input type="text" class="form-control" name="working_from" id="working_from" placeholder="MM/YYYY" required/>
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
						
							<div class="col-lg-4 col-sm-9 col-xs-12" >
								<div class="date form-group">
									<div class="input-group input-append date" id="datePicker1">
										<input type="text" class="form-control" name="working_to" id="working_to" placeholder="MM/YYYY" required />
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
											<option value="<?php echo $profile->id; ?>"><?php echo $profile->title?></option>
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
										<input class="form-control number" maxlength="8" placeholder="CTC" type="text" name="ctc" id="ctc">
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
										<textarea placeholder="Reason For Leaving" rows="3" class="form-control" name="reason" id="reason"></textarea>
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
										<textarea placeholder="Roles &amp; Responsibilites" rows="3" class="form-control" name="roles" id="roles"></textarea>
										<i class="fa fa-address-card"></i>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-6">
							<input id="submit_expr" type="button" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
							<input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
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


	//$('#working_to').monthpicker(options);
		$('#datePicker,#datePicker1').datepicker({
		   format: 'mm/yyyy',
		   // You used '+0d' that is for days instead of '+0m' that is for months.
		   endDate: '+0m',
		   viewMode: "months", 
		   minViewMode: "months",
		   autoclose: true,
		   maxDate: new Date()
		});

	$('#datePicker').on('changeDate', function(e) {
		$('#datePicker1').datepicker('setStartDate', $('#working_from').val());
	});
	$('#datePicker1').on('changeDate', function(e) {
		$('#datePicker').datepicker('setEndDate', $('#working_to').val());
	});
	


   $('#submit_expr').click(function (e) {		
		var can_id = '<?php echo $this->uri->segment(3);?>';
		var exp_id= $('#exp_id').val();		
		var company_name = $('#company_name').val();
		var working_from= $('#working_from').val();
		var working_to = $('#working_to').val();
		var designation= $('#designation').val();
		var ctc= $('#ctc').val();
		var reason= $('#reason').val();
		var roles= $('#roles').val();
		var date='<?php echo date('m/Y'); ?>';
		to_date=$('#working_to').datepicker('getDate');;
		var diff = get_diff(working_to,working_from);

		function get_diff(start,end)
	   {
	   	    if((start != null) && (end != null))
	        {
	        	var days = (end - start) / (1000 * 60 * 60 * 24);
				return days;	
	        }
	   }

		if($('#company_name').val()=='')
		{
			$('#com_err').text(" Please Enter Company Name").show().delay(2000).fadeOut(800);
		}
		else if($('#working_from').val()=='')
		{
			$('#from_date_err').text(" Please Enter Working from Date").show().delay(2000).fadeOut(800);
		}
		/*else if($('#working_from').val()>date)
		{
			$('#from_date_err').text(" Please Select valid Working from Date").show().delay(2000).fadeOut(800);
		}*/
		else if($('#working_to').val()=='')
		{
			$('#to_date_err').text(" Please Enter Working to Date").show().delay(2000).fadeOut(800);
		}
		/*else if($('#working_to').val()>date)
		{
			$('#to_date_err').text(" Please Select valid Working to Date").show().delay(2000).fadeOut(800);
		}*/

		else if(diff<0)
		{
			$('#to_date_err').text(" From Date Must Be Less Than To Date").show().delay(2000).fadeOut(800);
		}
		else if($('#designation').val()=='')
		{
			$('#des_err').text(" Please Enter Designation").show().delay(2000).fadeOut(800);
		}
		else
		{
			$('#submit_expr').attr('disabled',true);
			$.ajax({
				url: '<?php echo site_url();?>/candidate/save_experience',
				data : {can_id: can_id, exp_id :exp_id, company_name: company_name, working_from:working_from, working_to:working_to,ctc:ctc, designation:designation, leaving_reason:reason, roles:roles},
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

   
	

</script>