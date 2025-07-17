
<div class="page-content">
    <div class="container-fluid">
        
    <div class="col-sm-12 well">
         <div class="row">
            <form data-toggle="validator" class="col-sm-12" id="add_travel" action=" " method="post">
                <h1 class="well headline">Clearance Form</h1>
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
                                        <input type="hidden" id="can_id" name="can_id" value="<?php echo @$travel_details->can_id; ?>">
                                        <input type="hidden" id="tv_id" name="tv_id" value="<?php echo @$travel_details->tv_id; ?>">
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
                                    <label class="form-label">Documents : </label>
                                </div>
                            </div>
                        
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="width:15%">Sr. No.</th>
                                                    <th style="width:15%">Document Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($travel_doc_details)) {
                                                    $i = 1;
                                                    foreach($travel_doc_details as $key => $value) { ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><a href="<?php echo base_url().'upload_travel_docs/'.@$value['tfile_name']; ?>" target="_blank"><?php echo @$value['tdoc_name']; ?></a></td>
                                                    </tr>
                                                <?php $i++; } } else { ?>
                                                    <tr>
                                                        <td colspan="2"><span class="text-center text-danger">No documents uploaded.</span></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Clearance Remark <span>*</span></label>
                                </div>
                            </div>
                    
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <textarea class="form-control col-md-12" id="clearance_remark" name="clearance_remark" rows="3" cols="" maxlength="1000"></textarea>
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
                            <div class="col-lg-12">
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
    $('#add_travel')
        .bootstrapValidator({
            fields: {
                clearance_remark: {
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
            var fdata = $('#add_travel').serialize();
            var clearance_remark = $('#clearance_remark').val();
            $('#submit_travel').attr('disabled',true);
            $.ajax({
                url: '<?php echo site_url();?>/travel_management/add_travel_clearance',
                data : fdata,
                type: 'POST',
                success: function(response)
                {
                    if(response==1)
                        {
                            type ='success';
                            message ='Travel Clearance Updated Successfully!';
                            title ='Success:';
                        }
                        $.notify({
                                title: "<strong>"+title+"</strong> ",
                                message: message,
                                
                            },{
                            type: type,
                            delay: 800,
                                animate:{
                                    enter: "animated fadeInUp",
                                    exit: "animated fadeOutDown"
                                } 
                        });
                        setTimeout(function () {
                        window.location.href = '<?php echo site_url("travel_management/clearance"); ?>';
                    }, 2000);
                }
            });
        });
});
</script>