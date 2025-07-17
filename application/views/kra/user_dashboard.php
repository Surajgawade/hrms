<div class="page-content">
	<div class="container-fluid ">
		<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>Employee <span title="Key Result Area">KRA</span> Review</h2>
						</div>
						<div class="add_btn col-md-2">
							
						</div>
					</div>
				</div>
			</header>
		<div class="well profile_bg">
			<div class="col-md-12">
				<div class="row kra_row">
				<div class="col-md-3">
					<div class="row">
						<div class="" style="">                                        
							<div class="col-md-6 kra_colbg" id="square">
								<span class=""><span class=""><?php echo (!empty($assigned_kra))?$assigned_kra:'0' ?></span>
								<p>Assigned KRA</p>
							</div>
						</div>
						<div class="" >              
							<div  class="col-md-6 assign_kra kra_colbg2" id="square">
								<span class=""><?php echo (!empty($completed_kra))?$completed_kra:'0' ?></span>
								<p>Completed KRA</p>
							</div>
						</div>
					</div>
				</div>
			
			
			</div>

				<div class="row kra_select">
					<div class="col-md-2 form-group">
						<select id="review_type" class="form-control">
							<option value="">Select Review</option>
							<option>Weekly Review</option>
							<option>Monthly Review</option>
							<option>Quaterly Review</option>
							<option>Half Yearly Review</option>
							<option>Yearly Review</option>
						</select>
					</div>
					<div class="col-md-2 form-group">
						<select id="month" class="form-control">
							<option value="">Select Month</option>
							<option>Jan</option>
							<option>Feb</option>
							<option>Mar</option>
							<option>Apr</option>
							<option>May</option>
							<option>Jun</option>
							<option>Jul</option>
							<option>Aug</option>
							<option>Sept</option>
							<option>Oct</option>
							<option>Nov</option>
							<option>Dec</option>
						</select>
					</div>
					<div class="col-md-2 form" style="display: none;">
						<a class="form_krabtn col-md-12" href="#" data-toggle = "modal" data-target = "#myModal"><i class="fa fa-tasks" aria-hidden="true"></i> Form</a>
					</div>
					<div class="col-md-2" style="">
						
					</div>
				</div>

				<div class="kra_table result">
					<table id="kra_list" class="table-responsive display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th style="width:10%">Emp Code</th>
							<th style="width:25%">Emp Name</th>
							<th style="width:20%">Review</th>
							<th style="width:15%">Month</th>
							<th style="width:10%">Assigned By</th>
							<th style="width:15%">Assigned On</th>
							<th style="width:10%">Action</th>
						</tr>
						</thead>

						<tbody>
							<?php foreach($assign_kra as $key=>$value){
								$action='';
								if($value['status']==0)
								{
									$action="<a class='assign_btn' id='".$value['kra_id']."' href='".site_url()."/kra/rate_kra/".$value['kra_id']."/".get_login_user_id()."'><i class='fa fa-star' aria-hidden='true'></i> Rate</a>";
								}
								else
								{
									$action="<a class='assign_btn' id='".$value['kra_id']."' href='".site_url()."/kra/view_kra/".$value['kra_id']."/".get_login_user_id()."'><i class='fa fa-eye' aria-hidden='true'></i> View</a>";	
								}
								echo "<tr><td>MUM00000".$value['can_id']."</td><td>".$value['can_name']."</td><td>".$value['kra_name']."</td><td>".$value['month']."</td><td>".get_user_name_by_id($value['created_by'])."</td><td>".date('Y/m/d',strtotime($value['created_on']))."</td><td>".$action."</td></tr>";
							}?>
						</tbody>
						
					</table>
				</div>
			</div>

			
			<!--Candidate Name-->

			<div class = "modal fade" id = "name_kra" tabindex = "-1" role = "dialog" 
			   aria-labelledby = "myModalLabel" aria-hidden = "true">
			   
			   <div class = "modal-dialog">
			      <div class = "modal-content">
			         
			         <div class = "modal-header">
			            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
			                  &times;
			            </button>
			            
			            <h4 class = "modal-title" id = "myModalLabel">
			               Select Name
			            </h4>
			         </div>
			         
			         <div class = "modal-body">
			           <div class="row">
							<div class="col-lg-3" align="right">
								<input type='checkbox' id="select_all" onClick="check_uncheck_checkbox(this.checked);">Select All
							</div>
							<div class="col-lg-9">
								<?php 
									 foreach ($user_list as $key => $value) {
									 	echo "<input class='emplyee_ids' type='checkbox' name='user_list[]' value='".$value['can_id']."'>".$value['can_name']."<br>";		
										
									 }
								?>
								<input type="hidden" name="kra_id" id="kra_id">
								<span id="entity-error"></span>
							</div>
						</div>
			         </div>
			         
			         <div class = "modal-footer">
			            <button type = "button" class = "btn btn-default" data-dismiss = "modal">
			               Close
			            </button>
			            
			            <button id="assign_kra" type = "button" class = "btn btn-primary">
			               Assign KRA
			            </button>
			         </div>
			         
			      </div><!-- /.modal-content -->
			   </div><!-- /.modal-dialog -->
			  
			</div><!-- /.modal -->
					

		</div>
	</div>
</div>
<script src="<?php echo assets_url();?>js/lib/charts-c3js/fusioncharts.charts.js"></script>
  <script src="<?php echo assets_url();?>js/lib/charts-c3js/fusioncharts.js"></script>
  <script src="<?php echo assets_url();?>js/lib/charts-c3js/fusioncharts.gantt.js"></script>
<script type="text/javascript">
	$(".chosen-select").chosen();
	 $(document).ready(function() {  
    	$(".chosen-select").attr('disabled', true).trigger("chosen:updated")
    	$("#emplyee").attr('disabled', true);
    	$("#department1").attr('disabled', true);
    });
	 $(".assign_btn").click(function() {
			$('#kra_id').val($(this).attr('id'));
		});
	 $("#assign_kra").click(function() {
	 	 var fields = $("input[class='emplyee_ids']").serializeArray();
		 var kra_id=$("#kra_id").val();
		 if(fields=='')
		 {
		 	$('#entity-error').html('<p style="color:red" id="msg-entity">required</p>');	
		 	$("#msg-entity").hide(1000);
		 }
		 else
		 {
		 	$('#select_all').removeAttr('checked');
		 	$.ajax({
					url: '<?php echo site_url();?>/kra/save_assign_kra/',
					dataType :"json",
					data : {'kra_id':kra_id,'employee_ids':fields},
					type: 'POST',
					success: function(response){
						if(response==1)
						{
							swal("Kra Has Been Assigned Successfully", "success");
							$('#myModal').modal('hide');
							$('#department').trigger("change");	
							$('#select_all').prop('checked', false); // Unchecks it
		 					$('#select_all').trigger("change");
						}
						else
						{
							$('#title-error').html('<p style="color:red" id="msg">Already Exist</p>');	
						}
					}
				});
		 }
	 });
	 
	$("#review_type").change(function() {
		review_type=$("#review_type option:selected").val();
		if(review_type!='')
		{
			$(".chosen-select").attr('disabled', false).trigger("chosen:updated")
    		$("#emplyee").attr('disabled', false);
    		$("#department1").attr('disabled', false);	
		}
		else
		{
			$(".chosen-select").attr('disabled', true).trigger("chosen:updated")
    		$("#emplyee").attr('disabled', true);
    		$("#department1").attr('disabled', true);
		}
	});
	$("#department").change(function() {
		id=$("#department").val();
		if(id!='')
		{

			$.ajax({
					url: '<?php echo site_url();?>/kra/get_candidate_list/',
					dataType :"json",
					data : {id: id},
					type: 'POST',
					success: function(response){
						$('.result').html(response.can_list);
						$('.total_count').html(response.total_employee);
						$('.emplyee').html(response.can_select_list);	
						//$('.circle-green').css('display','block')
					}
				});
		}
		else
		{
			//$('.emplyee').html();	
			
			$('.form').css('display','none');				
		}
		//}
		// }
		// alert(id);
	});

</script>
<script type="text/javascript">
	$('#openBtn').click(function(){
  	$('#myModal').modal('show');
	});
</script>
<script type="text/javascript">
	FusionCharts.ready(function () {
    var ageGroupChart = new FusionCharts({
        type: 'pie2d',
        renderAt: 'chart-container',
        width: '100%',
        height: '130',
        dataFormat: 'json',
        dataSource: {
           "chart": {
	        "caption": false,
	        "showpercentageinlabel": "1",
	        "bgAlpha": "0",
	        "borderAlpha": "10",
	        "showvalues": "0",
	        "showlabels": "0",
	        "showlegend": false,
	        "showborder": "0"
    },
                "data": [{
                "label": "IT",
                    "value": "1250400"
            }, {
                "label": "Marketing",
                    "value": "1463300"
            }, {
                "label": "HR",
                    "value": "1050700"
            }, {
                "label": "Finance",
                    "value": "491000",
                    "isSliced": "1"
            }]
        }
    });

    ageGroupChart.render();
});
	$("#select_all").change(function(){  //"select all" change
	var status = this.checked; // "select all" checked status
	$('.entity_ids').each(function(){ //iterate all listed checkbox items
	this.checked = status; //change ".checkbox" checked status
	});
	});

	$("#save_kra").click(function() {
		kra_title=$("#review_type option:selected").val();
		 var fields = $("input[class='entity_ids']").serializeArray();
		var month=$("#month option:selected").val();
		var emplyee_id=$("#employee_select option:selected").val();
		 if($('#kra_title').val()=='')
		 {

		// 	$('#title-error').html('<p style="color:red" id="msg">required</p>');
		// 	$("#msg").hide(1000);
		 }
		 else if(fields=='')
		 {
		 	$('#entity-error').html('<p style="color:red" id="msg-entity">required</p>');	
		 	$("#msg-entity").hide(1000);
		 }
		 else
		 {
		 	$('#select_all').removeAttr('checked');
		 	$.ajax({
					url: '<?php echo site_url();?>/kra/save_assign_kra/',
					dataType :"json",
					data : {'kra_title':kra_title,'entity_ids':fields,'emplyee_id':emplyee_id,'month':month},
					type: 'POST',
					success: function(response){
						if(response==1)
						{
							$('#myModal').modal('hide');
							swal("Done!", "Kra Has Been Assigned Successfully!", "success");
							$('#department').trigger("change");	
							$('#select_all').prop('checked', false); // Unchecks it
		 					$('#select_all').trigger("change");
						}
						else
						{
							$('#title-error').html('<p style="color:red" id="msg">Already Exist</p>');	
						}
					}
				});
		 }
	});
</script>
