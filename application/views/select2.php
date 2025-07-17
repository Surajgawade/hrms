<html lang="en">

<head>


  
  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
  <?php /*<script src="<?php echo assets_url();?>js/lib/jquery/jquery-1.9.1.js"></script>*/?>
<script src="<?php echo assets_url();?>js/lib/jquery/jquery-3.2.1.min.js"></script>

  
  <link href="<?php echo assets_url();?>css/lib/select2/select2.min.css" rel="stylesheet" />
  <script src="<?php echo assets_url();?>js/lib/select2/select2-new.min.js"></script>
  

</head>

<body>


<div style="width:520px;margin:0px auto;margin-top:30px;height:500px;">

  <h2>Select Box with Search Option Jquery Select2.js</h2>

  <select class="itemName form-control" id="itemName" style="width:500px" name="itemName"></select>

</div>


<script type="text/javascript">
$(document).ready(function(){
url='<?php echo site_url();?>'+'/candidate/get_can_list';
placeholder='--- Select Reporing Person ---';
// match = "harsha";
select2(itemName,url,placeholder);

});
function select2(id_selector,url,placeholder='')
{
      $(id_selector).select2({

        placeholder: placeholder,

        ajax: {

          url: url,
          dataType: 'json',
          delay: 250,

          processResults: function (data) {

            return {

              results: data

            };

          },

          cache: true

        }

      });

}
</script>


</body>

</html>