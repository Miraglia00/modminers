<?php

/**
* Class user_model
* @property   User_model $register
*/

	class User_model extends CI_model {

		public function __construct() {
			$this->load->database();
		}
		public function register($password, $beta=NULL, $code=NULL) {

			//POST értékeit tömbbe helyezzük
			if($beta === true) {
				$data = array(
					'username' => html_escape($this->input->post('username')),
					'email' => 'betatester@modminers.hu',
					'image_url' => 'default',
					'password' => $password,
					'server_permission' => 4,
					'code' => $code
				);

				$this->db->insert('users', $data);
				$dbid = $this->db->insert_id();

				$beta_data = array(
					'id' => $dbid,
					'username' => html_escape($this->input->post('username')),
					'status' => "0",
				);
				$this->db->insert('tester_accounts', $beta_data);
			}else{
                $s = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ=%", 15)), 0, 15);
				$data = array(
					'username' => html_escape($this->input->post('username')),
					'email' => mb_convert_encoding($this->input->post('email'), "UTF-8"),
					'image_url' => 'default',
					'password' => $password,
                    'code' => $s
				);
	
				$this->db->insert('users', $data);
	
				$dbid = $this->db->insert_id();

				$user_list = array(
					'id' => $dbid,
					'username' => html_escape($this->input->post('username')),
				);
				$this->db->insert('user_list', $user_list);
	
				$user_settings = array(
					'id' => $dbid,
					'email' => "0",
					'image' => "0",
				);
				$this->db->insert('user_settings', $user_settings);
	
				$user_status = array(
					'id' => $dbid,
					'server_status' => "0",
					'web_status' => "0",
				);
				$this->db->insert('online_status', $user_status);
	
				//0-pending, 1-accepted, 2-declined
				$user_registration = array(
					'id' => $dbid,
					'introduction' => html_escape($this->input->post('introduction')),
					'status' => 0,
				);
				$this->db->insert('user_registrations', $user_registration);
			}

			return $this->db->cache_delete_all();

		}
		public function user_exists($id) {
	
			$query = $this->db->get_where('users', array('id' => $id));

			if(empty($query->row_array())) {
				return false;
			}else{
				return true;
			}
		}
		//User controllerből meghívott, adatbázissal kommunikáló szimpla SELECT WHERE query-vel név létezés lekérdezése.
		public function check_username_exists($username) {
			//Query beállítása, username mezőben keressük a paraméterként megadott $username változóval.
			$query = $this->db->get_where('users', array('username' => $username));
			// Ha üres sort talált vagyis nem talált egyezést akkor TRUE-t ad vissza ha talált egyezést akkor FALSE-t.
			if(empty($query->row_array())) {
				return true;
			}else{
				return false;
			}
		}
		//Név lekérdezésen alapuló email checkoló.
		public function check_email_exists($email) {
			$query = $this->db->get_where('users', array('email' => $email));
			if(empty($query->row_array())) {
				return true;
			}else{
				return false;
			}
		}
		//Login function
		public function login($username, $password) {
			$result = $this->db->get_where('users', "username = '$username' AND password = '$password'");

			if($result->num_rows() == 1) {
			    $id = $result->row(0)->id;
			    $res = $this->db->get_where('user_registrations', "id = '$id' AND status = 1");
                if($res->num_rows() == 1) {
				    return $id;
                }else{
                    return "not_activated";
                }
			}else{
				return false;
			}
		}

		public function get_user_data($id) {

			$result = $this->db->get_where('users', array('id' => $id));

			if($result->num_rows() == 1) {

				$birth_date = new DateTime($result->row(0)->birth_date);
				$today = new DateTime('today');
				$age = $birth_date->diff($today)->y;

				$userdata = array(
					'id' => $result->row(0)->id,
					'username' => $result->row(0)->username,
					'server_permission' => $result->row(0)->server_permission,
					'web_permission' => $result->row(0)->web_permission,
					'email' => $result->row(0)->email,
					'image_url' => $result->row(0)->image_url,
					'reg_date' => $result->row(0)->register_date,
					'b_date' => $result->row(0)->birth_date,
					'age' => $age,
					'last_activity' => $result->row(0)->last_activity
				);
				return $userdata;

			}else{
				return false;
			}

		}

		public function my_profile() {
			$id = $this->session->userdata('user_id');
			$result = $this->db->get_where('users', array('id' => $id));

			if($result->num_rows() == 1) {

				$birth_date = new DateTime($result->row(0)->birth_date);
				$today = new DateTime('today');
				$age = $birth_date->diff($today)->y;
	
				$userdata = array(
					'id' => $result->row(0)->id,
					'username' => $result->row(0)->username,
					'server_permission' => $result->row(0)->server_permission,
					'web_permission' => $result->row(0)->web_permission,
					'email' => $result->row(0)->email,
					'image_url' => $result->row(0)->image_url,
					'reg_date' => $result->row(0)->register_date,
					'b_date' => $result->row(0)->birth_date,
					'age' => $age,
					'last_activity' => $result->row(0)->last_activity
				);

				return $userdata;

			}else{
				return false;
			}
		}

		public function list_users($param = NULL) {

			if($param === NULL) {
				$query = $this->db->get('users');
				return $query->result_array();
			}else{
				$query = $this->db->get_where('users', $param);
				return $query->result_array();
			}


		}

		public function search($query) {
			$this->db->like('username', $query);
			return $this->db->get('user_list');

		}

		public function get_user_settings($dbid) {

			$result = $this->db->get_where('user_settings', array('id' => $dbid));

			$usersettings = array(
				'email' => $result->row(0)->email,
				'image' => $result->row(0)->image
			);

			if($result->num_rows() == 1) {
				return $usersettings;
			}else{
				return false;
			}
		}

		public function update_user($id, $key_col, $table, $data) {
			$this->db->where($key_col, $id);
			$result = $this->db->update($table, $data);

			$this->db->cache_delete_all();

			if($result) {
				return true;
			}else{
				return false;
			}

		}

		public function get_user_id($username) {

			$result = $this->db->get_where('users', array('username' => $username));

			if($result) {
				return $result->row(0)->id;
			}else{
				return false;
			}
		}

		public function get_where($table, $param) {

			$query = $this->db->get_where($table, $param);
			return $query->result_array();
		}

		public function custom($sql) {
			
			$query = $this->db->query($sql);
			$this->db->cache_delete_all();
			return $query->result_array();
		}

		public function create_beta($data) {

			return $this->db->insert('users', $data);
			
		}

		public function get_username($id) {
			$result = $this->db->get_where('users', array('id' => $id));

			if($result) {
				return $result->row(0)->username;
			}else{
				return false;
			}
		}

	}