<?php 
     $userdata = $this->session->userdata('logged_in_user');
?>

<div class="page-content">

	<div class="container-fluid">
		<div class="well">
			<div class="row"> 
				<form data-toggle="validator" class="col-sm-12" id="leave_application" action="<?php echo site_url();?>/hrpolicy/upload_document" method="post" >
					<h1 class="well headline">HR Policy</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Particular<span>*</span></label>
								</div>
							</div>
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="date form-group">
									<input type="text" class="form-control" name="particular" id="particular" placeholder="Particular Policy Name" required />
									<span id="par_err" class="error_msg"></span>
								</div>
							</div>

							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Update Date<span>*</span></label>
								</div>
							</div>
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="date form-group">
									<div class="input-group input-append date" id="datePicker1" data-date-start-date="0d">
									<input type="text" class="form-control" name="to_date" id="to_date" placeholder="dd/mm/yyyy" required />
									<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
									<span id="date_err" class="error_msg"></span>
								</div>
							</div>
						</div>

							<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Upload Policy Pdf<span>*</span></label>
								</div>
							</div>

							<div class="col-lg-10">
								<section class="proj-page-section">
								<div class="drop-zone">
									<i class="font-icon font-icon-cloud-upload-2"></i>
									<div class="drop-zone-caption">Drag file to upload</div>
									<span class="btn btn-rounded btn-file">
									<span>Choose file</span>
									<input class="file-upload_ins" type="file" id="myfile" name="files" accept=".pdf">
									</span>
									<div>
										<span id="uploaded_filename" style="color: #919fa9;"></span>
										<br><span class="error_msg" id ="myfile_err"></span></div>
								</div>
								</section>
							</div>
							
						</div>
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
								<input id="upload_file" type="submit" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
								<input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
							</div>
						</div>
					</div>
				</form> 
			</div>
		</div>
	</div>
</div><!--.page-content-->


<script type="text/javascript">
	$(document).ready(function()
	{

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
	    allowedExtensions: ['pdf'],
	    success: function() {
	    	if(i == 1)
	    	{
	    		var filename = $('#myfile').val().replace(/C:\\fakepath\\/i, '')
				$('#uploaded_filename').html(filename);
			}
	    },
	    error: function() {
	    	swal("Please Select PDF File Type","","error");
	    	$('#uploaded_filename').html('');
	    }
	  });
	    
	    $(".upload-button").on('click', function() {
	     
	       $(".file-upload_ins").click();

	    });

	    $(".upload-cancel").on('click', function() {
	       //$(".file-upload_ins").click();

	    });

	$('#myfile').change(function(){
		var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')
		$('#uploaded_filename').html(filename);
	});

	$('#datePicker1').datepicker({
		format: 'dd/mm/yyyy',
			autoclose : true,
			minDate: new Date()
   	});

		$('#upload_file').click(function (e) {		
		e.preventDefault();
		$('.myprogress').css('width', '0');
		$('.msg').text('');
		var to_date = $('#to_date').val();
		var myfile = $('#myfile').val();
		if($('#particular').val()=='')
		{
			$('#par_err').text(" Please Enter Particular Policy Name").show().delay(2000).fadeOut(800);
         event.preventDefault();
		}
		else if($('#to_date').val()=='')
		{
			$('#date_err').text(" Please Select Date").show().delay(2000).fadeOut(800);
         event.preventDefault();
		}
		else if(myfile == '') 
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
			formData.append('particular', $('#particular').val());
			formData.append('todate', to_date);
			$('#upload_file').attr('disabled', 'disabled');
			$('.msg').text('Uploading in progress...');
			$('#upload_file').attr('disabled',true);

			$.ajax({
				url: '<?php echo site_url();?>/hrpolicy/upload_document',
				data: formData,
				processData: false,
				contentType: false,
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
				}
				}, false);
				return xhr;
				},
				success: function (response)
				{
					$('#upload_file').removeAttr('disabled');
						var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='HR Policy Uploaded Successfully!';
							title ='Success:';
							setTimeout(function () {
						window.location.href = '<?php echo site_url();?>/hrpolicy/policy_list/';
    				}, 2000);
						}
						else if(response==2)
						{
							type ='danger';
							message ='Failed to Upload!';
							title ='Oops:';

						}
						else if(response==3)
						{
							type ='warning';
							message ='File Size Max 2 MB, Allowed!';
							title ='Warning:';

						}
						else if(response==4)
						{
							type ='warning';
							message ='Please Select pdf File Type!';
							title ='Warning:';

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
								
				}				
			});
			//window.location.href = '<?php //echo site_url();?>/candidate/documents/'+ can_id;

			document.getElementById("myform").reset();
			$('.myprogress').css('width', '0');
			$('.msg').text('');
			// location.reload();
		}
	});
	});
</script>








