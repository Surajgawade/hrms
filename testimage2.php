<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    
</head>
<body>

<div class="container-fluid">
	<form action=" " method="POST" enctype="multipart/form-data">
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
        // print_r($file);  just checking File properties

        // File Properties
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
            //print_r($_FILES);


            if ($file_error === 0) {
                if ($file_size <= 5000000) {
                        $file_name_new     =  $file_fname . uniqid('',true) . '.' . $file_ext;
                        $file_name_new    =  uniqid('',true) . '.' . $file_ext;



                        $file_destination =  '/var/www/html/hrms/ResumeParser/ResumeTransducer/UnitTests/' . $file_name_new;
                        
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                        	
                        	$file_name_out = str_replace(".pdf",".txt",$file_name_new);
                        	$lastline = shell_exec("sudo /var/www/html/hrms/shellmain.sh '".$file_name_new."' '".$file_name_out."'");
                        	$filename = '/var/www/html/hrms/test/'. $file_name_out;  
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
		        
								<div class="container col-lg-6">
								<div class="row">
									<legend>Resume</legend>

								  <form role="form">
								  	<legend>Basic Information</legend>
								  	<div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
							            <label for="name">Name</label>
							           <input id="name" name="can_name" type="text" placeholder="Enter name here" value= "<?php echo $firstname. " " . $lastname ?>" class="form-control input-md" required="">
							        </div>
							        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
							            <label for="email">Email address</label>
							            <input id="email" name="can_email" type="text" placeholder="Enter email here" value= "<?php echo $email  ?>" class="form-control input-md" required="">
							        </div>
							        <div class="clearfix"></div>
							        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
							            <label for="mobile-main">Mobile</label>
							            <input id="mobile-main" name="can_phone" type="text" placeholder="Enter mobile number " class="form-control input-md" required="">
							        </div>
							        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
							            <label for="address">Address</label>
							            <input id="address" name="can_address" type="text" placeholder="Enter address here" class="form-control input-md" required="">
							        </div>
							        <div class="clearfix"></div>
							        <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
							        	<label for="gender">Gender</label>
							            <select id="gender" name="can_gender" class="form-control">
										      <option value="1">male</option>
										      <option value="2">female</option>
							    		</select>
							        </div>


							        <div class="clearfix"></div>
							        <legend>Education</legend>
							        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
							            <label for="edu-primary">Education SSC</label>  
							             <input id="edu-primary" name="can_edu_primary" type="text" placeholder="Board" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="edu-primary-year">Year</label>  
							             <input id="edu-primary" name="can_edu_primary_year" type="text" placeholder="year" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="edu-primary-marks">Percentage</label>  
							             <input id="edu-primary" name="can_edu_primary_marks" type="text" placeholder="percentage" class="form-control input-md">
							        </div>


							        <div class="clearfix"></div>
							        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
							            <label for="edu-secondary">Education HSC</label>  
							             <input id="edu-secondary" name="can_edu_secondary" type="text" placeholder="Board" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="edu-secondary-year">Year</label>  
							             <input id="edu-secondary" name="can_edu_seondary_year" type="text" placeholder="year" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="edu-primary-marks">Percentage</label>  
							             <input id="edu-primary" name="can_edu_secondary_marks" type="text" placeholder="percentage" class="form-control input-md">
							        </div>


							        <div class="clearfix"></div>
							        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
							            <label for="edu-graduation">Education Graduation</label>  
							             <input id="edu-graduation" name="can_edu_graduation" type="text" value= "<?php echo $edu_grad ?>" placeholder="College/University" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="edu-graduation-year">Year</label>  
							             <input id="edu-graduation" name="can_edu_graduation_year" type="text" placeholder="year" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="edu-graduation-marks">Percentage</label>  
							             <input id="edu-graduation" name="can_edu_graduation_marks" type="text" placeholder="percentage" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="edu-graduation-spec">Specilization</label>  
							             <input id="edu-graduation-spec" name="can_edu_graduation_spec" type="text" placeholder="specilization" class="form-control input-md">
							        </div>

							        <div class="clearfix"></div>
							        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
							            <label for="edu-post">Education Post Graduation</label>  
							             <input id="edu-post" name="can_edu_post" type="text" placeholder="College/University" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="edu-post-year">Year</label>  
							             <input id="edu-post" name="can_edu_post_year" type="text" placeholder="year" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="edu-post-marks">Percentage</label>  
							             <input id="edu-post" name="can_edu_post_marks" type="text" placeholder="percentage" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="edu-post-marks">Specilization</label>  
							             <input id="edu-post-spec" name="can_edu_post_spec" type="text" placeholder="specilization" class="form-control input-md">
							        </div>

							          <div class="clearfix"></div>
							        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
							            <label for="edu-doct">Education Doctorate</label>  
							             <input id="edu-doct" name="can_edu_doct" type="text" placeholder="College/University" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="edu-doct-year">Year</label>  
							             <input id="edu-doct" name="can_edu_doct_year" type="text" placeholder="year" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="edu-doct-marks">Percentage</label>  
							             <input id="edu-doct" name="can_edu_doct_marks" type="text" placeholder="percentage" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="edu-doct-marks">Specilization</label>  
							             <input id="edu-doct-spec" name="can_edu_doct_spec" type="text" placeholder="specilization" class="form-control input-md">
							        </div>

							        <div class="clearfix"></div>
							        <legend>Employment Details</legend>
							        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
							            <label for="emp-name">First Employer Name</label>  
							             <input id="emp-name" name="can_emp_name" type="text" placeholder="Company Name" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="emp-start-year"> Start Year</label>  
							             <input id="emp-start-year" name="can_emp_start_year" type="text" placeholder="MM/YYYY" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="emp-end-year">End Year</label>  
							             <input id="emp-end-year" name="can_emp_end_year" type="text" placeholder="MM/YYYY" class="form-control input-md">
							        </div>
							         <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="emp-desgn">Designation</label>  
							             <input id="emp-desgn" name="can_emp_desgn" type="text" placeholder="designation" class="form-control input-md">
							        </div>

							        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
							            <label for="emp-name-2">Second Employer Name</label>  
							             <input id="emp-name-2" name="can_emp_name_2" type="text" placeholder="Company Name" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="emp-start-year-2"> Start Year</label>  
							             <input id="emp-start-year-2" name="can_emp_start_year_2" type="text" placeholder="MM/YYYY" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="emp-end-year-2">End Year</label>  
							             <input id="emp-end-year-2" name="can_emp_end_year_2" type="text" placeholder="MM/YYYY" class="form-control input-md">
							        </div>
							         <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="emp-desgn-2">Designation</label>  
							             <input id="emp-desgn-2" name="can_emp_desgn_2" type="text" placeholder="designation" class="form-control input-md">
							        </div>

							         <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
							            <label for="emp-name-3">Third Employer Name</label>  
							             <input id="emp-name-3" name="can_emp_name_3" type="text" placeholder="Company Name" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="emp-start-year-3"> Start Year</label>  
							             <input id="emp-start-year-3" name="can_emp_start_year_3" type="text" placeholder="MM/YYYY" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="emp-end-year-3">End Year</label>  
							             <input id="emp-end-year-3" name="can_emp_end_year_3" type="text" placeholder="MM/YYYY" class="form-control input-md">
							        </div>
							         <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="emp-desgn-3">Designation</label>  
							             <input id="emp-desgn-3" name="can_emp_desgn_3" type="text" placeholder="designation" class="form-control input-md">
							        </div>

							        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
							            <label for="emp-name-4">Fourth Employer Name</label>  
							             <input id="emp-name-4" name="can_emp_name_4" type="text" placeholder="Company Name" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="emp-start-year-4"> Start Year</label>  
							             <input id="emp-start-year-4" name="can_emp_start_year_4" type="text" placeholder="MM/YYYY" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="emp-end-year-4">End Year</label>  
							             <input id="emp-end-year-4" name="can_emp_end_year_4" type="text" placeholder="MM/YYYY" class="form-control input-md">
							        </div>
							         <div class="form-group col-xs-5 col-sm-2 col-md-2 col-lg-2">
							            <label for="emp-desgn-4">Designation</label>  
							             <input id="emp-desgn-4" name="can_emp_desgn_4" type="text" placeholder="designation" class="form-control input-md">
							        </div>

							        <div class="clearfix"></div>
							        <legend>Other Details</legend>
							        <div class="form-group col-xs-10 col-sm-8 col-md-8 col-lg-8">
							            <label for="skills">Technical skills</label>  
							             <input id="skills" name="can_skills" type="text" placeholder="Enter skills here" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-10 col-sm-8 col-md-8 col-lg-8">
							            <label for="skills">Training</label>  
							             <input id="training" name="can_training" type="text" placeholder="Training course Name here" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-10 col-sm-8 col-md-8 col-lg-8">
							            <label for="Languages">Languages</label>  
							             <input id="languages" name="can_languages" type="text" placeholder="Languages here" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-10 col-sm-8 col-md-8 col-lg-8">
							            <label for="Achievements">Achievements</label>  
							             <input id="achievements" name="can_achievements" type="text" placeholder="Achievements here" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-10 col-sm-8 col-md-8 col-lg-8">
							            <label for="Awards">Awards</label>  
							             <input id="awards" name="can_awards" type="text" placeholder="Awards here" class="form-control input-md">
							        </div>
							        <div class="form-group col-xs-10 col-sm-8 col-md-8 col-lg-8">
							            <label for="Hobbies">Hobbies</label>  
							             <input id="hobbies" name="can_hobbies" type="text" placeholder="Hobbies here" class="form-control input-md">
							        </div>
							        <div class="clearfix"></div>
							        <div class="col-xs-10 col-sm-4 col-md-4 col-lg-4">
							            <button type="submit" class="btn btn-success">Submit</button>
							        </div>
							    </form>
							    <div class="clearfix"></div>

							    <br /><br />
								</div>
							</div>

						 	<?php

										} 
								 echo '</div>
								    <div class="col-lg-6">
								     <div class="viewer 	">
								<iframe src="http://192.168.11.123/hrms/ResumeParser/ResumeTransducer/UnitTests/'.$file_name_new.'" style="width:100%; height:1000px;" frameborder="0"></iframe>
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
