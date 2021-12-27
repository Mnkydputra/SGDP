<?php

date_default_timezone_set('Asia/Jakarta');

class Patrol extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $id = $this->session->userdata('id_akun');

        if ($id == null || $id == "") {
            $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
            redirect('Login');
        }
    }


    public function urutan($urutan)
    {

        $area = $this->db->get_where('employee', ['npk' => $this->session->userdata('npk')])->row();
        $data = array(
            'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'        => $this->uri->segment(2),
            'berkas'     => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
            'tikor'      => $this->db->get_where('titik_area', ['id_plan' => $area->area_kerja, 'urutan' => $urutan])->result(),
        );

        $this->load->view('mobile/header', $data);
        $this->load->view("Danru/pilih_plan", $data);
        $this->load->view('mobile/fotter');
    }

    public function getPlan()
    {
        # code...
        $id = $this->input->post("tikor");
        $data = $this->db->get_where('titik_area', ['id' => $id])->result();
        echo json_encode($data);
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


    public function titik()
    {
        # code...
        $id = $this->input->post('titik');
        $data = [
            'tikor'   => $this->db->get_where('titik_area', ['id_plan'  => $id])->result(),
        ];
        $this->load->view('Danru/titik_plan', $data);
    }

    public function input()
    {
        // $barcode     = $this->input->post("barcode");
        // $lat         = $this->input->post("latitude");
        // $long        = $this->input->post("longitude");

        // $cek_plan = $this->db->get_where('tbl_plan_report', ['longitude' => $long, 'latitude' => $lat]);


        // if ($cek_plan->num_rows() > 0) {
        //     $data = $cek_plan->row();
        //     $info = [
        //         'plan'  => $data->plan
        //     ];
        //     echo $data->plan;
        //     // redirect('Danru/Patrol/form_report/' . $data->plan);
        // } else {
        //     echo "anda diluar plan area kerja";
        // }
    }


    public function form_report($id)
    {
        # code...
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
        # code...
        $id  = $this->session->userdata("id_akun");
        $idPTRL = "PTRL" . date('dis') . $id;
        $this->load->library('upload');
        $config['upload_path']  = './assets/patrol/';
        $config['allowed_types']  = "jpg|png|jpeg";
        $this->upload->initialize($config);
        for ($i = 1; $i <= 3; $i++) {
            if (!empty($_FILES['file' . $i]['name'])) {
                $filename = $_FILES['file' . $i]['name'];
                if (!$this->upload->do_upload('file' . $i))
                    $this->upload->display_errors();
                else {
                    $upload_berkas = [
                        'id_patroli'   => $idPTRL,
                        'picture'      => $filename
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
