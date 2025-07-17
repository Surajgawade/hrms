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
							<h2>Leave Status</h2>
						</div>
					</div>
				</div>
			</header>
			
			<section class="card">
				<div class="card-block">
					<table id="processed_leave_appli_list" class="display table table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th style="width:10%">Acronym</th>
							<th style="width:15%">Name</th>
							<th style="width:10%">Leave From</th>
							<th style="width:10%">Leave To</th>
							<th style="width:10%">Leave Days</th>
							<th style="width:15%">Status</th>
							<!-- <th style="width:10%">Remarks</th> -->
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
			$('#processed_leave_appli_list').dataTable
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
					{"sName": "acronym", "mData": "acronym" ,"bSortable":true},
					{"sName": "can_name", "mData": "can_name" ,"bSortable":true},
					{"sName": "from_date", "mData": "from_date" ,"bSortable":true},
					{"sName": "to_date", "mData": "to_date" ,"bSortable":false},
					{"sName": "leave_days", "mData": "leave_days" ,"bSortable":false},
					{"sName": "status", "mData": "status" ,"bSortable":false,"bSearchable":false}
				],
				"createdRow": function ( row, data, index )
				{
					frm_date = format_date(data.from_date);
					to_date = format_date(data.to_date);
					$('td', row).eq(2).text(frm_date);
					$('td', row).eq(3).text(to_date);
	              	if(data.status == "Pending")
	              	{
	                 $('td', row).eq(5).css('color','blue');
	              	}
	              	if(data.status == "Approved")
	              	{
	                 $('td', row).eq(5).css('color','green');
	              	}
	              	if(data.status == "Rejected")
	              	{ 
	                 $('td', row).eq(5).css('color','red');
	              	}
	                $('td', row).eq(4).text(++data.leave_days);
        		},
				'sAjaxSource'    : '<?php echo site_url();?>'+'/leave_management/processed_leave_appli_list',
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
				'fnDrawCallback': function( status ) {
					if(status==1)
						return  ($(this).text() == 'Approved');
					else
						return ($(this).text() == 'Rejected');
      		}
			});

			$('#leave_appli_list').on('change', '.status', function() {
				var selected_status = $(this).val();
				var appl_id = $(this).siblings('input[type="hidden"]').val();
								
				$.ajax({
					url: '<?php echo site_url();?>/leave_management/change_appli_status',
					// dataType :"json",
					data : {appl_id: appl_id,selected_status:selected_status},
					type: 'POST',
					success: function(response){
						$.notify(response, "success");		
					}
				});
			});
		//.fnFilterOnReturn()
		});	
	</script>



