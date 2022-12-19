<?php
$owner = $_REQUEST['owner']; $dashboard = $_REQUEST['dashboard'];
$dir = "../../../uploads/dashboard/".$dashboard.'/'.$owner;
$path = "/uploads/dashboard/".$dashboard.'/'.$owner;
$files = scandir($dir);
$date_cache = date('YmdHis');
$ret= array();
foreach($files as $file)
{
	$filePath=$dir."/".$file;

	if($file == "." || $file == ".." || is_dir($filePath))
		continue;
	
	$details = array();
	$details['name']=$file.'?ver='.$date_cache;
	$details['path']=$path;
	$details['size']=filesize($filePath);
	$ret[] = $details;

}

echo json_encode($ret);
?>