<?php

class SimpananPokok extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('hak_akses') !='2'){
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Anda belum login!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>');
				redirect('welcome');
        }
    }

    public function index(){
        $data['title'] = "Biaya Administrasi";
        $data['anggota'] = $this->db->get_where('data_anggota',['id_anggota'=>$this->session->userdata('id_anggota')])->row();
        $data['simpanan_pokok'] = $this->db->get_where('biaya_administrasi',['id_anggota'=>$this->session->userdata('id_anggota')])->result();
        $this->load->view('templates_anggota/header', $data);
        $this->load->view('templates_anggota/sidebar');
        $this->load->view('anggota/SimpananPokok', $data);
        $this->load->view('templates_anggota/footer');
    }

    public function tambahSimpananPokok()
    {
        $data['title'] = "Tambah Biaya Administrasi";
        $this->load->view('templates_anggota/header', $data);
        $this->load->view('templates_anggota/sidebar');
        $this->load->view('anggota/formTambahSimpananPokok', $data);
        $this->load->view('templates_anggota/footer');
    }
}