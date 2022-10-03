<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';

class User extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('roles_model');
		$this->load->model('user_model');
		$this->load->model('user_role_model');
		$this->load->model('wilayah_provinsi_model');
		$this->load->model('wilayah_kabupaten_model');
		$this->load->model('wilayah_kecamatan_model');
		$this->load->model('wilayah_kelurahan_model');
	}

	public function index() {
		$this->load->helper('url');
		if ($this->data['is_can_read']) {
			$this->data['roles'] = $this->roles_model->getAllById([]);
			$this->data['content'] = 'backend/user/list_v';
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}

		$this->load->view('backend/layouts/page', $this->data);
	}

	public function create() {
		if ($this->data['is_can_create']) {
			$this->form_validation->set_rules('username', "Username Harus Diisi", 'trim|required');
			$this->form_validation->set_rules('role_id', "Role Harus Diisi", 'trim|required');
			if ($this->form_validation->run() === TRUE) {
				$this->db->trans_begin();

				//set variabel input
				$username 	= $this->input->post('username');
				$email 		= $this->input->post('email');
				$first_name = $this->input->post('first_name');
				$phone 		= $this->input->post('phone');

				$provinsi_id  = $this->config->item('provinsi_id');
				$kabupaten_id = $this->input->post('kabupaten_id');
				$kecamatan_id = $this->input->post('kecamatan_id');
				$kelurahan_id = $this->input->post('kelurahan_id');
				$address 	  = $this->input->post('address');

				$nik = $this->input->post('nik');
				$nip = $this->input->post('nip');

				//insert
				$data = [
					'first_name' 	=> $first_name,
					'phone' 		=> $phone,
					'provinsi_id' 	=> $provinsi_id,
					'kabupaten_id' 	=> $kabupaten_id,
					'kecamatan_id' 	=> $kecamatan_id,
					'kelurahan_id' 	=> $kelurahan_id,
					'address' 		=> $address,
					'nip' 			=> $nip,
					'nik' 			=> $nik,
					'is_deleted' 	=> 0,
				];

				$location_path = "./uploaded/profile/";
				if (!is_dir("./uploaded/")) {
					mkdir("./uploaded/", 0777, TRUE);
				}
				if (!is_dir($location_path)) {
					mkdir($location_path, 0777, TRUE);
				}
				$uploaded = uploadFile("photo", $location_path, $kode, 1);
				$arr_file = [];

				if ($uploaded['status'] == 1) {
					$data['photo'] = str_replace(' ', '_', $uploaded['file']);
					$file_thumb = str_replace(' ', '_', $uploaded['file_thumb']);
					$arr_file[] = $data['photo'];
					$arr_file[] = $file_thumb;
				}

				$role 		= array($this->input->post('role_id'));
				$password 	= $this->input->post('password');
				$insert 	= $this->ion_auth->register($username, $password, $email, $data, $role);

				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					$this->session->set_flashdata('message_error', "Gagal Disimpan");
					redirect("user");
				} else {
					$this->db->trans_commit();
					$this->session->set_flashdata('message', "Berhasil Disimpan");
					redirect("user");
				}
			}else{
				$this->data['provinsi'] = $this->wilayah_provinsi_model->getAllById([]);
				$this->data['roles'] = $this->roles_model->getAllById([]);
				$this->data['content'] = 'backend/user/create_v';
			}
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}
		$this->load->view('backend/layouts/page', $this->data);
	}

	public function edit() {
		if ($this->data['is_can_edit']) {
			$this->form_validation->set_rules('role_id_edit', "Role Harus Diisi", 'trim|required');
			if ($this->form_validation->run() === TRUE) {
				$this->db->trans_begin();

				//set variabel input
				$id = $this->input->post('id_edit');
				$kode = $this->input->post('kode_edit');
				$email = strtolower($this->input->post('email_edit'));
				$first_name = strtolower($this->input->post('first_name_edit'));
				$phone = $this->input->post('phone_edit');

				$provinsi_id = $this->config->item('provinsi_id');
				$kabupaten_id = $this->input->post('kabupaten_id_edit');
				$kecamatan_id = $this->input->post('kecamatan_id_edit');
				$kelurahan_id = $this->input->post('kelurahan_id_edit');
				$address = strtolower($this->input->post('address_edit'));

				$golongan_id = $this->input->post('golongan_id_edit');
				$jabatan = strtolower($this->input->post('jabatan_edit'));
				$nip = $this->input->post('nip_edit');
				$nik = $this->input->post('nik_edit');

				$role = $this->input->post('role_id_edit');

				//update
				$data = [
					'first_name' => $first_name,
					'email' => $email,
					'phone' => $phone,
					'provinsi_id' => $provinsi_id,
					'kabupaten_id' => $kabupaten_id,
					'kecamatan_id' => $kecamatan_id,
					'kelurahan_id' => $kelurahan_id,
					'address' => $address,
					'golongan_id' => $golongan_id,
					'jabatan' => $jabatan,
					'nip' => $nip,
					'nik' => $nik,
				];

				$photo = $_FILES['photo_edit']['name'];
				if (!empty($photo)) {
					$location_path = "./uploaded/profile/" . $kode . "/";
					if (!is_dir("./uploaded/")) {
						mkdir("./uploaded/", 0777, TRUE);
					}
					if (!is_dir($location_path)) {
						mkdir($location_path, 0777, TRUE);
					}
					$uploaded = uploadFile("photo_edit", $location_path, $kode, 1);
					$arr_file = [];

					if ($uploaded['status'] == 1) {
						$data['photo'] = str_replace(' ', '_', $uploaded['file']);
						$file_thumb = str_replace(' ', '_', $uploaded['file_thumb']);
						$arr_file[] = $data['photo'];
						$arr_file[] = $file_thumb;
					}
				}

				log_message('CUSTOM', "user_id => " . $this->data['users']->id . ", function => edit");
				log_message('CUSTOM', "user_id => " . $this->data['users']->id . ", data => " . json_encode($data));

				$this->ion_auth->update($id, $data);

				$where_role = [
					"user_id" => $id,
				];
				$this->user_role_model->update(['role_id' => $role], $where_role);

				if ($this->db->trans_status() === FALSE) {
					log_message('CUSTOM', "user_id => " . $this->data['users']->id . ", function => edit error");
					$this->db->trans_rollback();
					$this->session->set_flashdata('message_error', "Gagal Disimpan");
					redirect("user");
				} else {
					if (is_dir($location_path) && !empty($photo)) {
						if ($handle = opendir($location_path)) {
							while (false !== ($entry = readdir($handle))) {
								if ($entry != "." && $entry != "..") {
									if (!in_array($entry, $arr_file)) {
										if (is_file($location_path . $entry)) {
											unlink($location_path . $entry);
										}
									}
								}
							}
							closedir($handle);
						}
					}

					log_message('CUSTOM', "user_id => " . $this->data['users']->id . ", function => edit success");
					$this->db->trans_commit();
					$this->session->set_flashdata('message', "Berhasil Disimpan");
					redirect("user");
				}
			}
		} else {
			log_message('CUSTOM', "user_id => " . $this->data['users']->id . ", function => don't have access");
			$this->data['content'] = 'errors/html/restrict';
		}
	}

	public function dataList() {
		$columns = [
			0 => '',
			1 => 'users.first_name',
			2 => 'users.username',
			3 => 'users.email',
			4 => 'users.is_deleted',
		];

		$provinsi_id = $this->config->item('provinsi_id');
		$where = [
			'users.provinsi_id' => $provinsi_id,
			'users.is_deleted !=' => 2,
			'roles.id !=' => 2 
		];

		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$search = array();
		$limit = 0;
		$start = 0;

		$totalData = $this->user_model->getCountAllBy($limit, $start, $search, $order, $dir, $where);

		if (!empty($this->input->post('search')['value'])) {
			$search_value = $this->input->post('search')['value'];

			if (strtolower($search_value) == "aktif") {
				$where["users.is_deleted"] = 0;
			} elseif (strtolower($search_value) == "nonaktif") {
				$where["users.is_deleted"] = 1;
			} else {
				$search = array(
					"users.first_name" => $search_value,
					"users.kode" => $search_value,
					"users.nip" => $search_value,
					"users.username" => $search_value,
					"users.email" => $search_value,
					"users.phone" => $search_value,
					"roles.name" => $search_value,
				);
			}

			$totalFiltered = $this->user_model->getCountAllBy($limit, $start, $search, $order, $dir, $where);
		} else {
			$totalFiltered = $totalData;
		}

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$datas = $this->user_model->getAllBy($limit, $start, $search, $order, $dir, $where);
		$new_data = array();
		if (!empty($datas)) {
			foreach ($datas as $key => $data) {
				$create_url = "";
				$edit_url = "";
				$active_url = "";
				$delete_url = "";

				if ($this->data['is_can_edit'] && ($data->is_deleted == 0 || $data->is_deleted == 3)) {
					$edit_url = "<a href='#' class='dropdown-item edit' data-id='" . $data->id . "'><i class='fa fa-pencil me-2'></i> Ubah</a>";
				}

				if ($this->data['is_can_active']) {
					if ($data->is_deleted == 0 || $data->is_deleted == 3) {
						$active_url = "<a href='#' url='" . base_url() . "user/destroy/" . $data->id . "/1'
                            data-status='1' class='dropdown-item delete'><i class='fa fa-lock me-2'></i> NonAktif</a>";
					} elseif ($data->is_deleted == 1) {
						$active_url = "<a href='#' url='" . base_url() . "user/destroy/" . $data->id . "/2'
                            data-status='2' class='dropdown-item delete'><i class='fa fa-unlock me-2'></i> Aktif</a>";
					}
				}

				if ($this->data['is_can_delete'] && $data->is_deleted == 1 && $this->data['is_superadmin'] == 1) {
					$delete_url = "<a href='#' url='" . base_url() . "user/destroy/" . $data->id . "/3'
                        data-status='3' class='dropdown-item delete'><i class='fa fa-trash me-2'></i> Hapus</a>";
				}

				if ($data->is_deleted == 0) {
					$is_deleted = '<span class="badge bg-success">Aktif</span>';
				} elseif ($data->is_deleted == 1) {
					$is_deleted = '<span class="badge bg-danger">Tidak Aktif</span>';
				} else {
					$is_deleted = '<span class="badge bg-mute">Dihentikan</span>';
				}

				$nestedData['nama'] = '<div class="form-selectgroup-label-content d-flex align-items-center">
                    <div>
                        <div class="font-muted text-uppercase small">' . $data->kode . '</div>
                        <div class="text-weight-medium text-wrap text-capitalize">' . $data->first_name . '</div>
                    </div>
                </div>';

				$nestedData['username'] = '<div class="form-selectgroup-label-content d-flex align-items-center">
                    <div>
                        <div class="font-muted text-uppercase small">' . $data->nama_role . '</div>
                        <div class="text-weight-medium text-wrap text-capitalize">' . $data->username . '</div>
                    </div>
                </div>';

				$nestedData['kontak'] = '<div class="form-selectgroup-label-content d-flex align-items-center">
                    <div>
                        <div class="font-muted text-lowercase small">' . $data->email . '</div>
                        <div class="text-weight-medium text-wrap">' . $data->phone . '</div>
                    </div>
                </div>';

				$nestedData['is_deleted'] = $is_deleted;

				$nestedData['action'] = '<div class="dropdown">
                    <button type="button" class="btn btn-yellow" data-bs-toggle="dropdown">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="dropdown-menu">
                        ' . $create_url . '' . $edit_url . '' . $active_url . '' . $delete_url . '
                    </div>
                </div>';
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
			$where = ['users.id' => $id];
			if ($status == 1) {
				$data = ['is_deleted' => 1];
				$update = $this->user_model->update($data, $where);
				$response_data['data'] = $data;
				$response_data['msg'] = "Sukses Menonaktifkan Data";
				$response_data['status'] = true;
			} elseif ($status == 2) {
				$data = ['is_deleted' => 0];
				$update = $this->user_model->update($data, $where);
				$response_data['data'] = $data;
				$response_data['msg'] = "Sukses Mengaktifkan Data";
				$response_data['status'] = true;
			} elseif ($status == 3) {
				$data = ['is_deleted' => 2];
				$update = $this->user_model->update($data, $where);
				$response_data['data'] = $data;
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

	public function getUser() {
		$id = $this->input->get('id');
		$data = $this->user_model->getOneBy(['users.id' => $id]);

		if ($data) {
			$provinsi = $this->wilayah_provinsi_model->getAllById(['id' => $data->provinsi_id]);
			if (!empty($provinsi)) {
				foreach ($provinsi as $key => $value) {
					if ($provinsi[$key]->id == $data->provinsi_id) {
						$provinsi[$key]->selected = "selected";
					} else {
						$provinsi[$key]->selected = "";
					}
				}
			}

			$kabupaten = $this->wilayah_kabupaten_model->getAllById(['provinsi_id' => $data->provinsi_id]);
			if (!empty($kabupaten)) {
				foreach ($kabupaten as $key => $value) {
					if ($kabupaten[$key]->id == $data->kabupaten_id) {
						$kabupaten[$key]->selected = "selected";
					} else {
						$kabupaten[$key]->selected = "";
					}
				}
			}

			$kecamatan = $this->wilayah_kecamatan_model->getAllById(['kabupaten_id' => $data->kabupaten_id]);
			if (!empty($kecamatan)) {
				foreach ($kecamatan as $key => $value) {
					if ($kecamatan[$key]->id == $data->kecamatan_id) {
						$kecamatan[$key]->selected = "selected";
					} else {
						$kecamatan[$key]->selected = "";
					}
				}
			}

			$kelurahan = $this->wilayah_kelurahan_model->getAllById(['kecamatan_id' => $data->kecamatan_id]);
			if (!empty($kelurahan)) {
				foreach ($kelurahan as $key => $value) {
					if ($kelurahan[$key]->id == $data->kelurahan_id) {
						$kelurahan[$key]->selected = "selected";
					} else {
						$kelurahan[$key]->selected = "";
					}
				}
			}

			$response_data['status'] = true;
			$response_data['data'] = $data;
			$response_data['provinsi'] = $provinsi;
			$response_data['kabupaten'] = $kabupaten;
			$response_data['kecamatan'] = $kecamatan;
			$response_data['kelurahan'] = $kelurahan;
			$response_data['message'] = "Berhasil Mengambil Data";
		} else {
			$response_data['status'] = false;
			$response_data['data'] = [];
			$response_data['message'] = "Gagal Mengambil Data";
		}

		echo json_encode($response_data);
	}

	public function checkUsername() {
		$username = $this->input->post('username');
		$where = ["users.username" => $username];
		$result = $this->user_model->getUsername($where);

		if (!empty($result)) {
			echo json_encode(FALSE);
		} else {
			echo json_encode(TRUE);
		}
	}
}