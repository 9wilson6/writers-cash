<?php
require_once "../inc/header_links.php";
$page="messages" ;
require_once "../components/top_nav.php";
require_once("../dbconfig/dbconnect.php");
?>

<div class="page-container">
<?php require_once "../components/tutor_leftnav.php" ?>
<div class="display">
<div class="display__content">
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
<h1 class="headingTertiary">Messages</h1>

<div class="card">
<div class="card-header">Your recent messages</div>

<div class="card-body">
<?php $query="SELECT chats.user_type, chats.message, chats.date_sent, chats.project_id, chats.student_id, chats.tutor_id,projects.status FROM chats LEFT JOIN projects on chats.project_id=projects.project_id where chats.user_type=1 ORDER BY date_sent DESC LIMIT 10";
$results=$db->get_results($query);
?>
<?php if ($db->num_rows >0): ?>
<div class="table-responsive" id="meso">
<table class="table">
<table class="table table-bordered">
<thead>
<tr>
<th class="">Order id</th>
<th class="">From(student id)</th>
<th class="">Message</th>

<th class="">Date</th>
<th class="">Action</th>
</tr>
</thead> <tbody>
<div id="messages">
<?php foreach ($results as $result ): ?>

<tr>
<td><?php echo $result->project_id; ?></td>
<td><?php echo $result->student_id; ?></td>
<td>

<?php $project_id=$result->project_id; ?>
<p style="max-height: 100px; overflow: auto; width:400px;"><?php echo $result->message; ?></p>
</td>
<td><?php echo $result->date_sent; ?></td>
<?php if ($result->status==1): ?>
<td>
<a href="in-progress-details?pid=<?php echo urlencode(convert_uuencode($result->project_id)) ?>#messageBox" class="btn-message btn-block">view</a>
</td>
<?php elseif($result->status==2): ?>

<td>
<a href="delivered-details?pid=<?php echo urlencode(convert_uuencode($result->project_id)) ?>#messageBox" class="btn-message btn-block">view</a>
</td>
<?php elseif($result->status==3): ?>

<td>
<a href="revision-details?pid=<?php echo urlencode(convert_uuencode($result->project_id)) ?>#messageBox" class="btn-message btn-block">view</a>
</td>
<?php elseif($result->status>3): ?>

<td>
<a href="my-projects-details?pid=<?php echo urlencode(convert_uuencode($result->project_id)) ?>#messageBox" class="btn-message btn-block">view</a>
</td>
<?php endif ?>

</tr>

<?php endforeach ?>
<script>let project_id="<?php echo $project_id ; ?>";
let user_type="<?php echo $_SESSION['user_type'] ?>";
</script>
</div>
</tbody>
</table>
</table>
</div>
<?php else: ?>
<div class="headingTertiary">No Messages Yet</div>
<?php endif ?>

</div>
<?php if ($db->num_rows>9): ?>
<div class="card-footer">
<div class="customSelect">
<div class="select">
<select name="select" class="" id="select">
<option value="20">10</option>
<option value="20">20</option>
<option value="50">50</option>
<option value="100">100</option>
<option value="100">250</option>
<option value="100">500</option>
</select>
</div>
</div>
</div>
<?php endif ?>
</div>
</div>
<?php require_once("./section_rate.php"); ?>
</div>
</div>
</div>
</div>

<?php
require_once"../inc/footer_links.php";

?>
<script src="../js/chat.js"></script>
<script src="../js/files.js"></script>
<script>
$( document ).ready(function() {
$.post("../chat", {
project_id: project_id,
user_type: user_type,
event: "keylistener"
});



$("#select").change(function() {
let limit = $("#select").val();
let submit="submit";
$("#meso").load("messages_.php", {
limit: limit,
submit:submit
})
});

// setTimeout('window.location.href=window.location.href;', 120000);
});
</script>
