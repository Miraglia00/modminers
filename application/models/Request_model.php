<?php

class Request_model extends CI_model {

	public function __construct() {
		$this->load->database();
	}

	public function get_intro($id) {

		$query = $this->db->select('introduction')->from('user_registrations')->where("id = ".$id)->get();
		
		return $query->row(0)->introduction;        

	}

}