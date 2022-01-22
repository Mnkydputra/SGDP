<?php


Class Dashboard Extends CI_Controller
{
  function __construct()
  {
    parent::__construct();

    $id = $this->session->userdata('id_akun');
    date_default_timezone_set('Asia/Jakarta');  
      if ($id == null || $id == "") {
      $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
      redirect('Login');
  }
      
  }

    function index()
    {
    $cek_id = $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row();
    $id_absen = $cek_id->id_employee;
    $where = array('id_absen'  => $id_absen,
                    'validasi_kehadiran' => 1);
    $validasi = 1;
    $jam = date('H:i:s');
    $wilayah = $cek_id->wilayah;
    $area    = $cek_id->area_kerja;
    $cek_kehadiran = $this->Anggota_model->cek_wil12($id_absen,$validasi);
    $validasi2 = date('H:i:s',strtotime('+20 hours', strtotime($cek_kehadiran->in_time)));
    $tgl2  =  date('Y-m-d',strtotime('+1 days', strtotime($cek_kehadiran->in_date)));       
    $cek_kehadiran->in_time;
    $hours = $cek_kehadiran->in_time;

    $o1 = new DateTime($jam);
    $o2 = new DateTime($hours);
    $diff = $o1->diff($o2,true);
    echo $diff->format('%H:%I:%S');
    // if($jam > $validasi2 && $cek_kehadiran->in_date == $tgl2){
    //   echo "sudah lebih dari 20 jam";

    //   // $data1 = array(
    //       //     'validasi_kehadiran' => 2,
    //       //   );
    //       //   $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_wil2",$where);
    //       // echo "sudah lebih dari 20 jam dan tanggal setelahnya";
    //     }else{
    //           echo"kurang dari 20jam";                  
    //     }
    // switch ($wilayah) {
    //   case 'WIL1':
    //     if($jam > $validasi2 || $cek_kehadiran->in_date == $tgl2){
    //       $data1 = array(
    //           'validasi_kehadiran' => 2,
    //         );
    //         $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_wil2",$where);
    //       echo "sudah lebih dari 20 jam dan tanggal setelahnya";
    //     }
    //   case 'WIL2':
    //     if($jam > $validasi2 || $cek_kehadiran->in_date == $tgl2){
    //     $data1 = array(
    //         'validasi_kehadiran' => 2,
    //       );
    //       $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_wil2",$where);
    //       echo "sudah lebih dari 20 jam dan tanggal setelahnya";
    //     }
    //     break;
    //   case 'WIL3':
    //     if($jam > $validasi2 || $cek_kehadiran->in_date == $tgl2){
    //     $data1 = array(
    //         'validasi_kehadiran' => 2,
    //       );
    //       $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_wil2",$where);
    //     echo "sudah lebih dari 20 jam dan tanggal setelahnya";
    //   }
       
    //     break;
    //   case 'WIL4':
    //     if($jam > $validasi2 || $cek_kehadiran->in_date == $tgl2){
    //     $data1 = array(
    //         'validasi_kehadiran' => 2,
    //       );
    //       $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_wil2",$where);
    //     echo "sudah lebih dari 20 jam dan tanggal setelahnya";
    //   }
    //     break; 
    // }
    // if($jam > $validasi2 || $cek_kehadiran->in_date == $tgl2){
    //     $data1 = array(
    //         'validasi_kehadiran' => 2,
    //       );
    //       $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_wil2",$where);
    //     echo "sudah lebih dari 20 jam dan tanggal setelahnya";
    //   }else{
    //     echo "Belum lebih dari 20 jam dan masih di tanggal yang sama";
    //   }
    
    //   $data = array(
    //     'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
    //     'url'  => $this->uri->segment(2),
    //     'berkas'    => $this->db->get_where('berkas',array('id_berkas' => $this->session->userdata('id_akun')))->row(),
    //  );
    //     $this->load->view('mobile/header',$data);
    //     $this->load->view('Anggota/dashboard',$data);
    //     $this->load->view('mobile/fotter');
    }

}
?>