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
		<?php } ?>
	</div>
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>Insurance List</h2>
						</div>
					</div>
				</div>
			</header>
			
			<section class="card">
				<div class="card-block">
					<table id="list_insurance" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:3%"><input type="checkbox" id="checkAll"></th>
								<th style="width:20%">Employee Name</th>
								<th style="width:15%">Policy Number</th>
								<th style="width:15%">Premium Amount</th>
								<th style="width:15%">Insurance Expiry Date</th>
								<th style="width:15%">Mail Sent</th>
								<th style="width:10%">Action</th>
							</tr>
						</thead>
						</div>
						<tbody>
							
						</tbody>

					</table>
					<div class="card-block">
						<button class="btn btn-inline btn-success ladda-button check-all" data-style="expand-left" id="btn_register"><span class="ladda-label">Bulk Reminder</span><div class="ladda-progress" style="width: 106px;"></div></button>
					</div>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->	


	<script>
	$(document).ready(function() {
		$(".chosen-select").chosen();
		get_insurance();

		 $("#checkAll").click(function () {
		     $('input:checkbox').not(this).prop('checked', this.checked);
		 });
	});
			
	function get_insurance()
	{
		var id = '<?php echo $this->uri->segment(3); ?>';
		oTable = $('#list_insurance').dataTable({
			'responsive': true,
			'bProcessing'    : true,
			'bServerSide'    : true,
			"language": {
		    	processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
		  	},
			"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
			'sPaginationType': 'full_numbers',
			"aoColumns": [
				{"sName": "checkbox", "mData": "checkall" ,"bSortable":false,"bSearchable":false},
				{"sName": "can_name", "mData": "can_name" ,"bSortable":true},
				{"sName": "policy_no", "mData": "policy_no" ,"bSortable":true},
				{"sName": "premium_amnt", "mData": "premium_amnt" ,"bSortable":true},
				{"sName": "ins_expire_date", "mData": "ins_expire_date" ,"bSortable":true},
				{"sName": "mail_sent", "mData": "mail_sent" ,"bSortable":false},
				{"sName": "Action", "mData": "pay" ,"bSortable":false,"bSearchable":false}
			],
			'sAjaxSource'    : '<?php echo site_url();?>'+'/insurance/list_insurance',
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
				frm_date = format_date(data.ins_expire_date);
				$('td', row).eq(4).text(frm_date);
				mail = data.mail_sent;
				if(mail == 0)
				{
					$('td', row).eq(5).text("No");
				}
				else
				{
					$('td', row).eq(5).text("Yes");
				}
	        }
		});
	}

	$('#btn_register').on('click', function() {
		var ids = [];
		$("input:checkbox").each(function(){
		    var $this = $(this);
		    if($this.is(":checked")){
		        ids.push($this.attr("id"));
		    }
		});
		if(ids.length == 0)
		{
			$.notify({
	                title: "<strong>Warning</strong> ",
	                message: "Please select at least one insurance",
	                type: "warning",
	            },{
	                delay: 800,
	                animate:{
	                    enter: "animated fadeInUp",
	                    exit: "animated fadeOutDown"
	                } 
	        });
		}
		else
		{
			$('#list_insurance_wrapper').append('<div id="loaderDiv" class="" style="display: block; position: relative;  margin: 0 auto; align:center;  z-index:100;"><img style="margin: 0 auto; margin-top: 0px; position: relative; align-items: center; display: block; margin-top: -50px;" src="<?php echo assets_url();?>img/loader.gif"></div>');
			$('#loaderDiv').fadeIn('fast');
			$('button').attr('disabled', true);
			$.ajax({
                url: '<?php echo site_url();?>/insurance/pay_bulk',
                dataType :"json",
                async:false,
                data : {'ids': ids},
                type: 'POST',
                success: function(response)
                {
                	$("#loaderDiv").fadeOut('slow');
                	$('button').removeAttr('disabled');
                	var type = '' ;
					var message = '';
					var title = '';
					if(response == 1)
					{
						type ='success';
						message ='Mails sent Successfully!';
						title ='Success:';
					}
					else if(response == 2)
					{
						type = 'danger';
						message = 'Something went wrong...';
						title = 'Oops:';
					}
					else if(response == 3)
					{
						type = 'warning';
						message = 'Please select insurance';
						title = 'Warning:';
					}
					else if(response == 4)
					{
						type = 'warning';
						message = 'Invalid email address';
						title = 'Warning:';
					}
                    $.notify({
                            title: "<strong>"+title+"</strong> ",
                            message: message,
                            type: type,
                        },{
	                        delay: 800,
                            animate:{
                                enter: "animated fadeInUp",
                                exit: "animated fadeOutDown"
                            } 
                    });
                    if(response == 1)
                    {
	                    window.setTimeout(function(){
	                        window.location.href = '<?php echo site_url("insurance"); ?>';
	                    },1000);
	                }
                }
            });
		}
	});

	function remind(ins_id)
	{
		$('#list_insurance_wrapper').append('<div id="loaderDiv" class="" style="display: block; position: relative;  margin: 0 auto; align:center;  z-index:100;"><img style="margin: 0 auto; margin-top: 0px; position: relative; align-items: center; display: block; margin-top: -50px;" src="<?php echo assets_url();?>img/loader.gif"></div>');
		$('#loaderDiv').fadeIn('fast');
		$('button').attr('disabled', true);
		$.ajax({
            url: '<?php echo site_url();?>/insurance/pay/'+ins_id,
            dataType :"json",
            async:false,
            type: 'POST',
            success: function(response)
            {
            	$("#loaderDiv").fadeOut('slow');
                $('button').removeAttr('disabled');
            	var type = '' ;
				var message = '';
				var title = '';
				if(response == 1)
				{
					type ='success';
					message ='Mails sent Successfully!';
					title ='Success:';
				}
				else if(response == 2)
				{
					type = 'danger';
					message = 'Something went wrong...';
					title = 'Oops:';
				}
				else if(response == 3)
				{
					type = 'warning';
					message = 'Please select insurance';
					title = 'Warning:';
				}
				else if(response == 4)
				{
					type = 'warning';
					message = 'Invalid email address';
					title = 'Warning:';
				}
                $.notify({
                        title: "<strong>"+title+"</strong> ",
                        message: message,
                        type: type,
                    },{
                        delay: 800,
                        animate:{
                            enter: "animated fadeInUp",
                            exit: "animated fadeOutDown"
                        } 
                });
                if(response == 1)
                {
                    window.setTimeout(function(){
                        window.location.href = '<?php echo site_url("insurance"); ?>';
                    },1000);
                }
            }
        });
	}
	</script>