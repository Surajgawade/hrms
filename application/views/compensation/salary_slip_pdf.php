<head>
	
	 <style type="text/css">
	 	table{
	 		
	 		font-family: initial;
	 		 border-collapse: collapse;

	 	}
	 td, th { 
			 
			  text-align: left; 
			  border-bottom:1px solid #999; 
			  border-right: 1px solid #999;
			   border-collapse: collapse;
			   padding:5px;
			}
			td:last-child {
				
				border-right: none;
			}
		
		
		
	 </style>
</head>
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
						<td colspan="3" align="center" style="border-bottom:1px solid #999; padding: 0;text-align: center;">Raoson Business & Softtech Solution</td>
				</tr>
				<tr align="center">
					<td colspan="3" align="center" style="border-bottom:1px solid #999; padding: 0;text-align: center;">816, 8th Floor, DBS Business Center,The Corporate Park,<br>Sector:18, Vashi, Navi Mumbai Landline: 02227771800 Ext.814</td>
				</tr>
				<tr align="center">
					<td align="center" style="text-align: center;" colspan="3" >Pay Slip For the Month Of <?php echo $salary_slip['month']." / ".$salary_slip['year']; ?></td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #999;">Employee Code:</td>
					<td style="border-bottom:1px solid #999;"><?php echo $candidate_data['can_id']; ?></td>
					<td style="border-bottom:1px solid #999;">Name:</td>
					<td style="border-bottom:1px solid #999;"><?php echo $candidate_data['can_name']; ?></td>
				</tr>
				<tr>
					<td style="border-bottom: 1px solid #999;">PF No</td>
					<td style="border-bottom: 1px solid #999;"></td>
					<td style="border-bottom: 1px solid #999;">Designation</td>
					<td style="border-bottom: 1px solid #999;"><?= $candidate_data['job_profile_title']?></td>
				</tr>
				<tr>
					<td style="border-bottom: 1px solid #999;">ESIC No.</td>
					<td style="border-bottom: 1px solid #999;"></td>
					<td style="border-bottom: 1px solid #999;">No Of Days</td>
					<td style="border-bottom: 1px solid #999;"></td>
				</tr>
				<tr>
					<td style="border-bottom: 1px solid #999;">DOJ</td>
					<td style="border-bottom: 1px solid #999;"><?= $candidate_data['joining_date']?></td>
					<td style="border-bottom: 1px solid #999;"><b>Balance PL</b></td>
					<td style="border-bottom: 1px solid #999;"><?= $candidate_data['balance_leave'] ?></td>
				</tr>
				<tr>
					<td style="border-bottom: 1px solid #999;">PAN No.</td>
					<td style="border-bottom: 1px solid #999;"><?= strtoupper($candidate_data['pan_no'])?></td>
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
				<tr>
					<td style="border-bottom: 1px solid #999;"><b>Basic</b></td>
					<td style="border-bottom: 1px solid #999;"><?= $salary_slip['earn_basic']?></td>
					<td style="border-bottom: 1px solid #999;"><b>P.Tax</b></td>
					<td style="border-bottom: 1px solid #999;"><?= $salary_slip['pt_amount']?></td>
				</tr>
				<tr>
					<td style="border-bottom: 1px solid #999;"><b>HRA</b></td>
					<td style="border-bottom: 1px solid #999;"><?= $salary_slip['earn_hra']?></td>
					<td style="border-bottom: 1px solid #999;"><b>Income Tax</b></td>
					<td style="border-bottom: 1px solid #999;"><?= $salary_slip['income_tax']?></td>
				</tr>
				<tr>
					<td style="border-bottom: 1px solid #999;"><b>Conveyance</b></td>
					<td><?= $salary_slip['earn_conveyance']?></td>
					<td style="border-bottom: 1px solid #999;"><b></b></td>
					<td></td>
				</tr>
				<tr>
					<td style="border-bottom: 1px solid #999;"><b>Medical</b></td>
					<td><?= $salary_slip['earn_medical']?></td>
					<td style="border-bottom: 1px solid #999;"><b></b></td>
					<td></td>
				</tr>
				<tr>
					<td style="border-bottom: 1px solid #999;"><b>Motor Allowance</b></td>
					<td><?= $salary_slip['earn_motor_remberse']?></td>
					<td style="border-bottom: 1px solid #999;"><b></b></td>
					<td></td>
				</tr>
				<tr>
					<td style="border-bottom: 1px solid #999;"><b>Mobile Reimbursement</b></td>
					<td><?= $salary_slip['earn_mobile_remberse']?></td>
					<td style="border-bottom: 1px solid #999;"><b></b></td>
					<td></td>
				</tr>
				
				<tr>
					<td style="border-bottom: 1px solid #999;"><b>Gratuty</b></td>
					<td><?= $salary_slip['gratuty']?></td>
					<td style="border-bottom: 1px solid #999;"><b></b></td>
					<td></td>
				</tr>
				<tr>
					<td style="border-bottom: 1px solid #999;"><b>Special Allow</b></td>
					<td><?= $salary_slip['earn_special']?></td>
					<td style="border-bottom: 1px solid #999;"><b></b></td>
					<td></td>
				</tr>
				<tr>
					<td><b>LTA</b></td><td><?= $salary_slip['earn_lta']?></td>
					<td><b></b></td><td></td>
				</tr>
				<tr>
					<td><b>Arrears</b></td><td><?=$salary_slip['earn_arrears'] ?></td>
					<td><b></b></td><td></td>
				</tr>
				<tr style="background-color: grey;">
					<td style="padding:10px"><b>Total Earned</b></td><td><b><?=$salary_slip['earn_total'] ?></b></td>
					<td><b>Total Deduction</b></td><td><b><?=$salary_slip['total_deduction'] ?></b></td>
				</tr>
				<tr >
					<td style="padding:10px"></td><td><b></b></td>
					<td style="padding:10px;background-color: grey;"><b>Net Pay</b></td><td><b><?=$salary_slip['net_pay'] ?></b></td>
				</tr>
	
		</table>
	</center></div>
		</section>
</div>
</div>
</div>
</div>