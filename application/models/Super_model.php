<?php


class Super_model extends CI_Model
{

    public function getDaftarAnggota($where)
    {
        $query = $this->db->query('SELECT nama ,  biodata.npk , employee.wilayah   FROM biodata JOIN  employee ON  biodata.npk = employee.npk where nama like "%' . $where . '%" ');
        return $query->result_array();
    }

    public function getWilayahAnggota($npk)
    {
        $query = $this->db->query('SELECT employee.id_employee , employee.wilayah , employee.area_kerja   FROM biodata JOIN  employee ON  biodata.npk = employee.npk where employee.npk = "' . $npk . '" ');
        return $query->result();
    }

    //ambil data absensi anggota berdasarkan tanggal bulan dan npk
    public function getPresensi($npk, $bulan, $tabel)
    {
        $query = $this->db->query('SELECT * FROM ' . $tabel . ' WHERE npk = "' . $npk . '" AND in_date LIKE "%' . $bulan . '%"  ');
        return $query;
    }

    //update data presensi 
    public function updateAbsensi($where, $tabel, $data)
    {
        $this->db->where($where);
        $this->db->update($tabel, $data);
        return $this->db->affected_rows();
    }


    //hitung patroli tanggal kemarin 
    public function countPatroli($area, $tgl)
    {
        $query = $this->db->query('SELECT COUNT(`count`) AS total  FROM count_patroli WHERE area = "' . $area . '" AND tanggal = "' . $tgl . '" ');
        return $query->row();
    }


    //input presensi 
    public function input($tabel, $data)
    {
        $this->db->insert($tabel, $data);
        return $this->db->affected_rows();
    }
}
