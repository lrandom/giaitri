<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!function_exists('generate_image')) {
    function generate_image($img, $width, $height) {
		$path_parts = pathinfo($img);
		$ext = $path_parts['extension'];
		//echo $ext;
		$imge = NULL;
		$ext=strtolower($ext);
		switch ($ext) {
			case 'jpg' :
			case 'jpeg' :
				$imge = imagecreatefromjpeg($img);
				break;

			case 'gif' :
				$imge = imagecreatefromgif($img);
				break;

			case 'png' :
				$imge = imagecreatefrompng($img);
				break;
			default :
				$imge = NULL;
				break;
		}
		if ($imge != NULL) {
			$img_w = imagesx($imge);
			$img_h = imagesy($imge);
			$img_tmp = imagecreatetruecolor($width, $height);
			imagecopyresampled($img_tmp, $imge, 0, 0, 0, 0, $width, $height, $img_w, $img_h);
		    header("Content-disposition: filename=$img;");
		    header('Content-transfer-Encoding: binary');
		    header('Last-modified: '.gmdate('D, d M Y H:i:s'));
			switch ($ext) {
				case 'jpg' :
					if (imagetypes() & IMG_JPG) {
					 header('Content-Type: image/jpg');
					 imagejpeg($img_tmp);
					}
					break;
					
				case 'jpeg' :
					if (imagetypes() & IMG_JPEG) {
					 header('Content-Type: image/jpeg');
					 imagejpeg($img_tmp);
					}
					break;

				case 'gif' :
					if (imagetypes() & IMG_GIF) {
					  header('Content-Type: image/gif');
					  imagejpeg($img_tmp);
					}
					break;

				case 'png' :
				    if (imagetypes() & IMG_PNG) {
					  header('Content-Type: image/png');
					  imagejpeg($img_tmp);
					}
					break;
			}
		}

	}
}
?>