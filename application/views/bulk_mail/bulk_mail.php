<div class="page-content">
	<div class="container-fluid">
		<div class="well">
				<form action="" id="interview_form" name="bulk_mail_form" method="post" data-toggle="validator">
					<h1 class="well headline">Bulk E-mail</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="form-label">Departments : <span>*</span></label>
								</div>
							</div>
							<div class="col-lg-10 col-sm-9 col-xs-12" >
								<div class="form-group">
									<select class="form-control chosen-select" id="department" name="departments" placeholder="Mail Recipient" onChange="get_recipients()">
									</select>
									<div class="help-block with-errors error_msg" id ="dept_txt"></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="form-label">Recipients : </label>
								</div>
							</div>
							<div class="col-lg-10 col-sm-9 col-xs-12" >
								<div class="form-group">
									<textarea type="text" class="form-control" id="recipients" placeholder="Choose Recipient" readonly rows="4">All</textarea>
									<input type="hidden" id="rec_ids" name="recipients[]" value="all">
									<div class="help-block with-errors error_msg" id ="rec_txt"></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="form-label">Subject : <span>*</span></label>
								</div>
							</div>
							<div class="col-lg-10 col-sm-9 col-xs-12" >
								<div class="form-group">
									<input type="text" class="form-control" id="subject" name="subject" placeholder="Mail Subject">
									<div class="help-block with-errors error_msg" id ="sub_txt"></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="form-label">Message : <span>*</span></label>
								</div>
							</div>
							<div class="col-lg-10 col-sm-9 col-xs-12" >
								<div class="form-group">
									<textarea class="form-control" id="mail_body" name="message" row="10" style="height:500px;">
									</textarea>
									<div class="help-block with-errors error_msg" id ="mail_txt"></div>
								</div>
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-lg-6">
							<button type="button" class="btn btn-inline btn-success ladda-button" data-style="expand-left" name="submit_mail" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Sending Message" id="submit_mail"><span class="ladda-label">Send Mail</span>
						</div>							
					</div>
				</form>
		</div>
	</div>
</div>

<div class="modal fade" id="recipient_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
	        <div class="modal-header">
            	<!-- <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;</button> -->
	            <h4 class = "modal-title" id = "myModalLabel">Select Recipient</h4>
         	</div>
         
         	<div class = "modal-body">
           		<div class="row">
					<div class="col-lg-3" align="right">
						<input type='checkbox' id="select_all">Select All
					</div>
					<div class="col-lg-9" id="rec_div">
					</div>
				</div>
         	</div>
         
         	<div class = "modal-footer">
            	<!-- <button type = "button" class = "btn btn-default" data-dismiss = "modal">Close</button> -->
	            <button id="assign_rec" type = "button" class = "btn btn-primary">Save</button>
         	</div>
	    </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	$(document).ready(function () {
		$(".chosen-select").chosen();
		get_departments();

		tinymce.init({
	        selector: "#mail_body",
        	branding: false
	    });

  		$("#submit_mail").click(function(){
  			var mail_body = tinyMCE.activeEditor.getContent();
  			var subject = $('#subject').val();
  			var dept = $('#department').val();
  			var rec = $('#rec_ids').val();
  			if(mail_body.trim() == '')
  			{
  				$('#sub_txt').text("Please Enter Message ....").show().delay(2000).fadeOut(800);
                $('#submit_mail').removeAttr('disabled');
  			}
  			else if(subject.trim() == '')
  			{
  				$('#mail_txt').text("Please Enter Subject ....").show().delay(2000).fadeOut(800);
                $('#submit_mail').removeAttr('disabled');
  			}
  			else if(dept.trim() == '')
  			{
  				$('#dept_txt').text("Please Enter Departments ....").show().delay(2000).fadeOut(800);
                $('#submit_mail').removeAttr('disabled');
  			}
  			else if(rec.length == 0)
  			{
  				$('#rec_txt').text("Please Enter Recipients ....").show().delay(2000).fadeOut(800);
                $('#submit_mail').removeAttr('disabled');
  			}
  			else
  			{
  				$("#submit_mail").attr('disabled', true);
  				var $this = $(this);
				$this.button('loading');
				$.ajax({
	  				url:'<?php echo site_url();?>/bulk_mail/send_bulk_mail',
	  				dataType :"json",
                    async:false,
                    type: 'POST',
	  				data:{'message':mail_body, 'subject':subject, 'recipients':rec, 'departments':dept},
	  				success: function(response)
                    {
				       	$this.button('reset');
                    	var type = '' ;
						var message = '';
						var title = '';
						if(response == 1)
						{
							type ='success';
							message ='Mail sent Successfully!';
							title ='Success:';
						}
						else if(response == 2)
						{
							type = 'danger';
							message = 'Something went wrong...';
							title = 'Oops:';
						}
						else if(response == 3)
						{
							type = 'warning';
							message = 'Candidates are not present.';
							title = 'Warning:';
						}
						else if(response == 4)
						{
							type = 'warning';
							message = 'Invalid email address or message';
							title = 'Warning:';
						}
		                $.notify({
		                        title: "<strong>"+title+"</strong> ",
		                        message: message,
		                        type: type,
		                    },{
		                        delay: 800,
		                        animate:{
		                            enter: "animated fadeInUp",
		                            exit: "animated fadeOutDown"
		                        } 
		                });
		                if(response == 1)
		                {
		                    window.setTimeout(function(){
		                        window.location.reload();
		                    },1000);
		                }
                    }
	  			});
	  		}
  		});
	});

	function get_departments()
	{
		$.ajax({
			url:'<?php echo site_url();?>/bulk_mail/get_departments',
			dataType :"json",
			async:false,
			type: 'POST',
			success: function(response)
			{
				var depts = '<option value="all">All</option>';
				if(response.length != 0)
				{
					$.each(response, function(key, val){
						depts += '<option value="'+val.id+'">'+val.title+'</option>';
					});
				}
				$('#department').html(depts).trigger('chosen:updated');
			}
		});
	}

	function get_recipients()
	{
		var dept = $('#department').val();
		if((dept.trim() != 'all') && (dept.trim() != ''))
		{
			$.ajax({
				url:'<?php echo site_url();?>/bulk_mail/get_recipients',
				dataType :"json",
				async:false,
				type: 'POST',
				data: {'dept_id':dept},
				success: function(response)
				{
					var recs = '';
					$('#rec_div').html('');
					$('#select_all').addClass('hidden');
					$('#select_all').attr('checked', false);
					if(response != '')
					{
						$.each(response, function(key, val){
							recs += "<input class='emplyee_ids' type='checkbox' name='recs[]' id='"+val.can_id+"' value='"+val.can_name+" - "+val.designation+"'>"+val.can_name+" - "+val.designation+"<br>";
						});
					}
					else
					{
						recs = "<span class='text-center text-danger h3'>No Employee in this department.</span>";
					}
					$('#rec_div').html(recs);
					$('#select_all').removeClass('hidden');
					$('#select_all').attr('checked', false);
					$('#recipient_modal').modal({backdrop: 'static', keyboard: false});
					$('#recipient_modal').modal('show');
				}
			});
		}
	}

	$("#select_all").change(function(){  //"select all" change
		var status = this.checked; // "select all" checked status
		$('.emplyee_ids').each(function(){ //iterate all listed checkbox items
			this.checked = status; //change ".checkbox" checked status
		});
	});

	$('#assign_rec').click(function() {
		var ids = [];
		var text = '';
		$(".emplyee_ids").each(function(){
		    var $this = $(this);
		    if($this.is(":checked")){
		        ids.push($this.attr("id"));
		        text += $this.attr("value")+",";
		    }
		});
		if(ids.length != 0)
		{
			$('#recipients').val(text);
			$('#rec_ids').val(ids);
			$('#recipient_modal').modal("hide");
			$('#rec_div').html('');
		}
		else
		{
			swal("Wrong", "Please select Recipient", "error");
		}
	});
</script>