<?php

use Mpdf\Tag\P;

date_default_timezone_set('Asia/Jakarta');
class Patrol_v2 extends CI_Controller
{

    public function index()
    {
        $now = date('Y-m-d');
        $empl = $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row();
        $kemarin =  date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));
        $data = array(
            'biodata'    => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'employee' => $empl,
            'url'        => $this->uri->segment(2),
            'berkas'     => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
            'kemarin'       => $kemarin,
            'events'        =>  $this->db->query("select * from events where area='" . $empl->area_kerja . "' and tanggal between '" . $kemarin . "' and '" . $now . "'  ")
        );
        $this->load->view('mobile/header', $data);
        $this->load->view("Danru/patrol/home_patrol", $data);
        $this->load->view('mobile/fotter');
    }



    public function listLokasi($id)
    {
        $empl = $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row();


        $now = strtotime(date('H:i:s'));
        // $now = strtotime(date('19:00:00'));
        $shift = "";
        $batas_shift1 = strtotime(date('18:00:00'));
        $batas_shift2 = strtotime(date('06:00:00'));

        if ($now > $batas_shift2 && $now <= $batas_shift1) {
            // echo "shift 1";
            $shift = 1;
        } else if ($now > $batas_shift1 || $now < $batas_shift2) {
            // echo "shift 2";
            $shift = 2;
        }

        $cek_jadwal = $this->db->get_where(
            "events",
            [
                'id'      => $id,
                'shift'   => $shift,
                'status'  => 0,
                'area'    => $empl->area_kerja
            ]
        );
        $da = $cek_jadwal->row();
        if ($cek_jadwal->num_rows() > 0) {
            $empl = $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row();
            $data = [
                'biodata'      => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
                'employee'     => $empl,
                'id_events'    => $da->id,
                'tgl_events'   => $da->tanggal,
                'shift'        => $da->shift,
                'url'          => $this->uri->segment(2),
                'berkas'       => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
                'titik'  => $this->db->get_where("titik_area", ['id_plan' => $empl->area_kerja])
            ];
            $this->load->view('mobile/header', $data);
            $this->load->view("Danru/patrol/lokasi_patrol", $data);
            $this->load->view('mobile/fotter');
        } else {
            // var_dump($da);

            echo "tidak ada jadwal patroli";
        }
    }


    //modal handheld detail
    public function modal_camera($id, $id_events)
    {
        // echo $id;
        $data = [
            'id' => $id,
            'id_events' => $id_events,
            'employee' => $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row(),
        ];
        $this->load->view("Danru/patrol/camera", $data);
    }

    //cek temuan 
    public function kondisi($id_titik, $id_events)
    {

        $cek_jadwal = $this->db->get_where("events", ['id' => $id_events])->row();
        $data = array(
            'biodata'         => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'             => $this->uri->segment(2),
            'area'            => $this->db->get_where('employee', ['npk' => $this->session->userdata('npk')])->row(),
            'tanggal_events'  => $cek_jadwal->tanggal,
            'shift'           => $cek_jadwal->shift,
            'id_events'       => $id_events,
            'plan'            => $this->db->get_where('titik_area', ['id' => $id_titik])->row(),
            'berkas'          => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
        );
        $this->load->view('mobile/header', $data);
        $this->load->view("Danru/patrol/cek_lokasi", $data);
        $this->load->view('mobile/fotter');
    }


    //form kirim kondisi patroli
    public function formKondisi()
    {
        $status = $this->input->post("kondisi");
        $data = [
            'status'  => $status
        ];
        $this->load->view("Danru/patrol/kondisi", $data);
    }

    //compress file yang di upload 
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


    public function submit()
    {

        //data events
        $id_events          = $this->input->post("id_events");
        $tanggal_events     = $this->input->post("tanggal_events");
        $shift              = $this->input->post("shift");
        // end 

        // input timer  patroli
        // $jam_mulai = date('Y-m-d H:i:s');
        // $jam_berakhir = date('Y-m-d H:i:s', time() + (60 * 60));
        $area_kerja         = $this->input->post("area_kerja");

        // $data = [
        //     'area'      =>  $area_kerja,
        //     'mulai'     => $jam_mulai,
        //     'selesai'   => $jam_berakhir
        // ];
        // $d = $this->db->get_where("time_patroli", ['area' => $area_kerja]);
        // if ($d->num_rows() <= 0) {
        //     $this->db->insert("time_patroli", $data);
        // }
        // end of timer patroli

        $lokasi             =  $this->input->post("plan");
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
                'tanggal'       => $tanggal_events,
                'shift'         => $shift,
                'id_events'     => $id_events,
                'jam'           => date('H:i:s'),
                'keterangan'    => $this->input->post("keterangan"),
            ];

            $add = $this->Sipd_model->added("report_patrol", $data);
            $this->Anggota_model->update(['status' => 1], "titik_area", ['id' => $this->input->post("idLokasi")]);
            if ($add > 0) {
                $this->session->set_flashdata("info", "Patroli " . $lokasi . " di kirim");
                redirect('Danru/Patrol_v2/listLokasi/' . $id_events);
            } else {
                $this->session->set_flashdata("info", "Patroli Gagal di Input");
                redirect('Danru/Patrol_v2/listLokasi/' . $id_events);
            }
        } else {
            $this->session->set_flashdata("info", 'gagal upload gambar');
            redirect('Danru/Patrol_v2/listLokasi/' . $id_events);
        }
    }

    //jika waktu patroli selesai maka akan hangus 
    public function resetTime($id)
    {
        $this->db->where("area", $id);
        $this->db->delete("time_patroli");
        $update = $this->Anggota_model->update(['status' => 0], "titik_area", ['id_plan' => $id]);

        // $del = $this->db->query("delete from report_patrol where area_kerja = '" . $id . "' ");

        if ($update) {
            redirect('Danru/Patrol_v2');
        }
    }


    //send patroli 
    public function sendPatrol($id)
    {
        # code...            //get tanggal patroli di titik pertama
        $getTgl = $this->db->query('SELECT area_kerja , tanggal , id_events ,  MIN(id) AS awal  FROM report_patrol WHERE area_kerja = "' . $id . '"')->row();
        $date = $getTgl->tanggal;

        //tambahkan durasi patroli 
        $waktu_a = $this->db->query('SELECT jam , tanggal FROM report_patrol WHERE id IN (SELECT MIN(id) FROM report_patrol) and area_kerja="' . $id . '" ')->row();

        $waktu_ak = $this->db->query('SELECT jam , tanggal FROM report_patrol WHERE id IN (SELECT MAX(id) FROM report_patrol)  and area_kerja="' . $id . '" ')->row();

        $mulai  = $waktu_a->tanggal  . " "  . $waktu_a->jam;
        $selesai  = $waktu_ak->tanggal  . " "  . $waktu_ak->jam;
        $awal  = strtotime($mulai);
        $akhir = strtotime($selesai);
        $diff  = $akhir - $awal;
        $jam   = floor($diff / (60 * 60));
        $menit = $diff - ($jam * (60 * 60));

        $durasi = $jam . " jam " . floor($menit / 60) . " menit";
        $id_durasi = uniqid(rand(), true);

        //pindahkan hasil patroli ke tabel hasil patroli 
        $move = $this->db->query('INSERT INTO hasil_patroli (id_npk , id_patroli , nama , lokasi , area_kerja , tanggal , jam  , id_events , shift , keterangan , tgl_kirim_patroli , id_durasi )
            SELECT  id_npk , id_patroli , nama , lokasi , area_kerja , tanggal , jam , id_events , shift ,keterangan  , "' . $date . '" , "' . $id_durasi . '" 
            FROM report_patrol WHERE area_kerja = "' . $id . '"  ');


        //input durasi patroli
        $savedurasi =  $this->db->insert("durasi_patroli", ['id_durasi' => $id_durasi, 'durasi' => $durasi, 'area' => $id]);

        //update titik patroli menjadi merah semua
        $update = $this->Anggota_model->update(['status' => 0], "titik_area", ['id_plan' => $id]);



        //hapus report patrol sebelumnya 
        $del = $this->db->query("delete from report_patrol where area_kerja = '" . $id . "' ");

        //
        $this->db->query("update events set status = '1' where id='" . $getTgl->id_events . "' ");

        $data = [
            'nama' => $this->session->userdata("nama"),
            'npk' => $this->session->userdata("npk"),
            'tanggal' => date('Y-m-d'),
            'count' => 1,
            'area' => $id
        ];
        $input = $this->db->insert("count_patroli", $data);
        if ($update && $input && $move && $del && $savedurasi) {
            redirect('Danru/Patrol_v2');
        } else {
            redirect('Danru/Patrol_v2');
            // echo "Failed Send Report";
        }
    }
}
