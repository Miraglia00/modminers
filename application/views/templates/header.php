<script>
    var start = setInterval(getResponse, 1000);

    function getResponse() {
        clearInterval(start);
        var req = new XMLHttpRequest();
        req.open('GET', '<?= $this->auth->siteURL(); ?>api/get/notification_count');
		req.setRequestHeader( "Content-Type", "application/json" );
        req.send();

        req.onload = function(){
            var data = JSON.parse(req.responseText);
            if(data.response_code != 200) {
                console.log(data.message);
                clearInterval(interval);
            }else{
                var number = data.number;
                if(number != 0) {
                    $('.count_not').html("&nbsp;<span class='badge badge-pill badge-danger'>" +  number + "</span>");
                }
            }
        };
        var interval = setTimeout(getResponse, 30000);
    }


</script>

<!doctype html>
<html lang="hu">
<head>
<meta http-equiv="content-type" content="text/html"; charset="UTF-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=yes">
	<title>ModMiners</title>

	<!-- template css -->
	<link href="<?= base_url(); ?>/assets/css/modminers.css" rel="stylesheet">

	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

	<!-- required js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>

	<!-- template js -->
	<script src="<?= base_url(); ?>/assets/js/modminers.min.js"></script>

	<!-- bootstrap toggle button js and css -->
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <!-- CUSTOM LAODING -->
    <script src="<?= base_url(); ?>/assets/js/loading.js"></script>

	<!-- custom css -->
	<link href="<?= base_url(); ?>/assets/css/custom.css" rel="stylesheet">
	<!-- FONTAWESOME -->
	<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>

    <!-- Text Editor -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

	<?php if($_SERVER['CI_ENV'] === "production"): ?>
		<script src="<?= base_url(); ?>/assets/js/not_allow.js"></script>
	<?php endif; ?>
	<script src="<?= base_url(); ?>/assets/js/load_time.js"></script>

</head>
<body>
	<?php if($_SERVER['CI_ENV'] === "development"): ?>
		<div class='text-center alert-dismissible fade show animated_alert alert alert-warning fixed-bottom col-12 col-lg-2 offset-lg-10 log_alert' role='alert' onclick="$('.log_alert').hide('fade');">
	  		<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	    		<span aria-hidden='true'>&times;</span>
	  		</button>
	  		Az oldal jelenleg "development" üzemmódban van, azaz fejlesztés alatt! Hibák kiírása, F12 engedélyezése is ehhez az állapothoz tartozik.
	  	</div>
	<?php endif; ?>
	<div class="app">

        <!-- LOADING ICON -->
        <div class="fixed-top d-flex justify-content-end m-1">
            <i style="font-size:50px;" class="fas fa-circle-notch fa-spin hidden loading"></i>
        </div>

		<div class="app-body">
			<div class="app-sidebar bg-primary">
				<div class="text-right">
					<button type="button" class="btn btn-sidebar" data-dismiss="sidebar">
						<span class="x"></span>
					</button>
				</div>
				<?php if($this->session->userdata('logged_in') === true): ?>
				<div class="sidebar-header">

					<?php if($this->session->userdata('image_url') === 'default'): ?>
						<img src="<?= base_url();?>assets/images/default_img.png" class="user-photo">
					<?php else: ?>
						<img src="<?= $this->session->userdata('image_url'); ?>" class="user-photo">
					<?php endif; ?>
					<p class="username"><?= $this->session->userdata('username'); ?><br><small><?= $permissions['web_permission']; ?> és <br/> <?= $permissions['server_permission']; ?></small></p>
				</div>
				<?php endif; ?>
				<ul id="sidebar-nav" class="sidebar-nav">
					<?php if($this->session->userdata('logged_in') === true): ?>
					<li class="sidebar-nav-btn"><a href="<?= base_url(); ?>users/my_profile" class="btn btn-block btn-outline-light">Profilom</a></li>
					<?php endif; ?>

					<li><a href="<?= base_url(); ?>home" class="sidebar-nav-link"><i class="icon-home"></i> Kezdőlap</a></li>

					<li class="sidebar-nav-group"><a href="" class="sidebar-nav-link" data-toggle="collapse"><i class="icon-info"></i> Információk</a>
						<!--<ul id="device-controls" class="collapse" data-parent="#sidebar-nav">
							<li><a href="../../pages/device-controls/camera.html" class="sidebar-nav-link">Camera</a></li>
							<li><a href="../../pages/device-controls/file-manager.html" class="sidebar-nav-link">File manager</a></li>
						</ul>-->
					</li>
					<?php if($this->session->userdata('logged_in') === true) : ?>
					<li><a href="forum" class="sidebar-nav-link"><i class="icon-arrow-right-circle"></i> Fórum</a></li>

					<li class="sidebar-nav-group"><a href="#users" class="sidebar-nav-link" data-toggle="collapse"><i class="icon-people"></i> Felhasználó</a>
						<ul id="users" class="collapse" data-parent="#sidebar-nav">
							<li><a href="<?= base_url(); ?>users/show/all" class="sidebar-nav-link">Felhasználók megtekintése</a></li>
							<li><a href="<?= base_url(); ?>users/search" class="sidebar-nav-link">Tagok keresése</a></li>
						</ul>
					</li>
					<?php if($this->session->userdata('p_web') >= 1): ?>
					<li class="sidebar-nav-group"><a href="#apanel" class="sidebar-nav-link" data-toggle="collapse"><i class="icon-shield"></i> Adminpanel</a>
						<ul id="apanel" class="collapse" data-parent="#sidebar-nav">
							<li><a href="<?= base_url(); ?>adminpanel/show/all" class="sidebar-nav-link">Játékosok listája</a></li>
							<li><a href="<?= base_url(); ?>adminpanel/registrations" class="sidebar-nav-link">Játékos regisztrációk</a></li>
							<li><a href="<?= base_url(); ?>adminpanel/beta_accounts/all" class="sidebar-nav-link">Beta felhasználók</a></li>
							<li><a href="<?= base_url(); ?>adminpanel/add_changelog" class="sidebar-nav-link">Changelog hozzáadása</a></li>
							<li><a href="../../pages/input-controls/input-suggestion.html" class="sidebar-nav-link">Input suggestion</a></li>
							<li><a href="../../pages/input-controls/label.html" class="sidebar-nav-link">Label</a></li>
							<li><a href="../../pages/input-controls/radio-button.html" class="sidebar-nav-link">Radio button</a></li>
							<li><a href="<?= base_url(); ?>adminpanel/app_settings" class="sidebar-nav-link">Weboldal beállítások</a></li>
						</ul>
					</li>
					<?php endif; ?>
                    <li><a href="<?= base_url(); ?>changelog" class="sidebar-nav-link"><i class="icon-wrench"></i> Changelog</a></li>
					<li><a href="<?= base_url(); ?>roadmap" class="sidebar-nav-link"><i class="icon-map"></i> Roadmap</a></li>
					<li><a href="<?= base_url(); ?>notifications" class="sidebar-nav-link"><i class="icon-bell"></i> Értesítések
						<?php /*if($this->session->userdata('count_notifications') != 0): */?>
							<span class="count_not"></span>
						<?php /*endif; */?>
					</a></li>
					
					<?php endif; ?>
					<li><a href="<?= base_url(); ?>about" class="sidebar-nav-link"><i class="icon-info"></i> Rólunk</a></li>

				</ul>
				<?php if($this->session->userdata('logged_in') == true): ?>
				<div class="sidebar-footer">
					<a href="../../pages/content/chat.html" data-toggle="tooltip" title="Chats"><i class="icon-bubbles"></i> </a>
					<a href="../../pages/content/settings.html" data-toggle="tooltip" title="Beállítások (Hamarosan)"><i class="icon-settings"></i> </a>
					<a href="<?= base_url(); ?>user/logout" data-toggle="tooltip" title="Kijelentkezés"><i class="fas fa-sign-out-alt"></i></a>
				</div>
				<?php endif; ?>

				<?php if($this->session->userdata('logged_in') == false): ?>
				<div class="sidebar-footer">
					<a href="login" data-toggle="tooltip" title="Belépés"><i class="fas fa-sign-in-alt"></i> </a>
					&nbsp;&nbsp;&nbsp;
					<a href="register" data-toggle="tooltip" title="Regisztráció"><i class="fas fa-user-plus"></i> </a>
				</div>
				<?php endif; ?>
				<center><span id="result"></span></center>

			</div>

			<div class="app-content">
				<nav class="navbar navbar-expand navbar-light bg-white">

					<button type="button" class="btn btn-sidebar" data-toggle="sidebar"><i class="icon-menu"></i></button>
					<?php /*if($this->session->userdata('count_notifications') != 0):*/ ?>
							<span class="d-block d-xl-none count_not"></span>
					<?php /*endif; */?>

                    <div class="navbar-brand d-flex"><section class="d-none d-md-block">ModMiners &middot;&nbsp;</section> <?= $title; ?></div>
					<?php if($this->session->userdata('logged_in') === true): ?>
					
					<?php endif; ?>
				</nav>

				<!--<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">Content</li>
						<li class="breadcrumb-item active" aria-current="page">Blank page</li>
					</ol>
				</nav>-->

				<div class="container-fluid p-0">

<!-- All form validation errors are showing in this popup, by adding only the 'form_errors' id, into the $this->popup->set_poup() function -->

<?php if($this->session->flashdata('form_errors')): ?>
  <?php echo "<div class='alert-dismissible fade show animated_alert alert alert-danger fixed-top col-12 col-lg-8 offset-lg-2' role='alert'>"; ?>
  <?php echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>"; ?>
  <?php echo $this->session->flashdata('form_errors')."</div>"; ?>
<?php endif; ?>

<!-- All form success messages are showing in this popup, by adding only the 'success' id, into the $this->popup->set_poup() function -->

<?php if($this->session->flashdata('success')): ?>
  <?php echo "<div class='alert-dismissible fade show animated_alert alert alert-success fixed-top col-12 col-lg-8 offset-lg-2' role='alert'>"; ?>
  <?php echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>"; ?>
  <?php echo $this->session->flashdata('success')."</div>"; ?>
<?php endif; ?>

<!-- All warning messages are showing in this popup, by adding only the 'warning' id, into the $this->popup->set_poup() function -->

<?php if($this->session->flashdata('warning')): ?>
  <?php echo "<div class='alert-dismissible fade show animated_alert alert alert-warning fixed-top col-12 col-lg-8 offset-lg-2' role='alert'>"; ?>
  <?php echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>"; ?>
  <?php echo $this->session->flashdata('warning')."</div>"; ?>
<?php endif; ?>

<!-- All info messages are showing in this popup, by adding only the 'info' id, into the $this->popup->set_poup() function -->

<?php if($this->session->flashdata('info')): ?>
  <?php echo "<div class='alert-dismissible fade show animated_alert alert alert-info fixed-top col-12 col-lg-8 offset-lg-2' role='alert'>"; ?>
  <?php echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>"; ?>
  <?php echo $this->session->flashdata('info')."</div>"; ?>
<?php endif; ?>

<!-- COPIED MESSAGE -->
<div class='fade animated_alert alert alert-dark fixed-bottom col-4 offset-4 col-lg-2 offset-lg-5 text-center' id="copied" role='alert' >Másolva!
</div>



