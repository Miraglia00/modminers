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

        public function post() {
            $headers = $this->input->request_headers();
            echo $headers['token'];
            echo $this->input->post('token');
            /*return $this->output->set_output(json_encode(array('response_code' => '200', 'message' => 'OK')));*/
        }
    }