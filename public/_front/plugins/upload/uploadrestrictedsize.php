<?php
$owner = $_REQUEST['owner'];
$output_dir = "../../../upload/vehicles/".$owner;
if (!file_exists($output_dir)){
	$oldumask = umask(0);
	mkdir($output_dir, 0777, true);
	umask($oldumask); 
}
$output_dir.= '/';
if(isset($_FILES["myfile"]))
{
	$ret = array();

	$error =$_FILES["myfile"]["error"];
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData() 
	if(!is_array($_FILES["myfile"]["name"])) //single file
	{
 	 	$fileName = $_FILES["myfile"]["name"];

		$filenameTMP = $_FILES['myfile']['tmp_name'];	
		if($filenameTMP != "") { 
			list($width, $height) = getimagesize($filenameTMP);
		} 

		if($width==1200 && $height == 1048) {
	 		move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
    		#$ret[]= $fileName;
			if(strlen($owner < 30)) {
				//save to database
				$conn = mysql_connect('localhost', 'site_rentwizard', '-Qg7i7,)-?t9');
					$db = mysql_select_db('site_rentwizard');
		
				$query = "INSERT INTO property_owner_vehicle_images SET property_owner_vehicle_id='$owner' AND image='$fileName'";
				$result = mysql_query($query);
			}
		} else {
			$ret[] = "Alert! " . $fileName . " is not uploaded. Your image does not fit the proper file format and could not be uploaded, please check the image requirements again!";			
		}
	}
	else  //Multiple files, file[]
	{
	  $fileCount = count($_FILES["myfile"]["name"]);
	  for($i=0; $i < $fileCount; $i++)
	  {
	  	$fileName = $_FILES["myfile"]["name"][$i];
		
		$filenameTMP = $_FILES['myfile']['tmp_name'][$i];	
		if($filenameTMP != "") { 
			list($width, $height) = getimagesize($filenameTMP);
		} 
		
		if($width==1200 && $height == 1048) {
			move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
		  	#$ret[]= $fileName;
			if(strlen($owner < 30)) {
				//save to database
				$conn = mysql_connect('localhost', 'site_rentwizard', '-Qg7i7,)-?t9');
					$db = mysql_select_db('site_rentwizard');
		
				$query = "INSERT INTO property_owner_vehicle_images SET property_owner_vehicle_id='$owner' AND image='$fileName'";
				$result = mysql_query($query);
			}
		} else {
			$ret[] = "Alert! " . $fileName . " is not uploaded. Your image does not fit the proper file format and could not be uploaded, please check the image requirements again!";
		}
	  }
	
	}
    echo json_encode($ret);
 }
 ?>