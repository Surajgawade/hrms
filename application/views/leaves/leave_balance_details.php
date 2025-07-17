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
			<h1 class="well headline">Yearly Leave Details
				<a style="margin-top:3px" class="pull-right btn btn-success btn-md m-r" href="<?php echo site_url('leave_management/apply_for_leave'); ?>">Apply Leave</a>
			</h1>
    <!--     <h1 class="well headline"> <a href="<?php //echo site_url('leave_management/apply_for_leave'); ?>" class="text-white pull-right m-r">Apply for Leave</a></h1> -->
			<section class="card">
				<div class="card-block table-responsive">
					<div class="text-center">
						<div class="small_box">
							<ul>
							<li><i class="fa fa-square cyan-color"></i>Earned Leaves : <?php echo $configuration['PL']; ?></li>
							<li><i class="fa fa-square darkgreen"></i>Sick Leaves : <?php echo $configuration['SL']; ?></li>
							<li><i class="fa fa-square yellow-color"></i>Casusal Leaves : <?php echo $configuration['CL']; ?></li>
							<li><i class="fa fa-square purple-color"></i>Compensatory Offs : 0</li>
							<li><i class="fa fa-square color-red"></i>Paid Holidays : <?php echo $holiday; ?></li>
						</ul>
						</div>
					</div>
					<br>
					
					<table class="display table table-bordered table-striped" id="summerytab" width="100%">
						<thead>
							<th colspan="3" class="h5" style="padding:5px 8px; font-weight:400;">Leave Summary</th>
						</thead>
						<tbody>
							<tr>
								<td>Alloted Leaves : <?php echo $leave_details['alloted_leave']; ?></td>
								<td>Leaves Balance : <?php echo $leave_details['balance_leave']; ?></td>
								<td>Leaves Taken : <?php echo $leave_details['alloted_leave']-$leave_details['balance_leave']; ?></td>
							</tr>
						</tbody>
					</table>
					<br><br>
					
					<table class="display table-responsive table table-bordered table-striped" width="100%">

						<thead>
							<th colspan="7" class="h5" style="padding:5px 8px; font-weight:400;">Applied leaves in Detail</th>
						</thead>
						<tbody>
							<tr>
								<td class="text-center"><strong>Emp. Code</strong></td>
								<td class="text-center"><strong>Name</strong></td>
								<td class="text-center"><strong>From Date</strong></td>
								<td class="text-center"><strong>To date</strong></td>
								<td class="text-center"><strong>Reason</strong></td>
								<td class="text-center"><strong>Status</strong></td>
								<td class="text-center"><strong>Reporting To</strong></td>
							</tr>
							<?php if(!empty($leave_taken)) { 
								foreach($leave_taken as $key1 => $value1) { ?>
								<tr>
									<td><?php echo @$value1['emp_code']; ?></td>
									<td><?php echo $value1['can_name']; ?></td>
									<td><?php echo db_to_date($value1['from_date']); ?></td>
									<td><?php echo db_to_date($value1['to_date']); ?></td>
									<td><?php echo $value1['reason']; ?></td>
									<td>
										<?php if($value1['status'] == 0) {
											echo "Pending";
										} else if($value1['status'] == 1) {
											echo "Approved";
										} else {
											echo "Rejected";
										}?>
									</td>
									<td><?php echo @$value1['reporting_to']; ?></td>
								</tr>
							<?php } } else { ?>
								<tr>
									<td colspan="7" class="text-center"><strong class="text-danger h3">No Records Found.</strong></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					<br><br>

					<table class="display table table-bordered table-striped" width="100%">
						<thead>
							<th colspan="<?php echo count(@$leave_type); ?>" class="h5" style="padding:5px 8px; font-weight:400;">Leaves per Type</th>
						</thead>
						<tbody>
							<tr>
								<?php if(!empty($leave_type)) { 
								foreach($leave_type as $key2 => $value2) { ?>
									<td><?php if(isset($value2['leave_title'])){ echo $value2['leave_title'].'/s Taken'.' : '.$value2['days']; } ?></td>
								<?php } } else { ?>
									<td colspan="<?php echo count(@$leave_type); ?>" class="text-center"><strong class="text-danger h3">No Records Found.</strong></td>
								<?php } ?>
							</tr>
						</tbody>
					</table>
					<br><br>
					
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->