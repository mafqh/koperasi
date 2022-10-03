<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate_data extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->insert_menu();
		$this->insert_function();
		$this->insert_menu_function();
		$this->insert_users();
		$this->insert_users_roles();
		$this->insert_roles();
		redirect("/");
	}

	function insert_menu() {
		$table = 'menu';
		$this->db->truncate($table);

		$data = array(
			array('id' => 1, 'module_id' => 1, 'name' => 'root', 'url' => '#', 'parent_id' => 0, 'icon' => "", 'sequence' => 0, 'description' => 'Root Aplikasi', "show_at" => 0),
			array('id' => 2, 'module_id' => 1, 'name' => 'Dashboard', 'url' => 'dashboard', 'parent_id' => 1, 'icon' => "fa-tachometer-alt", 'sequence' => 1, 'description' => 'Dashboard', "show_at" => 0),
			array('id' => 3, 'module_id' => 1, 'name' => 'Akses Sistem', 'url' => '#', 'parent_id' => 1, 'icon' => "fa-key", 'sequence' => 2, 'description' => 'Akses Sistem', "show_at" => 0),
			array('id' => 4, 'module_id' => 1, 'name' => 'Jabatan', 'url' => 'role', 'parent_id' => 3, 'icon' => "", 'sequence' => 1, 'description' => 'Jabatan', "show_at" => 0),
			array('id' => 5, 'module_id' => 1, 'name' => 'Pengguna', 'url' => 'user', 'parent_id' => 3, 'icon' => "", 'sequence' => 2, 'description' => 'Pengguna', "show_at" => 0),
			array('id' => 6, 'module_id' => 1, 'name' => 'Master Data', 'url' => '#', 'parent_id' => 1, 'icon' => "fa-database", 'sequence' => 3, 'description' => 'Master Data', "show_at" => 0),
			array('id' => 7, 'module_id' => 1, 'name' => 'Kategori', 'url' => 'kategori', 'parent_id' => 6, 'icon' => "", 'sequence' => 1, 'description' => 'Kategori', "show_at" => 0),
			array('id' => 8, 'module_id' => 1, 'name' => 'Katalog', 'url' => 'katalog', 'parent_id' => 6, 'icon' => "", 'sequence' => 2, 'description' => 'Katalog', "show_at" => 0),
		);

		$this->db->insert_batch($table, $data);
	}

	function insert_function() {
		$table = 'function';
		$this->db->truncate($table);

		$data = array(
			array('name' => 'Create', 'description' => 'Can Create'),
			array('name' => 'Read', 'description' => 'Can Read'),
			array('name' => 'Update', 'description' => 'Can Update'),
			array('name' => 'Delete', 'description' => 'Can Delete'),
			array('name' => 'Active', 'description' => 'Can Active'),
			array('name' => 'Access', 'description' => 'Can Access'),
			array('name' => 'Download', 'description' => 'Can Download'),
			array('name' => 'Upload', 'description' => 'Can Upload'),
			array('name' => 'Approval', 'description' => 'Can Approval'),
		);
		$this->db->insert_batch($table, $data);
	}

	function insert_menu_function() {
		$table = 'menu_function';
		$this->db->truncate($table);

		$menus = [
			"1" => [2],
			
			//parent menu
			"2" => [2],
			"3" => [2],
			"6" => [2],

			//Akses Sistem
			"4" => [1, 2, 3, 4, 5, 6],
			"5" => [1, 2, 3, 4, 5],
			"7" => [1, 2, 3, 4, 5],
			"8" => [1, 2, 3, 4, 5],
		];

		$data = [];
		foreach ($menus as $key => $value) {
			for ($i = 0; $i < count($value); $i++) {
				$data[] = [
					"menu_id" => $key,
					"function_id" => $value[$i],
				];
			}
		}

		$this->db->insert_batch($table, $data);
	}

	function insert_users() {
		$table = 'users';
		$this->db->truncate($table);

		$data = array(
			array('ip_address' => '127.0.0.1', 'username' => 'admin', 'password' => '$2y$08$FWoXIAWwgz3dsP4udOCM9uV1d846OrWZv8TbL40TZsxgqaPtsrfMq', 'salt' => '', 'email' => 'admin@shirobyte.com', 'activation_code' => '', 'forgotten_password_code' => NULL, 'created_on' => '1268889823', 'last_login' => '1268889823', 'active' => '1', 'first_name' => 'super admin', 'last_name' => '', 'phone' => '0', 'is_deleted' => 0),
		);
		$this->db->insert_batch($table, $data);
	}

	function insert_users_roles() {
		$table = 'users_roles';
		$this->db->truncate($table);

		$data = array(
			array('id' => 1, 'user_id' => '1', 'role_id' => '1'),
			array('id' => 2, 'user_id' => '2', 'role_id' => '1'),
		);
		$this->db->insert_batch($table, $data);
	}

	function insert_roles() {
		$table = 'roles';
		$this->db->truncate($table);

		$data = array(
			array('id' => 1, 'name' => 'superadmin'),
			array('id' => 2, 'name' => 'Ketua'),
			array('id' => 3, 'name' => 'Sekretaris'),
			array('id' => 4, 'name' => 'Bendahara'),
			array('id' => 5, 'name' => 'Anggota Internal'),
			array('id' => 6, 'name' => 'Anggota Eksternal'),
		);
		$this->db->insert_batch($table, $data);
	}

}