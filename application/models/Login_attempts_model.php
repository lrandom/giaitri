<?php
/**
 *
 */
class Login_attempts_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_login_attempts($select, $array_where, $array_like, $first, $offset, $order_by) {
		$data = array();
		$order = key($order_by);
		if ($order != null) {
			$sort = $order_by[$order];
			$this -> db -> order_by($order, $sort);
		}
		$this -> db -> select($select);
		$this -> db -> from('login_attempts');
		$this -> db -> where($array_where);
		$this -> db -> like($array_like);
		$this -> db -> limit($offset, $first);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $rows) {
				$data[] = $rows;
			}
			$query -> free_result();
			return $data;
		} else {
			return null;
		}
	}

	function total($array_where, $array_like) {
		$this -> db -> select('count(*) as total');
		$this -> db -> where($array_where);
		$this -> db -> like($array_like);
		$this -> db -> from('login_attempts');
		$query = $this -> db -> get();
		$rows = $query -> result();
		$query -> free_result();
		return $rows[0] -> total;
	}

	function get_login_attempts_by_id($id) {
		$select = '*';
		$array_where = array('id' => $id);
		$array_like = array();
		$order_by = array();
		return $this -> get_login_attempts($select, $array_where, $array_like, 0, 1, $order_by);
	}

	function insert_login_attempts($data_array) {
		$this -> db -> insert('login_attempts', $data_array);
		return $this -> db -> insert_id();
	}

	public function remove_login_attempts($array_where) {
		$this -> db -> where($array_where);
		$this -> db -> delete('login_attempts');
	}
	
	public function remove_login_attempts_by_user_name_and_ip($username,$ip){
		$this->remove_login_attempts(array('user_name'=>$username,'ip_address'=>$ip));
	}

	public function remove_login_attempts_by_id($id) {
		$array_where = array('id' => $id);
		$this -> remove_login_attempts($array_where);
	}

	function update_login_attempts($data_array, $array_where) {
		$this -> db -> where($array_where);
		$this -> db -> update('login_attempts', $data_array);
	}

}
?>