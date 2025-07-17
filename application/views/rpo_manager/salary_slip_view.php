<head>
	 <style type="text/css">
	 	table{
	 		font-family: initial;
	 		 border-collapse: collapse;
	 	}
	 td, th { 
			text-align: left; 
			border:1px solid #999; 
			border-collapse: collapse;
			padding:5px;
			font-size: 14px;
			}
			
	 </style>
</head>
<?php if(isset($rpoempsalary_details)){?>

	<div class="page-content">
	<div class="container-fluid">
		<div class="well">
			<section class="card">
		  <div class="row">
		  	<div class="col-md-12" style="padding:20px 0">
		  		<center>
			<table cellpadding="4" cellspacing="0" style="border: 1px solid #999;">
				<tr>
					<td rowspan="3" style="text-align: center;"><img align="center" src="<?php echo LOGOPATH;?>" width="150px"></td>
						<td colspan="3" align="center" style="border-bottom:1px solid #999; padding: 0;text-align: center;"><h3><strong>Raoson Business & Softtech Solution</strong></h3></td>
				</tr>
				<tr align="center">
					<td colspan="3" align="center" style="border-bottom:1px solid #999; padding: 0;text-align: center;font-size: 14px;font-weight: 300;">816, 8th Floor, DBS Business Center,The Corporate Park,<br>Sector:18, Vashi, Navi Mumbai Landline: 02227771800 Ext.814</td>
				</tr>
				<tr align="center">
					<td align="center" style="text-align: center;" colspan="3" ></td>
				</tr>	
				<tr>
					<td align="center" style="text-align: center;" colspan="4"><strong>Payslip for the Month of <?php echo $rpoempsalary_details->month." / ".$rpoempsalary_details->year; ?></strong></td>
				</tr>
				<tr>
					<td ><strong>Employee Code</strong></td>
					<td ><?php echo (isset($rpoempsalary_details->can_id) && !empty($rpoempsalary_details->can_id)) ? $rpoempsalary_details->can_id : '';?></td>
					<td ><strong>Name</strong></td>
					<td ><?php echo (isset($rpoempsalary_details->can_name) && !empty($rpoempsalary_details->can_name)) ? $rpoempsalary_details->can_name : '';?></td>
				</tr>
				<tr>
					<td ><strong>Department</strong></td>
					<td ><?php echo (isset($rpoempsalary_details->department) && !empty($rpoempsalary_details->department)) ? $rpoempsalary_details->department : '-';?></td>
					<td ><strong>Designation</strong></td>
					<td ><?php echo (isset($rpoempsalary_details->designation) && !empty($rpoempsalary_details->designation)) ? $rpoempsalary_details->designation : '';?></td>
				</tr>
				
				<tr>
					<td ><strong>Joining Date</strong></td>
					<td colspan="3"><?php echo (isset($rpoempsalary_details->joining_date) && !empty($rpoempsalary_details->joining_date)) ? $rpoempsalary_details->joining_date : '';?></td>
				</tr>
				
				<tr style="background-color: grey;">
					<td style="padding:10px;background-color: grey;text-align: center;" colspan="4"><strong>Earning & Deductions</strong></td>
				</tr>
				<tr>
					<td ><strong>Per Hour Rate</strong></td>
					<td ><?php echo (isset($rpoempsalary_details->amount) && !empty($rpoempsalary_details->amount)) ? $rpoempsalary_details->amount : '';?></td>
					<td ><strong>Paid Hours</strong></td>
					<td ><?php echo (isset($rpoempsalary_details->paid_hours) && !empty($rpoempsalary_details->paid_hours)) ? $rpoempsalary_details->paid_hours : '';?></td>
				</tr>
				<tr>
					<?php /* <td ><strong>Professional Tax</strong></td>
					<td ><?php echo (isset($rpoempsalary_details->prof_tax) && !empty($rpoempsalary_details->prof_tax)) ? $rpoempsalary_details->prof_tax : '';?></td>*/?>
					<td><strong>Total Earnings</strong></td>
					<td><?php echo (isset($rpoempsalary_details->total_earnings) && !empty($rpoempsalary_details->total_earnings)) ? $rpoempsalary_details->total_earnings : '';?></td>
					<td ><strong>TDS</strong></td>
					<td ><?php echo (isset($rpoempsalary_details->tds) && !empty($rpoempsalary_details->tds)) ? $rpoempsalary_details->tds : ''; ?></td>
				</tr>
				<tr>
					
					<td ><strong>Total Deductions</strong></td>
					<td><?php echo (isset($rpoempsalary_details->total_deduction) && !empty($rpoempsalary_details->total_deduction)) ? $rpoempsalary_details->total_deduction : ''; ?></td>
					<td><strong>Net Pay</strong></td>
					<td colspan="3"><?php echo (isset($rpoempsalary_details->net_pay) && !empty($rpoempsalary_details->net_pay)) ? $rpoempsalary_details->net_pay : '';?></td>
				</tr>
						
		</table>
	</center></div>
		</section>
</div>
</div>
</div>
<?php } else {?>
	<div class="row col-md-12">No records to display </div>
<?php } ?>
</div>