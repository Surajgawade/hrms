<body class="with-side-menu-addl-full">

	<div class="page-content">
		<div class="container-fluid">
        <h1 class="well headline">Attendance List</h1>
			
			<section class="card">
				<div class="card-block">
					<table id="example" class="display table table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:15%">Month</th>
								<th style="width:15%">Year</th>
								<th style="width:15%">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($attendance_list)) {
								foreach($attendance_list as $key => $value) { ?>
								<tr>
									<td><span><?php echo date("F", mktime(0, 0, 0, $value['month'], 15)); ?></span></td>
									<td><span><?php echo $value['year']; ?></span></td>
									<td><a  href="<?php echo site_url('attendance/attendance_view/').$value['month'].'/'.$value['year']; ?>" class="tabledit-edit-button btn btn-primary btn-sm btn_edit"><span></span>View</a></td>
								</tr>
							<?php } } 
							//else { ?>
								<!-- <tr>
									<td colspan="3"><span class="text-danger h1">No records found.</span></td>
								</tr> -->
							<?php //} ?>
						</tbody>
					</table>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	
	<script>
		$(function(){
			$('#example').DataTable({
				responsive: true
			});
		});
	</script>