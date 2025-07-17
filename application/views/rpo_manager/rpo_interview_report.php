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
						<table class="table table-responsible">
							<tbody>
								<tr>
									<td >From Date</td>
									<td >To Date</td>
									<td >Interview Status</td>
									<td rowspan="2" class="text-center"><button type="button" name="create_query" id="create_query" class="btn btn-primary">Generate Report</button></td>

								</tr>
								<tr>
									<td><input type="text" name="from_date" id="from_date"  ></td>
									<td><input type="text" name="to_date" id="to_date" data-date-start-date="" ></td>
									<td><select id="interview_status" name="interview_status" >
										<option value="" selected >Select Interview Status</option>
										<option value="selected">Selected</option>
								    	<option value="rejected">Rejected</option>
								    	<option value="onhold">On Hold</option>
								    	<option value="upcoming_interviews">Upcoming Interviews</option>
								    	<option value="upcoming_joining">Upcoming Joining</option>
									</select></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table class="table table-responsible" style="margin-top: 50px;">
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
				</div><br>
				
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

  		$("#create_query").click(function(){
  			 $("#report_table").children().remove();
  			var from_date=$("#from_date").val();
  			var to_date=$("#to_date").val();
  			var interview_status=$("#interview_status").val();
  			
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
	  				data:{'from_date':from_date,'to_date':to_date,'interview_status':interview_status},
	  				dataType:'JSON',
	  				success:function(output){
	  					$row='';
	  					if(output==""){
	  						$row='<tr><td colspan="5"><h3 class="text-center">No Records Found</h3></td></tr>';
	  						$("#report_table").append($row);
	  					}
	  					
	  					$.each(output,function(index,arrvalue){
	  						$row='<tr><td>'+arrvalue.can_name+'</td><td>'+arrvalue.email_id+'</td><td>'+arrvalue.mobile_no+'</td><td>'+arrvalue.interview_status+'</td>';
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