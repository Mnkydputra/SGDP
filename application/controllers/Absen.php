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
          'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
          'url'  => $this->uri->segment(2),
          'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
          'employe'  => $this->db->get_where('employee',array('id_employee' => $this->session->userdata('id_akun')))->row(),
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

    function input($id)
    {
      
      $cek_id = $this->db->get_where('employee', array('id_employee' => $id))->row();
      $id_absen = $cek_id->id_employee;
      $where = array('id_absen'  => $id_absen );
      $npk = $cek_id->npk;
      $tgl = date('Y-m-d');
      $validasi = 1;
      $jam = date('H:i:s');
      
      $cek_kehadiran = $this->Anggota_model->cek_kehadiran($id_absen,$validasi);
      $area = $cek_id->area_kerja;
      $validasi1 = $cek_kehadiran->validasi_kehadiran;
      $validasi2 = date('H:i:s',strtotime($cek_kehadiran->in_time));
      $jam2 = date('H:i:s',strtotime("+7 hours", $jam)); 
      switch($cek_id->area_kerja)
      {
        case 'P1':
            if($cek_id != null){
                  if($validasi1 == 1){
                    if($validasi2 <= $jam2){
                        $this->session->set_flashdata("AndaTelahAbsen","Berhasil");    
                        redirect('Absen');
                    }else{
                        $data1 = array(
                        'out_time'  => $jam,
                        'out_date'  => $tgl,
                        'validasi_kehadiran' => 2,
                      );
                       $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_p1",$id_absen);
                       if($UpdateInfo){
                          $this->session->set_flashdata("AbsenPulang","Berhasil");
                          redirect('Absen');
                       }
                    }
                      
                  }else{
                      $data = array(
                      'id_absen' => $id_absen,
                      'npk'      => $npk,
                      'in_time'  => $jam,
                      'in_date'  => $tgl,
                    );
                      $info = $this->Anggota_model->input($data,"absen_p1");
                      if($info){
                         $this->session->set_flashdata("AbsenMasuk","Berhasil");
                         redirect('Absen');
                      }
                  }   
              }else{
                $this->session->set_flashdata("Gagal","Data ada tidak ada");
                redirect('Absen');
              }
          break;
        case 'P2':

            if($cek_id != null){
                  if($validasi1 == 1){
                    if($validasi2 <= $jam2){
                        $this->session->set_flashdata("AndaTelahAbsen","Berhasil");    
                        redirect('Absen');
                    }else{
                        $data1 = array(
                        'out_time'  => $jam,
                        'out_date'  => $tgl,
                        'validasi_kehadiran' => 2,
                      );
                       $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_p2",$id_absen);
                       if($UpdateInfo){
                          $this->session->set_flashdata("AbsenPulang","Berhasil");
                          redirect('Absen');
                       }
                    }
                      
                  }else{
                      $data = array(
                      'id_absen' => $id_absen,
                      'npk'      => $npk,
                      'in_time'  => $jam,
                      'in_date'  => $tgl,
                    );
                      $info = $this->Anggota_model->input($data,"absen_p2");
                      if($info){
                         $this->session->set_flashdata("AbsenMasuk","Berhasil");
                         redirect('Absen');
                      }
                  }   
              }else{
                $this->session->set_flashdata("Gagal","Data ada tidak ada");
                redirect('Absen');
              }

          break;
        case 'P3':

            if($cek_id != null){
                  if($validasi1 == 1){
                    if($validasi2 <= $jam2){
                        $this->session->set_flashdata("AndaTelahAbsen","Berhasil");    
                        redirect('Absen');
                    }else{
                        $data1 = array(
                        'out_time'  => $jam,
                        'out_date'  => $tgl,
                        'validasi_kehadiran' => 2,
                      );
                       $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_p3",$id_absen);
                       if($UpdateInfo){
                          $this->session->set_flashdata("AbsenPulang","Berhasil");
                          redirect('Absen');
                       }
                    }
                      
                  }else{
                      $data = array(
                      'id_absen' => $id_absen,
                      'npk'      => $npk,
                      'in_time'  => $jam,
                      'in_date'  => $tgl,
                    );
                      $info = $this->Anggota_model->input($data,"absen_p3");
                      if($info){
                         $this->session->set_flashdata("AbsenMasuk","Berhasil");
                         redirect('Absen');
                      }
                  }   
              }else{
                $this->session->set_flashdata("Gagal","Data ada tidak ada");
                redirect('Absen');
              }

          break;
        case 'P4':

            if($cek_id != null){
                  if($validasi1 == 1){
                    if($validasi2 <= $jam2){
                        $this->session->set_flashdata("AndaTelahAbsen","Berhasil");    
                        redirect('Absen');
                    }else{
                        $data1 = array(
                        'out_time'  => $jam,
                        'out_date'  => $tgl,
                        'validasi_kehadiran' => 2,
                      );
                       $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_p4",$id_absen);
                       if($UpdateInfo){
                          $this->session->set_flashdata("AbsenPulang","Berhasil");
                          redirect('Absen');
                       }
                    }
                      
                  }else{
                      $data = array(
                      'id_absen' => $id_absen,
                      'npk'      => $npk,
                      'in_time'  => $jam,
                      'in_date'  => $tgl,
                    );
                      $info = $this->Anggota_model->input($data,"absen_p4");
                      if($info){
                         $this->session->set_flashdata("AbsenMasuk","Berhasil");
                         redirect('Absen');
                      }
                  }   
              }else{
                $this->session->set_flashdata("Gagal","Data ada tidak ada");
                redirect('Absen');
              }

          break;
        case 'P5':

            if($cek_id != null){
                  if($validasi1 == 1){
                    if($validasi2 <= $jam2){
                        $this->session->set_flashdata("AndaTelahAbsen","Berhasil");    
                        redirect('Absen');
                    }else{
                        $data1 = array(
                        'out_time'  => $jam,
                        'out_date'  => $tgl,
                        'validasi_kehadiran' => 2,
                      );
                       $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_p5",$id_absen);
                       if($UpdateInfo){
                          $this->session->set_flashdata("AbsenPulang","Berhasil");
                          redirect('Absen');
                       }
                    }
                      
                  }else{
                      $data = array(
                      'id_absen' => $id_absen,
                      'npk'      => $npk,
                      'in_time'  => $jam,
                      'in_date'  => $tgl,
                    );
                      $info = $this->Anggota_model->input($data,"absen_p5");
                      if($info){
                         $this->session->set_flashdata("AbsenMasuk","Berhasil");
                         redirect('Absen');
                      }
                  }   
              }else{
                $this->session->set_flashdata("Gagal","Data ada tidak ada");
                redirect('Absen');
              }

          break;
        case 'HO':

            if($cek_id != null){
                  if($validasi1 == 1){
                    if($validasi2 <= $jam2){
                        $this->session->set_flashdata("AndaTelahAbsen","Berhasil");    
                        redirect('Absen');
                    }else{
                        $data1 = array(
                        'out_time'  => $jam,
                        'out_date'  => $tgl,
                        'validasi_kehadiran' => 2,
                      );
                       $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_ho",$id_absen);
                       if($UpdateInfo){
                          $this->session->set_flashdata("AbsenPulang","Berhasil");
                          redirect('Absen');
                       }
                    }
                      
                  }else{
                      $data = array(
                      'id_absen' => $id_absen,
                      'npk'      => $npk,
                      'in_time'  => $jam,
                      'in_date'  => $tgl,
                    );
                      $info = $this->Anggota_model->input($data,"absen_ho");
                      if($info){
                         $this->session->set_flashdata("AbsenMasuk","Berhasil");
                         redirect('Absen');
                      }
                  }   
              }else{
                $this->session->set_flashdata("Gagal","Data ada tidak ada");
                redirect('Absen');
              }

          break;
        case 'VLC':
            if($cek_id != null){
                  if($validasi1 == 1){
                    if($validasi2 >= $jam2){
                        $this->session->set_flashdata("AndaTelahAbsen","Berhasil");    
                        redirect('Absen');
                    }else{
                        $data1 = array(
                        'out_time'  => $jam,
                        'out_date'  => $tgl,
                        'validasi_kehadiran' => 2,
                      );
                      var_dump($data1);
                       $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_vlc",$where);
                       if($UpdateInfo){
                          $this->session->set_flashdata("AbsenPulang","Berhasil");
                          redirect('Absen');
                       }
                    }
                      
                  }else{
                      $data = array(
                      'id_absen' => $id_absen,
                      'npk'      => $npk,
                      'in_time'  => $jam,
                      'in_date'  => $tgl,
                      'validasi_kehadiran' => $validasi,
                    );
                      $info = $this->Anggota_model->input($data,"absen_vlc");
                      if($info){
                         $this->session->set_flashdata("AbsenMasuk","Berhasil");
                         redirect('Absen');
                      }
                  }   
              }else{
                $this->session->set_flashdata("Gagal","Data ada tidak ada");
                redirect('Absen');
              }
          break;
        case 'PC':

            if($cek_id != null){
                  if($validasi1 == 1){
                    if($validasi2 <= $jam2){
                        $this->session->set_flashdata("AndaTelahAbsen","Berhasil");    
                        redirect('Absen');
                    }else{
                        $data1 = array(
                        'out_time'  => $jam,
                        'out_date'  => $tgl,
                        'validasi_kehadiran' => 2,
                      );
                       $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_pc",$id_absen);
                       if($UpdateInfo){
                          $this->session->set_flashdata("AbsenPulang","Berhasil");
                          redirect('Absen');
                       }
                    }
                      
                  }else{
                      $data = array(
                      'id_absen' => $id_absen,
                      'npk'      => $npk,
                      'in_time'  => $jam,
                      'in_date'  => $tgl,
                    );
                      $info = $this->Anggota_model->input($data,"absen_pc");
                      if($info){
                         $this->session->set_flashdata("AbsenMasuk","Berhasil");
                         redirect('Absen');
                      }
                  }   
              }else{
                $this->session->set_flashdata("Gagal","Data ada tidak ada");
                redirect('Absen');
              }

          break;
        case 'DORMITORY':

            if($cek_id != null){
                  if($validasi1 == 1){
                    if($validasi2 <= $jam2){
                        $this->session->set_flashdata("AndaTelahAbsen","Berhasil");    
                        redirect('Absen');
                    }else{
                        $data1 = array(
                        'out_time'  => $jam,
                        'out_date'  => $tgl,
                        'validasi_kehadiran' => 2,
                      );
                       $UpdateInfo = $this->Anggota_model->updateFile($data1,"absen_dor",$id_absen);
                       if($UpdateInfo){
                          $this->session->set_flashdata("AbsenPulang","Berhasil");
                          redirect('Absen');
                       }
                    }
                      
                  }else{
                      $data = array(
                      'id_absen' => $id_absen,
                      'npk'      => $npk,
                      'in_time'  => $jam,
                      'in_date'  => $tgl,
                    );
                      $info = $this->Anggota_model->input($data,"absen_dor");
                      if($info){
                         $this->session->set_flashdata("AbsenMasuk","Berhasil");
                         redirect('Absen');
                      }
                  }   
              }else{
                $this->session->set_flashdata("Gagal","Data ada tidak ada");
                redirect('Absen');
              }

          break;
        default:
          echo "AREA KERJA TIDAK DI TEMUKAN";
          break; 
      }

     
     
      
      

    }
    
  }
  ?>