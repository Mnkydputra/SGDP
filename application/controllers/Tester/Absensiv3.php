<?php

date_default_timezone_set('Asia/Jakarta');
class Absensiv3 extends CI_Controller
{

    public function index(Type $var = null)
    {
        $npk = 228572;
        $data = [
            'data' => $this->db->get_where("absen_wil3", ['npk' => $npk])->result()
        ];
        $this->load->view("Tester/absensi_v3", $data);
    }
    public function cek(Type $var = null)
    {
        $npk            = 228572;
        $idabsen        = "AGT-228572";
        $today          = date('Y-m-d');
        $waktu          = date('H:i:s');
        $wil            = 'WIL3';
        $kemarin        = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));
        $status_absen   = $this->input->post("opsi");
        // $status_absen   = "IN";
        $area           = 'P3';
        switch ($wil) {
            case 'WIL1':
                $tabel = "absen_wil1";
                $presensiKemarin = $this->db->get_where($tabel, ['npk' => $npk, 'jadwal_masuk' => $kemarin]);
                $presensiSekarang = $this->db->get_where($tabel, ['npk' => $npk, 'jadwal_masuk' => $today]);
                break;
            case 'WIL2':
                $tabel = "absen_wil2";
                $presensiKemarin = $this->db->get_where($tabel, ['npk' => $npk, 'jadwal_masuk' => $kemarin]);
                $presensiSekarang = $this->db->get_where($tabel, ['npk' => $npk, 'jadwal_masuk' => $today]);
                break;
            case 'WIL3':
                $tabel = "absen_wil3";
                $presensiKemarin = $this->db->get_where($tabel, ['npk' => $npk, 'jadwal_masuk' => $kemarin]);
                $presensiSekarang = $this->db->get_where($tabel, ['npk' => $npk, 'jadwal_masuk' => $today]);
                break;
            case 'WIL4':
                $tabel = "absen_wil4";
                $presensiKemarin = $this->db->get_where($tabel, ['npk' => $npk, 'jadwal_masuk' => $kemarin]);
                $presensiSekarang = $this->db->get_where($tabel, ['npk' => $npk, 'jadwal_masuk' => $today]);
                break;
                $tabel  = null;
                break;
        }

        $kmrn = $presensiKemarin->num_rows();
        $skrg = $presensiSekarang->num_rows();
        if ($status_absen == "IN") {
            //cari data absensi hari ini 
            if ($skrg > 0) {
                $this->session->set_flashdata("info", "sudah absen masuk");
                redirect('Tester/Absensiv3');
            } else if ($kmrn > 0) {
                $absen_kemarin =  $presensiKemarin->row();
                $awal  = strtotime($absen_kemarin->in_time . " " . $absen_kemarin->in_date);
                $akhir = strtotime(date('Y-m-d H:i:s'));
                $diff  = $akhir - $awal;
                //jam selisih untuk absen pulang
                $jam_pulang   = floor($diff / (60 * 60));

                if ($absen_kemarin->validasi_kehadiran == 1) {
                    if ($jam_pulang <= 2) {
                        $this->session->set_flashdata("info", "absen masuk di jam berikutnya");
                        redirect('Tester/Absensiv3');
                    } else {
                        if ($absen_kemarin->validasi_kehadiran == 1) {
                            $this->db->where('id', $absen_kemarin->id);
                            $this->db->update(
                                $tabel,
                                [
                                    'validasi_kehadiran'    => 2,
                                    'ket'                   => 'MANGKIR',
                                ]
                            );
                        }
                        $this->db->insert($tabel, [
                            'npk'                   => $npk,
                            'id_absen'              => $idabsen,
                            'in_time'               => date('H:i:s'),
                            'in_date'               => date('Y-m-d'),
                            'jadwal_masuk'          => date('Y-m-d'),
                            'validasi_kehadiran'    => 1,
                            'ket'                   => '',
                            'area'                  => $area
                        ]);
                        $this->session->set_flashdata("info", "absen masuk");
                        redirect('Tester/Absensiv3');
                    }
                } else if ($absen_kemarin->validasi_kehadiran == 2) {
                    $awal  = strtotime($absen_kemarin->out_time . " " . $absen_kemarin->out_date);
                    $akhir = strtotime(date('Y-m-d H:i:s'));
                    $diff  = $akhir - $awal;
                    //jam selisih untuk absen pulang
                    $jam_pulang   = floor($diff / (60 * 60));
                    if ($jam_pulang <= 1) {
                        $this->session->set_flashdata("info", "absen masuk beberapa jam lagi");
                        redirect('Tester/Absensiv3');
                    } else {
                        $this->db->insert($tabel, [
                            'npk'                   => $npk,
                            'id_absen'              => $idabsen,
                            'in_time'               => date('H:i:s'),
                            'in_date'               => date('Y-m-d'),
                            'jadwal_masuk'          => date('Y-m-d'),
                            'validasi_kehadiran'    => 1,
                            'ket'                   => '',
                            'area'                  => $area
                        ]);
                        $this->session->set_flashdata("info", "absen masuk");
                        redirect('Tester/Absensiv3');
                    }
                }
            } else {
                $this->db->insert($tabel, [
                    'npk'                   => $npk,
                    'id_absen'              => $idabsen,
                    'in_time'               => date('H:i:s'),
                    'in_date'               => date('Y-m-d'),
                    'jadwal_masuk'          => date('Y-m-d'),
                    'validasi_kehadiran'    => 1,
                    'ket'                   => '',
                    'area'                  => $area
                ]);
                $this->session->set_flashdata("info", "absen masuk");
                redirect('Tester/Absensiv3');
            }
        } else if ($status_absen == "OUT") {

            if ($skrg > 0) {
                //selisih jam masuk dan jam sekarang kurang dari 2 jam 
                //tidak bisa absen pulang 
                $absen  = $presensiSekarang->row();
                //jika absen masuk kurang dari 2jam maka absen pulang  di tolak 
                $awal  = strtotime($absen->in_time . " " . $absen->in_date);
                $akhir = strtotime(date('Y-m-d H:i:s'));
                $diff  = $akhir - $awal;
                //jam selisih untuk absen pulang
                $jam_pulang   = floor($diff / (60 * 60));
                if ($jam_pulang <= 2) {
                    $this->session->set_flashdata("info", "jam pulang sebentar lagi , tunggu ya");
                    redirect('Tester/Absensiv3');
                } else if ($absen->validasi_kehadiran == 2) {
                    $this->session->set_flashdata("info", "absensi lengkap");
                    redirect('Tester/Absensiv3');
                } else {
                    $this->db->where('id', $absen->id);
                    $this->db->update(
                        $tabel,
                        [
                            'out_time'              => date('H:i:s'),
                            'out_date'              => date('Y-m-d'),
                            'validasi_kehadiran'    => 2,
                            'ket'                   => 'HADIR',
                        ]
                    );
                    $this->session->set_flashdata("info", "absen pulang2");
                    redirect('Tester/Absensiv3');
                }
            } else {
                if ($kmrn > 0) {
                    $absen  = $presensiKemarin->row();
                    if ($absen->validasi_kehadiran == 1) {
                        $this->db->where('id', $absen->id);
                        $this->db->update(
                            $tabel,
                            [
                                'out_time'              => date('H:i:s'),
                                'out_date'              => date('Y-m-d'),
                                'validasi_kehadiran'    => 2,
                                'ket'                   => 'HADIR',
                            ]
                        );
                        $this->session->set_flashdata("info", "absen pulang");
                        redirect('Tester/Absensiv3');
                    } else if ($absen->validasi_kehadiran == 2) {

                        $this->db->insert($tabel, [
                            'npk'                   => $npk,
                            'id_absen'              => $idabsen,
                            'out_time'              => date('H:i:s'),
                            'out_date'              => date('Y-m-d'),
                            'jadwal_masuk'          => date('Y-m-d'),
                            'validasi_kehadiran'    => 2,
                            'ket'                   => 'MANGKIR',
                            'area'                  => $area
                        ]);
                        $this->session->set_flashdata("info", "absen pulang2");
                        redirect('Tester/Absensiv3');
                    }
                }
            }
        }
    }
}


// $this->db->insert("absen_wil3", [
//     'npk'                   => $npk,
//     'id_absen'              => $idabsen,
//     'in_time'               => date('H:i:s'),
//     'in_date'               => date('Y-m-d'),
//     'validasi_kehadiran'    => 1,
//     'ket'                   => '',
//     'area'                  => $area
// ]);
// echo "absen masuk";