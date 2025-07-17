<link href="<?php echo base_url()?>assets/css/mdtimepicker.css" rel="stylesheet" type="text/css">

<div class="page-content">
	<div class="container-fluid">
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
					<h1 class="well headline">Task Manager</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Task Name<span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Enter Task Name" type="text" name="task_name" id="task_name" required value="<?php echo set_value('task_name');?>">
											<i class="fa fa-user"></i>
											<span class="error_msg" id ="t_name_err"></span>
										</div>
									</div>
								</div>
							</div>
										
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Description <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<textarea placeholder="Enter Task Description" rows="3" name="task_description" id="task_description" class="form-control"></textarea>
											<span class="error_msg" id ="t_desc_err"></span>	
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Turn Around Time</label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-4 col-xs-4">
									 <!-- <div class="form-group date">
										<div class="input-group" id="datetimepicker1">
											<input type="text" class="form-control" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
										</div>
									</div>-->
									  <div class="form-group">
										<div class="input-group input-append date" id="datepicker1" data-date-start-date="0d">
											<input type="text" class="form-control" name="tat" id="tat" placeholder="dd/mm/yyyy" value="<?php echo set_value('tat');?>" />
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
										<span class="error_msg" id="err_tat"></span>								
									</div>  
							</div>
							<div class="col-lg-4 col-sm-4 col-xs-4">
								<input type="text" id="timepicker" placeholder="time" />
							</div>
						</div>

							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Priority </label>
									</div>
								</div>
							
								<div class="col-lg-10 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select class="form-control web chosen-select" id="priority" name="priority" style="width: 100%">
												  <option value="High">High</option>
												  <option value="Medium">Medium</option>
												  <option value="Low">Low</option>
											</select>
										</div>
									</div>
								</div>
							</div>



													
							<div class="row">
								<div class="col-lg-6">
									<input type="submit" id="submit_task" value="Save" class="btn btn-inline btn-success ladda-button"/>
									<input id="showmenu" type="button" value="Assign Task" class="btn btn-inline ladda-button" disabled="" />
									<input id="showmenu" type="button" value="Reset" class="btn btn-inline ladda-button reset"/>		
								</div>
							</div>
					</div>
				</form>
			 </div>
		</div>
		
		<div class="menu" style="display: none; margin-top:10px;">
			<div class="well">
				<div class="row">
					<form class="col-sm-12" id="task_form" action=" " method="post">
						<input type="hidden" name="task_id" id="task_id">
							<h1 class="well headline">Assign Task To : </h1>
							<div class="col-sm-12 col-xs-12 profile_bg">		
								<div class="form-group">
									<select class="chosen-select col-md-12 col-sm-12 col-xs-12 " name="candidates[]" id="candidates" multiple style="width: 100px">
									  <option value="Select Name" disabled hidden>Select Name</option>
									  <?php foreach ($candidates as $key => $candidate) {?>
									 	 <option value="<?php echo $candidate->can_id?>"><?php echo $candidate->can_name?></option>									  	
									  <?php }?>
									</select>
									</div>
									<span class="error_msg" id="err_can"></span>
								<div class="row">
									<div class="col-lg-6">
										<input type="button" value="Save" class="btn btn-inline btn-success ladda-button" id="assign_task"/>
									</div>
								</div>
										</div>
							</div>
					</form>
				</div>
			</div>
		</div>										
	</div>
</div>
<script src="<?php echo base_url()?>assets/js/mdtimepicker.js"></script>

<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->

<script>

	$(document).ready(function() {
		$('#timepicker').mdtimepicker();
		$(".chosen-select").chosen();
		//$('#datetimepicker1').datetimepicker();
		$('#datepicker1').datepicker({
			format: 'dd/mm/yyyy',
			autoclose : true,
			minDate: new Date()
  		 	});
        $('#showmenu').click(function() {
            $('.menu').slideToggle("fast");
        });

 	  $('#submit_task').click(function (e) {		
			e.preventDefault();
			var task_name= $('#task_name').val();
			var task_description = $('#task_description').val();
			var tat = $('#tat').val();
			var time = $('#timepicker').val();
			var priority = $('#priority').val();
			if($('#task_name').val()=='')
			{
			$('#t_name_err').text(" Please Enter Task Name").show().delay(2000).fadeOut(800);
	         event.preventDefault();
			}
			else if($('#task_description').val()=='')
			{
			$('#t_desc_err').text(" Please Enter Task Description").show().delay(2000).fadeOut(800);
	         e.preventDefault();
			}
			else
			{
				$('#submit_task').attr('disabled',true);			
				$.ajax({
					url: '<?php echo site_url();?>/task/save_task',
					dataType :"json",
					data : {task_name: task_name, task_description:task_description, tat:tat, priority:priority,time:time},
					type: 'POST',
					success: function(response){
						console.log(response.task_id);
						$.notify({
								title: "<strong>Success</strong> ",
								message: "Task Created Successfully",
							},
							{
								type: "success",
								delay: 500,
								animate:{
								enter: "animated fadeInUp",
								exit: "animated fadeOutDown"
								}
							});
							$('#showmenu').removeAttr('disabled');
							$('#task_id').val(response.task_id);
							//window.setTimeout(function(){location.href = '<?php //echo site_url();?>/task'},1000);
							//setTimeout(function () {
							//window.location.href = '<?php //echo site_url();?>/task'
	    						//}, 2000);
			   		}
				});
			}
		});

		

	   $('#assign_task').click(function (e) {		
			e.preventDefault();
			var task_id= $('#task_id').val();
			var candidates = [];
			$.each($("#candidates option:selected"), function(){            
				candidates.push($(this).val());
			});
			if(candidates=== null)
			{
				$('#err_can').html('Select Employees!').show().delay(2000).fadeOut(800);
			}
			else if($("#candidates ")[0].selectedIndex <= 0)
			{
				$('#err_can').html('Select Employees!').show().delay(2000).fadeOut(800);
			}
			else
			{
				$('#assign_task').attr('disabled', true);
				$.ajax({
					url: '<?php echo site_url();?>/task/assign_task',
					data : {task_id: task_id, candidates:candidates},
					type: 'POST',
					success: function(response){
						console.log(response.task_id);
						$.notify({
								title: "<strong>Success</strong> ",
								message: "Task Assigned Successfully",
							},
							{
								type: "success",
								delay: 500,
								animate:{
								enter: "animated fadeInUp",
								exit: "animated fadeOutDown"
								}
							});
						setTimeout(function () {
							window.location.href = '<?php echo site_url();?>/task'
	    						}, 2000);
							$('#showmenu').removeAttr('disabled');
							$('#task_id').val(response.task_id);
			   		}
				});
				}
		});
		$('.reset').click(function(){
			$('#showmenu').attr('disabled');			
		});

    });
	
	var classes = {
		2 : 'orange',
		4 : 'blue',
		5 : 'orange'
	};
	/*$('#basic').picker();
	$('#multi').picker({search : true,coloring: classes});*/
</script>	
