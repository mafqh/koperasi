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
        $data = [
            'id_anggota' => $this->input->post('anggota'),
            'jumlah' => $this->input->post('jumlah'),
            'tanggal' => date("Y/m/d"),
            'jenis_simpanan' => 'pemasukan'
        ];
        $this->db->insert('simpanan_tabungan', $data);
        redirect('admin/SimpananSukarela/simpanan');
    }

    public function ambilSimpananSukarela()
    {
        $data['title'] = "Ambil Simpanan Tabungan";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formAmbilSimpananSukarela', $data);
        $this->load->view('templates_admin/footer');
    }

    public function Kurang() {
        $data = [
            'id_anggota' => $this->input->post('anggota'),
            'jumlah' => $this->input->post('jumlah'),
            'tanggal' => date("Y/m/d"),
            'jenis_simpanan' => 'pengeluaran'
        ];
        $this->db->insert('simpanan_tabungan', $data);
        redirect('admin/SimpananSukarela/simpanan');
    }

   public function detailSimpananSukarela()
    {
        $anggota = $this->uri->segment(4);
        $data['title'] = "Detail Simpanan Tabungan";
        $data['anggota'] = $this->koperasiModel->get_data_tabungan_by_anggota($anggota)->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formDetailSimpananSukarela', $data);
        $this->load->view('templates_admin/footer');
    }

    public function updateData($id)
    {
        $data['title'] = "Update Simpanan Tabungan";
        $tabungan = $this->koperasiModel->get_data_where('simpanan_tabungan', 'id_simpanan_tabungan', $id)->row();
        $data['tabungan'] = $tabungan;
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formupdateSimpananSukarela', $data);
        $this->load->view('templates_admin/footer');
    }

    public function Ubah() {
        $id_simpanan_tabungan = $this->input->post('id_simpanan_tabungan');
        $id_anggota = $this->input->post('id_anggota');
        $data = [
            'jumlah' => $this->input->post('jumlah'),
            'tanggal' => date("Y/m/d"),
        ];
        $this->db->update('simpanan_tabungan', $data, ['id_simpanan_tabungan' => $id_simpanan_tabungan]);
        redirect('admin/simpananSukarela/detailSimpananSukarela/'.$id_anggota);
    }

    public function deleteData($id)
    {
        $where = array('id_simpanan_tabungan' => $id);
        $data = $this->koperasiModel->get_data_where('simpanan_tabungan', 'id_simpanan_tabungan', $id)->row();
        $this->koperasiModel->delete_data($where, 'simpanan_tabungan');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data berhasil dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('admin/simpananSukarela/detailSimpananSukarela/'.$data->id_anggota);
    }
}

?>