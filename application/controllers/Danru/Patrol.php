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
            'data'          => $this->Anggota_model->cari(['id_plan' => $id_plan], "titik_area"),
            'area'          => $id_plan,
            'terlewati'     => $this->Anggota_model->cari(['id_plan' => $id_plan, 'status' => 1], "titik_area")
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
            'plan'       => $this->db->get_where('titik_area', ['id' => $id])->row(),
            'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
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
                    $this->compress($files);
                    $upload_berkas = [
                        'id_patroli'   => $idPTRL,
                        'picture'      => $files
                    ];
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

        $add = $this->Sipd_model->added("report_patrol", $data);
        $this->Anggota_model->update(['status' => 1], "titik_area", ['id' => $this->input->post("idLokasi")]);
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
        $area = $this->Anggota_model->update(['status' => 0], "titik_area", ['id_plan' => $id]);
        if ($area) {
            echo "Report Send";
        } else {
            echo "Failed Send Report";
        }
    }
}
