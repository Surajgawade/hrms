<div class="page-content">
		<div class="container-fluid">	
	<?php $this->load->view('candidate/can_menu');?>
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
							<h2>Assets Assigned</h2>
						</div>
					</div>
				</div>
			</header>
			
			<section class="card">
				<div class="card-block">
					<table id="asset_list" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:15%">Asset</th>
								<th style="width:15%">Quantity</th>
								<th style="width:15%">Department</th>
								<th style="width:15%">Penalty</th>
							</tr>
						</thead>	
						<tbody>
							
						</tbody>
						
					</table>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->	
</div>

<script>

	var oTable;
	$(document).ready(function () {
		get_assets_list();
	});


	function get_assets_list()
	{
		var id = '<?php echo $this->uri->segment(3); ?>';
		// var is_exist = '<?php// echo check_record_exist($tablename='candidate', $conditions = array('can_id' =>$this->uri->segment(3)));?>';
		oTable = $('#asset_list').DataTable({
			'responsive': true,
			'bProcessing'    : true,
			'bServerSide'    : true,
			"language": {
		    	processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
		  	},
			"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
			'sPaginationType': 'full_numbers',
			"aoColumns": [
				{"sName": "prop_name", "mData": "prop_name" ,"bSortable":true},
				{"sName": "quantity", "mData": "quantity" ,"bSortable":true},
				{"sName": "title", "mData": "title" ,"bSortable":true},
				{"sName": "penalty", "mData": "penalty" ,"bSortable":true}
			],
			'sAjaxSource'    : '<?php echo site_url();?>'+'/candidate/assets_list/'+id,
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
