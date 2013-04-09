<?php
/**
 *
 */
class Perm_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function get_perm($select, $array_where, $array_like, $first, $offset, $order_by, $join_table_roles =FALSE,$join_table_funcs = FALSE) {
		$data = array();
		$order = key($order_by);
		if ($order != null) {
			$sort = $order_by[$order];
			$this -> db -> order_by($order, $sort);
		}
		if($join_table_roles){
			$this->db->join('roles', 'perms.role_id=roles.id', 'left');
		}
		if ($join_table_funcs) {
			$this -> db -> join('funcs', 'perms.func_id=funcs.id', 'left');
		}

		$this -> db -> select($select);
		$this -> db -> from('perms');
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

	public function get_perm_by_role_id($func_id, $join_table_roles =FALSE,$join_table_funcs = FALSE) {
		$array_where = array('role_id' => $role_id);
		return $this -> get_perm('*', $array_where, array(), 0, 100, array('perms.last_update' => 'DESC'), $join_table_roles,$join_table_funcs);
	}

	public function get_perm_by_func_id($role_id, $func_id, $join_table_roles =FALSE,$join_table_funcs = FALSE) {
		$array_where = array('role_id' => $role_id, 'func_id' => $func_id);
		return $this -> get_perm('*', $array_where, array(), 0, 500, array(), $join_table_roles,$join_table_funcs);
	}

	public function total($array_where, $array_like,$join_table_roles =FALSE,$join_table_funcs = FALSE) {
		$this -> db -> select('count(*) as total');
		$this -> db -> where($array_where);
		$this -> db -> like($array_like);
		$this -> db -> from('perms');
		if($join_table_roles){
			$this->db->join('roles', 'perms.role_id=roles.id', 'left');
		}
		if ($join_table_funcs) {
			$this -> db -> join('funcs', 'perms.func_id=funcs.id', 'left');
		}
		$query = $this -> db -> get();
		$rows = $query -> result();
		$query -> free_result();
		return $rows[0] -> total;
	}

	public function get_total_role_perm_by_2id($role_id, $app_id) {
		$array_where = array('role_id' => $role_id, 'func_id' => $app_id);
		return $this -> total($array_where, array());
	}

	public function insert_perm($data_array) {
		$this -> db -> insert('perms', $data_array);
		return $this -> db -> insert_id();
	}

	public function insert_perm_with_params($id_role, $id_app, $perm) {
		$curr_date = date('Y-m-d H:i:s', time());
		$data_array = array('role_id' => $id_role, 'func_id' => $id_app, 'perm' => $perm, 'last_update' => $curr_date);
		$this -> insert_role_perm($data_array);
	}

	public function remove_perm($arr_where) {
		$this -> db -> where($arr_where);
		$this -> db -> delete('perms');
	}

	public function remove_perm_by_2id($role_id, $app_id) {
		$array_where = array('role_id' => $role_id, 'func_id' => $app_id);
		$this -> remove_role_perm($array_where);
	}

	public function remove_perm_by_id($id) {
		$array_where = array('id' => $id);
		$this -> remove_perm($array_where);
	}

	public function update_perm($data_array, $array_where) {
		$this -> db -> where($array_where);
		$this -> db -> update('perms', $data_array);
	}

	public function update_perm_by_id($id,$data_array){
		$this->update_perm($data_array,array('id'=>$id));
	}

	public function update_perm_by_role_id($perm, $role_id, $app_id) {
		$data_array = array('perm' => $perm);
		$array_where = array('role_id' => $role_id, 'func_id' => $app_id);
		$this -> update_role_perm($data_array, $array_where);
	}

	public function update_perm_by_func_id($perm, $role_id, $app_id) {
		$data_array = array('perm' => $perm);
		$array_where = array('role_id' => $role_id, 'func_id' => $app_id);
		$this -> update_role_perm($data_array, $array_where);
	}
}
?>