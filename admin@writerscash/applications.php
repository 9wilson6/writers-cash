<?php
require_once("../inc/header_links.php");
require_once("./inc/topnav.php");
require_once("../inc/utilities.php");
$page="dashboard";
require_once("../inc/global_functions.php");
require_once("../dbconfig/dbconnect.php");
$query="SELECT * FROM users WHERE type=2 and verified=0";
$results=$db->get_results($query);

if (isset($_POST['verify'])) {
$user_id=$_POST['user_id'];
$query="UPDATE users SET verified=1 WHERE type =2 AND user_id=$user_id";
if ($db->query($query)) { ?>
<script>
alert("Tutor ID: <?php echo $user_id  ?> account has been marked as verified");
window.location.assign("applications");
</script>

<?php } 
}
if (isset($_POST['decline'])) {
$user_id=$_POST['user_id'];
$query="UPDATE users SET files=3, verified=3 WHERE type =2 AND user_id=$user_id";
if ($db->query($query)) { ?>
<script>
alert("Tutor ID: <?php echo $user_id  ?> application has been declined");
window.location.assign("applications");
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
<h1 class="headingTertiary text-uppercase">Unverified Tutor Accounts</h1>

<div class="card">
<div class="card-header text-uppercase">Mark accounts as verified</div>
<div class="card-body">
<?php if ($db->num_rows<1): ?>
<h1 class="classHeadingSecondary">There is Nothing To show Yet</h1>
<?php elseif($db->num_rows>0): ?>
<table class="table table-bordered text-center">
<thead>
<tr>
<th>Tutor Id</th>
<th>Username</th>
<th>Email</th>
<th class="wide">Date Registered</th>
<th class="wide">Files</th>
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
<td><?php docs_download($result->user_id) ?></td>
<td class="wide">
<form action="" method="POST">
<input type="hidden" name="user_id"
value="<?php echo $result->user_id?>">
<input type="submit" style="color:aliceblue ; background: #006266; margin-bottom: 3px; border-radius: 10px" name="verify"
class="btn-submit btn-block" value="ACTIVATE">
</form>
<form action="" method="POST">
<input type="hidden" name="user_id"
value="<?php echo $result->user_id?>">
<input type="submit" style="color:aliceblue; background: #b71540; border-radius: 10px;" name="decline"
class="btn-submit btn-block" value="DECLINE">
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