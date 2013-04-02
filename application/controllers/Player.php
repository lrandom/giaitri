<?php
class Player extends CI_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index() {

	}

	public function load() {
		if(isset($_GET['link']) && isset($_GET['autoplay'])){
			$link=$this->input->get('link');
			$thumb=isset($_GET['thumb'])?'':$this->input->get('thumb');
			$autoplay=$this->input->get('autoplay');
			$data['link']=$link;
			$data['thumb']=$thumb;
			$data['autoplay']=$autoplay;
			$this->load->view('embed',$data);
		}
	}
}
?>