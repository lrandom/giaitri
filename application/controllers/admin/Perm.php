<?php
/**
 *
 */
class Perm extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$this -> load -> model('Role_model');
		//config and init pagination
		$config = array();
		$config['total_rows'] = $this -> Role_model -> total(array(), array());
		//end config and init pagination

		$action = $this -> input -> get('action');
		if ($action) {
			switch ($action) {
				case 'show' :
					break;

				case 'delete' :
					$id = intval($this -> input -> get('id'));
					if ($id) {
						$this -> Role_model -> remove_role_by_id($id);
						$data['alert_state'] = 'success';
						$data['alert_msg'] = 'Xóa thành công';
					}
					break;

				case 'edit' :
					$id = intval($this -> input -> get('id'));
					if ($id) {
						redirect(base_url() . 'admin/role/editRole/' . $id);
					}
					break;

				default :
					break;
			}
		}

		$page = $this -> input -> get('page') ? $this -> input -> get('page') : 1;
		$order = $this -> input -> get('order') ? $this -> input -> get('order') : 'ASC';
		$per_page = $this -> input -> get('per_page') ? $this -> input -> get('per_page') : 5;

		$data['role_list'] = $this -> Role_model -> get_role("*", array(), array(), ($page - 1) * $per_page, $per_page, array('id' => $order));
		$data['base_url'] = base_url() . 'admin/dash_board/role/?order=' . $order;
		$data['sort'] = $order;
		$data['next_sort'] = $order == 'ASC' ? 'DESC' : 'ASC';

		$config['base_url'] = $data['base_url'];
		$config['per_page'] = $per_page;
		$this -> pagination -> initialize($config);
		$data['page_link'] = $this -> pagination -> create_links();
		$data['add_link'] = base_url() . "admin/role/add";
		$data['title'] = "Vai trò";
		$this -> load -> view('back_end/main_perm', $data);
	}

}
?>