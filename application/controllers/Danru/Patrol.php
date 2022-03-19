<<<<<<< HEAD
<?php

date_default_timezone_set('Asia/Jakarta');

class Patrol extends CI_Controller
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
        if ($role_id != 2) {
            redirect('LogOut');
        }
    }
    
    public function index()
    {
        $data = array(
            'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'        => $this->uri->segment(2),
            'berkas'     => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
        );
        $this->load->view('mobile/header', $data);
        $this->load->view("Danru/scan_barcode", $data);
        $this->load->view('mobile/fotter');
    }
    
    
    //munculkan pilihan lokasi patroli berdasarkan area yang di pilih
    public function getIDPLAN()
    {
        # code...
        $id_plan  = $this->input->post("id_plan");
        $data  = [
            'data'          => $this->Anggota_model->cari(['id_plan' => $id_plan], "titik_area") , 
            'area'          => $id_plan ,
            'terlewati'     => $this->Anggota_model->cari(['id_plan' => $id_plan , 'status' => 1 ], "titik_area" )
        ];
        $this->load->view("Danru/pilih_titik", $data);
    }
    
    public function scanRFID()
    {
        $data = array(
            'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'        => $this->uri->segment(2),
            'berkas'     => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
        );
        $this->load->view('mobile/header', $data);
        $this->load->view("Danru/scan_rfid", $data);
        $this->load->view('mobile/fotter');
    }

    public function input_id(Type $var = null)
    {
        $id = $this->input->post("id_card");
        if ($id != 1) {
            $this->session->set_flashdata("fail", "gagal");
            redirect('Danru/Patrol/scanRFID');
        }
    }


   //cek status lokasi sudah pernah di lewat apa tidak berdasarkan titik koordinat dan hasil scan barcode
    public function getPlan()
    {
        $id = $this->input->post("tikor");
        $qrcode = $this->input->post("barcode");
        $cek  = $this->db->get_where('titik_area', ['titik_koordinat' => $qrcode , 'id' => $id]);

        if ($cek->num_rows() > 0) {
            $t = $cek->row();
            switch($t->status) {
                case 0 :
                    echo json_encode($cek->result());
                    //echo $t->status .  " || boleh scan barcode" ;
                    break ;
                case 1 :
                    //jika satu artinya area sudah di lewati
                    echo "OK" ;
                break;
                default :
                    echo "";
                break ;   
            }
        } else {
            echo "0";
        }
    }

    
    //tampilkan form upload documentasi area patroli
    public function input_report($id)
    {
        $data = array(
            'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'        => $this->uri->segment(2),
            'area'       => $this->db->get_where('employee', ['npk' => $this->session->userdata('npk')])->row(),
            'plan'       => $this->db->get_where('titik_area', ['id' => $id])->row(),
            'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
        );
        $this->load->view('mobile/header', $data);
        $this->load->view("Danru/Input_report", $data);
        $this->load->view('mobile/fotter');
    }

    
    
    public function compress($file)
    {
        # compress gambar yang di upload
        $this->load->library('image_lib', 'upload');
        $this->image_lib->initialize(array(
            'image_library' => 'gd2', //library yang kita gunakan
            'source_image' => './assets/patrol/' . $file,
            'maintain_ratio' => FALSE,
            'create_thumb' => FALSE,
            'width' => 600,
            'height' => 450
        ));
        $this->image_lib->resize();
    }
    
    //input gambar area hasil patroli
    public function submit()
    {
        $id  = $this->session->userdata("id_akun");
        $idPTRL = "PTRL" . date('dis') . $id;
        $this->load->library('upload');
        $config['upload_path']  = './assets/patrol/';
        for ($i = 1; $i <= 2; $i++) {
            $config['allowed_types']  = "jpg|png|jpeg";
            if (!empty($_FILES['file' . $i]['name'])) {

                $filename = $_FILES['file' . $i]['name'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $files = md5(date('s') . $filename) . '.' . $ext;
                $config['file_name'] = $files;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('file' . $i))
                    $this->upload->display_errors();
                else {
                    //compress gambar
                    $this->compress($files);
                    $upload_berkas = [
                        'id_patroli'   => $idPTRL,
                        'picture'      => $files
                    ];
                    
                    //upload nama gambar ke database
                    $this->Sipd_model->added("documentasi_patroli", $upload_berkas);
                }
            }
        }
        
        $data = [
            'id_npk'        => $this->session->userdata("id_akun"),
            'id_patroli'    => $idPTRL,
            'nama'          => $this->session->userdata('nama'),
            'lokasi'        => $this->input->post("plan"),
            'area_kerja'    => $this->input->post("area_kerja"),
            'tanggal'       => date('Y-m-d'),
            'jam'           => date('H:i:s'),
            'keterangan'    => $this->input->post("keterangan"),
        ];
        
        //input data titik patroli yang sudah di lewati 
        $add = $this->Sipd_model->added("report_patrol", $data);
        
        //update titik patroli yang sudah di lewati 
        $this->Anggota_model->update(['status' => 1 ], "titik_area", ['id' => $this->input->post("idLokasi")]);
        if ($add > 0) {
            echo "berhasil simpan data";
        } else {
            echo "0";
        }
    }
    
    ///update status lokasi jika sudah ter patroli semuanya
    public function updateStatus($id)
    {
        $area = $this->Anggota_model->update(['status' => 0], "titik_area", ['id_plan' => $id]);
        if ($area) {
            echo "Report Send";
        } else {
            echo "Failed Send Report";
        }
    }
}
=======
<?php

date_default_timezone_set('Asia/Jakarta');

class Patrol extends CI_Controller
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
        if ($role_id != 2) {
            redirect('LogOut');
        }

        $this->load->library('upload');
    }

    public function patroli_sementara()
    {
        //get tanggal kemarin 
        $data  = [
            'data' => $this->db->get("report_patrol")->result()
        ];
        $this->load->view("Danru/patroli_sementara", $data);
    }

    public function deleteSementara($id)
    {

        $this->db->where('id', $id);
        $del = $this->db->delete("report_patrol");
        if ($del) {
            $this->session->set_flashdata("ok", 'data terhapus');
            redirect('Danru/Patrol/patroli_sementara');
        } else {
            $this->session->set_flashdata("fail", 'data gagal terhapus');
            redirect('Danru/Patrol/patroli_sementara');
        }
    }

    public function index()
    {
        $k = $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row();
        $area_kerja = $k->area_kerja;
        // $area_kerja = "P1";
        $jam_akhir = "";
        $d = $this->db->get_where("time_patroli", ['area' => $area_kerja]);
        if ($d->num_rows() > 0) {
            $get_time = $d->row();
            $format1 = $get_time->selesai;
            $format2  = new DateTime($format1);
            $jam_akhir =  $format2->format('M d , Y H:i:s');
        }
        $data = array(
            'd'          => $d,
            'jam_akhir'  => $jam_akhir,
            'biodata'    => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'employee' => $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row(),
            'url'        => $this->uri->segment(2),
            'berkas'     => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
        );
        $this->load->view('mobile/header', $data);
        $this->load->view("Danru/scan_barcode", $data);
        // $this->load->view("Danru/scan_barcode2", $data);
        $this->load->view('mobile/fotter');
    }

    public function versi2()
    {
        $data = array(
            'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'employee' => $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row(),
            'url'        => $this->uri->segment(2),
            'berkas'     => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
        );
        $this->load->view('mobile/header', $data);
        $this->load->view("Danru/scan_patroli", $data);
        $this->load->view('mobile/fotter');
    }


    //munculkan pilihan lokasi patroli berdasarkan area yang di pilih
    public function getIDPLAN()
    {
        # code...
        $id_plan  = $this->input->post("id_plan");
        $data  = [
            'data'          => $this->Anggota_model->cari(['id_plan' => $id_plan], "titik_area"),
            'area'          => $id_plan,
            'terlewati'     => $this->Anggota_model->cari(['id_plan' => $id_plan, 'status' => 1], "titik_area")
        ];
        $this->load->view("Danru/pilih_titik", $data);
    }

    public function tapRFID()
    {
        $data = array(
            'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'        => $this->uri->segment(2),
            'berkas'     => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
        );
        $this->load->view('mobile/header', $data);
        $this->load->view("Danru/tap_rfid", $data);
        $this->load->view('mobile/fotter');
    }

    public function input_id(Type $var = null)
    {
        $id = $this->input->post("id_card");
        echo $id;
        // if ($id != 1) {
        //     $this->session->set_flashdata("fail", "gagal");
        //     redirect('Danru/Patrol/scanRFID');
        // }
    }


    //cek status lokasi sudah pernah di lewat apa tidak berdasarkan titik koordinat dan hasil scan barcode
    public function getPlan()
    {
        $id = $this->input->post("tikor");
        $qrcode = $this->input->post("barcode");
        $cek  = $this->db->get_where('titik_area', ['titik_koordinat' => $qrcode, 'id' => $id]);

        if ($cek->num_rows() > 0) {
            $t = $cek->row();
            switch ($t->status) {
                case 0:
                    echo json_encode($cek->result());
                    //echo $t->status .  " || boleh scan barcode" ;
                    break;
                case 1:
                    //jika satu artinya area sudah di lewati
                    echo "OK";
                    break;
                default:
                    echo "";
                    break;
            }
        } else {
            echo "0";
        }
    }


    //tampilkan form upload documentasi area patroli
    public function input_report($id)
    {
        $data = array(
            'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'        => $this->uri->segment(2),
            'area'       => $this->db->get_where('employee', ['npk' => $this->session->userdata('npk')])->row(),
            'shift'      => $this->input->get("shift"),
            'plan'       => $this->db->get_where('titik_area', ['id' => $id])->row(),
            'berkas'     => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
        );
        $this->load->view('mobile/header', $data);
        $this->load->view("Danru/Input_report", $data);
        $this->load->view('mobile/fotter');
    }


    public function compress($file)
    {
        # code...
        $this->load->library('image_lib', 'upload');
        $this->image_lib->initialize(array(
            'image_library' => 'gd2', //library yang kita gunakan
            'source_image' => './assets/patrol/' . $file,
            'maintain_ratio' => FALSE,
            'create_thumb' => FALSE,
            'width' => 600,
            'height' => 450
        ));
        $this->image_lib->resize();
    }


    //input gambar area hasil patroli
    public function submit()
    {

        // input timer  patroli
        $jam_mulai = date('Y-m-d H:i:s');
        $jam_berakhir = date('Y-m-d H:i:s', time() + (60 * 180));
        $area_kerja         = $this->input->post("area_kerja");

        $data = [
            'area'      =>  $area_kerja,
            'mulai'     =>  $jam_mulai,
            'selesai'   =>  $jam_berakhir,
            'shift'     => $this->input->post("shift")
        ];
        $d = $this->db->get_where("time_patroli", ['area' => $area_kerja]);
        if ($d->num_rows() <= 0) {
            $this->db->insert("time_patroli", $data);
        }
        // end of timer patroli

        $lokasi             =  $this->input->post("plan");
        $cek_               = $this->db->get_where('report_patrol', ['lokasi' => $lokasi, 'area_kerja' => $area_kerja, 'shift' => $this->input->post("shift")]);

        if ($cek_->num_rows() >= 1) {
            $this->session->set_flashdata("info",  'Area Sudah di Patroli di jam sebelumnya');
            redirect('Danru/Patrol');
        } else {
            $id  = $this->session->userdata("id_akun");
            $idPTRL = "PTRL" . date('dis') . $id;
            $this->load->library('upload');
            $config['upload_path']  = './assets/patrol/';
            $h = 0;
            for ($i = 1; $i <= 2; $i++) {
                $config['allowed_types']  = "jpg|png|jpeg";
                if (!empty($_FILES['file' . $i]['name'])) {

                    $filename = $_FILES['file' . $i]['name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $files = md5(date('s') . $filename) . '.' . $ext;
                    $config['file_name'] = $files;
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('file' . $i))
                        $this->upload->display_errors();
                    else {
                        $this->compress($files);
                        $upload_berkas = [
                            'id_patroli'   => $idPTRL,
                            'picture'      => $files
                        ];
                        $this->Sipd_model->added("documentasi_patroli", $upload_berkas);
                        $h = $i;
                    }
                }
            }

            if ($h == 2) {
                $data = [
                    'id_npk'        => $this->session->userdata("id_akun"),
                    'id_patroli'    => $idPTRL,
                    'nama'          => $this->session->userdata('nama'),
                    'lokasi'        => $this->input->post("plan"),
                    'area_kerja'    => $this->input->post("area_kerja"),
                    'tanggal'       => date('Y-m-d'),
                    'jam'           => date('H:i:s'),
                    'shift'         => $this->input->post("shift"),
                    'keterangan'    => $this->input->post("keterangan"),
                ];

                $add = $this->Sipd_model->added("report_patrol", $data);
                $this->Anggota_model->update(['status' => 1], "titik_area", ['id' => $this->input->post("idLokasi")]);
                if ($add > 0) {
                    $this->session->set_flashdata("info", "Hasil Patroli " . $lokasi . " di kirim");
                    redirect('Danru/Patrol');
                } else {


                    $this->session->set_flashdata("info", "Hasil Patroli Gagal di Input");
                    redirect('Danru/Patrol');
                }
            } else {
                $this->session->set_flashdata("info", 'gagal upload gambar');
                redirect('Danru/Patrol');
            }
        }
    }

    ///update status lokasi jika sudah ter patroli semuanya
    public function updateStatus()
    {
        $id = $this->input->get("id");
        $shift = $this->input->get("shift");
        //bandingakan jumlah titik yang sudah di lewati dengan titik patroli yang wajib di lewati
        $titikTerlewati = $this->db->get_where("report_patrol", ['area_kerja' => $id, 'shift' => $shift])->num_rows();

        $titikPatroli = $this->db->get_where("titik_area", ['id_plan' => $id])->num_rows();
        $persentase = $titikTerlewati  / $titikPatroli;
        $prs  = $persentase * 100;

        if ($titikTerlewati != $titikPatroli) {
            echo "Terjadi Double Input\n" . "\nHubungi Tim Apps & Development";
        } else {
            //get tanggal patroli di titik pertama
            $getTgl = $this->db->query('SELECT area_kerja , tanggal ,  MIN(id) AS awal  FROM report_patrol WHERE area_kerja = "' . $id . '" and shift="' . $shift . '" ')->row();
            $date = $getTgl->tanggal;

            //tambahkan durasi patroli 
            $waktu_a = $this->db->query('SELECT jam , tanggal FROM report_patrol WHERE id IN (SELECT MIN(id) FROM report_patrol) and area_kerja="' . $id . '" and shift="' . $shift . '" ')->row();

            $waktu_ak = $this->db->query('SELECT jam , tanggal FROM report_patrol WHERE id IN (SELECT MAX(id) FROM report_patrol)  and area_kerja="' . $id . '" and shift="' . $shift . '" ')->row();

            $mulai  = $waktu_a->tanggal  . " "  . $waktu_a->jam;
            // $selesai  = $waktu_ak->tanggal  . " "  . $waktu_ak->jam;
            $selesai  = date('Y-m-d H:i:s');
            $awal  = strtotime($mulai);
            $akhir = strtotime($selesai);
            $diff  = $akhir - $awal;
            $jam   = floor($diff / (60 * 60));
            $menit = $diff - ($jam * (60 * 60));

            $durasi = $jam . "j " . floor($menit / 60) . "m";
            $id_durasi = uniqid(rand(), true);

            //pindahkan hasil patroli ke tabel hasil patroli 
            $move = $this->db->query('INSERT INTO hasil_patroli (id_npk , id_patroli , nama , lokasi , area_kerja , tanggal , jam  , shift , keterangan , tgl_kirim_patroli , id_durasi )
            SELECT  id_npk , id_patroli , nama , lokasi , area_kerja , tanggal , jam ,  shift ,keterangan  , "' . $date . '" , "' . $id_durasi . '" 
            FROM report_patrol WHERE area_kerja = "' . $id . '"  and shift = "' . $shift . '" ');


            //input durasi patroli
            $savedurasi =  $this->db->insert(
                "durasi_patroli",
                [
                    'id_durasi' => $id_durasi,
                    'durasi' => $durasi,
                    'persentasi' => $prs,
                    'area' => $id
                ]
            );

            //update titik patroli menjadi merah semua
            $update = $this->Anggota_model->update(['status' => 0], "titik_area", ['id_plan' => $id]);

            //hapus timer patroli
            $this->db->query('DELETE FROM time_patroli WHERE area="' . $id  . '" and shift="' . $shift  . '" ');

            //hapus report patrol sebelumnya 
            $del = $this->db->query("delete from report_patrol where area_kerja = '" . $id . "' and shift = '" . $shift . "' ");

            $data = [
                'nama' => $this->session->userdata("nama"),
                'npk' => $this->session->userdata("npk"),
                'tanggal' => date('Y-m-d'),
                'count' => 1,
                'shift'  => $shift,
                'area' => $id
            ];
            $input = $this->db->insert("count_patroli", $data);
            if ($update && $input && $move && $del && $savedurasi) {
                echo "Report Send";
            } else {
                echo "Failed Send Report";
            }
        }
    }


    //jika waktu patroli selesai maka akan hangus 
    public function resetTime($area)
    {
        $shift = $this->input->get("shift");
        $area;
        //get tanggal patroli di titik pertama
        $getTgl = $this->db->query('SELECT area_kerja , tanggal ,  MIN(id) AS awal  FROM report_patrol WHERE area_kerja = "' . $area . '"  and shift="' . $shift . '"  ')->row();
        $date = $getTgl->tanggal;

        //tambahkan durasi patroli 
        $waktu_a = $this->db->query('SELECT jam , tanggal FROM report_patrol WHERE id IN (SELECT MIN(id) FROM report_patrol) and area_kerja="' . $area . '" and shift="' . $shift . '"  ')->row();

        $waktu_ak = $this->db->query('SELECT jam , tanggal FROM report_patrol WHERE id IN (SELECT MAX(id) FROM report_patrol)  and area_kerja="' . $area . '" and shift="' . $shift . '"  ')->row();
        // 


        // 
        $titikTerlewati = $this->db->get_where("report_patrol", ['area_kerja' => $area, 'shift' => $shift])->num_rows();

        $titikPatroli = $this->db->get_where("titik_area", ['id_plan' => $area])->num_rows();

        $persentase = $titikTerlewati  / $titikPatroli;
        $prs  = $persentase * 100;

        //cek jika durasi 
        if ($titikTerlewati != $titikPatroli) {
            $count = 0;
            $data = [
                'nama' => $this->session->userdata("nama"),
                'npk' => $this->session->userdata("npk"),
                'tanggal' => date('Y-m-d'),
                'count' => $count,
                'area' => $area,
                'shift' => $shift
            ];
            $this->db->insert("count_patroli", $data);
        } else {
            $count = 1;
            $data = [
                'nama' => $this->session->userdata("nama"),
                'npk' => $this->session->userdata("npk"),
                'tanggal' => date('Y-m-d'),
                'count' => $count,
                'shift' => $shift,
                'area' => $area
            ];
            $this->db->insert("count_patroli", $data);
        }
        // 


        $mulai  = $waktu_a->tanggal  . " "  . $waktu_a->jam;
        $selesai  = $waktu_ak->tanggal  . " "  . $waktu_ak->jam;
        $awal  = strtotime($mulai);
        $akhir = strtotime($selesai);
        $diff  = $akhir - $awal;
        $jam   = floor($diff / (60 * 60));
        $menit = $diff - ($jam * (60 * 60));

        //hitung durasi patroli dalam satu siklus
        $durasi = $jam . "j " . floor($menit / 60) . "m";
        $area_durasi = uniqid(rand(), true);

        //pindahkan hasil patroli ke tabel hasil patroli 
        $move = $this->db->query('INSERT INTO hasil_patroli (id_npk , id_patroli , nama , lokasi , area_kerja , tanggal , jam , shift , keterangan , tgl_kirim_patroli , id_durasi )
        SELECT  id_npk , id_patroli , nama , lokasi , area_kerja , tanggal , jam ,  shift ,keterangan  , "' . $date . '" , "' . $area_durasi . '" 
        FROM report_patrol WHERE area_kerja = "' . $area . '" and shift = "' . $shift . '" ');


        //input durasi patroli
        $savedurasi =  $this->db->insert(
            "durasi_patroli",
            [
                'id_durasi' => $area_durasi,
                'area' => $area,
                'durasi' => $durasi,
                'persentasi' => $prs,
            ]
        );

        // //update titik patroli menjadi merah semua
        $update = $this->Anggota_model->update(['status' => 0], "titik_area", ['id_plan' => $area]);

        // //hapus report patrol sebelumnya 
        $del = $this->db->query('delete from report_patrol where area_kerja = "' . $area . '" and shift = "' . $shift . '" ');


        // $this->db->query('DELETE FROM time_patroli WHERE area="' . $area  . '" and shift="' . $shift  . '" ');
        if ($update &&  $move && $del && $savedurasi) {
            redirect('Danru/Patrol');
        } else {
            redirect('Danru/Patrol');
        }
    }
}
>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426
