<div class="page-content">

    <?php //echo $this->uri->segment('5');
        $is_manager=false;
        $style='';
        $disabled='';
        if($this->uri->segment('5')==get_login_user_id())
        {
            $is_manager=true;
            $style="style='display:block'";
            $disabled='disabled';
        }
    ?>
    <div class="container-fluid">

        <div class="well">
         <div class="row">

         <form data-toggle="validator" class="col-sm-12" id="profile_form" action="" method="post">
                <h1 class="well headline">Appraisal Form</h1>
                    <div class="col-sm-12 col-xs-12 profile_bg">

                        <table class="kra_table table-responsive">
                          
                          <tbody>
                            <tr>
                              <td class="kra_bold">Employee Id</td>
                              <td><?php echo "MUM00000".$candidate_details['can_id']?></td>
                              <td class="kra_bold">Employee Name</td>
                              <td> <?php echo $candidate_details['can_name']?></td>
                            </tr>
                             <tr>
                              <td class="kra_bold">Reporting To</td>
                              <td><?php echo $candidate_details['reporting_to']?></td>
                              <td class="kra_bold">Designation</td>
                              <td><?php echo get_user_job_profile($candidate_details['job_profile'])?></td>
                            </tr>
                             <tr>
                              <td class="kra_bold">Department</td>
                              <td> <?php echo $candidate_details['department_title']?></td>
                              <td class="kra_bold">Joining Date</td>
                              <td><?php echo $candidate_details['joining_date']?></td>
                            </tr>
                          </tbody>
                        </table>
                         <div class="col-md-12 kra_form">
                            <div class="row kra_fst_col">
                                <div class="col-md-4">
                                    Paratmeters
                                </div>
                                <div class="col-md-4" style="text-align: right">
                                    <?php if($is_manager){?>
                                        <?php echo $candidate_details['can_name']?> Rating       
                                    <?php }else{?>
                                        Self Rating
                                    <?php } ?>
                                </div>

                                <div class="col-md-4" <?php echo $style?> style="text-align: right;display: none">
                                    Manager Rating
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php 
                                    $count=count($kra_entities);

                                    $i=0;
                                       foreach ($kra_entities as $key => $value) {
                                    ?>
                                    
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-3 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label"><?=$value['name']?> <span>*</span></label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-9 col-xs-12">
                                            <div class="form-group">
                                                <div class="form-control-wrapper form-control-icon-right">

                                                    <input type="text" class="form-control number user_rating" placeholder="10" name="<?=$value['name']?>" <?php echo $disabled?> <?php if(isset($user_rating_values[$i])) echo 'value="'.$user_rating_values[$i].'";'?>>
                                                    <div class="help-block with-errors error_msg"></div>                                        
                                                </div>                                  
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-9 col-xs-12" <?php echo $style?> style="display: none">
                                            <div class="form-group">
                                                <div class="form-control-wrapper form-control-icon-right">
                                                    <input type="text" class="form-control number manager_rating" placeholder="10" name="<?=$value['name']?>" >
                                                    <div class="help-block with-errors error_msg"></div>                                        
                                                </div>                                  
                                            </div>
                                        </div>
                                    </div>


                                     <?php 

                                        $i++;
                                        }
                                    ?>
                                    <div class="row">
                                         <div class="col-md-4">
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <div id="chart-container">FusionCharts will render here</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div id="chart-container1" <?php echo $style?> style="display: none">FusionCharts will render here</div>
                                        </div>
                                    </div>

                                </div>
                             
                            </div>
                            <div class="row ">
                                <div class="col-md-4">
                                                
                                </div>
                                <div class="col-md-4" style="text-align: center; margin-top:20px; ">
                                     <?php 
                                        if($this->uri->segment('4')==get_login_user_id())
                                        {
                                            echo '<button type="button" class="btn-primary btn btn-inline btn-success ladda-button" name="submit" id="review_submit_user">Submit Review</button>';       
                                        }
                                     ?>
                                      
                                </div>
                                <div class="col-md-4" style="text-align: center; margin-top:20px;">
                                      <?php 
                                      if($this->uri->segment('5')==get_login_user_id())
                                        {
                                            echo '<button type="button" class="btn-primary btn btn-inline btn-success ladda-button" name="submit" id="review_submit_manager">Submit Review</button>';
                                        }
                                        ?>          
                                </div>
                        </div>
                        </div>

                      
                
                </div>
                </div>
            </form>

    </div>
</div>
<script src="<?php echo assets_url();?>js/lib/charts-c3js/fusioncharts.charts.js"></script>
  <script src="<?php echo assets_url();?>js/lib/charts-c3js/fusioncharts.js"></script>
  <script src="<?php echo assets_url();?>js/lib/charts-c3js/fusioncharts.gantt.js"></script>
  <script src="<?php echo assets_url();?>js/lib/charts-c3js/piechart.js"></script>
  
<script type="text/javascript">

     $(document).ready(function() {  
        $('#review_submit_user').on('click', function(e){
        var isValid = true;
        var values='';
        var sum = 0;
        var avg = 0;
          jQuery('.user_rating').each(function() {
           sum += Number(jQuery(this).val());
           });

        var $allx = jQuery(':text.user_rating');
        var $emptyx = $allx.filter('[value=""]');
        var num = $allx.length - $emptyx.length ;
         if(num > 0){ avg = Number(sum/num); }
        $('.user_rating').each(function() {
            if ($.trim($(this).val()) == '') {
                isValid = false;
                $(this).css({
                    //"border": "1px solid red",
                    "background": "#FFCECE"
                });
            }
            else {    
                values += $(this).val()+',';

                $(this).css({
                    "border": "",
                    "background": ""
                });
            }
        });
        if (isValid == false)
        { 
            e.preventDefault();
        }
        else
        { 
            $.ajax({
                    url: '<?php echo site_url();?>/kra/save_kra_rating/user',
                    // dataType :"json",
                    data : {kra_id: "<?php echo $kra_details['kra_id']?>",'values':values,'avg':avg},
                    type: 'POST',
                    success: function(response){
                        swal(response); 
                          window.history.back();
                        //$('.circle-green').css('display','block')
                    }
                });
        }
    });
    $('#review_submit_manager').on('click', function(e){
        var isValid = true;
        var values='';
        var sum = 0;
        var avg = 0;
          jQuery('.manager_rating').each(function() {
           sum += Number(jQuery(this).val());
           });

        var $allx = jQuery(':text.manager_rating');
        var $emptyx = $allx.filter('[value=""]');
        var num = $allx.length - $emptyx.length ;
         if(num > 0){ avg = Number(sum/num); }
        
        $('.manager_rating').each(function() {
            if ($.trim($(this).val()) == '') {
                isValid = false;
                $(this).css({
                    //"border": "1px solid red",
                    "background": "#FFCECE"
                });
            }
            else {    
                values += $(this).val()+',';

                $(this).css({
                    "border": "",
                    "background": ""
                });
            }
        });
        if (isValid == false)
        { 
            e.preventDefault();
        }
        else
        { 
            $.ajax({
                    url: '<?php echo site_url();?>/kra/save_kra_rating/manager',
                    // dataType :"json",
                    data : {kra_id: "<?php echo $kra_details['kra_id']?>",'values':values,'avg':avg,'can_id':"<?php echo $this->uri->segment('4')?>"},
                    type: 'POST',
                    success: function(response){
                        swal(response);  
                         window.history.back();
                        //$('.circle-green').css('display','block')
                    }
                });
        }
    });       
    FusionCharts.ready(function () {
    var cSatScoreChart = new FusionCharts({
        type: 'angulargauge',
        renderAt: 'chart-container',
        width: '100%',
        height: '150',
        dataFormat: 'json',
        dataSource: {
            "chart": {
                "lowerLimit": "0",
                "upperLimit": "10",
                "gaugeFillMix": "{light-3},{light-20},{light-60},{dark-30},{dark-40}, {dark-40}",
                "gaugeFillRatio": "",
                "theme": "fint",
                "showValue": "1",
                 "valueBelowPivot": "1",
                 "bgAlpha":"0"
            },
            "colorRange": {
                "color": [
                    {
                        "minValue": "0",
                        "maxValue": "3",
                        "code": "#e44a00"
                    },
                    {
                        "minValue": "9",
                        "maxValue": "7",
                        "code": "#f8bd19"
                    },
                    {
                        "minValue": "7",
                        "maxValue": "10",
                        "code": "#6baa01"
                    }
                ]
            },
            "dials": {
                "dial": [{
                    "value": "<?php echo $user_rating_average?>"
                }]
            }
        }
    }).render();
});

FusionCharts.ready(function () {
    var cSatScoreChart = new FusionCharts({
        type: 'angulargauge',
        renderAt: 'chart-container1',
        width: '100%',
        height: '150',
        dataFormat: 'json',
        dataSource: {
            "chart": {
                "lowerLimit": "0",
                "upperLimit": "10",
                "gaugeFillMix": "{light-3},{light-20},{light-60},{dark-30},{dark-40}, {dark-40}",
                "gaugeFillRatio": "",
                "theme": "fint",
                "showValue": "1",
                "valueBelowPivot": "1",
               //  "bgColor":"#000000",
               //"canvasBgColor": "#000000",
                "bgAlpha":"0"
            },
            "colorRange": {
                "color": [
                    {
                        "minValue": "0",
                        "maxValue": "3",
                        "code": "#e44a00"
                    },
                    {
                        "minValue": "9",
                        "maxValue": "7",
                        "code": "#f8bd19"
                    },
                    {
                        "minValue": "7",
                        "maxValue": "10",
                        "code": "#6baa01"
                    }
                ]
            },
            "dials": {
                "dial": [{
                    "value": "<?php echo $manager_rating_average?>"
                }]
            }
        }
    }).render();
});



    $('.number').on('keyup keydown', function(e){
        if ($(this).val() > 10 
            && e.keyCode != 46
            && e.keyCode != 8
           ) {
           e.preventDefault();     
           $(this).val(10);
        }
    });
    $('.user_rating').on('change', function(e)
    {
         var sum = 0;
        var avg = 0;
          jQuery('.number').each(function() {
           sum += Number(jQuery(this).val());
           });

        var $allx = jQuery(':text.user_rating');
        var $emptyx = $allx.filter('[value=""]');
        var num = $allx.length - $emptyx.length ;
         if(num > 0){ avg = Number(sum/num); }
        
        FusionCharts.ready(function () {
    var cSatScoreChart = new FusionCharts({
        type: 'angulargauge',
        renderAt: 'chart-container',
        width: '100%',
        height: '150',
        dataFormat: 'json',
        dataSource: {
            "chart": {
                "lowerLimit": "0",
                "upperLimit": "10",
                "gaugeFillMix": "{light-3},{light-20},{light-60},{dark-30},{dark-40}, {dark-40}",
                "gaugeFillRatio": "",
                "theme": "fint",
                "showValue": "1",
                "valueBelowPivot": "1",
                "bgAlpha":"0"
            },
            "colorRange": {
                "color": [
                    {
                        "minValue": "0",
                        "maxValue": "3",
                        "code": "#e44a00"
                    },
                    {
                        "minValue": "9",
                        "maxValue": "7",
                        "code": "#f8bd19"
                    },
                    {
                        "minValue": "7",
                        "maxValue": "10",
                        "code": "#6baa01"
                    }
                ]
            },
            "dials": {
                "dial": [{
                    "value": avg
                }]
            }
        }
	    }).render();
		});
    });
});
</script>

