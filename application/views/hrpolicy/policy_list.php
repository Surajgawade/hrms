<body class="with-side-menu-addl-full">

<?php 

$can_type=$this->session->can_type;

if($this->session->flashdata('success')){
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
							<h2>Policy List</h2>
							<!-- <div class="subtitle">Welcome to Ultimate Dashboard</div> -->
						</div>
					
					</div>
				</div>
			</header>
			
			<section class="card">
				<div class="card-block">
					<?php //print_r($resi_dtls[0]->resi_title);die();?>
					<table id="candidate_list" class="display table table-bordered table-striped" cellspacing="0" width="100%" style="text-align: center;">
						<thead>
						<tr>
							<th  style="text-align: center !important;" style="width:15%">Sr. No.</th>
							<th style="text-align: center !important;" style="width:15%">Particular</th>
							<th style="text-align: center !important;" style="width:15%">Release Date</th>
							<th style="text-align: center !important;" style="width:15%">Uploaded Document</th>
						</tr>


						</thead>
						


						<?php
						if($can_type!='user'){

							//echo "gfgfdgdf";die();

						 $i=1; if(!empty($hr_policy_dtls)){


						foreach($hr_policy_dtls as $dt){ 

							?>
						<tbody>
							<td style="width:15%"><?php echo $i; ?></td>
							<td style="width:15%"><?php  echo isset($dt->particular) && !empty($dt->particular) ? $dt->particular : '-';?></td>
							<td style="width:15%"><?php echo db_to_date($dt->doc_upload_date); ?></td>
							<td style="width:15%"><a href="<?php echo base_url()."uploads/hr_doc/". $dt->doc_path; ?>" target="_blank"><img src="<?php echo assets_url().'/img/file-pdf.png'?>" style="width: 30px; height: 30px"></a></td>
						</tbody>
						<?php $i++; }




					}else{ ?>
						<tbody>
							<tr>
							<td style="width:15%" colspan="4"><span>Sorry no records found</span></td>
							</tr>
						</tbody>
						<?php } } 

						else{ ?>


					<?php 





					$i=0; if(!empty($hr_policy_dtls)){

						foreach($hr_policy_dtls as $dt){ 
							++$i; 
if($i<2){

							?>
						<tbody>
							<tr>
							<td style="width:15%"><?php echo $i; ?></td>
							<td style="width:15%"><?php  echo isset($dt->particular) && !empty($dt->particular) ? $dt->particular : '-';?></td>
							<td style="width:15%"><?php echo db_to_date($dt->doc_upload_date); ?></td>
							<td style="width:15%"><a href="<?php echo base_url()."uploads/hr_doc/". $dt->doc_path; ?>" target="_blank"><img src="<?php echo assets_url().'/img/file-pdf.png'?>" style="width: 30px; height: 30px"></a></td>
							</tr>
						</tbody>
						<?php
}else
{ 
	//var_dump('kjkjkjkj');
	break;
}

						 }

						}else{ ?>
						<tbody>
							<tr>
							<td style="width:15%" colspan="4"><span>Sorry no records found</span></td>
							</tr>
						</tbody>
						<?php } } ?>








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
       