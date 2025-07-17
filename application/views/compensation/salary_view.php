<div class="page-content">
	<div>
		<?php if($this->session->flashdata('success')){?><?php }?>	
	</div>
<div class="container-fluid">	
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell col-md-12">
					<h2>Salary Slip</h2>
				</div>
				
					
			</div>
		</div>
	</header>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-condensed">
				<tr>
					<td>Employee Id</td>
					<td><?php echo $salary_slip->can_id; ?></td>
					<td>Employee Name</td>
					<td><?php echo $salary_slip->can_name; ?></td>
				</tr>
				<tr>
					<td>Designation</td>
					<td><?php echo $salary_slip->job_profile_title; ?></td>
					<td>PF Account Number</td>
					<td><?php echo $salary_slip->pf_no; ?></td>
				</tr>
				<tr>
					<td>Date Of Joining</td>
					<td><?php echo $salary_slip->joining_date; ?></td>
					<td>ESIC Account Number</td>
					<td><?php echo $salary_slip->can_id; ?></td>
				</tr>
			</table>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-md-6">	
			<table class="table table-bordered" >
				<tr>
					<th>Earnings</th>
					<th>Amount</th>
				</tr>
				<tr>
					<td>Basic Pay</td>
					<td><?php echo $salary_slip->basic; ?></td>
				</tr>
				<tr>
					<td>HRA</td>
					<td><?php echo $salary_slip->HRA; ?></td>
				</tr>
				<tr>
					<td>Conveyance</td>
					<td><?php echo $salary_slip->conveyance; ?></td>
				</tr>
				<tr>
					<td>Medical</td>
					<td><?php echo $salary_slip->medical; ?></td>
				</tr>
				<tr>
					<td>Special Allowance</td>
					<td><?php echo $salary_slip->special_allowance; ?></td>
				</tr>
				<tr>
					<td>LTA</td>
					<td><?php echo $salary_slip->LTA; ?></td>
				</tr>
				<tr>
					<td>Mobile reimbursement</td>
					<td><?php echo $salary_slip->mobile_reimbursement; ?></td>
				</tr>
				<tr>
					<td>Motor Allowance</td>
					<td><?php echo $salary_slip->motor_allowance; ?></td>
				</tr>
				<tr>
					<th>Total Earning</th>
					<th><?php $totalEarn=$salary_slip->basic+$salary_slip->HRA+$salary_slip->conveyance+$salary_slip->special_allowance+$salary_slip->LTA+$salary_slip->mobile_reimbursement+$salary_slip->motor_allowance; echo $totalEarn; ?></th>
				</tr>
			</table>
		</div>
		<div class="col-md-6">	
			<table class="table table-bordered">
				<tr>
					<th>Deduction</th>
					<th>Amount</th>
				</tr>
				<tr>
					<td>ESIC</td>
					<td><?php echo $salary_slip->esic_amount; ?></td>
				</tr>
				<tr>
					<td>PF</td>
					<td><?php echo $salary_slip->pf_amount; ?></td>
				</tr>
				<tr>
					<td>Income Tax</td>
					<td><?php echo $salary_slip->income_tax; ?></td>
				</tr>
				<tr>
					<td>Professional Tax</td>
					<td><?php echo $salary_slip->pt_amount; ?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<th>Total Deduction</th>
					<th><?php $totalDed=$salary_slip->esic_amount+$salary_slip->pf_amount+$salary_slip->income_tax+$salary_slip->pt_amount; echo $totalDed; ?></th>
				</tr>
			</table>
		</div>
	</div><hr>
		<div class="row">
			<div class="col-md-6"></div>
			<div class="col-md-6">
				<h4>Net Pay: <?php $netPay=(int)($totalEarn-$totalDed); echo $netPay; ?></h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 text-right">
				<a href="javascript:window.history.go(-1);" class="btn btn-primary btn-sm">Back To List</a>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
	 	
</div>
					