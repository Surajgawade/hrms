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
							<h2>Leave Requests</h2>
						</div>
					</div>
				</div>
			</header>
			
			<section class="card">
				<div class="card-block">
					<table id="leave_appli_list" class="display table table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<!-- <th style="width:3%">Sr.No</th> -->
							<th style="width:10%">Acronym</th>
							<th style="width:15%">Name</th>
							<th style="width:10%">Leave From</th>
							<th style="width:10%">Leave To</th>
							<th style="width:10%">Leave Days</th>
							<th style="width:10%">Status</th>
							<th style="width:15%">Change Status</th>
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
			$('#leave_appli_list').dataTable
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
					{"sName": "acronym", "mData": "acronym" ,"bSortable":true},
					{"sName": "can_name", "mData": "can_name" ,"bSortable":true},
					{"sName": "from_date", "mData": "from_date" ,"bSortable":true},
					{"sName": "to_date", "mData": "to_date" ,"bSortable":false},
					{"sName": "Leave Days", "mData": "leave_days" ,"bSortable":false},
					{"sName": "status", "mData": "status" ,"bSortable":false},
					{"sName": "Change Status", "mData": "change_status" ,"bSortable":false,"bSearchable":false}
				],
				"createdRow": function ( row, data, index )
				{

              	frm_date = format_date(data.from_date);
					to_date = format_date(data.to_date);
					$('td', row).eq(2).text(frm_date);
					$('td', row).eq(3).text(to_date);
					$('td', row).eq(4).text(++data.leave_days);
        		},
				'sAjaxSource'    : '<?php echo site_url();?>'+'/leave_management/list_leave_request',
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
					
					$btn_enabled='<a  href="<?php echo site_url().'/leave_management/change_status/' ?>'+data.appl_id+'" class="tabledit-edit-button btn btn-sm btn_assign">Change Status</a>';

					$btn_disabled='<span class="tabledit-edit-button btn btn-sm btn_assign  btn-success">Approved</span>';
					if(data.status=='Approved')
					{
						$('td', row).eq(6).html($btn_disabled);
						//$('#delete_candidate_'+data.can_id).attr('hidden');
					}
					else
					{
						$('td', row).eq(6).html($btn_enabled);
						//$("#activate_candidate_"+data.can_id+"").attr('hidden');;
					}
					
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
						$.notify({
								title: "<strong>Success:</strong> ",
								message:"Status Changed Successfully!",
								
							},{
							type: "success",
							delay: 800,
								animate:{
									enter: "animated fadeInUp",
									exit: "animated fadeOutDown"
								} 
						});		
					}
				});
			});
		//.fnFilterOnReturn()
		});	
	</script>



