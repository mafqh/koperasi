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
}

?>