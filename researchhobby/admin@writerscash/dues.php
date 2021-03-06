<?php
require_once("../inc/header_links.php");
require_once("./inc/topnav.php");
require_once("../inc/utilities.php");
$page="dashboard";
require_once("../inc/global_functions.php");
require_once("../dbconfig/dbconnect.php");
$query="SELECT * FROM projects WHERE status=4";
$results=$db->get_results($query);
?>
<div class="page-container">
<?php require_once "inc/leftnav.php" ?>
<div class="display">
<div class="display__content">
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-11">
<h1 class="headingTertiarytext-uppercase">You can release payment for this order anytime
</h1>

<div class="card">
<div class="card-header text-uppercase">Recently complited orders</div>
<div class="card-body">
<?php if ($db->num_rows<1): ?>
<h1 class="classHeadingSecondary">There are no closed assignments</h1>
<?php elseif($db->num_rows>0): ?>
<table class="table table-bordered">
<thead>
<tr>
<th>Order Number</th>
<th class="wide">Title</th>
<th data-toggle="tooltip" title="Price $" data-placement="right">Price</th>
<th data-toggle="tooltip" title="pages" data-placement="right">Pg</th>
<th class="smalll">Subject</th>
<th class="medium">Deadline</th>
</tr>
</thead>

<tbody id="display">
<?php foreach ($results as $result): ?>
<tr>
<td class="smalll"><?php echo $result->project_id; ?></td>
<td class="wide">
<?php echo (strlen($result->title) >35 )? substr($result->title, 0, 55).'...':$result->title; ?>
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
<?php else: ?>
<span class="text-dark"><?php echo "{$time}"; ?></span>
<?php endif ?>

</td>
</tr>
<?php endforeach ?>
</tbody>
</table>
<?php endif ?>
<?php $classes_query="SELECT * FROM classes WHERE status=4";
$classes_query_results=$db->get_results($classes_query);
if ($db->num_rows>0) { ?>
	<h2 class="headingTertiary">Closed Classes</h2>
<table class="table table-bordered">
<thead>
<tr>
<th>Class Id</th>
<th class="wide">Subject</th>
<th data-toggle="tooltip" title="Price $" data-placement="right">Price</th>
<th data-toggle="tooltip" title="pages" data-placement="right">DATE_CREATED</th>
<th class="smalll">Student ID</th>
<!-- <th class="medium">Description</th> -->
</tr>
</thead>

<tbody id="display">
	<?php foreach ($classes_query_results as $classes_query_result): ?>
		<tr>
			<td><?php echo $classes_query_result->project_id; ?></td>
			<td><?php echo $classes_query_result->subject; ?></td>
			<td><?php echo $classes_query_result->cost; ?></td>
			<td><?php echo $classes_query_result->date_created; ?></td>
			<td><?php echo $classes_query_result->student_id; ?></td>

		</tr>
	<?php endforeach ?>
</tbody>
</table>
<?php }
 ?>

</div>
<div class="card-footer"></div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php require_once("../inc/footer_links.php") ?>