

<div class="page-content">
	<div class="container-fluid ">
		<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>Manager <span title="Key Result Area">KRA</span> Review</h2>
						</div>
						<div class="add_btn col-md-2">
							
						</div>
					</div>
				</div>
			</header>
		<div class="well profile_bg">
			<div class="row col-md-12 kra_row">
				<div class="col-md-3">
					<div class="row">
						<div class="" style="">                                        
							<div class="col-md-6 kra_colbg" id="square">
								<span class=""><?php echo $total_employee?></span>
								<p>Total Employee</p>
							</div>
						</div>
						<div class="" >              
							<div  class="col-md-6 assign_kra kra_colbg2" id="square">
								<span class=""><?php echo $assign_kra_total?></span>
								<p>Assigned KRA</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="row">
						<div class="" style="">                                        
							<div class="col-md-6 kra_colbg" id="square">

								<span class=""><?php echo (!empty($team_self_evaluation))?$team_self_evaluation:'0' ?></span>
								<p>Team Self Evaluation</p>
							</div>
						</div>
						<div class="" >              
							<div  class="col-md-6 assign_kra kra_colbg2" id="square">
								<?php echo (!empty($self_review))?$self_review:'0' ?>
								<p>Self Evaluation</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="row">
						<div class="" style="">                                        
							<div class="col-md-6 kra_colbg" id="square">
								<span class=""><?php echo (!empty($pending_review))?$pending_review:'0' ?></span>
								<p>Pending Review</p>
							</div>
						</div>
						
					</div>
				</div>
			
			</div>

			<div class="col-md-12">
			<section class="tabs-section">
				<div class="tabs-section-nav">
					<div class="tbl">
						<ul class="nav" role="tablist">
								<li class="nav-item">
									<a id="assigned_kra" class="nav-link active" href="#tabs-2-tab-1" role="tab" data-toggle="tab">
										<span class="nav-link-in">
											Assigned KRA
										</span>
									</a>
								</li>
								<?php if(!empty($user_list)){ ?>
			
								<li class="nav-item">
									<a class="nav-link" id="team_evaluation" href="#tabs-2-tab-2" role="tab" data-toggle="tab">
										<span class="nav-link-in">
											Team Evaluation									
										</span>
									</a>
								</li>
								<?php } ?>
								<li class="nav-item">
									<a class="nav-link" id="self_evaluation" href="#tabs-2-tab-3" role="tab" data-toggle="tab">
										<span class="nav-link-in">
											Self Evaluation										
										</span>
									</a>
								</li>
													</ul>
					</div>
				</div><!--.tabs-section-nav-->

				<div class="tab-content">
					<?php if(!empty($user_list)){ ?>
			
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
						<div class="col-md-2 emplyee form-group">
						<!-- <select id="emplyee" class="form-control chosen-select" multiple="">
							<?php foreach($team_members as $key=>$value){
								//echo "<option>".$value['can_name']."</option>";
							}?>	
						</select> -->
					</div>
					<div class="col-md-2 form form-group" style="display: block;">
						<a class="form_krabtn col-md-12" href="#" data-toggle = "modal" data-target = "#myModal1"><i class="fa fa-tasks" aria-hidden="true"></i> Form</a>
					</div>
					<div class="col-md-2 form-group" style="display: block;">
						<a class="form_krabtn col-md-12" style="background: #32c5d2" href="<?php echo site_url()."/kra/assign_kra"?>" data-toggle = "modal" data-target = "#name_kra"><i class="fa fa-tasks" aria-hidden="true"></i> Assign</a>
					</div>
					</div>
					<?php }?>
					<div role="tabpanel" class="tab-pane fade in active show" id="tabs-2-tab-1">
						<div class="kra_table result">
									<table id="kra_list" class="table-responsive display table table-bordered table-striped" cellspacing="0" width="100%">
										<thead>
										<tr>
											<th style="width:10%">Emp Code</th>
											<th style="width:25%">Assigned By</th>
											<th style="width:10%">Designation</th>
											<th style="width:15%">Assigned On</th>
											<th style="width:10%">Review</th>
											<th style="width:5%">Month</th>
											<th style="width:20%">Status</th>
											<th style="width:20%">Action</th>
										</tr>
										</thead>


										<tbody id="assigned_kra_list">
											<?php foreach($assign_kra as $key=>$value){
												$user_data=get_user_details(array('can_id'=>$value['created_by']));
												$action='';
												if($value['status']==0)
												{
													$action="<button class='assign_btn' id='".$value['kra_id']."' href='' data-toggle = 'modal' data-target = '#name_kra'><i class='fa fa-users' aria-hidden='true'></i> Assign</button>";	
												}
												else
												{
													$action='Already Assigned';	
												}
												//echo "<tr><td>MUM00000".$user_data['can_id']."</td><td>".get_user_name_by_id($value['created_by'])."</td><td>".get_user_job_profile($user_data['job_profile'])."</td><td>".date('Y/m/d',strtotime($value['created_on']))."</td><td>".$value['kra_name']."</td><td>".$value['month']."</td><td>".$action."</td><td><button type='button' class='btn btn-sm btn-danger' onclick='delete_kra(".$value['kra_id'].")'><i class='fa fa-trash'></i></button></td></tr>";
												
												echo "<tr><td>MUM00000".$user_data['can_id']."</td><td>".get_user_name_by_id($value['created_by'])."</td><td>".get_user_job_profile($user_data['job_profile'])."</td><td>".date('Y/m/d',strtotime($value['created_on']))."</td><td>".$value['kra_name']."</td><td>".$value['month']."</td><td>".$action."</td><td><a href='javascript:;' onClick='delete_kra('')'  class='tabledit-delete-button btn-danger btn btn-sm btn_delete' id='delete_candidat'><span class='glyphicon glyphicon-trash'></span></a></td></tr>";
											}?>
										</tbody>
										
									</table>
								</div>
					</div><!--.tab-pane-->
					<div role="tabpanel" class="tab-pane fade" id="tabs-2-tab-2">
						<div class="kra_approvaltab result kra_team_list" >
									<table id="" class="table-responsive display table table-bordered table-striped" cellspacing="0" width="100%">
										<thead>
										<tr>
											<th style="width:10%">Emp Code</th>
											<th style="width:20%">Review</th>
											<th style="width:10%">Month</th>
											<th style="width:15%">Assigned By</th>
											<th style="width:15%">Assigned On</th>
											<th style="width:15%">Status</th>
											<th style="width:15%">Action</th>
										</tr>
										</thead>

										<tbody>
											
										</tbody>
										
									</table>
								</div>
					</div><!--.tab-pane-->
					<div role="tabpanel" class="tab-pane fade" id="tabs-2-tab-3">

						<div class="kra_selftab">
									<table id="kra_self_list" class="table-responsive display table table-bordered table-striped" cellspacing="0" width="100%">
										<thead>
										<tr>
											<th style="width:10%">Emp Code</th>
											<th style="width:25%">Assigned By</th>
											<th style="width:10%">Designation</th>
											<th style="width:15%">Assigned On</th>
											<th style="width:10%">Review</th>
											<th style="width:5%">Month</th>
											<th style="width:20%">Action</th>
										</tr>
										</thead id="kra_self_list" >

										<tbody class="kra_self_list">
										
									</table>
								</div>
					</div><!--.tab-pane-->				
				</div><!--.tab-content-->
			</section><!--.tabs-section-->
			
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
									 	echo "<input class='emplyee_ids1' type='checkbox' name='user_list[]' value='".$value['can_id']."'>".$value['can_name']."<br>";		
										
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

			<div class = "modal fade" id = "myModal1" tabindex = "-1" role = "dialog" 
			   aria-labelledby = "myModalLabel" aria-hidden = "true">
			   
			   <div class = "modal-dialog">
			      <div class = "modal-content">
			         
			         <div class = "modal-header">
			            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
			                  &times;
			            </button>
			            
			            <h4 class = "modal-title" id = "myModalLabel">
			              Select Entities
			            </h4>
			         </div>
			         
			         <div class = "modal-body">
			           <div class="row">
							<div class="col-lg-3" align="right">
								<input type='checkbox' id="select_all_entities" onClick="check_uncheck_checkbox(this.checked);">Select All
							</div>
							<div class="col-lg-9">
								<div id="cblist">
								<?php 
									foreach ($kra_entities as $key => $value) {
										echo "<input class='entity_ids' type='checkbox' name='entity_ids[]' value='".$value['kra_entity_id']."'>".$value['name']."<br>";		
										$last_id=$value['kra_entity_id'];	
									}
								?>
								</div>
								<input type="hidden" name="" value="<?php echo $last_id?>" id='last_id'>
								<input type="text" id="txtName" />
								<input type="button" id="addCheckbox" value="Add">
								
								<span id="entity-error"></span>
							</div>
						</div>
			         </div>
			         
			         <div class = "modal-footer">
			            <button type = "button" class = "btn btn-default" data-dismiss = "modal">
			               Close
			            </button>
			            
			            <button id='save_kra' type = "button" class = "btn btn-primary">
			               Save KRA
			            </button>
			         </div>
			         
			      </div><!-- /.modal-content -->
			   </div><!-- /.modal-dialog -->
			  
			</div><!-- /.modal -->
					

		</div>
	</div>
</div>

<script type="text/javascript">
	$(".chosen-select").chosen();
	 $(document).ready(function() {
    $('#addCheckbox').click(function() {
     	
        var text = $('#txtName').val();
      	var last_id=$('#last_id').val();
       if(text!='')
       {
       		$.ajax({
					url: '<?php echo site_url();?>/kra/add_kra_entity/',
					dataType :"json",
					data : {text: text},
					type: 'POST',
					success: function(response){
						if(response.id!='')
						{
							$('#cblist').append('<input class="entity_ids" value="'+last_id+'" name="entity_ids[]" type="checkbox" /> ' + text + '<br />');
       						$('#txtName').val('');
       						$('#last_id').val(response.id);		
       					}
       					else
       					{
       						swal(response.msg);
       					}

					}
				});
       			
       		
       }
    });
});

function addCheckbox(name) {
   var container = $('#cblist');
   var inputs = container.find('input');
   var text = $('#txtName').val();

       $('#cblist').append('<br><input id="" type="checkbox" /> ' + hi + '<br />');
  
}
	 $(document).ready(function() {  
    	$(".chosen-select").attr('disabled', true).trigger("chosen:updated")
    	$("#emplyee").attr('disabled', true);
    	$("#department1").attr('disabled', true);
    });
	 $(".assign_btn").click(function() {
			$('#kra_id').val($(this).attr('id'));
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
					}
				});
		}
		else
		{

			$('.form').css('display','none');				
		}
	});

</script>
<script type="text/javascript">
	$('#openBtn').click(function(){
  	$('#myModal').modal('show');
	});
</script>
<script type="text/javascript">
	$(".chosen-select").chosen();

	 $(document).ready(function() {

	 	$(".chosen-select").attr('disabled', true).trigger("chosen:updated")
    	$("#emplyee").attr('disabled', true);
    	$("#department1").attr('disabled', true);
    	
	 	$("#select_all").change(function(){  //"select all" change
			var status = this.checked; // "select all" checked status
			$('.emplyee_ids').each(function(){ //iterate all listed checkbox items
			this.checked = status; //change ".checkbox" checked status
			});
			});
	 	$("#select_all_entities").change(function(){  //"select all" change
			var status = this.checked; // "select all" checked status
			$('.entity_ids').each(function(){ //iterate all listed checkbox items
			this.checked = status; //change ".checkbox" checked status
			});
			});
	 	
	$("#save_kra").on('click',function() {
		 kra_title=$("#review_type option:selected").val();
		  var fields = $("input[class='entity_ids']").serializeArray();
		 var month=$("#month option:selected").val();
		 var emplyee_id=$("#employee_select option:selected").val();

		 if(kra_title=='')
		 {
		 	swal("Please Select Review Type","","error");
		 }
		 else if(month=='')
		 {
		 	swal("Please Select Month","","error");
		 }
		 else if(fields=='')
		 {
		 	swal("Please select atleast one entity","","error");
		 }
		 else
		 {
		 	$('#select_all').removeAttr('checked');
		 	$.ajax({
					url: '<?php echo site_url();?>/kra/save_kra_manager/',
					dataType :"json",
					data : {'kra_title':kra_title,'entity_ids':fields,'month':month},
					type: 'POST',
					success: function(response){
						if(response!='')
						{
							swal("Done!", "Kra Has Been Added Successfully!", "success");
							$('#kra_id').val(response);
							$('#myModal1').modal('hide');
							$('#select_all_entities').prop('checked', false); // Unchecks it
		 					$('#select_all_entities').trigger("change");
							

						}
						else
						{
							$('#title-error').html('<p style="color:red" id="msg">Already Exist</p>');	
						}
					}
				});
		 }
		//alert('ok');
	});
	$("#assign_kra").on('click',function() {
	 	 
	 	 kra_id=$("#kra_id").val();
		  var fields = $("input[class='emplyee_ids1']").serializeArray();
		 if(fields=='')
		 {
		 	swal("Please select atleast one employee","","error");
		 }
		 else
		 {
		 	//$('#select_all').removeAttr('checked');
		 	$.ajax({
					url: '<?php echo site_url();?>/kra/save_assign_kra/',
					//dataType :"",
					data : {'kra_id':kra_id,'employee_ids':fields},
					type: 'POST',
					success: function(response){
						if(response==1)
						{
							$('#name_kra').modal('hide');
							swal("Done!", "Kra Has Been Assigned Successfully!", "success");
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
	$("#team_evaluation").click(function() {
		$.ajax({
					url: '<?php echo site_url();?>/kra/get_team_kra/',
					dataType :"json",
					type: 'POST',
					success: function(response){
						$('.kra_team_list').html(response.can_list);
					}
				});
	});
	$("#self_evaluation").click(function() {
		$.ajax({
					url: '<?php echo site_url();?>/kra/get_self_kra/',
					dataType :"json",
					type: 'POST',
					success: function(response){
						$('.kra_self_list').html(response.can_list);
					}
				});
	});
	

	 $("#assigned_kra").click(function() {
			$.ajax({
					url: '<?php echo site_url();?>/kra/get_assigned_kra_list/',
					dataType :"json",
					type: 'POST',
					success: function(response){
						$('.assigned_kra_list').html(response.can_list);
					}
				});
		});
    });
	 
	 $(".assign_btn").click(function() {
			$('#kra_id').val($(this).attr('id'));
		});
	 
	$("#review_type").change(function() {
		review_type=$("#review_type option:selected").val();
		if(review_type!='')
		{
			$(".chosen-select").attr('disabled', false).trigger("chosen:updated")
    		$("#emplyee").attr('disabled', false);
    		$("#department1").attr('disabled', false);	
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

function delete_kra_emp(id,can_id)
{
	swal({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then(function () {
		$.ajax({
			url: '<?php echo site_url();?>/kra/delete_kra_emp/',
			dataType :"json",
			data : {id: id,can_id:can_id},
			type: 'POST',
			success: function(response){
				if(response == true)
				{
					swal("Done", "Record deleted successfully", "success");
				}
				else
				{
					swal("Opps", "Something went wrong...", "error");
				}
				$('#team_evaluation').trigger('click');
			}
		});
	});
}

function delete_kra(id)
{
	swal({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then(function () {
		$.ajax({
			url: '<?php echo site_url();?>/kra/delete_kra/',
			dataType :"json",
			data : {id: id},
			type: 'POST',
			success: function(response){
				if(response == true)
				{
					swal({
						title : "Done",
						message : "Record deleted successfully",
						type : "success"
					}).then(function() {
						window.location.reload();
					});
				}
				else
				{
					swal("Opps", "Something went wrong...", "error");
				}
				$('#assigned_kra').trigger('click');
			}
		});
	});
}
</script>



