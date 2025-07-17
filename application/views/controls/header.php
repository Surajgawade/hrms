<?php $userdata = $this->session->userdata('logged_in_user');
		$user_settings=$this->session->userdata('user_settings');
		$this->load->helper('file');
		$string = read_file(APPPATH.'/launch_date.txt');
		$date = date_create($string);
		$ndate = date_create(date('Y-m-d'));
		$diff = date_diff($date,$ndate);
		$d = $diff->format("%R%a");

		if($d > 15)
		{
			redirect('expire_trial_pack');
		}
		else
		{
			$days = 15 - $d;
		}
		if(!empty($config_settings['company_outer_logo']) && file_exists(UPLOADPATH.'logo/'.$config_settings['company_outer_logo']))
		{
			$logo_img = base_url().LOGO_PATH.$config_settings['company_outer_logo'];
		}
		else
		{
			$logo_img = assets_url().'img/login.png';
		}
		$is_rpo_can =$this->session->userdata('is_rpo_can');
		if($is_rpo_can)
		{
			$update_profile_url = '/rpo_manager/add_edit_rpo_candidate/';
			$profile_setting_url = '/rpo_manager/settings';
	  		$profile_path = RPO_PROFILE_PATH;
		}
		else
		{
			$update_profile_url = '/candidate/update/';
			$profile_setting_url = '/profile/settings';
	  		$profile_path = PROFILE_PATH;
		}
?>
<body class="with-side-menu control-panel control-panel-compact">
	<div class="se-pre-con"></div>
	<header class="site-header">
	    <div class="container-fluid p-0">
	    	<div class="upperleft">
	    	 <div class="brand"> 
		        <a href="#" class="site-logo logo">
		            <img class="" src="<?php echo $logo_img;?>" alt="">
		        </a>
		    </div>
		    <div class="days_left hidden-sm hidden-lg hidden-md">
        		<span><?php echo $days; ?> DAYS REMAINING</span>
			</div>
      		<div class="sidebar-toggle-box">
		        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
		            <span>toggle menu</span>
		        </button>
		
		        <button class="hamburger hamburger--htla">
		            <span>toggle menu</span>
		        </button>
		    </div>
		</div>
		<div class="upperright">
		    <?php if(!empty($user_settings)) { 
		    	$cnt = 0;
		    	$avg = 1;
				foreach ($user_settings as $keycnt => $valuecnt) 
				{
					if (empty($valuecnt['submenu']))
					{
						$cnt++;
					}
					else
					{
						foreach ($valuecnt['submenu'] as $key12 => $submenu2) {
							$cnt++;
						}
					}
					$avg = ceil($cnt / 6);
				}
		    }?>
	        <div class="site-header-content">
	            <div class="site-header-content-in">
	            	<div class="days_left hidden-xs">
	            		<span><?php echo $days; ?> DAYS REMAINING</span>
    				</div>
	                <div class="site-header-shown">
	                	<div class="toggle_head">
	                		<?php //if($this->session->role_id==$this->config->item('hr_user_role_id')){?>
	                		<?php /*if($this->session->active_db=='hrms_global')
	                				{
	                		?>
	                       		<input data-toggle="toggle" data-onstyle="primary" data-offstyle="warning" type="checkbox" id="toggle_db" name="toggle_db" >
	                       		<?php }
	                       		else
	                       			{
	                       			?>
	                       			<input checked data-toggle="toggle" data-onstyle="primary" data-offstyle="warning" type="checkbox" id="toggle_db" name="toggle_db" >
	                       			<?php 
	                       			}*/?> 
	                       	<?php //} ?>
                    	</div>
	                	<div class="site-header-search-container hidden-xs hidden-sm">
	                        <!-- <form class="site-header-search closed">
	                            <input type="text" placeholder="Search" id="search_key" list="search_data" />
	                            <datalist id="search_data" class="data_list" >
								</datalist>
	                            <button type="submit">
	                                <span class="font-icon-search"></span>
	                            </button>
	                            <div class="overlay"></div>
	                        </form> -->
	                        <button id="search" type="submit"  class="header-alarm">
							    <span class="glyphicon glyphicon-search" aria-hidden="true" ></span>
							</button>
                    	</div>

                    	<div class="dropdown dropdown-notification notif">
	                        <a href="#"
	                           class="header-alarm dropdown-toggle div_notif"
	                           id="dd-notification"
	                           data-toggle="dropdown"
	                           aria-haspopup="true"
	                           aria-expanded="false">
	                            <i class="font-icon-alarm"></i>
	                            <span class="notification-label notification-count bounceIn" ></span>
	                        </a>
	                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-notif drop-head" aria-labelledby="dd-notification" >
	                            <ul class="dropdown-menu-notif-list" id="notification_data">
	                            </ul>
	                        </div>
	                    </div>

	                	<div class="help-dropdown">
                        <button type="button">
                            <i class="fa fa-plus"></i>
                        </button>
                        <div class="help-dropdown-popup">
                        	<div class="row">
	                            
                              <?php if(!empty($user_settings)) { ?>
	                                    <div class="help-dropdown-popup-side col-sm-2">
	                                		<ul>
								   		<?php $i = 0;
											foreach ($user_settings as $key => $value) 
											{
												$icon = '';
												$color = '';
												if(!empty($value['menu_icon_class']) || !empty($value['menu_icon_color']))
												{
													$icon = 'black'.' font-icon fa fa-chevron-right small_arrow';
													$color = 'black';
												}
												else
												{
													$icon = 'black'.' font-icon fa fa-chevron-right small_arrow';
													$color = 'black';
												}
												$access_control_method = (!empty($value['method']))?$value['method']:'index';
												if (empty($value['submenu']))
												{
													if(($i % $avg) == 0 && $i > 0)
												{ ?>
														</ul>
	                            					</div>
	                            					<div class="help-dropdown-popup-side col-sm-2">
	                                					<ul>
											<?php } $i++;
									?>
												<li class="">
													<a href="<?php echo site_url()."/".$value['controller']."/".$value['method'];?>">
													   <span>
															<i class="<?=$color?> <?=$icon ?>"></i>
															<?= $value['menu_name']?>
													   </span>
													</a>
												</li>
									<?php						   				
												}
												else 
												{
									?>
											<!-- <li class="<?=$color ?> with-sub  <?php //if(strtolower($access_class)==strtolower($value['controller'])) {echo 'opened';}?>">
												<span>
												<i class="<?=$icon ?>"></i>
												<?//=$value['menu_name']; ?>
											</span> -->
												<?php 
													foreach ($value['submenu'] as $key1 => $submenu) {
													$access_submenu_method=(!empty($submenu['method']))?$submenu['method']:'index';
													if(!empty($value['menu_icon_class']) || !empty($value['menu_icon_color']))
													{
														$icon = $value['menu_icon_color'].' font-icon fa fa-chevron-right small_arrow';
														$color = $value['menu_icon_color'];
													}
													else
													{
														$icon = $value['menu_icon_color'].' font-icon fa fa-chevron-right small_arrow';
														$color = 'black';
													}
													if(($i % $avg) == 0 && $i > 0)
												{ ?>
														</ul>
	                            					</div>
	                            					<div class="help-dropdown-popup-side col-sm-2">
	                                					<ul>
											<?php } $i++;
													?>
													<!-- <ul class="submenu"> -->
														<li class="">
															<a href="<?php echo site_url()."/".$submenu['controller']."/".$access_submenu_method;?>">
																<span>
															<i class="<?=$color?> <?=$icon ?>"></i>
															<?=$submenu['menu_name'] ?></a>
															</span>
														</li>
													<!-- </ul> -->
												<?php
													}
												?>		
											<!-- </li> -->
										
									<?php			
												}
											} ?>			
											</ul>
	                            		</div>
								   	<?php } ?>
	                        </div>
                        </div>
                    </div>
	               

                    	 <div class="dropdown dropdown-lang">
	                   	<div id="google_translate_element"><i class="fa fa-language  hidden-xs" aria-hidden="true"></i></div>
	                    </div>


	                    
                 
	                    <div class="dropdown user-menu" style="position:relative !important;" title="<?php echo $this->session->email ?>" data-toggle="tool_tip">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                        	<?php if(!empty($this->session->profile_pic) && file_exists($profile_path.'/'.$this->session->profile_pic))
	                        	{
	                        		$profile_pic = base_url().$profile_path.$this->session->profile_pic;
	                        	}
	                        	else
                        		{
	                        		$profile_pic = base_url().$profile_path.'no_profile_image.png';
                        		}?>
	                             <img src="<?php echo $profile_pic;//(!empty($this->session->profile_pic))?  base_url().$profile_path.$this->session->profile_pic : base_url().$profile_path.'no_profile_image.png'?>" alt=""> 
	                            <span ><?php  echo 'Hello '.$this->session->userdata('user_name')?></span>
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right right_menu drop-head" aria-labelledby="dd-user-menu" style="position:fixed; !important;">
	                            <a class="dropdown-item" href="<?php echo site_url().$update_profile_url.$userdata['id'];?>"><span  class="font-icon glyphicon glyphicon-user"></span>Profile</a>
					
								<?php if(in_array($this->session->userdata('role_id'), $this->config->item('super_user_role_id'))) { ?>
								<a class="dropdown-item" href="<?php echo site_url();?>/config_setting/configuration_settings"><span class="font-icon glyphicon glyphicon-wrench"></span>Configuration Settings</a>
								<?php } ?>

	                            <a class="dropdown-item" href="<?php echo site_url().$profile_setting_url;?>"><span class="font-icon glyphicon glyphicon-cog"></span>Settings</a>
	                            <!-- <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-question-sign"></span>Help</a> -->
	                            <div class="dropdown-divider"></div>
	                            <a class="dropdown-item" href="<?php echo site_url();?>/login/logout"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
	                        </div>
	                    </div>
	
	                    <button type="button" class="burger-right">
	                        <i class="fa fa-th-large" aria-hidden="true"></i>
	                    </button>
	                </div><!--.site-header-shown-->
	
	                <div class="mobile-menu-right-overlay"></div>
	                 <div class="site-header-collapsed">
                        <div class="site-header-collapsed-in">
              
                            <div class="dropdown dropdown-typical">
                                <a class="dropdown-toggle" id="dd-header-social" data-target="#" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="font-icon font-icon-plus"></span>
                                    <span class="lbl">ADD</span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dd-header-social">

                                    <?php if(!empty($user_settings)) { ?>
								   		<?php foreach ($user_settings as $key => $value) 
											{
												$icon = '';
												$color = '';
												if(!empty($value['menu_icon_class']) || !empty($value['menu_icon_color']))
												{
													$icon = 'black'.' font-icon fa fa-chevron-right small_arrow';
													$color = 'black';
												}
												else
												{
													$icon = 'black'.' font-icon fa fa-chevron-right small_arrow';
													$color = 'black';
												}
												$access_control_method = (!empty($value['method']))?$value['method']:'index';
												if (empty($value['submenu']))
												{
									?>
												<li class="">
													<a href="<?php echo site_url()."/".$value['controller']."/".$value['method'];?>">
													   <span>
															<i class="<?=$color?> <?=$icon ?>"></i>
															<?= $value['menu_name']?>
													   </span>
													</a>
												</li>
									<?php						   				
												}
												else 
												{
									?>
											<!-- <li class="<?=$color ?> with-sub  <?php //if(strtolower($access_class)==strtolower($value['controller'])) {echo 'opened';}?>">
												<span>
												<i class="<?=$icon ?>"></i>
												<?//=$value['menu_name']; ?>
											</span> -->
												<?php 
													foreach ($value['submenu'] as $key1 => $submenu) {
													$access_submenu_method=(!empty($submenu['method']))?$submenu['method']:'index';
													if(!empty($value['menu_icon_class']) || !empty($value['menu_icon_color']))
													{
														$icon = $value['menu_icon_color'].' font-icon fa fa-chevron-right small_arrow';
														$color = $value['menu_icon_color'];
													}
													else
													{
														$icon = $value['menu_icon_color'].' font-icon fa fa-chevron-right small_arrow';
														$color = 'black';
													}
													?>
													<!-- <ul class="submenu"> -->
														<li class="">
															<a href="<?php echo site_url()."/".$submenu['controller']."/".$access_submenu_method;?>">
																<span>
															<i class="<?=$color?> <?=$icon ?>"></i>
															<?=$submenu['menu_name'] ?></a>
															</span>
														</li>
													<!-- </ul> -->
												<?php
													}
												?>		
											<!-- </li> -->
										
									<?php			
												}
											} ?>			
								   	<?php } ?>
                                </div>
                            </div>
                            <div class="site-header-search-container">
                                <form class="site-header-search closed" id="seach_small" action="#">
                                    <input type="text" placeholder="Search" id="search_key1" autocomplete="off">
		                            <!-- <datalist id="search_data1" class="data_list" >
									</datalist> -->
									<div class="col-sm-12" style="max-height:100px;overflow: scroll;overflow-x: hidden;">
										<ul id="search_data1" style="position: fixed;"></ul>
									</div>
		                            <button type="submit">
		                                <span class="font-icon-search"></span>
		                            </button>
		                            <div class="overlay"></div>
                                </form>
                            </div>
                        </div>
                        <!--.site-header-collapsed-in-->
                    </div>
	            </div><!--site-header-content-in-->
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
	</header><!--.site-header-->

<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Search</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form data-toggle="validator" class="col-sm-12">
              <div class="search_news">
				<form action="#" method="post">
					<input type="text" placeholder="Search" id="search_key" autocomplete="off">
				  </form>
			</div>
         <!--  <datalist id="search_data" class="data_list" >
					</datalist> -->
					<div class="col-sm-12 search_data_div" style="max-height:650px;overflow: scroll;overflow-x: hidden;">
						<ul id="search_data" style=" column-count: 3;"></ul>
					</div>
            </form> 
      	</div>
     </div>
  </div>
</div>
<script type="text/javascript">
	$("#toggle_db").change(function(){
		var toggle_val = $(this).is(':checked');
		console.log(toggle_val);
		swal({
			title: 'Do you want to switch between database?',
				// text: "You won't be able to revert this!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, switch it!'
			}).then(function () {
				$.ajax({
					url:'<?php echo site_url();?>/dashboard/toggle_db',
					type:'POST',
					data:{'toggle_val':toggle_val},
					success:function(response){
						console.log(response);
						$.notify({
							type: 'success',
							title: "<strong>Success:</strong> ",
							message: "Database Switched Successfully!",
							delay: 1000,
							animate:{
								enter: "animated fadeInUp",
								exit: "animated fadeOutDown"
							}
						});
						location.reload();
					}
				});
			});
	});
</script>