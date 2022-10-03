<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->data = array();
		$this->data['users'] = array();
		$this->db->query('SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,"ONLY_FULL_GROUP_BY",""))');
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		} else {
			$this->data['users'] = $this->ion_auth->user()->row();
			$this->data['users_groups'] = $this->ion_auth->get_users_groups($this->data['users']->id)->row();
			log_message('CUSTOM', "user_id => " . $this->data['users']->id . ", function => " . uri_string() . "/");
		}
		$this->make_dir_upload();
		$this->data['page'] = "";
		$this->data['parent_page_name'] = "";
		$this->data['page_id'] = "";
		$this->data['is_superadmin'] = false;
		$this->data['is_can_create'] = false;
		$this->data['is_can_read'] = false;
		$this->data['is_can_edit'] = false;
		$this->data['is_can_delete'] = false;
		$this->data['is_can_active'] = false;
		$this->data['is_can_access'] = false;
		$this->data['is_can_download'] = false;
		$this->data['is_can_upload'] = false;
		$this->data['is_can_approval'] = false;
		$this->load->model("menu_model");

		if ($this->ion_auth->in_group(1)) {
			$this->data['is_superadmin'] = true;
		}

		if (!$this->input->is_ajax_request()) {
			$this->data['menu'] = $this->loadMenu();
		} else {
			$this->data['page_id'] = $this->session->userdata('page_id');
		}

		if ($this->data['is_superadmin']) {
			$this->data['is_can_create'] = true;
			$this->data['is_can_read'] = true;
			$this->data['is_can_edit'] = true;
			$this->data['is_can_delete'] = true;
			$this->data['is_can_active'] = true;
			$this->data['is_can_access'] = true;
			$this->data['is_can_download'] = true;
			$this->data['is_can_upload'] = true;
			$this->data['is_can_approval'] = true;
		} else {
			$this->load->model("privileges_model");
			if ($this->data['users_groups']) {
				$where = [
					"menu_id" => $this->data['page_id'],
					"role_id" => $this->data['users_groups']->id,
				];
				$dataPrivileges = $this->privileges_model->getOneBy($where);
				$this->data['is_can_create'] = ($this->isInPrivileges($dataPrivileges, 1));
				$this->data['is_can_read'] = ($this->isInPrivileges($dataPrivileges, 2));
				$this->data['is_can_edit'] = ($this->isInPrivileges($dataPrivileges, 3));
				$this->data['is_can_delete'] = ($this->isInPrivileges($dataPrivileges, 4));
				$this->data['is_can_active'] = ($this->isInPrivileges($dataPrivileges, 5));
				$this->data['is_can_access'] = ($this->isInPrivileges($dataPrivileges, 6));
				$this->data['is_can_download'] = ($this->isInPrivileges($dataPrivileges, 7));
				$this->data['is_can_upload'] = ($this->isInPrivileges($dataPrivileges, 8));
				$this->data['is_can_approval'] = ($this->isInPrivileges($dataPrivileges, 9));
			}
		}

		$this->autoMigrate();
		$this->cleanTmp();
	}

	private function make_dir_upload() {
		$dirs = [
			'./uploaded/',
		];

		foreach ($dirs as $dir) {
			if (!is_dir($dir)) {
				mkdir($dir, 0777, TRUE);
			}
		}
	}

	private function isInPrivileges($data, $id) {
		if (!empty($data)) {
			for ($i = 0; $i < count($data); $i++) {
				if (isset($data[$i]) && $data[$i]->function_id == $id) {
					return true;
				}
			}
		}

		return false;
	}

	private function createTree($parent, $menu, $parent_id, $path_active_name) {
		$html = "";
		if (isset($menu['parents'][$parent])) {
			$show = "";
			// foreach ($menu['parents'][$parent] as $itemId) {
			// 	$id = $menu['items'][$itemId]['id'];
			// 	if ($id == $parent_id || $parent == $parent_id) {
			// 		$show = "show";
			// 	}
			// }
			// if ($parent == 1) {
			// 	$html
			// 	$html .= '<ul class="navbar-nav pt-lg-3"> ';
			// } else {
			// 	if ($parent_id != 1) {
			// 		$html .= '<div class="dropdown-menu ' . $show . '">';
			// 	} else {
			// 		$html .= '<div class="dropdown-menu ' . $show . '">
			// 					<div class="dropdown-menu-columns">
			// 	 					<div class="dropdown-menu-column">';
			// 	}
			// }
			foreach ($menu['parents'][$parent] as $itemId) {
				$id = $menu['items'][$itemId]['id'];
				$url = $menu['items'][$itemId]['url'];
				$urlText = $menu['items'][$itemId]['url-text'];
				$icon = $menu['items'][$itemId]['icon'];
				$name = $menu['items'][$itemId]['name'];
				if (!isset($menu['parents'][$itemId])) {
					if ($urlText != "#") {
						$active = ($path_active_name == strtolower($urlText)) ? "active" : "";
						if ($menu['items'][$itemId]['parent_id'] == 1) {
							$html .= '<li class="nav-item '.$active.'">
									<a class="nav-link" href="' . $url . '">
										<i class="fas fa-fw ' . $icon . '"></i>
										<span>' . $name . '</span>
									</a>';
							$html .= '</li>';
						} else {
							$html .= '<a class="collapse-item ' . $active . '" href="' . $url . '">' . $name . '</a>';
						}
					}
				} else {
					$active = ($id == $parent_id) ? "active" : '';
					$html .= '
					<li class="nav-item ' . $active . '">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse'.$itemId.'"
							aria-expanded="true" aria-controls="collapse'.$itemId.'">
							<i class="fas fa-fw ' . $icon . '"></i>
							<span>' . $name . '</span>
						</a>
						<div id="collapse'.$itemId.'" class="collapse" aria-labelledby="heading'.$itemId.'" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner rounded">
								<h6 class="collapse-header">submenu ' . $name . ':</h6>';
								$html .= $this->createTree($itemId, $menu, $parent_id, $path_active_name);
					$html .= '</div>
						</div>
					</li>';
						#parent yang ada child nya
						// $grand_parent = $menu['items'][$parent_id]["parent_id"];
						// $active = ($id == $parent_id || $id == $grand_parent) ? "active" : '';
						// $html .= '<li class="nav-item ' . $active . ' dropdown">
						// 				<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="true">
						// 					<span class="nav-link-icon d-md-none d-lg-inline-block">
						// 						<i class="ti ti-' . $icon . '"></i>
						// 					</span>
						// 					<span class="nav-link-title">
						// 						' . $name . '
						// 					</span>
						// 				</a>';
						// $html .= $this->createTree($itemId, $menu, $parent_id, $path_active_name);
						// $html .= "</li>";

				}
			}
			// if ($parent == 1) {
			// 	$html .= "</ul>";
			// } else {
			// 	if ($parent_id != 1) {
			// 		$html .= '</div>';
			// 	} else {
			// 		$html .= '</div></div></div>';
			// 	}
			// }
		}
		return $html;
	}

	private function loadMenu() {
		$where = [];
		if ($this->data['is_superadmin']) {
			$menus = $this->menu_model->getMenuSuperadmin($where);
		} else {
			$where["role_id"] = $this->data['users_groups']->id;
			$menus = $this->menu_model->getMenuPrivileges($where);
		}
		if (empty($menus)) {
			return "";
		}

		$new_menus = array();

		foreach ($menus as $key => $value) {
			$new_menus[$value->id] = array();
			$new_menus[$value->id]['id'] = $value->id;
			$new_menus[$value->id]['name'] = $value->name;
			$new_menus[$value->id]['url'] = base_url() . $value->url;
			$new_menus[$value->id]['url-text'] = $value->url;
			$new_menus[$value->id]['parent_id'] = $value->parent_id;
			$new_menus[$value->id]['icon'] = $value->icon;
			$new_menus[$value->id]['description'] = $value->description;
			$new_menus[$value->id]['show_at'] = $value->show_at;
		}

		$tree_menu = array(
			'items' => array(),
			'parents' => array(),
		);
		foreach ($new_menus as $a) {
			$tree_menu['items'][$a['id']] = $a;
			$tree_menu['parents'][$a['parent_id']][] = $a['id'];
		}
		$path_active_name = $this->uri->segment(1);
		if (!empty($this->uri->segment(2))) {
			$data_uri_2 = [
				"create",
				"edit",
				"destroy",
				"privileges",
				"export",
				"import",
				"download",
				"approved",
				"rejected",
				"insert",
				"update",
				"delete_file",

			];
			if (!in_array($this->uri->segment(2), $data_uri_2)) {
				$path_active_name = $this->uri->segment(1) . "/" . $this->uri->segment(2);
			}
		}

		$data_parent = $this->menu_model->getParentIdBy(array("URL" => $path_active_name));
		$data_menu = $this->menu_model->getDetailMenuBy(array("URL" => $path_active_name));

		$parent_id = (!empty($data_parent)) ? $data_parent->parent_id : 0;
		if ($data_parent) {
			$parent = $this->menu_model->getParentIdBy(array("id" => $data_parent->parent_id));
		}

		$this->data['parent_page_name'] = (!empty($parent)) ? $parent->name : "";
		$this->data['page'] = (!empty($data_menu)) ? $data_menu->name : "";
		$this->data['page_description'] = (!empty($data_menu)) ? $data_menu->description : "";
		$this->data['page_id'] = (!empty($data_menu)) ? $data_menu->id : "";
		$this->session->set_userdata(array("page_id" => $this->data['page_id']));
		return $this->createTree(1, $tree_menu, $parent_id, $path_active_name);
	}

	public function autoMigrate() {
		$this->load->library('migration');
		if ($this->migration->latest() === FALSE) {
			show_error($this->migration->error_string());
		}
	}

	private function cleanTmp() {
		if (is_dir("./uploaded/tmp")) {
			$files = glob("./uploaded/tmp/*");
			if (!empty($files)) {
				foreach ($files as $file) {
					if (is_file($file)) {
						$date_file = date("d-m-Y", filemtime($file));
						if ($date_file < date("d-m-Y")) {
							unlink($file);
						}

					}
				}
			}
		}
	}
}