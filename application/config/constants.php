<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*
 |--------------------------------------------------------------------------
 | File and Directory Modes
 |--------------------------------------------------------------------------
 |
 | These prefs are used when checking and setting modes when working
 | with the file system.  The defaults are fine on servers with proper
 | security, but you may wish (or even need) to change the values in
 | certain environments (Apache running a separate process for each
 | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
 | always be used to set the mode correctly.
 |
 */
 define('FILE_READ_MODE', 0644);
 define('FILE_WRITE_MODE', 0666);
 define('DIR_READ_MODE', 0755);
 define('DIR_WRITE_MODE', 0777);

/*
 |--------------------------------------------------------------------------
 | File Stream Modes
 |--------------------------------------------------------------------------
 |
 | These modes are used when working with fopen()/popen()
 |
 */

 define('FOPEN_READ', 'rb');
 define('FOPEN_READ_WRITE', 'r+b');
 define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb');
// truncates existing file data, use with care
 define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b');
// truncates existing file data, use with care
 define('FOPEN_WRITE_CREATE', 'ab');
 define('FOPEN_READ_WRITE_CREATE', 'a+b');
 define('FOPEN_WRITE_CREATE_STRICT', 'xb');
 define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');


 /* End of file constants.php */
 /* Location: ./application/config/constants.php */
 define('PROJECT_TITLE', 'THUGIAN');
 define('ACTIVED_STATE', 1);
 define('DISABLED_STATE', 0);
 define('SESS_LOGIN_KEY', 'user_loged');

 /*Define exception view*/
 define('NOT_FOUND_VIEW', '');
 define('ADMIN_LOGIN_VIEW', '');
 define('DENY_VIEW', '');
 /*End*/

 /*Define role code */
 define('ACC_ROLE', 'acc_role');
 define('ACC_USER', 'acc_user');
 define('ACC_APP', 'acc_app');
 define('ACC_CATEGORY', 'acc_cat');
 define('ACC_COMMENT', 'acc_comment');
 define('ACC_LOGO', 'acc_logo');
 define('ACC_SETTING', 'acc_setting');
 define('ACC_BANNER', 'acc_banner');
 define('ACC_FILLE', 'acc_file');
 define('ACC_STATISTIC', 'acc_statistic');
/*end*/

 /*Define CRUD messager*/
 define('ADD_SUCCESS_MSG', 'Thêm thành công');
 define('ADD_FAILED_MSG', 'Thêm thất bại');
 define('DEL_FAILED_MSG', 'Xóa thất bại');
 define('DEL_SUCCESS_MSG', 'Xóa thành công');
 define('EDIT_SUCCESS_MSG', 'Sửa thành công');
 define('EDIT_FAILED_MSG', 'Sửa thất bại');
 define('BASE_USER_MSG_WARRNING', 'Bạn không thể xóa vai trò này vì đây là vai trò cơ bản');

 /*Define base role*/
 define('HIGHEST_ROLE_ID', '1');
 define('LOWEST_ROLE_ID', '2');

 define('ADD_LABEL', 'Thêm');
 define('EDIT_LABEL', 'Sửa');
 define('DELETE_LABEL', 'Xóa');
 define('BACK_LABEL', 'Quay lại');

 /*define alert state and msg */
 define('ALERT_STATE_SUCCESS', 'success');
 define('ALERT_STATE_FAILED', 'error');
 define('ALERT_STATE_INFO', 'dismiss');
 /*end define*/

 /*define default thumbnail path*/
 define('THUMB_DEFAULT_PATH','resources/no_thumb.jpg');
/*end*/


 /*define root folder application*/
 define('ROOT_FOLDER_APP', $_SERVER['DOCUMENT_ROOT'] . '/giaitri/');
/*end define*/

 /*define folder upload*/
 define('PATH_UPLOAD_FOLDER', 'uploads');
 define('PATH_AVTS_FOLDER', 'uploads/avts');
 define('PATH_ARTICLES_FOLDER', 'uploads/articles');
 define('PATH_OWN_IMAGES_ARTICLES_FOLDER', 'uploads/articles/own/images');
 define('PATH_OWN_VIDEO_ARTICLES_FOLDER', 'uploads/articles/own/videos');
 define('PATH_PUBLIC_ARTICLES_FOLDER','uploads/articles/public');
 define('PATH_ADVER_FOLDER', 'uploads/articles/advers');
 define('PATH_LOGO_FOLDER', 'uploads/logos');
 define('THUMB_FOLDER','thumb');
/*end define*/

 /*define type upload label*/
 define('IMAGE_UPLOAD_LABEL','image');
 define('THUMB_UPLOAD_LABEL','thumb');
 define('VIDEO_UPLOAD_LABEL','video');
/*end define*/

 /*define allow type upload*/
 define('VIDEO_UPLOAD_MIME','mp4|flv|3gp');
 define('THUMB_UPLOAD_MIME','gif|png|jpg|jpeg');
 define('IMAGES_UPLOAD_MIME','gif|png|jpg|jpeg');
 /*end define*/

 /*define video max upload file size*/
 define("VIDEO_UPLOAD_MAX_FILE_SIZE",120);//120mb
 define('IMAGE_UPLOAD_MAX_FILE_SIZE',3);//3mb
 /*end define*/

/*define specical view path*/
define('LOGIN_FAILED_VIDEW', '');
define('404_VIEW','');