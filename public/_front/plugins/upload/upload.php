<?php
$owner = $_REQUEST['owner']; $dashboard = $_REQUEST['dashboard'];
$dir_name = '../../../uploads/dashboard/'.$dashboard;
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
	
	$ret = array();

	$error =$_FILES["myfile"]["error"];
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData() 
	if(!is_array($_FILES["myfile"]["name"])) //single file
	{
 	 	$fileName = $_FILES["myfile"]["name"];
 	 	$path1 = $_FILES["myfile"]["name"];
		$ext = pathinfo($path1, PATHINFO_EXTENSION);

		/*$path_extension = getimagesize($_FILES["myfile"]["name"]);*/
 	 	$dbname   = "profile-image.".$ext;

	
	 	//$dbname   = str_replace(' ','-', $fileName);
	 	//$dbname = file_exists_name($output_dir, $fileName);

		$filenameTMP = $_FILES['myfile']['tmp_name'];	
		if($filenameTMP != "") { 
			list($width, $height) = getimagesize($filenameTMP);
		} 

		if($width>3000) {
			$ret[] = "Alert! " . $fileName . " is not uploaded. Your image is too big!";
		}else {
	 		move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$dbname);
    	
		}
	}
	else  //Multiple files, file[]
	{
	  $fileCount = count($_FILES["myfile"]["name"]);
	  for($i=0; $i < $fileCount; $i++)
	  {
	  	$fileName = $_FILES["myfile"]["name"][$i];
		// $dbname = str_replace(' ','-', $fileName);
		$dbname = file_exists_name($output_dir, $fileName);

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
			
		} 
	  }
	
	}
    echo json_encode($ret);
 }

 function file_exists_name($path, $filename) {

 	$filename = str_replace(' ','-', $filename);
 	$img_path = $path.$filename;
 	$img_info = pathinfo($img_path);

 	$ctr = 1;
 	while (file_exists($img_path)) {
 		$filename = $img_info['filename'].'-'.$ctr.'.'.$img_info['extension'];
		$img_path = $path.$filename;
		$ctr++;
 		# code...
 	}
 	return $filename;
 }
 ?>