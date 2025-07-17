<body class="with-side-menu-addl-full">
<?php if($this->session->flashdata('success')){
	?>
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
							<h2>Resignation</h2>
							<!-- <div class="subtitle">Welcome to Ultimate Dashboard</div> -->
						</div>
					
					</div>
				</div>
			</header>
			
			<section class="card">
				<div class="card-block">
					<?php //print_r($resi_dtls[0]->resi_title);die();?>
					<table id="candidate_list" class="table-responsive display table table-bordered table-striped" cellspacing="0" width="100%" style="text-align: center;">
						<thead>
						<tr>
							<!-- <th style="width:3%">id</th> -->
							<th  style="text-align: center !important;" style="width:15%">Employee Name</th>
							<th style="text-align: center !important;" style="width:15%">Request Date</th>
							<th style="text-align: center !important;" style="width:15%">Release Date</th>
							<th style="text-align: center !important;" style="width:15%">Head Status</th>
							<th style="text-align: center !important;" style="width:15%">HR Status</th>
							<th style="text-align: center !important;" style="width:15%">MD Status</th>
							<th style="text-align: center !important;" style="width:15%">Final Decision</th>
						</tr>
						</thead> 
<?php foreach($resi_dtls as $dt)
							{ ?>
						<tbody>

							<td style="width:15%"><?php echo $dt->resi_title; ?></td>
								
							<td style="width:15%"><?php echo date('d-m-Y', strtotime($dt->req_rel_date)); ?></td>
							<td style="width:15%"><?php echo date('d-m-Y', strtotime($dt->sys_rel_date)); ?></td>


							<td style="width:15%"><?php if($dt->pm_status==1){echo '<font color="red">Accepted</font>';}else{echo '<font color="green">process</font>';} ?>
					<?php echo $dt->pm_remark; ?>
							</td>


							<td style="width:15%">
								<?php if($dt->hr_status==1) { ?>
									<a href="<?php echo site_url();?>/resignation/hr_status_update/<?php echo $dt->resi_id; ?>/<?php echo $dt->hr_status; ?>">
										<font color="red">Accepted</font>
									</a>
								<?php } else { ?>
									<button type="button" id="accept_hd" onClick="get_property(<?php echo $dt->resi_id; ?>)" class="btn btn-success">Process</button>
								<?php } ?>
								<br />

								<?php if($dt->hr_remark == ""){ ?>
								<span style="padding-left: 20px;"><a data-toggle="modal" href="#myModal" class="remark" data-id="<?php echo $dt->resi_id; ?>" style="text-decoration: none; outline: 0;">Remark</a></span>
								<?php }else{
									echo $dt->hr_remark;
								} ?>
							</td>

							
							<td style="width:15%"><?php if($dt->md_status==1){echo '<font color="red">Accepted</font>';}else{echo '<font color="green">process</font>';} ?>
						<?php echo $dt->md_remark; ?>
							</td>



							<td style="width:10%"><?php if($dt->pm_status==1 && $dt->hr_status==1 && $dt->md_status==1){echo 'Release';}else{echo '<font color="green">In Process</font>';} ?>

						
							</td>
						
						</tbody>
						<?php } ?>
					</table>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->

 <!-- Modal -->

		 <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          	 <form data-toggle="validator" id="resetPassword" name="resetPassword" method="post" action="<?php echo site_url();?>/resignation/hr_remark/" >
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-body">
                          <p>Remark</p>
                          <input type="hidden" name="resi_id" id="callId" value="">
                          <textarea name="remark" id="remark" placeholder="Enter Your Remark" autocomplete="off" class="form-control placeholder-no-fix rest_stl" required rows="5"></textarea>
					<span class="error_msg" id ="forgot_err"></span>
                      </div>

					
                      <div class="modal-footer">
                          <button class="btn btn-success" type="submit" id="forgot_submit" name="submit" value="submit">Submit</button>
                          <button data-dismiss="modal" class="btn btn-success" type="button">Cancel</button>
                      </div>
                  </div>
              </div>
              </form>
          </div>
          <!-- modal -->

<!-- Modal 2 -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="handoverModal" class="modal fade">
	<form data-toggle="validator" id="handover_form" name="handover_form" method="post" action="">
  		<div class="modal-dialog">
      		<div class="modal-content">
      			<div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	                <h4 class="modal-title">Employee Properties</h4>
	            </div>
          		<div class="modal-body">
      				<input type="hidden" name="resi_id" id="resi_id" value="">
      				<input type="hidden" name="status" id="status" value="0">
          			<table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%" style="text-align: center;">
          				<thead>
          					<tr>
          						<th>Check</th>
          						<th>Department</th>
          						<th>Property</th>
          						<th>Reason</th>
          						<th>Penalty</th>
          					</tr>
          				</thead>
          				<tbody id="property_data"></tbody>
          				<tfoot>
          					<tr>
          						<td colspan="5">
          							<button class="btn btn-success" type="button" id="save_prop">Submit</button>
          							<button data-dismiss="modal" class="btn btn-danger" type="button">Cancel</button>
          						</td>
          					</tr>
          				</tfoot>
          			</table>
          		</div>
      		</div>
  		</div>
  	</form>
</div>
<!-- modal 2 -->
<script type="text/javascript">
$(document).on("click", ".remark", function (e) {
    e.preventDefault();
    var _self = $(this);
    var myCallId = _self.data('id');
    $("#callId").val(myCallId);
    $(_self.attr('href')).modal('show');
});

function get_property(res_id)
{
	$('#resi_id').val(res_id);
	$.ajax({
        url: '<?php echo site_url();?>/resignation/get_can_property/'+res_id,
        type: 'POST',
        success: function(response_prop)
        {
        	var data = '';
        	if(response_prop.length != 0 && response_prop != '[]' && response_prop != '' && response_prop != 'null')
        	{
        		response_prop = JSON.parse(response_prop);
        		$.each(response_prop, function(key1, val1) {
        			console.log(val1);
        			data += '<tr><td><input type="checkbox" class="prop_chk" id="chk-'+key1+'" value="'+key1+'" style="zoom:1.5"><input type="hidden" name="rec-can_asset_id-'+key1+'" value="'+val1.can_asset_id+'"><input type="hidden" name="rec-can_id-'+key1+'" value="'+val1.can_id+'"><input type="hidden" name="rec-prop_id-'+key1+'" value="'+val1.asset_id+'"><input type="hidden" name="rec-dept_id-'+key1+'" value="'+val1.dept_id+'"><input type="hidden" name="rec-res_id-'+key1+'" value="'+val1.res_id+'"></td><td>'+val1.department+'</td><td>'+val1.property+'</td><td><input type="text" name="rec-reason-'+key1+'" id="reason-'+key1+'"></td><td><input type="text" name="rec-penalty-'+key1+'" id="penalty-'+key1+'"></td></tr>';
        		});
        	}
        	else
        	{
        		data = '<tr><td colspan="5" class="text-center"><span class="text-danger h3">No Property assigned to this Employee.</span></td></tr>';
        	}
        	$('#property_data').html(data);
        	$('#handoverModal').modal('show');
        	$(".prop_chk").on('click', function() {
				var id = $(this).val();
				if($(this).is(':checked'))
				{
					$('#reason-'+id).attr('disabled', true);
					$('#penalty-'+id).attr('disabled', true);
				}
				else
				{
					$('#reason-'+id).removeAttr('disabled');
					$('#penalty-'+id).removeAttr('disabled');
				}
			});
        }
    });
}

$('#save_prop').on('click', function() {
	var fdata = $('#handover_form').serialize();
	$.ajax({
        url: '<?php echo site_url();?>/resignation/save_handover/',
        type: 'POST',
        data:fdata,
        success: function(response)
        {
        	$('#handoverModal').modal('hide');
        	$('#property_data').html('');
        	$.notify({
				title: "<strong>Success:</strong> ",
				message: "Response saved successfully !",
			},
			{
				type: "success",
				delay: 800,
				animate:{
					enter: "animated fadeInUp",
					exit: "animated fadeOutDown"
				}
			});
        	setTimeout(function () {
        		window.location.reload();
        	}, 2000);
        }
    });
});
</script>