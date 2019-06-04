<?php
require_once("../inc/header_links.php");
require_once("./inc/topnav.php");
require_once("../inc/utilities.php");
$page="dashboard";
require_once("../inc/global_functions.php");
require_once("../dbconfig/dbconnect.php");
if(isset($_POST['close'])){ 

$class_id=$_POST['project_id'];
$tutor_id=$_POST['tutor_id'];
$charges=$_POST['cost'];
$date=$date_global;
$student_id=$_POST['student_id'];
	?>

<script>
let c= confirm("Are you sure you want to close class id "+ <?php echo $class_id; ?>);
if (c==false) {
window.location.assign("active_classes");
}

</script>

<?php
//////////////////////////////////////////////////////////////////////////
$query="SELECT dues FROM users WHERE user_id='$tutor_id'";
$result=$db->get_var($query);
$dues=($result+$charges);
$query="UPDATE users SET dues='$dues' WHERE user_id='$tutor_id'";
$db->query($query);

$query="INSERT INTO closed(comment,rating,date_closed,project_id,student_id,tutor_id, type)VALUES('excellent',10,'$date','$class_id','$student_id','$tutor_id',1)";

if ($db->query($query)) {
$db->query("DELETE FROM on_progress WHERE project_id='$class_id'");
	$query="UPDATE classes SET status=4, cost='$charges' WHERE project_id='$class_id'";
	if ($db->query($query)) {
		/////////////////////////////////notification/////////////////////////////////////////////
$note="Class id: ".$class_id." was closed on ". $date_global;
$note2="You closed class id: ".$class_id." on ". $date_global;
$querys="INSERT INTO notifications(user_type, note) VALUES(1,'$note')";
$db->query($querys);
$querys="INSERT INTO notifications(user_type, note, user_id) VALUES(3,'$note2','$student_id')";

/////////////////////////////////notification/////////////////////////////////////////////
		if ($db->query($query)) {?>
			<script>
		alert("Class has been closed sucessfully (. ❛ ᴗ ❛.)");
		 window.location.assign("active_classes");
		</script>

		<?php }
	}
 }
 /////////////////////////////////////////////////////

 } 
$user_id= $_SESSION['user_id'];

    $query="SELECT * FROM on_progress LEFT JOIN classes ON on_progress.project_id=classes.project_id WHERE on_progress.tutor_id='$user_id'";
$results=$db->get_results($query);

?>
<div class="page-container">
<?php require_once "inc/leftnav.php" ?>
<div class="display">
<div class="display__content">

<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
<h1 class="headingTertiary text-uppercase">Classes In progress </h1>

<div class="card">
    <div class="card-header">Class Info</div>
    <?php if ($db->num_rows<1) { ?>
    <div class="headingTertiary">There is nothing to show Yet</div>
    <?php }else{?>


    <div class="card-body">
    <table class="table table-bordered">
    <thead>
    <tr>
    <th>Class id</th>
    <th class="wide">Subject</th>
    <th class="smalll">Tutor Id</th>
    <th class="medium">Cost</th>
    <th  width="50%" >description</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <?php foreach ($results  as $result): ?>


    <td class="smalll"><?php echo $result->project_id; ?>
    </td>
    <td><?php echo $result->subject; ?></td>
    <td><?php echo $result->tutor_id; ?></td>
    <td><?php echo "$". $result->cost; ?></td>
    <td><?php echo $result->instructions; ?></td>
    <td>
    	<form action="" method="POST">
    		<input type="hidden" name="project_id" value="<?php echo $result->project_id ?>">
    		<input type="hidden" name="tutor_id" value="<?php echo $result->tutor_id ?>">
    		<input type="hidden" name="cost" value="<?php echo $result->cost ?>">
    		<input type="hidden" name="student_id" value="<?php echo $result->student_id ?>">
    		<input type="submit" name="close" style="background: #27ae60; width: 100%; border-radius: 10px; color: #fff;" value="Close">
    	</form>
    	
    </td>
    </tr>
    <?php endforeach ?>

    <?php $completed_query="SELECT * FROM closed LEFT JOIN classes ON closed.project_id=classes.project_id WHERE closed.tutor_id='$user_id'";
    $completed_query_results=$db->get_results($completed_query);

     ?>

    </tbody>
    </table>
    </div>
            <?php }  ?>
    </div>
    <div class="card-footer"><a href="closed_classes" class="submit" name="submit_class" style="color: #fff; text-align: center; font-weight: bolder; padding-top: 5px; font-size: 16px" />Closed Classes</a></div>
</div>

<!-- /////////////////////////////////////// -->

<div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
	<h1 class="headingTertiary text-uppercase">Activities</h1>
<div class="card">
<div class="card-header text-uppercase">Notifications</div>
<!--card header-->
<div class="card-body" id="cbody">
	<center><img src="../assets/Ripple-1s-200px.gif" alt="loading....."></center>
</div>
<!--card body-->

</div>
<!--card-->
</div>
<!--col2-->
<!-- //////////////////////////////////////////// -->
</div>
</div>
</div>
</div>
<?php require_once("../inc/footer_links.php") ?>
<script>
$(function () {
setInterval(function () {
$("#cbody").load("notifications.php", { limit: 10 });
}, 3000);
});
</script>