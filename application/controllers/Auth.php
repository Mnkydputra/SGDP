<?php


class Auth extends CI_Controller
{

    function __construct()
        {
            parent::__construct();
            $this->load->library('user_agent');
            $id = $this->session->userdata('npk');
            
            if ($id == null || $id == "") {
            $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
            redirect('Login');
        }
            
        }

    function index()
    {
        $data =array(
            'akun' => $this->db->get_where('akun', array('npk' => $this->session->userdata('npk')))->row(),
        );
        $this->load->view('Auth',$data);
    }
}

?>