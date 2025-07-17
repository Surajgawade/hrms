</body>
<script type="text/javascript">
	$(document).ready(function(){
 

 function load_unseen_notification(view = '',noti_data='')
 {
   
  $.ajax({
   url:'<?php echo site_url();?>/push_notifications',
   method:"POST",
   delay:1000,
   data:{view:view,data:noti_data},
   dataType:"json",
   success:function(data)
   {

      if(data.notifications_data!='')
      {
        $('#notification_data').html(data.notifications_data);
        $('#notification_data').css('overflow-y','scroll');
      }
    if(data.unseen_notification > 0)
    {
       $('.font-icon-alarm').addClass('alarm_icon');
      var cnt=$('.notification-count').text();
  
     $('.notification-count').html(data.unseen_notification);
     //$('.new_notification').html(data.unseen_notification);
    	if(cnt>0 && data.unseen_notification>cnt)
    	{

	    	$.notify({
                message: "New Notification Added", 
              },
              {
                type: "success",
                delay: 800,
                animate:{
                  enter: "animated fadeInUp",
                  exit: "animated fadeOutDown"
                } 
            });
             

	    }
    }
    else
    {
  		$('.notification-count').html('0');
  		$('.new_notification').html('0');	
      $('.font-icon-alarm').removeClass('alarm_icon');
    }
   }
  });
 }
 load_unseen_notification();
 $('.font-icon-alarm').on('click',function(){
  //$('.notification-count').html('0');
  load_unseen_notification('','data');
 });

 $('.div_notif').on('click',function(){
  //$('.notification-count').html('0');
  load_unseen_notification('','data');
 });
 
 setInterval(function(){ 
  load_unseen_notification();
 }, 7000);

  /*setInterval(function(){ 
    bulk_alert();
  }, 5000);*/
 
});

  $(document).on('click', '#search', function(){ 
    $('#search_data').html('');
    $('#search_key').val('');
    $('#searchModal').modal('show');
});

$('#search_key').on('keyup', function() {
  var search_key = $('#search_key').val();
  if(search_key.replace(/\s/g, '') != '')
  {
    $.ajax({
      url: '<?php echo site_url();?>/insurance/search_menu/'+search_key,
      dataType :"json",
      async:false,
      type: 'POST',
      success: function(response)
      {
        var data = '';
        if(response.length != 0)
        {
          $.each(response, function(ks, vs) {
            data += '<li><a href="<?php echo site_url();?>'+vs.link+'"><i class="fa fa-chevron-right"></i> '+vs.title+'</a></li>';
              // '<option value="<?php //echo site_url();?>'+vs.link+'" label="'+vs.title+'">'+vs.title+'</option>';
          });
        }
        else
        {
          data = '<span class="help-block with-errors error_msg">No record found.</span>';
        }
        $('#search_data').html(data);
      }
    });
  }
  else
  {
    $('#search_data').html('');
  }
});

$('#search_key1').on('keyup', function() {
  var search_key = $('#search_key1').val();
  if(search_key.replace(/\s/g, '') != '')
  {
    $.ajax({
      url: '<?php echo site_url();?>/insurance/search_menu/'+search_key,
      dataType :"json",
      async:false,
      type: 'POST',
      success: function(response)
      {
        var data = '';
        if(response.length != 0)
        {
          $.each(response, function(ks, vs) {
            data += '<li><a href="<?php echo site_url();?>'+vs.link+'"><i class="fa fa-chevron-right"></i> '+vs.title+'</a></li>';
            // '<option value="<?php //echo site_url();?>'+vs.link+'" label="'+vs.title+'">'+vs.link+'</option>';
          });
        }
        else
        {
          data = '<span class="help-block with-errors error_msg">No record found.</span>';
        }
        $('#search_data1').html(data);
      }
    });
  }
  else
  {
    $('#search_data1').html('');
  }
});

// $(document).on('change', '#search_key', function(){
//     var options = $('#search_data')[0].options;
//     for (var i=0;i<options.length;i++){
//        if (options[i].value  == $(this).val()) 
//          {
//           window.location.href=options[i].value;
//         }
//     }
// });

// $(document).on('change', '#search_key1', function(){
//     var options = $('#search_data1')[0].options;
//     for (var i=0;i<options.length;i++){
//        if (options[i].value  == $(this).val()) 
//          {
//           window.location.href=options[i].value;
//         }
//     }
// });

function bulk_alert()
{
  $.ajax({
    url:'<?php echo site_url();?>/bulk_mail/alert_notify',
    method:"POST",
    delay:1000,
    dataType:"json",
    success:function(response)
    {
      if(response.length != 0)
      {
        swal({
          title : "Done",
          message : response,
          type : "success",
          html: true
        });
      }
    }
  });
}
</script>
</html>