<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$homepage = "www.modminers.hu";

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>ModMiners - 404</title>
	<!-- Bootstrap core CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

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

  	<!-- CUSTOM FONT -->
  	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body style="background-color: #e9ecef;">
	<div class="d-flex align-content-center flex-wrap mt-5" style="color:rgba(255,255,255,0.75);">
		<div class="jumbotron col-8 offset-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4" style="background-color: #343a40;">
			<img src="/modminers/assets/images/404.png" style="width:25%;" class="mx-auto d-block" />
			<h1 class="display-4 d-flex justify-content-center flex-wrap">Hoppá!</h1>
			<hr class="my-4">
			<p class="big">Elfelejtettél térképet hozni magaddal? Valószínüleg eltévedtél!</p>
			<p class="medium">A keresett oldal nem található!</p>
			<p class="col-md-6 offset-md-3 col-12" style="background-color: #868e96;">
			<a class="btn btn-lg" href="<?= $homepage ?>" role="button" style="width:100%;">Kezdőlapra!</a>
			</p>
		</div>
	</div>
</body>
</html>