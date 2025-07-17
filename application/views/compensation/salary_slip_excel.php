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
							<h2>Monthly Salary Slips</h2>
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/compensation/download">
								<button class="btn btn-inline btn-primary ladda-button" data-style="expand-right">
								<span class="ladda-label">Download</span>
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
					<table id="list_currentmonth_slips" class="display table table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:15%">Transaction Type</th>
								<th style="width:15%">Debit A/c No</th>
								<th style="width:15%">Account No</th>
								<th style="width:15%">Beneficiary No</th>
								<th style="width:15%">Net Pay</th>
								<th style="width:15%">Name</th>
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
	function get_month(month)
	{
		var monthNames = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
		var d = month-1;
		return monthNames[d];
	}

	function list_currentmonth_slips()
	{
		//var id = '<?php //echo $this->uri->segment(3); ?>';
		oTable = $('#list_currentmonth_slips').DataTable({
		
			'responsive': true,
			'bProcessing'    : true,
			'bServerSide'    : true,
			'language': {
					processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
			  	},
			"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
			'sPaginationType': 'full_numbers',
			"aoColumns": [
				{"sName": "transaction_type", "mData": "transaction_type" ,"bSortable":true},
				{"sName": "debit_acc_number", "mData": "debit_acc_number" ,"bSortable":true},
				{"sName": "account_number", "mData": "account_number" ,"bSortable":false},
				{"sName": "beneficiary_id", "mData": "beneficiary_id" ,"bSortable":false},
				{"sName": "net_pay", "mData": "net_pay" ,"bSortable":false},
				{"sName": "can_name", "mData": "can_name" ,"bSortable":true}

			],
			'sAjaxSource'    : '<?php echo site_url();?>'+'/compensation/list_currentmonth_slips',
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
                $('td', row).eq(1).text(get_month(data.month));
            }
 
		});
	}


	$(function() {
		$(".chosen-select").chosen();
		list_currentmonth_slips();
	});	
	</script>



