<?php



class Patrol extends CI_Controller
{
    public function index()
    {
        $this->load->view("Danru/scan");
    }

    public function input()
    {
        $barcode  = $this->input->post("barcode");
        $lat = $this->input->post("latitude");
        $long  = $this->input->post("longitude");

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
