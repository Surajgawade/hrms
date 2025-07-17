<div class="page-content">
	<div class="container-fluid p-xl-0">
		<div class="well">
			 <div class="row">
			 	<div class="col-sm-12">
					<?php if($this->session->flashdata('success')){?>
					<script type="text/javascript">
					var message_text='<?php echo $this->session->flashdata('success');?>';
						$.notify({
							title: "<strong>"+title+"</strong> ",
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
				
						<div class="col-sm-12 col-xs-12 profile_bg">
							
						
								<h1 class="well headline">Resignation </h1>
								
							

						
						
						

						<div class="row">
							<div class="col-lg-12" style="text-align: center;"><br /><br />
								<strong>Resignation send sucsessfully wait for reply....</strong>
								<br /><br />
							</div>
						</div>
			 </div>
		</div>
		
		
		</div>										
	</div>