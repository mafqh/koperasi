<?php

class SimpananSukarela extends CI_Controller{

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

    public function simpanan()
    {

        $data['title'] = "Simpanan Tabungan";
        $data['jenis'] = $this->koperasiModel->get_data_simpanan_tabungan()->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/simpananSukarela', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahSimpananSukarela()
    {
        $data['title'] = "Tambah Simpanan Tabungan";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formTambahSimpananSukarela', $data);
        $this->load->view('templates_admin/footer');
    }

    public function Tambah() {
        $jenis = $this->input->post('jenis_simpanan');
        $data = [
            'jenis_simpanan' => $jenis,
            'id_anggota' => $this->input->post('anggota'),
            'jumlah' => $this->input->post('jumlah'),
            'tanggal' => date("Y/m/d")
        ];
        $this->db->insert('data_simpanan', $data);
        redirect('admin/SimpananSukarela/simpanan/' .$jenis);
    }

   public function detailSimpananSukarela()
    {
        $jenis = $this->uri->segment(4);
        $anggota = $this->uri->segment(5);
        $data['title'] = "Detail Simpanan Tabungan";
        $data['anggota'] = $this->koperasiModel->get_data_by_anggota($jenis,$anggota)->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formDetailSimpananSukarela', $data);
        $this->load->view('templates_admin/footer');
    }
}

?>