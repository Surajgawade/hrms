<?php 
$per_new=$percentage['per_new'];

$total = $this->uri->total_segments();
$last = $this->uri->segment($total);
$can_type=$this->session->can_type;
if(isset($_GET['type']))
{
  $type=$_GET['type'];
}
// x_debug($this->session->user_profile_pic);

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
				     <?php }
				     $profile_path = PROFILE_PATH;
            		 if(!empty($this->session->profile_pic) && file_exists($profile_path.'/'.$this->session->profile_pic))
               	{
               		$profile_pic = base_url().$profile_path.$this->session->profile_pic;
               	}
               	else
            		{
               		$profile_pic = base_url().$profile_path.'no_profile_image.png';
            		}?>
				     <p style="margin-top: -10px;color: #eee;">
				     	<?php if(!empty($this->session->profile_pic) && ($last==get_login_user_id()) && file_exists($profile_path.'/'.$this->session->profile_pic)) { ?>
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
			<li><a href="<?php echo site_url();?>/candidate/update/<?php echo  $last;?>">Profile Details</a></li>
			<li><a href="<?php echo site_url();?>/candidate/bank_details/<?php echo $last;?>">Bank Details</a></li>
			<li><a href="<?php echo site_url();?>/candidate/documents/<?php echo  $last;?>">Documents</a></li>
			<?php if($can_type!='user' && $can_type!='Manager'){ ?>
			<li><a href="<?php echo site_url();?>/candidate/billing/<?php echo  $last;?>">Billing</a></li>
			<li><a href="<?php echo site_url();?>/candidate/experience/<?php echo  $last;?>">Experience</a></li>
			<li><a href="<?php echo site_url();?>/candidate/insurance_details/<?php echo  $last;?>">Insurance Details</a></li>
			<li><a href="<?php echo site_url();?>/candidate/reference/<?php echo $last;?>/?type=0">Professional Reference</a></li>
			<?php } ?>
			<li><a href="<?php echo site_url();?>/candidate/interview_reference/<?php echo $last;?>?type=1">Friends Reference</a></li>
			<li><a href="<?php echo site_url();?>/candidate/investment/<?php echo $last;?>">Investment</a></li>
			<?php //if($can_type!='user' && $can_type!='Manager'){ ?>
			<li><a href="<?php echo site_url();?>/candidate/assets/<?php echo $last;?>">Assets</a></li>
			<?php //} ?>
			
			<li><a href="<?php echo site_url();?>/candidate/salary_details/<?php echo $last;?>">Salary Details</a></li>
			<li><a href="<?php echo site_url();?>/candidate/profile_summary/<?php echo $last;?>">Profile Summary</a></li>
			
			<!-- <li><a href="<?php //echo site_url();?>/compensation/my_salaryslips/<?php //echo $last;?>">Salary Slip Details</a></li> -->
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

				<a class="step <?php echo ($access_method=='update')? 'current' : 'step' ?>" href="<?php echo site_url();?>/candidate/update/<?php echo $last;?>">
					<span>Profile Details</span>
				</a>
				<a class="step <?php echo ($access_method=='bank_details')? 'current' : 'step' ?>" href="<?php echo site_url();?>/candidate/bank_details/<?php echo $last;?>">
					<span>Bank Details</span>
				</a>
				<a class="step <?php echo ($access_method=='documents' || $access_method=='add_document')? 'current' : 'step' ?>" href="<?php echo site_url();?>/candidate/documents/<?php echo $last;?>">
					<span>Documents</span>
				</a>

				<?php if($can_type!='user' && $can_type!='Manager'){ ?>

				<a class="step <?php echo ($access_method=='billing' || $access_method=='add_billing' || $access_method=='edit_billing_details')? 'current' : 'step' ?>" href="<?php echo site_url();?>/candidate/billing/<?php echo $last;?>">
					<span>Billing</span>
				</a>
		
				<a class="step <?php echo ($access_method=='experience' || $access_method=='add_experience' || $access_method=='edit_exp_details')? 'current' : 'step' ?>" href="<?php echo site_url();?>/candidate/experience/<?php echo $last;?>">
					<span>Experience</span>
				</a>
	
				<a class="step <?php echo ($access_method=='insurance_details')? 'current' : 'step' ?>" href="<?php echo site_url();?>/candidate/insurance_details/<?php echo $last;?>">
					<span>Insurance Details</span>
				</a>

				<a class="step <?php echo ($access_method=='reference' || ($type==0 && $access_method=='add_reference_details' || ($access_method=='edit_reference_details' && $ref_id == '0')))? 'current' : 'step' ?>" href="<?php echo site_url();?>/candidate/reference/<?php echo $last;?>?type=0">
					<span>Professional Reference</span>
				</a>

			<?php } ?>

				<a class="step <?php echo ($access_method=='interview_reference' || ($type==1 && $access_method=='add_reference_details' ) || ($access_method=='edit_reference_details' && $ref_id == '1'))? 'current' : 'step' ?>" href="<?php echo site_url();?>/candidate/interview_reference/<?php echo $last;?>?type=1">
					<span>Friends Reference</span>
				</a>
		
				<a class="step <?php echo ($access_method=='investment' || $access_method=='add_investment' || $access_method=='edit_investment_details' )? 'current' : 'step' ?>" href="<?php echo site_url();?>/candidate/investment/<?php echo $last;?>">
					<span>Investment</span>
				</a>
	
				<?php //if($can_type!='user' && $can_type!='Manager'){ ?>
				
				<a class="step <?php echo ($access_method=='assets')? 'current' : 'step' ?>" href="<?php echo site_url();?>/candidate/assets/<?php echo $last;?>">
					<span>Assets</span>
				</a>
				<?php //} ?>

				<a class="step <?php echo ($access_method=='salary_details')? 'current' : 'step' ?>" href="<?php echo site_url();?>/candidate/salary_details/<?php echo $last;?>">
					<span>Salary Details</span>
				</a>

				<a class="step <?php echo ($access_method=='profile_summary')? 'current' : 'step' ?>" href="<?php echo site_url();?>/candidate/profile_summary/<?php echo $last;?>">
					<span>Profile Summary</span>
				</a>

		</div>
		</div>
	</div>
</div>    

<div class="demo_progress">
 	<p> Profile Completed</p>
      <!-- <div class="progress candidate_prog">
		<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="83"
	aria-valuemin="0" aria-valuemax="100" style="width:<?php //echo $percentage."%";?>">
	<span><?php //echo $percentage."%";?></span>
        </div>
      </div> -->
  <div class="wrap_arrow" >
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
	
  	
<?php if($can_type!='user' && $can_type!='Manager'){ ?>

	<div class="progress_arrow arrow_blue">
	    <?php if($per_new['bill_per']!=''){ ?>
	    	<i class="fa fa-check" style=" font-size: 20px;" aria-hidden="true"></i>
		<?php }else{ ?>
			<i class="fa" style=" font-size: 20px;" aria-hidden="true"></i>
		<?php } ?>
	  </div>
	<div class="progress_arrow arrow_grey">
	    <?php if($per_new['exp_per']!=''){ ?>
	    	<i class="fa fa-check" style=" font-size: 20px;" aria-hidden="true"></i>
		<?php }else{ ?>
			<i class="fa" style=" font-size: 20px;" aria-hidden="true"></i>
		<?php } ?>
	  </div>  
	  <div class="progress_arrow arrow_yellow">
	    <?php if($per_new['ins_per']!=''){ ?>
	    	<i class="fa fa-check" style=" font-size: 20px;" aria-hidden="true"></i>
		<?php }else{ ?>
			<i class="fa" style=" font-size: 20px;" aria-hidden="true"></i>
		<?php } ?>
	  </div>  
<?php } ?>

	<div class="progress_arrow arrow_greenish">
	    <?php if($per_new['ref_per']!=''){ ?>
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
		pic="<?php echo $profile_pic; // $this->session->can_profile_pic; ?>";
		//alert(pic);
		if(pic!='')
		{
			html = '<img src="' + "<?php echo $profile_pic;//base_url().PROFILE_PATH.$this->session->can_profile_pic; ?>" + '" />';
				$("#upload-demo-i").html(html);
		}
		else{
			html = '<img src="' + "<?php echo $profile_pic;//base_url().PROFILE_PATH.'no_profile_image.png'; ?>" + '" />';
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

			url: "<?= base_url(); ?>index.php/candidate/upload_profile_image/",
			
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
			url: '<?php echo site_url();?>/candidate/remove_profile',
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