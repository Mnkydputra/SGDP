<?php
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
   
  }



  function index()
  {
    $data1 = $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row();
    $area = $data1->wilayah;
    $region = new Dekiakbar\IndonesiaRegionsPhpClient\Region();
    $provinsi = $region->getAllProvince('pos');
    $data2 = "";
    switch ($area) {
      case 'WIL1':
             $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_wil1")->result();
        break;
      case 'WIL2':
             $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_wil2")->result();
        break;
      case 'WIL3':
             $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_wil3")->result();
        break;
      case 'WIL4':
             $data2  = $this->Anggota_model->cari(array("id_absen" => $this->session->userdata('id_akun')), "absen_wil4")->result();
        break;
      default:
        echo "EROR!";
        break;
    }
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
      case 'WIL1':
        $tbl = "absen_wil1";
        $absen = $this->Anggota_model->getAbsensi($this->session->userdata('id_akun'), $date, "absen_wil1")->result();
        break;
      case 'WIL2':
        $tbl = "absen_wil2";
        $absen = $this->Anggota_model->getAbsensi($this->session->userdata('id_akun'), $date, "absen_wil2")->result();
        break;
      case 'WIL3':
        $tbl = 'absen_wil3';
        $absen = $this->Anggota_model->getAbsensi($this->session->userdata('id_akun'), $date, "absen_wil3")->result();
        break;
      case 'WIL4':
        $tbl = "absen_wil4";
        $absen = $this->Anggota_model->getAbsensi($this->session->userdata('id_akun'), $date, "absen_wil4")->result();
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
