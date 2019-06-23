<div class="offset-lg-1 col-lg-10 col-12 offset-0 mt-3">
    <div class="jumbotron pt-4 bg-light pb-4">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12 mb-2 text-center small">
                    Magyarázat: <br /> Újítás: <i class="fas fa-plus-circle text-success"></i> | Eltávolítás: <i class="fas fa-minus-circle text-danger"></i> | HotFix: <i class="fab fa-hotjar text-warning"></i> | Javítás: <i class="fas fa-wrench text-info"></i>
                </div>
            </div>

            <?php
            if($changes != false) { ?>
                <table class="table">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tartalom</th>
                        <th scope="col">Időpont</th>
                        <th scope="col" class="d-none d-md-table-cell">A</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php  foreach ($changes as $change) {
                            switch ($change['type']) {
                                case 0:
                                    $icon = "<i style=\"font-size:25px;\" class=\"fas fa-plus-circle text-success\"></i>";
                                    break;
                                case 1:
                                    $icon = "<i style=\"font-size:25px;\" class=\"fas fa-minus-circle text-danger\"></i>";
                                    break;
                                case 2:
                                    $icon = "<i style=\"font-size:25px;\" class=\"fab fa-hotjar text-warning\"></i>";
                                    break;
                                case 3:
                                    $icon = "<i style=\"font-size:25px;\" class=\"fas fa-wrench text-info\"></i>";
                                    break;
                            }
                            $delete_icon = "<i style=\"font-size:25px;\" class=\"fas fa-times text-danger\">";
                            ?>

                            <tr id="ch<?= $change['id']; ?>" class="text-center d-none d-md-table-row">
                                <td style="background-color: transparent;" class="border align-middle text-center"><?= $icon ?></td>
                                <td style="background-color: transparent;" class="border align-middle"><?= $change['content'] ?></td>
                                <td style="background-color: transparent;" class="border align-middle"><b><?= $change['c_date'] ?></b></td>
                                <td onclick="delete_log('<?= $change['id'] ?>',false);" style="background-color: transparent; cursor: pointer;" class="border align-middle d-none d-md-table-cell"><?= $delete_icon; ?></i></td>
                            </tr>

                            <tr id="ch<?= $change['id']; ?>" class="text-center d-table-row d-md-none mch" style="cursor: pointer;" <?php if($this->permissions->isAdmin()): ?> { onclick="delete_log('<?= $change['id'] ?>', true);" <?php endif; ?>>
                                <td style="background-color: transparent;" class="border align-middle text-center"><?= $icon ?></td>
                                <td style="background-color: transparent;" class="border align-middle"><?= $change['content'] ?></td>
                                <td style="background-color: transparent;" class="border align-middle"><b><?= $change['c_date'] ?></b></td>
                            </tr>
                            <?php if($this->permissions->isAdmin()):?>
                            <style>
                                .mch:hover {
                                    background-color: red;
                                }
                            </style>
                            <?php endif; ?>
                            <?php
                        } ?>
                    </tbody>
                </table>
           <?php  }else{
                echo "
                <div class=\"row text-danger\">
                        <div class=\"col-12 d-flex justify-content-center\">
                            Ez jelenleg üres!
                        </div>
                    </div>
                ";
            } ?>

        </div>

    </div>
</div>

<script>

    function delete_log(id, mobil = null) {

        if(mobil) {
            document.getElementById("delete_changelog_id").value = id;
            $("#delete_ch_modal").modal()
        }else{
            var req = new XMLHttpRequest();
            req.open('POST', '<?= $this->auth->siteURL(); ?>api/delete/changelog/'+id);
            req.setRequestHeader("token", "123652735627895289357");
            req.send();
            loading();
            req.onload = function(){
                var data = JSON.parse(req.responseText);
                if(data.response_code != 200) {
                console.log(data.message);
                }else{
                loading();
                $('#ch'+id).remove();
                $('#ch'+id).remove();
                }
            };
        }

    }

    function call_delete_log() {
        var id = $('#delete_changelog_id').val();
        delete_log(id,false);
    }


</script>

<?php if($this->permissions->isAdmin()): ?>

    <div class="modal fade" id="delete_ch_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Biztos vagy benne?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="m-1">
                        Biztos törölni akarod a kiválasztott changelog-ot?
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- CH ID-t tartalmazó input --><input id="delete_changelog_id" type="hidden" value="" />
                    <button type="submit" class="btn btn-success col-6" name='action' value='accept' onclick="call_delete_log();" data-dismiss="modal">Igen</button>
                    <button type="submit" class="btn btn-primary col-6" data-dismiss="modal">Nem</button>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>


