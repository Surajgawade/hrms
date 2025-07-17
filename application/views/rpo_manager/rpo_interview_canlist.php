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
							<h2>Interview Candidate List</h2>
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/rpo_interview/add_edit">
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
					<table id="interview_canlist" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:15%">Candidate name</th>
								<th style="width:15%">Email ID</th>
								<th style="width:15%">Mobile No</th>
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
	$(document).ready(function() {
			$(".chosen-select").chosen();
			get_candidates();
		});	
			
	function get_candidates()
		{
			console.log('in get_candidates');
			var id = '<?php echo $this->uri->segment(3); ?>';
			oTable = $('#interview_canlist').dataTable({
				'responsive': true,
				'bProcessing'    : true,
				'bServerSide'    : true,
				"language": {
			    	processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
			  	},
				"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
				'sPaginationType': 'full_numbers',
				"aoColumns": [
					{"sName": "can_name", "mData": "can_name" ,"bSortable":true},
					{"sName": "email_id", "mData": "email_id" ,"bSortable":true},
					{"sName": "phone1", "mData": "phone1" ,"bSortable":true},
					{"sName": "Action", "mData": "edit" ,"bSortable":false,"bSearchable":false},
				],
				'sAjaxSource'    : '<?php echo site_url();?>'+'/rpo_interview/list_candidates',
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
				'createdRow': function(row, data, index)
				{
					if(data.is_interested=='yes')
					{
						update_url = '<?php echo site_url().'/rpo_interview/interview_details/'?>'+data.intw_can_id+'';
					}
					else
					{
						update_url = '<?php echo site_url().'/rpo_interview/add_edit/'?>'+data.intw_can_id+'';
					}

					edit_link='<a href="'+update_url+'" class="tabledit-edit-button btn btn-sm btn_edit btn-success"><span class="glyphicon glyphicon-pencil"></span></a><a href="javascript:;" onClick="delete_can($1)" class="tabledit-delete-button btn btn-sm btn-danger btn_edit"><span class="glyphicon glyphicon-trash"></span></a>';
					$('td', row).eq(3).html(edit_link);					
   			}
			});
		}

		function delete_can(intw_can_id)
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
					url: '<?php echo site_url();?>/rpo_interview/delete',
					data : {intw_can_id: intw_can_id},
					type: 'POST',
					success: function(response){
						var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Candidate Details Deleted Successfully!';
							title ='Success';
						}
						else
						{
							type ='warning';
							message ="Access Denied";
							title ='Warning'; 

						}
						$.notify({
								title: title,
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
						window.setTimeout(function(){location.reload()},2000);
					}

				});
				oTable.draw();				
				return true;			
			});
		}
	</script>