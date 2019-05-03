<!DOCTYPE html>
<html>
<head>
	<title>ModMiners</title>

	<meta charset="UTF-8">

	<!-- Bootstrap core CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

	<!-- CUSTOM CSS [Bootstrap Animated - Meteriel]-->
	<link rel="stylesheet" href="<?= base_url();?>assets/css/mdb.css">

	<!-- JQuery -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>

	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>

	<!-- BOOTSTRAP SWITCH(DOWNLOADED) -->

  	<script src="<?= base_url();?>assets/js/bootstrap-toggle.min.js"></script>
  	<link href="<?= base_url();?>assets/css/bootstrap-toggle.min.css" rel="stylesheet"></link>
	
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.15/js/mdb.min.js"></script>

	<!-- FontAwesome CSS -->
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

	<!-- Bootstrap téma -->
	<link rel="stylesheet" href="https://bootswatch.com/4/superhero/bootstrap.min.css">

	<!-- CUSTOM CSS [Saját] -->
	<link rel="stylesheet" href="<?= base_url();?>assets/css/custom.css">

  	<!-- CUSTOM JS -->
  	<script src="<?= base_url();?>assets/js/alert_dismiss.js"></script>
  	<script src="<?= base_url();?>assets/js/chat_buttons.js"></script>

  	<!-- CUSTOM FONT -->
  	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

</head>
<body>
    <div class="d-block d-sm-none">XS</div>
    <div class="d-none d-sm-block d-md-none">SM</div>
    <div class="d-none d-md-block d-lg-none">MD</div>
    <div class="d-none d-lg-block d-xl-none">LG</div>
    <div class="color d-none d-xl-block">XL</div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<a class="navbar-brand" href="<?= base_url();?>" style="font-size:35px; padding-right:25px;">ModMiners</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item button btn mobile-color btn-primary color mb-1 mb-lg-0">
					<a class="nav-link" href="<?= base_url();?>"><i class="d-none d-lg-block fas fa-home"></i>Kezdőlap <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item  button btn mobile-color btn-primary mb-1 mb-lg-0">
					<a class="nav-link" href="<?= base_url();?>informations"><i class="d-none d-lg-block fas fa-info"></i>Információk</a>
				</li>
				<?php if($this->session->userdata('logged_in') == true): ?>
				<li class="nav-item  button btn mobile-color btn-primary mb-1 mb-lg-0">
					<a class="nav-link" href="<?= base_url();?>forum"><i class="d-none d-lg-block fas fa-chevron-circle-right"></i>Forum</a>
				</li>
				<li class="nav-item  button btn mobile-color btn-primary mb-1 mb-lg-0">
					<a class="nav-link" href="<?= base_url();?>users/my_profile"><i class="d-none d-lg-block fas fa-user"></i>Profil</a>
				</li>
				<li class="d-none d-lg-block nav-item dropdown button btn mobile-color btn-primary mb-1 mb-lg-0">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="d-none d-lg-block fas fa-users"></i>Felhasználó</a>
					<div class="dropdown-menu mt-4 col-xs-12 bg-dark" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
						<a class="dropdown-item" href="<?= base_url();?>users/show/all">Felhasználók megtekintése</a>
						<a class="dropdown-item" href="<?= base_url();?>users/search">Tagok keresése</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?= base_url();?>users/my_profile">Profilom</a>
					</div>
				</li>
				<!-- MOBILE VIEW OF "FELHASZNÁLÓ" DROPDOWN -->
				<div class="d-block d-lg-none text-white bg-primary shadow-none mobile-color">
					<ul class="navbar-nav">
						<li class="nav-item button btn mobile-color btn-primary color mb-1 mb-lg-0"><a data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample" class="nav-link">Felhasználó <i class="fas fa-caret-down"></i></a></li>
					</ul>

					<div class="card-body collapse" id="collapseExample1">
						<ul class="navbar-nav">
							<li class="nav-item button btn mobile-color btn-primary color mb-1 mb-lg-0"><a href="<?= base_url();?>users/show/all" class="nav-link">Felhasználók megtekintése</a></li>
							<li class="nav-item button btn mobile-color btn-primary color mb-1 mb-lg-0"><a class="nav-link" href="<?= base_url();?>users/search">Tagok keresése</a></li>
							<div class="dropdown-divider"></div>
							<li class="nav-item button btn mobile-color btn-primary color mb-1 mb-lg-0"><a class="nav-link" href="<?= base_url();?>users/my_profile">Profilom</a></li>
						</ul>
					</div>
				</div>
				<!-- END OF MOBILE VIEW OF "FELHASZNÁLÓ" DROPDOWN -->
				<!-- MOBILE VIEW OF "ADMINPANEL" DROPDOWN -->
				<div class="d-block d-lg-none text-white bg-primary shadow-none mobile-color">
					<ul class="navbar-nav">
						<li class="nav-item button btn mobile-color btn-primary color mb-1 mb-lg-0"><a data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample" class="nav-link">Adminpanel <i class="fas fa-caret-down"></i></a></li>
					</ul>

					<div class="card-body collapse" id="collapseExample2">
						<ul class="navbar-nav">
							<li class="nav-item button btn mobile-color btn-primary color mb-1 mb-lg-0"><a href="<?= base_url();?>users/show/all" class="nav-link">Felhasználók megtekintése</a></li>
							<li class="nav-item button btn mobile-color btn-primary color mb-1 mb-lg-0"><a class="nav-link" href="<?= base_url();?>users/search">Tagok keresése</a></li>
							<div class="dropdown-divider"></div>
							<li class="nav-item button btn mobile-color btn-primary color mb-1 mb-lg-0"><a class="nav-link" href="<?= base_url();?>users/my_profile">Profilom</a></li>
						</ul>
					</div>
				</div>
				<!-- END OF MOBILE VIEW OF "FELHASZNÁLÓ" DROPDOWN -->
				<li class="d-none d-lg-block nav-item dropdown button btn mobile-color btn-primary mb-1 mb-lg-0">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="d-none d-lg-block fas fa-users"></i>Adminpanel</a>
					<div class="dropdown-menu mt-4 col-xs-12 bg-dark" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
						<a class="dropdown-item" href="<?= base_url();?>users/show/all">Felhasználók megtekintése</a>
						<a class="dropdown-item" href="<?= base_url();?>users/search">Tagok keresése</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?= base_url();?>users/my_profile">Profilom</a>
					</div>
				</li>
				
				<?php endif; ?>
			</ul>
	      	<ul class="navbar-nav mx-0 p-0 my-0 my-lg-0">
	      		<?php if($this->session->userdata('logged_in') == false): ?>
				<li class="nav-item button btn mobile-color btn-primary mb-1 mb-lg-0">
					<a class="nav-link" href="<?= base_url();?>login"><i class="d-none d-lg-block fas fa-sign-in-alt"></i>Belépés</a>
				</li>
				<li class="nav-item  button btn mobile-color btn-primary mb-1 mb-lg-0">
					<a class="nav-link" href="<?= base_url();?>register"><i class="d-none d-lg-block fas fa-user-plus"></i>Regisztráció</a>
				</li>
				<?php endif; ?>
				<?php if($this->session->userdata('logged_in') == true): ?>
				<!--<?php $image = ($this->session->userdata('image_url') ? $this->session->userdata('image_url') : 'https://ih1.redbubble.net/image.512557046.7821/flat,550x550,075,f.u4.jpg'); ?>
				<li class="nav-item button btn mobile-color btn-primary mb-1 mb-lg-0">
					<div style="width:40px; height:40px;" class="m-0 p-0">
						<img src="<?= $image; ?>" style="max-width: 100%;">
					</div>
				</li>-->
				<li class="nav-item button btn mobile-color btn-primary mb-1 mb-lg-0">
					<a class="nav-link" href="<?= base_url();?>logout"><img src="<?= base_url();?>assets/icons-svg/account-logout" alt="icon name"> Kijelentkezés</a>
				</li>
				<?php endif; ?>
			</ul>
		</div>
	</nav>
	<!-- <?php if($this->uri->segment(2) != ""): ?>
	<ol class="breadcrumb">
  		<li class="breadcrumb-item"><a href="#">Home</a></li>
  		<li class="breadcrumb-item active">Library</li>
	</ol>
	<?php endif; ?>-->

<div class="container-fluid">
<!-- Regisztráció sikeres felugró -->

<?php if($this->session->flashdata('user_registered')): ?>
  <?php echo "<div class='alert-dismissible fade hidden show animated_alert alert alert-success fixed-top col-12 col-lg-8 offset-lg-2' role='alert'>"; ?>
  <?php echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>"; ?>
  <?php echo $this->session->flashdata('user_registered')."</div>"; ?>
<?php endif; ?>

<!-- Belépés sikeres felugró -->

<?php if($this->session->flashdata('user_logged')): ?>
  <?php echo "<div class='alert-dismissible fade hidden show animated_alert alert alert-success fixed-top col-12 col-lg-8 offset-lg-2' role='alert'>"; ?>
  <?php echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>"; ?>
  <?php echo $this->session->flashdata('user_logged')."</div>"; ?>
<?php endif; ?>

<!-- Belépés sikertelen felugró -->

<?php if($this->session->flashdata('login_failed')): ?>
  <?php echo "<div class='alert-dismissible fade hidden show animated_alert alert alert-danger fixed-top col-12 col-lg-8 offset-lg-2' role='alert'>"; ?>
  <?php echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>"; ?>
  <?php echo $this->session->flashdata('login_failed')."</div>"; ?>
<?php endif; ?>

<!-- Kijelentkezés felugró -->

<?php if($this->session->flashdata('user_logout')): ?>
  <?php echo "<div class='alert-dismissible fade hidden show animated_alert alert alert-success fixed-top col-12 col-lg-8 offset-lg-2' role='alert'>"; ?>
  <?php echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>"; ?>
  <?php echo $this->session->flashdata('user_logout')."</div>"; ?>
<?php endif; ?>

<!-- Profil beállítások mentése felugró -->

<?php if($this->session->flashdata('update_profile')): ?>
  <?php echo "<div class='alert-dismissible fade hidden show animated_alert alert alert-success fixed-top col-12 col-lg-8 offset-lg-2' role='alert'>"; ?>
  <?php echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>"; ?>
  <?php echo $this->session->flashdata('update_profile')."</div>"; ?>
<?php endif; ?>

<?php if($this->session->flashdata('form_errors')): ?>
  <?php echo "<div class='alert-dismissible fade hidden show animated_alert alert alert-success fixed-top col-12 col-lg-8 offset-lg-2' role='alert'>"; ?>
  <?php echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>"; ?>
  <?php echo $this->session->flashdata('form_errors')."</div>"; ?>
<?php endif; ?>

<?php if($this->session->flashdata('success')): ?>
  <?php echo "<div class='alert-dismissible fade hidden show animated_alert alert alert-success fixed-top col-12 col-lg-8 offset-lg-2' role='alert'>"; ?>
  <?php echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>"; ?>
  <?php echo $this->session->flashdata('success')."</div>"; ?>
<?php endif; ?>