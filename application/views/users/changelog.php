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

                    <tr class="row" id="ch<?= $change['id']; ?>">
                        <th style="background-color: transparent;" class="border text-center align-middle col-2"><?= $icon ?></th>
                        <td style="background-color: transparent;" class="border text-left align-middle col-6"><?= $change['content'] ?></td>
                        <th style="background-color: transparent;" class="border text-center align-middle col-3"><?= $change['c_date'] ?></th>
                        <th onclick="delete_log('<?= $change['id'] ?>');" style="background-color: transparent; cursor: pointer;" class="border text-center align-middle col-1"><?= $delete_icon; ?></i></th>
                    </tr>

                    <?php
                } ?>
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

    function delete_log(id) {
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
            }
        };
    }

</script>


