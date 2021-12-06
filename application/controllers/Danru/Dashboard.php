<?php


Class Dashboard Extends CI_Controller
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

    function index()
    {
      $data = array(
        'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
        'url'  => $this->uri->segment(2),
     );
        $this->load->view('mobile/header');
        $this->load->view('Danru/dashboard',$data);
        $this->load->view('mobile/fotter');
    }

}
?>