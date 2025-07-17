<style type="text/css">
	#summerytab td{
		width:25%;
		border:1px solid #ccc;
		margin: 10px 10px;
	}
	#example td, #example th,#example input{
		text-align: center;		
	}
	.in, .out{
		border:0;
		background: transparent;
	}
</style>
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
								<td>Full Days <span class="pull-right" style='background-color:#5fdbbc;color:#000; padding: 1px 8px 2px; border-radius: 4px;'><?php  echo $value['fullday'];  ?></span></td>
								<td>Holiday <span class="pull-right" style='background-color:#f66b84;color:#fff; padding: 1px 8px 2px; border-radius: 4px;'><?php  echo $value['holiday'];  ?></span></td>
								<td>Late Coming <span class="pull-right" style='background-color:#8D6658;color:#fff; padding: 1px 8px 2px; border-radius: 4px;'><?php  echo $value['latecome'];  ?></span></td>
							</tr>
							<tr>
								<td>Half Days <span class="pull-right" style='background-color:#71adff;color:#fff; padding: 1px 8px 2px; border-radius: 4px;'><?php  echo $value['halfday'];  ?></span></td>
								<td>Week Off <span class="pull-right" style='background-color:#8E44AD;color:#fff; padding: 1px 8px 2px; border-radius: 4px;'><?php  echo $value['weekoff'];  ?></span></td>
								<td>Early Leaving <span class="pull-right" style='background-color:#FFCC00;color:#000; padding: 1px 8px 2px; border-radius: 4px;'><?php  echo $value['earlyleave'];  ?></span></td>	
							</tr>
							<tr>
								<td>Total Leaves <span class="pull-right" style='background-color:#f9c365;color:#000; padding: 1px 8px 2px; border-radius: 4px;'><?php  echo $value['absent'];  ?></td>	
								<td>Work On Holiday <span class="pull-right" style='background-color:#44c44d;color:#fff; padding: 1px 8px 2px; border-radius: 4px;'><?php  echo $value['workonholiday'];  ?></span></td>							
								<td>Missed Punch <span class="pull-right" style='background-color:#000000;color:#fff; padding: 1px 8px 2px; border-radius: 4px;'><?php  echo $value['misspunch'];  ?></span></td>
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
							</tr>
						</thead>
						<tbody>
							<?php $days = cal_days_in_month(CAL_GREGORIAN, $this->uri->segment(3), $this->uri->segment(4)) ?>
										<?php for($i = 1; $i <= $days; $i++) { $e=0; ?>
										<tr>
											<td width="15%"><?php echo ($i < 10) ? '0'.$i : $i; ?>/<?php echo $value['month']; ?>/<?php echo $value['year']; ?></td>
											<td width="15%">
												<input type="time" class="in" name="<?php echo 'd'.$i.'_in_time'; ?>" id="<?php echo 'd'.$i.'_in_time'; ?>" value="<?php if(isset( $value['d'.$i.'_in_time'])){ echo $value['d'.$i.'_in_time']; } else { echo '-';} ?>" disabled>
											</td>
                    						<td width="15%">
                    							<input type="time" class="out" id="<?php echo 'd'.$i.'_out_time'; ?>" name="<?php echo 'd'.$i.'_out_time'; ?>" value="<?php if(isset( $value['d'.$i.'_out_time'])){ echo $value['d'.$i.'_out_time']; } else { echo '-';} ?>" disabled>
                    						</td>

											<td width="15%" id="<?php echo 'd'.$i.'_hours'; ?>" class="whour"><span class="label <?php echo $value[$i.'-day_color']; ?>"><?php echo $value['d'.$i.'_hours']; ?></span></td>
											<?php if(empty($value['d'.$i.'_in_time']) && !empty($value['d'.$i.'_out_time'])) { ?>
												<td width="15%" style="background-color:#000000;color:#fff;">
											<?php } else if(!empty($value['d'.$i.'_in_time']) && empty($value['d'.$i.'_out_time'])) { ?>
												<td width="15%" style="background-color:#000000;color:#fff;">
											<?php } else if(($value['d'.$i.'_hours'] >= $this->config->item('half_hours_per_day')) && ($value['d'.$i.'_hours'] < $this->config->item('grace_time'))) { 
													++$e;
													if($e <= 2) { ?>
														<td width="15%" style="background-color:#FFCC00;color:#000;">
													<?php } else { ?>
														<td width="15%" class="<?php echo $value[$i.'-day_color']; ?>">
											<?php } } else if($value['d'.$i.'_in_time']>=$this->config->item('late_mark_time')) { ?>
												<td width="15%" style="background-color:#8D6658;color:#fff;">
											<?php } else { ?>
												<td width="15%" class="<?php echo $value[$i.'-day_color']; ?>">
											<?php } ?>
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
									<?php } ?>
								</tr>
							<?php } } else { ?>
								<tr>
									<td colspan="31"><span class="text-danger h1">No records found.</span></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->