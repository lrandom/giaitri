<?php
/**
 *
 */
class M_role_perm extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function get_role_perm($select, $array_where, $array_like, $first, $offset, $order_by, $join_table_app=FALSE) {
		$data = array();
		$order = key($order_by);
		if ($order != null) {
			$sort = $order_by[$order];
			$this -> db -> order_by($order, $sort);
		}
	    if($join_table_app){
			$this->db->join('tbl_app','tbl_role_perm.cls_id_app=tbl_app.cls_id','left');
		}
		$this -> db -> select($select);
		$this -> db -> from('tbl_role_perm');
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

	public function get_role_perm_with_role_id($role_id,$join_table_app=FALSE) {
		$array_where = array('cls_id_role' => $role_id);
		return $this -> get_role_perm('*', $array_where, array(), 0, 100, array('tbl_role_perm.cls_last_update' => 'DESC'),$join_table_app);
    }

	public function get_role_perm_with_2id($role_id, $app_id, $join_table_app=FALSE) {
		$array_where = array('cls_id_role' => $role_id, 'cls_id_app' => $app_id, );
		return $this -> get_role_perm('*', $array_where, array(), 0, 500, array(),$join_table_app);
	}

	public function total($array_where, $array_like) {
		$this -> db -> select('count(*) as total');
		$this -> db -> where($array_where);
		$this -> db -> like($array_like);
		$this -> db -> from('tbl_role_perm');
		$query = $this -> db -> get();
		$rows = $query -> result();
		$query -> free_result();
		return $rows[0] -> total;
	}

	public function get_total_role_perm_with_2id($role_id, $app_id) {
		$array_where = array('cls_id_role' => $role_id, 'cls_id_app' => $app_id, );
		return $this -> total($array_where, array());
	}

	public function insert_role_perm($data_array) {
		$this -> db -> insert('tbl_role_perm', $data_array);
		return $this -> db -> insert_id();
	}

	public function insert_role_perm_with_params($id_role, $id_app, $perm) {
		$curr_date = date('Y-m-d H:i:s', time());
		$data_array = array('cls_id_role' => $id_role, 'cls_id_app' => $id_app, 'cls_perm' => $perm, 'cls_last_update' => $curr_date);
		$this -> insert_role_perm($data_array);
	}

	public function remove_role_perm($arr_where) {
		$this -> db -> where($arr_where);
		$this -> db -> delete('tbl_role_perm');
	}

	public function remove_role_with_2id($role_id, $app_id) {
		$array_where = array('cls_id_role' => $role_id, 'cls_id_app' => $app_id);
		$this->remove_role_perm($array_where);
	}

	public function remove_role_perm_by_id($id) {
		$array_where = array('cls_id' => $id);
		$this -> remove_audio($array_where);
	}

	public function update_role_perm($data_array, $array_where) {
		$this -> db -> where($array_where);
		$this -> db -> update('tbl_role_perm', $data_array);
	}

	public function update_role_perm_with_2id($perm, $role_id, $app_id) {
		$data_array = array('cls_perm' => $perm);
		$array_where = array('cls_id_role' => $role_id, 'cls_id_app' => $app_id);
		$this -> update_role_perm($data_array, $array_where);
	}

}
?>