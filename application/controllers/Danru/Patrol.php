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


    public function urutan($urutan)
    {

        $area = $this->db->get_where('employee', ['npk' => $this->session->userdata('npk')])->row();
        $data = array(
            'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'        => $this->uri->segment(2),
            'berkas'     => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
            'tikor'      => $this->db->get_where('titik_area', ['id_plan' => $area->area_kerja, 'urutan' => $urutan]),
        );
        $this->load->view('mobile/header', $data);
        $this->load->view("Danru/pilih_plan", $data);
        $this->load->view('mobile/fotter');
    }

    public function getPlan()
    {
        $id = $this->input->post("tikor");
        $qrcode = $this->input->post("barcode");
        $cek  = $this->db->get_where('titik_area', ['titik_koordinat' => $qrcode]);

        if ($cek->num_rows() > 0) {
            $data = $this->db->get_where('titik_area', ['id' => $id])->result();
            echo json_encode($data);
        } else {
            echo "0";
        }
    }

    public function scan_barcode($idTikor)
    {
        $data = array(
            'biodata'       => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'           => $this->uri->segment(2),
            'berkas'        => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
            'plan'          => $this->db->get_where('titik_area', ['id' => $idTikor])->row()
        );

        $this->load->view('mobile/header', $data);
        $this->load->view("Danru/scan", $data);
        $this->load->view('mobile/fotter');
    }

    public function form_report($id)
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


    public function submit()
    {
        $id  = $this->session->userdata("id_akun");
        $idPTRL = "PTRL" . date('dis') . $id;
        $this->load->library('upload');
        $config['upload_path']  = './assets/patrol/';
        for ($i = 1; $i <= 3; $i++) {
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
        if ($add > 0) {
            echo "berhasil simpan data";
        } else {
            echo "0";
        }
    }
}
