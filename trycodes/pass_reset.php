<?php
ob_start(); ?>
<?php require_once"../inc/header_links.php";?>
<?php require_once("../inc/global_functions.php");
$error="";
$success="";

reset_pass();
?>
<?php require_once"./components/reset_pass.php" ?>
<?php require_once"../inc/footer_links.php"; 
ob_flush();?>
