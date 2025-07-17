<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
<?php $this->load->view("controls/meta");?>	


<link rel="icon" href="<?php echo assets_url();?>img/fav.ico" type="image/x-icon" />
<?php /*
<link rel="icon" href="" type="image/x-icon" />
<<<<<<< HEAD
<link rel="icon" href="<?php echo assets_url();?>images/favicon.png" type="image/x-icon" />
<link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
=======
<link rel="icon" href="<?php echo assets_url();?>img/fav.ico" type="image/x-icon" />

<!-- <link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
>>>>>>> 81a9b3207b5b24dbd69e78fc9ca08bd5f755ec77
<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
<link href="img/favicon.png" rel="icon" type="image/png">
<<<<<<< HEAD
<link href="img/favicon.ico" rel="shortcut icon">*/?>

<title> <mp:Title/> | HRMS</title>
<?php $this->load->view("controls/css_include");?> 

<script>
	$(window).bind("load",function() {
		$(".se-pre-con").fadeOut("slow");
	}); 
</script>

</head>  
<?php 
	$this->load->view("controls/header");
	$this->load->view("controls/sidebar");
	$this->load->view("controls/js_include");
	$this->load->view("controls/contentpane");
	$this->load->view( "controls/footer" );
?>
