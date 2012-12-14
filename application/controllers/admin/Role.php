<?php
/**
 *
 */
class Role extends CI_Controller {

	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Bangkok');
		$this -> load -> library('session');
		$this -> load -> helper('url');
		$this -> load -> helper('text');
		$this -> load -> helper('trim_text');
		$this -> load -> database();
		$this -> load -> model('role');
		$this -> load -> model('subject');
	}

	function show_form_add_role() {
		$this -> load -> view('admin/form/frmAddRole');
	}

	function show_form_change_perm() {
		if (isset($_GET['id'])) {
			$data['id'] = $this -> input -> get('id');
			$this -> load -> model('role_perm');
			$this -> load -> model('app');
			$rows = $this -> role_perm -> get_role_perm_with_role_id($data['id']);
			if ($rows != NULL) {
				foreach ($rows as $r) {
					$tmp = $this -> app -> get_by_id($r -> cls_id_app, 0, 1);
					//echo $this->db->last_query();
					$r -> cls_desc = $tmp[0] -> cls_desc;
				}
			}
			$data['role_perm'] = $rows;
			$data['app'] = $this -> app -> get_app('*', array(), array(), 0, 100, array());
			$this -> load -> view('admin/form/frmChangePerm', $data);
		}
	}

	function add_role() {
		if (isset($_POST['role_name'])) {
			$role_name = $this -> input -> post('role_name');
			if ($role_name != '') {
				$curr_date = date('Y-m-d H:i:s', time());
				$data_array = array('cls_name' => $role_name, 'cls_last_update' => $curr_date);
				$this -> role -> insert_role($data_array);
			}
		}
	}

	function remove_role() {
		if (isset($_POST['id'])) {
			$tmp = $this -> input -> post('id');
			for ($i = 0; $i < count($tmp); $i++) {
				$id = $tmp[$i];
				$this -> role -> remove_role_by_id($id);
			}
		}
	}

	function add_perm() {
		if (isset($_POST['role_id'])) {
			$this -> load -> model('role_perm');
			$role_id = $this -> input -> post('role_id');
			$app_id = $this -> input -> post('app_id');
			$list_access = $this -> input -> post('list_access');
			$set_of_perm = '';
			for ($i = 0; $i < count($list_access); $i++) {
				$set_of_perm .= $list_access[$i];
			}
			//check exist
			$total = $this -> role_perm -> get_total_role_perm_with_2id($role_id, $app_id);
			if ($total == 0) {
				$this -> role_perm -> insert_role_perm_with_params($role_id, $app_id, $set_of_perm);
				$curr_date=date('Y-m-d H:i:s',time());
				$data_array=array('cls_last_update'=>$curr_date);
			    $this -> role -> update_role($data_array, array('cls_id'=>$role_id));
				echo 'Cho phÃ©p truy cáº­p á»©ng dá»¥ng thÃ nh cÃ´ng';
			} else {
				$data = $this -> role_perm -> get_role_perm_with_2id($role_id, $app_id);
				if ($set_of_perm != $data[0] -> cls_perm) {
					$this -> role_perm -> update_role_perm_with_2id($set_of_perm, $role_id, $app_id);
				    $curr_date=date('Y-m-d H:i:s',time());
				    $data_array=array('cls_last_update'=>$curr_date);
			        $this -> role -> update_role($data_array, array('cls_id'=>$role_id));
					echo 'PhÃ¢n quyá»�n thÃ nh cÃ´ng';
				} else {
					echo 'Quyá»�n truy cáº­p á»©ng dá»¥ng nÃ y Ä‘Ã£ tá»“n táº¡i';
				}
			}
		}
	}
    
	function remove_perm(){
	  if(isset($_POST['app_id']) && isset($_POST['role_id'])){
	    $app_id=$this->input->post('app_id');
		$role_id=$this->input->post('role_id');
		$this->load->model('role_perm');
		$this->role_perm->remove_role_with_2id($role_id, $app_id);
	  }
	}
	
	function get_role() {
		$select = '*';
		$array_where = array();
		$array_like = array();
		if (isset($_POST['page'])) {
			$page = $this -> input -> post('page');
		} else {
			$page = 1;
		}

		if (isset($_POST['rows'])) {
			$offset = $this -> input -> post('rows');
		} else {
			$offset = 10;
		}

		if (isset($_POST['q_name']) && isset($_POST['q_value'])) {
			switch ($_POST['q_name']) {
				case 'id' :
					$q_value = $this -> input -> post('q_value');
					$array_where = array();
					$array_like = array();
					$array_where['cls_id'] = $q_value;
					break;

				case 'title' :
					$q_value = $this -> input -> post('q_value');
					$array_where = array();
					$array_like = array();
					$array_like['cls_name'] = $q_value;
					break;

				default :
					break;
			}
		}

		if (isset($_POST['sort']) && isset($_POST['order'])) {
			$sort = $this -> input -> post('sort');
			$order = $this -> input -> post('order');
			$order_by = array($sort => $order);
		} else {
			$order_by = array('cls_last_update' => 'DESC');
		}

		$first = ($page - 1) * $offset;
		$total = $this -> role -> total($array_where, $array_like);
		$result['total'] = $total;
		$rows = $this -> role -> get_role($select, $array_where, $array_like, $first, $offset, $order_by);
		if ($rows != null) {
			$result['rows'] = $rows;
		} else {
			$result['rows'] = 0;
		}
		echo json_encode($result);
	}
}
?>
