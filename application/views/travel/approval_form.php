
<div class="page-content">
    <div class="container-fluid">
<?php if($this->session->flashdata('warning')){?>
            <script type="text/javascript">
                var message_text='<?php echo $this->session->flashdata('warning');?>';
                    $.notify({
                                title: "<strong>Warning:</strong> ",
                                message: message_text,
                            },
                            {
                                type: "warning",
                                delay: 800,
                                animate:{
                                enter: "animated fadeInUp",
                                exit: "animated fadeOutDown"
                                }
                            });
            </script>
        <?php }?>        
    <div class="col-sm-12 well">
         <div class="row">
            <form data-toggle="validator" class="col-sm-12" id="add_remark" action=" " method="post">
                <h1 class="well headline">Approval Form</h1>
                    <div class="col-sm-12 col-xs-12 profile_bg">

                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Candidate Name : </label>
                                </div>
                            </div>
                        
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <span><?php echo @$can_details->can_name; ?></span>
                                        <input type="hidden" name="can_id" value="<?php echo @$travel_details->can_id; ?>">
                                        <input type="hidden" name="tv_id" value="<?php echo @$travel_details->tv_id; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Travel Purpose : </label>
                                </div>
                            </div>
                        
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <span><?php echo @$travel_details->purpose; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Travel To : </label>
                                </div>
                            </div>
                        
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <span><?php echo @$travel_details->location; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Travel From Date : </label>
                                </div>
                            </div>
                
                            <div class="col-lg-4">
                                <div class="date form-group">
                                    <div class="input-group input-append date">
                                        <span><?php echo (!empty(@$travel_details->from_date)) ? db_to_date(@$travel_details->from_date) : ''; ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Travel To Date : </label>
                                </div>
                            </div>
                
                            <div class="col-lg-4">
                                <div class="date form-group">
                                    <div class="input-group input-append date">
                                        <span><?php echo (!empty(@$travel_details->to_date)) ? db_to_date(@$travel_details->to_date) : ''; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">No. of Days : </label>
                                </div>
                            </div>
                
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <span><?php echo @$travel_details->days; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">No. of Stays : </label>
                                </div>
                            </div>
                
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <span><?php echo @$travel_details->stays; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">No. of Meals : </label>
                                </div>
                            </div>
                
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <span><?php echo @$travel_details->meals; ?></span>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">No. of Snacks : </label>
                                </div>
                            </div>
                
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <span><?php echo @$travel_details->snacks; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Budget : </label>
                                </div>
                            </div>
                        
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <span><?php echo @$travel_details->budget; ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Advance : </label>
                                </div>
                            </div>
                        
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <span><?php echo @$travel_details->advance; ?></span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Mode of Transport : </label>
                                </div>
                            </div>
                        
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <span><?php echo @$travel_details->transport_mode; ?></span>
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
                                        <span><?php echo @$travel_details->details; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                                        
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Remark <span>*</span></label>
                                </div>
                            </div>
                    
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <textarea class="form-control col-md-12" id="remark" name="remark" rows="3" cols="" maxlength="1000"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Status <span>*</span></label>
                                </div>
                            </div>
                        
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <select id="approve" name="status" class="web col-lg-12" required="">
                                            <optgroup label="Status">
                                              <option value="approved">Approve</option>
                                              <option value="rejected">Reject</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" id="submit_travel" class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label">Submit</span>
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
<script>
$(document).ready(function() {
    $('#add_remark')
        .bootstrapValidator({
            fields: {
                remark: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Remark'
                        }
                    }
                },
                status: {
                    validators: {
                        notEmpty: {
                            message: 'Please Select Status'
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
            var fdata = $('#add_remark').serialize();
            $('#submit_travel').attr('disabled',true);
            $.ajax({
                url: '<?php echo site_url();?>/travel_management/add_travel_remark',
                data : fdata,
                type: 'POST',
                success: function(response)
                {
                   
			$.notify({
				title: "<strong>Success:</strong> ",
				message: "Travel Remark Updated Successfully!",	
				},{
				type: "success",
				delay: 800,
				animate:{
				enter: "animated fadeInUp",
				exit: "animated fadeOutDown"
				} 
			});
			
			setTimeout(function () {
			window.location.href = '<?php echo site_url("travel_management/approval"); ?>';
    			}, 1000);
                }
            });
        });
});

$('#reset_form').on('click', function() {
    document.getElementById("add_travel").reset();
});
</script>