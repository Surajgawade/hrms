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
							<h2>Criteria List</h2>
						</div>
				<?php /*		<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/performance_criteria/add_edit">
								<button class="btn btn-inline btn-primary ladda-button " data-style="expand-right">
								<span class="ladda-label">Add Criteria</span>
								<span class="ladda-spinner"></span>
								<div class="ladda-progress" style="width: 0px;"></div>
							</button>
							</a>
						</div>*/?>
					</div>
				</div>
			</header>
			
			<section class="card">
				<div class="card-block">
					<table id="criteria_list" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:15%">Role Name</th>
								<th style="width:15%">Criteria Name</th>
								<th style="width:15%">Criteria Percent</th>
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
		$(function() {
		$(".chosen-select").chosen();
			
			oTable = $('#criteria_list').DataTable({
				'responsive': true,
				'bProcessing'    : true,
				'bServerSide'    : true,
				'language': {
			     processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
			  	}, 
				"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
				'sPaginationType': 'full_numbers',
				"aoColumns": [
					{"sName": "role_name", "mData": "role_name" ,"bSortable":true},
					{"sName": "criteria_name", "mData": "criteria_name" ,"bSortable":true},
					{"sName": "percent_value", "mData": "percent_value" ,"bSortable":false},
					{"sName": "Action", "mData": "edit" ,"bSortable":false,"bSearchable":false}
				],
				'sAjaxSource'    : '<?php echo site_url();?>'+'/performance_and_incentives/list_criterias',
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

		function delete_data(id)
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
				var  tv_id = id;
				$.ajax({
					url: '<?php echo site_url();?>/performance_and_incentives/delete_criteria',
					data : {criteria_id: tv_id},
					type: 'POST',
					success: function(response){
						var type='' ;
							var message='' ;
							var title='' ;
							if(response != 0)
							{
								type ='success';
								message ='Performance criteria Deleted Successfully!';
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
				// window.setTimeout(function(){location.reload()},3000);
				oTable.draw();
				return true;
			});
	    }
	</script>



