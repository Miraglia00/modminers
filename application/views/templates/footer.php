</div>

			</div>
		</div>
	</div>

<?php if($_SERVER['CI_ENV'] === "development"): ?>
    <div class='text-center alert-dismissible fade show animated_alert alert alert-warning fixed-bottom col-12 col-lg-2 offset-lg-10 log_alert' role='alert' onclick="$('.log_alert').hide('fade');">
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        Az oldal jelenleg "development" üzemmódban van, azaz fejlesztés alatt! Hibák kiírása, F12 engedélyezése is ehhez az állapothoz tartozik.
    </div>
<?php endif; ?>

<!-- LOADING ICON -->
<div class="fixed-top d-flex justify-content-end m-1" style="z-index:9999;">
    <i style="font-size:50px;" class="fas fa-circle-notch fa-spin hidden loading"></i>
</div>

<!-- VERSION -->
<div class="fixed-bottom d-flex justify-content-end m-1 small" style="z-index:9999;">
    Verzió:<?= $_SERVER['WEB_VERSION']; ?><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span>
</div>
<!-- COPIED -->
<div class='fade animated_alert alert alert-dark fixed-bottom col-4 offset-4 col-lg-2 offset-lg-5 text-center hidden' id="copied" role='alert' >Másolva!</div>




</body>
</html>