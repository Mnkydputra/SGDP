<?php

class Login extends CI_Controller
{


    function __construct()
	  {
	    parent::__construct();
        $this->load->library('user_agent');
		$id 	 = $this->session->userdata('role_id');
	  }

    function index()
    {
    
        if($this->agent->platform() == 'Android'){
            redirect('Login/mobile');
        }else if ($this->agent->platform() == 'iOS'){
            redirect('Login/mobile');
        }else{
            redirect('Login/web');
        }
    }

    function web()
    {
         
        $this->load->view('web/login');
    }

    function mobile()
    {
        
        $this->load->view('mobile/login');
    }

    function cekLogin()
	{
		date_default_timezone_set('Asia/Jakarta');
		$username 	= $this->input->post('npk');
		$password   = md5($this->input->post('password'));	

		$auth = $this->Login_model->cek_login($username, $password)->num_rows();
       
        $cekstatus = $this->db->get_where("biodata",array("npk" =>$username))->row();
		 if($auth > 0){
			$user = $this->Login_model->cek_login($username, $password)->row();   
            var_dump($user);
            }
            if ($user->pass == md5($username))
            {
                redirect("Auth");
            }else {
                $this->session->set_userdata('id_akun',$user->id_akun);
		 		$this->session->set_userdata('npk',$user->npk);
		 		$this->session->set_userdata('role_id',$user->role_id);
		 		$this->session->set_userdata('nama',$user->nama);
                switch ($user->role_id)
                {
                    case '1':
                        redirect('Anggota/Dashboard');
                        break;
                    case '2':
                        redirect('Danru/Dashboard');
                        break;
                    case '3':
                        redirect('Korlap/Dashboard');
                        break;
                    case '4': 
                        redirect('SIPD/Dashboard');
                        break;
                    case '5':
                        redirect('PIC/Dashboard');
                        break;
                    case '6':
                        redirect('SPV/Dashboard');
                        break;
                    case '7':
                        redirect('MGT/Dashboard');
                        break;
                    default:
                        break;
                }
            }
    }
}