<body class="with-side-menu-addl-full">
<?php if($this->session->flashdata('success')){
	?>
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
<?php if($this->session->flashdata('warning')){
	?>
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
							<a href="<?php echo site_url();?>/candidate/register">
								<button class="btn btn-inline check-all" data-style="expand-right">
								<span><i class="fa fa-plus"></i> Add Employee </span>
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
							<th style="width:10%">Emp Id</th>
							<th style="width:10%">Name</th>
							<th style="width:20%">Email</th>
							<th style="width:15%">Contact</th>
							<th style="width:20%">Designation</th>
							<th style="width:10%">Is Active</th>
							<th style="width:15%">Action</th>
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
	function delete_can(can_id)
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
				url: '<?php echo site_url();?>/candidate/delete',
				data : {can_id: can_id},
				type: 'POST',
				success: function(response){
						var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Candidate Deleted Successfully!';
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

		function get_candidate()
		{
			var id = '<?php echo $this->uri->segment(3); ?>';
			oTable = $('#candidate_list').DataTable({
			language: {
			     processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
			  },
				'responsive': true,
				'bProcessing'    : true,
				'bServerSide'    : true,
				"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
				'sPaginationType': 'full_numbers',
				"aoColumns": [
					{"sName": "emp_code", "mData": "emp_code" ,"bSortable":true},
					{"sName": "can_name", "mData": "can_name" ,"bSortable":true},
					{"sName": "email", "mData": "email" ,"bSortable":true},
					{"sName": "phone1", "mData": "phone1" ,"bSortable":false},
					{"sName": "job_profile", "mData": "job_profile" ,"bSortable":false},
					{"sName": "is_active", "mData": "is_active" ,"bSortable":false},
					{"sName": "Action", "mData": "edit" ,"bSortable":false,"bSearchable":false}
				],

				"language": {
			    	processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
			  	},
				'sAjaxSource'    : '<?php echo site_url();?>'+'/candidate/list_candidate',

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
				'createdRow': function(row, data, index) {
					var view_url='<?php echo site_url()."/candidate/view/";?>'+data.can_id;
					$row_active='<a  href="<?php echo site_url().'/candidate/update/' ?>'+data.can_id+'" class="tabledit-edit-button btn btn-success btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;"  onClick="activate_can('+data.can_id+')"  class="tabledit-delete-button btn-success btn btn-sm btn_delete " id="activate_candidate_$1" >Activate</a>';

					$row_delete='<a  href="<?php echo site_url().'/candidate/update/' ?>'+data.can_id+'" class="tabledit-edit-button btn btn-success btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_can('+data.can_id+')"  class="tabledit-delete-button btn-danger btn btn-sm btn_delete" id="delete_candidate_$1"><span class="glyphicon glyphicon-trash"></span></a> <a href="'+view_url+'" class="tabledit-view-button btn btn-primary btn-sm btn_edit" ><span class="glyphicon glyphicon-eye-open" ></span></a>';
					if(data.is_active=='Yes')
					{
						$('td', row).eq(6).html($row_delete);
						//$('#delete_candidate_'+data.can_id).attr('hidden');
					}
					else
					{
						$('td', row).eq(6).html($row_active);
						//$("#activate_candidate_"+data.can_id+"").attr('hidden');;
					}
					
      			},
				
			});
		}


	$(document).ready(function() {
		get_candidate();
	});

	</script>



