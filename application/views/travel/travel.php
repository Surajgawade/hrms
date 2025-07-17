<body class="with-side-menu-addl-full">
<?php if($this->session->flashdata('success')){?>
<script type="text/javascript">
  var message_text='<?php echo $this->session->flashdata('success');?>';
	 $.notify({
				title: "<strong>Success</strong> ",
				message: message_text,
				
			},{
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
							<h2>My Travels</h2>
							<!-- <div class="subtitle">Welcome to Ultimate Dashboard</div> -->
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/travel_management/add_travel/">
								<!-- <button class="btn btn-inline btn-primary ladda-button" data-style="expand-right">
								<span class="ladda-label">Add New </span>
								<span class="ladda-spinner"></span>
								<div class="ladda-progress" style="width: 0px;"></div>
							</button> -->
							</a>
						</div>
					</div>
				</div>
			</header>

	<section class="card">
		<div class="card-block">
			<table id="example" class="display table table-bordered" cellspacing="0" width="100%">
				<thead>
				<tr>
					<th style="width:15%">Employee Name</th>
					<th style="width:10%">From Date</th>
					<th style="width:10%">To Date</th>
					<th style="width:10%">Purpose</th>
					<th style="width:10%">Status</th>
					<th style="width:10%">Amount</th>
					<th style="width:15%">Remark</th>
					<th style="width:15%">Clearance Remark</th>
					<th style="width:15%">Actions Performed</th>
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
	    $('#submit_travel').click(function (e) {		
			e.preventDefault();
			var can_id = '<?php echo $this->uri->segment(3); ?>';
			var tv_id= $('#tv_id').val();
			var description = $('#description').val();
			var amount= $('#amount').val();
			var section = $('#section').val();
			if(amount=='')
			{
				alert('Enter amount!')
			}
			else
			{
				$.ajax({
					url: '<?php echo site_url();?>/candidate/add_travel_details'+id,
					dataType :"json",
					data : {can_id: can_id, tv_id:tv_id, description: description,amount:amount,section:section},
					type: 'POST',
					success: function(response){
	               $.notify({
								title: "<strong>Success</strong> ",
								message: "Travel details updated successfully!",	
							},
							{
								type: type,
								delay: 800,
									animate:{
										enter: "animated fadeInUp",
										exit: "animated fadeOutDown"
									} 
						});
					/*		var cnt=0;
						var trHTML = '';
						trHTML += '<tr><td>Sr.No</td><td>Rate Per Hour</td><td>Rate Per day</td><td>Rate Per Week</td><td>Rate Per Month</td><td>Rate Per Year</td><td>From Date</td><td>To Date</td><td>Actions</td></tr>';
				        $.each(response['result'], function (key,value) {
			        	cnt= cnt+1;
			            trHTML += 
				                '<tr><td>' + cnt + 
				                '</td><td>' + value.description + 
				                '</td><td>' + value.amount +
				                '</td><td>' + value.section +
				                '</td><td style="white-space: nowrap; width: 1%;"><div class="tabledit-toolbar btn-toolbar" style="text-align: left;"><div class="btn-group btn-group-sm" style="float: none;"><button type="button" class="tabledit-delete-button btn btn-sm" id="del" style="float: none;"><span class="glyphicon glyphicon-trash"></span></button></div></div></td></tr>';     
				          });
						$("#example tbody tr").remove();
			            $('#example').append(trHTML);
			            document.getElementById("investment_form").reset();*/
			   		}
				});
				// window.setTimeout(function(){location.reload()},3000);
				/*$('#amount').val('');

				$('#description').text('');*/
				document.getElementById("travel_form").reset();
				oTable.draw();
			}
		});

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
				{"sName": "remark", "mData": "remark" ,"bSortable":false },
				{"sName": "clearance_remark", "mData": "clearance_remark" ,"bSortable":false },
				{"sName": "Actions", "mData": "edit" ,"bSortable":false,"bSearchable":false}
			],
			'sAjaxSource'    : '<?php echo site_url();?>'+'/travel_management/travel_details/',
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
                   $('td', row).eq(8).html('');
                }
                else if(data.status == "raised"){
                   $('td', row).eq(4).css('background-color','#f2f2f2');
                }
                else if(data.status == "cleared"){
                   $('td', row).eq(4).css('background-color','#32CD32');
                   $('td', row).eq(8).html('');
                }
                else if(data.status == "claimed"){
                   $('td', row).eq(4).css('background-color','#9370DB');
                   $('td', row).eq(8).html('');
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
					var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Travel Details Deleted Successfully!';
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