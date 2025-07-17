<div class="page-content">
    <div class="container-fluid">
        
    <div class="col-sm-12 well">
         <div class="row">
            <form data-toggle="validator" class="col-sm-12" id="add_travel" action=" " method="post" data-toggle="validator">
                <h1 class="well headline">Add Travel Form</h1>
                    <div class="col-sm-12 col-xs-12 profile_bg">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Employee Name <span>*</span></label>
                                </div>
                            </div>
                        
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <input class="form-control" placeholder="Enter Candidate Name" type="text" value="<?php echo @$can_details->can_name; ?>" oninvalid="this.setCustomValidity('Please Enter valid Name.')" oninput="setCustomValidity('')" disabled>
                                        <i class="fa fa-user"></i>
                                        <input type="hidden" id="can_id" name="can_id" value="<?php echo @$travel_details->can_id; ?>">
                                        <input type="hidden" id="tv_id" name="tv_id" value="<?php echo @$travel_details->tv_id; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Travel Purpose <span>*</span></label>
                                </div>
                            </div>
                        
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <input class="form-control" placeholder="Enter Travel Purpose" type="text" id="purpose" name="purpose" required oninvalid="this.setCustomValidity('Please Enter Travel Purpose')" oninput="setCustomValidity('')" data-error="Please Enter Travel Purpose" value="<?php echo @$travel_details->purpose; ?>" maxlength="30">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Travel To <span>*</span></label>
                                </div>
                            </div>
                        
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <input class="form-control" placeholder="Enter Travel Location" type="text" id="location" name="location" required oninvalid="this.setCustomValidity('Please Enter Travel Location')" oninput="setCustomValidity('')" value="<?php echo @$travel_details->location; ?>" maxlength="30">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Travel from Date </label>
                                </div>
                            </div>
                
                            <div class="col-lg-4">
                                <div class="date form-group">
                                    <div class="input-group input-append date" id="datePicker"  data-date-start-date="0d">
                                        <input type="text" class="form-control" id="from_date" name="from_date" placeholder="DD/MM/YYYY"  oninvalid="this.setCustomValidity('Please Enter From Date')" value="<?php echo !empty(@$travel_details->from_date) ? db_to_date(@$travel_details->from_date) : db_to_date(date('Y-m-d')); ?>" data-date-start-date="0d" />
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <div class="help-block with-errors error_msg" id ="fr_dt"></div>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Travel to Date </label>
                                </div>
                            </div>
                
                            <div class="col-lg-4">
                                <div class="date form-group">
                                    <div class="input-group input-append date" id="datePicker1" data-date-start-date="0d" >
                                        <input type="text" class="form-control" id="to_date" name="to_date" placeholder="DD/MM/YYYY"  oninvalid="this.setCustomValidity('Please Enter To Date')" value="<?php echo !empty(@$travel_details->to_date) ? db_to_date(@$travel_details->to_date) : db_to_date(date('Y-m-d')); ?>" data-date-start-date="0d" />
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <div class="help-block with-errors error_msg" id ="to_dt"></div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Stay </label>
                                </div>
                            </div>
                        
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <label class="form-label" ><input type="radio" name="stay_radio" id="stay_y" value="Y" <?php echo (@$travel_details->stays > 0) ? 'checked' : ''; ?>>Yes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <label class="form-label"><input type="radio" name="stay_radio" id="stay_n" value="N" <?php echo (@$travel_details->stays > 0) ? '' : 'checked'; ?>>No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">No. of Stays </label>
                                </div>
                            </div>
                
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <input class="form-control number" placeholder="Enter No. of Stays" type="text" id="stays" name="stays" oninvalid="this.setCustomValidity('Please Enter No. of travel Stays')" oninput="setCustomValidity('')" value="<?php echo (@$travel_details->stays > 0) ? @$travel_details->stays : 0; ?>" <?php echo (@$travel_details->stays > 0) ? '' : 'readonly'; ?>>
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Meals </label>
                                </div>
                            </div>
                        
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <label class="form-label" ><input type="radio" name="meal_radio" id="meal_y" value="Y" <?php echo (@$travel_details->meals > 0) ? 'checked' : ''; ?>>Yes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <label class="form-label"><input type="radio" name="meal_radio" id="meal_n" value="N" <?php echo (@$travel_details->meals > 0) ? '' : 'checked'; ?> >No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">No. of Meals</label>
                                </div>
                            </div>
                
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <input class="form-control number" placeholder="Enter No. of meals " type="text" id="meals" name="meals" oninvalid="this.setCustomValidity('Please Enter No. of travel days')" oninput="setCustomValidity('')" value="<?php echo (@$travel_details->meals > 0) ? @$travel_details->meals : 0; ?>" <?php echo (@$travel_details->meals > 0) ? '' : 'readonly'; ?>>
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Snacks </label>
                                </div>
                            </div>
                        
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <label class="form-label"><input type="radio" name="snack_radio" id="snack_y" value="Y" <?php echo (@$travel_details->snacks > 0) ? 'checked' : ''; ?> >Yes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <label class="form-label"><input type="radio" name="snack_radio" id="snack_n" value="N" <?php echo (@$travel_details->snacks > 0) ? '' : 'checked'; ?> >No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">No. of Snacks</label>
                                </div>
                            </div>
                
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <input class="form-control number" placeholder="Enter No. of Snacks" type="text" id="snacks" name="snacks" oninvalid="this.setCustomValidity('Please Enter No. of travel Snacks')" oninput="setCustomValidity('')"  value="<?php echo (@$travel_details->snacks > 0) ? @$travel_details->snacks : 0; ?>" <?php echo (@$travel_details->snacks > 0) ? '' : 'readonly'; ?>>
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Budget <span>*</span></label>
                                </div>
                            </div>
                        
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <input type="text" min="1" id="budget" name="budget" placeholder="Enter Budget" required class="form-control number" value="<?php echo @$travel_details->budget; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Advance </label>
                                </div>
                            </div>
                        
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <input type="text" min="0" id="advance" name="advance" placeholder="Enter Advance" class="form-control number"  value="<?php echo @$travel_details->advance; ?>">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Mode of Transport <span>*</span></label>
                                </div>
                            </div>
                        
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <select id="transport_mode" name="transport_mode" class="web col-lg-12 form-control" onChange="get_mode()" required>
                                            <optgroup label="Transport">
                                              <option value="Road" <?php echo (@$travel_details->transport_mode == 'Road') ? 'selected' : ''; ?>>By road</option>
                                              <option value="Air" <?php echo (@$travel_details->transport_mode == 'Air') ? 'selected' : ''; ?>>By Air</option>
                                              <option value="Train" <?php echo (@$travel_details->transport_mode == 'Train') ? 'selected' : ''; ?>>By Train</option>
                                              <option value="Own Car" <?php echo (@$travel_details->transport_mode == 'Own Car') ? 'selected' : ''; ?>>Personal Car</option>
                                              <option value="Own Bike" <?php echo (@$travel_details->transport_mode == 'Own Bike') ? 'selected' : ''; ?>>Personal Bike</option>
                                              <option value="Other" <?php echo (@strpos($travel_details->transport_mode, 'Other') !== FALSE) ? 'selected' : ''; ?>>Other</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 <?php echo (!empty($travel_details->other_transport)) ? '' : 'hidden'; ?>" id="other_lbl">
                                <div class="form-group">
                                    <label class="form-label">Other Details : </label>
                                </div>
                            </div>
                    
                            <div class="col-lg-4 <?php echo (!empty($travel_details->other_transport)) ? '' : 'hidden'; ?>" id="other_data">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <input type="text" placeholder="Enter Other Mode" id="other_mode" name="other_transport" class="form-control" value="<?php echo @$travel_details->other_transport; ?>" maxlength="30">
                                    </div>
                                </div>
                            </div>
                        </div>
                                    
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Details : </label>
                                </div>
                            </div>
                    
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <textarea class="form-control col-md-12" rows="3" name="details" maxlength="1000"><?php echo @$travel_details->details; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if(!empty(@$travel_details) && (@$travel_details->status != 'raised')) { ?>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label">Remarks : </label>
                                    </div>
                                </div>
                        
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <div class="form-control-wrapper form-control-icon-right">
                                            <textarea class="form-control col-md-12" rows="3" disabled maxlength="1000"> <?php echo @$travel_details->remark; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if(!empty(@$travel_details) && (@$travel_details->status == 'cleared')) { ?>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label">Cleareance Remarks : </label>
                                    </div>
                                </div>
                        
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <div class="form-control-wrapper form-control-icon-right">
                                            <textarea class="form-control col-md-12" rows="3" disabled maxlength="1000"> <?php echo @$travel_details->clearance_remark; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="row">
                            <div class="col-lg-6">
                                <?php if(empty(@$travel_details) || (@$travel_details->status == 'raised') || (@$travel_details->status == 'rejected')) { ?>
                                    <button type="submit" class="btn btn-inline btn-success ladda-button" data-style="expand-left" id="submit_travel"><span class="ladda-label">Submit</span>
                                    <span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
                                
                                    <button type="button" id="reset_form" class="btn btn-inline ladda-button" data-style="expand-left"><span class="ladda-label">Reset</span>
                                    <span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
                                <?php } //elseif(@$travel_details->status == 'approved') { ?>
                                    <!-- <button type="button" class="btn btn-inline btn-warning ladda-button" data-style="expand-left" id="claim_travel"><span class="ladda-label">Claim</span>
                                    <span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button> -->
                                <?php// } else { ?>
                                    <!-- <button type="button"  class="btn btn-inline btn-danger ladda-button" data-style="expand-left" id="clear_travel"><span class="ladda-label">Clear</span>
                                    <span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button> -->
                                <?php// } ?>
                            </div>
                            
                        </div>

                    </div>
            </form> 
        </div>
    </div>
</div>
</div>
<script>
$(document).ready(function() {
    // var date1 = $('#from_date').val();
    $('#datePicker, #datePicker1').datepicker({
        format: 'dd/mm/yyyy',
	 minDate: new Date()
    });
    $('#datePicker').on('changeDate', function(e) {
       	$('#datePicker1').datepicker('setStartDate', $('#from_date').val());

	var start = $(this).datepicker('getDate');
        var end = $('#datePicker1').datepicker('getDate');
        var days = (end - start) / (1000 * 60 * 60 * 24);
        if(days < 0)
        {
            /*$.notify({
                title: "<strong>Warning</strong>",
                message: "Please Select Correct Date",
                
            },
            {
                type: 'warning',
                delay: 800,
                animate:{
                    enter: "animated fadeInUp",
                    exit: "animated fadeOutDown"
                } 
             }); */
            $('#to_date').val('');
            $('#to_dt').text("From date cannot be greater than To date").show().delay(2000).fadeOut(800);
            $('#stays').attr('readonly',true);
            $('#stays').val(0);
            $('#stays').removeAttr('min');
            // $('#stay_n').attr('checked', 'checked');
            $("#stay_n").prop("checked", true);
            //$('#stay_y').removeAttr('checked');
            $('#meals').attr('readonly',true);
            $('#meals').val(0);
            $('#meals').removeAttr('min');
            // $('#meal_n').attr('checked', 'checked');
            $('#meal_n').prop("checked", true);
            // $('#meal_y').removeAttr('checked');
            $('#snacks').attr('readonly',true);
            $('#snacks').val(0);
            $('#snacks').removeAttr('min');
            $('#snack_n').prop("checked", true);
        }
        else if(days > 0)
        {
            var stays = days;
            var meals = days*2;
            var snacks = days*2;
            $('#stays').removeAttr('readonly');
            $('#stays').val(stays);
            $('#stays').attr('min',1);
            $('#stay_y').prop("checked", true);
            // $('#stay_y').attr('checked', 'checked');
            // $('#stay_n').removeAttr('checked');
            $('#meals').removeAttr('readonly');
            $('#meals').val(meals);
            $('#meals').attr('min',1);
            $('#meal_y').prop("checked", true);
            // $('#meal_y').attr('checked', 'checked');
            // $('#meal_n').removeAttr('checked');
            $('#snacks').removeAttr('readonly');
            $('#snacks').val(snacks);
            $('#snacks').attr('min',1);
            $('#snack_y').prop("checked", true);
            // $('#snack_y').attr('checked', 'checked');
            // $('#snack_n').removeAttr('checked');
        }
        else
        {
            $('#stays').attr('readonly',true);
            $('#stays').val(0);
            $('#stays').removeAttr('min');
            // $('#stay_n').attr('checked', 'checked');
            $("#stay_n").prop("checked", true);
            //$('#stay_y').removeAttr('checked');
            $('#meals').attr('readonly',true);
            $('#meals').val(0);
            $('#meals').removeAttr('min');
            // $('#meal_n').attr('checked', 'checked');
            $('#meal_n').prop("checked", true);
            // $('#meal_y').removeAttr('checked');
            $('#snacks').attr('readonly',true);
            $('#snacks').val(0);
            $('#snacks').removeAttr('min');
            $('#snack_n').prop("checked", true);
            // $('#snack_n').attr('checked', 'checked');
            // $('#snack_y').removeAttr('checked');
        }
    });

    $('#datePicker1').on('changeDate', function(e) {
       $('#datePicker').datepicker('setEndDate', $('#to_date').val());
	
	 var start = $('#datePicker').datepicker('getDate');
        var end = $(this).datepicker('getDate');
        var days = (end - start) / (1000 * 60 * 60 * 24);
        if(days < 0)
        {
            $('#to_date').val('');
            $('#to_dt').text("From date cannot be greater than To date").show().delay(2000).fadeOut(800);
            $('#stays').attr('readonly',true);
            $('#stays').val(0);
            $('#stays').removeAttr('min');
            // $('#stay_n').attr('checked', 'checked');
            $("#stay_n").prop("checked", true);
            //$('#stay_y').removeAttr('checked');
            $('#meals').attr('readonly',true);
            $('#meals').val(0);
            $('#meals').removeAttr('min');
            // $('#meal_n').attr('checked', 'checked');
            $('#meal_n').prop("checked", true);
            // $('#meal_y').removeAttr('checked');
            $('#snacks').attr('readonly',true);
            $('#snacks').val(0);
            $('#snacks').removeAttr('min');
            $('#snack_n').prop("checked", true);
        }
        else if(days > 0)
        {
            var stays = days;
            var meals = days*2;
            var snacks = days*2;
            $('#stays').removeAttr('readonly');
            $('#stays').val(stays);
            $('#stays').attr('min',1);
            $('#stay_y').prop("checked", true);
            // $('#stay_y').attr('checked', 'checked');
            // $('#stay_n').removeAttr('checked');
            $('#meals').removeAttr('readonly');
            $('#meals').val(meals);
            $('#meals').attr('min',1);
            $('#meal_y').prop("checked", true);
            // $('#meal_y').attr('checked', 'checked');
            // $('#meal_n').removeAttr('checked');
            $('#snacks').removeAttr('readonly');
            $('#snacks').val(snacks);
            $('#snacks').attr('min',1);
            $('#snack_y').prop("checked", true);
            // $('#snack_y').attr('checked', 'checked');
            // $('#snack_n').removeAttr('checked');
        }
        else
        {
            $('#stays').attr('readonly',true);
            $('#stays').val(0);
            $('#stays').removeAttr('min');
            // $('#stay_n').attr('checked', 'checked');
            $("#stay_n").prop("checked", true);
            //$('#stay_y').removeAttr('checked');
            $('#meals').attr('readonly',true);
            $('#meals').val(0);
            $('#meals').removeAttr('min');
            // $('#meal_n').attr('checked', 'checked');
            $('#meal_n').prop("checked", true);
            // $('#meal_y').removeAttr('checked');
            $('#snacks').attr('readonly',true);
            $('#snacks').val(0);
            $('#snacks').removeAttr('min');
            $('#snack_n').prop("checked", true);
            // $('#snack_n').attr('checked', 'checked');
            // $('#snack_y').removeAttr('checked');
        }
    });

        $('#add_travel')
        .bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                /*valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'*/
            },
            fields: {
                purpose: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Travel Purpose'
                        }
                    }
                },
                location: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Travel Location'
                        }
                    }
                },
                /*from_date: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Travel from Date'
                        },
                        lessThan: {
                            value: 'to_date',
                            inclusive: true,
                            message: 'The From Date has to be less than To Date'
                        }
                    }
                },
                to_date: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Travel to Date'
                        },
                        greaterThan: {
                            value: 'from_date',
                            inclusive: true,
                            message: 'The To date has to be greater than From Date'
                        }
                    }
                },*/
                budget: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Budget'
                        },
                        greaterThan: {
                            value: 'advance',
                            inclusive: true,
                            message: 'Budget has to be greater than advance'
                        }
                    }
                },
                advance: {
                    validators: {
                        lessThan: {
                            value: 'budget',
                            inclusive: true,
                            message: 'Advance has to be less than budget'
                        }
                    }
                },
                stay_radio: {
                    validators: {
                        notEmpty: {
                            message: 'Stay is required and can\'t be empty'
                        }
                    }
                },
                meal_radio: {
                    validators: {
                        notEmpty: {
                            message: 'Meal is required and can\'t be empty'
                        }
                    }
                },
                snack_radio: {
                    validators: {
                        notEmpty: {
                            message: 'Snack is required and can\'t be empty'
                        }
                    }
                }
            }
        })
        .on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
            // Use Ajax to submit form data
            if($('#from_date').val() == '')
            {
                $('#fr_dt').text(" Please Enter From Date").show().delay(2000).fadeOut(800);
                $('#submit_travel').removeAttr('disabled');
            }
            else if($('#to_date').val() == '')
            {
                $('#to_dt').text(" Please Enter To Date").show().delay(2000).fadeOut(800);
                $('#submit_travel').removeAttr('disabled');
            }
            else if(($('#to_date').val() == '') && ($('#from_date').val() == ''))
            {
                $('#fr_dt').text(" Please Enter From Date").show().delay(2000).fadeOut(800);
                $('#to_dt').text(" Please Enter To Date").show().delay(2000).fadeOut(800);
                $('#submit_travel').removeAttr('disabled');
            }
            else
            {
                var fdata = $('#add_travel').serialize();
                $('#submit_travel').attr('disabled',true);
                $.ajax({
                    url: '<?php echo site_url();?>/travel_management/add_travel_details',
                    dataType :"json",
                    async:false,
                    data : fdata,
                    type: 'POST',
                    success: function(response)
                    {
                        if((response.result == false) || (response.result == 0))
                        {
                            $.notify({
                                title: "<strong>OOPs:</strong> ",
                                message: response.msg,
                                
                            },{
                            type: 'danger',
                            delay: 800,
                                animate:{
                                    enter: "animated fadeInUp",
                                    exit: "animated fadeOutDown"
                                }
                        });
                        $('#submit_travel').removeAttr('disabled');
                    }
                    else
                    {
                        $.notify({
                                title: "<strong>Success:</strong> ",
                                message: "Travel Details Saved Successfully",        
                            },{
                            type: 'success',
                            delay: 800,
                                animate:{
                                    enter: "animated fadeInUp",
                                    exit: "animated fadeOutDown"
                                } 
                        });
                        window.setTimeout(function(){
                            window.location.href = '<?php echo site_url("travel_management/my_travel_schedule_list"); ?>';
                        },1000);
                    }
                }
            });
            }
        });
});

$('#budget').keyup(function(){
    $('#advance').attr('max',$(this).val());
});

$('input[name="stay_radio"]').on('click', function() {
    var stay = $(this).val();
    if(stay == 'Y')
    {
        $('#stays').removeAttr('readonly');
        $('#stays').attr('min',1);
        $('#stays').attr('required',true);
    }
    else
    {
        $('#stays').attr('readonly',true);
        $('#stays').removeAttr('min');
        $('#stays').val(0);
        $('#stays').removeAttr('required');
    }
});

$('input[name="meal_radio"]').on('click', function() {
    var stay = $(this).val();
    if(stay == 'Y')
    {
        $('#meals').removeAttr('readonly');
        $('#meals').attr('min',1);
        $('#meals').attr('required',true);
    }
    else
    {
        $('#meals').attr('readonly',true);
        $('#meals').removeAttr('min');
        $('#meals').val(0);
        $('#meals').removeAttr('required');
    }
});

$('input[name="snack_radio"]').on('click', function() {
    var stay = $(this).val();
    if(stay == 'Y')
    {
        $('#snacks').removeAttr('readonly');
        $('#snacks').attr('min',1);
        $('#snacks').attr('required',true);
    }
    else
    {
        $('#snacks').attr('readonly',true);
        $('#snacks').removeAttr('min');
        $('#snacks').val(0);
        $('#snacks').removeAttr('required');
    }
});

$('#reset_form').on('click', function() {
    document.getElementById("add_travel").reset();
});

function get_mode()
{
    var mode = $('#transport_mode').val();
    if(mode == 'Other')
    {
        $('#other_data').removeClass('hidden');
        $('#other_lbl').removeClass('hidden');
        $('#other_mode').attr('required',true);
    }
    else
    {
        $('#other_data').addClass('hidden');
        $('#other_lbl').addClass('hidden');
        $('#other_mode').removeAttr('required');
    }
}
</script>
