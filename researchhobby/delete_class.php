<?php 
if (isset($_POST['id'])) {
	require_once("../dbconfig/dbconnect.php");
	require_once("../inc/global_functions.php");
	require_once("../inc/utilities.php");
	$project_id=$_POST['id'];
	$user_id=$_POST['user'];
	$user_type=$_POST['user_type'];

	$query="DELETE FROM classes WHERE project_id=$project_id";
	if ($db->query($query)) {
		deleteFiles($user_id, $project_id);
		$query="DELETE FROM bids WHERE project_id='$project_id'";
		$db->query($query);
		/////////////////////////////////notification/////////////////////////////////////////////
		$note="Student Id: ".$user_id." deleted class id: ".$project_id." at ".$date_global;
		$note2="You deleted class id: ".$project_id." at ".$date_global;
		$querys="INSERT INTO notifications(user_type, note) VALUES('$user_type','$note')";
		$db->query($querys);
		$querys="INSERT INTO notifications(user_type, note, user_id) VALUES(3,'$note2', '$user_id')";
		$db->query($querys);
			/////////////////////////////////notification/////////////////////////////////////////////
		echo "Class id {$project_id} was deleted Successfully";
	}else{
		echo "Failed to delete";
	}
	
}
 ?>

 