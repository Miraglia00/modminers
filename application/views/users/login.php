<?php echo form_open('users/login'); ?>

<?php if(validation_errors() != false) { ?>
<div class="fixed-top animated_alert alert alert-danger alert-dismissible fade show col-12 offset-0 col-lg-8 offset-lg-2" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Sikertelen belépés!</strong><?php echo validation_errors();?>
</div>
<?php } ?>

<div class="d-flex align-content-center flex-wrap" style="color:rgba(255,255,255,0.75);">
	<div class="container mt-5">
		<div class="row">
			<div class="offset-lg-3 col-lg-6 offset-0 col-12">

				<div class="card bg-primary mb-3">
					<div class="card-header">
						<div class="container">
							<div class="row">
								<div class="col-12 d-flex justify-content-center" style="font-size:50px"><i style="font-weight: 700;" class="icon-user"></i></div>
							</div>
							<div class="row">
								<div style="font-size:1.5em" class="col-12 d-flex justify-content-center"><?= $title ?></div>
							</div>
						</div>
				  	</div>
				  <div class="card-body">		
				   	<!-- Username FORM -->
					  <div class="form-group">
					  <label class="control-label">Felhasználónév:</label>
					  <div class="form-group">
					    <div class="input-group">
					      <div class="input-group-prepend">
					        <span class="input-group-text"><i style="font-weight: 700;" class="icon-user"></i></span>
					      </div>
					      <input type="text" name="username" class="form-control" aria-label="Felhasználónév...">
					    </div>
					  </div>
					</div>

					<!-- Password FORM -->
					<div class="form-group mt-3">
					  <label class="control-label">Jelszó:</label>
					  <div class="form-group">
					    <div class="input-group">
					      <div class="input-group-prepend">
					        <span class="input-group-text"><i style="font-weight: 700;" class="icon-key"></i></span>
					      </div>
					      <input type="password" name="password" class="form-control" aria-label="Jelszó">
					    </div>
					  </div>
					</div>

					<button type="submit" class="btn btn-secondary btn-lg mt-4 ">Belépés!</button>

				  </div>
				</div>
				
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>