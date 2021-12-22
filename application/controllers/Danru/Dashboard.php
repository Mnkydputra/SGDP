<?php


class Dashboard extends CI_Controller
{
<<<<<<< HEAD
    function __construct()
    {
      parent::__construct();
      $this->load->library('user_agent');
      $id = $this->session->userdata('id_akun');
      $role_id = $this->session->userdata('role_id');
      if ($id == null || $id == "") {
        $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
        redirect('Login');
      }
      if ($role_id != 2) {
        redirect('LogOut');
      }
    }

    function index()
    {
      $data = array(
        'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
        'url'  => $this->uri->segment(2),
        'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
     );
        $this->load->view('mobile/header',$data);
        $this->load->view('Danru/dashboard',$data);
        $this->load->view('mobile/fotter');
    }

=======
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
      'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
    );
    $this->load->view('mobile/header', $data);
    $this->load->view('Danru/dashboard', $data);
    $this->load->view('mobile/fotter');
  }
>>>>>>> 68b03c13ee60cafcdf371d95d0f066dab906151a
}
