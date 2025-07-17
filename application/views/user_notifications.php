<?php
date_default_timezone_set('Asia/Kolkata');
    if(!empty($data))
    {
        foreach ($data as $key => $value)
        {
            if(isset($value['field_data']) && !empty($value['field_data']))
            {
                $style='';
                $time='';
                if(empty($value['status']))
                {
                    $style='style="background-color:#f9e8d2"';
                }
                if(!empty($value['created_on']))
                {
		// $time=get_time_difference('2017-12-18 12:02:01'); 
                 // $time=$value['field_data']['created_on']; 
		 $time=get_time_difference($value['created_on']);
                }
                if(isset($value['field_data']['task_created_by']) && !empty($value['field_data']['task_created_by']))
                {?>
                    <li class="dropdown-menu-notif-item" <?php echo $style?>>
                    <div class="dot"></div>
                    <a href="<?=site_url('task/update_my_task/').$value['field_data']['task_id']?>">New Task Added By <?php echo (isset($value['field_data']['task_created_by'])) ? get_user_name_by_id($value['field_data']['task_created_by']):'' ?> :<?php echo (isset($value['field_data']['task_name'])) ? $value['field_data']['task_name']:'' ?></a> 
                    <div class="color-blue-grey-lighter"><?=$time ?></div>
                    </li>
                <?php
                }
                else if(isset($value['table_type']) && !empty($value['table_type']))
                {
                    if($value['table_type']=='leave_application' && empty($value['reporting_to']))
                    {
                        ?>
                                <?php 
                                if($value['field_data']['status']==1)
                                {?>
                                    <li class="dropdown-menu-notif-item" <?php echo $style?>>
                        
                                <div class="dot"></div>
                            
                                <a href="<?php site_url('leave_management/leave_status')?>">Leave Approved</a> 
                                <div class="color-blue-grey-lighter"><?=$time ?></div>
                        </li>

                        <?php }else{?>
                            <li class="dropdown-menu-notif-item" <?php echo $style?>>
                            <div class="dot"></div>
                            <a href="<?php site_url('leave_management/leave_status')?>">Leave Rejected</a> 
                            <div class="color-blue-grey-lighter"><?=$time ?></div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <li class="dropdown-menu-notif-item" <?php echo $style?>>
                        <div class="dot"></div>
                        <?php ?>
                        <a href="<?=site_url('leave_management/change_status/').$value['field_data']['appl_id'] ?>">Leave Request by <?php echo (isset($value['can_id'])) ? get_user_name_by_id($value['can_id']):'' ?> 
                        <div class="color-blue-grey-lighter"><?=$time ?></div>
                        </li>
                <?php } ?>
                <?php
                }
            }
        }    
    }
    else
    {   ?>
        <li class="dropdown-menu-notif-item">
           No notification
        </li>
    <?php }
    
?>
    
