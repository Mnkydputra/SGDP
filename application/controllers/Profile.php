<?php
<<<<<<< HEAD
=======

>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426
use Dekiakbar\IndonesiaRegionsPhpClient\Region;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Offset;

class Profile extends CI_Controller
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
<<<<<<< HEAD
   
=======
>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426
  }


  function index()
  {
    $data1 = $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row();
    $area = $data1->wilayah;
    $region = new Dekiakbar\IndonesiaRegionsPhpClient\Region();
    $provinsi = $region->getAllProvince('pos');
    $data2 = "";
    switch ($area) {
<<<<<<< HEAD
      case 'WIL 1':
        $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_wil1")->result();
=======
<<<<<<< HEAD
      case 'WIL1':
             $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_wil1")->result();
        break;
      case 'WIL2':
             $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_wil2")->result();
=======
      case 'P1':
        $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_p1")->result();
>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426
        break;
      case 'WIL3':
             $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_wil3")->result();
        break;
<<<<<<< HEAD
      case 'WIL4':
             $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_wil4")->result();
=======
      case 'P3':
        $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_p3")->result();
        break;
      case 'P4':
        $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_p4")->result();
>>>>>>> bb78d4d63d06fc5214e377effe63f2dfbfeb91a5
        break;
      case 'WIL 2':
        $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_wil2")->result();
        break;
      case 'WIL 3':
        $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_wil3")->result();
        break;
<<<<<<< HEAD
      case 'WIL 4':
        $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_wil4")->result();
=======
      case 'VLC':
        $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_vlc")->result();
        break;
      case 'DOR':
        $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_dor")->result();
>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426
>>>>>>> bb78d4d63d06fc5214e377effe63f2dfbfeb91a5
        break;
      default:
        echo "EROR!";
        break;
    }
<<<<<<< HEAD
       $data = array(
          'biodata'   => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
          'employee'  => $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row(),
          'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
          'url'       => $this->uri->segment(2),
          'provinsi'  => $provinsi,
          'absen'     => $data2
        );
        $this->load->view('mobile/header', $data);
        $this->load->view('profile', $data);
        $this->load->view('mobile/fotter');
=======
    $data = array(
      'biodata'   => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
      'employee'  => $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row(),
      'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
      'absen'      => $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_wil1")->result(),
      'url'       => $this->uri->segment(2),
      'provinsi'  => $provinsi,
      'absen'     => $data2
    );
    $this->load->view('mobile/header', $data);
    $this->load->view('profile', $data);
    $this->load->view('mobile/fotter');
>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426
  }

  function Foto()
  {
    $data = array(
      'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row()
    );
    $this->load->view('mobile/header', $data);
    $this->load->view('foto', $data);
    $this->load->view('mobile/fotter');
  }


  function BiodataUpdate()
  {
    $where = array('id_biodata'  => $this->input->post('id_biodata'));
    //masukan data update karyawan ke array data
    $data = array(
      'ktp'                     => $this->input->post("no_ktp"),
      'kk'                      => $this->input->post("no_kk"),
      'no_hp'                   => $this->input->post("no_hp"),
      'no_emergency'            => $this->input->post("no_emergency"),
      'email'                   => $this->input->post("email"),
      'jl_ktp'                  => strtoupper($this->input->post("jl_ktp")),
      'rt_ktp'                  => $this->input->post("rt_ktp"),
      'rw_ktp'                  => $this->input->post("rw_ktp"),
      'kel_ktp'                 => strtoupper($this->input->post("kelurahan_ktp")),
      'kec_ktp'                 => strtoupper($this->input->post("kecamatan_ktp")),
      'kota_ktp'                => strtoupper($this->input->post("kabupaten_ktp")),
      'provinsi_ktp'            => strtoupper($this->input->post("provinsi_ktp")),
      'jl_dom'                  => strtoupper($this->input->post("jl_dom")),
      'rt_dom'                  => $this->input->post("rt_dom"),
      'rw_dom'                  => $this->input->post("rw_dom"),
      'kel_dom'                 => strtoupper($this->input->post("kel_dom")),
      'kec_dom'                 => strtoupper($this->input->post("kec_dom")),
      'kota_dom'                => strtoupper($this->input->post("kota_dom")),
      'provinsi_dom'            => strtoupper($this->input->post("provinsi_dom")),
      'berat_badan'             => $this->input->post("berat_badan"),
      'tinggi_badan'            => $this->input->post("tinggi_badan"),
      'imt'                     => $this->input->post("imt"),
      'keterangan'              => strtoupper($this->input->post("keterangan")),

    );
    //input update karyawan
    $UpdateInfo = $this->Anggota_model->updateFile($data, "biodata", $where);
    if ($UpdateInfo) {
      echo "Sukses";
    } else {
      echo "Gagal";
    }
  }

  function EmployeeUpdate()
  {
    $today = date("Y-m-d");
    $cektgl = $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row();
    $q = $cektgl->expired_kta;
    $where = array('id_employee'  => $this->input->post('id_employe'));
    //masukan data update karyawan ke array data
    $data = array(
      'no_kta'                       => $this->input->post("no_kta"),
      'expired_kta'                  => $this->input->post("ex_kta"),
<<<<<<< HEAD
     
=======

>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426
      'tgl_masuk_sigap'              => $this->input->post("masuk_sigap"),
      'tgl_masuk_adm'                => $this->input->post("masuk_adm"),
    );
    if ($q >= $today) {
      $this->db->set('status_kta', 'AKTIF');
      $this->db->where($where, "employee");
      $this->db->update('employee');
    } else if ($q <= $today) {
      $this->db->set('status_kta', 'TIDAK AKTIF');
      $this->db->where($where, "employee");
      $this->db->update('employee');
    }
    //input update karyawan
    $updateInfouser = $this->Anggota_model->updateFile($data, "employee", $where);
    if ($updateInfouser) {
      echo "Sukses";
    } else {
      echo "Gagal";
    }
  }

  public function UpdateFoto()
  {
    $id_akun = $this->session->userdata('id_akun');
    $directory = "Poto";
    $this->load->library('upload');
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['upload_path']  = './assets/berkas/Poto/';
    $config['overwrite'] = true;
    $config['file_name'] = $directory . $this->input->post('npk');
    $this->upload->initialize($config);

    if ($this->upload->do_upload("foto")) {
      $file = $this->upload->data('file_name');
      $data = array(
        'foto'    => $file
      );

      $where = array('id_berkas'  => $this->session->userdata('id_akun'));
      $update = $this->Anggota_model->updateFile($data, 'berkas', $where);
      if ($update) {
        echo "Sukses";
      } else {
        echo "Gagal";
      }
    }
  }

  public function showAbsensi()
  {
    $data1 = $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row();
    $area = $data1->wilayah;
    $absen = "";
    $year = date('Y') . '-' . $this->input->post("bulan");
    $bln = $this->input->post("bulan");
    $date = $year;
    switch ($area) {
<<<<<<< HEAD
      case 'WIL1':
        $tbl = "absen_wil1";
        $absen = $this->Anggota_model->getAbsensi($this->session->userdata('id_akun'), $date, "absen_wil1")->result();
        break;
      case 'WIL2':
        $tbl = "absen_wil2";
        $absen = $this->Anggota_model->getAbsensi($this->session->userdata('id_akun'), $date, "absen_wil2")->result();
=======
      case 'P1':
        $tbl = "absen_p1";
        $absen = $this->Anggota_model->getAbsensi($this->session->userdata('id_akun'), $date, "absen_p1")->result();
        break;
      case 'P2':
        $tbl = "absen_p2";
        $absen = $this->Anggota_model->getAbsensi($this->session->userdata('id_akun'), $date, "absen_p2")->result();
        break;
      case 'P3':
        $tbl = 'absen_p3';
        $absen = $this->Anggota_model->getAbsensi($this->session->userdata('id_akun'), $date, "absen_p3")->result();
        break;
      case 'P4':
        $tbl = "absen_p4";
        $absen = $this->Anggota_model->getAbsensi($this->session->userdata('id_akun'), $date, "absen_p4")->result();
        break;
      case 'P5':
        $tbl = "absen_p5";
        $absen = $this->Anggota_model->getAbsensi($this->session->userdata('id_akun'), $date, "absen_p5")->result();
        break;
      case 'PC':
        $tbl = "absen_pc";
        $absen = $this->Anggota_model->getAbsensi($this->session->userdata('id_akun'), $date, "absen_pc")->result();
        break;
      case 'VLC':
        $tbl = "absen_vlc";
        $absen = $this->Anggota_model->getAbsensi($this->session->userdata('id_akun'), $date, "absen_vlc")->result();
>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426
        break;
      case 'WIL3':
        $tbl = 'absen_wil3';
        $absen = $this->Anggota_model->getAbsensi($this->session->userdata('id_akun'), $date, "absen_wil3")->result();
        break;
<<<<<<< HEAD
      case 'WIL4':
        $tbl = "absen_wil4";
        $absen = $this->Anggota_model->getAbsensi($this->session->userdata('id_akun'), $date, "absen_wil4")->result();
=======
      case 'DOR':
        $tbl = "absen_dor";
        $absen = $this->Anggota_model->getAbsensi($this->session->userdata('id_akun'), $date, "absen_dor")->result();
>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426
        break;
    }
    $data = [
      'absen' => $absen,
      'bulan' => $bln,
      'tabel' => $tbl,
    ];
    $this->load->view("showAbsen", $data);
  }
}
