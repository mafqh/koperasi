<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';

class Profile extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct();
		$this->load->model('profile_model');
		$this->load->model('wilayah_provinsi_model');
        $this->load->model('wilayah_kabupaten_model');
        $this->load->model('wilayah_kecamatan_model');
        $this->load->model('wilayah_kelurahan_model');
	}  
	public function index()
	{ 
		if (!empty($_POST))
		{
			//set variabel input
			$id 	  = $this->data['users']->id;
			$kode     = $this->data['users']->kode;
            $email    = strtolower($this->input->post('email'));
            $first_name = strtolower($this->input->post('first_name'));
            $phone = $this->input->post('phone');
            $nik = $this->input->post('nik');

            $provinsi_id  = $this->config->item('provinsi_id');
            $kabupaten_id = $this->input->post('kabupaten_id');
            $kecamatan_id = $this->input->post('kecamatan_id');
            $kelurahan_id = $this->input->post('kelurahan_id');
            $address = strtolower($this->input->post('address'));

            //data
            $data = [
                'first_name'   => $first_name, 
                'phone'        => $phone, 
                'provinsi_id'  => $provinsi_id, 
                'kabupaten_id' => $kabupaten_id, 
                'kecamatan_id' => $kecamatan_id, 
                'kelurahan_id' => $kelurahan_id, 
                'address'      => $address, 
                'nik'          => $nik
            ]; 

            $photo         = $_FILES['photo']['name'];
            if(!empty($photo)) {
                $location_path = "./uploaded/profile/".$kode."/";
                if(!is_dir("./uploaded/")){
                    mkdir("./uploaded/", 0777, TRUE);
                }
                if(!is_dir($location_path)){
                    mkdir($location_path, 0777, TRUE);
                }
                $uploaded      = uploadFile("photo", $location_path,$kode,1);
                $arr_file = [];

                if($uploaded['status']==1){
                    $data['photo'] = str_replace(' ', '_', $uploaded['file']);
                    $file_thumb = str_replace(' ', '_', $uploaded['file_thumb']);
                    $arr_file[] = $data['photo'];
                    $arr_file[] = $file_thumb;
                }
            }

            log_message('CUSTOM', "user_id => ".$this->data['users']->id.", function => edit");
            log_message('CUSTOM', "user_id => ".$this->data['users']->id.", data => ".json_encode($data));

            $this->ion_auth->update($id, $data);

            if ($this->db->trans_status() === FALSE){  
                log_message('CUSTOM', "user_id => ".$this->data['users']->id.", function => edit error");
                $this->db->trans_rollback();
                $this->session->set_flashdata('message_error',"Gagal Disimpan");
                redirect("profile");
            }else{
                if (is_dir($location_path) && !empty($photo)){
                    if ($handle = opendir($location_path)) {
                        while (false !== ($entry = readdir($handle))) {
                            if ($entry != "." && $entry != "..") {
                                if(!in_array($entry, $arr_file)){
                                    if(is_file($location_path.$entry)) {
                                        unlink($location_path.$entry);
                                    }
                                }
                            }
                        }
                        closedir($handle);
                    }
                }

                log_message('CUSTOM', "user_id => ".$this->data['users']->id.", function => edit success");
                $this->db->trans_commit();
                $this->session->set_flashdata('message', "Berhasil Disimpan");
                redirect("profile");
            }
		} 
		else
		{	
			$this->data['provinsi_id']  = $this->config->item('provinsi_id');
            $this->data['kabupaten_id'] = $this->config->item('kabupaten_id');

            $this->data['provinsi']   = $this->wilayah_provinsi_model->getAllById(['id' => $this->config->item('provinsi_id')]);
            $this->data['kabupaten']  = $this->wilayah_kabupaten_model->getAllById(['provinsi_id' => $this->config->item('provinsi_id')]);

			$this->data['page'] = "Profile";
			$this->data['content'] = 'backend/profile/edit_v'; 
			$this->load->view('backend/layouts/page',$this->data);
		}    
	}  
}
