<?php
	$total = $this->uri->total_segments();
	$last = $this->uri->segment($total);
	$can_type=$this->session->can_type;
	$per_new=$percentage['per_new'];
?>
<style type="text/css">
a:hover{
	cursor: pointer!important;
}
.progress_arrow {
	width: 9.5%;
}
 </style>
 <div class="row">
	<div class="col-sm-12">
		<div class="profile-widget"> 
		  	<div class="row">
		  		<div class="col-md-4 text-center">
		  		</div>
		  		<div class="col-md-4" id="profile_div" style="display:block; text-align: center;">
					<div id="upload-demo-i" class="upload_pic"></div>
					 <?php if($last==get_login_user_id()) {?>
					 <div class="p-image">
				           <a ><i class="fa fa-camera upload-button"></i></a>
					        <input class="file-upload" type="file" id="upload" accept="image/*"/>
					       
				     </div>
				     <?php }?>
				     <p style="margin-top: -10px;color: #eee;">
				     	<?php if(!empty($this->session->profile_pic)) { ?>
					        	<a id="remove_profile">Remove Image</a>
					    <?php } ?>
					</p>
				     <h3 class="profile-username"><?php echo (isset($this->session->can_name) && !empty($this->session->can_name)) ? $this->session->can_name : '';?></h3>
				     <h5 class="profile-desig"><?= get_user_job_profile($this->session->can_job_profile)  ?> </h5>
		  		</div>
		  		
		  		<div class="col-md-4" id="upload_div" style=" display:none;">
		  			<div id="upload-demo" style="">
		  			</div>
		  			<div class="act_btn" style="margin-bottom: 20px">
		  				<br>
			  			<button class="btn btn-success upload-result" >Upload Image</button>
			  			<button class="btn btn-success upload-cancel">Cancel</button>
		  			</div>
		  		</div>
		  	</div>
		</div>
	</div>
</div>

<div>
	<div class="menu d-lg-none">
		<ul>
			<li><a href="<?php echo site_url();?>/rpo_manager/add_edit_rpo_candidate/<?php echo  $last;?>">Profile Details</a></li>
			<li><a href="<?php echo site_url();?>/rpo_manager/bank_details/<?php echo $last;?>">Bank Details</a></li>
			<li><a href="<?php echo site_url();?>/rpo_manager/documents/<?php echo  $last;?>">Documents</a></li>
			<li><a href="<?php echo site_url();?>/rpo_manager/billing/<?php echo  $last;?>">Billing</a></li>
			<li><a href="<?php echo site_url();?>/rpo_manager/insurance_details/<?php echo  $last;?>">Insurance Details</a></li>
			<li><a href="<?php echo site_url();?>/rpo_manager/investment/<?php echo $last;?>">Investment</a></li>			
			<li><a href="<?php echo site_url();?>/rpo_manager/salary_slips/<?php echo $last;?>">Salary Slips</a></li>			
		</ul>
	</div>
	<div class="menu-toggle d-lg-none">
		<a href="#">Menus &nbsp;<i class="fa fa-angle-double-down"></i></a>
	</div>					
</div>
<div class="col-sm-12">
	<div class="row">
		<div class="menu_btns hidden-xs hidden-sm">
			<!-- <?php //echo $active_method ;?> -->
<div class="arrow-steps clearfix">

				<a class="step <?php echo ($access_method=='add_edit_rpo_candidate')? 'current' : 'step' ?>" href="<?php echo site_url();?>/rpo_manager/add_edit_rpo_candidate/<?php echo $last;?>">
					<span>Profile Details</span>
				</a>
				<a class="step <?php echo ($access_method=='bank_details')? 'current' : 'step' ?>" href="<?php echo site_url();?>/rpo_manager/bank_details/<?php echo $last;?>">
					<span>Bank Details</span>
				</a>
				<a class="step <?php echo ($access_method=='documents' || $access_method=='add_document')? 'current' : 'step' ?>" href="<?php echo site_url();?>/rpo_manager/documents/<?php echo $last;?>">
					<span>Documents</span>
				</a>
				<a class="step <?php echo ($access_method=='billing' || $access_method=='add_billing' || $access_method=='edit_billing_details')? 'current' : 'step' ?>" href="<?php echo site_url();?>/rpo_manager/billing/<?php echo $last;?>">
					<span>Billing</span>
				</a>				
				<a class="step <?php echo ($access_method=='insurance_details')? 'current' : 'step' ?>" href="<?php echo site_url();?>/rpo_manager/insurance_details/<?php echo $last;?>">
					<span>Insurance Details</span>
				</a>
				<a class="step <?php echo ($access_method=='investment' || $access_method=='add_investment' || $access_method=='edit_investment_details' )? 'current' : 'step' ?>" href="<?php echo site_url();?>/rpo_manager/investment/<?php echo $last;?>">
					<span>Investment</span>
				</a>
				<a class="step <?php echo ($access_method=='salary_slips' || $access_method=='generate_salary_slip' || $access_method=='generate_salary_slip' )? 'current' : 'step' ?>" href="<?php echo site_url();?>/rpo_manager/salary_slips/<?php echo $last;?>">
					<span>Salary Slips</span>
				</a>	
		</div>
		</div>
	</div>
</div>    

<div class="demo_progress">
 	<p> Profile Completeness</p>
      <!-- <div class="progress candidate_prog">
		<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="83"
	aria-valuemin="0" aria-valuemax="100" style="width:<?php //echo $percentage."%";?>">
	<span><?php //echo $percentage."%";?></span>
        </div>
      </div> -->
  <div class="wrap_arrow">
	  <div class="progress_arrow arrow_yellow">
	    <?php if($per_new['profile_per']!=''){ ?>
	    	<i class="fa fa-check" style=" font-size: 20px;" aria-hidden="true"></i>
		<?php }else{ ?>
			<i class="fa" style=" font-size: 20px;" aria-hidden="true"></i>
		<?php } ?>
	  </div>
	  <div class="progress_arrow arrow_greenish">
		  <?php if($per_new['bank_per']!=''){ ?>
		    	<i class="fa fa-check" style=" font-size: 20px;" aria-hidden="true"></i>
			<?php }else{ ?>
				<i class="fa" style=" font-size: 20px;" aria-hidden="true"></i>
			<?php } ?>
	  </div>
	   <div class="progress_arrow arrow_red">
	     <?php if($per_new['doc_per']!=''){ ?>
	    	<i class="fa fa-check" style=" font-size: 20px;" aria-hidden="true"></i>
		<?php }else{ ?>
			<i class="fa" style=" font-size: 20px;" aria-hidden="true"></i>
		<?php } ?>
	  </div>
	  <div class="progress_arrow arrow_blue">
	    <?php if($per_new['bill_per']!=''){ ?>
	    	<i class="fa fa-check" style=" font-size: 20px;" aria-hidden="true"></i>
		<?php }else{ ?>
			<i class="fa" style=" font-size: 20px;" aria-hidden="true"></i>
		<?php } ?>
	  </div>
	  <div class="progress_arrow arrow_grey">
	    <?php if($per_new['ins_per']!=''){ ?>
	    	<i class="fa fa-check" style=" font-size: 20px;" aria-hidden="true"></i>
		<?php }else{ ?>
			<i class="fa" style=" font-size: 20px;" aria-hidden="true"></i>
		<?php } ?>
	  </div>
	  
	  <div class="progress_arrow arrow_red">
	    <?php if($per_new['inv_per']!=''){ ?>
	    	<i class="fa fa-check" style=" font-size: 20px;" aria-hidden="true"></i>
		<?php }else{ ?>
			<i class="fa" style=" font-size: 20px;" aria-hidden="true"></i>
		<?php } ?>
	  </div>
	</div>
  </div>



<script>
	$(document).ready(function(){
		$(".menu-toggle a").click(function(){ 
			$(".menu").slideToggle(700);
		});
		pic="<?php echo $this->session->can_profile_pic; ?>";
		// alert(pic);
		if(pic!='')
		{
			html = '<img src="' + "<?php echo base_url().RPO_PROFILE_PATH.$this->session->can_profile_pic; ?>" + '" />';
				$("#upload-demo-i").html(html);
		}
		else{
			html = '<img src="' + "<?php echo base_url().RPO_PROFILE_PATH.'no_profile_image.png'; ?>" + '" />';
			$("#upload-demo-i").html(html);		
		}

	});	
</script>
<script type="text/javascript">

$uploadCrop = $('#upload-demo').croppie({

    enableExif: true,

    viewport: {

        width: 180,

        height: 180,

        type: 'circle'

    },

    boundary: {

        width: 200,

        height: 200

    }

});


$('#upload').on('change', function () { 

	var reader = new FileReader();

    reader.onload = function (e) {

    	$uploadCrop.croppie('bind', {

    		url: e.target.result

    	}).then(function(){

    		console.log('jQuery bind complete');

    	});


    	

    }

    reader.readAsDataURL(this.files[0]);

});


$('.upload-result').on('click', function (ev) {

	$uploadCrop.croppie('result', {

		type: 'canvas',

		size: 'viewport'

	}).then(function (resp) {


		$.ajax({

			url: "<?php echo site_url(); ?>/rpo_manager/upload_profile_image/",
			
			type: "POST",

			data: {"image":resp},

			success: function (data) {

				html = '<img src="' + resp + '" />';

				$("#upload-demo-i").html(html);
				window.location.reload();

			}

		});

	});
	$('#profile_div').css('display','block');
	$('#upload_div').css('display','none');

});
$(document).ready(function() {

    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);            
        if((this.files[0].size/1024/1024)<5)
        {
          $('#profile_div').css('display','none');
          $('#upload_div').css('display','block');
        }
        else
        {
        	swal("File Size Must Be Less Than 5 MB","","error");
        }
       
    });
    $.fn.checkFileType = function(options) {
	  	var defaults = {
	    allowedExtensions: [],
	    success: function() {},
	    error: function() {}
	  };
	  options = $.extend(defaults, options);

	  return this.each(function() {

	    $(this).on('change', function() {
	      var value = $(this).val(),
	        file = value.toLowerCase(),
	        extension = file.substring(file.lastIndexOf('.') + 1);

	      if ($.inArray(extension, options.allowedExtensions) == -1) {
	        options.error();
	        $(this).focus();
	      } else {
	        options.success();

	      }

	    });

	  });
	};

    $('.file-upload').checkFileType({
    allowedExtensions: ['jpg', 'jpeg', 'png'],
    success: function() {
    	//$("#message").text("Valid image").fadeIn();
    },
    error: function() {
    	swal("Please Select jpeg,jpg or png File Type","","error");
      $('#profile_div').css('display','block');
       $('#upload_div').css('display','none');
    }
  });
    
    $(".upload-button").on('click', function() {
     
       $(".file-upload").click();

    });

    $(".upload-cancel").on('click', function() {
       $('#profile_div').css('display','block');
       $('#upload_div').css('display','none');
       //$(".file-upload").click();

    });
});

$('#remove_profile').on('click', function() {
	swal({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete Profile Pic!'
	}).then(function () {
		$.ajax({
			url: '<?php echo site_url();?>/rpo_manager/remove_profile',
			type: 'POST',
			success: function(response){
				response = JSON.parse(response);
				if(response == true)
				{
					type = 'success';
					message = 'Profile Picture Deleted Successfully!';
					title = 'Success';
				}
				else
				{
					type = 'warning';
					message = 'Something went wrong';
					title = 'Warning';

				}
				$.notify({
						title: "<strong>"+title+"</strong> ",
						message: message,	
					},
					{
						type: type,
						delay: 800,
						animate:{
							enter: "animated fadeInUp",
							exit: "animated fadeOutDown"
						} 
				});	
			}
		});
		window.setTimeout(function(){location.reload()},3000);
	});
});



</script>

