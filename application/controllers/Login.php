<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->_rules();

		if($this->form_validation->run()==FALSE){
			$data['title'] = "Form Login";
			$this->load->view('templates_admin/header', $data);
			$this->load->view('formLogin');
		}else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$cek = $this->koperasiModel->cek_login($username, $password);
			if($cek == FALSE)
			{
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Username atau password salah!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>');
				redirect('login');
			}else{
				$this->session->set_userdata('hak_akses',$cek->hak_akses);
				$this->session->set_userdata('nama_anggota',$cek->nama_anggota);
				$this->session->set_userdata('photo',$cek->photo);
				$this->session->set_userdata('id_anggota',$cek->id_anggota);
				$this->session->set_userdata('nik',$cek->nik);
				$this->session->set_userdata('status',$cek->status);
				
				$this->autoRedirect();
			}
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	public function autoRedirect()
	{
		$status = $this->session->userdata('status');
		if($status != 1){
			$akses = $this->koperasiModel->getOneAksesMenu($status);
			if(!empty($akses)){
				redirect($akses->menu);
			}else{
				$this->session->sess_destroy();
				redirect('login');
			}
		}else{
			redirect('dashboard');
		}
	}
}