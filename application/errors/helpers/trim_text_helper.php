<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!function_exists('trim_text')) {
	function trim_text($input, $length, $ellipses = true, $strip_html = true) {
		//strip tags, if desired
		$input = word_limiter($input, $length);
		if ($strip_html) {
			$input = strip_tags(html_entity_decode(htmlspecialchars_decode($input), ENT_NOQUOTES, 'utf-8'));
			//preg_replace('/&#8230;/', '...', $input);
		}

		//add ellipses (...)
		if ($ellipses) {
			//$trimmed_text .= '...';
		}
		return $input;
	}

}
?>