<?php echo form_open('users/update_profile'); ?>
<div class="jumbotron jumbotron-fluid bg-light mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-5 d-inline-flex justify-content-center align-items-center">
                <?php $image_url = ($user_data['image_url'] === "default" ? base_url()."assets/images/default_img.png" : $user_data['image_url']); ?>
                <?php if($user_settings['image'] == 1): ?>
                    <img class="rounded-circle d-flex justify-content-center" style="width:20vw !important; height:20vw !important;" src="<?= $image_url ?>" />
                <?php else: ?>
                    <img class="rounded-circle d-flex justify-content-center"  style="width:20vw !important; height:20vw !important;" src="<?= $image_url ?>" />
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-7">
                <h1 class="mb-2 d-flex d-md-block justify-content-center"><?= $user_data['username'] ?></h1>
                <h5 class="m-0 d-flex d-md-block justify-content-center"><?= $permissions['web_permission']." és ".$permissions['server_permission']; ?></h5>
                <hr class="mb-2 mt-2" style="border-color:#EBEBEB">
                <?php if($user_settings['image'] == 0): ?>
                <p class="small m-0 danger text-center text-md-left mb-2" style="color:red;">A profilképed nem nyilvános, de itt megjelenítjük neked!</p>
                <?php endif; ?>
                <!--
                    TABLET - GÉP ADATOK MUTATÁSA
                -->
                <table class="table d-none d-md-table">
                    <tbody>
                    <tr>
                        <?php $age = ($user_data['b_date'] === "0000-00-00" ? "Ismeretlen" : $user_data['age']); ?>
                        <td class="border align-middle bg-secondary" style="font-size: 16px;">Életkor:</td><td class="border align-middle bg-secondary" style="font-size: 16px;"><?= $age ?></td>
                    </tr>
                    <tr>
                    <?php if($user_settings['email'] === "1"): ?>
                        <td class="border align-middle bg-secondary" style="font-size: 16px;">E-mail:</td><td class="border align-middle bg-secondary" style="font-size: 16px;"><?= $user_data['email'] ?><br /></td>
                        <?php else: ?>
                        <td class="border align-middle bg-secondary" style="font-size: 16px;">E-mail:</td><td class="border align-middle bg-secondary" style="font-size: 16px;"><?= $user_data['email'] ?><br /><p class="danger small mb-0" style="color:red;">Nem publikus email!</p></td>
                    <?php endif; ?>

                    </tr>
                    <tr>
                        <td class="border align-middle bg-secondary" style="font-size: 16px;">Regisztráció időpontja:</td><td class="border align-middle bg-secondary" style="font-size: 16px;"><?= $user_data['reg_date'] ?></td>
                    </tr>
                    </tbody>
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
                               <?= $user_data['email'] ?>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="row bg-white rounded mb-2 p-2">
                        <div class="col-6 text-center">Regisztráció időpontja:</div>
                        <div class="col-6 text-center"><?= $user_data['reg_date'] ?></div>
                    </div>
                </div>

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
    </div>
</div>
<div class="jumbotron jumbotron-fluid pt-4 bg-light">
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-12 mt-0">
                    <?php echo validation_errors(); ?>
                    <h5 class="d-flex justify-content-center">Profil beállítások</h5>
                    <hr style="border-color:#EBEBEB">
                </div>
            </div>
            <?php if($user_data['image_url'] === "default"): ?>
            <p class="small justify-content-center d-flex" style="color:red;">Nincs profilkép beállítva így az alap kép fog megjelenni mindenhol!</p>
            <?php endif; ?>
            <div class="row">
                <?php $checked = ($user_settings['email'] === "1"? "checked" : ""); ?>
                <div class="col-8 d-flex align-items-center justify-content-start">Publikus e-mail</div>
                <div class="col-4 d-flex align-items-center justify-content-end">
                    <input class="p-0" type="checkbox" name="publicemail" <?= $checked ?> data-toggle="toggle" data-width="100" data-onstyle="success" data-offstyle="danger" style="width:100%"; data-on="BE" data-off="KI">
                </div>
            </div>

            <div class="row mt-2">
                <?php $checked = ($user_settings['image'] === "1"? "checked" : ""); ?>
                <div class="col-8 d-flex align-items-center justify-content-start">Publikus profilkép</div>
                <div class="col-4 d-flex align-items-center justify-content-end text-center">
                    <input class="p-0 text-center" type="checkbox" name="publicimage" <?= $checked ?> data-toggle="toggle" data-width="100" data-onstyle="success" data-offstyle="danger" style="width:100%"; data-on="BE" data-off="KI">
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-6 col-md-8 d-flex align-items-center justify-content-start">Születési idő</div>
                <div class="col-6 col-md-4 d-flex align-items-center justify-content-end">
                    <input class="form-control text-center" type="date" name="user_birth" value="<?= $user_data['b_date']; ?>">
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-4 d-flex align-items-center justify-content-start">Profilkép forrása (URL)</div>
                <div class="col-8 d-flex align-items-center justify-content-end">
                    <?php if($user_data['image_url'] === "default"): ?>
                    <input type="text" class="form-control" placeholder="Profilkép URL címe" id="user_image" name="user_image">
                    <?php else: ?>
                    <input type="text" class="form-control" placeholder="Profilkép URL címe" id="user_image" name="user_image" value="<?= $user_data['image_url']; ?>">
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mt-0">
                <div class="col-12">
                    <hr style="border-color:#EBEBEB">
                    <div class="d-flex justify-content-center"><button type="submit" class="btn btn-primary btn-lg w-75">Mentés!</button></div>
                </div>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>