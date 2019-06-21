<div class="container-fluid">
	<div class="row">
		<div class="offset-lg-2 col-lg-8 col-12 offset-0 mt-3">
			<div class="jumbotron bg-light jumbotron-fluid">
				<div class="container-fluid">
					<div class="row">
                        <div class="col-12 col-lg-5 d-inline-flex justify-content-center align-items-center">
                            <?php $image_url = ($user_data['image_url'] === "default" || $user_settings['image'] == 0 ? base_url()."assets/images/default_img.png" : $user_data['image_url']); ?>
                            <?php if($user_settings['image'] == 1): ?>
                                <img class="rounded-circle d-flex justify-content-center" style="width:15vw !important; height:15vw !important;" src="<?= $image_url ?>" />
                            <?php else: ?>
                                <img class="rounded-circle d-flex justify-content-center"  style="width:15vw !important; height:15vw !important;" src="<?= $image_url ?>" />
                            <?php endif; ?>
                        </div>

						<div class="col-12 col-lg-7">
							<h1 class="mb-2 d-flex d-lg-block justify-content-center"><?= $user_data['username'] ?></h1>
							<h5 class="m-0 d-flex d-lg-block justify-content-center text-xs-center text-lg-left"><?= $permissions['web_permission']." és ".$permissions['server_permission']; ?></h5>
							<?php echo "<p class='mb-1 small text-center text-lg-left' style='color:red;'>".($user_settings['image'] == 0 ? "A felhasználó profilképe nem publikus!" : "")."</p>"; ?>
							<?php echo "<p class='small text-center text-lg-left' style='color:red;'>".($user_settings['email'] == 0 ? "A felhasználó e-mail címe nem publikus!" : "")."</p>"; ?>
							<hr style="border-color:#EBEBEB">
                            <!--
                                TABLET - GÉP ADATOK MUTATÁSA
                            -->
							<table class="table table-light table-sm d-none d-md-table">
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
                            <!--
                                TELEFON ADATOK MUTATÁSA
                            -->
                            <div class="container-fluid border-bottom mb-3 mt-3 d-xs-block d-md-none">
                                <div class="row bg-white rounded mb-2 p-2">
                                    <div class="col-6 text-center">Életkor:</div>
                                    <div class="col-6 text-center"><?= $age ?></div>
                                </div>
                                <div class="row bg-white rounded mb-2 p-2">
                                    <div class="col-12 text-center">E-mail:</div>
                                    <div class="col-12 text-center">

                                        <?php if($user_settings['email'] === "1"): ?>
                                            <?= $user_data['email'] ?>
                                        <?php else: ?>
                                            Ismeretlen!
                                        <?php endif; ?>

                                    </div>
                                </div>
                                <div class="row bg-white rounded mb-2 p-2">
                                    <div class="col-6 text-center">Regisztráció időpontja:</div>
                                    <div class="col-6 text-center"><?= $user_data['reg_date'] ?></div>
                                </div>
                            </div>

							<table class="w-100 mt-2" style="text-align:center;">
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
						<div class="col-12 col-md-6 mb-md-0 mb-2"><button class="w-100 btn btn-primary p-1">Privát üzenet!</button></div>

						<div class="col-12 col-md-6"><button class="w-100 btn btn-primary p-1">Barát listára!</button></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>