<?php 
	class Popup {

	function __construct() {
            $CI=& get_instance();
        }

	public function set_popup($id, $title=NULL, $message=NULL) {
              
		  $CI=& get_instance();
		  
		  if($message === NULL) {
				return $CI->session->set_flashdata($id, $title); 
		  }else{
				return $CI->session->set_flashdata($id, "<b>".$title."</b> <br />".$message);
		  }
        
	}

	}