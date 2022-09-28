<?php

class ValidasiSimpananPokok extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('hak_akses') !='1'){
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Anda belum login!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>');
				redirect('welcome');
        }
    }

    public function validasiPembayaran($jenis)
    {
        $data['title'] = "Validasi Biaya Administrasi";
        $data['jenis'] = $this->koperasiModel->get_data('data_anggota')->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/validasiSimpananPokok', $data);
        $this->load->view('templates_admin/footer');
    }

    public function deleteData($id, $id_anggota)
    {
        $this->db->where('id_biaya_administrasi', $id);
        $this->db->delete('biaya_administrasi');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data berhasil dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/simpananPokok/detailSimpananPokok/sp/'.$id_anggota);
    }
}

?>