<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Privileges_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct(); 
    }  
    public function getOneBy($where = array()){
        $this->db->select("*,roles.name as role_name")
                ->from("privileges"); 
        $this->db->join("roles","roles.id = privileges.role_id","left"); 
        $this->db->join("menu","menu.id = privileges.menu_id","left");   
        $this->db->where("roles.is_deleted",0); 
        $this->db->where($where);   
        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->result(); 
        } 
        return FALSE;
    }
    public function insert($data){
        $this->db->insert('privileges', $data);
        return $this->db->insert_id();
    }

    public function update($data,$where){
        $this->db->update('privileges', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($where){
        $this->db->where($where);
        $this->db->delete('privileges'); 
        if($this->db->affected_rows()){
            return TRUE;
        }
        return FALSE;
    }
    public function insert_batch($data){
        $this->db->insert_batch('privileges', $data);
        return $this->db->insert_id();
    }
}
