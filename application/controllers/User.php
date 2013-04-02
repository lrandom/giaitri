<?php
/**
 *
 */
class User extends CI_Controller {

	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Bangkok');
	}

	function index() {
		$this -> load -> model('User_model');
		$where = array();
		$like = array();
		if ($this -> input -> get('action')) {
			$action = $this -> input -> get('action');
			switch ($action) {
				case 'delete' :
					$id = intval($this -> input -> get('id'));
					if ($id) {
						$this -> load -> model('User_model');
						$this -> User_model -> remove_user_by_id($id);
						$data['alert_state'] = ALERT_STATE_SUCCESS;
						$data['alert_msg'] = DEL_SUCCESS_MSG;
					}
					break;

				default :
					break;
			}
		}

		if ($this -> input -> get('show')) {
			$show = $this -> input -> get('show');
			switch ($show) {
				case 'actived' :
					$where['users.state'] = ACTIVED_STATE;
					break;

				case 'disabled' :
					$where['users.state'] = DISABLED_STATE;
					break;

				case 'reg_today' :
					$where['date(last_login)'] = date('Y-m-d', time());
					break;

				case 'sig_today' :
					$where['date(date_join)'] = date('Y-m-d', time());
					break;
				default :
					break;
			}
		}

		if ($this -> input -> get('key_q') && $this -> input -> get('q')) {
			$key_q = $this -> input -> get('key_q');
			$q = $this -> input -> get('q');
			switch ($key_q) {
				case 'id' :
					$where['users.id'] = $q;
					break;

				case 'user_name' :
					$like['name'] = $q;
					break;

				case 'full_name' :
					$like['full_name'] = $q;
					break;

				case 'email' :
					$like['email'] = $q;
					break;

				case 'phone' :
					$like['phone'] = $q;
					break;

				default :
					break;
			}
		}

		$where['role_id <>'] = HIGHEST_ROLE_ID;
		//config and init pagination
		$config = array();
		$config['total_rows'] = $this -> User_model -> total($where, $like);
		//end config and init pagination

		$page = $this -> input -> get('page') ? $this -> input -> get('page') : 1;
		$order = $this -> input -> get('order') ? $this -> input -> get('order') : 'ASC';
		$per_page = $this -> input -> get('per_page') ? $this -> input -> get('per_page') : 5;

		$data['user_list'] = $this -> User_model -> get_user("*", $where, $like, ($page - 1) * $per_page, $per_page, array('users.id' => $order));
		$data['base_url'] = base_url() . 'admin/dash_board/user/?order=' . $order;
		$data['sort'] = $order;
		$data['next_sort'] = $order == 'ASC' ? 'DESC' : 'ASC';

		$config['base_url'] = $data['base_url'];
		$config['per_page'] = $per_page;
		$this -> pagination -> initialize($config);
		$data['page_link'] = $this -> pagination -> create_links();
		$data['title'] = "Người dùng";
		$data['add_link'] = base_url() . 'user/add';
		$data['title'] = 'Quản lí người dùng';
		$this -> load -> view('back_end/main_user', $data);
	}

	function add() {
		if (isset($_POST['txtFullName'])) {
			$txtFullName = $this -> input -> post('txtFullName');
			$txtUserName = $this -> input -> post('txtUserName');
			$txtPassWord = md5(md5($this -> input -> post('txtPassWord')));
			$txtPhone = $this -> input -> post('txtPhone');
			$txtEmail = $this -> input -> post('txtEmail');
			$txtRole = $this -> input -> post('txtRole');
			$this -> load -> model('User_model');
			$data_array = array('role_id' => $txtRole, 'full_name' => $txtFullName, 'user_name' => $txtUserName, 'pass' => $txtPassWord, 'email' => $txtEmail, 'phone' => $txtPhone, 'address_ip' => $this -> input -> ip_address(), 'date_join' => date('Y-m-d H:i:s', time()));
			$this -> User_model -> insert_user($data_array);
			$data['alert_state'] = ALERT_STATE_SUCCESS;
			$data['alert_msg'] = ADD_SUCCESS_MSG;
		}
		$this -> load -> model('Role_model');
		$data['role'] = $this -> Role_model -> get_role('*', array(), array(), 0, 100, array());
		$data['title'] = "Thêm người dùng mới";
		$this -> load -> view('back_end/form/frmAddUser', $data);
	}

	function edit() {
		if ($this -> uri -> segment(3)) {
			$id = intval($this -> uri -> segment(3));
			if ($id) {
				$this -> load -> model('User_model');
				if (isset($_POST['txtFullName'])) {
					$full_name = $this -> input -> post('txtFullName');
					$email = $this -> input -> post('txtEmail');
					$phone = $this -> input -> post('txtPhone');
					$role_id = $this -> input -> post('txtRole');
					$state = $this -> input -> post('txtState');
					$this -> User_model -> update_user(array('full_name' => $full_name, 'email' => $email, 'phone' => $phone, 'role_id' => $role_id, 'state' => $state), array('id' => $id));
					$data['alert_state'] = ALERT_STATE_SUCCESS;
					$data['alert_msg'] = EDIT_SUCCESS_MSG;
				}
				$data['user'] = $this -> User_model -> get_user_by_id($id);
				$this -> load -> model('Role_model');
				$data['role'] = $this -> Role_model -> get_role('*', array(), array(), 0, 100, array());
				if ($data['user'] != null && $data['role'] != null) {
					$data['title'] = 'Thay đổi thông tin thành viên';
					$this -> load -> view('back_end/form/frmEditUser', $data);
				}
			}
		}
	}

	function blockUser() {

	}

	function checkEmailExist() {
		if (isset($_POST['txtEmail'])) {
			$this -> load -> model("User_model");
			$email = $this -> input -> post('txtEmail');
			$data = $this -> User_model -> get_user("*", array('email' => $email), array(), 0, 10, array());
			if ($data != null) {
				echo "false";
			} else {
				echo "true";
			}
		} else {
			echo "false";
		}
	}

	function checkPhoneExist() {
		if (isset($_POST['txtPhone'])) {
			$this -> load -> model("User_model");
			$phone = $this -> input -> post('txtPhone');
			$data = $this -> User_model -> get_user("*", array('phone' => $phone), array(), 0, 10, array());
			if ($data != null) {
				echo "false";
			} else {
				echo "true";
			}
		} else {
			echo "false";
		}
	}

	function checkUserExist() {
		if (isset($_POST['txtUserName'])) {
			$this -> load -> model("User_model");
			$username = $this -> input -> post('txtUserName');
			$data = $this -> User_model -> get_user("*", array('user_name' => $username), array(), 0, 10, array());
			if ($data != null) {
				echo "false";
			} else {
				echo "true";
			}
		} else {
			echo "false";
		}
	}

	function checkEmailExistEdit() {
		if (isset($_POST['txtEmail'])) {
			$this -> load -> model("User_model");
			$email = $this -> input -> post('txtEmail');
			$id = $this -> input -> post('id');
			$data = $this -> User_model -> get_user("*", array('email' => $email, 'users.id <>' => $id), array(), 0, 10, array());
			if ($data != null) {
				echo "false";
			} else {
				echo "true";
			}
		} else {
			echo "false";
		}
	}

	function checkPhoneExistEdit() {
		if (isset($_POST['txtPhone'])) {
			$this -> load -> model("User_model");
			$phone = $this -> input -> post('txtPhone');
			$id = $this -> input -> post('id');
			$data = $this -> User_model -> get_user("*", array('phone' => $phone, 'users.id <>' => $id), array(), 0, 10, array());
			if ($data != null) {
				echo "false";
			} else {
				echo "true";
			}
		} else {
			echo "false";
		}
	}

}
?>