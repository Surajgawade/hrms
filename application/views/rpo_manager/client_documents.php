<div class="page-content">
	<div class="container-fluid">	
	<?php $this->load->view('rpo_manager/client_menu');?>
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
							<h2>Client Document List</h2>
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/rpo_manager/add_contract_document/<?php echo $this->uri->segment(3);?>">
								<button class="btn btn-inline btn-primary ladda-button" data-style="expand-right">
								<span class="ladda-label">Add Document</span>
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
					<table id="document_list" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:15%">Document Name</th>
								<th style="width:15%">View / Download</th>
								<th style="width:10%">Actions</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
						
					</table>
				</div>
			</section>
		</div><!--.container-fluid-->

	</div>
<script>

var oTable;
$(function () {
	get_documents();
});

function get_documents()
{
	var id = '<?php echo $this->uri->segment(3); ?>';
   var is_exist = '<?php echo check_record_exist($tablename='rpo_client_details', $conditions = array('client_id' =>$this->uri->segment(3)));?>'; 
	oTable = $('#document_list').DataTable({
		'responsive': true,
		'bProcessing'    : true,
		'bServerSide'    : true,
		"language": {
	    	processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
	  	},
		"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
		'sPaginationType': 'full_numbers',
		"aoColumns": [
			{"sName": "doc_name", "mData": "doc_name" ,"bSortable":true},
			/*{"sName": "file_name", "mData": "file_name" ,"bSortable":true},*/
			{"sName": "file_name", "mData": "file_name" ,"bSortable":true},
			{"sName": "Actions", "mData": "edit" ,"bSortable":false,"bSearchable":false}
		],
		'sAjaxSource'    : '<?php echo site_url();?>'+'/rpo_manager/list_contractdocs/'+id,
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
		var	doc_id = id;
		$.ajax({
			url: '<?php echo site_url();?>/rpo_manager/delete_doc',
			// dataType :"json",
			data : {doc_id: doc_id},
			type: 'POST',
			success: function(response){
					var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Document deleted successfully!';
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
		window.setTimeout(function(){location.reload()},2000);
		oTable.draw();
	});
}

</script>
