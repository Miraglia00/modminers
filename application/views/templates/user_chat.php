<?php if($this->session->userdata('logged_in') == true): ?>
<div class="col-4 d-flex" style="position:fixed; bottom:0;">
	<div class="card text-white bg-secondary mb-2">
		<div class="card-body chat-box hidden">
			<h4 class="card-title">Secondary card title</h4>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		</div>
		<div class="d-flex">
			<button class="btn chat-button" data-toggle="tooltip" data-placement="right" title="Értesítések" id="test"><i class="fas fa-bell"></i></button>
		</div>
	</div>
</div>
<?php endif; ?>