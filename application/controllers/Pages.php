<?php 

	class Pages extends CI_Controller {

		public function view($page = "home") {
            if($page != "api") {
                if (!file_exists(APPPATH . "views/pages/" . $page . ".php")) {
                    if ($page != "api") {
                        return show_404();
                    } else {
                        redirect('api');
                    }
                }
                if ($this->session->userdata('logged_in') === TRUE) {
                    $this->load->library('onlinestatus');
                    $header['user_notifications'] = $this->notifications->get_user_notifications($this->session->userdata('user_id'));
                    $header['permissions'] = $this->permissions->get_permissions();
                }


                if ($page === 'home') {
                    $data['post'] = $this->site_model->getAll('post', 'edited_at DESC, created_at DESC');
                    if($data['post'] != "A tábla üres.") {
                        $c = count($data['post']);
                        $x = 0;
                        while ($c - 1 >= $x) {
                            $id = $data['post'][$x]['user_id'];

                            if ($data['post'][$x]['last_edited_by'] != 0) {

                                $le = $data['post'][$x]['last_edited_by'];

                                $user_data = $this->user_model->custom("SELECT username FROM users WHERE id='$le'");

                                $data['post'][$x]['last_edited_username'] = $user_data[0]['username'];
                            }

                            $user_data = $this->user_model->custom("SELECT image_url,username FROM users WHERE id='$id'");

                            $data['posts'][$x]['image_url'] = $user_data[0]['image_url'];
                            $data['posts'][$x]['username'] = $user_data[0]['username'];

                            $x++;
                        }
                    }
                }

                $header['title'] = ucfirst($page);

                $this->load->view("templates/header", $header);
                $this->load->view("pages/" . $page, $data);
                $this->load->view("templates/footer");
            }
            else{
                return $this->output->set_output(json_encode(array("response_code" => "403", "message" => "Forbidden!")));
            }

		}
	}