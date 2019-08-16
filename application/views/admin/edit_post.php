<?php echo form_open("admin/edit_post/". $post['id']); ?>

    <script type="text/javascript" src="<?= base_url(); ?>assets/ckeditor/ckeditor.js"></script>

<?php if(validation_errors() != false) { ?>
    <div class="fixed-top animated_alert alert alert-danger alert-dismissible fade show col-12 offset-0 col-lg-8 offset-lg-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Sikertelen mentés!</strong><?php echo validation_errors();?>
    </div>
<?php } ?>

    <div class="jumbotron bg-light col-12 offset-0 col-lg-6 offset-lg-3 mt-3 pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <h4>Hír szerkesztése</h4>
                        <a style="text-decoration: none; color:black;" href="<?= base_url(); ?>home">Vissza</a>
                    </div>
                </div>
            </div>

            <div class="form-group mt-2">
                <label class="control-label">Cím:</label>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                        </div>
                        <input type="text" name="post_title" class="form-control" value="<?= $post['title']; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group mt-2">
                        <div class="form-group">
                            <textarea id="edi" name="post_content" ><?= $post['content']; ?></textarea>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" name="action" value="update" class="btn btn-secondary btn-lg mt-4 ">Mentés!</button>
            </div>
        </div>
    </div>
    </div>
<?php echo form_close(); ?>

<script>
    $(document).ready(function() {
        $('#edi').summernote();
    });
</script>
