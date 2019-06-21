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
				return false;
			}
		}

		function select($table, $array) {
			$q = $this->db->get_where($table,$array);

			if($q->num_rows() > 0) {

				foreach ($q->result_array() as $row) {
					$data = $row;
				}

				return $data;
			}else{
				return false;
			}
		}
        function update($table, $id, $array) {
            $this->db->set($array);
            $this->db->where('id', $id);
            $q =  $this->db->update($table);

                if($q) {
                    return true;
                }else{
                    return false;
                }
        }

        function delete($table, $id) {
            $this->db->where('id', $id);
            $q = $this->db->delete($table);

            if($q) {
                return true;
            }else{
                return false;
            }
        }


        function insert($table, $array) {
            $query = $this->db->insert($table, $array);
            return $query;
        }

        function insert_multiple($table, $array) {
            $query = $this->db->insert_batch($table, $array);
            return $query;
        }

        function get_time() {
            $datestring = '%Y-%m-%d %H:%i';
            $time = time();
            return mdate($datestring, $time);
        }

	}