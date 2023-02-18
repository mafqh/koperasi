<?php
require_once APPPATH . 'core/Admin_Controller.php';

class DataAnggota extends Admin_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        if($this->data['is_can_read']){
            $this->data['title'] = "Data Anggota";
            $this->data['anggota'] = $this->db->get_where('data_anggota',['hak_akses'=>2])->result();
            $this->load->view('templates_admin/header', $this->data);
            $this->load->view('templates_admin/sidebar', $this->data);
            $this->load->view('admin/dataAnggota', $this->data);
            $this->load->view('templates_admin/footer');
        }else{
            show_404();
        }

    }

    public function tambahData()
    {
        if($this->data['is_can_create']){
            $this->data['title'] = "Tambah Data Anggota";
            $this->load->view('templates_admin/header', $this->data);
            $this->load->view('templates_admin/sidebar', $this->data);
            $this->load->view('admin/formTambahAnggota', $this->data);
            $this->load->view('templates_admin/footer');
        }else{
            show_404();
        }
    }

    public function tambahDataAksi()
    {
        if($this->data['is_can_create']){
            $this->_rules();
    
            if($this->form_validation->run() == FALSE) {
                $this->tambahData();
            }else{
                $nik             = $this->input->post('nik');
                $alamat_anggota  = $this->input->post('alamat_anggota');
                $no_telp         = $this->input->post('no_telp');
                $nama_anggota    = $this->input->post('nama_anggota');
                $jenis_kelamin   = $this->input->post('jenis_kelamin');
                $tanggal_masuk   = $this->input->post('tanggal_masuk');
                $status          = $this->input->post('status');
                $username        = $this->input->post('username');
                $password        = md5($this->input->post('password'));
                $photo           = $_FILES['photo']['name'];
                if($photo=''){}else{
                    $config ['upload_path'] = './assets/photo';
                    $config ['allowed_types'] = 'jpg|jpeg|png|tiff';
                    $this->load->library('upload', $config);
                    if(!$this->upload->do_upload('photo')){
                        echo "Photo Gagal diupload!";
                    }else{
                        $photo = $this->upload->data('file_name');
                    }
                }
    
                $data = array(
                    'nik'            => $nik,
                    'alamat_anggota' => $alamat_anggota,
                    'no_telp'        => $no_telp,
                    'nama_anggota'   => $nama_anggota,
                    'jenis_kelamin'  => $jenis_kelamin,
                    'tanggal_masuk'  => $tanggal_masuk,
                    'status'         => $status,
                    'hak_akses'      => 2,
                    'username'       => $username,
                    'password'       => $password,
                    'photo'          => $photo,
                );
    
                $this->koperasiModel->insert_data($data, 'data_anggota');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil ditambahkan!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('DataAnggota');
            }
        }else{
            show_404();
        }
    }

    public function detailAnggota($id)
    {
        if($this->data['is_can_read']){
            $where = array('id_anggota' => $id);
            $this->data['title'] = "Detail Data Anggota";
            $this->data['anggota'] = $this->db->get_where('data_anggota',$where)->result();
            $this->load->view('templates_admin/header', $this->data);
            $this->load->view('templates_admin/sidebar', $this->data);
            $this->load->view('admin/detailDataAnggota', $this->data);
            $this->load->view('templates_admin/footer');
        }else{
            show_404();
        }
    }

    public function updateData($id)
    {
        if($this->data['is_can_edit']){
            $where = array('id_anggota' => $id);
            $this->data['title'] = 'Update Data Anggota';
            $this->data['anggota'] = $this->db->get_where('data_anggota',$where)->result();
            $this->data['jabatan'] = $this->koperasiModel->get_data_where('data_jabatan','is_pengurus','0')->result();
            $this->load->view('templates_admin/header', $this->data);
            $this->load->view('templates_admin/sidebar', $this->data);
            $this->load->view('admin/formUpdateAnggota', $this->data);
            $this->load->view('templates_admin/footer');
        }else{
            show_404();
        }
    }

    public function updateDataAksi()
    {
        if($this->data['is_can_edit']){
            $this->_rules();
            
            $id              = $this->input->post('id_anggota');
            $nik             = $this->input->post('nik');
            $nama_anggota    = $this->input->post('nama_anggota');
            $alamat_anggota  = $this->input->post('alamat_anggota');
            $no_telp         = $this->input->post('no_telp');
            $jenis_kelamin   = $this->input->post('jenis_kelamin');
            $tanggal_masuk   = $this->input->post('tanggal_masuk');
            $status          = $this->input->post('status');
            $username        = $this->input->post('username');
            $status          = $this->input->post('status');
            $photo           = $_FILES['photo']['name'];
            if($photo){
                $config ['upload_path'] = './assets/photo';
                $config ['allowed_types'] = 'jpg|jpeg|png|tiff';
                $this->load->library('upload', $config);
                if($this->upload->do_upload('photo')){
                    echo "Photo Gagal diupload!";
                    $photo = $this->upload->data('file_name');
                    $this->db->set('photo', $photo);
                }else{
                    echo $this->upload->display_errors();
                }
            }
    
            $data = array(
                'nik'            => $nik,
                'nama_anggota'   => $nama_anggota,
                'alamat_anggota' => $alamat_anggota,
                'no_telp'        => $no_telp,
                'jenis_kelamin'  => $jenis_kelamin,
                'tanggal_masuk'  => $tanggal_masuk,
                'status'         => $status,
                'hak_akses'      => 2,
                'username'       => $username,
            );
    
            $where = array(
                'id_anggota' => $id
            );
    
            $this->koperasiModel->update_data('data_anggota', $data, $where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil diupdate!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('DataAnggota');
        }else{
            show_404();
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('nama_anggota', 'nama anggota', 'required');
        $this->form_validation->set_rules('alamat_anggota', 'alamat anggota', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'required');
        $this->form_validation->set_rules('tanggal_masuk', 'tanggal masuk', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');
        $this->form_validation->set_rules('no_telp', 'nomor telepon', 'required');
    }

    public function deleteData($id)
    {
        if($this->data['is_can_delete']){
            $where = array('id_anggota' => $id);
            $this->koperasiModel->delete_data($where, 'data_anggota');
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data berhasil dihapus!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('dataAnggota');
        }else{
            show_404();
        }
    }

    public function exportPdf()
    {
        if($this->data['is_can_export_pdf']){
            $this->load->library('pdf');
    
            $this->pdf->setPaper('A4', 'landscape');
            $this->pdf->set_option('isRemoteEnabled', TRUE);
            $this->pdf->set_option('defaultFont', 'arial');
            $this->pdf->set_base_path("/");
            $data = [];
            $data["listData"] = $this->db->order_by('id_anggota', 'ASC')->get_where("data_anggota", ['hak_akses'=>2])->result();
            $this->pdf->filename = "Data Anggota ".date("dmY").".pdf";
            $html = $this->load->view('admin/pdfAnggota', $data, TRUE);
    
            $this->pdf->load_html($html);
            $this->pdf->render();
    
            $output = $this->pdf->output();
            $this->pdf->stream($this->pdf->filename, array("Attachment" => FALSE));
        }else{
            show_404();
        }
    }
}

?>