<?php echo form_open('admin/create_beta'); ?>

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
					<h4>Fehlhasználó létrehozása</h4>
					<a style="text-decoration: none; color:black;" href="<?= base_url(); ?>adminpanel/beta_accounts/all">Vissza</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-6 offset-0 offset-md-3">
				<!-- USERNAME FORM -->
				<div class="form-group mt-2">
				<label class="control-label">Felhasználónév:</label>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" class="form-control" aria-label="Felhasználónév">
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