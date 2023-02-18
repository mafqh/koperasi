<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('koperasiModel');

        if(!$this->session->userdata('hak_akses')){
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Anda belum login!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>');
				redirect('login');
        }

		$this->data = array();	
		$this->data['role_id'] = $this->session->userdata('status');
		$this->data['page_id'] = $this->uri->segment(1);
		$this->data['akses_menu'] = [];
		$this->data['is_superadmin'] 	= false;
		$this->data['is_can_read'] 	= false;
		$this->data['is_can_create'] 	= false;
		$this->data['is_can_edit'] 	= false;
		$this->data['is_can_delete'] 	= false;
		$this->data['is_can_export_excel'] = false;
		$this->data['is_can_export_pdf'] 	= false;
		$this->data['is_can_hak_akses'] 	= false;
		
		if ($this->session->userdata('status') == 1) {
			$this->data['is_superadmin'] = true;
		}

		if ($this->data['is_superadmin']) {
			$this->data['is_can_read'] 	= true;
			$this->data['is_can_create'] 	= true;
			$this->data['is_can_edit'] 	= true;
			$this->data['is_can_delete'] 	= true;
			$this->data['is_can_export_excel'] = true;
			$this->data['is_can_export_pdf'] 	= true;
			$this->data['is_can_hak_akses'] 	= true;
		} else {
			$where_hak_akses = [
				'id_jabatan' => $this->data['role_id'],
				'menu' => $this->data['page_id']	
			];
			$hak_akses = $this->db->get_Where('hak_akses', $where_hak_akses)->result();
			if (!empty($hak_akses)) {	
				$this->data['is_can_read'] 	= ($this->isInPrivileges($hak_akses, 1));
				$this->data['is_can_create'] 	= ($this->isInPrivileges($hak_akses, 2));
				$this->data['is_can_edit'] 	= ($this->isInPrivileges($hak_akses, 3));
				$this->data['is_can_delete'] 	= ($this->isInPrivileges($hak_akses, 4));
				$this->data['is_can_export_excel'] = ($this->isInPrivileges($hak_akses, 5));
				$this->data['is_can_export_pdf'] 	= ($this->isInPrivileges($hak_akses, 6));
				$this->data['is_can_hak_akses'] 	= ($this->isInPrivileges($hak_akses, 7));
			}else{
				show_404();
			}

			//akses menu
			$akses_menu = $this->koperasiModel->getAksesMenu($this->data['role_id']);
			$master_data = [
				"dataJabatan",
				"dataPengurus",
				"dataAnggota"
			];
			$simpanan = [
				"simpananPokok",
				"simpananWajib",
				"simpananSukarela",
			];

			if(!empty($akses_menu)){
				foreach ($akses_menu as $value) {
					$this->data['akses_menu'][] = $value->menu;

					if(in_array($value->menu, $master_data) && !in_array("master_data", $this->data['akses_menu'])){
						$this->data['akses_menu'][] = "master_data";
					}

					if(in_array($value->menu, $simpanan) && !in_array("simpanan", $this->data['akses_menu'])){
						$this->data['akses_menu'][] = "simpanan";
					}

				}
			}
		}
	}

	private function isInPrivileges($data, $id) {
		if (!empty($data)) {
			for ($i = 0; $i < count($data); $i++) {
				if (isset($data[$i]) && $data[$i]->fungsi == $id) {
					return true;
				}
			}
		}

		return false;
	}
}