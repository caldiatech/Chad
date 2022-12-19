<?php
$owner = $_REQUEST['owner'];
$dir_name = $_SERVER['DOCUMENT_ROOT'].'/upload/vehicles';
$output_dir = $dir_name."/".$owner;

if (!file_exists($output_dir)){
	$oldumask = umask(0);
	mkdir($output_dir, 0777, true);
	umask($oldumask); 
}else{
	chmod($output_dir, 0775);
}
$output_dir.= '/';
if(isset($_FILES["myfile"]))
{
	$var_localhost = '127.0.0.1';
	$var_dbname = 'site_rentwizard';
	$var_username = 'site_rentwizard';
	$var_password = '-Qg7i7,)-?t9';

	$ret = array();

	$error =$_FILES["myfile"]["error"];
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData() 
	if(!is_array($_FILES["myfile"]["name"])) //single file
	{
 	 	$fileName = $_FILES["myfile"]["name"];
	 	$dbname = str_replace(' ','-', $fileName).'-'.time();

		$filenameTMP = $_FILES['myfile']['tmp_name'];	
		if($filenameTMP != "") { 
			list($width, $height) = getimagesize($filenameTMP);
		} 

		if($width>3000) {
			$ret[] = "Alert! " . $fileName . " is not uploaded. Your image is too big!";
		}else if($width<300) {
			$ret[] = "Alert! " . $fileName . " is not uploaded. Your image is too small!";
		} else {
	 		move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$dbname);
    		#$ret[]= $fileName;
			if(strlen($owner < 30)) {
				//save to database
				$conn = mysql_connect($var_localhost, $var_username, $var_password);
				$db = mysql_select_db($var_dbname);
		
				$query = "INSERT INTO property_owner_vehicle_images SET property_owner_vehicle_id='$owner' AND image='$dbname'";
				$result = mysql_query($query);
				
			}
				
						
		}
	}
	else  //Multiple files, file[]
	{
	  $fileCount = count($_FILES["myfile"]["name"]);
	  for($i=0; $i < $fileCount; $i++)
	  {
	  	$fileName = $_FILES["myfile"]["name"][$i];
		$dbname = str_replace(' ','-', $fileName).'-'.time();
		$filenameTMP = $_FILES['myfile']['tmp_name'][$i];	
		if($filenameTMP != "") { 
			list($width, $height) = getimagesize($filenameTMP);
		} 
		
		if($width>3000) {
			$ret[] = "Alert! " . $fileName . " is not uploaded. Your image is too big!";
		}else if($width<300) {
			$ret[] = "Alert! " . $fileName . " is not uploaded. Your image is too small!";
		} else {
			move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$dbname);
		  	#$ret[]= $fileName;
			if(strlen($owner < 30)) {
				//save to database
				$conn = mysql_connect($var_localhost, $var_username, $var_password);
				$db = mysql_select_db($var_dbname);
		
				$query = "INSERT INTO property_owner_vehicle_images SET property_owner_vehicle_id='$owner' AND image='$dbname'";
				$result = mysql_query($query);
			}
		} 
	  }
	
	}
    echo json_encode($ret);
 }
 ?>