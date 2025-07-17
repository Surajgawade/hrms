<div class="page-content">
    <div class="container-fluid">
    
    <script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="col-lg-7 col-sm-9 col-xs-10"><input class="form-control" style="float:left" type="text" name="fields[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field">' +
            '<i class="fa fa-minus btn btn-danger" aria-hidden="true"></i> </a></div>'; //New input field html
        var x = 1; //Initial field counter is 1
        $(addButton).click(function(e){ //Once add button is clicked
            e.preventDefault();
            if(x < maxField){ //Check maximum number of input fields
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Add field html
            }
        });
        $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>

    <div class="well">
            <div class="row">
                <form data-toggle="validator" class="col-lg-6 col-md-12 col-sm-12" id="profile_form" method="post" action="<?php echo site_url();?>/candidate/insert ">
                    <h1 class="well headline">Edit Poll</h1>
                    <div class="col-md-12 col-sm-12 col-xs-12 profile_bg">
                        <?= form_open_multipart('polls/edit/' . $vote->dv_id, array('class' => 'form-horizontal')) ?>
                        <div class="row">
                            <div class="col-lg-2 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Poll Title</label>
                                </div>
                            </div>

                            <div class="col-lg-10 col-sm-9 col-xs-12">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <input class="form-control " name="dv_title"
                                                   value="<?php echo $vote->dv_title ?>"/>
                                            <?php echo form_error('dv_title'); ?>
                                        <i class="fa fa-vote"></i>                                       
                                    </div>                                  
                                </div>
                            </div>
                        </div>
                       <div class="row field_wrapper">
                            <?php $counter = 1 ;foreach($columns as $key=>$value){ ?>
                                <div class="col-lg-7 col-sm-9 col-xs-10">
                                    <input class="form-control" style="float: left" type="text" name="fields[]" value="<?= set_value($key, $value) ?>"/>
                                     <a href="javascript:void(0);" class='remove_button' title="Add field">
                                        <i class="fa fa-minus btn btn-danger" aria-hidden="true"></i>
                                    </a>
                                    
                                </div>

                                <?php $counter++; } ?>
                                <div class="col-lg-7 col-sm-9 col-xs-10">
                                    <input class="form-control"  style="float: left" type="text" name="fields[]" value=""/>
                                    <button id="add" class="btn btn-success add_button"><i class="fa fa-plus " aria-hidden="true"></i></button>
                                </div>
                                 <?php echo form_error('fields'); ?>
                        </div>
                      
                            <label class="control-label col-sm-4">
                                <input type="checkbox" name="dv_state" id="chk1" value="1" <?php echo set_checkbox("dv_state", "1", ($vote->dv_state == 1) ? TRUE : FALSE); ?> />Active ?</label>
                            
                            <br />

                            <input class="btn btn-primary" type="submit" name="save" value="Save Poll"/>
                       
                            <?php echo form_close(); ?>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
