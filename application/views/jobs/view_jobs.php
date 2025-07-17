<div class="page-content">
		<div>
		<?php if($this->session->flashdata('success')){?><?php }?>	
	</div>
<div class="container-fluid">	
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
					<h2>Job Manager</h2>
			</div>
		</div>
	</header>
	<div class="container-fluid">
		<div class="row">
	 		<div class="col-md-2">
	 			<h5><label>Job Title:</label></h5>
	 		</div>
	 		<div class="col-md-10">
	 			<p><?php if(isset($job_details->job_title)) echo $job_details->job_title;  ?></p>
	 		</div>
	 	</div>
	 	<div class="row">
	 		<div class="col-md-2">
	 			<h5><label>Status:</label></h5>
	 		</div>
	 		<div class="col-md-10">
	 			<p><?php if(isset($job_details->status)){ echo $job_details->status; } ?></p>
	 		</div>
		</div>
		<div class="row">
                        <div class="col-md-2">
                                <h5><label>Job Description:</label></h5>
                        </div>
                        <div class="col-md-10">
                                <p><?php if(isset($job_details->job_description)) echo $job_details->job_description;  ?></p>
                        </div>
                </div>
                <div class="row">
                        <div class="col-md-2">
                                <h5><label>No. of openings:</label></h5>
                        </div>
                        <div class="col-md-10">
                                <p><?php if(isset($job_details->no_of_position)){ echo $job_details->no_of_position; } ?></p>
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
