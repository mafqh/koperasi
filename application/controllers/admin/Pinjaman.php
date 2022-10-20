<?php

class Pinjaman extends CI_Controller{

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

    public function index()
    {
        $data['title'] = "Data Pinjaman";
        $data['pinjaman'] = $this->koperasiModel->get_data_pinjaman()->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/pinjaman', $data);
        $this->load->view('templates_admin/footer');
    }

    public function listAnggota()
    {
        $data['title'] = "List Anggota";
        $data['anggota'] = $this->db->get_where('data_anggota',['hak_akses'=>2])->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/listAnggotaPinjaman', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahData($id_anggota)
    {
        $data['title'] = "Tambah Data Pinjaman";
        $data['anggota'] = $this->db->get_where('data_anggota',['id_anggota'=> $id_anggota])->row();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formTambahPinjaman', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahDataAksi()
    {
        $this->form_validation->set_rules('id_anggota', 'Anggota', 'required');
        $this->form_validation->set_rules('no_pinjaman', 'Nomor Pinjaman', 'required');
        $this->form_validation->set_rules('jumlah_pinjaman', 'Jumlah Pinjaman', 'required');
        $this->form_validation->set_rules('tanggal_pinjaman', 'Tanggal Pinjaman', 'required');
        $this->form_validation->set_rules('lama', 'Lama Pinjaman', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->tambahData();
        }else{
            $id_anggota         = $this->input->post('id_anggota');
            $no_pinjaman        = $this->input->post('no_pinjaman');
            $jumlah_pinjaman    = $this->input->post('jumlah_pinjaman');
            $tanggal_pinjaman   = $this->input->post('tanggal_pinjaman');
            $lama               = $this->input->post('lama');

            $data = array(
                'id_anggota'        => $id_anggota,
                'no_pinjaman'       => $no_pinjaman,
                'jumlah_pinjaman'   => $jumlah_pinjaman,
                'tanggal_pinjaman'  => $tanggal_pinjaman,
                'lama'              => $lama,
                'status'            => 'belum lunas'
            );

            $this->koperasiModel->insert_data($data, 'data_pinjaman');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/pinjaman');
        }
    }

    public function updateData($id)
    {
        $data['title'] = "Update Data Pinjaman";
        $pinjaman = $this->db->get_where('data_pinjaman', ['id' => $id])->row();
        $data['pinjaman'] = $pinjaman;
        $data['anggota'] = $this->db->get_where('data_anggota',['id_anggota'=> $pinjaman->id_anggota])->row();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formupdatePinjaman', $data);
        $this->load->view('templates_admin/footer');
    }

    public function updateDataAksi()
    {
        $this->form_validation->set_rules('id', 'Anggota', 'required');
        $this->form_validation->set_rules('no_pinjaman', 'Nomor Pinjaman', 'required');
        $this->form_validation->set_rules('jumlah_pinjaman', 'Jumlah Pinjaman', 'required');
        $this->form_validation->set_rules('tanggal_pinjaman', 'Tanggal Pinjaman', 'required');
        $this->form_validation->set_rules('lama', 'Lama Pinjaman', 'required');

        if($this->form_validation->run() == FALSE) {
            $id         = $this->input->post('id');
            $this->updateData($id);
        }else{
            $id                 = $this->input->post('id');
            $no_pinjaman        = $this->input->post('no_pinjaman');
            $jumlah_pinjaman    = $this->input->post('jumlah_pinjaman');
            $tanggal_pinjaman   = $this->input->post('tanggal_pinjaman');
            $lama               = $this->input->post('lama');
            $status             = $this->input->post('status');

            $data = array(
                'no_pinjaman'       => $no_pinjaman,
                'jumlah_pinjaman'   => $jumlah_pinjaman,
                'tanggal_pinjaman'  => $tanggal_pinjaman,
                'lama'              => $lama,
                'status'            => $status
            );

            $this->koperasiModel->update_data('data_pinjaman', $data, ['id' => $id]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil diupdate!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/pinjaman');
        }
    }

    public function deleteData($id)
    {
        $where = array('id' => $id);
        $this->koperasiModel->delete_data($where, 'data_pinjaman');
        $where = array('id_pinjaman' => $id);
        $this->koperasiModel->delete_data($where, 'data_angsuran');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data berhasil dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('admin/pinjaman');
    }

    public function detailAngsuran($id)
    {
        $data['title'] = "List Angsuran";
        $pinjaman = $this->db->get_where('data_pinjaman', ['id' => $id])->row();
        $sudah_dibayar = $this->db->select('SUM(jumlah_angsuran) as total')->from('data_angsuran')->where('id_pinjaman', $pinjaman->id)->get()->row()->total;
        $data['pinjaman'] = $pinjaman;
        if($pinjaman->jumlah_pinjaman > $sudah_dibayar){
            $data['belum_dibayar'] = $pinjaman->jumlah_pinjaman - $sudah_dibayar;
        }else{
            $data['belum_dibayar'] = 0;
        }

        $data['sudah_dibayar'] = $sudah_dibayar;
        $data['anggota'] = $this->db->get_where('data_anggota',['id_anggota'=> $pinjaman->id_anggota])->row();
        $data['angsuran'] = $this->db->get_where('data_angsuran', ['id_pinjaman' => $pinjaman->id])->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/angsuran', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahAngsuran($id)
    {
        $data['title'] = "Tambah Angsuran";
        $pinjaman       = $this->db->get_where('data_pinjaman', ['id' => $id])->row();
        $data['pinjaman']   = $pinjaman;
        $data['anggota']    = $this->db->get_where('data_anggota',['id_anggota'=> $pinjaman->id_anggota])->row();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formTambahAngsuran', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahAngsuranAksi()
    {
        $this->form_validation->set_rules('id_pinjaman', 'Pinjaman ID', 'required');
        $this->form_validation->set_rules('no_angsuran', 'Nomor Angsuran', 'required');
        $this->form_validation->set_rules('jumlah_angsuran', 'Jumlah Angsuran', 'required');
        $this->form_validation->set_rules('tanggal_bayar', 'Tanggal Angsuran', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->tambahData();
        }else{
            $id_pinjaman        = $this->input->post('id_pinjaman');
            $no_angsuran        = $this->input->post('no_angsuran');
            $jumlah_angsuran    = $this->input->post('jumlah_angsuran');
            $tanggal_bayar      = $this->input->post('tanggal_bayar');

            $data = array(
                'id_pinjaman'       => $id_pinjaman,
                'no_angsuran'       => $no_angsuran,
                'jumlah_angsuran'   => $jumlah_angsuran,
                'tanggal_bayar'  => $tanggal_bayar,
            );

            $this->koperasiModel->insert_data($data, 'data_angsuran');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/pinjaman/detailAngsuran/'.$id_pinjaman);
        }
    }

    public function updateAngsuran($id)
    {
        $data['title'] = "Update Angsuran";
        $angsuran           = $this->db->get_where('data_angsuran', ['id' => $id])->row();
        $pinjaman           = $this->db->get_where('data_pinjaman', ['id' => $angsuran->id_pinjaman])->row();
        $data['angsuran']   = $angsuran;
        $data['pinjaman']   = $pinjaman;
        $data['anggota']    = $this->db->get_where('data_anggota',['id_anggota'=> $pinjaman->id_anggota])->row();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formUpdateAngsuran', $data);
        $this->load->view('templates_admin/footer');
    }

    public function updateAngsuranAksi()
    {
        $this->form_validation->set_rules('id_angsuran', 'Angsuran Id', 'required');
        $this->form_validation->set_rules('no_angsuran', 'Nomor Angsuran', 'required');
        $this->form_validation->set_rules('jumlah_angsuran', 'Jumlah Angsuran', 'required');
        $this->form_validation->set_rules('tanggal_bayar', 'Tanggal Angsuran', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->tambahData();
        }else{
            $id_pinjaman        = $this->input->post('id_pinjaman');
            $id_angsuran        = $this->input->post('id_angsuran');
            $no_angsuran        = $this->input->post('no_angsuran');
            $jumlah_angsuran    = $this->input->post('jumlah_angsuran');
            $tanggal_bayar      = $this->input->post('tanggal_bayar');

            $data = array(
                'no_angsuran'       => $no_angsuran,
                'jumlah_angsuran'   => $jumlah_angsuran,
                'tanggal_bayar'     => $tanggal_bayar,
            );

            $this->koperasiModel->update_data('data_angsuran', $data, ['id' => $id_angsuran]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/pinjaman/detailAngsuran/'.$id_pinjaman);
        }
    }

    public function deleteDataAngsuran($id)
    {
        $angsuran = $this->db->get_where('data_angsuran', ['id' => $id])->row();
        $where = array('id' => $id);
        $this->koperasiModel->delete_data($where, 'data_angsuran');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data berhasil dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('admin/pinjaman/detailAngsuran/'.$angsuran->id_pinjaman);
    }
}

?>