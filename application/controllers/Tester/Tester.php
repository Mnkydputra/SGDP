<?php

class Tester extends CI_Controller
{


    public function index()
    {
        $this->load->view("Tester/webcam_qrcode");
    }
}
