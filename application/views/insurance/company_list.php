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
							<h2>Insurance Company List</h2>
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/insurance/add_company">
								<button class="btn btn-inline btn-primary ladda-button" data-style="expand-right">
									<span class="ladda-label">Add Company</span>
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
					<table id="list_company" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:15%">Company Name</th>
								<th style="width:15%">Description</th>
								<th style="width:15%">Company Mail</th>
								<th style="width:10%">Action</th>
							</tr>
						</thead>
						</div>
						<tbody>
							
						</tbody>

					</table>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->	


<script>
	var oTable;
	$(document).ready(function() {
		get_company();
	});	
			
	function get_company()
	{
		oTable = $('#list_company').DataTable({
			'responsive': true,
			'bProcessing'    : true,
			'bServerSide'    : true,
			"language": {
		    	processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
		  	},
			"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
			'sPaginationType': 'full_numbers',
			"aoColumns": [
				{"sName": "name", "mData": "name" ,"bSortable":true},
				{"sName": "description", "mData": "description" ,"bSortable":true},
				{"sName": "ic_email", "mData": "ic_email" ,"bSortable":true},
				{"sName": "Action", "mData": "edit" ,"bSortable":false,"bSearchable":false}
			],
			'sAjaxSource'    : '<?php echo site_url();?>'+'/insurance/list_companies',
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

	function delete_com(ic_id)
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
	            url: '<?php echo site_url();?>/insurance/delete_company/'+ic_id,
	            async:false,
	            type: 'POST',
	            success: function(response)
	            {
	            	var type = '' ;
					var message = '';
					var title = '';
					if(response == 1)
					{
						type ='success';
						message ='Company Deleted Successfully!';
						title ='Success:';
					}
					else if(response == 2)
					{
						type = 'danger';
						message = 'Something went wrong...';
						title = 'Oops:';
					}
					else if(response == 3)
					{
						type = 'warning';
						message = 'Please fill all details';
						title = 'Warning:';
					}
	                $.notify({
	                        title: "<strong>"+title+"</strong> ",
	                        message: message,
	                        type: type,
	                    },{
	                        delay: 800,
	                        animate:{
	                            enter: "animated fadeInUp",
	                            exit: "animated fadeOutDown"
	                        }
	                });
	            	oTable.draw();
	        	}
	    	});
		});
	}
</script>