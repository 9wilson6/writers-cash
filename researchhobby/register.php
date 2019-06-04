<?php
ob_start();
 ?>
<?php require_once"../inc/header_links.php";?>
<?php require_once("../inc/global_functions.php"); ?>

<?php
$error="";
$success="";

Register();

?>
<?php require_once"./components/register.php" ?>
<?php require_once"../inc/footer_links.php"; ?>
<?php ob_flush(); ?>
<!-- <script type="text/javascript" src="js/twakto.js"></script> -->