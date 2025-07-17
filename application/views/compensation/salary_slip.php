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
			}
			td:last-child {
				
				border-right: none;
			}
	 </style>
</head>
<?php if(isset($salary_slip)){ ?>
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
						<td colspan="3" align="center" style="border-bottom:1px solid #999; padding: 0;text-align: center;">Raoson Business &amp; Softtech Solution</td>
				</tr>
				<tr align="center">
					<td colspan="3" align="center" style="border-bottom:1px solid #999; padding: 0;text-align: center;">816, 8th Floor, DBS Business Center,The Corporate Park,<br>Sector:18, Vashi, Navi Mumbai Landline: 02227771800 Ext.814</td>
				</tr>
				<tr align="center">
					<td align="center" style="text-align: center;" colspan="3" ></td>
				</tr>
				<tr>
					<td >Employee Code:</td>
					<td ><?php echo $salary_slip->can_id; ?></td>
					<td >Name:</td>
					<td ><?php echo $salary_slip->can_name; ?></td>
				</tr>
				<tr>
					<td >PF No</td>
					<td ></td>
					<td >Designation</td>
					<td ><?php echo $salary_slip->job_profile_title;?></td>
				</tr>
				<tr>
					<td >ESIC No.</td>
					<td ></td>
					<td >No Of Days</td>
					<td ></td>
				</tr>
				<tr>
					<td >DOJ</td>
					<td ><?php echo $salary_slip->joining_date; ?></td>
					<td  colspan="2" rowspan="3"></td>
				</tr>
				<tr>
					<td >PAN No.</td>
					<td ><?= strtoupper($salary_slip->pan_no)?></td>
				</tr>
				<tr>
					<td >Department.</td>
					<td >IT</td>
				</tr>
				<tr style="background-color: grey;">
					<td style="padding:10px;background-color: grey;"><b>Earning & Reimbursement</b></td>
					<td style="border-bottom: 1px solid #999;background-color: grey;"><b>Gross Rs.</b></td>
					<td style="border-bottom: 1px solid #999;background-color: grey;"><b>Earning Rs.</b></td>
					<td style="border-bottom: 1px solid #999;background-color: grey;"><b>Deduction & Recovery</b></td>
				</tr>
				<tr>
					<td ><b>Basic</b></td>
					<td ><?php echo $salary_slip->basic; ?></td>
					<td ><b>P.Tax</b></td>
					<td ><?php echo $salary_slip->pf_amount; ?></td>
				</tr>
				<tr>
					<td ><b>HRA</b></td>
					<td ><?php echo $salary_slip->HRA; ?></td>
					<td ><b>Income Tax</b></td>
					<td ><?php echo $salary_slip->pf_amount; ?></td>
				</tr>
				<tr>
					<td ><b>Conveyance</b></td>
					<td><?php echo $salary_slip->conveyance; ?></td>
					<td ><b></b></td>
					<td></td>
				</tr>
				<tr>
					<td ><b>Medical</b></td>
					<td><?php echo $salary_slip->medical; ?></td>
					<td ><b></b></td>
					<td></td>
				</tr>
				<tr>
					<td ><b>Motor Allowance</b></td>
					<td><?php echo $salary_slip->motor_allowance; ?></td>
					<td ><b></b></td>
					<td></td>
				</tr>
				<tr>
					<td ><b>Mobile Reimbursement</b></td>
					<td><?php echo $salary_slip->mobile_reimbursement; ?></td>
					<td ><b></b></td>
					<td></td>
				</tr>
				
				<tr>
					<td ><b>Gratuity</b></td>
					<td><?php echo $salary_slip->gratuity; ?></td>
					<td ><b></b></td>
					<td></td>
				</tr>
				<tr>
					<td ><b>Special Allow</b></td>
					<td><?php echo $salary_slip->special_allowance; ?></td>
					<td ><b></b></td>
					<td></td>
				</tr>
				<tr>
					<td><b>LTA</b></td><td><?php echo $salary_slip->LTA; ?></td>
					<td><b></b></td><td></td>
				</tr>
				<tr>
					<td><b>Arrears</b></td><td><?php echo $salary_slip->arrears; ?></td>
					<td><b></b></td><td></td>
				</tr>
				<tr style="background-color: grey;">
					<td style="padding:10px"><b>Total Earned</b></td><td><b><?php echo $salary_slip->total_earned; ?></b></td>
					<td><b>Total Deduction</b></td><td><b><?php $totalDed=$salary_slip->esic_amount+$salary_slip->pf_amount+$salary_slip->income_tax+$salary_slip->pt_amount; echo $totalDed; ?></b></td>
				</tr>
				<tr >
					<td style="padding:10px"></td><td><b></b></td>
					<td style="padding:10px;background-color: grey;"><b>Net Pay</b></td><td><b> <?php $netPay=(int)($salary_slip->total_earned-$totalDed); echo $netPay; ?></b></td>
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