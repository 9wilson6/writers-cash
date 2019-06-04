<?php
require_once("../inc/header_links.php");
require_once("./inc/topnav.php");
require_once("../inc/utilities.php");
$page="dashboard";
require_once("../inc/global_functions.php");
require_once("../dbconfig/dbconnect.php");

$user_id= $_SESSION['user_id'];

    $query="SELECT * FROM closed LEFT JOIN classes ON closed.project_id=classes.project_id WHERE closed.tutor_id='$user_id'";
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
    <th>Date Closed</th>
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
	<?php echo $result->date_closed; ?>	
    </td>
    </tr>
    <?php endforeach ?>

    <?php $completed_query="SELECT * FROM closed LEFT JOIN classes ON closed.project_id=classes.project_id WHERE closed.tutor_id='$user_id' ORDER BY closed.project_id desc";
    $completed_query_results=$db->get_results($completed_query);

     ?>

    </tbody>
    </table>
    </div>
            <?php }  ?>
    </div>
    <div class="card-footer"><a href="active_classes" class="submit" name="submit_class" style="color: #fff; text-align: center; font-weight: bolder; padding-top: 5px; font-size: 16px" />Active Classes</a></div>
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