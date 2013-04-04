<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Ultils {
	public function counter_view_thread($idThread) {
		$cookieName = 'article_' . $idThread;
		$CI = &get_instance();
		if (!isset($_COOKIE[$cookieName])) {
			$CI -> load -> model('news');
			$data = $CI -> news -> get_news_by_id_news($idThread);
			$count_of_views = $data[0] -> cls_countViews;
			$count_of_views += 1;
			$data_array = array('cls_countViews' => $count_of_views);
			$array_where = array('cls_idNews' => $idThread);
			$CI -> news -> update_news($data_array, $array_where);
			$CI -> input -> set_cookie($cookieName, $idThread, time() + 3600);
		};
	}

	public function counter_click($id) {
		$cookieName = 'adver_' . $id;
		$CI = &get_instance();
		if (!isset($_COOKIE[$cookieName])) {
			$CI -> load -> model('adver');
			$ip = $CI -> input -> ip_address();
			$curr_date = date('Y-m-d H:i:s', time());
			$CI -> adver -> update_count_click_2($id, $ip, $curr_date);
			$CI -> input -> set_cookie($cookieName, $id, time() + 900);
			return array("success_messager" => "Thay đổi thông tin thành công");
		};
	}

	public function counter_view_video($id) {
		$cookieName = 'video_' . $id;
		$CI = &get_instance();
		if (!isset($_COOKIE[$cookieName])) {
			$CI -> load -> model('video');
			$data = $CI -> video -> get_video_by_id($id, 0, 10);
			$count_of_views = $data[0] -> cls_count_views;
			$count_of_views += 1;
			$data_array = array('cls_count_views' => $count_of_views);
			$array_where = array('cls_idVideo' => $id);
			$CI -> video -> update_video($data_array, $array_where);
			$CI -> input -> set_cookie($cookieName, $id, time() + 900);
		};
	}

	public function voted() {
		$cookieName = 'voted' . md5(time());
		$CI = &get_instance();
		if (isset($_COOKIE[$cookieName])) {
			$CI -> load -> model('poll');
			$this -> poll -> update_poll();
			return 1;
		} else {
			$CI -> input -> set_cookie($cookieName, $CI -> input -> ip_address(), time() + 86400);
			return 0;
		}
	}

	static function check_empty_folder($dir) {
		$files = array();
		if ($handle = opendir($dir)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
					$files[] = $file;
				}
			}
			closedir($handle);
		}
		return (count($files) > 0) ? FALSE : TRUE;
	}

	static function check_exist_folder($dir) {
		if (file_exists($dir) && is_dir($dir)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	
	static function get_new_link($word) {
		$ttk = array('a' => array('ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ', 'Ặ', 'á', 'à', 'ả', 'ã', 'ạ', 'â', 'ă', 'Á', 'À', 'Ả', 'Ã', 'Ạ', 'Â', 'Ă'), 'e' => array('ế', 'ề', 'ể', 'ễ', 'ệ', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ', 'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê'), 'i' => array('í', 'ì', 'ỉ', 'ĩ', 'ị', 'Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị'), 'o' => array('ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'Ố', 'Ồ', 'Ổ', 'Ô', 'Ộ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ', 'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ơ', 'Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ơ'), 'u' => array('ứ', 'ừ', 'ử', 'ữ', 'ự', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư'), 'y' => array('ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ', 'Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ'), 'd' => array('đ', 'Đ'), );
		foreach ($ttk as $key => $arr) {
			foreach ($arr as $val) {
				$word = str_replace($val, $key, $word);
			}

		}
		$word=rtrim($word);
		$word=ltrim($word);
		$word= preg_replace('/[^a-zA-Z0-9\s]/', '', $word);
		$new_word = str_replace(' ', '-', strtolower($word));
		return $new_word;
	}
	
	static function _encrypt_password($password){
		return md5(md5($password));
	}
}

/* End of file phpthumb_lib.php */
/* Location: ./system/app/libraries/phpthumb_lib.php */
