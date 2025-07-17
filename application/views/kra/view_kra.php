<div class="page-content">
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
                            <div class="row">
                                <table class="kra_table table-responsive">
                                    <thead class="kra_fst_col">
                                        <th class="text-left">Paratmeters</th>
                                        <th>Self Rating</th>
                                        <th>Manager Rating</th>
                                    </thead>
                                   <tbody>
                                    <?php 
                                    $count=count($kra_entities);
                                    $i=0;
                                       foreach ($kra_entities as $key => $value) {
                                    ?>
                                      <tr>
                                      <td class="kra_bold text-left"><?=$value['name']?></td>
                                      <td>
                                        <?php if(isset($user_rating_values[$i])) echo $user_rating_values[$i]?>
                                        </td>
                                      <td><?php if(isset($user_rating_values[$i])) echo $manager_rating_values[$i]; else echo 'NA';?></td>
                                    </tr>
                                    <?php 
                                      $i++;
                                    }
                                    ?>
                                    
                                  </tbody>
                                </table>


                            </div>
                            <div class="row" style="margin-top:15px">
                                <div class="col-md-12">
                                    <div class="row">
                                         <div class="col-md-4">
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <div id="chart-container">FusionCharts will render here</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div id="chart-container1">FusionCharts will render here</div>
                                        </div>
                                    </div>

                                </div>
                             
                            </div>
                            <div class="row ">
                            <!-- <div class="col-md-12" style="text-align: center; margin-top:20px; ">
                                 <button type="button" class="btn-primary btn btn-inline btn-success" name="submit" id="review_submit">Submit Review</button>
                            </div> -->
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
                    "value": "<?php echo $user_rating_average;?>"
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
                    "value": "<?php echo $manager_rating_average;?>"
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
    $('.number').on('change', function(e)
    {
    	 var sum = 0;
        var avg = 0;
          jQuery('.number').each(function() {
           sum += Number(jQuery(this).val());
           });

        var $allx = jQuery(':text.number');
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
