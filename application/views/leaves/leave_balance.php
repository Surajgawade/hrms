<div class="page-content">
	<div class="container-fluid">
		
		<h1 class="well headline">Leave Balance</h1>
		<section class="card">
				<div class="card-block">
					<table id="leave_balance_list" class="display table table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th style="width:15%">Name</th>
							<th style="width:15%">Total Leave</th>
							<th style="width:10%">Balance Leave</th>
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
		$(function() {
			//alert("hi");
			$('#leave_balance_list').dataTable
			({
				'responsive': true,
				'bProcessing'    : true,
				'bServerSide'    : true,
				'language': {
			     processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
			  	}, 
				"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
				'sPaginationType': 'full_numbers',
				"aoColumns": [
					// {"sName": "appl_id", "mData": "appl_id" ,"bSortable":true},
					{"sName": "can_name", "mData": "can_name" ,"bSortable":true},
					{"sName": "alloted_leave", "mData": "alloted_leave" ,"bSortable":false},
					{"sName": "balance_leave", "mData": "balance_leave" ,"bSortable":false}
				],
				'sAjaxSource'    : '<?php echo site_url();?>'+'/leave_management/list_leave_balance',
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
		});
	</script>
