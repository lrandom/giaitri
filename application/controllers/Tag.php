<?php
/**
 *
 */
class Tag extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function get_tag() {
		if (isset($_GET['q'])) {
			$q = $this -> input -> get('q');
			$this -> load -> model('Tag_model');
			echo json_encode($this -> Tag_model -> get_tag_by_name($q, 0, 100));
		}
	}

	function add_tag() {
		if (isset($_POST['txtTagName'])) {
			$tagName = $this -> input -> post('txtTagName');
			$this -> load -> model('Tag_model');
			$data = $this -> Tag_model -> get_tag_by_extract_name($tagName, 0, 100);
			if ($data == null && $tagName!='') {
				$this -> Tag_model -> insert_tag(array('name' => $tagName));
			}
		}
	}
}
?>