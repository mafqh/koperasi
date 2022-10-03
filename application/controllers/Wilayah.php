<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';

class Wilayah extends Admin_Controller {
    public function __construct()
    {
        parent::__construct(); 
        $this->load->model('wilayah_provinsi_model');
        $this->load->model('wilayah_kabupaten_model');
        $this->load->model('wilayah_kecamatan_model');
        $this->load->model('wilayah_kelurahan_model');
    }

    public function getProvinsi(){
        $response_data = array();        
        $provinsi = $this->wilayah_provinsi_model->getAllById();

        if(!empty($provinsi)){
            $response_data['status'] = true;
            $response_data['data'] = $provinsi;
            $response_data['message'] = 'Berhasil Mengambil Data';
        }else{
            $response_data['status'] = false;
            $response_data['data'] = [];
            $response_data['message'] = 'Gagal Mengambil Data';
        }

        echo json_encode($response_data);
    } 

    public function getKabupaten(){
        $response_data = array();
        $provinsi_id = $this->input->get('id');
        
        $kabupaten = $this->wilayah_kabupaten_model->getAllById(['wilayah_kabupaten.provinsi_id' => $provinsi_id]);
        if(!empty($kabupaten)){
            $response_data['status'] = true;
            $response_data['data'] = $kabupaten;
            $response_data['message'] = 'Berhasil Mengambil Data';
        }else{
            $response_data['status'] = false;
            $response_data['data'] = [];
            $response_data['message'] = 'Gagal Mengambil Data';
        }

        echo json_encode($response_data);
    }   

    public function getKecamatan(){
        $response_data = array();
        $kabupaten_id = $this->input->get('id');
        
        $kecamatan = $this->wilayah_kecamatan_model->getAllById(['wilayah_kecamatan.kabupaten_id' => $kabupaten_id]);
        if(!empty($kecamatan)){
            $response_data['status'] = true;
            $response_data['data'] = $kecamatan;
            $response_data['message'] = 'Berhasil Mengambil Data';
        }else{
            $response_data['status'] = false;
            $response_data['data'] = [];
            $response_data['message'] = 'Gagal Mengambil Data';
        }

        echo json_encode($response_data);
    }

    public function getKelurahan(){
        $response_data = array();
        $kecamatan_id = $this->input->get('id');
        
        $kelurahan = $this->wilayah_kelurahan_model->getAllById(['wilayah_kelurahan.kecamatan_id' => $kecamatan_id]);
        if(!empty($kelurahan)){
            $response_data['status'] = true;
            $response_data['data'] = $kelurahan;
            $response_data['message'] = 'Berhasil Mengambil Data';
        }else{
            $response_data['status'] = false;
            $response_data['data'] = [];
            $response_data['message'] = 'Gagal Mengambil Data';
        }

        echo json_encode($response_data);
    }  


}
