<?php


class Presensi extends CI_Controller
{

    public function index(Type $var = null)
    {
        $this->load->view("superadmin/cari_absen");
    }



    //form absensi manual 
    public function absen_manual()
    {
        $this->load->view("superadmin/form_absen_manual");
    }

    //input absensi manual
    public function input_absensi_manual()
    {
        $in = $this->input->post("in");
        $id = $this->input->post("id_absen");
        $wilayah  = $this->input->post("wilayah");
        $area  = $this->input->post("area");
        $npk  = $this->input->post("npk");
        $data = explode(" ", $in,  2);
        $tgl_masuk = $data[0];
        $jam_masuk = $data[1];
        switch ($wilayah) {
            case 'WIL 1':
                $tabel = "absen_wil1";
                $d = $this->db->get_where($tabel, ['npk' => $npk, 'in_date' => $tgl_masuk]);
                break;
            case 'WIL 2':
                $tabel = "absen_wil2";
                $d = $this->db->get_where($tabel, ['npk' => $npk, 'in_date' => $tgl_masuk]);
                break;
            case 'WIL 3':
                $tabel = "absen_wil3";
                $d = $this->db->get_where($tabel, ['npk' => $npk, 'in_date' => $tgl_masuk]);
                break;
            case 'WIL 4':
                $tabel = "absen_wil4";
                $d = $this->db->get_where($tabel, ['npk' => $npk, 'in_date' => $tgl_masuk]);
                break;
            default:
                $tabel = "not found";
                break;
        }

        if ($d->num_rows() > 0) {
            echo "presensi masuk jam sekarang sudah ada";
        } else {
            $data = [
                'id_absen'  => $id,
                'npk'       => $npk,
                'in_time'  => $jam_masuk,
                'in_date' => $tgl_masuk,
                'area'          => $area,
                'validasi_kehadiran' => 1
            ];
            $input = $this->Super_model->input($tabel, $data);
            if ($input > 0) {
                $this->session->set_flashdata("ok", "Presensi " . $npk .  " di Input");
                redirect('Superadmin/Presensi/absen_manual');
            } else {
                $this->session->set_flashdata("fail", "Presensi " . $npk .  " gagal di Input");
                redirect('Superadmin/Presensi/absen_manual');
            }
        }
    }


    //ambil data anggota untuk di tampilkan di select 
    public function listAnggota()
    {
        $nama = $this->input->get("nama");
        $list = $this->Super_model->getDaftarAnggota($nama);
        echo json_encode($list);
    }

    //ambil data wilayah anggota
    public function listWilayahAnggota()
    {

        $npk = $this->input->post("npk");
        $list = $this->Super_model->getWilayahAnggota($npk);
        echo json_encode($list);
    }

    public function showAbsensi(Type $var = null)
    {
        $tahun = date('Y');
        $bulan = $this->input->post("bulan");
        $npk = $this->input->post("npk");
        $wilayah = $this->input->post("wilayah");
        $area = $this->input->post("area");
        $tabel = "";
        switch ($wilayah) {
            case 'WIL 1':
                $tabel = "absen_wil1";
                $d = $this->Super_model->getPresensi($npk, $tahun . "-" . $bulan, "absen_wil1");
                break;
            case 'WIL 2':
                $tabel = "absen_wil2";
                $d = $this->Super_model->getPresensi($npk, $tahun . "-" . $bulan, "absen_wil2");
                break;
            case 'WIL 3':
                $tabel = "absen_wil3";
                $d = $this->Super_model->getPresensi($npk, $tahun . "-" . $bulan, "absen_wil3");
                break;
            case 'WIL 4':
                $tabel = "absen_wil4";
                $d = $this->Super_model->getPresensi($npk, $tahun . "-" . $bulan, "absen_wil4");
                break;
            default:
                $tabel = "not found";
                break;
        }
        $data = [
            'npk' => $npk,
            'tabel' => $tabel,
            'bulan' => $bulan
        ];
        $this->load->view("Superadmin/daftar_absen", $data);
    }

    public function form_edit($id, $tabel)
    {
        // $id = $this->input->get("id");
        // $tabel = $this->input->get("table");
        $data = [
            'data' => $this->db->get_where($tabel, ['id' => $id])->row(),
            'tabel'  => $tabel
        ];
        $this->load->view("Superadmin/form_editabsen", $data);
    }

    //update data absensi 
    public function update_absensi()
    {
        $in = $this->input->post("in");
        $out = $this->input->post("out");

        $masuk = explode(" ", $in, 2);
        $pulang = explode(" ", $out, 2);
        $in_date = $masuk[0];
        $in_time = $masuk[1];
        $out_date = $pulang[0];
        $out_time = $pulang[1];

        $tabel = $this->input->post("tabel");
        $id = $this->input->post("id");
        $keterangan = $this->input->post("ket");
        $where = ['id' => $id];
        $data = [
            'in_time' => $in_time,
            'in_date'  => $in_date,
            'out_time' => $out_time,
            'out_date'  => $out_date,
            'ket'  => $keterangan
        ];

        $update = $this->Super_model->updateAbsensi($where, $tabel, $data);
        if ($update > 0) {
            $this->session->set_flashdata('ok', 'Presensi di Ubah');
            redirect('Superadmin/Presensi');
        } else {
            $this->session->set_flashdata('fail', 'Presensi gagal di Ubah');
            redirect('Superadmin/Presensi');
        }
    }
}
