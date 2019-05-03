<?php

class Auth
{
    public function __construct()
    {
        $that=& get_instance();
    }

    public function set_sign($user_id, $generated) {
        $that=& get_instance();
        $user_code = $that->site_model->select('users', array(user_id => $user_id));
        echo $user_code['code'];
    }

}
