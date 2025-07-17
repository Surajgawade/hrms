 <?php foreach ($widgets as $widget) {?>
	 <input type='checkbox' class="widget_id" name="widget_ids[]" id='menu_id-<?php echo $widget['widget_id']?>' value="<?php echo $widget['widget_id']?>" <?php if(in_array($widget['widget_id'], $selected)){ echo "checked";} ?>/>
	 <?php echo $widget['widget_name']?>
	 <br/>
	 
<?php }?>
