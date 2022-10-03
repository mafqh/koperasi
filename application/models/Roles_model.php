<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Roles_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct(); 
    }  

    public function getAllById($where = array()){
        $this->db->select("roles.*")->from("roles");  
        $roles_default = array('1');
        $this->db->where_not_in('roles.id', $roles_default);
        $this->db->where($where);  
        $this->db->order_by('roles.name', 'ASC'); 

        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->result(); 
        } 
        return FALSE;
    }

    public function getOneBy($where = array()){
        $this->db->select("roles.*")->from("roles");  
        $this->db->where($where);  
        $this->db->order_by('roles.name', 'ASC'); 

        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->row(); 
        } 
        return FALSE;
    }
    
    public function insert($data){
        $this->db->insert("roles", $data);
        return $this->db->insert_id();
    }

    public function update($data,$where){
        $this->db->update("roles", $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($where){
        $this->db->where($where);
        $this->db->delete("roles"); 
        if($this->db->affected_rows()){
            return TRUE;
        }
        return FALSE;
    }

    function getAllBy($limit = null,$start= null,$search= null,$col= null,$dir= null,$where=array())
    {
        $this->db->select("roles.*")->from("roles");  
        $this->db->limit($limit,$start)->order_by($col,$dir) ;
        if(!empty($search)){
            $this->db->group_start();
            foreach($search as $key => $value){
                $this->db->or_like($key,$value);    
            }   
            $this->db->group_end();     
        }
        $roles_default = array('1');
        $this->db->where_not_in('roles.id', $roles_default);
        $this->db->where($where); 

        $result = $this->db->get();
        if($result->num_rows()>0)
        {
            return $result->result();  
        }
        else
        {
            return null;
        }
    }

    function getCountAllBy($limit = null,$start= null,$search= null,$col= null,$dir= null,$where=array())
    { 
        $this->db->select("roles.*")->from("roles"); 
        if(!empty($search)){
            $this->db->group_start();
            foreach($search as $key => $value){
                $this->db->or_like($key,$value);    
            }   
            $this->db->group_end();     
        }
        $roles_default = array('1');
        $this->db->where_not_in('roles.id', $roles_default);
        $this->db->where($where); 
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
}
