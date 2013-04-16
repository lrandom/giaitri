<?php
/**
* 
*/
class C_forum extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	function index(){
		$this->load->model('Categories_model');
		$data['menu'] = $this -> Categories_model ->get_top_menu(0,20);
		$this -> load -> view('front_end/includes/header-forum', $data);
		$this->load->view('front_end/includes/frum-menu');

		$this->load->model('Article_model');
		$data['forum_slider'] = $this -> Article_model ->get_article_cat_id(3,0,1);
		$data['forum_title'] = $this -> Article_model ->get_article_cat_id(3,0,2);
		$data['forum_img']=$this -> Article_model ->get_article_cat_id(3,0,4);
		$this->load->view('front_end/includes/forum-slider',$data);

		$this->load->view('front_end/includes/forum-wraper');
		$data['forum_xu'] =$this -> Article_model ->get_article_cat_id(1,0,4);
		$this->load->view('front_end/includes/forum-xu-huong',$data);
		
		$this->load->view('front_end/includes/forum-funny');
		
		$this->load->model('Article_model');	
		$data['view']=$this-> Article_model->get_focus_new(1);
		$data['top_view']= $this-> Article_model->get_new_view(1,0,6);
		$data['slider_sibar']=$this -> Article_model -> get_article_cat_id(1,0,3);
		$this->load->view('front_end/includes/sidebar',$data);
		$this->load->view('front_end/includes/footer');
	}


	function load_new(){
		if(isset($_POST['first']) && isset($_POST['offset'])){
			$first=$this->input->post('first');
			$offset=$this->input->post('offset');
			$this->load->model('Article_model');
			$data['new']= $this-> Article_model->get_article_cat_id_2(4,$first,$offset);
			$this->load->view('front_end/ajax/frum_wraper',$data);
		}
	}
	function load_new_funny(){
		if (isset($_POST['first']) && isset($_POST['offset'])) {
		$first=$this->input->post('first');
			$offset=$this->input->post('offset');
			$this->load->model('Article_model');
			$data['forum_funny']= $this-> Article_model->get_article_cat_id_2(3,$first,$offset);
			$this->load->view('front_end/ajax/frum_funny',$data);
		}
	}
}
?>