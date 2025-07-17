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
							<h2>Widget List</h2>
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/system_settings/add_widget">
								<button class="btn btn-inline btn-primary ladda-button" data-style="expand-right">
								<span class="ladda-label">Add Widget</span>
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
					<table id="widget_list" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:25%">Widget Name</th>
								<th style="width:25%">Description</th>

								<th style="width:25%">Is Active</th>
								<th style="width:25%">Actions</th>
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
			get_widgets();
		});	
			
		function get_widgets()
		{
			var id = '<?php echo $this->uri->segment(3); ?>';
			oTable = $('#widget_list').DataTable({
			
				'responsive': true,
				'bProcessing'    : true,
				'bServerSide'    : true,
				'language': {
			     processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
			  	}, 
				"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
				'sPaginationType': 'full_numbers',
				"aoColumns": [
					{"sName": "widget_name", "mData": "widget_name" ,"bSortable":true},
					{"sName": "widget_description", "mData": "widget_description" ,"bSortable":true},
					{"sName": "is_active", "mData": "is_active" ,"bSortable":true},
					{"sName": "Action", "mData": "edit" ,"bSortable":false,"bSearchable":false},
				],
				'sAjaxSource'    : '<?php echo site_url();?>'+'/system_settings/widget_list',
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
					$row_active='<a  href="<?php echo site_url().'/candidate/update/' ?>'+data.widget_id+'" class="tabledit-edit-button btn btn-success btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;"  onClick="activate_menu('+data.widget_id+')"  class="tabledit-delete-button btn-success btn btn-sm btn_delete " id="activate_candidate_$1" >Activate</a>';

					$row_delete='<a  href="<?php echo site_url().'/system_settings/update_widget/' ?>'+data.widget_id+'" class="tabledit-edit-button btn btn-success btn-sm btn_edit"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_menu('+data.widget_id+')"  class="tabledit-delete-button btn-danger btn btn-sm btn_delete" id="delete_candidate_$1"><span class="glyphicon glyphicon-trash"></span></a>';
					if(data.is_active=='Yes')
					{
						$('td', row).eq(3).html($row_delete);
					}
					else
					{
						$('td', row).eq(3).html($row_active);
					}
      			}
			});
		}

		function delete_menu(widget_id)
		{
			swal({
				title: 'Are you sure?',
				text: "You Want To De-activate This Widget!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, In-Active it!'
			}).then(function () {
				$.ajax({
					url: '<?php echo site_url();?>/system_settings/delete_widget',
					data : {widget_id: widget_id},
					type: 'POST',
					success: function(response){
						var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Widget In-Actived Successfully!';
							title ='Success';
						}
						else if(response=0)
						{
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
					}
				});
				oTable.draw();
				// window.setTimeout(function(){location.reload()},2000);
				return true;
			});
		}
	
		function activate_menu(widget_id)
		{
			swal({
				title: 'Are you sure?',
				text: "You Want To Activate This Widget!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, Activate it!'
			}).then(function () {
				$.ajax({
					url: '<?php echo site_url();?>/system_settings/active_widget',
					data : {widget_id: widget_id},
					type: 'POST',
					success: function(response){
						var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Menu Activated Successfully!';
							title ='Success';
						}
						else if(response=0)
						{
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
					}
				});
				oTable.draw();
				// window.setTimeout(function(){location.reload()},2000);
				return true;
			});
		}
	</script>




