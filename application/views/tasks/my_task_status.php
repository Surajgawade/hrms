
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
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>Task Status </h2>
						</div>
					</div>
				</div>
			</header>
			

			
			<section class="card">
				<div class="card-block">
					<!-- <div class="row top_task_row">
						<div class="col-md-3">
							<div class="task_head task_green">
								Open
							</div>
						</div>
						<div class="col-md-3">
							<div class="task_head task_red">
								In-Progress
							</div>
						</div>
						<div class="col-md-3">
							<div class="task_head task_blue">
								Completed
							</div>
						</div>
						<div class="col-md-3">
							<div class="task_head task_yellow">
								Reopen
							</div>
						</div>
					</div> -->


				<div class="col-lg-12 col-md-12 task_view_status nopadding">
					<div class="row">
						<div class="col-lg-3 col-md-6">
							<div class="task_head task_green">
								Open
							</div>
									<?php foreach ($opened as $row)
							{ ?> 
							<div class="task_body task_color_green">
								
							<!-- <td> -->
								<article class="task_row">
		                                <div class="user-card-row">
		                                    <div class="tbl-row">
		                                        
		                                        <div class="tbl-cell">
		                                           <div class="full_row">
		                                           <div class="row"> 
		                                           	<div class="user_img col-md-3 col-sm-3 col-xs-3">
		                                           		<?php if(empty($row['profile_picture'])){?>
		                                           			<img src="<?php echo base_url().PROFILE_PATH.'no_profile_image.png';?>" alt=""/>
		                                           			<?php } else{?>
		                                           			<img src="<?php echo base_url().PROFILE_PATH.$row['profile_picture'];?>" alt=""/>
		                                           		<?php } ?>
		                                           	</div>
		                                           	<div class="col-md-9 col-sm-9 col-xs-9 no-padding">
		                                           		<div class="task_user_name">
		                                           			<?php echo $row['can_name'];?>
		                                           		</div>
		                                           		<div class="rgt_task">Task Name : <?php echo $row['task_name'];?> </div>
		                                           		
		                                           	</div>
		                                        	</div>
		                                        </div>
		                                            <div class="full_row"> 
		                                            	<div class="rgt_time">Turn Around Time </div>
		                                            	<div class="">: <?php echo $row['tat'];?></div>
		                                        	</div>
		                                        	<div class="full_row"> 
		                                            	<div class="rgt_time">Priority </div>	
		                                            	<div class="high_red">: <?php echo $row['priority'];?>
		                                            	</div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </article>
							<!-- </td> -->
							</div>
							<?php } ?>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="task_head task_red">
								In-Progress
							</div>
							<?php foreach ($in_progress as $row)
						{ ?> 
							<div class="task_body task_color_red">
							<article class="task_row">
	                                <div class="user-card-row">
	                                    <div class="tbl-row">
	                                         <div class="tbl-cell">
		                                           <div class="full_row">
		                                           <div class="row"> 
		                                           	<div class="user_img col-md-3 col-sm-3 col-xs-3">
		                                           		<?php if(empty($row['profile_picture'])){?>
		                                           			<img src="<?php echo base_url().PROFILE_PATH.'no_profile_image.png';?>" alt=""/>
		                                           			<?php } else{?>
		                                           			<img src="<?php echo base_url().PROFILE_PATH.$row['profile_picture'];?>" alt=""/>
		                                           		<?php } ?>
		                                           	</div>
		                                           	<div class="col-md-9 col-sm-9 col-xs-9 no-padding">
		                                           		<div class="task_user_name">
		                                           			<?php echo $row['can_name'];?>
		                                           		</div>
		                                           		<div class="rgt_task">Task Name : <?php echo $row['task_name'];?> </div>
		                                           		
		                                           	</div>
		                                        	</div>
		                                        </div>
		                                            <div class="full_row"> 
		                                            	<div class="rgt_time">Turn Around Time </div>
		                                            	<div class="">: <?php echo $row['tat'];?></div>
		                                        	</div>
		                                        	<div class="full_row"> 
		                                            	<div class="rgt_time">Priority </div>	
		                                            	<div class="high_red">: <?php echo $row['priority'];?>
		                                            		
		                                            	<!-- 	<a href="reopen_task/<?php echo $row['taskm_id']?>"  class="tabledit-edit-button btn btn-sm btn_edit btn-success pull-right"><span class="glyphicon glyphicon-pencil"></span> Reopen </a> -->
		                                            	</div>
		                                            </div>
		                                        </div>
	                                        
	                                    </div>
	                                </div>
	                            </article>
							</div>
						<?php } ?>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="task_head task_blue">
								Completed
							</div>
									<?php foreach ($completed as $row)
						{ ?> 
							<div class="task_body task_color_blue">
							<article class="task_row">
	                                <div class="user-card-row">
	                                    <div class="tbl-row">
	                                        
	                                    	<div class="tbl-cell">
		                                           <div class="full_row">
		                                           <div class="row"> 
		                                           	<div class="user_img col-md-3 col-sm-3 col-xs-3">
		                                           		<?php if(empty($row['profile_picture'])){?>
		                                           			<img src="<?php echo base_url().PROFILE_PATH.'no_profile_image.png';?>" alt=""/>
		                                           			<?php } else{?>
		                                           			<img src="<?php echo base_url().PROFILE_PATH.$row['profile_picture'];?>" alt=""/>
		                                           		<?php } ?>
		                                           	</div>
		                                           	<div class="col-md-9 col-sm-9 col-xs-9 no-padding">
		                                           		<div class="task_user_name">
		                                           			<?php echo $row['can_name'];?>
		                                           		</div>
		                                           		<div class="rgt_task">Task Name : <?php echo $row['task_name'];?> </div>
		                                           		
		                                           	</div>
		                                        	</div>
		                                        </div>
		                                            <div class="full_row"> 
		                                            	<div class="rgt_time">Turn around time </div>
		                                            	<div class="">: <?php echo $row['tat'];?></div>
		                                        	</div>
		                                        	<div class="full_row"> 
		                                            	<div class="rgt_time">Priority </div>	
		                                            	<div class="high_red">: <?php echo $row['priority'];?>
		                                            		
		                                            		<a href="reopen_task/<?php echo $row['taskm_id']?>"  class="tabledit-edit-button btn btn-sm btn_edit btn-success pull-right"><span class="glyphicon glyphicon-pencil"></span> Reopen </a>
		                                            	</div>
		                                            </div>
		                                        </div>
	                                    </div>
	                                </div>
	                            </article>
							</div>
						<?php } ?>
						</div>

						<div class="col-lg-3 col-md-6">
							<div class="task_head task_yellow">
								Reopen
							</div>
							<?php foreach ($reopen as $row)
						{ ?> 
							<div class="task_body task_color_yellow">
							<article class="task_row">
	                                <div class="user-card-row">
	                                    <div class="tbl-row">
	                                        
	                                       <div class="tbl-cell">
		                                           <div class="full_row">
		                                           <div class="row"> 
		                                           	<div class="user_img col-md-3 col-sm-3 col-xs-3">
		                                           		<?php if(empty($row['profile_picture'])){?>
		                                           			<img src="<?php echo base_url().PROFILE_PATH.'no_profile_image.png';?>" alt=""/>
		                                           			<?php } else{?>
		                                           			<img src="<?php echo base_url().PROFILE_PATH.$row['profile_picture'];?>" alt=""/>
		                                           		<?php } ?>
		                                           	</div>
		                                           	<div class="col-md-9 col-sm-9 col-xs-9 no-padding">
		                                           		<div class="task_user_name">
		                                           			<?php echo $row['can_name'];?>
		                                           		</div>
		                                           		<div class="rgt_task">Task Name : <?php echo $row['task_name'];?> </div>
		                                           		
		                                           	</div>
		                                        	</div>
		                                        </div>
		                                            <div class="full_row"> 
		                                            	<div class="rgt_time">Turn around time </div>
		                                            	<div class="">: <?php echo $row['tat'];?></div>
		                                        	</div>
		                                        	<div class="full_row"> 
		                                            	<div class="rgt_time">Priority </div>	
		                                            	<div class="high_red">: <?php echo $row['priority'];?>
		                                            	</div>
		                                            </div>
		                                        </div>
	                                    </div>
	                                    </div>
	                            </article>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>

			</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->	


