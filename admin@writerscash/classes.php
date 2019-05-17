<?php
require_once("../inc/header_links.php");
require_once("./inc/topnav.php");
require_once("../inc/utilities.php");
$page="dashboard";
require_once("../inc/global_functions.php");
require_once("../dbconfig/dbconnect.php");
if (isset($_POST['delete'])) { ?>
	
<script>alert("delete")</script>

<?php }elseif(isset($_POST['close'])){ 

$class_id=$_POST['project_id'];
	?>

<script>
let c= confirm("Are you sure you want to close class id "+ <?php echo $class_id; ?>);
if (c==false) {
window.location.assign("classes");
}

</script>

<?php
$query("SELECT ");

 } 
$query="SELECT * FROM classes where date_closed=0 order by project_id desc";
$results=$db->get_results($query);

?>
<div class="page-container">
<?php require_once "inc/leftnav.php" ?>
<div class="display">
<div class="display__content">

<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
<h1 class="headingTertiary text-uppercase">Available Classes </h1>

<div class="card">
<div class="card-header text-uppercase">Available Classes</div>
<div class="card-body">
<?php if ($db->num_rows<1): ?>
<h1 class="classHeadingSecondary">There is Nothing To show Yet</h1>
<?php elseif($db->num_rows>0): ?>
<table class="table table-bordered">
<thead>
<tr>
<th class="small">Class Id</th>
<th data-toggle="tooltip" title="Price $" data-placement="right">Budget</th>
<th data-toggle="tooltip" title="subject" data-placement="right">Subject</th>
</tr>
</thead>

<tbody id="display">
<?php foreach ($results as $result): ?>
<tr>
<td class="smalll"><a
href="class-details?pid=<?php echo urlencode(convert_uuencode($result->project_id)); ?>"><?php echo $result->project_id; ?><i
class="fas fa-external-link-alt icon-r ml-4"></i></a></td>
<td><?php echo $result->budget; ?></td>
<td><?php echo $result->subject; ?></td>
<?php endforeach ?>

</tbody>

</table>
<?php endif ?>
</div>
<div class="card-footer"></div>
</div>
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