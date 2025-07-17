<?php 
	$current_month = date('m');
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
	}
	/*if($month==2)
	{
		$pt_amount = 300;
	}
	else
	{
		$pt_amount = 200;
	}*/
	$total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	$dateObj   = DateTime::createFromFormat('!m', $month);
	$monthName = $dateObj->format('F');
?>

<div class="page-content">
	<div class="container-fluid">	
		<div class="well">
			 <div class="row">
				<form data-toggle="validator" class="col-sm-12" id="monthly_salary_slip" action=" " method="post">
					<h1 class="well headline">Generate Salary Slip</h1>
					<?php if($this->session->flashdata('error')){?>
						<div class="alert alert-danger alert-no-border alert-close alert-dismissible fade show" role="alert">
						 <?php echo $this->session->flashdata('error');?>
						</div>
						<?php }?>
					<span id="error_profile"></span>
					<input type="hidden" id="pf_applicable" >					
					<input type="hidden" name="month" id="month" value="<?php echo $month;?>">
					<input type="hidden" name="year" id="year" value="<?php echo $year;?>">
					<input type="hidden" id="total_days" value="<?php echo $total_days;?>">
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-6">
								<div class="form-group">
									<label class="form-label">Month </label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-6">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><?php echo $monthName;?></label>
									</div>
								</div>
							</div>

							<div class="col-lg-2 col-sm-3 col-xs-6">
								<div class="form-group">
								<label class="form-label">Year</label>
								</div>
							</div>

							<div class="col-lg-4 col-sm-9 col-xs-6">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<label class="form-label"><?php echo $year;?></label>
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
											<select class="form-control chosen-select col-md-10 col-sm-12 col-xs-12 " name="can_id" id="can_name"  style="width: 100%" required >
											<option value="" selected hidden>Select Employee Name</option>
											<?php foreach ($candidates as $key => $candidate) {?>
											<option value="<?php echo $candidate->can_id?>"><?php echo $candidate->can_name?></option>
											<?php }?>
										</select>
										<span class="msg_red" id="err_canid"></span>
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
											<input class="form-control" placeholder="Date of Joining" type="text" id="doj" readonly>
										</div>
									</div>
								</div> 

							
	                  </div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Designation <span>*</span></label>
								</div>
							</div>
							
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Designation" type="text"  id="emp_designation" readonly>
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
										<input class="form-control" placeholder="Department" type="text"  id="emp_department" readonly>
									</div>
								</div>
                     </div>
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
						</div>
	            

						 <div class="row" >
						 	<!-- <div id="pf_no_div" style="display: none"> -->
							<div class="col-lg-2 col-sm-3 col-xs-12 pf_no_div">
								<div class="form-group">
									<label class="form-label">PF No. :</label>
								</div>
							</div>
							
							<div class="col-lg-4 col-sm-9 col-xs-12 pf_no_div">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="PF No." type="text" id="pf_no" value="" readonly>
									</div>
								</div>
                     </div>
                  <!-- </div> -->
	               <!-- <div id="esic_no_div" style="display: none">            -->
                     <div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">ESIC No. :</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="ESIC No." type="text" id="esic_no" readonly>
                           </div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Transaction Type:</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Transaction Type" type="text" id="transaction_type" name="transaction_type" readonly>
                           </div>
								</div>
							</div>
							<!-- <input type="hidden" name="transaction_type" id="transaction_type" name=""> -->

						<!-- </div> -->
                  </div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Balance Leaves </label>
								</div>
							</div>

							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Balance Leaves" type="text" id="balance_leave">
									</div>
								</div>
							</div>

							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Days Present <span>*</span></label>
								</div>
							</div>
					
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control number" placeholder="Enter Days Present" type="text" name="days_present" id="days_present" required data-error="Please Enter Number of Days Present" >
										<span class="error_msg" id="error_day"></span>
									<div class="help-block with-errors error_msg" ></div>
                           </div>
								</div>								
							</div>
						</div>

                        <div class="month-head">
                            <h6>Earnings &amp; Reimbursement</h6>
                        </div>
                        <div class="row">
                        	<div class="col-sm-12">
										<section class="form-group">
											
												<table id="month_sal" class="table-responsive display table table-bordered table-striped" cellspacing="0" width="100%">
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
																		<input class="form-control number" placeholder="" type="text"  id="basic" required data-error="Basic salary can not blank!" readonly>
																		<div class="help-block with-errors error_msg"></div>
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number clear_field" placeholder="" type="text" name="earn_basic" id="earn_basic" value="0" required data-error="Please Enter Basic Salary">
																		<div class="help-block with-errors error_msg"></div>
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
																		<input class="form-control number" placeholder="" type="text"  id="hra" readonly required data-error="HRA can not blank!">
																		<div class="help-block with-errors error_msg"></div>

																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number clear_field" placeholder="" type="text" name="earn_hra" id="earn_hra" value="0" required data-error="Please Enter HRA">
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
																		<input class="form-control number " placeholder="" type="text"  id="conveyance" readonly required data-error="Conveyance can not blank!" > 
																		<div class="help-block with-errors error_msg"></div>
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number clear_field" placeholder="" type="text" name="earn_conveyance" id="earn_conveyance" required data-error="Please Enter Conveyance" value="0">
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
																		<input class="form-control number" placeholder="" type="text" id="medical" readonly required data-error="Medical can not blank!" >
																		<div class="help-block with-errors error_msg"></div>
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number clear_field" placeholder="" type="text" name="earn_medical" id="earn_medical" required data-error="Please Enter Medical" value="0">
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
																		<input class="form-control number" placeholder="" type="text"  id="special" readonly required data-error="Special Allowances can not blank!">
																		<div class="help-block with-errors error_msg"></div>
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number clear_field" placeholder="" type="text" name="earn_special" id="earn_special" required data-error="Please Enter Special Allowances" value="0">
																		<div class="help-block with-errors error_msg"></div>
																	</div>
																</div>
															</td>
														</tr>														
														<tr id="lta_row" style="display: none;">
															<td>
																<div class="form-group">
																	<label class="form-label">LTA</label>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text"  id="lta" readonly>
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" name="earn_lta" id="earn_lta" value="0">
																	</div>
																</div>
															</td>
														</tr>														
														<tr id="mr_row" style="display: none;">
															<td>
																<div class="form-group">
																	<label class="form-label">Mobile reimbursement</label>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text"  id="mobile_remberse" readonly>
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" name="earn_mobile_remberse" id="earn_mobile_remberse" value="0">
																	</div>
																</div>
															</td>
														</tr>
														<tr id="mt_row" style="display: none;">
															<td>
																<div class="form-group">
																	<label class="form-label">Motor Allowance</label>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" id="motor_remberse" readonly>
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" name="earn_motor_remberse" id="earn_motor_remberse" value="0">
																	</div>
																</div>
															</td>
														</tr>
													

														<tr id="gt_row" style="display: none;">
															<td>
																<div class="form-group">
																	<label class="form-label">Gratuity</label>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" id="gt" readonly>
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" name="gratuty" id="gratuty" value="0">
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
																		<input class="form-control number" placeholder="" type="text"   id="arrears" readonly>
																	</div>
																</div>
															</td>
															<td>
																<div class="form-group">
																	<div class="form-control-wrapper form-control-icon-right">
																		<input class="form-control number" placeholder="" type="text" name="earn_arrears" id="earn_arrears" value="0">
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
										
										</section>
										</div>
									</div>
                       
	                        
                        <div class="month-head">
                            <h6>
                                Deduction &amp; Recovery
                            </h6>
                        </div>

                        <div class="row" id="pf_div" style="display: none;">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Provident Fund Actual</label>
										</div>
									</div>
								
									<div class="col-lg-4 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control number clear_field" placeholder="" type="text"  id="pf_amount" readonly>
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
												<input class="form-control number" placeholder="" type="text" name="provident_fund" id="provident_fund" value="0" readonly="">
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
												<input class="form-control number" placeholder="" type="text" name="pt_amount" id="pt_amount" value="0">
												
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
												<input class="form-control number" placeholder="" type="text" name="income_tax" id="income_tax" value="0">
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
												<input class="form-control number" placeholder="" type="text" id="gross" readonly value="0">
												
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
												<input class="form-control number clear_field" placeholder="" type="text" name="earn_total" id="earn_total" required data-error="Total earned can't be empty!" >
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
												<input class="form-control number" placeholder="" type="text" name="total_deduction" id="total_deduction" readonly>
												
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
												<input class="form-control number clear_field" placeholder="" type="text" name="net_pay" id="net_pay" required data-error="Net pay cant't be empty!" value="0">
												<div class="help-block with-errors error_msg"></div>
                                 </div>
										</div>
									</div>

								</div>

								<!-- <input type="text" name="total_deduction" id="total_deduction" > -->
								<div class="row">
									<div class="col-lg-6">
										<button class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label">Submit</span>
										<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
									
										<button class="btn btn-inline ladda-button" data-style="expand-left"><span class="ladda-label">Reset</span>
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
			// var total_earned = 0.0;
			var total_deduction = 0.0;
			// var net_pay = 0.0;
			// var income_tax = 0.0;
			var daysInMonth = $('#total_days').val();			
			var days_present =0;
			var pf_amount = 0.0;			
			var month = $('#month').val();
			var year = $('#year').val();	
			// var pt_amount = 0.0;
			// if(month==2)
			// 	pt_amount = 300;
			// else
			// 	pt_amount = 200;

		/*$("#datePicker1,#datePicker2").datepicker( {
		   format: "mm-yyyy",
		   viewMode: "months", 
		   minViewMode: "months"
		});*/
		
		$('#can_name').change(function(){
			var can_id = $("#can_name").chosen().val();
			var month = $("#month").val();
			var year = $("#year").val();
			if($('#can_name').val()=='')
			{
				$('#err_canid').html('Please Select Employee').show().delay(2000).fadeOut(1000);
				$("html, body").animate({ scrollTop: 0 }, "slow");
				return false;
				// console.log(can_id);	
			}
			else
			{

				var response = $.parseJSON($.ajax({
					url:  '<?php echo site_url();?>/compensation/get_can_salary_details',
					dataType: "json", 
					data: {can_id:can_id,month: month,year:year},
					type:'POST',
					async: false
				}).responseText);
				//console.log(response);
				if(response.msg == "1")
				{
					var month_name ='<?php echo $monthName;?>';
					var year ='<?php echo $year;?>';
					$('#monthly_salary_slip').trigger("reset");
					$('#error_profile').html('<div class="alert alert-danger alert-no-border alert-dismissible fade show" role="alert" style="margin-top:10px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Salary slip already generated for this employee for '+month_name+' '+year+' !</div>').show();
				}
				else if(response.msg == "2")
				{
					$('#monthly_salary_slip').trigger("reset");				
					$('#error_profile').html('<div class="alert alert-danger alert-no-border alert-dismissible fade show" role="alert"  style="margin-top:10px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Please update profile first!</div>').show().delay(2000).fadeOut(1000);
				}
				else if(response.msg == "3")
				{
					$('#monthly_salary_slip').trigger("reset");				
					$('#error_profile').html('<div class="alert alert-danger alert-no-border alert-dismissible fade show" role="alert" style="margin-top:10px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Please add salary details first!</div>').show().delay(2000).fadeOut(1000);
				}
				else
				{
					// console.log(response);
					$('#error_profile').html('').hide();
					if(response.salary != null)
					{
						console.log(response.salary);
						$('#pf_applicable').val(response.salary.pf_applicable);
						$('#emp_designation').val(response.salary.job_profile_title);
						$('#transaction_type').val(response.salary.transaction_type);
						$('#emp_department').val(response.salary.department_title);
						$('#balance_leave').val(response.salary.balance_leave);
						if(response.salary.pf_no!='')
						{
							$('#pf_no').val(response.salary.pf_no);
							$('.pf_no_div').css('display','block');
						}
						else
						{
							$('.pf_no_div').css('display','none');

							// $('.pf_no_div').hide();
						}
						$('#esic_no').val(response.salary.esic_no);
						$('#basic').val(response.salary.basic);
						$('#hra').val(response.salary.HRA);
						$('#conveyance').val(response.salary.conveyance);
						$('#medical').val(response.salary.medical);
						$('#special').val(response.salary.special_allowance);

						if(response.salary.LTA!=0)
						{
							$('#lta').val(response.salary.LTA);
							$('#lta_row').show();
						}
						if(response.salary.mobile_reimbursement!=0)
						{
							$('#mobile_remberse').val(response.salary.mobile_reimbursement);
							$('#mr_row').show();
						}
						if(response.salary.motor_allowance!=0)
						{						
							$('#motor_remberse').val(response.salary.motor_allowance);
							$('#mt_row').show();
						}
						if(response.salary.pf_amount!=0)
						{
							$('#pf_amount').val(response.salary.pf_amount);
							$('#pf_div').show();							
						}
						if(response.salary.pf_amount!=0)
						{
							$('#gt').val(response.salary.gratuity);
							$('#gt_div').show();							
						}

						// $('#pt_amount').val(pt_amount);

						$('#arrears').val(response.salary.arrears);
						$('#gross').val(response.salary.gross_pay);
						$('#job_profile_title').val(response.salary.job_profile_title);
						$('#transaction_type').val(response.salary.transaction_type);
						
						$('#total').val(response.salary.gross_pay);
						// $('#total_deduction').val(response.salary.total_deduction);

						if(response.salary.joining_date != null)
							$('#doj').val(formatDate (response.salary.joining_date));
						$('#days_present').val(response.leaves);
						$('#days_present').trigger('blur');
					}
					else
					{
						$('#monthly_salary_slip').trigger("reset");
						$(this).closest('form').find("input[type=text]").val("");	
					}
				}
			}			
			
		});



		$('#days_present').blur(function(){	
			days_present = $(this).val();

			var bal_leave = $('#balance_leave').val();
			
				if(($('#days_present').val() !='') && ($('#days_present').val() !=0))
				{
					if(parseInt(days_present) > parseInt(daysInMonth))
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

		$('input[type=radio][name=pf_applicable]').change(function() {
        if (this.value == 0) {
           $('#pf_amount').val(0);
        }
        else if (this.value == 1) {
        		pf_amount = ((12/100)*basic).toFixed(2);
           $('#pf_amount').val(pf_amount);
        }
    });

		function cal_salary()
		{
			if($('#gross').val() > 5000)
			{
				console.log('gross greater than 5000');
				basic = (($('#basic').val()/daysInMonth)*days_present).toFixed(2);	
				$('#earn_basic').val(basic);
				// console.log(basic);

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
				// $('#earn_special').val(special);
				// console.log(special);

				if($('#lta').val()!=0)
				{
					lta =(($('#lta').val()/daysInMonth)*days_present).toFixed(2);
					$('#earn_lta').val(lta);
					special = special - lta;
					// special = calc_special_allowance();	
					// console.log(special);

				}
				if($('#mobile_remberse').val()!=0)
				{
					mobile_remberse =(($('#mobile_remberse').val()/daysInMonth)*days_present).toFixed(2);
					$('#earn_mobile_remberse').val(mobile_remberse);
					special = special - mobile_remberse;

					// special = calc_special_allowance();	
				}
				if($('#motor_remberse').val()!=0)
				{
					motor_remberse =(($('#motor_remberse').val()/daysInMonth)*days_present).toFixed(2);
					$('#earn_motor_remberse').val(motor_remberse);
					special = special - motor_remberse;

					// special = calc_special_allowance();	
				}

				
				$('#earn_special').val(special);			
			

				// console.log(medical);


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
				total_deduction = calc_total_deduction();
			}
			else
			{
				total_earned = (($('#gross').val()/daysInMonth)*days_present).toFixed(2);	
				$('#earn_total').val(total_earned);
				$('#total_deduction').val($('#pt_amount').val());
				net_pay =  parseFloat(parseFloat(total_earned) - parseFloat($('#total_deduction').val()));
				$('#net_pay').val(net_pay);
			}	
		}


		function calc_total_pay()
		{
			total_earned = (parseFloat(parseFloat($('#earn_basic').val())+parseFloat($('#earn_hra').val())+parseFloat($('#earn_conveyance').val())+parseFloat($('#earn_medical').val())+parseFloat($('#earn_special').val())+parseFloat($('#earn_lta').val())+parseFloat($('#earn_mobile_remberse').val())+parseFloat($('#earn_motor_remberse').val())+parseFloat($('#gratuty').val())+parseFloat($('#earn_arrears').val()))).toFixed(2);
			$('#earn_total').val(total_earned);
			console.log('total_earned'+total_earned);			

		}

		function calc_net_pay()
		{
			net_pay = (parseFloat(parseFloat($('#earn_basic').val())+parseFloat($('#earn_hra').val())+parseFloat($('#earn_conveyance').val())+parseFloat($('#earn_medical').val())+parseFloat($('#earn_special').val())+parseFloat($('#earn_lta').val())+parseFloat($('#earn_mobile_remberse').val())+parseFloat($('#earn_motor_remberse').val())+parseFloat($('#gratuty').val())+parseFloat($('#earn_arrears').val())-parseFloat($('#provident_fund').val())-parseFloat($('#pt_amount').val())-parseFloat($('#income_tax').val()))).toFixed(2);
			$('#net_pay').val(net_pay);
			console.log('net_pay'+net_pay);

		}

		function calc_total_deduction()
		{
			total_deduction = (parseFloat(parseFloat($('#provident_fund').val())+ parseFloat($('#pt_amount').val())+parseFloat($('#income_tax').val()))).toFixed(2);
			$('#total_deduction').val(total_deduction);
		}

	 	function calc_special_allowance()
		{
			// console.log('in calc_special_allowance');
			// console.log($('#LTA').val());
			return special = (parseFloat($('#earn_total').val()) - (parseFloat($('#earn_basic').val())+parseFloat($('#earn_hra').val())+parseFloat($('#earn_conveyance').val())+parseFloat($('#earn_medical').val())+parseFloat($('#earn_lta').val())+parseFloat($('#earn_mobile_remberse').val())+parseFloat($('#earn_motor_remberse').val()))).toFixed(2);
			// $('#earn_special').val(special);
		}


	$( "#earn_lta" ).change(function()
	{
		total_earned = calc_total_pay();
		net_pay = calc_net_pay();					
		total_deduction = calc_total_deduction();					
		special = calc_special_allowance();					
	});

	$( "#earn_mobile_remberse" ).bind( "change", function() {
		total_earned = calc_total_pay();
		net_pay = calc_net_pay();
		total_deduction = calc_total_deduction();
		special = calc_special_allowance();					
	});

	$( "#earn_motor_remberse" ).bind( "change", function() {
		total_earned = calc_total_pay();
		net_pay = calc_net_pay();
		total_deduction = calc_total_deduction();
		special = calc_special_allowance();					
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
		$('#monthly_salary_slip').click(function (event) {
			if($('#can_name').val()=='')
			{
				$('#err_canid').html('Please Select Employee').show().delay(2000).fadeOut(1000);
				$("html, body").animate({ scrollTop: 0 }, "slow");
				return false;
				
			}
		});

	});
</script>


 
