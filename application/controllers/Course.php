<?php

class Course extends CI_Controller{
    
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
            
    }
   
    
    function index()
    {
        $data =  array(
            'berkas'    => $this->db->get_where('berkas',array('id_berkas' => $this->session->userdata('id_akun')))->row(),
			'url' 				=> $this->uri->segment(2),
            'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
		);
        $this->load->view('mobile/header',$data);
        $this->load->view('course');
        $this->load->view('mobile/fotter',$data);
    }
}


?>

