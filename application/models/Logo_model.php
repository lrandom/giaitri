<?php
/**
 *
 */
class Logo_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_logo($select, $array_where, $array_like, $first, $offset, $order_by) {
		$data = array();
		$order = key($order_by);
		if ($order != null) {
			$sort = $order_by[$order];
			$this -> db -> order_by($order, $sort);
		}
		$this -> db -> select($select);
		$this -> db -> from('logos');
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
		$this -> db -> from('logos');
		$query = $this -> db -> get();
		$rows = $query -> result();
		$query -> free_result();
		return $rows[0] -> total;
	}

	function get_logo_by_id($id) {
		$select = '*';
		$array_where = array('id' => $id);
		$array_like = array();
		$order_by = array();
		return $this -> get_logo($select, $array_where, $array_like, 0, 1, $order_by);
	}

	function get_logo_by_name($category_name, $first, $offset) {
		$select = '*';
		$array_where = array();
		$array_like = array('name' => $id);
		$order_by = array();
		return $this -> get_logo($select, $array_where, $array_like, $first, $offset, $order_by);
	}

	function get_logo_by_id_parent($id, $first, $offset) {
		$select = '*';
		$array_where = array();
		$array_like = array('parent_id' => $id);
		$order_by = array();
		return $this -> get_logo($select, $array_where, $array_like, $first, $offset, $order_by);
	}

	function get_logo_availabel($first, $offset) {
		return $this -> get_logo('*', array('state' => ACTIVED_STATE), array(), $first, $offset, array('id' => 'DESC'));
	}

	function insert_logo($data_array) {
		$this -> db -> insert('logos', $data_array);
		return $this -> db -> insert_id();
	}

	public function remove_logo($arr_where) {
		$this -> db -> where($arr_where);
		$this -> db -> delete('logos');
	}

	public function remove_logo_by_id($id) {
		$array_where = array('id' => $id);
		$this -> remove_logo($array_where);
	}

	function update_logo($data_array, $array_where) {
		$this -> db -> where($array_where);
		$this -> db -> update('logos', $data_array);
	}

}
?>