<?php
/**
 *
 */
class Article_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_article($select, $array_where, $array_like, $first, $offset, $order_by) {
		$data = array();
		$order = key($order_by);
		if ($order != null) {
			$sort = $order_by[$order];
			$this -> db -> order_by($order, $sort);
		}
		$this -> db -> select($select);
		$this -> db -> from('articles');
		$this -> db -> where($array_where);
		$this -> db -> like($array_like);
		$this -> db -> limit($offset, $first);
		$this -> db -> join('users', 'articles.user_id=users.id', 'left');
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
		$this -> db -> from('articles');
		$query = $this -> db -> get();
		$rows = $query -> result();
		$query -> free_result();
		return $rows[0] -> total;
	}
	function get_article_cat_id($id,$first,$offset){

		$select = '*,articles.id as id';
		$arr_where = array('articles.state' => 1, 'FIND_IN_SET("' . $id . '",cat_id)<>' => 0);
		$arr_like = array();
		$order_by = array('date_post' => 'DESC');
		$data = $this -> get_article($select, $arr_where, $arr_like, $first, $offset, $order_by);
		return $data;
	}
	function get_article_cat_id_2($id,$first,$offset){
	$select = '*,articles.id as id';
	$arr_where = array('articles.state' => 1, 'FIND_IN_SET("' . $id . '",cat_id)<>' => 0);
		$arr_like = array();
	$order_by = array('views_count' => 'DESC');
		$data = $this -> get_article($select, $arr_where, $arr_like, $first, $offset, $order_by);
		return $data;

	 }

	 function get_focus_new($number_of_news){
	 	$CI =& get_instance();
	 	$subject=$CI->Categories_model->get_categories_availabel();
	 	$data=null;
	 	foreach ($subject as $r) {
	 		$id=$r->id;
	 		$new=$this->get_article_cat_id_2($id,0,1);
	 		if ($new!=null) {
	 			$data[]=$new;
	 		}
	 	}
	 	$tmp=null;
	 	$count=count($data);

	 	for ($i=0; $i <($number_of_news-1) ; $i++) { 
	 	for ($ii=($i+1); $i <$number_of_news ; $ii++) { 
	 		if (($data[$ii][0]->views_count)>($data[$i][0]->views_count)) {
	 			$tmp=$data[$i];
	 			$data[$i]=$data[$ii];
	 			$data[$ii]=$tmp;
	 		}
	 	}
	 	}
	 	return $data;
   }
   public function get_new_view($id,$first,$offset){
   	$select = 'articles.id as';
   	$array_where = array('articles.state' => 1, 'FIND_IN_SET("' . $id . '",cat_id)<>' => 0);
   	$array_like = array();
   	$order_by = array('articles.views_count' => 'DESC');
   	return $this->get_article($select,$array_where,$array_like,$first,$offset,$order_by);
   	if ($data !=null) {
   		foreach ($data as $r) {
   			$r -> cat_id = $id;
   		}
   	}
   }
	function get_article_by_id($id) {
		$select = '*,articles.id as id';
		$array_where = array('articles.id' => $id);
		$array_like = array();
		$order_by = array('articles.id' => 'DESC');
		return $this -> get_article($select, $array_where, $array_like, 0, 1, $order_by);
	}
	function get_article_by_title($title, $first, $offset) {
		return $this -> get_article('*,articles.id as id,users.id as user_id', array(), array('title' => $title), $first, $offset, array());
	}

	function get_article_by_name($category_name, $first, $offset) {
		$select = '*';
		$array_where = array();
		$array_like = array('name' => $id);
		$order_by = array();
		return $this -> get_article($select, $array_where, $array_like, $first, $offset, $order_by);
	}

	function get_article_by_id_parent($id, $first, $offset) {
		$select = '*';
		$array_where = array();
		$array_like = array('parent_id' => $id);
		$order_by = array();
		return $this -> get_articles($select, $array_where, $array_like, $first, $offset, $order_by);
	}

	function insert_article($data_array) {
		$this -> db -> insert('articles', $data_array);
		return $this -> db -> insert_id();
	}

	function remove_article($arr_where) {
		$this -> db -> where($arr_where);
		$this -> db -> delete('articles');
	}

	function remove_article_by_id($id) {
		$array_where = array('id' => $id);
		$this -> remove_article($array_where);
	}

	function update_article($data_array, $array_where) {
		$this -> db -> where($array_where);
		$this -> db -> update('articles', $data_array);
	}
	function get_article_top_view($id,$first,$offset){

		$select='*,articles.id as id';
		$arr_where = array('articles.state' => 1 , 'FIND_IN_SET("' . $id .'",cat_id )<>' => 0 ,'id < ' => $newid);
		$arr_like = array(); 
		$order_by = array('views_count' => 'DESC');
		$data = $this -> get_article($select,$arr_where,$arr_like,$first,$offset,$order_by);

	}

}
?> 