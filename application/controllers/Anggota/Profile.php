<?php


class Profile extends CI_Controller{

  function __construct()
  {
    parent::__construct();
    $this->load->library('user_agent');
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
        'berkas'    => $this->db->get_where('berkas',array('id_berkas' => $this->session->userdata('id_akun')))->row(),
        'url'  => $this->uri->segment(2),
     );
  
        $this->load->view('mobile/header',$data);
        $this->load->view('Anggota/profile',$data);
        $this->load->view('mobile/fotter');
    }

    function Foto()
    {
       $data = array(
         'berkas'    => $this->db->get_where('berkas',array('id_berkas' => $this->session->userdata('id_akun')))->row()
       );
        $this->load->view('mobile/header',$data);
        $this->load->view('Anggota/Foto',$data);
        $this->load->view('mobile/fotter');
    }


    function BiodataUpdate()
    {
      $where = array('id_biodata'  => $this->input->post('id_biodata') );
      //masukan data update karyawan ke array data
      $data = array(
        'ktp'                     => $this->input->post("no_ktp"),
        'kk'                      => $this->input->post("no_kk"),
        'no_hp'                   => $this->input->post("no_hp"),
        'no_emergency'            => $this->input->post("no_emergency"),
        'email'                   => $this->input->post("email"),
        'jl_ktp'                  => $this->input->post("jl_ktp"),
        'rt_ktp'                  => $this->input->post("rt_ktp"),
        'rw_ktp'                  => $this->input->post("rw_ktp"),
        'kel_ktp'                 => $this->input->post("kel_ktp"),
        'kec_ktp'                 => $this->input->post("kec_ktp"),
        'kota_ktp'                => $this->input->post("kota_ktp"),
        'jl_dom'                  => $this->input->post("jl_dom"),
        'rt_dom'                  => $this->input->post("rt_dom"),
        'rw_dom'                  => $this->input->post("rw_dom"),
        'kel_dom'                 => $this->input->post("kel_dom"),
        'kec_dom'                 => $this->input->post("kec_dom"),
        'kota_dom'                => $this->input->post("kota_dom"),
        'berat_badan'             => $this->input->post("berat_badan"),
        'tinggi_badan'            => $this->input->post("tinggi_badan"),
        'imt'                     => $this->input->post("imt"),

      );
      //input update karyawan
      $UpdateInfo = $this->Anggota_model->updateFile($data,"biodata",$where);
      if($UpdateInfo){
        echo "Sukses";
      } else {
        echo "Gagal";
      }
    }

    function EmployeeUpdate()
    {
      $where = array('id_employee'  => $this->input->post('id_karyawan') );
      //masukan data update karyawan ke array data
      $data = array(
        'no_kta'                       => $this->input->post("no_kta"),
        'expired_kta'                  => $this->input->post("ex_kta"),
        'status_kta'                   => $this->input->post("status_kta"),
      
      );
      //input update karyawan
      $updateInfouser = $this->Anggota_model->updateFile($data,"employee",$where);
      if($updateInfouser){
        echo "Sukses";
      } else {
        echo "Gagal";
      }
    }

    public function UpdateFoto()
 	  {	
    $id_akun = $this->session->userdata('id_akun');
 		$directory = "Poto" ;
 		$this->load->library('upload');
 		$config['allowed_types'] = 'jpg|png|jpeg' ;
 		$config['upload_path']  = './assets/berkas/Poto/';
 		$config['overwrite'] = true ;
 		$config['file_name'] = $directory . $this->input->post('npk');
 			$this->upload->initialize($config);

 		if($this->upload->do_upload("foto")){
 			$file = $this->upload->data('file_name');
 			$data = array(
 				'foto'		=> $file
 			);

 			$where = array('id_berkas'  => $this->session->userdata('id_akun'));
 			$update = $this->Anggota_model->updateFile($data,'berkas',$where);
 				if($update){
 					echo "Sukses";
 				}else {
 					echo "Gagal";
 				}
 		}
 	}

  
}
