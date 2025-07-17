<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    
</head>
<body>

<div class="container-fluid">
	<form action="" method="POST" enctype="multipart/form-data">
	 <label>Upload Your Cv</label>
<div class="row">
	
        <div class="col-lg-2 form-group">
           
            <input class="form-control" type="file" name="file"/>
        </div>
        <div class="col-lg-1 form-group">
          
            <input type="submit" name="upload" value="upload"/>
        </div>

</form>
</div>
</div>
</div>



</body>
</html>


<?php
if(isset($_REQUEST["upload"]))
{
	if (isset($_FILES['file'])) {
        $file   = $_FILES['file'];
        $file_name  = $file['name'];
        $file_tmp   = $file['tmp_name'];
        $file_size  = $file['size'];
        $file_error = $file['error'];

        // Working With File Extension
        $file_ext   = explode('.', $file_name);
        $file_fname = explode('.', $file_name);

        $file_fname = strtolower(current($file_fname));
        $file_ext   = strtolower(end($file_ext));
        $allowed    = array('txt','pdf','doc','docx');
        

        if (in_array($file_ext,$allowed)) {	
            if ($file_error === 0) {
                if ($file_size <= 5000000) {
                        $file_name_new     =  $file_fname . uniqid('',true) . '.' . $file_ext;
                        $file_name_new    =  uniqid('',true) . '.' . $file_ext;



                        $file_destination =  FCPATH.'ResumeParser/ResumeTransducer/UnitTests/' . $file_name_new;
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                        	
                        	$file_name_out = str_replace(".pdf",".txt",$file_name_new);
                        	//print_r($file_name_out); 
                        	
                        	$lastline = shell_exec("sudo ".FCPATH."shellmain.sh '".$file_name_new."' '".$file_name_out."'");
                        	
                        	$filename = FCPATH.'test/'. $file_name_out;  
							$handle = fopen($filename, "r");
							if(!$handle){
								echo "file can not be opened";
								die();
							}
							else{

								 $contents = fread($handle, filesize($filename));
								$result4 = $contents;
								$description = str_replace("\\n","\n",$result4);
								$des=str_replace("?"," ",$description);
							
							  $obj = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $des), true );
							  // echo "<pre>";
							  // print_r($obj);
							  // exit;
							  				if (isset($obj['education_and_training'][0]['Education'])){

											    $edu_grad=$obj['education_and_training'][0]['Education'];
											}
											else{
											$edu_grad ="";

											}
											
											if (isset($obj['basics']['name']['firstName'])){
											    $firstname =$obj['basics']['name']['firstName'];
											    //echo $var1;
											}
											else{
											$firstname ="";

											}
											if (isset($obj['basics']['name']['surname'])){
											    $lastname =$obj['basics']['name']['surname'];
											   // echo $var2;
											}
											else{
											$lastname ="";

											}
											//echo $obj['basics']['name']['surname'];
											//echo "<br>";
											if (isset($obj['basics']['email'][0])){
											    $email =$obj['basics']['email'][0];
											   // echo $var3;
											}
											else{
											$email ="";

											}
										//	echo $obj['basics']['gender'];
										//	echo "<br>";
										//	echo $obj['basics']['email'][0];

										  ?>
		        
								

						 	<?php

										} 
								 echo '</div>
								    <div class="col-lg-6">
								     <div class="viewer 	">
								<iframe src="'.base_url().'ResumeParser/ResumeTransducer/UnitTests/'.$file_name_new.'" style="width:100%; height:1000px;" frameborder="0"></iframe>
								</div>
								</div>
								</div>
								</div>';


                        }
                        else
                        {
                            echo "some error in uploading file";
                        }
                       
                }
                else
                {
                    echo "size must bne less then 5MB";
                }
            }

        }
        else
        {
            echo "invalid file";
        }
}
}
?>

