<?php
/**
 *
 */
class Logo extends CI_Controller {

	function __construct() {
		parent::__construct();
		session_start();
		date_default_timezone_set('Asia/Bangkok');
		$this -> load -> model('Logo_model');
	}

	function index() {

	}

}
?>