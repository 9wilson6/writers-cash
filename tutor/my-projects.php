<?php
require_once "../inc/header_links.php";
$page="projects" ;
require_once "../components/top_nav.php";


require_once("../dbconfig/dbconnect.php");
require_once("../inc/utilities.php");

?>
<div class="page-container">
<?php require_once "../components/tutor_leftnav.php" ?>
<div class="display">
<div class="display__content">
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
<h1 class="headingTertiary">Available Projects</h1>
<div class="card wide-card">
<div class="card-header">Available Orders</div>
<div class="card-body">

<?php 
$date_global_=strtotime($date_global);
$tutor_id=$_SESSION['user_id'];
$count_q="SELECT COUNT(closed.project_id) FROM closed LEFT JOIN projects ON closed.project_id=projects.project_id WHERE closed.tutor_id='$tutor_id'";
$result_q=$db->get_var($count_q);

if ($result_q>20) {

$query="SELECT * FROM closed LEFT JOIN projects ON closed.project_id=projects.project_id WHERE closed.tutor_id='$tutor_id' ORDER BY closed.project_id desc LIMIT 20 ";
}else{?>
<!-- <meta http-equiv="refresh" content="30"> -->

<?php
$query="SELECT * FROM closed LEFT JOIN projects ON closed.project_id=projects.project_id WHERE closed.tutor_id='$tutor_id' ORDER BY closed.project_id desc";

}

$results=$db->get_results($query);
if ($db->num_rows<1): ?>
<div class="headingTertiary">There is Nothing To show Yet</div>
<?php elseif($db->num_rows>0): ?>
<div class="table-responsive" id="display">
<table class="table table-bordered">
<thead>
<tr>
<th>id</th>
<th class="wide">Title</th>
<th data-toggle="tooltip" title="Price $" data-placement="right">Price($)
</th>
<th data-toggle="tooltip" title="pages" data-placement="right">Pg</th>
<th class="smalll">Subject</th>
<th class="medium">Deadline</th>
</tr>
</thead>

<tbody>
<?php foreach ($results as $result): ?>
<tr>
<td class="smalll"><a
href="my-projects-details?pid=<?php echo urlencode(convert_uuencode($result->project_id)); ?>"><?php echo $result->project_id; ?><i
class="fas fa-external-link-alt icon-r ml-4"></i></a></td>
<td class="wide">
<?php echo (strlen($result->title) >35 )? substr($result->title, 0, 35).'...':$result->title; ?>
</td>
<td><?php echo $result->charges; ?></td>
<td><?php echo $result->pages; ?></td>
<td class="smalll"><?php echo $result->subject; ?></td>
<td><?php $time=getDateTimeDiff($date_global, $result->deadline );
$period= explode(" ", $time); ?>
<?php if ($period[1]=="days"): ?>
<span class="text-dark"><?php echo "{$time}"; ?></span>
<?php elseif($period[1]=="day"): ?>
<span class="text-success"><?php echo "{$time}"; ?></span>
<?php elseif($period[1]=="hours" || $period[1]=="hour"): ?>
<span class="text-warning"><?php echo "{$time}"; ?></span>
<?php elseif($period[1]=="mins" || $period[1]=="min"): ?>
<span class="text-danger"><?php echo "{$time}"; ?></span>
<?php elseif($period[1]=="secs" || $period[1]=="sec"): ?>
<span class="text-danger"><?php echo "{$time}"; ?></span>
<?php endif ?>
</td>


</tr>
<?php endforeach ?>

</tbody>

</table>
</div>
<?php endif ?>
</div>
<?php if ($result_q>10): ?>
<div class="card-footer">
<div class="customSelect">
<div class="select">
<select name="select" class="" id="select">
<option value="20">20</option>
<option value="50">50</option>
<option value="100">100</option>
<option value="100">250</option>
<option value="100">500</option>
</select></div>
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
<script>
$(document).ready(function () {
$("#select").change(function () {
let limit = $("#select").val();

$("#display").load("my-projects_.php", {
limit: limit
})
});
});
</script>