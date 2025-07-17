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
						<div class="add_btn col-md-2">
							<a href="<?php echo site_url();?>/resignation/send_resig">
								<button class="btn btn-inline btn-primary ladda-button" data-style="expand-right">
								<span class="ladda-label">Mail Request</span>
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
<?php if($resi_dtls!=null){?>
					<table id="candidate_list" class="table-responsive display table table-bordered table-striped" cellspacing="0" width="100%">
						

						<thead>
						<tr>
							<!-- <th style="width:3%">id</th> -->
							<th style="width:15%">Employee Name</th>
							<th style="width:15%">Request Date</th>
							<th style="width:15%">Release Date</th>
							<th style="width:15%">Head Status</th>
							<th style="width:15%">HR Status</th>
							<th style="width:15%">MD Status</th>
							<th style="width:15%">Final Decision</th>
						</tr>
						</thead> 

						<tbody>
							<?php

							 foreach($resi_dtls as $dt)
							{ ?>	
							<tr>	
							<td><?php echo $dt->resi_title; ?></td>
							<td><?php echo date('d-m-Y', strtotime($dt->req_rel_date)); ?></td>
							<td><?php echo date('d-m-Y', strtotime($dt->sys_rel_date)); ?></td>


							<td><?php if($dt->pm_status==1){echo '<font color="red">Accepted</font>';}else{echo '<font color="green">process</font>';} ?>
								<br />
								<?php if(strlen($dt->pm_remark) > 20) { ?>
									<?php echo substr($dt->pm_remark, 0, 20); ?>
									<input type="hidden" id="pm_re" value="<?php echo $dt->pm_remark ?>">
									 <a type="button" onclick="get_modal('pm')"><strong>More ...</strong></a>
								<?php } else { ?>
									<?php echo $dt->pm_remark; } ?>
							</td>


							<td><?php if($dt->hr_status==1){echo '<font color="red">Accepted</font>';}else{echo '<font color="green">process</font>';} ?>
								<br />
								<?php if(strlen($dt->hr_remark) > 20) { ?>
									<?php echo substr($dt->hr_remark, 0, 20); ?>
									<input type="hidden" id="hr_re" value="<?php echo $dt->hr_remark ?>">
									 <a type="button" onclick="get_modal('hr')"><strong>More ...</strong></a>
								<?php } else { ?>
									<?php echo $dt->hr_remark; } ?>
							</td>

							
							<td><?php if($dt->md_status==1){echo '<font color="red">Accepted</font>';}else{echo '<font color="green">process</font>';} ?>
								<br />
								<?php if(strlen($dt->md_remark) > 20) { ?>
									<?php echo substr($dt->md_remark, 0, 20); ?>
									<input type="hidden" id="md_re" value="<?php echo $dt->md_remark ?>">
									 <a type="button" onclick="get_modal('md')"><strong>More ...</strong></a>
								<?php } else { ?>
									<?php echo $dt->md_remark; } ?>
							</td>
							<td><?php if($dt->pm_status==1 && $dt->hr_status==1 && $dt->md_status==1){echo 'Release';}else{echo '<font color="green">In Process</font>';} ?></td>
						</tr>
						<?php } ?>

						</tbody>
						
					</table>
					<?php }else {echo "Sorry No Record Found";}?>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="remark_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
  			<div class="modal-header">
      			<h4 class="modal-title"><span id="author"></span> Remark</h4>
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  			</div>

  			<div class="modal-body">
      			<textarea rows="3" name="remark" id="remark" placeholder="Remark" autocomplete="off" class="form-control placeholder-no-fix rest_stl" disabled></textarea>
			</div>

			<div class="modal-footer">
      			<button data-dismiss="modal" class="btn btn-success" type="button">Close</button>
  			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	function get_modal(type)
	{
		var rem = '';
		$('#remark').val('');
		if(type == 'pm')
		{
			rem = $('#pm_re').val();
		}
		else if(type == 'hr')
		{
			rem = $('#hr_re').val();
		}
		else
		{
			rem = $('#md_re').val();
		}
		$('#author').html(type);
		$('#remark').val(rem);
		$('#remark_modal').modal('show');
	}
</script>