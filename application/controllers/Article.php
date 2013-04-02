<?php
/**
 *
 */
class Article extends CI_Controller {

	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Bangkok');
	}

	function index() {
		$this -> load -> model('Article_model');
		$where = array();
		$like = array();
		if ($this -> input -> get('action')) {
			$action = $this -> input -> get('action');
			switch ($action) {
				case 'delete' :
				$id = intval($this -> input -> get('id'));
				if ($id) {
					$this -> load -> model('Tag_model');
					$this -> load -> model('Video_model');
					$this -> Tag_model -> remove_tag_has_articles(array('article_id' => $id));
					$this -> Article_model -> remove_article_by_id($id);
					$data['alert_state'] = ALERT_STATE_SUCCESS;
					$data['alert_msg'] = DEL_SUCCESS_MSG;
				}

				break;

				default :
				break;
			}
		}

		if ($this -> input -> get('show')) {
			$show = $this -> input -> get('show');
			switch ($show) {
				case 'actived' :
				$where['articles.state'] = ACTIVED_STATE;
				break;

				case 'disabled' :
				$where['articles.state'] = DISABLED_STATE;
				break;

				case 'up_today' :
				$where['date(date_post)'] = date('Y-m-d', time());
				break;

				default :
				break;
			}
		}

		if ($this -> input -> get('key_q') && $this -> input -> get('q')) {
			$key_q = $this -> input -> get('key_q');
			$q = $this -> input -> get('q');
			switch ($key_q) {
				case 'id' :
				$where['articles.id'] = $q;
				break;

				case 'title' :
				$like['title'] = $q;
				break;

				case 'content' :
				$like['content'] = $q;
				break;

				case 'uploader' :
				$like['user_name'] = $q;
				break;

				case 'source' :
				$like['source'] = $q;
				break;

				case 'pseu' :
				$like['pseu'] = $q;
				break;

				default :
				break;
			}
		}

		//config and init pagination
		$config = array();
		$config['total_rows'] = $this -> Article_model -> total($where, $like);
		//end config and init pagination

		$page = $this -> input -> get('page') ? $this -> input -> get('page') : 1;
		$order = $this -> input -> get('order') ? $this -> input -> get('order') : 'DESC';
		$per_page = $this -> input -> get('per_page') ? $this -> input -> get('per_page') : 20;

		$data['article_list'] = $this -> Article_model -> get_article("*,articles.id as id,users.id as user_id,articles.state as state", $where, $like, ($page - 1) * $per_page, $per_page, array('articles.id' => $order));
		$data['base_url'] = base_url() . 'article/?order=' . $order;
		$data['sort'] = $order;
		$data['next_sort'] = $order == 'ASC' ? 'DESC' : 'ASC';

		$config['base_url'] = $data['base_url'];
		$config['per_page'] = $per_page;
		$this -> pagination -> initialize($config);
		$data['page_link'] = $this -> pagination -> create_links();
		$data['add_link'] = base_url() . 'article/add';
		$data['title'] = 'Quản lí bài viết';
		$this -> load -> view('back_end/main_article', $data);
	}

	function add() {
		if (isset($_POST['txtTitle'])) {
			$title = $this -> input -> post('txtTitle');
			$thumb = str_replace(base_url(), '', $this -> input -> post('thumb-data'));
			$cat_id = $this -> input -> post('txtCat');

			$list_of_cat_id = '';
			for ($i = 0; $i < count($cat_id); $i++) {
				$list_of_cat_id .= $cat_id[$i] . '|';
			}
			$list_of_cat_id = substr_replace($list_of_cat_id, '', -1);
			$source = $this -> input -> post('txtSource');
			$author = $this -> input -> post('txtAuthor');
			$content = $this -> input -> post('txtContent');
			$intro = $this -> input -> post('txtIntro');
			$list_of_rel_id = $this -> input -> post('set-of-rel-article') == '' ? '' : substr_replace($this -> input -> post('set-of-rel-article'), '', -1);
			$this -> load -> model('Article_model');
			$data_array = array('title' => $title, 'thumb' => $thumb, 'cat_id' => $list_of_cat_id, 'source' => $source, 'author' => $author, 'content' => htmlspecialchars($content), 'intro' => $intro, 'state' => DISABLED_STATE, 'date_post' => date('Y-m-d H:i:s', time()), 'user_id' => 2, 'rel_article_id' => $list_of_rel_id);

			$id = $this -> Article_model -> insert_article($data_array);

			if ($this -> input -> post('set-of-tag') != '') {
				$this -> load -> model('Tag_model');
				$set_of_tag = $this -> input -> post('set-of-tag');
				$array_tag_id = explode('|', substr_replace($set_of_tag, '', -1));
				for ($i = 0; $i < count($array_tag_id); $i++) {
					$this -> Tag_model -> insert_tag_has_article(array('tag_id' => $array_tag_id[$i], 'article_id' => $id));
				}
			}
			$data['alert_state'] = ALERT_STATE_SUCCESS;
			$data['alert_msg'] = ADD_SUCCESS_MSG;
		};
		$data['title'] = "Thêm mới bài viết";
		$this -> load -> model('Categories_model');
		$data['back_link'] = base_url() . 'article';
		$data['cat_list'] = $this -> Categories_model -> get_categories_availabel(0, 100);
		$data['video_upload_controller']=base_url().'admin/file_manager/file_upload_browser?type='.VIDEO_UPLOAD_LABEL;
		$data['image_upload_controller']=base_url().'admin/file_manager/file_upload_browser?type='.IMAGE_UPLOAD_LABEL;
		$data['thumb_upload_controller']=base_url().'admin/file_manager/thumbnail_upload_browser?type='.THUMB_UPLOAD_LABEL;
		$data['relative_article_controller']=base_url().'article/get_rel_article';
		$data['get_tag_controller']=base_url().'tag/get_tag';
		$data['add_tag_controller']=base_url().'tag/add_tag';
		$this -> load -> view('back_end/form/frmAddArticle', $data);
	}

	function edit() {
		if ($this -> uri -> segment(3)) {
			$id = intval($this -> uri -> segment(3));
			if ($id) {
				$this -> load -> model('Article_model');
				if (isset($_POST['txtTitle'])) {
					$title = $this -> input -> post('txtTitle');
					$thumb = str_replace(base_url(), '', $this -> input -> post('thumb-data'));
					$cat_id = $this -> input -> post('txtCat');

					$list_of_cat_id = '';
					for ($i = 0; $i < count($cat_id); $i++) {
						$list_of_cat_id .= $cat_id[$i] . '|';
					}
					$list_of_cat_id = substr_replace($list_of_cat_id, '', -1);
					$source = $this -> input -> post('txtSource');
					$author = $this -> input -> post('txtAuthor');
					$content = $this -> input -> post('txtContent');
					$intro = $this -> input -> post('txtIntro');
					$state = $this -> input -> post('txtState');
					
					$list_of_rel_id = $this -> input -> post('set-of-rel-article') == '' ? '' : substr_replace($this -> input -> post('set-of-rel-article'), '', -1);
					$this -> load -> model('Article_model');
					$data_array = array('title' => $title, 'thumb' => $thumb, 'cat_id' => $list_of_cat_id, 'source' => $source, 'author' => $author, 'content' => htmlspecialchars($content), 'intro' => $intro, 'state' => $state, 'date_post' => date('Y-m-d H:i:s', time()), 'user_id' => 2, 'rel_article_id' => $list_of_rel_id);

					$this -> Article_model -> update_article($data_array, array('articles.id' => $id));

					if ($this -> input -> post('set-of-tag') != '') {
						$this -> load -> model('Tag_model');
						$this -> Tag_model -> remove_tag_has_articles(array('article_id' => $id));
						$set_of_tag = $this -> input -> post('set-of-tag');
						$array_tag_id = explode('|', substr_replace($set_of_tag, '', -1));
						for ($i = 0; $i < count($array_tag_id); $i++) {
							$this -> Tag_model -> insert_tag_has_article(array('tag_id' => $array_tag_id[$i], 'article_id' => $id));
						}
					}
					$data['alert_state'] = ALERT_STATE_SUCCESS;
					$data['alert_msg'] = EDIT_SUCCESS_MSG;
				};

				$data['article'] = $this -> Article_model -> get_article_by_id($id);
				if ($data['article'] != null) {
					$data['title'] = 'Thay đổi thông tin bài viết';
					$this -> load -> model('Categories_model');
					$data['cat_list'] = $this -> Categories_model -> get_categories_availabel(0, 100);

					$rel_article = null;
					if ($data['article'][0] -> rel_article_id != null) {
						$rel_article_id = explode('|', $data['article'][0] -> rel_article_id);
						if (count($rel_article_id) != 0) {
							for ($i = 0; $i < count($rel_article_id); $i++) {
								$rel_article[$i] = $this -> Article_model -> get_article_by_id($rel_article_id[$i]);
							}
						}
					}

					$data['rel_article'] = $rel_article;

					$this -> load -> model('Tag_model');
					$data['tags'] = $this -> Tag_model -> get_tag_by_article_id($id);
					$data['back_link'] = base_url() . 'article';
					$data['video_upload_controller']=base_url().'admin/file_manager/file_upload_browser?type='.VIDEO_UPLOAD_LABEL;
					$data['image_upload_controller']=base_url().'admin/file_manager/file_upload_browser?type='.IMAGE_UPLOAD_LABEL;
					$data['thumb_upload_controller']=base_url().'admin/file_manager/thumbnail_upload_browser?type='.THUMB_UPLOAD_LABEL;
					$data['relative_article_controller']=base_url().'article/get_rel_article';
					$data['get_tag_controller']=base_url().'tag/get_tag';
					$data['add_tag_controller']=base_url().'tag/add_tag';					
					$this -> load -> view('back_end/form/frmEditArticle', $data);
				}
			}
		}
	}

	function get_rel_article() {
		if (isset($_GET['q'])) {
			$q = $this -> input -> get('q');
			$this -> load -> model('Article_model');
			$data = $this -> Article_model -> get_article_by_title($q, 0, 100);
			//echo $this->db->last_query();
			echo json_encode($this -> Article_model -> get_article_by_title($q, 0, 100));
		}
	}
}
?>
