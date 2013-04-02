<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('get_vi_current_time')) {
    function show_vi_current_time() {
        $str_in = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
        $str_out = array("Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy", "Chủ nhật");
        $time = gmdate("D, d/m/Y, H:i", time() + 7 * 3600);
        $time = str_replace($str_in, $str_out, $time);
        return $time;
    }

}

if (!function_exists('show_vi_time_from_my_sql')) {
    function show_vi_time_from_my_sql($str_time_in) {
        $datePost=new DateTime($str_time_in);
        $time=$datePost->format('D, d/m/Y, H:i');
        $str_in = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
        $str_out = array("Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy", "Chủ nhật");
        $time = str_replace($str_in, $str_out, $time);
        return $time;
    }
}
?>