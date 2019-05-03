<?php 

class Permissions
{
	public function load_sessions() {
		$CI=& get_instance();

		if($CI->user_model->user_exists($CI->session->userdata('user_id')) === false) {
				$killsess = array('logged_in', 'user_id', 'username', 'image_url', 'p_web', 'p_ser');
				$CI->session->unset_userdata($killsess);
				redirect('');
		}

		if($CI->session->userdata('logged_in') === true) {

			$temp_data = $CI->user_model->get_user_data($CI->session->userdata('user_id'));

			if($temp_data === false) {
				$killsess = array('logged_in', 'user_id', 'username', 'image_url', 'p_web', 'p_ser');
				$CI->session->unset_userdata($killsess);
				redirect('');
			}

			$user_perm = $this->convert_permission($temp_data['web_permission'], $temp_data['server_permission']);

			/*$array_items = array('username', 'image_url', 'p_web', 'p_ser');

			$CI->session->unset_userdata($array_items);*/

			$temp_session_array = array(
				'username' => $temp_data['username'],
				'image_url' => $temp_data['image_url'],
				'p_web' => $temp_data['web_permission'],
				'p_ser' => $temp_data['server_permission']
			);

			$CI->session->set_userdata($temp_session_array);
			$header['permissions'] = $user_perm;
		}
	}

	public function get_permissions() {
		$CI=& get_instance();
		$web = $CI->session->userdata['p_web'];
		$server = $CI->session->userdata['p_ser'];
		$this->load_sessions();

		return $permissions = $this->convert_permission($web, $server);

	}

	public function convert_permission($web = NULL, $server = NULL) {

			switch ($web) {
				case '0':
					$web_permission = "Weboldal felhasználó";
					break;
				case '1':
					$web_permission = "Weboldal adminisztrátor";
					break;
				case '2':
					$web_permission = "Webfejlesztő";
					break;
				
				default:
					$web_permission = "Hiba!";
					break;
			}

			switch ($server) {
				case '0':
					$server_permission = "Regisztrált játékos";
					break;
				case '1':
					$server_permission = "Játékos";
					break;
				case '2':
					$server_permission = "Szerver adminisztrátor";
					break;
				case '3':
					$server_permission = "Szerver tulajdonos";
					break;
				case '4':
					$server_permission = "Beta Tester";
					break;
				
				default:
					$server_permission = "Hiba!";
					break;
			}

			return $permissions = array(
				'web_permission' => $web_permission,
				'server_permission' => $server_permission
			);
	}

	public function isAdmin() {

		$CI=& get_instance(); 

		$rang = $CI->session->userdata('p_web');
		return ($rang > 0) ? true : false;

	}

    public function isLogged() {

        $CI=& get_instance();

        $logged = $CI->session->userdata('logged_in');
        return $logged;

    }

	public function get_user_ip(){

		$CI=& get_instance(); 

		return $CI->input->ip_address();

	}

	public function add_user_ip($id, $ip) {

		$CI=& get_instance();

		$query = $CI->user_model->custom("INSERT INTO user_ip VALUES (".$id.", '.$ip.', '0', NOW())");
		if($query) {
			return true;
		}else{
			return false;
		}

	}

	public function isIpBanned($ip, $id = NULL) {

		$CI=& get_instance();

		if($id != NULL) {
			$res = $CI->user_model->get_where("user_ip", "id = '$id' AND ip = '$ip' AND status = 2 OR status = 3");
		}else{
			$res = $CI->user_model->get_where("user_ip", "ip = '$ip' AND status = 2 OR status = 3");
		}

		if($res) {
			return true;
		}else{
			return false;
		}

	}
}
