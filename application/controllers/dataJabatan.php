<?php
require_once APPPATH . 'core/Admin_Controller.php';

class DataJabatan extends Admin_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        if($this->data['is_can_read']){
            $this->data['title'] = "Data Jabatan";
            $this->data['jabatan'] = $this->db->get_where('data_jabatan',['id_jabatan !='=> 1])->result();
            $this->load->view('templates_admin/header', $this->data);
            $this->load->view('templates_admin/sidebar', $this->data);
            $this->load->view('admin/dataJabatan', $this->data);
            $this->load->view('templates_admin/footer');
        }else{
            show_404();
        }
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
        redirect('DataJabatan');
    }

    public function hakAkses($id)
    {
        if($this->data['is_can_hak_akses']){
            $this->data['menus'] = [
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
    
            $this->data['fungsi'] = [
                1 => "Read", 
                2 => "Create",
                3 => "Update",
                4 => "Delete",
                5 => "Export Excel",
                6 => "Export Pdf",
                7 => "Hak Akses"
            ];
    
            // "url menu" => [id fungsi]
            $this->data['privilege'] = [
                "dashboard" => [1],
                "dataJabatan" => [1,7],
                "dataPengurus" => [1,2,3,4],
                "dataAnggota" => [1,2,3,4,6],
                "simpananPokok" => [1,2,3,4,5,6],
                "simpananWajib" => [1,2,3,4,5,6],
                "simpananSukarela" => [1,2,3,4,5,6],
                "pinjaman" => [1,2,3,4,5,6],
                "gantiPassword" => [1],
            ];
    
    
            $this->data['title'] = "Hak Akses";
            $data_hak_akses = $this->db->get_where('hak_akses', ['id_jabatan' => $id])->result();
            $hak_akses = [];
            if(!empty($data_hak_akses)){
                foreach ($data_hak_akses as $value) {
                    $hak_akses[$value->menu][$value->fungsi] = "checked";
                }
            }
            $this->data['hak_akses'] = $hak_akses;
            $this->data['jabatan'] = $this->db->get_where('data_jabatan',['id_jabatan'=> $id])->row();
            $this->load->view('templates_admin/header', $this->data);
            $this->load->view('templates_admin/sidebar', $this->data);
            $this->load->view('admin/hakAkses', $this->data);
            $this->load->view('templates_admin/footer');
        }else{
            show_404();
        }
    }

    public function updateHakAkses()
    {   
        if($this->data['is_can_hak_akses']){
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
            if(!empty($data)){
                $this->koperasiModel->insert_batch($data, 'hak_akses');
            }
    
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil diupdate!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('DataJabatan');
        }else{
            show_404();
        }
    }
}

?>