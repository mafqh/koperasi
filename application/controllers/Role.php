<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';

class Role extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('function_model');
		$this->load->model('roles_model');
		$this->load->model("privileges_model");
		$this->load->model("menu_model");
	}

	public function index() {
		$this->load->helper('url');
		if ($this->data['is_can_read']) {
			$this->data['content'] = 'backend/role/list_v';
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}

		$this->load->view('backend/layouts/page', $this->data);
	}

	public function create() {
		if ($this->data['is_can_create']) {
			$this->form_validation->set_rules('name', "Nama Jabatan Harus Diisi", 'trim|required');
			if ($this->form_validation->run() === TRUE) {
				$this->db->trans_begin();

				$data = array(
					'name' => $this->input->post('name'),
					'is_deleted' => 0,
				);
				$this->roles_model->insert($data);

				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					$this->session->set_flashdata('message_error', "Gagal Disimpan");
					redirect("role");
				} else {
					$this->db->trans_commit();
					$this->session->set_flashdata('message', "Berhasil Disimpan");
					redirect("role");
				}
			}else{
				$this->data['content'] = 'backend/role/create_v';
			}
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}

		$this->load->view('backend/layouts/page', $this->data);
	}

	public function edit($id) {
		if ($this->data['is_can_edit']) {
			$this->form_validation->set_rules('name', "Nama Jabatan Harus Diisi", 'trim|required');
			if ($this->form_validation->run() === TRUE) {
				$this->db->trans_begin();

				$data = array(
					'name' => $this->input->post('name'),
				);

				$this->roles_model->update($data, ['roles.id' => $id]);

				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					$this->session->set_flashdata('message_error', "Gagal Disimpan");
					redirect("role");
				} else {
					$this->db->trans_commit();
					$this->session->set_flashdata('message', "Berhasil Disimpan");
					redirect("role");
				}
			}else{
				if(empty($id)){
					$this->session->set_flashdata('message_error', "Data Tidak Ditemukan");
					redirect("role");
				}
				
				$this->data['role'] = $this->roles_model->getOneBy(['roles.id' => $id]);
				$this->data['content'] = 'backend/role/edit_v';
			}
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}

		$this->load->view('backend/layouts/page', $this->data);
	}

	public function privileges($id) {
		if ($this->data['is_can_access']) {
			$this->form_validation->set_rules('role_id', "Role Harus Diisi", 'trim|required');
			if ($this->form_validation->run() === TRUE) {
				$this->db->trans_begin();

				$functions = $this->input->post('functions');
				$menus = $this->input->post('menus');

				$this->privileges_model->delete(array("role_id" => $this->input->post('role_id')));
				$data = [];
				$parentMenu = [];
				if ($functions) {
					foreach ($functions as $menu_id => $dataFunction) {
						foreach ($dataFunction as $function_id => $function) {
							$data[] = array(
								"menu_id" => $menu_id,
								"function_id" => $function,
								"role_id" => $this->input->post('role_id'),
							);
						}
						$parentMenu[] = $menu_id;
					}

					$insert = $this->privileges_model->insert_batch($data);

					$data = array(
						"menu_id" => 1,
						"function_id" => 2,
						"role_id" => $this->input->post('role_id'),
					);
					$insert = $this->privileges_model->insert($data);

					$dataParent = $this->menu_model->getDataParentByMenus(implode(",", $parentMenu));
					$data = [];
					foreach ($dataParent as $key => $value) {
						$data[] = array(
							"menu_id" => $value->id,
							"function_id" => 2,
							"role_id" => $this->input->post('role_id'),
						);
					}
					$this->privileges_model->insert_batch($data);
				}

				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					$this->session->set_flashdata('message_error', "Gagal Disimpan");
					redirect("role");
				} else {
					$this->db->trans_commit();
					$this->session->set_flashdata('message', "Berhasil Disimpan");
					redirect("role");
				}
			}else{
				if(empty($id)){
					$this->session->set_flashdata('message_error', "Data Tidak Ditemukan");
					redirect("role");
				}
				$this->data['privilege'] = $this->getPrivillege($id);
				$this->data['role'] = $this->roles_model->getOneBy(['roles.id' => $id]);
				$this->data['content'] = 'backend/role/privilege_v';
			}
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}

		$this->load->view('backend/layouts/page', $this->data);
	}

	public function dataList() {
		$columns = [
			0 => 'roles.id',
			1 => 'roles.name',
			2 => 'roles.is_deleted',
			3 => '',
		];

		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$where  = [];
		$search = [];
		$limit = 0;
		$start = 0;

		$totalData = $this->roles_model->getCountAllBy($limit, $start, $search, $order, $dir, $where);

		if (!empty($this->input->post('search')['value'])) {
			$search_value = $this->input->post('search')['value'];
			$search = [
				"roles.id" => $search_value,
				"roles.name" => $search_value,
			];
			$totalFiltered = $this->roles_model->getCountAllBy($limit, $start, $search, $order, $dir, $where);
		} else {
			$totalFiltered = $totalData;
		}

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$datas = $this->roles_model->getAllBy($limit, $start, $search, $order, $dir, $where);

		$new_data = array();
		if (!empty($datas)) {
			foreach ($datas as $key => $data) {
				$edit_url = "";
				$active_url = "";
				$delete_url = "";
				$privilege_url = "";

				if ($this->data['is_can_edit'] && $data->is_deleted == 0) {
					$edit_url = "<a href='".base_url()."role/edit/".$data->id."' class='btn btn-sm btn-info mr-2'><i class='fa fa-pen mr-1'></i> Ubah</a>";
				}

				if ($this->data['is_can_active']) {
					if ($data->is_deleted == 0) {
						$active_url = "<a href='#' url='" . base_url() . "role/destroy/" . $data->id . "/1'
                            data-status='1' class='btn btn-sm btn-danger mr-2 delete'><i class='fa fa-lock mr-1'></i> NonAktif</a>";
					} elseif ($data->is_deleted == 1) {
						$active_url = "<a href='#' url='" . base_url() . "role/destroy/" . $data->id . "/2'
                            data-status='2' class='btn btn-sm btn-success mr-2 delete'><i class='fa fa-unlock mr-1'></i> Aktif</a>";
					}
				}

				if ($this->data['is_can_delete'] && $data->is_deleted == 1 && $this->data['is_superadmin'] == 1) {
					$delete_url = "<a href='#' url='" . base_url() . "role/destroy/" . $data->id . "/3'
                        data-status='3' class='btn btn-sm btn-danger mr-2 delete'><i class='fa fa-trash mr-1'></i> Hapus</a>";
				}

				if ($this->data['is_can_access'] && ($data->is_deleted == 0)) {
					$privilege_url = "<a href='".base_url()."role/privileges/".$data->id."' class='btn btn-sm btn-primary mr-2' ><i class='fa fa-cogs mr-1'></i> Hak Akses</a>";
				}

				if ($data->is_deleted == 0) {
					$is_deleted = '<span class="badge badge-success px-4 py-2">Aktif</span>';
				} elseif ($data->is_deleted == 1) {
					$is_deleted = '<span class="badge badge-danger px-4 py-2">Tidak Aktif</span>';
				}

				$nestedData['id'] = $start+$key+1;;
				$nestedData['name'] = $data->name;

				$nestedData['is_deleted'] = $is_deleted;

				$nestedData['action'] = $edit_url . '' . $privilege_url . '' . $active_url . '' . $delete_url;
				$new_data[] = $nestedData;
			}
		}

		$json_data = array(
			"draw" => intval($this->input->post('draw')),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $new_data,
		);

		log_message('CUSTOM', "user_id => " . $this->data['users']->id . ", function => datalist");
		log_message('CUSTOM', "user_id => " . $this->data['users']->id . ", data => " . json_encode($json_data));
		echo json_encode($json_data);
	}

	public function destroy($id, $status) {
		$response_data = array();
		$response_data['status'] = false;
		$response_data['msg'] = "";
		$response_data['data'] = array();

		if (!empty($id)) {
			$where = ['roles.id' => $id];
			if ($status == 1) {
				$data = ['is_deleted' => 1];
				$update = $this->roles_model->update($data, $where);
				$response_data['data'] = $data;
				$response_data['msg'] = "Sukses Menonaktifkan Data";
				$response_data['status'] = true;
			} elseif ($status == 2) {
				$data = ['is_deleted' => 0];
				$update = $this->roles_model->update($data, $where);
				$response_data['data'] = $data;
				$response_data['msg'] = "Sukses Mengaktifkan Data";
				$response_data['status'] = true;
			} elseif ($status == 3) {
				$delete = $this->roles_model->delete($where);
				$response_data['data'] = [];
				$response_data['msg'] = "Sukses Menghapus Data";
				$response_data['status'] = true;
			}
		} else {
			$response_data['msg'] = "ID Kosong";
		}

		log_message('CUSTOM', "user_id => " . $this->data['users']->id . ", function => destroy");
		log_message('CUSTOM', "user_id => " . $this->data['users']->id . ", data => " . json_encode($response_data));
		echo json_encode($response_data);
	}

	public function getRoles() {
		$id = $this->input->get('id');
		$data = $this->roles_model->getOneBy(['roles.id' => $id]);

		if ($data) {
			$response_data['status'] = true;
			$response_data['data'] = $data;
			$response_data['message'] = "Berhasil Mengambil Data";
		} else {
			$response_data['status'] = false;
			$response_data['data'] = [];
			$response_data['message'] = "Gagal Mengambil Data";
		}

		echo json_encode($response_data);
	}

	private function isMenuSelected($menu_selecteds, $menu) {
		foreach ($menu_selecteds as $key => $value) {
			if ($menu['id'] == $value['menu_id'] && count($value['functions']) == count($menu['functions'])) {
				return true;
			}
		}
		return false;
	}

	private function isMenuFunctionSelected($menu_selecteds, $menu_id, $function_id) {
		foreach ($menu_selecteds as $key => $menus) {
			if ($menu_id == $menus['menu_id']) {
				foreach ($menus['functions'] as $key => $function) {
					if ($function_id == $function['id']) {
						return true;
					}
				}
			}
		}
		return false;
	}

	public function getPrivillege($id) {
		$menus = $this->menu_model->getAllById();
		$functions = $this->function_model->getAllMenuFunction();
		$dataMenus = array();
		foreach ($functions as $key => $function) {
			$dataMenus[$function->id]["id"] = $function->id;
			$dataMenus[$function->id]["name"] = $function->name;
			$dataMenus[$function->id]["functions"][] = array(
				"id" => $function->function_id,
				"name" => $function->function_name,
			);
		}

		$menus = $dataMenus;
		$data = $this->privileges_model->getOneBy(array("roles.id" => $id));

		$dataMenus = array();
		if (!empty($data)) {
			foreach ($data as $key => $function) {
				$dataMenus[$function->menu_id]["menu_id"] = $function->menu_id;
				$dataMenus[$function->menu_id]["functions"][]['id'] = $function->function_id;
			}
		}
		$menu_selecteds = $dataMenus;
		$data = [];

		foreach ($menus as $key => $data_menu) {
			$x = new stdClass();
			$x->id = $data_menu['id'];
			$x->checked = $this->isMenuSelected($menu_selecteds, $data_menu) ? "checked" : "";
			$x->name = $data_menu['name'];

			//fungsi selected
			$fungsi = [];
			foreach ($data_menu['functions'] as $function) {
				$y = new stdClass();
				$y->id = $function['id'];
				$y->name = $function['name'];
				$y->checked = $this->isMenuFunctionSelected($menu_selecteds, $data_menu['id'], $function['id']) ? "checked" : "";
				array_push($fungsi, $y);
			}
			$x->fungsi = $fungsi;
			array_push($data, $x);
		}

		return $data;
	}

}