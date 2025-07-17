<body class="with-side-menu-addl-full">
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
	<div class="page-content">
		<div>
			<?php
               if(isset($message)){
               		echo $message;
               }
			?>
		</div>
		<div class="container-fluid">
			<?php if($this->session->flashdata('error')){?>
						<div class="alert alert-warning alert-no-border alert-close alert-dismissible fade show" role="alert">
						 <?php echo $this->session->flashdata('error');?>
						</div>
			<?php }?>
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>Travel Clearance</h2>
						</div>
					</div>
				</div>
			</header>

	<section class="card">
		<div class="card-block">
			<table id="example" class="display table table-bordered" cellspacing="0" width="100%">
				<thead>
				<tr>
					<th style="width:15%">Candidate Name</th>
					<th style="width:15%">From Date</th>
					<th style="width:15%">To Date</th>
					<th style="width:15%">Purpose</th>
					<th style="width:15%">Status</th>
					<th style="width:15%">Amount</th>
					<th style="width:10%">Actions</th>
				</tr>
				</thead>				
				<tbody>
				</tbody>
			</table>
			</div>
		</section>
	<!-- <hr> -->
		
</div>
</div>
<script src="<?php echo base_url();?>js/lib/bootstrap-sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
	var oTable;
	$(document).ready(function () {
		get_travels();
	});

	function get_travels()
	{
		oTable = $('#example').DataTable({
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
				{"sName": "from_date", "mData": "from_date" ,"bSortable":true},
				{"sName": "to_date", "mData": "to_date" ,"bSortable":true},
				{"sName": "purpose", "mData": "purpose" ,"bSortable":true},
				{"sName": "status", "mData": "status" ,"bSortable":false },
				{"sName": "budget", "mData": "budget" ,"bSortable":false },
				{"sName": "Actions", "mData": "edit" ,"bSortable":false,"bSearchable":false}
			],
			'sAjaxSource'    : '<?php echo site_url();?>'+'/travel_management/clearance_details/',
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
				frm_date = format_date(data.from_date);
				t_date  = format_date(data.to_date);
				$('td', row).eq(1).text(frm_date);
				$('td', row).eq(2).text(t_date);
				if(data.status == "approved"){
                   $('td', row).eq(4).css('background-color','#87CEFA');
                }
                else if(data.status == "raised"){
                   $('td', row).eq(4).css('background-color','#f2f2f2');
                }
                else if(data.status == "cleared"){
                   $('td', row).eq(4).css('background-color','#32CD32');
                }
                else if(data.status == "claimed"){
                   $('td', row).eq(4).css('background-color','#9370DB');
                }
                else if(data.status == "rejected"){
                   $('td', row).eq(4).css('background-color','#F08080');
                }
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
			var  tv_id = id;
			$.ajax({
				url: '<?php echo site_url();?>/travel_management/delete_travel',
				data : {tv_id: tv_id},
				type: 'POST',
				success: function(response){
					response = JSON.parse(response);
					 $.notify({
			                    title: "<strong>Success:</strong> ",
			                    message:response.msg,
			                    
			                },{
			                type: "success",
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