<?php echo form_open('users/register'); ?>

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

					<!-- Email FORM -->
					<div class="form-group mt-3">
					  <label class="control-label">E-mail cím:</label>
					  <div class="form-group">
					    <div class="input-group">
					      <div class="input-group-prepend">
					        <span class="input-group-text"><i style="font-weight: 700;" class="fas fa-at"></i></span>
					      </div>
					      <input type="email" name="email" class="form-control" aria-label="E-mail cím...">
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

					<!-- Password2 FORM -->
					<div class="form-group mt-3">
					  <label class="control-label">Jelszó megerősítése:</label>
					  <div class="form-group">
					    <div class="input-group">
					      <div class="input-group-prepend">
					        <span class="input-group-text"><i style="font-weight: 700;" class="icon-key"></i></span>
					      </div>
					      <input type="password" name="password2" class="form-control" aria-label="Jelszó megerősítése">
					    </div>
					  </div>
					</div>

					<!-- Introduction FORM -->
					<div class="form-group">
					  <label class="control-label">Rövid leírás magadról:</label>
					  <div class="form-group">
					    <div class="input-group">
					      <div class="input-group-prepend">
					        <span class="input-group-text"><i style="font-weight: 700;" class="icon-info"></i></span>
					      </div>
					      <textarea class="form-control" name="introduction" rows="3"></textarea>
					    </div>
					  </div>
					</div>

					<button type="submit" class="btn btn-secondary btn-lg mt-4 ">Regisztráció!</button>


				  </div>
				</div>
				

			</div>
		</div>
	</div>
</div>

<?php echo form_close(); ?>