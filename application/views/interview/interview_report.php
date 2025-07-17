<div class="page-content">
	<?php if($this->session->flashdata('success')){?>
		<script type="text/javascript">
			var message_text='<?php echo $this->session->flashdata('success');?>';
				$.notify({
						title: "<strong>Success:</strong> ",
						message: message_text,
					},
					{
						type: "success",
						delay: 800,
						animate:{
						enter: "animated fadeInUp",
						exit: "animated fadeOutDown"
						}
					});
		</script>
	<?php }?>
	
<div class="container-fluid">
	
	<div class="well">
			<form action="" id="interview_form" name="interview_form" method="post" data-toggle="validator">
				<h1 class="well headline">Report Generator</h1>
				<div class="col-sm-12 col-xs-12 profile_bg">
						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">From Date </label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date">
										<i class="fa fa-calendar"></i>
										
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">To Date</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<input type="text" name="to_date" id="to_date" data-date-start-date="" class="form-control" placeholder="To Date">
										<i class="fa fa-calendar"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Interview Status</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select id="interview_status" name="interview_status" class="form-control select2-arrow manual select2-no-search-arrow" >
										<option value="" selected >Select Interview Status</option>
										<option value="selected">Selected</option>
								    	<option value="rejected">Rejected</option>
								    	<option value="onhold">On Hold</option>
								    	<option value="upcoming_interviews">Upcoming Interviews</option>
								    	<option value="upcoming_joining">Upcoming Joining</option>

									</select>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-3 col-xs-12">
								<div class="form-group">
									<label class="form-label">Sub Coordinates</label>
								</div>
							</div>
						
							<div class="col-lg-4 col-sm-9 col-xs-12">
								<div class="form-group">
									<div class="form-control-wrapper form-control-icon-right">
										<select id="created_by" name="created_by" class="form-control select2-arrow manual select2-no-search-arrow">
										<option value="">Select Sub Coordinates</option>
									</select>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<button type="button" name="create_query" id="create_query" class="btn btn-primary">Generate Report</button>
							</div>							
						</div>


						<table class="display table table-bordered table-striped dataTable no-footer dtr-inline" style="margin-top: 20px;">
							<thead>
								<tr>
									<th>Candidate Name</th>
									<th>Candidate Email</th>
									<th>Candidate Number</th>
									<th>Interview Status</th>	
									<th id="jd">Joining Date</th>
								</tr>
							</thead>
							<tbody id="report_table">
								
							</tbody>
						</table>
					</div>
			
				
			</form>
	</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('#from_date,#to_date').datepicker({
			format: 'yyyy-mm-dd',
			maxDate: new Date()
		});
  		$("#jd").hide();

  		$.ajax({
			url:'<?php echo site_url(); ?>/interview/get_reporting',
			dataType:'JSON',
			success:function(output){
				$row='';
				$.each(output,function(index,arrvalue){
					$row='<option value="'+arrvalue.can_id+'">'+arrvalue.can_name+'</option>';
					$("#created_by").append($row);
				});
			}
		});

  		$("#create_query").click(function(){
  			 $("#report_table").children().remove();
  			var from_date=$("#from_date").val();
  			var to_date=$("#to_date").val();
  			var interview_status=$("#interview_status").val();
  			var created_by=$("#created_by").val();
  			if(interview_status=="null"){
  				interview_status="";
  			}
  			if(from_date=="" || to_date==""){
  				type ='warning';
				message ='Select from date and end date properly!';
				title ='Warning:';
  			} 
  			else if(from_date >= to_date){
  				type ='warning';
				message ='End date should not be less than from date!';
				title ='Warning:';
  			}
  			else{
  				$.ajax({
	  				url:'<?php echo site_url();?>/interview/interview_report_fetch',
	  				type:'POST',
	  				data:{'from_date':from_date,'to_date':to_date,'interview_status':interview_status,'created_by':created_by},
	  				dataType:'JSON',
	  				success:function(output){
	  					console.log(output);
	  					$row='';
	  					if(output==""){
	  						$row='<tr><td colspan="5"><h3 class="text-center">No Records Found</h3></td></tr>';
	  						$("#report_table").append($row);
	  					}
	  					
	  					$.each(output,function(index,arrvalue){
	  						$row='<tr><td>'+arrvalue.full_name+'</td><td>'+arrvalue.email_id+'</td><td>'+arrvalue.mobile_no+'</td><td>'+arrvalue.interview_status+'</td>';
	  						if(arrvalue.joining_date==null){
	  							arrvalue.joining_date="No date found";
	  						}
	  						if(arrvalue.interview_status=='selected' || arrvalue.interview_status=='onhold'){
	  							$row+='<td>'+arrvalue.joining_date+'</td></tr>';
	  							$("#jd").show();
	  						}else{
	  							$("#jd").hide();
	  						}
	  						$("#report_table").append($row);
	  					});
	  				}
	  			});
  			}
  			
  			$.notify({
	            title: title,
	            message: message,        
	        },{
		        type: type,
		        delay: 800,
		            animate:{
		                enter: "animated fadeInUp",
		                exit: "animated fadeOutDown"
		            } 
		    });
  		});

  		
	});

</script>