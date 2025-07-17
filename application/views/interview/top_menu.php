<?php 
	$total = $this->uri->total_segments();
	$slast = $this->uri->segment($total);
	$last = $this->uri->segment($total-1);
	$this->db->select('is_interested, schedule_date');
	$this->db->from('interview_candidate_records');
	$this->db->where(array('intw_can_id'=>$last, 'is_deleted'=>0));
	$can_status = $this->db->get()->row_array();
	// x_debug($can_status);
	$this->db->select('interview_status');
	$this->db->from('interview_manager');
	$this->db->where(array('intw_can_id'=>$last, 'is_deleted'=>0));
	$this->db->order_by('inw_mid','desc');
	$this->db->limit(1);
	$interview_status = $this->db->get()->row_array();
	$now=date('Y-m-d');
	$interval=date_diff(date_create($can_status['schedule_date']),date_create($now));
	$interval=$interval->format('%R%a');


?>
<style type="text/css">
 	a:hover{
 cursor: pointer!important;
}
 </style>
<div>
	
	<div class="menu d-lg-none">
		<ul>
			<?php if($slast=='old'){ ?>
				<li><a class="step <?php echo ($access_method=='add_edit')? 'current' : 'step' ?>"  href="<?php echo site_url();?>/interview/add_edit/<?php echo  $last.'/'.$slast;?>">
					<span>Candidate Details</span>
				</a></li>
				<?php if($can_status['is_interested']=='yes'){?>				
				<li><a class="step <?php echo ($access_method=='insert_data')? 'current' : 'step' ?>"  href="<?php echo site_url();?>/interview/insert_data/<?php echo  $last.'/'.$slast;?>">
					<span>Interview Details</span>
				</a></li>
				<?php if(($interview_status['interview_status'] == 'selected') && ($interval<=0)) { ?>
				<li><a class="step <?php echo ($access_method=='add_edit_hr')? 'current' : 'step' ?>" href="<?php echo site_url();?>/interview/add_edit_hr/<?php echo  $last.'/'.$slast;?>">
					<span>HR Round Details</span>
				</a></li>
				<li><a class="step <?php echo ($access_method=='offer_letter')? 'current' : 'step' ?>" href="<?php echo site_url();?>/interview/offer_letter/<?php echo  $last.'/'.$slast;?>">
					<span>Offer Letter</span> 
				</a></li>
				<?php } } }?>
		</ul>
	</div>
	<div class="menu-toggle d-lg-none">
		<a href="#">Menus &nbsp;<i class="fa fa-angle-double-down"></i></a>
	</div>					
</div>
<div class="col-sm-12">
	<div class="row">
		<div class="menu_btns hidden-xs hidden-sm">
			<div class="arrow-steps clearfix">
				<?php if($slast=='old'){ ?>
				<a class="step <?php echo ($access_method=='add_edit')? 'current' : 'step' ?>"  href="<?php echo site_url();?>/interview/add_edit/<?php echo  $last.'/'.$slast;?>">
					<span>Candidate Details</span>
				</a>
				<?php if($can_status['is_interested']=='yes'){?>				
				<a class="step <?php echo ($access_method=='insert_data')? 'current' : 'step' ?>"  href="<?php echo site_url();?>/interview/insert_data/<?php echo  $last.'/'.$slast;?>">
					<span>Interview Details</span>
				</a>
				<?php if(($interview_status['interview_status'] == 'selected') && ($interval<=0)) { ?>
				<a class="step <?php echo ($access_method=='add_edit_hr')? 'current' : 'step' ?>" href="<?php echo site_url();?>/interview/add_edit_hr/<?php echo  $last.'/'.$slast;?>">
					<span>HR Round Details</span>
				</a>
				<a class="step <?php echo ($access_method=='offer_letter')? 'current' : 'step' ?>" href="<?php echo site_url();?>/interview/offer_letter/<?php echo  $last.'/'.$slast;?>">
					<span>Offer Letter</span> 
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