<?php foreach ($permissions as $permission) {?>
	 <input type='checkbox' class="menu_id" name="menu_ids[]" id='menu_id-<?php echo $permission['menu_id']?>' value="<?php echo $permission['menu_id']?>" <?php if(in_array($permission['menu_id'], $selected)){ echo "checked";} ?>/>
	 <?php echo $permission['menu_name']?>
	 <br/>
	 
<?php }?>