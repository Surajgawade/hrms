<body class="with-side-menu-addl-full">

	<div class="page-content">
		<div class="container-fluid">
        <h1 class="well headline">Assess list</h1>
			
			<section class="card">
				<div class="card-block">
					<table id="example" class="display table table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th style="width:3%">Role ID</th>
							<th style="width:15%">Name</th>
							<th style="width:15%">Role</th>
							<th style="width:10%">Actions</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>111</td>
							<td>Sanj</td>
							<td>all rights</td>
							<td style="white-space: nowrap; width: 1%;">
								<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
									<div class="btn-group btn-group-sm" style="float: none;">
                                    <a href="<?php echo base_url();?>edit_access"><button type="button" class="tabledit-edit-button btn btn-sm" style="float: none;">
											<span class="glyphicon glyphicon-pencil"></span>
                                        </button>
                                    </a>
									</div>								
								</div>
							</td>
						</tr>
                        <tr>
							<td>121</td>
							<td>harsha</td>
							<td>ssss</td>
							<td style="white-space: nowrap; width: 1%;">
								<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
									<div class="btn-group btn-group-sm" style="float: none;">
										<button type="button" class="tabledit-edit-button btn btn-sm" style="float: none;">
											<span class="glyphicon glyphicon-pencil"></span>
										</button>
									</div>								
								</div>
							</td>
						</tr>
					
						</tbody>
					</table>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	
	<script>
		$(function(){
			$('#example').DataTable({
				responsive: true
			});
		});
	</script>



