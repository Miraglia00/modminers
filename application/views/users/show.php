<div class="container-fluid">
	<div class="row">
		<div class="col-xl-6 offset-xl-3 offset-lg-2 col-lg-8 col-12 offset-0 mt-3">
			<div class="jumbotron bg-light">
				<div class="container-fluid">
					<div class="row">
						<?php $image_url = ($user_data['image_url'] === "default" || $user_data['image_url'] === "" ? base_url()."assets/images/default_img.png" : $user_data['image_url']); ?>
						<?php if($user_settings['image'] == 1): ?>
						<div class="col-12 col-lg-5 d-flex justify-content-center">
							<img class="img-fluid mx-auto my-auto" src="<?= $image_url ?>" />
						</div>
						<?php else: ?>
						<div class="col-12 col-lg-5 d-flex justify-content-center">
							<img class="img-fluid mx-auto my-auto" src="../../assets/images/default_img.png" />
						</div>
						<?php endif; ?>
						<div class="col-12 col-lg-7">
							<h1 class="mb-2 d-flex d-lg-block justify-content-center"><?= $user_data['username'] ?></h1>
							<h5 class="m-0 d-flex d-lg-block justify-content-center"><?= $permissions['web_permission']." és ".$permissions['server_permission']; ?></h5>
							<?php echo "<p class='mb-1 small' style='color:red;'>".($user_settings['image'] == 0 ? "A felhasználó profilképe nem publikus!" : "")."</p>"; ?>
							<?php echo "<p class='small' style='color:red;'>".($user_settings['email'] == 0 ? "A felhasználó e-mail címe nem publikus!" : "")."</p>"; ?>
							<hr style="border-color:#EBEBEB">
							<table class="table table-light table-sm">
								<tr>
									<?php $age = ($user_data['b_date'] === "0000-00-00" ? "Ismeretlen" : $user_data['age']); ?>
									<td class="align-middle" style="font-size: 16px;">Életkor:</td><td class="align-middle" style="font-size: 16px;"><?= $age ?></td>
								</tr>
								<tr>
									<?php if($user_settings['email'] == 1): ?>
									<td class="align-middle" style="font-size: 16px;">E-mail:</td><td class="align-middle" style="font-size: 16px;"><?= $user_data['email'] ?></td>
									<?php else: ?>
									<td class="align-middle" style="font-size: 16px;">E-mail:</td><td class="align-middle" style="font-size: 16px;">Ismeretlen</td>
									<?php endif; ?>
								</tr>
								<tr>
									<td class="align-middle" style="font-size: 16px;">Regisztráció időpontja:</td><td class="align-middle" style="font-size: 16px;"><?= $user_data['reg_date'] ?></td>
								</tr>
							</table>

							<table class="w-100" style="text-align:center;">
								<tr>
									<td style="font-size: 16px;">Weboldal státusz:</td><td style="font-size: 16px;">Szerver státusz:</td>
								</tr>
								<tr>
									<?php echo ($user_status['web_status'] == 1) ? 
										"<td style='font-size: 16px;' class='p-2'><div class='justify-content-center rounded bg-success'>Online</div></td>" :
										"<td style='font-size: 16px;' class='p-2'><div class='justify-content-center rounded bg-danger'>Offline</div></td>"
									; ?>

									<?php echo ($user_status['server_status'] == 1) ? 
										"<td style='font-size: 16px;' class='p-2'><div class='justify-content-center rounded bg-success'>Online</div></td>" :
										"<td style='font-size: 16px;' class='p-2'><div class='justify-content-center rounded bg-danger'>Offline</div></td>"
									; ?>
								</tr>
							</table>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-6"><button class="w-100 btn btn-primary p-1">Privát üzenet!</button></div>

						<div class="col-6"><button class="w-100 btn btn-primary p-1">Barát listára!</button></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>