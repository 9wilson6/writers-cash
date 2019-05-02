
	<?php

	if (isset($_POST['user_id']) || isset($_GET['user_id']) ) {
	require_once("../dbconfig/dbconnect.php");
	$user_id=$_REQUEST['user_id'];
	$query="SELECT * FROM support WHERE user_id='$user_id'";
	$results=$db->get_results($query);
	if ($db->num_rows>0) {
	foreach ($results as $result) {
	if ($result->sender==3) { ?>
	<div class="sent"><p class="lead"><?php echo $result->message; ?></p><span class="datetym"><?php echo $result->datetym; ?></span></div>
	<?php	}else{ ?>
	<div class="received"><p class="lead"><?php echo $result->message; ?></p><span class="datetym"><?php echo $result->datetym; ?></span></div>

	<?php }
	}


	}else{
	echo "there are no messsages";
	// require_once("../assets/noise.png")
	}
	$query="UPDATE support set status=1 WHERE sender!=3 AND user_id='$user_id'";
	$db->query($query);
	}
	?>
