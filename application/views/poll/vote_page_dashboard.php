<div id='result'>
   <!-- Vote Start -->
   <?php 
      if(!empty($votes))
      {
         $dv_id='';
         ?>
         <?= form_open_multipart('voting/voted/', array('id' => 'voting_categories'))?>
         <?php foreach ($votes as $key1 => $value1) {
         ?>

         <div  class="col-md-12 nopadding">
            <ul class="pager vote_page">
               <li><a id='previous' href="javascript:void(0);"><i class="fa fa-chevron-left"></i></a></li>
               <li><a id='next' href="javascript:void(0);"><i class="fa fa-chevron-right"></i></a></li>
            </ul>
            <div id="box-vote" class="box-vote">
               <div class="box-vote-head"><?= $value1['dv_title']?></div>
               <div class="box-vote-content">
                  <input type="hidden" id="dv_id" value="<?= $value1['dv_id']; ?>"/>
                  <?php $dv_id=$value1['dv_id']; ?>
                  <?php foreach($value1['columns'] as $key=>$value): if(!empty($value)){ ?>
                  <div class="">
                     <div style="margin-bottom: 10px;">
                        <input name="v_column-<?php echo $value1['dv_id']?>" type="radio" value="<?= $key ?>,<?= $value ?>" type="radio" checked="checked">
                        <label style="display: inline-block" for="v_column-<?php echo $value1['dv_id']?>"> <?= $value ?> </label>
                     </div>
                     <!--  <label class="voting_blog">
                     <input class="check" name="v_column-<?php// echo $value1['dv_id']?>" type="radio" value="<?= $key ?>,<?= $value ?>" checked="checked" >
                     <label for="v_column-<?php //echo $value1['dv_id']?>">
                     <span class="box"></span> <?= $value ?> </label>
                     </label> -->
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
      }
    ?>
   </form>
   <?php }
   }
   else{?> <p class="notice error">sorry there no polls</p>  <?php } ?>
   <!-- Vote End -->
   <script type="text/javascript">
      $(document).ready(function(){
         var vote_status = '<?php echo $found_ip?>';
         if(vote_status)
         {
            $('#<?php echo $dv_id;?>').click();
         }
      });
      $("#next").click(function () {
         $.ajax({
            url: "<?= base_url(); ?>index.php/polls/vote_page_dashboard/" +"<?php echo $dv_id ?>"+"/next",
            type: "post",
            //data: sendData,
            dataType: "json",
            success: function (data) {
               if(data.data!=0)
               {
                  $("#poll-container").html(data.output);
               }
               else if(data.data==0)
               {
                  $("#next").css('display','none');      
                  $("#previous").css('display','inline-block');
               }
            }
         });
      });

      $("#previous").click(function (){
         $.ajax({
            url: "<?= base_url(); ?>index.php/polls/vote_page_dashboard/"+"<?php echo $dv_id ?>"+"/previous",
            type: "post",
            dataType: "json",
            //data: sendData,
            success: function (data) {
               if(data.data!=0)
               {
                  $("#poll-container").html(data.output);
               }
               else if(data.data==0)
               {
                  $("#previous").css('display','none');           
                  $("#next").css('display','inline-block');  
               }
               //$("#vote-results-"+dv_id).html(data).delay(1000).fadeIn(1000);
            }
         });
      });    
   </script>

   <script type="text/javascript">
      $(".vote").click(function () {

         dv_id= $(this).attr('id');
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
               var vote_status = '<?php echo $found_ip?>';
               // console.log('dfsfsf');
               // console.log(vote_status);
               if(vote_status)
               {
                  
                  $('#'+dv_id).attr('disabled',true);
               }
            }
         });
         return false;
      });
   </script>
</div>