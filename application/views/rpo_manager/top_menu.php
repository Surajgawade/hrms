<?php 
	$total = $this->uri->total_segments();
	$last = $this->uri->segment($total);
	// $this->db->order_by('inw_mid', 'desc');
	// $interview_status = $this->db->select()->get_where('rpo_interview_manager', array('intw_can_id'=>$last, 'is_deleted'=>0),1)->row_array();


	$this->db->select('is_interested');
	$this->db->from('rpo_interview_candidate_records');
	$this->db->where(array('intw_can_id'=>$last, 'is_deleted'=>0));
	$is_interested = $this->db->get()->row_array();

	$this->db->select('interview_status, schedule_date');
	$this->db->from('rpo_interview_manager');
	$this->db->where(array('intw_can_id'=>$last, 'is_deleted'=>0));
	$this->db->order_by('inw_mid','desc');
	$this->db->limit(1);
	$interview_status = $this->db->get()->row_array();
	$now=date('Y-m-d');


?>
<style type="text/css">
 	a:hover{
 cursor: pointer!important;
}
 </style>

 <div>
	<div class="menu d-lg-none">
		<ul>
			<?php if(is_numeric($last)){ ?>
				<li><a class="step <?php echo ($access_method=='add_edit')? 'current' : 'step' ?>"  href="<?php echo site_url();?>/rpo_interview/add_edit/<?php echo  $last;?>">
					<span>Candidate Details</span>
				</a></li>
				<?php if($is_interested['is_interested']=='yes'){?>
				<li><a class="step <?php echo ($access_method=='interview_details')? 'current' : 'step' ?>"  href="<?php echo site_url();?>/rpo_interview/interview_details/<?php echo  $last;?>">
					<span>Interview Details</span>
				</a></li>
				<?php if(($interview_status['interview_status'] == 'selected') && strtotime($interview_status['schedule_date'])<=strtotime($now)) { ?>
				<li><a class="step <?php echo ($access_method=='add_edit_hrdetails')? 'current' : 'step' ?>" href="<?php echo site_url();?>/rpo_interview/add_edit_hrdetails/<?php echo $last;?>">
					<span>HR Round Details</span>
				</a></li>
				<li><a class="step <?php echo ($access_method=='offer_letter')? 'current' : 'step' ?>" href="<?php echo site_url();?>/rpo_interview/offer_letter/<?php echo $last;?>">
					<span>Offer Letter</span> 
				</a></li>
				<li><a class="step <?php echo ($access_method=='joining_process')? 'current' : 'step' ?>" href="<?php echo site_url();?>/rpo_interview/joining_process/<?php echo $last;?>">
					<span>Joining Process</span> 
				</a></li>
				<?php } } }?>
		</ul>
	</div>
	<div class="menu-toggle d-lg-none">
		<a href="#">Menus &nbsp;<i class="fa fa-angle-double-down"></i></a>
	</div>	
</div>
<div class="row">
<div class="col-sm-12">
	
		<div class="menu_btns hidden-xs hidden-sm">
			<div class="arrow-steps clearfix">				

				<?php if(is_numeric($last)){ ?>
				<a class="step <?php echo ($access_method=='add_edit')? 'current' : 'step' ?>"  href="<?php echo site_url();?>/rpo_interview/add_edit/<?php echo  $last;?>">
					<span>Candidate Details</span>
				</a>
				<?php if($is_interested['is_interested']=='yes'){?>
				<a class="step <?php echo ($access_method=='interview_details')? 'current' : 'step' ?>"  href="<?php echo site_url();?>/rpo_interview/interview_details/<?php echo  $last;?>">
					<span>Interview Details</span>
				</a>
				<?php if(($interview_status['interview_status'] == 'selected')  && strtotime($interview_status['schedule_date'])<=strtotime($now)){ ?>
				<a class="step <?php echo ($access_method=='add_edit_hrdetails')? 'current' : 'step' ?>" href="<?php echo site_url();?>/rpo_interview/add_edit_hrdetails/<?php echo $last;?>">
					<span>HR Round Details</span>
				</a>
				<a class="step <?php echo ($access_method=='offer_letter')? 'current' : 'step' ?>" href="<?php echo site_url();?>/rpo_interview/offer_letter/<?php echo $last;?>">
					<span>Offer Letter</span> 
				</a>
				<a class="step <?php echo ($access_method=='joining_process')? 'current' : 'step' ?>" href="<?php echo site_url();?>/rpo_interview/joining_process/<?php echo $last;?>">
					<span>Joining Process</span> 
				</a>
				<?php } } }?>
			</div>
 
		</div>
	</div>
</div>    
<script>
	$(document).ready(function(){
		$(".menu-toggle a").click(function(){ 
			$(".menu").slideToggle(700);
		});
	});
</script>