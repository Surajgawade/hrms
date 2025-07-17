<body class="with-side-menu-addl-full">
	<div class="page-content">
		<div>
		<?php if($this->session->flashdata('success')){?>
			<script type="text/javascript">
				var message_text='<?php echo $this->session->flashdata('success');?>';
					$.notify({
								title: "<strong>Success</strong> ",
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
	</div>
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>Interview Task Assigned List</h2>
						</div>
						<div class="add_btn col-md-2">
							
						</div>
					</div>
				</div>
			</header>
			
			<section class="card">
				<div class="card-block">
					<table id="resource_request_list" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th style="width:10%">Date</th>
							<th style="width:10%">Resource Type</th>
							<th style="width:25%">Job Description</th>
							<th style="width:15%">Keywords</th>
							<th style="width:10%">No Of Positions</th>							
							<th style="width:10%">Budget</th>
							<th style="width:5%">Actions</th>
							<th style="width:10%">Assign</th>
						</tr>
						</thead>
						<tbody>
							
						</tbody>
						
					</table>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->	
	<script>
		$(document).ready(function() {
			$(".chosen-select").chosen();
			get_interview_list();
		});	
			
		function get_interview_list()
		{
			var id = '<?php echo $this->uri->segment(3); ?>';
			oTable = $('#resource_request_list').DataTable({
			
				'responsive': true,
				'bProcessing': true,
				'bServerSide': true,
				'language': {
			     processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
			  	}, 
				"bAutoWidth" : true,
				"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
				'sPaginationType': 'full_numbers',
				"aoColumns": [
					{"sName": "created_on", "mData": "created_on" ,"bSortable":true},
					{"sName": "title", "mData": "title" ,"bSortable":true},
					{"sName": "job_description", "mData": "job_description" ,"bSortable":true},
					{"sName": "keywords", "mData": "keywords" ,"bSortable":true},					
					{"sName": "no_of_positions", "mData": "no_of_positions" ,"bSortable":true},
					{"sName": "budget", "mData": "budget" ,"bSortable":true},
					{"sName": "Action", "mData": "edit" ,"bSortable":false,"bSearchable":false},
					{"sName": "Assign", "mData": "assign" ,"bSortable":false,"bSearchable":false}
				],

				"createdRow": function ( row, data, index )
				{
					var created_on = format_date(data.created_on);
					$('td', row).eq(0).text(created_on);
					if(data.count>=data.no_of_positions){
						can_status='Resource Closed';
						$('td', row).eq(7).text(can_status);
					}
        		},
				'sAjaxSource'    : '<?php echo site_url();?>'+'/interview/interview_list	',
				'fnServerData': function(sSource, aoData, fnCallback)
				{
					$.ajax
					({
						'dataType': 'json',
						'type'    : 'POST',
						'url'     : sSource,
						'data'    : aoData,
						'success' : fnCallback
					});
				}
			});
		}

		function add_candidate(int_task_id){
			$.ajax({
				url:'<?php echo site_url();?>/interview/add_edit',
				data:{int_task_id:int_task_id},
				type:'POST',

			});
		}

		
	</script>



