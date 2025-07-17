<?php  $userdata=$this->session->userdata('logged_in_user');
	   $user_settings=$this->session->userdata('user_settings');
	   $is_rpo_can =$this->session->userdata('is_rpo_can');
		if($is_rpo_can)
		{
	  		$profile_path = RPO_PROFILE_PATH;
	  	}
	  	else
	  	{
	  		$profile_path = PROFILE_PATH;
	  	}
?>

<nav class="side-menu" id="sidebar_menu">
	<div class="sidebar-user-panel" >
        <div class="user-panel">
            <div class="image">
            	<?php
            		 if(!empty($this->session->profile_pic) && file_exists($profile_path.'/'.$this->session->profile_pic))
               	{
               		$profile_pic = base_url().$profile_path.$this->session->profile_pic;
               	}
               	else
            		{
               		$profile_pic = base_url().$profile_path.'no_profile_image.png';
            		}?>
                <img class="img-circle user-img-circle" title="<?php echo $this->session->email ?>" data-toggle="tooltip" src="<?php echo $profile_pic; //(!empty($this->session->profile_pic))?  base_url().$profile_path.$this->session->profile_pic : base_url().$profile_path.'no_profile_image.png'?>" alt="">
            </div>
            <div class="info">
                <p> <?php echo get_user_name_by_id(get_login_user_id(),$userdata['can_type'])?></p>
                <span class="txtOnline"><?php echo get_user_job_profile($this->session->job_profile) ?></span>
            </div>
        </div>
    </div>
   <ul class="side-menu-list">
			
   	<?php if(!empty($user_settings))
   		{
			foreach ($user_settings as $key => $value) 
			{
				$icon='';
				$color='';
				if(!empty($value['menu_icon_class']) || !empty($value['menu_icon_color']))
				{
					$icon=$value['menu_icon_color'].' font-icon fa '.$value['menu_icon_class'];
					$color=$value['menu_icon_color'];
				}
				else
				{
					$icon=$value['menu_icon_color'].' font-icon fa fa-align-justify';
					$color='black';
				}
				$access_control_method=(!empty($value['method']))?$value['method']:'index';
				if (empty($value['submenu']))
				{

	?>
				<li  class="<?=$color?> <?php if(strtolower($access_class)==strtolower($value['controller']) && strtolower($access_method)==strtolower($access_control_method)) {echo 'active';}?>">
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
			<li class="<?=$color ?> with-sub  <?php if(strtolower($access_class)==strtolower($value['controller'])) {echo 'opened';}?>">
				<span>
				<i class="<?=$icon ?>"></i>
				<?=$value['menu_name']; ?>
			</span>
				<?php 
					foreach ($value['submenu'] as $key1 => $submenu) {
					$access_submenu_method=(!empty($submenu['method']))?$submenu['method']:'index';
					
				?>
					<ul class="submenu">
						<li class="<?php if(strtolower($access_class)==strtolower($submenu['controller']) && strtolower($access_method)==strtolower($access_submenu_method)) {echo'active';}?>">
							<a href="<?php echo site_url()."/".$submenu['controller']."/".$access_submenu_method;?>">
						<?=$submenu['menu_name'] ?></a>
						</li>
					</ul>
				<?php
					}
				?>		
			</li>
		
	<?php			
				}
			}   			
   		}
    ?>

   </ul>
</nav>
<div class="hidden-xs" id="open-switcher"> <i class="fa fa-cog"></i></div>
            <div id="close-switcher"> <i class="fa fa-times"></i></div>
            <div id="switcher-color">
                <div id="switcher-wrapper">
                    <h2>SKINS</h2>
                    <ul id="mainColors">
                        <li class="color-1 active" data-path="<?php echo assets_url();?>css/main.css"><a href="javascript:;" class="switch_theme"></a></li>
                        <li class="color-2 <?php if($my_theme=='grey1') echo "active";?>" data-path="<?php echo assets_url();?>css/color/grey1.css"><a href="javascript:;" class="switch_theme" data-value="grey1"></a></li>
                        <li class="color-3 <?php if($my_theme=='yellow1') echo "active";?>" data-path="<?php echo assets_url();?>css/color/yellow1.css"><a href="javascript:;" class="switch_theme" data-value="yellow"></a></li>
                        <li class="color-4 <?php if($my_theme=='blue') echo "active";?>" data-path="<?php echo assets_url();?>css/color/blue.css"><a href="javascript:;" class="switch_theme" data-value="blue"></a></li>
                        <li class="color-7 <?php if($my_theme=='red') echo "active";?>" data-path="<?php echo assets_url();?>css/color/red.css" <?php if($my_theme=='red') echo "active";?>><a href="javascript:;" class="switch_theme" data-value="red"></a></li>
                        <li class="color-5 <?php if($my_theme=='green') echo "active";?>" data-path="<?php echo assets_url();?>css/color/green.css"><a href="javascript:;" class="switch_theme" data-value="green"></a></li>
                        <li class="color-9 <?php if($my_theme=='purple') echo "active";?>" data-path="<?php echo assets_url();?>css/color/purple.css"><a href="javascript:;" class="switch_theme" data-value="purple"></a></li>
                        <li class="color-8 <?php if($my_theme=='black') echo "active";?>" data-path="<?php echo assets_url();?>css/color/black.css"><a href="javascript:;" class="switch_theme" data-value="black"></a></li>
                        <li class="color-10 <?php if($my_theme=='lightgrey') echo "active";?>" data-path="<?php echo assets_url();?>css/color/lightgrey.css"><a href="javascript:;" class="switch_theme" data-value="lightgrey"></a></li>
                       <?php /* <li class="color-3" data-path="<?php echo assets_url();?>css/color/yellow1.css"></li>
                        <li class="color-4" data-path="<?php echo assets_url();?>css/color/blue.css"></li>
                        <li class="color-7" data-path="<?php echo assets_url();?>css/color/red.css"></li>
                      	<li class="color-5" data-path="<?php echo assets_url();?>css/color/green.css"></li>
                        <li class="color-9" data-path="<?php echo assets_url();?>css/color/purple.css"></li>
                        <li class="color-8" data-path="<?php echo assets_url();?>css/color/black.css"></li>
                        <li class="color-10" data-path="<?php echo assets_url();?>css/color/lightgrey.css"></li>*/?>
                    </ul>
                </div>
            </div>


           
<!--.side-menu-->
<script type="text/javascript">
	
	$(document).ready(function(menuSlide) {
		 $('hover-[data-toggle="tooltip"]').tooltip({
        delay: {show: 0, hide: 2000,placement : 'top'}
    });
		 $('hover-[data-toggle="tool_tip"]').tooltip({
        delay: {show: 0, hide: 2000,placement : 'top'}
    });

	$('[data-toggle="tool_tip"]').click(function(){
    	 $('[data-toggle="tool_tip"]').tooltip('hide');
    });    
  var $as = $('.with-sub span').click(function() {
    $(this).toggleClass('opened').next('.submenu').slideToggle(500);
    $(this).parent().siblings().children('.submenu').slideUp(500);
    $(this).parent().siblings().children('.opened').removeClass('opened');
    return false;
  });

  var theme;
  $('#mainColors li').click(function()
  {
  		var data_path = $(this).attr('data-path');
  		var theme = $(this).find('.switch_theme').data('value');
		$.ajax({
			url: "<?php echo site_url();?>/dashboard/my_theme",
			type: "POST",
			data: {"theme":theme},
			success: function (repsonse) {
				console.log(theme);
			}
		});
  });


});

$.fn.isOnScreen = function(){
    
    var win = $(window);
    
    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();
    
    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();
    
    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
    
};

$(document).ready(function()
{
  if($('.submenu li.active,ul.submenu li.with-sub,.side-menu-list li.active').isOnScreen())
  {
  	console.log('on screen');
  }
  else 
  {
  	console.log('scroll up');
  	var height = $( document ).height(); // returns height of HTML document
	  var scroll = (height/100)*80;
  	$("#sidebar_menu").scrollTop(scroll);
  }
});
</script>