<div class="page-content">
	<div class="container-fluid">
		<?php $this->load->view('candidate/can_menu');?>
	<div class="well">
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12"  >
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
						
							<div class="col-lg-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right" id="user_profile_details">
										<?php 
											if(!empty($salary_details))
											{
										?>
										<table width="100%" class="table table-striped">
											<tr>
												<td>Basic</td>
												<td><?= (isset($salary_details[0]['basic']) && !empty($salary_details[0]['basic'])) ? $salary_details[0]['basic']:'-' ?></td>
												<td>HRA</td>
												<td><?= (isset($salary_details[0]['HRA']) && !empty($salary_details[0]['HRA'])) ? $salary_details[0]['HRA']:'-' ?></td>
												
											</tr>
											<tr>
												<td>Conveyance</td>
												<td><?= (isset($salary_details[0]['conveyance']) && !empty($salary_details[0]['conveyance'])) ? $salary_details[0]['conveyance']:'-' ?></td>
												<td>Special Allowance</td> 
												<td><?= (isset($salary_details[0]['special_allowance']) && !empty($salary_details[0]['special_allowance'])) ? $salary_details[0]['special_allowance']:'-' ?></td>
												
											</tr> 
											<tr>
												<td>Medical</td>
												<td><?= (isset($salary_details[0]['medical']) && !empty($salary_details[0]['medical'])) ? $salary_details[0]['medical']:'-' ?></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>PF Applicable</td>
												<td><?= ($salary_details[0]['pf_applicable']==0) ? 'No':'Yes' ?></td>
												<td>PF Amount</td>
												<td><?= (isset($salary_details[0]['pf_amount']) && !empty($salary_details[0]['pf_amount'])) ? $salary_details[0]['pf_amount']:'-' ?></td>
												
											</tr> 
											<tr>
												<td>Esic No</td>
												<td><?= (isset($salary_details[0]['esic_no']) && !empty($salary_details[0]['esic_no'])) ? $salary_details[0]['esic_no']:'-' ?></td>
												<td>Esic Amount</td>
												<td><?= (isset($salary_details[0]['esic_amount']) && !empty($salary_details[0]['esic_amount'])) ? $salary_details[0]['esic_amount']:'-' ?></td>
												
											</tr>
											<tr>
												<td>Mobile Reimbursement</td>
												<td><?= (isset($salary_details[0]['mobile_reimbursement']) && !empty($salary_details[0]['mobile_reimbursement'])) ? $salary_details[0]['mobile_reimbursement']:'-' ?></td>
												<td>Motor Allowance</td>
												<td><?= (isset($salary_details[0]['motor_allowance']) && !empty($salary_details[0]['motor_allowance'])) ? $salary_details[0]['motor_allowance']:'-' ?></td>
												
											</tr>
											<tr>
												<td>Gratuity</td>
												<td><?= (isset($salary_details[0]['gratuity']) && !empty($salary_details[0]['gratuity'])) ? $salary_details[0]['gratuity']:'-' ?></td>
												<td>Arrears</td>
												<td><?= (isset($salary_details[0]['arrears']) && !empty($salary_details[0]['arrears'])) ? $salary_details[0]['arrears']:'-' ?></td>
												
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td><b>Gross Pay</b></td>
												<td><b><?= (isset($salary_details[0]['gross_pay']) && !empty($salary_details[0]['gross_pay'])) ? $salary_details[0]['gross_pay']:'-' ?></b></td>
												
												
											</tr>
										</table>
										<?php 
											}
											else
											{
										?>
										<div>Salary Details Not Added Yet</div>
										<?php		
											}
										?>
									</div>
								</div>
							</div>
						</div>

					</div>
				</form> 
		</div>
	</div>
</div>
</div>

