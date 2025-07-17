<body class="with-side-menu-addl-full">

	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>Criteria Listing</h2>
						</div>
					</div>
				</div>
			</header>
			
			<section class="card">
				<div class="card-block">
					<table id="example" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th style="width:3%">Role ID</th>
							<th style="width:15%">Criteria</th>
							<th style="width:15%">Value</th>
							<th style="width:10%">Actions</th>
						</tr>
						</thead>
						<tbody>
                            <tr>
                                <td>111</td>
                                <td>Efficency</td>
                                <td>100%</td>
                                <td style="white-space: nowrap; width: 1%;">
                                    <div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                                        <div class="btn-group btn-group-sm" style="float: none;">
                                            <button class="tabledit-edit-button btn-success btn btn-sm" style="float: none;">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </button>
                                        </div>								
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>121</td>
                                <td>Productivity</td>
                                <td>100%</td>
                                <td style="white-space: nowrap; width: 1%;">
                                    <div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                                        <div class="btn-group btn-group-sm" style="float: none;">
                                            <button class="tabledit-edit-button btn-danger btn btn-sm" style="float: none;">
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



