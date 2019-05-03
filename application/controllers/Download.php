<?php 

	class Download extends CI_Controller {

		public function index($folder, $file) {

            if($folder == NULL || $file == NULL) {
                redirect('');
            }
            echo "asd";
			force_download('launcherFiles\ModMiners Client Installer.exe', NULL);
		}
	}