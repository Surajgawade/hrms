 
    <?php foreach ($data as $key => $value) {
    	if(isset($value['field_data']) && !empty($value['field_data']))
    	{
    		$style='';
    		$time='';
    		if(empty($value['status']))
    		{
    			$style='style="background-color:grey"';
    		}
    		if(!empty($value['created_on']))
    		{
    			$time=get_time_difference($value['created_on']);
    		}
    	if(isset($value['field_data']['task_created_by']) && !empty($value['field_data']['task_created_by']))
    	{
    		?>
    		<li class="dropdown-menu-notif-item" <?php echo $style?>>
    		<div class="dot"></div>
    		New Task Added By <?php echo (isset($value['field_data']['task_created_by'])) ? get_user_name_by_id($value['field_data']['task_created_by']):'' ?> :<?php echo (isset($value['field_data']['task_name'])) ? $value['field_data']['task_name']:'' ?> 
    		<div class="color-blue-grey-lighter"><?=$time ?></div>
    		</li>
    		<?php		
    	}
    	else if(isset($value['table_type']) && !empty($value['table_type']))
    	{
    		if($value['table_type']=='leave_application' && empty($value['reporting_to']))
    		{
    		
    		?>
    		<li class="dropdown-menu-notif-item" <?php echo $style?>>
    		<div class="dot"></div>
    		<?php 
    		if($value['field_data']['status']==1)
    		{
    		?>
    		Leave Approved 
    		<div class="color-blue-grey-lighter"><?=$time ?></div>
    		
    		</li>
    		
    		<?php 
			}
			else
			{
			?>
			Leave Rejected 
			<?php
			}
			}
			else
			{
			?>
			<li class="dropdown-menu-notif-item" <?php echo $style?>>
    		<div class="dot"></div>
    		<?php ?>
    		Leave Request by <?php echo (isset($value['can_id'])) ? get_user_name_by_id($value['can_id']):'' ?> 
    		<div class="color-blue-grey-lighter"><?=$time ?></div>
    		
    		</li>
			<?php 
			} ?>
    		<?php
    	}
    }
    } ?>
    
