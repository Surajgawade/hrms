<div class="page-content">
	<div class="container-fluid">
	<div class="col-sm-12 well">
		 <div class="row">
				<form class="col-sm-12" id="myform"  method="post">
					<h1 class="well headline">Import Attendance</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
			
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Attendance File Sample</label>
								</div>
							</div>

							<div class="col-lg-10">
								<div class="form-group img-responsive">
									<a href="<?php echo base_url().'assets/img/atten.xls' ?>" target="_blank"><img class="img-responsive" src="<?php echo base_url().'assets/img/atten.jpg' ?>"></a>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Import CSV<span> * </span></label>
								</div>
							</div>

							<div class="col-lg-10">
								<section class="proj-page-section">
								<div class="drop-zone">
									<i class="font-icon font-icon-cloud-upload-2"></i>
									<div class="drop-zone-caption">Drag file to upload</div>
									<span class="btn btn-rounded btn-file">
									<span>Choose file</span>
									<input class="file-upload_ins" type="file"  id="myfile" name="files" accept=".csv,.xls,.xlsx">
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
	    allowedExtensions: ['csv','xls','xlsx'],
	    success: function() {
	    	if(i == 1)
	    	{
	    		var filename = $('#myfile').val().replace(/C:\\fakepath\\/i, '')
				$('#uploaded_filename').html(filename);
			}
	    },
	    error: function() {
	    	swal("Please Select CSV OR XLS File Type","","error");
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
		$('#upload_file').click(function (e) {		
		e.preventDefault();
		$('.myprogress').css('width', '0');
		$('.msg').text('');
		var myfile = $('#myfile').val();
		if(myfile == '')  
		{
			$('#myfile_err').text(" Please Choose File").show().delay(2000).fadeOut(800);
            e.preventDefault();
				return;
		}
		else
		{
			$('body').append('<div id="loaderDiv" class="" style="display: block; position: relative;  margin: 0 auto; align:center;  z-index:100;"><img style="margin: 0 auto; margin-top: 0px; position: relative; align-items: center; display: block; margin-top: -50px;" src="<?php echo assets_url();?>img/loader.gif"></div>');
			$('#loaderDiv').fadeIn('fast');
			var formData = new FormData();
			formData.append('myfile', $('#myfile')[0].files[0]);
			$('#upload_file').attr('disabled', 'disabled');
			$('.msg').text('Uploading in progress...');
			$.ajax({
				url: '<?php echo site_url();?>/attendance/save_attendance',
				data: formData,
				processData: false,
				contentType: false,
				type: 'POST',
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
					$("#loaderDiv").fadeOut('slow');
					var type='' ;
					var message='' ;
					var title='' ;
					if(response==1)
					{
						type ='success';
						message ='Attendance Imported Successfully!';
						title ='Success:';
					}
					else if(response==2)
					{
						type ='danger';
						message ='Failed to Import!';
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
					else if(response==5)
					{
						type ='warning';
						message ='Column has wrong value';
						title ='Warning:';

					}
					else if(response==6)
					{
						type ='danger';
						message ='Please select file ....';
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
						window.location.reload();
    				}, 2000);
				}
			});
			document.getElementById("myform").reset();
			$('.myprogress').css('width', '0');
			$('.msg').text('');
		}
	});
	});
</script>