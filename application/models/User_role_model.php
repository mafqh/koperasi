<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class User_role_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct(); 
    }  

    public function getOneBy($where = array()){
        $this->db->select("users_roles.*")->from("users_roles");

        $this->db->where($where);  

        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->row(); 
        } 
        return FALSE;
    }
    public function getAllById($where = array()){
        $this->db->select("users_roles.*")->from("users_roles");  
        $this->db->join("users","users.id = users_roles.user_id");
        $this->db->join("roles","roles.id = users_roles.role_id"); 
        $this->db->where($where);  

        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->result(); 
        } 
        return FALSE;
    }
    
    public function insert($data){
        $this->db->insert("users_roles", $data);
        return $this->db->insert_id();
    }

    public function update($data,$where){
        $this->db->update("users_roles", $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($where){
        $this->db->where($where);
        $this->db->delete("users_roles"); 
        if($this->db->affected_rows()){
            return TRUE;
        }
        return FALSE;
    }
}
