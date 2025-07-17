<style type="text/css">
#headerdiv {
    font-family:"Arial", "Helvetica";
    font-size: 13px;
    font-weight: bold;
    color: black;
}
#valueDiv {
    color: black;
    text-align:center;
    font-size: 25px;
    padding: 10px;
    margin-top:5px;
    font-family:"Arial", "Helvetica";
    font-weight: bold;
}
.jqx-chart-legend-text {
  /*display: none !important;*/
}
</style>
<div class="page-content">
    <div class="container-fluid p-0">
        <div class="col-md-12">
            <div class="row">
                    <div class="col-lg-5 col-sm-12">
                        <div class="row four_block">
                            <div class="col-md-6 col-xl-6">
                              <a href="<?php echo site_url('organisation_tree'); ?>">
                                <div class="cyan-bgcolor order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Total Resources</h6>
                                        <h2 class="text-right"><i class="fa fa-users f-left"></i><span id="emp_cnt"></span></h2>
                                    </div>
                                  </div>
                              </a>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                  <a href="<?php echo site_url('task/my_task_list'); ?>">
                                    <div class="bgdarkgreen order-card">
                                        <div class="card-block">
                                            <h6 class="m-b-20">Task Management</h6>
                                            <h2 class="text-right"><i class="fa fa-align-justify f-left"></i><span id="pending_tasks"></span></h2>
                                        </div>
                                      </div>
                                    </a>
                                </div>
                            </div>
                            <div class="row four_block">
                                <div class="col-md-6 col-xl-6">
                                  <a href="<?php echo site_url('leave_management/leave_balance_details'); ?>">
                                    <div class="yellow_bg order-card">
                                        <div class="card-block">
                                            <h6 class="m-b-20">Leaves Balance <!-- <span class="pull-right bg-white apply_leave" style="font-size: 12px; padding:2px 5px; border-radius: 3px;">
                                                <a href="#leaveModal" data-toggle="modal" data-target="#leaveModal">Apply here</a></span> --></h6>
                                            <h2 class="text-right"><i class="fa fa-calendar f-left"></i><span id="leaves_pending"></span></h2>
                                        
                                         </div>
                                     </div>
                                  </a>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                  <a href="<?php echo site_url('leave_management/apply_for_leave'); ?>">
                                    <div class="bgdarkpink order-card">
                                        <div class="card-block">
                                            <h6 class="m-b-20">Leaves Taken</h6>
                                            <h2 class="text-right"><i class="fa fa-calendar f-left"></i><span id="leaves_taken"></span></h2>
                                         </div>
                                    </div>
                                  </a>
                                </div>
                            </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                      <a href="<?php echo site_url('attendance'); ?>">
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                               <section class="card attend_summ">
                                <header class="card-header">
                                   <i class="fa fa-user" aria-hidden="true"></i> Monthly Attendance Review
                                </header>
                                <div class="card-block">
                                    <div class="attend_summary" >
                                        <div class="row">
                                        <div class="col-md-3 col-xs-6">
                                            <a href="<?php echo site_url() ?>/attendance/">
					<div class="circle circle-green"><span class="col_count" id="present">0</span></div></a>
                                           <p>Present </p>
                                        </div>
                                        <div class="col-md-3 col-xs-6">
                                            <a href="<?php echo site_url() ?>/attendance/">
                                             <div class="circle circle-blue"><span class="col_count" id="half">0</span></div></a>
                                           <p>Half Day</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6">
                                             <a href="<?php echo site_url() ?>/attendance/">
					<div class="circle circle-brown"><span class="col_count" id="late">0</span></div></a>
                                           <p>Late Coming</p>
                                        </div>
                                        <div class="col-md-3 col-xs-6">
                                             <a href="<?php echo site_url() ?>/attendance/">
					<div class="circle circle-yellow"><span class="col_count" id="early">0</span></div></a>
                                           <p>Early Leaving</p>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                            </section>
                            </div>
                        </div>
                      </a>
                    </div>
                  <!--   <div class="col-sm-3">
                        <div class="row">
                            <div class="col-md-12">
                                <section class="card dash_calendar">
                                <header class="card-header">
                                   <i class="fa fa-calendar" aria-hidden="true"></i> Calendar
                                </header>
                                <div class="">
                                 
                                     <div class="auto-jsCalendar green"></div> 
                                      
                                       <div class="auto-jsCalendar material-theme red"></div>
                                </div>
                            </section>
                            </div>
                        </div>
                    </div> -->
                    <?php if(in_array(15,$widgets))
                         { 
                        ?>
                     <div class="col-lg-3 col-sm-6 well tile">
                        <section class="card user_birthdays">
                            <header class="card-header">
                               <i class="fa fa-birthday-cake" aria-hidden="true"></i>Birthdays
                            </header>
                            <div class="birthday_block">
                             <div class="panel-body card-block" id="user_birthdays">

                            </div>
                          </div>
                
                        </section>
                    </div> 
                    <?php } ?>
                    </div>
             </div>  
        </div>




        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php if(in_array(1,$widgets))
                         { 
                        ?>
            <div class="row">
                <div class="col-md-8 well tile">
                  <?php
                    $url=''; 
                    if(in_array('user_dashboard', $this->session->userdata('user_methods')))
                    {
                      $url='kra/user_dashboard';
                    }
                    elseif (in_array('manager_dashboard', $this->session->userdata('user_methods'))) {
                      $url='kra/manager_dashboard';
                    }
                    elseif (in_array('hr_dashboard', $this->session->userdata('user_methods'))) {
                      $url='kra/hr_dashboard';
                    }
                  ?>
                  <a href="<?php echo site_url($url); ?>">
                    <section class="card card-box">
                        <header class="card-header">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i> Employee Performance
                        </header>
                        <div class="card-block">
                            <!-- <div id='chartContainer' style="width:100%; height:250px;"/> -->
                            <div id='perform_chart' style="width:100%; height:250px;"/>
                        </div>
                    </section>
                  </a>
                </div>

                <div class="col-md-4 well tile">
                    <section class="card card-box">
                        <header class="card-header">
                          <i class="fa fa-pie-chart" aria-hidden="true"></i> Department Details
                        </header>
                        <div class="card-block">
                            <!-- <div id="chart-container"></div> -->
                            <div id="pie-container" style = "width: 100%; height: 250px; margin: 0 auto"></div>
                        </div>
                    </section>
                </div>
             <?php }?>
           
                <?php if(in_array(3,$widgets))
                 { 
                ?>
                 <div class="col-md-4  well tile">
                  <a href="<?php echo site_url('travel_management/my_travel_schedule_list'); ?>">
                    <section class="card card-box travel-block">
                        <header class="card-header">
                            <i class="fa fa-plane" aria-hidden="true"></i> Monthly Itinerary
                        </header>
                        <div class="travels_month">
                            <div class="panel-body" id="travels_month" style="text-align: center">
                                
                            </div>
                        </div>
                    </section>
                  </a>
                </div>
                 <?php }?>
                
                 <?php if(in_array(5,$widgets))
                             {
                            ?>
                <div class="col-md-4 well tile">
                    <section class="card card-box">
                        <header class="card-header">
                            <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i> Organisational Age
                        </header>
                        <div class="card-block">
                             <div id="chart-avg-age-employee"></div>
                        </div>
                    </section>
                </div>
                 <?php } ?>
                <?php if(in_array(6,$widgets))
                 { 
                ?>   
                 <div class="col-md-4  well tile">
                  <a href="<?php echo site_url('jobs/job_openings'); ?>">
                    <section class="card card-box jobs-block">
                        <header class="card-header">
                           <i class="fa fa-suitcase" aria-hidden="true"></i> Current Jobs
                        </header>
                        <div class="curr_jobs">
                           <div class="panel-body" id="curr_jobs">
                          </div>
                        </div>
                    </section>
                  </a>
                </div>
                 <?php }?>
               <?php if(in_array(8,$widgets))
                 {
                ?>

                <div class="col-md-4  well tile">
                  <a href="<?php echo site_url('compensation/my_salaryslips'); ?>">
                    <section class="card card-box">
                        <header class="card-header">
                           <i class="fa fa-inr" aria-hidden="true"></i> Department Remuniration
                        </header>
                         <div class="panel-body card-block" id="avg_dept_salary">
                        </div>
                    </section>
                  </a>
                </div>
    
                <?php }?>
                <?php if(in_array(9,$widgets))
                 { 
                ?>
                <!-- <div class="col-md-4  well tile">
                    <section class="card  card-box">
                        <header class="card-header">
                           <i class="fa fa-users" aria-hidden="true"></i> Departmentwise Employee Count
                        </header>
                         <div class="panel-body card-block" id="dept_emp_count">
                          
                            
                        </div>
            
                    </section>
                </div> -->
                <?php }?>
                <?php if(in_array(10,$widgets)) { ?>
                    <div class="col-md-4 well tile">
                      <a href="<?php echo site_url('resignation/resig_details'); ?>">
                                <section class="card card-box">
                                    <header class="card-header">
                                       <i class="fa fa-line-chart" aria-hidden="true"></i> Current Year Attrition Chart
                                    </header>
                                    <div class="panel-body card-block" id="resignation">
                                    </div>
                                </section>
                      </a>
                            </div>
                <?php } ?>

                <?php if(in_array(4,$widgets))
                 { 
                ?>
                <div class="col-md-4  well tile">
                  <a href="<?php echo site_url('calendar'); ?>">
                    <section class="card event-list-block card-box">
                        <header class="card-header">
                           <i class="fa fa-calendar" aria-hidden="true"></i> Ongoing Schedule
                        </header>

                    <div class="event-calendar">
                      
                        <div class="col-lg-12">
                            <div class="cal-day">
                                <span><strong>Today : <?php echo db_to_date(date('Y-m-d')); ?></strong></span>
                                <!-- <strong id="day_of_today">Friday</strong> -->
                            </div>
                           <div class="slimScrollDiv">
                                <ul class="event-list" id="events">

                                

                            </ul>         
                        </div>
                    </div>      
                    </section>
                </a>
                </div>
             <?php }?>

            <?php if(in_array(12,$widgets)) { ?>
            
                 <div class="col-md-4 well tile">
                    <section class="card card-box">
                        <header class="card-header">
                            <i class="fa fa-hand-pointer-o" aria-hidden="true"></i> Latest Polls
                        </header>
                        <div class="">
                            <div id="poll-container" class="newsTab" >
                                
                            </div>
                        </div>
                    </section>
                </div>
            <?php } ?>

            <?php if(in_array(14,$widgets)) {?>
            <div class="col-md-4  well tile">
                <section class="card card-box">
                    <header class="card-header">
                      <i class="fa fa-refresh" aria-hidden="true"></i>  Recent Updates
                    </header>
                     <div class="panel-body card-block" id="user_recent_activities">
                          <!-- <div class="panel-body card-block" id="user_recent_activities"> -->
                        
                    </div>
        
                </section>
            </div>
            <?php }?>
                     
             <?php if(in_array(7,$widgets))
                   {
                ?>
                 <div class="col-md-4 well tile">
                    <section class="card card-box">
                        <header class="card-header">
                           <i class="fa fa-bullhorn" aria-hidden="true"></i> Current News
                        </header>
                        <div class="event-calendar">
                          <div class="card-block">
                            <div id="news-container" class="newsTab">
                            </div>
                          </div>
                        </div>
                    </section>
                </div>

                <?php }?>  
               <!--  <div class="col-md-4  well tile">
                    <section class="card user_birthdays">
                        <header class="card-header">
                           <i class="fa fa-birthday-cake" aria-hidden="true"></i> Birthdays
                        </header>
                         <div class="panel-body card-block" id="user_birthdays">

                        </div>
            
                    </section>
                </div>  -->
                   <?php if(in_array(11,$widgets)) { ?>
             <!-- <div class="col-md-4 well tile">
                    <section class="card card-box">
                        <header class="card-header">
                           <i class="fa fa-check-circle-o" aria-hidden="true"></i> Profile Completed
                        </header>
                        <div class="load_c100">
                            <div class="c100 p50 big green" id="profile_completed">
                            <span></span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                    </section>
                </div> -->
                <?php } ?> 
                <?php if(in_array(13,$widgets)) {?>
               <div class="col-md-4  well tile">
                    <section class="card card-box">
                        <header class="card-header">
                          <i class="fa fa-user" aria-hidden="true"></i> My Profile Summary
                        </header>
                         <div class="panel-body card-block" id="user_profile_details">
                            <!-- <p id="pf_no"><strong> PF No </strong>: <span> </span> </p> -->
                            <p id="acc_no"> <strong>A/C No </strong>: <span></span> </p>
                            <p id="pan"> <strong>PAN </strong>:  <span></span></p>
                            <p id="aadhar"> <strong>Aadhar No </strong>: <span></span> </p>                        
                        </div>
            
                    </section>
                </div> 
                <?php }?>
                 <?php if(in_array(2,$widgets))
                 { 
                ?>
               <!--  <div class="col-md-4 well tile">
                    <section class="card card-box">
                        <header class="card-header">
                            <i class="fa fa-pie-chart" aria-hidden="true"></i> Monthly Performance
                        </header>
                        <div class="card-block">
                            <div id="pie-task"></div>
                        </div>
                    </section>
                </div> -->
                <?php }?>
    </div>
</div>
<div id="tmpinput" value="" style="display: none;">this is div </div> 
<div>
</div><!--.page-content-->

<!-- Leave Application Modal -->
<div class="modal fade" id="leaveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Leave Application</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form data-toggle="validator" class="col-sm-12" id="leave_application" action="<?php echo site_url();?>/leave_management/apply_for_leave " method="post">
                   
                    <div class="col-sm-12 col-xs-12 profile_bg">
                        <div class="row">
                            <div class="col-lg-2 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Leave From Date <span>*</span></label>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-9 col-xs-12">
                                <div class="date form-group">
                                    <div class="input-group input-append date" id="datePicker" data-date-start-date="0d" data-date-end-date="+1y">
                                        <input type="text" class="form-control number" name="from_date" id="from_date" placeholder="dd/mm/yyyy" required data-error="Please Enter Leave From Date" >
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <div class="help-block with-errors error_msg"></div>
                                        <span id="error_leaveappl" class="error_msg"></span>
                                </div>
                            </div>  
                            <div class="col-lg-2 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Leave To Date <span>*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-9 col-xs-12">
                                <div class="date form-group">
                                    <div class="input-group input-append date" id="datePicker1" data-date-start-date="0d" data-date-end-date="+1y">
                                    <input type="text" class="form-control number" name="to_date" id="to_date" placeholder="dd/mm/yyyy" data-error="Please Enter Leave To Date" required />
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <div class="help-block with-errors error_msg" id="to_dt"></div>
                                    <span id="error_leaveappltodate" class="error_msg"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2 col-sm-3 col-xs-12">
                                <div class="form-group">
                                <label class="form-label">Reason For Leave <span>*</span></label>
                                </div>
                            </div>

                            <div class="col-lg-10 col-sm-9 col-xs-12">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <textarea placeholder="Reason For Leave" name="reason" id="reason" rows="2" class="form-control" data-error="Please Enter Reason for Leave" required></textarea>
                                        <i class="fa fa-address-card"></i>
                                        <div class="help-block with-errors error_msg"></div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2 col-sm-3 col-xs-12">
                                <div class="form-group">
                                <label class="form-label">Mobile Number <span>*</span></label>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-9 col-xs-12">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <input type="text" placeholder="Enter mobile number" class="form-control number"  minlength="10" maxlength="10" required data-error="Please Enter Valid Mobile Number" pattern="^(\+\d{1,3}[- ]?)?\d{10}$" minlength="10" min="1000000000" max="9999999999" maxlength="10" name="mobile_no" id="mobile_no" value="<?php echo $can_details->phone1?>" >
                                        <i class="fa fa-mobile"></i>
                                        <div class="help-block with-errors error_msg" id ="phone1_err"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-3 col-xs-12">
                                <div class="form-group">
                                <label class="form-label">Alternate Number</label>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-9 col-xs-12">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <input type="text" placeholder="Alternate Number Here.." class="form-control number" name="phone_no" id="phone_no" min="1000000000" max="9999999999" minlength="10" maxlength="10">
                                        <i class="fa fa-phone"></i>
                                        <div class="help-block with-errors error_msg" id="phone2_err"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Leave Address</label>
                                </div>
                            </div>

                            <div class="col-lg-10 col-sm-9 col-xs-12">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <textarea placeholder="Leave Address" rows="2" class="form-control"  name="leave_address" id="leave_address"></textarea>
                                        <i class="fa fa-address-card"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2 col-sm-3 col-xs-12">
                                <div class="form-group">
                                <label class="form-label">Leave Type</label>
                                </div>
                            </div>
                            <div class="col-lg-10 col-sm-9 col-xs-12">
                                <?php 
                                $CI = get_instance();
                                $CI->load->model('leave_model');
                                $leave_types = $CI->leave_model->get_leave_list();?>
                                <div class="form-group">
                                    <div class="select-block1">
                                        <select name="leave_type" id="leave_type" style="width: 100%">
                                            <optgroup label="Select Leave Type">
                                            <?php foreach ($leave_types as $type) {?>
                                            <option value="<?php echo $type->type_id?>"><?php echo $type->leave_title?></option>
                                        <?php }?>   
                                        </optgroup>                             
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <input id="submit_leave_appli" type="submit" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
                                <input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
                            </div>
                        </div>
                    </div>
                </form> 
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>


<!-- Birthday wishesh Modal -->
<div class="modal fade" id="birthdaywishModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Wish Happy Birthday</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form data-toggle="validator" class="col-sm-12" id="birthday_wishesh" action="<?php echo site_url();?>/candidate/birthday_wishes" method="post">
                   <input type="hidden" name="can_id" id="can_id">
                    <div class="col-sm-12 col-xs-12 profile_bg">
                        <div class="row">
                            <div class="col-lg-2 col-sm-3 col-xs-12">
                                <div class="form-group">
                                <label class="form-label">Name</label>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-9 col-xs-12">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <input type="text" class="form-control" required  name="name" id="name" value="" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-3 col-xs-12">
                                <div class="form-group">
                                <label class="form-label">Email Id</label>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-9 col-xs-12">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <input type="text" class="form-control" required  name="email" id="email" value="" readonly>                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-sm-3 col-xs-12">
                                <div class="form-group">
                                <label class="form-label">Message<span>*</span></label>
                                </div>
                            </div>

                            <div class="col-lg-10 col-sm-9 col-xs-12">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <textarea placeholder="Message" name="message" id="message" rows="3" class="form-control" data-error="Please Enter Message" required></textarea>
                                        <i class="fa fa-address-card"></i>
                                        <div class="help-block with-errors error_msg" id="bd_mess"></div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <input id="submit_birthday_wish" type="button" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Send Wishes"/>
                            </div>
                        </div>
                    </div>
                </form> 
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

  <!-- modal -->
<div id="interview_notice" class="modal fade in" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Today's Scheduled Interviews</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>        
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <th>Candidate Name</th>
            <th>Email ID</th>
            <th>Phone Number</th>
          </thead>
          <tbody id="interview_table">
            
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  <!-- end modal -->

  <div class="modal fade" id="changepass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Change Password</h4>       
      </div>
      <div class="modal-body" >
        <div>
          <form name="change_pass" id="frm_change_pass" method="post" action="#">
                <div class="form-group row">
                  <div class="col-xl-4">
                    <label class="form-label">Current Password</label>
                  </div>
                  <div class="col-xl-8">
                    <input class="form-control" type="password" name="current_pass" id="current_pass" placeholder="Current Password"/>
                    <span id="err_curr_pass" class="error_msg"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-xl-4">
                    <label class="form-label">New Password</label>
                  </div>
                  <div class="col-xl-8">
                    <input class="form-control" type="password" name="new_password" id="new_password" placeholder="New Password"/>
                    <span id="err_newpass" class="error_msg"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-xl-4">
                    <label class="form-label">Confirm New Password</label>
                  </div>
                  <div class="col-xl-8">
                    <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password"/>
                    <span id="err_confirmpass" class="error_msg"></span>
                  </div>
                </div>
              </section>

              <section class="box-typical-section profile-settings-btns">
                <button type="button" id="change_pass_btn" class="btn btn-success">Save Changes</button>
              </section>
            </form> 
        </div>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="<?php echo assets_url();?>css/lib/fullcalendar/calendar.css">

    
  <!-- Chart pie -->
  <script src="<?php echo assets_url();?>js/lib/charts-c3js/fusioncharts.charts.js"></script>
  <script src="<?php echo assets_url();?>js/lib/charts-c3js/fusioncharts.js"></script>
  <script src="<?php echo assets_url();?>js/lib/charts-c3js/fusioncharts.gantt.js"></script>
  <script src="<?php echo assets_url();?>js/lib/charts-c3js/piechart.js"></script>
  <!-- <script src="<?php //echo assets_url();?>js/lib/charts-c3js/barchart.js"></script> -->
  <script src="<?php echo assets_url();?>js/lib/d3/d3.min.js"></script>
  <script src="<?php echo assets_url();?>js/lib/charts-c3js/c3.min.js"></script>
  <script src="<?php echo assets_url();?>js/lib/charts-c3js/c3js-init.js"></script>


 <?php /* <script src="<?php echo assets_url();?>js/lib/summernote/summernote.min.js"></script>*/?>
<script type="text/javascript">
    var ageGroupChart = new FusionCharts();
    var profileGroupChart = new FusionCharts();
    var resignationChart = new FusionCharts();
    $(document).ready(function() {
     
    $('#datePicker, #datePicker1').datepicker({
        format: 'dd/mm/yyyy',
            autoclose : true,
            minDate: new Date(),
            // maxDate:new Date()
    });


  	    get_tasks_list();
        get_leaves_list();
        get_attendance_details();
        get_day();
        get_emp_cnt();
        // get_user_profile_details();
        get_recent_activities();

        <?php if(in_array(2,$widgets)){ ?>
            get_pie_chart();
        <?php } ?>
        <?php if(in_array(3,$widgets)){ ?>
            get_events();
        <?php } ?>
        <?php if(in_array(4,$widgets)){ ?>
            get_travels();
        <?php } ?>
        
        <?php if(in_array(1,$widgets)){ ?>
            //get_performace_report();
        <?php }?>
        
        <?php if(in_array(6,$widgets)){ ?>
            get_jobs();
        <?php }?>
        <?php if(in_array(7,$widgets)){ ?>
            get_news();
        <?php }?>
        <?php if(in_array(5,$widgets)){ ?>
        get_avg_employee_age();
        <?php }?>
     <?php if(in_array(8,$widgets)){ ?>
    get_dept_average_salary();
        <?php }?>

     <?php if(in_array(9,$widgets)){ ?>
            get_dept_emp_count();
    <?php }?>
    <?php if(in_array(10,$widgets)) {?>
        get_resignations();
    <?php } ?>
    <?php if(in_array(11,$widgets)) {?>
        get_profile_completed_per();
    <?php } ?>
    <?php if(in_array(12,$widgets)) {?>
        get_polls();
    <?php } ?>

    <?php if(in_array(13,$widgets)) {?>
        get_rpo_user_profile_details();
    <?php } ?>

    <?php if(in_array(15,$widgets)){?>
        get_user_birthdays();
        <?php }?>
   });

    // $('#datePicker1').on('changeDate', function(e) {
    //     $('#datePicker').datepicker('setEndDate', $('#to_date').val());
    //     var start = $('#datePicker').datepicker('getDate');
    //     var end = $(this).datepicker('getDate');
    //     var days = (end - start) / (1000 * 60 * 60 * 24);
    //     if(days < 0)
    //     {
    //         $('#to_dt').text("From date cannot be greater than To date").show().delay(2000).fadeOut(800);
    //         $('#to_date').val('');
    //     }
    // });

    // $('#datePicker').on('changeDate', function(e) {
    //      $('#datePicker1').datepicker('setStartDate', $('#from_date').val());
    //     var start = $(this).datepicker('getDate');
    //     var end = $('#datePicker1').datepicker('getDate');
    //     var days = (end - start) / (1000 * 60 * 60 * 24);
    //     if(days < 0)
    //     {
    //         $('#to_dt').text("From date cannot be greater than To date").show().delay(2000).fadeOut(800);
    //         $('#to_date').val('');
    //     }
    // });

        
/*$('#datePicker').on('changeDate', function(e) {
    $('#datePicker1').datepicker('setStartDate', $('#from_date').val());
    var can_id = '<?php //echo $userdata['id'];?>';
    var from_date = $('#from_date').val();
    console.log($('#from_date').val());
    $.ajax({
            url: '<?php //echo site_url();?>/leave_management/get_can_leaves',
            data : {can_id: can_id,from_date:from_date },
            type: 'POST',
            success: function(response){
                console.log(response);
                if(response==1)
                {
                    $('#error_leaveappl').html('You have already applied leave for same date.').show();
                    $('#submit_leave_appli').attr('disabled',true);
                    return false;
                }
                else
                {
                    $('#submit_leave_appli').removeAttr('disabled');
                    $('#error_leaveappl').html('').hide();              
                }
            }
        });
     var start = $(this).datepicker('getDate');
    var end = $('#datePicker1').datepicker('getDate');
    var days = (end - start) / (1000 * 60 * 60 * 24);
    if(days < 0)
    {
        $.notify({
            title: "<strong>Warning</strong>",
            message: "Leave from date should be less than Leave to Date",
            
        },
        {
            type: 'warning',
            delay: 800,
            animate:{
                enter: "animated fadeInUp",
                exit: "animated fadeOutDown"
            }
        });
        $('#fr_dt').text("From Date must be less than To Date.").show().delay(2000).fadeOut(800);
        $('#to_date').val('');
    }
});

$('#datePicker1').on('changeDate', function(e) {
    $('#datePicker').datepicker('setEndDate', $('#to_date').val());
    var can_id = '<?php //echo $userdata['id'];?>';
    var from_date = $('#to_date').val();
    console.log($('#to_date').val());
    $.ajax({
            url: '<?php //echo site_url();?>/leave_management/get_can_leaves',
            data : {can_id: can_id,from_date:from_date },
            type: 'POST',
            success: function(response){
                console.log(response);
                if(response==1)
                {
                    $('#error_leaveappltodate').html('You have already applied leave for same date.').show().delay(2000).fadeOut(800);
                    $('#submit_leave_appli').attr('disabled',true);
                    return false;
                }
                else
                {
                    $('#submit_leave_appli').removeAttr('disabled');
                    $('#error_leaveappltodate').html('').hide();                
                }
            }
        });
    var start = $('#datePicker').datepicker('getDate');
    var end = $(this).datepicker('getDate');
    var days = (end - start) / (1000 * 60 * 60 * 24);
    if(days < 0)
    {
        $.notify({
            title: "<strong>Warning</strong>",
            message: "Leave from date should be less than Leave to Date",
            
        },
        {
            type: 'warning',
            delay: 800,
            animate:{
                enter: "animated fadeInUp",
                exit: "animated fadeOutDown"
            }
        });
        $('#fr_dt').text("From Date must be less than To Date.").show().delay(2000).fadeOut(800);
          $('#to_date').val('');
    }
});*/
    function get_news(){
        $.ajax({
            url:'<?php echo site_url();?>/dashboard/get_news',
            dataType:"json",
            type:'POST',
            success:function(response){
                var row = "";
        if(response != '' && response != null)
        {
                $.each(response,function(index,value){
                    var path='<?php echo base_url();?>index.php/news/view/'+value.nw_id;
                    $("#tmpinput").html(value.nw_description);
                    var nw_description = $("#tmpinput").text();
                    if(nw_description.length>90){
                        nw_description=nw_description.substr(0,87);
                    }
                    nw_description=nw_description+'...<a href="'+path+'">Read More</a>';
                    row+="<div class='col-md-12 nopadding dash_news'><div class='row col-md-12'><h5>"+value.nw_title+"</h5></div><div class='col-md-3 nopadding news_img'><img class='img-responsive' src='<?php echo base_url(); ?>/uploads/newsImage/"+value.image_name+"'></div><div class='col-md-9' style='float:left'>"+nw_description+"</div></div>";
                });
        }
        else
        {
            row = "No Current News.";
        }
        $("#news-container").prepend(row);
            },
            error:function(xhr){
                console.log(xhr.responseText);
            }
        });
    }

                               

    function get_tasks_list()
    {
        $.ajax({
            url: '<?php echo site_url();?>/dashboard/get_tasks_list',
            dataType :"json",
            type: 'POST',
            success: function(response)
            {
                $('#pending_tasks').html(response.pending_tasks);
                $('#completed_tasks').html(response.completed_tasks);
            }
        });
    }

    function get_leaves_list()
    {
        $.ajax({
            url: '<?php echo site_url();?>/dashboard/get_leaves_list',
            dataType :"json",
            type: 'POST',
            success: function(response)
            {
                $('#leaves_taken').html(response.leaves_taken);
                $('#leaves_pending').html(response.pending_leaves);
            }
        });
    }

    function get_attendance_details()
    {
        $.ajax({
            url: '<?php echo site_url();?>/dashboard/get_attendance_details',
            dataType :"json",
            type: 'POST',
            success: function(response)
            {
                $('#present').html(response.present);
                $('#half').html(response.half);
                $('#late').html(response.late);
                $('#early').html(response.early);
            }
        });
    }

    function get_events()
    {
        $.ajax({
            url: '<?php echo site_url();?>/dashboard/get_events',
            dataType :"json",
            type: 'POST',
            success: function(response)
            {
                $('#events').html('');
                var data = '';
                if(response == '')
                {
                    data = 'No Events Today';
                }
                else
                {
                    $.each(response, function(key,val) {
                        data += '<li>'+val.title+'</li>';
                    });
                }
                $('#events').html(data);
            }
        });
    }

     function get_travels()
    {
        $.ajax({
            url: '<?php echo site_url();?>/dashboard/get_travels',
            dataType :"json",
            type: 'POST',
            success: function(response)
            {
                var t_data = ''
                if(response.travels == '')
                {
                    t_data = '<img class="img-responsive" src="<?php echo assets_url();?>img/no-record-found.jpg">';
                }
                else
                {
                    t_data ='<table class="tbl-typical"><tbody><tr><th><div>Description</div></th><th><div>Status</div></th></tr>';
                          $.each(response.travels, function(k_tr, v_tr) {
          
                                t_data += ' <tr><td class=""><a href="<?php echo site_url("travel_management/my_travel_schedule_list/"); ?>">'+v_tr.location+' for '+v_tr.purpose+'</a></td><td><span class="label-success label label-primary">'+v_tr.status+'</span></td></tr>';

                    });
                          t_data +=' </tbody></table>';
                    
                    // t_data += '<div class="view_btn"><a href="<?php //echo site_url("travel_management/my_travel_schedule_list/"); ?>" class="btn btn-sm btn-primary" value="10">View More</a></div>';
                }

                $('#travels_month').html(t_data);
            }
        });
    }


    function get_pie_chart()
    {
        $.ajax({
            url: '<?php echo site_url();?>/dashboard/get_pie_chart',
            dataType :"json",
            type: 'POST',
            success: function(response)
            {
                var ct = 0;
                var pt = 0;
                if(response.month_pending_tasks > 0)
                {
                    pt = response.month_pending_tasks;
                }
                if(response.month_completed_tasks > 0)
                {
                    ct = response.month_completed_tasks;
                }
                var ageGroupChart = new FusionCharts({
                    type: 'pie2d',
                    renderAt: 'pie-task',
                    width: '100%',
                    height: '320',
                    dataFormat: 'json',
                    dataSource: {   
                        "chart": {
                            "subcaption": "(Right-click to see the export modes available)",
                            "exportenabled": "1",
                            "exportatclient": "1",
                            "exporthandler": "http://export.api3.fusioncharts.com",
                            "html5exporthandler": "http://export.api3.fusioncharts.com",
                            "caption": "Monthly Performance",
                            "subCaption": "This Month",
                            "paletteColors": "#6baa01,#008ee4,#f8bd19,#e44a00,#33bdda",
                            "bgAlpha": "0",
                            "borderAlpha": "20",
                            "use3DLighting": "0",
                            "showShadow": "0",
                            "enableSmartLabels": "0",
                            "startingAngle": "20",
                            "showLabels": "0",
                            "showLegend": "1",
                            "legendShadow": "0",
                            "legendBorderAlpha": "0",
                            "enableMultiSlicing": "0",
                            "slicingDistance": "15",
                            "showPercentValues": "1",
                            "showPercentInTooltip": "0",
                            "decimals": "1"
                    },
                        "data": [{
                        "label": "Completed",
                        "value": ct
                    }, {
                        "label": "Pending",
                            "value": pt,
                            "isSliced": "1"
                        }]
                    }
                });
                ageGroupChart.render();
            }
        });
    }

     function get_performace_report()
    {
        $.ajax({
            url: '<?php echo site_url();?>/dashboard/get_performace_report',
            dataType :"json",
            type: 'POST',
            success: function(response)
            {
                //response='<?php //echo json_decode(ressponse) ?>';
                // /response=JSON.parse(response);
                //alert(response[0]);
                //response=JSON.stringify(response);
                //response = response.substr(1).slice(0, -1);
                //console.log(response.categories);
                FusionCharts.ready(function () {
                var salesAnlysisChart = new FusionCharts({
                    type: 'MSColumn2D',
                    renderAt: 'chart-container',
                    width: '100%',
                    height: '200',
                    dataFormat: 'json',
                    dataSource: {
                    "chart": {
                        // "caption": response.categories,
                        "exportenabled": "1",
                        "exportatclient": "1",
                        "exporthandler": "http://export.api3.fusioncharts.com",
                        "html5exporthandler": "http://export.api3.fusioncharts.com",
                        "xAxisname": "Month",
                        "yAxisName": "No Of Tasks",
                        // "numberPrefix": "$",
                        "showBorder": "0",
                        "showValues": "0",
                        "paletteColors": "#0075c2,#1aaf5d,#f2c500",
                        "bgColor": "#ffffff",
                        "showCanvasBorder": "0",
                        "canvasBgColor": "#ffffff",
                        "captionFontSize": "14",
                        "subcaptionFontSize": "14",
                        "subcaptionFontBold": "0",
                        "divlineColor": "#999999",
                        "divLineIsDashed": "1",
                        "divLineDashLen": "1",
                        "divLineGapLen": "1",
                        "showAlternateHGridColor": "0",
                        "usePlotGradientColor": "0",
                        "toolTipColor": "#ffffff",
                        "toolTipBorderThickness": "0",
                        "toolTipBgColor": "#000000",
                        "toolTipBgAlpha": "80",
                        "toolTipBorderRadius": "2",
                        "toolTipPadding": "5",
                        "legendBgColor": "#ffffff",
                        "legendBorderAlpha": '0',
                        "legendShadow": '0',
                        "legendItemFontSize": '10',
                        "legendItemFontColor": '#666666',
                         "theme": "zune",
                         "drawCrossLine": "1",
                          "crossLineColor": "#cc3300",
                        "crossLineAlpha": "100"
                    },
                    "categories": [
                            response.categories,
                    ],
                    "dataset": 
                        response.dataset,
                }
                }).render();
             });

            }
        });
    }
    function get_day()
    {
        var d = new Date();
        var weekday = new Array(7);
        var month = new Array(12);
        var curr_date = d.getDate();
        var curr_month = d.getMonth();
        var curr_year = d.getFullYear();
        weekday[0] =  "Sunday";
        weekday[1] = "Monday";
        weekday[2] = "Tuesday";
        weekday[3] = "Wednesday";
        weekday[4] = "Thursday";
        weekday[5] = "Friday";
        weekday[6] = "Saturday";
        month[0] =  "January";
        month[1] = "February";
        month[2] = "March";
        month[3] = "April";
        month[4] = "May";
        month[5] = "June";
        month[6] = "July";
        month[7] =  "August";
        month[8] = "September";
        month[9] = "October";
        month[10] = "November";
        month[11] = "December";
        var n = weekday[d.getDay()];
        var m = month[d.getMonth()];
        $('#day_of_today').html(n);
        $('#mnth').html(m+' '+curr_year);
    }


     function get_jobs()
    {
        $.ajax({
            url: '<?php echo site_url();?>/dashboard/get_jobs',
            dataType :"json",
            type: 'POST',
            success: function(response)
            {
                console.log(response);
                var t_data = '';
                if(response.jobs == '')
                {
                    t_data = 'No Current Openings.';
                }

              else
                {
                    t_data ='<table class="tbl-typical"><tbody><tr><th><div>Status</div></th><th><div>No. of Positions</div></th> <th align="center"><div>Job Title</div></th></tr>';
                          $.each(response.jobs, function(k_tr, v_tr) {  
                                                        
                                t_data += ' <tr><td><span class="label label-success">'+v_tr.status+'</span></td><td class="">'+v_tr.no_of_position+'</td><td align="center"> <a style="text-decoration: none;" href="<?php echo site_url("jobs/job_openings/"); ?>'+v_tr.job_id+'">'+v_tr.job_title+'</a></td></tr>';

                            
                    });
                          t_data +=' </tbody></table>';
                    
                }
                
                $('#curr_jobs').html(t_data);
            }
        });
    }

    function get_avg_employee_age()
    {   
        $.ajax({
            url: '<?php echo site_url();?>/dashboard/get_avg_employee_age',
            dataType :"json",
            type: 'POST',
            success: function(response)
            {
                FusionCharts.ready(function () {
                var csatGauge = new FusionCharts({
                    "type": "angulargauge",
                    "renderAt": "chart-avg-age-employee",
                    "width": "100%",
                    "height": "200",
                    "dataFormat": "json",
                    "dataSource":{
                           "chart": {
                              "caption": false,
                              "lowerLimit": "0",
                              "upperLimit": "100",
                              "theme": "fint",
                                "showValue": "1",
                              "valueBelowPivot": "1",
                           },
                           "colorRange": {
                              "color": [
                                 {
                                    "minValue": "0",
                                    "maxValue": "50",
                                    "code": "#e44a00"
                                 },
                                 {
                                    "minValue": "25",
                                    "maxValue": "50",
                                    "code": "#e44a00"
                                 },
                                 {
                                    "minValue": "50",
                                    "maxValue": "75",
                                    "code": "#f8bd19"
                                 },
                                 {
                                    "minValue": "75",
                                    "maxValue": "100",
                                    "code": "#6baa01"
                                 }
                              ]
                           },
                           "dials": {
                              "dial": [
                                 {
                                    "value": response
                                 }
                              ]
                           }
                        }
                  });

                csatGauge.render();
            });
            }
        });

    }
   function get_dept_average_salary()
    {
        $.ajax({
            url: '<?php echo site_url();?>/dashboard/get_dept_average_salary',
            dataType :"json",
            type: 'POST',
            success: function(response)
            {
                // console.log(response);
                FusionCharts.ready(function () {
                var ageGroupChart = new FusionCharts({
                    type: 'pie3d',
                    renderAt: 'avg_dept_salary',
                    width: '100%',
                    height: '215',
                    dataFormat: 'json',
                    dataSource:  {
                        "chart": {
                        "caption": "Departments Average Salary",
                        "paletteColors": "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000",
                        "bgColor": "#ffffff",
                        "showBorder": "0",
                        "use3DLighting": "0",
                        "showShadow": "0",
                        "enableSmartLabels": "0",
                        "startingAngle": "0",
                        "showPercentValues": "1",
                        "showPercentInTooltip": "0",
                        "decimals": "1",
                        "captionFontSize": "14",
                        "subcaptionFontSize": "14",
                        "subcaptionFontBold": "0",
                        "toolTipColor": "#ffffff",
                        "toolTipBorderThickness": "0",
                        "toolTipBgColor": "#000000",
                        "toolTipBgAlpha": "80",
                        "toolTipBorderRadius": "2",
                        "toolTipPadding": "5",
                        "showHoverEffect":"1",
                        "showLegend": "1",
                        "legendBgColor": "#ffffff",
                        "legendBorderAlpha": '0',
                        "legendShadow": '0',
                        "legendItemFontSize": '10',
                        "legendItemFontColor": '#666666',
                        "showLabels":'0',
                        "showValues":'0',
                        "plottooltext": "<b>$label : $percentValue</b>",
                    },
                        "data": response
                    }
                    }).render();
                });
            }
        });
    }
   function get_dept_emp_count_highchart()
   {
        $.ajax({
            url: '<?php echo site_url();?>/dashboard/get_dept_emp_count_highchart',
             dataType :"json",
            type: 'POST',
            success: function(response)
            {
                $('#pie-container').highcharts({
                         chart: {
                            type: 'pie',
                            marginBottom:50,
                            marginTop:-40,
                                options3d: {
                                        enabled: true,
                                        alpha: 45
                                    }
                                
                        },
                        title:false,
                        plotOptions: {
                            series: {
                                cursor: 'pointer',
                                point: {
                                    events: {
                                        click: function() {
                                            location.href = this.options.url;
                                        }
                                    }
                                }
                            },
                            pie: {
                                    showInLegend: true,
                                    dataLabels: {
                                      enabled: false,                       
                                      formatter: function() {
                                          return this.percentage.toFixed(2) + '%';
                                          }
                                        } ,
                                    innerSize: 100,
                                    depth: 45
                                }
                        },
                        legend: {
                                   y: 20,
                                  enabled: true,
                                  floating: true,
                                  verticalAlign: 'bottom',
                                  align:'center',
                                  symbolRadius:0,
                                  paddingTop:10,
                                  labelFormatter: function() {
                                      return '<div style="width:60px;">' +this.name+ '</div>';
                                      }
                                },
                        tooltip: {
                                    formatter: function() {
                                      return '<b>'+ this.point.name +
                                             ' :</b>  <b>'+ this.y +'%</b>';        
                                  }
                        },
                        series: [{

                            data: response
                        }]
            });
            }
        });
   }
    function get_dept_emp_count()
    {
        $.ajax({
            url: '<?php echo site_url();?>/dashboard/get_dept_emp_count',
            dataType :"json",
            type: 'POST',
            success: function(response)
            {
                FusionCharts.ready(function () {
                var ageGroupChart = new FusionCharts({
                    type: 'pie2d',
                    renderAt: 'dept_emp_count',
                    width: '100%',
                    height: '215',
                    dataFormat: 'json',
                    dataSource: {
                        "chart": {
                            "caption": false,
                            "subCaption": "",
                            "paletteColors": "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000",
                            "bgColor": "#ffffff",
                            "showBorder": "0",
                            "use3DLighting": "0",
                            "showShadow": "0",
                            "enableSmartLabels": "0",
                            "startingAngle": "0",
                            "showPercentValues": "1",
                            "showPercentInTooltip": "0",
                            "decimals": "1",
                            "captionFontSize": "14",
                            "subcaptionFontSize": "14",
                            "subcaptionFontBold": "0",
                            "toolTipColor": "#ffffff",
                            "toolTipBorderThickness": "0",
                            "toolTipBgColor": "#000000",
                            "toolTipBgAlpha": "80",
                            "toolTipBorderRadius": "2",
                            "toolTipPadding": "5",
                            "showHoverEffect":"1",
                            "showLegend": "1",
                            "legendBgColor": "#ffffff",
                            "legendBorderAlpha": '0',
                            "legendShadow": '0',
                            "legendItemFontSize": '10',
                            "legendItemFontColor": '#666666'
                        },
                        
                        "data": response
                }
                    }).render();
                });
            }
        });
    }
    
    function get_resignations()
    {
        $.ajax({
            url: '<?php echo site_url();?>/dashboard/get_resignations',
            dataType :"json",
            type: 'POST',
            success: function(response)
            {
                var indChart = new FusionCharts({
                    type: 'msline',
                    renderAt: 'resignation',
                    width: '100%',
                    height: '215',
                    dataFormat: 'json',
                    dataSource: {
                        "chart": {
                            "caption": "Joinee vs Attrition",
                            //"subCaption": "Joinee vs Resignations",
                            "captionFontSize": "14",
                            "subcaptionFontSize": "14",
                            "subcaptionFontBold": "0",
                            "paletteColors": "#0075c2,#ff0000",
                            "bgcolor": "#ffffff",
                            "showBorder": "0",
                            "showShadow": "0",
                            "showCanvasBorder": "0",
                            "usePlotGradientColor": "0",
                            "legendBorderAlpha": "0",
                            "legendShadow": "0",
                            "showAxisLines": "0",
                            "showAlternateHGridColor": "0",
                            "divlineThickness": "1",
                            "divLineIsDashed": "1",
                            "divLineDashLen": "1",
                            "divLineGapLen": "1",
                            "xAxisName": "Year",
                            "showValues": "0",
                            /*"labelDisplay": "rotate",
                            "slantLabels" : "45"*/
                        },
                        "categories": [
                            {
                                "category": response.label
                            }
                        ],
                        "dataset": [
                            {
                                "seriesname": "Joinee",
                                "data": response.joinee
                            }, 
                            {
                                "seriesname": "Attrition",
                                "data": response.resignation
                            }
                        ]
                    }
                }).render();
            }
        });
    }



    function get_profile_completed_per()
    {
        var can_id = '<?php echo get_login_user_id();?>';
        $.ajax({
            url: '<?php echo site_url();?>/candidate/check_per_profile_complete',
            dataType :"json",
            data :{can_id:can_id},
            type: 'POST',
            success: function(response)
            {
                console.log(response);
                var per=response;
                
                $('#profile_completed span').html(response+'%');
                // $('.pie, .c100 .bar').css(clip,'0em, '+response+', 1em, 0em');
                $(".pie, .c100 .bar").css('clip', 'rect( 0em,' + response /100+ 'em, 1em, 0em)');
            }
            });
    }

    function get_polls(){
      $.ajax({
       url: "<?= base_url(); ?>index.php/polls/vote_page_dashboard/",
       type: "post",
        //dataType: "json",
       //data: sendData,
       success: function (data) {
              $("#poll-container").html(data);
           //$("#vote-results-"+dv_id).html(data).delay(1000).fadeIn(1000);
       }
      });
      }

/*     function get_user_profile_details() {
        $.ajax({
            url: '<?php //echo site_url();?>/dashboard/user_profile_details',
            dataType :"json",
            type: 'POST',
            success: function(response)
            {
                console.log(response.salary);
                if(response.salary!=null)
                    $('#pf_no span').html(response.salary.pf_no);
                else
                    $('#pf_no span').html('Not Provided');
                if(response.bank_details.account_number!='')
                    $('#acc_no span').html(response.bank_details.account_number);
                else
                    $('#acc_no span').html('Not Provided');
                if(response.profile.aadhar_no!='')
                    $('#aadhar span').html(response.profile.aadhar_no);
                else
                    $('#aadhar span').html('Not Provided');
                if(response.profile.pan_no!='')
                    $('#pan span').html(response.profile.pan_no.toUpperCase());
                else
                    $('#pan span').html('Not Provided');
            }
        });     
}*/



function get_recent_activities()
{
    $.ajax({
        url: '<?php echo site_url();?>/dashboard/user_recent_activities',
        //dataType :"json",
        type: 'POST',
        success: function(response)
        {
             var t_data = '';
            if(response =='')
            {
               t_data = '<img class="img-responsive" src="<?php echo assets_url();?>img/no-record-found.jpg">';
            }
            else
            {
                t_data=response;
                // t_data += '<ul>';
                // $.each(response.activities, function(k_tr, v_tr) {
                    
                //    t_data +='<li class="list-group-item d-flex justify-content-between recent_list"><div class="media align-items-center"><div class="media-body lh-1"><div><span>'+v_tr.comment+' </span></div></div></div><small class="text-muted">'+test+'</small></li>';

                //      //'<div class="runnigwork row col-md-12"> <div class="col-md-12"><div class="alert alert-info" role="alert"><i class="font-icon font-icon-zigzag"></i>   <a style="text-decoration: underline;" href="<?php //echo site_url();?>/'+v_tr.controller+'/'+v_tr.method+'/'+'<?php //echo get_login_user_id();?>">  '  +v_tr.comment+'</a></div></div> </div>';                   
                // });
                // t_data+='</ul>';
            }            
            $('#user_recent_activities').html(t_data);
        }
    });
}


function get_user_birthdays()
{
    var can_id = '<?php echo get_login_user_id();?>';
    $.ajax({
        url: '<?php echo site_url();?>/dashboard/get_user_birthdays',
        dataType :"json",
        type: 'POST',
        success: function(response)
        {
            var t_data = '';
            var cnt = 0;
            var display ='none';
            if(response == null)
            {
                t_data = 'No Birthday Today';
            }
            else
            {
                var profile_pic;
                var birth_date;
                var wishes_sent=0;
                var display='block';
                var button;
                var cake = '';
                if(response['todays_birthdays']!='')
                {
                    t_data += '<p style="padding-bottom: 5px;text-transform: uppercase;border-bottom: 1px dashed #999;padding-top:12px;"><strong>Today</strong></p>';
                    $.each(response['todays_birthdays'], function(k_tr, v_tr) {
                        cnt = cnt+1;
                        if(v_tr.profile_picture != null && v_tr.is_image_exist == 1)
                        {
                          profile_pic = v_tr.profile_picture;
                          
                        }
                        else
                        {
                          profile_pic = 'no_profile_image.png';
                        }

                        if(v_tr.is_today == 1)
                        {
                          if(v_tr.wished > 0)
                          {   
                              display ='none';
                              cake = '';
                          }
                          else
                          {
                              display ='';
                              cake = 'none';
                          }
                        }
                        else
                        {
                          display ='none';
                          cake = 'none';
                        }

                    if(v_tr.can_id==can_id)
                    {
                        button =  '<div><h5 style="color:#ca1313; padding-top:12px;">Happy Birthday!</h5></div>';
                    }
                    else
                    {
                      if(v_tr.already_liked>0)
                      {
                        like_btn = '';
                        color ='#54ffff';
                      }
                      else
                      {
                        like_btn = 'like_btn';
                        color ='#fff';
                      }

                        button = '<div class="like_send"><div class="tbl-cell btn_like"><a href="javascript:;" class="'+like_btn+'" id="'+v_tr.can_id+'"><span><i class="fa fa-thumbs-up like'+v_tr.can_id+'" style="color:'+color+';font-size: 20px;margin-right: 10px;"></i></span></a><span id="cnt'+v_tr.can_id+'" style="color: #fff; font-size: 14px; font-weight: 600">'+v_tr.likes+'</span></div><div class="tbl-cell tbl-cell-status btn_wish"><a href="javascript:;" style="padding: 3px 10px;"  class="btn btn-inline btn-success" id="wish_btn-'+v_tr.can_id+'"><span class="ladda-label">Wish</span></a> <span class="btn-success" style="display:'+cake+'"><i class="fa fa-birthday-cake" aria-hidden="true"></i></span> </div></div>';
                     
                    }

                     t_data += '<article class=""><div class="user-card-row birth_col"><div style="padding-bottom:5px"><div class="tbl-cell tbl-cell-photo"><a href="#"><img src="<?php echo base_url().PROFILE_PATH;?>'+profile_pic+'" alt=""></a></div><div class="tbl-cell"><p style="display:none;" class="user_id">'+v_tr.can_id+'</p><p class="birth_name" data-tooltip="'+v_tr.email+' '+v_tr.title+'" data-placement="right" title="" style="font-size:14px;">'  +v_tr.can_name+'</p><p class="user-card-rowd-row-mail user_email" style="display:none;">'+v_tr.email+'</p></div>'+button+'</div></div><div class="tbl-cell"></div></article>';                  
                  });
                }

                t_data += '<p style="padding-bottom: 5px;text-transform: uppercase;border-bottom: 1px dashed #999;padding-top:12px;"><strong>Upcoming</strong></p>';

                /*  Upcoming birthdays in current month*/
                $.each(response['upcoming_birthdays'], function(k_tr, v_tr) {
                    cnt = cnt+1;
                    if(v_tr.profile_picture == null)
                    {
                        profile_pic = 'no_profile_image.png';
                    }
                    else
                    {
                        profile_pic = v_tr.profile_picture;
                    }

                    if(v_tr.is_today == 0)
                    {
                     
                      display ='none';
                    }

                    if(v_tr.can_id==can_id && v_tr.is_today==1)
                    {
                        button =  '<div><h5 style="color:#ca1313;">Happy Birthday!</h5></div>';
                    }
                    else
                    {
                        button = '<div class="tbl-cell tbl-cell-status btn_wish" style="display:'+display+'"><a href="javascript:;"  class="btn btn-inline btn-success ladda-button " id="wish_btn-'+v_tr.can_id+'"><span class="ladda-label">Wish</span></a> </div>';    
                    }
                     t_data += '<article class=""><div class="user-card-row"><div class="tbl-row"><div class="tbl-cell tbl-cell-photo"><img src="<?php echo base_url().PROFILE_PATH;?>'+profile_pic+'" alt=""></div><div class="tbl-cell"><p style="display:none;" class="user_id">'+v_tr.can_id+'</p><p class="" data-tooltip="'+v_tr.email+' '+v_tr.title+'" data-placement="right" title="" style="font-size:14px;cursor:default;">'  +v_tr.can_name+' <span style="color:green;float:right;">'+v_tr.date_dob+' '+v_tr.month_name+'</span></p><p class="user-card-rowd-row-mail user_email" style="display:none;">'+v_tr.email+'</p></div>'+button+'</div></div></article>';
                });
            }            
            $('#user_birthdays').html(t_data);
        }
    });
}

/*function get_performace_report_highcharts()
{
    $.ajax({
    url: '<?php //echo site_url();?>/dashboard/get_performace_report_highcharts',
     dataType :"json",
     type: 'POST',
    success: function(response)
    {
            //alert(response);
            var sampleData =response;


            // prepare jqxChart settings
            var settings = {
                 title: "Year",
                // description: "Time spent in vigorous exercise by activity",
                
                description: false,
                enableAnimations: true,
                showLegend: true,
                padding: { left: 5, top: 5, right: 5, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: sampleData,
                xAxis:
                    {
                        dataField: 'Day',
                        unitInterval: 1,
                        axisSize: 'auto',
                        tickMarks: {
                            visible: false,
                            interval: 1,
                            color: '#BCBCBC'
                        },
                        gridLines: {
                            visible: false,
                            interval: 1,
                            color: '#BCBCBC'
                        },
                        labels:
                        {
                            horizontalAlignment: 'right',
                            verticalAlignment: 'center',
                            rotationPoint: 'lefttop',
                            autoRotate: true,
                        }
                    },
                valueAxis:
                {
                    flip: true, 
                    unitInterval: 1,
                    minValue: 0,
                    maxValue: 10,
                    title: { text: 'Time in minutes' },
                    // labels: { visible: true, horizontalAlignment: 'right', autoRotate: true},
                    // labels: { horizontalAlignment: 'right' },
                    // labels: {rotationPoin:'left', autoRotate : true},
                    tickMarks: { color: '#BCBCBC' },
                },
                colorScheme: 'scheme06',
                seriesGroups:
                    [
                        {
                            type: 'stackedcolumn',
                            columnsGapPercent: 50,
                            seriesGapPercent: 0,
                            series: [
                                    { dataField: 'user rating average', displayText: 'Self Rating Average' },
                                    { dataField: 'manager rating average', displayText: 'Manager Rating Average'}
                                ]
                        }
                    ]
            };

            // setup the chart
            $('#chartContainer').jqxChart(settings);
        }
    });
}*/

function get_performace_report_highcharts()
{
    $.ajax({
    url: '<?php echo site_url();?>/dashboard/get_performace_report_highcharts_new',
     dataType :"json",
     type: 'POST',
    success: function(response)
    {
           console.log(response);
        FusionCharts.ready(function () {
            var performChart = new FusionCharts({
              type: 'stackedcolumn2d',
              renderAt: 'perform_chart',
              width: '100%',
              height: '100%',
              dataFormat: 'json',
              dataSource: {
                  "chart": {
                      /*"caption": "Revenue split by product category",
                      "subCaption": "For current year",*/
                      // "xAxisname": "Months",
                      "palettecolors": "#034358,#0E7082,#EED17F,#97CBE7,#083848,#166270,#2C560A,#DD9D82",
                      "bgColor": "#ffffff",
                      "useRoundEdges": "1",
                      "valueFontColor": "#ffffff",
                      // "stack100Percent": "1",
                      "decimals": "1",
                      "showPercentInTooltip": "1",
                      "showValues": "1",
                      "showPercentValues": "0",
                      "yAxisName": "Performance",
                      "theme": "fint"
                  },
                  "categories": [response.categories],
                  "dataset": response.dataset,
              }
          });

            performChart.render();
        });
        }
    });
}

  function get_rpo_user_profile_details() {
    $.ajax({
        url: '<?php echo site_url();?>/dashboard/get_rpo_user_profile_details',
        dataType :"json",
        type: 'POST',
        success: function(response)
        {
            /*if(response.salary!=null)
                $('#pf_no span').html(response.salary.pf_no);
            else
                $('#pf_no span').html('Not Provided');*/
            if(response.trim!= '' && response!= null)
            {
              if(response.account_number.trim() !='')
                  $('#acc_no span').html(response.account_number);
              else
                  $('#acc_no span').html('Not Provided');
              if(response.aadhar_no.trim()!='')
                  $('#aadhar span').html(response.aadhar_no);
              else
                  $('#aadhar span').html('Not Provided');
              if(response.pan_no.trim()!='')
                  $('#pan span').html(response.pan_no.toUpperCase());
              else
                  $('#pan span').html('Not Provided');
            }
            else
            {
              $('#acc_no span').html('Not Provided');
              $('#aadhar span').html('Not Provided');
              $('#pan span').html('Not Provided');
            }
        }
    });     
}


$(document).on('click', '.btn_wish', function(){ 
    var email = $(this).parent().siblings().find(".user_email") .html();
    var name = $(this).parent().siblings().find(".birth_name") .html();
    var user_id = $(this).parent().siblings().find(".user_id") .html();
    $('#birthday_wishesh #can_id').val(user_id);
    $('#birthday_wishesh #name').val(name);
    $('#birthday_wishesh #email').val(email);
    $('#birthday_wishesh #message').html('');
    $('#birthdaywishModal').modal('show');
});


$('#mobile_no').on('blur', function(){
    var mob = $('#mobile_no').val();
    var ph = $('#phone_no').val();
    if((mob < 1000000000) || (mob > 9999999999) || (mob == ''))
    {
        $('#phone1_err').text("Please Enter Valid Mobile Number.").show().delay(2000).fadeOut(800);
        $('#submit_leave_appli').attr('disabled', true);
    }
    else if(mob === ph)
    {
        $('#phone1_err').text("Mobile & Alternate no. cannot be same.").show().delay(2000).fadeOut(800);
        $('#phone2_err').text("Mobile & Alternate no. cannot be same.").show().delay(2000).fadeOut(800);
        $('#submit_leave_appli').attr('disabled', true);
    }
    else
    {
        $('#submit_leave_appli').removeAttr('disabled');   
    }
});

$('#phone_no').on('blur', function(){
    var mob = $('#mobile_no').val();
    var ph = $('#phone_no').val();
    if(ph != '')
    {
        if((ph < 1000000000) || (ph > 9999999999))
        {
            $('#phone2_err').text("Please Enter Valid Mobile Number").show().delay(2000).fadeOut(800);
            $('#submit_leave_appli').attr('disabled', true);
        }
        else if(mob == ph)
        {
            $('#phone1_err').text("Mobile & Alternate no. cannot be same.").show().delay(2000).fadeOut(800);
            $('#phone2_err').text("Mobile & Alternate no. cannot be same.").show().delay(2000).fadeOut(800);
            $('#submit_leave_appli').attr('disabled', true);
        }
        else
        {
            $('#submit_leave_appli').removeAttr('disabled');
        }
    }
    else
    {
        $('#submit_leave_appli').removeAttr('disabled');
    }
});
</script>

<script type="text/javascript">
   $(document).ready(function(menuSlide){
      $('hover-[data-toggle="tooltip"]').tooltip({
         delay: {show: 0, hide: 2000,placement : 'top'}
      });

      $('hover-[data-toggle="tool_tip"]').tooltip({
         delay: {show: 0, hide: 2000,placement : 'top'}
      });

      $('[data-toggle="tool_tip"]').click(function(){
         $('[data-toggle="tool_tip"]').tooltip('hide');
      });
   });
</script>

<script language = "JavaScript">
   $(document).ready(function(){
    var is_rpo = '<?php echo $_SESSION['is_rpo_can'];?>';
    if(!is_rpo)
    {
      var login_status='<?php echo $_SESSION['login_status'] ?>';
      console.log("login_status="+login_status);
      if(login_status==0){
        $('#changepass').modal({
          backdrop: 'static',
          keyboard: false, 
          show: true
        });
      }  
    }

     

    $('#current_pass').blur(function (event) {
        if(($('#current_pass').val().trim()==''))
        {
          $('#err_curr_pass').addClass('warning-msg').html('Please enter your current password').show();
          event.preventDefault();
        }
        else
        {
          var email_id ='<?php echo $_SESSION['email']?>';
          var current_pass = $('#current_pass').val().trim();
         $.ajax({
                  type:'post',
                  data:{'current_pass':current_pass,'email_id':email_id},
                  dataType: "json",
                  url:'<?php echo site_url();?>/profile/check_password',
                  success:function(response){                  
                    if(response==0)
                    {
                      $('#err_curr_pass').addClass('warning-msg').html('You have entered wrong current password').show();
                      $('#change_pass_btn').attr('disabled', true);
                    }
                    else
                    {
                      $('#err_curr_pass').html('').hide();
                      $('#change_pass_btn').removeAttr('disabled');
                    }
                }               
            });
        } 
      });
    $('#change_pass_btn').click(function(event){
      isValid=1;

      var current_pass = $('#current_pass').val().trim();
      var new_pass = $('#new_password').val().trim();
      var confirm_pass = $('#confirm_password').val().trim();
      if(current_pass=='')
      {
        $('#err_curr_pass').html('Enter current password').show();
        event.preventDefault();
      }
      else if(new_pass=='')
      {
        $('#err_newpass').html('Enter new password').show();
      }
      else if(confirm_pass=='')
      {
        $('#err_confirmpass').html('Enter confirm password').show();
      }
      else if(new_pass!=confirm_pass)
      {
        $('#err_confirmpass').html('Confirm password does not match with new password').show();
      }
      else
      {   
        $('#err_oldpass').html('').hide();
        $('#err_newpass').html('').hide();
        $('#err_confirmpass').html('').hide();
        $('#change_pass_btn').attr('disabled',true);
        $.ajax({
          url: '<?php echo site_url();?>/profile/change_password',
          data : {confirm_pass: confirm_pass},
          type: 'POST',
          success: function(response){
            response = JSON.parse(response);
            console.log(response);
            console.log('<?php echo site_url();?>');

           if(response == true){
            window.location.href='<?php echo site_url();?>/login/logout';
           }
          }
        });
      }
    });
      get_dept_emp_count_highchart();
      get_performace_report_highcharts();
      var first_login = '<?php echo $_SESSION['first_login'] ?>';        
      if(first_login=='1'){
         get_interview();
      }
        
      function get_interview()
      {
         $.ajax({
            url:'<?php echo site_url(); ?>/dashboard/get_interview',
            dataType:'JSON',
            success:function(output){                  
               $row='';
               if(output==null){
                console.log("interview_notice="+output);
               }
               else
               {
                  $.each(output,function(index,arrvalue)
                  {
   	     //        $('#interview_notice ').modal('show');
                     $row='<tr><td>'+arrvalue.full_name+'</td><td>'+arrvalue.email_id+'</td><td>'+arrvalue.mobile_no+'</td></tr>';
                     $("#interview_table").append($row);
                  });
               }
            }
         });
      }
   });

   $('#submit_birthday_wish').on('click', function() {
    if($('#birthday_wishesh #message').val().trim() == '')
    {
      $('#bd_mess').text("Please Enter Message.").show().delay(2000).fadeOut(800);
      $('#submit_birthday_wish').removeAttr('disabled');
    }
    else
    {
      $('#birthdaywishModal').append('<div id="loaderDiv" class="" style="display: block; position: relative;  margin: 0 auto; align:center;  z-index:100;"><img style="margin: 0 auto; margin-top: 0px; position: relative; align-items: center; display: block; margin-top: -50px;" src="<?php echo assets_url();?>img/loader.gif"></div>');
      $('#loaderDiv').fadeIn('fast');
      var bd_data = $('#birthday_wishesh').serialize();
      $('#submit_birthday_wish').attr('disabled',true);
      $.ajax({
        url: '<?php echo site_url();?>/candidate/birthday_wishes',
        dataType :"json",
        async:false,
        data : bd_data,
        type: 'POST',
        success: function(response)
        {
          $('#birthday_wishesh #message').html('');
          $('#birthdaywishModal').modal('hide');
          $("#loaderDiv").fadeOut('slow');
          if(response.res == true)
          {
            $('#user_birthdays #wish_btn-'+response.can_id).attr('hidden', true);
            swal("Done!", "Birthday wishes by Email has been sent successfully !", "success");
          }
          else
          {
            swal("Opps", "something went wrong...", "error");
          }
        }
      });
    }
   
   });

  $(document).on('click', '.like_btn', function(){ 
    $(this).removeClass('like_btn');
    var can_id = $(this).attr('id');
    $.ajax({
        url: '<?php echo site_url();?>/candidate/like',
        async:false,
        data : {can_id:can_id},
        type: 'POST',
        success: function(response)
        {
          $('.like'+can_id).css('color','#009688');
          $('#cnt'+can_id).html(response);
        }
      });
   });

  function get_emp_cnt()
  {
        $.ajax({
            url:'<?php echo site_url();?>/dashboard/get_emp_cnt',
            dataType:"json",
            type:'POST',
            success:function(response){
            if(response != '' && response != null)
            {
              $('#emp_cnt').html(response);
            }
            else
            {
              $('#emp_cnt').html(0);
            }
          }
        });
    }
</script>