<!DOCTYPE HTML>
<html>
<title></title>
<head>
	
	 <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	 <style type="text/css">
	 	table{
	 		
	 		font-family: initial;
	 		 border-collapse: collapse;
	 		 font-size: 13px;
	 	}
	 td, th { 
			 
			  text-align: left; 
			  border-bottom:1px solid #999; 
			  border-right: 1px solid #999;
			   border-collapse: collapse;
			}
			td:last-child {
				
				border-right: none;
			}
		
		
		
	 </style>
</head>
<body>
	<h1>harshali</h1>
<table  cellpadding="2" cellspacing="0" style="border: 1px solid #999">
	<tr>
		<td rowspan="3" style="text-align: center;"><img src="<?php echo LOGOPATH;?>" width="120px" ></td>
			<td colspan="3" style="border-bottom:1px solid #999;">Raoson Business & Softtech Solution</td>
	</tr>
	<tr>
		<td colspan="3" style="border-bottom:1px solid #999;">816, 8th Floor, DBS Business Center,The Corporate Park,<br>Sector:18, Vashi, Navi Mumbai Landline: 02227771800 Ext.814</td>
	</tr>
	<tr>
		<td colspan="3" style="border-bottom:1px solid #999;">Pay Slip For the Month Of <?php echo $salary_slip->month." / ".$salary_slip->year; ?></td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid #999;">Employee Code:</td>
		<td style="border-bottom:1px solid #999;"><?php echo $salary_slip->can_id;?></td>
		<td style="border-bottom:1px solid #999;">Name:</td>
		<td style="border-bottom:1px solid #999;"><?php echo $salary_slip->can_name;?></td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #999;">Department</td>
		<td style="border-bottom: 1px solid #999;"><?php echo $salary_slip->department; ?></td>
		<td style="border-bottom: 1px solid #999;">Designation</td>
		<td style="border-bottom: 1px solid #999;"><? echo $salary_slip->designation;?></td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #999;">Joining Date</td>
		<td style="border-bottom: 1px solid #999;"><? echo $salary_slip->joining_date?></td>
		<td style="border-bottom: 1px solid #999;"><b>Balance PL</b></td>
		<td style="border-bottom: 1px solid #999;"><?= $salary_slip['balance_leave'] ?></td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #999;">PAN No.</td>
		<td style="border-bottom: 1px solid #999;"><?= strtoupper($salary_slip['pan_no'])?></td>
		<td style="border-bottom: 1px solid #999;"><!-- <b>Balance CL</b> --></td>
		<td style="border-bottom: 1px solid #999;"></td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #999;">Department.</td>
		<td style="border-bottom: 1px solid #999;">IT</td>
		<td style="border-bottom: 1px solid #999;"><!-- <b>Balance SL</b> --></td>
		<td style="border-bottom: 1px solid #999;"></td>
	</tr>
	<tr style="background-color: grey;">
		<td style="padding:10px;background-color: grey;"><b>Earning & Reimbursement</b></td>
		<td style="border-bottom: 1px solid #999;background-color: grey;"><b>Gross Rs.</b></td>
		<td style="border-bottom: 1px solid #999;background-color: grey;"><b>Earning Rs.</b></td>
		<td style="border-bottom: 1px solid #999;background-color: grey;"><b>Deduction & Recovery</b></td>
	</tr>
	
	<tr style="background-color: grey;">
		<td style="padding:10px"><b>Total Earned</b></td><td><b><? echo $salary_slip['earn_total'] ?></b></td>
		<td><b>Total Deduction</b></td><td><b><?=$salary_slip['total_deduction'] ?></b></td>
	</tr>
	<tr >
		<td style="padding:10px"></td><td><b></b></td>
		<td style="padding:10px;background-color: grey;"><b>Net Pay</b></td><td><b><? echo $salary_slip['net_pay'] ?></b></td>
	</tr>
</table>
</body>
</html>
