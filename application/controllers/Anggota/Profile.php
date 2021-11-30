<?php


class Profile extends CI_Controller{

    function __construct()
    {
      parent::__construct();
    }
    
    function index()
    {
        $this->load->view('mobile/header');
        $this->load->view('Anggota/profile');
        $this->load->view('mobile/fotter');
    }
}
?>