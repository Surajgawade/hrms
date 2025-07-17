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
		<div class="container-fluid p-xl-0">
			<?php $this->load->view('candidate/can_menu');?>

			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>Employee Billing List</h2>
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/candidate/add_billing/<?php echo $this->uri->segment(3);?>">
								<button class="btn btn-inline btn-primary ladda-button" data-style="expand-right">
								<span class="ladda-label">Add New</span>
							</button>
							</a>
						</div>
					</div>
				</div>
			</header>
			
			<section class="card">
				<div class="card-block">
					<table id="billing_list" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th style="width:15%">Rate Type</th>
							<th style="width:15%">Amount</th>
							<th style="width:15%">From Date</th>
							<th style="width:15%">To Date</th>
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
				url: '<?php echo site_url();?>/candidate/delete_billing',
				data : {bill_id: bill_id},
				type: 'POST',
				success: function(response){
					var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Billing details deleted successfully!';
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
	get_billing();
   $('#datePicker, #datePicker1, #datePicker2')
        .datepicker({
            format: 'dd/mm/yyyy'
   });
});


function get_billing()
{
	var id = '<?php echo $this->uri->segment(3); ?>';
	var is_exist = '<?php echo check_record_exist($tablename='candidate', $conditions = array('can_id' =>$this->uri->segment(3)));?>';
	oTable = $('#billing_list').DataTable({
		'responsive': true,
		'bProcessing'    : true,
		'bServerSide'    : true,
		"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
		'sPaginationType': 'full_numbers',
		"aoColumns": [
			// {"sName": "Sr_no", "mData": "sr_no" ,"bSortable":true},
			{"sName": "rate_type", "mData": "rate_type" ,"bSortable":true},
			{"sName": "amount", "mData": "amount" ,"bSortable":true},
			{"sName": "effective_from", "mData": "effective_from" ,"bSortable":false },
			{"sName": "effective_to", "mData": "effective_to" ,"bSortable":false },
			{"sName": "Actions", "mData": "edit" ,"bSortable":false,"bSearchable":false}
		],
		"createdRow": function ( row, data, index )
		{
			frm_date = format_date(data.effective_from);
			to_date = format_date(data.effective_to);
			$('td', row).eq(2).text(frm_date);
			$('td', row).eq(3).text(to_date);
        },
		'sAjaxSource'    : '<?php echo site_url();?>'+'/candidate/billing_details/'+id,
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