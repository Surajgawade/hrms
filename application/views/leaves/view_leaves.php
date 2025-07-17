<div class="page-content">
		<div>
		<?php if($this->session->flashdata('success')){?><?php } ?>	
	</div>
<div class="container-fluid">	
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
					<h2>Leave Manager</h2>
			</div>
		</div>
	</header>
	<div class="container-fluid">
		<div class="row">
	 		<div class="col-md-2">
	 			<h5><label>Leave type:</label></h5>
	 		</div>
	 		<div class="col-md-10">
	 			<p><?php if(isset($leave_details->leave_title)) echo $leave_details->leave_title;  ?></p>
	 		</div>
	 	</div>
	 	<div class="row">
	 		<div class="col-md-2">
	 			<h5><label>Acronym:</label></h5>
	 		</div>
	 		<div class="col-md-10">
	 			<p><?php if(isset($leave_details->acronym)){ echo $leave_details->acronym; } ?></p>
	 		</div>
		</div>
	 	
		<div class="row">
			<div class="col-md-11 text-right">
				<a href="javascript:window.history.go(-1);" class="btn btn-primary btn-sm">Back To List</a>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
	 	
</div>