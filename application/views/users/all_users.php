<div class="col-12 mt-3">
	<div class="jumbotron pt-4 bg-light">
		<table class="table text-center" style="font-size:16px;">
			<thead>
				<tr>
				    <th class="align-middle" scope="col">W</th>
				    <th class="align-middle" scope="col">SZ</th>
				    <th class="align-middle" scope="col">Felhasználónév</th>
				    <th class="align-middle d-none d-md-table-cell" scope="col">PM</th>
				    <th class="align-middle d-none d-md-table-cell" scope="col">Pozíció (W/SZ)</th>
				    <th class="align-middle d-none d-md-table-cell" scope="col">E-mail</th>
				    <th class="align-middle d-none d-sm-table-cell" scope="col">Regisztráció dátuma</th>
			    </tr>
			</thead>
			<tbody>
			<?php foreach ($users as $user): ?>
			<tr>
				<?php echo ($user['user_status']['web_status'] == 1) ? 
					"<td style='background-color: transparent; border-bottom: 1px solid #ced4da;' class='align-middle'><i class='text-success fa fa-circle' aria-hidden='true'></i></td>" :
					"<td style='background-color: transparent; border-bottom: 1px solid #ced4da;' class='align-middle'><i class='text-danger fa fa-circle' aria-hidden='true'></i></td>"
				; ?>

				<?php echo ($user['user_status']['server_status'] == 1) ? 
					"<td style='background-color: transparent; border-bottom: 1px solid #ced4da;' class='align-middle'><i class='text-success fa fa-circle' aria-hidden='true'></i></td>" :
					"<td style='background-color: transparent; border-bottom: 1px solid #ced4da;' class='align-middle'><i class='text-danger fa fa-circle' aria-hidden='true'></i></td>"
				; ?>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle"><a class="c_link" href="<?= base_url(); ?>users/show/<?= $user['id']; ?>"><?= $user['username']; ?></a></td>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle d-none d-md-table-cell"><i class="message_icon fas fa-envelope"></i></td>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle d-none d-sm-table-cell"><?= $user['web']." / ".$user['server']; ?></td>
				<?php if($user['user_settings']['email'] == 1): ?>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle d-none d-md-table-cell"><?= $user['email']; ?></td>
				<?php else: ?>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle d-none d-md-table-cell"><font class="text-danger">Nem publikus!</font></td>
				<?php endif; ?>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle d-none d-sm-table-cell"><?= $user['register_date']; ?></td>
			</tr>
    		<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>