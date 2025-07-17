 <div class="page-content">
	<div class="container-fluid">
		<TEXTAREA rows="5" cols="100" name="query" id="query"></TEXTAREA>
		<br>
		<input type="button" id="submit" value="Run"><BR><BR>
		<div id="result"></div>
	</div>
</div>
<script type="text/javascript">
	
	$(document).ready(function() {
		$('#submit').on('click', function()
		{
			query=$('#query').val();
			//alert(query);
			if(query!='')
			{
				$.ajax({
		            url: '<?php echo site_url();?>/query_runner/run',
		            data : {'query':query},
		            type: 'POST',
		            success: function(response)
		            {
		            	$('#result').html(response);
		            	//console.log(response);
		                
		            }
		        });
			}
		});
	});
</script>
