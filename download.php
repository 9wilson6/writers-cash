<?php
ob_start(); 
// require "functions.php";

$fileName=basename($_GET['file']);
$dir=$_GET['dir'];
$filePath=$dir."/".$fileName;
if (!$filePath) {
	die( "File Not Found");
}else{
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: application/zip");
header('Content-Disposition: attachment; filename="'.$fileName.'"');

header("Content-Transfer-Encoding: binary");

	ob_end_clean();
 flush();
readfile($filePath);
exit;
}


 ?>