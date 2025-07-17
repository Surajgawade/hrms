<div class="page-content">
		<div class="container-fluid">
            <div class="well" style="margin-bottom:20px;">
				 <div class="row">
					<form data-toggle="validator" class="col-sm-12" id="profile_form" action=" " method="post">
						<h1 class="well headline">Add Menu Operations</h1>
						<div class="col-sm-12 col-xs-12 profile_bg">
							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
									<label class="form-label">Menu Name</label>
									</div>
								</div>
								<div class="col-lg-10">
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<select class="chosen-select col-md-10 col-sm-12 col-xs-12 " name="menu_id" id="menu_id"  style="width: 100px" required="">
											<optgroup label="">
											<option value="">Select Menu</option>>
											<?php foreach ($menues as $menu) {?>
											<option value="<?php echo $menu->menu_id;?>"><?php echo $menu->menu_name;?></option>
											<?php }?>												  												  
											</optgroup>
											</select>
										</div>
									</div>
								</div>
							</div>
                            <div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Operation Name</label>
									</div>
								</div>
							
								<div class=col-lg-10>
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input class="form-control" placeholder="Operation Name" type="text" name="operation_name" id="operation_name" required="" oninvalid="this.setCustomValidity('Please Enter Menu Name')" oninput="setCustomValidity('');">
										</div>
									</div>
								</div>
							</div>
		
							<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
										<label class="form-label">Description</label>
									</div>
								</div>
							
								<div class=col-lg-10>
									<div class="form-group">
										<div class="form-control-wrapper form-control-icon-right">
											<input required="" class="form-control" placeholder="Operation Description" type="text" name="description" id="description">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<button class="btn btn-inline btn-success ladda-button" data-style="expand-left"><span class="ladda-label">Add</span>
									<span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 106px;"></div></button>
								</div>
							</div>
					    </div>
					</form> 
				</div>


			</div>

			<section class="card">
					<div class="card-block">
						<div class="menu_operations" id="menu_operations">
							<table id="menu_list" class="display table table-bordered table-striped menu_list" cellspacing="0" width="100%" style="width: 100%">
							<thead>
								<tr>
									<!-- <th style="width:25%">Menu Name</th> -->
									<th style="width:25%">Menu Operation Name</th>
									<th style="width:25%">Description</th>
									<th style="width:20%">Active</th>
									<th style="width:30%">Actions</th>
								</tr>
						</thead>
							<tbody>

							</tbody>
							</table>
						</div>
					</div>
				</section>	
			
			
	</div><!--.page-content-->
</div>
	<script>
		// var oTable ='';
		function get_menus(menu_id)
		{
			 var menu_id_new = menu_id;
			oTable = new Object; 
			oTable = $('#menu_list').DataTable({
				'responsive': true,
				 'retrieve': true,
				'bProcessing'    : true,
				'bServerSide'    : true,
				"order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
				'sPaginationType': 'full_numbers',
				"aoColumns": [
					// {"sName": "menu_id", "mData": "menu_id" ,"bSortable":true},
					// {"sName": "menu_name", "mData": "menu_name" ,"bSortable":true},
					{"sName": "menu_operation_name", "mData": "menu_operation_name" ,"bSortable":true},
					{"sName": "description", "mData": "description" ,"bSortable":true},
					{"sName": "is_active", "mData": "is_active" ,"bSortable":true},
					{"sName": "Action", "mData": "edit" ,"bSortable":false,"bSearchable":false}
				],
				'sAjaxSource'    : '<?php echo site_url();?>'+'/system_settings/get_menu_assign_operation?menu_id='+menu_id_new,
				'fnServerData': function(sSource, aoData, fnCallback)
				{
					$.ajax
					({
						'dataType': 'json',
						'type'    : 'POST',
						'url'     : sSource,
						'data'    : aoData,
						'success' : fnCallback
					});
				}
			});
			

		}
		$('#menu_id').change(function (e) {
				var menu_id =  $(this).val();
				if(menu_id!='')
				{
					//$('#menu_list').css('display','block');
					get_menus(menu_id);
					//get_menus(menu_id);
					oTable.draw();
					oTable.destroy();
				}
				else
				{
					//$('#menu_list').css('display','none');
				}
			});
		$(function(){
			$(".chosen-select").chosen();
			
			
		});
	</script>