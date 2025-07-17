<div class="page-content">
	<div class="container-fluid">
		<?php $this->load->view('rpo_manager/rpo_emp_menu');?>
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

		<header class="section-header">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell col-md-10">
						<h2>Employee Salary Slip List</h2>
					</div>
					<div class="add_btn col-md-2">
						<a href="<?php echo site_url();?>/rpo_manager/generate_salary_slip/<?php echo $this->uri->segment(3);?>">
							<button class="btn btn-inline btn-primary ladda-button" data-style="expand-right">
							<span class="ladda-label">Generate</span>
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
				<table id="salary_slip_list" class="display table table-bordered table-striped" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th style="width:15%">Name</th>
						<th style="width:15%">Month</th>
						<th style="width:15%">Year</th>
						<th style="width:15%">Paid Hours</th>
						<th style="width:15%">Net Pay</th>
						<th style="width:10%">Actions</th>
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
			var  bill_id = id;
			$.ajax({
				url: '<?php echo site_url();?>/rpo_manager/delete_salary_slip',
				data : {bill_id: bill_id},
				type: 'POST',
				success: function(response){
					var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Salary Slip deleted successfully!';
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
			return true;	
		});
	}
    
$(document).ready(function() {
	get_salary_slips();
});


function get_salary_slips()
{
	var id = '<?php echo $this->uri->segment(3); ?>';
	
	oTable = $('#salary_slip_list').DataTable({
		'responsive': true,
		'bProcessing'    : true,
		'bServerSide'    : true,
		"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
		'sPaginationType': 'full_numbers',
		"aoColumns": [
			// {"sName": "Sr_no", "mData": "sr_no" ,"bSortable":true},
			{"sName": "can_name", "mData": "can_name" ,"bSortable":true},
			{"sName": "month", "mData": "month" ,"bSortable":true},
			{"sName": "year", "mData": "year" ,"bSortable":false },
			{"sName": "paid_hours", "mData": "paid_hours" ,"bSortable":false },
			{"sName": "net_pay", "mData": "net_pay" ,"bSortable":false },
			{"sName": "Actions", "mData": "edit" ,"bSortable":false,"bSearchable":false}
		],
		'sAjaxSource'    : '<?php echo site_url();?>'+'/rpo_manager/salary_slip_list/'+id,
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
</script>