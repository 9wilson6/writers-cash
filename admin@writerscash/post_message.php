<?php 

 if (isset($_POST['submit'])) {
 	require_once("../dbconfig/dbconnect.php");
 	$chat=12;
 	require_once("../inc/utilities.php");
		$message=$_POST['my_message'];
		$sender=3;
		$user_id=$_POST['user_id'];
		$query="INSERT INTO support(sender, user_id, message,datetym ) VALUES('$sender','$user_id','$message', '$date_global')";
		$db->query($query);
	} 

 ?>
