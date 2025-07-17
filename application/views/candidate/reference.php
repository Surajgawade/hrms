<div class="page-content">
		<div class="container-fluid">
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
	
			<?php $this->load->view('candidate/can_menu');?>

			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>Employee Professional References</h2>
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/candidate/add_reference_details/<?php echo $this->uri->segment(3);?>?type=<?php echo $_GET['type']?>">
								<button class="btn btn-inline btn-primary ladda-button" data-style="expand-right">
								<span class="ladda-label">Add Reference</span>
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
					<table id="reference_list" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:15%">Reference Name</th>
								<th style="width:15%">Email</th>
								<th style="width:15%">Mobile No</th>
								<th style="width:15%">Designation</th>
								<th style="width:15%">Company</th>
								<th style="width:15%">Experience</th>
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

	function get_references()
	{
		var id = '<?php echo $this->uri->segment(3); ?>';
		var is_exist = '<?php echo check_record_exist($tablename='candidate', $conditions = array('can_id' =>$this->uri->segment(3)));?>';
		var type = 0;
		oTable = $('#reference_list').DataTable({
			'responsive': true,
			'bProcessing'    : true,
			'bServerSide'    : true,
			"language": {
		    	processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
		  	},
			"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
			'sPaginationType': 'full_numbers',
			"aoColumns": [
				{"sName": "ref_name", "mData": "ref_name" ,"bSortable":true},
				{"sName": "ref_email", "mData": "ref_email" ,"bSortable":true},
				{"sName": "ref_mobile", "mData": "ref_mobile" ,"bSortable":false },
				{"sName": "ref_designation", "mData": "ref_designation" ,"bSortable":false },
				{"sName": "ref_company", "mData": "ref_company" ,"bSortable":false },
				{"sName": "ref_experience", "mData": "ref_experience" ,"bSortable":false },
				{"sName": "Actions", "mData": "edit" ,"bSortable":false,"bSearchable":false}
			],
			'sAjaxSource'    : '<?php echo site_url();?>'+'/candidate/reference_details/'+id+'/'+type,
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
				var  ref_id = id;
				$.ajax({
					url: '<?php echo site_url();?>/candidate/delete_ref',
					data : {ref_id: ref_id},
					type: 'POST',
					success: function(response){
						var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Reference details deleted successfully!';
							title ='success';
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
				window.setTimeout(function(){location.reload()},2000);
			return true;	
		});
 	}
    
$(document).ready(function() {
	get_references();
   $('#datePicker, #datePicker1, #datePicker2')
        .datepicker({
            format: 'dd/mm/yyyy'
   });
});
</script>