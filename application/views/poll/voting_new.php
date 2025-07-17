<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = ' <div class="col-lg-12 col-sm-9 col-xs-10"><br><label class="form-label">Poll Option</label><input class="form-control" style="float:right" type="text" name="fields[]" placeholder="Poll Option" value=""/><a style="position:relative; float:left"  href="javascript:void(0);" class="remove_button" title="Remove field">' +
            '<i class="fa fa-minus btn btn-danger" aria-hidden="true"></i> </a></div>'; //New input field html
        var x = 1; //Initial field counter is 1
        $(addButton).click(function(){ //Once add button is clicked
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

<div class="page-content">
<div class="container-fluid">
    <div class="col-sm-12 well">
    
<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12 main">
        <h1 class="well headline">Add Poll</h1>
            <div class="card">
               <div class="col-md-12 col-sm-12 col-xs-12 profile_bg">
                    <?php echo form_open_multipart('polls/create/', array('class' => 'form-horizontal')) ?>
                    <div class="row">
                            <div class="col-lg-2 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Poll Title</label>
                                </div>
                            </div>

                            <div class="col-lg-10 col-sm-9 col-xs-12">
                                <div class="form-group">
                                    <div class="form-control-wrapper form-control-icon-right">
                                        <input id="dv_title" class="form-control" name="dv_title" placeholder="Poll Title" value="<?= set_value('Add Poll') ?><?php echo $dv_title; ?>"/>
                                             <?php echo form_error('dv_title'); ?>                                       
                                    </div>                                  
                                </div>
                            </div>
                        </div>
                 <!--    <div class="form-group col-sm-6">
                        <label class="form-label">Poll Title <span>*</span></label>
                        <input id="dv_title" class="form-control" name="dv_title" placeholder="Poll Title" value="<?= set_value('Add Poll') ?><?php echo $dv_title; ?>"/>
                        <?php echo form_error('dv_title'); ?>
                    </div> -->

                     <div class="row field_wrapper">
                          <!--       <div class="col-lg-2 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Poll Option<span>*</span></label>
                                </div>
                            </div> -->
                                <div class="col-lg-12 col-sm-9 col-xs-10">
                                    <label class="form-label">Poll Option </label>
                                     <input class="form-control" type="text" name="fields[]" placeholder="Poll Option" value=""/>
                                    <a href="javascript:void(0);" class="add_button" style="position:relative; float:left" title="Add field">
                                        <i class="fa fa-plus btn btn-success" aria-hidden="true"></i>
                                    </a>
                                    <?php echo form_error('fields[]'); ?>
                                </div>

                                
                               
                        </div>

<!-- 
                    <div class="form-group field_wrapper">
                        <div class="col-lg-7 col-sm-9 col-xs-10">
                            <label class="form-label">Poll Option <span>*</span></label>
                            <input class="form-control" type="text" name="fields[]" style="float:left" placeholder="Poll Option" value=""/>
                            <a href="javascript:void(0);" class="add_button" title="Add field">
                                <i class="fa fa-plus btn btn-success" aria-hidden="true"></i>
                            </a>
                        </div>
                        <?php echo form_error('fields[]'); ?>
                    </div> -->
                    <div class="form-group" style="margin-top:10px">
                        <input class="btn btn-primary" type="submit" name="save" value="Create Poll"/>
                    </div>
                    <?php echo form_close(); ?>
               
            </section>
             </div>
            </div>
        </div>
    </div>
</div>
</div>
