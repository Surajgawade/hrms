<link rel="stylesheet" href="<?php echo assets_url();?>css/lib/fullcalendar/fullcalendar.min.css"></link>
<link rel="stylesheet" href="<?php echo assets_url();?>css/separate/pages/calendar.css"></link>
<style>

  /*body {
    margin: 40px 10px;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 14px;
  }*/

</style>
<div class="page-content">
<div>
	<?php if($this->session->flashdata('warning')){?>
			<script type="text/javascript">
				var message_text='<?php echo $this->session->flashdata('warning');?>';
					$.notify({
								title: "<strong>Warning:</strong> ",
								message: message_text,
							},
							{
								type: "warning",
								delay: 800,
								animate:{
								enter: "animated fadeInUp",
								exit: "animated fadeOutDown"
								}
							});
			</script>
		<?php }?>
</div>
	<div class="container-fluid">
		<div class="box-typical" style="padding: 0px 10px">
			<div class="calendar-page">

				<div class="calendar-page-content">
					<div class="calendar-page-title">Calendar</div>
						<div id='calendar'></div>
					</div>

				<!-- .modal-dialog for calendar notes -->
				<div class="modal fade EventModal" tabindex="-1" role="dialog" id="EventModal" aria-labelledby="myModalLabel" aria-hidden="true">
				    <div class="modal-dialog" role="document">
				        <div class="modal-content">
				            <div class="modal-header">
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				                <h4 class="modal-title" id="ev_title">Create New Event</h4>
				            </div>
				            <div class="modal-body">
				            	<form data-toggle="validator" class="col-sm-12" id="add_event" action=" " method="post">
				            	<div class="row" id="ev_tp">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label" for="event_type">Event Type<span>*</span></label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
		                                    <div class="form-control-wrapper form-control-icon-right">
		                                        <select id="event_type" name="event_type" class="web col-lg-12 col-sm-12 col-xs-12 form-control chosen-select" required>
		                                            <optgroup label="Event Type">
		                                              <option value="appointment">Appointments</option>
		                                              <option value="meeting">Meeting</option>
		                                              <option value="calls">Follow Up Calls</option>
		                                              <option value="training">Training</option>
		                                            </optgroup>
		                                        </select>
		                                    </div>
		                                </div>
									</div>
				            	</div>

				            	<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label" for="title">Event Title<span>*</span></label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control" type="text" name="title" id="title" required>
												<input type="hidden" name="ev_id" id="ev_id">
											</div>
										</div>
									</div>
								</div>

				            	<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label" for="starts-at">Starts at<span>*</span></label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control" type="text" name="start" id="starts-at"  data-date-format="d/m/Y H:i" data-enable-time="true" data-time_24hr="false">
											</div>
										</div>
									</div>
								</div>

				               <div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label" for="ends-at">Ends at<span>*</span></label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control" type="text" name="end" data-date-format="d/m/Y H:i" id="ends-at" data-enable-time="true" data-time_24hr="false">
											</div>
											<!--  data-enable-seconds="true" -->
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label" for="details">Event Details</label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<textarea class="form-control" type="text" name="details" id="details" ></textarea>
											</div>
										</div>
									</div>
								</div>

				            </div>
				            <div class="modal-footer">
				            	<button type="button" class="btn btn-danger hidden" id="del_ev">Delete</button>
				                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				                <button type="submit" class="btn btn-primary" id="save">Save</button>
				            </div>
				        </form>
				        </div><!-- /.modal-content -->
				    </div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
			</div><!--.calendar-page-->

			<div class="col-sm-12 text-center" style="margin-top:10px !important;">
				<ul class="colors-guide-list">
					<li style="display : inline; padding-right: 15px">
						<div class="color-double green"><div></div></div>
						Appointments
					</li>
					<li style="display : inline; padding-right: 15px">
						<div class="color-double"><div></div></div>
						Meetings
					</li>
					<li style="display : inline; padding-right: 15px">
						<div class="color-double orange"><div></div></div>
						Follow up calls
					</li>
					<li style="display : inline; padding-right: 15px">
						<div class="color-double coral"><div></div></div>
						Training
					</li>
						<li style="display : inline; padding-right: 15px">
						<div class="color-double seagreen"><div></div></div>
						Task
					</li>
					<li style="display : inline; padding-right: 15px">
						<div class="color-double purple"><div></div></div>
						Leave
					</li>
					<li style="display : inline; padding-right: 15px">
						<div class="color-double lightpink"><div></div></div>
						Travel
					</li>
				</ul>
			</div>

		</div><!--.box-typical-->
	</div><!--.container-fluid-->
</div><!--.page-content-->

<script type="text/javascript">
	$(document).ready(function() {
		$(".chosen-select").chosen();
		$('#calendar').fullCalendar({
	        header: {
	            left: 'prev, next today',
	            center: 'title',
	             right: false,
	        },
	        allDay : true,
	        contentHeight: 600,
	        defaultDate: new Date(),
	        navLinks: true, // can click day/week names to navigate views
	        selectable: true,
	        selectHelper: true,
	        displayEventTime: true,
	        fixedWeekCount : false,
	        select: function(start, end) {
	            // Display the modal.
	            // You could fill in the start and end fields based on the parameters
	            var today = new Date();
	            today.setDate(today.getDate() - 1);
	            if(start >= today)
	            {
	            	var start_date = start.format("DD/MM/YYYY");
	            	$.ajax({
		                url: '<?php echo site_url();?>/calendar/get_leave_for_day/',
		                dataType :"json",
		                data: {'start_date' : start_date},
		                async:false,
		                type: 'POST',
		                success: function(response)
		                {
		                	if(response == true)
		                	{
					    		document.getElementById("add_event").reset();
				        	    $('.EventModal').find('#ev_title').html('Create New Event');
					            $('.EventModal').find('#starts-at').val(start.format("DD/MM/YYYY HH:mm"));
					            $('.EventModal').find('#ends-at').val(end.format("DD/MM/YYYY HH:mm"));
				        	    $('.EventModal').find('#ev_id').val('');
					            $('.EventModal').find('#title').val('');
					            $('.EventModal').find('#save').removeClass('hidden');
				        	    $('.EventModal').find('#del_ev').addClass('hidden');
					            $('.EventModal').find('#ev_tp').removeClass('hidden');
					            $('.EventModal').modal('show');
					        }
					        else
					        {
					        	$.notify({
										title: "<strong>Leave</strong> ",
										message: "You are on leave.",
									},
									{
										type: "warning",
										z_index: 3000,
										delay: 800,
										animate:{
											enter: "animated fadeInUp",
											exit: "animated fadeOutDown"
										}
								});
					        }
				        }
				    });
				}
				else
		        {
		        	$.notify({
							title: "<strong>Prohibited</strong> ",
							message: "Cannot add event on past dates.",
						},
						{
							type: "danger",
							z_index: 3000,
							delay: 800,
							animate:{
								enter: "animated fadeInUp",
								exit: "animated fadeOutDown"
							}
					});
		        }
	        },
	        eventClick: function(event, element) {
	            // Display the modal and set the values to the event values.
	            $.ajax({
	                url: '<?php echo site_url();?>/calendar/get_event_details/'+event.ev_id,
	                dataType :"json",
	                async:false,
	                type: 'POST',
	                success: function(response)
	                {
	                  $('.EventModal').find('#ev_id').val(response.ev_id);
			            $('.EventModal').find('#starts-at').val(response.start);
			            $('.EventModal').find('#ends-at').val(response.end);
			            $('.EventModal').find('#title').val(response.title);
			            $('.EventModal').find('#details').val(response.details);
			            $('.EventModal').find('#event_type').val(response.event_type);
			            $('.EventModal').find('#ev_title').html('Current Event');
			            if((response.event_type == 'leave') || (response.event_type == 'task') || (response.event_type == 'travel'))
			            {
			            	$('.EventModal').find('#del_ev').addClass('hidden');
			            	$('.EventModal').find('#save').addClass('hidden');
			            	$('.EventModal').find('#ev_tp').addClass('hidden');
			            }
			            else
			            {
			            	$('.EventModal').find('#save').addClass('hidden');
			            	$('.EventModal').find('#del_ev').removeClass('hidden');
			            	$('.EventModal').find('#ev_tp').removeClass('hidden');
			            }
			            $('.EventModal').modal('show');
	                }
	            });
	        },
	        editable: true,
	        eventLimit: true // allow "more" link when too many events
	    });

	    get_events();

	    $('#add_event')
        .bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
            },
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Event Title'
                        }
                    }
                },
                event_type: {
                    validators: {
                        notEmpty: {
                            message: 'Please Select Event Type'
                        }
                    }
                }/*,
                start: {
                    validators: {
                        notEmpty: {
                            message: 'The from date is required and can\'t be empty'
                        }
                    }
                },
                end: {
                    validators: {
                        notEmpty: {
                            message: 'The to date is required and can\'t be empty'
                        }
                    }
                },*/
            }
        })
        .on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
            // Use Ajax to submit form data
            var fdata = $('#add_event').serialize();
			var today = new Date();
	        today.setDate(today.getDate() - 1);
            var start = $('#starts-at').val();
            var event_id = $('#ev_id').val();
            if((start >= today) || (event_id != null))
            {
            $.ajax({
                url: '<?php echo site_url();?>/calendar/add_event_details',
                dataType :"json",
                async:false,
                data : fdata,
                type: 'POST',
                success: function(response)
                {
                	if(response.result==1)
                	{
                		$.notify({
								title: "<strong>Warning</strong> ",
								message: response.msg,	
							},
							{
								type: "warning",
								delay: 800,
								animate:{
									enter: "animated fadeInUp",
									exit: "animated fadeOutDown"
								} 
						});
						$('.EventModal').modal('hide');
						document.getElementById("add_event").reset();
                	}	
                	else if((response.result == false) || (response.result == 0))
                	{
                		$.notify({
								title: "<strong>OOPs</strong> ",
								message: response.msg,	
							},
							{
								type: "warning",
								z_index: 3000,
								delay: 800,
								animate:{
									enter: "animated fadeInUp",
									exit: "animated fadeOutDown"
								} 
						});
                		$('.EventModal').modal('hide');
                		document.getElementById("add_event").reset();
                	}
                	else if(response.result == 2)
                	{
                		$.notify({
								title: "<strong>Success</strong> ",
								message: response.msg,	
							},
							{
								type: "success",
								delay: 800,
								animate:{
									enter: "animated fadeInUp",
									exit: "animated fadeOutDown"
								} 
						});
	                    document.getElementById("add_event").reset();
			            $('.EventModal').modal('hide');
			            get_events();
                	}
                }
            });
	}
            else
            {
            	$.notify({
						title: "<strong>Prohibited</strong> ",
						message: "Cannot add event on past dates.",
					},
					{
						type: "danger",
						z_index: 3000,
						delay: 800,
						animate:{
							enter: "animated fadeInUp",
							exit: "animated fadeOutDown"
						}
				});
				document.getElementById("add_event").reset();
				$('.EventModal').modal('hide');
				get_events();
            }
        });
	    
	    // Bind the dates to datetimepicker.
    	// You should pass the options you need
    	/*$("#starts-at, #ends-at").datepicker({
    		format: 'dd/mm/yyyy HH:mm:ss'
    		// locale: 'ru'
    	});*/
    	$("#starts-at, #ends-at").flatpickr({
    		minDate: new Date().fp_incr(0),
    		maxDate: new Date().fp_incr(365)
    	});

	    // Whenever the user clicks on the "save" button om the dialog
	    $('#save-event').on('click', function() {
	        var title = $('#title').val();
	        var details = $('#details').val();
	        var event_type = $('#event_type').val();
	        if (title) {
	            var eventData = {
	                title: title,
	                /*details: $('#details').val();
	                event_type: $('#event_type').val();*/
	                start: $('#start').val(),
	                end: $('#start').val()
	            };
	            $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
	        }
	        $('#calendar').fullCalendar('unselect');

	        // Clear modal inputs
	        $('.EventModal').find('input').val('');

	        // hide modal
	        $('.EventModal').modal('hide');
	    });

	    $('#del_ev').on('click', function() {
	        var ev_id = $('.EventModal').find('#ev_id').val();
	       	$.ajax({
                url: '<?php echo site_url();?>/calendar/delete_event/'+ev_id,
                dataType :"json",
                async:false,
                type: 'POST',
                success: function(response)
                {
                	var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Event Deleted Successfully!';
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
                    document.getElementById("add_event").reset();
		            $('.EventModal').modal('hide');
		            get_events();
                }
            });
	    });
	});

	function get_events()
	{
		$.ajax({
            url: '<?php echo site_url();?>/calendar/event_details',
            dataType :"json",
            async:false,
            type: 'POST',
            success: function(response)
            {
                $('#calendar').fullCalendar('removeEvents');
                $('#calendar').fullCalendar('addEventSource', response);
            }
        });
	}
</script>
<script src="<?php echo assets_url();?>js/lib/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo assets_url();?>js/lib/fullcalendar/fullcalendar-init.js"></script>
<script src="<?php echo assets_url();?>js/lib/flatpickr/flatpickr.min.js"></script>