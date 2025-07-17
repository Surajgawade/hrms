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
							<h2>Employee Assessment List</h2>
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/performance_and_incentives/add_edit_can_assessment/">
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
					<table id="candidate_assessment_list" class="display table table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:15%">Employee Name</th>
								<th style="width:15%">Date</th>
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
		var oTable;
		$(function() {
		$(".chosen-select").chosen();
			
			oTable = $('#candidate_assessment_list').DataTable({
				'responsive': true,
				'bProcessing'    : true,
				'bServerSide'    : true,
				'language': {
			     processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
			  	}, 
				"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
				'sPaginationType': 'full_numbers',
				"aoColumns": [
					{"sName": "can_name", "mData": "can_name" ,"bSortable":true},
					{"sName": "date", "mData": "date" ,"bSortable":true},
					{"sName": "Action", "mData": "edit" ,"bSortable":false,"bSearchable":false}
				],
				'sAjaxSource'    : '<?php echo site_url();?>'+'/performance_and_incentives/assessment_list',
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
					frm_date = format_date(data.date);
					$('td', row).eq(1).text(frm_date);
		        }
			});
			//.fnFilterOnReturn()
		});

		function delete_asses(id)
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
				var  list_id = id;
				$.ajax({
					url: '<?php echo site_url();?>/performance_and_incentives/delete_asses',
					data : {list_id: list_id},
					type: 'POST',
					success: function(response){
						var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Assesment Details Deleted Successfully!';
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
				window.location.reload();
				return true;
			});
		}

		function format_date(date)
	    {
			var d = new Date(date);
			var curr_day = d.getDate();
			var curr_month = parseInt(d.getMonth())+1;
			var curr_year = d.getFullYear();
			if(curr_day < 10)
			{
				curr_day = '0'+curr_day;
			}
			if(curr_month < 10)
			{
				curr_month = '0'+curr_month;
			}
			var newDate = curr_day+'/'+curr_month+'/'+curr_year;
	    	return newDate;
	    }
	</script>



