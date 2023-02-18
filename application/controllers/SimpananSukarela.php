<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once APPPATH . 'core/Admin_Controller.php';

class SimpananSukarela extends Admin_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function simpanan()
    {
        if($this->data['is_can_read']){
            $anggota = "";
            if($this->session->userdata('hak_akses') == 2){
                $anggota = $this->session->userdata('id_anggota');
            }
    
            $this->data['title'] = "Simpanan Tabungan";
            $data_anggota = $this->koperasiModel->get_data_simpanan_tabungan($anggota)->result();
            if(!empty($data_anggota)){
                foreach ($data_anggota as $key => $value) {
                    $total_pemasukan   = $this->koperasiModel->get_total_simpanan_tabungan($value->id_anggota, "pemasukan");
                    $total_pengeluaran = $this->koperasiModel->get_total_simpanan_tabungan($value->id_anggota, "pengeluaran");
                    $data_anggota[$key]->total = $total_pemasukan-$total_pengeluaran;
                }
            }
            $this->data['jenis'] = $data_anggota;
            $this->load->view('templates_admin/header', $this->data);
            $this->load->view('templates_admin/sidebar', $this->data);
            $this->load->view('admin/simpananSukarela', $this->data);
            $this->load->view('templates_admin/footer');
        }else{
            show_404();
        }
    }

    public function tambahSimpananSukarela()
    {
        if($this->data['is_can_create']){
            $this->data['title'] = "Tambah Simpanan Tabungan";
            $this->load->view('templates_admin/header', $this->data);
            $this->load->view('templates_admin/sidebar', $this->data);
            $this->load->view('admin/formTambahSimpananSukarela', $this->data);
            $this->load->view('templates_admin/footer');
        }else{
            show_404();
        }
    }

    public function Tambah() 
    {
        if($this->data['is_can_create']){
            $data = [
                'id_anggota' => $this->input->post('anggota'),
                'jumlah' => $this->input->post('jumlah'),
                'tanggal' => date("Y/m/d"),
                'jenis_simpanan' => 'pemasukan'
            ];
            $this->db->insert('simpanan_tabungan', $data);
            redirect('SimpananSukarela/simpanan');
        }else{
            show_404();
        }
    }

    public function ambilSimpananSukarela()
    {
        if($this->data['is_can_create']){
            $this->data['title'] = "Ambil Simpanan Tabungan";
            $this->load->view('templates_admin/header', $this->data);
            $this->load->view('templates_admin/sidebar', $this->data);
            $this->load->view('admin/formAmbilSimpananSukarela', $this->data);
            $this->load->view('templates_admin/footer');
        }else{
            show_404();
        }
    }

    public function Kurang() 
    {
        if($this->data['is_can_create']){
            $data = [
                'id_anggota' => $this->input->post('anggota'),
                'jumlah' => $this->input->post('jumlah'),
                'tanggal' => date("Y/m/d"),
                'jenis_simpanan' => 'pengeluaran'
            ];
            $this->db->insert('simpanan_tabungan', $data);
            redirect('SimpananSukarela/simpanan');
        }else{
            show_404();
        }
    }

   public function detailSimpananSukarela()
    {
        if($this->data['is_can_read']){
            $anggota = $this->uri->segment(3);
            $this->data['id_anggota'] = $anggota;
            $this->data['title'] = "Detail Simpanan Tabungan";
            $this->data['anggota'] = $this->koperasiModel->get_data_tabungan_by_anggota($anggota)->result();
            $this->load->view('templates_admin/header', $this->data);
            $this->load->view('templates_admin/sidebar', $this->data);
            $this->load->view('admin/formDetailSimpananSukarela', $this->data);
            $this->load->view('templates_admin/footer');
        }else{
            show_404();
        }
    }

    public function updateData($id)
    {
        if($this->data['is_can_edit']){
            $this->data['title'] = "Update Simpanan Tabungan";
            $tabungan = $this->koperasiModel->get_data_where('simpanan_tabungan', 'id_simpanan_tabungan', $id)->row();
            $this->data['tabungan'] = $tabungan;
            $this->load->view('templates_admin/header', $this->data);
            $this->load->view('templates_admin/sidebar', $this->data);
            $this->load->view('admin/formupdateSimpananSukarela', $this->data);
            $this->load->view('templates_admin/footer');
        }else{
            show_404();
        }
    }

    public function Ubah() 
    {
        if($this->data['is_can_edit']){
            $id_simpanan_tabungan = $this->input->post('id_simpanan_tabungan');
            $id_anggota = $this->input->post('id_anggota');
            $data = [
                'jumlah' => $this->input->post('jumlah'),
                'tanggal' => date("Y/m/d"),
            ];
            $this->db->update('simpanan_tabungan', $data, ['id_simpanan_tabungan' => $id_simpanan_tabungan]);
            redirect('simpananSukarela/detailSimpananSukarela/'.$id_anggota);
        }else{
            show_404();
        }
    }

    public function deleteData($id)
    {
        if($this->data['is_can_delete']){
            $where = array('id_simpanan_tabungan' => $id);
            $data = $this->koperasiModel->get_data_where('simpanan_tabungan', 'id_simpanan_tabungan', $id)->row();
            $this->koperasiModel->delete_data($where, 'simpanan_tabungan');
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data berhasil dihapus!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('simpananSukarela/detailSimpananSukarela/'.$data->id_anggota);
        }else{
            show_404();
        }
    }

    public function exportExcel($tahun)
    {
        if($this->data['is_can_export_excel']){
            $tahun_sebelumnya = $tahun - 1;
            $spreadsheet = new Spreadsheet();
            \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder(new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder());
    
            $sheet = $spreadsheet->getActiveSheet();
    
            //set widht kolom
            $batas = "AO";
            for($i = 'A'; $i <= 'Z'; $i++) {
                $sheet->getColumnDimension($i)->setAutoSize(true);
                if($batas == $i){
                    break;
                }
            }
    
            //set header tingkat 1
            $sheet->setCellValue('A1', "LAPORAN TABUNGAN ANGGOTA KOPERASI BOGOR GADING RESIDENCE");
            $sheet->getStyle("A1")->getFont()->setSize(16)->setBold(true);
            $sheet->mergeCells("A1:H1");
    
            $sheet->setCellValue('A2', "TAHUN ".$tahun);
            $sheet->getStyle("A2")->getFont()->setSize(16)->setBold(true);
            $sheet->mergeCells("A2:H2");
            
            $sheet->setCellValue('A4', 'NO.');
            $sheet->mergeCells("A4:A6");
    
            $sheet->setCellValue('B4', 'NO. ANGGOTA');
            $sheet->mergeCells("B4:B6");
           
            $sheet->setCellValue('C4', 'NAMA ANGGOTA');
            $sheet->mergeCells("C4:C6");
           
            $sheet->setCellValue('D4', 'SALDO TABUNGAN '.$tahun_sebelumnya);
            $sheet->mergeCells("D4:D6");
            
            $sheet->setCellValue('E4', 'BULAN');
            $sheet->mergeCells("E4:AN4");
    
            $sheet->setCellValue('AO4', 'SALDO AKHIR '.$tahun);
            $sheet->mergeCells("AO4:AO6");
            
            $sheet->getStyle("A4:AO6")->getFont()->setBold(true);
            $sheet->getStyle('A4:AO6')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            $sheet->getStyle('A4:AO6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    
            //set bulan
            $bulan = [
                "JANUARI",
                "FEBRUARI",
                "MARET",
                "APRIL",
                "MEI",
                "JUNI",
                "JULI",
                "AGUSTUS",
                "SEPTEMBER", 
                "OKTOBER",
                "NOVEMBER",
                "DESEMBER"
            ];
    
            $batas = "AN";
            $index_bulan = 0;
            for($i = 'E'; $i <= 'Z'; $i++) {
                $batas_awal_bulan = $i;
                $sheet->setCellValue($batas_awal_bulan.'5', $bulan[$index_bulan++]);
                $sheet->setCellValue($batas_awal_bulan.'6', "DEBET");
                $i++;
                $sheet->setCellValue($i.'6', "KREDIT");
                $i++;
                $batas_akhir_bulan = $i;
                $sheet->setCellValue($batas_akhir_bulan.'6', "SALDO");
                
                $sheet->mergeCells($batas_awal_bulan."5:".$batas_akhir_bulan."5");
                if($batas == $i){
                    break;
                }
            }
        
            //list anggota
            $anggota = $this->koperasiModel->get_data_where("data_anggota","hak_akses",2)->result();
    
            //get total simpanan tahun lalu 
            $jumlah_tahun_lalu = 0;
            $data_tahun_lalu = [];
            $tahun_lalu = $this->koperasiModel->get_tabungan_tahun_lalu($tahun);
            if(!empty($tahun_lalu)){
                foreach ($tahun_lalu as $key => $value) {
                    $total = $value->total;
                    if($value->jenis_simpanan == "pengeluaran"){
                        $total = -$value->total;
                    }
    
                    if(!empty($data_tahun_lalu[$value->id_anggota])){
                        $data_tahun_lalu[$value->id_anggota] += $total;
                    }else{
                        $data_tahun_lalu[$value->id_anggota] = $total;
                    }
    
                    $jumlah_tahun_lalu += $total;
                }
            }
    
            //get total simpanan tahun ini
            $jumlah_tahun_ini = 0;
            $data_tahun_ini = [];
            $tahun_ini = $this->koperasiModel->get_tabungan_tahun_ini($tahun);
            if(!empty($tahun_ini)){
                foreach ($tahun_ini as $key => $value) {
                    $total = $value->total;
                    if($value->jenis_simpanan == "pengeluaran"){
                        $total = -$value->total;
                    }
    
                    if(!empty($data_tahun_ini[$value->id_anggota])){
                        $data_tahun_ini[$value->id_anggota] += $total;
                    }else{
                        $data_tahun_ini[$value->id_anggota] = $total;
                    }
    
                    $jumlah_tahun_ini += $total;
                }
            }
    
            //get total simpanan perbulan
            $data_perbulan = [];
            $perbulan = $this->koperasiModel->get_tabungan_perbulan($tahun);
            if(!empty($perbulan)){
                foreach ($perbulan as $key => $value) {
                    $total = $value->total;
                    if($value->jenis_simpanan == "pengeluaran"){
                        $data_perbulan[$value->id_anggota][$value->bulan]["kredit"] = $total;
                    }else{
                        $data_perbulan[$value->id_anggota][$value->bulan]["debit"] = $total;
                    }
                }
            }
            
            //isi data
            $jumlah_perbulan = [];
            $no = 1;
            $x = 7;
            if (!empty($anggota)) {
                foreach ($anggota as $row) {
                    $sheet->setCellValueExplicit('A' . $x, $no++, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    $sheet->setCellValueExplicit('B' . $x, $row->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    $sheet->setCellValueExplicit('C' . $x, $row->nama_anggota, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
    
                    $saldo_tahun_lalu = 0;
                    if(!empty($data_tahun_lalu[$row->id_anggota])){
                        $saldo_tahun_lalu = $data_tahun_lalu[$row->id_anggota];
                    }
                    $sheet->setCellValueExplicit('D' . $x, $saldo_tahun_lalu, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
    
                    $batas = "AN";
                    $index_bulan = 1;
                    for($i = 'E'; $i <= 'Z'; $i++) {
                        $debit  = 0;
                        $kredit = 0;
                        if(!empty($data_perbulan[$row->id_anggota][$index_bulan]["kredit"])){
                            $kredit = $data_perbulan[$row->id_anggota][$index_bulan]["kredit"];
                        }
                        
                        if(!empty($data_perbulan[$row->id_anggota][$index_bulan]["debit"])){
                            $debit = $data_perbulan[$row->id_anggota][$index_bulan]["debit"];
                        }
                        $sheet->setCellValueExplicit($i. $x, $debit, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                        $i++;
                        $sheet->setCellValueExplicit($i. $x, $kredit, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                        $i++;
                        $sheet->setCellValueExplicit($i. $x, $debit-$kredit, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
    
                        //jumlah perbulan 
                        if(!empty($jumlah_perbulan[$i]["kredit"])){
                            $jumlah_perbulan[$index_bulan]["kredit"] += $kredit;
                        }else{
                            $jumlah_perbulan[$index_bulan]["kredit"] = $kredit;
                        }
    
                        if(!empty($jumlah_perbulan[$index_bulan]["debit"])){
                            $jumlah_perbulan[$index_bulan]["debit"] += $debit;
                        }else{
                            $jumlah_perbulan[$index_bulan]["debit"] = $debit;
                        }
    
                        $index_bulan++;
                        if($batas == $i){
                            break;
                        }
                    }
    
                    $saldo_tahun_ini = 0;
                    if(!empty($data_tahun_ini[$row->id_anggota])){
                        $saldo_tahun_ini = $data_tahun_ini[$row->id_anggota];
                    }
                    $sheet->setCellValueExplicit('AO' . $x, $saldo_tahun_ini, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
    
                    // $sheet->getStyle('D' . $x)->getAlignment()->setWrapText(true);
                    $x++;
                }
            }
    
            //jumlah
            $sheet->setCellValueExplicit('C' . $x, "JUMLAH", \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('D' . $x, $jumlah_tahun_lalu, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
    
            $batas = "AN";
            $index_bulan = 1;
            for($i = 'E'; $i <= 'Z'; $i++) {
                $total = $jumlah_perbulan[$index_bulan]["debit"] - $jumlah_perbulan[$index_bulan]["kredit"];
                $sheet->setCellValueExplicit($i. $x, $jumlah_perbulan[$index_bulan]["debit"], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $i++;
                $sheet->setCellValueExplicit($i. $x, $jumlah_perbulan[$index_bulan]["kredit"], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $i++;
                $sheet->setCellValueExplicit($i. $x, $total, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
    
                $index_bulan++;
                if($batas == $i){
                    break;
                }
            }
            $sheet->setCellValueExplicit('AO' . $x, $jumlah_tahun_ini, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
            $sheet->getStyle("C".$x.":AO".$x)->getFont()->setBold(true);
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
            $sheet->getStyle('A4:AO' . $batas_akhir)->applyFromArray($styleArray);
            //set align
            $sheet->getStyle('A7:AO' . $batas_akhir)->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
            $sheet->getStyle('A7:AO' . $batas_akhir)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B7:AO' . $batas_akhir)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    
            $writer = new Xlsx($spreadsheet);
            $filename = 'LAPORAN TABUNGAN ANGGOTA KOPERASI BOGOR GADING RESIDENCE TAHUN ' .$tahun;
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
        }else{
            show_404();
        }
	}

    public function exportPdf($id)
    {
        if($this->data['is_can_export_pdf']){
            $this->load->library('pdf');
    
            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->set_option('isRemoteEnabled', TRUE);
            $this->pdf->set_option('defaultFont', 'arial');
            $this->pdf->set_base_path("/");
            $data = [];
            $data["listData"] = $this->db->order_by('id_simpanan_tabungan', 'ASC')->get_where("simpanan_tabungan", ["id_anggota" => $id])->result();
            $data["anggota"] =  $this->db->get_where("data_anggota",["id_anggota" => $id])->row();
            $this->pdf->filename = "Simpanan Tabungan ".$data["anggota"]->nama_anggota." ".date("dmY").".pdf";
            $html = $this->load->view('admin/pdfSimpananTabungan', $data, TRUE);
    
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