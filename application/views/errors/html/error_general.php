<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$base_url = 'http://localhost/modminers_ci3/';
?><!DOCTYPE html>
<html lang="en">
<head>
	<title>ModMiners</title>

	<!-- Bootstrap core CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

	<!-- CUSTOM CSS [Bootstrap Animated - Meteriel]-->
	<link rel="stylesheet" href=<?= $base_url; ?>"assets/css/mdb.css">

	<!-- JQuery -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>

	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
	
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.15/js/mdb.min.js"></script>

	<!-- FontAwesome CSS -->
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

	<!-- Bootstrap téma -->
	<link rel="stylesheet" href="https://bootswatch.com/4/superhero/bootstrap.min.css">

	<!-- CUSTOM CSS [Saját] -->
	<link rel="stylesheet" href=<?= $base_url; ?>"assets/css/custom.css">

  	<!-- CUSTOM FONT -->
  	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

</head>
<body>
	<div id="container">
		<div class="col-12 col-lg-8 offset-lg-2 mt-3 d-flex justify-content-center">
	<div class="jumbotron">
		<img class="img-fluid w-25 mx-auto d-block" src="../modminers/assets/images/404.png" />
		<h1 class="display-3 text-center">Hoppá!</h1>
		<hr class="my-4">
		<p style="font-size:20px;"><?php echo $heading; ?></p>
		<p class="mt-2"><?php echo $message; ?></p>
		<p class="lead">
		<a class="btn btn-primary btn-lg" href=<?= $base_url; ?> role="button">Kezdőlapra!</a>
		</p>
	</div>
</div>
	</div>
</body>
</html>