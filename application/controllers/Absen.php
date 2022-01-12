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
        'employe'   => $this->db->get_where('employee',array('id_employee' => $this->session->userdata('id_akun')))->row(),
      );
      $this->load->view('mobile/header',$data);
      $this->load->view('absensi',$data);
      $this->load->view('mobile/fotter');
  }

  function getPlan()
  {
      $id = $this->input->post("AreaKerja");
      $data = $this->db->get_where('barcode_absensi', ['id_barcode' => $id])->result();
      echo json_encode($data);
  }
  
  function Korlap($id)
  {
    $cek_id = $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row();
    $id_absen = $cek_id->id_employee;
    $where = array('id_absen'  => $id_absen );
    $npk = $cek_id->npk;
    $validasi = 1;
    $cek_kehadiran = $this->Anggota_model->cek_KORLAP($id_absen,$validasi);
    $tgl = date('Y-m-d');
    $jam = date('H:i:s');
    $area = $cek_id->area_kerja;
         if($cek_kehadiran == null){
                $data = array(
                        'id_absen' => $id_absen,
                        'npk'      => $npk,
                        'in_time'  => $jam,
                        'in_date'  => $tgl,
                        'validasi_kehadiran' => $validasi,
                      );
                        $info = $this->Anggota_model->input($data,"absen_korlap");
                        if($info){
                           echo 'AbsenMasuk';
                            }
                    }else{
                        $validasi1 = $cek_kehadiran->validasi_kehadiran;
                        $validasi2 = $cek_kehadiran->in_time;
                        $jam2 = date('H:i:s',strtotime('+5 hours', strtotime($validasi2))); 
                            if($validasi1 == 1){
                                if($jam < $jam2){
                                    echo 'AndaTelahAbsen';
                              }else{
                                  $data1 = array(
                                  'out_time'  => $jam,
                                  'out_date'  => $tgl,
                                  'validasi_kehadiran' => 2,
                                );
                                 $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_korlap",$where);
                                 if($UpdateInfo){
                                    echo 'AbsenPulang';
                                 }
                              }
                            }
                    }
  }

  function input($id)
  {
     
    $cek_id = $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row();
    $id_absen = $cek_id->id_employee;
    $where = array('id_absen'  => $id_absen );
    $npk = $cek_id->npk;
    $validasi = 1;
    $tgl = date('Y-m-d');
    $jam = date('H:i:s');
    $area = $cek_id->area_kerja;
   switch($area)
    {
      case 'P1':
            $cek_kehadiran = $this->Anggota_model->cek_P1($id_absen,$validasi);
                if($cek_kehadiran == null){
                    $data = array(
                    'id_absen' => $id_absen,
                    'npk'      => $npk,
                    'in_time'  => $jam,
                    'in_date'  => $tgl,
                    'validasi_kehadiran' => $validasi,
                  );
                    $info = $this->Anggota_model->input($data,"absen_p1");
                    if($info){
                       echo 'AbsenMasuk';
                    }
                }else{
                    $validasi1 = $cek_kehadiran->validasi_kehadiran;
                    $validasi2 = $cek_kehadiran->in_time;
                    $jam2 = date('H:i:s',strtotime('+5 hours', strtotime($validasi2))); 
                    if($validasi1 == 1){
                          if($jam < $jam2){
                                echo 'AndaTelahAbsen';
                          }else{
                               $data1 = array(
                              'out_time'  => $jam,
                              'out_date'  => $tgl,
                              'validasi_kehadiran' => 2,
                            );
                             $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_p1",$where);
                             if($UpdateInfo){
                                echo 'AbsenPulang';
                             }
                            }  
                    }
                }
        break;
      case 'P2':
           $cek_kehadiran = $this->Anggota_model->cek_P2($id_absen,$validasi);
                if($cek_kehadiran == null){
                    $data = array(
                    'id_absen' => $id_absen,
                    'npk'      => $npk,
                    'in_time'  => $jam,
                    'in_date'  => $tgl,
                    'validasi_kehadiran' => $validasi,
                  );
                    $info = $this->Anggota_model->input($data,"absen_p2");
                    if($info){
                       echo 'AbsenMasuk';
                    }
                }else{
                    $validasi1 = $cek_kehadiran->validasi_kehadiran;
                    $validasi2 = $cek_kehadiran->in_time;
                    $jam2 = date('H:i:s',strtotime('+5 hours', strtotime($validasi2))); 
                    if($validasi1 == 1){
                          if($jam < $jam2){
                                echo 'AndaTelahAbsen';
                          }else{
                               $data1 = array(
                              'out_time'  => $jam,
                              'out_date'  => $tgl,
                              'validasi_kehadiran' => 2,
                            );
                             $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_p2",$where);
                             if($UpdateInfo){
                                echo 'AbsenPulang';
                             }
                            }  
                    }
                }

        break;
      case 'P3':
               $cek_kehadiran = $this->Anggota_model->cek_P3($id_absen,$validasi);
                if($cek_kehadiran == null){
                    $data = array(
                    'id_absen' => $id_absen,
                    'npk'      => $npk,
                    'in_time'  => $jam,
                    'in_date'  => $tgl,
                    'validasi_kehadiran' => $validasi,
                  );
                    $info = $this->Anggota_model->input($data,"absen_p3");
                    if($info){
                       echo 'AbsenMasuk';
                    }
                }else{
                    $validasi1 = $cek_kehadiran->validasi_kehadiran;
                    $validasi2 = $cek_kehadiran->in_time;
                    $jam2 = date('H:i:s',strtotime('+5 hours', strtotime($validasi2))); 
                    if($validasi1 == 1){
                          if($jam < $jam2){
                                echo 'AndaTelahAbsen';
                          }else{
                               $data1 = array(
                              'out_time'  => $jam,
                              'out_date'  => $tgl,
                              'validasi_kehadiran' => 2,
                            );
                             $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_p3",$where);
                             if($UpdateInfo){
                                echo 'AbsenPulang';
                             }
                            }  
                    }
                }

        break;
      case 'P4':
                $cek_kehadiran = $this->Anggota_model->cek_P4($id_absen,$validasi);
                if($cek_kehadiran == null){
                    $data = array(
                    'id_absen' => $id_absen,
                    'npk'      => $npk,
                    'in_time'  => $jam,
                    'in_date'  => $tgl,
                    'validasi_kehadiran' => $validasi,
                  );
                    $info = $this->Anggota_model->input($data,"absen_p4");
                    if($info){
                       echo 'AbsenMasuk';
                    }
                }else{
                    $validasi1 = $cek_kehadiran->validasi_kehadiran;
                    $validasi2 = $cek_kehadiran->in_time;
                    $jam2 = date('H:i:s',strtotime('+5 hours', strtotime($validasi2))); 
                    if($validasi1 == 1){
                          if($jam < $jam2){
                                echo 'AndaTelahAbsen';
                          }else{
                               $data1 = array(
                              'out_time'  => $jam,
                              'out_date'  => $tgl,
                              'validasi_kehadiran' => 2,
                            );
                             $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_p4",$where);
                             if($UpdateInfo){
                                echo 'AbsenPulang';
                             }
                            }  
                    }
                }

        break;
      case 'P5':
                $cek_kehadiran = $this->Anggota_model->cek_P5($id_absen,$validasi);
                if($cek_kehadiran == null){
                    $data = array(
                    'id_absen' => $id_absen,
                    'npk'      => $npk,
                    'in_time'  => $jam,
                    'in_date'  => $tgl,
                    'validasi_kehadiran' => $validasi,
                  );
                    $info = $this->Anggota_model->input($data,"absen_p5");
                    if($info){
                       echo 'AbsenMasuk';
                    }
                }else{
                    $validasi1 = $cek_kehadiran->validasi_kehadiran;
                    $validasi2 = $cek_kehadiran->in_time;
                    $jam2 = date('H:i:s',strtotime('+5 hours', strtotime($validasi2))); 
                    if($validasi1 == 1){
                          if($jam < $jam2){
                                echo 'AndaTelahAbsen';
                          }else{
                               $data1 = array(
                              'out_time'  => $jam,
                              'out_date'  => $tgl,
                              'validasi_kehadiran' => 2,
                            );
                             $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_p5",$where);
                             if($UpdateInfo){
                                echo 'AbsenPulang';
                             }
                            }  
                    }
                }

        break;
      case 'HO':
                $cek_kehadiran = $this->Anggota_model->cek_HO($id_absen,$validasi);
                if($cek_kehadiran == null){
                    $data = array(
                    'id_absen' => $id_absen,
                    'npk'      => $npk,
                    'in_time'  => $jam,
                    'in_date'  => $tgl,
                    'validasi_kehadiran' => $validasi,
                  );
                    $info = $this->Anggota_model->input($data,"absen_ho");
                    if($info){
                       echo 'AbsenMasuk';
                    }
                }else{
                    $validasi1 = $cek_kehadiran->validasi_kehadiran;
                    $validasi2 = $cek_kehadiran->in_time;
                    $jam2 = date('H:i:s',strtotime('+5 hours', strtotime($validasi2))); 
                    if($validasi1 == 1){
                          if($jam < $jam2){
                                echo 'AndaTelahAbsen';
                          }else{
                               $data1 = array(
                              'out_time'  => $jam,
                              'out_date'  => $tgl,
                              'validasi_kehadiran' => 2,
                            );
                             $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_ho",$where);
                             if($UpdateInfo){
                                echo 'AbsenPulang';
                             }
                            }  
                    }
                }
        break;
      case 'VLC':
          $cek_kehadiran = $this->Anggota_model->cek_VLC($id_absen,$validasi);
                if($cek_kehadiran == null){
                    $data = array(
                    'id_absen' => $id_absen,
                    'npk'      => $npk,
                    'in_time'  => $jam,
                    'in_date'  => $tgl,
                    'validasi_kehadiran' => $validasi,
                  );
                    $info = $this->Anggota_model->input($data,"absen_vlc");
                    if($info){
                       echo 'AbsenMasuk';
                    }
                }else{
                    $validasi1 = $cek_kehadiran->validasi_kehadiran;
                    $validasi2 = $cek_kehadiran->in_time;
                    $jam2 = date('H:i:s',strtotime('+5 hours', strtotime($validasi2))); 
                    if($validasi1 == 1){
                          if($jam < $jam2){
                                echo 'AndaTelahAbsen';
                          }else{
                              $data1 = array(
                              'out_time'  => $jam,
                              'out_date'  => $tgl,
                              'validasi_kehadiran' => 2,
                            );
                             $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_vlc",$where);
                             if($UpdateInfo){
                                echo 'AbsenPulang';
                             }
                            }  
                    }
                }
        break;
      case 'PC':
               $cek_kehadiran = $this->Anggota_model->cek_PC($id_absen,$validasi);
                if($cek_kehadiran == null){
                    $data = array(
                    'id_absen' => $id_absen,
                    'npk'      => $npk,
                    'in_time'  => $jam,
                    'in_date'  => $tgl,
                    'validasi_kehadiran' => $validasi,
                  );
                    $info = $this->Anggota_model->input($data,"absen_pc");
                    if($info){
                       echo 'AbsenMasuk';
                    }
                }else{
                    $validasi1 = $cek_kehadiran->validasi_kehadiran;
                    $validasi2 = $cek_kehadiran->in_time;
                    $jam2 = date('H:i:s',strtotime('+5 hours', strtotime($validasi2))); 
                    if($validasi1 == 1){
                          if($jam < $jam2){
                                echo 'AndaTelahAbsen';
                          }else{
                               $data1 = array(
                              'out_time'  => $jam,
                              'out_date'  => $tgl,
                              'validasi_kehadiran' => 2,
                            );
                             $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_pc",$where);
                             if($UpdateInfo){
                                echo 'AbsenPulang';
                             }
                            }  
                    }
                }
        break;
      case 'DORMITORY':
                $cek_kehadiran = $this->Anggota_model->cek_DOR($id_absen,$validasi);
                if($cek_kehadiran == null){
                    $data = array(
                    'id_absen' => $id_absen,
                    'npk'      => $npk,
                    'in_time'  => $jam,
                    'in_date'  => $tgl,
                    'validasi_kehadiran' => $validasi,
                  );
                    $info = $this->Anggota_model->input($data,"absen_dor");
                    if($info){
                       echo 'AbsenMasuk';
                    }
                }else{
                    $validasi1 = $cek_kehadiran->validasi_kehadiran;
                    $validasi2 = $cek_kehadiran->in_time;
                    $jam2 = date('H:i:s',strtotime('+5 hours', strtotime($validasi2))); 
                    if($validasi1 == 1){
                          if($jam < $jam2){
                                echo 'AndaTelahAbsen';
                          }else{
                               $data1 = array(
                              'out_time'  => $jam,
                              'out_date'  => $tgl,
                              'validasi_kehadiran' => 2,
                            );
                             $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_dor",$where);
                             if($UpdateInfo){
                                echo 'AbsenPulang';
                             }
                            }  
                    }
                }
        break;
      default:
        echo "AREA KERJA TIDAK DI TEMUKAN";
        break; 
    }
  }
}
?>