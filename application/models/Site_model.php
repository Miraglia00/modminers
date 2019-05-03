<?php 

	class Site_model extends CI_model {

		function __construct() {
			$this->load->database();
		}

		function getAll($table, $order_by=NULL) {

            if($order_by != NULL) {
                $this->db->order_by($order_by);
            }

			$q = $this->db->get($table);


			if($q->num_rows() > 0) {

				foreach ($q->result_array() as $row) {
					$data[] = $row;
				}

				return $data;
			}else{
				return "A tábla üres.";
			}
		}

		function select($table, $array) {
			$this->db->select($array);			
			$q = $this->db->get($table);

			if($q->num_rows() > 0) {

				foreach ($q->result() as $row) {
					$data[] = $row;
				}

				return $data;
			}else{
				return "A tábla üres.";
			}
		}

        function insert($table, $array) {
            $query = $this->db->insert($table, $array);
            return $query;
        }

        function get_time() {
            $datestring = '%Y-%m-%d %H:%i';
            $time = time();
            return mdate($datestring, $time);
        }

	}