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

 	function load_captcha_comment(){
 		$captcha = new gen_captcha();
 		$code = $captcha -> export(120,40,6,$this::COMMENT_KEY);
 	}

 	function check_captcha_login_attempts(){
 		if(isset($_POST['captcha_code'])){
 			$code = $this->session->userdata($this::LOGIN_ATTEMPT_KEY);
 			if ($code == $this -> input -> post('captcha_code')) {
 				redirect(base_url().'dash');
 			}else{
 				redirect(base_url().'login_attempt');
 			}
 		}
 	}

 	function load_captcha_login_attempts(){
 		$captcha=new gen_captcha();
 		$code=$captcha->export(120,40,6,$this::LOGIN_ATTEMPT_KEY);
 	}

 	function check_captcha_comment() {
 		if (isset($_POST['captcha'])) {
 			$code = $this -> session -> userdata($this::COMMENT_KEY);
 			if ($code == $this -> input -> post('captcha')) {
 				echo json_encode(array('ok' => 1));
 			} else {
 				echo json_encode(array('ok' => 0));
 			}
 		}
 	}

 }
 ?>