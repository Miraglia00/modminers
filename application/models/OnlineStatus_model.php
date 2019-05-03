<?php 

	class OnlineStatus_model extends CI_model {

		public function __construct() {
			$this->load->database();
		}

		public function check_os_exists($id) {
			$query = $this->db->get_where('online_status', array('id' => $id));
			if(empty($query->row_array())) {
				return true;
			}else{
				return false;
			}
		}

		public function insert_into($id) {
			$data = array(
				'id' => $id,
				'server_status' => 0,
				'web_status' => 1
			);

			$this->db->where('id', $id);
			$this->db->cache_delete_all();
		}

		public function update($id) {
			$data = array(
				'web_status' => 1
			);
			$this->db->where('id', $id);
			$this->db->update('online_status', $data);
			$this->db->cache_delete_all();
		}

		public function logout($id) {
			$data = array(
				'web_status' => 0
			);
			$this->db->where('id', $id);
			$this->db->update('online_status', $data);
			$this->db->cache_delete_all();
		}

		public function get_status($id) {

			$result = $this->db->get_where('online_status', array('id' => $id));

			$data = array(
				'id' => $result->row(0)->id,
				'server_status' => $result->row(0)->server_status,
				'web_status' => $result->row(0)->web_status
			);

			if($result->num_rows() == 1) {
				return $data;
			}else{
				return false;
			}
		}
	}