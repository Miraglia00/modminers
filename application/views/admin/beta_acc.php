<div class="col-12 mt-3">
	<div class="jumbotron pt-4 bg-light">
		<div class="col-12" style="word-break: break-word;">
            <div style="word-break: break-word;">
			    <a style="word-break: break-word;" href="<?= base_url(); ?>adminpanel/create_beta"><button class="btn btn-secondary btn-lg mt-4 w-100">Felhasználó létrehozása</button></a>
            </div>
		</div>
		<table class="table text-center" style="font-size:16px;">
			<thead>
				<tr>
					<th class="align-middle d-none d-sm-table-cell" scope="col ">#</th>
				    <th class="align-middle" scope="col">Felhasználónév</th>
					<th class="align-middle" scope="col">Jelszó</th>
				    <th class="align-middle d-none d-sm-table-cell" scope="col">Létrehozás dátuma</th>
					<th class="align-middle d-xs-table-cell d-sm-none" scope="col">A</th>
				    <th class="align-middle d-none d-sm-table-cell" scope="col">Akció</th>
			    </tr>
			</thead>
			<tbody>
			<?php $x = 0; ?>
			<?php foreach ($beta_users as $user): ?>
			<?php $x++; ?>
			<tr>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle d-none d-sm-table-cell"><?= $x; ?></td>		   
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle"><?= $user['username']; ?></td>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle d-none d-md-table-cell"><?= $user['code']; ?></td>
                <td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle d-table-cell d-md-none"><i class="fas fa-copy" onclick="copy('<?= $user['username']; ?>', '<?= $user['code']; ?>');"></i></td>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle d-none d-sm-table-cell"><?= $user['register_date']; ?></td>
				<td style="background-color: transparent; border-bottom: 1px solid #ced4da;" class="align-middle"><a href="<?= base_url(); ?>adminpanel/edit/beta/<?= $user['id']; ?>"><i class="fas fa-user-edit"></i></a></td>
			</tr>
    		<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<script>

    function copy(name, code) {
        var $temp = $("<textarea>");
        $("body").append($temp);
        $temp.val(name + ' : ' + code).select();
        document.execCommand("copy");
        $temp.remove();

        $('#copied').addClass('show');
        setTimeout(function(){
            $('#copied').removeClass('show');
        },1000)

    }

</script>