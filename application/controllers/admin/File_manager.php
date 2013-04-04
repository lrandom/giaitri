<?php
/**
 *
 */
class File_manager extends CI_Controller {

	function __construct() {
		parent::__construct();
		session_start();
		date_default_timezone_set('Asia/Bangkok');
	}

	function index() {
		$data['title'] = 'Quản lí file';
		$this -> load -> view('back_end/main_file', $data);
	}

	function file_upload_browser() {
		if(isset($_GET['type'])){
			$data['type']=$this->input->get('type');
			$data['title'] = 'Duyệt file';
			$data['file_browser_init_controller']=base_url().'admin/file_manager/own_browser_upload_folder_init?type=';
			$data['swf_jwplayer_path']=base_url().'player/player.swf';
			$this -> load -> view('back_end/form/frmBrowserFile', $data);	
		}
	}
	
	function thumbnail_upload_browser(){
		if(isset($_GET['type'])){
			$data['type']=$this->input->get('type');
			$data['title'] = 'Duyệt ảnh đại diện bài viết';
			$data['file_browser_init_controller']=base_url().'admin/file_manager/own_browser_upload_folder_init?type=';
			$this -> load -> view('back_end/form/frmBrowserThumbnail', $data);	
		}
	}

	function elfinder_init() {
		$this -> load -> helper('path');
		$opts = array('debug' => true, 'roots' => array( array('driver' => 'LocalFileSystem', 'path' => set_realpath('uploads'), 'URL' => base_url() . 'uploads/')));
		$this -> load -> library('elfinder_lib', $opts);
	}

	function own_browser_upload_folder_init() {
		if (isset($_GET['type'])) {
			$url = $this -> input -> get('url');
			$this -> load -> library('ultils');
			$this -> load -> helper('path');
			switch ($this->input->get('type')) {
				case VIDEO_UPLOAD_LABEL:
				$upload_folder = PATH_OWN_VIDEO_ARTICLES_FOLDER .'/'. date('Y') .'/'. date('m') .'/'. date('d');
				if (!$this -> ultils -> check_exist_folder(ROOT_FOLDER_APP . PATH_OWN_VIDEO_ARTICLES_FOLDER .'/'. date('Y'))) {
					mkdir(ROOT_FOLDER_APP . PATH_OWN_VIDEO_ARTICLES_FOLDER .'/'. date('Y'), DIR_WRITE_MODE);
				};

				if (!$this -> ultils -> check_exist_folder(ROOT_FOLDER_APP . PATH_OWN_VIDEO_ARTICLES_FOLDER .'/'. date('Y') .'/'. date('m'))) {
					mkdir(ROOT_FOLDER_APP . PATH_OWN_VIDEO_ARTICLES_FOLDER .'/'. date('Y') .'/'. date('m'), DIR_WRITE_MODE);
				};

				if (!$this -> ultils -> check_exist_folder(ROOT_FOLDER_APP.$upload_folder)) {
					mkdir(ROOT_FOLDER_APP . $upload_folder, DIR_WRITE_MODE);
				};

				if (!$this -> ultils->check_exist_folder(ROOT_FOLDER_APP.$upload_folder.'/'.THUMB_FOLDER)){
					mkdir(ROOT_FOLDER_APP.$upload_folder.'/'.THUMB_FOLDER,DIR_WRITE_MODE);
				};

				$opts = array(
					'debug' => true,
					'roots' => array( 
						array('driver' => 'LocalFileSystem', 'path' => set_realpath($upload_folder),
							'URL' => base_url() . $upload_folder . '/',
							'uploadAllow'  => array('video/x-flv','video/mp4'),
							'uploadDeny'   => array('all'),
							'uploadOrder'  => 'deny,allow',
							'attributes'   =>  array(
                            array(  // show everything starting with '/public'
                            	'pattern' => '/.thumb/',
                            	'hidden' => true
                            	),
                             array(  // show everything starting with '/public'
                             	'pattern' => '/.tmb/',
                             	'hidden' => true
                             	)
                             )
							),
						)
					);
				$this -> load -> library('elfinder_lib', $opts);
				break;

				case IMAGE_UPLOAD_LABEL :
				$upload_folder = PATH_OWN_IMAGES_ARTICLES_FOLDER .'/'. date('Y') .'/'. date('m') .'/'. date('d');
				if (!$this -> ultils -> check_exist_folder(ROOT_FOLDER_APP . PATH_OWN_IMAGES_ARTICLES_FOLDER .'/'. date('Y'))) {
					mkdir(ROOT_FOLDER_APP . PATH_OWN_IMAGES_ARTICLES_FOLDER .'/'. date('Y'), DIR_WRITE_MODE);
				};

				if (!$this -> ultils -> check_exist_folder(ROOT_FOLDER_APP . PATH_OWN_IMAGES_ARTICLES_FOLDER .'/'. date('Y') .'/'. date('m'))) {
					mkdir(ROOT_FOLDER_APP . PATH_OWN_IMAGES_ARTICLES_FOLDER .'/'. date('Y') .'/'. date('m'), DIR_WRITE_MODE);
				};

				if (!$this -> ultils -> check_exist_folder(ROOT_FOLDER_APP.$upload_folder)) {
					mkdir(ROOT_FOLDER_APP . $upload_folder, DIR_WRITE_MODE);
				};

				$opts = array(
					'debug' => true,
					'roots' => array(
						array(
							'driver' => 'LocalFileSystem',
							'path' => set_realpath($upload_folder),
							'URL' => base_url() . $upload_folder,
							'uploadAllow'  => array('image'),
							'uploadDeny'   => array('all'),
							'uploadOrder'  => 'deny,allow',
							'attributes'   =>  array(
                            array(  // show everything starting with '/public'
                            	'pattern' => '/.thumb/',
                            	'hidden' => true
                            	),
                             array(  // show everything starting with '/public'
                             	'pattern' => '/.tmb/',
                             	'hidden' => true
                             	)
                             )
							)
						)
					);
				$this -> load -> library('elfinder_lib', $opts);
				break;

				case THUMB_UPLOAD_LABEL:
				$upload_folder = PATH_OWN_IMAGES_ARTICLES_FOLDER .'/'. date('Y') .'/'. date('m') .'/'. date('d') .'/'.THUMB_FOLDER;
				if (!$this -> ultils -> check_exist_folder(ROOT_FOLDER_APP . PATH_OWN_IMAGES_ARTICLES_FOLDER .'/'. date('Y'))) {
					mkdir(ROOT_FOLDER_APP . PATH_OWN_IMAGES_ARTICLES_FOLDER .'/'. date('Y'), DIR_WRITE_MODE);
				};

				if (!$this -> ultils -> check_exist_folder(ROOT_FOLDER_APP . PATH_OWN_IMAGES_ARTICLES_FOLDER .'/'. date('Y') .'/'. date('m'))) {
					mkdir(ROOT_FOLDER_APP . PATH_OWN_IMAGES_ARTICLES_FOLDER .'/'. date('Y') .'/'. date('m'), DIR_WRITE_MODE);
				};

				if (!$this -> ultils -> check_exist_folder(ROOT_FOLDER_APP . PATH_OWN_IMAGES_ARTICLES_FOLDER .'/'. date('Y') .'/'. date('m').'/'.date('d'))) {
					mkdir(ROOT_FOLDER_APP . PATH_OWN_IMAGES_ARTICLES_FOLDER .'/'. date('Y') .'/'. date('m').'/'.date('d'), DIR_WRITE_MODE);
				};

				if (!$this -> ultils -> check_exist_folder(ROOT_FOLDER_APP.$upload_folder)) {
					mkdir(ROOT_FOLDER_APP . $upload_folder, DIR_WRITE_MODE);
				};
				$opts = array(
					'debug' => true,
					'roots' => array( 
						array(
							'driver' => 'LocalFileSystem',
							'path' => set_realpath($upload_folder),
							'URL' => base_url() . $upload_folder,
							'uploadAllow'  => array('image'),
							'uploadDeny'   => array('all'),
							'uploadOrder'  => 'deny,allow',
							'attributes'   =>  array(
                            array(  // show everything starting with '/public'
                            	'pattern' => '/.thumb/',
                            	'hidden' => true
                            	),
                             array(  // show everything starting with '/public'
                             	'pattern' => '/.tmb/',
                             	'hidden' => true
                             	)
                             )
							))
					);
				$this -> load -> library('elfinder_lib', $opts);
				break;
			}
		}
	}

	function uploadVideoArticle(){
		if(isset($_FILES['Filedata']) && isset($_POST['title']) && isset($_POST['catId'])){
			$this -> load -> library('ultils');
			$upload_folder = PATH_OWN_VIDEO_ARTICLES_FOLDER .'/'. date('Y') .'/'. date('m') .'/'. date('d');
			if (!$this -> ultils -> check_exist_folder(ROOT_FOLDER_APP . PATH_OWN_VIDEO_ARTICLES_FOLDER .'/'. date('Y'))) {
				mkdir(ROOT_FOLDER_APP . PATH_OWN_VIDEO_ARTICLES_FOLDER .'/'. date('Y'), DIR_WRITE_MODE);
			};

			if (!$this -> ultils -> check_exist_folder(ROOT_FOLDER_APP . PATH_OWN_VIDEO_ARTICLES_FOLDER .'/'. date('Y') .'/'. date('m'))) {
				mkdir(ROOT_FOLDER_APP . PATH_OWN_VIDEO_ARTICLES_FOLDER .'/'. date('Y') .'/'. date('m'), DIR_WRITE_MODE);
			};

			if (!$this -> ultils -> check_exist_folder(ROOT_FOLDER_APP.$upload_folder)) {
				mkdir(ROOT_FOLDER_APP . $upload_folder, DIR_WRITE_MODE);
			};

			if (!$this -> ultils->check_exist_folder(ROOT_FOLDER_APP.$upload_folder.'/'.THUMB_FOLDER)){
				mkdir(ROOT_FOLDER_APP.$upload_folder.'/'.THUMB_FOLDER,DIR_WRITE_MODE);
			};
			$title=$this->input->post('title');
			$catId=$this->input->post('catId');
			$config['upload_path'] = $upload_folder;
			$config['allowed_types'] = VIDEO_UPLOAD_MIME;
			$config['max_size'] = 1024 * VIDEO_UPLOAD_MAX_FILE_SIZE;
			$config['encrypt_name'] = FALSE;
			$this -> load -> library('upload', $config);
			$this -> upload -> initialize($config);
			$pathInfo=pathinfo($_FILES['Filedata']['name']);
			$_FILES['Filedata']['name']=$this->ultils->get_new_link($title).'.'.$pathInfo['extension'];
			print_r($_FILES['Filedata']);
			if ($this -> upload -> do_upload('Filedata')) {
				//CREATE THUMBNAIL
				$this->load->library('GenThumbVideo');
				$data=$this->upload->data();
				$thumbCreator=new GenThumbVideo();
				$thumbPath=str_replace(ROOT_FOLDER_APP,'',$thumbCreator->createThumb($data['file_path'], $data['file_name'], $width = 350, $height =   220));
				$this->load->model('Video_model');
				$this->Video_model->insert_video(
					array(
						'path'=>str_replace(ROOT_FOLDER_APP,'',$data['full_path']),
						'title'=>$title,
						'thumb'=>$thumbPath,
						'cat_id'=>$catId,
						'date_create'=>date('Y-m-d H:i:s',time())
						)
					);
				//return json 
				echo json_encode(array('err' => 0, 'msg' => $this -> upload -> display_errors(), 'data' => $this -> upload -> data()));
			} else {
				echo json_encode(array('err' => 1, 'msg' => $this -> upload -> display_errors()));
			};
			$catId=$this->input->post('catId');
			$title=$this->input->post('title');

		}
	}

}
?>