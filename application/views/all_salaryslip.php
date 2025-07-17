<div class="page-content">
<div class="container-fluid">   
<div class="col-sm-12 well p-lg-0">
     <div class="row">
        <form data-toggle="validator" class="col-sm-12" id="profile_form" action=" " method="post">
            <h1 class="well headline">Employee Salary Details</h1>
                <div class="col-sm-12 col-xs-12 profile_bg">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-label">Employee ID </label>
                            </div>
                        </div>
                    
                        <div class="col-lg-10">
                            <div class="form-group">
                                <div class="form-control-wrapper form-control-icon-right">
                                    <input class="form-control" placeholder="Employee ID" type="text" name="emp_id" required="" oninvalid="this.setCustomValidity('Please Enter valid ID.')" 
                                    oninput="setCustomValidity('')">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-label">Select Year</label>
                            </div>
                        </div>
                    
                        <div class="col-lg-10">
                        <div class="form-group">
                            <div class="form-control-wrapper form-control-icon-right">
                                <select id="year" name="year" class="web col-md-12" required="">
                                    <optgroup label="Policy">
                                    <option value="pqr">2012</option>
                                      <option value="mno">2013</option>
                                      <option value="abc">2014</option>
                                      <option value="xyz">2015</option>
                                      <option value="pqr">2016</option>
                                      <option value="mno">2017</option>
                                    </optgroup>
                                
                                </select>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-label">Select Month</label>
                            </div>
                        </div>
                    
                        <div class="col-lg-10">
                        <div class="form-group">
                            <div class="form-control-wrapper form-control-icon-right">
                                <select id="month" name="month" class="web col-lg-12" required="">
                                    <optgroup label="Policy">
                                      <option value="abc">January</option>
                                      <option value="xyz">Feburary</option>
                                      <option value="pqr">March</option>
                                      <option value="mno">April</option>
                                      <option value="abc">May</option>
                                      <option value="xyz">June</option>
                                      <option value="pqr">July</option>
                                      <option value="mno">August</option>
                                      <option value="abc">September</option>
                                      <option value="xyz">October</option>
                                      <option value="pqr">November</option>
                                      <option value="mno">December</option>
                                    </optgroup>
                                
                                </select>
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

<div class="well col-md-12 ">
     <div class="row">
        <div class="table_bg col-sm-12 col-xs-12">
            <div class="row" style="padding: 5px 0px; border-bottom:3px solid #e3975b">
                <div class="col-lg-4">
                    <h1>
                        <img class="hidden-md-down" src="<?php echo base_url();?>img/logo.png" alt="">
                    </h1>
                </div>
            
                <div class="col-lg-8 text-right">
                    <h4>Raoson Business &amp; Softech Solutions Pvt Ltd</h4>
                    <h5><small>816, DBS Business Centre, The Corporate Park, 
                            Sector -18, <br/> Vashi, Navi Mumbai
                    </small></h5>
                </div>
            </div>
            <div class="container">
            <div class="row color-invoice">
                <div class="col-md-12 top_tab">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                
                                    <tbody>
                                        <tr>
                                            <td><strong>Emp Code</strong></td>
                                            <td>MUM0000000000</td>
                                        </tr>
                                        <tr>
                                            <td><strong>PF No. :</strong></td>
                                            <td>123456</td>
                                        </tr>
                                        <tr>
                                            <td><strong>ESIC No:</strong></td>
                                            <td>123456</td>
                                        </tr>
                                        <tr>
                                            <td><strong>DOJ :</strong></td>
                                            <td>01/08/17</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Balance PL :</strong></td>
                                            <td>12</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                
                                    <tbody>
                                        <tr>
                                            <td><strong>Emp Name : </strong></td>
                                            <td>Sanjivani</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Designation :</strong></td>
                                            <td>UI Developer</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Day Paid :</strong></td>
                                            <td>12</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Day Present :</strong></td>
                                            <td>23</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Balance CL :</strong></td>
                                            <td>12</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>  
                           
                    </div>
                </div>
              <hr />
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Earnings &amp; Reimbursement</th>
                          <th>Gross Salary</th>
                          <th>Actual Salary</th>
                          <th colspan="2">Deduction &amp; Recovery</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Basic</td>
                          <td>0</td>
                          <td>1</td>
                          <td>P.Tax</td>
                          <td>000</td>
                        </tr>
                        <tr>
                          <td>H.R.A</td>
                          <td>0</td>
                          <td>2</td>
                          <td>Income Tax</td>
                          <td>000</td>
                        </tr>
                        <tr>
                          <td>Conveyance</td>
                          <td>00</td>
                          <td>1</td>
                          <td>Loan</td>
                          <td>000</td>
                        </tr>
                        <tr>
                          <td>Medical</td>
                          <td>0</td>
                          <td>1</td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Special Allow</td>
                          <td>0</td>
                          <td>1</td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Mobile reimbursement</td>
                          <td>0</td>
                          <td>1</td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Motor Allowance</td>
                          <td>0</td>
                          <td>1</td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Total Earned</td>
                          <td>0</td>
                          <td>1</td>
                          <td>Total Deduction</td>
                          <td>0</td>
                        </tr>
                        <tr>
                          <td> </td>
                          <td></td>
                          <td></td>
                          <td>Net Pay</td>
                          <td>0</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <hr>
                
                </div>
              </div>
              
              <hr />
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <a href="#" class="btn btn-success btn-sm">Print Salary Slip</a>    
                  <a href="#" class="btn btn-info btn-sm">Download In Pdf</a>
                </div>
              </div>
              
              <hr>
              <div class="row">
        
      
      </div>
            </div>
          </div>
      </div>
        </div>
    </div>
</div>


