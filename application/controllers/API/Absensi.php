<?php
require APPPATH . 'libraries\RestController.php';

use chriskacerguis\RestServer\RestController;

date_default_timezone_set('Asia/Jakarta');

class Absensi extends RestController
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function cekBarcodeKorlap_get()
    {
        # code...
        $wil = $this->get("wilayah");
        $lat = $this->get("latitude");
        $d = $this->db->get_where("barcode_absensi", ['wilayah' => $wil, 'latitude' => $lat]);
        if ($d->num_rows() > 0) {
            $this->response([
                'status'  => false,
                'message' => 1
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 0
            ], 404);
        }
    }

    public function cekBarcodeAnggota_get()
    {
        $area = $this->get("area_kerja");
        $lat = $this->get("latitude");
        $d = $this->db->get_where("barcode_absensi", ['area_kerja' => $area, 'latitude' => $lat]);
        if ($d->num_rows() > 0) {
            $this->response([
                'status'  => false,
                'message' => 1
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 0
            ], 404);
        }
    }



    //input data absensi ke dalam databasen
    public function inputAbsensi_post(Type $var = null)
    {
        $npk        = $this->post("npk");
        $wil        = $this->post("wilayah");
        $area       = $this->post("area_kerja");
        $id_absen   = $this->post("id_absen");
        $now        = date('Y-m-d'); //ambil tanggal sekarang


        //tanggal kemarin
        $tgl_kemarin    = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));
        //cek wilayah untuk  penentuan dimana anggota harus di simpan data absennya
        switch ($wil) {
            case 'WIL1':
                $tabel = "absen_wil1";
                break;
            case 'WIL2':
                $tabel = "absen_wil2";
                break;
            case 'WIL3':
                $tabel = "absen_wil3";
                break;
            case 'WIL4':
                $tabel = "absen_wil4";
                break;
            default:
                break;
        }

        $presensiKemarin = $this->Anggota_model->absenKemarin($npk, $tgl_kemarin, $wil);
        $presensiSekarang = $this->Anggota_model->absenKemarin($npk, $now, $wil);

        if ($presensiSekarang->num_rows() > 0) {
            $absen = $presensiSekarang->row();
            if ($absen->validasi_kehadiran == 1 && $absen->ket == NULL) {
                $awal  = strtotime($absen->in_time . " " . $absen->in_date);
                $akhir = strtotime(date('Y-m-d H:i:s'));
                $diff  = $akhir - $awal;
                //jam selisih untuk absen pulang
                $jam   = floor($diff / (60 * 60));
                if ($jam < 5) {
                    $this->response([
                        'status'    => 'attention',
                        'message'   =>  "Silahkan Absen di Jam Berikutnya"
                    ], 404);
                    // echo "anda bisa absen lagi 5 jam dari sekarang";
                } else {
                    //absen pulang
                    $data = [
                        'out_time'              => date('H:i:s'),
                        'out_date'              => date('Y-m-d'),
                        'validasi_kehadiran'    => 2,
                        'ket'                   => "HADIR"
                    ];
                    $this->db->where('id', $absen->id);
                    $this->db->update($tabel, $data);
                    $this->response([
                        'status'   => 'success',
                        'message' =>  "Absen Pulang Berhasil"
                    ], 200);
                    // echo "anda absen pulang bos";
                }
            } else if ($absen->validasi_kehadiran == 2) {
                $awal  = strtotime($absen->out_time . " " . $absen->out_date);
                $akhir = strtotime(date('Y-m-d H:i:s'));
                $diff  = $akhir - $awal;

                //jam selisih untuk absen pulang
                $jam   = floor($diff / (60 * 60));

                //jika kurang dari 6jam maka tidak bisa absen pulang
                if ($jam < 6) {
                    $this->response([
                        'status'   => 'attention',
                        'message' =>  "Silahkan Absen di Jam Berikutnya"
                    ], 200);
                    // echo "anda bisa absen lagi  6 jam dari sekarang";
                } else if ($jam > 6 || $jam <= 18) {
                    $data = [
                        'id_absen' => $id_absen,
                        'npk'       => $npk,
                        'in_time'   => date('H:i:s'),
                        'in_date'   => date('Y-m-d'),
                        'area'      => $area,
                        'validasi_kehadiran' =>  1,
                        'ket'     => NULL
                    ];
                    $this->db->insert($tabel, $data);
                    $this->response([
                        'status'   => 'success',
                        'message' =>  "Absen Masuk Berhasil"
                    ], 200);
                    // echo "anda bisa absen masuk lagi";
                }
            }
        } else {
            if ($presensiKemarin->num_rows() <= 0) {
                $data = [
                    'id_absen' => $id_absen,
                    'npk'       => $npk,
                    'in_time'   => date('H:i:s'),
                    'in_date'   => date('Y-m-d'),
                    'area'      => $area,
                    'validasi_kehadiran' =>  1
                ];
                $this->db->insert($tabel, $data);
                $this->response([
                    'status'   => 'success',
                    'message' =>  "Absen Masuk Berhasil"
                ], 200);
                // echo "input absen baru disini";
            } else if ($presensiKemarin->num_rows() > 0) {
                $absen = $presensiKemarin->row();
                if ($absen->validasi_kehadiran == 1 && $absen->ket == NULL) {

                    //hitung count jam dari jam masuk sampai jam sekarang
                    $awal  = strtotime($absen->in_time . " " . $absen->in_date);
                    $akhir = strtotime(date('Y-m-d H:i:s'));
                    $diff  = $akhir - $awal;

                    //jam selisih untuk absen pulang
                    $jam   = floor($diff / (60 * 60));

                    //jika jam kurang dari 6jam maka absen pulang di tolak
                    if ($jam < 6) {
                        $this->response([
                            'status'   => 'attention',
                            'message' =>  "Silahkan Absen di Jam Berikutnya"
                        ], 200);
                        // echo "anda belum bisa absen pulang coy";
                    } else if ($jam > 6 || $jam <= 18) {
                        //absen pulang
                        $data = [
                            'out_time'           => date('H:i:s'),
                            'out_date'           => date('Y-m-d'),
                            'validasi_kehadiran' => 2,
                            'ket'                => "HADIR"
                        ];
                        $this->db->where('id', $absen->id);
                        $this->db->update($tabel, $data);
                        $this->response([
                            'status'   => 'success',
                            'message' =>  "Absen Pulang Berhasil"
                        ], 200);
                        // echo "anda bisa absen pulang";
                    }
                } else if ($absen->validasi_kehadiran == 2) {
                    $awal  = strtotime($absen->out_time . " " . $absen->out_date);
                    $akhir = strtotime(date('Y-m-d H:i:s'));
                    $diff  = $akhir - $awal;

                    //jam selisih untuk absen pulang
                    $jam   = floor($diff / (60 * 60));

                    //jika jam kurang dari 6jam maka absen masuk di tanggal sama  di tolak
                    if ($jam < 2) {
                        $this->response([
                            'status'   => 'attention',
                            'message' =>  "Silahkan Absen di Jam Berikutnya"
                        ], 404);
                        // echo "anda belum bisa absen masuk lagi";
                    } else if ($jam > 6 || $jam <= 18) {
                        $data = [
                            'id_absen'  => $id_absen,
                            'npk'       => $npk,
                            'in_time'   => date('H:i:s'),
                            'in_date'   => date('Y-m-d'),
                            'area'      => $area,
                            'validasi_kehadiran' =>  1,
                            'ket'     => NULL
                        ];
                        $this->db->insert($tabel, $data);
                        $this->response([
                            'status'   => 'success',
                            'message' =>  "Absen Masuk Berhasil"
                        ], 404);
                        // echo "anda bisa absen masuk lagi di tanggal yang sama ";
                    }
                }
            }
        }
    }




    public function showAbsensi_get()
    {
        $this->response([
            'data'   => '',
        ], 404);
    }
}
