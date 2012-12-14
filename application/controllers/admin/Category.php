<?php
/**
 *
 */
class Category extends CI_Controller {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Bangkok');
        $this -> load -> library('session');
        $this -> load -> helper('url');
        $this -> load -> helper('text');
        $this -> load -> helper('trim_text');
        $this -> load -> database();
        $this -> load -> model('subject');
    }

    function index() {

    }

    function get_subject() {
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
                    $array_where['cls_idSubject'] = $q_value;
                    break;
                case 'name_subject' :
                    $q_value = $this -> input -> post('q_value');
                    $array_where = array();
                    $array_like = array();
                    $array_like['cls_nameSubject'] = $q_value;
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
                    $array_where['cls_displayMenu'] = 1;
                    break;

                case 'v_off' :
                    $array_where = array();
                    $array_like = array();
                    $array_where['cls_displayMenu'] = 0;
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
            $order_by = array('cls_idSubject' => 'DESC');
        }

        $first = ($page - 1) * $offset;
        $total = $this -> subject -> total($array_where, $array_like);
        $result['total'] = $total;
        $rows = $this -> subject -> get_subject($select, $array_where, $array_like, $first, $offset, $order_by);
        if ($rows != null) {
            foreach ($rows as $r) {
                if ($r -> cls_displayMenu == 1) {
                    $r -> cls_displayMenu = 'Ä�ang hiá»‡n';
                } else {
                    $r -> cls_displayMenu = 'Ä�ang áº©n';
                }
            }
            $result['rows'] = $rows;
        } else {
            $result['rows'] = 0;
        }

        echo json_encode($result);
    }

    function show_form_add_subject() {
        $select = "*";
        $array_where = array('cls_level < ' => 4);
        $array_like = array();
        $order_by = array('cls_nameSubject' => 'ASC');
        $data['subject'] = $this -> subject -> get_subject($select, $array_where, $array_like, 0, 500, $order_by);
        $this -> load -> view('admin/form/frmAddSubject', $data);
    }

    function show_form_edit_subject() {
        if (!isset($_GET)) {
            return (0);
        }
        $idSubject = mysql_real_escape_string($_GET['idSubject']);
        $data['subject'] = $this -> subject -> get_subject_by_id($idSubject);
        $this -> load -> view('admin/form/frmEditSubject', $data);
    }

    function add_subject() {
        if (isset($_POST)) {
            $nameSubject = mysql_real_escape_string($_POST['nameSubject']);
            $linkDirect = mysql_real_escape_string($_POST['linkDirect']);
            $parentSubject = mysql_real_escape_string($_POST['parentSubject']);
            $levelParent = mysql_real_escape_string($_POST['levelParent']);
            if ($levelParent != '') {
                $level = $levelParent + 1;
            } else {
                $level = 1;
            }
            $data_array = array('cls_nameSubject' => $nameSubject, 'cls_linkWebClone' => $linkDirect, 'cls_targetParent' => $parentSubject, 'cls_level' => $level);

            $this -> subject -> insert_subject($data_array);
            echo json_encode(array('ok' => 1));
        }
    }

    function show_on_top_menu() {
        if (isset($_POST)) {
            for ($i = 0; $i < count($_POST['id_subject']); $i++) {
                $id = mysql_real_escape_string($_POST['id_subject'][$i]);
                $data_array = array('cls_displayMenu' => 1);
                $array_where = array('cls_idSubject' => $id);
                $this -> subject -> update_subject($data_array, $array_where);
            }
        }
    }

    function hide_on_top_menu() {
        if (isset($_POST)) {
            for ($i = 0; $i < count($_POST['id_subject']); $i++) {
                $id = mysql_real_escape_string($_POST['id_subject'][$i]);
                $data_array = array('cls_displayMenu' => 0);
                $array_where = array('cls_idSubject' => $id);
                $this -> subject -> update_subject($data_array, $array_where);
            }
        }
    }

    function remove_subject() {
        if (isset($_POST)) {
            for ($i = 0; $i < count($_POST['id_subject']); $i++) {
                $id = mysql_real_escape_string($_POST['id_subject'][$i]);
                $array_where = array('cls_idSubject' => $id);
                $this -> subject -> remove_subject($array_where);
            }
        }
    }

    function change_name_subject() {
        if (isset($_POST)) {
            $idSubject = mysql_real_escape_string($_POST['idSubject']);
            $nameSubject = mysql_real_escape_string($_POST['nameSubject']);
            if ($nameSubject == "") {
                echo 'TÃªn chuyÃªn má»¥c khÃ´ng Ä‘Æ°á»£c trá»‘ng';
                return (0);
            }

            $array_like = array();
            $array_where = array('cls_idSubject <>' => $idSubject, 'cls_nameSubject' => $nameSubject);
            $exist = $this -> subject -> total($array_where, $array_like);
            if ($exist > 0) {
                echo 'TÃªn chuyÃªn má»¥c nÃ y Ä‘Ã£ tá»“n táº¡i';
                return (0);
            }
            $data_array = array('cls_nameSubject' => $nameSubject);
            $array_where = array('cls_idSubject' => $idSubject);
            $this -> subject -> update_subject($data_array, $array_where);
            echo 'Cáº­p nháº­t thÃ nh cÃ´ng';
        }
    }

    function change_link_direct() {
        if (isset($_POST)) {
            $idSubject = mysql_real_escape_string($_POST['idSubject']);
            $linkDirect = mysql_real_escape_string($_POST['linkDirect']);
            $data_array = array('cls_linkWebClone' => $linkDirect);
            $array_where = array('cls_idSubject' => $idSubject);
            $this -> subject -> update_subject($data_array, $array_where);
            echo 'Cáº­p nháº­t thÃ nh cÃ´ng';
        }
    }

    function change_index_menu() {
        if (isset($_POST)) {
            $idSubject = mysql_real_escape_string($_POST['idSubject']);
            $index = mysql_real_escape_string($_POST['index']);
            if (!is_numeric($index)) {
                echo 'Thá»© tá»± pháº£i lÃ  sá»‘';
                return (0);
            }

            if ($index != 0) {
                $array_like = array();
                $array_where = array('cls_idSubject <>' => $idSubject, 'cls_indexMenu' => $index);
                $exist = $this -> subject -> total($array_where, $array_like);
                if ($exist > 0) {
                    echo 'Thá»© tá»± nÃ y Ä‘Ã£ tá»“n táº¡i';
                    return (0);
                }
            }
            $data_array = array('cls_indexMenu' => $index);
            $array_where = array('cls_idSubject' => $idSubject);
            $this -> subject -> update_subject($data_array, $array_where);
            echo 'Cáº­p nháº­t thÃ nh cÃ´ng';
        }
    }

    function change_hot_subject() {
            if(isset($_POST['idSubject'])){
              $idSubject=$this->input->post('idSubject');
              $data_array=array('cls_forum_hot'=>0);
              $array_where=array();
              $this->subject->update_subject($data_array, $array_where);
              echo $idSubject;
              $data_array=array('cls_forum_hot'=>1);
              $array_where=array('cls_idSubject'=>$idSubject);
              $this->subject->update_subject($data_array, $array_where);
            }
    }

}
?>
