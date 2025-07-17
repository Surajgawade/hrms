<div class="page-content">
	<div class="container-fluid">
		<div class="well">
		 	<div class="row">
				
			</div>
			<div class="container-fluid">
    <div class="row widget-block">

        <?php
        // debug($candidates);
         foreach ($candidates as $key => $value) {
        	# code...
         ?>
        	<div class="card-block col-md-2"><div class="content"><section class="card widget_list">
              <img src="<?php echo (!empty($value['profile_picture']))? base_url().PROFILE_PATH.$value['profile_picture'] : base_url().PROFILE_PATH.'no_profile_image.png'?>" width="100px"/>
                <div class="widget-user-card__name"><?php echo $value['can_name']; ?></div>
                <div class="widget-user-card__desig"><?php echo get_user_job_profile    ($value['job_profile']); ?></div>
                <div class="widget-user-card__occupation"> <a href="mailto:<?php echo $value['email']; ?>" target="_top"><?php echo $value['email']; ?></a></div>
          </section>
            </div></div>
        <?php }?>
    </div>
</div>
		</div>
	</div>
</div>