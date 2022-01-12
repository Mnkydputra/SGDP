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
        'berkas'    => $this->db->get_where('berkas',array('id_berkas' => $this->session->userdata('id_akun')))->row(),
     );
        $this->load->view('mobile/header',$data);
        $this->load->view('Anggota/dashboard',$data);
        $this->load->view('mobile/fotter');
    }

}
?>