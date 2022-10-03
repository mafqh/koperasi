<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Wilayah_kelurahan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct(); 
    }  

    public function getAllById($where = array()){
        $this->db->select("wilayah_kelurahan.*")->from("wilayah_kelurahan");
        $this->db->where($where);  
        $this->db->order_by('wilayah_kelurahan.id', 'ASC'); 

        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->result(); 
        } 
        return FALSE;
    }

    public function getOneBy($where = array()){
        $this->db->select("wilayah_kelurahan.*")->from("wilayah_kelurahan");  
        $this->db->where($where);  
        $this->db->order_by('wilayah_kelurahan.id', 'ASC'); 

        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->row(); 
        } 
        return FALSE;
    }
    
    public function insert($data){
        $this->db->insert("wilayah_kelurahan", $data);
        return $this->db->insert_id();
    }

    public function update($data,$where){
        $this->db->update("wilayah_kelurahan", $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($where){
        $this->db->where($where);
        $this->db->delete("wilayah_kelurahan"); 
        if($this->db->affected_rows()){
            return TRUE;
        }
        return FALSE;
    }

    function getAllBy($limit = null,$start= null,$search= null,$col= null,$dir= null,$where=array())
    {
        $this->db->select("wilayah_provinsi.id as provinsi_id, wilayah_provinsi.name as nama_provinsi, wilayah_kabupaten.id as kabupaten_id, wilayah_kabupaten.name as nama_kabupaten, wilayah_kecamatan.id as kecamatan_id, wilayah_kecamatan.name as nama_kecamatan, wilayah_kelurahan.id as kelurahan_id, wilayah_kelurahan.name as nama_kelurahan, wilayah_kelurahan.is_deleted as is_deleted")->from("wilayah_kelurahan");
        $this->db->join("wilayah_kecamatan","wilayah_kecamatan.id = wilayah_kelurahan.kecamatan_id"); 
        $this->db->join("wilayah_kabupaten","wilayah_kabupaten.id = wilayah_kecamatan.kabupaten_id"); 
        $this->db->join("wilayah_provinsi","wilayah_provinsi.id = wilayah_kabupaten.provinsi_id"); 
        $this->db->limit($limit,$start)->order_by($col,$dir) ;
        if(!empty($search)){
            $this->db->group_start();
            foreach($search as $key => $value){
                $this->db->or_like($key,$value);    
            }   
            $this->db->group_end();     
        }
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
        $this->db->select("wilayah_provinsi.id as provinsi_id, wilayah_provinsi.name as nama_provinsi, wilayah_kabupaten.id as kabupaten_id, wilayah_kabupaten.name as nama_kabupaten, wilayah_kecamatan.id as kecamatan_id, wilayah_kecamatan.name as nama_kecamatan, wilayah_kelurahan.id as kelurahan_id, wilayah_kelurahan.name as nama_kelurahan, wilayah_kelurahan.is_deleted as is_deleted")->from("wilayah_kelurahan");
        $this->db->join("wilayah_kecamatan","wilayah_kecamatan.id = wilayah_kelurahan.kecamatan_id"); 
        $this->db->join("wilayah_kabupaten","wilayah_kabupaten.id = wilayah_kecamatan.kabupaten_id"); 
        $this->db->join("wilayah_provinsi","wilayah_provinsi.id = wilayah_kabupaten.provinsi_id"); 
        if(!empty($search)){
            $this->db->group_start();
            foreach($search as $key => $value){
                $this->db->or_like($key,$value);    
            }   
            $this->db->group_end();     
        }
        $this->db->where($where); 
        
        $result = $this->db->get();
    
        return $result->num_rows();
    } 

    public function getLastKode($where = array()){
        $this->db->select("id");
        $this->db->from('wilayah_kelurahan');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $this->db->where($where); 
        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->row()->id; 
        } 
        return FALSE;
    }

    public function getAllOrderKelurahan($where = array())
    {
        $this->db->select("wilayah_kelurahan.id, wilayah_kelurahan.name as nama_kelurahan, 
                           wilayah_kecamatan.id as kecamatan_id, wilayah_kecamatan.name as nama_kecamatan,
                           wilayah_kabupaten.id as kabupaten_id, wilayah_kabupaten.name as nama_kabupaten,
                           wilayah_provinsi.name as nama_provinsi")->from("wilayah_kelurahan");
        $this->db->join("wilayah_kecamatan", "wilayah_kecamatan.id = wilayah_kelurahan.kecamatan_id");
        $this->db->join("wilayah_kabupaten", "wilayah_kabupaten.id = wilayah_kecamatan.kabupaten_id");
        $this->db->join("wilayah_provinsi",  "wilayah_provinsi.id  = wilayah_kabupaten.provinsi_id");
        $this->db->where($where);  
        $this->db->order_by("wilayah_kecamatan.id", "ASC"); 
        $this->db->order_by("wilayah_kelurahan.id", "ASC"); 

        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->result(); 
        } 
        return FALSE;
    }
}
