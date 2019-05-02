<?php 
require_once("../dbconfig/dbconnect.php");
require_once("../inc/header_links.php");
$id= $_SESSION['user_id'];
$query=$query="SELECT verified FROM users WHERE user_id='$id'";
$resultx=$db->get_var($query);
if ($resultx==0) {
	header("location:./not_active");
}

?>