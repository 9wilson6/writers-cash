<?php
require_once("../dbconfig/dbconnect.php");
require_once("../inc/utilities.php");
$date_global_=strtotime($date_global);

//////////////////////////IN PROGRESS//////////////////////////////////////////////
///
///
///
//////////////////////////IN PROGRESS//////////////////////////////////////////////
function in_progress($user_type, $user_id){
	global $db;
if ($user_type==1) {
	$query="SELECT * FROM on_progress WHERE student_id='$user_id' ";
}elseif ($user_type==2) {
	$query="SELECT * FROM on_progress WHERE tutor_id='$user_id' ";
}
$results=$db->get_results($query);

return $db->num_rows;

}
////////////////////////////////////////////////////////////////////
if ($_POST['target']=="in_progress") {
	if (in_progress($_POST['user_type'], $_POST['user_id'])>0) {
		echo "<span class='my_pill_'>".in_progress($_POST['user_type'], $_POST['user_id'])."</span>";
	}else{
		echo "<span class='pill_'>".in_progress($_POST['user_type'], $_POST['user_id'])."</span>";
	}

}

//////////////////////////IN PROGRESS//////////////////////////////////////////////
///
///
///
//////////////////////////IN PROGRESS//////////////////////////////////////////////
///



//////////////////////////CLOSED//////////////////////////////////////////////
///
///
///
//////////////////////////CLOSED//////////////////////////////////////////////
function closed($user_type, $user_id){
	global $db;
if ($user_type==1) {
	$query="SELECT * FROM closed WHERE student_id='$user_id' ";
}elseif ($user_type==2) {
	$query="SELECT * FROM closed WHERE tutor_id='$user_id' ";
}
$results=$db->get_results($query);

return $db->num_rows;

}
////////////////////////////////////////////////////////////////////
if ($_POST['target']=="closed") {
	if (closed($_POST['user_type'], $_POST['user_id'])>0) {
echo "<span class='my_pill_'>".closed($_POST['user_type'], $_POST['user_id'])."</span>";
	}else{
	echo "<span class='pill_'>".closed($_POST['user_type'], $_POST['user_id'])."</span>";
	}

}

//////////////////////////CLOSED//////////////////////////////////////////////
///
///
///
//////////////////////////CLOSED//////////////////////////////////////////////
function on_revision($user_type,$user_id ){
 global $db;
if ($user_type==1) {
	$query="SELECT * FROM revisions WHERE student_id='$user_id'";
}elseif($user_type==2){
	$query="SELECT * FROM revisions WHERE tutor_id='$user_id'";
}
$results=$db->get_results($query);

return $db->num_rows;

}
////////////////////////////////////////////////////////////////////
if ($_POST['target']=="on_revision") {

	if (on_revision($_POST['user_type'], $_POST['user_id'])>0) {
echo "<span class='my_pill_'>".on_revision($_POST['user_type'], $_POST['user_id'])."</span>";
	}else{
	echo "<span class='pill_'>".on_revision($_POST['user_type'], $_POST['user_id'])."</span>";
	}
}
function assigned(){

}

//////////////////////////DELIVERED//////////////////////////////////////////////
///
///
///
//////////////////////////DELIVERED//////////////////////////////////////////////

function delivered($user_type, $user_id){
	global $db;
if ($user_type==1) {
	$query="SELECT * FROM delivered WHERE student_id='$user_id'";
}elseif($user_type==2){
	$query="SELECT * FROM delivered WHERE tutor_id='$user_id'";
}
$results=$db->get_results($query);
return $db->num_rows;
}
////////////////////////////////////////////////////////////////////////////////
if ($_POST['target']=="delivered") {

	if (delivered($_POST['user_type'], $_POST['user_id'])>0) {
echo "<span class='my_pill_'>".delivered($_POST['user_type'], $_POST['user_id'])."</span>";
	}else{
	echo "<span class='pill_'>".delivered($_POST['user_type'], $_POST['user_id'])."</span>";
	}
}
//////////////////////////DELIVERED//////////////////////////////////////////////
///
///
///
//////////////////////////DELIVERED//////////////////////////////////////////////

//////////////////////////AVAILABLE//////////////////////////////////////////////
///
///
///
//////////////////////////AVAILABLE//////////////////////////////////////////////
function available($user_type, $user_id){
global $date_global_, $db;
if ($user_type==1) {
	$query="SELECT * FROM projects WHERE student_id='$user_id'AND status=0 ";
}elseif ($user_type==2) {
	$query="SELECT * FROM projects WHERE status=0 AND deadline>$date_global_";
}
$results=$db->get_results($query);

return $db->num_rows;
}
///////////////////////////////////////////////////////////////////////////////////
if ($_POST['target']=="available") {

	if (available($_POST['user_type'], $_POST['user_id'])>0) {
echo "<span class='my_pill_'>".available($_POST['user_type'], $_POST['user_id'])."</span>";
	}else{
	echo "<span class='pill_'>".available($_POST['user_type'], $_POST['user_id'])."</span>";
	}
}

//////////////////////////AVAILABLE//////////////////////////////////////////////
///
///
///
//////////////////////////AVAILABLE//////////////////////////////////////////////

//////////////////////////MESSAGES//////////////////////////////////////////////
///
///
///
//////////////////////////MESSAGES//////////////////////////////////////////////
function messages($user_id, $user_type){
	global $db;
if ($user_type==1) {

	$query="SELECT * FROM chats WHERE student_id='$user_id' AND status=0 AND user_type=2";
}elseif ($user_type==2) {
	$query="SELECT * FROM chats WHERE tutor_id='$user_id' AND status=0 AND user_type=1";
}

$results=$db->get_results($query);

return $db->num_rows;
}
///////////////////////////////////////////////////////////////////////////////////
if ($_POST['target']=="messages") {

	if (messages($_POST["user_id"], $_POST["user_type"])>0) {
echo "<span class='my_pill_'>".messages($_POST["user_id"], $_POST["user_type"])."</span>";
	}else{
	echo "<span class='pill_'>".messages($_POST["user_id"], $_POST["user_type"])."</span>";
	}
	}
//////////////////////////MESSAGES//////////////////////////////////////////////
///
///
///
//////////////////////////MESSAGES//////////////////////////////////////////////
function announcements(){

}
?>
