<?php
require_once("../inc/header_links.php");
require_once("./inc/topnav.php");
require_once("../inc/utilities.php");
$mainpage="student";
$sub_page="student_suspend";
require_once("../inc/global_functions.php");
require_once("../dbconfig/dbconnect.php");
$query="SELECT * FROM users WHERE type =1 and status=1";
$results=$db->get_results($query);
if (isset($_POST['submit'])) {
$user_id=$_POST['user_id'];
$query="UPDATE users SET status=0 WHERE type =1 AND user_id=$user_id";
if ($db->query($query)) { ?>
<script>
alert("Student ID: <?php echo $user_id  ?> has been suspended");
window.location.assign("student_suspend");
</script>

<?php } 
}
?>
<div class="page-container">
<?php require_once "inc/leftnav.php" ?>
<div class="display">
<div class="display__content">

<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-11">
<h1 class="headingTertiary text-uppercase">Student suspension panel</h1>

<div class="card">
<div class="card-header text-uppercase">Active Student Accounts</div>
<div class="card-body">
<?php if ($db->num_rows<1): ?>
<h1 class="classHeadingSecondary">There is Nothing To show Yet</h1>
<?php elseif($db->num_rows>0): ?>
<table class="table table-bordered text-center">
<thead>
<tr>
<th>Student Id</th>
<th>Username</th>
<th>Email</th>
<th class="wide">Date Registered</th>
<th class="wide">Action</th>
</tr>
</thead>
<tbody id="display">
<?php foreach ($results as $result): ?>
<tr>
<td class="smalll"><?php echo $result->user_id; ?></td>
<td>
<?php echo $result->username?>
</td>
<td><?php echo $result->email; ?></td>
<td><?php echo $result->created_on; ?></td>
<td class="wide">
<form action="" method="POST">
<input type="hidden" name="user_id"
value="<?php echo $result->user_id?>">
<input type="submit" style="color:aliceblue; background: #c0392b"
name="submit" class="btn-submit btn-block" value="SUSPEND!!">
</form>
</td>
</tr>
<?php endforeach ?>
</tbody>
</table>
<?php endif ?>
</div>
<div class="card-footer"></div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php require_once("../inc/footer_links.php") ?>