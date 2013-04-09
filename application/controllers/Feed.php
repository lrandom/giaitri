<?php
/**
 *
 */
class Feed extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
		$this -> load -> helper('xml');
		$this -> load -> model('news');
		$this -> load -> helper('url');
		$this -> load -> helper('text');
		$this -> load -> helper('trim_text');
		$this -> load -> helper('date_time_convert');
		$this -> load -> helper('new_link');
	}

	function index() {
        //load header
		$header['client_file_side'] = 'includes/client_side_file/feed';
		$this -> load -> model('Subject');
		$header['menu'] = $this -> Subject -> getTopMenu();
		$header['menu_more'] = $this -> Subject -> getMoreMenu();
		$this -> load -> model('Logo');
		$header['logo'] = $this -> Logo -> get_avail_logo();
		$header['title'] = 'Kênh rss cận cảnh';
		$header['content'] = 'Kênh rss';
		$header['description'] = 'rss feed, cận cảnh rss';
		$header['feed_subject']=$this->Subject->get_subject_available();
		$this -> load -> view('includes/header', $header);
		$this -> load -> view('includes/feed_container');
		$this -> load -> view('includes/footer');
	}

	function index_page() {
		$data['feed_title'] = 'Trang chủ - cancanh.vn';
		$data['feed_channel'] = 'Cận cảnh, tin nhanh, 24h';
		$data['feed_generator'] = 'cancanh.vn';
		$data['manager_editor'] = 'cancanh.vn';
		$data['feed_webmaster'] = 'info@cancanh.vn';
		// the encoding
		$data['feed_url'] = base_url() . '/feed';
		// the url to your feed
		$data['page_description'] = 'Cận cảnh, tin nhanh, tin tức cập nhật 24h';
		// some description
		$data['page_language'] = 'vi-VN';
		// the language
		$data['creator_email'] = 'mail@me.com';
		// your email

		//get events news
		$news['events'] = $this -> news -> get_news_by_id_subject(1, 0, 5);
		//end

		//get sport news
		$news['sport'] = $this -> news -> get_news_by_id_subject(3, 0, 5);
		//end

		//get bussiness news
		$news['bussiness'] = $this -> news -> get_news_by_id_subject(5, 0, 5);
		//end

		//get law news
		$news['law'] = $this -> news -> get_news_by_id_subject(1, 0, 5);
		//end

		//get technology news
		$news['tech'] = $this -> news -> get_news_by_id_subject(16, 0, 5);
		//end

		//get discovery news
		$news['discovery'] = $this -> news -> get_news_by_id_subject(13, 0, 5);
		//end

		//get life-style news
		$news['life-style'] = $this -> news -> get_news_by_id_subject(17, 0, 5);
		//end

		//get car news
		$news['car'] = $this -> news -> get_news_by_id_subject(14, 0, 5);
		//end

		//get entertertaiment news
		$news['entertaiment'] = $this -> news -> get_news_by_id_subject(19, 0, 5);
		//end

		//get education news
		$news['education'] = $this -> news -> get_news_by_id_subject(4, 0, 5);
		//end

		//get food news
		$news['food'] = $this -> news -> get_news_by_id_subject(15, 0, 5);
		//end

		$data['news'] = $news;
		header("Content-Type: text/xml");
		$this -> load -> view('rss/index', $data);
		// important!
	}

	function forum() {
		$idSubject = $this -> uri -> segment(3);
		$this -> load -> model('subject');
		$name_subject = $this -> subject -> get_nameSubject($idSubject);
		$data['feed_title'] = $name_subject.' - cancanh.vn';
		$data['feed_channel'] = 'Cận cảnh, tin nhanh, 24h';
		$data['feed_generator'] = 'cancanh.vn';
		$data['manager_editor'] = 'cancanh.vn';
		$data['feed_webmaster'] = 'info@cancanh.vn';
		// the encoding
		$data['feed_url'] = base_url() . '/feed';
		// the url to your feed
		$data['page_description'] = 'Cận cảnh, tin nhanh, tin tức cập nhật 24h';
		// some description
		$data['page_language'] = 'vi-VN';
		// the language
		// your email
		$data['news'] = $this -> news -> get_news_by_id_subject(1, 0, 10);
		header("Content-Type: text/xml");
		$this -> load -> view('rss/forum', $data);
		// important!
	}
	
	function video(){
	    $idSubject = 18;
		$this -> load -> model('video');
		$data['feed_title'] = 'Video - cancanh.vn';
		$data['feed_channel'] = 'Cancanh, tin nhanh, 24h';
		$data['feed_generator'] = 'cancanh.vn';
		$data['manager_editor'] = 'cancanh.vn';
		$data['feed_webmaster'] = 'info@cancanh.vn';
		// the encoding
		$data['feed_url'] = base_url() . '/feed';
		// the url to your feed
		$data['page_description'] = 'Cận cảnh, tin nhanh, tin tức cập nhật 24h';
		// some description
		$data['page_language'] = 'vi-VN';
		// the language
		// your email
		$data['news'] = $this -> video -> get_video('*',array(), array(), 0, 10, array('tbl_video.cls_idNews'=>'DESC'));
		header("Content-Type: text/xml");
		$this -> load -> view('rss/video', $data);
	}

}
?>