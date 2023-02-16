<?php

class DataJabatan extends CI_Controller{

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

    public function index()
    {
        $data['title'] = "Data Jabatan";
        $data['jabatan'] = $this->db->get_where('data_jabatan',['id_jabatan !='=> 1])->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/dataJabatan', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahData()
    {
        $data['title'] = "Tambah Data Jabatan";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formTambahJabatan', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahDataAksi()
    {
        $this->_rules();

        if($this->form_validation->run() == FALSE) {
            $this->tambahData();
        }else{
            $nama_jabatan = $this->input->post('nama_jabatan');
            $is_pengurus  = $this->input->post('is_pengurus');

            $data = array(
                'nama_jabatan' => $nama_jabatan,
                'is_pengurus' => $is_pengurus,
            );

            $this->koperasiModel->insert_data($data, 'data_jabatan');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/DataJabatan');
        }
    }

    public function updateData($id)
    {
        $where = array('id_jabatan' => $id);
        $data['title'] = 'Update Data Jabatan';
        $data['jabatan'] = $this->db->get_where('data_jabatan',$where)->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formUpdateJabatan', $data);
        $this->load->view('templates_admin/footer');
    }
    
    public function updateDataAksi()
    {
        $this->_rules();
        
        $id              = $this->input->post('id_jabatan');
        $nama_jabatan    = $this->input->post('nama_jabatan');
        $is_pengurus     = $this->input->post('is_pengurus');

        $data = array(
            'nama_jabatan'   => $nama_jabatan,
            'is_pengurus'    => $is_pengurus,
        );

        $where = array(
            'id_jabatan' => $id
        );

        $this->koperasiModel->update_data('data_jabatan', $data, $where);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil diupdate!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('admin/DataJabatan');
    }

    public function hakAkses($id)
    {

        $data['menus'] = [
            "dashboard" => "Dashboard",
            "dataJabatan" => "Data Jabatan",
            "dataPengurus" => "Data Pengurus",
            "dataAnggota" => "Data Anggota",
            "simpananPokok" => "Simpanan Pokok",
            "simpananWajib" => "Simpanan Wajib",
            "simpananSukarela" => "Simpanan Tabungan",
            "pinjaman" => "Pinjaman",
            "gantiPassword" => "Ganti Password",
        ];

        $data['fungsi'] = [
            1 => "Read", 
            2 => "Create",
            3 => "Update",
            4 => "Delete",
            5 => "Export Excel",
            6 => "Export Pdf",
            7 => "Hak Akses"
        ];

        // "url menu" => [id fungsi]
        $data['privilege'] = [
            "dashboard" => [1],
            "dataJabatan" => [1,2,3,4,7],
            "dataPengurus" => [1,2,3,4],
            "dataAnggota" => [1,2,3,4,6],
            "simpananPokok" => [1,2,3,4,5,6],
            "simpananWajib" => [1,2,3,4,5,6],
            "simpananSukarela" => [1,2,3,4,5,6],
            "pinjaman" => [1,2,3,4,5,6],
            "gantiPassword" => [1],
        ];


        $data['title'] = "Hak Akses";
        $data['jabatan'] = $this->db->get_where('data_jabatan',['id_jabatan'=> $id])->row();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/hakAkses', $data);
        $this->load->view('templates_admin/footer');
    }

    public function updateHakAkses()
    {   
        $id_jabatan      = $this->input->post('id_jabatan');
        $menus           = $this->input->post('menus');
        $functions       = $this->input->post('functions');
        
        $data = [];
        if(!empty($menus)){
            foreach ($menus as $key => $value) {
                if(!empty($functions[$value])){
                    foreach ($functions[$value] as $k => $v) {
                        $data[] = [
                            "id_jabatan" => $id_jabatan,
                            "menu"      => $value,
                            "fungsi"    => $v
                        ];
                    }
                }
            }
        }

        $this->koperasiModel->delete_data(['id_jabatan' => $id_jabatan], 'hak_akses');
        $this->koperasiModel->insert_batch($data, 'hak_akses');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil diupdate!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('admin/DataJabatan');
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_jabatan', 'nama jabatan', 'required');
        $this->form_validation->set_rules('is_pengurus', 'pengurus', 'required');
    }

    public function deleteData($id)
    {
        $where = array('id_jabatan' => $id);
        $this->koperasiModel->delete_data($where, 'data_jabatan');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data berhasil dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('admin/dataJabatan');
    }
}

?>