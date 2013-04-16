<?php
/**
 *
 */
class Func extends CI_Controller {

	function __construct() {
		parent::__construct();
		session_start();
		date_default_timezone_set('Asia/Bangkok');
		$this -> load -> library('session');
		$this -> load -> helper('url');
		$this -> load -> helper('text');
		$this -> load -> helper('trim_text');
		$this -> load -> database();
		$this -> load -> library('pagination');
	}

	function index() {
		$data['title'] = 'Function';
		$this -> load -> model('Func_model');
		$where = array();
		$like = array();
		if ($this -> input -> get('action')) {
			$action = $this -> input -> get('action');
			switch ($action) {
				case 'delete' :
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

		    //get params using get method
		$page = $this -> input -> get('page') ? $this -> input -> get('page') : 1;
		$order = $this -> input -> get('order') ? $this -> input -> get('order') :'DESC';
		$per_page = $this -> input -> get('per_page') ? $this -> input -> get('per_page') : 5;
		    //end get params from get method

		$data['func_list'] = $this -> Func_model -> get_func('*', $where, $like, ($page - 1) * $per_page, $per_page, array('id'=>$order));
		$data['base_url'] = base_url() . 'admin/func?order=' . $order;
		$data['sort'] = $order;
		$data['next_sort'] = $order == 'ASC' ? 'DESC' : 'ASC';

		$config = array();
		$config['total_rows'] = $this -> Func_model -> total(array(), array());
		$config['base_url'] = $data['base_url'];
		$config['per_page'] = $per_page;
		$this -> pagination -> initialize($config);
		$data['page_link'] = $this -> pagination -> create_links();
		$data['add_link'] = base_url() . "admin/func/add";
		$this -> load -> view('back_end/main_func', $data);
	}

	function add() {
		//insert data
		$data['title'] = 'Thêm mới';
		if (isset($_POST['txtName']) && isset($_POST['txtCode']) && isset($_POST['token'])) {
			if(isset($_SESSION['token']) && ($_SESSION['token']==$this->input->post('token'))){
				$txtCode = strval($this -> input -> post('txtCode'));
				$txtName = strval($this -> input -> post('txtName'));
				$this -> load -> model('Func_model');
				$data_array = array('desc' => $txtName, 'code' => $txtCode, 'last_update' => date('Y-m-d H:i:s', time()));
				$this -> Func_model -> insert_func($data_array);
				$data['alert_state'] = ALERT_STATE_SUCCESS;
				$data['alert_msg'] = ADD_SUCCESS_MSG;
		}//end if
		}//end if
        //end insert data

		$this->load->library('ultils');
		$data['token']=$this->ultils->_generate_unqid_token();
		$_SESSION['token']=$data['token'];
		$this -> load -> view('back_end/form/frmAddFunc', $data);
	}

	function edit() {
		$data['title'] = "Sửa";
		if ($this -> uri -> segment(4)) {
			$id = intval($this -> uri -> segment(4));
			if ($id) {
				$this -> load -> model('Func_model');
				if (isset($_POST['txtName']) && isset($_POST['txtCode'])) {
					$txtName = strval($this -> input -> post('txtName'));
					$txtCode = $_POST['txtCode'];
					$this -> Func_model -> update_func(array('desc' => $txtName, 'code' => $txtCode, 'last_update' => date("Y-m-d H:i:s", time())), array('id' => $id));
					$data['alert_state'] = ALERT_STATE_SUCCESS;
					$data['alert_msg'] = EDIT_SUCCESS_MSG;
					$data['func'] = $this -> Func_model -> get_func_by_id($id);
					if ($data['func'] != null) {
						$this -> load -> view('back_end/form/frmEditFunc', $data);
					}
				} else {
					$data['func'] = $this -> Func_model -> get_func_by_id($id);
					if ($data['func'] != null) {
						$this -> load -> view('back_end/form/frmEditFunc', $data);
					}
				}
			}
		}
	}


	function checkNameExist() {
		echo "true";
	}

	function checkCodeExist() {
		echo "true";
	}

}
?>
