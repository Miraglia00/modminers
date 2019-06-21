<?php echo form_open('admin/add_changelog'); ?>
<div class="offset-lg-2 col-lg-8 col-12 offset-0 mt-3">
    <div class="jumbotron pt-4 bg-light">
        <div class="container-fluid d-none d-md-block" id="fields">

            <div class="row">
                <div class="col-12 mb-5 text-center">
                    <button class="d-flex justify-content-center btn btn-success w-100" type="button" onclick="add_field();">Mező hozzáadása &nbsp;<div class="d-flex"><span class="field_counter">1</span>/20</div></button>
                    <button class="mt-2 d-flex justify-content-center btn btn-danger w-100" type="button" onclick="remove_all();">Alaphelyzet (Törlés)</button>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="input-group mb-3">

                        <select class="custom-select col-4 col-lg-2" name="type1">
                            <option value="0" selected>Újítás</option>
                            <option value="1">Eltávolítás</option>
                            <option value="2">HotFix</option>
                            <option value="3">Javítás</option>
                        </select>

                        <input name="content1" type="text" class="form-control w-75" aria-label="Text input with dropdown button" placeholder="Rövid leírás (1 mondat)">

                        <button class="btn btn-outline-danger col-1" type="button"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            </div>

        </div>

        <div class="container-fluid mt-3">
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
<script src="<?= base_url(); ?>/assets/js/changelog.js"></script>