<?php 

class Admin extends CI_Controller {

	public function list_all_user() {

		if(!$this->permissions->isAdmin()) {
			redirect('');
		}

		if($this->session->userdata('logged_in') != true && $this->session->userdata('p_web') == 0 && $this->session->userdata('p_web') == 4) {
			redirect('');
		}

		$data['users'] = $this->user_model->list_users("server_permission <> 4");

		$x = 0;

		foreach ($data['users'] as $user) {
			$web = $user['web_permission'];
			$server = $user['server_permission'];
			$perm = $this->permissions->convert_permission($web, $server);

			$data['users'][$x]['user_settings'] = $this->user_model->get_user_settings($data['users'][$x]['id']);

			$data['users'][$x]['web'] = $perm['web_permission'];
			$data['users'][$x]['server'] = $perm['server_permission'];
			$x++;
		}

		$header["title"] = "Adminpanel - Játékos lista";

		$header['permissions'] = $this->permissions->get_permissions();

		$header['user_notifications'] = $this->notifications->get_user_notifications($this->session->userdata('user_id'));

		$this->load->view('templates/header',$header);

		$this->load->view('admin/all_user', $data);

		$this->load->view('templates/footer');
	}

	public function edit($what = NULL, $id = NULL) {

		if(!$this->permissions->isAdmin()) {
			redirect('');
		}

		if($this->session->userdata('logged_in') == false || $this->session->userdata('p_web') == 0 && $this->session->userdata('p_web') == 4) {
			redirect('home');
		}

		$what = $this->uri->segment(3);
		$id = $this->uri->segment(4);

		if($what == NULL || $id == NULL) {
			redirect('adminpanel/show/all');
		}

		if($what == "user") {

			$data['edit_data'] = $this->user_model->get_user_data($id);
			$temp = $data['edit_data']['server_permission'];

			if($data['edit_data']['server_permission'] == 4) {
				redirect('adminpanel/show/all');
			}


			$header['title'] = "Adminpanel - ".$data['edit_data']['username']." módosítása";
			$header['permissions'] = $this->permissions->get_permissions();
			$header['user_notifications'] = $this->notifications->get_user_notifications($this->session->userdata('user_id'));

			$this->load->view("templates/header", $header);

			$this->load->view("admin/edit_user", $data);

			$this->load->view("templates/footer");

		}else if($what == "beta") {

			$data['edit_data'] = $this->user_model->get_user_data($id);
			$data['beta_status'] = $this->user_model->get_where('tester_accounts', 'id ='.$id);
			$data['beta_status'] = $data['beta_status'][0];
			
			if($data['edit_data']['server_permission'] != 4) {
				redirect('adminpanel/show/all');
			}

			$header['title'] = "Adminpanel - ".$data['edit_data']['username']." módosítása";
			$header['permissions'] = $this->permissions->get_permissions();
			$header['user_notifications'] = $this->notifications->get_user_notifications($this->session->userdata('user_id'));
			
			$this->load->view("templates/header", $header);

			$this->load->view("admin/edit_beta_acc", $data);

			$this->load->view("templates/footer");

		}

	}

	public function update($what = NULL, $id = NULL) {

		if(!$this->permissions->isAdmin()) {
			redirect('');
		}

		if($id === NULL || $what === NULL) {
			redirect('adminpanel/show/all');
		}

		if($this->session->userdata('logged_in') == false || $this->session->userdata('p_web') == 0 && $this->session->userdata('p_web') == 4) {
			redirect('home');
		}

		$id = $this->uri->segment(4);

		if($what == "user") {

			$this->form_validation->set_rules('edit_user_username', 'felhasználónév', 'required');
			$this->form_validation->set_rules('edit_user_web_permission', 'weboldal rang', 'required');
			$this->form_validation->set_rules('edit_user_server_permission', 'szerver rang', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">- ', '</div>');

			if($this->form_validation->run() === TRUE) {

				$old_userdata = $this->user_model->get_user_data($id);

				$username = $this->input->post('edit_user_username');
				$web_permission = $this->input->post('edit_user_web_permission');
				$server_permission = $this->input->post('edit_user_server_permission');

				$old_permissions = $this->permissions->convert_permission($old_userdata['web_permission'], $old_userdata['server_permission']);
				$new_permissions = $this->permissions->convert_permission($web_permission, $server_permission);

				$username_into = ($old_userdata['username'] != $username ? "Név: ".$old_userdata['username']." --> ".$username." | " : "Név: Nincs változás! | ");
				$web_into = ($old_userdata['web_permission'] != $web_permission ? "Web rang: ".$old_permissions['web_permission']." --> ".$new_permissions['web_permission']." | " : "Web rang: Nincs változás! | ");
				$server_into = ($old_userdata['server_permission'] != $server_permission ? "Szerver rang: ".$old_permissions['server_permission']." --> ".$new_permissions['server_permission']  : "Szerver rang: Nincs változás!");


				$update_user_data = array(
					'username' => $username,
					'server_permission' => $server_permission,
					'web_permission' => $web_permission
				);

				$return = $this->user_model->update_user($id, 'id', 'users', $update_user_data);

				if($return) {
					$this->popup->set_popup('success', 'Sikeres adatmódosítás', 'Az adatok mentésre kerültek az adatbázisba!');

					$this->notifications->add_user_notification($id, 
						"Profilod szerkesztve lett egy admin által!", "<b>".$this->session->userdata('username')."</b> módosította a profil bellításaidat. Ha nem volt egyeztetve, avagy helytelen változtatást észleltél, vedd fel a kapcsolatot a vezetőséggel.<br/>".$username_into.$web_into.$server_into, 0
					);

					$this->notifications->add_admin_notification( 
						$username." profilja szerkesztve lett!", "<b>".$this->session->userdata('username')."</b> módosította '".$username."' profil bellításait.<br/>".$username_into.$web_into.$server_into, 4
					);

					redirect('adminpanel/edit/user/'.$id);
				}else{
					$this->popup->set_popup('form_errors', 'Sikertelen adatmódosítás', 'Váratlan hiba történt!');
					redirect('adminpanel/edit/user/'.$id);
				}

			}else{
				$this->session->set_flashdata('form_errors', "<b>Sikertelen adatmódosítás!</b> <br />".validation_errors());
				redirect('adminpanel/edit/user/'.$id);
			}

		}else if($what == "beta") {

			$this->form_validation->set_rules('edit_beta_username', 'felhasználónév', 'required');
			$this->form_validation->set_rules('edit_beta_status', 'státusz', 'trim');
			$this->form_validation->set_error_delimiters('<div class="error">- ', '</div>');

			if($this->form_validation->run() === TRUE) {

				$value = $this->input->post('action');
				
				if($value == "update") {

					$old_name = $this->user_model->get_username($id);

					$username = $this->input->post('edit_beta_username');
					$status = ($this->input->post('edit_beta_status') === "on" ? "1" : "0");

					switch ($status) {
						case '1':
							$status_name = "Foglalt";
							break;
						case '0':
							$status_name = "Szabad";
							break;
						
						default:
							$status_name = "Hiba";
							break;
					}

					$return = $this->user_model->custom("UPDATE users U, tester_accounts TA SET U.username = '$username', TA.username = '$username', TA.status = '$status' WHERE U.id = '$id' AND TA.id = '$id';");

					if($return) {
						$this->popup->set_popup('success', 'Sikeres adatmódosítás', 'Az adatok mentésre kerültek az adatbázisba!');

						$this->notifications->add_admin_notification('Beta felhasználó szerkesztve!', '<b>'.$this->session->userdata('username').'</b> szerkesztette \''.$username.'\' fiók állapotát. <br /> Név: '.$old_name. ' --> '.$username.' | Státusz: '.$status_name, 4);

						redirect('adminpanel/edit/beta/'.$id);
					}else{
						$this->popup->set_popup('form_errors', 'Sikertelen adatmódosítás!', 'Váratlan hiba történt!');
						redirect('adminpanel/edit/beta/'.$id);
					}
				}else if($value == "delete_beta"){
					
					$return = $this->user_model->custom("DELETE FROM users WHERE id = '$id';");

					if($return) {
						$this->popup->set_popup('success', 'Sikeres törlés!', 'A felhasználói fiók törölve!');

						$this->notifications->add_admin_notification('Beta felhasználó törölve!', '<b>'.$this->session->userdata('username').'</b> törölte \''.$this->session->userdata('username').'\' beta fiókot!', 4);

						redirect('adminpanel/beta_accounts/all');

					}else{
						$this->popup->set_popup('form_errors', 'Sikertelen törlés!', 'Váratlan hiba történt!');
						redirect('adminpanel/beta_accounts/all');
					}

				}else{
					redirect('adminpanel/edit/beta/'.$id);
				}

			}else{
				$this->popup->set_popup('form_errors', 'Sikertelen adatmódosítás!', validation_errors());
				redirect('adminpanel/edit/beta/'.$id);
			}
		}else{
			redirect('');
		}
	}

	public function app_settings() {
		if($this->session->userdata('logged_in') == false || $this->session->userdata('p_web') == 0 && $this->session->userdata('p_web') == 4) {
			redirect('home');
		}

		if(!$this->permissions->isAdmin()) {
			redirect('');
		}

		$header['title'] = "Adminpanel - Weboldal beállítások";
		$header['permissions'] = $this->permissions->get_permissions();
		$header['user_notifications'] = $this->notifications->get_user_notifications($this->session->userdata('user_id'));

		$this->form_validation->set_rules('dev_mode', 'státusz', 'required');

		if($this->form_validation->run() === TRUE) {
			switch ($this->input->post('dev_mode')) {
				case '0':
					$dev_mode = "development";
					break;
				case '1':
					$dev_mode = "production";
					break;
				case '2':
					$dev_mode = "testing";
					break;
				
				default:
					$dev_mode = "development";
					break;
			}

			$old_mode = $_SERVER['CI_ENV'];

			$new_mode = $dev_mode;

			$file = '.htaccess';

			$str = file_get_contents($file);

			$str = str_replace("$old_mode", "$new_mode",$str);

			file_put_contents('.htaccess', $str);

			$this->notifications->add_admin_notification('Weboldal beállítása változott!', '<b>'.$this->session->userdata('username').'</b> átállította a weboldal státuszát! ('.$old_mode.' -> '.$new_mode.')', 4);

			redirect('adminpanel/app_settings');

		}else{
			$this->load->view("templates/header", $header);

			$this->load->view("admin/app_settings");

			$this->load->view("templates/footer");
		}

	}

	public function beta_acc($id = NULL) {

		if($this->session->userdata('logged_in') != true && $this->session->userdata('p_web') == 0 && $this->session->userdata('p_web') == 4) {
			redirect('');
		}

		if(!$this->permissions->isAdmin()) {
			redirect('');
		}

		if($id === NULL) {
	
			redirect('');

		}else if($id === "all") {

			$header["title"] = "Adminpanel - Beta felhasználók";

			$header['permissions'] = $this->permissions->get_permissions();

			$header['user_notifications'] = $this->notifications->get_user_notifications($this->session->userdata('user_id'));

			$data['beta_users'] = $this->user_model->list_users(array('server_permission' => 4));

			$this->load->view('templates/header',$header);

			$this->load->view('admin/beta_acc', $data);

			$this->load->view('templates/footer');

		}

		$data['beta_acc'] = $this->user_model->get_user_data($id);

		$header["title"] = "Adminpanel - ".$data['beta_acc']['username'];

		$header['permissions'] = $this->permissions->get_permissions();

		$header['user_notifications'] = $this->notifications->get_user_notifications($this->session->userdata('user_id'));

		$this->load->view('templates/header', $header);

		$this->load->view('admin/edit_beta_acc', $data);

		$this->load->view('templates/footer');
	}

	public function create_beta() {

		if(!$this->permissions->isAdmin()) {
			redirect('');
		}

		$this->form_validation->set_rules('username', 'felhasználónév', 'required');

		if($this->form_validation->run() === TRUE) {

			$s = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ=%", 15)), 0, 15);
			$password = md5($s);

			$this->user_model->register($password, true, $s);

			$this->popup->set_popup('success', 'Sikeres létrehozás!', 'Az adatok mentve lettek!');
			$this->notifications->add_admin_notification('Beta felhasználó létrehozása!', '<b>'.$this->session->userdata('username').'</b> létrehozott egy beta felhasználót \''.$this->input->post('username').'\' néven!', 4);
			redirect('adminpanel/beta_accounts/all');

		}

		$header["title"] = "Adminpanel - Beta felhasználó létrehozása";

		$header['permissions'] = $this->permissions->get_permissions();

		$header['user_notifications'] = $this->notifications->get_user_notifications($this->session->userdata('user_id'));

		$this->load->view('templates/header', $header);

		$this->load->view('admin/create_beta');

		$this->load->view('templates/footer');
	}

	public function user_registrations($id = NULL){

		if(!$this->permissions->isAdmin()) {
			redirect('');
		}

		$header["title"] = "Adminpanel - Játékos regisztrációk";

		$header['permissions'] = $this->permissions->get_permissions();

		$header['user_notifications'] = $this->notifications->get_user_notifications($this->session->userdata('user_id'));

		$data['users'] = $this->user_model->list_users("server_permission <> 4");
		$data['registrations'] = $this->user_model->custom('SELECT * FROM user_registrations');
		$x = 0;
		$count = count($data['users']);

		while($count > $x) {
			$data['users'][$x]['intro'] = $data['registrations'][$x]['introduction'];
			$data['users'][$x]['reg_date'] = $data['registrations'][$x]['reg_date'];
			$data['users'][$x]['reg_status'] = $data['registrations'][$x]['status'];

			$x++;
		}

		$this->form_validation->set_rules('username', 'felhasználónév', 'trim');

		if($this->form_validation->run() === TRUE) {
			echo $this->input->post('action');
			if($this->input->post('action') === "accept") {
				$this->user_model->update_user($id, 'id', 'user_registrations', array('status' => 1));
				$this->user_model->update_user($id, 'id', 'users', array('server_permission' => 1));
				$name = $this->user_model->get_username($id);
				$this->notifications->add_user_notification($id, 'Regisztráció állapot változás!',"<b>".$this->session->userdata('username')."</b> elfogadta regisztrációdat! A szerver rangod automatikusan  'Játékos'-ra váltott!", 2);
				$this->notifications->add_admin_notification('Regisztráció állapot változás!',"<b>".$this->session->userdata('username')."</b> elfogadta '".$name."' regisztrációját! A rangja automatikusan  'Játékos'-ra váltott!", 4);
				redirect('adminpanel/registrations');
			}
			if($this->input->post('action') === "refuse") {
				$this->user_model->update_user($id, 'id', 'user_registrations', array('status' => 2));
				$this->user_model->update_user($id, 'id', 'users', array('server_permission' => 0));
				$name = $this->user_model->get_username($id);
				$this->notifications->add_user_notification($id, 'Regisztráció állapot változás!',"<b>".$this->session->userdata('username')."</b> elutasította regisztrációdat!", 3);
				$this->notifications->add_admin_notification('Regisztráció állapot változás!',"<b>".$this->session->userdata('username')."</b> elutasította '".$name."' regisztrációját! Regisztrált IP cím mentve.", 4);
				redirect('adminpanel/registrations');
			}

		}else{
			$this->load->view('templates/header', $header);

			$this->load->view('admin/user_registrations', $data);
	
			$this->load->view('templates/footer');	
		}

	}

	public function create_post() {

        if(!$this->permissions->isAdmin()) {
            redirect('');
        }

		$this->form_validation->set_rules('post_title', 'cím', 'required');
		$this->form_validation->set_rules('post_content', 'tartalom', 'required');

		if($this->form_validation->run() === TRUE) {
			$content = $this->input->post('post_content');
            $title = $this->input->post('post_title');

            $rtime = $this->site_model->get_time();

            $query = $this->site_model->insert('post', array(
                'id' => '',
                'user_id' => $this->session->userdata('user_id'),
                'title' => $title,
                'content' => $content,
                'edited_at' => '',
                'created_at' => $rtime,
                'last_edited_by' => ''
            ));

            if($query) {
                $this->notifications->add_user_notification('all', 'Új hír került kiírásara!',"<b>".$this->session->userdata('username')."</b> egy új bejegyzést írt ki a kezdőlapra! (Cím: ".$title.")", 0);
                $this->notifications->add_admin_notification('Új hír került kiírásra!',"<b>".$this->session->userdata('username')."</b> egy új bejegyzést írt ki a kezdőlapra! A bejegyzést bárki szerkesztheti akinek joga van hozzá! (Cím: ".$title.")", 4);
                $this->popup->set_popup('success', 'Sikeres létrehozás!', 'A hír kiírásra került a kezdőlapon!');
                redirect('home');
            }


		}

		$header["title"] = "Adminpanel - Hír létrehozása";

		$header['permissions'] = $this->permissions->get_permissions();

		$this->load->view('templates/header', $header);

		$this->load->view('admin/create_post');

		$this->load->view('templates/footer');
	}
    public function edit_post($id) {

        if(!$this->permissions->isAdmin()) {
            redirect('');
        }

        if($id == NULL || !is_numeric($id)) {
            redirect('');
        }

        $this->form_validation->set_rules('post_title', 'cím', 'required');
        $this->form_validation->set_rules('post_content', 'tartalom', 'required');

        if($this->form_validation->run() === TRUE) {
            $content = $this->input->post('post_content');
            $title = $this->input->post('post_title');

            $rtime = $this->site_model->get_time();

            $query = $this->site_model->update('post', $id, array(
                'title' => $title,
                'content' => $content,
                'edited_at' => $rtime,
                'last_edited_by' => $this->session->userdata('user_id')
            ));

            if($query) {
                $this->notifications->add_admin_notification('Egy hír szerkesztve lett!',"<b>".$this->session->userdata('username')."</b> szerkesztett egy hírt a kezdőlapon! (Cím: ".$title.")", 4);
                $this->popup->set_popup('success', 'Sikeres mentés!', 'A hír szerkesztve lett!');
                redirect('home');
            }else{
                redirect('home');
            }


        }

        $data['post'] = $this->site_model->select('post', array('id' => $id));

        $header["title"] = "Adminpanel - Hír szerkesztése";

        $header['permissions'] = $this->permissions->get_permissions();

        $this->load->view('templates/header', $header);

        $this->load->view('admin/edit_post',$data);

        $this->load->view('templates/footer');
    }

    public function delete_post($id) {
        if(!$this->permissions->isAdmin()) {
            redirect('');
        }

        if($id == NULL || !is_numeric($id)) {
            redirect('');
        }

        $post = $this->site_model->select('post', array('id' => $id));
        $title = $post['title'];

        $q = $this->site_model->delete('post', $id);

        if($q) {
            $this->notifications->add_admin_notification('Egy hír törölve lett!',"<b>".$this->session->userdata('username')."</b> törölt egy hírt a kezdőlapról! (Cím: ".$title.")", 4);
            $this->popup->set_popup('success', 'Sikeres törlés!', 'A hír törölve lett!');
            redirect('home');
        }else{
            $this->popup->set_popup('form_errors', 'Sikertelen törlés!', 'Váratlan hiba történt!');
            redirect('home');
        }


    }


	public function apitest() {
        require 'vendor/autoload.php';
        $client = new GuzzleHttp\Client();
        $res = $client->request('POST', 'http://localhost/modminers_ci3/api/post', [
            'headers' => [
                'token' => 'asgaghsdhsdh'
            ],
            'form_params' => [
                'token' => '1241235236346'
            ]
        ]);
        echo $res->getBody();
        $array = json_decode($res->getBody(), true);
        echo $array['response_code'];
        echo $array['message'];
    }

    public function set_sign() {
        $this->auth->set_sign($this->session->userdata('user_id'), $this->session->userdata('generated'));
    }

	
}
?>