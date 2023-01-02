<?php

class SimpananPokok extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if(!$this->session->userdata('hak_akses')){
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Anda belum login!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>');
				redirect('login');
        }
    }

    public function simpanan()
    {
        $anggota = "";
        if($this->session->userdata('hak_akses') == 2){
            $anggota = $this->session->userdata('id_anggota');
        }

        $data['title'] = "Simpanan Pokok";
        $data['jenis'] = $this->koperasiModel->get_data_biaya_administrasi($anggota)->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/SimpananPokok', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahSimpananPokok()
    {
        if($this->session->userdata('hak_akses') == 1){
            $data['title'] = "Tambah Simpanan Pokok";
            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/formTambahSimpananPokok', $data);
            $this->load->view('templates_admin/footer');
        }else{
            redirect('admin/dashboard');
        }
    }

    public function Tambah() 
    {
        if($this->session->userdata('hak_akses') == 1){
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
            $this->db->insert('biaya_administrasi', $data);
            redirect('admin/SimpananPokok/simpanan/' .$jenis);
        }else{
            redirect('admin/dashboard');
        }
    }

    public function detailSimpananPokok()
    {
        $anggota = $this->uri->segment(4);
        $data['title'] = "Detail Simpanan Pokok";
        $data['anggota'] = $this->koperasiModel->get_data_administrasi_by_anggota($anggota)->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formDetailSimpananPokok', $data);
        $this->load->view('templates_admin/footer');
    }

    public function editSimpananPokok() 
    {
        if($this->session->userdata('hak_akses') == 1){
            $id_simpanan = $this->uri->segment(4);
            $data['simpanan'] = $this->koperasiModel->getDataSimpanan($id_simpanan);
            $data['title'] = "Edit Simpanan Pokok";
            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/formEditSimpananPokok', $data);
            $this->load->view('templates_admin/footer');
        }else{
            redirect('admin/dashboard');
        }
    }

    public function update()
    {
        if($this->session->userdata('hak_akses') == 1){
            $jumlah = $this->input->post('jumlah');
            $id = $this->input->post('id_simpanan');
            $id_anggota = $this->input->post('id_anggota');
            $this->db->set('jumlah', $jumlah);
            $this->db->where('id_biaya_administrasi', $id);
            $this->db->update('biaya_administrasi');
            redirect('admin/SimpananPokok/detailSimpananPokok/'.$id_anggota);
        }else{
            redirect('admin/dashboard');
        }
    }

    public function deleteData($id, $id_anggota)
    {
        if($this->session->userdata('hak_akses') == 1){
            $this->db->where('id_biaya_administrasi', $id);
            $this->db->delete('biaya_administrasi');
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data berhasil dihapus!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('admin/simpananPokok/detailSimpananPokok/'.$id_anggota);
        }else{
            redirect('admin/dashboard');   
        }
    }
}

?>