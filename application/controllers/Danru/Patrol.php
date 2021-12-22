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
    public function index()
    {
        $data = array(
            'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'  => $this->uri->segment(2),
            'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
        );

        $this->load->view('mobile/header', $data);
        $this->load->view("Danru/scan", $data);
        $this->load->view('mobile/fotter');

        $this->load->view("Danru/tes");
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


    public function form_report($plan)
    {
        # code...
        $data = array(
            'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'  => $this->uri->segment(2),
            'plan'  => $plan,
            'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
        );
        $this->load->view('mobile/header', $data);
        $this->load->view("Danru/Input_report", $data);
        $this->load->view('mobile/fotter');
    }


    public function submit()
    {
        # code...

        $fle  = $_FILES['file']['name'];
        if ($fle == null || $fle == "") {
            echo "file kosong";
        } else {

            $this->load->library('upload');
            $config['upload_path']  = './assets/patrol/';
            $config['allowed_types']  = "jpg|png|jpeg";
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')) {
                echo "failed";
            } else {
                $data = [
                    'id_npk'        =>  $this->session->userdata("id_akun"),
                    'nama'          => $this->session->userdata('nama'),
                    'lokasi'        => $this->input->post("plan"),
                    'tanggal'       => date('Y-m-d'),
                    'jam'           => date('H:i:s'),
                    'keterangan'    => $this->input->post("keterangan"),
                    'picture'       => $fle
                ];
                $add = $this->Sipd_model->added("tbl_report_patrol", $data);
                if ($add > 0) {
                    echo "berhasil simpan data";
                } else {
                    echo "failed";
                }
            }
        }
    }
}
