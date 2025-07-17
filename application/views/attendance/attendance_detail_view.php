<body class="with-side-menu-addl-full">
	<div class="page-content">
		<div class="container-fluid">
        <h1 class="well headline">Attendance Details</h1>
			
			<section class="card">
				<div class="card-block">
					<div class="text-center">
						<strong>Month : <?php echo date("F", mktime(0, 0, 0, $this->uri->segment(3), 15)); ?></strong> of <strong>Year : <?php echo $this->uri->segment(4); ?></strong>
						<div class="small_box">
							<ul>
							<li><i class="fa fa-square cyan-color"></i>Half Day</li>
							<li><i class="fa fa-square darkgreen"></i>Present</li>
							<li><i class="fa fa-square yellow-color"></i>Absent</li>
							<li><i class="fa fa-square purple-color"></i>Weekly Off</li>
							<li><i class="fa fa-square color-red"></i>Leave</li>
							<li><i class="fa fa-square darkpink-color"></i>Holidays</li>
						</ul>
						</div>
					</div>
					<table id="example" class="display table-responsive table table-bordered table-striped attend_list" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Employee Name</th>
								<?php $days = cal_days_in_month(CAL_GREGORIAN, $this->uri->segment(3), $this->uri->segment(4)) ?>
								<?php for($i = 1; $i <= $days; $i++) { ?>
									<th><?php echo $i; ?></th>
								<?php } ?>
								<th>Total Working</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($attendance_records)) {
								foreach($attendance_records as $key => $value) { ?>
								<tr>
									<td><span><?php echo $value['name']; ?></span></td>
									<?php for($i = 1; $i <= $days; $i++) {
										if ($value[$i.'-presenty'] == 'P') { ?>
											<td class="darkgreenbg"><span><?php echo $value[$i.'-presenty']; ?></span></td>
										<?php } else if($value[$i.'-presenty'] == 'H') { ?>
											<td class="cyan-colorbg"><span><?php echo $value[$i.'-presenty']; ?></span></td>
										<?php } else { ?>
											<td class="<?php echo $value[$i.'-day_color']; ?>"><span><?php echo $value[$i.'-presenty']; ?></span></td>
									<?php } } ?>
									<td><span><?php echo $value['total']; ?></span></td>
									<td><a  href="<?php echo site_url('attendance/attendance_indiv_view/').$value['month'].'/'.$value['year'].'/'.$value['can_id']; ?>" class="tabledit-edit-button btn btn-primary btn-sm btn_edit"><span></span>View</a></td>
								</tr>
							<?php } } else { ?>
								<tr>
									<td colspan="33"><span class="text-danger h1">No records found.</span></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	