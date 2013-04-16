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
		if ($this ->
			uri -> segment(4)) {
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
					$del_id = intval($this -> input -> get('id'));
					if ($del_id) {
						$this -> Perm_model ->remove_perm_by_id($del_id);
						$data['alert_state'] = ALERT_STATE_SUCCESS;
						$data['alert_msg'] = DEL_SUCCESS_MSG;
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

			if ($this -> input -> get('key_q') && $this -> input -> get('q')) {
				$key_q = $this -> input -> get('key_q');
				$q = $this -> input -> get('q');
				switch ($key_q) {
					case 'id' :
					$where['perms.id'] = $q;
					break;

					case 'func_name' :
					$like['funcs.desc'] = $q;
					break;

					default :
					break;
				}
			}

			$where['perms.role_id']=$id;
			$page = $this -> input -> get('page') ? $this -> input -> get('page') : 1;
			$order = $this -> input -> get('order') ? $this -> input -> get('order') : 'DESC';
			$per_page = $this -> input -> get('per_page') ? $this -> input -> get('per_page') : 5;

			$data['perm_list'] = $this -> Perm_model -> get_perm("*,perms.id as id", $where, $like, ($page - 1) * $per_page, $per_page, array('perms.id' => $order),FALSE,TRUE);
			$data['base_url'] =base_url() . 'admin/perm/index/'.$id.'?order=' . $order;
			$data['sort'] = $order;
			$data['next_sort'] = $order == 'ASC' ? 'DESC' : 'ASC';

			$config = array();
			$config['total_rows'] = $this -> Perm_model -> total($where,$like,FALSE,TRUE);
			$config['base_url'] = $data['base_url'];
			$config['per_page'] = $per_page;

			$this -> pagination -> initialize($config);
			$data['page_link'] = $this -> pagination -> create_links();
			$data['add_link'] = base_url() . "admin/perm/add/".$id;
			$data['title'] = "Vai trò";
			$data['edit_link']=base_url().'admin/perm/edit/';
			$data['delete_link']=base_url().'admin/perm/index/'.$id.'?action=delete&id=';
			$data['change_perm_link']=base_url().'perm/change_perm';
			$data['search_link']=base_url().'admin/perm/index/'.$id.'?key_q=';
			$data['all_link']=base_url().'admin/perm/index/'.$id;
			$data['role_id']=$id;
			$this -> load -> view('back_end/main_perm', $data);
		}
	}
}

function add(){
	if($this->uri->segment(4)){
		$id=intval($this->uri->segment(4));
		if($id){
			if(isset($_POST['func_list']) && isset($_POST['crud']) && isset($_POST['token'])){
				if(isset($_SESSION['token']) && ($_SESSION['token']==$this->input->post('token'))){
					$func_id=$this->input->post('func_list');
					$crud=$this->input->post('crud');
					$this->load->model('Perm_model');
					$data=$this->Perm_model->get_perm_by_func_id($id, $func_id);
					if($data==null){
						$crud_list='';
						for ($i=0; $i < count($crud) ; $i++) { 
							$crud_list.=$crud[$i];
						}
						$data_array=array(
							'perm'=>$crud_list,
							'last_update'=>date('Y-m-d H:i:s',time()),
							'role_id'=>$id,
							'func_id'=>$func_id);
						$this->Perm_model->insert_perm($data_array);
					}
				}//end if
			}//end if
			//end data
			$data['title']="Thêm quyền";
			$this->load->model('Func_model');
			$data['func_list']=$this->Func_model-> get_func('*',array(), array(), 0, 100, array());
			$data['back_link']=base_url().'admin/perm/index/'.$id;
			$this->load->library('ultils');
			$data['token']=$this->ultils->_generate_unqid_token();
			$_SESSION['token']=$data['token'];
			$this->load->view('back_end/form/frmAddPerm',$data);
		}
	}
}

function edit(){
	if($this->uri->segment(4) && $this->uri->segment(5)){
		$id=intval($this->uri->segment(4));
		$role_id=intval($this->uri->segment(5));
		if($id && $role_id){
			if(isset($_POST['crud'])){
				$crud=$this->input->post('crud');
				$crud_list='';
				for ($i=0; $i < count($crud) ; $i++) { 
					$crud_list.=$crud[$i];
				}
				$data_array=array(
					'perm'=>$crud_list,
					'last_update'=>date('Y-m-d H:i:s',time()),
					'role_id'=>$role_id);
				$this->load->model('Perm_model');
				$this->Perm_model->update_perm_by_id($id,$data_array);
				
			}
			$data['title']="Thay đổi cho phép";
			$this->load->model('Perm_model');
			$data['crud_list']=$this->Perm_model->get_perm("*,perms.id as id",array('perms.id'=>$id),array(),0,1, array(),FALSE,TRUE);
			$data['back_link']=base_url().'admin/perm/index/'.$role_id;
			$this->load->view('back_end/form/frmEditPerm',$data); 
		}
	}
}
}
?>