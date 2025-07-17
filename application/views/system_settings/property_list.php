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
							<h2>Property List</h2>
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/system_settings/create_property">
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
					<table id="property_list" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:10%">Department Name</th>
								<th style="width:10%">Property Name</th>
								<th style="width:10%">Quantity</th>
								<th style="width:10%">Purchase Price</th>
								<th style="width:10%">Penalty</th>
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
		get_property();
	});	
		
	function get_property()
	{
		$.ajax({
			url:'<?php echo site_url();?>'+'/system_settings/property_list',
			dataType:"json",
			success:function(response){
				if(response.length != 0)
				{
					$.each(response,function(key,val){
						if(val.status==1){
							var status="Available";
						}else{
							status="Not Available";
						}
						var update_url ='<?php echo site_url();?>/system_settings/update/'+val.prop_id;
	   					var view_url='<?php echo site_url(); ?>/system_settings/view/'+val.prop_id;
						var row='<tr><td>'+val.dept_name+'</td><td>'+val.prop_name+'</td><td>'+val.quantity+'</td><td>'+val.purchase_price+'</td><td>'+val.penalty+'</td><td>'+status+'</td><td><a href="'+update_url+'" class="tabledit-edit-button btn btn-success btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a> <a href="javascript:;" onClick="delete_menu('+val.prop_id+')"  class="tabledit-delete-button btn-danger btn btn-sm btn_edit" > <span class="glyphicon glyphicon-trash"></span></a></td></tr>';
						$("#property_list").prepend(row);
					});
				}
				else
				{
					$("#property_list").prepend('<tr><td colspan="7" class="text-center"><span class="h3 text-danger">No records found.</span></td></tr>');
				}
			}
		});
	}

	function delete_menu(prop_id)
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
				url:'<?php echo site_url();?>'+'/system_settings/delete_property',
				type:'POST',
				dataType:"json",
				data:{'prop_id':prop_id},
				success:function(response){
					var type='' ;
					var message='' ;
					var title='' ;
					if(response==1){
						type ='success';
						message ='Property Deleted Successfully!';
						title ='Success';
					}
					else{
						type ='warning';
						message ="Access Denied";
						title ='warning'; 

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
					window.setTimeout(function () {
						window.location.href = '<?php echo site_url();?>/system_settings/employee_properties'
					}, 2000);
				},
				error:function(error){
					console.log(error.responseText);
				}
			});
		});
	}

	</script>



