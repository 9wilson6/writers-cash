<?php 
	require_once("dbconfig/dbconnect.php");
if (isset($_POST['submit'])) {
	$chat="hh";
	require_once("./inc/utilities.php");

	$message=$_POST['message'];
	$user_id=$_POST['user_id'];
	$user_type=$_POST['user_type'];
	$query="INSERT INTO support(sender,user_id, message, datetym) VALUES('$user_type','$user_id','$message','$date_global')";
$db->query($query);
}
if (isset($_POST['getdata'])) {

	$user_id=$_POST['user_id'];
	$user_type=$_POST['user_type'];
	$query="SELECT * FROM support where user_id='$user_id'";
	$results=$db->get_results($query);
if ($db->num_rows==0) {
	echo "<center>No messages</center>";
}else{

	foreach ($results as $result) {
		if ($result->sender==$user_type) { ?>
			<div class="sent"><p class="lead"><?php echo $result->message; ?></p><span class="datetym"><?php echo $result->datetym; ?></span></div>
	<?php	}else{ ?>
		<div class="received"><p class="lead"><?php echo $result->message; ?></p><span class="datetym"><?php echo $result->datetym; ?></span></div>

		<?php }
	}
}
}
if (isset($_POST['count'])) {
	
$user_id=$_POST['user_id'];
	$user_type=$_POST['user_type'];
$query="SELECT count(message) FROM support where user_id='$user_id' AND sender!='$user_type' AND status=0";
$result=$db->get_var($query);
if ($result>0) {
	echo $result;
}else{
	echo "0";
}

	}

	if (isset($_POST['update'])) {
	
$user_id=$_POST['user_id'];
	$user_type=$_POST['user_type'];
$query="UPDATE support SET status=1 where user_id='$user_id' AND sender!='$user_type'";
$db->query($query);
	}
 ?>
