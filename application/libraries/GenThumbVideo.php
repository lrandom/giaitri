<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 * PHPThumb wrapper for CodeIgniter
 *
 * @package			CodeIgniter
 * @subpackage	    Libraries
 * @category		Video generate
 * @author			luan nguyen<luann4099@gmail.com>
 * @link			http://toptep.net
 *
 */

class GenThumbVideo{
	public $abLinkThumb;
	public function createThumb($abVideoPath,$videoName, $width = 350, $height = 220) {
		$loadSuccess = extension_loaded('ffmpeg');
		if ($loadSuccess) {
			$movie = new ffmpeg_movie(str_replace('//','/',$abVideoPath.'/'.$videoName));
			if ($movie) {
				$totalFrame = 0;
				$frame = $movie -> getFrame(100);
				if ($frame) {
					$images = $frame -> toGDImage();
					if ($images) {
						$thumbName = preg_replace("/\\.[^.\\s]{3,4}$/", "", $videoName) . '.jpg';
						if(!file_exists($abVideoPath.'/'.THUMB_FOLDER.'/')){
							mkdir($abVideoPath.'/'.THUMB_FOLDER . '/',DIR_WRITE_MODE); 
						}
						$thumbPath = $abVideoPath.'/'.THUMB_FOLDER .'/' . $thumbName;
						imagejpeg($images, $thumbPath);
						$this -> abLinkThumb = $abVideoPath.THUMB_FOLDER.'/' . $thumbName;
						return($this->abLinkThumb);
					}
				} else {
					//do something
				}
			} else {
				//do something
			}
		} else {
			//do something
		}
	}
}
?>