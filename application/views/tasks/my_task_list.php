
	<div class="page-content">
		<div>
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
	</div>
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>My Task List</h2>
						</div>
					</div>
				</div>
			</header>
			
			<section class="card">
				<div class="card-block">
					<table id="my_task_list" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:15%">Task Name</th>
								<th style="width:15%">Description</th>
								<th style="width:15%">Tat</th>
								<th style="width:15%">Time</th>
								<th style="width:15%">Priority</th>
								<th style="width:15%">Assigned By</th>
								<th style="width:15%">Status</th>
								<th style="width:10%">Action</th>
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
		$(function() {
		$(".chosen-select").chosen();
			
			$('#my_task_list').dataTable
			({
				'responsive': true,
				'bProcessing'    : true,
				'bServerSide'    : true,
				'language': {
					processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
			  	},
				"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
				'sPaginationType': 'full_numbers',
				"aoColumns": [
					// {"sName": "can_id", "mData": "can_id" ,"bSortable":true},
					{"sName": "task_name", "mData": "task_name" ,"bSortable":true},
					{"sName": "task_description", "mData": "task_description" ,"bSortable":true},
					{"sName": "tat", "mData": "tat" ,"bSortable":true},
					{"sName": "time", "mData": "time" ,"bSortable":true},
					{"sName": "priority", "mData": "priority" ,"bSortable":true},
					{"sName": "can_name", "mData": "can_name" ,"bSortable":true},
					{"sName": "status", "mData": "status" ,"bSortable":true},
					{"sName": "Action", "mData": "edit" ,"bSortable":false,"bSearchable":false}
				],
				'sAjaxSource'    : '<?php echo site_url();?>'+'/task/list_my_task',
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
			//.fnFilterOnReturn()
		});	
	</script>



