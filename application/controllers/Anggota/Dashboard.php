<?php


class Dashboard extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('user_agent');
    $id = $this->session->userdata('id_akun');
    $role_id = $this->session->userdata('role_id');
    if ($id == null || $id == "") {
      $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
      redirect('Login');
    }
    if ($role_id != 1) {
      redirect('LogOut');
    }
  }

  function index()
  {
    $data = array(
      'biodata'   => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
      'url'       => $this->uri->segment(2),
      'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
    );
    $cek_id = $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row();
    $id_absen = $cek_id->id_employee;
    $where = array('id_absen'  => $id_absen,
                    'validasi_kehadiran' => 1);
    $npk = $cek_id->npk;
    $validasi = 1;
    $tgl = date('Y-m-d');
    $jam = date('H:i:s');
    $dua = 2;
    $wilayah = $cek_id->wilayah;
    $area    = $cek_id->area_kerja;
    switch ($wilayah) {
      case 'WIL1':
        $cek_kehadiran = $this->Anggota_model->cek_wil1($id_absen,$tgl,$validasi);
        if($cek_kehadiran != null){
            $validasi2 = $cek_kehadiran->in_time;
            $jam2 = date('H:i:s',strtotime('+20 hours', strtotime($validasi2)));
            if($jam2 > $jam){
              echo "Lebih Dari 20 Jam";
              $data1 = array(
                'validasi_kehadiran' => 2,
                );
              $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_wil1",$where);
                }
            }
        break;
        case 'WIL2':
        $cek_kehadiran = $this->Anggota_model->cek_wil2($id_absen,$tgl,$validasi);
        if($cek_kehadiran != null){
            $validasi2 = $cek_kehadiran->in_time;
            $jam2 = date('H:i:s',strtotime('+20 hours', strtotime($validasi2)));
            if($jam2 > $jam){
              echo "Lebih Dari 20 Jam";
              $data1 = array(
                'validasi_kehadiran' => 2,
                );
              $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_wil2",$where);
                }
            }
        break;
        case 'WIL3':
        $cek_kehadiran = $this->Anggota_model->cek_wil3($id_absen,$tgl,$validasi);
        if($cek_kehadiran != null){
            $validasi2 = $cek_kehadiran->in_time;
            $jam2 = date('H:i:s',strtotime('+20 hours', strtotime($validasi2)));
            if($jam2 > $jam){
              echo "Lebih Dari 20 Jam";
              $data1 = array(
                'validasi_kehadiran' => 2,
                );
              $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_wil3",$where);
                }
            }
        break;
        case 'WIL4':
        $cek_kehadiran = $this->Anggota_model->cek_wil1($id_absen,$tgl,$validasi);
        if($cek_kehadiran != null){
            $validasi2 = $cek_kehadiran->in_time;
            $jam2 = date('H:i:s',strtotime('+20 hours', strtotime($validasi2)));
            if($jam2 > $jam){
              echo "Lebih Dari 20 Jam";
              $data1 = array(
                'validasi_kehadiran' => 2,
                );
              $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_wil4",$where);
                }
            }
        
        break;
    }

    // $this->load->view('mobile/header', $data);
    // $this->load->view('Anggota/dashboard', $data);
    // // $this->load->view('Anggota/new');
    // $this->load->view('mobile/fotter');
  }
}
