<script src="<?= base_url(); ?>assets/js/post_helper.js"></script>

<?php if($this->permissions->isAdmin() && $this->permissions->isLogged()): ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <a href="<?= base_url(); ?>adminpanel/post/create"><button class="btn btn-secondary btn-lg mt-4 w-100">Hír létrehozása</button></a>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty($posts)): ?>
<?php foreach ($posts as $post): ?>

<div class="jumbotron bg-light col-12 p-2 mt-3">
	<div class="container-fluid">
		<div class="row mb-2">
			<!--<div class="col-lg-2 p-2 d-none d-lg-block">
                <div style="width:150px" class="mx-auto my-auto d-none d-lg-block" style="text-align:center">
                    <?php if($post['image_url'] === 'default'): ?>
                        <img style="width:100%;" src="<?= base_url(); ?>assets/images/default_img.png">
                    <?php else: ?>
                        <img style="width:100%;" src="<?= $post['image_url']; ?>">
                    <?php endif; ?>
                </div>
            </div>-->
            
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                            <div class="align-self-center">
                                <span><h3 class="mx-0 my-0"><b><?= $post['title']; ?></b></h3></span>
                                <span>Létrehozva <b><?= $post['username']; ?></b> által</span>
                            </div>
                            <div>
                                <?php if($post['image_url'] === 'default'): ?>
                                    <img class="rounded-circle" style="width:50px;" src="<?= base_url(); ?>assets/images/default_img.png">
                                <?php else: ?>
                                    <img class="rounded-circle" style="width:100%;" src="<?= $post['image_url']; ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <?php if(strlen($post['content']) > 700): ?>
                            <?php
                                $pos = 700;
                                $begin = substr($post['content'], 0, $pos+1);
                                $end = substr($post['content'], $pos+1);
                            ?>

                                <span id="toggled"><?= $begin ?></span>
                                <span id="show_12" onclick="reveal_text(12);" style="cursor:pointer; color:grey; font-size:1.1em;">Teljes bejegyzés mutatása...</span>

                                <span id="need_to_toggle_12" style="display:none;"><?= $end; ?></span>
                                <span id="hide_12" onclick="hide_text(12);" style="cursor:pointer; color:grey; display:none; font-size:1.1em;">Kevesebb mutatása...</span>

                            <?php else: ?>

                                <span id="toggled"><?= $post['content']; ?></span>

                            <?php endif; ?>
                            <?php if($this->permissions->IsAdmin()): ?>
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <div>
                                    <a class="c_link mr-5" style="color:black;" href="<?= base_url(); ?>adminpanel/post/edit/<?= $post['id']; ?>"><i class="fas fa-pencil-alt"></i></a>
                                    <a class="c_link" style="color:black;" href="<?= base_url(); ?>adminpanel/post/delete/<?= $post['id']; ?>"><i class="fas fa-trash-alt"></i></a>
                                </div>
                                <?php endif; ?>
                            <?php if($post['last_edited_by'] == 0): ?>
                                <p class="align-right d-flex justify-content-end">Létrehozva: <?= $post['created_at']; ?></p>
                            <?php else: ?>
                                <p class="align-right mt-3 d-flex justify-content-end">Szerkesztve: <?= $post['edited_at']; ?> (<b><?= $post['last_edited_username']; ?></b>)</p>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
		</div>
	</div>	
</div>

<?php endforeach; ?>
<?php endif; ?>
