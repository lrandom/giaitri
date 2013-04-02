<?php
  /**
  * 
  */
  class Dash extends CI_Controller 
  {
  	
  	function __construct()
  	{
  		parent::__construct();
      session_start();
    }

    function index(){
      if(isset($_SESSION[SESS_LOGIN_KEY])){
        //load welcome 
      }else{

        $this->load->view('back_end/login.php');
      }
    }

    function login_attempt(){
      $this->load->view('back_end/login_attempt.php');
    }

    function check_login(){
      
    }
  }
  ?>