<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SimpananPokok extends CI_Controller{

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

    public function simpanan()
    {
        $anggota = "";
        if($this->session->userdata('hak_akses') == 2){
            $anggota = $this->session->userdata('id_anggota');
        }

        $data['title'] = "Simpanan Pokok";
        $data['jenis'] = $this->koperasiModel->get_data_biaya_administrasi($anggota)->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/SimpananPokok', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahSimpananPokok()
    {
        if($this->session->userdata('hak_akses') == 1){
            $data['title'] = "Tambah Simpanan Pokok";
            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/formTambahSimpananPokok', $data);
            $this->load->view('templates_admin/footer');
        }else{
            redirect('admin/dashboard');
        }
    }

    public function Tambah() 
    {
        if($this->session->userdata('hak_akses') == 1){
            $data = [];
            $jenis = $this->input->post('jenis_simpanan');
    
            $data = [
                'id_anggota' => $this->input->post('anggota'),
                'jumlah' => $this->input->post('jumlah'),
                'tanggal' => date("Y/m/d")
            ];
            if($this->session->userdata('hak_akses') == '1'){
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }
            $this->db->insert('biaya_administrasi', $data);
            redirect('admin/SimpananPokok/simpanan/' .$jenis);
        }else{
            redirect('admin/dashboard');
        }
    }

    public function detailSimpananPokok()
    {
        $anggota = $this->uri->segment(4);
        $data['id_anggota'] = $anggota;
        $data['title'] = "Detail Simpanan Pokok";
        $data['anggota'] = $this->koperasiModel->get_data_administrasi_by_anggota($anggota)->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formDetailSimpananPokok', $data);
        $this->load->view('templates_admin/footer');
    }

    public function editSimpananPokok() 
    {
        if($this->session->userdata('hak_akses') == 1){
            $id_simpanan = $this->uri->segment(4);
            $data['simpanan'] = $this->koperasiModel->getDataSimpanan($id_simpanan);
            $data['title'] = "Edit Simpanan Pokok";
            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/formEditSimpananPokok', $data);
            $this->load->view('templates_admin/footer');
        }else{
            redirect('admin/dashboard');
        }
    }

    public function update()
    {
        if($this->session->userdata('hak_akses') == 1){
            $jumlah = $this->input->post('jumlah');
            $id = $this->input->post('id_simpanan');
            $id_anggota = $this->input->post('id_anggota');
            $this->db->set('jumlah', $jumlah);
            $this->db->where('id_biaya_administrasi', $id);
            $this->db->update('biaya_administrasi');
            redirect('admin/SimpananPokok/detailSimpananPokok/'.$id_anggota);
        }else{
            redirect('admin/dashboard');
        }
    }

    public function deleteData($id, $id_anggota)
    {
        if($this->session->userdata('hak_akses') == 1){
            $this->db->where('id_biaya_administrasi', $id);
            $this->db->delete('biaya_administrasi');
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data berhasil dihapus!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('admin/simpananPokok/detailSimpananPokok/'.$id_anggota);
        }else{
            redirect('admin/dashboard');   
        }
    }

    public function exportExcel() 
    {
        $spreadsheet = new Spreadsheet();
        \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder(new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder());

        $sheet = $spreadsheet->getActiveSheet();

        //set widht kolom
        $batas = "F";
        for($i = 'A'; $i <= 'Z'; $i++) {
            $sheet->getColumnDimension($i)->setAutoSize(true);
            if($batas == $i){
                break;
            }
        }

        //set header tingkat 1
        $sheet->setCellValue('A1', "LAPORAN SIMPANAN POKOK ANGGOTA KOPERASI BOGOR GADING RESIDENCE");
        $sheet->getStyle("A1")->getFont()->setSize(16)->setBold(true);
        $sheet->mergeCells("A1:H1");
        
        $sheet->setCellValue('A4', 'NO.');
        $sheet->setCellValue('B4', 'NO. ANGGOTA');
        $sheet->setCellValue('C4', 'NAMA ANGGOTA');
        $sheet->setCellValue('D4', 'STATUS');
        $sheet->setCellValue('E4', 'JUMLAH SIMPANAN POKOK');
        $sheet->setCellValue('F4', 'SISA YANG HARUS DIBAYAR');
        
        $sheet->getStyle("A4:F4")->getFont()->setBold(true);
        $sheet->getStyle('A4:F4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A4:F4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $datas = $this->koperasiModel->get_all_data_biaya_administrasi(); 
        //isi data
        $total_simpanan_pokok = 0;
        $total_sisa = 0;
        $no = 1;
        $x = 5;
        if (!empty($datas)) {
            foreach ($datas as $row) {
                $total_biaya_admin = 200000;
                $total_bayar = $row->total;
                $sisa = $total_biaya_admin - $total_bayar;

                $total_simpanan_pokok += $total_bayar;
                $total_sisa += $sisa;

                $status = "Lunas";
                if($sisa > 0){
                    $status = "Belum Lunas";
                }

                $sheet->setCellValueExplicit('A' . $x, $no++, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('B' . $x, $row->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('C' . $x, $row->nama_anggota, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('D' . $x, $status, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('E' . $x, $total_bayar, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('F' . $x, $sisa, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                
                $x++;
            }
        }

        //jumlah
        $sheet->setCellValueExplicit('A' . $x, "JUMLAH", \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->mergeCells("A".$x.":D".$x);
        $sheet->setCellValueExplicit('E' . $x, $total_simpanan_pokok, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
        $sheet->setCellValueExplicit('F' . $x, $total_sisa, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);

        $sheet->getStyle("A".$x.":F".$x)->getFont()->setBold(true);
        $x++;

        //set border
        $batas_akhir = intval($x) - 1;
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ];
        $sheet->getStyle('A4:F' . $batas_akhir)->applyFromArray($styleArray);
        //set align
        $sheet->getStyle('A5:F' . $batas_akhir)->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
        $sheet->getStyle('A5:F' . $batas_akhir)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B5:F' . $batas_akhir)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $writer = new Xlsx($spreadsheet);
        $filename = 'LAPORAN SIMPANAN POKOK ANGGOTA KOPERASI BOGOR GADING RESIDENCE TANGGAL '.date('d-m-Y');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
	}

    public function exportPdf($id)
    {
        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->set_option('isRemoteEnabled', TRUE);
        $this->pdf->set_option('defaultFont', 'arial');
        $this->pdf->set_base_path("/");
        $data = [];
        $data["listData"] = $this->db->get_where("biaya_administrasi", ["id_anggota" => $id])->result();
        $data["anggota"] =  $this->db->get_where("data_anggota",["id_anggota" => $id])->row();
        $this->pdf->filename = "Simpanan Pokok.pdf";
        $html = $this->load->view('admin/pdfSimpananPokok', $data, TRUE);

        $this->pdf->load_html($html);
        $this->pdf->render();

        $output = $this->pdf->output();
        $this->pdf->stream($this->pdf->filename, array("Attachment" => FALSE));
    }
}

?>