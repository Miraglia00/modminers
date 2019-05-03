<?php 

	class SendEmail extends CI_Controller {

		public function index() {
            $CI=& get_instance();
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.googlemail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'infomodminers@gmail.com';
            $config['smtp_pass']    = '1-2-3-4-5-ModMiners-6-7-8-9';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html';
            $config['validation'] = FALSE;

            $CI->email->initialize($config);
            $CI->email->from('info@mail.com', 'admin ');
            $CI->email->to('neo2000hun@gmail.com');
            $CI->email->subject('Email Test');
            $CI->email->message('Testing email send');

            $result = $CI->email->send();
            var_dump($CI->email->print_debugger());
		}
	}