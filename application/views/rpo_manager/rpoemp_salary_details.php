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
							<h2>RPO Employee Salary Details</h2>
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/rpo/add_edit_rpo_emp_salary_details">
								<button class="btn btn-inline btn-primary ladda-button" data-style="expand-right">
								<span class="ladda-label">Add RPO Salary Details</span>
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
					<table id="emp_salarydetails" class="display table table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:15%">Name</th>
								<th style="width:15%">Hourly Rate</th>
								<th style="width:15%">Effective From</th>
								<th style="width:15%">Effective To</th>
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

	function get_emp_salarydetails()
	{
		//var id = '<?php //echo $this->uri->segment(3); ?>';
		oTable = $('#emp_salarydetails').DataTable({
		
			'responsive': true,
			'bProcessing'    : true,
			'bServerSide'    : true,
			"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
			'sPaginationType': 'full_numbers',
			"aoColumns": [
				// {"sName": "can_id", "mData": "can_id" ,"bSortable":true},
				{"sName": "can_name", "mData": "can_name" ,"bSortable":true},
				{"sName": "hourly_rate", "mData": "hourly_rate" ,"bSortable":false},
				{"sName": "effective_from", "mData": "effective_from" ,"bSortable":false},
				{"sName": "effective_to", "mData": "effective_to" ,"bSortable":false},
				{"sName": "Action", "mData": "edit" ,"bSortable":false,"bSearchable":false}
			],
			'sAjaxSource'    : '<?php echo site_url();?>'+'/rpo/list_emp_salarydetails	',
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
			"createdRow": function ( row, data, index )
			{
				frm_date = format_date(data.effective_from);
				to_date = format_date(data.effective_to);
				$('td', row).eq(2).text(frm_date);
				$('td', row).eq(3).text(to_date);
	        }
		});
	}

	function delete_rposaldetails(rpo_sal_id)
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
				url: '<?php echo site_url();?>/rpo/delete_rposaldetails',
				data : {rpo_sal_id: rpo_sal_id},
				type: 'POST',
				success: function(response){
					var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Employee Salary Details Deleted Successfully!';
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
			oTable.draw();
			 // window.setTimeout(function(){location.reload()},2000);
			return true;
		});	
	}


	$(function() {
		$(".chosen-select").chosen();
		get_emp_salarydetails();
	});	
	</script>



