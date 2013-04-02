<?php
/**
 *
 */
class Func_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function get_func($select, $array_where, $array_like, $first, $offset, $order_by) {
		$data = array();
		$order = key($order_by);
		if ($order != null) {
			$sort = $order_by[$order];
			$this -> db -> order_by($order, $sort);
		}

		$this -> db -> select($select);
		$this -> db -> from('funcs');
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

	public function total($array_where, $array_like) {
		$this -> db -> select('count(*) as total');
		$this -> db -> where($array_where);
		$this -> db -> like($array_like);
		$this -> db -> from('funcs');
		$query = $this -> db -> get();
		$rows = $query -> result();
		$query -> free_result();
		return $rows[0] -> total;
	}

	public function get_func_by_id($id) {
		$select = '*';
		$array_where = array('id' => $id);
		$array_like = array();
		$order_by = array();
		return $this -> get_func($select, $array_where, $array_like, 0, 1, $order_by);
	}

	public function insert_func($data_array) {
		$this -> db -> insert('funcs', $data_array);
		return $this -> db -> insert_id();
	}

	public function remove_func($arr_where) {
		$this -> db -> where($arr_where);
		$this -> db -> delete('funcs');
	}

	public function remove_func_by_id($id) {
		$array_where = array('id' => $id);
		$this -> remove_func($array_where);
	}

	public function update_func($data_array, $array_where) {
		$this -> db -> where($array_where);
		$this -> db -> update('funcs', $data_array);
	}

}
?>