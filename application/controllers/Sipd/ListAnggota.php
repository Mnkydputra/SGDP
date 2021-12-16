<?php


class ListAnggota extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $id = $this->session->userdata('id_akun');
        $role_id = $this->session->userdata('role_id');
        if ($id == null || $id == "") {
            $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
                redirect('Login');
            } 
            if ($role_id != 4){
                redirect('LogOut');
            }
    }


    public function index()
    {
        $this->load->view('web/header');
        $this->load->view('');
        $this->load->view('web/fotter');
    }

}

?>