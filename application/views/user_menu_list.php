<option value=''>Select Menu</option>
	<?php
		foreach ($data as $value) 
		{
		?>
			<option value="<?=$value['menu_id']?>"><?=$value['menu_name']?></option>
		<?php
		}
	  ?>
	