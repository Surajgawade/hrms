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
							<h2>Resource Request List</h2>
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/resource_request/add_edit">
								<button class="btn btn-inline btn-primary ladda-button" data-style="expand-right">
								<span class="ladda-label">Add New</span>
								<span class="ladda-spinner"></span>
								<div class="ladda-progress" style="width: 0px;"></div>
							</button>
							</a>
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
							<th style="width:10%">Job Description</th>
							<th style="width:10%">Keywords</th>
							<th style="width:10%">No Of Positions</th>							
							<th style="width:10%">Budget</th>							
							<th style="width:10%">Status</th>
							<th style="width:10%">Actions</th>
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
			get_resource_request_list();
		});	
			
		function get_resource_request_list()
		{
			var id = '<?php echo $this->uri->segment(3); ?>';
			oTable = $('#resource_request_list').DataTable({
			
				'responsive': true,
				'bProcessing'    : true,
				'bServerSide'    : true,
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
					{"sName": "request_status", "mData": "request_status" ,"bSortable":false},
					{"sName": "Action", "mData": "edit" ,"bSortable":false,"bSearchable":false}
				],

				"createdRow": function ( row, data, index )
				{
					var created_on = format_date(data.created_on);
					$('td', row).eq(0).text(created_on);
					if(data.request_status==0){
						request_status='Pending';
					}else if(data.request_status==1){
						request_status='Accepted';
					}else if(data.request_status==3){
						request_status='Pending for Approval';
					}else{
						request_status='Rejected';						
					}
					$('td', row).eq(6).text(request_status);

        		},
				'sAjaxSource'    : '<?php echo site_url();?>'+'/resource_request/list_request	',
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

		function delete_request(request_id)
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
					url: '<?php echo site_url();?>/resource_request/delete_request',
					data : {request_id: request_id},
					type: 'POST',
					success: function(response){
						var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Resource Request Deleted Successfully!';
							title ='Success';
						}
						else
						{
							type ='warning';
							message ='Access Denied';
							title ='Warning';

						}
						$.notify({
								title: "<strong>"+title+"</strong> ",
								message: message,	
							},
							{
								type: type,
								delay: 800,
								animate:{
									enter: "animated fadeInUp",
									exit: "animated fadeOutDown"
								} 
						});		
					}
				});
				oTable.draw();
			    window.setTimeout(function(){location.reload()},2000);
				return true;
			});
		}
	</script>



