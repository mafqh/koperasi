<?php

class Dashboard extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('hak_akses') !='2'){
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
        $data['title'] = "Dashboard";
        $id = $this->session->userdata('id_anggota');
        $data['anggota'] = $this->db->get_where('data_anggota',['id_anggota'=>$id])->result();
        $this->load->view('templates_anggota/header', $data);
        $this->load->view('templates_anggota/sidebar');
        $this->load->view('anggota/dashboard', $data);
        $this->load->view('templates_anggota/footer');
    }
}

?>