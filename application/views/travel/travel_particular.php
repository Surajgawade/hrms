
<div class="page-content">
	<div class="container-fluid">

		<h1 class="well headline">Travel Document Listing</h1>
		<section class="card">
			<div class="card-block">
				<table id="example" class="display table table-bordered" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th style="width:15%">Document Name</th>
						<th style="width:15%">View / Download</th>
						<th style="width:10%">Actions</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</section>

	
		<div class="well">
			<div class="row">
				<form class="col-sm-12" id="myform" data-toggle="validator" method="post">
					<h1 class="well headline">Documents</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">					
					</div>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Candidate Name</label>
								</div>
							</div>
							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label name_lable"><?php echo $can_details->can_name;?></label>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
								<label class="form-label">Document Name <span>*</span></label>
								</div>
							</div>

							<div class=col-lg-10>
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Your Document Name" type="text" name="tdoc_name" id="tdoc_name" required oninvalid="this.setCustomValidity('Please Enter valid Document Name')" oninput="setCustomValidity('')" maxlength="30">
										<i class="fa fa-address-card"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">File Upload <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-10">
								<section class="proj-page-section">
								<div class="drop-zone">
									<i class="font-icon font-icon-cloud-upload-2"></i>
									<div class="drop-zone-caption">Drag file to upload</div>
									<span class="btn btn-rounded btn-file">
									<span>Choose file</span>
									<input class="file-upload_ins" type="file"  id="myfile" name="files" accept="text/plain,.pdf,.doc,.docx,image/*" required>
									</span>
									<div><span id="uploaded_filename" style="color: #919fa9;"></span></div>
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
							<input id="reset_form" type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset" />
							<button type="button" class="btn btn-inline btn-warning ladda-button" data-style="expand-left" id="claim_travel"><span class="ladda-label">Claim</span>
                                <span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
							</div>
						</div>
					</div>
				</form> 
			</div>
		</div>
	</div>
</div>

<script>
	var oTable;
$(document).ready(function () {

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


	get_tdocuments();
	$('#myfile').change(function(){
		var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')
		$('#uploaded_filename').html(filename);
	});
    $('#myform')
        .bootstrapValidator({
            message: 'This value is not valid',
            
            fields: {
                tdoc_name: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Document Name'
                        }
                    }
                },
                files: {
                    validators: {
                        notEmpty: {
                            message: 'Please Choose File'
                        }
                    }
                }
            }
        })
        .on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
            var $form = $(e.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
            // Use Ajax to submit form data
            $('.myprogress').css('width', '0');
			$('.msg').text('');
			var filename = $('#tdoc_name').val();
			var myfile = $('#myfile').val();
			var can_id = '<?php echo $travel_details->can_id; ?>';
			var tv_id = '<?php echo $travel_details->tv_id; ?>';
            var formData = new FormData();
			formData.append('myfile', $('#myfile')[0].files[0]);
			formData.append('filename', filename);
			formData.append('can_id', can_id);
			formData.append('tv_id', tv_id);
			$('#upload_file').attr('disabled', 'disabled');
			$('.msg').text('Uploading in progress...');
            $.ajax({
                url: '<?php echo site_url();?>/travel_management/upload_document',
                processData: false,
				contentType: false,
                data : formData,
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
					$('.msg').text(message);
					$('.myprogress').css('width', 0);
					window.setTimeout(function(){location.reload()},2000);
				}
			});
			document.getElementById("myform").reset();
			oTable.draw();
			//window.setTimeout(function(){location.reload()},2000);
	        });
});

function get_tdocuments()
{
	var id = '<?php echo $travel_details->can_id; ?>';
	var tid = '<?php echo $travel_details->tv_id; ?>';
	oTable = $('#example').DataTable({
		'responsive': true,
		'bProcessing'    : true,
		'language': {
					processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
			  	},
		'bServerSide'    : true,
		'language': {
					processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
			  	},
		"order": [[ 0, "desc" ]],
		'sPaginationType': 'full_numbers',
		"aoColumns": [
			{"sName": "tdoc_name", "mData": "tdoc_name" ,"bSortable":true},
			{"sName": "tfile_name", "mData": "tfile_name" ,"bSortable":true},
			{"sName": "Actions", "mData": "edit" ,"bSortable":false,"bSearchable":false}
		],
		'sAjaxSource'    : '<?php echo site_url();?>'+'/travel_management/tdocument_details/'+id+'/'+tid,
		'fnServerData': function(sSource, aoData, fnCallback)
		{
			$.ajax
			({
				'dataType': 'json',
				'type'    : 'POST',
				'url'     : sSource,
				'data'    : aoData,
				'success' : fnCallback
			});
		}
	});
}

function delete_data(id)
{
	swal({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then(function () {
		var	doc_id = id;
		$.ajax({
			url: '<?php echo site_url();?>/travel_management/delete_doc',
			// dataType :"json",
			data : {doc_id: doc_id},
			type: 'POST',
			success: function(response){
				var type='' ;
						var message='' ;
						var title='' ;
						if(response == 1)
						{
							type ='success';
							message ='Document Deleted Successfully!';
							title ='Success';
						}
						else
						{
							type ='warning';
							message ='Access Denied';
							title ='Warning';

						}
						$.notify({
								title: "<strong>"+title+"</strong> ",
								message: message,	
							},
							{
								type: type,
								delay: 800,
								animate:{
									enter: "animated fadeInUp",
									exit: "animated fadeOutDown"
								} 
						});	
			}
		});
		// window.setTimeout(function(){location.reload()},3000);
		oTable.draw();
		return true;
	});
}

$('#reset_form').on('click', function() {
    document.getElementById("myform").reset();
    $('#uploaded_filename').html('');
});

 $('#claim_travel').click(function () {
    // e.preventDefault();
    $('#claim_travel').attr('disabled', true);
    var tv_id = '<?php echo $travel_details->tv_id; ?>';
    $.ajax({
        url: '<?php echo site_url();?>/travel_management/add_travel_claim',
        dataType :"json",
        async:false,
        data : {'tv_id':tv_id,'status':'claimed'},
        type: 'POST',
        success: function(response)
        {
           $.notify({
				title: "<strong>Success:</strong> ",
				message: "Travel Claimed Successfully",
			},
			{
				type: "success",
				delay: 800,
				animate:{
				enter: "animated fadeInUp",
				exit: "animated fadeOutDown"
				}
			});
        }
    });
    /*document.getElementById("submit_travel").reset();
    oTable.draw();*/
    window.setTimeout(function(){
    	window.location.href = '<?php echo site_url("travel_management/bill_upload") ?>';
    },2000);
});
</script>
