<div class="page-content">
		<div class="container-fluid ">	
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
		<div class="container-fluid p-xl-0">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>Employee Experience Summary</h2>
						</div>
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/candidate/add_experience/<?php echo $this->uri->segment(3);?>">
								<button class="btn btn-inline btn-primary ladda-button" data-style="expand-right">
								<span class="ladda-label">Add Experience</span>
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
					<table id="experience_list" class="display table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:15%">Company Name</th>
								<th style="width:15%">Working From</th>
								<th style="width:15%">Working To</th>
								<th style="width:15%">Designation</th>
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
$(function () {
	get_experience();
});
function get_experience()
{
	var id = '<?php echo $this->uri->segment(3); ?>';
	//var is_exist = '<?php //echo check_record_exist($tablename='experience', $conditions = array('can_id' =>$this->uri->segment(3)));?>';
	oTable = $('#experience_list').DataTable({
		'responsive': true,
		'bProcessing'    : true,
		'bServerSide'    : true,
		"language": {
	    	processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
	  	},
		"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
		'sPaginationType': 'full_numbers',
		"aoColumns": [
			{"sName": "company_name", "mData": "company_name" ,"bSortable":true},
			{"sName": "working_from", "mData": "working_from" ,"bSortable":true},
			{"sName": "working_to", "mData": "working_to" ,"bSortable":false },
			{"sName": "title", "mData": "title" ,"bSortable":false },
			{"sName": "Actions", "mData": "edit" ,"bSortable":false,"bSearchable":false}
		],
		'sAjaxSource'    : '<?php echo site_url();?>'+'/candidate/experience_details/'+id,
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
			frm_date = format_date(data.working_from);
			t_date  = format_date(data.working_to);
			$('td', row).eq(1).text(frm_date);
			$('td', row).eq(2).text(t_date);
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
		var  exp_id = id;
		$.ajax({
			url: '<?php echo site_url();?>/candidate/delete_exp',
			data : {exp_id: exp_id},
			type: 'POST',
			success: function(response){
						var type='' ;
						var message='' ;
						var title='' ;
						if(response==1)
						{
							type ='success';
							message ='Experience details deleted successfully!';
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
		oTable.draw();
	return true;	
	});
}

function format_date(date)
{
	var d = new Date(date);
	var curr_month = parseInt(d.getMonth())+1;
	if(curr_month < 10)
	{
		curr_month = '0'+curr_month;
	}
	var curr_year = d.getFullYear();
	var newDate = curr_month+'/'+curr_year;
	return newDate;
}
</script>
