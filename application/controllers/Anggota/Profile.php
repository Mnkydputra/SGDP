<?php


class Profile extends CI_Controller{

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
        'employee' => $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row(),
        'url'  => $this->uri->segment(2),
     );
    //  echo '<pre>';
    //  var_dump($data);
        $this->load->view('mobile/header');
        $this->load->view('Anggota/profile',$data);
        $this->load->view('mobile/fotter');
    }
}
