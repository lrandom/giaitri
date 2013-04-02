<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
if (!function_exists('show_thumb')) {
	function show_thumb($obj, $width, $height, $class = '') {
		echo '<img src="' . base_url() . 'index.php/thumb/view/w/'.$width.'/h/'.$height.'/src/';
		if(isset($obj->cls_linkImages)){
		  echo $obj->cls_linkImages;
		}else{
		  if(isset($obj->cls_linkthumb)){
		  	echo $obj->cls_linkthumb;
		  }else{
		    echo base_url().'resource/no_thumb.jpg';
		  }
		}
		
		echo '"  alt="';
		if (isset($obj -> cls_caption)) {
			echo $obj -> cls_caption;
		} else {
			echo $obj -> cls_title;
		}
		echo '"';
		if ($class != '') {
			echo ' class="' . $class . '"';
		}
		echo ' title="';
		if (isset($obj -> cls_title)) {
			echo $obj -> cls_title;
		} else {
			echo $obj -> cls_caption;
		}
		echo '" width="' . $width . '" height="' . $height . '"/>';
	}

}
?>