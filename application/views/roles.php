<div class="page-content">
		<div class="container-fluid">
			<section id="accordion">
      			<div data-type="accordion-section" data-filter="type1">
	    			<h3 data-type="accordion-section-title" class="header-default header-active">Role Listing</h3>
			   		 <div class="accordion-content" data-type="accordion-section-body" style="display:block;">
						<table id="example" class="display table table-bordered " cellspacing="0" width="100%">
							<thead>
								<tr>
									<th style="width:25%">Role Name</th>
									<th style="width:35%">Description</th>
									<th style="width:20%">Actions</th>
								</tr>
							</thead>						
							<tbody>
								<?php foreach ($roles as $role) {?>
								<tr>
									<td><?php echo $role->role_name?></td>
									<td><?php echo !empty($role->role_description) ? $role->role_description : '---';?></td>
									<td style="white-space: nowrap; width: 1%;">
										<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
											<div class="btn-group btn-group-sm" style="float: none;">
												<button type="button" class="tabledit-edit-button btn btn-sm btn-success btn_edit" value="<?php echo $role->role_id ?>" style="float: none;">
													<span class="glyphicon glyphicon-pencil"></span>
												</button>
												<button type="button" class="tabledit-delete-button btn btn-sm btn-danger btn_delete"  value="<?php echo $role->role_id ?>" style="float: none;">
													<span class="glyphicon glyphicon-trash"></span>
												</button>
											</div>								
										</div>
									</td>
								</tr>
								<?php }?>
						</tbody>
						</table>
					</div>
			</div>
			<div data-type="accordion-section" data-filter="type1">
   			 <h3 data-type="accordion-section-title">Create Role</span></h3>
   				<div class="accordion-content col-xs-12" data-type="accordion-section-body">
					<form data-toggle="validator" class="col-sm-12" id="role_frm" action=" " method="post">
						<input type="hidden" name="role_id" id="role_id" value="">				
							<div class="col-sm-12 col-xs-12 profile_bg">
								<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Role Name</label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input class="form-control" placeholder="Role Name" type="text" name="role_name" id="role_name" required="" oninvalid="this.setCustomValidity('Please Enter valid ID')" 
		                                            oninput="setCustomValidity('');">
												<i class="fa fa-user"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-2 col-sm-3 col-xs-12">
										<div class="form-group">
											<label class="form-label">Role Description</label>
										</div>
									</div>
								
									<div class="col-lg-10 col-sm-9 col-xs-12">
										<div class="form-group">
											<div class="form-control-wrapper form-control-icon-right">
												<input required="" class="form-control" placeholder="Role Description" type="text" name="role_description" id="role_description">
											</div>
										</div>
									</div>
								</div>						
								<div class="row">
									<div class="col-lg-6">
										<input id="create_role" type="button" class="btn btn-inline btn-success ladda-button" data-style="expand-left" value="Submit"/>
										<input type="button" class="btn btn-inline ladda-button reset" data-style="expand-left" value="Reset">
										<input type="button" class="btn btn-inline ladda-button pull-right" data-style="expand-left" value="Add New">
									</div>							
								</div>		
							</div>
					</form> 
				</div>
            </div>
        </section>
		</div>
</div><!--.page-content-->

<script>
	$(function(){
		$('#example').DataTable({
			responsive: true
		});
		$('#create_role').click(function (e) {		
			e.preventDefault();
			var role_id= $('#role_id').val();
			var role_name= $('#role_name').val();
			var role_description= $('#role_description').val();
			
			if(role_name=='')
			{
				alert('Enter role name!')
			}
			else
			{
				$.ajax({
					url: '<?php echo site_url();?>/system_settings/add_role',
					dataType :"json",
					async:false,
					data : {role_id: role_id,role_name: role_name, role_description:role_description},
					type: 'POST',
					success: function(response)
					{
						// alert(response.msg);
						 $.notify({
			                    title: "<strong>Success:</strong> ",
			                    message:response.msg,
			                    
			                },{
			                type: "success",
			                delay: 800,
			                    animate:{
			                        enter: "animated fadeInUp",
			                        exit: "animated fadeOutDown"
			                    } 
			            }); 
					}
				});
				window.setTimeout(function(){location.reload()},2000);
			}
		});

	 	$('.btn_edit').on('click',function(){
			var role_id = $(this).val();
			var data = $.parseJSON($.ajax({
				url:  '<?php echo site_url();?>/system_settings/edit_role',
				dataType: "json", 
				data: {role_id:role_id},
				type:'POST',
				async: false
			}).responseText);
			var Response = data.result;
			$('#role_id').val(role_id);
			$('#role_name').val(Response[0].role_name);
			$('#role_description').val(Response[0].role_description);
		});

		$('.btn_delete').click(function (e) {		
		if(!confirm('Are you sure?')){
			e.preventDefault();
			return false;
		}
		else
		{
			var  role_id = $(this).val();
			$.ajax({
			url: '<?php echo site_url();?>/system_settings/delete_role',
			data : {role_id: role_id},
			type: 'POST',
			success: function(response){
				$.notify({
			                    title: "<strong>Success:</strong> ",
			                    message:response,
			                    
			                },{
			                type: "success",
			                delay: 800,
			                    animate:{
			                        enter: "animated fadeInUp",
			                        exit: "animated fadeOutDown"
			                    } 
			            }); 
			}
			});
			window.setTimeout(function(){location.reload()},2000);			
		return true;	
		}
	});

	});
</script>
<script src="<?php echo assets_url();?>js/lib/accordion/accordion.js"></script>
 <script>
  $( function() {

    $( "#accordion" ).accordion({
      collapsible: true,
     
    });
  } );
  </script>