<?php
  /**
  * 
  */
  class Dash extends CI_Controller 
  {
    const COOKIE_TOKEN_KEY='remember_me_token';
    const COOKIE_USER_NAME='username';
    const COOKIE_PASSWORD ='password';	
    const LOGIN_ATTEMPT_KEY='captcha_login_attemps';
    const LOGIN_ATTEMPT_USER_NAME='';
    function __construct()
    {
      parent::__construct();
      session_start();
      date_default_timezone_set('Asia/Bangkok');
      $this->load->library('form_validation');
      $this->load->library('ultils');
    }

    function index(){
      //if user login attempt
      if(isset($_SESSION[self::LOGIN_ATTEMPT_USER_NAME])){
        redirect(base_url().'dash/login_attempts');
      }

      //if user has session
      if(isset($_SESSION[LOGIN_KEY_SESSION])){
        redirect(base_url().'dash/welcome');
      }
      //end

      //if remember me 
      if(isset($_COOKIE[self::COOKIE_TOKEN_KEY])){
        if($this->ultils->validate_remember_me_token($_COOKIE[self::COOKIE_TOKEN_KEY],$_COOKIE[self::COOKIE_USER_NAME],$_COOKIE[self::COOKIE_PASSWORD])){
          $this->load->model('User_model');
          $data=$this->User_model->get_user_by_username_and_password(
            $_COOKIE[self::COOKIE_USER_NAME],
            $_COOKIE[self::COOKIE_PASSWORD]
            );
          if($data){
            $_SESSION[LOGIN_KEY_SESSION]=$data;
            $data_array=array(      
              'last_login'=>date('Y-m-d H:i:s',time()),
              'ip_address'=>$_SERVER['REMOTE_ADDR']
              );
            $this->User_model->update_user_by_id($data[0]->id,$data_array);
            redirect(base_url().'dash/welcome');
          }
        }
      }
      //end

      //if not remember me 
      if(isset($_POST['username']) && isset($_POST['password']) && !isset($_SESSION[LOGIN_KEY_SESSION])){
        $username=$this->input->post('username');
        $password=$this->ultils->_encrypt_password($this->input->post('password'));
        $this->load->model('User_model');

        //check exist username and password
        $data=$this->User_model->get_user_by_username_and_password($username,$password);
        if($data!=null){
          //if exist
          $_SESSION[LOGIN_KEY_SESSION]=$data;
          $data_array=array(      
            'last_login'=>date('Y-m-d H:i:s',time()),
            'ip_address'=>$_SERVER['REMOTE_ADDR']
            );
          $this->User_model->update_user_by_id($data[0]->id,$data_array);
          //if checked remember login
          if(isset($_POST['remember_me'])){
            $token=$this->ultils->_generate_remember_me_token($username,$password);
            $expr_time=time()+60*60*24*30; //1 year
            setcookie(self::COOKIE_USER_NAME,$username,$expr_time,'/');
            setcookie(self::COOKIE_PASSWORD,$password,$expr_time,'/');
            setcookie(self::COOKIE_TOKEN_KEY,$token,$expr_time,'/');
          }
          //end check
          redirect(base_url().'dash/welcome');
        }else{
          //if not exist
          $this->load->model('login_attempts_model');
          $this->login_attempts_model->insert_login_attempts(
            array(
              'user_name'=>$username,
              'ip_address'=>$_SERVER['REMOTE_ADDR'],
              'time'=>date('Y-m-d H:i:s',time())
              )
            );
          $where=array(
            'time > '=>date('Y-m-d H:i:s',strtotime('-15 minutes')),
            'ip_address'=>$_SERVER['REMOTE_ADDR'],
            'user_name'=>$username
            );

          $attempts=$this->login_attempts_model->total($where, array());
          if($attempts > MAX_LOGIN_ATTEMPTS){
            $_SESSION[self::LOGIN_ATTEMPT_USER_NAME]=$username;
            redirect(base_url().'dash/login_attempts');
          }
          $data['error_msg']='Tên đăng nhập và mật khẩu không đúng, vui lòng nhập đúng!';
        }
      }

      $data['title']='Đăng nhập trang quản trị';
      $this->load->view('back_end/login',$data);
      //end 
    }

    function login_attempts(){
      if(isset($_SESSION[self::LOGIN_ATTEMPT_USER_NAME])){
        if(isset($_POST['captcha_code'])){
          $code = $this->session->userdata(self::LOGIN_ATTEMPT_KEY);
          if ($code == $this -> input -> post('captcha_code')) {
            $this->load->model('login_attempts_model');
            $username=$_SESSION[self::LOGIN_ATTEMPT_USER_NAME];
            $ip=$_SERVER['REMOTE_ADDR'];
            $this->login_attempts_model->remove_login_attempts_by_user_name_and_ip($username,$ip);
            unset($_SESSION[self::LOGIN_ATTEMPT_USER_NAME]);
            redirect(base_url().'dash');
          }
        }
        
        $data['title']='Xác nhận hệ thống';
        $this->load->view('back_end/login_attempt.php',$data);
      }else{
        redirect(base_url().'dash');
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


    function log_out(){
      if(isset($_SESSION[LOGIN_KEY_SESSION])){
        unset($_SESSION[LOGIN_KEY_SESSION]);
      }
      if(isset($_COOKIE[self::COOKIE_TOKEN_KEY])){
        setcookie(self::COOKIE_TOKEN_KEY,"",time()-3600,'/');
      }
      if(isset($_COOKIE[self::COOKIE_USER_NAME])){
        setcookie(self::COOKIE_USER_NAME,"", time()-3600,'/');
      }
      if(isset($_COOKIE[self::COOKIE_PASSWORD])){
        setcookie(self::COOKIE_PASSWORD,"", time()-3600,'/');
      }
      redirect(base_url().'dash');
    }
  }
  ?>