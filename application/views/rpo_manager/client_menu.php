<?php 
	$total = $this->uri->total_segments();
	$last = $this->uri->segment($total);
?>
<style type="text/css">
 	a:hover{
 cursor: pointer!important;
}
 </style>
<div class="row">
<div class="col-sm-12">
	
		<div class="menu_btns hidden-xs hidden-sm">
			<div class="arrow-steps clearfix">
				

				<?php if(is_numeric($last)){ ?>
				<a class="step <?php echo ($access_method=='add_edit_client')? 'current' : 'step' ?>"  href="<?php echo site_url();?>/rpo_manager/add_edit_client/<?php echo  $last;?>">
					<span>Client Details</span>
				</a>
				<a class="step <?php echo ($access_method=='contract_document_list')? 'current' : 'step' ?>"  href="<?php echo site_url();?>/rpo_manager/contract_document_list/<?php echo  $last;?>">
					<span>Documents</span>
				</a>
				<?php } ?>
			</div>
 
		</div>
	</div>
</div>    
