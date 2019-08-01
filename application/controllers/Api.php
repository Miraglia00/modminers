<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2019. 04. 29.
 * Time: 20:43
 */

	class Api extends CI_Controller {

        public function __construct() {
            parent::__construct(); /*&& $this->uri->segment(2) === NULL*/
        }

        public function get($what) {
            if(!$this->permissions->isLogged()) {
                return $this->output->set_output(json_encode(array('response_code' => '403', 'message' => 'Forbidden')));
            }
            /*$headers = $this->input->request_headers();
            if(!isset($headers['token'])) {
                return $this->output->set_output(json_encode(array('response_code' => '417', 'message' => 'Expectation Failed')));
            }*/
            if($what == NULL) {
                return $this->output->set_output(json_encode(array('response_code' => '405', 'message' => 'Method Not Allowed')));
            }

            $signature = $this->check_signature($this->session->userdata('generated'));
            if($signature) {
                switch($what){
                    case 'notification_count':
                        $this->notification_count();
                        break;

                    default:
                        return $this->output->set_output(json_encode(array('response_code' => '405', 'message' => 'Method Not Allowed')));
                        break;
                }
            }else{
                return $this->output->set_output(json_encode(array('response_code' => '401', 'message' => 'Unauthorized')));
            }
        }

        public function delete($table, $id) {
            if(!$this->permissions->isLogged()) {
                return $this->output->set_output(json_encode(array('response_code' => '403', 'message' => 'Forbidden')));
            }
            $headers = $this->input->request_headers();
            if(!isset($headers['token'])) {
                return $this->output->set_output(json_encode(array('response_code' => '417', 'message' => 'Expectation Failed')));
            }
            if($id == NULL) {
                return $this->output->set_output(json_encode(array('response_code' => '405', 'message' => 'Method Not Allowed')));
            }

            $delete = $this->site_model->delete($table,$id);
            if($delete) {
                return $this->output->set_output(json_encode(array('response_code' => '200', 'message' => 'OK')));
            }else{
                return $this->output->set_output(json_encode(array('response_code' => '500', 'message' => 'Internal Server Error')));
            }

        }

        public function check_signature($random) {
            $data = $this->site_model->select('users', array('id' => $this->session->userdata('user_id')));
            $user_code = $data['code'];
            $token = hash('sha256', $user_code.$random);

            $exist = $this->site_model->select('api_tokens', array('token' => $token));

            if($exist) {
                return true;
            }else{
                return false;
            }

        }

        public function notification_count() {
            $number = $this->notifications->count_unread_user_notifications();
            return $this->output->set_output(json_encode(array('response_code' => '200', 'message' => 'OK', 'data' => array('number' => $number))));
        }

        public function my_token() {
            if(!$this->permissions->isAdmin() || !$this->permissions->isLogged()) {
                redirect('');
            }else{
                $data = $this->site_model->select('users', array('id' => $this->session->userdata('user_id')));
                $user_code = $data['code'];
                echo hash('sha256', $user_code.$this->session->userdata('generated'));
            }
        }
    }