<?php
/**
 *
 */
class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		 $this -> load -> database();
	}


	function index(){
		$this->load->model('Categories_model');
		$data['menu'] = $this -> Categories_model ->get_top_menu(0,20);
		$this -> load -> view('front_end/includes/header', $data);

		$this->load->model('Article_model');
        $data['new_img'] = $this -> Article_model -> get_article_cat_id(2,0,9);
        $data['xu_huong'] = $this -> Article_model -> get_article_cat_id(1,0,4);
        $data['funny'] = $this -> Article_model ->get_article_cat_id(4,0,6);
        $data['focus_new']=$this-> Article_model->get_article_cat_id(2,0,3) ;
		$this->load->view('front_end/content',$data);
		
		$this->load->model('Article_model');	
		$data['view']=$this-> Article_model->get_focus_new(1);
		$data['slider_sibar']=$this -> Article_model -> get_article_cat_id(2,0,3);
		$data['top_view']= $this-> Article_model->get_article_cat_id_2(2,0,6);
		$this->load->view('front_end/includes/sidebar',$data);

		$this->load->view('front_end/includes/slider',$data);
		$this->load->view('front_end/includes/footer');


	}
}
?>