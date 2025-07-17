<div class="page-content">
	<div class="container-fluid">
	<div class="well">
		<?php $this->load->view('candidate/can_menu');?>
		 <div class="row">
				<form class="col-sm-12" id="myform"  method="post">
					<h1 class="well headline">Add Document</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Employee Name</label>
								</div>
							</div>
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label name_lable"><?php echo $can_details->can_name;?></label>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
								<label class="form-label">Document Name <span> * </span></label>
								</div>
							</div>

							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Your Document Name" type="text" name="document_name" id="document_name" required>
										<i class="fa fa-address-card"></i>
					<span class="error_msg" id ="doc_name_err"></span>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">File Upload <span> * </span></label>
								</div>
							</div>

							<div class="col-lg-10">
								<section class="proj-page-section">
								<div class="drop-zone">
									<i class="font-icon font-icon-cloud-upload-2"></i>
									<div class="drop-zone-caption">Drag file to upload</div>
									<span class="btn btn-rounded btn-file">
									<span>Choose file</span>
									<input class="file-upload_ins" type="file"  id="myfile" name="files" accept="text/plain,.pdf,.doc,.docx,image/*">
									</span>
									<div><span id="uploaded_filename" style="color: #919fa9;"></span></div>
					<span class="error_msg" id ="myfile_err"></span>
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
							<input id="upload_file" type="button" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
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
	        	var filename = $('#myfile').val().replace(/C:\\fakepath\\/i, '');
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
	    		var filename = $('#myfile').val().replace(/C:\\fakepath\\/i, '');
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



	$('#myfile').change(function(){
		var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
		// $('#uploaded_filename').html(filename);
	});
		$('#upload_file').click(function (e) {		
		e.preventDefault();
		$('.myprogress').css('width', '0');
		$('.msg').text('');
		var filename = $('#document_name').val();
		var myfile = $('#myfile').val();

		if($('#document_name').val().trim()=='')
		{
			$('#doc_name_err').text(" Please Enter Document Name").show().delay(2000).fadeOut(800);
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
			var can_id = '<?php echo $this->uri->segment(3)?>';
			// if (filename == '' || myfile == '') {
			// 	alert('Please enter file name and select file');
			// 	return;
			// }
			var formData = new FormData();
			formData.append('myfile', $('#myfile')[0].files[0]);
			formData.append('filename', filename);
			formData.append('can_id', can_id);
			$('#upload_file').attr('disabled', 'disabled');
			$('.msg').text('Uploading in progress...');
			$('#upload_file').attr('disabled',true);

			$.ajax({
				url: '<?php echo site_url();?>/candidate/upload_document',
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
							message ='Document Uploaded Successfully!';
							title ='Success:';
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
							message ='Invalid File Format!';
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
						setTimeout(function () {
						window.location.href = '<?php echo site_url();?>/candidate/documents/'+can_id;
    				}, 2000);		
				}				
			});
			//window.location.href = '<?php //echo site_url();?>/candidate/documents/'+ can_id;
			$('.myprogress').css('width', '0');
			$('.msg').text('');
			// location.reload();
		}
	});
	});
</script>
	