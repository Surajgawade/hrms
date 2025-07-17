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
						<!-- <div class="add_btn col-md-2">
							<a href="<?php //echo site_url();?>/resignation/send_resig">
								<button class="btn btn-inline btn-primary ladda-button" data-style="expand-right">
								<span class="ladda-label">Mail Request</span>
								<span class="ladda-spinner"></span>
								<div class="ladda-progress" style="width: 0px;"></div>
							</button>
							</a>
						</div> -->
					</div>
				</div>
			</header>
			
			<section class="card">
				<div class="card-block">
					<?php //print_r($resi_dtls[0]->resi_title);die();?>
					<table id="candidate_list" class="table-responsive display table table-bordered table-striped" cellspacing="0" width="100%" style="text-align: center;">
						<thead>
						<tr>
							<!-- <th st yle="width:3%">id</th> -->
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
								<br />
								<?php echo $dt->pm_remark; ?>

							</td>


							<td style="width:15%"><?php if($dt->hr_status==1){echo '<font color="red">Accepted</font>';}else{echo '<font color="green">process</font>';} ?>
								<br />

						<?php echo $dt->hr_remark; ?>
							</td>

							
							<td style="width:15%"><?php if($dt->md_status==1){?><a href="<?php echo site_url();?>/resignation/md_status_update/<?php echo $dt->resi_id; ?>/<?php echo $dt->md_status; ?>"><font color="red">Accepted</font></a><?php }else{ ?><a href="<?php echo site_url();?>/resignation/md_status_update/<?php echo $dt->resi_id; ?>/<?php echo $dt->md_status; ?>"><font color="blue">process</font></a><?php } ?>
								<br />

								<?php if($dt->md_remark == ""){ ?>
								<span style="padding-left: 20px;"><a data-toggle="modal" href="#myModal" class="remark" data-id="<?php echo $dt->resi_id; ?>" style="text-decoration: none; outline: 0;">Remark</a></span>
								<?php }else{
									echo $dt->md_remark;
								} ?>


							</td>
							<td style="width:10%"><?php if($dt->pm_status==1 && $dt->hr_status==1 && $dt->md_status==1){echo 'Release';}else{echo '<font color="green">In Process</font>';} ?></td>
						
						</tbody>
						<?php } ?>
					</table>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->

<!-- Modal -->

		 <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          	 <form data-toggle="validator" id="resetPassword" name="resetPassword" method="post" action="<?php echo site_url();?>/resignation/md_remark/" >
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
<script>
	$(document).on("click", ".remark", function (e) {

    e.preventDefault();

    var _self = $(this);

    var myCallId = _self.data('id');
    $("#callId").val(myCallId);
    

    $(_self.attr('href')).modal('show');
});
</script>

