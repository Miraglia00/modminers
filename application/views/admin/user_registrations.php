<div class="col-12 mt-3">
	<div class="jumbotron pt-4 bg-light">
		<table class="table text-center" style="font-size:16px;">
			<thead>
				<tr>
                    <th class="align-middle" scope="col">Felhasználónév</th>
					<th class="align-middle" scope="col">Állapot</th>
					<th class="align-middle" scope="col">Bemutatkozás</th>
					<th class="align-middle d-none d-sm-table-cell" scope="col">Dátum</th>
			    </tr>
			</thead>
			<tbody>
			<?php foreach ($users as $user): ?>
			<tr>
				
				<?php switch($user['reg_status']) {

					case 0: 
						$reg_status = "<i class='fas fa-question'></i>";
						break;
	
					case 1: 
						$reg_status = "<i class='fas fa-check'></i>";
						break;

					case 2: 
						$reg_status = "<i class='fas fa-times'></i>";
						break;
				} ?>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle"><a class="c_link" href="<?= base_url(); ?>users/show/<?= $user['id']; ?>"><?= $user['username']; ?></a></td>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle"><?= $reg_status; ?></td>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle "><a data-toggle="modal" data-target="#intro<?= $user['id']; ?>" href="#" class="show_intro" onclick="load_data(<?= $user['id']; ?>);"><i class="fas fa-eye"></i></a></td>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle  d-none d-sm-table-cell"><?= $user['reg_date']; ?></td>
			</tr>

			<?php if($this->permissions->isAdmin()): ?>

			<div class="modal fade" id="intro<?= $user['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">'<span class="regusername"></span>' bemutatkozása</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="m-1 result"></div>
				</div>
				<div class="modal-footer">
				<?php if($user['reg_status'] == 0): ?>
				<?php echo form_open('admin/user_registrations/'.$user['id']); ?>
					<!-- CSAKÚGY --><input type="hidden" name="username" value="Joe" />
					<button type="submit" class="btn btn-success col-6" name='action' value='accept'>Elfogad</button>
					<button type="submit" class="btn btn-danger col-6" name="action" value='refuse'>Elutasít</button>
				<?php else: ?>
					<button type="submit" class="btn btn-primary col-12" data-dismiss="modal">Bezár</button>
				<?php echo form_close(); ?>
				<?php endif; ?>
				</div>
				</div>
			</div>
			</div>

			<?php endif; ?>

    		<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<script src="<?= base_url(); ?>/assets/js/user_registration.js"></script>