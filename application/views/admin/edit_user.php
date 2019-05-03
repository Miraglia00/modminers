<?php echo form_open('admin/update/user/'.$edit_data['id']); ?>

<div class="jumbotron bg-light col-12 offset-0 col-lg-6 offset-lg-3 mt-3 pt-4">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="d-flex justify-content-between">
					<h4><?= $edit_data['username']; ?> adatainak módosítása</h4>
					<a style="text-decoration: none; color:black;" href="<?= base_url(); ?>adminpanel/show/all">Vissza</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-6">

				<!-- USERNAME FORM -->
				<div class="form-group mt-2">
				<label class="control-label">Felhasználónév:</label>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="edit_user_username" class="form-control" aria-label="Felhasználónév" value="<?= $edit_data['username']; ?>">
						</div>
					</div>
				</div>

			</div>
			<div class="col-12 col-md-6">
				
				<!-- USERNAME FORM -->
				<div class="form-group mt-2">
				<label class="control-label">Weboldal rang:</label>
					<div class="form-group">
						<div class="input-group">
						<select class="custom-select" name="edit_user_web_permission">
							<option <?php if($edit_data['web_permission'] == 0){echo "selected";} ?> value="0">Felhasználó</option>
							<option <?php if($edit_data['web_permission'] == 1){echo "selected";} ?> value="1">Adminisztrátor</option>
							<option <?php if($edit_data['web_permission'] == 2){echo "selected";} ?> value="2">Webfejlesztő</option>
						</select>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-6 offset-md-3">
				
				<!-- USERNAME FORM -->
				<div class="form-group mt-2">
				<label class="control-label">Szerver rang:</label>
					<div class="form-group">
						<div class="input-group">
						<select class="custom-select" name="edit_user_server_permission">
							<option <?php if($edit_data['server_permission'] == 0){echo "selected";} ?> value="0">Regisztrált</option>
							<option <?php if($edit_data['server_permission'] == 1){echo "selected";} ?> value="1">Játékos</option>
							<option <?php if($edit_data['server_permission'] == 2){echo "selected";} ?> value="2">Adminisztrátor</option>
							<option <?php if($edit_data['server_permission'] == 3){echo "selected";} ?> value="3">Tulajdonos</option>
							<option <?php if($edit_data['server_permission'] == 4){echo "selected";} ?> value="4">Beta Tester</option>
						</select>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<button type="submit" class="btn btn-secondary btn-lg mt-4 ">Mentés!</button>
			</div>
		</div>
	</div>	
</div>
<?php echo form_close(); ?>