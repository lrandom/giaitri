<?php
/**
 *
 */
class Article extends CI_Controller {

	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Bangkok');
		$this -> load -> library('session');
		$this -> load -> helper('url');
		$this -> load -> helper('text');
		$this -> load -> helper('trim_text');
		$this -> load -> database();
		$this -> load -> library('session');
	}
    
	function showFormAdd(){
	    $this->load->view('back_end/form/frmAddArticle');
	}
	
	function addArticle(){
	    $this->load->model('article');
		
	}
	
	function addVideo(){
		
	}
	
	function addImages(){
		
	}
	
	function showFormEdit(){
		
	}
	
	
	function getNews() {
		$select = 'DISTINCT(tbl_news.cls_idNews),cls_content,cls_title,
		           cls_datePost,cls_pseu,cls_acceptNews,tbl_member.cls_idMember,
		           tbl_member.cls_userName,
		           cls_idSubject,cls_apply_comment';
		$array_where = array();
		$array_like = array();
		if (isset($_POST['page'])) {
			$page = $this -> input -> post('page');
		} else {
			$page = 1;
		}

		if (isset($_POST['rows'])) {
			$offset = $this -> input -> post('rows');
		} else {
			$offset = 10;
		}

		if (isset($_POST['q_name']) && isset($_POST['q_value'])) {
			switch ($_POST['q_name']) {
				case 'id_news' :
					$q_value = $this -> input -> post('q_value');
					$array_where = array();
					$array_like = array();
					$array_where['tbl_news.cls_idNews'] = $q_value;
					break;

				case 'title' :
					$q_value = $this -> input -> post('q_value');
					$array_where = array();
					$array_like = array();
					$array_like['cls_title'] = $q_value;
					break;

				case 'pseu' :
					$q_value = $this -> input -> post('q_value');
					$array_where = array();
					$array_like = array();
					$array_like['cls_pseu'] = $q_value;
					break;
				
                case 'user_name':
				    $q_value = $this -> input -> post('q_value');
					$array_where = array();
					$array_like = array();
					$array_like['cls_userName'] = $q_value;
					break;
				default :
					break;
			}
		}

		if (isset($_POST['q_view'])) {
			switch ($_POST['q_view']) {
				case 'v_wait_accept' :
					$array_where = array();
					$array_like = array();
					$array_where['cls_acceptNews'] = 0;
					break;

				case 'v_currentDate' :
					$array_where = array();
					$array_like = array();
					$currentDate = date('Y-m-d', time());
					$array_where['date(cls_datePost)'] = $currentDate;
					break;

				case 'v_has_post' :
					$array_where = array();
					$array_like = array();
					$array_where['cls_acceptNews'] = 1;
					break;

				case 'v_all' :
					$array_where = array();
					$array_like = array();
					break;
				default :
					break;
			}
		}
		if (isset($_POST['sort']) && isset($_POST['order'])) {
			$sort = $this -> input -> post('sort');
			$order = $this -> input -> post('order');
			$order_by = array($sort => $order);
		} else {
			$order_by = array('tbl_news.cls_datePost' => 'DESC');
		}

		$first = ($page - 1) * $offset;
		$total = $this -> news -> total($array_where, $array_like);
		$result['total'] = $total;
		$rows = $this -> news -> get_news($select, $array_where, $array_like, $first, $offset, $order_by);
		if ($rows != null) {
			$this->load->model('subject');
			foreach ($rows as $r) {
				$name_subject='';
				$r -> cls_content = trim_text(htmlspecialchars_decode($r -> cls_content), 50, true, true);
				if ($r -> cls_acceptNews == 1) {
					$r -> cls_acceptNews = 'Ä�Ã£ Ä‘Æ°á»£c Ä‘Äƒng';
				} else {
					$r -> cls_acceptNews = 'ChÆ°a Ä‘Æ°á»£c Ä‘Äƒng';
				}
				
				if($r -> cls_apply_comment ==1){
					$r->cls_apply_comment='CÃ³';
				}else{
					$r->cls_apply_comment='KhÃ´ng';
				}
				
				$r -> cls_datePost = date('H:i:s m-d-Y', strtotime($r -> cls_datePost));
				
				$idSubject=explode(',', $r->cls_idSubject);
				if($idSubject!=NULL){
				foreach ($idSubject as $id) {
				  if($id!=NULL){
				  	$tmp=$this->subject->get_subject_by_id($id);
				    if($tmp!=NULL &&  $id==reset($idSubject)){
				      $name_subject.=$tmp[0]->cls_nameSubject;
					}else{
				      if($tmp!=NULL){
					   $name_subject.=' / '.$tmp[0]->cls_nameSubject;
					}
					}
				  }
				}                
				$r->cls_nameSubject=$name_subject;
			}
			}
			$result['rows'] = $rows;
		} else {
			$result['rows'] = 0;
		}
      
		echo json_encode($result);
	}



	function show_form_quick_view() {
		$idNews = $this -> uri -> segment(4);
		if (is_numeric($idNews)) {
			$this -> load -> helper('show_thumb');
			$data['news'] = $this -> news -> get_news_by_id_news($idNews, true);
			$data['relative_news'] = $this -> news -> get_relative_news($idNews);
			$this -> load -> model('Video');
			$data['video_news'] = $this -> Video -> get_for_news($idNews);
			$this -> load -> model('Audio');
			$data['audio_news'] = $this -> Audio -> get_for_news($idNews);
			$this -> load -> model('Image');
			$data['image_news'] = $this -> Image -> get_for_news($idNews);
			$this -> load -> view('admin/form/frmNewsQuickView', $data);
		}
	}

	function del_news() {
		if (isset($_POST['id_news'])) {

			$this -> load -> model('video');
			$this -> load -> model('audio');
			$this -> load -> model('image');
			for ($i = 0; $i < count($_POST['id_news']); $i++) {
				$id_news = mysql_real_escape_string($_POST['id_news'][$i]);
				$arr_where = array('cls_idNews' => $id_news);
				$this -> news -> remove_news($arr_where);

				$data = $this -> video -> get_for_news($id_news);
				if ($data != null) {
					unlink(BASE_DIR . $data[0] -> cls_linkVideo);
					unlink(BASE_DIR . $data[0] -> cls_linkthumb);
					$this -> video -> remove_video($arr_where);
				}

				$data = $this -> audio -> get_for_news($id_news);
				if ($data) {
					unlink(BASE_DIR . $data[0] -> cls_link);
				}
				$this -> audio -> remove_audio($arr_where);

				$data = $this -> image -> get_for_news($id_news);
				if ($data) {
					unlink(BASE_DIR . $data[0] -> cls_linkImages);
				}
				$this -> image -> remove_images($arr_where);
			}
		}

	}

	function search_relative_news() {
		$this -> load -> model('news');
		if (isset($_GET['q'])) {
			$select = 'cls_title,tbl_news.cls_idNews';
			$array_where = array();
			$array_like = array();
			$array_where['cls_acceptNews'] = 1;
			$array_like['cls_title'] = $this -> input -> get('q');
			$order_by = array('tbl_news.cls_title' => 'ASC');
			$rows = $this -> news -> get_news($select, $array_where, $array_like, 0, 50, $order_by);
			echo json_encode($rows);
		}
	}

	function search_relative_news_for_edit() {
		$this -> load -> model('news');
		if (isset($_GET['q'])) {
			$idNews = $this -> input -> get('idNews');
			$select = 'cls_title,tbl_news.cls_idNews';
			$array_where = array();
			$array_like = array();
			$array_where['cls_acceptNews'] = 1;
			$array_where['tbl_news.cls_idNews <>'] = $idNews;
			$array_like['cls_title'] = $this -> input -> get('q');
			$order_by = array('tbl_news.cls_title' => 'ASC');
			$rows = $this -> news -> get_news($select, $array_where, $array_like, 0, 50, $order_by);
			echo json_encode($rows);
		}
	}

	function get_subject_level1() {
		if (isset($_POST['idSubject'])) {
			$idSubject = $this -> input -> post('idSubject');
			$this -> load -> model('subject');
			$select = 'cls_idSubject,cls_nameSubject';
			$array_where = array('cls_level' => 2, 'cls_displayMenu' => 1, 'cls_targetParent' => $idSubject);
			$array_like = array();
			$order_by = array();
			$subject = $this -> subject -> get_subject($select, $array_where, $array_like, 0, 100, $order_by);
			echo $this -> db -> last_query();
			echo '<option value="">Chá»�n chuyÃªn má»¥c con</option>';
			if ($subject != null) {
				foreach ($subject as $r) {
					echo '<option value="' . $r -> cls_idSubject . '">' . $r -> cls_nameSubject . '</option>';
				}
			}
		}
	}

	function insert_news() {
		if (isset($_POST)) {
			if ($this -> session -> userdata('loged')) {
				$user_data = $this -> session -> userdata('loged');
				$user_id = $user_data['user_id'];
				$set_of_idSubject = '';
				$idSubject = $this -> input -> post('idSubject');
				$set_of_idSubject = $idSubject;
				if (isset($_POST['idSubjectLevel1'])) {
					$idSubjectLevel1 = $this -> input -> post('idSubjectLevel1');
					$set_of_idSubject .= ',' . $idSubjectLevel1;
				}
				$set_of_relative_id_news = '';
				$title = $this -> input -> post('title');
				$content = $this -> input -> post('content');
				$pseu = $this -> input -> post('pseu');
				$arr_id_news = $this -> input -> post('arrIdNews');
				for ($i = 0; $i < count($arr_id_news); $i++) {
					$set_of_relative_id_news = $set_of_relative_id_news . ',' . $arr_id_news[$i];
				}
				$current_date = date('Y-m-d H:i:s', time());
				$array_insert = array('cls_title' => $title, 'cls_pseu' => $pseu, 
				                      'cls_content' => htmlspecialchars($content),
				                      'cls_idRelativeNews' => $set_of_relative_id_news, 
				                      'cls_idSubject' => $set_of_idSubject, 
				                      'cls_datePost' => $current_date,
									  'cls_idMember' => $user_id);
				$this -> load -> model('news');
				$last_id = $this -> news -> insert_news($array_insert);

				//update for relative news
				if (isset($_POST['arrIdNews'])) {
					for ($i = 0; $i < count($arr_id_news); $i++) {
						$tmp = $this -> input -> post('arrIdNews');
						$select = 'cls_idRelativeNews,tbl_news.cls_idNews';
						$id = $tmp[$i];
						$array_where = array('cls_acceptNews' => 1, 'tbl_news.cls_idNews' => $id);
						$array_like = array();
						$order_by = array();
						$row = $this -> news -> get_news($select, $array_where, $array_like, 0, 500, $order_by);
						if ($row != null) {
							foreach ($row as $r) {
								$set_of_relative_id_news = $r -> cls_idRelativeNews . ',' . $last_id;
								$data_array = array('cls_idRelativeNews' => $set_of_relative_id_news);
								$array_where = array('cls_idNews' => $r -> cls_idNews);
								$this -> news -> update_news($data_array, $array_where);
							}
						}
					}
				}

				//end update
				$state = array('ok' => 1, 'idNews' => $last_id);
				echo json_encode($state);
			}
		}
	}

	function accept_news() {
		if (isset($_POST)) {
			if (count($_POST['id_news']) > 0)
				for ($i = 0; $i < count($_POST['id_news']); $i++) {
					$id_news = mysql_real_escape_string($_POST['id_news'][$i]);
					$data_array = array('cls_acceptNews' => 1);
					$array_where = array('cls_idNews' => $id_news);
					$this -> news -> update_news($data_array, $array_where);
				}
		}
	}

	function reject_news() {
		if (isset($_POST['id_news'])) {
			if (count($_POST['id_news']) > 0)
				for ($i = 0; $i < count($_POST['id_news']); $i++) {
					$id_news = mysql_real_escape_string($_POST['id_news'][$i]);
					$data_array = array('cls_acceptNews' => 0);
					$array_where = array('cls_idNews' => $id_news);
					$this -> news -> update_news($data_array, $array_where);
				}
		}
	}

	function update_content_news() {
		if (isset($_POST['idNews'])) {
			$idNews = $this -> input -> post('idNews');
			$content = $this -> input -> post('content');
			$data_array = array('cls_content' => $content);
			$array_where = array('cls_idNews' => $idNews);
			$this -> news -> update_news($data_array, $array_where);
			echo 'Cáº­p nháº­t thÃ nh cÃ´ng';
		}
	}

	function update_title_news() {
		if (isset($_POST['idNews'])) {
			$idNews = $this -> input -> post('idNews');
			$content = $this -> input -> post('title');
			$data_array = array('cls_title' => $content);
			$array_where = array('cls_idNews' => $idNews);
			$this -> news -> update_news($data_array, $array_where);
			echo 'Cáº­p nháº­t thÃ nh cÃ´ng';
		}
	}

	function update_pseu_news() {
		if (isset($_POST['idNews'])) {
			$idNews = $this -> input -> post('idNews');
			$content = $this -> input -> post('pseu');
			$data_array = array('cls_pseu' => $content);
			$array_where = array('cls_idNews' => $idNews);
			$this -> news -> update_news($data_array, $array_where);
			echo 'Cáº­p nháº­t thÃ nh cÃ´ng';
		}
	}

	function update_date_post() {
		if (isset($_POST['idNews'])) {
			$idNews = $this -> input -> post('idNews');
			$date_post = date('Y-m-d H:i', strtotime($this -> input -> post('date_post')));
			$data_array = array('cls_datePost' => $date_post);
			$array_where = array('cls_idNews' => $idNews);
			$this -> news -> update_news($data_array, $array_where);
			echo 'Cáº­p nháº­t thÃ nh cÃ´ng';
		}
	}

	function add_relative_news() {
		if (isset($_POST['arrIdNews'])) {
			$idNews = $this -> input -> post('idNews');
			$news = $this -> news -> get_news_by_id_news($idNews);
			$arr_id_add_relative_news = $this -> input -> post('arrIdNews');
			$tmp = $news[0] -> cls_idRelativeNews;
			$arr_id_relative_news = explode(',', $tmp);
			$set_of_id_relative_news = $tmp;

			for ($i = 0; $i < count($arr_id_add_relative_news); $i++) {
				if ($tmp != null) {
					for ($k = 0; $k < count($arr_id_relative_news); $k++) {
						if ($arr_id_relative_news[$k] != null) {
							if ($arr_id_add_relative_news[$i] != $arr_id_relative_news[$k]) {
								$set_of_id_relative_news .= ',' . $arr_id_add_relative_news[$i];
							}
						}
					}
				} else {
					$set_of_id_relative_news .= ',' . $arr_id_add_relative_news[$i];
				}
			}

			$data_array = array('cls_idRelativeNews' => $set_of_id_relative_news);
			$array_where = array('cls_idNews' => $idNews);
			$this -> news -> update_news($data_array, $array_where);
			//end update cho tin hien tai

			//update cho cac tin khac
			for ($i = 0; $i < count($arr_id_add_relative_news); $i++) {
				$id = $arr_id_add_relative_news[$i];
				$news = $this -> news -> get_news_by_id_news($id);
				$tmp = $news[0] -> cls_idRelativeNews;
				$arr_id_relative_news = explode(',', $tmp);
				$set_of_id_relative_news = $tmp;
				$flag = TRUE;
				for ($k = 0; $k < count($arr_id_relative_news); $k++) {
					if ($idNews == $arr_id_relative_news[$k]) {
						$flag = FALSE;
						break;
					}
				}
				if ($flag == TRUE) {
					$set_of_id_relative_news .= ',' . $idNews;
					$data_array = array('cls_idRelativeNews' => $set_of_id_relative_news);
					$array_where = array('cls_idNews' => $id);
					$this -> news -> update_news($data_array, $array_where);
				}
			}
			//end update cho cac tin khac
		}
	}

	function remove_relative_news() {
		if (isset($_POST['idNews']) && isset($_POST['arrIdNews'])) {

			$idNews = $this -> input -> post('idNews');
			$news = $this -> news -> get_news_by_id_news($idNews);
			$arr_id_relative_news = $news[0] -> cls_idRelativeNews;
			$arr_id_remove_relative_news = $this -> input -> post('arrIdNews');

			//update cho tin hien tai
			$pattern = "";
			$tmp = "";
			for ($i = 0; $i < count($arr_id_remove_relative_news); $i++) {
				$tmp .= '|,' . $arr_id_remove_relative_news[$i];
			}

			$pattern = '(' . $tmp . ')';
			$set_of_id_relative_news = preg_replace($pattern, "", $arr_id_relative_news);
			$data_array = array('cls_idRelativeNews' => $set_of_id_relative_news);
			$array_where = array('cls_idNews' => $idNews);
			$this -> news -> update_news($data_array, $array_where);
			//end update cho tin hien tai

			//update cho tin khac
			for ($i = 0; $i < count($arr_id_remove_relative_news); $i++) {
				$news = $this -> news -> get_news_by_id_news($arr_id_remove_relative_news[$i]);
				$arr_id_relative_news = $news[0] -> cls_idRelativeNews;
				$tmp = "";
				$pattern = '/,' . $idNews . '/';
				$set_of_id_relative_news = preg_replace($pattern, "", $arr_id_relative_news);
				$data_array = array('cls_idRelativeNews' => $set_of_id_relative_news);
				$array_where = array('cls_idNews' => $arr_id_remove_relative_news[$i]);
				$this -> news -> update_news($data_array, $array_where);
			}
			//end update cho tin khac
		}
	}

    function apply_comment(){
    	if(isset($_POST['id_news'])){
    	  $id_news=$this->input->post('id_news');
		  $this->news->apply_comment($id_news);
    	}
    }
	
	function reject_comment(){
		if(isset($_POST['id_news'])){
		  $id_news=$this->input->post('id_news');
		  $this->news->reject_comment($id_news);
		}
	}
}
?>
