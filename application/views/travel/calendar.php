<link rel="stylesheet" href="<?php echo assets_url();?>css/lib/fullcalendar/fullcalendar.min.css"></link>
<link rel="stylesheet" href="<?php echo assets_url();?>css/separate/pages/calendar.css"></link>

<div class="page-content">
	<div class="container-fluid">
		<div class="box-typical">
			<div class="calendar-page">

				<div class="calendar-page-content">
					<div class="calendar-page-title">Calendar</div>
					<div class="calendar-page-content-in">
						<div id='calendar'></div>
						<div id='datepicker'></div>
					</div><!--.calendar-page-content-in-->
				</div><!--.calendar-page-content-->

				<div class="calendar-page-side">
					 <section class="calendar-page-side-section">
						<div class="calendar-page-side-section-in">
							<div id="side-datetimepicker"></div>
						</div>
					</section>

	    			<section class="calendar-page-side-section">
						<header class="box-typical-header-sm">Filters</header>
						<div class="calendar-page-side-section-in">
							<ul class="colors-guide-list">
								<li>
									<div class="color-double green"><div></div></div>
									Appointments
								</li>
								<li>
									<div class="color-double"><div></div></div>
									Meetings
								</li>
								<li>
									<div class="color-double orange"><div></div></div>
									Follow up calls
								</li>
		    					<li>
									<div class="color-double coral"><div></div></div>
									Training
								</li>
									<li>
									<div class="color-double seagreen"><div></div></div>
									Task
								</li>
								<li>
									<div class="color-double purple"><div></div></div>
									Leave
								</li>
		    					<li>
									<div class="color-double lightpink"><div></div></div>
									Travel
								</li>
							</ul>
						</div>
					</section>
				</div><!--.calendar-page-side-->

				<!-- .modal-dialog for calendar notes -->

				<div class="modal fade" tabindex="-1" role="dialog">
				    <div class="modal-dialog" role="document">
				        <div class="modal-content">
				            <div class="modal-header">
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				                <h4 class="modal-title">Create new event</h4>
				            </div>
				            <div class="modal-body">
				            	<form data-toggle="validator" class="col-sm-12" id="add_event" action=" " method="post">
				            	<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label" for="event_type">Event Type</label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
		                                    <div class="form-control-wrapper form-control-icon-right">
		                                        <select id="event_type" name="event_type" class="web col-lg-12" required>
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
											<label class="form-label" for="title">Event title</label>
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
											<label class="form-label" for="starts-at">Starts at</label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control" type="text" name="start" id="starts-at">
											</div>
										</div>
									</div>
								</div>

				               <div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label" for="ends-at">Ends at</label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control" type="text" name="end" id="ends-at">
											</div>
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
				                <button type="submit" class="btn btn-primary" id="save">Save changes</button>
				            </div>
				        </form>
				        </div><!-- /.modal-content -->
				    </div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
			</div><!--.calendar-page-->
		</div><!--.box-typical-->
	</div><!--.container-fluid-->
</div><!--.page-content-->

<script type="text/javascript">
	$(document).ready(function() {

		$('#calendar').fullCalendar({
	        header: {
	            left: 'prev,next today',
	            center: 'title',
	            right: 'month,agendaWeek,agendaDay'
	        },
	        defaultDate: new Date(),
	        navLinks: true, // can click day/week names to navigate views
	        selectable: true,
	        selectHelper: true,
	        select: function(start, end) {
	            // Display the modal.
	            // You could fill in the start and end fields based on the parameters
	            document.getElementById("add_event").reset();
	            $('.modal').find('#starts-at').val(start.format("DD/MM/YYYY"));
	            $('.modal').find('#ends-at').val(start.format("DD/MM/YYYY"));
	            $('.modal').find('#ev_id').val('');
	            $('.modal').find('#title').val('');
	            $('.modal').find('#save').removeClass('hidden');
	            $('.modal').find('#del_ev').addClass('hidden');
	            $('.modal').modal('show');
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
	                    $('.modal').find('#ev_id').val(response.ev_id);
			            $('.modal').find('#starts-at').val(response.start);
			            $('.modal').find('#ends-at').val(response.end);
			            $('.modal').find('#title').val(response.title);
			            $('.modal').find('#details').val(response.details);
			            $('.modal').find('#event_type').val(response.event_type);
			            if((response.event_type == 'leave') || (response.event_type == 'task') || (response.event_type == 'travel'))
			            {
			            	$('.modal').find('#del_ev').addClass('hidden');
			            	$('.modal').find('#save').addClass('hidden');
			            }
			            else
			            {
			            	$('.modal').find('#save').removeClass('hidden');
			            	$('.modal').find('#del_ev').removeClass('hidden');
			            }
			            $('.modal').modal('show');
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
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: 'The Event Title is required and can\'t be empty'
                        }
                    }
                },
                event_type: {
                    validators: {
                        notEmpty: {
                            message: 'The Event Type is required and can\'t be empty'
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
            $.ajax({
                url: '<?php echo site_url();?>/calendar/add_event_details',
                dataType :"json",
                async:false,
                data : fdata,
                type: 'POST',
                success: function(response)
                {
                	console.log(response);
                	if((response.result == false) || (response.result == 0))
                	{
                		$.notify({
	                        type: 'danger',
	                        title: "<strong>OOPs:</strong> ",
	                        message: response.msg,
	                        delay: 5000,
	                        animate:{
	                            enter: "animated fadeInUp",
	                            exit: "animated fadeOutDown"
	                        }
	                    });
                	}
                	else
                	{
                		$.notify({
	                        type: 'success',
	                        title: "<strong>Success:</strong> ",
	                        message: "Event details saved successfully!",
	                        delay: 5000,
	                        animate:{
	                            enter: "animated fadeInUp",
	                            exit: "animated fadeOutDown"
	                        }
	                    });
	                    document.getElementById("add_event").reset();
			            $('.modal').modal('hide');
			            get_events();
                	}
                }
            });
        });
	    
	    // Bind the dates to datetimepicker.
    	// You should pass the options you need
    	$("#starts-at, #ends-at").datepicker({
    		format: 'dd/mm/yyyy',
    		date: new Date()
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
	        $('.modal').find('input').val('');

	        // hide modal
	        $('.modal').modal('hide');
	    });

	    $('#del_ev').on('click', function() {
	        var ev_id = $('.modal').find('#ev_id').val();
	       	$.ajax({
                url: '<?php echo site_url();?>/calendar/delete_event/'+ev_id,
                dataType :"json",
                async:false,
                type: 'POST',
                success: function(response)
                {
                	if(response == true)
                	{
	                	$.notify({
	                        type: 'success',
	                        title: "<strong>Success:</strong> ",
	                        message: "Event deleted successfully!",
	                        delay: 5000,
	                        animate:{
	                            enter: "animated fadeInUp",
	                            exit: "animated fadeOutDown"
	                        }
	                    });
	                }
	                else
	                {
	                	$.notify({
	                        type: 'danger',
	                        title: "<strong>OOPs:</strong> ",
	                        message: "Something went wrong !!",
	                        delay: 5000,
	                        animate:{
	                            enter: "animated fadeInUp",
	                            exit: "animated fadeOutDown"
	                        }
	                    });
	                }
                    document.getElementById("add_event").reset();
		            $('.modal').modal('hide');
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