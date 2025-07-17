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
							<h2>News List</h2>
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/news/create_news">
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
					<table id="news_list" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:15%">News Title</th>
								<th style="width:15%">publish date</th>
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
			var id = '<?php echo $this->uri->segment(3); ?>';
			oTable = $('#news_list').DataTable({
			
				'responsive': true,
				'bProcessing'    : true,
				'bServerSide'    : true,
				'language': {
					processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
			  	},
				"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
				'sPaginationType': 'full_numbers',
				"aoColumns": [
					{"sName": "nw_title", "mData": "nw_title" ,"bSortable":true},
					{"sName": "publish_date", "mData": "publish_date" ,"bSortable":true},
					{"sName": "Action", "mData": "edit" ,"bSortable":false,"bSearchable":false}
				],
				'sAjaxSource'    : '<?php echo site_url();?>'+'/news/list_news',
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
					if(data.publish_date != null)
					{
						var pdate = data.publish_date.replace(/\-/g, '/');
						$('td', row).eq(1).text(pdate);
					}
					else
					{
						$('td', row).eq(1).text("-");
					}
				},
			});				
		});	
		function delete_news(nw_id)
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
					url: '<?php echo site_url();?>/news/delete_news',
					data : {nw_id: nw_id},
					type: 'POST',
					success: function(response){
						console.log(response);
						var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='News Deleted Successfully!';
							title ='Success';
						}
						else
						{
							type ='warning';
							message ='Access Denied';
							title ='Warning';

						}	
					}
				});
				$.notify({
					type: 'success',
					title: "<strong>Success:</strong> ",
					message: "News deleted successfully!",
					delay: 2000,
					animate:{
						enter: "animated fadeInUp",
						exit: "animated fadeOutDown"
					}
				});
				oTable.draw();
				window.setTimeout(function(){location.reload()},3000);
				return true;
			});
		}

</script>