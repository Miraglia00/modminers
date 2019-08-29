<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2019. 04. 29.
 * Time: 20:43
 */

	class Api extends CI_Controller {

        protected  $responses = array(
            '200' => array('200', 'OK'),
            '405' => array('405', 'Method Not Allowed',),
            '417' => array('417', 'Expectation Failed'),
            '403' => array('403', 'Forbidden'),
            '401' => array('401', 'Unauthorized'),
            '500' => array('500', 'Internal Server Error'),
            '450' => array('450', 'Already Has Defined Token')
        );

        public function __construct() {
            parent::__construct(); /*&& $this->uri->segment(2) === NULL*/
        }

        public function send_response($number, $name = null, $data = null) {
            return $this->output->set_output(json_encode(array('response_code' => $this->responses[$number][0], 'message' => $this->responses[$number][1], $name => $data)));
        }

        public function send_spec_response($array) {
            return $this->output->set_output(json_encode($array));
        }


        public function get($what = null) {

            $headers = $this->input->request_headers();

            if($what == NULL) {
                return $this->send_response(405); /*return $this->output->set_output(json_encode(array('response_code' => '405', 'message' => 'Method Not Allowed')));*/
            }

            if($this->has_perm()) {
                switch($what){
                    case 'notification_count':
                        $this->notification_count();
                        break;

                    default:
                        return $this->send_response(405);
                        break;
                }
            }else{
                return $this->send_response(401);
            }
        }

        public function select() {
            if(!$this->has_perm()) {
                return $this->send_response(403);
            }


            $data = file_get_contents("php://input");
            $data = json_decode($data, true);


            $select = $this->site_model->select($data['table'], $data['param']);
            if($select === false) {
                return $this->output->set_output(json_encode(false));
            }else{
                return $this->output->set_output(json_encode($select));
            }
        }

        function update() {
            if(!$this->has_perm()) {
                return $this->send_response(403);
            }

            $data = file_get_contents("php://input");
            $data = json_decode($data, true);

            $q = $this->site_model->update($data['table'], $data['col'], $data['id'], $data['param']);
            return $this->output->set_output(json_encode($q));
        }

        public function delete() {
            if(!$this->has_perm()) {
                return $this->send_response(403);
            }


            $data = file_get_contents("php://input");
            $data = json_decode($data, true);


            $delete = $this->site_model->delete($data['table'], $data['col'], $data['id']);
            if($delete) {
                return $this->send_response(200);
            }else{
                return $this->send_response(500);
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
            $num = $this->notifications->count_unread_user_notifications();
            return $this->send_response(200, 'number', $num);
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

        public function defined_token($token) {
            $ip = $this->input->ip_address();
            $data = $this->site_model->select('api_tokens', array('ip' => $ip, 'token' => $token));

            if($data) {
                return true;
            }else{
                return false;
            }
        }

        public function has_defined_token($ip) {
            $data = $this->site_model->select('api_tokens', array('ip' => $ip));
            if($data) {
                return $data['token'];
            }else return false;
        }

        public function create_token() {
            $headers = $this->input->request_headers();
            if(!isset($headers['ip-address'])) {
                $ip = $this->input->ip_address();
            }else{
                $ip = $headers['ip-address'];
            }
            if(!$this->has_defined_token($ip)) {
                $first = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ=%", 15)), 0, 15);
                $second = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ=%", 15)), 0, 15);
                $token = "$".hash('sha256', $first.$second);
                $this->site_model->insert('api_tokens', array('id' => '', 'token' => $token, 'ip' => $ip));
                return $this->send_spec_response(array('token' => $token));
            }else return $this->send_response('450', 'defined_token', $this->has_defined_token($ip));
        }

        public function has_perm() {
            $signature = $this->check_signature($this->session->userdata('generated'));
            if (!$signature) {
                if(isset($headers['Token'])) {
                    if(!$this->defined_token($headers['Token'])) {
                        return $this->send_response(417);
                    }else{
                        return true;
                    }
                }else{
                    return $this->send_response(403);
                }
            }else { //VAN ALÁÍRÁS, WEBEN VAN
                if (!$this->permissions->isLogged()) {
                    return $this->send_response(403);
                } else {
                    return true;
                }
            }
        }

        public function add_admin_notification() {
            if(!$this->has_perm()) {
                return $this->send_response(403);
            }


            $data = file_get_contents("php://input");
            $data = json_decode($data, true);

            if(isset($data['username'])) {
                $message = "<b>".$data['username']."</b> ".$data['message'];
            }else{
                $message = $data['message'];
            }

            $this->notifications->add_admin_notification($data['title'], $message, $data['type']);

            return true;
        }

    }