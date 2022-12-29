<?php

class KoperasiModel extends CI_model{

    public function get_data($table){
        return $this->db->get($table);
    }

    public function get_data_where($table, $field, $value){
        if($field && $value !=''){
            return $this->db->where($field, $value)->get($table);    
        }

        return $this->db->get($table);
    }

    public function insert_data($data, $table){
        $this->db->insert($table, $data);
    }

    public function update_data($table, $data, $where){
        $this->db->update($table, $data, $where);
    }

    public function delete_data($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }

    // public function insert_batch($table = null, $data = array())
    // {
    //     $jumlah = count($data);
    //     if($jumlah > 0)
    //     {
    //         $this->db->insert_batch($table, $data);
    //     }
    // }

    public function cek_login()
    {
        $username   = set_value('username');
        $password   = set_value('password');

        $result     = $this->db->where('username', $username)
                               ->where('password',md5($password))
                               ->limit(1)
                               ->get('data_anggota');
        if($result->num_rows()>0){
            return $result->row();
        }else{
            return FALSE;
        }
    }

    public function get_data_by_jenis($jenis){
        $this->db->select('*');
        $this->db->from('data_simpanan');
        $this->db->join('data_anggota','data_simpanan.id_anggota = data_anggota.id_anggota', 'INNER');
        $this->db->where('data_simpanan.jenis_simpanan', $jenis);
        $this->db->group_by('data_simpanan.id_anggota');
        return $this->db->get();
    }

    public function get_data_by_anggota($jenis,$anggota){
        $this->db->select('*');
        $this->db->from('biaya_administrasi');
        $this->db->join('data_anggota','biaya_administrasi.id_anggota = data_anggota.id_anggota', 'INNER');
        $this->db->where('biaya_administrasi.id_anggota', $anggota);
        $this->db->where('biaya_administrasi.status',1);
        return $this->db->get();
    }

    public function getDataSimpanan($id_simpanan){
        return $this->db->get_where('biaya_administrasi',['id_biaya_administrasi'=>$id_simpanan])->row();
    }

    public function getDataSimpananWajib($id_simpanan){
        return $this->db->get_where('simpanan_wajib',['id_simpanan_wajib'=>$id_simpanan])->row();
    }

    public function get_data_count($table, $field, $where = []){
        $this->db->select('SUM('.$field.') as total');
        $this->db->from($table);
        $this->db->where($where);

        return $this->db->get();
    }

    public function get_data_pinjaman(){
        $this->db->select('data_pinjaman.*, data_anggota.nama_anggota');
        $this->db->from('data_pinjaman');
        $this->db->join('data_anggota','data_pinjaman.id_anggota = data_anggota.id_anggota', 'INNER');
        return $this->db->get();
    }

    public function get_data_biaya_administrasi()
    {
        $this->db->select('data_anggota.*, SUM(biaya_administrasi.jumlah) as total');
        $this->db->from('data_anggota');
        $this->db->join('biaya_administrasi','biaya_administrasi.id_anggota = data_anggota.id_anggota', 'LEFT');
        $this->db->group_by('data_anggota.id_anggota');
        return $this->db->get();
    }
    
    public function get_data_administrasi_by_anggota($anggota){
        $this->db->select('*');
        $this->db->from('biaya_administrasi');
        $this->db->join('data_anggota','biaya_administrasi.id_anggota = data_anggota.id_anggota', 'INNER');
        $this->db->where('biaya_administrasi.id_anggota', $anggota);
        $this->db->where('biaya_administrasi.status',1);
        return $this->db->get();
    }

    public function get_data_simpanan_wajib()
    {
        $this->db->select('data_anggota.*, SUM(simpanan_wajib.jumlah) as total');
        $this->db->from('data_anggota');
        $this->db->join('simpanan_wajib','simpanan_wajib.id_anggota = data_anggota.id_anggota', 'LEFT');
        $this->db->group_by('data_anggota.id_anggota');
        return $this->db->get();
    }
    
    public function get_data_wajib_by_anggota($anggota){
        $this->db->select('*');
        $this->db->from('simpanan_wajib');
        $this->db->join('data_anggota','simpanan_wajib.id_anggota = data_anggota.id_anggota', 'INNER');
        $this->db->where('simpanan_wajib.id_anggota', $anggota);
        $this->db->where('simpanan_wajib.status',1);
        return $this->db->get();
    }

    public function get_data_simpanan_tabungan()
    {
        $this->db->select('data_anggota.*');
        $this->db->from('data_anggota');
        $this->db->group_by('data_anggota.id_anggota');
        return $this->db->get();
    }

    public function get_total_simpanan_tabungan($anggota, $jenis)
    {
        $this->db->select('SUM(simpanan_tabungan.jumlah) as total');
        $this->db->from('simpanan_tabungan');
        $this->db->where('simpanan_tabungan.id_anggota', $anggota);
        $this->db->where('simpanan_tabungan.jenis_simpanan', $jenis);
        return $this->db->get()->row()->total;
    }

    public function get_data_tabungan_by_anggota($anggota){
        $this->db->select('*');
        $this->db->from('simpanan_tabungan');
        $this->db->join('data_anggota','simpanan_tabungan.id_anggota = data_anggota.id_anggota', 'INNER');
        $this->db->where('simpanan_tabungan.id_anggota', $anggota);
        return $this->db->get();
    }

    public function get_total_data_pinjaman($anggota)
    {
        $this->db->select('COUNT(data_pinjaman.id) as total');
        $this->db->from('data_pinjaman');
        $this->db->where('data_pinjaman.id_anggota', $anggota);
        return $this->db->get()->row()->total;
    }
}

?>