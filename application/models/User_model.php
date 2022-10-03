<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function getOneBy($where = array()) {
		$this->db->select("users.*, users_roles.role_id")->from("users");
		$this->db->join("users_roles", "users_roles.user_id = users.id");
		$this->db->join("roles", "roles.id = users_roles.role_id");
		$this->db->where($where);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return FALSE;
	}

	public function getAllById($where = array()) {
		$this->db->select("users.*, users_roles.role_id")->from("users");
		$this->db->join("users_roles", "users_roles.user_id = users.id");
		$this->db->join("roles", "roles.id = users_roles.role_id");
		$this->db->where($where);
		$this->db->where("users.is_deleted", 0);
		$this->db->where("roles.is_deleted", 0);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return FALSE;
	}

	public function insert($data) {
		$this->db->insert("users", $data);
		return $this->db->insert_id();
	}

	public function update($data, $where) {
		$this->db->update("users", $data, $where);
		return $this->db->affected_rows();
	}

	public function delete($where) {
		$this->db->where($where);
		$this->db->delete("users");
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		return FALSE;
	}

	public function getAllBy($limit, $start, $search, $col, $dir, $where = []) {
		$this->db->select("users.id, users.kode, users.first_name, users.username, users.email, users.phone,
                           users.nip, users.is_deleted, roles.name as nama_role")->from("users");
		$this->db->join("users_roles", "users.id = users_roles.user_id");
		$this->db->join("roles", "roles.id = users_roles.role_id");
		$this->db->limit($limit, $start)->order_by($col, $dir);

		$roles_default = array('1');
		$this->db->where_not_in('roles.id', $roles_default);
		$this->db->where("roles.is_deleted", 0);
		$this->db->where($where);
		if (!empty($search)) {
			$this->db->group_start();
			foreach ($search as $key => $value) {
				$this->db->or_like($key, $value);
			}
			$this->db->group_end();
		}

		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function getCountAllBy($limit, $start, $search, $order, $dir, $where = []) {
		$this->db->select("users.id")->from("users");
		$this->db->join("users_roles", "users.id = users_roles.user_id");
		$this->db->join("roles", "roles.id = users_roles.role_id");

		$roles_default = array('1');
		$this->db->where_not_in('roles.id', $roles_default);
		$this->db->where("roles.is_deleted", 0);
		$this->db->where($where);
		if (!empty($search)) {
			$this->db->group_start();
			foreach ($search as $key => $value) {
				$this->db->or_like($key, $value);
			}
			$this->db->group_end();
		}

		$result = $this->db->get();

		return $result->num_rows();
	}

	public function getUsername($where = array()) {
		$this->db->select("users.username")->from("users");
		$this->db->where($where);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return FALSE;
	}

	public function getLastKode($where = array()) {
		$this->db->select("kode");
		$this->db->from("users");
		$this->db->order_by("kode", "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row()->kode;
		}
		return FALSE;
	}

	public function getTotalPengguna($where = []) {
		$this->db->select("users.id")->from("users");
		$this->db->join("users_roles", "users.id = users_roles.user_id");
		$this->db->join("roles", "roles.id = users_roles.role_id");

		$roles_default = array('1');
		$this->db->where_not_in('roles.id', $roles_default);
		$this->db->where("roles.is_deleted", 0);
		$this->db->where($where);

		$result = $this->db->get();

		return $result->num_rows();
	}
}