<?php

	class Users extends CI_Controller {

        public function register() {

			if(!$this->session->userdata('logged_in')) {
				$header['title'] = "Regisztráció";
				// Beállítjuk az egyes form inputok validációjának szabályatt
				$this->form_validation->set_rules('username', 'felhasználónév', 'required|callback_check_username_exists'); // Custom szabály, functionnal létrehozva.

				$this->form_validation->set_rules('email', 'e-mail', 'required|callback_check_email_exists');

				$this->form_validation->set_rules('password', 'jelszó', 'required');

				$this->form_validation->set_rules('password2', 'jelszó (2x)', 'required|matches[password]');

				$this->form_validation->set_message('matches', 'A két jelszó nem egyezik.');

				$this->form_validation->set_rules('introduction', 'bemutatkozás', 'required');

				$this->form_validation->set_error_delimiters('<div class="error">- ', '</div>');

				if($this->form_validation->run() === FALSE) {

					if(validation_errors()) {
						$this->popup->set_popup('form_errors', 'Sikertelen regisztráció!', validation_errors());
						redirect(register);
					}

					$this->load->view('templates/header',$header);

					$this->load->view('users/register');

					$this->load->view('templates/footer');

				}else{
					$ex_array = array('dev_acc', 'beta_tester1','beta_tester2','beta_tester3','beta_tester4','beta_tester5', 'NErO', 'TicTac', 'Geniusz', 'Cs4bi');
					if($_SERVER['CI_ENV'] === "development") {
						$where = array_search($this->input->post('username'), $ex_array);
						if($where != NULL) {
							$enc_password = md5($this->input->post('password'));

							$this->user_model->register($enc_password);

							$this->popup->set_popup('success', 'Sikeres regisztráció!', 'Miután adminjaink elfogadják regisztrációd, be is tudsz majd lépni!');
							redirect('login');
						}else{
							$this->popup->set_popup('warning', 'Az oldal jelenleg fejlesztés alatt áll így a regisztráció nem elérhető!');
							redirect('');
						}
					}else{
						if($this->permissions->isIpBanned($this->input->ip_address(), html_escape($this->input->post('username')))) {
							$this->popup->set_popup('form_errors', 'Sikertelen regisztráció!', 'A rendszer visszautasította a kérését!');
							redirect('home');
						}

						$enc_password = md5($this->input->post('password'));

						$this->user_model->register($enc_password);

						$this->popup->set_popup('success', 'Sikeres regisztráció!', 'Miután adminjaink elfogadják regisztrációd, be is tudsz majd lépni!');
						redirect('login');
					}
				}
			}else{
				redirect('');
			}
		}
		// Felhasználónév FORM szabályának létrehozása egy function-el, létezik-e a név.
		public function check_username_exists($username) {
			$this->form_validation->set_message('check_username_exists', 'A felhasználónév már foglalt.');
			// MEghívjuk a model-ben létrehozott függvényt, ami az adatbázisban keres utánna a megadott paraméternek - TRUE v. FALSE-t ad vissza.
			// Ha TRUE-t ad vissza a model-ben lévő function akkor üres, azaz nem talált semmit.
			// Ha FALSE-t ad vissza a model-ben lévő function akkor van találat.
			if($this->user_model->check_username_exists($username)) {
				return true;
			}else{
				return false; 
			}
		}
		// Email létezésének check-olása, az előző function alapján.
		public function check_email_exists($email) {

			if($email == "betatester@modminers.hu") {
				return true;
			}
			$this->form_validation->set_message('check_email_exists', 'Az e-mail már foglalt.');
			if($this->user_model->check_email_exists($email)) {
				return true;
			}else{
				return false; 
			}
		}
		//Belépés
		public function login() {

			if(!$this->session->userdata('logged_in')) {
				$header['title'] = "Belépés";
				// Beállítjuk az egyes form inputok validációjának szabályatt
				$this->form_validation->set_rules('username', 'felhasználónév', 'required');

				$this->form_validation->set_rules('password', 'jelszó', 'required');

				$this->form_validation->set_error_delimiters('<div class="error">- ', '</div>');

				if($this->form_validation->run() === FALSE) {

					if(validation_errors()) {
						$this->popup->set_popup('form_errors', 'Sikertelen belépés!', validation_errors());
						redirect(login);
					}

					$this->load->view('templates/header', $header);

					$this->load->view('users/login');

					$this->load->view('templates/footer');

				}else{
					//Jelszó titkosaítása
					$enc_password = md5($this->input->post('password'));
					$username = html_escape($this->input->post('username'));

					if($this->permissions->isIpBanned($this->input->ip_address(), $this->user_model->get_user_id($username))) {
						$this->popup->set_popup('form_errors', 'Sikertelen belépés!', 'A rendszer visszautasította a kérését!');
						redirect('home');
					}

					$user_id = $this->user_model->login($username, $enc_password);
					if($user_id != false && $user_id != "not_activated") {

						$get_user_data = $this->user_model->get_user_data($user_id);

						if($get_user_data['server_permission'] == 4) {
							$this->popup->set_popup('form_errors', 'Sikertelen belépés!', 'A beírt adatok használata nem áll jogodban.');
							redirect('');
						}

						if($_SERVER['CI_ENV'] == "development" && $get_user_data['web_permission'] == 0) {
							$this->popup->set_popup('warning', 'Az oldal jelenleg fejlesztés alatt áll így a regisztráció nem elérhető!');
							redirect('');
						}
                        $unique = substr(base64_encode(mt_rand()), 0, 15);
						$user_data = array(
							'user_id' => $user_id,
							'username' => $username,
							'image_url' => $get_user_data['image_url'],
							'logged_in' => true,
							'p_web' => $get_user_data['web_permission'],
							'p_ser' => $get_user_data['server_permission'],
                            'generated' => $unique
						);

						$this->session->set_userdata($user_data);

                        $signature = $this->auth->set_sign($this->session->userdata('generated'));
                        $this->site_model->insert('api_tokens', array('token' => $signature, 'ip' => $this->input->ip_address()));

						$this->popup->set_popup('success', 'Sikeres belépés', 'Üdvözöllek '.$this->input->post('username').'!');

						redirect('');
					}else{
					    if($user_id == "not_activated") {
                            $this->popup->set_popup('form_errors', 'Sikertelen belépés!', 'A fiók még nem lett megerősítve az adminisztrátoraink által.');
                            redirect('login');
                        }else{
                            $this->popup->set_popup('form_errors', 'Sikertelen belépés!', 'Nincs ilyen felhasználónév/jelszó párosítás!');
                            /*echo ($user_id === false) ? "false" : $user_id; die();*/
                            /*if(!$this->session->has_userdata('login_count')) {
                                $x = 0;
                                $this->session->set_userdata('login_count', $x);
                                $this->session->set_userdata('login_username', $username);
                            }else{
                                $x = $this->session->userdata('login_count');
                                $this->session->set_userdata('login_count', $x+1);
                            }*/

                            /*if($this->session->userdata('login_count') === 3) {
                                if($username != $this->session->userdata('login_username')) {
                                    $this->session->set_userdata('login_count', NULL);
                                    $this->session->set_userdata('login_username', NULL);
                                }else{

                                    $id = $this->user_model->get_user_id($this->session->userdata('login_username'));
                                    $this->notifications->add_user_notification($id,
                                        "Sikertelen belépés!", "A profilodba 3x is megpróbáltak belépni, sikertelenül. Azt javasoljuk változtass jelszót, profilod védelme érdekében.", 1
                                    );
                                    $this->session->set_userdata('login_count', NULL);
                                    $this->session->set_userdata('login_username', NULL);
                                }
                            }*/
                            redirect('login');
                        }
					}
				}
			}else{
				redirect('');
			}
		}
		//Logout
		public function user_logout() {
			if($this->session->userdata('logged_in')) {
				$killsess = array('logged_in', 'username', 'image_url', 'p_web', 'p_ser');
				//Kill összes session
				$this->session->unset_userdata($killsess);

				$this->popup->set_popup('success', 'Sikeren kijelentkezés!', 'További jó időtöltést!');
				return redirect('');
			}else{
				return redirect('');
			}

		}

		public function browser_logout() {
			if($this->session->userdata('logged_in')) {
				$this->onlinestatus->logout($this->session->userdata('user_id'));
			}else{
				return redirect('');
			}

		}

		//User adatainak mutatása a show page-n (views/users/show), akár sajátot is.
		public function show($id = NULL) {
			error_reporting(FALSE);
			if($id === NULL) {
				redirect('');
			}
			if(!is_numeric($id)) {
				redirect('');
			}

			if($this->session->userdata('logged_in') == true) {

				$data['user_data'] = $this->user_model->get_user_data($id);

				if(empty($data['user_data'])) {
					redirect('users/show/all');
				}

				if($data['user_data']['server_permission'] == 4) {
					redirect('users/show/all');
				}

				$web = $data['user_data']['web_permission'];
				$server = $data['user_data']['server_permission'];

				$permissions = $this->permissions->convert_permission($web, $server);

				$data['permissions'] = $permissions;

				$data['user_settings'] = $this->user_model->get_user_settings($id);

				$data['user_status']['web_status'] = $this->onlinestatus->is_online($id);


				$header['permissions'] = $this->permissions->get_permissions();

				$header['user_notifications'] = $this->notifications->get_user_notifications($this->session->userdata('user_id'));

				$header['title'] = $data['user_data']['username']." profilja";

				$this->load->view('templates/header', $header);

				$this->load->view('users/show', $data);

				$this->load->view('templates/footer');

			}else{
				redirect('');
			}
		}

		public function my_profile() {

			if($this->session->userdata('logged_in') === true) {

				$data['user_data'] = $this->user_model->my_profile();

				$usersettings = $this->user_model->get_user_settings($this->session->userdata('user_id'));

				/*$user_status = $this->onlinestatus->get_status($this->session->userdata('user_id'));*/

				$data['user_status']['web_status'] = $this->onlinestatus->is_online($this->session->userdata('user_id'));

				$data['user_status']['server_status'] = 0;

				$web = $data['user_data']['web_permission'];
				$server = $data['user_data']['server_permission'];

				$data['user_settings'] = $usersettings;

				$permissions = $this->permissions->convert_permission($web, $server);

				$data['permissions'] = $permissions;

				$header['title'] = "Profilom";

				$header['user_notifications'] = $this->notifications->get_user_notifications($this->session->userdata('user_id'));

				$header['permissions'] = $this->permissions->get_permissions();

				$this->load->view('templates/header',$header);

				$this->load->view('users/my_profile', $data);

				$this->load->view('templates/footer');
			}else{
				redirect('login');
			}

		}

		public function list_users() {
			if($this->session->userdata('logged_in') == true) {

				$data['users'] = $this->user_model->list_users('server_permission <> 4');

				$x = 0;

				foreach ($data['users'] as $user) {
					$web = $user['web_permission'];
					$server = $user['server_permission'];
					$perm = $this->permissions->convert_permission($web, $server);

					$data['users'][$x]['user_settings'] = $this->user_model->get_user_settings($data['users'][$x]['id']);

					$data['users'][$x]['web'] = $perm['web_permission'];
					$data['users'][$x]['server'] = $perm['server_permission'];

					/*$data['users'][$x]['user_status'] = $this->onlinestatus_model->get_status($data['users'][$x]['id']);*/

					$data['users'][$x]['user_status']['web_status'] = $this->onlinestatus->is_online($data['users'][$x]['id']);

					$data['users'][$x]['user_status']['server_status'] = 0;

					$x++;
				}

				$header["title"] = "Összes játékos";

				$header['permissions'] = $this->permissions->get_permissions();

				$header['user_notifications'] = $this->notifications->get_user_notifications($this->session->userdata('user_id'));

				$this->load->view('templates/header',$header);

				$this->load->view('users/all_users', $data);

				$this->load->view('templates/footer');

			}else{
				redirect('');
			}
		}

		public function search() {

			$header['permissions'] = $this->permissions->get_permissions();

			$header['user_notifications'] = $this->notifications->get_user_notifications($this->session->userdata('user_id'));

			$header['title'] = "Játékos keresése";

			$this->load->view('templates/header',$header);

			$this->load->view('users/search');

			$this->load->view('templates/footer');
		}

		public function search_user() {
			$query = $this->input->post('query');

			$result = $this->user_model->search($query);

			$output = "";

			if($result->num_rows() > 0) {
				foreach ($result->result() as $user) {
					$output .= "<a class='col-12 offset-0 col-lg-8 offset-lg-2 mb-3 button btn btn-primary' href='".base_url()."/users/show/".$user->id."'>".$user->username."</a>";
				}

			}else{
				$output = "Nem található játékos!";
			}
			echo $output;
		}
		/* Profil beállítások frissítése */
		public function update_profile() {
			if($this->session->userdata('logged_in')) {

				$this->form_validation->set_rules('publicemail', '1', 'trim');
				$this->form_validation->set_rules('publicimage', '2', 'trim');

				if($this->form_validation->run() === FALSE) {

					redirect('users/my_profile');

				}else{

					$toggle1 = ($this->input->post('publicemail') === "on" ? "1" : "0");
					$toggle2 = ($this->input->post('publicimage') === "on" ? "1" : "0");
					$input_image = ($this->input->post('user_image') === "" ? "default" : $this->input->post('user_image'));
					$input_birth = $this->input->post('user_birth');

					$data = array(
						'email' => $toggle1,
						'image' => $toggle2
					);

					$data_user = array (
						'image_url' => $input_image,
						'birth_date' => $input_birth
					);

					$result = $this->user_model->update_user($this->session->userdata('user_id'), 'id', 'user_settings', $data);

					$result_user = $this->user_model->update_user($this->session->userdata('user_id'), 'id', 'users', $data_user);

					if($result && $result_user) {
						$this->popup->set_popup('success', 'Sikeres frissítés!', 'Az adataid mentve lettek!');
						redirect('users/my_profile');
					}else{
						$this->popup->set_popup('form_errors', 'Sikertelen frissítés!', 'Váratlan hiba történt!');
						redirect('users/my_profile');
					}

				}
			}else{
				redirect('');
			}
		}

		public function killsess() {
            $this->session->sess_destroy();
		}

		public function notifications($id = NULL){
			if($this->session->userdata('logged_in') === TRUE) {

				if($id != NULL) {
					if($id === "all") {
							$this->notification_model->dismiss_all_user_notification($this->session->userdata('user_id'), $id);
							
							$this->popup->set_popup('info', 'Minden értesítés oldavosttnak jelölve!');

							redirect('notifications');
					}
					$read = $this->notification_model->is_read($this->session->userdata('user_id'), $id);
					if($read == 0) {
						$this->notification_model->dismiss_user_notification($this->session->userdata('user_id'), $id);
						redirect('notifications');
					}else{
						redirect('notifications');
					}					
				}
				$header["title"] = "Összes értesítés";

				$header['permissions'] = $this->permissions->get_permissions();

				$data['user_notifications'] =  $this->notification_model->get_all_user_notifications($this->session->userdata('user_id'));
				$this->notification_model->dismiss_all_user_notification($this->session->userdata('user_id'), $id);

				$this->load->view('templates/header',$header);

				$this->load->view('users/notifications', $data);

				$this->load->view('templates/footer');

			}
		}

		public function manage_ip() {
			if($this->session->userdata('logged_in') === TRUE) {

				$data['user_notifications'] =  $this->notification_model->get_all_user_notifications($this->session->userdata('user_id'));
				$header['permissions'] = $this->permissions->get_permissions();
				$header["title"] = "IP címek kezelése";

				$this->load->view('templates/header',$header);

				$this->load->view('users/manage_ip', $data);

				$this->load->view('templates/footer');

			}
		}

	}