<?php 

include(APPPATH.'views/controls/css_include.php');
include(APPPATH.'views/controls/js_include.php');
 ?> 
<div class="page-content">

<style>
    /* vote */
    

    /* footer */
</style>
<script type="text/javascript">

    $(document).ready(function () {
        $(".vote").click(function () {
            dv_id=$(this).attr('id');

            //var dvId = $("#dv_id").val();
            var v_column = $('input[name="v_column-'+dv_id+'"]:checked').val();
            //alert(v_column);

            //var v_data = $('input[name="v_data"]').val();
             var sendData = {"v_column": v_column};
             // alert(sendData);
             $.ajax({
                 url: "<?= base_url(); ?>index.php/Polls/voted/" + dv_id,
                 type: "post",
                 data: sendData,
                 success: function (data) {
                     //$("#box-vote").fadeOut(1000);
                     $("#vote-results-"+dv_id).html(data).delay(1000).fadeIn(1000);
                 }
             });

            return false;

        })

    })

</script>
<!-- Vote Start -->

        <?php 
        if(!empty($votes))
        {
        ?>
        <?= form_open_multipart('voting/voted/', array('id' => 'voting_categories'))?>
        <?php foreach ($votes as $key1 => $value1) {
            ?>

        <div  class="col-md-4 margin-top-30">
            <div id="box-vote" class="box-vote">

                <div class="box-vote-head"><?= $value1['dv_title']?></div>
                <div class="box-vote-content">
                    <input type="hidden" id="dv_id" value="<?= $value1['dv_id']; ?>"/>
            <?php foreach($value1['columns'] as $key=>$value): if(!empty($value)){ ?>
            <div class="">
                <label class="voting_blog">
                     <input class="check" name="v_column-<?php echo $value1['dv_id']?>" type="radio" value="<?= $key ?>,<?= $value ?>" checked="checked" >
                        <label for="v_column-<?php echo $value1['dv_id']?>">
                            <span class="box"></span> <?= $value ?> </label>
                    
                </label>
            </div>
              <?php } endforeach;  ?>
              <button type="button" name="votes" id="<?php echo $value1['dv_id']?>"  class="btn btn-custom btn-block vote">Vote Now!</button>
                </div>
             <div id="vote-results-<?php echo $value1['dv_id']?>" style="display:none;"></div>
                
            </div>
        </div>

            <?
        }
            # code...
        } ?>
        </form>
    <?php }
        }
    else{?> <p class="notice error">sorry,there no polls</p>  <?php } ?>
<!-- Vote End -->

</div>