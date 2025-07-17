<div class="page-content">
	<div class="container-fluid">
	<div class="well">
		<?php $this->load->view('rpo_manager/client_menu');?>
		 <div class="row">
				<form class="col-sm-12" id="myform"  method="post">
					<h1 class="well headline">Add Document</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Client Name</label>
								</div>
							</div>
							<div class="col-lg-10 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label name_lable"><?php echo !empty($client_details['client_name']) ? $client_details['client_name'] :'';?></label>
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
									<input type="file"  id="myfile" name="files" accept="text/plain,.pdf,.doc,.docx,image/*">
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

	$('#myfile').change(function(){
		var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')
		$('#uploaded_filename').html(filename);
	});
		$('#upload_file').click(function (e) {		
		e.preventDefault();
		$('.myprogress').css('width', '0');
		$('.msg').text('');
		var filename = $('#document_name').val();
		var myfile = $('#myfile').val();

		if($('#document_name').val()=='')
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
			var client_id = '<?php echo $this->uri->segment(3)?>';
			// if (filename == '' || myfile == '') {
			// 	alert('Please enter file name and select file');
			// 	return;
			// }
			var formData = new FormData();
			formData.append('myfile', $('#myfile')[0].files[0]);
			formData.append('filename', filename);
			formData.append('client_id', client_id);
			$('#upload_file').attr('disabled', 'disabled');
			$('.msg').text('Uploading in progress...');
			$('#upload_file').attr('disabled',true);

			$.ajax({
				url: '<?php echo site_url();?>/rpo_manager/upload_contract_document',
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
						window.location.href = '<?php echo site_url();?>/rpo_manager/contract_document_list/'+client_id;
    				}, 2000);		
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
	