<?php
/**
 *
 */
class App extends CI_Controller {

	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Bangkok');
		$this -> load -> library('session');
		$this -> load -> helper('url');
		$this -> load -> helper('text');
		$this -> load -> helper('trim_text');
		$this -> load -> database();
		$this -> load -> model('app');
	}

	function get_app() {
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

				case 'alias' :
					$q_value = $this -> input -> post('q_value');
					$array_where = array();
					$array_like = array();
					$array_like['cls_code'] = $q_value;
					break;

				case 'name' :
					$q_value = $this -> input -> post('q_value');
					$array_where = array();
					$array_like = array();
					$array_like['cls_desc'] = $q_value;
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
		$total = $this -> app -> total($array_where, $array_like);
		$result['total'] = $total;
		$rows = $this -> app -> get_app($select, $array_where, $array_like, $first, $offset, $order_by);
		if ($rows != null) {
			$result['rows'] = $rows;
		} else {
			$result['rows'] = 0;
		}
		echo json_encode($result);
	}

	function show_form_add_app() {
	  $this->load->view('admin/form/frmAddApp');
	} 
	
	function do_add_app(){
	  if(isset($_POST['app_name']) && isset($_POST['app_code'])){
	    $app_name=$this->input->post('app_name');
		$app_code=$this->input->post('app_code');
		$curr_date=date('Y-m-d H:i:s',time());
		$data_array=array(
		   'cls_code'=>$app_code,
		   'cls_desc'=>$app_name,
		   'cls_last_update'=>$curr_date
		);
		$this->app->insert_app($data_array);
		echo 'Thêm mới thành công';
	  }
	}
	
	function remove_app(){
	  if(isset($_POST['id'])){
	    $tmp=$this->input->post('id');
		for($i=0;$i<count($tmp);$i++){
		  $id=$tmp[$i];
		  $this->app->remove_app_by_id($id);
		}
	  }
	}
	
	function show_form_edit_app(){
	  if(isset($_GET['id'])){
	    $id=$this->input->get('id');
		$data['app']=$this->app->get_by_id($id, 0, 10);
		$this->load->view('admin/form/frmEditApp',$data);
	   }
	}
	
	function edit_app(){
	  if(isset($_POST['id'])){
	    $id=$this->input->post('id');
		$app_code=$this->input->post('app_code');
		$app_name=$this->input->post('app_name');
		$curr_date=date('Y-m-d H:i:s',time());
		$data_array=array(
		            'cls_desc'=>$app_name,
		            'cls_code'=>$app_code,
		            'cls_last_update'=>$curr_date
		            );
		$array_where=array('cls_id'=>$id);
		$this->app->update_app($data_array, $array_where);
	  }
	}
}
?>
