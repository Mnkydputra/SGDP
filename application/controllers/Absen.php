<?php

class Absen extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('user_agent');
    date_default_timezone_set('Asia/Jakarta');
    $id = $this->session->userdata('id_akun');
    $role_id = $this->session->userdata('role_id');
    if ($id == null || $id == "") {
      $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
      redirect('Login');
    }
  }

  function index()
  {
    $data = array(
      'biodata'   => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
      'url'       => $this->uri->segment(2),
      'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
      'employe'   => $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row(),
    );
    $this->load->view('mobile/header', $data);
    $this->load->view('absensi', $data);
    $this->load->view('mobile/fotter');
  }

  function getPlan()
  {
    $id = $this->input->post("AreaKerja");
    $data = $this->db->get_where('barcode_absensi', ['id_barcode' => $id])->result();
    echo json_encode($data);
  }
  function getlatitude()
  {
    $wil = $this->input->post("latitude");
    $data = $this->db->get_where('barcode_absensi', ['latitude' => $wil])->result();
    echo json_encode($data);
  }

  function input($id)
  {
    $cek_id = $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row();
    $id_absen = $cek_id->id_employee;
    $where = array(
      'id_absen'  => $id_absen,
      'validasi_kehadiran' => 1
    );
    $npk = $cek_id->npk;
    $validasi = 1;
    $tgl = date('Y-m-d');
    $jam = date('H:i:s');
    $wilayah = $cek_id->wilayah;
    $area    = $cek_id->area_kerja;
    switch ($wilayah) {
      case 'WIL1':
        $cek_kehadiran = $this->Anggota_model->cek_wil1($id_absen, $tgl);
        if ($cek_kehadiran == null) {
          $data = array(
            'id_absen' => $id_absen,
            'npk'      => $npk,
            'area'     => $area,
            'in_time'  => $jam,
            'in_date'  => $tgl,
            'validasi_kehadiran' => $validasi,
          );
          $info = $this->Anggota_model->input($data, "absen_wil1");
          if ($info) {
            echo 'AbsenMasuk';
          }
        } elseif ($cek_kehadiran->validasi_kehadiran == 1) {
          $validasi2 = $cek_kehadiran->in_time;
          $jam2 = date('H:i:s', strtotime('+5 hours', strtotime($validasi2)));
          if ($jam < $jam2) {
            echo 'AndaTelahAbsen';
          } else {
            $data1 = array(
              'out_time'  => $jam,
              'out_date'  => $tgl,
              'validasi_kehadiran' => 2,
            );
            $UpdateInfo = $this->Anggota_model->updateFile($data1, "absen_wil1", $where);
            if ($UpdateInfo) {
              echo 'AbsenPulang';
            }
          }
        } else {
          if ($cek_kehadiran->out_date == $tgl) {
            $jamOut = $cek_kehadiran->out_time;
            $jamOutLebih = date('H:i:s', strtotime('+6 hours', strtotime($jamOut)));
            if ($jam < $jamOutLebih) {
              echo 'AndaTelahMasuk';
            } else {
              $data = array(
                'id_absen' => $id_absen,
                'npk'      => $npk,
                'area'     => $area,
                'in_time'  => $jam,
                'in_date'  => $tgl,
                'validasi_kehadiran' => $validasi,
              );
              $info = $this->Anggota_model->input($data, "absen_wil1");
              if ($info) {
                echo 'AbsenMasuk';
              }
            }
          }
        }
        break;
      case 'WIL2':
        $cek_kehadiran = $this->Anggota_model->cek_wil2($id_absen, $tgl);
        if ($cek_kehadiran == null) {
          $data = array(
            'id_absen' => $id_absen,
            'npk'      => $npk,
            'area'     => $area,
            'in_time'  => $jam,
            'in_date'  => $tgl,
            'validasi_kehadiran' => $validasi,
          );
          $info = $this->Anggota_model->input($data, "absen_wil2");
          if ($info) {
            echo 'AbsenMasuk';
          }
        } elseif ($cek_kehadiran->validasi_kehadiran == 1) {
          $validasi2 = $cek_kehadiran->in_time;
          $jam2 = date('H:i:s', strtotime('+5 hours', strtotime($validasi2)));
          if ($jam < $jam2) {
            echo 'AndaTelahAbsen';
          } else {
            $data1 = array(
              'out_time'  => $jam,
              'out_date'  => $tgl,
              'validasi_kehadiran' => 2,
            );
            $UpdateInfo = $this->Anggota_model->updateFile($data1, "absen_wil2", $where);
            if ($UpdateInfo) {
              echo 'AbsenPulang';
            }
          }
        } else {
          if ($cek_kehadiran->out_date == $tgl) {
            $jamOut = $cek_kehadiran->out_time;
            $jamOutLebih = date('H:i:s', strtotime('+6 hours', strtotime($jamOut)));
            if ($jam < $jamOutLebih) {
              echo 'AndaTelahMasuk';
            } else {
              $data = array(
                'id_absen' => $id_absen,
                'npk'      => $npk,
                'area'     => $area,
                'in_time'  => $jam,
                'in_date'  => $tgl,
                'validasi_kehadiran' => $validasi,
              );
              $info = $this->Anggota_model->input($data, "absen_wil2");
              if ($info) {
                echo 'AbsenMasuk';
              }
            }
          }
        }
        break;
      case 'WIL3':
        $cek_kehadiran = $this->Anggota_model->cek_wil3($id_absen, $tgl);
        if ($cek_kehadiran == null) {
          $data = array(
            'id_absen' => $id_absen,
            'npk'      => $npk,
            'area'     => $area,
            'in_time'  => $jam,
            'in_date'  => $tgl,
            'validasi_kehadiran' => $validasi,
          );
          $info = $this->Anggota_model->input($data, "absen_wil3");
          if ($info) {
            echo 'AbsenMasuk';
          }
        } elseif ($cek_kehadiran->validasi_kehadiran == 1) {
          $validasi2 = $cek_kehadiran->in_time;
          $jam2 = date('H:i:s', strtotime('+5 hours', strtotime($validasi2)));
          if ($jam < $jam2) {
            echo 'AndaTelahAbsen';
          } else {
            $data1 = array(
              'out_time'  => $jam,
              'out_date'  => $tgl,
              'validasi_kehadiran' => 2,
            );
            $UpdateInfo = $this->Anggota_model->updateFile($data1, "absen_wil3", $where);
            if ($UpdateInfo) {
              echo 'AbsenPulang';
            }
          }
        } else {
          if ($cek_kehadiran->out_date == $tgl) {
            $jamOut = $cek_kehadiran->out_time;
            $jamOutLebih = date('H:i:s', strtotime('+6 hours', strtotime($jamOut)));
            if ($jam < $jamOutLebih) {
              echo 'AndaTelahMasuk';
            } else {
              $data = array(
                'id_absen' => $id_absen,
                'npk'      => $npk,
                'area'     => $area,
                'in_time'  => $jam,
                'in_date'  => $tgl,
                'validasi_kehadiran' => $validasi,
              );
              $info = $this->Anggota_model->input($data, "absen_wil3");
              if ($info) {
                echo 'AbsenMasuk';
              }
            }
          }
        }
        break;
      case 'WIL4':
        $cek_kehadiran = $this->Anggota_model->cek_wil4($id_absen, $tgl);
        if ($cek_kehadiran == null) {
          $data = array(
            'id_absen' => $id_absen,
            'npk'      => $npk,
            'area'     => $area,
            'in_time'  => $jam,
            'in_date'  => $tgl,
            'validasi_kehadiran' => $validasi,
          );
          $info = $this->Anggota_model->input($data, "absen_wil4");
          if ($info) {
            echo 'AbsenMasuk';
          }
        } elseif ($cek_kehadiran->validasi_kehadiran == 1) {
          $validasi2 = $cek_kehadiran->in_time;
          $jam2 = date('H:i:s', strtotime('+5 hours', strtotime($validasi2)));
          if ($jam < $jam2) {
            echo 'AndaTelahAbsen';
          } else {
            $data1 = array(
              'out_time'  => $jam,
              'out_date'  => $tgl,
              'validasi_kehadiran' => 2,
            );
            $UpdateInfo = $this->Anggota_model->updateFile($data1, "absen_wil4", $where);
            if ($UpdateInfo) {
              echo 'AbsenPulang';
            }
          }
        } else {
          if ($cek_kehadiran->out_date == $tgl) {
            $jamOut = $cek_kehadiran->out_time;
            $jamOutLebih = date('H:i:s', strtotime('+6 hours', strtotime($jamOut)));
            if ($jam < $jamOutLebih) {
              echo 'AndaTelahMasuk';
            } else {
              $data = array(
                'id_absen' => $id_absen,
                'npk'      => $npk,
                'area'     => $area,
                'in_time'  => $jam,
                'in_date'  => $tgl,
                'validasi_kehadiran' => $validasi,
              );
              $info = $this->Anggota_model->input($data, "absen_wil4");
              if ($info) {
                echo 'AbsenMasuk';
              }
            }
          }
        }
        break;
      default:
        echo "GAGAL";
        break;
    }
  }
}
