<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('curPageURL')) {
    function curPageURL() {
        $isHTTPS = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on");
        $port = (isset($_SERVER["SERVER_PORT"]) && ((!$isHTTPS && $_SERVER["SERVER_PORT"] != "80") || ($isHTTPS && $_SERVER["SERVER_PORT"] != "443")));
        $port = ($port) ? ':' . $_SERVER["SERVER_PORT"] : '';
        $url = ($isHTTPS ? 'https://' : 'http://') . $_SERVER["SERVER_NAME"] . $port . $_SERVER["REQUEST_URI"];
        return $url;
        return $pageURL;
    }
}
?>