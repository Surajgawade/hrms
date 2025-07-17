<div class="page-content">
	<div class="container-fluid">	
	<?php $this->load->view('candidate/can_menu');?>

	<div class="well">
		 <div class="row">
			<form data-toggle="validator" class="col-sm-12" id="profile_form" action=" " method="post">
				<h1 class="well headline">Salary Slip Details</h1>
					<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">User ID :</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Employee ID" type="text" name="emp_id" required="" oninvalid="this.setCustomValidity('Please Enter valid ID.')" 
										oninput="setCustomValidity('')">
										
									</div>
								</div>
                            </div>
                            
                            <div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Employee Name :</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Employee Name" type="text" name="emp_name" required="" oninvalid="this.setCustomValidity('Please Enter valid Name')" 
										oninput="setCustomValidity('')">
										
									</div>
								</div>
							</div>
                        </div>
                        
                        <div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">PF No. :</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Enter PF No." type="text" name="pf_no">
										
									</div>
								</div>
                            </div>
                            
                            <div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">ESIC No. :</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="ESIC No." type="text" name="esic_no">
                                    </div>
								</div>
							</div>
                        </div>
                        
                        <div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Date Of Joining (Auto populate this)</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Date of Joining" type="text" name="doj">
										
									</div>
								</div>
                            </div>
                            
                            <div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Days Paid</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Enter Days Paid" type="text" name="esic_no">
                                    </div>
								</div>
							</div>
						</div>

                        <div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">PF No. :</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Enter PF No." type="text" name="pf_no">
										
									</div>
								</div>
                            </div>
                            
                            <div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">ESIC No. :</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="Employee Name" type="text" name="esic_no">
                                    </div>
								</div>
							</div>
						</div>

                        <div class="month-head">
                            <h6>
                                Earnings &amp; Reimbursement
                            </h6>
                        </div>

                        <div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Basic</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="" type="text" name="basic">
										
									</div>
								</div>
                            </div>
                            
                            <div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">H.R.A</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="" type="text" name="hra">
                                    </div>
								</div>
							</div>
                        </div>
                        
                        <div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Conveyance</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="" type="text" name="conveny">
										
									</div>
								</div>
                            </div>
                            
                            <div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Medical</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="" type="text" name="medical">
                                    </div>
								</div>
							</div>
                        </div>
                        
                        <div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Special Allow</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="" type="text" name="spcl_allow">
										
									</div>
								</div>
                            </div>
                            
                            <div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">LTA</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="" type="text" name="lta">
                                    </div>
								</div>
							</div>
                        </div>
                        
                        <div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Mobile reimbursement</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="" type="text" name="mob_reim">
										
									</div>
								</div>
                            </div>
                            
                            <div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Motor Allowance</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="" type="text" name="motor_allow">
                                    </div>
								</div>
							</div>
						</div>

                        <div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Arrears</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="" type="text" name="arrears">
										
									</div>
								</div>
                            </div>
                            
                            <div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Total Earned</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="" type="text" name="totol_earn">
                                    </div>
								</div>
							</div>
						</div>
                        
                        <div class="month-head">
                            <h6>
                                Deduction &amp; Recovery
                            </h6>
                        </div>

                        <div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Profession Tax</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="" type="text" name="ptax">
										
									</div>
								</div>
                            </div>
                            
                            <div class="col-lg-2">
								<div class="form-group">
									<label class="form-label">Income Tax</label>
								</div>
							</div>
						
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input class="form-control" placeholder="" type="text" name="income_tax">
                           </div>
								</div>
							</div>
						</div>

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


