
<div class="page-content">
	<div class="container-fluid p-xl-0">
		<div class="well">
			 <div class="row">
			 	<div class="col-sm-12">
					<?php if($this->session->flashdata('success')){?>
					<script type="text/javascript">
					var message_text='<?php echo $this->session->flashdata('success');?>';
						$.notify({
							title: "<strong>"+title+"</strong> ",
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
				</div>
				<form data-toggle="validator" class="col-sm-12" id="task_form" action="" method="post"  role="form">
					<h1 class="well headline">News Manager</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">News Title<span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Enter News Title" type="text" name="nw_title" id="nw_title" required  
											value="<?php if(isset($news_details->nw_title)){ echo $news_details->nw_title; } ?>">
											<i class="fa fa-user"></i>
											<span class="error_msg" id ="t_title_err"></span>
										</div>
									</div>
								</div>
							</div>	

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Description<span>*</span></label>
								</div>
							</div>
						
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<div class="col-lg-12 nopadding">
											<textarea id="nw_description" name="nw_description" rows="8" class="form-control"><?php if(isset($news_details->nw_description)) { echo $news_details->nw_description; } ?></textarea>
										</div>
										<span class="error_msg" id ="t_desc_err"></span>	

										<div></div>
									</div>
								</div>
							</div>
						</div>		
										
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Image<span>*</span></label>
								</div>
							</div>
						
						<div class="col-lg-10">
							<section class="proj-page-section">
								<div class="drop-zone">
									<?php if(isset($news_details->image_name)) {?> <img style="height: 80px; width: 100px;" src="<?php echo base_url(); ?>/uploads/newsImage/<?php echo $news_details->image_name; ?>"> <?php } else { ?> <i class="font-icon font-icon-cloud-upload-2"></i><?php } ?>
									<div class="drop-zone-caption">Drag file to upload</div>
									<span class="btn btn-rounded btn-file">
									<span>Choose file</span>
									<input class="file-upload_ins" type="file"  id="nw_image" name="nw_image" accept="image/*" value="<?php if(isset($news_details->image_name)) { echo $news_details->image_name;  } ?>">
									<input type="hidden"  id="old_image" name="old_image" value="<?php if(isset($news_details->nw_image)) { echo $news_details->nw_image;  } ?>">
									</span>
									<div><span id="uploaded_filename" style="color: #919fa9;" >
										<?php if(isset($news_details->image_name)) { echo $news_details->image_name; ?><input type="hidden" name="hideImage" id="hideImage" value="<?php echo $news_details->image_name; ?>"><?php } ?></span></div>
									<span class="error_msg" id ="myfile_err"></span>
								</div>
							</section>
						</div>	
					</div>
					<div class="row">
						<div class="col-lg-2 col-sm-3 col-xs-12">
							<div class="form-group">
								<label class="form-label">Do you want to publish?</label>
							</div>
						</div>
					
						<div class="col-lg-10 col-sm-9 col-xs-12">									 
							<div class="form-group">
								<select id="publish_status" name="publish_status">
								  <option value="0">No</option>
								  <option value="1" <?php if(isset($news_details->publish_status) && $news_details->publish_status==1){ ?> selected <?php } ?>>Yes</option>
								 
								</select>
								<span class="error_msg" id="err_date"></span>								
							</div>  
						</div>
					</div>	
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								<div class="progress">
								<div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%" >0%</div>
								</div>
								<div class="msg"></div>
								</div>
							</div>
						</div>	

						<div class="row">
							<div class="col-lg-6">
								<input type="submit" id="submit_news" value="Save" class="btn btn-inline btn-success ladda-button"/>
								<input id="showmenu" type="button" value="Reset" class="btn btn-inline ladda-button reset"/>		
								<input type="hidden" name="hideID" id="hideID" value="<?php if(isset($news_details->nw_id)){ echo $news_details->nw_id;} ?>">
							</div>
						</div>
				</form>
			 </div>
		</div>
		
		
		</div>										
	</div>
</div>

<script>

	$(document).ready(function() {
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
	    allowedExtensions: ['jpg','jpeg','png','gif'],
	    success: function() {
	    	if(i == 1)
	    	{
	    		var filename = $('#myfile').val().replace(/C:\\fakepath\\/i, '')
				$('#uploaded_filename').html(filename);
			}
	    },
	    error: function() {
	    	swal("Please Select JPG,JPEG,GIF OR PNG File Type","","error");
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

	// $(document).ready(function() {
	$(".chosen-select").chosen();		
	tinymce.init({
        selector: "textarea",
        branding: false
    });
    $('#showmenu').click(function() {
        $('.menu').slideToggle("fast");
    });

    $("#nw_image").change(function(e){
    	var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
		$('#uploaded_filename').html(filename);
    });
 	$('#submit_news').click(function (e) {
 	  	e.preventDefault();
		$('.myprogress').css('width', '0');
		$('.msg').text('');
  		var nw_title=$("#nw_title").val();
  		var nw_description=tinyMCE.activeEditor.getContent();  	
  		var nw_image=$("#nw_image").val();
  		var hideID=$("#hideID").val();

  		var publish_status=$("#publish_status").val();
  		if(nw_title==''){
  			$("#t_title_err").text("Please Enter New Title").show().delay(2000).fadeOut(800);
  		}else if(nw_description==''){
  			$("#t_desc_err").text("Please Enter News Description").show().delay(2000).fadeOut(800);
  		}else{  			
  			var formData = new FormData();
  			if(hideID!=''){
  				formData.append('nw_id',hideID);
  				var image_name=$('#hideImage').val();
  			}else{
  				var image_name="";
  			}
  				// alert(image_name);
  			formData.append('nw_image', $('#nw_image')[0].files[0]);
  			formData.append('old_image', $('#old_image').val());
  			formData.append('nw_title',nw_title);
  			formData.append('nw_description',nw_description);
  			formData.append('publish_status',publish_status);
  			formData.append('image_name',image_name);
			$('#upload_file').attr('disabled', 'disabled');
			$('.msg').text('Uploading in progress...');
			$('#submit_news').attr('disabled', true);
  			$.ajax({
			url: '<?php echo site_url();?>/news/save_news',
			dataType :"json",
			data :formData,
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
				success: function(response){
				$('#upload_file').removeAttr('disabled');
						var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='News saved Successfully!';
							title ='Success:';
							$('#upload_file').attr('disabled', 'disabled');
							$('.msg').text('Uploading in progress...');	
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
						else if(response==5)
						{
							type ='warning';
							message ='Please select file';
							title ='Warning:';
						}
						$.notify({
                                title: title,
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
							window.location.href = '<?php echo site_url();?>/news';
    				}, 2000);
    			
	   		},
	   		error:function(xhr){
	   			console.log(xhr.responseText);
	   		}
			});
  		}
  	});	
</script>