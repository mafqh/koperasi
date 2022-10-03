<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Password extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct();
	}  
	public function index()
	{ 

		if (!empty($_POST))
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old_password'), $this->input->post('new_password'));

			if ($change)
			{
				$this->session->set_flashdata('message', 'Password Lama Berhasil Diubah');
				redirect('password', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message_error', 'Password Lama Tidak Cocok');
				redirect('password', 'refresh');
			}
		} 
		else
		{
			$this->data['page'] = "Ubah Password";
			$this->data['content'] = 'backend/password/edit_v'; 
			$this->load->view('backend/layouts/page',$this->data);
		}    
	}  
}
