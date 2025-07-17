<div class="col-lg-2">
	<div class="form-group">
	<label class="form-label"> Operations</label>
	</div>                                       
</div>
<div class="col-lg-10">
		  <?php foreach ($operations as $operation) {?>
		 	 <input type='checkbox' class="menu_id" name="operations[]" id='menu_id-<?php echo $operation['mo_id']?>' value="<?php echo $operation['mo_id']?>" <?php if(in_array($operation['mo_id'], $selected)){ echo "checked"; } ?> />
		 	 <?php echo $operation['menu_operation_name']?>
		 	 <br/>
		 	 
		  <?php }?>
</div>
