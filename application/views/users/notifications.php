<div class="container-fluid mt-3">
	<div class="row">
		
	<div class="col-12 col-lg-8 offset-lg-2">	
		<div class="text-center alert alert-warning fade show" role="alert">
			Neked jelenleg <?= $this->session->userdata('count_notifications'); ?> nem kezelt értesítésed van.
		</div>
	</div>

	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-12 offset-0 col-lg-10 offset-lg-1 mb-5">
			


<?php
$number = $this->session->userdata('count_notifications');
$x = 0;
foreach ($user_notifications as $notification): ?>

	<?php $read = ($notification['read'] == 0) ? "<i style='color:white' class='m-auto fas fa-flag'></i>" : ""; ?>

	<?php switch ($notification['type']) {
		case '0': //Általános
			
			?>
			<div class="notification_box mt-3 container-fluid" style="background-color: #c6c6c6">
				<div class="row">
					<div class="col-2 col-lg-1 d-flex justify-content-center align-middle" style="background-color: #9e9e9e">
						<i style="font-size:30px; color:white" class="m-auto fas fa-bell"></i>
					</div>
					<div class="col-10 mt-2 mb-2">
						<strong><?= $notification['title']; ?></strong><?= $read; ?><br />
						<?= $notification['message']; ?> <br />
						<small><?= $notification['date']; ?></small>
					</div>
				</div>
			</div>
			<?php

		break;
		
		case '1': //Figyelmeztető
			?>
			<div class="notification_box mt-3 container-fluid" style="background-color: #efaa33">
				<div class="row">
					<div class="col-2 col-lg-1 d-flex justify-content-center align-middle" style="background-color: #af7d26">
						<i style="font-size:30px; color:white" class="m-auto fas fa-exclamation-triangle"></i>
					</div>
					<div class="col-10 mt-2 mb-2">
						<strong><?= $notification['title']; ?></strong><?= $read; ?><br />
						<?= $notification['message']; ?> <br />
						<small><?= $notification['date']; ?></small>
					</div>
				</div>
			</div>
			<?php

		break;

		case '2': //Elfogadott
			?>
			<div class="notification_box mt-3 container-fluid" style="background-color: #66aa33">
				<div class="row">
					<div class="col-2 col-lg-1 d-flex justify-content-center align-middle" style="background-color: #4c7d24">
						<i style="font-size:30px; color:white" class="m-auto fas fa-check"></i>
					</div>
					<div class="col-10 mt-2 mb-2">
						<strong><?= $notification['title']; ?></strong><?= $read; ?><br />
						<?= $notification['message']; ?> <br />
						<small><?= $notification['date']; ?></small>
					</div>
				</div>
			</div>
			<?php

		break;

		case '3': //Elutasított
			?>
			<div class="notification_box mt-3 container-fluid" style="background-color: #ef6644">
				<div class="row">
					<div class="col-2 col-lg-1 d-flex justify-content-center align-middle" style="background-color: #af4b31">
						<i style="font-size:30px; color:white" class="m-auto fas fa-times"></i>
					</div>
					<div class="col-10 mt-2 mb-2">
						<strong><?= $notification['title']; ?></strong><?= $read; ?><br />
						<?= $notification['message']; ?> <br />
						<small><?= $notification['date']; ?></small>
					</div>
				</div>
			</div>
			<?php

		break;

		case '4': //Admin
			?>
			<div class="notification_box mt-3 container-fluid" style="background-color:#d9e021">
				<div class="row">
					<div class="col-2 col-lg-1 d-flex justify-content-center align-middle" style="background-color: #b4ba1d">
						<i style="font-size:30px; color:white" class="m-auto icon-shield"></i>
					</div>
					<div class="col-10 mt-2 mb-2">
						<strong><?= $notification['title']; ?></strong><?= $read; ?><br />
						<?= $notification['message']; ?> <br />
						<small><?= $notification['date']; ?></small>
					</div>
				</div>
			</div>
			<?php

		break;
	}
	$x++;
	if($x == $number) {
		echo "<hr style='border-top: 1px solid red;'>";
	}

	?>

<?php endforeach; ?>

		</div>
	</div>
</div>