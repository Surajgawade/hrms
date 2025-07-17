<div class="page-content">
	<div class="container-fluid">
		<?php $this->load->view('candidate/can_menu');?>
	<div class="well">
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="frmcan_bank_details" action="" method="post">
				<input type="hidden" name="bd_id" id="bd_id" value="<?php echo (isset($can_bank_details->bd_id) && !empty($can_bank_details->bd_id)) ? $can_bank_details->bd_id: '';?>">
				<h1 class="well headline">Bank Details</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Employee Name <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Your Full Name" type="text" name="can_name" id="can_name" required value=" <?php echo (isset($can_bank_details->can_name) && !empty($can_bank_details->can_name)) ? $can_bank_details->can_name : $can_details->can_name;?>" readonly>
										<i class="fa fa-user"></i>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Bank Name <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Your Bank Name" type="text" name="bank_name" id="bank_name" value="<?php echo (isset($can_bank_details->bank_name) && !empty($can_bank_details->bank_name)) ? $can_bank_details->bank_name : ''?>" required>
										<i class="fa fa-address-card"></i>
					<span class="error_msg" id ="b_name_err"></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Branch Name</label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Your Branch Name" type="text" name="branch_name" id="branch_name" value="<?php echo (isset($can_bank_details->branch) && !empty($can_bank_details->branch)) ? $can_bank_details->branch : ''?>">
										<i class="fa fa-address-card"></i>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Account Number <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" minlength="6" maxlength="15" placeholder="Your Account No." type="text" name="account_number" id="account_number" required  value="<?php echo (isset($can_bank_details->account_number) && !empty($can_bank_details->account_number)) ? $can_bank_details->account_number : ''?>">
										<i class="fa fa-address-card"></i>
										<span class="error_msg" id ="acc_err"></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">IFSC Code <span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control special_char uppercase" minlength="11" maxlength="11" placeholder="Bank IFSC Code" type="text" name="IFSC_code" id="IFSC_code" required value="<?php echo (isset($can_bank_details->ifsc) && !empty($can_bank_details->ifsc)) ? $can_bank_details->ifsc:''?>">
										<i class="fa fa-address-card"></i>
										<span class="error_msg" id ="ifsc_err"></span>
									</div>
								</div>
							</div>
						</div>
						<?php $can_type=$this->session->can_type;
						if($can_type!="user"){?>
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Beneficiary ID </label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Beneficiary ID" type="text" name="beneficiary_id" id="beneficiary_id"  value="<?php echo (isset($can_bank_details->beneficiary_id) && !empty($can_bank_details->beneficiary_id)) ? $can_bank_details->beneficiary_id:''?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Transaction Type</label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select required="" id="transaction_type" name="transaction_type" class="chosen-select col-sm-12">																				
											<option value="WIB" <?php if($can_bank_details->transaction_type=="WIB") { echo "selected";}?>>WIB</option>
											<option value="NFT" <?php if($can_bank_details->transaction_type=="NFT") { echo "selected";}?>>NEFT</option>
											<option value="RTG" <?php if($can_bank_details->transaction_type=="RTG") { echo "selected";}?>>RTGS</option>
											<option value="IFC" <?php if($can_bank_details->transaction_type=="IFC") { echo "selected";}?>>IMPS</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<?php }?>

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Upload Bank Statement <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-10">
								<section class="proj-page-section">
								<div class="drop-zone">
									<i class="font-icon font-icon-cloud-upload-2"></i>
									<div class="drop-zone-caption">Drag file to upload</div>
									<span class="btn btn-rounded btn-file">
									<span>Choose file</span>
									<input class="file-upload_ins" type="file" id="myfile" name="files" accept="text/plain,.pdf,.doc,.docx,image/*">
									</span>
									<div>
										<span id="uploaded_filename" style="color: #919fa9;"><?php echo (isset($can_bank_details->bank_statement_name) && !empty($can_bank_details->bank_statement_name)) ? $can_bank_details->bank_statement_name : ''?></span>
										<br><span class="error_msg" id ="myfile_err"></span></div>
								</div>
								</section>
							</div>
							<input type="hidden" name="old_bank_statement" id="old_bank_statement" value="<?php echo !empty($can_bank_details->bank_statement_name) ? $can_bank_details->bank_statement_name : ''?>">
						</div>
						<?php 

						if(isset($can_bank_details->bank_statement_name) && !empty($can_bank_details->bank_statement_name) && (file_exists(UPLOADPATH.$can_bank_details->can_id.'/'.$can_bank_details->bank_statement_name))){?>
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Document</label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<a class="btn btn-success" href="<?php echo base_url('uploads/').$can_bank_details->can_id.'/'.$can_bank_details->bank_statement_name; ?>"  download="<?php echo base_url('uploads/').$can_bank_details->can_id.'/'.$can_bank_details->bank_statement_name; ?>">Download</a>
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
								<input id="save_bank_details" type="button" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
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
	    

	    $(".file-upload_ins").on('change', function(){
	        readURL(this);            
	        if((this.files[0].size/1024/1024)<2)
	        {
	        	var filename = $('#myfile').val().replace(/C:\\fakepath\\/i, '')
				$('#uploaded_filename').html(filename);
				i++;
	        }
	        else
	        {
	        	swal("File Size Must Be Less Than 2 MB","","error");
	        	$('#uploaded_filename').html('');
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

	    $('.file-upload_ins').checkFileType({
	    allowedExtensions: ['doc', 'docx', 'pdf','txt','jpg','jpeg','png'],
	    success: function() {
	    	if(i == 1)
	    	{
	    		var filename = $('#myfile').val().replace(/C:\\fakepath\\/i, '')
				$('#uploaded_filename').html(filename);
			}
	    },
	    error: function() {
	    	swal("Please Select PDF,DOC,TXT,JPG,JPEG OR PNG File Type","","error");
	    	$('#uploaded_filename').html('');
	    }
	  });
	    
	    $(".upload-button").on('click', function() {
	     
	       $(".file-upload_ins").click();

	    });

	    $(".upload-cancel").on('click', function() {
	       //$(".file-upload_ins").click();

	    });

	});


	$('#myfile').change(function(){
		var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')
		$('#uploaded_filename').html(filename);
	});
	$('#save_bank_details').click(function (e) {			
		//e.preventDefault();
		$('.myprogress').css('width', '0');
		$('.msg').text('');
		//var filename = $('#document_name').val();
		var myfile = $('#myfile').val();
		var can_id = '<?php echo $this->uri->segment(3)?>';
		var prev_file = $('#old_bank_statement').val();
		if($('#bank_name').val()=='')
		{
			$('#b_name_err').text(" Please Enter Bank Name").show().delay(2000).fadeOut(800);
         event.preventDefault();
		}
		else if($('#account_number').val()=='' || $('#account_number').val()<100000 || $('#account_number').val()>999999999999999)
		{
			$('#acc_err').text(" Please Enter Valid Account Number").show().delay(2000).fadeOut(800);
         event.preventDefault();
		}
		else if($('#IFSC_code').val()=='' || $('#IFSC_code').val().length !=11)
		{
				$('#ifsc_err').text(" Please Enter Valid IFSC Code").show().delay(2000).fadeOut(800);
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
		formData.append('bd_id', $('#bd_id').val());
		formData.append('bank_name', $('#bank_name').val());
		formData.append('branch_name', $('#branch_name').val());
		formData.append('account_number', $('#account_number').val());
		formData.append('IFSC_code', $('#IFSC_code').val());
		formData.append('beneficiary_id', $('#beneficiary_id').val());
		formData.append('transaction_type', $('#transaction_type').val());
		formData.append('old_bank_statement', $('#old_bank_statement').val());
		// formData.append('filename', filename);
		formData.append('can_id', can_id);
		$('#save_bank_details').attr('disabled', 'disabled');
		$('.msg').text('Uploading in progress...');
		$.ajax({
			url: '<?php echo site_url();?>/candidate/upload_bank_details',
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
							message ='Bank Details Updated Successfully!';
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
							message ='Bank Details Updated Successfully!';
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
	