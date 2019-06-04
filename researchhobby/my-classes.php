<?php 
require_once("../dbconfig/dbconnect.php");

require_once("../inc/utilities.php");

require_once "../inc/header_links.php";
$student_id=$_SESSION['user_id'];

$query="SELECT * FROM classes WHERE student_id='$student_id' and status=0 order by project_id desc";
$results=$db->get_results($query);
$page="classes";
require_once "./top_nav.php";
?>
<div class="page-container">
<?php require_once "./stud_leftnav.php" ?>
<div class="display">
<div class="display__content">

<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
<h1 class="headingTertiary">My Classes</h1>
<div class="card">
<div class="card-header">
<?php if ($db->num_rows>0): ?>
list of classes you have posted
<?php elseif($db->num_rows<=0): ?>
You have 0 posted assignments
<?php endif ?>
</div>
<div class="card-body">
<?php if ($db->num_rows<=0): ?>
<div class="headingTertiary">Nothing to Show Yet</div>
</div>
<?php elseif($db->num_rows>0): ?>
<table class="table table-bordered table-sm">
<thead>
<tr>
<th>Class_id</th>
<th>Budget</th>
<th>Subject</th>
<th>Date created</th>
</tr>
</thead>
<tbody>
<?php foreach ($results as $result) { ?>


<tr>


<td class="smalll"><a
href="my-class-details?id=<?php echo urlencode(convert_uuencode($result->project_id)); ?>">
<?php echo $result->project_id. "<i class='fas fa-external-link-alt icon-r ml-4'></i>"; ?></a>
</td>

<!-- <td><?php #echo $result->title; ?></td> -->

<td>
<?php echo $result->budget; ?>
</td>
<td>
<?php echo $result->subject; ?>
</td>
<td>
<?php echo $result->date_created; ?>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<div class="card-footer">
	<a href="active_classes" class="submit" name="submit_class" style="color: #fff; text-align: center; font-weight: bolder; padding-top: 5px; font-size: 16px" />Active/Closed Classes</a></div>
<?php endif ?>
</div>
</div>


<?php require_once("section_notes.php") ?>


</div>
</div>
</div>
<?php
require_once"../inc/footer_links.php";
?>
<?php require_once("../support.php") ?>