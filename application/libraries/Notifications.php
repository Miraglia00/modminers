<?php 
	class Notifications {

		function __construct() {
			$CI=& get_instance();
			$CI->load->model("notification_model");

			if($CI->session->userdata('logged_in') === TRUE) {
				$this->count_unread_user_notifications();
			}

		}

		function count_unread_user_notifications() {
			$CI=& get_instance();
			if($CI->session->userdata('logged_in') === FALSE) {
				redirect('');
			}
			
			$counted = $CI->notification_model->count_unread_user_notifications($CI->session->userdata('user_id'));	
			$CI->session->set_userdata(array('count_notifications' => $counted));
		}

		function add_user_notification($id,$title,$message,$type){
			$CI=& get_instance();
			if($CI->session->userdata('logged_in') === FALSE) {
				redirect('');
			}
			$CI->notification_model->add_user_notification($id,$title,$message,$type);
		}

		function get_user_notifications($id) {
			$CI=& get_instance();
			if($CI->session->userdata('logged_in') === FALSE) {
				redirect('');
			}
			$user_notifications = $CI->notification_model->get_user_notifications($id);
			return $user_notifications;
		}

		function add_admin_notification($title,$message,$type) {

			$CI=& get_instance();
			if($CI->session->userdata('logged_in') === FALSE) {
				redirect('');
			}
			$CI->notification_model->add_admin_notification($title,$message,$type);

		}

	}