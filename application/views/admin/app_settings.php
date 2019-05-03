<?php echo form_open('admin/app_settings'); ?>

<?php if($this->session->flashdata('edit_app_settings')): ?>
  <?php echo "<div class='alert-dismissible fade show animated_alert alert alert-danger fixed-top col-12 col-lg-8 offset-lg-2' role='alert'>"; ?>
  <?php echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>"; ?>
  <?php echo $this->session->flashdata('edit_app_settings')."</div>"; ?>
<?php endif; ?>

<div class="jumbotron bg-light col-12 offset-0 col-lg-6 offset-lg-3 mt-3 pt-4">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="d-flex justify-content-center">
					<h4>Weboldal beállítások</h4>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-6 offset-md-3">			
				<!-- USERNAME FORM -->
				<div class="form-group mt-2">
				<label class="control-label">Weboldal állapota:</label>
					<div class="form-group">
						<div class="input-group">
						<select class="custom-select" name="dev_mode">
							<option <?php if($_SERVER['CI_ENV'] == "development"){echo "selected";} ?> value="0">Fejlesztés/Karbantartás</option>
							<option <?php if($_SERVER['CI_ENV'] == "production"){echo "selected";} ?> value="1">Stabil verzió</option>
							<option <?php if($_SERVER['CI_ENV'] == "beta"){echo "selected";} ?> value="2">Beta funkciók (MÉG NINCS)</option>
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