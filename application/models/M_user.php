<?php
/**
 *
 */
class M_user extends CI_Model {

	function __construct() {
		parent::__contruct();
	}

	function get_user($select, $array_where, $array_like, $first, $offset, $order_by) {
		$data = array();
		$order = key($order_by);
		if ($order != null) {
			$sort = $order_by[$order];
			$this -> db -> order_by($order, $sort);
		}

		$this -> db -> select($select);
		$this -> db -> from('tbl_user');
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
		$this -> db -> from('tbl_app');
		$query = $this -> db -> get();
		$rows = $query -> result();
		$query -> free_result();
		return $rows[0] -> total;
	}

	function get_user_by_id($id, $first, $offset) {
		$select = '*';
		$array_where = array('cls_idUser' => $id);
		$array_like = array();
		$order_by = array();
		return $this -> get_app($select, $array_where, $array_like, $first, $offset, $order_by);
	}

	function get_user_by_oau_id($id, $first, $offset) {
		$select = '*';
		$array_where = array('cls_oauId' => $id);
		$array_like = array();
		$order_by = array();
		return $this -> get_app($select, $array_where, $array_like, $first, $offset, $order_by);
	}

	function get_user_by_user_name($user_name, $first, $offset) {
		$select = '*';
		$array_where = array();
		$array_like = array('cls_name' => $id);
		$order_by = array();
		return $this -> get_app($select, $array_where, $array_like, $first, $offset, $order_by);
	}

	function insert_user() {
		$this -> db -> insert('tbl_user', $data_array);
		return $this -> db -> insert_id();
	}

	public function remove_user($arr_where) {
		$this -> db -> where($arr_where);
		$this -> db -> delete('tbl_user');
	}

	public function remove_user_by_id($id) {
		$array_where = array('cls_idUser' => $id);
		$this -> remove_app($array_where);
	}

	function update_user($data_array, $array_where) {
		$this -> db -> where($array_where);
		$this -> db -> update('tbl_user', $data_array);
	}
}
?>