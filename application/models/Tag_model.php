<?php
/**
 *
 */
class Tag_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_tag($select, $array_where, $array_like, $first, $offset, $order_by) {
		$data = array();
		$order = key($order_by);
		if ($order != null) {
			$sort = $order_by[$order];
			$this -> db -> order_by($order, $sort);
		}

		$this -> db -> select($select);
		$this -> db -> from('tags');
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

	function get_tag_has_article($select, $array_where, $array_like, $first, $offset, $order_by) {
		$data = array();
		$order = key($order_by);
		if ($order != null) {
			$sort = $order_by[$order];
			$this -> db -> order_by($order, $sort);
		}

		$this -> db -> select($select);
		$this -> db -> from('tags_has_articles');
		$this -> db -> where($array_where);
		$this -> db -> like($array_like);
		$this -> db -> limit($offset, $first);
		$this -> db -> join('tags','tags_has_articles.tag_id=tags.id','inner');
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
		$this -> db -> from('tags');
		$query = $this -> db -> get();
		$rows = $query -> result();
		$query -> free_result();
		return $rows[0] -> total;
	}

	function get_tag_by_name($name, $first, $offset) {
		return $this -> get_tag('*', array(), array('name' => $name), $first, $offset, array());
	}

	function get_tag_by_extract_name($name, $first, $offset) {
		return $this -> get_tag('*', array('name' => $name), array(), $first, $offset, array());
	}

	function get_tag_by_id($id) {
		return $this -> get_tag('*', array('id' => $id), array(), 0, 100, array());
	}

	function get_tag_by_article_id($id) {
		return $this -> get_tag_has_article('*,tags.id as id', array('article_id' => $id), array(), 0, 100, array());
	}

	function insert_tag($data_array) {
		$this -> db -> insert('tags', $data_array);
		return $this -> db -> insert_id();
	}

	function insert_tag_has_article($data_array) {
		$this -> db -> insert('tags_has_articles', $data_array);
		return $this -> db -> insert_id();
	}

    function remove_tag_has_articles($array_where) {
		$this -> db -> where($array_where);
		$this -> db -> delete('tags_has_articles');
	}

	function remove_tag($array_where) {
		$this -> db -> where($array_where);
		$this -> db -> delete('tags');
	}

}
?>