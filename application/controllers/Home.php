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
		$this->load->view('front_end/includes/menu-left');
		$this->load->view('front_end/includes/top-slider');
		$this->load->view('front_end/includes/wraper-slider');
		$this->load->view('front_end/includes/xu_huong');
		$this->load->view('front_end/includes/funny');
		$this->load->model('Article_model');	
		$data['top_view']= $this-> Article_model->get_new_view(1,0,6);
		$data['slider_sibar']=$this -> Article_model -> get_article_cat_id(1,0,3);
		$data['view']=$this-> Article_model->get_focus_new(1);
		$this->load->view('front_end/includes/sidebar',$data);
		$this->load->view('front_end/includes/slider',$data);
		$this->load->view('front_end/includes/footer');


	}
	function load_top_slider(){
		$this->load->model('Article_model');
		$data1=$this->input->post('data');
		switch ($data1) {
			case 'video':
			$data['focus_new']=$this-> Article_model->get_article_cat_id_2(1,0,3) ;
			break;

			case 'most_news':
			$data['focus_new']=$this-> Article_model->get_article_cat_id(1,0,3) ;

			break;
			case 'most_views':
			$data['focus_new']=$this-> Article_model->get_new_view(1,0,3);
			break;
			default:

		}
		$this->load->view('front_end/ajax/top_slider',$data);
	}
	function load_beet_slider(){
		$this->load->model('Article_model');
		$data2=$this->input->post('data');
		switch ($data2) {
			case 'video':
				  $data['new_img'] = $this -> Article_model -> get_article_cat_id_2(4,0,9);
				break;
			case 'news':
				  $data['new_img'] = $this -> Article_model -> get_article_cat_id(4,0,9);
				break;
			case 'views':
				  $data['new_img'] = $this -> Article_model -> get_new_view(4,0,9);
				break;
			default:

		}
		$this->load->view('front_end/ajax/wrap_slider',$data);
	}
	function load_xu_huong(){
		$this->load->model('Article_model');
		$data3=$this->input->post('data');
		switch ($data3) {
			case 'video':
				 $data['vl'] = $this -> Article_model -> get_article_cat_id_2(3,0,4);
				break;
			case 'news-2':
				 $data['vl'] = $this -> Article_model -> get_article_cat_id(3,0,4);
				break;
			case 'views-2':
				 $data['vl'] = $this -> Article_model -> get_new_view(3,0,4);
				break;
			default:
		}
		$this->load->view('front_end/ajax/funny',$data);
	}
	
	function load_funy(){
		$this->load->model('Article_model');
		$data4=$this->input->post('data');
		switch ($data4) {
			case 'video':
				  $data['funny'] = $this -> Article_model ->get_article_cat_id_2(2,0,4);
				break;
			case 'news-3':
				 $data['funny'] = $this -> Article_model -> get_article_cat_id(2,0,4);
				break;
			case 'views-3':
				 $data['funny'] = $this -> Article_model -> get_new_view(2,0,4);
				break;
			
			default:
		}
		$this->load->view('front_end/ajax/bottom',$data);
	}
}
?>