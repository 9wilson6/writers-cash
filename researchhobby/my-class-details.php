<?php
$project_id=convert_uudecode($_GET['id']);
require_once("../dbconfig/dbconnect.php");
require_once("../inc/utilities.php");
require_once "../inc/header_links.php";
require_once "./top_nav.php";

if (isset($_POST['submit'])) {
require_once('stud_functions.php');
filesUpload($_SESSION['user_id'], $_POST['project_id']);
}
$query="SELECT * FROM classes where project_id='$project_id'";
$results=$db->get_row($query);
// print_r($results);

?>

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
</head>
<div class="page-container">
<?php $page="classes"; ?>
<?php require_once "./stud_leftnav.php" ?>
<div class="display">
<div class="display__content">

<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
<h1 class="headingTertiary">Class #
<?php echo $project_id ; ?>
</h1>
<div class="card">
<div class="card-header">details</div>
<div class="card-body">
<?php
if ($db->num_rows<1) { ?>

<div class="headingTertiary">Class is no longer available</div>

<?php  } else{ ?>
<div class="table-responsive">
<table class="table  table-striped table-hover table-bordered">
<tbody>
<tr>
<th scope="row">Subject</th>
<td>
<?php echo $results->subject ?>
</td>
<th scope="row">Budget</th>
<td>
<?php echo $results->budget; ?>
</td>
</tr>
<tr>
</tr>
<tr>

</tr>
<tr>
<th>Description</th>
<td colspan="3" class="pl-5">

<?php echo $results->instructions; ?>
</td>
</tr>

</tbody>
</table>
</div>

<div class="card-footer">
<div class="row">
<div class="col-md-6 col-sm-12"><button class="btn btn-submit btn-block danger"
onclick="deleletconfig()">delete
project</button></div>
<div class="col-md-6 col-sm-12"><a
href="class_edit?id=<?php echo urlencode(convert_uuencode($project_id)) ?>"
class="btn btn-submit btn-block">edit
project</a></div>
<script>
function deleletconfig() {
let del = confirm(
"Are you sure you want to delete class # <?php echo $project_id ?> ?");
if (del) {
$.post("delete_class", {
id: "<?php echo $project_id ?>",
user: "<?php echo $_SESSION['user_id'] ?>",
user_type: "<?php echo $_SESSION['user_type']?>"
})
.done(function (data) {
alert(data);
window.location.href = "my-classes";
});
};
}
</script>
</div>
</div>

<div class="card">
<div class="card-header">
Bids
</div>
<div class="card-body">

<div class="table-responsive " id="bids">
<?php
$query="SELECT * FROM bids WHERE project_id=$project_id";
$results=$db->get_results($query);
if ($db->num_rows<1) {?>
<div class="headingTertiary">Nothing To Show Yet</div>
<?php }else{ ?>

<table class="table">
<thead>
<th>Tutor Id</th>
<th>Rated</th>
<th>Orders Complited</th>
<th>Bid Amount($)</th>
<th>Action</th>
</thead>
<tbody>

<?php foreach ($results as $result) {?>
<tr>
<td>
<?php echo $result->tutor_id ?>
</td>
<?php $query="SELECT SUM(rating) as rating, COUNT(comment) as complited FROM closed WHERE tutor_id='$result->tutor_id'";
$results=$db->get_row($query);
if ($results->rating>0) {
$rate=round($results->rating/$results->complited,0);  
}else{
$rate=0;
}

?>
<td>
<?php echo  $rate."/10" ?>
<?php if ($rate==0): ?>
<img class="img-fluid rating" src="../assets/not_rated.PNG"
alt="">
<?php elseif($rate>0 && $rate<=4): ?>
<img class="img-fluid rating" src="../assets/poor.PNG" alt="">
<?php elseif($rate>4 && $rate<=7): ?>
<img class="img-fluid rating" src="../assets/average.PNG"
alt="">
<?php elseif($rate>7 && $rate<=10): ?>
<img class="img-fluid rating" src="../assets/excelent.PNG"
alt="">
<?php endif ?>
</td>
<td>
<?php echo $results->complited ?>
</td>
<td>

<?php echo $result->bid_total_amount?>
</td>
<td>
<form action="assing" method="POST" id="assing">
<input type="hidden" name="project_id"
value="<?php echo $project_id; ?>">
<input type="hidden" name="is_class">
<input type="hidden" name="user_id"
value="<?php echo $_SESSION['user_id']; ?>">
<input type="hidden" name="user_type"
value="<?php echo $_SESSION['user_type']; ?>">
<!-- <?php #echo $_SESSION['user_id']; die; ?> -->
<input type="hidden" name="tutor_id"
value="<?php echo $result->tutor_id; ?>">
<input type="hidden" name="cost"
value="<?php echo $result->bid_total_amount ?>">
<input type="hidden" name="charged"
value="<?php echo $result->bid_amount ?>">
<button type="submit" name="assing"
class="btn btn-submit btn-block move-up mr-0">Award</button>
</form>
</td>
</tr>

<?php } ?>
</tbody>
</table>

<?php }  }

?>

</div>
<p class="text-center"></p>
</div>

</div>
</div>
</div>
</div>
<?php require_once("section_notes.php") ?>


</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<?php

require_once"../inc/footer_links.php";

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
$(function () {
setInterval(function () {

let project_id = "<?php echo $project_id; ?>";
$("#bids").load("bids", {
project_id: project_id
});
}, 30000);
$("#assing").submit(function () {

var c = confirm("Note that in order to assigne tutor ID: <?php if (isset($result->tutor_id)) {echo $result->tutor_id;} ?> \n your homework you will need to load $<?php if (isset( $result->bid_total_amount)) {echo $result->bid_total_amount;} ?> \n to your Lorem account. \nThe funds will be held in your account until you release them.\n We will guide you through the process\n Press okay to proceed");
return c; //you can just return c because it will be true or false
});
});
</script>

<?php require_once("../support.php") ?>