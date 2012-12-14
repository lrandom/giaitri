<?php
/**
 *
 */
class M_video extends CI_Model {

	function __construct($argument) {

	}

	public function get_video($select, $array_where, $array_like, $first, $offset, $order_by) {
		$this -> db -> select($select);
		$this -> db -> where($array_where);
		$this -> db -> like($array_like);
		$order = key($order_by);
		if ($order != null) {
			$sort = $order_by[$order];
			$this -> db -> order_by($order, $sort);
		}
		$this -> db -> from('tbl_video');
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
}
?>