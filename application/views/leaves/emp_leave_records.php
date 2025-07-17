<body class="with-side-menu-addl-full">
	<div class="page-content">
		<div>
			<?php
            if(isset($message)){
      			echo $message;
            }
			?>
		</div>
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>Employee Leave Records</h2>
						</div>
					</div>
				</div>
			</header>
			
			<section class="card">
				<div class="card-block">
					<table id="list_emp_leave_records" class="display table table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th style="width:10%">Acronym</th>
							<th style="width:15%">Name</th>
							<th style="width:10%">Leave From</th>
							<th style="width:10%">Leave To</th>
							<th style="width:10%">Status</th>
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
			$('#list_emp_leave_records').dataTable
			({
				'responsive': true,
				'bProcessing'    : true,
				'bServerSide'    : true,
				 'language': {
			     processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
			  	}, 
				"order": [[ 2, "desc" ]],  //descending column for id , newly inserted record display on row one
				'sPaginationType': 'full_numbers',
				"aoColumns": [
					// {"sName": "appl_id", "mData": "appl_id" ,"bSortable":true},
					{"sName": "acronym", "mData": "acronym" ,"bSortable":true},
					{"sName": "can_name", "mData": "can_name" ,"bSortable":true},
					{"sName": "from_date", "mData": "from_date" ,"bSortable":true},
					{"sName": "to_date", "mData": "to_date" ,"bSortable":false},
					{"sName": "status", "mData": "status" ,"bSortable":false}
				],
				"createdRow": function ( row, data, index )
				{
					frm_date = format_date(data.from_date);
					to_date = format_date(data.to_date);
					$('td', row).eq(2).text(frm_date);
					$('td', row).eq(3).text(to_date);
	              	if(data.status == "Pending")
	              	{
	                 $('td', row).eq(4).css('color','blue');
	              	}
	              	if(data.status == "Approved")
	              	{
	                 $('td', row).eq(4).css('color','green');
	              	}
	              	if(data.status == "Rejected")
	              	{
	                 $('td', row).eq(4).css('color','red');
	              	}
	              	// $('#list_emp_leave_records').column(2).order('desc').draw();
        		},
				'sAjaxSource'    : '<?php echo site_url();?>'+'/leave_management/list_emp_leave_records',
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



