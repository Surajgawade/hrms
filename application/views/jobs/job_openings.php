<body class="with-side-menu-addl-full">
	<div class="page-content">
	<div>
		<?php if($this->session->flashdata('success')){?>
			<script type="text/javascript">
				var message_text='<?php echo $this->session->flashdata('success');?>';
					$.notify({
								title: "<strong>Success:</strong> ",
								message: message_text,
							},
							{
								type: "success",
								delay: 800,
								animate:{
								enter: "animated fadeInUp",
								exit: "animated fadeOutDown"
								}
							});
			</script>
		<?php }?>
	</div>
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell col-md-10">
							<h2>Jobs Openings</h2>
						</div>
					</div>
				</div>
			</header>
			
			<section class="card">
				<div class="card-block" id="curr_jobs">
					</div>
				</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->	

	<!-- Refer friend & send job opening email Modal -->
	<div class="modal fade" id="reref_friendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Refer to friend</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	         <form data-toggle="validator" class="col-sm-12" id="refer_friend" action="<?php echo site_url();?>/jobs/refer_friend " method="post">
               <input type="hidden" name="can_id" id="can_id" value="<?php echo get_login_user_id();?>">
						<div class="col-sm-12 col-xs-12 profile_bg">
						   <div class="row">
						       <div class="col-lg-2 col-sm-3 col-xs-12">
						           <div class="form-group">
						           <label class="form-label">Name <span>*</span></label>
						           </div>
						       </div>

						       <div class="col-lg-10 col-sm-9 col-xs-12">
						           <div class="form-group">
						               <div class="form-control-wrapper form-control-icon-right">
						                   <input type="text" class="form-control" required  data-error="Please Enter Name" name="referto_name" id="name" value="">
						                   <div class="help-block with-errors error_msg"></div>
						               </div>
						           </div>
						       </div>
						   </div>
						   <div class="row">
						      <div class="col-lg-2 col-sm-3 col-xs-12">
									<div class="form-group">
									<label class="form-label">Email Id <span>*</span></label>
									</div>
						      </div>

						      <div class="col-lg-10 col-sm-9 col-xs-12">
						         <div class="form-group">
					               <div class="form-control-wrapper form-control-icon-right">
					                  <input type="email" class="form-control" required data-error="Please Enter Valid Email Id"  name="referto_email" id="email" value="">
					                  <div class="help-block with-errors error_msg"></div>
					               </div>
					         </div>
						      </div>
						   </div>
						   <input type="hidden" name="frm_job_id" id="frm_job_id">
						   <input type="hidden" name="job_title" id="job_title">
						   <input type="hidden" name="no_of_position" id="no_of_position">						   

						   <div class="row">
						       <div class="col-lg-2 col-sm-3 col-xs-12">
						           <div class="form-group">
						           <label class="form-label">Message<span>*</span></label>
						           </div>
						       </div>

						       <div class="col-lg-10 col-sm-9 col-xs-12">
						           <div class="form-group">
						               <div class="form-control-wrapper form-control-icon-right">
						                   <textarea placeholder="Message" name="message" id="message" rows="6" class="form-control" data-error="Please Enter Message" required></textarea>
						                   <i class="fa fa-address-card"></i>
						                   <div class="help-block with-errors error_msg"></div>                                        
						               </div>
						           </div>
						       </div>
						   </div>

						   <div class="row">
						       <div class="col-lg-6">
						           <input id="submit_refer_friend" type="submit" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
						       </div>
						   </div>
						</div>
            </form> 
	      </div>
	      <!-- <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div> -->
	    </div>
	  </div>
	</div>


	<script>
	$(document).ready(function() {
		$(".chosen-select").chosen();
		get_openings();
	});	
			
	function get_openings()
	{
		$.ajax({
			url: '<?php echo site_url();?>/dashboard/get_all_jobs',
			dataType :"json",
			type: 'POST',
			success: function(response)
			{
				console.log(response);
				var t_data = '';
				if(response.jobs == '')
				{
				t_data = 'Empty';
				}
				else
				{
					$.each(response.jobs, function(k_tr, v_tr)
					{   
						if(v_tr.no_of_position==0)
	               {
                     v_tr.no_of_position ='-';
	               }           
						t_data += '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"> <div class="panel panel-default"> <div class="panel-heading " role="tab" id="headingOne"> <h4 class="panel-title tit_acc"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#' +v_tr.job_id+'" aria-expanded="true" aria-controls="collapseOne"> <i class="more-less glyphicon glyphicon-plus"></i> <p ><strong>Job Title : </strong><span class="opening-name">' +v_tr.job_title+'</span></p> <p class="btm_name "><strong>No. of Positions : </strong><span class="nop">'+v_tr.no_of_position+'</span></p> </a> </h4> </div> <div id="' +v_tr.job_id+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" > <div class="panel-body pn_btm_body"> <div class="page-heading"> <h2><strong>Job Description</strong></h2> <p class="jd">'+v_tr.job_description+' </p><input type="hidden" value="' +v_tr.job_id+'" class="job_id"><button class="btn btn-inline btn-success ladda-button refer_friend" data-style="expand-left"><span class="ladda-label">Send Email</span><div class="ladda-progress" style="width: 106px;"></div></button> </div> </div> </div> </div> </div>';
					});

				}

				$('#curr_jobs').html(t_data);
			}
		});
	}

		function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);

	$(document).on('click', '.refer_friend', function()
	{ 
		var message='';
		var job_title = $(this).parents().find(".opening-name").html();
		var no_of_position = $(this).parents().find(".nop").html();
		var job_description = $(this).parent().find(".jd").html();
		var job_id  =  $(this).parent().find(".job_id ").val();

		$('#refer_friend #frm_job_id').val(job_id);
		$('#refer_friend #job_title').val(job_title);
		$('#refer_friend #no_of_position').val(no_of_position);
		$('#refer_friend #message').val(job_description);
		$('#reref_friendModal').modal('show');
	});
	</script>



