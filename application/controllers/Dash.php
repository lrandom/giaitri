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
      $this->load->library('form_validation');
    }

    function index(){
      if(isset($_SESSION[LOGIN_KEY_SESSION])){
           redirect(base_url().'dash/welcome');
      }else{
        if(isset($_POST['username']) && isset($_POST['password'])){
          $this->load->library('ultils');
          $username=$this->input->post('username');
          $password=$this->ultils->_encrypt_password($this->input->post('password'));
          $this->load->model('User_model');

          //check exist username and password
          $data=$this->User_model->get_user_by_username_and_password($username,$password);
          if($data!=null){
            //if exist
            $_SESSION[LOGIN_KEY_SESSION]=$data;
            redirect(base_url().'dash/welcome');
          }else{
            //if not exist
            $data['error_msg']='Username và password không đúng, vui lòng thử lại';
          }
        }
        $data['title']='Đăng nhập trang quản trị';
        $this->load->view('back_end/login',$data);
      }
    }

    function welcome(){
      if(isset($_SESSION[LOGIN_KEY_SESSION])){
        $data['title']='Chào mừng bạn đến với trang quản trị hệ thống';
        $this->load->view('back_end/welcome',$data);
      }else{
        redirect(base_url().'dash');
      }
    }

    function login_attempt(){
      $this->load->view('back_end/login_attempt.php');
    }

    function log_out(){
      unset($_SESSION[LOGIN_KEY_SESSION]);
      redirect(base_url().'dash');
    }
  }
  ?>