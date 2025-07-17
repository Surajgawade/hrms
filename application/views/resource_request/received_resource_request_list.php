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
	</div>
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>Received Resource Request List</h2>
						</div>
					</div>
				</div>
			</header>
			
			<section class="card">
				<div class="card-block">
					<table id="received_resource_request_list" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th style="width:10%">Date</th>
							<th style="width:10%">Requested By</th>
							<th style="width:10%">Designation</th>
							<th style="width:10%">Resource Type</th>
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
			get_received_resource_request_list();
		});	
			
		function get_received_resource_request_list()
		{
			var id = '<?php echo $this->uri->segment(3); ?>';
			oTable = $('#received_resource_request_list').DataTable({
			
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
					{"sName": "can_name", "mData": "can_name" ,"bSortable":true},
					{"sName": "designation", "mData": "designation" ,"bSortable":true},
					{"sName": "title", "mData": "title" ,"bSortable":true},
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
				'sAjaxSource'    : '<?php echo site_url();?>'+'/resource_request/list_received_request	',
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

		function process_request(request_id,status)
		{
			var text ='';
			var confirmButtonText ='';
			if(status==1)
			{
				text = "You want to approve this!";
				confirmButtonText = 'Yes, approve it!';
			}
			else
			{
				text = "You want to reject this!";
				confirmButtonText = 'Yes, reject it!';
			}
			swal({
				title: 'Are you sure?',
				text: text ,
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: confirmButtonText
			}).then(function () {
				$.ajax({
					url: '<?php echo site_url();?>/resource_request/process_request',
					data : {request_id: request_id,request_status:status},
					type: 'POST',
					success: function(response){
						var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Resource Request Processed Successfully!';
							title ='Success';
						}/*
						else if(response==2)
						{
							type ='success';
							message ='Resource Request Rejected Successfully!';
							title ='Success';
						}*/
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



