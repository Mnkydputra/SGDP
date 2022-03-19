<?php

class Dashboard extends CI_Controller
{
    public function index(Type $var = null)
    {
        $data = [
            'usia'  => $this->db->query("SELECT
            CASE
            WHEN umur < 17 THEN '< 17 '
                WHEN umur BETWEEN 18 AND 20 THEN '18 - 20'
                WHEN umur BETWEEN 21 AND 25 THEN '21 - 25'
                WHEN umur BETWEEN 26 AND 30 THEN '26 - 30'
                WHEN umur BETWEEN 31 AND 40 THEN '31 - 40'
                WHEN umur BETWEEN 41 AND 50 THEN '41 - 50'
                WHEN umur BETWEEN 51 AND 60 THEN '51 - 60'
            END AS range_umur,
            COUNT(*) AS jumlah
        
        FROM (SELECT npk, nama, tanggal_lahir, TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) AS umur FROM biodata)  AS dummy_table
        GROUP BY range_umur
        ORDER BY range_umur;")
        ];
        $this->load->view("Tester/dashboard", $data);
    }
}
