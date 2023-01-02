<?php

class Dashboard extends CI_Controller{

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
        $data['title']  = "Dashboard";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');

        if($this->session->userdata('hak_akses') == 1){
            $data['total_pengurus'] = $this->koperasiModel->get_data_where('data_anggota', 'hak_akses', 1)->num_rows();
            $data['total_anggota'] = $this->koperasiModel->get_data_where('data_anggota', 'hak_akses', 2)->num_rows();
    
            //get saldo koperasi
            $saldo = 0;
            $saldo_administrasi = $this->koperasiModel->get_data_count('biaya_administrasi', 'jumlah')->row()->total;
            $saldo += $saldo_administrasi;
            
            $saldo_simpanan_tabungan    = $this->koperasiModel->get_data_count('simpanan_tabungan', 'jumlah', ['jenis_simpanan' => 'pemasukan'])->row()->total;
            $saldo_simpanan_pengeluaran = $this->koperasiModel->get_data_count('simpanan_tabungan', 'jumlah', ['jenis_simpanan' => 'pengeluaran'])->row()->total;
            $saldo += ($saldo_simpanan_tabungan - $saldo_simpanan_pengeluaran);
    
            $saldo_simpanan_wajib = $this->koperasiModel->get_data_count('simpanan_wajib', 'jumlah')->row()->total;
            $saldo += $saldo_simpanan_wajib;
            
            $total_angsuran = 0;
            $total_pinjaman = $this->koperasiModel->get_data_count('data_pinjaman', 'jumlah_pinjaman')->row()->total;
            $total_angsuran = $this->koperasiModel->get_data_count('data_angsuran', 'jumlah_angsuran')->row()->total;
            $total_angsuran = $total_pinjaman - $total_angsuran;
            
            $saldo -= $total_angsuran;
            $data['saldo'] = $saldo;
            $data['total_angsuran'] = $total_angsuran;
            $this->load->view('admin/dashboard', $data);
        }else{
            $id = $this->session->userdata('id_anggota');
            $data['anggota'] = $this->db->get_where('data_anggota',['id_anggota'=>$id])->result();
            $this->load->view('anggota/dashboard', $data);
        }
        $this->load->view('templates_admin/footer');
    }
}

?>