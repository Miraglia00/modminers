<?php

class Notification_model extends CI_model {

	public function __construct() {
		$this->load->database();
	}

	public function add_user_notification($id,$title,$message,$type){

	    $time = $this->site_model->get_time();

	    if($id === 'all') {
            $ids = $this->get_users_id();
            $count = count($ids);
            $x=0;

            while($x <= $count-1) {
                $id = $ids[$x];

                $data[] =
                    array(
                        'user_id' => $id,
                        'title' => $title,
                        'message' => $message,
                        'type' => $type,
                        'date' => $time
                    );
                $x++;
            }

            $this->db->insert_batch('user_notifications', $data);
            return $this->db->cache_delete_all();
        }else{
            $user_notification = array(
                'user_id' => $id,
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'date' => $time
            );

            $this->db->insert('user_notifications', $user_notification);
            $this->db->cache_delete_all();
        }
	}

	public function get_user_notifications($id) {
		$this->db->limit(5);
		$this->db->order_by('date', 'DESC');
		$query = $this->db->select('*')->from('user_notifications')->where("user_id = ".$id." AND read = 0")->get();
		return $query->result_array();
	}

	public function get_all_user_notifications($id) {
		$this->db->order_by('read ASC, date DESC');
		$query = $this->db->select('*')->from('user_notifications')->where("user_id = ".$id)->get();
		return $query->result_array();
	}

	public function count_unread_user_notifications($id) {
		//Szeméyles értesítés
		$this->db->from('user_notifications');
		$this->db->where("user_id = ".$id." AND read = 0");
		return $this->db->count_all_results();
	}

	public function is_read($userid, $id) {
		$this->db->from('user_notifications');
		$this->db->where("id = ".$id." AND user_id = ".$userid." AND read = 1");
		$query = $this->db->get();
		if($query == NULL) {
			return 1;
		}else{
			return 0;
		}	
	}

	public function dismiss_user_notification($userid,$id){
		$this->db->set('read', '1');
		$this->db->where("user_id = ".$userid." AND id = ".$id);
		$this->db->update('user_notifications');
		return $this->db->cache_delete_all();
	}

	public function dismiss_all_user_notification($userid){
		$this->db->set('read', '1');
		$this->db->where("user_id = ".$userid);
		$this->db->update('user_notifications');
		return $this->db->cache_delete_all();
	}

	public function get_admins_id() {

		$query = $this->db->select('id')->from('users')->where("web_permission > 1")->get();
		$x = 0;
		foreach ($query->result() as $row):
			$admins[$x++] = $row->id;
		endforeach;
		
		return $admins;        

	}

    public function get_users_id() {

        $query = $this->db->select('id')->from('users')->where("server_permission <> 4")->get();
        $x = 0;
        foreach ($query->result() as $row):
            $users[$x++] = $row->id;
        endforeach;

        return $users;

    }

	public function add_admin_notification($title,$message,$type){
		$time = date('Y-m-d H:i:s');
		$ids = $this->get_admins_id();
		$count = count($ids);
		$x=0;

		while($x <= $count-1) {
			$id = $ids[$x];
            $data[] =
                array(
                    'user_id' => $id,
                    'title' => $title,
                    'message' => $message,
                    'type' => $type,
                    'date' => $time
                );
			$x++;
		}

        $this->db->insert_batch('user_notifications', $data);
		return $this->db->cache_delete_all();
	}
}