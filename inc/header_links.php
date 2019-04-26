<?php 
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- Bootstrap 4 link -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<!-- Fontawesome 5.5.0 link -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<!-- animate css CDN link-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" />
	<!-- Animate On scroll cdn -->
	<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
	<!-- Custom Css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">

	<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
	<?php if(isset($link)) {?>
		<link rel="stylesheet" href="css/settings.css">
		<link rel="stylesheet" href="./plugins/jquery.nice-number.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
	<?php }else{?>
		<link rel="stylesheet" href="../plugins/jquery.nice-number.min.css">
		<link rel="stylesheet" href="../css/settings.css">
		<!-- <link rel="stylesheet" href="../secondary_settings.css"> -->
	<?php }?>
	<!-- Custom Css -->

	<title>Online Professional Tutoring | Lorem ipsum.</title>
</head>
<body>
