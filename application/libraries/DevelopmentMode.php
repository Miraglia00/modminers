<?php 

class DevelopmentMode
{
	function __construct() {
		$CI=& get_instance();



		if($_SERVER['CI_ENV'] === "development" && $CI->session->userdata('logged_in') === true && $CI->session->userdata('p_web') == 0) {
			$killsess = array('logged_in', 'username', 'image_url', 'p_web', 'p_ser');
			//Kill összes session
			$CI->session->unset_userdata($killsess);

			$CI->session->set_flashdata('dev_mode', "Kilettél jeletkeztetve! Sajnáljuk de az oldal jelenleg 'development' módban van. Ennek oka a karbantartás, vagy a fejlesztés! Megértésedet köszönjük!");
			return redirect('');
		}

	}
}
