<?php echo form_open('admin/add_codes'); ?>
    <div class="offset-lg-2 col-lg-8 col-12 offset-0 mt-3">
        <div class="jumbotron pt-4 bg-light">
            <div class="container-fluid d-none d-md-block" id="fields">

                <div class="row">
                    <div class="col-12 mb-5 text-center">
                        <button class="d-flex justify-content-center btn btn-success w-100" type="button" onclick="add_field();">Új kód &nbsp;<div class="d-flex"><span class="field_counter">1</span>/20</div></button>
                        <button class="mt-2 d-flex justify-content-center btn btn-danger w-100" type="button" onclick="remove_all();">Alaphelyzet (Törlés)</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="input-group mb-3">

                            <input name="name1" type="text" class="form-control w-25" aria-label="Text input with dropdown button" placeholder="Item / Block neve">
                            <input name="id1" type="text" class="form-control w-25" aria-label="Text input with dropdown button" placeholder="Item / Block id">
                            <input name="meta1" type="text" class="form-control" aria-label="Text input with dropdown button" value="0" placeholder="Meta (Alapból 0)">
                            <input name="amount1" type="text" class="form-control" aria-label="Text input with dropdown button" value="1" placeholder="Mennyiség (Alapból 1)">

                            <button class="btn btn-outline-danger col-1" type="button"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="container-fluid mt-3 d-none d-md-block">
                <div class="row">
                    <div class="col-4">
                        <button class="d-flex justify-content-center btn btn-success w-100" type="submit"">Mentés</button>
                    </div>
                </div>
            </div>

            <div class="container-fluid d-block d-md-none">
                <div class="row">
                    <div class="col-12 text-center">
                        <i class="far fa-frown" style="font-size:100px;"></i><br />
                        Sajnos ez a funnckió nem érhető el ezen az eszközön!
                        <a class="mt-3 btn btn-lg btn-dark" href="<?= base_url(); ?>" role="button" style="width:100%;">Kezdőlapra!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>

    <div class="offset-lg-2 col-lg-8 col-12 offset-0 mt-3">
        <div class="jumbotron pt-4 bg-light">
            <table class="table text-center" style="font-size:16px;">
                <thead>
                <tr>
                    <th class="align-middle" scope="col">Név</th>
                    <th class="align-middle" scope="col">BlockID</th>
                    <th class="align-middle " scope="col">Meta</th>
                    <th class="align-middle " scope="col">Mennyiség</th>
                    <th class="align-middle " scope="col">Másol</th>
                    <th class="align-middle" scope="col">Felhasználva</th>
                    <th class="align-middle d-none d-lg-table-cell" scope="col">A</th>
                </tr>
                </thead>
                <tbody class="p-0 m-0">
                <?php if($codes === false): ?>
                    <tr>
                        <td style="background-color: transparent;" class="align-middle" colspan="7"><div class='col-12 text-danger text-center'>Nincs megjelenítendő kód!</div></td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($codes as $code): ?>
                        <tr id="code<?= $code['id']; ?>">
                            <td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle"><?= $code['name']; ?></td>
                            <td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle"><?= $code['block_id']; ?></td>
                            <td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle"><?= $code['meta']; ?></td>
                            <td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle"><?= $code['amount']; ?></td>
                            <td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle"><i style="cursor:pointer;" class="fas fa-copy" onclick="copy('<?= $code['code']; ?>');"></i></td>
                            <td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle"><?php echo ($code['used_by'] == "" ? "-" : $code['used_by']) ?> </td>
                            <td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle d-none d-lg-table-cell"><i onclick="delete_code(<?= $code['id']; ?>);" style="font-size:25px; cursor: pointer;" class="fas fa-times text-danger"></i></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>

        function copy(name, code) {
            var $temp = $("<textarea>");
            $("body").append($temp);
            $temp.val(name + ' : ' + code).select();
            document.execCommand("copy");
            $temp.remove();

            $('#copied').removeClass('hidden');

            $('#copied').addClass('show');

            setTimeout(function(){
                $('#copied').removeClass('show');
            },1000)

        }

    </script>
    <script src="<?= base_url(); ?>/assets/js/codes.js"></script>