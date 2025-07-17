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
	<!-- <div class="container-fluid">
		
	</div> -->
	<div class="container-fluid">
		<div class="well">
			 
			 		<h1 class="well headline"><?php if(isset($news_details->nw_title)){ echo $news_details->nw_title; } ?>
						<a style="margin-top:3px" class="pull-right btn btn-success btn-md m-r" href="javascript:window.history.go(-1);">Back To List</a>
					</h1>
					<div class="col-sm-12 col-xs-12 profile_bg" style="padding: 10px !important;">
						<div class="row">
							<div class="col-lg-3 col-sm-3 col-xs-12">
								
									<?php if(isset($news_details->image_name)) {?>
									 <img class="img-responsive" style="border:6px ridge #fad9af;" src="<?php echo base_url(); ?>/uploads/newsImage/<?php echo $news_details->image_name; ?>"> <?php } ?> 
								
							</div>
						
							<div class="col-lg-9 col-sm-9 col-xs-12 new_p">
								<?php if(isset($news_details->nw_description)){ echo $news_details->nw_description; } ?>
							</div>
						</div>

					</div>
				
		
		</div>
	</div>
</div>
