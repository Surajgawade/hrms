<div class="page-content">
	<div class="container-fluid">
		<?php $this->load->view('rpo_manager/rpo_emp_menu');?>
	<div class="well">
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="frmcan_insurance_details" action="" method="post">
				<input type="hidden" name="insurance_id" id="insurance_id" value="<?php echo (isset($can_insurance_details['insurance_id']) && !empty($can_insurance_details['insurance_id'])) ? $can_insurance_details['insurance_id']: '';?>">
				<h1 class="well headline">Insurance Details</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Employee Name </label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Your Full Name" type="text" name="can_name" id="can_name" required value=" <?php echo (isset($can_insurance_details->can_name) && !empty($can_insurance_details->can_name)) ? $can_insurance_details->can_name : $can_details->can_name;?>" readonly required>
										<i class="fa fa-user"></i>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Joining Date </label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" class="form-control" name="joining_date" id="joining_date" placeholder="dd/mm/yyyy" value="<?php echo (isset($can_details->joining_date) && !empty($can_details->joining_date)) ? format_date($can_details->joining_date) : ''?>" required readonly>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Insurance Company Name <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select class="chosen-select web col-lg-12" placeholder="Insurance Company Name" type="text" name="ins_comp_name" id="ins_comp_name" required>
											<?php if(!empty($company_details)){
												foreach($company_details as $key => $value) { ?>
												<option value="<?php echo $value['ic_id']; ?>" <?php echo ($value['ic_id'] == $can_insurance_details['ins_comp_name']) ? "selected" : ""; ?>><?php echo $value['name']; ?></option>
											<?php } }?>
										</select>
										<span class="error_msg" id ="c_name_err"></span>
										<!--  value="<?php //echo (isset($can_insurance_details->ins_comp_name) && !empty($can_insurance_details->ins_comp_name)) ? $can_insurance_details->ins_comp_name : ''?>" -->
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Policy Number <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Insurance Policy Number" type="text" name="policy_no" id="policy_no" value="<?php echo (isset($can_insurance_details['policy_no']) && !empty($can_insurance_details['policy_no'])) ? $can_insurance_details['policy_no'] : ''?>" required maxlength="20">
										<span class="error_msg" id ="p_no_err"></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Insurance Start Date <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="date form-group">
									<div class="input-group input-append date" id="datePicker">
										<input type="text" class="form-control col-md-12 " name="ins_start_date" id="ins_start_date" placeholder="DD/MM/YYYY" value="<?php echo (isset($can_insurance_details['ins_start_date']) && !empty($can_insurance_details['ins_start_date'])) ? format_date($can_insurance_details['ins_start_date']) : ''?>" required>
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								<span class="error_msg" id ="s_date_err"></span>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Insurance Expiry Date <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="date form-group">
									<?php /*<div class="input-group input-append date" id="datePicker1">
										<input type="text" class="form-control col-md-12 "  name="ins_expire_date" id="ins_expire_date" placeholder="DD/MM/YYYY" value="<?php echo (isset($can_insurance_details->ins_expire_date) && !empty($can_insurance_details->ins_expire_date)) ? format_date($can_insurance_details->ins_expire_date) : ''?>" required readonly>
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>*/?>
									<div class="input-group input-append date">
										<input type="text" class="form-control col-md-12 "  name="ins_expire_date" id="ins_expire_date" placeholder="DD/MM/YYYY" value="<?php echo (isset($can_insurance_details['ins_expire_date']) && !empty($can_insurance_details['ins_expire_date'])) ? format_date($can_insurance_details['ins_expire_date']) : ''?>" required readonly>
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								<span class="error_msg" id ="e_date_err"></span>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Premium Amount <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="premium_amnt" id="premium_amnt" placeholder="Premium Amount" class="form-control number" value="<?php echo (isset($can_insurance_details['premium_amnt'])) && !empty($can_insurance_details['premium_amnt']) ? $can_insurance_details['premium_amnt'] : ''?>" maxlength="8">
										<span class="error_msg" id ="p_amt_err"></span>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Assured Amount <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="assured_amt" id="assured_amt" placeholder="Assured Amount" class="form-control number" value="<?php echo (isset($can_insurance_details['assured_amt'])) && !empty($can_insurance_details['assured_amt']) ? $can_insurance_details['assured_amt'] : ''?>" maxlength="8">
										<span class="error_msg" id ="a_amt_err"></span>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Paid By <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select class="form-control" id="paid_by" name="paid_by" class="web" style="width: 100%">
											  <option value="Company">Company</option>
											  <option value="Employee">Employee</option>
										</select>
										<span class="error_msg" id ="paid_by_err"></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Upload Insurance Document <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-10">
								<section class="proj-page-section">
								<div class="drop-zone">
									<i class="font-icon font-icon-cloud-upload-2"></i>
									<div class="drop-zone-caption">Drag file to upload</div>
									<span class="btn btn-rounded btn-file">
									<span>Choose file</span>
									<input type="file" id="myfile" name="files" accept="text/plain,.pdf,.doc,.docx/*">
									</span>
									<div><span id="uploaded_filename" style="color: #919fa9;"><?php echo (isset($can_insurance_details->ins_doc_name) && !empty($can_insurance_details->ins_doc_name)) ? $can_insurance_details->ins_doc_name : ''?></span>
										<br><span class="error_msg" id ="myfile_err"></span></div>
								</div>
								</section>
							</div>
							<input type="hidden" name="old_ins_doc" id="old_ins_doc" value="<?php echo !empty($can_insurance_details['ins_doc_name']) ? $can_insurance_details['ins_doc_name'] : ''?>">
						</div>
						<?php 

						if(isset($can_insurance_details['ins_doc_name']) && !empty($can_insurance_details['ins_doc_name']) ){?>
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Document</label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<a class="btn btn-success" href="<?php echo base_url('uploads/insurance_doc/').$can_insurance_details['ins_doc_name']; ?>" target="_blank">Download</a>
									</div>
								</div>
							</div>
						</div>
						<?php }?>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								<div class="progress">
								<div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
								</div>
								<div class="msg"></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<input id="save_insurance_details" type="button" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
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
	$(document).ready(function() {
		$(".chosen-select").chosen();
		$('#datePicker').datepicker({
		format: 'dd/mm/yyyy',
		autoclose : true
   		});

		$('#datePicker').on('changeDate', function(e) {
			var d = $('#datePicker').datepicker('getDate');
		    d.setDate(d.getDate() + 364);
			d = convert_date(d);
		    $('#ins_expire_date').val(d);
		});

	});

	$('#myfile').change(function(){
		var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')
		$('#uploaded_filename').html(filename);
	});
	$('#save_insurance_details').click(function (e) {			
		//e.preventDefault();
		$('.myprogress').css('width', '0');
		$('.msg').text('');
		//var filename = $('#document_name').val();
		var myfile = $('#myfile').val();
		var can_id = '<?php echo $this->uri->segment(3)?>';
		var prev_file = $('#old_ins_doc').val();
		if($('#ins_comp_name').val()=='')
		{
			$('#c_name_err').text(" Please Enter Insurance Company Name").show().delay(2000).fadeOut(800);
         event.preventDefault();
		}
		else if($('#policy_no').val()=='')
		{
			$('#p_no_err').text(" Please Enter Policy Number").show().delay(2000).fadeOut(800);
         event.preventDefault();
		}
		else if($('#ins_start_date').val()=='')
		{
				$('#s_date_err').text(" Please Enter Insurance Start Date").show().delay(2000).fadeOut(800);
			event.preventDefault();
		}
		else if($('#ins_expire_date').val()=='')
		{
				$('#e_date_err').text(" Please Enter Insurance Expiry Date").show().delay(2000).fadeOut(800);
			event.preventDefault();
		}
		else if($('#premium_amnt').val()=='' || $('#premium_amnt').val()<=0)
		{
			$('#p_amt_err').text(" Please Enter Premium Amount").show().delay(2000).fadeOut(800);
         event.preventDefault();
		}
		else if($('#assured_amt').val()=='' || $('#assured_amt').val()<=0)
		{
			$('#a_amt_err').text(" Please Enter Assured Amount").show().delay(2000).fadeOut(800);
         event.preventDefault();
		}
		else if($('#paid_by').val()=='')
		{
			$('#paid_by_err').text(" Please Select Paid By").show().delay(2000).fadeOut(800);
         event.preventDefault();
		}
		else if((myfile == '') && (prev_file == '')) 
		{
				$('#myfile_err').text(" Please Choose File").show().delay(2000).fadeOut(800);
            event.preventDefault();
				// alert('Please  select file');
				return;
		}
		else
		{
		
		var formData = new FormData();
		formData.append('myfile', $('#myfile')[0].files[0]);
		formData.append('ins_start_date', $('#ins_start_date').val());
		formData.append('ins_expire_date', $('#ins_expire_date').val());
		formData.append('paid_by', $('#paid_by').val());
		formData.append('premium_amnt', $('#premium_amnt').val());
		formData.append('assured_amt', $('#assured_amt').val());
		formData.append('ins_comp_name', $('#ins_comp_name').val());
		formData.append('policy_no', $('#policy_no').val());
		formData.append('old_ins_doc', $('#old_ins_doc').val());
		formData.append('insurance_id', $('#insurance_id').val());
		// formData.append('filename', filename);
		formData.append('can_id', can_id);
		$('#save_insurance_details').attr('disabled', 'disabled');
		$('.msg').text('Uploading in progress...');
		$.ajax({
			url: '<?php echo site_url();?>/rpo_manager/upload_insurance_details',
			data: formData,
			processData: false,
			contentType: false,
			dataType:"json",
			type: 'POST',
			// this part is progress bar
			xhr: function () {
			var xhr = new window.XMLHttpRequest();
			xhr.upload.addEventListener("progress", function (evt) {
				if (evt.lengthComputable) {
					var percentComplete = evt.loaded / evt.total;
					percentComplete = parseInt(percentComplete * 100);
					$('.myprogress').text(percentComplete + '%');
					$('.myprogress').css('width', percentComplete + '%');
					/*alert(percentComplete);
					if(percentComplete==100+ '%')
					{
						$('.msg').text('');
						$('.msg').text('File Uploaded.....');
					}*/
				}
			}, false);
			return xhr;
			},
			success: function (response)
			{
				var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Insurance Details Updated Successfully!';
							title ='Success:';
						}
						else if(response==2)
						{
							type ='danger';
							message ='Failed to Update';
							title ='Oops:';

						}
						else if(response==3)
						{
							type ='warning';
							message ='File Size Max 2 MB';
							title ='Warning:';

						}
						else if(response==4)
						{
							type ='warning';
							message ='Invalid File Format';
							title ='Warning:';

						}
						else if(response==5)
						{
							type ='success';
							message ='Insurance Details Updated Successfully!';
							title ='Success:';

						}
						$.notify({
								title: "<strong>"+title+"</strong> ",
								message: message,
								
							},{
							type: type,
							delay: 800,
								animate:{
									enter: "animated fadeInUp",
									exit: "animated fadeOutDown"
								} 
						});
				//$('.myprogress').text('');
				//$('.myprogress').css('width', 0);
				//$('.msg').text(response.msg);
				window.setTimeout(function(){
                    window.location.reload();
                },2000);
			}
		});
	}
		// location.reload();
	});

</script>
	