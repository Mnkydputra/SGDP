<?php



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
        );
        $this->load->view('mobile/header');
        $this->load->view("Danru/scan", $data);
        $this->load->view('mobile/fotter');
    }

    public function input()
    {
        $barcode     = $this->input->post("barcode");
        $lat         = $this->input->post("latitude");
        $long        = $this->input->post("longitude");

        $data =  [
            $barcode,
            $lat,
            $long
        ];
        var_dump($data);
    }

    // public function cekTitik()
    // {
    //     $latitude = $this->input->post("latitude");
    //     $longitude = $this->input->post("longitude");
    //     # code...
    //     // echo $latitude . "\n";
    //     // echo $longitude;
    //     // -6.2193664
    //     // 106.8269568

    //     if ($latitude != "-6.2193664" && $longitude != "106.8269568") {
    //         echo "anda sedang di luar titik";
    //     } else {
    //         echo "lanjut scan barcode";
    //     }
    // }

    // public function scanBarcode()
    // {
    //     # code...
    //     $this->load->view("Danru/scan");
    // }


}
