<?php 

	class Request extends CI_Controller {

		public function show_intro($id) {
            if($this->input->post('data') == true) {
                $this->load->model('request_model');
                echo $this->request_model->get_intro($id);
            }
        }

        public function get_username($id) {
            if($this->input->post('data') == true) {
                $this->load->model('user_model');
                echo $this->user_model->get_username($id);
            }
        }

        /*public function set_id() {
            if($this->input->post('data') != NULL) {
                $this->session->set_userdata('reg_id', $this->input->post('data'));
            }
        }*/
	}