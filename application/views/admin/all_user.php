<div class="col-12 mt-3">
	<div class="jumbotron pt-4 bg-light">
		<table class="table text-center" style="font-size:16px;">
			<thead>
				<tr>
					<th class="align-middle d-none d-sm-table-cell" scope="col ">#</th>
				    <th class="align-middle" scope="col">Felhasználónév</th>
				    <th class="align-middle d-none d-sm-table-cell" scope="col">Regisztráció dátuma</th>
					<th class="align-middle d-xs-table-cell d-sm-none" scope="col">A</th>
				    <th class="align-middle d-none d-sm-table-cell" scope="col">Akció</th>
			    </tr>
			</thead>
			<tbody>
			<?php $x = 0; ?>
			<?php foreach ($users as $user): ?>
			<?php $x++; ?>
			<tr>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle d-none d-sm-table-cell"><?= $x; ?></td>		   
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle"><a class="c_link" href="<?= base_url(); ?>users/show/<?= $user['id']; ?>"><?= $user['username']; ?></a></td>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle d-none d-sm-table-cell"><?= $user['register_date']; ?></td>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle"><a href="<?= base_url(); ?>adminpanel/edit/user/<?= $user['id']; ?>"><i class="fas fa-user-edit"></i></a></td>
			</tr>
    		<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>