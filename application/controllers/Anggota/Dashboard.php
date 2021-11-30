<?php


Class Dashboard Extends CI_Controller
{
   function __construct()
    {
      parent::__construct();
    }

    public function index()
    {
        $this->load->view('mobile/header');
        $this->load->view('Anggota/dashboard');
        $this->load->view('mobile/fotter');
    }

}
?>