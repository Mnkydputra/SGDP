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


    function UpdatePassword()
    {
       $username = $this->input->post('npk');
       $password = md5($this->input->post('password1'));
       $password2 = md5($this->input->post('password2'));
       $ceknpk = $this->db->get_where("akun", array('npk'  => $username))->num_rows();
       if($ceknpk == 0){
           echo "gagal";
       }else if($password == $password2){
            $where = array('npk' => $this->input->post('npk'));
            $data = array('password' => $password);
           $data =  $this->Anggota_model->updatePass($where,$data);
           $this->session->set_flashdata("berhasil","password anda berhasil berubah"); 
           redirect('Login');
        }
        
    }

    function cekLogin()
	{
		date_default_timezone_set('Asia/Jakarta');
		$username 	= $this->input->post('npk');
		$password   = md5($this->input->post('password'));	
		$auth = $this->db->get_where("akun",array("npk" => $username))->num_rows();
         if($auth > 0)
         {
			$user = $this->Login_model->cek_login($username, $password)->row();   
            if ($user->password == md5($username))
            {
                $this->session->set_userdata('npk', $user->npk);
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
        }else{
            $this->session->set_flashdata("gagal","Akun Anda Belum Terdaftar");
            redirect("Login");
            
        }
    } 
}