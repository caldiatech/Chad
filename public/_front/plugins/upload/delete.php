<?php
$owner = $_POST['owner'];
$output_dir = "../../../upload/vehicles/".$owner;
$output_dir .= '/';
if(isset($_POST["op"]) && $_POST["op"] == "delete" && isset($_POST['name']))
{
	$fileName =$_POST['name'];
	$filePath = $output_dir. $fileName;
	//echo $filePath;
	if (file_exists($filePath)) 
	{
        unlink($filePath);
		
		//remove from database
		  	$conn = mysql_connect('localhost', 'site_rentwizard', '-Qg7i7,)-?t9');
			$db = mysql_select_db('site_rentwizard');

	  	$query = "DELETE FROM property_owner_vehicle_images WHERE property_owner_vehicle_id='$owner' AND image='$fileName'";
        $result = mysql_query($query);

		echo "Deleted File ".$fileName."<br>";
    }else{
		echo 'failed to delete the image';
	}
}else{
	//var_dump($_POST);
}

?>