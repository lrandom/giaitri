<?php
 /**
 * 
 */
 class Captcha extends CI_Controller
 {
 	const COMMENT_KEY='captcha_comment';
 	const LOGIN_ATTEMPT_KEY='captcha_login_attemps';

 	function __construct()
 	{
 		parent::__construct();
 		$this -> load -> library('gen_captcha');
 	}

 	function index(){
 	}


 	function load_captcha_login_attempts(){
 		$captcha=new gen_captcha();
 		$code=$captcha->export(120,40,6,self::LOGIN_ATTEMPT_KEY);
 	}

 	function load_captcha_comment(){
 		$captcha = new gen_captcha();
 		$code = $captcha -> export(120,40,6,self::COMMENT_KEY);
 	}

 	function check_captcha_comment() {
 		if (isset($_POST['captcha'])) {
 			$code = $this -> session -> userdata(self::COMMENT_KEY);
 			if ($code == $this -> input -> post('captcha')) {
 				echo json_encode(array('ok' => 1));
 			} else {
 				echo json_encode(array('ok' => 0));
 			}
 		}
 	}
 }
 ?>