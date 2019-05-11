<?php

class Auth
{
    public function __construct()
    {
        $that=& get_instance();
    }

    public function set_sign($generated) {
        $that=& get_instance();
        $data = $that->site_model->select('users', array('id' => $that->session->userdata('user_id')));
        $user_code = $data['code'];
        $token = hash('sha256', $user_code.$generated);
    }

}
