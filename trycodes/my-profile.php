<?php
require_once("../dbconfig/dbconnect.php");
require_once("../inc/utilities.php");
require_once "../inc/header_links.php";
$page="profile" ;
require_once "./top_nav.php";
if (isset($_REQUEST['key'])) {
$user_id =convert_uudecode($_REQUEST['key']);
$query="SELECT * FROM users WHERE user_id='$user_id'";
$results=$db->get_row($query);

}else{
header("LOCATION:dashboard");
}

?>
<div class="page-container">
<?php require_once "./tutor_leftnav.php" ?>
<div class="display">
<div class="display__content">

<!-- <h1 class="headingTertiary text-left">Available</h1> -->
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
<h1 class="headingTertiary">My Profile</h1>
<div class="card wide-card">
<div class="card-header">Profile</div>
<div class="card-body">

<div class="table-responsive">
<table class="table table-striped table-hover text-center">
<thead>
<tr>
<th>User Id</th>
<th>Username</th>
<th>Email</th>
<th>Date Created</th>

<tr>
</thead>
<tbody>
<tr>
<td><?php echo $results->user_id; ?></td>
<td><?php echo $results->username; ?></td>
<td><?php echo $results->email; ?></td>
<td><?php echo $results->created_on; ?></td>
</tr>
<tr><th colspan="2">About me</th> <td colspan="2"><?php echo $results->about_me; ?></td></tr>
</tbody>
</table>
</div>

</div>
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
