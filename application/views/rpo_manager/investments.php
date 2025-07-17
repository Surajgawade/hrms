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
							<h2>Employee Investment Summary</h2>
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/rpo_manager/add_investment/<?php echo $this->uri->segment(3);?>">
								<button class="btn btn-inline btn-primary ladda-button" data-style="expand-right">
								<span class="ladda-label">Add New</span>
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
					<table id="investment_list" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:15%">Amount</th>
								<th style="width:15%">Description</th>
								<th style="width:15%">Section</th>
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
</div>

<script>

	var oTable;
	$(document).ready(function () {
		get_investments();
	});


	function get_investments()
	{
		var id = '<?php echo $this->uri->segment(3); ?>';
		var is_exist = '<?php echo check_record_exist($tablename='candidate', $conditions = array('can_id' =>$this->uri->segment(3)));?>';
		oTable = $('#investment_list').DataTable({
			'responsive': true,
			'bProcessing'    : true,
			'bServerSide'    : true,
			"language": {
		    	processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
		  	},
			"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
			'sPaginationType': 'full_numbers',
			"aoColumns": [
				{"sName": "amount", "mData": "amount" ,"bSortable":true},
				{"sName": "description", "mData": "description" ,"bSortable":true},
				{"sName": "section", "mData": "section" ,"bSortable":false },
				{"sName": "Actions", "mData": "edit" ,"bSortable":false,"bSearchable":false}
			],
			'sAjaxSource'    : '<?php echo site_url();?>'+'/rpo_manager/investment_details/'+id,
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
			var  inv_id = id;
			$.ajax({
				url: '<?php echo site_url();?>/rpo_manager/delete_investment',
				data : {inv_id: inv_id},
				type: 'POST',
				success: function(response){
					var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Investment details deleted successfully!';
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
			// window.setTimeout(function(){location.reload()},3000);
			oTable.draw();
		});
    }
</script>
