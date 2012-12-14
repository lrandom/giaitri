<?php
/**
 *
 */

/*
 permision access_code

 */
class Dash_board extends CI_Controller {

	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Bangkok');
		$this -> load -> library('session');
		$this -> load -> helper('url');
		$this -> load -> database();
		$this -> load -> library('do_upload');
	}

	function index() {
		if ($this -> session -> userdata('loged')) {
			$user_data = $this -> session -> userdata('loged');
			$data['user_name'] = $user_data['user_name'];
			$this -> load -> view('admin/includes/header', $data);
			$this -> load -> view('admin/includes/footer');
		} else {
			$this -> load -> view('admin/login');
		}
	}

	//truy cap tin tuc
	function news() {
		if ($this -> session -> userdata('loged')) {
			$user_data = $this -> session -> userdata('loged');
			$app_access = $user_data['app_access'];
			$data['user_name'] = $user_data['user_name'];
			$this -> load -> view('admin/includes/header', $data);
			foreach ($app_access as $key => $value) {
				if ($key == 'acs_news') {
					$data['perm'] = $value;
					$this -> load -> view('admin/main_container/news_container', $data);
					$this -> load -> view('admin/includes/client_file_side/news');
					break;
				}
			}
			$this -> load -> view('admin/includes/footer');
		} else {
			$this -> load -> view('admin/login');
		}
	}

	//truy cap vai tro
	function role() {
		if ($this -> session -> userdata('loged')) {
			$user_data = $this -> session -> userdata('loged');
			$app_access = $user_data['app_access'];
			$data['user_name'] = $user_data['user_name'];
			$this -> load -> view('admin/includes/header', $data);
			foreach ($app_access as $key => $value) {
				if ($key == 'acs_role') {
					$data['perm'] = $value;
					$this -> load -> view('admin/main_container/role_container', $data);
					$this -> load -> view('admin/includes/client_file_side/role');
					break;
				}
			}
			$this -> load -> view('admin/includes/footer');
		} else {
			$this -> load -> view('admin/login');
		}
	}

	//truy cap ung dung
	function app() {
		if ($this -> session -> userdata('loged')) {
			$user_data = $this -> session -> userdata('loged');
			$app_access = $user_data['app_access'];
			$data['user_name'] = $user_data['user_name'];
			$this -> load -> view('admin/includes/header', $data);
			foreach ($app_access as $key => $value) {
				if ($key == 'acs_role') {
					$data['perm'] = $value;
					$this -> load -> view('admin/main_container/app_container', $data);
					$this -> load -> view('admin/includes/client_file_side/app');
					break;
				}
			}
			$this -> load -> view('admin/includes/footer');
		} else {
			$this -> load -> view('admin/login');
		}
	}

	//truy cap thanh vien
	function member() {
		if ($this -> session -> userdata('loged')) {
			$user_data = $this -> session -> userdata('loged');
			$app_access = $user_data['app_access'];
			$data['user_name'] = $user_data['user_name'];
			$this -> load -> view('admin/includes/header', $data);
			foreach ($app_access as $key => $value) {
				if ($key == 'acs_member') {
					$data['perm'] = $value;
					$this -> load -> view('admin/main_container/member_container', $data);
					$this -> load -> view('admin/includes/client_file_side/member');
					break;
				}
			}
			$this -> load -> view('admin/includes/footer');
		} else {
			$this -> load -> view('admin/login');
		}
	}

	//truy cap chuyen muc
	function subject() {
		if ($this -> session -> userdata('loged')) {
			$user_data = $this -> session -> userdata('loged');
			$app_access = $user_data['app_access'];
			$data['user_name'] = $user_data['user_name'];
			$this -> load -> view('admin/includes/header', $data);
			foreach ($app_access as $key => $value) {
				if ($key == 'acs_subject') {
					$data['perm'] = $value;
					$this -> load -> view('admin/main_container/subject_container', $data);
					$this -> load -> view('admin/includes/client_file_side/subject');
					break;
				}
			}
			$this -> load -> view('admin/includes/footer');
		} else {
			$this -> load -> view('admin/login');
		}
	}

	//truy cap logo
	function logo() {
		if ($this -> session -> userdata('loged')) {
			$user_data = $this -> session -> userdata('loged');
			$app_access = $user_data['app_access'];
			$data['user_name'] = $user_data['user_name'];
			$this -> load -> view('admin/includes/header', $data);
			foreach ($app_access as $key => $value) {
				if ($key == 'acs_logo') {
					$data['perm'] = $value;
					$this -> load -> view('admin/main_container/logo_container', $data);
					$this -> load -> view('admin/includes/client_file_side/logo');
					break;
				}
			}
			$this -> load -> view('admin/includes/footer');
		} else {
			$this -> load -> view('admin/login');
		}
	}

	//truy cap banner
	function banner() {
		if ($this -> session -> userdata('loged')) {
			$user_data = $this -> session -> userdata('loged');
			$app_access = $user_data['app_access'];
			$data['user_name'] = $user_data['user_name'];
			$this -> load -> view('admin/includes/header', $data);
			foreach ($app_access as $key => $value) {
				if ($key == 'acs_adver') {
					$data['perm'] = $value;
					$this -> load -> view('admin/main_container/adver_container', $data);
					$this -> load -> view('admin/includes/client_file_side/adver');
					break;
				}
			}
			$this -> load -> view('admin/includes/footer');
		} else {
			$this -> load -> view('admin/login');
		}
	}

	//truy cap file
	function file_manager() {
		if ($this -> session -> userdata('loged')) {
			$user_data = $this -> session -> userdata('loged');
			$app_access = $user_data['app_access'];
			$data['user_name'] = $user_data['user_name'];
			$this -> load -> view('admin/includes/header', $data);
			foreach ($app_access as $key => $value) {
				if ($key == 'acs_file_manager') {
					$data['perm'] = $value;
					$this -> load -> view('admin/main_container/file_manager_container', $data);
					$this -> load -> view('admin/includes/client_file_side/adver');
					break;
				}
			}
			$this -> load -> view('admin/includes/footer');
		} else {
			$this -> load -> view('admin/login');
		}
	}

	//end truy cap file

	//truy cap binh luan
	function comment() {
		if ($this -> session -> userdata('loged')) {
			$user_data = $this -> session -> userdata('loged');
			$app_access = $user_data['app_access'];
			$data['user_name'] = $user_data['user_name'];
			$this -> load -> view('admin/includes/header', $data);
			foreach ($app_access as $key => $value) {
				if ($key == 'acs_comment') {
					$data['perm'] = $value;
					$this -> load -> view('admin/main_container/comment_container', $data);
					$this -> load -> view('admin/includes/client_file_side/comment');
					break;
				}
			}
			$this -> load -> view('admin/includes/footer');
		} else {
			$this -> load -> view('admin/login');
		}
	}

	//truy cap lien he
	function contact() {
		if ($this -> session -> userdata('loged')) {
			$this -> load -> view('admin/includes/header');
			$this -> load -> view('admin/main_container/contact_container');
			$this -> load -> view('admin/includes/client_file_side/contact');
			$this -> load -> view('admin/includes/footer');
		} else {
			$this -> load -> view('admin/login');
		}
	}

	//truy cap thong tin toa soan
	function company_infor() {

	}

	//truy cap quang cao
	function adver_infor() {
		if ($this -> session -> userdata('loged')) {
			$this -> load -> view('admin/includes/header');
			$this -> load -> model('info');
			$data['infor'] = $this -> info -> get_adver();
			$this -> load -> view('admin/main_container/adver_infor', $data);
			$this -> load -> view('admin/includes/footer');
		} else {
			$this -> load -> view('admin/login');
		}
	}

	//truy cap dieu kien thoa thuan
	function term_infor() {
		if ($this -> session -> userdata('loged')) {
			$this -> load -> view('admin/includes/header');
			$this -> load -> model('info');
			$data['infor'] = $this -> info -> get_term();
			$this -> load -> view('admin/main_container/term_infor', $data);
			$this -> load -> view('admin/includes/footer');
		} else {
			$this -> load -> view('admin/login');
		}
	}

	//dang xuat
	function logout() {
		$this -> session -> unset_userdata('loged');
		$this -> load -> view('admin/login');
	}

	//dang xuat
	function do_logout() {
		$this -> session -> unset_userdata('loged');
		$this -> load -> view('admin/login');
	}

	//check out login
	function check_login() {
		if (isset($_POST)) {
			header('Content-type: application/json');
			$user_name = $this -> input -> post('user_name');
			$pass_word = $this -> input -> post('pass_word');
			$this -> load -> model('user');
			$count = $this -> user -> check_exist_user($user_name, md5(md5(md5($pass_word))));
			if ($count > 0) {
				$data = $this -> user -> get_user_by_user_name($user_name);
				$user = array('user_name' => $user_name, 'role_id' => $data[0] -> cls_idRole, 'user_id' => $data[0] -> cls_idMember, 'user_name' => $data[0] -> cls_userName);
				$this -> load -> model('role_perm');
				$role_perm = $this -> role_perm -> get_role_perm_with_role_id($data[0] -> cls_idRole, TRUE);
				$app_access = array();
				foreach ($role_perm as $r) {
					$app_access[$r -> cls_code] = $r -> cls_perm;
				}
				$user['app_access'] = $app_access;
				$this -> session -> set_userdata('loged', $user);

				//update data for user
				$curr_date = date('Y-m-d H:i:s', time());
				$data_array = array('cls_lastLogin' => $curr_date, 'cls_ipAddress' => $this -> input -> ip_address());
				$array_where = array('cls_idMember' => $user['user_id']);
				$this -> user -> update_user($data_array, $array_where);
				echo json_encode(array('ok' => 1));

			} else {
				echo json_encode(array('ok' => 0));
			}
		}	}

	function change_pass() {
		if ($this -> session -> userdata('loged')) {
			$this -> load -> view('admin/includes/header');
			$this -> load -> view('admin/change_pass_container');
			$this -> load -> view('admin/includes/footer');
		} else {
			$this -> load -> view('admin/login');
		}
	}

}
?>
