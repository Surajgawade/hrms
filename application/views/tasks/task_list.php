<body class="with-side-menu-addl-full">
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
							<h2>Task List</h2>
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/task/create_task">
								<button class="btn btn-inline btn-primary ladda-button" data-style="expand-right">
								<span class="ladda-label">Add Task</span>
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
					<table id="task_list" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:15%">Task Name</th>
								<th style="width:15%">Description</th>
								<th style="width:15%">Date</th>
								<th style="width:15%">Time</th>
								
								<th style="width:15%">Priority</th>
								<!-- <th style="width:15%">Assigned To</th> -->
								<th style="width:10%">Action</th>
								<th style="width:10%">Assign Task</th>
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
			get_task();
		});	
			
		function get_task()
		{
			var id = '<?php echo $this->uri->segment(3); ?>';
			oTable = $('#task_list').DataTable({
			
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
					// {"sName": "can_id", "mData": "can_id" ,"bSortable":true},
					{"sName": "task_name", "mData": "task_name" ,"bSortable":true},
					{"sName": "task_description", "mData": "task_description" ,"bSortable":true},
					{"sName": "tat", "mData": "tat" ,"bSortable":true},
					{"sName": "time", "mData": "time" ,"bSortable":true},
					{"sName": "priority", "mData": "priority" ,"bSortable":true},
					// {"sName": "can_ids", "mData": "can_ids" ,"bSortable":true},
					{"sName": "Action", "mData": "edit" ,"bSortable":false,"bSearchable":false},
					{"sName": "Assign Task", "mData": "assign_task" ,"bSortable":false,"bSearchable":false}
				],
				'sAjaxSource'    : '<?php echo site_url();?>'+'/task/list_task',
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

		function delete_task(task_id)
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
					url: '<?php echo site_url();?>/task/delete_task',
					data : {task_id: task_id},
					type: 'POST',
					success: function(response){
						//$('.msg').text(response.msg);	
						var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Task Deleted Successfully!';
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
				// $.notify({
				// 	type: 'success',
				// 	title: "<strong>Success:</strong> ",
				// 	message: "Task deleted successfully!",
				// 	delay: 2000,
				// 	animate:{
				// 		enter: "animated fadeInUp",
				// 		exit: "animated fadeOutDown"
				// 	}
				// });
				oTable.draw();
				// window.setTimeout(function(){location.reload()},3000);
				return true;
			});
		}
			/*if(!confirm('Are you sure?')){
				e.preventDefault();
				return false;
			}
			else
			{
				var  task_id = $(this).val();
				$.ajax({
					url: '<?php //echo site_url();?>/task/delete',
					data : {task_id: task_id},
					type: 'POST',
					success: function(response){
						$('.msg').text(response.msg);				
					}
				});
				$.notify({
							type: 'success',
							title: "<strong>Success:</strong> ",
							message: "Task deleted successfully!",
							delay: 2000,
							animate:{
								enter: "animated fadeInUp",
								exit: "animated fadeOutDown"
							}
						});
				window.setTimeout(function(){location.reload()},3000);
			return true;	
			}
      });*/
	
	</script>



