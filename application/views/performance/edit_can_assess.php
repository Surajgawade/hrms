<div class="page-content">
    <div class="container-fluid">   
        <div class="col-sm-12 well">
            <div class="row">
            <?php $i = 0; ?>
                <form data-toggle="validator" class="col-sm-12" id="employee_assesment" action=" " method="post">
                    <h1 class="well headline">Employee Assesment</h1>
                    <div class="col-sm-12 col-xs-12 profile_bg">
                        <div class="row">
                            <div class="col-lg-2 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Employee Name <span>*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-9 col-xs-12">
                                <div class="form-group">
                                    <input type="hidden" name="list_id" value="<?php echo @$performance_details['can_list']['list_id']; ?>">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <?php if(!empty(@$performance_details['can_list']['can_id']) && (@$performance_details['can_list']['can_id'] != NULL)) { ?>
                                            <input class="form-control" placeholder="Candidate Name" type="text" name="" id="can_name" value="<?php echo @$performance_details['can_list']['can_name']; ?>" readonly>
                                            <input type="hidden" name="can_id" value="<?php echo @$performance_details['can_list']['can_id']; ?>">
                                        <?php } else { ?>
                                            <select class="chosen-select col-md-10 col-sm-12 col-xs-12" name="can_id" id="can_name" style="width: 100px" required data-error="Please Select Employee Name">
                                            <option value="" disabled selected hidden>Select Employee Name</option>
                                            <?php  foreach ($candidates as $key => $candidate) { if($candidate->can_id!=get_login_user_id()){?>
                                                <option value="<?php echo @$candidate->can_id?>" <?php echo (@$candidate->can_id == @$performance_details['can_list']['can_id']) ? 'selected' : ''; ?>><?php echo $candidate->can_name?></option>
                                            <?php } }?>
                                            </select>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Designation <span>*</span></label>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-9 col-xs-12">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <input class="form-control" placeholder="Designation" type="text" name="" id="emp_designation" value="<?php echo @$performance_details['can_list']['role_name']; ?>" readonly>
                                        <input type="hidden" name="role_id" id="role_id" value="<?php echo @$performance_details['can_list']['role_id']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Date <span>*</span></label>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="date form-group">
                                    <div class="input-group input-append date" id="datePicker">
                                        <input type="text" class="form-control" id="date" name="date" placeholder="DD/MM/YYYY"  oninvalid="this.setCustomValidity('Please Enter From Date')" value="<?php echo !empty(@$performance_details['can_list']['date']) ? db_to_date(@$performance_details['can_list']['date']) : db_to_date(date('Y-m-d')); ?>" />
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="month-head">
                            <h6>Assesment Details</h6>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <section class="card">
                                    <div class="card-block">
                                        <table id="month_sal" class="display table table-bordered table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="width:30%">Criteria</th>
                                                    <th style="width:30%">Actual</th>
                                                    <th style="width:30%">Achieved</th>
                                                </tr>
                                            </thead>

                                        <tbody id="perform_data">
                                        <?php if(!empty(@$performance_details['assesment']) && (@$performance_details['assesment'] != NULL)) {
                                        foreach ($performance_details['assesment'] as $key => $value) { 
                                        $i++; ?>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label class="form-label"><?php echo $value['criteria_name']; ?><span>*</span></label>
                                                    <input type="hidden" name="id-<?php echo $value['criteria_id']; ?>" value="<?php echo $value['id']; ?>">

                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="form-control-wrapper form-control-icon-right">
                                                        <input class="form-control" placeholder="" type="text" name="max_value-<?php echo $value['criteria_id']; ?>" id="" value="<?php echo $value['max_value']; ?>" readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="form-control-wrapper form-control-icon-right">
                                                        <input class="form-control number val_min" placeholder="" type="text" name="assess_value-<?php echo $value['criteria_id']; ?>" required min="0" value="<?php echo $value['assess_value']; ?>" max="<?php echo $value['max_value']; ?>">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } } else { ?>
                                        <tr><td colspan="3" class="text-center h3"><stong>Please select Employee for Assesment.</stong></td></tr>
                                        <?php } ?>
                                        </tbody>
                                        <input type="hidden" id="max_id" value="<?php echo $i; ?>">
                                        <input type="hidden" id="act_tot" value="0">
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <button class="btn btn-inline btn-success ladda-button" data-style="expand-left" id="save_details" disabled><span class="ladda-label">Submit</span>
                                <span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>

                                <button type="button" id="reset_form" class="btn btn-inline ladda-button" data-style="expand-left"><span class="ladda-label">Reset</span>
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
$(document).ready(function() {
    $('#datePicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose : true
    });
    $(".chosen-select").chosen();
    var max = $('#max_id').val();
    if(max > 0)
    {
        $('#save_details').removeAttr('disabled');
    }
});

$('#can_name').change(function(){
    var can_id = $("#can_name").chosen().val();
    $.ajax({
        url:  '<?php echo site_url();?>/performance_and_incentives/get_can_role_details',
        dataType: "json", 
        data: {can_id:can_id},
        type:'POST',
        async: false,
        success: function(response){
            $('#emp_designation').val(response.role);
            $('#role_id').val(response.role_id);
            var data = '';
            var i = 0;
            var act_tot = 0;
            if(response.perform != '')
            {
                $.each(response.perform, function(key, val){
                i++;
                act_tot += parseFloat(val.percent_value);
                data += '<tr><td><div class="form-group"><label class="form-label">'+val.criteria_name+'<span>*</span></label></div></td><td><div class="form-group"><div class="form-control-wrapper form-control-icon-right"><input class="form-control" placeholder="'+val.criteria_name+'" type="text" name="max_value-'+val.criteria_id+'" id="act_val-'+i+'" value="'+val.percent_value+'" readonly></div></div></td><td><div class="form-group"><div class="form-control-wrapper form-control-icon-right"><input class="form-control number val_min" placeholder="'+val.criteria_name+'" type="text" name="assess_value-'+val.criteria_id+'" id="ach_val-'+i+'" required min="0" value="0" max="'+val.percent_value+'"><span class="error_msg" id ="err-'+i+'"></span><div class="help-block with-errors error_msg"></div></div></div></td></tr>';
                });
                /*data += '<tr><td><div class="form-group"><label class="form-label text-center">Total</label></div></td><td><div class="form-group"><div class="form-control-wrapper form-control-icon-right"><label class="form-label text-center">'+act_tot+'</label></div></div></td><td><div class="form-group"><div class="form-control-wrapper form-control-icon-right"><input class="form-control" placeholder="Total" type="text" name="" id="ach_tot" required data-error="Please Enter Total" min="0" value="0" max="'+act_tot+'" readonly><div class="help-block with-errors error_msg"></div></div></div></td></tr>';<div class="help-block with-errors error_msg"></div>*/
                $('#save_details').removeAttr('disabled');
            }
            else
            {
                data = '<tr><td colspan="3" class="text-center text-danger h3"><stong>No Performance Criteria added for this Role.</stong></td></tr>';
                $('#save_details').attr('disabled',true);
            }
            $('#max_id').val(i);
            $('#act_tot').val(act_tot);
            $('#perform_data').html(data);
        }
    });
});

$('#reset_form').on('click', function() {
    window.location.reload();
});

// $('#save_details').on('click', function() {
$('#employee_assesment')
.bootstrapValidator({
message: 'This value is not valid',
            feedbackIcons: {
            /*valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'*/
            },
            fields: {
                can_id: {
                validators: {
                notEmpty: {
                message: 'The candidate name is required and can\'t be empty'
                }
                }
                },
                date: {
                validators: {
                notEmpty: {
                message: 'The date is required and can\'t be empty'
                }
                }
                },
                myClass: {
                trigger: 'change keyup',
                selector: '.val_min',
                validators: {
                notEmpty: {
                message: 'Achieved Assesment cannot be null.'
                },
                greaterThan: {
                value: 0,
                message: 'The value must be greater than or equal to 0'
                }
                }
                }
            }
            })
            .on('success.form.bv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            var cnt = $('#max_id').val();
            var j = 0;
            for(var i = 1; i<= cnt; i++)
            {
            var ach_val = $('#ach_val-'+i).val();
            var max_val = $('#act_val-'+i).val();
            if((ach_val == '') || (ach_val > max_val))
            if(parseFloat(ach_val) > parseFloat(max_val))
                {
                    $('#err-'+i).text("Please enter proper value.").show().delay(2000).fadeOut(800);
                    j++;
                }
                else if(ach_val == '')
                {
                    $('#err-'+i).text("Please enter proper value.").show().delay(2000).fadeOut(800);
                    j++;
                }
            }
            if(j > 0)
            {

            }
            else
            {
            var fdata = $('#employee_assesment').serialize();
            $('#save_details').attr('disabled',true);
            $.ajax({
            url: '<?php echo site_url();?>/performance_and_incentives/save_assesment',
            data : fdata,
            type: 'POST',
            success: function(response)
            {
            if((response.result == false) || (response.result == 0))
            {
                $.notify({
                        title: "<strong>OOPs:</strong> ",
                        message:response.msg,
                        
                    },{
                    type: "danger",
                    delay: 800,
                        animate:{
                            enter: "animated fadeInUp",
                            exit: "animated fadeOutDown"
                        } 
                }); 
            /*swal({
            title: 'OOPs',
            text: response.msg,
            type: 'warning'});*/
            $('#save_details').removeAttr('disabled');
            }
            else
            {
            $.notify({
                        title: "<strong>Success:</strong> ",
                        message:"Assesment Details Saved Successfully!",
                        
                    },{
                    type: "success",
                    delay: 800,
                        animate:{
                            enter: "animated fadeInUp",
                            exit: "animated fadeOutDown"
                        } 
                }); 
            window.setTimeout(function(){
            window.location.href = '<?php echo site_url("performance_and_incentives/candidate_assessment_list"); ?>';
            // window.location.reload();
            },3000);
            }
            }
            });
            }
            });
            // });

            function get_total_percent()
            {
                var cnt = $('#max_id').val();
                var max_tot = $('#act_tot').val();
                var tot = 0;
                var per = 0;
                var achived = 0;
                for(var i = 1; i <= cnt; i++)
                {
                    achived = $('#ach_val-'+i).val();
                    if((achived == '') || (achived == NaN) || (achived == null))
                    {
                        achived = 0;
                    }
                    tot += parseFloat(achived);
                }
                per = parseFloat(parseFloat(tot/max_tot)*100);
                $('#ach_tot').val(tot);
            }

</script>
