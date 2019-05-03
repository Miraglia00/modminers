<?php 
	class OnlineStatus {

		function __construct() {
			$CI=& get_instance();
			$CI->load->model("onlinestatus_model");
			$CI->load->model("user_model");
			/*$CI->onlinestatus_model->update($CI->session->userdata('user_id'));

			if($CI->user_model->user_exists($CI->session->userdata('user_id')) === true) {

				if($CI->session->userdata('logged_in') == NULL) {
					$this->logout($CI->session->userdata('user_id'));
				}

				if($CI->onlinestatus_model->check_os_exists($CI->session->userdata('user_id')) && $CI->session->userdata('logged_in')) {

					$CI=& get_instance();
					$CI->onlinestatus_model->insert_into($CI->session->userdata('user_id'));

				}

				if($CI->session->userdata('logged_in') === true) {

					$status = $CI->onlinestatus_model->get_status($CI->session->userdata('user_id'));
					$CI->session->set_userdata('idg_status', $status['web_status']);
					$CI->onlinestatus_model->update($CI->session->userdata('user_id'));

					if($status['web_status'] === 0) {
						$this->update($CI->session->userdata('user_id'));
					}
				}
			}*/
			if ($CI->session->userdata('logged_in') === true) {
				$this->update_user_activity($CI->session->userdata('user_id'));
			}

		}

		public function update_user_activity($id) {
			$CI=& get_instance();
			$datestring = '%Y-%m-%d %H:%i:%s';
			$time = time();
			$time = mdate($datestring, $time);
			$CI->user_model->update_user($CI->session->userdata('user_id'), 'id', 'users', $data = array('last_activity' => $time));
		}

		public function is_online($id) {
			$CI=& get_instance();

			$data['user_data'] = $CI->user_model->get_user_data($id);

			$last_act = date('Y-m-d H:i:s', strtotime("+5 minutes", strtotime($data['user_data']['last_activity'])));

			if($last_act > date('Y-m-d H:i:s')) {
				return true;
			}else{
				return false;
			}

		}

	}