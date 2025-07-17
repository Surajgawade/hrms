   <?php 
/*	$current_month = date('m');
	$month = date('m')-1;
	$year = date('Y');
	if($current_month==1)
	{
		$month = 12;
		$year = date('Y')-1;
	}
	else if($current_month==2)
	{
		$month = date('m')-1;
	}*/

	$total_days = cal_days_in_month(CAL_GREGORIAN, $salary_slip_details->month, $salary_slip_details->year);
	$dateObj   = DateTime::createFromFormat('!m', $salary_slip_details->month);
	$monthName = $dateObj->format('F');?>
?>

<div class="page-content">
	<div class="container-fluid">	
		<div class="col-sm-12 well">
			 <div class="row">
				<form data-toggle="validator" class="col-sm-12" id="monthly_salary_slip" action=" " method="post">
					<h1 class="well headline">Edit Salary Slip</h1>
					<input type="hidden" id="pf_applicable" value="<?php echo $salary_slip_details->pf_applicable?>">
					<input type="hidden" name="month" id="month" value="<?php echo $salary_slip_details->month;?>">
					<input type="hidden" name="year" id="year" value="<?php echo $salary_slip_details->year;?>">
					<input type="hidden" id="total_days" value="<?php echo $total_days;?>">					
					<input type="hidden" name="salary_slip_id" id="salary_slip_id" value="<?php echo $salary_slip_details->salary_slip_id;?>">
						<div class="col-sm-12 col-xs-12 profile_bg">
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Month </label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<label class="form-label"><?php echo $monthName;?></label>
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
									<label class="form-label">Year</label>
									</div>
								</div>

								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<label class="form-label"><?php echo $salary_slip_details->year;?></label>
										</div>
									</div>
								</div>							
	                  </div>
							<div class="row">
								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Employee Name <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Employee Name" type="text" value="<?php echo !empty($salary_slip_details->can_name) ? $salary_slip_details->can_name : '';?>" readonly>
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Date Of Joining <span>*</span></label>
									</div>
								</div>
					
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Date of Joining" type="text" id="doj" value="<?php echo !empty($salary_slip_details->joining_date) ? db_to_date($salary_slip_details->joining_date) : '';?>" readonly>
										</div>
									</div>
	                     </div>  
									
	                  </div>

						<div class="row">
							<?php /*<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Month And Year <span>*</span></label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="date form-group">
									<div class="input-group input-append date" id="datePicker1">
										<input type="text" class="form-control col-md-12 " name="dob" id="dob" placeholder="mm/yyyy" value="<?php echo !empty($empsalary_details->dob) ? format_date($empsalary_details->dob) : ''?>" required data-error="Please Select Month and Year">
										<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
									<div class="help-block with-errors error_msg"></div>
								</div>
							</div>*/?>
							<div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Designation <span>*</span></label>
									</div>
								</div>
							
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Designation" type="text"  id="emp_designation"  value="<?php echo !empty($salary_slip_details->job_profile_title) ? $salary_slip_details->job_profile_title : '';?>" readonly>
										</div>
									</div>
	                     </div>

	                     <div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
										<label class="form-label">Department <span>*</span></label>
									</div>
								</div>
								
								<div class="col-lg-4 col-sm-9 col-xs-12">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Designation" type="text"  value="<?php echo !empty($salary_slip_details->department_title) ? $salary_slip_details->department_title : '';?>" id="emp_department" readonly>
										</div>
									</div>
	                     </div>														
						  </div>

  						 <div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">PF No. :</label>
								</div>
							</div>
							
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Enter PF No." type="text" id="pf_no" value="<?php echo !empty($salary_slip_details->pf_no) ? $salary_slip_details->pf_no : '';?>" readonly>
									</div>
								</div>
                     </div>
	                            
                     <div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">ESIC No. :</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="ESIC No." type="text" id="esic_no" value="<?php echo !empty($salary_slip_details->esic_no) ? $salary_slip_details->esic_no : '';?>" readonly>
                           </div>
								</div>
							</div>
                  </div>
	                        
                  <div class="row">
                  	<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Days Present <span>*</span></label>
								</div>
							</div>
							
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Enter Days Present" type="text" name="days_present" id="days_present" required data-error="Please Enter Number of Days Present"  value="<?php echo !empty($salary_slip_details->days_present) ? $salary_slip_details->days_present : '';?>">
										<span class="error_msg" id="error_day"></span>
									<div class="help-block with-errors error_msg" ></div>
                           </div>
								</div>								
							</div>
                  </div>
                  
                


						<?php /*<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Balance Leaves </label>
								</div>
							</div>

							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Balance Leaves" type="text" id="balance_leave" value="<?php echo !empty($salary_slip_details->esic_no) ? $salary_slip_details->esic_no : '';?>">
									</div>
								</div>
							</div>
						</div>
						*/?>

                        <div class="month-head">
                            <h6>Earnings &amp; Reimbursement</h6>
                        </div>
                        <div class="row">
                        	<div class="col-sm-12">
										<section class="card">
											<div class="card-block">
												<table id="month_sal" class="display table table-bordered table-striped" cellspacing="0" width="100%">
													<thead>
														<tr>
															<th style="width:30%">Earnings</th>
															<th style="width:30%">Actual</th>							
															<th style="width:30%">Calculated</th>
														</tr>
													</thead>

													<tbody>
														<tr>
															<td>
																<div class="form-group">
																	<label class="form-label">Basic <span>*</span></label>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text"  id="basic" readonly value="<?php echo !empty($salary_slip_details->basic) ? $salary_slip_details->basic : 0;?>">
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" name="earn_basic" id="earn_basic" required data-error="Please Enter Basic Salary" value="<?php echo !empty($salary_slip_details->earn_basic) ? $salary_slip_details->earn_basic : 0;?>">
																	</div>
																</div>
															</td>
														</tr>
														<tr>
															<td>
																<div class="form-group">
																	<label class="form-label">HRA <span>*</span></label>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text"  id="hra" readonly value="<?php echo !empty($salary_slip_details->HRA) ? $salary_slip_details->HRA : '';?>">
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" name="earn_hra" id="earn_hra" required data-error="Please Enter HRA" value="<?php echo !empty($salary_slip_details->earn_hra) ? $salary_slip_details->earn_hra : 0;?>">
																		<div class="help-block with-errors error_msg"></div>
																	</div>
																</div>
															</td>
														</tr>
														<tr>
															<td>
																<div class="form-group">
																	<label class="form-label">Conveyance <span>*</span></label>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text"  id="conveyance" readonly value="<?php echo !empty($salary_slip_details->conveyance) ? $salary_slip_details->conveyance : 0;?>">
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" name="earn_conveyance" id="earn_conveyance" required data-error="Please Enter Conveyance"  value="<?php echo !empty($salary_slip_details->earn_conveyance) ? $salary_slip_details->earn_conveyance : 0;?>">
																		<div class="help-block with-errors error_msg"></div>
																	</div>
																</div>
															</td>
														</tr>
														<tr>
															<td>
																<div class="form-group">
																	<label class="form-label">Medical <span>*</span></label>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" id="medical" readonly value="<?php echo !empty($salary_slip_details->medical) ? $salary_slip_details->medical : 0;?>" >
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" name="earn_medical" id="earn_medical" required data-error="Please Enter Medical"  value="<?php echo !empty($salary_slip_details->earn_medical) ? $salary_slip_details->earn_medical : 0;?>" >
																		<div class="help-block with-errors error_msg"></div>
																	</div>
																</div>
															</td>
														</tr>
														<tr>
															<td>
																<div class="form-group">
																	<label class="form-label">Special Allowances <span>*</span></label>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text"  id="special" readonly value="<?php echo !empty($salary_slip_details->special_allowance) ? $salary_slip_details->special_allowance : 0;?>" >
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" name="earn_special" id="earn_special" required data-error="Please Enter Special Allowances" value="<?php echo !empty($salary_slip_details->earn_special) ? $salary_slip_details->earn_special : 0;?>">
																		<div class="help-block with-errors error_msg"></div>
																	</div>
																</div>
															</td>
														</tr>
														
														<tr <?php if($salary_slip_details->LTA == 0){?> style="display: none;" <?php }?>>
															<td>
																<div class="form-group">
																	<label class="form-label">LTA</label>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text"  id="lta" readonly value="<?php echo ($salary_slip_details->LTA !=0 ) ? $salary_slip_details->LTA : 0;?>">
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" name="earn_lta" id="earn_lta" value="<?php echo !empty($salary_slip_details->earn_lta) ? $salary_slip_details->earn_lta : 0;?>">
																	</div>
																</div>
															</td>
														</tr>														
													
														<tr 	<?php if($salary_slip_details->mobile_reimbursement==0){?> style="display: none;" <?php }?>>
															<td>
																<div class="form-group">
																	<label class="form-label">Mobile reimbursement</label>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text"  id="mobile_remberse" readonly value="<?php echo ($salary_slip_details->mobile_reimbursement!=0) ? $salary_slip_details->mobile_reimbursement : 0;?>">
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" name="earn_mobile_remberse" id="earn_mobile_remberse" value="<?php echo ($salary_slip_details->earn_mobile_remberse!=0) ? $salary_slip_details->earn_mobile_remberse : 0;?>">
																	</div>
																</div>
															</td>
														</tr>
														
														<tr <?php if($salary_slip_details->motor_allowance==0){?> style="display: none;" <?php }?>>
															<td>
																<div class="form-group">
																	<label class="form-label">Motor Allowance</label>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" id="motor_remberse" readonly value="<?php echo ($salary_slip_details->motor_allowance!=0) ? $salary_slip_details->motor_allowance : 0;?>">
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" name="earn_motor_remberse" id="earn_motor_remberse" value="<?php echo ($salary_slip_details->earn_motor_remberse!=0) ? $salary_slip_details->earn_motor_remberse : 0;?>">
																	</div>
																</div>
															</td>
														</tr>	
														<tr>
															<td>
																<div class="form-group">
																	<label class="form-label">Gratuity</label>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" id="gt" readonly value="<?php echo !empty($salary_slip_details->gratuity) ? $salary_slip_details->gratuity : 0;?>">
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" name="gratuty" id="gratuty" value="<?php echo !empty($salary_slip_details->gratuty) ? $salary_slip_details->gratuty : 0;?>">
																	</div>
																</div>
															</td>
														</tr>

														<tr>
															<td>
																<div class="form-group">
																	<label class="form-label">Arrears</label>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text"   id="arrears" readonly value="<?php echo !empty($salary_slip_details->arrears) ? $salary_slip_details->arrears : 0;?>">
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" name="earn_arrears" id="earn_arrears"  value="<?php echo !empty($salary_slip_details->earn_arrears) ? $salary_slip_details->earn_arrears : 0;?>">
																	</div>
																</div>
															</td>
														</tr>
														<!-- <tr>
															<td>
																<div class="form-group">
																	<label class="form-label">Total Earned</label>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text"  id="gross" readonly>
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" name="earn_total" id="earn_total">
																	</div>
																</div>
															</td>
														</tr> -->
													</tbody>
												</table>
											</div>
										</section>
										</div>
									</div>
                       
	                        
                        <div class="month-head">
                            <h6>
                                Deduction &amp; Recovery
                            </h6>
                        </div>
 							
                        <div class="row"  <?php if($salary_slip_details->pf_amount==0){?> style="display: none;" <?php }?>>
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Provident Fund Actual</label>
										</div>
									</div>
								
									<div class="col-lg-4 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control number" placeholder="" type="text"  id="pf_amount" readonly value="<?php echo !empty($salary_slip_details->pf_amount) ? $salary_slip_details->pf_amount : 0;?>" readonly>											
											</div>
										</div>
		                            </div>
		                    
                            <div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Provident Fund Calculated</label>
										</div>
									</div>
								
									<div class="col-lg-4 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control number" placeholder="" type="text" name="provident_fund" id="provident_fund" value="<?php echo !empty($salary_slip_details->provident_fund) ? $salary_slip_details->provident_fund : 0;?>">
                                 </div>
										</div>
									</div>
								</div>

                        <div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Profession Tax</label>
										</div>
									</div>
								
									<div class="col-lg-4 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control number" placeholder="" type="text" name="pt_amount" id="pt_amount" value="<?php echo !empty($salary_slip_details->pt_amount) ? $salary_slip_details->pt_amount : 0;?>" readonly>
												
											</div>
										</div>
		                            </div>
		                            
                            <div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Income Tax</label>
										</div>
									</div>
								
									<div class="col-lg-4 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control number" placeholder="" type="text" name="income_tax" id="income_tax" value="<?php echo !empty($salary_slip_details->income_tax) ? $salary_slip_details->income_tax : 0;?>">
                                 </div>
										</div>
									</div>
								</div>

								  <div class="month-head">
                            <h6>
                               Calculate Net Pay
                            </h6>
                        	</div>

                        <div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Gross Pay</label>
										</div>
									</div>
								
									<div class="col-lg-2 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control number" placeholder="" type="text" id="gross" readonly value="<?php echo !empty($salary_slip_details->gross_pay) ? $salary_slip_details->gross_pay : 0;?>">
												
											</div>
										</div>
                          </div>
		                            
                          <div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Total Earned</label>
										</div>
									</div>
								
									<div class="col-lg-2 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control number" placeholder="" type="text" name="earn_total" id="earn_total" required data-error="Total earned can't be empty!" value="<?php echo !empty($salary_slip_details->earn_total) ? $salary_slip_details->earn_total : 0;?>">
												<div class="help-block with-errors error_msg"></div>
                                 </div>
										</div>
									</div>

									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Total Deduction</label>
										</div>
									</div>
								
									<div class="col-lg-2 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control number" placeholder="" type="text" name="total_deduction" id="total_deduction" readonly value="<?php echo !empty($salary_slip_details->total_deduction) ? $salary_slip_details->total_deduction : 0;?>">
												
											</div>
										</div>
                          </div>

									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Net Pay</label>
										</div>
									</div>
								
									<div class="col-lg-2 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control number" placeholder="" type="text" name="net_pay" id="net_pay" required data-error="Net pay cant't be empty!" value="<?php echo !empty($salary_slip_details->net_pay) ? $salary_slip_details->net_pay : 0;?>">
												<div class="help-block with-errors error_msg"></div>
                                 </div>
										</div>
									</div>
								

								</div>

								<input type="hidden" name="total_deduction" id="total_deduction" value="<?php echo $salary_slip_details->total_deduction?>">
								<div class="row">
									<div class="col-lg-6">
										<button class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label">Submit</span>
										<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
									
										<button class="btn btn-inline ladda-button reset" data-style="expand-left"><span class="ladda-label">Reset</span>
										<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
									</div>								
								</div>
						</div>
				</form>
				 </div> 
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function formatDate (input) {
		var datePart = input.match(/\d+/g),
		year = datePart[0].substring(0), // get only two digits
		month = datePart[1], day = datePart[2];
		return day+'/'+month+'/'+year;
	}

	function daysInMonth(month, year) {
    	return new Date(year, month, 0).getDate();
	}

			var basic = 0.0;
			var hra = 0.0;
			var conveyance = 0.0;
			var medical = 0.0;
			var special = 0.0;
			var lta = 0.0;
			var provident_fund = 0.0;
			var mobile_remberse = 0.0;
			var motor_remberse = 0.0;
			var gratuty =0.0;
			var arrears =0.0;
			var total_earned = 0.0;
			var total_deduction = 0.0;
			var net_pay = 0.0;
			var income_tax = 0.0;			
			var month = $('#month').val();
			var year = $('#year').val();	
			var daysInMonth = $('#total_days').val();
			var days_present = 0;
			var pt_amount = 0.0;
			if(month==2)
				pt_amount = 300;
			else
				pt_amount = 200;
/*
			$('#monthly_salary_slip')
				.bootstrapValidator({
					excluded: ':disabled'
				});*/

		/*$("#datePicker1,#datePicker2").datepicker( {
		   format: "mm-yyyy",
		   viewMode: "months", 
		   minViewMode: "months"
		});*/
		
/*		$('#can_id').change(function(){
			var can_id = $("#can_id").chosen().val();
			console.log(can_id);

			var response = $.parseJSON($.ajax({
				url:  '<?php //echo site_url();?>/compensation/get_can_salary_details',
				dataType: "json", 
				data: {can_id:can_id},
				type:'POST',
				async: false
			}).responseText);
			
			if(response!= null)
			{
				$('#pf_applicable').val(response.pf_applicable);
				$('#emp_designation').val(response.job_profile_title);
				$('#balance_leave').val(response.balance_leave);
				$('#pf_no').val(response.pf_no);
				$('#esic_no').val(response.esic_no);
				$('#basic').val(response.basic);
				$('#hra').val(response.HRA);
				$('#conveyance').val(response.conveyance);
				$('#medical').val(response.medical);
				$('#special').val(response.special_allowance);
				$('#lta').val(response.LTA);
				$('#mobile_remberse').val(response.mobile_reimbursement);
				$('#motor_remberse').val(response.motor_allowance);
				$('#pf_amount').val(response.pf_amount);
				$('#pt_amount').val(pt_amount);
				$('#gt').val(response.gratuity);
				$('#arrears').val(response.arrears);
				$('#gross').val(response.gross_pay);
				$('#job_profile_title').val(response.job_profile_title);
				
				$('#total').val(response.gross_pay);

				if(response.joining_date != null)
					$('#doj').val(formatDate (response.joining_date));
			}
			else
			{
				$(this).closest('form').find("input[type=text]").val("");	
			}
		});*/



		$('#days_present').blur(function(){	

			//var daysInMonth = new Date(year, month, 0).getDate();
			
			days_present = $(this).val();			
			console.log('Days in a month:'+daysInMonth);
			console.log('Days present:'+days_present);
			var bal_leave = $('#balance_leave').val();
			
				if(($('#days_present').val() !='') && ($('#days_present').val() !=0))
				{
					if(days_present > daysInMonth)
					{
						$('#error_day').html('Days can\'t be greater than'+daysInMonth).show().delay(2000).fadeOut(1000);
						$("input:text.clear_field").val('');
						return false;
					}
					else
					{
						cal_salary();
					}												
				}
				else
				{
					$('#error_day').html('Enter no of days present').show().delay(2000).fadeOut(1000);
				}
		});

		function cal_salary()
		{
			console.log('in calculate salary function');
			console.log(daysInMonth);
			console.log(days_present);

			basic = (($('#basic').val()/daysInMonth)*days_present).toFixed(2);	
			$('#earn_basic').val(basic);
			console.log(basic);

			hra = (($('#hra').val()/daysInMonth)*days_present).toFixed(2);
			$('#earn_hra').val(hra);
			// console.log(hra);

			conveyance = (($('#conveyance').val()/daysInMonth)*days_present).toFixed(2);
			$('#earn_conveyance').val(conveyance);
			// console.log(conveyance);

			medical = (($('#medical').val()/daysInMonth)*days_present).toFixed(2);
			$('#earn_medical').val(medical);
			// console.log(medical);				


			special = (($('#special').val()/daysInMonth)*days_present).toFixed(2);
			$('#earn_special').val(special);
			// console.log(medical);
			// calc_special_allowance();
			// $('#earn_special').val(special);



			if($('#pf_applicable').val()==1 && $('#pf_amount').val()!= 0)
			{
				provident_fund = (($('#pf_amount').val()/daysInMonth)*days_present).toFixed(2);
				$('#provident_fund').val(provident_fund);
			}
			else
			{
				$('#provident_fund').val(0);
			}

			total_earned = calc_total_pay();					
			net_pay = calc_net_pay();
			net_pay = calc_total_deduction();
		}

	
		function calc_pf()
		{
			provident_fund = ((12/100)*($('#earn_basic').val())).toFixed(2);
        $('#provident_fund').val(provident_fund);
		}

		function calc_special_allowance()
		{
			special = (parseFloat($('#earn_total').val()) - (parseFloat($('#earn_basic').val())+parseFloat($('#earn_hra').val())+parseFloat($('#earn_conveyance').val())+parseFloat($('#earn_medical').val())+parseFloat($('#earn_lta').val())+parseFloat($('#earn_mobile_remberse').val())+parseFloat($('#earn_motor_remberse').val()))).toFixed(2);
				$('#earn_special').val(special);
		}

		function calc_total_pay()
		{
			console.log('in cal total pay');
			console.log($('#earn_basic').val());
			console.log($('#earn_hra').val());
			console.log($('#earn_conveyance').val());
			console.log($('#earn_medical').val());
			console.log($('#earn_special').val());
			console.log($('#earn_lta').val());
			console.log($('#earn_mobile_remberse').val());
			console.log($('#earn_motor_remberse').val());
			console.log($('#gratuty').val());
			console.log($('#earn_arrears').val());

			total_earned = (parseFloat(parseFloat($('#earn_basic').val())+parseFloat($('#earn_hra').val())+parseFloat($('#earn_conveyance').val())+parseFloat($('#earn_medical').val())+parseFloat($('#earn_special').val())+parseFloat($('#earn_lta').val())+parseFloat($('#earn_mobile_remberse').val())+parseFloat($('#earn_motor_remberse').val()+parseFloat($('#gratuty').val())+parseFloat($('#earn_arrears').val())))).toFixed(2);
			$('#earn_total').val(total_earned);
		}

		function calc_net_pay()
		{
			net_pay = (parseFloat(parseFloat($('#earn_basic').val())+parseFloat($('#earn_hra').val())+parseFloat($('#earn_conveyance').val())+parseFloat($('#earn_medical').val())+parseFloat($('#earn_special').val())+parseFloat($('#gratuty').val())+parseFloat($('#earn_arrears').val())-parseFloat($('#provident_fund').val())-parseFloat($('#pt_amount').val())-parseFloat($('#income_tax').val()))).toFixed(2);
			$('#net_pay').val(net_pay);
		}

		function calc_total_deduction()
		{
			total_deduction = (parseFloat(parseFloat($('#provident_fund').val())+ parseFloat($('#pt_amount').val())+parseFloat($('#income_tax').val()))).toFixed(2);
			$('#total_deduction').val(total_deduction);
		}


	$( "#earn_lta" ).change(function()
	{
		total_earned = calc_total_pay();
		net_pay = calc_net_pay();	
		total_deduction = calc_total_deduction();
	});

	$( "#earn_mobile_remberse" ).bind( "change", function() {
			total_earned = calc_total_pay();
			net_pay = calc_net_pay();
			total_deduction = calc_total_deduction();
	});

	$( "#earn_motor_remberse" ).bind( "change", function() {
			total_earned = calc_total_pay();
			net_pay = calc_net_pay();
			total_deduction = calc_total_deduction();
	});

	$( "#gratuty" ).bind( "change", function() {
			total_earned = calc_total_pay();
			net_pay = calc_net_pay();
			total_deduction = calc_total_deduction();
	});

	$( "#earn_arrears" ).bind( "change", function()
	{
			total_earned = calc_total_pay();
			net_pay = calc_net_pay();
			total_deduction = calc_total_deduction();
	});

	$( "#pt_amount" ).bind( "change", function()
	{
			total_earned = calc_total_pay();
			net_pay = calc_net_pay();
			total_deduction = calc_total_deduction();
	});

	$( "#income_tax" ).bind( "change", function()
	{
			total_earned = calc_total_pay();
			net_pay = calc_net_pay();
			total_deduction = calc_total_deduction();
	});




	$(document).ready(function() {
		$(".chosen-select").chosen();
	});
</script>



