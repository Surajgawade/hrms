<div id="middleContent">
    <!-- Bread Crumb Start -->
    <div class="breadCrumb">
        <span><a class="home" href="<?= base_url(); ?>"></a></span>
        <span class="current">Votes</span>
    </div>
    <!-- Bread Crumb End -->
    <?php if(isset($rows) && $rows != NULL && $mainTotal != 0){?>
        <?php  foreach($rows as $row){       ?>
            <div class="block lrg">
                <div class="title">Vote results</div>
                <div class="info">The number who participated in the Vote yet<?php echo $total; ?> voter</div>
                <div class="content text">
                    
                </div>
            </div>
    <?php } // end of each  ?>
    <?php }else{?>
        <p class="notice error">Sorry but there are so far no Vote</p>
    <?php } ?>
</div>

