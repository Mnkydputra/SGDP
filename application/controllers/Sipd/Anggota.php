<?php
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use PhpOffice\PhpSpreadsheet\IOFactory;
	use PhpOffice\PhpSpreadsheet\Spreadsheet;


class Anggota extends CI_Controller
{
  function __construct()
    {
        parent::__construct();

        $id = $this->session->userdata('id_akun');
        $role_id = $this->session->userdata('role_id');
        if ($id == null || $id == "") {
            $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
                redirect('Login');
            } 
            if ($role_id != 4){
                redirect('LogOut');
            }
    }
  function index()
  {
    $data = array(
        'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
        'url'  => $this->uri->segment(2),
        'berkas'    => $this->db->get_where('berkas',array('id_berkas' => $this->session->userdata('id_akun')))->row(),
     );
      $this->load->view('web/header',$data);
      $this->load->view('Sipd/anggota',$data);
      $this->load->view('web/fotter');
  }

  private $filename = "Upload_anggota";
  function Posting()
  {
    $data = array(
        'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
        'url'           => $this->uri->segment(2),
        'berkas'        => $this->db->get_where('berkas',array('id_berkas' => $this->session->userdata('id_akun')))->row(),
    );
    if(isset($_POST['submit'])){
        $upload = $this->Sipd_model->uploadfile3($this->filename);
        if($upload['result'] =="success") {
            
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();$spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

                // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
                // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
                $data['sheet'] = $sheet ;
            }else{
                $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
                echo $upload['error'];
            }

    }
    $this->load->view('web/header',$data);
    $this->load->view('Sipd/anggota',$data);
    $this->load->view('web/fotter');
  }
  
  function TambahAnggota()
  {
    $upload_file=$_FILES['upload_file']['name'];
    $extension=pathinfo($upload_file,PATHINFO_EXTENSION);
    if($extension == 'csv'){
         $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Csv');
    }else if($extension == 'xls'){
         $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
    }else{
         $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
    }
    $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
    $sheetdata = $spreadsheet->getActiveSheet()->toArray(); 
    $sheetcount=count($sheetdata);
    $data = array();
    $data1 = array();
    $data2 = array();
    $data3 = array();
    $data4 = array();

        echo '<pre>';
        print_r($sheetdata);
    // if($sheetcount > 1){
    //     for ($i=1; $i < $sheetcount; $i++)
    //     {
    //         $Id                 = $sheetdata[$i][1];
    //         $Npk                = $sheetdata[$i][2];
    //         $Nama               = $sheetdata[$i][3];
    //         $TempatLahir        = $sheetdata[$i][4];
    //         $TanggalLahir       = $sheetdata[$i][5];
    //         $ÀreaKerja          = $sheetdata[$i][6];
    //         $Wilayah            = $sheetdata[$i][7];
    //         $Jabatan            = $sheetdata[$i][8];
    //         $StatusAnggota      = $sheetdata[$i][9];
    //         $TanggalMasukSigap  = $sheetdata[$i][10];
    //         $TanggalMasukAdm    = $sheetdata[$i][11];

    //         $data[]=array(
    //             'id_akun'   => $Id,
    //             'npk'       => $Npk,
    //             'password'  => md5($Npk),
    //             'role_id'   => 1,
    //         );

    //         $data1[]=array(
    //             'id_berkas' => $Id,
    //         );

    //         $data2[]=array(
    //             'id_biodata'    => $Id,
    //             'npk'           => $Npk,
    //             'nama'          => $Nama,
    //             'tempat_lahir'  => $TempatLahir,
    //             'tanggal_lahir' => $TanggalLahir,
    //         );

    //         $data3[]=array(
    //             'id_employee'           => $Id,
    //             'npk'                   => $Npk,
    //             'jabatan'               => $Jabatan,
    //             'status_anggota'        => $StatusAnggota,
    //             'area_kerja'            => $ÀreaKerja,
    //             'wilayah'               => $Wilayah,
    //             'tgl_masuk_sigap'       => $TanggalMasukSigap,
    //             'tgl_masuk_adm'         => $TanggalMasukAdm,
    //         );

    //         $data4[]=array(
    //             'id_akun'           => $Id,
    //             'id_biodata'        => $Id,
    //             'id_employe'        => $Id,
    //             'id_berkas'         => $Id,
    //         );
    //       }
    //     }
    //     $CekAkun = $this->Sipd_model->cari(array("id_akun" => $Id),"akun")->num_rows();

    //     if($CekAkun > 0){
    //         $this->session->set_flashdata("Error", "Anggota telah terdaftar");
    //         redirect("Sipd/Anggota");
    //     }else{
    //         $input =  $this->Sipd_model->inputArray("akun", $data);
    //         $input =  $this->Sipd_model->inputArray("berkas", $data1);
    //         $input =  $this->Sipd_model->inputArray("biodata", $data2);
    //         $input =  $this->Sipd_model->inputArray("employee", $data3);
    //         $input =  $this->Sipd_model->inputArray("anggota", $data4);
    //     }
    //     if ($input) {
    //         $this->session->set_flashdata("success", "Karyawan tersimpan di data master");
    //         redirect("Sipd/Anggota");
    //     } else {
    //         echo "Gagal";
    //     }
    }
}
