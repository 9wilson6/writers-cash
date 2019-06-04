<?php 
require_once "../inc/header_links.php";
require_once"../inc/utilities.php";
require_once("./inc/topnav.php");
#//////////////////////////////////////////////////////////////////////////////////// -->
require_once("../dbconfig/dbconnect.php");
if (isset($_REQUEST['pid'])) {
$project_id=convert_uudecode($_REQUEST['pid']);
}
$page="dashboard";



if (isset($_POST['submit'])) {
$student_id=$_POST['student_id'];
$project_id=$_POST['project_id'];
$tutor_id=$_POST['tutor_id'];
$bid_amount=$_POST['bid_amount'];
$query="INSERT INTO bids(tutor_id, project_id, bid_amount, bid_fee, bid_total_amount, student_id) VALUES('$tutor_id', '$project_id', '$bid_amount','$bid_amount','$bid_amount', '$student_id')";
$results=$db->query($query);
}
if (isset($_POST['delete'])) {
$project_id=$_POST['project_id'];
$tutor_id=$_POST['tutor_id'];
// $bids=$_POST['bids']-1;
$db->query("DELETE FROM bids WHERE tutor_id='$tutor_id' AND project_id='$project_id'");
// $db->query("UPDATE projects SET bids='$bids' WHERE project_id='$project_id'");

?>
<script>
// window.location.href="d_details?id=<?php #echo $project_id ?>";
</script>
<?php
}




?>
<div class="page-container">
<?php require_once "inc/leftnav.php" ?>
<div class="display">
<div class="display__content">
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
<h1 class="headingTertiary">Class # <?php echo $project_id. " Details"; ?></h1>
<div class="card">
<div class="card-header">Order info</div>
<?php  $query=("SELECT * FROM classes WHERE project_id='$project_id'");
$results=$db->get_row($query);
if ($db->num_rows<1) {?>
<div class="card-body">
<div class="headingTertiary">
This project Is no longer Available
</div>
</div>
</div>
</div>

<?php  }else{ ?>
<table class="table table-sm table-responsive{-sm|-md|-lg|-xl}">
<thead class="table-light">
<tr>
<th class="text-center">Class Id</th>
<th class="text-center">Subject</th>
<th class="text-center">Budget</th>
<th class="text-center">Date created</th>
</tr>
</thead>
<tbody>
<tr>
<th scope="row" class="text-center mt-5">
<?php echo $results->project_id ; ?>
</th>

<td class="text-center mt-5">
<?php echo $results->subject; ?>
</td>
<td class="text-center mt-5">
<?php echo $results->budget; ?>
</td>
<td class="text-center mt-5">
<?php echo $results->date_created; ?>
</td>
</tr>
<tr>
	<th>Description</th>
	<td colspan="3"><?php echo $results->instructions; ?></td>
</tr>
</tbody>
</table>

<!-- //////////////////////////////// -->

<table class="table table-sm table-responsive{-sm|-md|-lg|-xl}">
<thead class="table-light">

</thead>
<tbody>
<tr>

<td class="text-center">
<?php
$tutor_id=$_SESSION['user_id'];
////////////////////////////CHECK IF USER HAS ALREADY APPLIED FOR THIS ORDER////////////////////////////////////////////
$check_q=$db->get_row("SELECT * FROM bids WHERE project_id= $project_id");
////////////////////////////CHECK IF USER HAS ALREADY APPLIED FOR THIS ORDER////////////////////////////////////////////
?>
<?php if ($db->num_rows <1): ?>
<form action="" method="POST">
<div class="row">
<div class="col-8">
<?php $min= ceil(intval(str_replace("$", "", $results->budget)) * 0.7);
?>

<input type="number" name="bid_amount"
class="form-control forms2__input" required
min="<?php echo $min ?>">
<input type="hidden" name="project_id"
value="<?php echo $project_id ?>">
<input type="hidden" name="tutor_id" value="<?php echo $tutor_id ?>">
<input type="hidden" name="bids" value="<?php echo $results->bids ?>">
<input type="hidden" name="student_id" value="<?php echo $results->student_id?>">
</div>
<div class="col-4">
<button class="btn-submit btn-block" name="submit"
type="submit">Apply</button>
</div>

</div>
</form>

<?php else: ?>

<form action="" method="POST">
<div class="row">
<div class="col-8">
<h5 class="bg-info forms2__input py-3 text-light">Your Bid amount is:
$<?php echo $check_q->bid_amount; ?></h5>
<input type="hidden" name="project_id"
value="<?php echo $project_id ?>">
<input type="hidden" name="tutor_id" value="<?php echo $tutor_id ?>">
<input type="hidden" name="bids" value="<?php echo $results->bids ?>">
</div>
<div class="col-4">
<button class="btn-submit btn-block" style="background: #e74c3c;" name="delete"
type="submit">DELETE</button>
</div>

</div>
</form>
<?php endif ?>


</td>
</tr>

</tbody>
</table>
<!-- /////////////////////////////////////////// -->

</div>

</div>
<?php } ?>


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
<?php
require_once"../inc/footer_links.php";
?>
<script>
$(function () {
setInterval(function () {
$("#cbody").load("notifications.php", { limit: 10 });
}, 3000);
});
</script>