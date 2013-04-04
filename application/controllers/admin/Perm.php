<?php
/**
 *
 */
class Perm extends CI_Controller {

	function __construct() {
		session_start();
		parent::__construct();
	}

	function index() {
		if ($this -> uri -> segment(4)) {
			$id=intval($this->uri->segment(4));
			if($id){
				$this -> load -> model('Perm_model');
				$action = $this -> input -> get('action');
				$where=array();
				$like=array();
				if ($action) {
					switch ($action) {
						case 'show' :
						break;

						case 'delete' :
						$id = intval($this -> input -> get('id'));
						if ($id) {
							$this -> Perm_model -> remove_role_by_id($id);
							$data['alert_state'] = 'success';
							$data['alert_msg'] = 'Xóa thành công';
						}
						break;

						case 'edit' :
						$id = intval($this -> input -> get('id'));
						if ($id) {
							redirect(base_url() . 'admin/role/editRole/' . $id);
						}
						break;

						default :
						break;
					}
				}
                
                $where['perms.role_id']=$id;
				$page = $this -> input -> get('page') ? $this -> input -> get('page') : 1;
				$order = $this -> input -> get('order') ? $this -> input -> get('order') : 'DESC';
				$per_page = $this -> input -> get('per_page') ? $this -> input -> get('per_page') : 5;

				$data['perm_list'] = $this -> Perm_model -> get_perm("*", $where, $like, ($page - 1) * $per_page, $per_page, array('perms.id' => $order),FALSE,TRUE);
				$data['base_url'] =base_url() . 'admin/perm/index/'.$id.'?order=' . $order;
				$data['sort'] = $order;
				$data['next_sort'] = $order == 'ASC' ? 'DESC' : 'ASC';

				$config = array();
				$config['total_rows'] = $this -> Perm_model -> total($where,$like);
				$config['base_url'] = $data['base_url'];
				$config['per_page'] = $per_page;

				$this -> pagination -> initialize($config);
				$data['page_link'] = $this -> pagination -> create_links();
				$data['add_link'] = base_url() . "admin/perm/add/".$id;
				$data['title'] = "Vai trò";
				$data['edit_link']=base_url().'perm/edit/';
				$data['delete_link']=base_url().'perm?action=delete?id=';
				$data['change_perm_link']=base_url().'perm/change_perm';
				$data['search_link']=base_url().'admin/func?key_q=';
				$this -> load -> view('back_end/main_perm', $data);
			}
		}
	}

	function add(){
		if($this->uri->segment(4)){
			$id=intval($this->uri->segment(4));
			if($id){
				$data['title']="Thêm quyền";
				$this->load->model('Func_model');
				$data['func_list']=$this->Func_model-> get_func('*',array(), array(), 0, 100, array());
				$data['back_link']=base_url().'admin/perm/index/'.$id;
				$this->load->view('back_end/form/frmAddPerm',$data);
			}
		}
	}
}
?>