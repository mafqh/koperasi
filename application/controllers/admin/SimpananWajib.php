<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SimpananWajib extends CI_Controller{

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
        
        $data['title'] = "Simpanan Wajib";
        $data['jenis'] = $this->koperasiModel->get_data_simpanan_wajib($anggota)->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/simpananWajib', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahSimpananWajib()
    {
        if($this->session->userdata('hak_akses') == 1){
            $data['title'] = "Tambah Simpanan Wajib";
            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/formTambahSimpananWajib', $data);
            $this->load->view('templates_admin/footer');
        }else{
            redirect('admin/dashboard');
        }
    }

    public function Tambah() {
        if($this->session->userdata('hak_akses') == 1){
            $data = [];
            
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
            $this->db->insert('simpanan_wajib', $data);
            redirect('admin/SimpananWajib/simpanan/' .$this->input->post('anggota'));
        }else{
            redirect('admin/dashboard');
        }
    }

    public function detailSimpananWajib()
    {
        $anggota = $this->uri->segment(4);
        $data['title'] = "Detail Simpanan Wajib";
        $data['anggota'] = $this->koperasiModel->get_data_wajib_by_anggota($anggota)->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formDetailSimpananWajib', $data);
        $this->load->view('templates_admin/footer');
    }

    public function editSimpananWajib() 
    {
        if($this->session->userdata('hak_akses') == 1){
            $id_simpanan = $this->uri->segment(4);
            $data['simpanan'] = $this->koperasiModel->getDataSimpananWajib($id_simpanan);
            $data['title'] = "Edit Simpanan Wajib";
            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/formEditSimpananWajib', $data);
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
            $this->db->where('id_simpanan_wajib', $id);
            $this->db->update('simpanan_wajib');
            redirect('admin/SimpananWajib/detailSimpananWajib/'.$id_anggota);
        }else{
            redirect('admin/dashboard');
        }
    }

    public function deleteData($id, $id_anggota)
    {
        if($this->session->userdata('hak_akses') == 1){
            $this->db->where('id_simpanan_wajib', $id);
            $this->db->delete('simpanan_wajib');
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data berhasil dihapus!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('admin/simpananWajib/detailSimpananWajib/'.$id_anggota);
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
        $sheet->setCellValue('A1', "LAPORAN SIMPANAN WAJIB ANGGOTA KOPERASI BOGOR GADING RESIDENCE");
        $sheet->getStyle("A1")->getFont()->setSize(16)->setBold(true);
        $sheet->mergeCells("A1:H1");
        
        $sheet->setCellValue('A4', 'NO.');
        $sheet->setCellValue('B4', 'NO. ANGGOTA');
        $sheet->setCellValue('C4', 'NAMA ANGGOTA');
        $sheet->setCellValue('D4', 'STATUS');
        $sheet->setCellValue('E4', 'JUMLAH SIMPANAN WAJIB');
        $sheet->setCellValue('F4', 'SISA YANG HARUS DIBAYAR');
        
        $sheet->getStyle("A4:F4")->getFont()->setBold(true);
        $sheet->getStyle('A4:F4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A4:F4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $datas = $this->koperasiModel->get_all_data_simpanan_wajib(); 
        //isi data
        $total_simpanan_pokok = 0;
        $total_sisa = 0;
        $no = 1;
        $x = 5;
        if (!empty($datas)) {
            foreach ($datas as $row) {
                $jumlah_simpanan_wajib = 240000;
                $simpanan_wajib = $row->total;
                $sisa = $jumlah_simpanan_wajib - $simpanan_wajib;

                $total_simpanan_pokok += $simpanan_wajib;
                $total_sisa += $sisa;

                $status = "Lunas";
                if($sisa > 0){
                    $status = "Belum Lunas";
                }

                $sheet->setCellValueExplicit('A' . $x, $no++, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('B' . $x, $row->id_anggota, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('C' . $x, $row->nama_anggota, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('D' . $x, $status, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('E' . $x, $simpanan_wajib, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
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
        $filename = 'LAPORAN SIMPANAN WAJIB ANGGOTA KOPERASI BOGOR GADING RESIDENCE TANGGAL '.date('d-m-Y');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
	}
}

?>