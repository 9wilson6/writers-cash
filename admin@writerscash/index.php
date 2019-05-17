<?php
require_once("./payment.php");
require_once("../inc/header_links.php");
require_once("./inc/topnav.php");
$mainpage="dashboard";
$page="dashboard";
require_once("./inc/leftnav.php");
require_once("../dbconfig/dbconnect.php");
$result=$db->get_var("SELECT payment_date FROM others");
?>
<div class="page-container">
<?php require_once "inc/leftnav.php" ?>
<div class="display">
<div class="display__content">

<h1 class="headingTertiary text-center text-uppercase">Dashboard </h1>
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">

<div class="card">
<div class="card-header text-uppercase">account activities summary</div>
<!--card header-->
<div class="card-body">
<!-- <marquee class="bg-dark text-light">Next funds disbursement date:
<?php #echo date('Y-m-d H:i:s', $result); ?> (. ❛ ᴗ ❛.)</marquee> -->
<div class="dashboard__content mb-5">
<div class="row">

<div class="col-sm-4">
<div class="card-header">Order Summary</div>
<ul class="list-group">
<a href="available" class="dashboard__content--items">
<li class="list-group-item"> Available <span id="available"><center><img style="display: inline; position: relative; top: -30px;" height="40px" src="../assets/Flickr-1s-200px.gif" alt="loading....."></center></span> </li>
</a>
<a href="progress" class="dashboard__content--items">
<li class="list-group-item">Progress<span id="progress"><center><img style="display: inline; position: relative; top: -30px;" height="40px" src="../assets/Flickr-1s-200px.gif" alt="loading....."></center></span></li>
</a>
<a href="delivered" class="dashboard__content--items">
<li class="list-group-item">Delivered <span id="delivered"><center><img style="display: inline; position: relative; top: -30px;" height="40px" src="../assets/Flickr-1s-200px.gif" alt="loading....."></center></span></li>
</a>
<a href="revision" class="dashboard__content--items">
<li class="list-group-item">Revisions <span id="revision"><center><img style="display: inline; position: relative; top: -30px;" height="40px" src="../assets/Flickr-1s-200px.gif" alt="loading....."></center></span></li>
</a>
<a href="classes" class="dashboard__content--items">
<li class="list-group-item">Class <span id="classes"><center><img style="display: inline; position: relative; top: -30px;" height="40px" src="../assets/Flickr-1s-200px.gif" alt="loading....."></center></span></li>
</a>

<a href="closed" class="dashboard__content--items">
<li class="list-group-item">Closed <span id="closed"><center><img style="display: inline; position: relative; top: -30px;" height="40px" src="../assets/Flickr-1s-200px.gif" alt="loading....."></center></span></li>
</a>
</ul>
</div>
<!--col-1-->
<div class="col-sm-4">
<div class="card-header">Accounts Summary</div>
<ul class="list-group">
<a href="tutors" class="dashboard__content--items">
<li class="list-group-item">Tutors <span id="tutors"><center><img style="display: inline; position: relative; top: -30px;" height="40px" src="../assets/Facebook-1s-200px.gif" alt="loading....."></center></span></li>
</a>
<a href="students" class="dashboard__content--items">
<li class="list-group-item">Students <span id="students"><center><img style="display: inline; position: relative; top: -30px;" height="40px" src="../assets/Facebook-1s-200px.gif" alt="loading....."></center></span></li>
</a>

<a href="applications" class="dashboard__content--items">
<li class="list-group-item">Applications <span id="applications"><center><img style="display: inline; position: relative; top: -30px;" height="40px" src="../assets/Facebook-1s-200px.gif" alt="loading....."></center></span></li>
</a>
<a href="suspended" class="dashboard__content--items">
<li class="list-group-item">Suspended <span id="suspended"><center><img style="display: inline; position: relative; top: -30px;" height="40px" src="../assets/Facebook-1s-200px.gif" alt="loading....."></center></span></li>
</a>
<a href="messages" class="dashboard__content--items">
<li class="list-group-item">Messages <span id="messages"><center><img style="display: inline; position: relative; top: -30px;" height="40px" src="../assets/Facebook-1s-200px.gif" alt="loading....."></center></span></li>
</a>
<!-- <a href="closed"  class="dashboard__content--items"> <li class="list-group-item">Closed <span id="closed"></span></li> </a>
-->
</ul>
</div>
<!--col-2-->
<div class="col-sm-4">
<div class="card-header">Account status</div>
<ul class="list-group">

<a href="dues" class="dashboard__content--items">
<li class="list-group-item">Dues<span id="dues"><center><img style="display: inline; position: relative; top: -30px;" height="40px" src="../assets/Flickr-1s-200px.gif" alt="loading....."></center></span></li>
</a>
<a href="acc_balance" class="dashboard__content--items">
<li class="list-group-item"> Balance <span id="balance"><center><img style="display: inline; position: relative; top: -30px;" height="40px" src="../assets/Flickr-1s-200px.gif" alt="loading....."></center></span> </li>
</a>
</ul>
</div>
<!--col-3-->
</div>
<!-- row end -->
</div>
</div>
<!--card body-->
</div>
<!--card-->
</div>
<!--col 1-->

<div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
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


</div>
</div>
</div>
</div>
<?php require_once("../inc/footer_links.php");
?>
<script>
$(function () {
setInterval(function () {
$("#available").load('dashboard_counters', {
type: 'available',
submit: 'submit'
});

$("#delivered").load('dashboard_counters', {
type: 'delivered',
submit: 'submit'
});
$("#suspended").load('dashboard_counters', {
type: 'suspended',
submit: 'submit'
});
$("#applications").load('dashboard_counters', {
type: 'applications',
submit: 'submit'
});
$("#classes").load('dashboard_counters', {
type: 'classes',
submit: 'submit'
});
$("#balance").load('dashboard_counters', {
type: 'balance',
submit: 'submit'
});
}, 5000);

setInterval(function () {
$("#students").load('dashboard_counters', {
type: 'students',
submit: 'submit'
});
$("#tutors").load('dashboard_counters', {
type: 'tutors',
submit: 'submit'
});

$("#messages").load('dashboard_counters', {
type: 'messages',
submit: 'submit'
});
$("#revision").load('dashboard_counters', {
type: 'revision',
submit: 'submit'
});
$("#closed").load('dashboard_counters', {
type: 'closed',
submit: 'submit'
});
}, 3000);

setInterval(function () {
$("#progress").load('dashboard_counters', {
type: 'progress',
submit: 'submit'
});
$("#dues").load('dashboard_counters', {
type: 'dues',
submit: 'submit'
});



$("#cbody").load("notifications.php", { limit: 10 });
}, 7000);
});
</script>