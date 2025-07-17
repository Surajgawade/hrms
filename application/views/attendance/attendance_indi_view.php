<style type="text/css">
	#summerytab td{
		width:25%;
		border:1px solid #ccc;
		margin: 10px 10px;
	}
	#example td, #example th,#example input{
		text-align: center;		
	}
	.in,.out{
		border:0;
		background: transparent;
	}
</style>
<link rel="stylesheet" href="<?php echo assets_url();?>css/lib/clockpicker/bootstrap-clockpicker.min.css">
<?php if($this->session->flashdata('success')){?>
			<script type="text/javascript">
				var message_text='<?php echo $this->session->flashdata('success');?>';
					$.notify({
							title: "<strong>Success:</strong> ",
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
<body class="with-side-menu-addl-full">
	<div class="page-content">
		<div class="container-fluid">
        <h1 class="well headline">Attendance Details</h1>
			<!-- <?php echo "<pre>";var_dump($attendance_records); ?> -->
			<section class="card">
				<div class="card-block table-responsive">
					<div class="text-center">
						<strong>Month : <?php echo date("F", mktime(0, 0, 0, $this->uri->segment(3), 15)); ?></strong> of <strong>Year : <?php echo $this->uri->segment(4); ?></strong>
						<div class="small_box">
							<ul>
							<li><i class="fa fa-square cyan-color"></i>Half Day</li>
							<li><i class="fa fa-square darkgreen"></i>Present</li>
							<li><i class="fa fa-square yellow-color"></i>Absent</li>
							<li><i class="fa fa-square purple-color"></i>Weekly Off</li>
							<li><i class="fa fa-square color-red"></i>Leave</li>
							<li><i class="fa fa-square" style="color: #44c44d;"></i>Work On Holiday</li>
							<li><i class="fa fa-square" style="color: #8D6658;"></i>Late Coming </li>
							<li><i class="fa fa-square" style="color: #FFCC00;"></i>Early Leaving</li>
							<li><i class="fa fa-square" style="color: #000000;"></i>Missed Punch</li>
						</ul>
						</div>
					</div>	<hr>
					<?php if(!empty($attendance_records)) {
						foreach($attendance_records as $key => $value) { ?>
					<h3>Employee Name: <?php echo $value['name']; ?><h3>
					<table class="display table table-bordered table-striped" id="summerytab" width="100%">
						
						<thead>
							<th colspan="4">This Month Summary</th>
						</thead>
						<?php if(!empty($attendance_records)) {
								foreach($attendance_records as $key => $value) { ?>
						<tbody>
							<tr>
								<td>Full Days <span class="pull-right" style='background-color:#5fdbbc !important;color:#000; padding: 3px 8px; border-radius: 10px;'><?php  echo $value['fullday'];  ?></span></td>
								<td>Holiday <span class="pull-right" style='background-color:#f66b84;color:#fff; padding: 3px 8px; border-radius: 10px;'><?php  echo $value['holiday'];  ?></span></td>
								<td>Late Coming <span class="pull-right" style='background-color:#8D6658;color:#fff; padding: 3px 8px; border-radius: 10px;'><?php  echo $value['latecome'];  ?></span></td>
							</tr>
							<tr>
								<td>Half Days <span class="pull-right" style='background-color:#71adff;color:#fff; padding: 3px 8px; border-radius: 10px;'><?php  echo $value['halfday'];  ?></span></td>
								<td>Week Off <span class="pull-right" style='background-color:#8E44AD;color:#fff; padding: 3px 8px; border-radius: 10px;'><?php  echo $value['weekoff'];  ?></span></td>
								<td>Early Leaving <span class="pull-right" style='background-color:#FFCC00;color:#000; padding: 3px 8px; border-radius: 10px;'><?php  echo $value['earlyleave'];  ?></span></td>	
							</tr>
							<tr>
								<td>Total Leaves <span class="pull-right" style='background-color:#f9c365;color:#000; padding: 3px 8px; border-radius: 10px;'><?php  echo $value['absent'];  ?></td>	
								<td>Work On Holiday <span class="pull-right" style='background-color:#44c44d;color:#fff; padding: 3px 8px; border-radius: 10px;'><?php  echo $value['workonholiday'];  ?></span></td>							
								<td>Missed Punch <span class="pull-right" style='background-color:#000000;color:#fff; padding: 3px 8px; border-radius: 10px;'><?php  echo $value['misspunch'];  ?></span></td>
							</tr>
						</tbody>
						<?php } } ?>
					</table>
					<table id="example" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Date</th>
								<th>In Time</th>
								<th>Out Time</th>
								<th>Work Duration</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $days = cal_days_in_month(CAL_GREGORIAN, $this->uri->segment(3), $this->uri->segment(4)) ?>
										<?php for($i = 1; $i <= $days; $i++) { ?>
										<tr>
											<td width="15%"><?php echo ($i < 10) ? '0'.$i : $i; ?>/<?php echo $value['month']; ?>/<?php echo $value['year']; ?></td>
											<td width="15%">
=
												<input type="text" class="in form-control clockpicker" name="<?php echo 'd'.$i.'_in_time'; ?>" id="<?php echo 'd'.$i.'_in_time'; ?>" value="<?php if(isset( $value['d'.$i.'_in_time'])){ echo $value['d'.$i.'_in_time']; } else { echo '-';} ?>" disabled>
											</td>
                    						<td width="15%">
                    							<input type="text" class="out form-control clockpicker" id="<?php echo 'd'.$i.'_out_time'; ?>" name="<?php echo 'd'.$i.'_out_time'; ?>" value="<?php if(isset( $value['d'.$i.'_out_time'])){ echo $value['d'.$i.'_out_time']; } else { echo '-';} ?>" disabled>
                    						</td>

											<td width="15%" id="<?php echo 'd'.$i.'_hours'; ?>" class="whour"><span class="label <?php echo $value[$i.'-day_color']; ?>"><?php echo $value['d'.$i.'_hours']; ?></span></td>
											<td width="15%" class="<?php echo $value[$i.'-day_color']; ?>">
											<?php 
												if($value[$i.'-presenty']=='P'){
													echo 'Present';
												}else if($value[$i.'-presenty']=='H'){
													echo 'Half Day';
												}else if($value[$i.'-presenty']=='A'){
													echo 'Absent';
												}else if($value[$i.'-presenty']=='W'){
													echo 'Week Off';
												}else if($value[$i.'-presenty']=='L'){
													echo 'Leave';
												}else if($value[$i.'-presenty']=='O'){
													echo 'Holiday';
												}
											?>
											</td>
											<td width="15%">
												<!-- <a  href="<?php echo site_url('attendance/attendance_edit').'/'.$value['can_id']; ?>" class="tabledit-edit-button btn btn-success btn-sm btn_edit"><span>Edit</span></a> -->
												<button class="tabledit-edit-button btn btn-success btn-sm btn_edit" id="btn_edit" class="btn_edit">Edit</button>
												<button class="tabledit-edit-button btn btn-primary btn-sm btn_save" id="btn_save" class="btn_save" style='display:none;' >save</button>
												<input type="hidden" name="atn_id" id="atn_id" value="<?php echo $value['atn_id']; ?>">
											</td>
									<?php } ?>
								</tr>
							<?php } } else { ?>
								<tr>
									<td colspan="32"><span class="text-danger h1">No records found.</span></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->

<script src="<?php echo assets_url();?>js/lib/clockpicker/bootstrap-clockpicker.min.js"></script>
<script src="<?php echo assets_url();?>js/lib/clockpicker/bootstrap-clockpicker-init.js"></script>
<script type="text/javascript">
	
	$(document).ready(function(){
		$('.btn_edit').click(function() {
		 	console.log("edit button");
        $(this).parents('tr').find('input').removeAttr('disabled').css('background-color','#ccc');
        $(this).parents('tr').find('input').addClass('clockpicker');
        $(this).parents('tr').find('button').css('display','inline');
    	});

    	$('.btn_save').click(function(){
    		var intime=$(this).parents('tr').find('.in').val();
    		var inid=$(this).parents('tr').find('.in').attr('id');
    		var outtime=$(this).parents('tr').find('.out').val();
    		var outid=$(this).parents('tr').find('.out').attr('id');
    		var whour=$(this).parents('tr').find('.whour').attr('id');
    		var atn_id=$("#atn_id").val();

    		if(intime > outtime){
    			$.notify({
					type: 'Error',
					title: "<strong>Error:</strong> ",
					message: "InTime must be less than OutTime!",
					delay: 2000,
					animate:{
						enter: "animated fadeInUp",
						exit: "animated fadeOutDown"
					}
				});
       		}else{

    		$.ajax({
    			data:{'intime':intime,'outtime':outtime,'inid':inid,'outid':outid,'whour':whour,'atn_id':atn_id},
    			type:'POST',
    			url:'<?php echo site_url(); ?>/attendance/updatetime',
    			success:function(output){
    				$.notify({
					type: 'success',
					title: "<strong>Success:</strong> ",
					message: "Time updated successfully!",
					delay: 2000,
					animate:{
						enter: "animated fadeInUp",
						exit: "animated fadeOutDown"
					}
				});
    				
    			},
    			error:function(error){
    				console.log(error.responceText);
    			}
    		});
       		}

    		
    		$(this).parents('tr').find('.in').attr('readonly',true);
    		setTimeout(function () {
				location.reload();
    		}, 2000);


    	});
	});
</script>
<link rel="stylesheet" href="<?php echo assets_url();?>css/lib/clockpicker/bootstrap-clockpicker.min.css">
 <script src="<?php echo assets_url();?>js/lib/clockpicker/bootstrap-clockpicker.min.js"></script>
<script src="<?php echo assets_url();?>js/lib/clockpicker/bootstrap-clockpicker-init.js"></script>