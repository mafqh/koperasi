<?php
require_once APPPATH . 'core/Admin_Controller.php';

class Dashboard extends Admin_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        if($this->data['is_can_read']){
            $this->data['title']  = "Dashboard";
            $this->load->view('templates_admin/header', $this->data);
            $this->load->view('templates_admin/sidebar', $this->data);
    
            if($this->session->userdata('hak_akses') == 1){
                $this->data['total_pengurus'] = $this->koperasiModel->get_data_where('data_anggota', 'hak_akses', 1)->num_rows();
                $this->data['total_anggota'] = $this->koperasiModel->get_data_where('data_anggota', 'hak_akses', 2)->num_rows();
        
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
                $this->data['saldo'] = $saldo;
                $this->data['total_angsuran'] = $total_angsuran;
                $this->load->view('admin/dashboard', $this->data);
            }else{
                $id = $this->session->userdata('id_anggota');
                $this->data['anggota'] = $this->db->get_where('data_anggota',['id_anggota'=>$id])->result();
                $this->load->view('anggota/dashboard', $this->data);
            }
            $this->load->view('templates_admin/footer');
        }else{
            show_404();
        }
    }

    public function dataChartTabungan($tahun)
    {   
        //get total simpanan perbulan
        $data_perbulan = [];
        $perbulan = $this->koperasiModel->get_tabungan_perbulan($tahun);
        if(!empty($perbulan)){
            foreach ($perbulan as $key => $value) {
                $total = $value->total;
                if($value->jenis_simpanan == "pengeluaran"){
                    if(!empty($data_perbulan[$value->bulan]["kredit"])){
                        $data_perbulan[$value->bulan]["kredit"] += $total;
                    }else{
                        $data_perbulan[$value->bulan]["kredit"] = $total;
                    }
                }else{
                    if(!empty($data_perbulan[$value->bulan]["debit"])){
                        $data_perbulan[$value->bulan]["debit"] += $total;
                    }else{
                        $data_perbulan[$value->bulan]["debit"] = $total;
                    }
                }
            }
        }


        $kategori = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];
        
        $data_debit = [];
        $data_kredit = [];
        $data_saldo = [];
        for ($i=1; $i < count($kategori)+1 ; $i++) { 
            $tmp_debit = 0;
            if(!empty($data_perbulan[$i]["debit"])){
                $tmp_debit = intVal($data_perbulan[$i]["debit"]);
            }
            $data_debit[] = $tmp_debit;

            $tmp_kredit = 0;
            if(!empty($data_perbulan[$i]["kredit"])){
                $tmp_kredit = intVal($data_perbulan[$i]["kredit"]);
            }
            $data_kredit[] = $tmp_kredit;
            
            $data_saldo[] = intVal($tmp_debit - $tmp_kredit);
        }

        $response_data['status']      = true;
        $response_data['kategori']    = $kategori;
        $response_data['data_debit']  = $data_debit;
        $response_data['data_kredit'] = $data_kredit;
        $response_data['data_saldo']  = $data_saldo;
        $response_data['message']     = "Berhasil Mengambil Data";

        echo json_encode($response_data);
    }
}

?>