<body class="with-side-menu-addl-full">
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
	<div class="page-content">
		<div class="container-fluid">
			<?php if($this->session->flashdata('error')){?>
						<div class="alert alert-warning alert-no-border alert-close alert-dismissible fade show" role="alert">
						 <?php echo $this->session->flashdata('error');?>
						</div>
			<?php }?>
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>Employee List</h2>
							<!-- <div class="subtitle">Welcome to Ultimate Dashboard</div> -->
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/system_settings/add_user">
								<button class="btn btn-inline btn-primary ladda-button" data-style="expand-right">
								<span class="ladda-label">Add Users</span>
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
					<table id="candidate_list" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
						<tr>
							<!-- <th style="width:3%">id</th> -->
							<th style="width:15%">Name</th>
							<th style="width:15%">Email</th>
							<th style="width:15%">Is Active</th>
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
	var oTable;
	function delete_user(user_id)
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
				url: '<?php echo site_url();?>/system_settings/delete_user',
				data : {user_id: user_id},
				type: 'POST',
				success: function(response){
						var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='User Deleted Successfully!';
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
			//window.setTimeout(function(){location.reload()},2000);
			return true;
		});	
	}

	function activate_can(can_id)
	{
		swal({
			title: 'Are you sure?',
			text: "You Want To Activate This Employee!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Activated it!'
		}).then(function () {
			$.ajax({
				url: '<?php echo site_url();?>/candidate/activate',
				data : {can_id: can_id},
				type: 'POST',
				success: function(response){
						var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Candidate Activated successfully!';
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
			// window.setTimeout(function(){location.reload()},3000);
			return true;
		});	
	}

		function get_users()
		{
			var id = '<?php echo $this->uri->segment(3); ?>';
			oTable = $('#candidate_list').DataTable({
			
				'responsive': true,
				'bProcessing'    : true,
				'bServerSide'    : true,
				"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
				'sPaginationType': 'full_numbers',
				"aoColumns": [
					// {"sName": "can_id", "mData": "can_id" ,"bSortable":true},
					{"sName": "user_name", "mData": "user_name" ,"bSortable":true},
					{"sName": "email", "mData": "email" ,"bSortable":true},
					{"sName": "is_active", "mData": "is_active" ,"bSortable":false},
					{"sName": "Action", "mData": "edit" ,"bSortable":false,"bSearchable":false}
				],
				"language": {
			    	processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
			  	},
				'sAjaxSource'    : '<?php echo site_url();?>'+'/system_settings/list_users',
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
				},
				
			});
		}


	$(document).ready(function() {
		get_users();
	});

	function showMessage()
	{
		return "hello";
	}
	</script>



