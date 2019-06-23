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
        return $token;
    }

    function siteURL() {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'] . '/';
        if($domainName == 'localhost/' || $domainName == '192.168.0.45/') {
            return $protocol . $domainName."modminers/";
        }else{
            return $protocol . $domainName;
        }
    }

}
