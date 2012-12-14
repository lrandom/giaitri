<?php
/**
 *
 */
class Logo extends CI_Controller {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Bangkok');
        $this -> load -> library('session');
        $this -> load -> helper('url');
        $this -> load -> helper('text');
        $this -> load -> helper('trim_text');
        $this -> load -> database();
        $this -> load -> model('logo');
    }

    function index() {

    }

    function get_logo() {
        $select = '*';
        $array_where = array();
        $array_like = array();
        if (isset($_POST['page'])) {
            $page = $this -> input -> post('page');
        } else {
            $page = 1;
        }

        if (isset($_POST['rows'])) {
            $offset = $this -> input -> post('rows');
        } else {
            $offset = 10;
        }

        if (isset($_POST['q_name']) && isset($_POST['q_value'])) {
            switch ($_POST['q_name']) {
                case 'id' :
                    $q_value = $this -> input -> post('q_value');
                    $array_where = array();
                    $array_like = array();
                    $array_where['cls_idLogo'] = $q_value;
                    break;

                default :
                    break;
            }
        }

        if (isset($_POST['q_view'])) {
            switch ($_POST['q_view']) {
                case 'v_on' :
                    $array_where = array();
                    $array_like = array();
                    $array_where['cls_status'] = 1;
                    break;

                case 'v_off' :
                    $array_where = array();
                    $array_like = array();
                    $array_where['cls_status'] = 0;
                    break;

                case 'v_all' :
                    $array_where = array();
                    $array_like = array();
                    break;
                default :
                    break;
            }
        }

        if (isset($_POST['sort']) && isset($_POST['order'])) {
            $sort = $this -> input -> post('sort');
            $order = $this -> input -> post('order');
            $order_by = array($sort => $order);
        } else {
            $order_by = array('cls_idLogo' => 'DESC');
        }

        $first = ($page - 1) * $offset;
        $total = $this -> logo -> total($array_where, $array_like);
        $result['total'] = $total;
        $rows = $this -> logo -> get_logo($select, $array_where, $array_like, $first, $offset, $order_by);
        if ($rows != null) {
            foreach ($rows as $r) {
                if ($r -> cls_status == 1) {
                    $r -> cls_status = 'Ä�ang báº­t';
                } else {
                    $r -> cls_status = 'Ä�ang táº¯t';
                }
            }
            $result['rows'] = $rows;
        } else {
            $result['rows'] = 0;
        }

        echo json_encode($result);
    }

    function show_form_add_logo() {
        $this -> load -> view('admin/form/frmAddLogo');
    }

    function turn_on_logo() {
        if (isset($_POST)) {
            for ($i = 0; $i < count($_POST['id_logo']); $i++) {
                $id = mysql_real_escape_string($_POST['id_logo'][$i]);
                $data_array = array('cls_status' => 0);
                $array_where = array();
                
                $this -> logo -> update_news($data_array, $array_where);
                $data_array = array('cls_status' => 1);
                $array_where = array('cls_idLogo' => $id);
                $this -> logo -> update_news($data_array, $array_where);
            }
        }
    }
   
   function remove_logo(){
       if(isset($_POST)){
         for ($i = 0; $i < count($_POST['id_logo']); $i++) {
                $id = mysql_real_escape_string($_POST['id_logo'][$i]);
                $logo=$this->logo->get_logo_by_id($id);
                $ab_path=BASE_DIR.$logo[0]->cls_path;
                unlink($ab_path);
                $array_where=array('cls_idLogo'=>$id);
                $this->logo->remove_logo($array_where);
            }
       }
   }
}
?>
