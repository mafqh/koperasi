<?php

class SimpananWajib extends CI_Controller{

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
        $data['title'] = "Simpanan Wajib";
        $data['jenis'] = $this->koperasiModel->get_data('data_anggota')->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/simpananWajib', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahSimpananWajib()
    {
        $data['title'] = "Tambah Simpanan Wajib";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formTambahSimpananWajib', $data);
        $this->load->view('templates_admin/footer');
    }

    public function Tambah() {
        $data = [];
        $jenis = $this->input->post('jenis_simpanan');

        $data = [
            'id_anggota' => $this->input->post('anggota'),
            'jumlah' => $this->input->post('jumlah'),
            'tanggal' => date("Y/m/d")
        ];
        if($this->session->userdata('hak_akses') == '1'){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }
        $this->db->insert('simpanan_wajib', $data);
        redirect('admin/SimpananWajib/simpanan/' .$jenis);
    }

    public function detailSimpananWajib()
    {
        $jenis = $this->uri->segment(4);
        $anggota = $this->uri->segment(5);
        $data['title'] = "Detail Simpanan Wajib";
        $data['anggota'] = $this->koperasiModel->get_data_by_anggota($jenis,$anggota)->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formDetailSimpananWajib', $data);
        $this->load->view('templates_admin/footer');
    }

    public function editSimpananWajib() {
        $id_simpanan = $this->uri->segment(5);
        $data['simpanan'] = $this->koperasiModel->getDataSimpanan($id_simpanan);
        $data['title'] = "Edit Simpanan Wajib";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formEditSimpananWajib', $data);
        $this->load->view('templates_admin/footer');
    }

    public function update(){
        $jumlah = $this->input->post('jumlah');
        $id = $this->input->post('id_simpanan');
        $id_anggota = $this->input->post('id_anggota');
        $this->db->set('jumlah', $jumlah);
        $this->db->where('id_simpanan_wajib', $id);
        $this->db->update('simpanan_wajib');
        redirect('admin/SimpananPokok/detailSimpananWajib/sw/'.$id_anggota);
    }

    public function deleteData($id, $id_anggota)
    {
        $this->db->where('id_simpanan_wajib', $id);
        $this->db->delete('simpanan_wajib');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data berhasil dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/simpananPokok/detailSimpananWajib/sw/'.$id_anggota);
    }
}

?>