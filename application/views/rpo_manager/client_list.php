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
							<h2>RPO Client List</h2>
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/rpo_manager/add_edit_client">
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
					<table id="interview_canlist" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:15%">Client name</th>
								<th style="width:15%">Mobile No</th>
								<th style="width:15%">Contract Status</th>
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
	$(document).ready(function() {
			$(".chosen-select").chosen();
			get_clients();
		});	
			
	function get_clients()
		{
			var id = '<?php echo $this->uri->segment(3); ?>';
			oTable = $('#interview_canlist').dataTable({
				'responsive': true,
				'bProcessing'    : true,
				'bServerSide'    : true,
				"language": {
			    	processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
			  	},
				"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
				'sPaginationType': 'full_numbers',
				"aoColumns": [
					{"sName": "client_name", "mData": "client_name" ,"bSortable":true},
					{"sName": "contact_number", "mData": "contact_number" ,"bSortable":true},
					{"sName": "contract_status", "mData": "contract_status" ,"bSortable":true},
					{"sName": "Action", "mData": "edit" ,"bSortable":false,"bSearchable":false},
				],
				'sAjaxSource'    : '<?php echo site_url();?>'+'/rpo_manager/client_list_fetch',
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

		function delete_client(client_id)
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
					url: '<?php echo site_url();?>/rpo_manager/delete_client',
					data : {client_id: client_id},
					type: 'POST',
					success: function(response){
						var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='RPO Client Deleted Successfully!';
							title ='Success';
						}
						else
						{
							type ='warning';
							message ="Access Denied";
							title ='Warning'; 

						}
						$.notify({
								title: title,
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
						window.setTimeout(function(){location.reload()},2000);
					}

				});
				oTable.draw();				
				return true;			
			});
		}
	</script>