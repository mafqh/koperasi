<?php 
require_once APPPATH . 'core/Admin_Controller.php';

class GantiPassword extends Admin_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        if($this->data['is_can_read']){
            $this->data['title'] = "Ganti Password";
            $this->load->view('templates_admin/header', $this->data);
            $this->load->view('templates_admin/sidebar', $this->data);
            $this->load->view('admin/formGantiPassword', $this->data);
            $this->load->view('templates_admin/footer');
        }else{
            show_404();
        }
    }

    public function gantiPasswordAksi()
    {
        if($this->data['is_can_read']){
            $passBaru  = $this->input->post('passBaru') ;
            $ulangPass = $this->input->post('ulangPass');
    
            $this->form_validation->set_rules('passBaru', 'password baru','required|matches[ulangPass]');
            $this->form_validation->set_rules('ulangPass', 'ulangi password','required');
    
            if($this->form_validation->run() != FALSE) {
                $data = array('password' => md5($passBaru));
                $id = array('id_pengurus' => $this->session->userdata('id_pengurus'));
    
                $this->koperasiModel->update_data('data_pengurus', $data, $id);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Password berhasil diganti!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('login');
            }else{
                $this->data['title'] = "Ganti Password";
                $this->load->view('templates_admin/header', $this->data);
                $this->load->view('templates_admin/sidebar', $this->data);
                $this->load->view('admin/formGantiPassword', $this->data);
                $this->load->view('templates_admin/footer');
            }
        }else{
            show_404();
        }
    }
}

?>