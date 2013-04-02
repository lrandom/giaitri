<?php
/**
 *
 */
class Role extends CI_Controller {

	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Bangkok');
	}

	function index() {
		$this -> load -> model('Role_model');
		$where = array();
		$like = array();
		if ($this -> input -> get('action')) {
			$action = $this -> input -> get('action');
			switch ($action) {
				case 'delete':
					$id = intval($this -> input -> get('id'));
					if ($id) {
						if ($id != LOWEST_ROLE_ID && $id != HIGHEST_ROLE_ID) {
							$this -> load -> model('User_model');
							$this -> User_model -> remove_user(array('role_id' => $id));
							$this -> load -> model('Perm_model');
							$this -> Perm_model -> remove_perm(array('role_id' => $id));
							$this -> Role_model -> remove_role_by_id($id);
							$data['alert_state'] = ALERT_STATE_SUCCESS;
							$data['alert_msg'] = DEL_SUCCESS_MSG;
						} else {
							$data['alert_state'] = ALERT_STATE_INFO;
							$data['alert_msg'] = BASE_USER_MSG_WARRNING;
						}
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
					$where['state'] = ACTIVED_STATE;
					break;

				case 'disabled' :
					$where['state'] = DISABLED_STATE;
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
					$where['id'] = $q;
					break;

				case 'name' :
					$like['name'] = $q;
					break;
				default :
					break;
			}
		}

		$page = $this -> input -> get('page') ? $this -> input -> get('page') : 1;
		$order = $this -> input -> get('order') ? $this -> input -> get('order') : 'ASC';
		$per_page = $this -> input -> get('per_page') ? $this -> input -> get('per_page') : 5;

		$data['role_list'] = $this -> Role_model -> get_role("*", $where, $like, ($page - 1) * $per_page, $per_page, array('id' => $order));
		$data['base_url'] = base_url() . 'admin/dash_board/role/?order=' . $order;
		$data['sort'] = $order;
		$data['next_sort'] = $order == 'ASC' ? 'DESC' : 'ASC';

		//pagination
		$config['base_url'] = $data['base_url'];
		$config['per_page'] = $per_page;
		$config = array();
		$config['total_rows'] = $this -> Role_model -> total(array(), array());
		$this -> pagination -> initialize($config);
		$data['page_link'] = $this -> pagination -> create_links();
		//end pagination

		$data['add_link'] = base_url() . "admin/role/add";
		$data['title'] = "Vai trò";
		$this -> load -> view('back_end/main_role', $data);
	}

	function add() {
		$data['title'] = "Thêm";
		if (isset($_POST['txtRole'])) {
			$txtRole = strval($this -> input -> post('txtRole'));
			$this -> load -> model('Role_model');
			$data_array = array('name' => $txtRole, 'last_update' => date('Y-m-d H:i:s', time()), 'state' => 1);
			$this -> Role_model -> insert_role($data_array);
			$data['alert_state'] = 'success';
			$data['alert_msg'] = ADD_SUCCESS_MSG;

		}
		$this -> load -> view('back_end/form/frmAddRole', $data);
	}

	function edit() {
		$data['title'] = "Sửa";
		if ($this -> uri -> segment(4)) {
			$id = intval($this -> uri -> segment(4));
			if ($id) {
				$this -> load -> model('Role_model');
				if (isset($_POST['txtRole']) && isset($_POST['txtState'])) {
					$txtRole = strval($this -> input -> post('txtRole'));
					$txtState = $_POST['txtState'];
					$this -> Role_model -> update_role(array('name' => $txtRole, 'state' => $txtState, 'last_update' => date("Y-m-d H:i:s", time())), array('id' => $id));
					$data['alert_state'] = 'success';
					$data['alert_msg'] = 'Thay đổi thành công';
					$data['role'] = $this -> Role_model -> get_role_by_id($id);
					if ($data['role'] != null) {
						$this -> load -> view('back_end/form/frmEditRole', $data);
					}
				} else {
					$data['role'] = $this -> Role_model -> get_role_by_id($id);
					if ($data['role'] != null) {
						$this -> load -> view('back_end/form/frmEditRole', $data);
					}
				}
			}
		}
	}

	function checkRoleExist() {
		echo "true";
	}

}
?>
