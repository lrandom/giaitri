<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!function_exists('random_banner')) {
	function random_banner($id_position) {
		$adver_index_pos = 'adver_index_pos' . $id_position;
		$CI = &get_instance();
		$adver_pos = $CI -> adver -> get_adver_available_index($id_position);
		if ($adver_pos != NULL) {
			if (isset($_SESSION[$adver_index_pos])) {
				$tmp = $_SESSION[$adver_index_pos];
				if ($tmp > count($adver_pos) || count($adver_pos) == 1) {
					$i = 0;
				} else {
					do {
						$i = rand(0, count($adver_pos) - 1);
					} while($i==$tmp);
				}
			} else {
				$i = 0;
			}
			$_SESSION[$adver_index_pos] = $i;
			return $adver_pos[$i];
		} else {
			return NULL;
		}
	}

}

if (!function_exists('random_forum_banner')) {
	function random_forum_banner($id_position, $id_subject) {
		$adver_forum_pos = 'adver_forum_pos' . $id_position;
		$CI = &get_instance();
		$adver_pos = $CI -> adver -> get_adver_available_forum($id_position, $id_subject);
		if ($adver_pos != NULL) {
			if (isset($_SESSION[$adver_forum_pos])) {
				$tmp = $_SESSION[$adver_forum_pos];
				if ($tmp > count($adver_pos) || count($adver_pos) == 1) {
					$i = 0;
				} else {
					do {
						$i = rand(0, count($adver_pos) - 1);
					} while($i==$tmp);
				}
			} else {
				$i = 0;
			}
			$_SESSION[$adver_forum_pos] = $i;
			return $adver_pos[$i];
		} else {
			return NULL;
		}
	}

}

if (!function_exists('random_thread_banner')) {
	function random_thread_banner($id_position, $id_subject) {
		$adver_thread_pos = 'adver_forum_pos' . $id_position;
		$CI = &get_instance();
		$adver_pos = $CI -> adver -> get_adver_available_forum($id_position, $id_subject);
		if ($adver_pos != NULL) {
			if (isset($_SESSION[$adver_thread_pos])) {
				$tmp = $_SESSION[$adver_thread_pos];
				if ($tmp > count($adver_pos) || count($adver_pos) == 1) {
					$i = 0;
				} else {
					do {
						$i = rand(0, count($adver_pos) - 1);
					} while($i==$tmp);
				}
			} else {
				$i = 0;
			}
			$_SESSION[$adver_thread_pos] = $i;
			return $adver_pos[$i];
		} else {
			return NULL;
		}
	}
}
?>